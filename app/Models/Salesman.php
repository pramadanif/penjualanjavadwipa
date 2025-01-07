<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salesman extends Model
{
    use HasFactory;


    protected $table = 'salesman';


    protected $primaryKey = 'salesman_id';


    protected $fillable = [
        'salesman_name',
        'salesman_city',
        'commission'
    ];

    
    public function orders()
    {
        return $this->hasMany(Order::class, 'salesman_id', 'salesman_id');
    }
}
