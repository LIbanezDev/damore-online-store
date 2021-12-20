<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('receipt')->nullable();
            $table->unsignedInteger('total');
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('status', ['pendiente', 'aceptada', 'pagada', 'despachada', 'rechazada'])->default('pendiente');
            $table->string('email')->nullable();
            $table->string('shipping_address')->nullable();
            $table->enum('order_type', ['retiro_en_tienda', 'delivery']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
