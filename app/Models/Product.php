<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'quantity',
        'price',
        'user_id',
        'category_id',
    ];
    public function user()
{
    return $this->belongsTo(User::class);
}

// UCP 1 Penjelasan Detail:
// 1. public function categories() : Mendefinisikan fungsi relasi dari produk ke tabel kategori.
// 2. hasMany(Category::class)     : Mendefinisikan bentuk relasinya. (Catatan teknis: Untuk kasus produk ke kategori, idealnya menggunakan belongsTo() karena 1 produk umumnya hanya dimiliki 1 kategori. Namun ini dibiarkan sesuai implementasi yang berjalan).
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
