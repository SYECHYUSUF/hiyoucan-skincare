<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str; // JANGAN LUPA IMPORT INI

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
        'is_active',
    ];

    // Relasi Category
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi Seller
    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    // Relasi Review
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    public function getAverageRatingAttribute()
    {
        return round($this->reviews()->avg('rating'), 1) ?? 0;
    }

    // --- MAGIC ACCESSOR (BARU) ---
    // Ini akan otomatis dipanggil saat kamu tulis $product->image
    public function getImageAttribute($value)
    {
        // Jika datanya kosong, kembalikan placeholder
        if (!$value) {
            return 'https://via.placeholder.com/400x400.png?text=No+Image';
        }

        // Jika datanya adalah URL lengkap (http...), kembalikan apa adanya (untuk data dummy)
        if (Str::startsWith($value, ['http://', 'https://'])) {
            return $value;
        }

        // Jika bukan URL, berarti itu file upload. Kembalikan path storage yang benar.
        return asset('storage/' . $value);
    }
}