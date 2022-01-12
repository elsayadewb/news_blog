<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::Paginate(5);

        return view('users.index',compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data =  $request->validate([
            'name' => 'required|max:150',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6'
        ],[
        ],[

            'name'=>'name',
            'email'=>'email',
            'password'=>'password',

        ]);
        $data['password'] = bcrypt(request('password'));

        User::create($data);
        return redirect()->route('users.index')
            ->with('success','User created successfully.');
    }

    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }
    public function update(Request $request, User $user)
    {
        $data =   $request->validate([
            'name' => 'required|max:150',
            'email' => 'required|email',
         ],[
        ],[
            'name'=>'name ',
            'email'=>'email',
        ]);
        if (request()->has('password') != "")
        {
            $data['password'] = bcrypt(request('password'));
            session()->flash('success','User updated change_password');
        }
//        return dd($user);
        $user->update($data);
        return redirect()->route('users.index') ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success','User deleted successfully');
    }
}
