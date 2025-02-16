<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // thêm thư viện xóa hiện ngày xóa

class Menu extends Model
{
    use SoftDeletes; // thêm thư viện xóa hiện ngày xóa
    protected $guarded = []; //có thể sài guarded để lấy mọi dữ liệu
}
