<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('vendors')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            
            
            $table->date('date_transaction')->index();
            $table->text('description')->nullable(); // <-- Pastikan ada kolom ini
            $table->decimal('amount', 15, 2)->default(0);
            $table->decimal('amount_dollar', 15, 2)->default(0);
            $table->string('currency', 10);
            $table->string('image')->nullable(); // <-- Sebaiknya nullable
            $table->boolean('is_paid')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};