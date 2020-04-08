<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentDirectoryContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_directory_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('document_directories_id')->comment('目录id');
            $table->jsonb('content')->default('{}')->comment('内容');
            $table->boolean('is_finish')->default(false)->comment('是否完成');
            $table->bigInteger('created_user_id')->comment('作者用户id');
            $table->bigInteger('last_user_id')->nullable()->comment('最后修改人');
            $table->timestamps();
            $table->foreign('document_directories_id')->references('id')->on('document_directories')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('last_user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_directory_contents');
    }
}
