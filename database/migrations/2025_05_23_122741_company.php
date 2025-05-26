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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_email')->unique();
            $table->string('company_number');
            $table->string('company_address');
            $table->boolean('deactivated');
        });

        Schema::create('owner', function (Blueprint $table) {
            $table->id();
            $table->string('owner_name');
            $table->string('owner_number');
            $table->string('owner_email');
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
        });

        Schema::create('contact', function (Blueprint $table) {
            $table->id();
            $table->string('contact_name');
            $table->string('contact_number');
            $table->string('contact_email');
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company');
        Schema::dropIfExists('owner');
        Schema::dropIfExists('contact');
    }
};
