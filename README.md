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


Register Route | POST

```
http://localhost:8000/api/register

```

Login Route | POST

```
http://localhost:8000/api/roles

```

Get all role  | GET

all roles with laravel pagination default 50


```
http://localhost:8000/api/roles

```

create new role | POST

```
http://localhost:8000/api/roles

{
    "name":"myRole",
    "description:"my role is awesome",
    "guard_name:""
}
```

assign role to user | PUT
you can assign role to user via user id

```
http://localhost:8000/api/roles/assign_role_to_user/{user_id}

{
    role:"my-role"
}

```

All users with their roles | GET

```
http://localhost:8000/api/roles/users_with_all_roles

```


User without any role | GET

```
http://localhost:8000/api/roles/user_without_roles


```


User with same role | GET

make sure your role name without space

```
http://localhost:8000/api/roles/user_with_same_role/{role}

```


All user with all roles they have

```

http://localhost:8000/api/roles/users_with_all_roles


```

Remove previous roles from user then create new | PUT

```
http://localhost:8000/api/roles/sync_role_to_user/{user_id}

{
    "role":"new-role"
}

```


revoke role from user |PUT

```
http://localhost:8000/api/roles/remove_role_from_user/2

{
    "role":"current-role"
}

```