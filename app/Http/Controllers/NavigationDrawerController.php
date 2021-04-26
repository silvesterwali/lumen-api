<?php

namespace App\Http\Controllers;

use App\Models\NavigationDrawer;
use Illuminate\Http\Request;
use Services\NavigationDrawerService;

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
    public function store(Request $request, NavigationDrawerService $navService)
    {
        $this->validate($request, [
            "name" => "required|unique:navigation_drawers,name",
            "path_name" => "required|unique:navigation_drawers,path_name",
            "icon" => "string",
            "description" => "string",
        ]);

        $request->level = $navService->lastMaxLevel();
        NavigationDrawer::create($request);
        return response(["message" => "Success to add new navigation drawer"]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NavigationDrawer  $navigationDrawer
     * @return \Illuminate\Http\Response
     */
    public function show(NavigationDrawer $navigationDrawer)
    {
        return response($navigationDrawer);
    }

    /**
     * Update the specified resource in storage.
     * note : level cannot update here
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NavigationDrawer  $navigationDrawer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NavigationDrawer $navigationDrawer)
    {
        $this->validate($request, [
            "name" => "required|unique:navigation_drawers,name," . $navigationDrawer->id,
            "path_name" => "required|unique:navigation_drawers,path_name," . $navigationDrawer->id,
            "level" => "required|unique:level,path_name," . $navigationDrawer->id,
            "icon" => "string",
            "description" => "string",
        ]);

        $navigationDrawer->update($request->except("id"));
        return response(["message" => "Success to update navigation drawer"]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NavigationDrawer  $navigationDrawer
     * @return \Illuminate\Http\Response
     */
    public function destroy(NavigationDrawer $navigationDrawer)
    {
        $navigationDrawer->delete();
        return response(["message" => "Success to delete navigation drawer"]);
    }
}
