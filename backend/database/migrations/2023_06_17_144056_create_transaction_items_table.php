<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('transaction_id')->nullable();
            $table->bigInteger('item_id')->nullable();
            $table->float('qty')->nullable();
            $table->bigInteger('warehouse_id')->nullable();
            $table->integer('transaction_type')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_items');
    }
};