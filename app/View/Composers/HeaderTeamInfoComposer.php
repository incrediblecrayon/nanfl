<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Team;

class HeaderTeamInfoComposer
{
    /**
     * Bind data to specified views.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('teams', Team::orderBy('name','asc')->get());
    }
}