<?php

/**
 * BaseSeries
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idsserie
 * @property integer $ca_idpadre
 * @property string $ca_nombre
 * @property string $ca_grupo
 * @property string $ca_usucreado
 * @property timestamp $ca_fchcreado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usueliminado
 * @property timestamp $ca_fcheliminado
 * @property integer $ca_idmodo
 * @property Usuario $UsuCreado
 * @property Usuario $UsuActualizado
 * @property Series $Series
 * @property Modo $Modo
 * 
 * @method integer   getCaIdsserie()        Returns the current record's "ca_idsserie" value
 * @method integer   getCaIdpadre()         Returns the current record's "ca_idpadre" value
 * @method string    getCaNombre()          Returns the current record's "ca_nombre" value
 * @method string    getCaGrupo()           Returns the current record's "ca_grupo" value
 * @method string    getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string    getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method timestamp getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method string    getCaUsueliminado()    Returns the current record's "ca_usueliminado" value
 * @method timestamp getCaFcheliminado()    Returns the current record's "ca_fcheliminado" value
 * @method integer   getCaIdmodo()          Returns the current record's "ca_idmodo" value
 * @method Usuario   getUsuCreado()         Returns the current record's "UsuCreado" value
 * @method Usuario   getUsuActualizado()    Returns the current record's "UsuActualizado" value
 * @method Series    getSeries()            Returns the current record's "Series" value
 * @method Modo      getModo()              Returns the current record's "Modo" value
 * @method Series    setCaIdsserie()        Sets the current record's "ca_idsserie" value
 * @method Series    setCaIdpadre()         Sets the current record's "ca_idpadre" value
 * @method Series    setCaNombre()          Sets the current record's "ca_nombre" value
 * @method Series    setCaGrupo()           Sets the current record's "ca_grupo" value
 * @method Series    setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method Series    setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method Series    setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method Series    setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method Series    setCaUsueliminado()    Sets the current record's "ca_usueliminado" value
 * @method Series    setCaFcheliminado()    Sets the current record's "ca_fcheliminado" value
 * @method Series    setCaIdmodo()          Sets the current record's "ca_idmodo" value
 * @method Series    setUsuCreado()         Sets the current record's "UsuCreado" value
 * @method Series    setUsuActualizado()    Sets the current record's "UsuActualizado" value
 * @method Series    setSeries()            Sets the current record's "Series" value
 * @method Series    setModo()              Sets the current record's "Modo" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseSeries extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('docs.tb_sseries');
        $this->hasColumn('ca_idsserie', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idpadre', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_nombre', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_grupo', 'string', null, array(
             'type' => 'string',
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
        $this->hasColumn('ca_usueliminado', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_fcheliminado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_idmodo', 'integer', null, array(
             'type' => 'integer',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Usuario as UsuCreado', array(
             'local' => 'ca_usucreado',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as UsuActualizado', array(
             'local' => 'ca_usuactualizado',
             'foreign' => 'ca_login'));

        $this->hasOne('Series', array(
             'local' => 'ca_idpadre',
             'foreign' => 'ca_idsserie'));

        $this->hasOne('Modo', array(
             'local' => 'ca_idmodo',
             'foreign' => 'ca_idmodo'));
    }
}