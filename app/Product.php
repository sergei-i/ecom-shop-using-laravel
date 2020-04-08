<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getPriceForCount()
    {
        if(!is_null($this->pivot)) {
            return $this->price * $this->pivot->count;
        }
        return $this->price;
    }
}
