<?php

namespace App\Http\Controllers;

use App\Models\NavigationDrawer;
use Illuminate\Http\Request;

class NavigationDrawerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $navigationDrawers = NavigationDrawer::orderBy('name', "asc")
            ->paginate(50);
        return response($navigationDrawers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "name" => "required|unique:navigation_drawers,name",
            "path_name" => "required|unique:navigation_drawers,path_name",
            "icon" => "string",
            "description" => "string",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NavigationDrawer  $navigationDrawer
     * @return \Illuminate\Http\Response
     */
    public function show(NavigationDrawer $navigationDrawer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NavigationDrawer  $navigationDrawer
     * @return \Illuminate\Http\Response
     */
    public function edit(NavigationDrawer $navigationDrawer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NavigationDrawer  $navigationDrawer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NavigationDrawer $navigationDrawer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NavigationDrawer  $navigationDrawer
     * @return \Illuminate\Http\Response
     */
    public function destroy(NavigationDrawer $navigationDrawer)
    {
        //
    }
}
