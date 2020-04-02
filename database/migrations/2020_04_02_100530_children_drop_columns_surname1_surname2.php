<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChildrenDropColumnsSurname1Surname2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('children', function (Blueprint $table) {
            $table->dropColumn('surname1');
            $table->dropColumn('surname2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('children', function (Blueprint $table) {
            $table->char('surname1', 20)->after('name')->nullable();
            $table->char('surname2', 20)->after('surname1')->nullable();
        });
    }
}
