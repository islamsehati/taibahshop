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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('created_oleh')->nullable();
            $table->unsignedBigInteger('updated_oleh')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();

            $table->foreign('created_oleh')->references('id')->on('users');
            $table->foreign('updated_oleh')->references('id')->on('users');
            $table->foreign('branch_id')->references('id')->on('branches');
        });
        Schema::table('branches', function (Blueprint $table) {
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
        // Schema::table('products', function (Blueprint $table) {
        //     $table->dropColumn(['sku', 'variant', 'link']);
        // });
    }
};
