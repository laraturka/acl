<?php

namespace Laraturka\Acl;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AclViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', \Laraturka\Acl\AclViewComposer::class );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
