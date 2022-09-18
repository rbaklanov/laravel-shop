<?php

namespace App\View\Composers;

use App\Domain\Filter\Filter;
use Illuminate\View\View;

class ProductIndexComposer
{
    protected $cities;

    protected $categories;

    /**
     *
     */
    public function __construct()
    {
        $this->cities = Filter::where('filterable_type', 'App/Domain/City')->pluck('name')->unique();
        $this->categories = Filter::where('filterable_type', 'App/Domain/Category')->pluck('name')->unique();
    }

    /**
     * @param \Illuminate\View\View $view
     * @return void
     */
    public function compose(View $view): void
    {
        $view->withCities($this->cities)->withCategories($this->categories);
    }
}
