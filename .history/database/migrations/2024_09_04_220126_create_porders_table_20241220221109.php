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
        Schema::create('porders', function (Blueprint $table) {
            $table->id();
            $table->string('code_tr')->nullable();
            $table->datetime('date_order')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('sales_type')->nullable();
            $table->boolean('is_paid')->default(false);
            $table->string('shipping_method')->nullable();
            $table->enum('status', ['new', 'processing', 'shipped', 'delivered', 'canceled'])->default('new');
            $table->text('notes')->nullable();
            $table->decimal('discount', 10, 0)->nullable();
            $table->decimal('shipping_amount', 10, 0)->nullable();
            $table->decimal('grand_total', 10, 0)->nullable();
            $table->decimal('total_payment', 10, 0)->nullable();
            $table->decimal('total_cashback', 10, 0)->nullable();
            $table->datetime('paid_at')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('branch_id')->references('id')->on('branches');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('porders');
    }
};
