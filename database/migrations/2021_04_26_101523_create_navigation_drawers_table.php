<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavigationDrawersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigation_drawers', function (Blueprint $table) {
            $table->id();
            $table->string("name")->comment("name of the navigation drawer to apply as label on front ent");
            $table->string('path_name')->comment("apply for base directory example: /dashboard");
            $table->string('icon')->nullable()->comment('if navigation drawer on front end apply icon');
            $table->string('description')->nullable();
            $table->smallInteger("level")->comment('will default create it');
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
        Schema::dropIfExists('navigation_drawers');
    }
}
