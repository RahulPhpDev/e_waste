<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class PageHead extends Component
{
    public $title;

    public $flag;

    public $argument;
    /**
     * Create a new component instance.
     *
     * @return void
     */
       */
    public function __construct( $flag = null , $argument = null)
    {
        $routeName = Route::current()->getName();
        $routeArray = explode('.', $routeName);
        $this->title = $routeArray ?  array_reverse($routeArray)[0] :'';
        $this->flag = $flag;
        $this->argument = $argument;


    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.admin.page-head');
    }
}
