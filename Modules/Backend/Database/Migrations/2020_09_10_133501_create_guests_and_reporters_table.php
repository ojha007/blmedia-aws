<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsAndReportersTable extends Migration
{
    protected $tables = ['guests', 'reporters'];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        foreach ($this->tables as $tableName) {
            Schema::create($tableName, function (Blueprint $table) use ($tableName) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->string('organization')->nullable();
                $table->string('facebook_url')->nullable();
                $table->string('twitter_url')->nullable();
                $table->string('designation')->nullable();
                $table->string('phone_number')->nullable();
                $table->string('email')->nullable();
                $table->string('address')->nullable();
                $table->string('slug')->unique();
                $table->string('caption')->nullable();
                $table->text('description')->nullable();
                $table->text('image')->nullable();
                $table->boolean('is_active')->default(1);
                $table->auditableWithDeletes();
                $table->timestamps();
                $table->softDeletes();
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
        foreach ($this->tables as $table) {
            Schema::dropIfExists($table);
        }
    }
}
