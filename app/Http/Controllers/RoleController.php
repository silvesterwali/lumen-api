<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles=Role::oderBy("name","asc")
        ->paginate(50);
        return response($roles);
    
    }

    /**
     * Store a newly created resource in storage.
     * role name should lowercase
     * prevent space
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "name"=>"required|array|alpha_dash|unique:roles,name"
        ]);

        try{
            Role::createMany($request->except("id"));
        }catch(Exception $e){
            return response($e->getMessage(),Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response(["message"=>"Success to create new role"]);
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
        $this->validate($request,["name"=>"required|alpha_dash"]);
    }


    /**
     * to assign user to role
     * user only have one role at moment but if you want more ? just do it by your self
     * @see https://spatie.be/docs/laravel-permission/v4/basic-usage/role-permissions
     * 
    */
    public function assign_role_to_user(Request $request,$user_id){

        $this->validate($request,[
            "role"=>"required"
        ]);

        // todo :check the user if already have the role

        $user=User::find($user_id);

        if(!$user){
            // prevent if user not exists
            return response(["message"=>"User data not found"],Response::HTTP_NOT_FOUND);
        }

        $user->assignRole($request->roles);


        return response(["message"=>"Success to async roles to user"]);

    }



    /**
     * remove a role from user 
     * - for more information please @see https://spatie.be/docs/laravel-permission/v4/basic-usage/role-permissions
    */
    public function remove_role_from_user(Request $request){
        $this->validate($request,[
            "user_id"=>"required",
            "role"=>"required|alpha_dash"
        ]);

        $user=User::find($request->user_id);

        if(!$user){
            return response(["message"=>"User data not found"],Response::HTTP_NOT_FOUND);
        }

        $user->removeRole($request->role);

        return response(["message"=>"Success remove role from user"]);
    }




    /**
     * remove all user role adn assign new role
     * TODO :: does all the role_permission gone ?
    */
    public function sync_role_to_user(Request $request,$user_id){
        $this->validate($request,[
            "role"=>"required|alpha_dash",
        ]);

        $user=User::find($user_id);

        if(!$user){
            return response(["message"=>"User data not found"],Response::HTTP_NOT_FOUND);
        }

        $user->syncRoles($request->role);

        return response(["message"=>"Success to remove all old user role and async new role"]);
    }

    /**
     * User with all user
     * 
    */
    public function user_all_roles($user_id){

        $user=User::find($user_id);

        $userRoles=$user->hasAllRoles(Role::all());

        return response($userRoles);
    }


    /**
     * get all user with same role
     * @return \Illuminate\Http\Response;
    */
    public function user_with_same_role($role){

        $users=User::role($role)->pagination(50);

        return response($users);
    }


    /**
     * all user with all role
     * @return \Illuminate\Http\Response;
    */
    public function users_with_roles(){


        $userRoles=User::with("roles")
        ->orderBy("name","asc")
        ->paginate(50);

        return response($userRoles);
    }


    /**
     * all user without any roles
     * @return \Illuminate\Http\Response;
    */
    public function user_without_role(){
        $users=User::doesntHave("roles")->oderBy("name","asc")->paginate(50);
        return response($users);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
