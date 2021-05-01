# Lumen PHP Framework


## Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).

clone this repo and don't forget to remove remote on this repo


This project only helps you for the most basic of applications that you will develop, this project has been accompanied by authentication using jwt, roles and permissions from spatie and also basic settings for navigation needs on the front end



## Routes

The following are the basic routes that have been provided and are ready to use



### Authentication

User registration and log in will go through this route

```
http:\\localhost:8000/api/register

```

```
http:\\localhost:8000/api/login

```

#### If already authenticated


if user want to log out 

```
http://localhost:8000/api/auth/logout

```

refresh token (token only take 15 minutes) live

```
http://localhost:8000/api/auth/refresh

```

and user can access their basic information with this route

```
http://localhost:8000/api/auth/me

```


### Role 

this project is already implement Spatie permissions and for more information about [spatie Permission](https://spatie.be/docs/laravel-permission/v4/introduction)


#### Basic

for get ,create and delete role 

get all roles resource  and will return it with pagination by default 50 row ,and also to create new role

```
http://localhost:8000/api/role/

```

and if needed you can take role by id

```
http://localhost:8000/api/role/{id}

```

