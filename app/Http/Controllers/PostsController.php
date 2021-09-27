<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;

use App\category;
use App\Post;
use App\Tag;
use App\User;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkCategory')->only('create');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $user_id = auth()->user()->id;
        // $posts = DB::table('posts')
        //   ->join('users', 'posts.user_id', 'users.id')
        //     ->where('posts.user_id', $user_id)
        //   ->get();
        return view('posts.index')->with('posts', Post::where('posts.user_id', $user_id)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', category::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $request->image->store('images', 'public'),
            'category_id' => $request->categoryID,
            'user_id' => $request->user_id
        ]);

        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }

        session()->flash('success', 'post created successfuly');

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $user = $post->user;
        $profile = $post->user->profile;
        return view('posts.show')->with('post', $post)->with('user', $user)->with('profile', $profile)->with('categories', Category::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create', ['post' => $post, 'categories' => Category::all(), 'tags' => Tag::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only(['title', 'description', 'content']);
        if ($request->hasFile('image')) {
            $image = $request->image->store('images', 'public');
            Storage::disk('public')->delete($post->image);
            $data['image'] = $image;
        }

        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }

        $post->update($data);

        session()->flash('success', 'post updated successfuly');
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        if ($post->trashed()) {
            Storage::disk('public')->delete($post->image);
            $post->forceDelete();
            session()->flash('success', 'post delete successfuly');
        } else {
            $post->delete();
            session()->flash('success', 'post trashed successfuly');
        }

        return redirect(route('posts.index'));
    }

    public function trashed()
    {
        $user_id = auth()->user()->id;
        $trashed_post = '0';
        $trashed = Post::onlyTrashed()->where('posts.user_id', $user_id)->get();
        // session()->flash('success', 'post trashed successfuly');
        return view('posts.index')->with('posts', $trashed)->with('trashed_post', $trashed_post);
    }
    public function restore($id)
    {
        Post::withTrashed()->where('id', $id)->restore();

        session()->flash('success', 'post restored successfuly');
        return redirect(route('trashed.index'));
    }
}
