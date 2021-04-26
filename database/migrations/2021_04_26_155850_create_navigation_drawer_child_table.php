<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavigationDrawerChildTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigation_drawer_child', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("navigation_drawer_id");
            $table->string("name");
            $table->string("path_name");
            $table->string("icon")->nullable();
            $table->tinyInteger("level");
            $table->string("description")
                ->nullable();
            $table->foreign("navigation_drawer_id")
                ->references("id")
                ->on("navigation_drawers")
                ->cascadeOnDelete("cascade");
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
        Schema::dropIfExists('navigation_drawer_child');
    }
}
