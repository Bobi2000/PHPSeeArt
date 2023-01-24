<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index()
    {
        $curListPosts = Post::all();

        $listPostsWithUsername = [];


        $allLikes = [];

        if (session()->get('userId')) {
            $allLikes = Like::where('userId', session()->get('userId'))->get();
        }

        foreach ($curListPosts as $value) {
            $curUser = User::find($value->userId);
            $additional = $value;
            $additional->username = $curUser->name;
            $additional->userId = $curUser->id;


            foreach ($allLikes as $curLike) {
                if ($value->id == $curLike->postId) {
                    if ($curLike->like) {
                        $additional->isLike = true;
                    }
                    if ($curLike->dislike) {
                        $additional->isDislike = true;
                    }

                    break;
                }
            }


            array_push($listPostsWithUsername, $additional);
        }

        return view('welcome', ['listPosts' => $listPostsWithUsername, 'likes' => $allLikes]);
    }

    public function post($postId)
    {
        $post = Post::where('id', $postId)->get()->first();
        $curUser = User::find($post->userId);

        return view('post', ['post' => $post, 'user' => $curUser]);
    }

    public function makePost()
    {
        if (!session()->has('logged')) {
            return redirect('/login');
        }

        return view('make-post');
    }

    public function deletePost($id)
    {
        if (!session()->has('userId')) {
            return redirect('/login');
        }

        $data = Post::find($id);

        if (!session()->get('userId') == $data->userId) {
            return redirect('/login');
        }

        $data->delete();
        return redirect('/');
    }

    public function editPost($id)
    {
        if (!session()->has('userId')) {
            return redirect('/login');
        }

        $curPost = Post::find($id);

        if (!session()->get('userId') == $curPost->userId) {
            return redirect('/login');
        }

        return view('make-post',  ['curPost' => $curPost]);
    }

    public function submitEditPost(Request $request, $id)
    {
        $curPost = Post::find($id);
        $curPost->title = $request->title;
        $curPost->content = $request->content;
        $curPost->save();

        return redirect('/');
    }

    public function savePost(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        $newPost = new Post;
        Log::info(json_encode($request->all()));
        $newPost->title = $request->title;
        $newPost->content = $request->content;
        $newPost->userId = session()->get('userId');
        $newPost->imageName = $imageName;
        $newPost->save();

        return redirect('/');
    }
}
