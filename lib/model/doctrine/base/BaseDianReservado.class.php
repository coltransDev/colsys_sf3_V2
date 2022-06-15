<?php

/**
 * BaseDianReservado
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_numero_resv
 * @property numeric $ca_anno
 * @property numeric $ca_numenvio
 * @property timestamp $ca_fchreservado
 * @property string $ca_usureservado
 * 
 * @method integer       getCaNumeroResv()    Returns the current record's "ca_numero_resv" value
 * @method numeric       getCaAnno()          Returns the current record's "ca_anno" value
 * @method numeric       getCaNumenvio()      Returns the current record's "ca_numenvio" value
 * @method timestamp     getCaFchreservado()  Returns the current record's "ca_fchreservado" value
 * @method string        getCaUsureservado()  Returns the current record's "ca_usureservado" value
 * @method DianReservado setCaNumeroResv()    Sets the current record's "ca_numero_resv" value
 * @method DianReservado setCaAnno()          Sets the current record's "ca_anno" value
 * @method DianReservado setCaNumenvio()      Sets the current record's "ca_numenvio" value
 * @method DianReservado setCaFchreservado()  Sets the current record's "ca_fchreservado" value
 * @method DianReservado setCaUsureservado()  Sets the current record's "ca_usureservado" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseDianReservado extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_dianreservados');
        $this->hasColumn('ca_numero_resv', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_anno', 'numeric', null, array(
             'type' => 'numeric',
             ));
        $this->hasColumn('ca_numenvio', 'numeric', null, array(
             'type' => 'numeric',
             ));
        $this->hasColumn('ca_fchreservado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usureservado', 'string', 20, array(
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
        
    }
}