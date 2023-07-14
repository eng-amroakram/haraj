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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->double('price')->default(0);

            $table->enum('model', config('data.data.cars-models'));
            $table->enum('year', config('data.years'));
            $table->string('km');
            $table->enum('regional_specifications', config('data.data.regional-specifications'));
            $table->enum('body_type', config('data.data.body-types'));
            $table->enum('mechanical_condition', config('data.data.mechanical-conditions'));
            $table->enum('car_conditions', config('data.data.car-conditions'));
            $table->enum('seller_type', config('data.data.seller-types'));
            $table->enum('transmission', config('data.data.transmissions-types'));
            $table->enum('engine_power', config('data.data.engine-powers'));

            $table->enum('insurance', config("data.data.insurances"));
            $table->enum('outer_color', config("data.data.colors"));
            $table->enum('inner_color', config("data.data.colors"));
            $table->enum('door_numbers', config("data.data.doors-number"));
            $table->enum('seat_numbers', config("data.data.seats-number"));
            $table->enum('cylinders', config("data.data.cylinders"));
            $table->enum('fuel_type', config("data.data.fuel-types"));
            $table->string('technical_features');
            $table->enum('driving_hand', config("data.data.driving-hand"));
            $table->json('additional_features'); // json array

            $table->enum('status', ['new', 'approved', 'rejected']);

            $table->timestamp('published_in');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
