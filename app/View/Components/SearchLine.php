<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SearchLine extends Component
{
    public $city;

    public $cities;

    public $category;

    public $categories;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($city, $cities, $category, $categories)
    {
        $this->city = $city;
        $this->cities = $cities;
        $this->category = $category;
        $this->categories = $categories;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.search-line');
    }
}
