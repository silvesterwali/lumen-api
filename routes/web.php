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

    $router->group(["prefix" => "role"], function () use ($router) {
        $router->get("/", "RoleController@index");
        $router->post("/", "RoleController@store");
        $router->delete("/{id}", "RoleController@destroy");
    });

    $router->group(["prefix" => "permission"], function () use ($router) {
        $router->get("/", "PermissionController@index");
        $router->post("/", "PermissionController@store");
        $router->delete("/{id}", "PermissionController@destroy");
    });

    $router->group(["prefix" => "user_permission"], function () use ($router) {
        $router->get("/", "UserPermissionController@usersWithPermissions");
        $router->get("/permission/{permission}", "UserPermissionController@usersWithPermission");
        $router->post("/give_permission", "UserPermissionController@userGivePermissionTo");
        $router->post("/revoke_permission", "UserPermissionController@userRevokePermissionTo");
    });

    $router->group(["prefix" => "user_role"], function () use ($router) {
        $router->get("/", "UserRoleController@usersWithRoles");
        $router->get("/role/{role}", "UserRoleController@usersWithRole");
        $router->get("/user_without_role", "UserRoleController@usersWithoutRole");
        $router->post("/assign_role", "UserRoleController@userAssignRole");
        $router->post("/remove_role_as", "UserRoleController@userRemoveRoleAs");

    });

    $router->group(["prefix" => "user_via_role"], function () use ($router) {
        $router->post("/give_permission", "UserRoleToPermissionController@userRoleGivePermissionTo");
        $router->post("/revoke_permission", "UserRoleToPermissionController@userRoleRevokePermissionTo");
    });

    $router->group(["prefix" => "navigation_drawer"], function () use ($router) {
        $router->get("/", "NavigationDrawerController@index");
        $router->post("/", "NavigationDrawerController@store");
        $router->get("/{id}", "NavigationDrawerController@show");
        $router->put("/{id}", "NavigationDrawerController@update");
        $router->delete("/{id}", "NavigationDrawerController@destroy");
    });

    $router->group(["prefix" => "navigation_drawer_child"], function () use ($router) {
        $router->get("/", "NavigationDrawerChildController@index");
        $router->post("/", "NavigationDrawerChildController@store");
        $router->get("/{id}", "NavigationDrawerChildController@show");
        $router->put("/{id}", "NavigationDrawerChildController@update");
        $router->delete("/{id}", "NavigationDrawerChildController@destroy");
    });

    $router->get("user_navigation_items/{user_id}", "UserNavigationItemController");

});
