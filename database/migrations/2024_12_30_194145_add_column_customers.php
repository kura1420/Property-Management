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
        Schema::table('customers', function (Blueprint $table) {
            //
            $table->foreignUlid('lead_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUlid('type_buyer_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('first_res_date')->nullable();
            $table->text('request_note')->nullable();
            $table->text('cost_plan')->nullable();
            $table->string('domisili')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            //
        });
    }
};
