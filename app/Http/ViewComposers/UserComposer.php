<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserComposer
{
    /**
     * Bind data to the view.
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $you = Auth::user();
        // bind to view
        $view->with('you', $you);
    }
}