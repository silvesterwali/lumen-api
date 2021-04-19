<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->group(['prefix' => 'api'], function () use ($router) {
    // Matches "/api/register
    $router->post('register', 'AuthController@register');
    // Matches "/api/login
    $router->post('login', 'AuthController@login');
});

// all route with authorize

$router->group(["middleware" => "auth:api", "prefix" => "api"], function () use ($router) {

    // route for user basic
    $router->group(["prefix" => "auth"], function () use ($router) {

        $router->post("logout", "AuthController@logout");
        $router->get("refresh", "AuthController@refresh");
        $router->get("me", "AuthController@me");

    });
    // end of user basic


    $router->group(["prefix"=>"roles"], function() use ($router){

        $router->get("/","RoleController@index");
        $router->post("/","RoleController@store");
        $router->put("/assign_role_to_user/{user_id}","RoleController@assignRoleToUser");
        $router->put("/remove_role_from_user","RoleController@removeRoleFromUser");
        $router->put("/sync_role_to_user","RoleController@syncRoleToUser");
        $router->get("/user_with_all_roles","RoleController@userWithRoles");
        $router->get("/user_with_same_role/{role}","RoleController@userWithSameRole");
        $router->get("/user_with_roles","RoleController@userWithRoles");
        $router->get("/user_without_roles","RoleController@userWithoutRole");

    });


    $router->group(["prefix"=>"permissions"],function() use($router){
        $router->get("/","PermissionController@index");
        $router->post("/","PermissionController@store");
        $router->put("/give_permissions_to_user/{user_id}","PermissionController@givePermissionsToUser");
        $router->put("/revoke_permission_from_user/{user_id}","PermissionController@revokePermissionFromUser");
        $router->get("/get_user_permission_via_role/{user_id}","PermissionController@getUserPermissionViaRole");
        $router->get("/get_user_with_all_permission/{user_id}","PermissionController@getUserWithAllPermission");
        $router->put("/revoke_and_create_new_permission_to_user/{user_id}","PermissionController@revokeAndCreateNewPermissionToUser");
    });

  





    // route for module
    $router->post("module", "ModuleController@store");
    // end of route module
});
