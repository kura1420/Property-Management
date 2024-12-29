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
        Schema::create('products', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->char('code', 10);
            $table->string('name');
            $table->string('city');
            $table->text('address');
            $table->text('map')->nullable();
            $table->integer('quantity', false, false)->default(0);
            $table->boolean('status')->default(false);
            $table->text('description')->nullable();
            $table->foreignUlid('attribute_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
