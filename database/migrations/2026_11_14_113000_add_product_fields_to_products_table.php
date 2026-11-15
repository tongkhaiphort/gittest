<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('name', 100)->nullable();
            $table->decimal('price', 8, 2)->default(0);
            $table->integer('quantity')->default(0);
            $table->foreignId('category_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('image', 255)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn(['name', 'price', 'quantity', 'category_id', 'image']);
        });
    }
};
