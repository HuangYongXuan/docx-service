<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentUserGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_user_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('documents_id')->comment('文档id');
            $table->bigInteger('users_id')->comment('用户id');
            $table->enum('post', ['Owner', 'Admin', 'Develop', 'Visitors', 'Forbidden'])->comment('用户角色');
            $table->bigInteger('invite_user_id')->comment('邀请人id');
            $table->timestamps();
            $table->foreign('documents_id')->references('id')->on('documents')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('users_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('invite_user_id')->references('id')->on('documents')
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
        Schema::dropIfExists('document_user_groups');
    }
}
