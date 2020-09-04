<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;

    public function login()
    {
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $res = [
                'code' => $this->successStatus,
                'token' => $user->createToken('nApp')->accessToken
            ];
            return response()->json($res, $this->successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 403);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            $res = [
                'code' => 202,
                'message' => $validator->errors()
            ];
            return response()->json($res, $this->successStatus);
        } else {
            $exists = User::where('email', $request->email)->count();
            if ($exists > 0) {
                $res = [
                    'code' => 202,
                    'message' => ['email' => 'Email is exists']
                ];
                return response()->json($res, $this->successStatus);
            }
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $res = [
            'code' => $this->successStatus,
            'token' => $user->createToken('nApp')->accessToken,
            'name' => $user->name
        ];
        return response()->json($res, $this->successStatus);
    }

    public function details($id = 0)
    {
        if (empty($id)) {
            $user = Auth::user();
        } else {
            $user = User::find($id);
        }
        if ($user) {
            $res = [
                'code' => $this->successStatus,
                'data' => $user
            ];
        } else {
            $res = [
                'code' => 202,
                'message' => 'Invalid User ID'
            ];
        }
        return response()->json($res, $this->successStatus);
    }

    public function update($id, Request $request)
    {
        $exists = User::find($id);
        if (!$exists) {
            $res = [
                'code' => 202,
                'message' => 'User not exists'
            ];
        } else {
            if (!empty($request->name)) {
                $exists->name = $request->name;
                $exists->update();
                $res = [
                    'code' => $this->successStatus,
                    'message' => 'User '.$id.' updated successfully'
                ];
            } else {
                $res = [
                    'code' => 202,
                    'message' => 'Name is empty'
                ];
            }
        }
        return response()->json($res, $this->successStatus);
    }

    public function remove($id)
    {
        $exists = User::find($id);
        if (!$exists) {
            $res = [
                'code' => 202,
                'message' => 'User not exists'
            ];
        } else {
            $exists->delete();
            $res = [
                'code' => 202,
                'message' => 'User '.$id.' deleted successfully'
            ];
        }
        return response()->json($res, $this->successStatus);
    }

    public function list()
    {
        $user = User::all();
        $res = [
            'code' => $this->successStatus,
            'data' => $user
        ];
        return response()->json($res, $this->successStatus);
    }
}
