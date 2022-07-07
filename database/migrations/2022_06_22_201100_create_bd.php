<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /***** Without relations *****/
        Schema::create('table', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('description');
            $table->integer('capacity');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('description');
            $table->decimal('price');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('role', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        /***** With relations *****/
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('names');
            $table->string('last_names');
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedInteger('fk_id_role');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('fk_id_role')
                ->references('id')
                ->on('role');
        });

        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('fk_id_table');
            $table->datetime('received_date')->nullable();
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('received_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('fk_id_table')
                ->references('id')
                ->on('table');
            $table->foreign('created_by')
                ->references('id')
                ->on('user');
            $table->foreign('received_by')
                ->references('id')
                ->on('user');
            $table->foreign('updated_by')
                ->references('id')
                ->on('user');
            $table->foreign('deleted_by')
                ->references('id')
                ->on('user');
        });

        /***** Pivoting *****/
        Schema::create('order_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity');
            $table->decimal('subtotal');
            $table->unsignedInteger('fk_id_order');
            $table->unsignedInteger('fk_id_product');
            $table->timestamps();
            $table->foreign('fk_id_order')
                ->references('id')
                ->on('order');
            $table->foreign('fk_id_product')
                ->references('id')
                ->on('product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_has_products');
        Schema::dropIfExists('order');
        Schema::dropIfExists('user');
        Schema::dropIfExists('role');
        Schema::dropIfExists('product');
        Schema::dropIfExists('table');
    }
}
