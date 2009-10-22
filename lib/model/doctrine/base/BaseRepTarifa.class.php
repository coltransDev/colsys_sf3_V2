<?php

/**
 * BaseRepTarifa
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $oid
 * @property integer $ca_idreporte
 * @property integer $ca_idconcepto
 * @property decimal $ca_cantidad
 * @property decimal $ca_neta_tar
 * @property decimal $ca_neta_min
 * @property string $ca_neta_idm
 * @property decimal $ca_reportar_tar
 * @property decimal $ca_reportar_min
 * @property string $ca_reportar_idm
 * @property decimal $ca_cobrar_tar
 * @property decimal $ca_cobrar_min
 * @property string $ca_cobrar_idm
 * @property string $ca_observaciones
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property Reporte $Reporte
 * @property Concepto $Concepto
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6508 2009-10-14 06:28:49Z jwage $
 */
abstract class BaseRepTarifa extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_reptarifas');
        $this->hasColumn('oid', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idreporte', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idconcepto', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_cantidad', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_neta_tar', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_neta_min', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_neta_idm', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_reportar_tar', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_reportar_min', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_reportar_idm', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_cobrar_tar', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_cobrar_min', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_cobrar_idm', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_observaciones', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usucreado', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchactualizado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuactualizado', 'string', null, array(
             'type' => 'string',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Reporte', array(
             'local' => 'ca_idreporte',
             'foreign' => 'ca_idreporte'));

        $this->hasOne('Concepto', array(
             'local' => 'ca_idconcepto',
             'foreign' => 'ca_idconcepto'));
    }
}