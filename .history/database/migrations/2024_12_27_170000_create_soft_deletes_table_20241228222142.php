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
        // Schema::table('orders', function (Blueprint $table) {
        //     $table->softDeletes();
        // });
        // Schema::table('porders', function (Blueprint $table) {
        //     $table->softDeletes();
        // });
        // Schema::table('adj_items', function (Blueprint $table) {
        //     $table->softDeletes();
        // });
        // Schema::table('tr_stk_outs', function (Blueprint $table) {
        //     $table->softDeletes();
        // });
        // Schema::table('tr_stk_ins', function (Blueprint $table) {
        //     $table->softDeletes();
        // });
        // Schema::table('productions', function (Blueprint $table) {
        //     $table->softDeletes();
        // });
        // Schema::table('order_items', function (Blueprint $table) {
        //     $table->softDeletes();
        // });
        // Schema::table('payments', function (Blueprint $table) {
        //     $table->softDeletes();
        // });
        Schema::table('order_items', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
