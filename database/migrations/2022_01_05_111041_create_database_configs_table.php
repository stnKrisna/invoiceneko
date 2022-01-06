<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatabaseConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('database_configs', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('value');

            $table->integer('company_id')->unsigned();
            $table
                ->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onDelete('cascade');

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
        Schema::dropIfExists('database_configs', function (Blueprint $table) {
            $table->dropForeign('database_configs_company_id_foreign');
            $table->dropColumn('company_id');
        });
    }
}
