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
        $router->post("/give_permission_to", "UserPermissionController@userGivePermissionTo");
        $router->post("/revoke_permission_to", "UserPermissionController@userRevokePermissionTo");
    });

    $router->group(["prefix" => "user_role"], function () use ($router) {
        $router->post("/assign_role", "UserRoleController@userAssignRole");
        $router->post("/remove_role_as", "UserRoleController@userRemoveRoleAs");
    });

    // route for module
    $router->post("module", "ModuleController@store");
    // end of route module
});
