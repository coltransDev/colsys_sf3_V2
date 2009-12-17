<?php

/**
 * BaseInoConcepto
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idconcepto
 * @property string $ca_concepto
 * @property string $ca_tipo
 * @property integer $ca_liminferior
 * @property boolean $ca_flete
 * @property boolean $ca_recargolocal
 * @property boolean $ca_recargoorigen
 * @property boolean $ca_recargootmdta
 * @property boolean $ca_costo
 * @property Doctrine_Collection $InoConceptoModalidad
 * @property Doctrine_Collection $InoParametroFacturacion
 * @property Doctrine_Collection $InoParametroCosto
 * @property Doctrine_Collection $InoTransaccion
 * 
 * @method integer             getCaIdconcepto()            Returns the current record's "ca_idconcepto" value
 * @method string              getCaConcepto()              Returns the current record's "ca_concepto" value
 * @method string              getCaTipo()                  Returns the current record's "ca_tipo" value
 * @method integer             getCaLiminferior()           Returns the current record's "ca_liminferior" value
 * @method boolean             getCaFlete()                 Returns the current record's "ca_flete" value
 * @method boolean             getCaRecargolocal()          Returns the current record's "ca_recargolocal" value
 * @method boolean             getCaRecargoorigen()         Returns the current record's "ca_recargoorigen" value
 * @method boolean             getCaRecargootmdta()         Returns the current record's "ca_recargootmdta" value
 * @method boolean             getCaCosto()                 Returns the current record's "ca_costo" value
 * @method Doctrine_Collection getInoConceptoModalidad()    Returns the current record's "InoConceptoModalidad" collection
 * @method Doctrine_Collection getInoParametroFacturacion() Returns the current record's "InoParametroFacturacion" collection
 * @method Doctrine_Collection getInoParametroCosto()       Returns the current record's "InoParametroCosto" collection
 * @method Doctrine_Collection getInoTransaccion()          Returns the current record's "InoTransaccion" collection
 * @method InoConcepto         setCaIdconcepto()            Sets the current record's "ca_idconcepto" value
 * @method InoConcepto         setCaConcepto()              Sets the current record's "ca_concepto" value
 * @method InoConcepto         setCaTipo()                  Sets the current record's "ca_tipo" value
 * @method InoConcepto         setCaLiminferior()           Sets the current record's "ca_liminferior" value
 * @method InoConcepto         setCaFlete()                 Sets the current record's "ca_flete" value
 * @method InoConcepto         setCaRecargolocal()          Sets the current record's "ca_recargolocal" value
 * @method InoConcepto         setCaRecargoorigen()         Sets the current record's "ca_recargoorigen" value
 * @method InoConcepto         setCaRecargootmdta()         Sets the current record's "ca_recargootmdta" value
 * @method InoConcepto         setCaCosto()                 Sets the current record's "ca_costo" value
 * @method InoConcepto         setInoConceptoModalidad()    Sets the current record's "InoConceptoModalidad" collection
 * @method InoConcepto         setInoParametroFacturacion() Sets the current record's "InoParametroFacturacion" collection
 * @method InoConcepto         setInoParametroCosto()       Sets the current record's "InoParametroCosto" collection
 * @method InoConcepto         setInoTransaccion()          Sets the current record's "InoTransaccion" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseInoConcepto extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ino.tb_conceptos');
        $this->hasColumn('ca_idconcepto', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_concepto', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('ca_tipo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_liminferior', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_flete', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_recargolocal', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_recargoorigen', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_recargootmdta', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_costo', 'boolean', null, array(
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
        $this->hasMany('InoConceptoModalidad', array(
             'local' => 'ca_idconcepto',
             'foreign' => 'ca_idconcepto'));

        $this->hasMany('InoParametroFacturacion', array(
             'local' => 'ca_idconcepto',
             'foreign' => 'ca_idconcepto'));

        $this->hasMany('InoParametroCosto', array(
             'local' => 'ca_idconcepto',
             'foreign' => 'ca_idconcepto'));

        $this->hasMany('InoTransaccion', array(
             'local' => 'ca_idconcepto',
             'foreign' => 'ca_idconcepto'));
    }
}