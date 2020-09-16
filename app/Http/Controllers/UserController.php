<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(10);

        abort_unless(Gate::allows('viewAny', $users), 403);

        return view('user.index', compact('users'));
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
        $success_message = Session::get('success_message');

        return view('user.show', compact(['user', 'success_message']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        abort_unless(Gate::allows('update', $user), 403);

        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        abort_unless(Gate::allows('update', $user), 403);

        $request->validate([
            'name' => 'required | min:3',
            'motto' => 'required | min:20',
            'image' => 'mimes:jpeg,jpg,bmp,png,gif'
        ]);

        if($request->image){
            $image = Image::make($request->image);
            $this->uploadImages($image, $user->id);
        }

        $user->update([
            'name' => $request->name,
            'motto' => $request->motto,
            'about_me' => $request->about_me
        ]);

        return redirect()->route('user.show', $user->id)->with(['success_message' => 'Your profile has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        abort_unless(Gate::allows('delete', $user), 403);

        $user->delete();

        return $this->index()->with(['success_message' => 'User '.$user->name.' has been deleted']);
    }

    public function uploadImages($image, $userId){
        if($image->width() > $image->height()){     //landscape
            $image->resize(500, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path() . "/img/users/" .$userId. "_large.jpg")
                  ->resize(400, 500)->pixelate(12)->save(public_path() . "/img/users/" . $userId . "_pixelated.jpg");

            $image->widen(60)->save(public_path() . "/img/users/" . $userId . "_thumb.jpg");

        }else{  //portrait
            $image->heighten(500)->save(public_path() . "/img/users/" .$userId. "_large.jpg")
                  ->heighten(300)->pixelate(12)->save(public_path() . "/img/users/" . $userId . "_pixelated.jpg");

            $image->heighten(60)->save(public_path() . "/img/users/" . $userId . "_thumb.jpg");
        }
    }
}
