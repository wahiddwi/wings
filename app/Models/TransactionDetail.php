<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $table = 'transaction_detail';

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_code', 'id');
    }

    public function transactionHeaders()
    {
        return $this->belongsTo(TransactionHeader::class, 'document_code', 'id');
    }
}
