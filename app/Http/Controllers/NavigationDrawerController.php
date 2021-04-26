<?php

namespace App\Http\Controllers;

use App\Models\NavigationDrawer;
use App\Services\NavigationDrawerServices;
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
     * @param App\Services\NavigationDrawerServices $navService
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, NavigationDrawerServices $navService)
    {
        $this->validate($request, [
            "name"        => "required|unique:navigation_drawers,name",
            "path_name"   => "required|string",
            "icon"        => "string",
            "description" => "string",
        ]);

        $request->request->add(["level" => $navService->lastMaxLevel()]);
        NavigationDrawer::create($request->except("id"));
        return response(["message" => "Success to add new navigation drawer"]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $navigationDrawer = NavigationDrawer::find($id);
        return response($navigationDrawer);
    }

    /**
     * Update the specified resource in storage.
     * note : level cannot update here
     * @param  int $id
     * @param  \App\Models\NavigationDrawer  $navigationDrawer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            "name"        => "required|unique:navigation_drawers,name," . $id,
            "path_name"   => "required|string",
            "icon"        => "string",
            "description" => "string",
        ]);

        NavigationDrawer::findOrFail($id)
            ->update($request->except(["id", "level"]));

        return response(["message" => "Success to update navigation drawer"]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        NavigationDrawer::findOrFail($id)
            ->delete();
        return response(["message" => "Success to delete navigation drawer"]);
    }
}
