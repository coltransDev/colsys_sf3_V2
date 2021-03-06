<?php

/**
 * BaseFalaDeclaracionImp
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $ca_referencia
 * @property string $ca_numinternacion
 * @property integer $ca_ano_trm
 * @property integer $ca_semana_trm
 * @property decimal $ca_factor_trm
 * @property string $ca_usucreado
 * @property timestamp $ca_fchcreado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchactualizado
 * @property Doctrine_Collection $FalaHeaderAdu
 * @property Doctrine_Collection $FalaDeclaracionDts
 * @property Doctrine_Collection $FalaFacturacionAdu
 * @property Doctrine_Collection $FalaNotaCab
 * 
 * @method string              getCaReferencia()       Returns the current record's "ca_referencia" value
 * @method string              getCaNuminternacion()   Returns the current record's "ca_numinternacion" value
 * @method integer             getCaAnoTrm()           Returns the current record's "ca_ano_trm" value
 * @method integer             getCaSemanaTrm()        Returns the current record's "ca_semana_trm" value
 * @method decimal             getCaFactorTrm()        Returns the current record's "ca_factor_trm" value
 * @method string              getCaUsucreado()        Returns the current record's "ca_usucreado" value
 * @method timestamp           getCaFchcreado()        Returns the current record's "ca_fchcreado" value
 * @method string              getCaUsuactualizado()   Returns the current record's "ca_usuactualizado" value
 * @method timestamp           getCaFchactualizado()   Returns the current record's "ca_fchactualizado" value
 * @method Doctrine_Collection getFalaHeaderAdu()      Returns the current record's "FalaHeaderAdu" collection
 * @method Doctrine_Collection getFalaDeclaracionDts() Returns the current record's "FalaDeclaracionDts" collection
 * @method Doctrine_Collection getFalaFacturacionAdu() Returns the current record's "FalaFacturacionAdu" collection
 * @method Doctrine_Collection getFalaNotaCab()        Returns the current record's "FalaNotaCab" collection
 * @method FalaDeclaracionImp  setCaReferencia()       Sets the current record's "ca_referencia" value
 * @method FalaDeclaracionImp  setCaNuminternacion()   Sets the current record's "ca_numinternacion" value
 * @method FalaDeclaracionImp  setCaAnoTrm()           Sets the current record's "ca_ano_trm" value
 * @method FalaDeclaracionImp  setCaSemanaTrm()        Sets the current record's "ca_semana_trm" value
 * @method FalaDeclaracionImp  setCaFactorTrm()        Sets the current record's "ca_factor_trm" value
 * @method FalaDeclaracionImp  setCaUsucreado()        Sets the current record's "ca_usucreado" value
 * @method FalaDeclaracionImp  setCaFchcreado()        Sets the current record's "ca_fchcreado" value
 * @method FalaDeclaracionImp  setCaUsuactualizado()   Sets the current record's "ca_usuactualizado" value
 * @method FalaDeclaracionImp  setCaFchactualizado()   Sets the current record's "ca_fchactualizado" value
 * @method FalaDeclaracionImp  setFalaHeaderAdu()      Sets the current record's "FalaHeaderAdu" collection
 * @method FalaDeclaracionImp  setFalaDeclaracionDts() Sets the current record's "FalaDeclaracionDts" collection
 * @method FalaDeclaracionImp  setFalaFacturacionAdu() Sets the current record's "FalaFacturacionAdu" collection
 * @method FalaDeclaracionImp  setFalaNotaCab()        Sets the current record's "FalaNotaCab" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseFalaDeclaracionImp extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_faladeclaracion_imp');
        $this->hasColumn('ca_referencia', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('ca_numinternacion', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_ano_trm', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_semana_trm', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_factor_trm', 'decimal', null, array(
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
        $this->hasMany('FalaHeaderAdu', array(
             'local' => 'ca_referencia',
             'foreign' => 'ca_referencia'));

        $this->hasMany('FalaDeclaracionDts', array(
             'local' => 'ca_referencia',
             'foreign' => 'ca_referencia',
             'orderBy' => 'ca_referencia ASC'));

        $this->hasMany('FalaFacturacionAdu', array(
             'local' => 'ca_referencia',
             'foreign' => 'ca_referencia',
             'orderBy' => 'ca_referencia ASC'));

        $this->hasMany('FalaNotaCab', array(
             'local' => 'ca_referencia',
             'foreign' => 'ca_referencia'));
    }
}