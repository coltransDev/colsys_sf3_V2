<?php

/**
 * BaseEnviosComunicacion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idenviocomunicacion
 * @property integer $ca_idcomunicado
 * @property string $ca_email
 * @property integer $ca_idemail
 * @property string $ca_nombrecontacto
 * @property string $ca_empresacontacto
 * @property string $ca_usucreado
 * @property timestamp $ca_fchcreado
 * @property timestamp $ca_fchenvio
 * @property Doctrine_Collection $Comunicado
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseEnviosComunicacion extends MyDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('comunicaciones.tb_envioscomunicacion');
        $this->hasColumn('ca_idenviocomunicacion', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idcomunicado', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idcontacto', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idcliente', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_email', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('ca_idemail', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_nombrecontacto', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('ca_empresacontacto', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('ca_usucreado', 'string', 15, array(
             'type' => 'string',
             'length' => '15',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_fchenvio', 'timestamp', null, array(
             'type' => 'timestamp',
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

    }
}