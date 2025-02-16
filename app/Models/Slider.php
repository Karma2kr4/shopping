<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // thêm thư viện xóa hiện ngày xóa

class Slider extends Model
{
    use SoftDeletes; // thêm thư viện xóa hiện ngày xóa
    protected $table = 'sliders';
    protected $guarded = [];
}
