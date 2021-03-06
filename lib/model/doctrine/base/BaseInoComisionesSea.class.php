<?php

/**
 * BaseInoComisionesSea
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idinocliente
 * @property integer $ca_comprobante
 * @property date $ca_fchliquidacion
 * @property decimal $ca_vlrcomision
 * @property decimal $ca_sbrcomision
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property InoClientesSea $InoClientesSea
 * @property Usuario $UsuCreado
 * @property Usuario $UsuActualizado
 * 
 * @method integer          getCaIdinocliente()    Returns the current record's "ca_idinocliente" value
 * @method integer          getCaComprobante()     Returns the current record's "ca_comprobante" value
 * @method date             getCaFchliquidacion()  Returns the current record's "ca_fchliquidacion" value
 * @method decimal          getCaVlrcomision()     Returns the current record's "ca_vlrcomision" value
 * @method decimal          getCaSbrcomision()     Returns the current record's "ca_sbrcomision" value
 * @method timestamp        getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string           getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp        getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method string           getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method InoClientesSea   getInoClientesSea()    Returns the current record's "InoClientesSea" value
 * @method Usuario          getUsuCreado()         Returns the current record's "UsuCreado" value
 * @method Usuario          getUsuActualizado()    Returns the current record's "UsuActualizado" value
 * @method InoComisionesSea setCaIdinocliente()    Sets the current record's "ca_idinocliente" value
 * @method InoComisionesSea setCaComprobante()     Sets the current record's "ca_comprobante" value
 * @method InoComisionesSea setCaFchliquidacion()  Sets the current record's "ca_fchliquidacion" value
 * @method InoComisionesSea setCaVlrcomision()     Sets the current record's "ca_vlrcomision" value
 * @method InoComisionesSea setCaSbrcomision()     Sets the current record's "ca_sbrcomision" value
 * @method InoComisionesSea setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method InoComisionesSea setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method InoComisionesSea setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method InoComisionesSea setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method InoComisionesSea setInoClientesSea()    Sets the current record's "InoClientesSea" value
 * @method InoComisionesSea setUsuCreado()         Sets the current record's "UsuCreado" value
 * @method InoComisionesSea setUsuActualizado()    Sets the current record's "UsuActualizado" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseInoComisionesSea extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_inocomisiones_sea');
        $this->hasColumn('ca_idinocliente', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_comprobante', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_fchliquidacion', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_vlrcomision', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_sbrcomision', 'decimal', null, array(
             'type' => 'decimal',
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
        $this->hasOne('InoClientesSea', array(
             'local' => 'ca_idinocliente',
             'foreign' => 'ca_idinocliente'));

        $this->hasOne('Usuario as UsuCreado', array(
             'local' => 'ca_usucreado',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as UsuActualizado', array(
             'local' => 'ca_usuactualizado',
             'foreign' => 'ca_login'));
    }
}