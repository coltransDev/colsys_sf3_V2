<?php

/**
 * BaseInoDeduccion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_iddeduccion
 * @property integer $ca_idcomprobante
 * @property float $ca_neto
 * @property float $ca_tcambio
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property string $ca_observaciones
 * @property InoComprobante $InoComprobante
 * @property Deduccion $Deduccion
 * 
 * @method integer        getCaIddeduccion()     Returns the current record's "ca_iddeduccion" value
 * @method integer        getCaIdcomprobante()   Returns the current record's "ca_idcomprobante" value
 * @method float          getCaNeto()            Returns the current record's "ca_neto" value
 * @method float          getCaTcambio()         Returns the current record's "ca_tcambio" value
 * @method timestamp      getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string         getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp      getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method string         getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method string         getCaObservaciones()   Returns the current record's "ca_observaciones" value
 * @method InoComprobante getInoComprobante()    Returns the current record's "InoComprobante" value
 * @method Deduccion      getDeduccion()         Returns the current record's "Deduccion" value
 * @method InoDeduccion   setCaIddeduccion()     Sets the current record's "ca_iddeduccion" value
 * @method InoDeduccion   setCaIdcomprobante()   Sets the current record's "ca_idcomprobante" value
 * @method InoDeduccion   setCaNeto()            Sets the current record's "ca_neto" value
 * @method InoDeduccion   setCaTcambio()         Sets the current record's "ca_tcambio" value
 * @method InoDeduccion   setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method InoDeduccion   setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method InoDeduccion   setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method InoDeduccion   setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method InoDeduccion   setCaObservaciones()   Sets the current record's "ca_observaciones" value
 * @method InoDeduccion   setInoComprobante()    Sets the current record's "InoComprobante" value
 * @method InoDeduccion   setDeduccion()         Sets the current record's "Deduccion" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseInoDeduccion extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ino.tb_deducciones');
        $this->hasColumn('ca_iddeduccion', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_idcomprobante', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_neto', 'float', null, array(
             'type' => 'float',
             ));
        $this->hasColumn('ca_tcambio', 'float', null, array(
             'type' => 'float',
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
        $this->hasColumn('ca_observaciones', 'string', null, array(
             'type' => 'string',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('InoComprobante', array(
             'local' => 'ca_idcomprobante',
             'foreign' => 'ca_idcomprobante'));

        $this->hasOne('Deduccion', array(
             'local' => 'ca_iddeduccion',
             'foreign' => 'ca_iddeduccion'));
    }
}