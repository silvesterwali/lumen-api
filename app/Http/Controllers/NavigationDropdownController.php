<?php

namespace App\Http\Controllers;

use App\Models\NavigationDropdown;
use Illuminate\Http\Request;

class NavigationDropdownController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $navigationDropdown = NavigationDropdown::orderBy('name', 'asc')->paginate(50);
        return response($navigationDropdown);
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
            'name'        => "required|string",
            'path_name'   => 'required|string|unique:navigation_dropdowns,path_name',
            'description' => 'string',
            'icon'        => 'string',
        ]);

        NavigationDropdown::create($request->only(["name", "path_name", "description", "icon"]));
        return response(["message" => "Success create new navigation dropdown"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response(NavigationDropdown::findOrFail($id));
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
            'name'        => "required|string",
            'path_name'   => 'required|string|unique:navigation_dropdowns,path_name,' . $id,
            'description' => 'string',
            'icon'        => 'string',
        ]);

        NavigationDropdown::findOrFail($id)
            ->update($request->only(["name", "path_name", "description", "icon"]));
        return response(["message" => "Success update navigation dropdown"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        NavigationDropdown::findOrFail($id)->delete();
        return response(["message" => "Success to remove navigation dropdown"]);
    }
}
