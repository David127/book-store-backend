<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosOrder extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'client_id',
        'total',
        'doc_type',
        'doc_number'
    ];

    public function client()
    {
        return $this->belongsTo(PosClient::class, 'client_id', 'client_id');
    }

    public function details()
    {
        return $this->hasMany(PosOrderDetail::class, 'order_id', 'order_id');
    }
}
