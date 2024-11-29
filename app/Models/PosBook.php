<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosBook extends Model
{
    use HasFactory;

    protected $primaryKey = 'book_id';

    protected $fillable = [
        'isbn',
        'name',
        'stock',
        'current_price',
        'image',
    ];

    public function orderDetails()
    {
        return $this->hasMany(PosOrderDetail::class, 'book_id', 'book_id');
    }
}
