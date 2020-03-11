<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('families', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email_parent_1');
            $table->string('email_parent_2');
            $table->unsignedBigInteger('child_id');

            $table->foreign('email_parent_1')
                ->references('email')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('email_parent_2')
                ->references('email')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('child_id')
                ->references('id')->on('childs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('family');
        Schema::enableForeignKeyConstraints();
    }
}
