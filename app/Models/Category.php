<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];

    // UCP 1 Penjelasan Detail:
    // 1. public function products() : Mendefinisikan sebuah method (fungsi) bernama 'products'. Penamaannya jamak karena 1 kategori akan berelasi dengan "banyak" produk.
    // 2. hasMany(Product::class)    : Ini adalah cara Laravel menentukan tipe relasi "One-to-Many" (Satu ke Banyak). Baris ini memberi tahu sistem bahwa 1 data di tabel Category ini berpotensi memiliki banyak ikatan dengan data di tabel Product.
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
