<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebCheckoutsTable extends Migration
{
    public function up(): void
    {
        Schema::create('web_checkouts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 120);
            $table->string('surname', 120);
            $table->string('document', 50);
            $table->enum('document_type', ['CC', 'CE', 'TI', 'NIT', 'RUT']);
            $table->string('company', 120);
            $table->string('email', 250);
            $table->string('mobile', 10);
            $table->string('address', 250);
            $table->string('status', 50);
            $table->string('value', 250);
            $table->string('message', 150)->nullable();
            $table->string('request_id', 50)->nullable();
            $table->string('reference', 50);
            $table->text('cart')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('web_checkouts');
    }
}
