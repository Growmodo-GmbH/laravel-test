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
       
         $user= User::create($request->all());
          $user->name = $request->name;
          $user->email = $request->email;
          $user->phone =$request->phone;
          $user->password = bcrypt($request->password);
          $user->save();
          
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
    {   //return dd($request->all()); 
        $resource = User::findOrFail($id);  
        $resource->fill($request->all());
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
