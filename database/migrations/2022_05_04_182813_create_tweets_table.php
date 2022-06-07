<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTweetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tweets')) {
            Schema::create('tweets', function (Blueprint $table) {
                $table->id();
                $table->string('user_id')->references('id')->on('users');
                $table->char('body', 250);
                $table->likes('likes')->nullable();
                $table->text('shared_by', 250)->nullable();
                $table->char('shared_by_name')->nullable();
                $table->timestamps();
            });
        }
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tweets');
    }
}
