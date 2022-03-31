<?php

namespace App\Widgets;

use App\Contracts\PortalGuard;
use App\Models\Menu;
use Arrilot\Widgets\AbstractWidget;

class MainMenu extends AbstractWidget
{
    public function run(Menu $menuModel, PortalGuard $auth)
	{
        return view('widgets.mainMenu', [
            'listMenu'  => $menuModel->listHierarchy(-1),
	        'auth'      => $auth,
	        'user'      => $auth->user()
        ]);
	}
}