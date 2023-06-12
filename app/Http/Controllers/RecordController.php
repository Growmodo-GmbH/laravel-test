<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class RecordController extends Controller{
    public function index(){
        $lists = User::all();
        return view('records', compact('lists'));
    }
    public function userData(){
        $data = User::all();
        return response()->json($data);
    }
    public function update(Request $request, $id) {
        $data = User::find($id);
        $data->update($request->all());
        return response()->json('User updated');
    }
    public function delete($id){
        $data = User::find($id);
        $data->delete();
        return response()->json('deleted');
    }
}
