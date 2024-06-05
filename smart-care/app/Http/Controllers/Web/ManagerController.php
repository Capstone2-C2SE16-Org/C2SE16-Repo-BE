<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagerRequest;
use App\Models\District;
use App\Models\Manager;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManagerController extends Controller
{
    public function index()
    {
        $managers = Manager::with('roles')->paginate(10);

        return response()->json($managers);
    }

    public function show($id)
    {
        $managers = Manager::findOrFail($id);

        return response()->json($managers);
    }

    public function store(ManagerRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $profileImage = Storage::url($path);
            $data['profile_image'] = $profileImage;
        }

        $manager = Manager::create($data);

        if (!empty($data['roles'])) {
            $manager->roles()->sync($data['roles']);
        }

        $manager->load('roles');

        $manager->address = $manager->getFullAddressAttribute();
        $manager->save();

        $roles = $manager->roles->pluck('name');

        return response()->json([
            'message' => 'Manager successfully created.',
            'manager' => $manager,
            'roles' => $roles,
        ], 201);
    }

    public function update(ManagerRequest $request, $id)
    {
        $manager = Manager::findOrFail($id);

        $data = $request->validated();

        if ($request->hasFile('profile_image')) {
            if ($manager->profile_image && Storage::disk('public')->exists($manager->profile_image)) {
                Storage::disk('public')->delete($manager->profile_image);
            }
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $data['profile_image'] = Storage::url($path);
        }

        $manager->ward_id = $data['ward_id'];
        $manager->district_id = $data['district_id'];
        $manager->province_id = $data['province_id'];

        $ward = Ward::find($data['ward_id']);
        $district = District::find($data['district_id']);
        $province = Province::find($data['province_id']);

        $fullAddress = $data['address'] . ', ' . ($ward ? $ward->name : '') . ', ' . ($district ? $district->name : '') . ', ' . ($province ? $province->name : '');
        $manager->address = $fullAddress;

        $manager->save(); 

        $manager->update($data);

        if (isset($data['roles'])) {
            $manager->roles()->sync($data['roles']);
        }

        $manager->load('roles');

        // $manager->address = $manager->getFullAddressAttribute();
        // $manager->save();

        return response()->json(['manager' => $manager]);
    }

    public function destroy($id)
    {
        $managers = Manager::findOrFail($id);

        $managers->delete();

        return response()->json(null, 204);
    }
}
