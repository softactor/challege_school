<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomFieldMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if(!Schema::hasTable('custom_field_metas')){
			Schema::create('custom_field_metas', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->integer('user_id');
				$table->string('module',255);
				$table->integer('reference_record');
				$table->integer('custom_fields_id');
				$table->text('field_value');
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
        Schema::dropIfExists('custom_field_metas');
    }
}
