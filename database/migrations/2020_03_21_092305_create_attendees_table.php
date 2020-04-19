<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if(!Schema::hasTable('attendees')){
			Schema::create('attendees', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->integer('serial_number');
				$table->integer('event_id');
				$table->string('salutation',255);
				$table->string('first_name',255);
				$table->string('last_name',255);
				$table->string('email',255);
				$table->integer('type_id');
				$table->string('country',255);
				$table->string('company',255);
				$table->integer('created_by');
				$table->integer('edited_by');
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
        Schema::dropIfExists('attendees');
    }
}
