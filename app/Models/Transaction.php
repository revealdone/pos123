<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
protected $fillable = [
    'invoice_number',
    'user_id',
    'total_price',
    'paid_amount',
    'change_amount',
    'transaction_date'
];

    public function details()
{
    return $this->hasMany(TransactionDetail::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}

}
