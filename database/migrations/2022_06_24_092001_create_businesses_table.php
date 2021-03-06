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
            $table->string('image_path')->nullable();
            $table->text('about');
            $table->string('website')->nullable();
            $table->string('service_form');
            $table->string('service_to');
            $table->foreignId('category_id')->constrained('categories','id')->cascadeOnDelete();
            $table->enum('created_by',['administrator','user'])->default('administrator');
            $table->unsignedBigInteger('created_id');
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
