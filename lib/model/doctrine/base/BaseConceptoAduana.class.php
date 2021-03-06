<?php

/**
 * BaseConceptoAduana
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_consecutivo
 * @property integer $ca_idconcepto
 * @property numeric $ca_valor
 * @property string $ca_aplicacion
 * @property numeric $ca_valorminimo
 * @property string $ca_parametro
 * @property string $ca_aplicacionminimo
 * @property date $ca_fchini
 * @property date $ca_fchfin
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fcheliminado
 * @property string $ca_observaciones
 * @property Costo $Costo
 * 
 * @method integer        getCaConsecutivo()       Returns the current record's "ca_consecutivo" value
 * @method integer        getCaIdconcepto()        Returns the current record's "ca_idconcepto" value
 * @method numeric        getCaValor()             Returns the current record's "ca_valor" value
 * @method string         getCaAplicacion()        Returns the current record's "ca_aplicacion" value
 * @method numeric        getCaValorminimo()       Returns the current record's "ca_valorminimo" value
 * @method string         getCaParametro()         Returns the current record's "ca_parametro" value
 * @method string         getCaAplicacionminimo()  Returns the current record's "ca_aplicacionminimo" value
 * @method date           getCaFchini()            Returns the current record's "ca_fchini" value
 * @method date           getCaFchfin()            Returns the current record's "ca_fchfin" value
 * @method timestamp      getCaFchcreado()         Returns the current record's "ca_fchcreado" value
 * @method string         getCaUsucreado()         Returns the current record's "ca_usucreado" value
 * @method timestamp      getCaFcheliminado()      Returns the current record's "ca_fcheliminado" value
 * @method string         getCaObservaciones()     Returns the current record's "ca_observaciones" value
 * @method Costo          getCosto()               Returns the current record's "Costo" value
 * @method ConceptoAduana setCaConsecutivo()       Sets the current record's "ca_consecutivo" value
 * @method ConceptoAduana setCaIdconcepto()        Sets the current record's "ca_idconcepto" value
 * @method ConceptoAduana setCaValor()             Sets the current record's "ca_valor" value
 * @method ConceptoAduana setCaAplicacion()        Sets the current record's "ca_aplicacion" value
 * @method ConceptoAduana setCaValorminimo()       Sets the current record's "ca_valorminimo" value
 * @method ConceptoAduana setCaParametro()         Sets the current record's "ca_parametro" value
 * @method ConceptoAduana setCaAplicacionminimo()  Sets the current record's "ca_aplicacionminimo" value
 * @method ConceptoAduana setCaFchini()            Sets the current record's "ca_fchini" value
 * @method ConceptoAduana setCaFchfin()            Sets the current record's "ca_fchfin" value
 * @method ConceptoAduana setCaFchcreado()         Sets the current record's "ca_fchcreado" value
 * @method ConceptoAduana setCaUsucreado()         Sets the current record's "ca_usucreado" value
 * @method ConceptoAduana setCaFcheliminado()      Sets the current record's "ca_fcheliminado" value
 * @method ConceptoAduana setCaObservaciones()     Sets the current record's "ca_observaciones" value
 * @method ConceptoAduana setCosto()               Sets the current record's "Costo" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseConceptoAduana extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('pric.tb_conceptoaduana');
        $this->hasColumn('ca_consecutivo', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idconcepto', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('ca_valor', 'numeric', null, array(
             'type' => 'numeric',
             'notnull' => true,
             ));
        $this->hasColumn('ca_aplicacion', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('ca_valorminimo', 'numeric', null, array(
             'type' => 'numeric',
             'notnull' => true,
             ));
        $this->hasColumn('ca_parametro', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('ca_aplicacionminimo', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('ca_fchini', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_fchfin', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usucreado', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fcheliminado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_observaciones', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));


        $this->setAttribute(Doctrine_Core::ATTR_EXPORT, Doctrine_Core::EXPORT_TABLES);

        $this->option('symfony', array(
             'form' => true,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Costo', array(
             'local' => 'ca_idconcepto',
             'foreign' => 'ca_idcosto'));
    }
}