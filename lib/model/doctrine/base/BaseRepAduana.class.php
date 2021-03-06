<?php

/**
 * BaseRepAduana
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idreporte
 * @property string $ca_instrucciones
 * @property string $ca_coordinador
 * @property string $ca_transnacarga
 * @property string $ca_transnatipo
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property Reporte $Reporte
 * @property Usuario $Usuario
 * 
 * @method integer   getCaIdreporte()       Returns the current record's "ca_idreporte" value
 * @method string    getCaInstrucciones()   Returns the current record's "ca_instrucciones" value
 * @method string    getCaCoordinador()     Returns the current record's "ca_coordinador" value
 * @method string    getCaTransnacarga()    Returns the current record's "ca_transnacarga" value
 * @method string    getCaTransnatipo()     Returns the current record's "ca_transnatipo" value
 * @method timestamp getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string    getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method string    getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method Reporte   getReporte()           Returns the current record's "Reporte" value
 * @method Usuario   getUsuario()           Returns the current record's "Usuario" value
 * @method RepAduana setCaIdreporte()       Sets the current record's "ca_idreporte" value
 * @method RepAduana setCaInstrucciones()   Sets the current record's "ca_instrucciones" value
 * @method RepAduana setCaCoordinador()     Sets the current record's "ca_coordinador" value
 * @method RepAduana setCaTransnacarga()    Sets the current record's "ca_transnacarga" value
 * @method RepAduana setCaTransnatipo()     Sets the current record's "ca_transnatipo" value
 * @method RepAduana setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method RepAduana setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method RepAduana setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method RepAduana setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method RepAduana setReporte()           Sets the current record's "Reporte" value
 * @method RepAduana setUsuario()           Sets the current record's "Usuario" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseRepAduana extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_repaduana');
        $this->hasColumn('ca_idreporte', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_instrucciones', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_coordinador', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_transnacarga', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_transnatipo', 'string', null, array(
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


        $this->setAttribute(Doctrine_Core::ATTR_EXPORT, Doctrine_Core::EXPORT_TABLES);

        $this->option('symfony', array(
             'form' => true,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Reporte', array(
             'local' => 'ca_idreporte',
             'foreign' => 'ca_idreporte'));

        $this->hasOne('Usuario', array(
             'local' => 'ca_coordinador',
             'foreign' => 'ca_login'));
    }
}