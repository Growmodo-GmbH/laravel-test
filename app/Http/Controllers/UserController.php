<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource as UserResource;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users =User::all();
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$data = $request->all()[0];
          User::create($request->all());
        
        return response()->json([
            'message' => 'success data inserted',
            'state' => 'OK',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $resource = User::findOrFail($id);
        return new UserResource($resource);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {    $resource = User::findOrFail($id);  
        $resource->update($request->all());
         $resource->save();
    
         
        
         return response()->json(['message' => 'Resource updated']);
    
    }
        

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resource = User::findOrFail($id);
        $resource->subscription = "unsubscribed";
        $resource->save();
      
        return response()->json(['message' => 'User unsubscribed']);
    }
}
