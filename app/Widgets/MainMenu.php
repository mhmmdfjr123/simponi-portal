<?php

namespace App\Widgets;

use App\Models\Menu;
use Arrilot\Widgets\AbstractWidget;

class MainMenu extends AbstractWidget
{
    public function run(Menu $menuModel)
	{
        return view('widgets.mainMenu', [
            'listMenu' => $menuModel->listHierarchy(-1)
        ]);
	}
}