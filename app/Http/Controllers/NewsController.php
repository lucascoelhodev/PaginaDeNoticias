<?php

namespace App\Http\Controllers;
// namespace App\Models;
use Illuminate\Http\Request;
use App\Models\News;
use Validator;
class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = News::orderBy('id')->get();

        return view('news.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('news.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|unique:news,title',
            'author'=>'required',
            'content'=>'required',
        ]);
        News::create($request->all());
        return redirect()->route('news.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = News::findOrfail($id);
        return view('news.show',compact('item'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = News::findOrfail($id);
        return view('news.edit',compact('item'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = News::findOrfail($id);
        $item->fill($request->all())->save();

        return redirect()->route('news.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = News::findOrfail($id);
        $item->delete();
        return redirect()->route('news.index');

    }
}
