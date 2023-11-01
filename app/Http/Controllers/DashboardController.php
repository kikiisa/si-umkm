<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        return view('backend.dashboard.index',[
            'countSlider' => Slider::all()->count(),
            'countProduct' => Product::all()->count(),
            'countCategory' => Category::all()->count(),
            'adminCount' => User::all()->count()
        ]);
    }
}
