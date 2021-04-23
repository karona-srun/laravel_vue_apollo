<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json([
            "success" => true,
            "message" => "User",
            "data" => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'tel' => 'required|min:9|numeric',
            'password' => 'required',
        ]);
   
        if($validator->fails()){
            return response()->json([
                "success" => false,
                "message" => "Validation Error.",
                "data" => $validator->errors()
            ]);     
        }

        try{
            $input['avatar'] = 'avatars/default.jpeg';
            $user = User::create($input);
        }catch(Exception $e){
            return response()->json([
                "success" => false,
                "message" => "Duplicate data"
            ]);
        }

        return response()->json([
            "success" => true,
            "message" => "User created successfully.",
            "data" => $user
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
			return response()->json([
                "success" => false,
                "message" => "User not found."
            ]);
		}
        return response()->json([
            "success" => true,
            "message" => "User created successfully.",
            "data" => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
			return response()->json([
                "success" => false,
                "message" => "User not found."
            ]);
		}
        return response()->json([
            "success" => true,
            "message" => "User created successfully.",
            "data" => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
		$validator = Validator::make($input, [
			'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'tel' => 'required|min:9|numeric',
		]);
		
		if($validator->fails()){
            return response()->json([
                "success" => false,
                "message" => "Validation Error.",
                "data" => $validator->errors()
            ]);     
        }

        $user = User::find($id);
        if (is_null($user)) {
			return response()->json([
                "success" => false,
                "message" => "User not found."
            ]);
		}
		$user->first_name = $input['first_name'];
		$user->last_name = $input['last_name'];
		$user->tel = $input['tel'];
        $user->email = $input['email'];
        $user->avatar = $input['avatar'];
		$user->save();
		
		return response()->json([
			"success" => true,
			"message" => "User updated successfully.",
			"data" => $user
		]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
			return response()->json([
                "success" => false,
                "message" => "User not found."
            ]);
		}
        $user->delete();
        return response()->json([
            "success" => true,
            "message" => "User deleted successfully.",
            "data" => $user
        ]);
    }
}
