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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('tiêu đề');
            $table->string('description')->comment("mô tả");
            $table->integer('status')->comment('Trạng thái');
            $table->integer('assigned_to')->nullable()->comment('ID của user được giao việc');
            $table->integer('department_id')->comment('phòng ban yêu cầu');
            $table->integer('category_id')->comment('danh mục yêu cầu');
            $table->integer('priority')->comment('ưu tiên');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
