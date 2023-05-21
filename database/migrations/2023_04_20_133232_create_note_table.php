<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    protected $table = 'note';
    
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('note', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('note');
    }
};
