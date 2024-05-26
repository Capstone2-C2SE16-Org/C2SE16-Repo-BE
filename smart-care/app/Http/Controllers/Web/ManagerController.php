<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagerRequest;
use App\Models\Manager;
use Illuminate\Http\Request;

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
        $validatedData = $request->validated();
        $manager = Manager::create($validatedData);

        if (isset($validatedData['roles'])) {
            $manager->roles()->attach($validatedData['roles']);  
        }

        return response()->json(['manager' => $manager->load('roles')], 201);
    }

    public function update(ManagerRequest $request, $id)
    {
        $managers = Manager::findOrFail($id);

        $validatedData = $request->validated();

        $managers->update($validatedData);

        if (isset($validatedData['roles'])) {
            $managers->roles()->sync($validatedData['roles']);
        }
        $managers->load('roles');

        return response()->json(['manager' => $managers]);
    }

    public function destroy($id)
    {
        $managers = Manager::findOrFail($id);

        $managers->delete();

        return response()->json(null, 204);
    }
}
