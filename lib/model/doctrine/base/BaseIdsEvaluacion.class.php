<?php

/**
 * BaseIdsEvaluacion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idevaluacion
 * @property integer $ca_id
 * @property string $ca_tipo
 * @property string $ca_concepto
 * @property date $ca_fchevaluacion
 * @property string $ca_usucreado
 * @property timestamp $ca_fchcreado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchactualizado
 * @property Ids $Ids
 * @property Doctrine_Collection $IdsEvaluacionxCriterio
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6365 2009-09-15 18:22:38Z jwage $
 */
abstract class BaseIdsEvaluacion extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ids.tb_evaluacion');
        $this->hasColumn('ca_idevaluacion', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_tipo', 'string', 15, array(
             'type' => 'string',
             'length' => '15',
             ));
        $this->hasColumn('ca_concepto', 'string', 15, array(
             'type' => 'string',
             'length' => '15',
             ));
        $this->hasColumn('ca_fchevaluacion', 'date', null, array(
             'type' => 'date',
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
    }

    public function setUp()
    {
        parent::setUp();
    $this->hasOne('Ids', array(
             'local' => 'ca_id',
             'foreign' => 'ca_id'));

        $this->hasMany('IdsEvaluacionxCriterio', array(
             'local' => 'ca_idevaluacion',
             'foreign' => 'ca_idevaluacion'));
    }
}