<?php

/**
 * BaseAduCliente
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idcliente
 * @property integer $ca_idagaduana
 * @property date $ca_fchautorizacion
 * @property date $ca_fchvigencia
 * @property integer $ca_iddocumento
 * @property timestamp $ca_fchanulado
 * @property string $ca_usuanulado
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property Cliente $Cliente
 * @property Ids $Ids
 * @property Archivos $Archivos
 * @property IdsCliente $IdsCliente
 * 
 * @method integer    getCaIdcliente()        Returns the current record's "ca_idcliente" value
 * @method integer    getCaIdagaduana()       Returns the current record's "ca_idagaduana" value
 * @method date       getCaFchautorizacion()  Returns the current record's "ca_fchautorizacion" value
 * @method date       getCaFchvigencia()      Returns the current record's "ca_fchvigencia" value
 * @method integer    getCaIddocumento()      Returns the current record's "ca_iddocumento" value
 * @method timestamp  getCaFchanulado()       Returns the current record's "ca_fchanulado" value
 * @method string     getCaUsuanulado()       Returns the current record's "ca_usuanulado" value
 * @method timestamp  getCaFchcreado()        Returns the current record's "ca_fchcreado" value
 * @method string     getCaUsucreado()        Returns the current record's "ca_usucreado" value
 * @method timestamp  getCaFchactualizado()   Returns the current record's "ca_fchactualizado" value
 * @method string     getCaUsuactualizado()   Returns the current record's "ca_usuactualizado" value
 * @method Cliente    getCliente()            Returns the current record's "Cliente" value
 * @method Ids        getIds()                Returns the current record's "Ids" value
 * @method Archivos   getArchivos()           Returns the current record's "Archivos" value
 * @method IdsCliente getIdsCliente()         Returns the current record's "IdsCliente" value
 * @method AduCliente setCaIdcliente()        Sets the current record's "ca_idcliente" value
 * @method AduCliente setCaIdagaduana()       Sets the current record's "ca_idagaduana" value
 * @method AduCliente setCaFchautorizacion()  Sets the current record's "ca_fchautorizacion" value
 * @method AduCliente setCaFchvigencia()      Sets the current record's "ca_fchvigencia" value
 * @method AduCliente setCaIddocumento()      Sets the current record's "ca_iddocumento" value
 * @method AduCliente setCaFchanulado()       Sets the current record's "ca_fchanulado" value
 * @method AduCliente setCaUsuanulado()       Sets the current record's "ca_usuanulado" value
 * @method AduCliente setCaFchcreado()        Sets the current record's "ca_fchcreado" value
 * @method AduCliente setCaUsucreado()        Sets the current record's "ca_usucreado" value
 * @method AduCliente setCaFchactualizado()   Sets the current record's "ca_fchactualizado" value
 * @method AduCliente setCaUsuactualizado()   Sets the current record's "ca_usuactualizado" value
 * @method AduCliente setCliente()            Sets the current record's "Cliente" value
 * @method AduCliente setIds()                Sets the current record's "Ids" value
 * @method AduCliente setArchivos()           Sets the current record's "Archivos" value
 * @method AduCliente setIdsCliente()         Sets the current record's "IdsCliente" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseAduCliente extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_aducliente');
        $this->hasColumn('ca_idcliente', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_idagaduana', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_fchautorizacion', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_fchvigencia', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_iddocumento', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_fchanulado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuanulado', 'string', null, array(
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

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Cliente', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idcliente'));

        $this->hasOne('Ids', array(
             'local' => 'ca_idagaduana',
             'foreign' => 'ca_id'));

        $this->hasOne('Archivos', array(
             'local' => 'ca_iddocumento',
             'foreign' => 'ca_idarchivo'));

        $this->hasOne('IdsCliente', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idcliente'));
    }
}