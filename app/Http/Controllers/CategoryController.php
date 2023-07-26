<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category();
        $category->title = $request->title;

        $category->save();

        return redirect()->route('category.index')->with('success', 'Категория успешно создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        // if ($category->author_id != \Auth::user()->id) {
        //     return redirect()->route('category.index')->withErrors('Вы не можете редактировать данный пост');
        // }

        if (!$category) {
            return redirect()->route('category.index')->withErrors('Данной категории не существует');
        }

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);

        // if ($category->author_id != \Auth::user()->id) {
        //     return redirect()->route('category.index')->withErrors('Вы не можете редактировать данный пост');
        // }

        if (!$category) {
            return redirect()->route('category.index')->withErrors('Данной категории не существует');
        }

        $category->title = $request->title;

        $category->update();
        $id = $category->id;
        return redirect()->route('category.index', compact('id'))->with('success', 'Категория успешно отредактирована');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        // if ($category->author_id != \Auth::user()->id) {
        //     return redirect()->route('category.index')->withErrors('Вы не можете удалить данный пост');
        // }
        if (!$category) {
            return redirect()->route('category.index')->withErrors('Данной категории не существует');
        }

        $category->delete();
        return redirect()->route('category.index')->with('success', 'Категория успешно удалена');
    }
}
