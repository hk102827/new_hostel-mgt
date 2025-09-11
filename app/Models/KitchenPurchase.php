<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitchenPurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_date',
        'item_name',
        'category',
        'quantity',
        'unit',
        'unit_price',
        'total_cost',
        'notes',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'quantity' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'total_cost' => 'decimal:2',
        'extra' => 'array',
    ];


}