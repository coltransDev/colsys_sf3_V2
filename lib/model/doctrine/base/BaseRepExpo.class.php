<?php

/**
 * BaseRepExpo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idreporte
 * @property decimal $ca_peso
 * @property decimal $ca_volumen
 * @property string $ca_piezas
 * @property string $ca_dimensiones
 * @property string $ca_valorcarga
 * @property string $ca_anticipo
 * @property integer $ca_idsia
 * @property integer $ca_tipoexpo
 * @property integer $ca_idlineaterrestre
 * @property string $ca_motonave
 * @property string $ca_emisionbl
 * @property string $ca_datosbl
 * @property integer $ca_numbl
 * @property Reporte $Reporte
 * @property Sia $Sia
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6365 2009-09-15 18:22:38Z jwage $
 */
abstract class BaseRepExpo extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_repexpo');
        $this->hasColumn('ca_idreporte', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_peso', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_volumen', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_piezas', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_dimensiones', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_valorcarga', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_anticipo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idsia', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_tipoexpo', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idlineaterrestre', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_motonave', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_emisionbl', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_datosbl', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_numbl', 'integer', null, array(
             'type' => 'integer',
             ));


        $this->setAttribute(Doctrine::ATTR_EXPORT, Doctrine::EXPORT_TABLES);
    }

    public function setUp()
    {
        parent::setUp();
    $this->hasOne('Reporte', array(
             'local' => 'ca_idreporte',
             'foreign' => 'ca_idreporte'));

        $this->hasOne('Sia', array(
             'local' => 'ca_idsia',
             'foreign' => 'ca_idsia'));
    }
}