<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Components\Recusive;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category= $category;
    }

    public function create()
    {
        $htmlOption = $this->getCategory(); // Không cần truyền parentId
        return view('admin.category.add', compact('htmlOption'));
    }



    public function index(){
        $categories = $this->category->latest()->paginate(5);
        return view('admin.category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->category->create([
            'name' => $request->name,
            'parent_id' => (int)$request->parent_id,  // Chuyển đổi thành số nguyên để tránh lỗi
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('categories.index');
    }
    // dữ liệu chung
    public function getCategory($parentId = null)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parentId);
        return $htmlOption;
    }
    //edit delete
    public function edit($id)
    {
        $category = $this->category->find($id);
        $htmlOption = $this->getCategory($category->parent_id);
        
        return view('admin.category.edit', compact('category', 'htmlOption'));
    }

    public function update($id, Request $request)
    {
        $this->category->find($id)->update([
            'name' => $request->name,
            'parent_id' => (int)$request->parent_id,  // Chuyển đổi thành số nguyên để tránh lỗi
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route('categories.index');
    }

    public function delete($id)
    {
        $this->category->find($id)->delete();
        return redirect()->route('categories.index');
    }

}
