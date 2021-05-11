<?php

namespace App\Http\Controllers;

use App\Models\NavigationDropdown;
use Illuminate\Http\Request;

class NavigationDropdownOrderController extends Controller
{
    public function moveUp(Request $request)
    {
        $this->validate($request, [
            "navigation_dropdown_id" => "required",
        ]);

        $currentNavigation = NavigationDropdown::findOrFail($request->navigation_dropdown_id);
        $upperNavigation   = NavigationDropdown::where("level", ">", $currentNavigation->level)
            ->orderBy("level", "ASC")
            ->first();

        if ($upperNavigation) {
            $this->updateLevel($currentNavigation->id, $upperNavigation->level);
            $this->updateLevel($upperNavigation->id, $currentNavigation->level);
        }

        return response(["message" => "Success to reordering dropdown"]);

    }

    public function moveDown(Request $request)
    {
        $this->validate($request, [
            "navigation_dropdown_id" => "required",
        ]);

        $currentNavigation = NavigationDropdown::findOrFail($request->navigation_dropdown_id);
        $lowerNavigation   = NavigationDropdown::where("level", "<", $currentNavigation->level)
            ->orderBy("level", "DESC")
            ->first();

        if ($lowerNavigation) {
            $this->updateLevel($currentNavigation->id, $lowerNavigation->level);
            $this->updateLevel($lowerNavigation->id, $currentNavigation->level);
        }

        return response(["message" => "Success to reordering dropdown"]);

    }

    /**
     * method for  update level on dropdown
     * @param int $id
     * @param int $level
     **/
    private function updateLevel($id, $level)
    {
        NavigationDropdown::find($id)->update(["level" => $level]);
    }
}
