<?php

/**
 * BaseCotRecargo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idcotrecargo
 * @property integer $ca_idcotizacion
 * @property integer $ca_idproducto
 * @property integer $ca_idopcion
 * @property integer $ca_idconcepto
 * @property integer $ca_idrecargo
 * @property string $ca_modalidad
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
 * @property integer $ca_idequipo
 * @property Concepto $Concepto
 * @property TipoRecargo $TipoRecargo
 * @property Concepto $Equipo
 * 
 * @method integer     getCaIdcotrecargo()    Returns the current record's "ca_idcotrecargo" value
 * @method integer     getCaIdcotizacion()    Returns the current record's "ca_idcotizacion" value
 * @method integer     getCaIdproducto()      Returns the current record's "ca_idproducto" value
 * @method integer     getCaIdopcion()        Returns the current record's "ca_idopcion" value
 * @method integer     getCaIdconcepto()      Returns the current record's "ca_idconcepto" value
 * @method integer     getCaIdrecargo()       Returns the current record's "ca_idrecargo" value
 * @method string      getCaModalidad()       Returns the current record's "ca_modalidad" value
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
 * @method integer     getCaIdequipo()        Returns the current record's "ca_idequipo" value
 * @method Concepto    getConcepto()          Returns the current record's "Concepto" value
 * @method TipoRecargo getTipoRecargo()       Returns the current record's "TipoRecargo" value
 * @method Concepto    getEquipo()            Returns the current record's "Equipo" value
 * @method CotRecargo  setCaIdcotrecargo()    Sets the current record's "ca_idcotrecargo" value
 * @method CotRecargo  setCaIdcotizacion()    Sets the current record's "ca_idcotizacion" value
 * @method CotRecargo  setCaIdproducto()      Sets the current record's "ca_idproducto" value
 * @method CotRecargo  setCaIdopcion()        Sets the current record's "ca_idopcion" value
 * @method CotRecargo  setCaIdconcepto()      Sets the current record's "ca_idconcepto" value
 * @method CotRecargo  setCaIdrecargo()       Sets the current record's "ca_idrecargo" value
 * @method CotRecargo  setCaModalidad()       Sets the current record's "ca_modalidad" value
 * @method CotRecargo  setCaValorTar()        Sets the current record's "ca_valor_tar" value
 * @method CotRecargo  setCaAplicaTar()       Sets the current record's "ca_aplica_tar" value
 * @method CotRecargo  setCaValorMin()        Sets the current record's "ca_valor_min" value
 * @method CotRecargo  setCaAplicaMin()       Sets the current record's "ca_aplica_min" value
 * @method CotRecargo  setCaIdmoneda()        Sets the current record's "ca_idmoneda" value
 * @method CotRecargo  setCaObservaciones()   Sets the current record's "ca_observaciones" value
 * @method CotRecargo  setCaConsecutivo()     Sets the current record's "ca_consecutivo" value
 * @method CotRecargo  setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method CotRecargo  setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method CotRecargo  setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method CotRecargo  setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method CotRecargo  setCaIdequipo()        Sets the current record's "ca_idequipo" value
 * @method CotRecargo  setConcepto()          Sets the current record's "Concepto" value
 * @method CotRecargo  setTipoRecargo()       Sets the current record's "TipoRecargo" value
 * @method CotRecargo  setEquipo()            Sets the current record's "Equipo" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseCotRecargo extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_cotrecargos');
        $this->hasColumn('ca_idcotrecargo', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_idcotizacion', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idproducto', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idopcion', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idconcepto', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idrecargo', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_modalidad', 'string', null, array(
             'type' => 'string',
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
        $this->hasColumn('ca_idequipo', 'integer', null, array(
             'type' => 'integer',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Concepto', array(
             'local' => 'ca_idconcepto',
             'foreign' => 'ca_idconcepto'));

        $this->hasOne('TipoRecargo', array(
             'local' => 'ca_idrecargo',
             'foreign' => 'ca_idrecargo'));

        $this->hasOne('Concepto as Equipo', array(
             'local' => 'ca_idequipo',
             'foreign' => 'ca_idconcepto'));
    }
}
