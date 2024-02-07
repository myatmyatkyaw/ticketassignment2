<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Crypt;
//use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::All();
        return view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$users = User::All();
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8', // Add other validation rules as needed
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        // $value = $request->password;
        // $decrypt = Crypt::decryptString($value);
        // $user->password = $decrypt;
        // $value = Crypt::encryptString($request->password);
        // $dd = Crypt::decryptString($value);
        // $user->password = $dd;

        $user->password = encrypt($request->password);

        $user->save();
        return redirect()->route('user.index')->with('success','New User is Created Successfully');
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
        return view('user.detail',compact('user'));
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
        return view('user.edit',compact('user'));
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
        $request->validate([
            'password' => 'required|min:8', // Add other validation rules as needed
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        // $user->password = $request->password;

        // $value = Crypt::encryptString($request->password);
        // $dd = Crypt::decryptString($value);
        // $user->password = $dd;

        $user->password = encrypt($request->password);



        if ($request->has('exampleCheck1')) {
            // If checkbox is checked, set the role to 'admin'
            $role = "0";
        } else {
            // If checkbox is not checked, set the role based on the selected role from the dropdown
            $role = $request->input('role');
        }
        $user->role = $role;
        $user->update();
        return redirect()->route('user.index')->with('update','User is updated successfully');
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
        if($user){
            $user->delete();
        }
        return redirect()->route('user.index')->with('delete','User is deleted!');
    }
}
