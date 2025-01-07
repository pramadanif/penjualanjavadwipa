<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    protected $table = 'orders';


    protected $primaryKey = 'order_id';


    protected $fillable = [
        'order_date',
        'amount',
        'salesman_id',
        'customer_id'
    ];


    protected $casts = [
        'order_date' => 'date',
        'amount' => 'decimal:2'
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    
    public function salesman()
    {
        return $this->belongsTo(Salesman::class, 'salesman_id', 'salesman_id');
    }
}
