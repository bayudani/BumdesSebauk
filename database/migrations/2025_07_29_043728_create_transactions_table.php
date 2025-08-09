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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->uuid('product_id')
                ->constrained('products')
                ->onDelete('cascade');
            $table->string('customer_name');
            $table->string('customer_address')->nullable();
            $table->string('customer_phone')->nullable();
            $table->integer('quantity')->default(1);
            $table->decimal('total_amount', 20, 2);
            $table->enum('transaction_status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->enum('order_status', ['pending','processing', 'completed', 'cancelled'])->default('pending');
            $table->timestamp('transaction_date')->useCurrent();
            $table->string('payment_method')->nullable();
            $table->enum('delivery_method', ['pickup', 'delivery'])->default('pickup');
            $table->string('proof_of_transaction')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
