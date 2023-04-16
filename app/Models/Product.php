<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $guarded = [];

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, 'product_code', 'id');
    }

    public function getDiscountedPriceAttribute()
    {
        return $this->price * (1 - $this->discount / 100);
    }
}
