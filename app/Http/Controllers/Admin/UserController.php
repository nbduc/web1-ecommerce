<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(20);

        return view('admin.users.index', [
            'users' => $users,
            'you' => Auth::user()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create', [
            'roles' => Role::all(),
            'you' => Auth::user()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::create($validatedData);

        $user->roles()->sync($request->roles);

        $request->session()->flash('success', "You have created the user.");

        return redirect(route('admin.users.index'));
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $users = User::where('name', 'like', '%' . $search . '%')
            ->orWhere('email', $search)
            ->paginate(5);
        return view('admin.users.index', [
            'users' => $users,
            'you' => Auth::user(),
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
        return view('admin.users.show', [
            'user' => User::find($id),
            'you' => Auth::user()
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
        return view('admin.users.edit', [
            'roles' => Role::all(),
            'user' => User::find($id),
            'you' => Auth::user()
            ]
        );
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
        $user = User::find($id);

        if(!$user){
            $request->session()->flash('error', "You cannot edit this user.");
        }

        $user->update($request->except(['_token', 'roles']));

        //Không cho phép người dùng tự chỉnh sửa role
        if (Gate::denies('is-me', $id)) {
            $user->roles()->sync($request->roles);
        }

        $request->session()->flash('success', "You have edited the user.");

        return redirect(route('admin.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if (Gate::allows('is-me', $id)) {
            $request->session()->flash('error', "You don't have permission to delete this user!");
        } else {
            User::destroy($id);
            $request->session()->flash('success', "You have deleted the user.");
        }
        return redirect(route('admin.users.index'));
    }
}
