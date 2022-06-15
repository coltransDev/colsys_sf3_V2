<?php

/**
 * BaseAduIndDetControl
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_id_ind_det_control
 * @property integer $ca_id_ind_cab_control
 * @property string $ca_origen
 * @property string $ca_destino
 * @property string $ca_hbl
 * @property date $ca_fcheta
 * @property string $ca_referencia
 * @property string $ca_tipodim
 * @property string $ca_inspeccion
 * @property string $ca_terminal
 * @property string $ca_transportadora
 * @property string $ca_tipocarga
 * @property date $ca_fchbl
 * @property date $ca_fchrecibo
 * @property date $ca_fchaprobacionrim
 * @property date $ca_fchfletes
 * @property date $ca_fchinspeccion
 * @property date $ca_fchpago
 * @property date $ca_fchlevante
 * @property date $ca_fchplanillas
 * @property string $ca_datos
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property Usuario $Usucreado
 * @property Usuario $Usuactualizado
 * @property Doctrine_Collection $AduIndCabControl
 * 
 * @method integer             getCaIdIndDetControl()     Returns the current record's "ca_id_ind_det_control" value
 * @method integer             getCaIdIndCabControl()     Returns the current record's "ca_id_ind_cab_control" value
 * @method string              getCaOrigen()              Returns the current record's "ca_origen" value
 * @method string              getCaDestino()             Returns the current record's "ca_destino" value
 * @method string              getCaHbl()                 Returns the current record's "ca_hbl" value
 * @method date                getCaFcheta()              Returns the current record's "ca_fcheta" value
 * @method string              getCaReferencia()          Returns the current record's "ca_referencia" value
 * @method string              getCaTipodim()             Returns the current record's "ca_tipodim" value
 * @method string              getCaInspeccion()          Returns the current record's "ca_inspeccion" value
 * @method string              getCaTerminal()            Returns the current record's "ca_terminal" value
 * @method string              getCaTransportadora()      Returns the current record's "ca_transportadora" value
 * @method string              getCaTipocarga()           Returns the current record's "ca_tipocarga" value
 * @method date                getCaFchbl()               Returns the current record's "ca_fchbl" value
 * @method date                getCaFchrecibo()           Returns the current record's "ca_fchrecibo" value
 * @method date                getCaFchaprobacionrim()    Returns the current record's "ca_fchaprobacionrim" value
 * @method date                getCaFchfletes()           Returns the current record's "ca_fchfletes" value
 * @method date                getCaFchinspeccion()       Returns the current record's "ca_fchinspeccion" value
 * @method date                getCaFchpago()             Returns the current record's "ca_fchpago" value
 * @method date                getCaFchlevante()          Returns the current record's "ca_fchlevante" value
 * @method date                getCaFchplanillas()        Returns the current record's "ca_fchplanillas" value
 * @method string              getCaDatos()               Returns the current record's "ca_datos" value
 * @method timestamp           getCaFchcreado()           Returns the current record's "ca_fchcreado" value
 * @method string              getCaUsucreado()           Returns the current record's "ca_usucreado" value
 * @method timestamp           getCaFchactualizado()      Returns the current record's "ca_fchactualizado" value
 * @method string              getCaUsuactualizado()      Returns the current record's "ca_usuactualizado" value
 * @method Usuario             getUsucreado()             Returns the current record's "Usucreado" value
 * @method Usuario             getUsuactualizado()        Returns the current record's "Usuactualizado" value
 * @method Doctrine_Collection getAduIndCabControl()      Returns the current record's "AduIndCabControl" collection
 * @method AduIndDetControl    setCaIdIndDetControl()     Sets the current record's "ca_id_ind_det_control" value
 * @method AduIndDetControl    setCaIdIndCabControl()     Sets the current record's "ca_id_ind_cab_control" value
 * @method AduIndDetControl    setCaOrigen()              Sets the current record's "ca_origen" value
 * @method AduIndDetControl    setCaDestino()             Sets the current record's "ca_destino" value
 * @method AduIndDetControl    setCaHbl()                 Sets the current record's "ca_hbl" value
 * @method AduIndDetControl    setCaFcheta()              Sets the current record's "ca_fcheta" value
 * @method AduIndDetControl    setCaReferencia()          Sets the current record's "ca_referencia" value
 * @method AduIndDetControl    setCaTipodim()             Sets the current record's "ca_tipodim" value
 * @method AduIndDetControl    setCaInspeccion()          Sets the current record's "ca_inspeccion" value
 * @method AduIndDetControl    setCaTerminal()            Sets the current record's "ca_terminal" value
 * @method AduIndDetControl    setCaTransportadora()      Sets the current record's "ca_transportadora" value
 * @method AduIndDetControl    setCaTipocarga()           Sets the current record's "ca_tipocarga" value
 * @method AduIndDetControl    setCaFchbl()               Sets the current record's "ca_fchbl" value
 * @method AduIndDetControl    setCaFchrecibo()           Sets the current record's "ca_fchrecibo" value
 * @method AduIndDetControl    setCaFchaprobacionrim()    Sets the current record's "ca_fchaprobacionrim" value
 * @method AduIndDetControl    setCaFchfletes()           Sets the current record's "ca_fchfletes" value
 * @method AduIndDetControl    setCaFchinspeccion()       Sets the current record's "ca_fchinspeccion" value
 * @method AduIndDetControl    setCaFchpago()             Sets the current record's "ca_fchpago" value
 * @method AduIndDetControl    setCaFchlevante()          Sets the current record's "ca_fchlevante" value
 * @method AduIndDetControl    setCaFchplanillas()        Sets the current record's "ca_fchplanillas" value
 * @method AduIndDetControl    setCaDatos()               Sets the current record's "ca_datos" value
 * @method AduIndDetControl    setCaFchcreado()           Sets the current record's "ca_fchcreado" value
 * @method AduIndDetControl    setCaUsucreado()           Sets the current record's "ca_usucreado" value
 * @method AduIndDetControl    setCaFchactualizado()      Sets the current record's "ca_fchactualizado" value
 * @method AduIndDetControl    setCaUsuactualizado()      Sets the current record's "ca_usuactualizado" value
 * @method AduIndDetControl    setUsucreado()             Sets the current record's "Usucreado" value
 * @method AduIndDetControl    setUsuactualizado()        Sets the current record's "Usuactualizado" value
 * @method AduIndDetControl    setAduIndCabControl()      Sets the current record's "AduIndCabControl" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseAduIndDetControl extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('aduana.tb_ind_det_control');
        $this->hasColumn('ca_id_ind_det_control', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_id_ind_cab_control', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_origen', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_destino', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_hbl', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fcheta', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_referencia', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_tipodim', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_inspeccion', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_terminal', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_transportadora', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_tipocarga', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchbl', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_fchrecibo', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_fchaprobacionrim', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_fchfletes', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_fchinspeccion', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_fchpago', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_fchlevante', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_fchplanillas', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_datos', 'string', null, array(
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
        $this->hasOne('Usuario as Usucreado', array(
             'local' => 'ca_usucreado',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as Usuactualizado', array(
             'local' => 'ca_usuactualizado',
             'foreign' => 'ca_login'));

        $this->hasMany('AduIndCabControl', array(
             'local' => 'ca_id_ind_cab_control',
             'foreign' => 'ca_id_ind_cab_control'));
    }
}