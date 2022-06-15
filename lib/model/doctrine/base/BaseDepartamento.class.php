<?php

/**
 * BaseDepartamento
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_iddepartamento
 * @property string $ca_nombre
 * @property boolean $ca_inhelpdesk
 * @property string $ca_idempresa
 * @property integer $ca_idsap
 * @property Doctrine_Collection $HdeskGroup
 * @property Empresa $Empresa
 * @property Doctrine_Collection $Usuario
 * @property Doctrine_Collection $HdeskDepartamentClasification
 * @property Doctrine_Collection $Idg
 * @property Doctrine_Collection $IdgProcesos
 * @property Doctrine_Collection $IntranetVideo
 * 
 * @method integer             getCaIddepartamento()              Returns the current record's "ca_iddepartamento" value
 * @method string              getCaNombre()                      Returns the current record's "ca_nombre" value
 * @method boolean             getCaInhelpdesk()                  Returns the current record's "ca_inhelpdesk" value
 * @method string              getCaIdempresa()                   Returns the current record's "ca_idempresa" value
 * @method integer             getCaIdsap()                       Returns the current record's "ca_idsap" value
 * @method Doctrine_Collection getHdeskGroup()                    Returns the current record's "HdeskGroup" collection
 * @method Empresa             getEmpresa()                       Returns the current record's "Empresa" value
 * @method Doctrine_Collection getUsuario()                       Returns the current record's "Usuario" collection
 * @method Doctrine_Collection getHdeskDepartamentClasification() Returns the current record's "HdeskDepartamentClasification" collection
 * @method Doctrine_Collection getIdg()                           Returns the current record's "Idg" collection
 * @method Doctrine_Collection getIdgProcesos()                   Returns the current record's "IdgProcesos" collection
 * @method Doctrine_Collection getIntranetVideo()                 Returns the current record's "IntranetVideo" collection
 * @method Departamento        setCaIddepartamento()              Sets the current record's "ca_iddepartamento" value
 * @method Departamento        setCaNombre()                      Sets the current record's "ca_nombre" value
 * @method Departamento        setCaInhelpdesk()                  Sets the current record's "ca_inhelpdesk" value
 * @method Departamento        setCaIdempresa()                   Sets the current record's "ca_idempresa" value
 * @method Departamento        setCaIdsap()                       Sets the current record's "ca_idsap" value
 * @method Departamento        setHdeskGroup()                    Sets the current record's "HdeskGroup" collection
 * @method Departamento        setEmpresa()                       Sets the current record's "Empresa" value
 * @method Departamento        setUsuario()                       Sets the current record's "Usuario" collection
 * @method Departamento        setHdeskDepartamentClasification() Sets the current record's "HdeskDepartamentClasification" collection
 * @method Departamento        setIdg()                           Sets the current record's "Idg" collection
 * @method Departamento        setIdgProcesos()                   Sets the current record's "IdgProcesos" collection
 * @method Departamento        setIntranetVideo()                 Sets the current record's "IntranetVideo" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseDepartamento extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('control.tb_departamentos');
        $this->hasColumn('ca_iddepartamento', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_nombre', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             ));
        $this->hasColumn('ca_inhelpdesk', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_idempresa', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idsap', 'integer', null, array(
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
        $this->hasMany('HdeskGroup', array(
             'local' => 'ca_iddepartamento',
             'foreign' => 'ca_iddepartament',
             'orderBy' => 'ca_name ASC'));

        $this->hasOne('Empresa', array(
             'local' => 'ca_idempresa',
             'foreign' => 'ca_idempresa'));

        $this->hasMany('Usuario', array(
             'local' => 'ca_nombre',
             'foreign' => 'ca_departamento'));

        $this->hasMany('HdeskDepartamentClasification', array(
             'local' => 'ca_iddepartamento',
             'foreign' => 'ca_iddepartament'));

        $this->hasMany('Idg', array(
             'local' => 'ca_iddepartamento',
             'foreign' => 'ca_iddepartamento'));

        $this->hasMany('IdgProcesos', array(
             'local' => 'ca_iddepartamento',
             'foreign' => 'ca_iddepartamento'));

        $this->hasMany('IntranetVideo', array(
             'local' => 'ca_iddepartmento',
             'foreign' => 'ca_iddepartment'));
    }
}