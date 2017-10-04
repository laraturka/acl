# acl
Role Based Access Control for Laravel

Copy migrate and seed files and migrate with seed.


Add route middleware for acl
app/Http/Kernel.php
'acl' => \Laraturka\Acl\AclMiddleware::class,


Add AclPolicy referance to Providers.
app/Http/Providers/AuthServiceProvider.php

User::class => AclPolicy::class,


Create route group with middleware

Route::group(['prefix'=>'admin', 'middleware' => ['auth','acl','nocache']], function() {

	//what ever you want to route
});