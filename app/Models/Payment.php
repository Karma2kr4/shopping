<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'name',
        'address',
        'phone',
        'message',
        'payment_method',
        'approved',
    ];

    public function details()
    {
        return $this->hasMany(PaymentDetail::class, 'payment_id');
    }

    // Thêm các trạng thái đơn hàng
    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;
    const STATUS_RECEIVED = 2;
    const STATUS_CANCELLED = 3;

    public static function getStatusText($status)
    {
        switch ($status) {
            case self::STATUS_PENDING:
                return 'Đang chờ duyệt';
            case self::STATUS_APPROVED:
                return 'Đã duyệt';
            case self::STATUS_RECEIVED:
                return 'Đã nhận hàng';
            case self::STATUS_CANCELLED:
                return 'Đơn hàng đã bị hủy';
            default:
                return 'Không xác định';
        }
    }
}