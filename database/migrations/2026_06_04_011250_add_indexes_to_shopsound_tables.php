<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE productos ADD CONSTRAINT chk_productos_precio CHECK (precio >= 0)');
        DB::statement('ALTER TABLE productos ADD CONSTRAINT chk_productos_stock CHECK (stock >= 0)');

        DB::statement('ALTER TABLE ventas ADD CONSTRAINT chk_ventas_total CHECK (total >= 0)');

        DB::statement('ALTER TABLE detalle_ventas ADD CONSTRAINT chk_detalle_ventas_cantidad CHECK (cantidad > 0)');
        DB::statement('ALTER TABLE detalle_ventas ADD CONSTRAINT chk_detalle_ventas_precio CHECK (precio >= 0)');

        DB::statement('ALTER TABLE ordens ADD CONSTRAINT chk_ordens_total CHECK (total >= 0)');

        DB::statement('ALTER TABLE detalle_ordens ADD CONSTRAINT chk_detalle_ordens_cantidad CHECK (cantidad > 0)');
        DB::statement('ALTER TABLE detalle_ordens ADD CONSTRAINT chk_detalle_ordens_precio CHECK (precio >= 0)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE productos DROP CHECK chk_productos_precio');
        DB::statement('ALTER TABLE productos DROP CHECK chk_productos_stock');
        DB::statement('ALTER TABLE ventas DROP CHECK chk_ventas_total');
        DB::statement('ALTER TABLE detalle_ventas DROP CHECK chk_detalle_ventas_cantidad');
        DB::statement('ALTER TABLE detalle_ventas DROP CHECK chk_detalle_ventas_precio');
        DB::statement('ALTER TABLE ordens DROP CHECK chk_ordens_total');
        DB::statement('ALTER TABLE detalle_ordens DROP CHECK chk_detalle_ordens_cantidad');
        DB::statement('ALTER TABLE detalle_ordens DROP CHECK chk_detalle_ordens_precio');
    }
};
