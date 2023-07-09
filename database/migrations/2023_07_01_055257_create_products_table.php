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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('thumbnail');
            $table->foreignId('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->unsignedBigInteger('subcategory_id')->nullable()->index();
            $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onDelete('cascade');

            $table->unsignedBigInteger('childcategory_id')->nullable()->index();
            $table->foreign('childcategory_id')->references('id')->on('child_categories')->onDelete('cascade');


            $table->foreignId('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->integer('quantity');
            $table->text('short_description');
            $table->text('long_description');
            $table->text('video_url')->nullable();
            $table->string('sku')->nullable();
            $table->double('price');
            $table->double('offer_price')->nullable();
            $table->date('offer_start_date')->nullable();
            $table->date('offer_end_date')->nullable();
            $table->string('product_type')->nullable();
            $table->boolean('status');
            $table->integer('is_approved')->default(0);
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};