<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //definizione della colonna
            $table->unsignedBigInteger('category_id')->nullable()->after('id');

            //definizione FK
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //rimozione relazione
            $table->dropForeign(['category_id']);

            //rimozione colonna
            $table->dropColumn('category_id');
        });
    }
}
