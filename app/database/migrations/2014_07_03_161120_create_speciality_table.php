<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSpecialityTable extends Migration {

    public $table = 'speciality';

	public function up(){
        if (!Schema::hasTable($this->table)) {
    		Schema::create($this->table, function(Blueprint $table) {

    			$table->increments('id');
                $table->string('name', 100)->nullable()->unique();
                $table->integer('university_id')->default(0)->unsigned()->nullable();
                $table->integer('emblem')->unsigned()->nullable();

                $table->string('slug')->nullable()->unique();
    			$table->timestamps();
           		#$table->index('name');
           		#$table->index('slug');

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