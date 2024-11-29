<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosClient extends Model
{
    use HasFactory;

    protected $primaryKey = 'client_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'doc_type',
        'doc_number',
        'first_name',
        'last_name',
        'phone',
        'email',
    ];

    public function orders()
    {
        return $this->hasMany(PosOrder::class, 'client_id', 'client_id');
    }
}
