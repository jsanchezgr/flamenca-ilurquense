<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class AddNewsletterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribers', function (Blueprint $schema) {
            $schema->id();
            $schema->string('email')->unique()->index();
            $schema->boolean('subscribed')->default(true);
            $schema->boolean('verified')->default(false);
            $schema->string('token')->nullable(true);
            $schema->timestamps();
            $schema->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscribers');
    }
}

