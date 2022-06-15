<?php

/**
 * BaseDirectorio
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_id
 * @property string $ca_callfrom
 * @property string $ca_callto
 * @property string $ca_phoneip
 * 
 * @method integer    getCaId()        Returns the current record's "ca_id" value
 * @method string     getCaCallfrom()  Returns the current record's "ca_callfrom" value
 * @method string     getCaCallto()    Returns the current record's "ca_callto" value
 * @method string     getCaPhoneip()   Returns the current record's "ca_phoneip" value
 * @method Directorio setCaId()        Sets the current record's "ca_id" value
 * @method Directorio setCaCallfrom()  Sets the current record's "ca_callfrom" value
 * @method Directorio setCaCallto()    Sets the current record's "ca_callto" value
 * @method Directorio setCaPhoneip()   Sets the current record's "ca_phoneip" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseDirectorio extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('control.tb_directorio');
        $this->hasColumn('ca_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_callfrom', 'string', 3, array(
             'type' => 'string',
             'length' => '3',
             ));
        $this->hasColumn('ca_callto', 'string', 3, array(
             'type' => 'string',
             'length' => '3',
             ));
        $this->hasColumn('ca_phoneip', 'string', 15, array(
             'type' => 'string',
             'length' => '15',
             ));

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