<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    private $paginate = 6;

    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
        // $this->middleware('admin')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $categories = Category::all();

        if ($request->category === "0") {
            $posts = Post::join('users', 'author_id', '=', 'users.id')
                ->whereNull('category_id')
                ->orderBy('posts.created_at', 'desc')
                ->select('posts.*', 'users.*', 'posts.id as id')
                ->paginate($this->paginate);
            return view('posts.index', compact('posts', 'categories'));
        }

        if ($request->category) {
            $category = Category::find($request->category);
            $posts = Post::join('users', 'author_id', '=', 'users.id')
                ->where('category_id', '=', $request->category)
                ->orderBy('posts.created_at', 'desc')
                ->select('posts.*', 'users.*', 'posts.id as id')
                ->paginate($this->paginate);
            return view('posts.index', compact('posts', 'category', 'categories'));
        }

        if ($request->search) {
            $posts = Post::join('users', 'author_id', '=', 'users.id')
                ->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('descr', 'like', '%' . $request->search . '%')
                ->where('name', 'like', '%' . $request->search . '%')
                ->orderBy('posts.created_at', 'desc')
                ->select('posts.*', 'users.*', 'posts.id as id')
                ->paginate($this->paginate);
            return view('posts.index', compact('posts', 'categories'));
        }

        $posts = Post::join('users', 'author_id', '=', 'users.id')
            ->orderBy('posts.created_at', 'desc')
            ->select('posts.*', 'users.*', 'posts.id as id')
            ->paginate($this->paginate);
        return view('posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->descr = $request->descr;
        $post->category_id = $request->category_id;
        $post->short_descr = strip_tags(
            Str::length($request->descr) > 300 ? Str::substr($request->descr, 0, 300) . '...' : $request->descr
        );
        $post->author_id = \Auth::user()->id;
        // dd($request->validated());
        if ($request->file('img')) {
            $path = Storage::putFile('public', $request->file('img'));
            $url = Storage::url($path);
            $post->img = $url;
        }

        $post->save();

        return redirect()->route('post.index')->with('success', 'Пост успешно создан');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::join('users', 'author_id', '=', 'users.id')
            ->leftJoin('categories', 'category_id', '=', 'categories.id')
            ->select('posts.*', 'users.*', 'posts.id as id', 'categories.title as category')
            ->find($id);

        if (!$post) {
            return redirect()->route('post.index')->withErrors('Данного поста не существует');
        }

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();

        if (!\Auth::user()->canEditPost($post->author_id)) {
            return redirect()->route('post.index')->withErrors('Вы не можете редактировать данный пост');
        }

        if (!$post) {
            return redirect()->route('post.index')->withErrors('Данного поста не существует');
        }

        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);

        if (!\Auth::user()->canEditPost($post->author_id)) {
            return redirect()->route('post.index')->withErrors('Вы не можете редактировать данный пост');
        }

        if (!$post) {
            return redirect()->route('post.index')->withErrors('Данного поста не существует');
        }

        $post->title = $request->title;
        $post->short_descr = strip_tags(
            Str::length($request->descr) > 300 ? Str::substr($request->descr, 0, 300) . '...' : $request->descr
        );
        $post->descr = $request->descr;
        $post->category_id = $request->category_id;

        if ($request->file('img')) {
            $path = Storage::putFile('public', $request->file('img'));
            $url = Storage::url($path);
            $post->img = $url;
        }

        $post->update();
        $id = $post->id;
        return redirect()->route('post.show', compact('id'))->with('success', 'Пост успешно отредактирован');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        // if ($post->author_id != \Auth::user()->id) {
        if (!\Auth::user()->canEditPost($post->author_id)) {
            return redirect()->route('post.index')->withErrors('Вы не можете удалить данный пост');
        }

        if (!$post) {
            return redirect()->route('post.index')->withErrors('Данного поста не существует');
        }

        $post->delete();
        return redirect()->route('post.index')->with('success', 'Пост успешно удален');
    }
}
