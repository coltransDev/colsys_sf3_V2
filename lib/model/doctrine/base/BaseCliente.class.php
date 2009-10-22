<?php

/**
 * BaseCliente
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idcliente
 * @property integer $ca_digito
 * @property string $ca_compania
 * @property string $ca_papellido
 * @property string $ca_sapellido
 * @property string $ca_nombres
 * @property string $ca_saludo
 * @property string $ca_sexo
 * @property string $ca_cumpleanos
 * @property string $ca_oficina
 * @property string $ca_email
 * @property string $ca_vendedor
 * @property string $ca_coordinador
 * @property string $ca_direccion
 * @property string $ca_torre
 * @property string $ca_bloque
 * @property string $ca_interior
 * @property string $ca_localidad
 * @property string $ca_complemento
 * @property string $ca_telefonos
 * @property string $ca_fax
 * @property string $ca_preferencias
 * @property string $ca_confirmar
 * @property string $ca_idciudad
 * @property string $ca_idgrupo
 * @property string $ca_listaclinton
 * @property date $ca_fchcircular
 * @property string $ca_status
 * @property Doctrine_Collection $Contacto
 * @property Usuario $Usuario
 * @property Ciudad $Ciudad
 * @property Doctrine_Collection $InoCliente
 * @property Doctrine_Collection $InoClientesSea
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6508 2009-10-14 06:28:49Z jwage $
 */
abstract class BaseCliente extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_clientes');
        $this->hasColumn('ca_idcliente', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_digito', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_compania', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_papellido', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_sapellido', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_nombres', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_saludo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_sexo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_cumpleanos', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_oficina', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_email', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_vendedor', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_coordinador', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_direccion', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_torre', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_bloque', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_interior', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_localidad', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_complemento', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_telefonos', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fax', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_preferencias', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_confirmar', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idciudad', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idgrupo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_listaclinton', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchcircular', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_status', 'string', null, array(
             'type' => 'string',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Contacto', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idcliente'));

        $this->hasOne('Usuario', array(
             'local' => 'ca_vendedor',
             'foreign' => 'ca_login'));

        $this->hasOne('Ciudad', array(
             'local' => 'ca_idciudad',
             'foreign' => 'ca_idciudad'));

        $this->hasMany('InoCliente', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idcliente'));

        $this->hasMany('InoClientesSea', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idcliente'));
    }
}