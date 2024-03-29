<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyContraintToProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_details', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('product_id')->change();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_details', function (Blueprint $table) {
            //
            // $table->integer('product_id')->change();
            $table->dropForeign('product_details_product_id_foreign');
        });
    }
}
