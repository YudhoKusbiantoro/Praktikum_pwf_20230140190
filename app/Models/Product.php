<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function user()
{
    return $this->belongsTo(User::class);
}

public function categories()
{
    return $this->hasMany(Category::class);
}
}
