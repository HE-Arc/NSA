<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('location');
            $table->string('title');
            $table->string('description');
            $table->timestamps();

            $table->foreignId('association_id')->nullable()->constrained(); //TODO : deactivate nullable after tests have been made
            $table->foreignId('image_id')->nullable()->constrained()->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropForeign(['association_id']);
            $table->dropForeign(['image_id']);
            $table->drop('activities');
        });
    }
}
