<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kodeine\Acl\Models\Eloquent\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Role::orderBy('created_at')->get();
        return view('role.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $slug = strtolower($request->input('name'));

    $customRequest = request()->merge(['slug' => $slug]);

    $this->validate($customRequest, [
    'name' => 'required|unique:roles,name',
    'slug' => 'unique:roles,slug',
    'description' => 'required',
    ]);
    // dd($request);
    $item = Role::create([
        'name' => $request->input('name'),
        'slug' => $slug,
        'description' => $request->input('description'),
    ]);

    return redirect()->route('role.index');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
