<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('setting_information', function (Blueprint $table) {
            $table->id();
            $table->string("logo")->nullable();
            $table->string("favicon")->nullable();
            $table->string("name")->nullable();
            $table->string("email")->nullable();
            $table->string("full_address")->nullable();
            $table->text("map")->nullable();
            $table->string("fax")->nullable();
            $table->string("contact_number")->nullable();
            $table->string("copyright")->nullable();
            $table->timestamps();
        });
        Schema::create('setting_ads', function (Blueprint $table) {
            $table->id();
            $table->text("manage_ads_setting")->nullable();
            $table->text("ads_client_id")->nullable();
            $table->string("adsense_ads_file")->nullable();
            $table->timestamps();
        });
        Schema::create('setting_menus', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("url")->nullable();
            $table->enum("status", ["published", "draft", "pending"])->default("pending");
            $table->tinyInteger("menu_type")->default(1);
            $table->tinyInteger("location")->default(1)->comment("vi tri");
            $table->string("menu_type_value")->nullable();
            $table->jsonb("sub_menus")->nullable();
            $table->string("icon")->nullable();
            $table->enum("target", ["_blank", "_self", "_parent","_top"])->default("_self");
            $table->timestamps();
        });
        Schema::create('setting_ads_items', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("title")->nullable();
            $table->string("button_label")->nullable();
            $table->string("key")->nullable();
            $table->enum("status", ["published", "draft", "pending"])->default("pending");
            $table->tinyInteger("ads_type")->default(1)->comment(" 1 customer , 2 ads");
            $table->string("url")->nullable();
            $table->string("image_desktop")->nullable();
            $table->string("image_mobile")->nullable();
            $table->string("location")->nullable();
            $table->date("expired_at")->nullable();
            $table->timestamps();
        });

        Schema::create('setting_pages', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("slug")->nullable();
            $table->string("description")->nullable();
            $table->text("content")->nullable();
            $table->enum("status", ["published", "draft", "pending"])->default("pending");
            $table->integer('author_id')->index()->nullable();
            $table->tinyInteger('page_type')->default(1);
            $table->tinyInteger('page_template')->default(1);
            $table->string("avatar")->nullable();
            $table->jsonb("gallery")->nullable();
            $table->bigInteger("views")->default(0);
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('seo_image')->nullable();
            $table->boolean('seo_index')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_information');
        Schema::dropIfExists('setting_ads_items');
        Schema::dropIfExists('setting_ads');
        Schema::dropIfExists('setting_menus');
        Schema::dropIfExists('setting_pages');
    }
};
