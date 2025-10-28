<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->decimal('utilidad',2,2)->after('precio');
            $table->decimal('precio_venta', 10, 2);
        });
    }


    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropColumn('utilidad');
            $table->dropColumn('precio_venta');
        });
    }
};
