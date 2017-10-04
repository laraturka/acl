<?php

namespace Laraturka\Acl;

use Illuminate\View\View;

class AclViewComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $user = Auth()->user();

        $view->with('user', $user);
    }
}