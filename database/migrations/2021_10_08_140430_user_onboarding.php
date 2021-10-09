<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserOnboarding extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_onboarding', function (Blueprint $table) {
            $table->integer('user_id');
            $table->date('created_date')->nullable();
            $table->integer('onboarding_percentage')->default('0');
            $table->integer('count_applications')->default('0');
            $table->integer('count_accepted_applications')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_onboarding');
    }
}
