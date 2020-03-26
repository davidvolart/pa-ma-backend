<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChildsAddPersonalAndSizeFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('childs', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('surname1');
            $table->dropColumn('surname2');
            $table->dropColumn('id_card');
            $table->dropColumn('height');
            $table->dropColumn('weight');
        });

        Schema::table('childs', function (Blueprint $table) {
            $table->char('name',20)->after('id');
            $table->char('surname1', 20)->after('name')->nullable();
            $table->char('surname2', 20)->after('surname1')->nullable();
            $table->char('id_card', 9)->after('surname2')->nullable();
            $table->char('health_care_number', 20)->after('id_card')->nullable();
            $table->date('birthdate')->after('health_care_number')->nullable();
            $table->char('shirt_size',3)->after('birthdate')->nullable();
            $table->char('pants_size',3)->after('shirt_size')->nullable();
            $table->char('dress_size',3)->after('pants_size')->nullable();
            $table->decimal('shoes_size',3,1)->after('dress_size')->nullable();
            $table->decimal('height',3,2)->after('shoes_size')->nullable();
            $table->decimal('weight',5,2)->after('height')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('childs');
    }
}
