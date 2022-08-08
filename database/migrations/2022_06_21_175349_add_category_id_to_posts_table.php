<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //先建立ID再設定外部鍵
            $table->unsignedBigInteger('category_id')->nullable();
            //指定名稱資料型別，ID是無號數，所以unsigned，'category_id'命名必須符合資料表名稱。
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            //文章分類ID要跟文章ID關聯，資料表互相關聯需要用外部鍵，參照ID欄位來自categories資料表，'cascade'代表資料相互串聯，跟分類有關的文章都會一起刪除，'restrict'除非相關分類內無文章才能刪除。
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
            //先解除外部鍵再刪除，用陣列代表欄位
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
            // 代表移除欄位
        });
    }
};
