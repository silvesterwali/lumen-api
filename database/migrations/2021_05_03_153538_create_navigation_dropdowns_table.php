<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavigationDropdownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigation_dropdowns', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('name of the navigation dropdown');
            $table->string('path_name')->comment('path directory');
            $table->smallInteger('level')->default(0)->comment("hierarchy of menu drop down");
            $table->string('description')->nullable();
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
        Schema::dropIfExists('navigation_dropdowns');
    }
}
