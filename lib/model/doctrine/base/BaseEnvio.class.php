<?php

/**
 * BaseEnvio
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idenvio
 * @property integer $ca_idcomunicado
 * @property integer $ca_id
 * @property integer $ca_idcontacto
 * @property integer $ca_idemail
 * @property boolean $ca_conf
 * @property timestamp $ca_fchconf
 * @property boolean $ca_test
 * @property text $ca_observaciones
 * @property Doctrine_Collection $Comunicado
 * @property Email $Email
 * @property Contacto $Contacto
 * @property Contacto $IdsContacto
 * 
 * @method integer             getCaIdenvio()        Returns the current record's "ca_idenvio" value
 * @method integer             getCaIdcomunicado()   Returns the current record's "ca_idcomunicado" value
 * @method integer             getCaId()             Returns the current record's "ca_id" value
 * @method integer             getCaIdcontacto()     Returns the current record's "ca_idcontacto" value
 * @method integer             getCaIdemail()        Returns the current record's "ca_idemail" value
 * @method boolean             getCaConf()           Returns the current record's "ca_conf" value
 * @method timestamp           getCaFchconf()        Returns the current record's "ca_fchconf" value
 * @method boolean             getCaTest()           Returns the current record's "ca_test" value
 * @method text                getCaObservaciones()  Returns the current record's "ca_observaciones" value
 * @method Doctrine_Collection getComunicado()       Returns the current record's "Comunicado" collection
 * @method Email               getEmail()            Returns the current record's "Email" value
 * @method Contacto            getContacto()         Returns the current record's "Contacto" value
 * @method IdsContacto         getIdsContacto()      Returns the current record's "IdsContacto" value
 * @method Envio               setCaIdenvio()        Sets the current record's "ca_idenvio" value
 * @method Envio               setCaIdcomunicado()   Sets the current record's "ca_idcomunicado" value
 * @method Envio               setCaId()             Sets the current record's "ca_id" value
 * @method Envio               setCaIdcontacto()     Sets the current record's "ca_idcontacto" value
 * @method Envio               setCaIdemail()        Sets the current record's "ca_idemail" value
 * @method Envio               setCaConf()           Sets the current record's "ca_conf" value
 * @method Envio               setCaFchconf()        Sets the current record's "ca_fchconf" value
 * @method Envio               setCaTest()           Sets the current record's "ca_test" value
 * @method Envio               setCaObservaciones()  Sets the current record's "ca_observaciones" value
 * @method Envio               setComunicado()       Sets the current record's "Comunicado" collection
 * @method Envio               setEmail()            Sets the current record's "Email" value
 * @method Envio               setContacto()         Sets the current record's "Contacto" value
 * @method Envio               setIdsContacto()      Sets the current record's "IdsContacto" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseEnvio extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('comunicaciones.tb_envios');
        $this->hasColumn('ca_idenvio', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idcomunicado', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idcontacto', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idemail', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_conf', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_fchconf', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_test', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_observaciones', 'text', null, array(
             'type' => 'text',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Comunicado', array(
             'local' => 'ca_idcomunicado',
             'foreign' => 'ca_idcomunicado'));

        $this->hasOne('Email', array(
             'local' => 'ca_idemail',
             'foreign' => 'ca_idemail'));

        $this->hasOne('Contacto', array(
             'local' => 'ca_idcontacto',
             'foreign' => 'ca_idcontacto'));

        $this->hasOne('IdsContacto', array(
             'local' => 'ca_idcontacto',
             'foreign' => 'ca_idcontacto'));
    }
}