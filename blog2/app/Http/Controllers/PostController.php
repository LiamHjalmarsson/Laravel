<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function search ($term) {
        // return Post::where('title', 'LIKE', '%' . $term . '%')->orWhere('body', 'LIKE', '%' . $term . '%')->with('user:id,username,avatar')->get();

        $posts = Post::search($term)->get();
        $posts->load("user:id,username,avatar");
        return $posts;
    }

    public function editUpdate (Post $post, Request $request) {
        $data = $request->validate(
            [
                "title" => "required",
                "body" => "required"
            ]
        );

        $data["title"] = strip_tags($data["title"]);
        $data["body"] = strip_tags($data["body"]);

        $post->update($data);

        // instead of redirect you can use back will take the user to the url the just came previously from 
        return back()->with("success", "post updated successfully");

    }

    public function editForm (Post $post) {
        return view("edith-post", ["post" => $post]);
    }

    public function deleteApi (Post $post) {
        $post->delete();
        return "post was deleted successfully";
    }

    public function delete (Post $post) {

        // doing the controll in the controller 
        // if ( auth()->user()->cannot("delete", $post)) {
        //     return "cant do that";
        // }
        $post->delete();
        return redirect("/profile/" . auth()->user()->username)->with("success", "Deleted post successfully");
    }

    public function showCreateForm (Request $request) {
        return view("create-post");
    }

    public function createApi (Request $request) {
        $data = $request->validate(
            [
                "title" => "required",
                "body" => "required"
            ]
        );

        $data["title"] = strip_tags($data["title"]);
        $data["body"] = strip_tags($data["body"]);

        // spelling out the auther or user of the post ( ID OF THE POST )
        // adding to the array a new item 
        $data["user_id"] = auth()->id(); // auth helper function 

        $post = Post::create($data);

        return $post->id;
    }

    public function createNewPost (Request $request) {
        $data = $request->validate(
            [
                "title" => "required",
                "body" => "required"
            ]
        );

        $data["title"] = strip_tags($data["title"]);
        $data["body"] = strip_tags($data["body"]);

        // spelling out the auther or user of the post ( ID OF THE POST )
        // adding to the array a new item 
        $data["user_id"] = auth()->id(); // auth helper function 

        $post = Post::create($data);

        return redirect("/post/{$post->id}")->with("success", "new post created");
    }

    // UNDESTAND THIS 
    // from web sending {post} acess here with example $post gives whater ever the value is 
    // typ hinting to laravel that whatever this incoimnig value is
    // $post is we want to ubterpret it trough the lens of what is a blog post or post model
    // Laravel can look up the appropriate pst in the db just based on this incoming id value 
    
    public function showPost (Post $post) { 
        // POLICY let us spell out a check out just once and then we can refrence to that ceck/policy in as many diffrent method os blade Templates or routes as we want
        // PostPolicy file 
        return view("single-post", ["post" => $post]);
    }
}


// MARK DOWN LEt you write in tags in blogs etc