<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomFieldDropdownMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if(!Schema::hasTable('custom_field_dropdown_metas')){
			Schema::create('custom_field_dropdown_metas', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->integer('custom_fields_id');
				$table->string('option_label');
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
        Schema::dropIfExists('custom_field_dropdown_metas');
    }
}
