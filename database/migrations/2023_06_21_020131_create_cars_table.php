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
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('gallery_id')->nullable()->constrained('galleries')->cascadeOnDelete();

            $table->string('title');
            $table->double('price')->default(0);

            $table->string('model');
            $table->string('year');
            $table->string('km');
            $table->string('regional_specifications');
            $table->string('body_type');
            $table->string('mechanical_condition');
            $table->string('car_conditions');
            $table->string('seller_type');
            $table->string('transmission');
            $table->string('engine_power');

            $table->string('insurance');
            $table->string('outer_color');
            $table->string('inner_color');
            $table->string('door_numbers');
            $table->string('seat_numbers');
            $table->string('cylinders');
            $table->string('fuel_type');
            $table->string('technical_features');
            $table->enum('driving_hand', config("data.data.driving-hand"));
            $table->json('additional_features'); // json array

            $table->string('main_image')->nullable();
            $table->json('images')->nullable(); // json array

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
