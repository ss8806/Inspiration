<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Request;
use App\Models\Category;
use Illuminate\View\Component;


class Serch extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {

        $categories = Category::query()
            ->orderBy('sort_no')
            ->get();
        
        $defaults = [
            'category'      => Request::input('category', ''),
            'keyword'       => Request::input('keyword', ''),
            'aboveday'      => Request::input('aboveday', ''),
            'belowday'      => Request::input('belowday', ''),
            'aboveprice'    => Request::input('aboveprice', ''),
            'belowprice'    => Request::input('belowprice', ''),
        ];

        return view('components.serch')
            ->with('categories', $categories)
            ->with('defaults', $defaults);
    }
}
