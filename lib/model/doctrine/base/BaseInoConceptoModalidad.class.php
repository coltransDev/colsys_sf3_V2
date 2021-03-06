<?php

/**
 * BaseInoConceptoModalidad
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idconcepto
 * @property integer $ca_idmodalidad
 * @property boolean $ca_comisionable
 * @property InoConcepto $InoConcepto
 * @property Modalidad $Modalidad
 * @property Doctrine_Collection $TipoRecargo
 * 
 * @method integer              getCaIdconcepto()    Returns the current record's "ca_idconcepto" value
 * @method integer              getCaIdmodalidad()   Returns the current record's "ca_idmodalidad" value
 * @method boolean              getCaComisionable()  Returns the current record's "ca_comisionable" value
 * @method InoConcepto          getInoConcepto()     Returns the current record's "InoConcepto" value
 * @method Modalidad            getModalidad()       Returns the current record's "Modalidad" value
 * @method Doctrine_Collection  getTipoRecargo()     Returns the current record's "TipoRecargo" collection
 * @method InoConceptoModalidad setCaIdconcepto()    Sets the current record's "ca_idconcepto" value
 * @method InoConceptoModalidad setCaIdmodalidad()   Sets the current record's "ca_idmodalidad" value
 * @method InoConceptoModalidad setCaComisionable()  Sets the current record's "ca_comisionable" value
 * @method InoConceptoModalidad setInoConcepto()     Sets the current record's "InoConcepto" value
 * @method InoConceptoModalidad setModalidad()       Sets the current record's "Modalidad" value
 * @method InoConceptoModalidad setTipoRecargo()     Sets the current record's "TipoRecargo" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseInoConceptoModalidad extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ino.tb_conceptos_modalidades');
        $this->hasColumn('ca_idconcepto', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_idmodalidad', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_comisionable', 'boolean', null, array(
             'type' => 'boolean',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('InoConcepto', array(
             'local' => 'ca_idconcepto',
             'foreign' => 'ca_idconcepto'));

        $this->hasOne('Modalidad', array(
             'local' => 'ca_idmodalidad',
             'foreign' => 'ca_idmodalidad'));

        $this->hasMany('TipoRecargo', array(
             'local' => 'ca_idconcepto',
             'foreign' => 'ca_idrecargo'));
    }
}