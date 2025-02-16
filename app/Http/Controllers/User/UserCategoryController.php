<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;

class UserCategoryController extends Controller
{
    public function index($slug, $categoryId)
    {
        $categorysLimit = Category::where('parent_id', 0)->take(3)->get(); 
        $products = Product::where('category_id', $categoryId)->paginate(perPage: 12);
        $categorys = Category::where('parent_id', 0)->get();//->latest()nếu muốn 
            
        return view('user.product.category.list', compact('categorysLimit', 'products', 'categorys'));
    }
    
}
