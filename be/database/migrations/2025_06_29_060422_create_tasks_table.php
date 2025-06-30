<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // id tự tăng
            $table->uuid('uuid')->unique(); // UUID duy nhất
            $table->string('name'); // tên công việc
            $table->timestamp('deadline')->nullable(); // hạn chót
            $table->boolean('completed')->default(false); // đã hoàn thành chưa
            $table->text('description')->nullable(); // mô tả
            $table->timestamps(); // created_at và updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
