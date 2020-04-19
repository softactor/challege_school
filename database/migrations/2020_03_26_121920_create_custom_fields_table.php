<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if(!Schema::hasTable('custom_fields')){
			Schema::create('custom_fields', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->string('module',100);
				$table->string('field_slug',100);
				$table->string('field_label',100);
				$table->string('field_type',100);
				$table->string('field_validation',100);
				$table->integer('field_visibility');
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
        Schema::dropIfExists('custom_fields');
    }
}
