<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->unsignedBigInteger('client_id');
            $table->decimal('total', 10, 2);
            $table->tinyInteger('doc_type');
            $table->string('doc_number', 20);
            $table->timestamps();

            $table->foreign('client_id')->references('client_id')->on('pos_clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pos_orders');
    }
}
