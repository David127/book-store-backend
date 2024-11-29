<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_clients', function (Blueprint $table) {
            $table->id('client_id');
            $table->tinyInteger('doc_type');
            $table->string('doc_number', 20);
            $table->string('first_name', 15);
            $table->string('last_name', 15);
            $table->string('phone', 9);
            $table->string('email', 50);
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
        Schema::dropIfExists('pos_clients');
    }
}
