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
        Schema::create('servers', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('server_group_id')->default(0);
            $table->string('name');
            $table->string('type'); 
            $table->string('hostname'); 
            $table->string('username'); 
            $table->string('password'); 
            $table->string('ip_address'); 
            $table->text('api_token'); 
            $table->string('security_token'); 

            $table->string('ns1'); 
            $table->string('ns1_ip'); 
            $table->string('ns2'); 
            $table->string('ns2_ip'); 
            $table->string('ns3'); 
            $table->string('ns3_ip'); 
            $table->string('ns4'); 
            $table->string('ns4_ip'); 
 
            $table->tinyInteger('status')->default(1); 

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
        Schema::dropIfExists('servers');
    }
};
