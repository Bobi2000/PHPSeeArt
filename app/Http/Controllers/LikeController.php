<?php

namespace App\Http\Controllers;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class LikeController extends Controller
{
    public function likePost($postId)
    {
        if(!session()->get('userId')) {
            return redirect('/login');
        }

        $curUser = User::where('id', session()->get('userId'))->get()->first();

        $record = Like::where('userId', $curUser->id)->where('postId', $postId)->first();

        if(!isset($record)) {
            $newLike = new Like;
            $newLike->userId = $curUser->id;
            $newLike->postId = $postId;
            $newLike->like = true;
            $newLike->dislike = false;
            $newLike->save();
        } else {
            $record->delete();
        }

        return Redirect::back();
    }

    public function dislikePost($postId) {
        if(!session()->get('userId')) {
            return redirect('/login');
        }
        $curUser = User::where('id', session()->get('userId'))->get()->first();
        $record = Like::where('userId', $curUser->id)->where('postId', $postId)->first();

        if(!isset($record)) {
            $newLike = new Like;
            $newLike->userId = $curUser->id;
            $newLike->postId = $postId;
            $newLike->like = false;
            $newLike->dislike = true;
            $newLike->save();
        } else {
            $record->delete();
        }

        return Redirect::back();
    }
}
