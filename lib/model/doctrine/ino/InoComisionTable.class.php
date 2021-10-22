<?php

class InoComisionTable extends Doctrine_Table {

    public static function getTotalCausado($idHouse, $IdUtilidad) {
        $q = Doctrine::getTable("InoComision")
                ->createQuery("c")
                ->addWhere("c.ca_idhouse = ? ", $idHouse);
        if ($IdUtilidad) {
            $q->addWhere("c.ca_idutilidad = ?", $IdUtilidad);
        } else {
            $q->addWhere("c.ca_idutilidad IS NULL");
        }
        $inoComisiones = $q->execute();

        $tot_causado = 0;
        foreach ($inoComisiones as $inoComision) {
            if ($inoComision->getCaConsecutivo()) {
                $tot_causado += $inoComision->getCaComision();
            }
        }
        return $tot_causado;
    }

    public static function getTotalPagado($idHouse, $IdUtilidad) {
        $q = Doctrine::getTable("InoComision")
                ->createQuery("c")
                ->addWhere("c.ca_idhouse = ? ", $idHouse)
                ->addWhere("c.ca_consecutivo IS NOT NULL");
        if ($IdUtilidad) {
            $q->addWhere("c.ca_idutilidad = ?", $IdUtilidad);
        } else {
            $q->addWhere("c.ca_idutilidad IS NULL");
        }
        $inoComisiones = $q->execute();

        $tot_pagado = 0;
        foreach ($inoComisiones as $inoComision) {
            if ($inoComision->getCaConsecutivo()) {
                $tot_pagado += $inoComision->getCaComision();
            }
        }
        return $tot_pagado;
    }

}
