<?php

namespace App\Http\Controllers;

use App\Models\NavigationDrawer;
use Illuminate\Http\Request;

class NavigationDrawerOrderController extends Controller
{
    /**
     * move one step up from current level
     * @param \Illuminate\Http\Request $request;
     * @return \Illuminate\Http\Response;
     */
    public function moveUp(Request $request)
    {
        $this->validate($request, [
            "navigation_drawer_id" => "required|integer",
        ]);

        $currentNavDrawer = NavigationDrawer::findOrFail($request->navigation_drawer_id);

        $upperNavDrawer = NavigationDrawer::where("level", ">", $currentNavDrawer->level)->orderBy("level", "ASC")->first();

        if ($upperNavDrawer) {
            $this->updateLevel($currentNavDrawer->id, $upperNavDrawer->level);
            $this->updateLevel($upperNavDrawer->id, $currentNavDrawer->level);

        }

        return response(["message" => "Move up level success"]);
    }

    /**
     * move one step down from current level
     * @param \Illuminate\Http\Request $request;
     * @return \Illuminate\Http\Response ;
     */
    public function moveDown(Request $request)
    {
        $this->validate($request, [
            "navigation_drawer_id" => "required|integer",
        ]);

        $currentNavDrawer = NavigationDrawer::findOrFail($request->navigation_drawer_id);

        $lowerNavDrawer = NavigationDrawer::where("level", "<", $currentNavDrawer->level)->orderBy("level", "DESC")->first();

        if ($lowerNavDrawer) {

            $this->updateLevel($currentNavDrawer->id, $lowerNavDrawer->level);

            $this->updateLevel($lowerNavDrawer->id, $currentNavDrawer->level);

        }

        return response(["message" => "Move down level success"]);
    }

    /**
     * Internal helper for updating level
     * @param int $id - id for the model
     * @param int $level - level
     */
    private function updateLevel($id, $level)
    {
        NavigationDrawer::find($id)->update(["level" => $level]);
        return true;
    }
}
