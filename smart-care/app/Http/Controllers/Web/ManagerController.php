<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagerRequest;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function listRoles()
    {
        $roles = \App\Models\Role::all();  // Fetch all roles
        return response()->json(['roles' => $roles]);
    }
    
    public function index()
    {
        $managers = Manager::with('roles')->paginate(10);

        return response()->json($managers);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $managers = Manager::findOrFail($id);

        return response()->json($managers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ManagerRequest $request)
    {
        // $selectedFields = DB::table('role')
        //             ->select('admin', 'teacher', 'coordinator')
        //             ->get();
        $validatedData = $request->validated();
        $manager = Manager::create($validatedData);

        // Assuming 'roles' is an array of role IDs received from the request
        if (isset($validatedData['roles'])) {
            $manager->roles()->attach($validatedData['roles']);  // Attach roles to the manager
        }

        return response()->json(['manager' => $manager->load('roles')], 201);
    }

    public function update(ManagerRequest $request, $id)
    {
        $managers = Manager::findOrFail($id);

        // Validate incoming data
        $validatedData = $request->validated();

        // Update manager details
        $managers->update($validatedData);

        // Assuming the request contains 'roles' as an array of role IDs
        if (isset($validatedData['roles'])) {
            // Sync roles - this updates the pivot table and ensures only the current roles are assigned
            $managers->roles()->sync($validatedData['roles']);
        }
        // Load the roles relationship to include in the response
        $managers->load('roles');

        return response()->json(['manager' => $managers]);
    }

    public function destroy($id)
    {
        // Retrieve the manager by id, or fail with a 404 error
        $managers = Manager::findOrFail($id);

        // Delete the manager
        $managers->delete();

        // Return a 204 No Content response to signify successful deletion
        return response()->json(null, 204);
    }
}
