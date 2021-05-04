<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDropdownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_dropdowns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("navigation_dropdown_id");
            $table->foreign("user_id")
                ->references("id")
                ->on("users")
                ->cascadeOnDelete("cascade");
            $table->foreign("navigation_dropdown_id")
                ->references("id")
                ->on("navigation_dropdowns")
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
        Schema::dropIfExists('user_dropdowns');
    }
}
