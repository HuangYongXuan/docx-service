<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateDocumentChapterContentsColumnByName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('document_chapter_contents', function (Blueprint $table) {
            $table->string('title')->addColumn();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_chapter_contents', function (Blueprint $table) {
            $table->dropColumn(['title']);
        });
    }
}
