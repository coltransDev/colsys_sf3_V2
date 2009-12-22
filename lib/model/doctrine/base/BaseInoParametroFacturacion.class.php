<?php

/**
 * BaseInoParametroFacturacion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idparametro
 * @property integer $ca_idconcepto
 * @property integer $ca_idccosto
 * @property integer $ca_idcuenta
 * @property booolean $ca_ingreso_propio
 * @property decimal $ca_iva
 * @property decimal $ca_baseretencion
 * @property integer $ca_idcuentaretencion
 * @property decimal $ca_valor
 * @property boolean $ca_convenios
 * @property decimal $ca_autoretencion
 * @property smallint $ca_tipoautoretencion
 * @property InoConcepto $InoConcepto
 * @property InoCentroCosto $InoCentroCosto
 * @property InoCuenta $InoCuenta
 * @property InoCuenta $InoCuentaRetencion
 * 
 * @method integer                 getCaIdparametro()        Returns the current record's "ca_idparametro" value
 * @method integer                 getCaIdconcepto()         Returns the current record's "ca_idconcepto" value
 * @method integer                 getCaIdccosto()           Returns the current record's "ca_idccosto" value
 * @method integer                 getCaIdcuenta()           Returns the current record's "ca_idcuenta" value
 * @method booolean                getCaIngresoPropio()      Returns the current record's "ca_ingreso_propio" value
 * @method decimal                 getCaIva()                Returns the current record's "ca_iva" value
 * @method decimal                 getCaBaseretencion()      Returns the current record's "ca_baseretencion" value
 * @method integer                 getCaIdcuentaretencion()  Returns the current record's "ca_idcuentaretencion" value
 * @method decimal                 getCaValor()              Returns the current record's "ca_valor" value
 * @method boolean                 getCaConvenios()          Returns the current record's "ca_convenios" value
 * @method decimal                 getCaAutoretencion()      Returns the current record's "ca_autoretencion" value
 * @method smallint                getCaTipoautoretencion()  Returns the current record's "ca_tipoautoretencion" value
 * @method InoConcepto             getInoConcepto()          Returns the current record's "InoConcepto" value
 * @method InoCentroCosto          getInoCentroCosto()       Returns the current record's "InoCentroCosto" value
 * @method InoCuenta               getInoCuenta()            Returns the current record's "InoCuenta" value
 * @method InoCuenta               getInoCuentaRetencion()   Returns the current record's "InoCuentaRetencion" value
 * @method InoParametroFacturacion setCaIdparametro()        Sets the current record's "ca_idparametro" value
 * @method InoParametroFacturacion setCaIdconcepto()         Sets the current record's "ca_idconcepto" value
 * @method InoParametroFacturacion setCaIdccosto()           Sets the current record's "ca_idccosto" value
 * @method InoParametroFacturacion setCaIdcuenta()           Sets the current record's "ca_idcuenta" value
 * @method InoParametroFacturacion setCaIngresoPropio()      Sets the current record's "ca_ingreso_propio" value
 * @method InoParametroFacturacion setCaIva()                Sets the current record's "ca_iva" value
 * @method InoParametroFacturacion setCaBaseretencion()      Sets the current record's "ca_baseretencion" value
 * @method InoParametroFacturacion setCaIdcuentaretencion()  Sets the current record's "ca_idcuentaretencion" value
 * @method InoParametroFacturacion setCaValor()              Sets the current record's "ca_valor" value
 * @method InoParametroFacturacion setCaConvenios()          Sets the current record's "ca_convenios" value
 * @method InoParametroFacturacion setCaAutoretencion()      Sets the current record's "ca_autoretencion" value
 * @method InoParametroFacturacion setCaTipoautoretencion()  Sets the current record's "ca_tipoautoretencion" value
 * @method InoParametroFacturacion setInoConcepto()          Sets the current record's "InoConcepto" value
 * @method InoParametroFacturacion setInoCentroCosto()       Sets the current record's "InoCentroCosto" value
 * @method InoParametroFacturacion setInoCuenta()            Sets the current record's "InoCuenta" value
 * @method InoParametroFacturacion setInoCuentaRetencion()   Sets the current record's "InoCuentaRetencion" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseInoParametroFacturacion extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ino.tb_parametros_facturacion');
        $this->hasColumn('ca_idparametro', 'integer', null, array(
             'type' => 'integer',
             'autoincrement' => true,
             'primary' => true,
             ));
        $this->hasColumn('ca_idconcepto', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idccosto', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idcuenta', 'integer', null, array(
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
        $this->hasColumn('ca_idcuentaretencion', 'integer', null, array(
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

        $this->hasOne('InoCentroCosto', array(
             'local' => 'ca_idccosto',
             'foreign' => 'ca_idccosto'));

        $this->hasOne('InoCuenta', array(
             'local' => 'ca_idcuenta',
             'foreign' => 'ca_idcuenta'));

        $this->hasOne('InoCuenta as InoCuentaRetencion', array(
             'local' => 'ca_idcuentaretencion',
             'foreign' => 'ca_idcuenta'));
    }
}