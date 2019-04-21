<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameBlogsColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->renameColumn('id', 'bid');
            $table->renameColumn('created_at', 'blog_created_at');
            $table->renameColumn('updated_at', 'blog_updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->renameColumn('bid', 'id');
            $table->renameColumn('blog_created_at', 'created_at');
            $table->renameColumn('blog_updated_at', 'updated_at');
        });
    }
}
