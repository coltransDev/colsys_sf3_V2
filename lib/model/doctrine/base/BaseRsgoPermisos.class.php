<?php

/**
 * BaseRsgoPermisos
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idproceso
 * @property string $ca_login
 * @property boolean $ca_riesgos_view
 * @property boolean $ca_riesgos_new
 * @property boolean $ca_riesgos_edit
 * @property boolean $ca_riesgos_delete
 * @property boolean $ca_riesgos_approval
 * @property boolean $ca_valoracion_view
 * @property boolean $ca_valoracion_new
 * @property boolean $ca_valoracion_edit
 * @property boolean $ca_valoracion_delete
 * @property boolean $ca_eventos_view
 * @property boolean $ca_eventos_new
 * @property boolean $ca_eventos_edit
 * @property boolean $ca_eventos_delete
 * @property boolean $ca_informes_view
 * @property boolean $ca_informes_new
 * @property integer $ca_idperfil
 * @property string $ca_usucreado
 * @property date $ca_fchcreado
 * @property string $ca_usuactualizado
 * @property date $ca_fchactualizado
 * @property RsgoProcesos $RsgoProcesos
 * @property Usuario $Usuario
 * @property Usuario $UsuCreado
 * @property Usuario $UsuActualizado
 * @property ColsysConfigValue $ColsysConfigValue
 * 
 * @method integer           getCaIdproceso()          Returns the current record's "ca_idproceso" value
 * @method string            getCaLogin()              Returns the current record's "ca_login" value
 * @method boolean           getCaRiesgosView()        Returns the current record's "ca_riesgos_view" value
 * @method boolean           getCaRiesgosNew()         Returns the current record's "ca_riesgos_new" value
 * @method boolean           getCaRiesgosEdit()        Returns the current record's "ca_riesgos_edit" value
 * @method boolean           getCaRiesgosDelete()      Returns the current record's "ca_riesgos_delete" value
 * @method boolean           getCaRiesgosApproval()    Returns the current record's "ca_riesgos_approval" value
 * @method boolean           getCaValoracionView()     Returns the current record's "ca_valoracion_view" value
 * @method boolean           getCaValoracionNew()      Returns the current record's "ca_valoracion_new" value
 * @method boolean           getCaValoracionEdit()     Returns the current record's "ca_valoracion_edit" value
 * @method boolean           getCaValoracionDelete()   Returns the current record's "ca_valoracion_delete" value
 * @method boolean           getCaEventosView()        Returns the current record's "ca_eventos_view" value
 * @method boolean           getCaEventosNew()         Returns the current record's "ca_eventos_new" value
 * @method boolean           getCaEventosEdit()        Returns the current record's "ca_eventos_edit" value
 * @method boolean           getCaEventosDelete()      Returns the current record's "ca_eventos_delete" value
 * @method boolean           getCaInformesView()       Returns the current record's "ca_informes_view" value
 * @method boolean           getCaInformesNew()        Returns the current record's "ca_informes_new" value
 * @method integer           getCaIdperfil()           Returns the current record's "ca_idperfil" value
 * @method string            getCaUsucreado()          Returns the current record's "ca_usucreado" value
 * @method date              getCaFchcreado()          Returns the current record's "ca_fchcreado" value
 * @method string            getCaUsuactualizado()     Returns the current record's "ca_usuactualizado" value
 * @method date              getCaFchactualizado()     Returns the current record's "ca_fchactualizado" value
 * @method RsgoProcesos      getRsgoProcesos()         Returns the current record's "RsgoProcesos" value
 * @method Usuario           getUsuario()              Returns the current record's "Usuario" value
 * @method Usuario           getUsuCreado()            Returns the current record's "UsuCreado" value
 * @method Usuario           getUsuActualizado()       Returns the current record's "UsuActualizado" value
 * @method ColsysConfigValue getColsysConfigValue()    Returns the current record's "ColsysConfigValue" value
 * @method RsgoPermisos      setCaIdproceso()          Sets the current record's "ca_idproceso" value
 * @method RsgoPermisos      setCaLogin()              Sets the current record's "ca_login" value
 * @method RsgoPermisos      setCaRiesgosView()        Sets the current record's "ca_riesgos_view" value
 * @method RsgoPermisos      setCaRiesgosNew()         Sets the current record's "ca_riesgos_new" value
 * @method RsgoPermisos      setCaRiesgosEdit()        Sets the current record's "ca_riesgos_edit" value
 * @method RsgoPermisos      setCaRiesgosDelete()      Sets the current record's "ca_riesgos_delete" value
 * @method RsgoPermisos      setCaRiesgosApproval()    Sets the current record's "ca_riesgos_approval" value
 * @method RsgoPermisos      setCaValoracionView()     Sets the current record's "ca_valoracion_view" value
 * @method RsgoPermisos      setCaValoracionNew()      Sets the current record's "ca_valoracion_new" value
 * @method RsgoPermisos      setCaValoracionEdit()     Sets the current record's "ca_valoracion_edit" value
 * @method RsgoPermisos      setCaValoracionDelete()   Sets the current record's "ca_valoracion_delete" value
 * @method RsgoPermisos      setCaEventosView()        Sets the current record's "ca_eventos_view" value
 * @method RsgoPermisos      setCaEventosNew()         Sets the current record's "ca_eventos_new" value
 * @method RsgoPermisos      setCaEventosEdit()        Sets the current record's "ca_eventos_edit" value
 * @method RsgoPermisos      setCaEventosDelete()      Sets the current record's "ca_eventos_delete" value
 * @method RsgoPermisos      setCaInformesView()       Sets the current record's "ca_informes_view" value
 * @method RsgoPermisos      setCaInformesNew()        Sets the current record's "ca_informes_new" value
 * @method RsgoPermisos      setCaIdperfil()           Sets the current record's "ca_idperfil" value
 * @method RsgoPermisos      setCaUsucreado()          Sets the current record's "ca_usucreado" value
 * @method RsgoPermisos      setCaFchcreado()          Sets the current record's "ca_fchcreado" value
 * @method RsgoPermisos      setCaUsuactualizado()     Sets the current record's "ca_usuactualizado" value
 * @method RsgoPermisos      setCaFchactualizado()     Sets the current record's "ca_fchactualizado" value
 * @method RsgoPermisos      setRsgoProcesos()         Sets the current record's "RsgoProcesos" value
 * @method RsgoPermisos      setUsuario()              Sets the current record's "Usuario" value
 * @method RsgoPermisos      setUsuCreado()            Sets the current record's "UsuCreado" value
 * @method RsgoPermisos      setUsuActualizado()       Sets the current record's "UsuActualizado" value
 * @method RsgoPermisos      setColsysConfigValue()    Sets the current record's "ColsysConfigValue" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseRsgoPermisos extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('riesgos.tb_permisos');
        $this->hasColumn('ca_idproceso', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_login', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('ca_riesgos_view', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_riesgos_new', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_riesgos_edit', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_riesgos_delete', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_riesgos_approval', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_valoracion_view', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_valoracion_new', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_valoracion_edit', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_valoracion_delete', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_eventos_view', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_eventos_new', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_eventos_edit', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_eventos_delete', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_informes_view', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_informes_new', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_idperfil', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_usucreado', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchcreado', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_usuactualizado', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchactualizado', 'date', null, array(
             'type' => 'date',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('RsgoProcesos', array(
             'local' => 'ca_idproceso',
             'foreign' => 'ca_idproceso'));

        $this->hasOne('Usuario', array(
             'local' => 'ca_login',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as UsuCreado', array(
             'local' => 'ca_usucreado',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as UsuActualizado', array(
             'local' => 'ca_usuactualizado',
             'foreign' => 'ca_login'));

        $this->hasOne('ColsysConfigValue', array(
             'local' => 'ca_idperfil',
             'foreign' => 'ca_ident'));
    }
}