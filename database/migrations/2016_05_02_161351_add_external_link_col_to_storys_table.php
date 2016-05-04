<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExternalLinkColToStorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('storys', function (Blueprint $table) {
              $table->string('external_link')->after('content')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('storys', function (Blueprint $table) {
          $table->dropColumn('external_link');

        });
    }
}
