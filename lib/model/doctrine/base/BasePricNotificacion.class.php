<?php

/**
 * BasePricNotificacion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idnotificacion
 * @property string $ca_titulo
 * @property string $ca_mensaje
 * @property string $ca_caducidad
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * 
 * @method integer          getCaIdnotificacion()  Returns the current record's "ca_idnotificacion" value
 * @method string           getCaTitulo()          Returns the current record's "ca_titulo" value
 * @method string           getCaMensaje()         Returns the current record's "ca_mensaje" value
 * @method string           getCaCaducidad()       Returns the current record's "ca_caducidad" value
 * @method timestamp        getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string           getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method PricNotificacion setCaIdnotificacion()  Sets the current record's "ca_idnotificacion" value
 * @method PricNotificacion setCaTitulo()          Sets the current record's "ca_titulo" value
 * @method PricNotificacion setCaMensaje()         Sets the current record's "ca_mensaje" value
 * @method PricNotificacion setCaCaducidad()       Sets the current record's "ca_caducidad" value
 * @method PricNotificacion setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method PricNotificacion setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6716 2009-11-12 19:26:28Z jwage $
 */
abstract class BasePricNotificacion extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_pricnotificaciones');
        $this->hasColumn('ca_idnotificacion', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_titulo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_mensaje', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_caducidad', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usucreado', 'string', null, array(
             'type' => 'string',
             ));


        $this->setAttribute(Doctrine_Core::ATTR_EXPORT, Doctrine_Core::EXPORT_TABLES);

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}