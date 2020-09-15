<?php

namespace App\Http\Controllers;

use App\Hobby;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class HobbyController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hobbies = Hobby::orderBy('created_at', 'DESC')->paginate(10);
        $danger_message = Session::get('danger_message');

        return view('hobby.index', compact('hobbies', 'danger_message'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hobby.create');
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
            'name' => 'required | min:3',
            'description' => 'required | min:10',
            'image' => 'mimes: jpeg, jpg, bmp, gif, png | dimensions:ratio=4/3'
        ]);

        $hobby = new Hobby([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => auth()->id()
        ]);
        $hobby->save();

        if($request->image){
            $image = Image::make($request->image);
            $this->uploadImages($image, $hobby->id);
        }

        //return $this->index()->with('success_message', 'Your hobby '.$hobby->name.' has been created.');
        return redirect('hobby/'.$hobby->id)->with('message_info', 'Please assign some tag now.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function show(Hobby $hobby)
    {
        $availableTags = (Tag::all())->diff($hobby->tags);
        $message_success = Session::get('message_success');
        $message_info = Session::get('message_info');

        return view('hobby.show', compact(['hobby', 'availableTags', 'message_success', 'message_info']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function edit(Hobby $hobby)
    {
        return view('hobby.edit')->with(['hobby'=>$hobby]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hobby $hobby)
    {
        $request->validate([
            'name' => 'required | min:3',
            'description' => 'required | min:10',
            'image' => 'mimes:jpeg,jpg,bmp,png,gif'
        ]);

        if($request->image){
            $image = Image::make($request->image);
            $this->uploadImages($image, $hobby->id);
        }

        $hobby->update([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => auth()->id()
        ]);

        return $this->index()->with('success_message', 'Your hobby '.$hobby->name.' has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hobby  $hobby
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hobby $hobby)
    {
        $hobby->delete();

        return $this->index()->with('danger_message', 'Your hobby '.$hobby->name.' has been deleted.');
    }

    public function uploadImages($image, $hobbyId){
        if($image->width() > $image->height()){     //landscape
            $image->widen(1200)->save(public_path() . "/img/hobbies/" .$hobbyId. "_large.jpg")
                  ->widen(400)->pixelate(12)->save(public_path() . "/img/hobbies/" . $hobbyId . "_pixelated.jpg")
                  ->widen(60)->save(public_path() . "/img/hobbies/" . $hobbyId . "_thumb.jpg");;
        }else{  //portrait
            $image->heighten(900)->save(public_path() . "/img/hobbies/" .$hobbyId. "_large.jpg")
                  ->heighten(400)->pixelate(12)->save(public_path() . "/img/hobbies/" . $hobbyId . "_pixelated.jpg")
                  ->heighten(60)->save(public_path() . "/img/hobbies/" . $hobbyId . "_thumb.jpg");;
        }
    }

    public function deleteImages($hobby_id){
        if(file_exists(public_path() . "/img/hobbies/" . $hobby_id . "_large.jpg"))
            unlink(public_path() . "/img/hobbies/" . $hobby_id . "_large.jpg");
        if(file_exists(public_path() . "/img/hobbies/" . $hobby_id . "_thumb.jpg"))
            unlink(public_path() . "/img/hobbies/" . $hobby_id . "_thumb.jpg");
        if(file_exists(public_path() . "/img/hobbies/" . $hobby_id . "_pixelated.jpg"))
            unlink(public_path() . "/img/hobbies/" . $hobby_id . "_pixelated.jpg");

        return back()->with(
            [
                'danger_message' => "The Image has been deleted."
            ]
        );
    }
}
