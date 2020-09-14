<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Hobby;

class HobbyTagController extends Controller
{
    public function getFilteredHobies($tag_id){
        $tag = new Tag();
        $hobbies = $tag->findOrFail($tag_id)->filteredHobbies()->paginate(10);

        $filter = $tag->find($tag_id);

        return view('hobby.index', compact(['hobbies', 'filter']));
    }

    public function attachTag($hobby_id, $tag_id){
        $hobby = Hobby::find($hobby_id);
        $tag = Tag::find($tag_id);

        $hobby->tags()->attach($tag_id);

        return back()->with(['success_message' => "The Tag <b>" . $tag->name . "</b> was added."]);
    }

    public function detachTag($hobby_id, $tag_id){
        $hobby = Hobby::find($hobby_id);
        $tag = Tag::find($tag_id);

        $hobby->tags()->detach($tag_id);

        return back()->with(['success_message' => "The Tag <b>" . $tag->name . "</b> was removed."]);
    }
}
