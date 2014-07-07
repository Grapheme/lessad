<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUniversityTable extends Migration {

    public $table = 'university';

	public function up(){
        if (!Schema::hasTable($this->table)) {
    		Schema::create($this->table, function(Blueprint $table) {
    			$table->increments('id');
                #$table->smallInteger('status')->default(1)->unsigned()->nullable();
                $table->string('name', 100)->nullable()->unique();
                $table->string('fullname', 100)->nullable()->unique();
                $table->integer('city')->unsigned()->nullable();
                $table->integer('photo')->unsigned()->nullable();
                $table->integer('emblem')->unsigned()->nullable();
                $table->integer('organization_form')->unsigned()->nullable();
                $table->integer('type')->unsigned()->nullable();
                $table->integer('profile')->unsigned()->nullable();
                $table->boolean('military_faculty')->nullable();
                $table->integer('foundation_year')->unsigned()->nullable();
                $table->text('desc')->nullable();

                $table->integer('count_students')->unsigned()->nullable();
                $table->integer('count_teachers')->unsigned()->nullable();
                $table->integer('count_specialities')->unsigned()->nullable();
                $table->integer('count_profiles')->unsigned()->nullable();
                $table->integer('count_faculties')->unsigned()->nullable();
                $table->integer('count_buildings')->unsigned()->nullable();
                $table->integer('count_dormitories')->unsigned()->nullable();
                $table->boolean('target_places')->nullable();
                $table->boolean('olympics_admission')->nullable();
                $table->integer('increased_scholarship')->unsigned()->nullable();

                $table->string('phone', 50)->nullable();
                $table->string('email', 50)->nullable();
                $table->integer('count_interested')->unsigned()->nullable();

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