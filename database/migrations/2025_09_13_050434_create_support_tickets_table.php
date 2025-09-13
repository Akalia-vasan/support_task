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
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ref_no')->unique();
            $table->string('customer_name');
            $table->text('problem_description');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->integer('status')->default(0)->comment('0 => New, 1=> Opened, 2=> Replied, 3=>closed');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_tickets');
    }
};
