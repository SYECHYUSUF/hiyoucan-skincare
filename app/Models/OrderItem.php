<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    /**
     * Relasi: Item ini adalah produk apa?
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relasi: Item ini milik Order (Nota) yang mana?
     * (INI YANG KEMARIN KURANG)
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}