<?php

/**
 * BaseNotTarea
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idtarea
 * @property integer $ca_idlistatarea
 * @property string $ca_url
 * @property string $ca_titulo
 * @property string $ca_texto
 * @property timestamp $ca_fchvisible
 * @property timestamp $ca_fchvencimiento
 * @property timestamp $ca_fchterminada
 * @property string $ca_usuterminada
 * @property integer $ca_prioridad
 * @property string $ca_notificar
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property string $ca_observaciones
 * @property Doctrine_Collection $Notificacion
 * @property NotListaTareas $NotListaTareas
 * @property Doctrine_Collection $RepAsignacion
 * @property Reporte $Reporte
 * @property Doctrine_Collection $Cotizacion
 * @property Doctrine_Collection $CotProducto
 * @property Doctrine_Collection $HdeskTicket
 * @property Doctrine_Collection $NotTareaAsignacion
 * 
 * @method integer             getCaIdtarea()          Returns the current record's "ca_idtarea" value
 * @method integer             getCaIdlistatarea()     Returns the current record's "ca_idlistatarea" value
 * @method string              getCaUrl()              Returns the current record's "ca_url" value
 * @method string              getCaTitulo()           Returns the current record's "ca_titulo" value
 * @method string              getCaTexto()            Returns the current record's "ca_texto" value
 * @method timestamp           getCaFchvisible()       Returns the current record's "ca_fchvisible" value
 * @method timestamp           getCaFchvencimiento()   Returns the current record's "ca_fchvencimiento" value
 * @method timestamp           getCaFchterminada()     Returns the current record's "ca_fchterminada" value
 * @method string              getCaUsuterminada()     Returns the current record's "ca_usuterminada" value
 * @method integer             getCaPrioridad()        Returns the current record's "ca_prioridad" value
 * @method string              getCaNotificar()        Returns the current record's "ca_notificar" value
 * @method timestamp           getCaFchcreado()        Returns the current record's "ca_fchcreado" value
 * @method string              getCaUsucreado()        Returns the current record's "ca_usucreado" value
 * @method string              getCaObservaciones()    Returns the current record's "ca_observaciones" value
 * @method Doctrine_Collection getNotificacion()       Returns the current record's "Notificacion" collection
 * @method NotListaTareas      getNotListaTareas()     Returns the current record's "NotListaTareas" value
 * @method Doctrine_Collection getRepAsignacion()      Returns the current record's "RepAsignacion" collection
 * @method Reporte             getReporte()            Returns the current record's "Reporte" value
 * @method Doctrine_Collection getCotizacion()         Returns the current record's "Cotizacion" collection
 * @method Doctrine_Collection getCotProducto()        Returns the current record's "CotProducto" collection
 * @method Doctrine_Collection getHdeskTicket()        Returns the current record's "HdeskTicket" collection
 * @method Doctrine_Collection getNotTareaAsignacion() Returns the current record's "NotTareaAsignacion" collection
 * @method NotTarea            setCaIdtarea()          Sets the current record's "ca_idtarea" value
 * @method NotTarea            setCaIdlistatarea()     Sets the current record's "ca_idlistatarea" value
 * @method NotTarea            setCaUrl()              Sets the current record's "ca_url" value
 * @method NotTarea            setCaTitulo()           Sets the current record's "ca_titulo" value
 * @method NotTarea            setCaTexto()            Sets the current record's "ca_texto" value
 * @method NotTarea            setCaFchvisible()       Sets the current record's "ca_fchvisible" value
 * @method NotTarea            setCaFchvencimiento()   Sets the current record's "ca_fchvencimiento" value
 * @method NotTarea            setCaFchterminada()     Sets the current record's "ca_fchterminada" value
 * @method NotTarea            setCaUsuterminada()     Sets the current record's "ca_usuterminada" value
 * @method NotTarea            setCaPrioridad()        Sets the current record's "ca_prioridad" value
 * @method NotTarea            setCaNotificar()        Sets the current record's "ca_notificar" value
 * @method NotTarea            setCaFchcreado()        Sets the current record's "ca_fchcreado" value
 * @method NotTarea            setCaUsucreado()        Sets the current record's "ca_usucreado" value
 * @method NotTarea            setCaObservaciones()    Sets the current record's "ca_observaciones" value
 * @method NotTarea            setNotificacion()       Sets the current record's "Notificacion" collection
 * @method NotTarea            setNotListaTareas()     Sets the current record's "NotListaTareas" value
 * @method NotTarea            setRepAsignacion()      Sets the current record's "RepAsignacion" collection
 * @method NotTarea            setReporte()            Sets the current record's "Reporte" value
 * @method NotTarea            setCotizacion()         Sets the current record's "Cotizacion" collection
 * @method NotTarea            setCotProducto()        Sets the current record's "CotProducto" collection
 * @method NotTarea            setHdeskTicket()        Sets the current record's "HdeskTicket" collection
 * @method NotTarea            setNotTareaAsignacion() Sets the current record's "NotTareaAsignacion" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseNotTarea extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('notificaciones.tb_tareas');
        $this->hasColumn('ca_idtarea', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idlistatarea', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_url', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_titulo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_texto', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchvisible', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_fchvencimiento', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_fchterminada', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuterminada', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_prioridad', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_notificar', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usucreado', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_observaciones', 'string', null, array(
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
        $this->hasMany('Notificacion', array(
             'local' => 'ca_idtarea',
             'foreign' => 'ca_idtarea'));

        $this->hasOne('NotListaTareas', array(
             'local' => 'ca_idlistatarea',
             'foreign' => 'ca_idlistatarea'));

        $this->hasMany('RepAsignacion', array(
             'local' => 'ca_idtarea',
             'foreign' => 'ca_idtarea'));

        $this->hasOne('Reporte', array(
             'local' => 'ca_idtarea',
             'foreign' => 'ca_idseguimiento'));

        $this->hasMany('Cotizacion', array(
             'local' => 'ca_idtarea',
             'foreign' => 'ca_idtarea'));

        $this->hasMany('CotProducto', array(
             'local' => 'ca_idtarea',
             'foreign' => 'ca_idtarea'));

        $this->hasMany('HdeskTicket', array(
             'local' => 'ca_idtarea',
             'foreign' => 'ca_idtarea'));

        $this->hasMany('NotTareaAsignacion', array(
             'local' => 'ca_idtarea',
             'foreign' => 'ca_idtarea'));
    }
}