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
        DB::unprepared("
            DROP PROCEDURE IF EXISTS SP_EliminarProductoLogico;

            CREATE PROCEDURE SP_EliminarProductoLogico(
                IN p_id BIGINT
            )
            BEGIN
                IF NOT EXISTS (
                    SELECT 1 FROM productos WHERE id = p_id
                ) THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'El producto no existe';
                ELSEIF EXISTS (
                    SELECT 1 FROM detalle_ventas WHERE producto_id = p_id
                ) THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'No se puede eliminar el producto porque tiene ventas registradas';
                ELSE
                    UPDATE productos
                    SET activo = 0,
                        updated_at = NOW()
                    WHERE id = p_id;
                END IF;
            END
        ");

        DB::unprepared("
            DROP PROCEDURE IF EXISTS SP_RegistrarVenta;

            CREATE PROCEDURE SP_RegistrarVenta(
                IN p_producto_id BIGINT,
                IN p_cantidad INT,
                IN p_precio DECIMAL(10,2)
            )
            BEGIN
                DECLARE v_stock INT;
                DECLARE v_venta_id BIGINT;

                DECLARE EXIT HANDLER FOR SQLEXCEPTION
                BEGIN
                    ROLLBACK;
                    SELECT 'Error al registrar venta' AS mensaje;
                END;

                START TRANSACTION;

                SELECT stock
                INTO v_stock
                FROM productos
                WHERE id = p_producto_id
                FOR UPDATE;

                IF v_stock IS NULL THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'El producto no existe';
                ELSEIF v_stock < p_cantidad THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'Stock insuficiente';
                ELSE
                    INSERT INTO ventas (
                        total,
                        created_at,
                        updated_at
                    )
                    VALUES (
                        p_cantidad * p_precio,
                        NOW(),
                        NOW()
                    );

                    SET v_venta_id = LAST_INSERT_ID();

                    INSERT INTO detalle_ventas (
                        venta_id,
                        producto_id,
                        cantidad,
                        precio,
                        created_at,
                        updated_at
                    )
                    VALUES (
                        v_venta_id,
                        p_producto_id,
                        p_cantidad,
                        p_precio,
                        NOW(),
                        NOW()
                    );

                    UPDATE productos
                    SET stock = stock - p_cantidad,
                        updated_at = NOW()
                    WHERE id = p_producto_id;

                    COMMIT;

                    SELECT 'Venta registrada correctamente' AS mensaje;
                END IF;
            END
        ");

        DB::unprepared("
            DROP PROCEDURE IF EXISTS SP_RegistrarOrden;

            CREATE PROCEDURE SP_RegistrarOrden(
                IN p_cliente VARCHAR(120),
                IN p_correo VARCHAR(150),
                IN p_telefono VARCHAR(30),
                IN p_direccion TEXT,
                IN p_producto_id BIGINT,
                IN p_cantidad INT,
                IN p_precio DECIMAL(10,2)
            )
            BEGIN
                DECLARE v_stock INT;
                DECLARE v_orden_id BIGINT;

                DECLARE EXIT HANDLER FOR SQLEXCEPTION
                BEGIN
                    ROLLBACK;
                    SELECT 'Error al registrar orden' AS mensaje;
                END;

                START TRANSACTION;

                SELECT stock
                INTO v_stock
                FROM productos
                WHERE id = p_producto_id
                FOR UPDATE;

                IF v_stock IS NULL THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'El producto no existe';
                ELSEIF v_stock < p_cantidad THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'Stock insuficiente para la orden';
                ELSE
                    INSERT INTO ordens (
                        cliente,
                        correo,
                        telefono,
                        direccion,
                        total,
                        created_at,
                        updated_at
                    )
                    VALUES (
                        p_cliente,
                        p_correo,
                        p_telefono,
                        p_direccion,
                        p_cantidad * p_precio,
                        NOW(),
                        NOW()
                    );

                    SET v_orden_id = LAST_INSERT_ID();

                    INSERT INTO detalle_ordens (
                        orden_id,
                        producto_id,
                        cantidad,
                        precio,
                        created_at,
                        updated_at
                    )
                    VALUES (
                        v_orden_id,
                        p_producto_id,
                        p_cantidad,
                        p_precio,
                        NOW(),
                        NOW()
                    );

                    UPDATE productos
                    SET stock = stock - p_cantidad,
                        updated_at = NOW()
                    WHERE id = p_producto_id;

                    COMMIT;

                    SELECT 'Orden registrada correctamente' AS mensaje;
                END IF;
            END
        ");

        DB::unprepared("
            DROP PROCEDURE IF EXISTS SP_ReporteVentas;

            CREATE PROCEDURE SP_ReporteVentas(
                IN p_fecha_inicio DATE,
                IN p_fecha_fin DATE
            )
            BEGIN
                SELECT
                    ventas.id AS venta_id,
                    DATE_FORMAT(ventas.created_at, '%d/%m/%Y') AS fecha,
                    productos.nombre AS producto,
                    categorias.nombre AS categoria,
                    marcas.nombre AS marca,
                    detalle_ventas.cantidad,
                    detalle_ventas.precio,
                    ventas.total
                FROM ventas
                INNER JOIN detalle_ventas
                    ON ventas.id = detalle_ventas.venta_id
                INNER JOIN productos
                    ON detalle_ventas.producto_id = productos.id
                INNER JOIN categorias
                    ON productos.categoria_id = categorias.id
                INNER JOIN marcas
                    ON productos.marca_id = marcas.id
                WHERE DATE(ventas.created_at)
                    BETWEEN p_fecha_inicio AND p_fecha_fin
                ORDER BY ventas.created_at DESC;
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS SP_EliminarProductoLogico");
        DB::unprepared("DROP PROCEDURE IF EXISTS SP_RegistrarVenta");
        DB::unprepared("DROP PROCEDURE IF EXISTS SP_RegistrarOrden");
        DB::unprepared("DROP PROCEDURE IF EXISTS SP_ReporteVentas");
    }
};
