<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosOrderDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_detail_id';

    protected $fillable = [
        'order_id',
        'book_id',
        'detail_price',
        'quantity'
    ];

    public function order()
    {
        return $this->belongsTo(PosOrder::class, 'order_id', 'order_id');
    }

    public function book()
    {
        return $this->belongsTo(PosBook::class, 'book_id', 'book_id');
    }
}
