<?php namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

/**
 * Class BranchAnnouncement
 * @package App\Widgets
 * @author efriandika
 */
class BranchAnnouncement extends AbstractWidget
{
    protected $config = [];


    public function run()
	{
        return view('widgets.branchAnnouncement');
	}
}