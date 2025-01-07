<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->date('order_date');
            $table->decimal('amount', 10, 2);

            
            $table->unsignedBigInteger('salesman_id');
            $table->foreign('salesman_id')
                  ->references('salesman_id')
                  ->on('salesman')
                  ->onDelete('cascade');


            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')
                  ->references('customer_id')
                  ->on('customers')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
