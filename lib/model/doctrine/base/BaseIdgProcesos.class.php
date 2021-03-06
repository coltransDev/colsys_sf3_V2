<?php

/**
 * BaseIdgProcesos
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idproceso
 * @property string $ca_nombre
 * @property integer $ca_iddepartamento
 * @property string $ca_usuproceso
 * @property Doctrine_Collection $IdgRiesgos
 * @property Departamento $Departamento
 * @property Doctrine_Collection $Idg
 * @property Doctrine_Collection $IdgUsuProcesos
 * @property Doctrine_Collection $IdgVersion
 * 
 * @method integer             getCaIdproceso()       Returns the current record's "ca_idproceso" value
 * @method string              getCaNombre()          Returns the current record's "ca_nombre" value
 * @method integer             getCaIddepartamento()  Returns the current record's "ca_iddepartamento" value
 * @method string              getCaUsuproceso()      Returns the current record's "ca_usuproceso" value
 * @method Doctrine_Collection getIdgRiesgos()        Returns the current record's "IdgRiesgos" collection
 * @method Departamento        getDepartamento()      Returns the current record's "Departamento" value
 * @method Doctrine_Collection getIdg()               Returns the current record's "Idg" collection
 * @method Doctrine_Collection getIdgUsuProcesos()    Returns the current record's "IdgUsuProcesos" collection
 * @method Doctrine_Collection getIdgVersion()        Returns the current record's "IdgVersion" collection
 * @method IdgProcesos         setCaIdproceso()       Sets the current record's "ca_idproceso" value
 * @method IdgProcesos         setCaNombre()          Sets the current record's "ca_nombre" value
 * @method IdgProcesos         setCaIddepartamento()  Sets the current record's "ca_iddepartamento" value
 * @method IdgProcesos         setCaUsuproceso()      Sets the current record's "ca_usuproceso" value
 * @method IdgProcesos         setIdgRiesgos()        Sets the current record's "IdgRiesgos" collection
 * @method IdgProcesos         setDepartamento()      Sets the current record's "Departamento" value
 * @method IdgProcesos         setIdg()               Sets the current record's "Idg" collection
 * @method IdgProcesos         setIdgUsuProcesos()    Sets the current record's "IdgUsuProcesos" collection
 * @method IdgProcesos         setIdgVersion()        Sets the current record's "IdgVersion" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseIdgProcesos extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('idg.tb_procesos');
        $this->hasColumn('ca_idproceso', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_nombre', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             ));
        $this->hasColumn('ca_iddepartamento', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_usuproceso', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('IdgRiesgos', array(
             'local' => 'ca_idproceso',
             'foreign' => 'ca_idproceso'));

        $this->hasOne('Departamento', array(
             'local' => 'ca_iddepartamento',
             'foreign' => 'ca_iddepartamento'));

        $this->hasMany('Idg', array(
             'local' => 'ca_idproceso',
             'foreign' => 'ca_idproceso'));

        $this->hasMany('IdgUsuProcesos', array(
             'local' => 'ca_idproceso',
             'foreign' => 'ca_idproceso'));

        $this->hasMany('IdgVersion', array(
             'local' => 'ca_idproceso',
             'foreign' => 'ca_idproceso'));
    }
}