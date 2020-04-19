<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if(!Schema::hasTable('events')){
			Schema::create('events', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->string('name', 255);
				$table->dateTime('event_date');
				$table->integer('created_by');
				$table->integer('edited_by')->nullable();
				$table->timestamps();
			});
		}
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
