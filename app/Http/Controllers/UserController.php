<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = User::getRoles();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->route('user.index')->with('success', 'Пользователь успешно создан');
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
        $user = User::find($id);
        $roles = User::getRoles();

        // if ($category->author_id != \Auth::user()->id) {
        //     return redirect()->route('user.index')->withErrors('Вы не можете редактировать данный пост');
        // }

        if (!$user) {
            return redirect()->route('user.index')->withErrors('Данного пользователя не существует');
        }

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::find($id);

        // if ($category->author_id != \Auth::user()->id) {
        //     return redirect()->route('category.index')->withErrors('Вы не можете редактировать данный пост');
        // }

        if (!$user) {
            return redirect()->route('user.index')->withErrors('Данного пользователя не существует');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);

        $user->update();
        $id = $user->id;
        return redirect()->route('user.index', compact('id'))->with('success', 'Категория успешно отредактирована');
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

        // if ($category->author_id != \Auth::user()->id) {
        //     return redirect()->route('category.index')->withErrors('Вы не можете удалить данный пост');
        // }
        if (!$user) {
            return redirect()->route('user.index')->withErrors('Данного пользователя не существует');
        }

        $user->delete();
        return redirect()->route('user.index')->with('success', 'Пользователь успешно удален');
    }
}
