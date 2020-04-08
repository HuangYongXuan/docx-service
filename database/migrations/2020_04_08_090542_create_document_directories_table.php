<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentDirectoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_directories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('parent_id')->nullable()->comment('上级目录');
            $table->bigInteger('documents_id')->comment('文档id');
            $table->bigInteger('created_user_id')->comment('作者用户id');
            $table->string('name')->comment('目录名称');
            $table->string('description')->nullable()->comment('描述');
            $table->boolean('is_enable')->default(true)->comment('是否启用');
            $table->boolean('is_finish')->default(false)->comment('是否完成');
            $table->bigInteger('last_user_id')->nullable()->comment('最后修改人');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('parent_id')->references('id')->on('document_directories')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('documents_id')->references('id')->on('documents')
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
        Schema::dropIfExists('document_directories');
    }
}
