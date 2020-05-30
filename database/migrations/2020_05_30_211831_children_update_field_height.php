<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChildrenUpdateFieldHeight extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('children', function (Blueprint $table) {
            $table->dropColumn('height');
        });

        Schema::table('children', function (Blueprint $table) {
            $table->decimal('height',5,2)->after('shoes_size')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('height');
            $table->decimal('height',3,2)->after('shoes_size')->nullable();
        });
    }
}
