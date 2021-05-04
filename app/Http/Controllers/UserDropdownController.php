<?php

namespace App\Http\Controllers;

use App\Models\UserDropdown;
use Illuminate\Http\Request;

class UserDropdownController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userDropdown = UserDropdown::with(["user", "navigationDropdown"])
            ->whereHas("user")
            ->whereHas("navigationDropdown")
            ->paginate(50);

        return response($userDropdown);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ["user_id" => "required|integer", "navigation_dropdowns_id"]);
        UserDropdown::updateOrCreate($request->only(['user_id', 'navigation_dropdowns_id']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserDropdown::findOrFail($id)->delete();
    }
}
