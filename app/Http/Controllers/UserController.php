<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $req)
    {

        if(!Auth::check() && $req->path() != '/login'){
            redirect('/login');
        }

        return view('app');
        // return $req->path();
    }
    public function login(Request $req)
    {
        $this->validate($req,[
            'email'    =>'required|email',
            'password' => 'required|min:6'
        ]);
        $credentials = $req->only('email', 'password');
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            if($user->userType =='User'){
                Auth::logout();
                return response()->json([
                    'msg' => 'Incorrect Login detail'
                ], 401);
            }
            return response()->json([
                'msg' => 'Logued!!!',
                'user'=> $user
            ]);
        }else{
            return response()->json([
                'msg' => 'Incorrect Login detail'
            ], 401);

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
