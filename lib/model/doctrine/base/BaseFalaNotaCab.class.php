<?php

/**
 * BaseFalaNotaCab
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $ca_referencia
 * @property string $ca_numdocumento
 * @property date $ca_emision_fch
 * @property decimal $ca_vlrdocumento
 * @property decimal $ca_tipo_cambio
 * @property string $ca_usucreado
 * @property timestamp $ca_fchcreado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchactualizado
 * @property FalaDeclaracionImp $FalaDeclaracionImp
 * @property Doctrine_Collection $FalaNotaDet
 * 
 * @method string              getCaReferencia()       Returns the current record's "ca_referencia" value
 * @method string              getCaNumdocumento()     Returns the current record's "ca_numdocumento" value
 * @method date                getCaEmisionFch()       Returns the current record's "ca_emision_fch" value
 * @method decimal             getCaVlrdocumento()     Returns the current record's "ca_vlrdocumento" value
 * @method decimal             getCaTipoCambio()       Returns the current record's "ca_tipo_cambio" value
 * @method string              getCaUsucreado()        Returns the current record's "ca_usucreado" value
 * @method timestamp           getCaFchcreado()        Returns the current record's "ca_fchcreado" value
 * @method string              getCaUsuactualizado()   Returns the current record's "ca_usuactualizado" value
 * @method timestamp           getCaFchactualizado()   Returns the current record's "ca_fchactualizado" value
 * @method FalaDeclaracionImp  getFalaDeclaracionImp() Returns the current record's "FalaDeclaracionImp" value
 * @method Doctrine_Collection getFalaNotaDet()        Returns the current record's "FalaNotaDet" collection
 * @method FalaNotaCab         setCaReferencia()       Sets the current record's "ca_referencia" value
 * @method FalaNotaCab         setCaNumdocumento()     Sets the current record's "ca_numdocumento" value
 * @method FalaNotaCab         setCaEmisionFch()       Sets the current record's "ca_emision_fch" value
 * @method FalaNotaCab         setCaVlrdocumento()     Sets the current record's "ca_vlrdocumento" value
 * @method FalaNotaCab         setCaTipoCambio()       Sets the current record's "ca_tipo_cambio" value
 * @method FalaNotaCab         setCaUsucreado()        Sets the current record's "ca_usucreado" value
 * @method FalaNotaCab         setCaFchcreado()        Sets the current record's "ca_fchcreado" value
 * @method FalaNotaCab         setCaUsuactualizado()   Sets the current record's "ca_usuactualizado" value
 * @method FalaNotaCab         setCaFchactualizado()   Sets the current record's "ca_fchactualizado" value
 * @method FalaNotaCab         setFalaDeclaracionImp() Sets the current record's "FalaDeclaracionImp" value
 * @method FalaNotaCab         setFalaNotaDet()        Sets the current record's "FalaNotaDet" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseFalaNotaCab extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_falanota_cab');
        $this->hasColumn('ca_referencia', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('ca_numdocumento', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('ca_emision_fch', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_vlrdocumento', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_tipo_cambio', 'decimal', null, array(
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

        $this->hasMany('FalaNotaDet', array(
             'local' => 'ca_numdocumento',
             'foreign' => 'ca_numdocumento'));
    }
}