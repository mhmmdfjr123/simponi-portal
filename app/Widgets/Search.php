<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class Search extends AbstractWidget
{
    public function run()
    {
        return view('widgets.search');
    }
}