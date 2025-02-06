<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('currency')->default("VND");
            $table->string("name")->nullable();
            $table->string("avatar")->nullable();
            $table->text("description")->nullable();
            $table->boolean("is_default")->default(false);
            $table->enum("status", ["active", "inactive"])->default("active");
            $table->jsonb("config")->nullable();
            $table->timestamps();
        });
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('avatar')->nullable();
            $table->string('icon')->nullable();
            $table->enum("status", ["published", "draft", "pending"])->default("pending");
            $table->string('description')->nullable();
            $table->integer('parent_id')->default(0)->index();
            $table->string('title_seo')->nullable();
            $table->string('description_seo')->nullable();
            $table->string('keywords_seo')->nullable();
            $table->tinyInteger('index_seo')->default(1);
            $table->timestamps();
        });
        Schema::create('ec_warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('avatar')->nullable();
            $table->enum("status", ["published", "draft", "pending"])->default("pending");
            $table->string('description')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
        });
        Schema::create('ec_brands', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('avatar')->nullable();
            $table->enum("status", ["published", "draft", "pending"])->default("pending");
            $table->string('description')->nullable();
            $table->string('title_seo')->nullable();
            $table->string('description_seo')->nullable();
            $table->string('keywords_seo')->nullable();
            $table->tinyInteger('index_seo')->default(1);
            $table->timestamps();
        });
        Schema::create('ec_product_labels', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('slug')->nullable();
            $table->tinyInteger('order')->default(0);
            $table->enum("status", ["published", "draft", "pending"])->default("pending");
            $table->timestamps();
        });
        Schema::create('ec_products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string("description")->nullable();
            $table->string('avatar')->nullable();
            $table->enum("status", ["published", "draft", "pending"])->default("pending");
            $table->integer('number')->default(0);
            $table->integer('price')->default(0);
            $table->integer('sale')->default(0);
            $table->text("contents")->nullable();
            $table->float("length")->nullable();
            $table->float("width")->nullable();
            $table->float("height")->nullable();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('brand_id')->nullable()->constrained('ec_brands');
            $table->timestamps();
        });
        Schema::create('ec_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->tinyInteger('order')->default(0);
            $table->tinyInteger('is_use_in_product_listing')->default(0);
            $table->tinyInteger('use_image_from_product_variation')->default(0);
            $table->enum("status", ["published", "draft", "pending"])->default("pending");
            $table->timestamps();
        });
        Schema::create('ec_attribute_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attribute_id')->constrained('ec_attributes')->onDelete('cascade');
            $table->tinyInteger('is_default')->default(0);
            $table->string('color')->nullable();
            $table->string('image')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
        });
        Schema::create('ec_product_options', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->tinyInteger('order')->default(0);
            $table->enum("status", ["published", "draft", "pending"])->default("pending");
            $table->timestamps();
        });
        Schema::create('ec_product_options_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_option_id')->constrained('ec_product_options')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('value')->nullable();
            $table->timestamps();
        });
        Schema::create('ec_product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('ec_products')->onDelete('cascade');
            $table->integer('price');
            $table->integer('stock');
            $table->string('image')->nullable();
            $table->timestamps();
        });
        Schema::create('ec_variant_attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_variant_id')->constrained('ec_product_variants')->onDelete('cascade');
            $table->foreignId('attribute_id')->constrained('ec_attributes')->onDelete('cascade');
            $table->foreignId('attribute_value_id')->constrained('ec_attribute_values')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('ec_products_labels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('ec_products')->onDelete('cascade');
            $table->foreignId('product_label_id')->constrained('ec_product_labels')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('ec_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('payment_method_id')->constrained('payment_methods');
            $table->string('code')->index()->unique();
            $table->bigInteger("total_shipping_fee")->default(0);
            $table->enum('payment_status',
                ['pending', 'completed', 'refunding', 'refunded', 'fraud', 'failed'])->default("pending");
            $table->enum("status", ["pending", "processing", "completed", "canceled", "returned"])->default("pending");
            $table->string("coupon_code")->nullable();
            $table->decimal("amount", total: 16, places: 2)->comment("Tổng tiền hàng");
            $table->decimal("shipping_amount", total: 16, places: 2)->comment("Tiền ship");
            $table->decimal("tax_amount", total: 16, places: 2)->comment("tiền thuế");
            $table->decimal("discount_amount", total: 16, places: 2)->comment("Tiền giảm giá");
            $table->decimal("sub_total", total: 16, places: 2)->comment("Tổng tiền");
            $table->dateTime('completed_at')->nullable();
            $table->text("notes")->nullable();
            $table->timestamps();
        });
        Schema::create('ec_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('ec_orders');
            $table->foreignId('product_id')->constrained('ec_products');
            $table->integer('qty')->default(1);
            $table->bigInteger("price")->default(0);
            $table->bigInteger("total_price")->default(0);
            $table->string("status")->nullable()->default("pending");
            $table->timestamps();
        });

        Schema::create('ec_stock_ins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('ec_products')->onDelete('cascade');
            $table->integer('quantity');
            $table->integer('price')->default(0)->nullable();
            $table->date('date');
            $table->timestamps();
        });

        Schema::create('ec_stock_outs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('ec_products')->onDelete('cascade');
            $table->integer('quantity');
            $table->integer('price')->default(0)->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('date');
            $table->timestamps();
        });

        Schema::create('votes', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary key, auto-increment
            $table->text('comment')->nullable(); // Comment field
            $table->integer('rating')->default(0); // Rating field with default value 0
            $table->unsignedBigInteger('product_id'); // Foreign key to products table
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->enum('status', ['published', 'draft', 'pending'])->default('pending'); // Enum status
            $table->json('images')->nullable(); // JSON field for storing images
            $table->timestamps(); // created_at and updated_at
            $table->index('product_id');
            $table->index('user_id');
        });

        $categories = [
            [
                "name" => "Quần áo nam"
            ],
            [
                "name" => "Quần áo nữ"
            ],
        ];
        foreach ($categories as $item) {
            \Illuminate\Support\Facades\DB::table("categories")->insert([
                "name"       => $item["name"],
                "slug"       => \Illuminate\Support\Str::slug($item["name"]),
                "created_at" => Carbon\Carbon::now()
            ]);
        }
        $lables = [
            [
                "name" => "New"
            ],
            [
                "name" => "Hot"
            ],
        ];
        foreach ($lables as $item) {
            \Illuminate\Support\Facades\DB::table("ec_product_labels")->insert([
                "name"       => $item["name"],
                "slug"       => \Illuminate\Support\Str::slug($item["name"]),
                "created_at" => Carbon\Carbon::now()
            ]);
        }
        $paymentsMethod = [
            [
                "currency"    => "VND",
                "name"        => "COD",
                "description" => "Nhận hàng thanh toán",
                "is_default"  => true,
                "status"      => "active",
                "created_at"  => Carbon\Carbon::now()
            ]
        ];

        foreach ($paymentsMethod as $item) {
            \Illuminate\Support\Facades\DB::table("payment_methods")->insert($item);
        }

        $products = [
            [
                "name"        => "Đồ Bộ Nam Phối Dây Dệt",
                "price"       => 200000,
                "sale"        => 0,
                "avatar"      => "https://m.yodycdn.com/fit-in/filters:format(webp)/products/bo-do-nam-phoi-day-det-yody-bdm7011-nau-2.jpg",
                "contents"    => "Nội dung",
                "description" => "Mô tả sản phẩm"
            ],
            [
                "name"        => "Áo Thu Đông Nữ Giữ Nhiệt Cổ Tròn",
                "price"       => 199000,
                "sale"        => 10,
                "avatar"      => "https://m.yodycdn.com/fit-in/filters:format(webp)/products/ao-giu-nhiet-nu-ATN7019-CAM%20%20(1).jpg",
                "contents"    => "Nội dung",
                "description" => "Mô tả sản phẩm"
            ],
            [
                "name"        => "Áo Len Nữ Xẻ Tà Dáng Rộng Dệt Kẻ",
                "price"       => 599000,
                "sale"        => 5,
                "avatar"      => "https://m.yodycdn.com/fit-in/filters:format(webp)/products/aln5010-tkd.jpg",
                "contents"    => "Nội dung",
                "description" => "Mô tả sản phẩm"
            ],
            [
                "name"        => "Đồ Bộ Nam Phối Dây Dệt Năm nay",
                "price"       => 699000,
                "sale"        => 20,
                "avatar"      => "https://m.yodycdn.com/fit-in/filters:format(webp)/products/bo-do-nam-phoi-day-det-yody-bdm7011-den-2.jpg",
                "contents"    => "Nội dung",
                "description" => "Mô tả sản phẩm"
            ],
        ];

        foreach ($products as $product) {
            $productInsert = \Illuminate\Support\Facades\DB::table("ec_products")->insertGetId([
                "name"        => $product["name"],
                "slug"        => \Illuminate\Support\Str::slug($product['name']),
                "price"       => $product["price"],
                "avatar"      => $product["avatar"],
                "sale"        => $product["sale"],
                "description" => $product["description"],
                "contents"    => $product["contents"],
                "category_id" => \Illuminate\Support\Facades\DB::table("categories")->inRandomOrder()->first()->id,
                "created_at"  => Carbon\Carbon::now()
            ]);

            if ($productInsert) {
                \Illuminate\Support\Facades\DB::table("ec_products_labels")->insert([
                    "product_id"       => $productInsert,
                    "product_label_id" => \Illuminate\Support\Facades\DB::table("ec_product_labels")->inRandomOrder()->first()->id,
                    "created_at"       => Carbon\Carbon::now()
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
        Schema::dropIfExists('variant_attributes');
        Schema::dropIfExists('ec_variant_attributes');
        Schema::dropIfExists('ec_attribute_values');
        Schema::dropIfExists('ec_product_variants');
        Schema::dropIfExists('ec_product_options_values');
        Schema::dropIfExists('ec_product_options');
        Schema::dropIfExists('ec_attributes');
        Schema::dropIfExists('ec_stock_ins');
        Schema::dropIfExists('ec_stock_outs');
        Schema::dropIfExists('ec_transactions');
        Schema::dropIfExists('ec_orders');
        Schema::dropIfExists('ec_products_labels');
        Schema::dropIfExists('ec_product_labels');
        Schema::dropIfExists('ec_products');
        Schema::dropIfExists('ec_brands');
        Schema::dropIfExists('payment_methods');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('ec_warehouses');
    }
};
