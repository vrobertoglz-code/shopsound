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
            DROP TRIGGER IF EXISTS BI_productos_validar;

            CREATE TRIGGER BI_productos_validar
            BEFORE INSERT ON productos
            FOR EACH ROW
            BEGIN
                IF NEW.precio < 0 THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'El precio del producto no puede ser negativo';
                END IF;

                IF NEW.stock < 0 THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'El stock del producto no puede ser negativo';
                END IF;
            END
        ");

        DB::unprepared("
            DROP TRIGGER IF EXISTS BU_productos_validar;

            CREATE TRIGGER BU_productos_validar
            BEFORE UPDATE ON productos
            FOR EACH ROW
            BEGIN
                IF NEW.precio < 0 THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'El precio del producto no puede ser negativo';
                END IF;

                IF NEW.stock < 0 THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'El stock del producto no puede ser negativo';
                END IF;
            END
        ");

        DB::unprepared("
            DROP TRIGGER IF EXISTS BD_productos_restringir;

            CREATE TRIGGER BD_productos_restringir
            BEFORE DELETE ON productos
            FOR EACH ROW
            BEGIN
                IF EXISTS (
                    SELECT 1
                    FROM detalle_ventas
                    WHERE producto_id = OLD.id
                ) THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'No se puede eliminar el producto porque tiene ventas relacionadas';
                END IF;

                IF EXISTS (
                    SELECT 1
                    FROM detalle_ordens
                    WHERE producto_id = OLD.id
                ) THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'No se puede eliminar el producto porque tiene órdenes relacionadas';
                END IF;
            END
        ");

        DB::unprepared("
            DROP TRIGGER IF EXISTS AI_productos_log;

            CREATE TRIGGER AI_productos_log
            AFTER INSERT ON productos
            FOR EACH ROW
            BEGIN
                INSERT INTO logs_operaciones (
                    tabla_afectada,
                    operacion,
                    usuario_bd,
                    fecha,
                    datos_anteriores,
                    datos_nuevos
                )
                VALUES (
                    'productos',
                    'INSERT',
                    USER(),
                    NOW(),
                    NULL,
                    JSON_OBJECT(
                        'id', NEW.id,
                        'nombre', NEW.nombre,
                        'precio', NEW.precio,
                        'stock', NEW.stock
                    )
                );
            END
        ");

        DB::unprepared("
            DROP TRIGGER IF EXISTS AU_productos_log;

            CREATE TRIGGER AU_productos_log
            AFTER UPDATE ON productos
            FOR EACH ROW
            BEGIN
                INSERT INTO logs_operaciones (
                    tabla_afectada,
                    operacion,
                    usuario_bd,
                    fecha,
                    datos_anteriores,
                    datos_nuevos
                )
                VALUES (
                    'productos',
                    'UPDATE',
                    USER(),
                    NOW(),
                    JSON_OBJECT(
                        'id', OLD.id,
                        'nombre', OLD.nombre,
                        'precio', OLD.precio,
                        'stock', OLD.stock
                    ),
                    JSON_OBJECT(
                        'id', NEW.id,
                        'nombre', NEW.nombre,
                        'precio', NEW.precio,
                        'stock', NEW.stock
                    )
                );
            END
        ");

        DB::unprepared("
            DROP TRIGGER IF EXISTS AD_productos_log;

            CREATE TRIGGER AD_productos_log
            AFTER DELETE ON productos
            FOR EACH ROW
            BEGIN
                INSERT INTO logs_operaciones (
                    tabla_afectada,
                    operacion,
                    usuario_bd,
                    fecha,
                    datos_anteriores,
                    datos_nuevos
                )
                VALUES (
                    'productos',
                    'DELETE',
                    USER(),
                    NOW(),
                    JSON_OBJECT(
                        'id', OLD.id,
                        'nombre', OLD.nombre,
                        'precio', OLD.precio,
                        'stock', OLD.stock
                    ),
                    NULL
                );
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS BI_productos_validar");
        DB::unprepared("DROP TRIGGER IF EXISTS BU_productos_validar");
        DB::unprepared("DROP TRIGGER IF EXISTS BD_productos_restringir");
        DB::unprepared("DROP TRIGGER IF EXISTS AI_productos_log");
        DB::unprepared("DROP TRIGGER IF EXISTS AU_productos_log");
        DB::unprepared("DROP TRIGGER IF EXISTS AD_productos_log");
    }
};
