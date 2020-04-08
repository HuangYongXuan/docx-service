<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->comment('文档标题');
            $table->text('description')->nullable()->comment('描述');
            $table->string("cover")->nullable()->comment('图片');
            $table->boolean('is_private')->default(false)->comment('是否只能自己或团队可以访问');
            $table->boolean('is_anyone')->default(true)->comment('是否任何人可以查看');
            $table->bigInteger('created_user_id')->comment('作者');
            $table->unsignedInteger('edit_count')->default(0);
            $table->unsignedInteger('watch_count')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('created_user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
