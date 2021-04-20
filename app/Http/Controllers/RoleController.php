<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
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
        $roles=Role::orderBy("name","asc")
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
            "name"=>"required|unique:roles,name"
        ]);

        try{
            
            Role::create($request->except("id"));
        }catch(Exception $e){
            return response($e->getMessage(),Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response(["message"=>"Success to create new role"]);
    }


    /**
     * to assign user to role
     * user only have one role at moment but if you want more ? just do it by your self
     * @see https://spatie.be/docs/laravel-permission/v4/basic-usage/role-permissions
     * @param \Illuminate\Http\Request $request
     * @param int $user_id
     * @return \Illuminate\Http\Response
    */
    public function assignRoleToUser(Request $request,$user_id){

        $this->validate($request,[
            "role"=>"required"
        ]);

        // todo :check the user if already have the role

        $user=User::findOrFail($user_id);

        if(!$user){
            // prevent if user not exists
            return response(["message"=>"User data not found"],Response::HTTP_NOT_FOUND);
        }

        $user->assignRole($request->role);


        return response(["message"=>"Success to async roles to user"]);

    }



    /**
     * remove a role from user 
     * - for more information please @see https://spatie.be/docs/laravel-permission/v4/basic-usage/role-permissions
     * @param \Illuminate\Http\Request
     * @param int $user_id
     * @return \Illuminate\Http\Response
    */
    public function removeRoleFromUser(Request $request,$user_id){

        $this->validate($request,[
            "role"=>"required"
        ]);

        $user=User::find($user_id);

        if(!$user){
            return response(["message"=>"User data not found"],Response::HTTP_NOT_FOUND);
        }

        $user->removeRole($request->role);

        return response(["message"=>"Success remove role from user"]);
    }




    /**
     * remove all user role adn assign new role
     * TODO :: does all the role_permission gone ?
     * @param \Illuminate\Http\Request $request
     * @param int $user_id
     * @return \Illuminate\Http\Response
    */
    public function syncRoleToUser(Request $request,$user_id){


        $this->validate($request,[
            "role"=>"required|alpha_dash",
        ]);

        $user=User::find($user_id);

        if(!$user){
            return response(["message"=>"User data not found"],Response::HTTP_NOT_FOUND);
        }

        $user->syncRoles($request->only("role"));

        return response(["message"=>"Success to remove all old user role and async new role"]);
    }



    /**
     * User with all roles
     * @param int $user_id
     * @return \Illuminate\Http\Response
    */
    public function userWithAllRoles($user_id){

        $user=User::find($user_id);

        $userRoles=$user->hasAllRoles(Role::all());

        return response($userRoles);
    }


    /**
     * get all user with same role
     * @param string $role
     * @return \Illuminate\Http\Response;
     * 
    */
    public function userWithSameRole($role){

        $users=User::role($role)->paginate(50);

        return response($users);
    }


    /**
     * all user with all role
     * @return \Illuminate\Http\Response;
    */
    public function usersWithRoles(){


        $userRoles=User::with("roles")
        ->whereHas("roles")
        ->orderBy("name","asc")
        ->paginate(50);

        return response($userRoles);
    }

    


    /**
     * all user without any roles
     * @return \Illuminate\Http\Response;
    */
    public function userWithoutRole(){
        $users=User::doesntHave("roles")->orderBy("name","asc")->paginate(50);
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
        $role=Role::findOrFail($id);
        $role->delete();
        return response(["message"=>"Success to remove role"]);
    }
}
