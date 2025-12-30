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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email');
            $table->string('phone', 10);

            $table->string('enquiry_for')->nullable();
            $table->text('address')->nullable();

            $table->enum('lead_type', ['Hot', 'Warm', 'Cold']);
            $table->enum('status', ['New', 'In Progress', 'Closed']);

            $table->date('lead_given_date');

            
            $table->enum('assigned_user', ['CRE', 'DSE'])->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
