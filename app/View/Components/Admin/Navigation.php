<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class Navigation extends Component
{

    public $names;
    public $link;
    public $icon;


    /**
     * Create a new component instance.
     *
     * @return void
     */
     public function __construct($names, $link, $icon)
    {
        $this->names = $names;
        $this->link = $link;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
         return view('components.admin.navigation');
    }
}
