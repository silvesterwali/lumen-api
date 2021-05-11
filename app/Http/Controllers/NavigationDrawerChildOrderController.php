<?php

namespace App\Http\Controllers;

use App\Models\NavigationDrawerChild;
use Illuminate\Http\Request;

/**
 * the class is used to ordering the level of navigation drawer child
 * reorder only occurred for same navigation drawer parent id
 */
class NavigationDrawerChildOrderController extends Controller
{
    /**
     * reorder the the level of navigation drawer child navigation to the top
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function moveUp(Request $request)
    {
        $this->validate($request, ["navigation_drawer_child_id" => "required|integer"]);
        $currentNavigation = NavigationDrawerChild::findOrFail($request->navigation_drawer_child_id);

        $upperNavigation = NavigationDrawerChild::where("level", ">", $currentNavigation->level)
            ->where("navigation_drawer_id", $currentNavigation->navigation_drawer_id)
            ->orderBy("level", "ASC")
            ->first();

        if ($upperNavigation) {
            $this->updateLevel($currentNavigation->id, $upperNavigation->level);
            $this->updateLevel($upperNavigation->id, $currentNavigation->level);
        }

        return response(["message" => "Success to order level up"]);
    }

    /**
     * reorder the level of navigation drawer child navigation to bottom
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function moveDown(Request $request)
    {
        $this->validate($request, ["navigation_drawer_child_id" => "required|integer"]);
        $currentNavigation = NavigationDrawerChild::findOrFail($request->navigation_drawer_child_id);

        $lowerNavigation = NavigationDrawerChild::where("level", "<", $currentNavigation->level)
            ->where("navigation_drawer_id", $currentNavigation->navigation_drawer_id)
            ->orderBy("level", "DESC")
            ->first();

        if ($lowerNavigation) {
            $this->updateLevel($currentNavigation->id, $lowerNavigation->level);
            $this->updateLevel($lowerNavigation->id, $currentNavigation->level);
        }

        return response(["message" => "Success to order level down"]);
    }

    /**
     * method to update level fot navigation drawer child
     * @param int $id
     * @param int $level
     * @return boolean
     */
    private function updateLevel($id, $level)
    {
        NavigationDrawerChild::find($id)->update(["level" => $level]);
        return true;
    }
}
