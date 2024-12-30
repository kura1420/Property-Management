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
        Schema::create('remind_buyers', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->smallInteger('seq', false, false);
            $table->string('step');
            $table->text('descr');
            $table->foreignUlid('type_buyer_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remind_buyers');
    }
};
