<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_chapters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('documents_id');
            $table->bigInteger('parent_id')->nullable();
            $table->string('name', 128);
            $table->boolean('is_enable')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('documents_id')->references('id')->on('documents')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('document_chapters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_chapters');
    }
}
