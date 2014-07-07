<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSpecialityUniversityTable extends Migration {

    public $table = 'speciality_university';

	public function up(){
        if (!Schema::hasTable($this->table)) {
    		Schema::create($this->table, function(Blueprint $table) {
    			$table->increments('id');
                $table->integer('university_id')->unsigned()->nullable();
                $table->integer('speciality_id')->unsigned()->nullable();

                $table->integer('avatar')->unsigned()->nullable();
                $table->text('info')->nullable();
                $table->string('learning_form', 32)->nullable();

    			$table->foreign('university_id')->references('id')->on('university')->onDelete('cascade');
    			$table->foreign('speciality_id')->references('id')->on('speciality')->onDelete('cascade');
    		});
            echo(' + ' . $this->table . PHP_EOL);
        } else {
            echo('...' . $this->table . PHP_EOL);
        }
	}

	public function down(){
		Schema::dropIfExists($this->table);
        echo(' - ' . $this->table . PHP_EOL);
	}

}