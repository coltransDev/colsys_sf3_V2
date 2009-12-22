<?php

/**
 * BaseFalaDeclaracionDts
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $ca_referencia
 * @property integer $ca_item
 * @property string $ca_subpartida
 * @property string $ca_mod
 * @property decimal $ca_cantidad
 * @property string $ca_unidad
 * @property decimal $ca_valor_fob
 * @property decimal $ca_gastos_despacho
 * @property decimal $ca_flete
 * @property decimal $ca_seguro
 * @property decimal $ca_gastos_embarque
 * @property decimal $ca_ajuste_valor
 * @property decimal $ca_valor_aduana
 * @property decimal $ca_arancel_porcntj
 * @property integer $ca_arancel
 * @property decimal $ca_iva_porctj
 * @property integer $ca_iva
 * @property decimal $ca_salvaguarda_porcntj
 * @property integer $ca_salvaguarda
 * @property decimal $ca_compensa_porcntj
 * @property integer $ca_compensa
 * @property decimal $ca_antidump_porcntj
 * @property integer $ca_antidump
 * @property integer $ca_sancion
 * @property integer $ca_rescate
 * @property decimal $ca_peso_bruto
 * @property decimal $ca_peso_neto
 * @property string $ca_usucreado
 * @property timestamp $ca_fchcreado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchactualizado
 * @property FalaDeclaracionImp $FalaDeclaracionImp
 * 
 * @method string             getCaReferencia()           Returns the current record's "ca_referencia" value
 * @method integer            getCaItem()                 Returns the current record's "ca_item" value
 * @method string             getCaSubpartida()           Returns the current record's "ca_subpartida" value
 * @method string             getCaMod()                  Returns the current record's "ca_mod" value
 * @method decimal            getCaCantidad()             Returns the current record's "ca_cantidad" value
 * @method string             getCaUnidad()               Returns the current record's "ca_unidad" value
 * @method decimal            getCaValorFob()             Returns the current record's "ca_valor_fob" value
 * @method decimal            getCaGastosDespacho()       Returns the current record's "ca_gastos_despacho" value
 * @method decimal            getCaFlete()                Returns the current record's "ca_flete" value
 * @method decimal            getCaSeguro()               Returns the current record's "ca_seguro" value
 * @method decimal            getCaGastosEmbarque()       Returns the current record's "ca_gastos_embarque" value
 * @method decimal            getCaAjusteValor()          Returns the current record's "ca_ajuste_valor" value
 * @method decimal            getCaValorAduana()          Returns the current record's "ca_valor_aduana" value
 * @method decimal            getCaArancelPorcntj()       Returns the current record's "ca_arancel_porcntj" value
 * @method integer            getCaArancel()              Returns the current record's "ca_arancel" value
 * @method decimal            getCaIvaPorctj()            Returns the current record's "ca_iva_porctj" value
 * @method integer            getCaIva()                  Returns the current record's "ca_iva" value
 * @method decimal            getCaSalvaguardaPorcntj()   Returns the current record's "ca_salvaguarda_porcntj" value
 * @method integer            getCaSalvaguarda()          Returns the current record's "ca_salvaguarda" value
 * @method decimal            getCaCompensaPorcntj()      Returns the current record's "ca_compensa_porcntj" value
 * @method integer            getCaCompensa()             Returns the current record's "ca_compensa" value
 * @method decimal            getCaAntidumpPorcntj()      Returns the current record's "ca_antidump_porcntj" value
 * @method integer            getCaAntidump()             Returns the current record's "ca_antidump" value
 * @method integer            getCaSancion()              Returns the current record's "ca_sancion" value
 * @method integer            getCaRescate()              Returns the current record's "ca_rescate" value
 * @method decimal            getCaPesoBruto()            Returns the current record's "ca_peso_bruto" value
 * @method decimal            getCaPesoNeto()             Returns the current record's "ca_peso_neto" value
 * @method string             getCaUsucreado()            Returns the current record's "ca_usucreado" value
 * @method timestamp          getCaFchcreado()            Returns the current record's "ca_fchcreado" value
 * @method string             getCaUsuactualizado()       Returns the current record's "ca_usuactualizado" value
 * @method timestamp          getCaFchactualizado()       Returns the current record's "ca_fchactualizado" value
 * @method FalaDeclaracionImp getFalaDeclaracionImp()     Returns the current record's "FalaDeclaracionImp" value
 * @method FalaDeclaracionDts setCaReferencia()           Sets the current record's "ca_referencia" value
 * @method FalaDeclaracionDts setCaItem()                 Sets the current record's "ca_item" value
 * @method FalaDeclaracionDts setCaSubpartida()           Sets the current record's "ca_subpartida" value
 * @method FalaDeclaracionDts setCaMod()                  Sets the current record's "ca_mod" value
 * @method FalaDeclaracionDts setCaCantidad()             Sets the current record's "ca_cantidad" value
 * @method FalaDeclaracionDts setCaUnidad()               Sets the current record's "ca_unidad" value
 * @method FalaDeclaracionDts setCaValorFob()             Sets the current record's "ca_valor_fob" value
 * @method FalaDeclaracionDts setCaGastosDespacho()       Sets the current record's "ca_gastos_despacho" value
 * @method FalaDeclaracionDts setCaFlete()                Sets the current record's "ca_flete" value
 * @method FalaDeclaracionDts setCaSeguro()               Sets the current record's "ca_seguro" value
 * @method FalaDeclaracionDts setCaGastosEmbarque()       Sets the current record's "ca_gastos_embarque" value
 * @method FalaDeclaracionDts setCaAjusteValor()          Sets the current record's "ca_ajuste_valor" value
 * @method FalaDeclaracionDts setCaValorAduana()          Sets the current record's "ca_valor_aduana" value
 * @method FalaDeclaracionDts setCaArancelPorcntj()       Sets the current record's "ca_arancel_porcntj" value
 * @method FalaDeclaracionDts setCaArancel()              Sets the current record's "ca_arancel" value
 * @method FalaDeclaracionDts setCaIvaPorctj()            Sets the current record's "ca_iva_porctj" value
 * @method FalaDeclaracionDts setCaIva()                  Sets the current record's "ca_iva" value
 * @method FalaDeclaracionDts setCaSalvaguardaPorcntj()   Sets the current record's "ca_salvaguarda_porcntj" value
 * @method FalaDeclaracionDts setCaSalvaguarda()          Sets the current record's "ca_salvaguarda" value
 * @method FalaDeclaracionDts setCaCompensaPorcntj()      Sets the current record's "ca_compensa_porcntj" value
 * @method FalaDeclaracionDts setCaCompensa()             Sets the current record's "ca_compensa" value
 * @method FalaDeclaracionDts setCaAntidumpPorcntj()      Sets the current record's "ca_antidump_porcntj" value
 * @method FalaDeclaracionDts setCaAntidump()             Sets the current record's "ca_antidump" value
 * @method FalaDeclaracionDts setCaSancion()              Sets the current record's "ca_sancion" value
 * @method FalaDeclaracionDts setCaRescate()              Sets the current record's "ca_rescate" value
 * @method FalaDeclaracionDts setCaPesoBruto()            Sets the current record's "ca_peso_bruto" value
 * @method FalaDeclaracionDts setCaPesoNeto()             Sets the current record's "ca_peso_neto" value
 * @method FalaDeclaracionDts setCaUsucreado()            Sets the current record's "ca_usucreado" value
 * @method FalaDeclaracionDts setCaFchcreado()            Sets the current record's "ca_fchcreado" value
 * @method FalaDeclaracionDts setCaUsuactualizado()       Sets the current record's "ca_usuactualizado" value
 * @method FalaDeclaracionDts setCaFchactualizado()       Sets the current record's "ca_fchactualizado" value
 * @method FalaDeclaracionDts setFalaDeclaracionImp()     Sets the current record's "FalaDeclaracionImp" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseFalaDeclaracionDts extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_faladeclaracion_dts');
        $this->hasColumn('ca_referencia', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('ca_item', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_subpartida', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_mod', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_cantidad', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_unidad', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_valor_fob', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_gastos_despacho', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_flete', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_seguro', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_gastos_embarque', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_ajuste_valor', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_valor_aduana', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_arancel_porcntj', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_arancel', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_iva_porctj', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_iva', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_salvaguarda_porcntj', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_salvaguarda', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_compensa_porcntj', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_compensa', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_antidump_porcntj', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_antidump', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_sancion', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_rescate', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_peso_bruto', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_peso_neto', 'decimal', null, array(
             'type' => 'decimal',
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

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('FalaDeclaracionImp', array(
             'local' => 'ca_referencia',
             'foreign' => 'ca_referencia'));
    }
}