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
        Schema::create('boards', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->foreignIdFor(\App\Models\User::class)
                    ->constrained()
                    ->cascadeOnDelete();
            $table->string('token')->unique();
            $table->timestamps();
        });

        Schema::create('board_user', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Board::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();
            $table->boolean('pinned');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boards');
        Schema::dropIfExists('board_user');
    }
};
