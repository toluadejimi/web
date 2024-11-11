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
        Schema::create('applied_coupons', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->default(0);
            $table->integer('coupon_id')->unsigned()->default(0);
            $table->tinyInteger('type')->default(0)->comment('0 = percent, 1 = fixed');
            $table->decimal('amount')->default(0);
            $table->decimal('discount_amount')->default(0);
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
        Schema::dropIfExists('applied_coupons');
    }
};
