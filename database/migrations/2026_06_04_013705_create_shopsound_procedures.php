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
            DROP PROCEDURE IF EXISTS SP_InsertarProducto;

            CREATE PROCEDURE SP_InsertarProducto(
                IN p_categoria_id BIGINT,
                IN p_marca_id BIGINT,
                IN p_nombre VARCHAR(255),
                IN p_descripcion TEXT,
                IN p_precio DECIMAL(10,2),
                IN p_stock INT
            )
            BEGIN
                DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
                BEGIN
                    SELECT 'Error al insertar producto' AS mensaje;
                END;

                IF p_precio < 0 THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'El precio no puede ser negativo';
                ELSEIF p_stock < 0 THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'El stock no puede ser negativo';
                ELSE
                    INSERT INTO productos (
                        categoria_id,
                        marca_id,
                        nombre,
                        descripcion,
                        precio,
                        stock,
                        created_at,
                        updated_at
                    )
                    VALUES (
                        p_categoria_id,
                        p_marca_id,
                        p_nombre,
                        p_descripcion,
                        p_precio,
                        p_stock,
                        NOW(),
                        NOW()
                    );
                END IF;
            END
        ");

        DB::unprepared("
            DROP PROCEDURE IF EXISTS SP_ActualizarProducto;

            CREATE PROCEDURE SP_ActualizarProducto(
                IN p_id BIGINT,
                IN p_nombre VARCHAR(255),
                IN p_precio DECIMAL(10,2),
                IN p_stock INT
            )
            BEGIN
                IF NOT EXISTS (
                    SELECT 1 FROM productos WHERE id = p_id
                ) THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'El producto no existe';
                ELSE
                    UPDATE productos
                    SET nombre = p_nombre,
                        precio = p_precio,
                        stock = p_stock,
                        updated_at = NOW()
                    WHERE id = p_id;
                END IF;
            END
        ");

        DB::unprepared("
            DROP FUNCTION IF EXISTS FN_CalcularSubtotal;

            CREATE FUNCTION FN_CalcularSubtotal(
                p_cantidad INT,
                p_precio DECIMAL(10,2)
            )
            RETURNS DECIMAL(10,2)
            DETERMINISTIC
            BEGIN
                RETURN p_cantidad * p_precio;
            END
        ");

        DB::unprepared("
            DROP FUNCTION IF EXISTS FN_TotalOrden;

            CREATE FUNCTION FN_TotalOrden(
                p_orden_id BIGINT
            )
            RETURNS DECIMAL(10,2)
            DETERMINISTIC
            BEGIN
                DECLARE v_total DECIMAL(10,2);

                SELECT IFNULL(SUM(cantidad * precio), 0)
                INTO v_total
                FROM detalle_ordens
                WHERE orden_id = p_orden_id;

                RETURN v_total;
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS SP_InsertarProducto");
        DB::unprepared("DROP PROCEDURE IF EXISTS SP_ActualizarProducto");
        DB::unprepared("DROP FUNCTION IF EXISTS FN_CalcularSubtotal");
        DB::unprepared("DROP FUNCTION IF EXISTS FN_TotalOrden");
    }
};
