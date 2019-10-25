<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Log;
class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $authTable = config("wink.foreign_auth_table");
        if(Schema::hasTable($authTable)){
            Schema::table($authTable, function (Blueprint $table) use ($authTable){

                if(!Schema::hasColumn($authTable, "bio")){
                    $table->text("bio")->nullable();
                }

                if(!Schema::hasColumn($authTable, "slug")){
                    $table->string("slug")->nullable()->unique();
                }

                if(!Schema::hasColumn($authTable, "avatar")){
                    $table->string("avatar")->nullable();

                }

            });
        }
        Schema::create('wink_tags', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug')->unique();
            $table->string('name');
            $table->timestamps();

            $table->index('created_at');
        });

        Schema::create('wink_posts_tags', function (Blueprint $table) {
            $table->uuid('post_id');
            $table->uuid('tag_id');

            $table->unique(['post_id', 'tag_id']);
        });


        Schema::create('wink_posts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('excerpt');
            $table->text('body');
            $table->boolean('published')->default(false);
            $table->dateTime('publish_date')->default('2018-10-10 00:00:00');
            $table->string('featured_image')->nullable();
            $table->string('featured_image_caption');
            $table->uuid('author_id')->index();
            $table->timestamps();
        });

        Schema::create('wink_authors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger(config("wink.foreign_auth_table_column"));
            $table->string('slug')->unique();
            $table->string('name');
            $table->text('bio');
            $table->string('avatar')->nullable();

            $table->foreign(config("wink.foreign_auth_table_column"))
                ->references(config("wink.foreign_auth_table_column_id"))
                ->on(config("wink.foreign_auth_table"));
            $table->timestamps();
        });

        Schema::create('wink_pages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('body');
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
        Schema::dropIfExists('wink_tags');
        Schema::dropIfExists('wink_posts_tags');
        Schema::dropIfExists('wink_authors');
        Schema::dropIfExists('wink_posts');
        Schema::dropIfExists('wink_pages');
    }
}
