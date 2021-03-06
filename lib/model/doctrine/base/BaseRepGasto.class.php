<?php

/**
 * BaseRepGasto
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idrepgasto
 * @property integer $ca_idreporte
 * @property integer $ca_idconcepto
 * @property integer $ca_idrecargo
 * @property integer $ca_idequipo
 * @property string $ca_aplicacion
 * @property string $ca_tipo
 * @property decimal $ca_neta_tar
 * @property decimal $ca_neta_min
 * @property decimal $ca_reportar_tar
 * @property decimal $ca_reportar_min
 * @property decimal $ca_cobrar_tar
 * @property decimal $ca_cobrar_min
 * @property string $ca_idmoneda
 * @property string $ca_detalles
 * @property bool $ca_recargoorigen
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property integer $ca_tiporecargo
 * @property Reporte $Reporte
 * @property TipoRecargo $TipoRecargo
 * @property Concepto $Concepto
 * @property Concepto $Equipo
 * @property InoConcepto $InoConcepto
 * 
 * @method integer     getCaIdrepgasto()      Returns the current record's "ca_idrepgasto" value
 * @method integer     getCaIdreporte()       Returns the current record's "ca_idreporte" value
 * @method integer     getCaIdconcepto()      Returns the current record's "ca_idconcepto" value
 * @method integer     getCaIdrecargo()       Returns the current record's "ca_idrecargo" value
 * @method integer     getCaIdequipo()        Returns the current record's "ca_idequipo" value
 * @method string      getCaAplicacion()      Returns the current record's "ca_aplicacion" value
 * @method string      getCaTipo()            Returns the current record's "ca_tipo" value
 * @method decimal     getCaNetaTar()         Returns the current record's "ca_neta_tar" value
 * @method decimal     getCaNetaMin()         Returns the current record's "ca_neta_min" value
 * @method decimal     getCaReportarTar()     Returns the current record's "ca_reportar_tar" value
 * @method decimal     getCaReportarMin()     Returns the current record's "ca_reportar_min" value
 * @method decimal     getCaCobrarTar()       Returns the current record's "ca_cobrar_tar" value
 * @method decimal     getCaCobrarMin()       Returns the current record's "ca_cobrar_min" value
 * @method string      getCaIdmoneda()        Returns the current record's "ca_idmoneda" value
 * @method string      getCaDetalles()        Returns the current record's "ca_detalles" value
 * @method bool        getCaRecargoorigen()   Returns the current record's "ca_recargoorigen" value
 * @method timestamp   getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string      getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp   getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method string      getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method integer     getCaTiporecargo()     Returns the current record's "ca_tiporecargo" value
 * @method Reporte     getReporte()           Returns the current record's "Reporte" value
 * @method TipoRecargo getTipoRecargo()       Returns the current record's "TipoRecargo" value
 * @method Concepto    getConcepto()          Returns the current record's "Concepto" value
 * @method Concepto    getEquipo()            Returns the current record's "Equipo" value
 * @method InoConcepto getInoConcepto()       Returns the current record's "InoConcepto" value
 * @method RepGasto    setCaIdrepgasto()      Sets the current record's "ca_idrepgasto" value
 * @method RepGasto    setCaIdreporte()       Sets the current record's "ca_idreporte" value
 * @method RepGasto    setCaIdconcepto()      Sets the current record's "ca_idconcepto" value
 * @method RepGasto    setCaIdrecargo()       Sets the current record's "ca_idrecargo" value
 * @method RepGasto    setCaIdequipo()        Sets the current record's "ca_idequipo" value
 * @method RepGasto    setCaAplicacion()      Sets the current record's "ca_aplicacion" value
 * @method RepGasto    setCaTipo()            Sets the current record's "ca_tipo" value
 * @method RepGasto    setCaNetaTar()         Sets the current record's "ca_neta_tar" value
 * @method RepGasto    setCaNetaMin()         Sets the current record's "ca_neta_min" value
 * @method RepGasto    setCaReportarTar()     Sets the current record's "ca_reportar_tar" value
 * @method RepGasto    setCaReportarMin()     Sets the current record's "ca_reportar_min" value
 * @method RepGasto    setCaCobrarTar()       Sets the current record's "ca_cobrar_tar" value
 * @method RepGasto    setCaCobrarMin()       Sets the current record's "ca_cobrar_min" value
 * @method RepGasto    setCaIdmoneda()        Sets the current record's "ca_idmoneda" value
 * @method RepGasto    setCaDetalles()        Sets the current record's "ca_detalles" value
 * @method RepGasto    setCaRecargoorigen()   Sets the current record's "ca_recargoorigen" value
 * @method RepGasto    setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method RepGasto    setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method RepGasto    setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method RepGasto    setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method RepGasto    setCaTiporecargo()     Sets the current record's "ca_tiporecargo" value
 * @method RepGasto    setReporte()           Sets the current record's "Reporte" value
 * @method RepGasto    setTipoRecargo()       Sets the current record's "TipoRecargo" value
 * @method RepGasto    setConcepto()          Sets the current record's "Concepto" value
 * @method RepGasto    setEquipo()            Sets the current record's "Equipo" value
 * @method RepGasto    setInoConcepto()       Sets the current record's "InoConcepto" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseRepGasto extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_repgastos');
        $this->hasColumn('ca_idrepgasto', 'integer', null, array(
             'type' => 'integer',
             'autoincrement' => true,
             'primary' => true,
             ));
        $this->hasColumn('ca_idreporte', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idconcepto', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idrecargo', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idequipo', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_aplicacion', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_tipo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_neta_tar', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_neta_min', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_reportar_tar', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_reportar_min', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_cobrar_tar', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_cobrar_min', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_idmoneda', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_detalles', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_recargoorigen', 'bool', null, array(
             'type' => 'bool',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usucreado', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchactualizado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuactualizado', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_tiporecargo', 'integer', null, array(
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
        $this->hasOne('Reporte', array(
             'local' => 'ca_idreporte',
             'foreign' => 'ca_idreporte'));

        $this->hasOne('TipoRecargo', array(
             'local' => 'ca_idrecargo',
             'foreign' => 'ca_idrecargo'));

        $this->hasOne('Concepto', array(
             'local' => 'ca_idconcepto',
             'foreign' => 'ca_idconcepto'));

        $this->hasOne('Concepto as Equipo', array(
             'local' => 'ca_idequipo',
             'foreign' => 'ca_idconcepto'));

        $this->hasOne('InoConcepto', array(
             'local' => 'ca_idconcepto',
             'foreign' => 'ca_idconcepto'));
    }
}