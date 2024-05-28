<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'email',
        'amount',
        'status',
        'ordered_at',
        'product_id',
        'store_id',
    ];

    protected $casts = [

        'ordered_at' => 'datetime',
        'amount' => 'decimal:2'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function store(){
        return $this->belongsTo(Store::class);
    }
}
