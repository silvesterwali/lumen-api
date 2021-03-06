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

/**
 * the route to perform basic authentication on the application
 */
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');
});

/**
 * all route with authorize
 */
$router->group(["middleware" => "auth:api", "prefix" => "api"], function () use ($router) {

    /**
     * specific route for user ownership
     */
    $router->group(["prefix" => "auth"], function () use ($router) {
        $router->post("logout", "AuthController@logout");
        $router->post("password-change", "AuthPasswordChangeController");
        $router->get("refresh", "AuthController@refresh");
        $router->get("me", "AuthController@me");
    });

    /**
     * resource routes for user role
     */
    $router->group(["prefix" => "role"], function () use ($router) {
        $router->get("/", "RoleController@index");
        $router->post("/", "RoleController@store");
        $router->delete("/{id}", "RoleController@destroy");
    });

    /**
     * user permission resource route
     */
    $router->group(["prefix" => "permission"], function () use ($router) {
        $router->get("/", "PermissionController@index");
        $router->post("/", "PermissionController@store");
        $router->delete("/{id}", "PermissionController@destroy");
    });

    /**
     * the route of the relationship between users and roles
     */
    $router->group(["prefix" => "user-permission"], function () use ($router) {
        $router->get("/", "UserPermissionController@usersWithPermissions");
        $router->get("/permission/{permission}", "UserPermissionController@usersWithPermission");
        $router->post("/give-permission", "UserPermissionController@userGivePermissionTo");
        $router->post("/revoke-permission", "UserPermissionController@userRevokePermissionTo");
    });

    /**
     * the route of the relationship between users and roles
     */
    $router->group(["prefix" => "user-role"], function () use ($router) {
        $router->get("/", "UserRoleController@usersWithRoles");
        $router->get("/role/{role}", "UserRoleController@usersWithRole");
        $router->get("/user-without-role", "UserRoleController@usersWithoutRole");
        $router->post("/give-role", "UserRoleController@userAssignRole");
        $router->post("/revoke-role", "UserRoleController@userRemoveRoleAs");

    });

    /**
     * give and revoke a user's permission via role
     */
    $router->group(["prefix" => "user-via-role"], function () use ($router) {
        $router->post("/give-permission", "UserRoleToPermissionController@userRoleGivePermissionTo");
        $router->post("/revoke-permission", "UserRoleToPermissionController@userRoleRevokePermissionTo");
    });

    /**
     * resource navigation drawer
     */
    $router->group(["prefix" => "navigation-drawer"], function () use ($router) {
        $router->get("/", "NavigationDrawerController@index");
        $router->post("/", "NavigationDrawerController@store");
        $router->get("/{id}", "NavigationDrawerController@show");
        $router->put("/{id}", "NavigationDrawerController@update");
        $router->delete("/{id}", "NavigationDrawerController@destroy");
    });

    /**
     * reorder the level hierarchy of navigation drawer,
     * order level will effect to your client
     * navigation drawer when they retrieve
     * according given access
     */
    $router->group(["prefix" => "navigation-drawer-order"], function () use ($router) {
        $router->post("/move-up", "NavigationDrawerOrderController@moveUp");
        $router->post("/move-down", "NavigationDrawerOrderController@moveDown", );

    });

    /**
     * resource navigation drawer child
     */
    $router->group(["prefix" => "navigation-drawer-child"], function () use ($router) {
        $router->get("/", "NavigationDrawerChildController@index");
        $router->post("/", "NavigationDrawerChildController@store");
        $router->get("/{id}", "NavigationDrawerChildController@show");
        $router->put("/{id}", "NavigationDrawerChildController@update");
        $router->delete("/{id}", "NavigationDrawerChildController@destroy");
    });

    /**
     * sort level navigation drawer child
     */
    $router->group(["prefix" => "navigation-drawer-child-order"], function () use ($router) {
        $router->post("/move-up", "NavigationDrawerChildOrderController@moveUp");
        $router->post("/move-down", "NavigationDrawerChildOrderController@moveDown");
    });

    /**
     *  all navigation assigned to a user
     */
    $router->get("navigation_items/{user_id}/user", "UserNavigationItemController");

    /**
     * give and revoke a user's navigation
     */
    $router->group(["prefix" => "user-navigation"], function () use ($router) {
        $router->post("/give-navigation", "UserNavigationController@giveNavigationToUser");
        $router->post("/revoke-navigation", "UserNavigationController@revokeNavigationFromUser");
    });

    /**
     * give and revoke navigation to role
     */
    $router->group(["prefix" => "role-navigation"], function () use ($router) {
        $router->post("/give-navigation", "NavigationAccordingRoleController@giveNavigationToRole");
        $router->post("/revoke-navigation", "NavigationAccordingRoleController@revokeNavigationFromRole");
    });

    /**
     * resource navigation dropdown
     */
    $router->group(["prefix" => "navigation-dropdown"], function () use ($router) {
        $router->get('/', "NavigationDropdownController@index");
        $router->post('/', "NavigationDropdownController@store");
        $router->get('/{id}', "NavigationDropdownController@show");
        $router->put('/{id}', "NavigationDropdownController@update");
        $router->delete('/{id}', "NavigationDropdownController@destroy");
    });

    /**
     * reorder level for dropdown menu
     */
    $router->group(["prefix" => "navigation-dropdown-order"], function () use ($router) {
        $router->post("move-up", "NavigationDropdownOrderController@moveUp");
        $router->post("move-down", "NavigationDropdownOrderController@moveDown");
    });

    /**
     * resource user dropdown navigation
     */
    $router->group(["prefix" => "user-dropdown"], function () use ($router) {
        $router->get("/", "UserDropdownController@index");
        $router->post("/", "UserDropdownController@store");
        $router->get("/{id}", "UserDropdownController@delete");
    });

    /**
     * retrieve user dropdown navigation
     */
    $router->get("/user-dropdown-item/{user_id}/user", "UserDropdownItemsController");

    $router->group(["prefix" => "role-dropdown"], function () use ($router) {
        $router->post("give-dropdown", "UserRoleToDropdownController@giveDropdown");
        $router->post("revoke-dropdown", "UserRoleToDropdownController@revokeDropdown");
    });
});
