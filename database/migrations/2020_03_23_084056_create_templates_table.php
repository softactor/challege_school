<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if(!Schema::hasTable('templates')){
			Schema::create('templates', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->string('template_name',500);
				$table->integer('event_id');
				$table->integer('type_id');
				$table->integer('page_height');
				$table->integer('page_width');
				$table->string('header_image');
				$table->longText('template_data')->nullable();
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
        Schema::dropIfExists('templates');
    }
}
