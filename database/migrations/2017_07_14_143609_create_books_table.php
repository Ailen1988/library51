<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bookname', 100)->comment('书名');
            $table->string('publisher', 100)->comment('出版社');
            $table->string('author', 50)->comment('作者');
            $table->decimal('price', 6, 2)->default(0)->comment('价格');
            $table->text('content')->comment('描述');
            $table->integer('cid')->comment('分类ID');
            $table->string('tags')->comment('标签ID');
            $table->string('pic')->comment('封面图片');
            $table->string('booknum')->comment('图书编号');
            $table->integer('user_id')->comment('管理员ID');
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
        Schema::drop('books');
    }
}
