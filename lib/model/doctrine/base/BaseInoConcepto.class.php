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
 * @property string $ca_incoterms
 * @property booolean $ca_comisionable
 * @property integer $ca_cuenta
 * @property booolean $ca_ingreso_propio
 * @property decimal $ca_iva
 * @property decimal $ca_baseretencion
 * @property integer $ca_cuentaretencion
 * @property decimal $ca_valor
 * @property boolean $ca_convenios
 * @property decimal $ca_autoretencion
 * @property smallint $ca_tipoautoretencion
 * @property Doctrine_Collection $InoConceptoModalidad
 * 
 * @method integer             getCaIdconcepto()         Returns the current record's "ca_idconcepto" value
 * @method string              getCaConcepto()           Returns the current record's "ca_concepto" value
 * @method string              getCaTipo()               Returns the current record's "ca_tipo" value
 * @method integer             getCaLiminferior()        Returns the current record's "ca_liminferior" value
 * @method string              getCaIncoterms()          Returns the current record's "ca_incoterms" value
 * @method booolean            getCaComisionable()       Returns the current record's "ca_comisionable" value
 * @method integer             getCaCuenta()             Returns the current record's "ca_cuenta" value
 * @method booolean            getCaIngresoPropio()      Returns the current record's "ca_ingreso_propio" value
 * @method decimal             getCaIva()                Returns the current record's "ca_iva" value
 * @method decimal             getCaBaseretencion()      Returns the current record's "ca_baseretencion" value
 * @method integer             getCaCuentaretencion()    Returns the current record's "ca_cuentaretencion" value
 * @method decimal             getCaValor()              Returns the current record's "ca_valor" value
 * @method boolean             getCaConvenios()          Returns the current record's "ca_convenios" value
 * @method decimal             getCaAutoretencion()      Returns the current record's "ca_autoretencion" value
 * @method smallint            getCaTipoautoretencion()  Returns the current record's "ca_tipoautoretencion" value
 * @method Doctrine_Collection getInoConceptoModalidad() Returns the current record's "InoConceptoModalidad" collection
 * @method InoConcepto         setCaIdconcepto()         Sets the current record's "ca_idconcepto" value
 * @method InoConcepto         setCaConcepto()           Sets the current record's "ca_concepto" value
 * @method InoConcepto         setCaTipo()               Sets the current record's "ca_tipo" value
 * @method InoConcepto         setCaLiminferior()        Sets the current record's "ca_liminferior" value
 * @method InoConcepto         setCaIncoterms()          Sets the current record's "ca_incoterms" value
 * @method InoConcepto         setCaComisionable()       Sets the current record's "ca_comisionable" value
 * @method InoConcepto         setCaCuenta()             Sets the current record's "ca_cuenta" value
 * @method InoConcepto         setCaIngresoPropio()      Sets the current record's "ca_ingreso_propio" value
 * @method InoConcepto         setCaIva()                Sets the current record's "ca_iva" value
 * @method InoConcepto         setCaBaseretencion()      Sets the current record's "ca_baseretencion" value
 * @method InoConcepto         setCaCuentaretencion()    Sets the current record's "ca_cuentaretencion" value
 * @method InoConcepto         setCaValor()              Sets the current record's "ca_valor" value
 * @method InoConcepto         setCaConvenios()          Sets the current record's "ca_convenios" value
 * @method InoConcepto         setCaAutoretencion()      Sets the current record's "ca_autoretencion" value
 * @method InoConcepto         setCaTipoautoretencion()  Sets the current record's "ca_tipoautoretencion" value
 * @method InoConcepto         setInoConceptoModalidad() Sets the current record's "InoConceptoModalidad" collection
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6508 2009-10-14 06:28:49Z jwage $
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
        $this->hasColumn('ca_incoterms', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_comisionable', 'booolean', null, array(
             'type' => 'booolean',
             ));
        $this->hasColumn('ca_cuenta', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_ingreso_propio', 'booolean', null, array(
             'type' => 'booolean',
             ));
        $this->hasColumn('ca_iva', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_baseretencion', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_cuentaretencion', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_valor', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_convenios', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_autoretencion', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_tipoautoretencion', 'smallint', null, array(
             'type' => 'smallint',
             ));


        //$this->setAttribute(Doctrine_Core::ATTR_EXPORT, Doctrine_Core::EXPORT_TABLES);
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('InoConceptoModalidad', array(
             'local' => 'ca_idconcepto',
             'foreign' => 'ca_idconcepto'));
    }
}