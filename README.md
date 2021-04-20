# Lumen PHP Framework


## Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).



## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


## Welcome

this app is for starter purpose . so you can easy to start your app with . this project has been include jwt and spatie permission , for more information about [Laravel](https://laravel.com) just go there to find all the documentation


### first step

clone the repo 

```
$ composer install

$ php artisan migrate 

$ php artisan key:generate

$ php artisan jwt:secret

$ php artisan cache:clear

$ php artisan config:clear

```

### list pre build route

Some of the route has been create . those route are just for the basic needed and not the standard or not the best best way . you change them as you want 

|URL|Method|Payload|Description|
|:--|:-----|:------|:----------|
|http://localhost:8000/api/register|POST|{name:"",email:"",password:"",password_confirm:""}| Register to app , will return token 
|http://localhost:8000/api/login|POST|{email:"",password:""}|Login to app 
|http://localhost:8000/api/roles|GET||Get all available roles with default paginate 50
|http://localhost:8000/api/roles|POST|{name:"",guard_name:"",description:""}| create new role . make sure it lowercase and without space
|http://localhost:8000/api/roles/assign_role_to_user/{user_id}|PUT|{role:""}| assign a role to user 
|http://localhost:8000/api/roles/users_with_all_roles|GET||Get all user with all roles they have
|http://localhost:8000/api/roles/user_without_roles|GET|| Get all user without any roles
|http://localhost:8000/api/roles/user_with_same_role/{role}|GET|| Get all user with same role for example role admin . and as i mention before than create role without space  and lowercase ,it will help your here clean the route
|http://localhost:8000/api/roles/users_with_all_roles|GET||Get all user with their roles
|http://localhost:8000/api/roles/sync_role_to_user/{user_id}|PUT|{role:"new-role"}|Remove previous role and assign new role to user
|http://localhost:8000/api/roles/remove_role_from_user/{user_id}|PUT|{role:"current-role"}| remove user role according role name



if your have idea you can contribute ,there no roles for that ,help other like help your self