<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Slider;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    { 
        $sliders = Slider::latest()->get(); 
        $categorys = Category::where('parent_id', 0)->get();//->latest()nếu muốn
        $products = Product::latest()->take(6)->get();
        $productsRecommend = Product::latest('views_count', 'desc')->take(12)->get();
        $categorysLimit = Category::where('parent_id', 0)->take(3)->get();

        return view('user.home.home', compact('sliders', 'categorys', 'products', 'productsRecommend', 'categorysLimit'));
    }
}
