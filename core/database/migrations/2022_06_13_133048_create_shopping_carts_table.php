<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_carts', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('user_id')->default(0);
            $table->unsignedInteger('product_id')->default(0);
            $table->unsignedInteger('domain_id')->default(0);
            $table->tinyInteger('type')->default(1);
            $table->tinyInteger('id_protection')->default(0);
            $table->integer('reg_period')->default(0);
            $table->tinyInteger('billing_cycle')->default(0);
            $table->string('domain')->nullable(true);
            $table->string('ns1')->nullable(true);
            $table->string('ns2')->nullable(true);
            $table->string('password')->nullable(true);
            $table->decimal('price', 28, 16)->default(0);
            $table->decimal('setup_fee', 28, 16)->default(0);
            $table->decimal('discount', 28, 16)->default(0);
            $table->decimal('total', 28, 16)->default(0);
            $table->decimal('after_discount', 28, 16)->default(0);
            $table->string('config_options')->nullable(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shopping_carts');
    }
};
