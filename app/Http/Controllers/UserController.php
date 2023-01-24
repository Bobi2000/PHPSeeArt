<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

class UserController extends Controller
{
    public function user($id)
    {
        $posts = Post::where('userId', $id)->get();

        $listPostsWithUsername = [];
        $curUser = User::find($id);

        foreach ($posts as $value) {
            $additional = $value;
            $additional->username = $curUser->name;
            $additional->userId = $curUser->id;
            array_push($listPostsWithUsername, $additional);
        }

        return view('user', ['listPosts' => $posts, 'user' => $curUser]);
    }
}
