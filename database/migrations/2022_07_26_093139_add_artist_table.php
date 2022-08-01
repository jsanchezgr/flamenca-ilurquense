<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('nick')->nullable(false);
            $table->string('slug')->nullable(false)->unique();
            $table->char('type')->nullable(false);
            $table->string('image');
            $table->text('biography');
            $table->text('birthplace')->nullable(false);
            $table->date('birthdate')->nullable(true);
            $table->timestamps();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artists');
    }
};
