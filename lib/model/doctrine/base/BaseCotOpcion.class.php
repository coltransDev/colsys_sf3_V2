<?php

/**
 * BaseCotOpcion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idopcion
 * @property integer $ca_idproducto
 * @property integer $ca_idcotizacion
 * @property integer $ca_idconcepto
 * @property decimal $ca_valor_tar
 * @property string $ca_aplica_tar
 * @property decimal $ca_valor_min
 * @property string $ca_aplica_min
 * @property string $ca_idmoneda
 * @property string $ca_observaciones
 * @property integer $ca_consecutivo
 * @property string $ca_usucreado
 * @property timestamp $ca_fchcreado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchactualizado
 * @property CotProducto $CotProducto
 * @property Concepto $Concepto
 * 
 * @method integer     getCaIdopcion()        Returns the current record's "ca_idopcion" value
 * @method integer     getCaIdproducto()      Returns the current record's "ca_idproducto" value
 * @method integer     getCaIdcotizacion()    Returns the current record's "ca_idcotizacion" value
 * @method integer     getCaIdconcepto()      Returns the current record's "ca_idconcepto" value
 * @method decimal     getCaValorTar()        Returns the current record's "ca_valor_tar" value
 * @method string      getCaAplicaTar()       Returns the current record's "ca_aplica_tar" value
 * @method decimal     getCaValorMin()        Returns the current record's "ca_valor_min" value
 * @method string      getCaAplicaMin()       Returns the current record's "ca_aplica_min" value
 * @method string      getCaIdmoneda()        Returns the current record's "ca_idmoneda" value
 * @method string      getCaObservaciones()   Returns the current record's "ca_observaciones" value
 * @method integer     getCaConsecutivo()     Returns the current record's "ca_consecutivo" value
 * @method string      getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp   getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string      getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method timestamp   getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method CotProducto getCotProducto()       Returns the current record's "CotProducto" value
 * @method Concepto    getConcepto()          Returns the current record's "Concepto" value
 * @method CotOpcion   setCaIdopcion()        Sets the current record's "ca_idopcion" value
 * @method CotOpcion   setCaIdproducto()      Sets the current record's "ca_idproducto" value
 * @method CotOpcion   setCaIdcotizacion()    Sets the current record's "ca_idcotizacion" value
 * @method CotOpcion   setCaIdconcepto()      Sets the current record's "ca_idconcepto" value
 * @method CotOpcion   setCaValorTar()        Sets the current record's "ca_valor_tar" value
 * @method CotOpcion   setCaAplicaTar()       Sets the current record's "ca_aplica_tar" value
 * @method CotOpcion   setCaValorMin()        Sets the current record's "ca_valor_min" value
 * @method CotOpcion   setCaAplicaMin()       Sets the current record's "ca_aplica_min" value
 * @method CotOpcion   setCaIdmoneda()        Sets the current record's "ca_idmoneda" value
 * @method CotOpcion   setCaObservaciones()   Sets the current record's "ca_observaciones" value
 * @method CotOpcion   setCaConsecutivo()     Sets the current record's "ca_consecutivo" value
 * @method CotOpcion   setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method CotOpcion   setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method CotOpcion   setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method CotOpcion   setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method CotOpcion   setCotProducto()       Sets the current record's "CotProducto" value
 * @method CotOpcion   setConcepto()          Sets the current record's "Concepto" value
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6508 2009-10-14 06:28:49Z jwage $
 */
abstract class BaseCotOpcion extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_cotopciones');
        $this->hasColumn('ca_idopcion', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idproducto', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idcotizacion', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idconcepto', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_valor_tar', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_aplica_tar', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_valor_min', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_aplica_min', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idmoneda', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_observaciones', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_consecutivo', 'integer', null, array(
             'type' => 'integer',
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


        $this->setAttribute(Doctrine_Core::ATTR_EXPORT, Doctrine_Core::EXPORT_TABLES);
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('CotProducto', array(
             'local' => 'ca_idproducto',
             'foreign' => 'ca_idproducto'));

        $this->hasOne('Concepto', array(
             'local' => 'ca_idconcepto',
             'foreign' => 'ca_idconcepto'));
    }
}