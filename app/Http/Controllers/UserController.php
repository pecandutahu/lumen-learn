<?php

namespace App\Http\Controllers;

use illuminate\http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
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
        return response()->json([
            'status' => $status, 
            'message' => $message, 
            'data' => $data
        ],$status);
    }

    public function index(){
        $Users = User::all();
        $data = [
            'users' => $Users
        ];
        return $this->handleResponse(200,'success',$data);
    }

    public function detail($id){
        $User = User::find($id);
        $data = [
            'user' => $User
        ];
        if($User)
            return $this->handleResponse(200,'success',$data);
            return $this->handleResponse(401,'NotFound',$data);
     
    }

    public function register(Request $request){
        $User = new User;
        $User->name = $request->name; 
        $User->email = $request->email; 
        $User->password = Hash::make($request->password); 
        $User->save();

        $data = [
            'user' => $User
        ];
        if($User)
            return $this->handleResponse(201,'success',$data);
            return $this->handleResponse(401,'NotFound',$data);

        return $this->handleResponse(200,' register success',$data);
    }

    public function login(Request $request){
        $User = User::where('email',$request->email)->first();
        if( Hash::check($request->password,$User->password)){
            $User->api_token = base64_encode(Str::random(40));
            $User->save();
            $data = [
                'User' => $User
            ];
            return $this->handleResponse(200,'success',$data);
        }else{
            $data = [
                'User' => null
            ];
            return $this->handleResponse(401,'Error Login',$data);

        }
    }

    // public function update(Request $request){
    //     $User = User::find($id);
    //     $User->name = $request->name; 
    //     $User->email = $request->email; 
    //     $User->password = Hash::make($request->password); 
    //     $User->save();

    //     $data = [
    //         'todolist' => $Todolist
    //     ];

    //     return $this->handleResponse(200,'success',$data);
    // }

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