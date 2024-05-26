<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagerRequest;
use App\Models\Manager;
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
    
        $manager->update($data);
    
        if (isset($data['roles'])) {
            $manager->roles()->sync($data['roles']);
        }
    
        $manager->load('roles');
    
        $manager->address = $manager->getFullAddressAttribute();
        $manager->save();
    
        return response()->json(['manager' => $manager]);
    }

    public function destroy($id)
    {
        $managers = Manager::findOrFail($id);

        $managers->delete();

        return response()->json(null, 204);
    }
}
