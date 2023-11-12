<?php

namespace App\Http\Controllers;

use App\Models\Zona;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ZonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Zona::all();
        $numb = 1;
        return view("index", compact("data", "numb"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Zona::all();
        return view("create", compact("data"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Zona::create($data);
        return redirect(route("zona.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Zona::find($id);
        return view("edit", compact("data"));
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
        $data = Zona::find($id);
        $data->update($request->all());
        return redirect(route("zona.index"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Zona::destroy($id);
        return redirect()->back();;
    }
}
