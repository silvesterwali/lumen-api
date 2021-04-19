<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;


class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permission=Permission::orderBy("name","asc")->paginate(50);


        return response($permission);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,["name"=>"required|array|alpha_dash|unique:permissions,name"]);

        Permission::createMany($request->except("id"));

        return response(["message"=>"Success to add permission"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * give permissions to user
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * 
    */
    public function  givePermissionsToUser(Request $request,$user_id){
        $this->validate($request,[
            "permissions"=>"required|array"
        ]);


        $user=User::find($user_id);

        if(!$user){
            return response(["User data not found"],Response::HTTP_NOT_FOUND);
        }


        $user->givePermissionTo($request->except("id"));

        return response(["Success give permission to user"]);

    }



    /**
     * revoke a permission from user
     * @param \Illuminate\Http\Request $request
     * @param int $user_id
     * @return \Illuminate\Http\Response
    */
    public function revokePermissionFromUser(Request $request,$user_id){
        $this->validate($request,["permission"]);

        $user=User::find($user_id);

        if(!$user){
            return response(["message"=>"User data not found"],Response::HTTP_NOT_FOUND);
        }

        $user->revokePermissionTo($request->except("id"));

        return response(["message"=>"Success revoke user permission"]);
    }


    /**
     * revoke a permission from user and create new one permission
     * @param \Illuminate\Http\Request $request;
     * @param int $user_id 
     * @return \Illuminate\Http\Response
     * 
    */
    public function revokeAndNewPermissionToUser(Request $request,$user_id){


        $this->validate($request,[
            "revoked_permission"=>"required|alpha_dash",
            "permission"=>"required|alpha_dash"
        ]);

        $user=User::find($user_id);

        if(!$user){

            return response(["message"=>"User data not found"],Response::HTTP_NOT_FOUND);
        }

        $user->syncPermissions($request->revoked_permission,$request->permission);

        return response(["message"=>"Success to revoke permission from user and create another"]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
