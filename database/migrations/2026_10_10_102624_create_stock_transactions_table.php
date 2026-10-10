<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('item_id')
                ->constrained('items')
                ->restrictOnDelete();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->date('transaction_date');
            
            $table->enum('type', [
                'masuk',
                'keluar',
            ]);

            $table->decimal('quantity', 15, 2);
            $table->decimal('unit_price', 15, 2)->default(0);

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index(['item_id', 'transaction_date']);
            $table->index(['transaction_date', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_transactions');
    }
};