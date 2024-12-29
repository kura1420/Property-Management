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
        Schema::create('product_items', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('product_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->char('code', 10);
            $table->string('name');
            $table->string('foto')->nullable();
            $table->integer('quantity', false, false)->default(0);
            $table->boolean('status')->default(false);
            $table->text('description')->nullable();
            $table->bigInteger('price', false, false)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_items');
    }
};
