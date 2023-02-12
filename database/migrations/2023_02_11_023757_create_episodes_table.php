<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use \App\Traits\CSVLoader;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('season');
            $table->unsignedTinyInteger('day');
            $table->string('section');
            $table->string('title');
            $table->string('speakers');
            $table->string('source');
            $table->string('slide')->nullable();
            $table->timestamps();
        });

        $this->seed(storage_path('app/seeders/csv/episodes.csv'), \App\Models\Episode::class);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episodes');
    }
};
