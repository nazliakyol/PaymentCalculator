<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->integer('beds')->nullable();
            $table->integer('baths')->nullable();
            $table->integer('area')->nullable();
            $table->string('city')->nullable();
            $table->string('code')->nullable();
            $table->string('street')->nullable();
            $table->string('street_nr')->nullable();
            $table->integer('price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->dropColumn(['beds', 'baths', 'area', 'city', 'code', 'street', 'street_nr', 'price']);
        });
    }
};
