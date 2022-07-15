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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('tagline');
            $table->text('desc');
            $table->string('location');
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->morphs('creatable');
            $table->string('action_permission')->default('0'); // 0 - All authenticated and 1 - Only Customer to that business
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
        Schema::dropIfExists('events');
    }
};
