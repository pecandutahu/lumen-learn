<?php

namespace App\Http\Controllers;

use illuminate\http\Request;
use App\Todolist;

class TodolistController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function handleResponse($status, $message, $data){
        return response()->json([$status, $message, $data]);
    }

    public function index(){
        $Todolists = Todolist::all();
        $data = [
            'todolists' => $Todolists
        ];
        return $this->handleResponse(200,'success',$data);
    }

    public function detail($id){
        $Todolists = Todolist::find($id);
        $data = [
            'todolists' => $Todolists
        ];
        if($Todolists)
            return $this->handleResponse(200,'success',$data);
            return $this->handleResponse(401,'NotFound',$data);
     
    }
    public function store(Request $request){
        $Todolist = new Todolist;
        $Todolist->title = $request->title; 
        $Todolist->description = $request->description; 
        $Todolist->status = $request->status; 
        $Todolist->thumbnail = $request->thumbnail; 
        $Todolist->author_id = $request->author_id; 
        $Todolist->save();

        $data = [
            'todolist' => $Todolist
        ];

        return $this->handleResponse(200,'success',$data);
    }

    public function update(Request $request){
        $Todolist = Todolist::find($request->id);
        $Todolist->title = $request->title; 
        $Todolist->description = $request->description; 
        $Todolist->status = $request->status; 
        $Todolist->thumbnail = $request->thumbnail; 
        $Todolist->author_id = $request->author_id; 
        $Todolist->save();

        $data = [
            'todolist' => $Todolist
        ];

        return $this->handleResponse(200,'success',$data);
    }

    public function destroy($id){
        $Todolist = Todolist::find($id);
        $data = [
            'todolist' => $Todolist
        ];

        $Todolist->delete();

        return $this->handleResponse(200,'success',$data);

    }

    //
}