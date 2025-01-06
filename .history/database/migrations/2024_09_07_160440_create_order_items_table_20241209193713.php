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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable()->constrained('products')->nullOnDelete();
            $table->string('unit_name')->nullable();
            $table->text('contain')->nullable();
            $table->integer('p_quantity')->nullable();
            $table->decimal('p_unit_amount', 10, 2)->nullable();
            $table->decimal('p_total_amount', 10, 2)->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('unit_amount', 10, 2)->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->text('mutation_type')->nullable();
            $table->integer('stock_before')->nullable();
            $table->integer('stock_after')->nullable();
            $table->timestamps();

            $table->foreignId('porder_id')->nullable()->constrained('porders')->cascadeOnDelete();
            $table->foreignId('order_id')->nullable()->constrained('orders')->cascadeOnDelete();
            $table->foreignId('adj_item_id')->nullable()->constrained('adj_items')->cascadeOnDelete();
            $table->foreignId('tr_stk_out_id')->nullable()->constrained('tr_stk_outs')->cascadeOnDelete();
            $table->foreignId('tr_stk_in_id')->nullable()->constrained('tr_stk_ins')->cascadeOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
