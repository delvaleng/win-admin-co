<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVwRecargasPendientesView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement("CREATE OR REPLACE VIEW vw_recargas_pendientes AS
        SELECT
        recargas.id                as id_driver_recarga,
        saldo.id                   as id_driver_saldo,
        saldo.id_enlace_conductor  as id_enlace_conductor,
        saldo.id_enlace_app        as id_enlace_app,
        saldo.codigo_oficina       as codigo_oficina,
        saldo.usuario_oficina      as usuario_oficina,
        saldo.saldo_actual         as saldo_actual,
        saldo.status               as conductor_status,
        country.id                 as id_counry,
        country.country            as country,
        country.code               as code_country,
        country.moneda_local       as moneda_local,
        country.moneda_admitida    as moneda_admitida,
        country.simbolo_local      as simbolo_local,
        country.simbolo_admitida   as simbolo_admitida,
        country.conversion_monto   as conversion_monto,
        recargas.id_tp_pago        as id_tp_pago,
        tp_pago.description        as tp_pago,
        recargas.id_status_recarga as id_status_recarga,
        status_recarga.description as status_recarga,
        recargas.saldo_previo,
        recargas.saldo_recarga,
        recargas.saldo_final,
        recargas.observacion,
        recargas.status,
        recargas.created_at,
        recargas.updated_at,
        recargas.num_operacion,
        recargas.fecha_pago             as fecha_pago,
        recargas.hora_pago              as hora_pago,
        recarga_detalle.id              as driver_recarga_detalle,
        recarga_detalle.num_comprobante as num_comprobante,
        recarga_detalle.imagen          as imagen,
        recarga_detalle.observacion     as recarga_detalle_observacion,
        recarga_detalle.id_tp_banco     as id_tp_banco,
        tp_banco.description            as tp_banco,
        responsable.id                  as id_responsable,
        responsable.username            as responsable


        FROM winsystem.driver_recargas          recargas

        left join winsystem.driver_recarga_detalles  recarga_detalle     on recarga_detalle.id_driver_recarga = recargas.id
        left join winsystem.tp_bancos                tp_banco            on tp_banco.id                       = recarga_detalle.id_tp_banco
        left join winsystem.driver_saldo             saldo               on saldo.id                          = recargas.id_driver_saldo
        left join winsystem.countries                country             on country.id                        = saldo.id_country
        left join winsystem.tp_pagos                 tp_pago             on tp_pago.id                        = recargas.id_tp_pago
        left join winsystem.status_recargas          status_recarga      on status_recarga.id                 = recargas.id_status_recarga
        left join winsystem.users                    responsable         on responsable.id                    = recargas.responsable

        WHERE
        recargas.deleted_at        is null  and
        recargas.id_tp_pago        in (1,2) and
        recargas.id_status_recarga in (1,2,3);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('vw_recargas_pendientes');
    }
}
