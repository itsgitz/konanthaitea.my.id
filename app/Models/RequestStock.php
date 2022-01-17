<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'stock_id',
        'request_quantity',
        'processed_quantity',
        'description'
    ];
}
