<?php

namespace App\Http\Controllers;

use App\Models\NavigationDrawerChild;
use App\Services\NavigationDrawerChildServices;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class NavigationDrawerChildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $navigationDrawerChild = NavigationDrawerChild::with("navigation_drawer")
            ->orderBy("name", "asc")
            ->paginate(50);
        return response($navigationDrawerChild);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param App\Services\NavigationDrawerChildService $navChild
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, NavigationDrawerChildServices $navChild)
    {
        $this->validate($request, [
            "navigation_drawer_id" => "required",
            "name"                 => "required|string",
            "path_name"            => "required|unique:navigation_drawer_child,path_name",
            "icon"                 => "string",
            "description"          => "string",
        ]);
        $currentLevel = $navChild->maxLevel($request->navigation_drawer_id);

        if (!$request->has("level")) {
            $request->request->add(["level" => $currentLevel]);
        } else {
            $request->level = $currentLevel;
        }

        NavigationDrawerChild::create($request->all());

        return response(["message" => "Success to add navigation drawer child"]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $navigationDrawerChild = NavigationDrawerChild::find($id);

        return Response($navigationDrawerChild);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "navigation_drawer_id" => "required",
            "name"                 => "required|string",
            "path_name"            => "required|unique:navigation_drawer_child,path_name," . $id,
            "icon"                 => "string",
            "description"          => "string",
        ]);

        NavigationDrawerChild::findOrFail($id)
            ->update($request->only(["name", "path_name", "icon", "description"]));

        return response(["message" => "Success update navigation drawer child"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        NavigationDrawerChild::findOrFail($id)->delete();
        return response(["message" => "Success to delete navigation drawer child"]);
    }
}
