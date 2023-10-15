<?php

namespace App\Http\Controllers;
// namespace App\Models;
use Auth;
use Illuminate\Http\Request;
use App\Models\News;
class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $autor = Auth::user()->id;
        $data = News::with('user')->where('user_id', $autor)->orderBy('created_at')->get();
        return view('news.index',compact('data','autor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $autor = Auth::user()->id;
        // dd($autor);
        return view('news.create', compact('autor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|unique:news,title',
            'content'=>'required',
            'user_id'=>'required',
        ]);
        $item = News::create($request->all());
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
        $autor = Auth::user()->id;
        return view('news.edit',compact('item','autor'));

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
