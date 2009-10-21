<?php

/**
 * BasePricFleteBs
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idtrayecto
 * @property integer $ca_idconcepto
 * @property decimal $ca_vlrneto
 * @property decimal $ca_vlrsugerido
 * @property date $ca_fchinicio
 * @property date $ca_fchvencimiento
 * @property string $ca_idmoneda
 * @property string $ca_estado
 * @property string $ca_aplicacion
 * @property integer $ca_consecutivo
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fcheliminado
 * @property Concepto $Concepto
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6365 2009-09-15 18:22:38Z jwage $
 */
abstract class BasePricFleteBs extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('bs_pricfletes');
        $this->hasColumn('ca_idtrayecto', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idconcepto', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_vlrneto', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_vlrsugerido', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_fchinicio', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_fchvencimiento', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_idmoneda', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_estado', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_aplicacion', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_consecutivo', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usucreado', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fcheliminado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));


        $this->setAttribute(Doctrine::ATTR_EXPORT, Doctrine::EXPORT_TABLES);
    }

    public function setUp()
    {
        parent::setUp();
    $this->hasOne('Concepto', array(
             'local' => 'ca_idconcepto',
             'foreign' => 'ca_idconcepto'));
    }
}