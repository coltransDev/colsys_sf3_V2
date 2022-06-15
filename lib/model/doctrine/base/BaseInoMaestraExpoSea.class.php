<?php

/**
 * BaseInoMaestraExpoSea
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $ca_referencia
 * @property integer $ca_idexpo
 * @property integer $ca_idnaviera
 * @property string $ca_modalidad
 * @property string $ca_hija
 * 
 * @method string            getCaReferencia()  Returns the current record's "ca_referencia" value
 * @method integer           getCaIdexpo()      Returns the current record's "ca_idexpo" value
 * @method integer           getCaIdnaviera()   Returns the current record's "ca_idnaviera" value
 * @method string            getCaModalidad()   Returns the current record's "ca_modalidad" value
 * @method string            getCaHija()        Returns the current record's "ca_hija" value
 * @method InoMaestraExpoSea setCaReferencia()  Sets the current record's "ca_referencia" value
 * @method InoMaestraExpoSea setCaIdexpo()      Sets the current record's "ca_idexpo" value
 * @method InoMaestraExpoSea setCaIdnaviera()   Sets the current record's "ca_idnaviera" value
 * @method InoMaestraExpoSea setCaModalidad()   Sets the current record's "ca_modalidad" value
 * @method InoMaestraExpoSea setCaHija()        Sets the current record's "ca_hija" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseInoMaestraExpoSea extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_expo_maritimo');
        $this->hasColumn('ca_referencia', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('ca_idexpo', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idnaviera', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_modalidad', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_hija', 'string', null, array(
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
        
    }
}