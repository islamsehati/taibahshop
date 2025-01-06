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
        // Schema::table('order_items', function (Blueprint $table) {
        //     $table->text('notes')->nullable()->change;
        // });

        // Schema::table('order_items', function (Blueprint $table) {
        // $table->dropForeign(['tr_stk_out_id']);
        // $table->dropForeign(['tr_stk_in_id']);
        // $table->dropForeign(['branch_id']);
        // $table->dropColumn(['tr_stk_out_id', 'tr_stk_in_id', 'branch_id']);
        //     $table->foreignId('tr_stk_out_id')->nullable()->constrained('tr_stk_outs')->cascadeOnDelete();
        //     $table->foreignId('tr_stk_in_id')->nullable()->constrained('tr_stk_ins')->cascadeOnDelete();
        //     $table->foreignId('branch_id')->nullable()->constrained('branches')->cascadeOnDelete();
        // });

        // Schema::table('users', function (Blueprint $table) {
        //     $table->unsignedBigInteger('branch_id')->nullable();
        //     $table->foreign('branch_id')->references('id')->on('branches');
        // });

        // Schema::table('tr_stk_ins', function (Blueprint $table) {
        // $table->dropForeign(['user_id']);
        // $table->dropForeign(['from_branch_id']);
        // $table->dropForeign(['to_branch_id']);
        // $table->dropColumn(['user_id', 'from_branch_id', 'to_branch_id']);
        //     $table->foreignId('user_id')->nullable()->constrained('users');
        //     $table->foreignId('from_branch_id')->nullable()->constrained('branches');
        //     $table->foreignId('to_branch_id')->nullable()->constrained('branches');
        // });
        // Schema::table('tr_stk_outs', function (Blueprint $table) {
        // $table->dropForeign(['user_id']);
        // $table->dropForeign(['from_branch_id']);
        // $table->dropForeign(['to_branch_id']);
        // $table->dropColumn(['user_id', 'from_branch_id', 'to_branch_id']);
        //     $table->foreignId('user_id')->nullable()->constrained('users');
        //     $table->foreignId('from_branch_id')->nullable()->constrained('branches');
        //     $table->foreignId('to_branch_id')->nullable()->constrained('branches');
        // });

        // Schema::table('products', function (Blueprint $table) {
        //     $table->unsignedBigInteger('created_by')->nullable();
        //     $table->unsignedBigInteger('updated_byy')->nullable();

        //     $table->foreign('created_by')->references('id')->on('users');
        //     $table->foreign('updated_byy')->references('id')->on('users');
        // });

        // Schema::table('order_items', function (Blueprint $table) {
        // $table->dropForeign(['tr_stk_out_id']);
        // $table->dropForeign(['tr_stk_in_id']);
        // $table->dropForeign(['branch_id']);
        // $table->dropColumn(['tr_stk_out_id', 'tr_stk_in_id', 'branch_id']);
        //     $table->foreignId('tr_stk_out_id')->nullable()->constrained('tr_stk_outs');
        //     $table->foreignId('tr_stk_in_id')->nullable()->constrained('tr_stk_ins');
        //     $table->foreignId('branch_id')->nullable()->constrained('branches');
        // });

        // Schema::table('order_items', function (Blueprint $table) {
        //     $table->integer('stock_before')->nullable();
        //     $table->integer('stock_after')->nullable();
        // });
        // Schema::table('adj_items', function (Blueprint $table) {
        //     $table->enum('status', ['new', 'pending', 'done'])->default('new')->change();
        // });
        // Schema::table('order_items', function (Blueprint $table) {
        //     $table->renameColumn('adj_id', 'adj_item_id');
        // });
        // Schema::table('order_items', function (Blueprint $table) {
        //     $table->foreignId('adj_item_id')->nullable()->constrained('adj_items')->cascadeOnDelete();
        //     $table->integer('notes')->nullable();
        // });
        // Schema::table('products', function (Blueprint $table) {
        //     $table->decimal('cogs', 10, 2)->nullable();
        // });
        // Schema::table('products', function (Blueprint $table) {
        //     $table->dropColumn(['in_stock']);
        // });
        // Schema::table('orders', function (Blueprint $table) {
        //     $table->datetime('date_order')->nullable();
        // });
        // Schema::table('porders', function (Blueprint $table) {
        //     $table->datetime('date_order')->nullable();
        // });
        // Schema::table('orders', function (Blueprint $table) {
        //     $table->string('code_tr')->nullable();
        // });
        // Schema::table('porders', function (Blueprint $table) {
        //     $table->string('code_tr')->nullable();
        // });
        // Schema::table('addresses', function (Blueprint $table) {
        //     // $table->dropForeign(['porder_id']);
        //     // $table->dropForeign(['order_id']);
        //     $table->dropColumn(['porder_id', 'order_id']);

        //     $table->foreignId('porder_id')->nullable()->constrained('porders')->cascadeOnDelete();
        //     $table->foreignId('order_id')->nullable()->constrained('orders')->cascadeOnDelete();
        // });

        // Schema::table('orders', function (Blueprint $table) {
        //     $table->unsignedBigInteger('created_by')->nullable();
        //     $table->unsignedBigInteger('updated_by')->nullable();

        //     $table->foreign('created_by')->references('id')->on('users');
        //     $table->foreign('updated_by')->references('id')->on('users');
        // });

        // Schema::table('porders', function (Blueprint $table) {
        //     $table->unsignedBigInteger('created_by')->nullable();
        //     $table->unsignedBigInteger('updated_by')->nullable();

        //     $table->foreign('created_by')->references('id')->on('users');
        //     $table->foreign('updated_by')->references('id')->on('users');
        // });

        // Schema::table('order_items', function (Blueprint $table) {
        //     // $table->dropForeign(['category_id']);
        //     // $table->dropForeign(['brand_id']);
        //     $table->integer('order_id')->nullable()->constrained('orders')->noActionOnDelete()->change();
        //     $table->integer('product_id')->nullable()->constrained('products')->noActionOnDelete()->change();
        // });

        // Schema::table('products', function (Blueprint $table) {
        //     // $table->dropForeign(['category_id']);
        //     // $table->dropForeign(['brand_id']);
        //     $table->integer('category_id')->nullable()->constrained('categories')->noActionOnDelete()->change();
        //     $table->integer('brand_id')->nullable()->constrained('brands')->noActionOnDelete()->change();
        // });

        // Schema::table('products', function (Blueprint $table) {
        //     $table->renameColumn('link', 'alias');
        // });

        // Schema::table('orders', function (Blueprint $table) {
        //     $table->enum('sales_type', ['dine_in', 'self_pickup', 'delivery'])->default('delivery');
        //     $table->decimal('discount', 10, 2)->nullable();
        // });

        // Schema::table('addresses', function (Blueprint $table) {
        //     $table->string('district')->nullable();
        //     $table->string('village')->nullable();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('products', function (Blueprint $table) {
        //     $table->dropColumn(['sku', 'variant', 'link']);
        // });
    }
};
