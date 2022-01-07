<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarpentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carpenters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('img')->default(NULL)->nullable();
            $table->text('cloudinary_public_id')->default(NULL)->nullable();
            $table->string('role');
            $table->unsignedBigInteger('message_id')->nullable();
            $table->timestamps();

            $table
            ->foreign('message_id')
            ->references('id')
            ->on('messages')
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
        Schema::dropIfExists('carpenters');
    }
}
