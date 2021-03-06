<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageCarpenterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_carpenter', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('message_id')->nullable(true);
            $table->unsignedBigInteger('carpenter_id')->nullable(true);

            $table->foreign('message_id')
                ->references('id')
                ->on('messages')
                ->onDelete('cascade');
            $table->foreign('carpenter_id')
                ->references('id')
                ->on('carpenters')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message_carpenter');
    }
}
