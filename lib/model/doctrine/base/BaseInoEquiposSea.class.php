<?php

/**
 * BaseInoEquiposSea
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $ca_referencia
 * @property integer $ca_idequipo
 * @property integer $ca_idconcepto
 * @property integer $ca_cantidad
 * @property string $ca_observaciones
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property InoMaestraSea $InoMaestraSea
 * @property Concepto $Concepto
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5845 2009-06-09 07:36:57Z jwage $
 */
abstract class BaseInoEquiposSea extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_inoequipos_sea');
        $this->hasColumn('ca_referencia', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('ca_idequipo', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_idconcepto', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_cantidad', 'integer', null, array(
             'type' => 'integer',
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
        $this->hasOne('InoMaestraSea', array(
             'local' => 'ca_referencia',
             'foreign' => 'ca_referencia'));

        $this->hasOne('Concepto', array(
             'local' => 'ca_idconcepto',
             'foreign' => 'ca_idconcepto'));
    }
}