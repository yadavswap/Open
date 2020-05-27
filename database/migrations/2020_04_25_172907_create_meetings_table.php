<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMeetingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('meetings', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('meeting_id', 191);
			$table->integer('user_id')->nullable();
			$table->string('owner_id', 191);
			$table->string('meeting_title')->nullable();
			$table->dateTime('start_time');
			$table->string('zoom_url', 191);
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
		Schema::drop('meetings');
	}

}
