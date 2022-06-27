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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('about');
            $table->string('website')->nullable();
            $table->string('service_form');
            $table->string('service_to');
            $table->foreignId('category_id')->constrained('categories','id')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users','id')->cascadeOnDelete();
            $table->boolean('is_active')->default(TRUE);
            $table->softDeletes();
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
        Schema::dropIfExists('businesses');
    }
};
