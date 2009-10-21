<?php

/**
 * BaseCotizacion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idcotizacion
 * @property integer $ca_idcontacto
 * @property string $ca_consecutivo
 * @property string $ca_saludo
 * @property string $ca_asunto
 * @property string $ca_entrada
 * @property string $ca_despedida
 * @property string $ca_anexos
 * @property string $ca_usuario
 * @property string $ca_empresa
 * @property string $ca_fuente
 * @property integer $ca_idg_envio_oportuno
 * @property string $ca_usucreado
 * @property timestamp $ca_fchcreado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuanulado
 * @property timestamp $ca_fchanulado
 * @property Usuario $Usuario
 * @property Contacto $Contacto
 * @property NotTarea $NotTarea
 * @property Doctrine_Collection $CotProducto
 * @property Doctrine_Collection $CotContinuacion
 * @property Doctrine_Collection $CotSeguro
 * @property Doctrine_Collection $CotContactoAg
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6365 2009-09-15 18:22:38Z jwage $
 */
abstract class BaseCotizacion extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_cotizaciones');
        $this->hasColumn('ca_idcotizacion', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idcontacto', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_consecutivo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_saludo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_asunto', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_entrada', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_despedida', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_anexos', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_usuario', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_empresa', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fuente', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idg_envio_oportuno', 'integer', null, array(
             'type' => 'integer',
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
        $this->hasColumn('ca_usuanulado', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_fchanulado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));


        $this->setAttribute(Doctrine::ATTR_EXPORT, Doctrine::EXPORT_TABLES);
    }

    public function setUp()
    {
        parent::setUp();
    $this->hasOne('Usuario', array(
             'local' => 'ca_usuario',
             'foreign' => 'ca_login'));

        $this->hasOne('Contacto', array(
             'local' => 'ca_idcontacto',
             'foreign' => 'ca_idcontacto'));

        $this->hasOne('NotTarea', array(
             'local' => 'ca_idg_envio_oportuno',
             'foreign' => 'ca_idtarea'));

        $this->hasMany('CotProducto', array(
             'local' => 'ca_idcotizacion',
             'foreign' => 'ca_idcotizacion'));

        $this->hasMany('CotContinuacion', array(
             'local' => 'ca_idcotizacion',
             'foreign' => 'ca_idcotizacion'));

        $this->hasMany('CotSeguro', array(
             'local' => 'ca_idcotizacion',
             'foreign' => 'ca_idcotizacion'));

        $this->hasMany('CotContactoAg', array(
             'local' => 'ca_idcotizacion',
             'foreign' => 'ca_idcotizacion'));
    }
}