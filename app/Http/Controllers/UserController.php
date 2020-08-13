<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\cars;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SlackError;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $id)
    {
        return view('auth.edit', ['user'=>$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $id)
    {
        $validatedData = request()->validate([
            'name' => 'required',
            'email'=> 'required|email',
            'age' => 'required',
        ]);

        $id->update($validatedData);
        

        if($request->hasFile('image'))
        {
            $extension = $request->image->getExtension();
            $name = $request->image->getClientOriginalName();
            $request->image->storeAs('/public', $name.".".$extension);
            $url = Storage::url($name.".".$extension);#
            if($id->image() == null)
            {
                $id->image()->Create(['name'=>$name, 'url'=>$url]);
            } else {
                $id->image()->delete();
                $id->image()->Create(['name'=>$name, 'url'=>$url]);

            }

        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $id)
    {
        $id->image()->delete();
        return redirect()->back();
    }

}
