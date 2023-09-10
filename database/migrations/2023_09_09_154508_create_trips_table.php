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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->nullable();
            $table->string("destination")->nullable();
            $table->string("departure_country")->nullable();
            $table->string("departure_city")->nullable();
            $table->string("departure_airport_name")->nullable();

            $table->string("arrival_country")->nullable();
            $table->string("arrival_city")->nullable();
            $table->string("arrival_airport_name")->nullable();
            $table->timestamp("date")->nullable();
            $table->date("take_off_time")->nullable();
            $table->date("landing_time")->nullable();
            $table->string("flight_status")->nullable();
            $table->tinyInteger('hours')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
