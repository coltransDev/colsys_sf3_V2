<?php

/**
 * BaseRepCosto
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idreporte
 * @property integer $ca_idcosto
 * @property string $ca_tipo
 * @property decimal $ca_vlrcosto
 * @property decimal $ca_mincosto
 * @property decimal $ca_netcosto
 * @property string $ca_idmoneda
 * @property string $ca_detalles
 * @property string $ca_aplicacion
 * @property string $ca_aplicacionminimo
 * @property string $ca_parametro
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property Reporte $Reporte
 * @property Costo $Costo
 * 
 * @method integer   getCaIdreporte()         Returns the current record's "ca_idreporte" value
 * @method integer   getCaIdcosto()           Returns the current record's "ca_idcosto" value
 * @method string    getCaTipo()              Returns the current record's "ca_tipo" value
 * @method decimal   getCaVlrcosto()          Returns the current record's "ca_vlrcosto" value
 * @method decimal   getCaMincosto()          Returns the current record's "ca_mincosto" value
 * @method decimal   getCaNetcosto()          Returns the current record's "ca_netcosto" value
 * @method string    getCaIdmoneda()          Returns the current record's "ca_idmoneda" value
 * @method string    getCaDetalles()          Returns the current record's "ca_detalles" value
 * @method string    getCaAplicacion()        Returns the current record's "ca_aplicacion" value
 * @method string    getCaAplicacionminimo()  Returns the current record's "ca_aplicacionminimo" value
 * @method string    getCaParametro()         Returns the current record's "ca_parametro" value
 * @method timestamp getCaFchcreado()         Returns the current record's "ca_fchcreado" value
 * @method string    getCaUsucreado()         Returns the current record's "ca_usucreado" value
 * @method Reporte   getReporte()             Returns the current record's "Reporte" value
 * @method Costo     getCosto()               Returns the current record's "Costo" value
 * @method RepCosto  setCaIdreporte()         Sets the current record's "ca_idreporte" value
 * @method RepCosto  setCaIdcosto()           Sets the current record's "ca_idcosto" value
 * @method RepCosto  setCaTipo()              Sets the current record's "ca_tipo" value
 * @method RepCosto  setCaVlrcosto()          Sets the current record's "ca_vlrcosto" value
 * @method RepCosto  setCaMincosto()          Sets the current record's "ca_mincosto" value
 * @method RepCosto  setCaNetcosto()          Sets the current record's "ca_netcosto" value
 * @method RepCosto  setCaIdmoneda()          Sets the current record's "ca_idmoneda" value
 * @method RepCosto  setCaDetalles()          Sets the current record's "ca_detalles" value
 * @method RepCosto  setCaAplicacion()        Sets the current record's "ca_aplicacion" value
 * @method RepCosto  setCaAplicacionminimo()  Sets the current record's "ca_aplicacionminimo" value
 * @method RepCosto  setCaParametro()         Sets the current record's "ca_parametro" value
 * @method RepCosto  setCaFchcreado()         Sets the current record's "ca_fchcreado" value
 * @method RepCosto  setCaUsucreado()         Sets the current record's "ca_usucreado" value
 * @method RepCosto  setReporte()             Sets the current record's "Reporte" value
 * @method RepCosto  setCosto()               Sets the current record's "Costo" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseRepCosto extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_repaduanadet');
        $this->hasColumn('ca_idreporte', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_idcosto', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_tipo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_vlrcosto', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_mincosto', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_netcosto', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_idmoneda', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_detalles', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_aplicacion', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_aplicacionminimo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_parametro', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usucreado', 'string', null, array(
             'type' => 'string',
             ));


        $this->setAttribute(Doctrine_Core::ATTR_EXPORT, Doctrine_Core::EXPORT_TABLES);

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Reporte', array(
             'local' => 'ca_idreporte',
             'foreign' => 'ca_idreporte'));

        $this->hasOne('Costo', array(
             'local' => 'ca_idcosto',
             'foreign' => 'ca_idcosto'));
    }
}