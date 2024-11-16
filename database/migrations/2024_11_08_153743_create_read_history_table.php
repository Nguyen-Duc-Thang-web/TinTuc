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
        Schema::create('read_history', function (Blueprint $table) {
            $table->id(); // Tạo khóa chính id tự tăng
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade'); 
            $table->timestamp('read_at')->useCurrent();
            $table->timestamps(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('read_history');
    }
};
