<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // thêm thư viện xóa hiện ngày xóa

use App\Models\Product;

class Category extends Model
{
    use SoftDeletes; // thêm thư viện xóa hiện ngày xóa
    protected $table = 'categories';
    protected $fillable = ['name', 'parent_id', 'slug'];

    public function categoryChildrent()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
