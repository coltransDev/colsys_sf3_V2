<?php

/**
 * BaseNotTareaAsignacion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idtarea
 * @property string $ca_login
 * @property NotTarea $NotTarea
 * @property Usuario $Usuario
 * 
 * @method integer            getCaIdtarea()  Returns the current record's "ca_idtarea" value
 * @method string             getCaLogin()    Returns the current record's "ca_login" value
 * @method NotTarea           getNotTarea()   Returns the current record's "NotTarea" value
 * @method Usuario            getUsuario()    Returns the current record's "Usuario" value
 * @method NotTareaAsignacion setCaIdtarea()  Sets the current record's "ca_idtarea" value
 * @method NotTareaAsignacion setCaLogin()    Sets the current record's "ca_login" value
 * @method NotTareaAsignacion setNotTarea()   Sets the current record's "NotTarea" value
 * @method NotTareaAsignacion setUsuario()    Sets the current record's "Usuario" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseNotTareaAsignacion extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('notificaciones.tb_tareas_asignaciones');
        $this->hasColumn('ca_idtarea', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_login', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('NotTarea', array(
             'local' => 'ca_idtarea',
             'foreign' => 'ca_idtarea'));

        $this->hasOne('Usuario', array(
             'local' => 'ca_login',
             'foreign' => 'ca_login'));
    }
}