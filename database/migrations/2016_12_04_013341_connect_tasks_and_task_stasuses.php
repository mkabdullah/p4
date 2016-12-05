<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConnectTasksAndTaskStasuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('tasks', function (Blueprint $table) {

        $table->integer('task_status_id')->unsigned();

        $table->foreign('task_status_id')->references('id')->on('task_statuses');

      });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('tasks', function (Blueprint $table) {

        $table->dropForeign('tasks_task_status_id_foreign');

        $table->dropColumn('task_status_id');
      });

    }
}
