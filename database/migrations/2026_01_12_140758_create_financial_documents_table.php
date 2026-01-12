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
        Schema::create('financial_documents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('flow_type', ['income', 'expense']);
            $table->string('counterparty')->nullable();   // Abbonaments ... to a service like Amazon ...
            $table->decimal('amount', 12, 2);
            $table->string('currency', 3)->default('EUR');
            $table->date('issue_date');
            $table->date('due_date')->nullable();  // If null = is daily expense
            $table->enum('status', ['draft', 'validated', 'paid', 'archived'])
                ->default('draft');

            // Foreign id
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_documents');
    }
};
