<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserNavigationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_navigation_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("navigation_drawer_child_id");
            $table->unsignedBigInteger("user_id");
            $table->foreign("navigation_drawer_child_id")
                ->references("id")
                ->on("navigation_drawer_child")
                ->cascadeOnDelete("cascade");
            $table->foreign("user_id")
                ->references("id")
                ->on("users")
                ->cascadeOnDelete('cascade');
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
        Schema::dropIfExists('user_navigation_items');
    }
}
