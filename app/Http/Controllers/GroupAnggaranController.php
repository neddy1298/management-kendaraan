<?php

namespace App\Http\Controllers;

use App\Models\GroupAnggaran;
use Illuminate\Http\Request;

class GroupAnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groupAnggarans = GroupAnggaran::all();

        return view('groupAnggaran.index', compact('groupAnggarans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(GroupAnggaran $groupAnggaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GroupAnggaran $groupAnggaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GroupAnggaran $groupAnggaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GroupAnggaran $groupAnggaran)
    {
        //
    }
}
