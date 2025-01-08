<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesmanTable extends Migration
{
    public function up()
    {
        Schema::create('salesman', function (Blueprint $table) {
            $table->id('salesman_id'); 
            $table->string('salesman_name', 100);
            $table->string('salesman_city', 100)->nullable();
            $table->decimal('commission', 4, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('salesman');
    }
}
