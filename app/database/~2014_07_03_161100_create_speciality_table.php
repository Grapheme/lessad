<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSpecialityTable extends Migration {

    public $table = 'speciality';

	public function up(){
        if (!Schema::hasTable($this->table)) {
    		Schema::create($this->table, function(Blueprint $table) {
    			$table->increments('id');
                $table->smallInteger('status')->default(1)->unsigned()->nullable();
                $table->string('name')->nullable()->unique();
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