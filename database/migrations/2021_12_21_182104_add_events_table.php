<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->dateTimeTz('date')->nullable(false);
            $table->string('name')->nullable(false);
            $table->string('slug')->nullable(false)->unique();
            $table->text('description')->nullable(false);
            $table->string('image')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->softDeletesTz();

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
