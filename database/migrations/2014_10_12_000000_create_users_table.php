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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable()->unique();
            $table->string('code')->nullable();

            $table->string('image')->nullable();

            $table->string('id_number')->nullable()->unique();
            $table->string('nick_name')->nullable()->unique();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('type', ['seller', 'buyer', 'admin']);
            $table->enum('status', ['active', 'inactive']);

            $table->enum('can_add_ad', ['active', 'inactive'])->dafault('inactive');
            $table->enum('can_add_offer', ['active', 'inactive'])->dafault('inactive');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
