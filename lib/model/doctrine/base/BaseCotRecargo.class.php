<?php

/**
 * BaseCotRecargo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idcotrecargo
 * @property integer $ca_idcotizacion
 * @property integer $ca_idproducto
 * @property integer $ca_idopcion
 * @property integer $ca_idconcepto
 * @property integer $ca_idrecargo
 * @property string $ca_modalidad
 * @property decimal $ca_valor_tar
 * @property string $ca_aplica_tar
 * @property decimal $ca_valor_min
 * @property string $ca_aplica_min
 * @property string $ca_idmoneda
 * @property string $ca_observaciones
 * @property integer $ca_consecutivo
 * @property string $ca_usucreado
 * @property timestamp $ca_fchcreado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchactualizado
 * @property Concepto $Concepto
 * @property TipoRecargo $TipoRecargo
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6508 2009-10-14 06:28:49Z jwage $
 */
abstract class BaseCotRecargo extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_cotrecargos');
        $this->hasColumn('ca_idcotrecargo', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idcotizacion', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idproducto', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idopcion', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idconcepto', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idrecargo', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_modalidad', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_valor_tar', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_aplica_tar', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_valor_min', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_aplica_min', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idmoneda', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_observaciones', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_consecutivo', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_usucreado', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuactualizado', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_fchactualizado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));


        $this->setAttribute(Doctrine_Core::ATTR_EXPORT, Doctrine_Core::EXPORT_TABLES);
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Concepto', array(
             'local' => 'ca_idconcepto',
             'foreign' => 'ca_idconcepto'));

        $this->hasOne('TipoRecargo', array(
             'local' => 'ca_idrecargo',
             'foreign' => 'ca_idrecargo'));
    }
}