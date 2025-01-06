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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable()->constrained('products')->nullOnDelete();
            $table->string('name')->nullable();
            $table->string('variant')->nullable();
            $table->string('slug')->nullable();
            $table->string('images')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('unit_amount', 10, 0)->nullable();
            $table->decimal('total_amount', 10, 0)->nullable();
            $table->text('mutation_type')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
