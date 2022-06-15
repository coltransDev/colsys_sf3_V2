<?php

/**
 * BaseInoUtilidadprmsSea
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idparametro
 * @property string $ca_referencia
 * @property integer $ca_idcosto
 * @property string $ca_tipo
 * @property decimal $ca_valor
 * @property string $ca_aplicacion
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property InoMaestraSea $InoMaestraSea
 * @property Costo $Costo
 * @property Usuario $UsuCreado
 * @property Usuario $UsuActualizado
 * 
 * @method integer            getCaIdparametro()     Returns the current record's "ca_idparametro" value
 * @method string             getCaReferencia()      Returns the current record's "ca_referencia" value
 * @method integer            getCaIdcosto()         Returns the current record's "ca_idcosto" value
 * @method string             getCaTipo()            Returns the current record's "ca_tipo" value
 * @method decimal            getCaValor()           Returns the current record's "ca_valor" value
 * @method string             getCaAplicacion()      Returns the current record's "ca_aplicacion" value
 * @method timestamp          getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string             getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp          getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method string             getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method InoMaestraSea      getInoMaestraSea()     Returns the current record's "InoMaestraSea" value
 * @method Costo              getCosto()             Returns the current record's "Costo" value
 * @method Usuario            getUsuCreado()         Returns the current record's "UsuCreado" value
 * @method Usuario            getUsuActualizado()    Returns the current record's "UsuActualizado" value
 * @method InoUtilidadprmsSea setCaIdparametro()     Sets the current record's "ca_idparametro" value
 * @method InoUtilidadprmsSea setCaReferencia()      Sets the current record's "ca_referencia" value
 * @method InoUtilidadprmsSea setCaIdcosto()         Sets the current record's "ca_idcosto" value
 * @method InoUtilidadprmsSea setCaTipo()            Sets the current record's "ca_tipo" value
 * @method InoUtilidadprmsSea setCaValor()           Sets the current record's "ca_valor" value
 * @method InoUtilidadprmsSea setCaAplicacion()      Sets the current record's "ca_aplicacion" value
 * @method InoUtilidadprmsSea setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method InoUtilidadprmsSea setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method InoUtilidadprmsSea setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method InoUtilidadprmsSea setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method InoUtilidadprmsSea setInoMaestraSea()     Sets the current record's "InoMaestraSea" value
 * @method InoUtilidadprmsSea setCosto()             Sets the current record's "Costo" value
 * @method InoUtilidadprmsSea setUsuCreado()         Sets the current record's "UsuCreado" value
 * @method InoUtilidadprmsSea setUsuActualizado()    Sets the current record's "UsuActualizado" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseInoUtilidadprmsSea extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_inoutilidadprms_sea');
        $this->hasColumn('ca_idparametro', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_referencia', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idcosto', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_tipo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_valor', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_aplicacion', 'string', null, array(
             'type' => 'string',
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

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('InoMaestraSea', array(
             'local' => 'ca_referencia',
             'foreign' => 'ca_referencia'));

        $this->hasOne('Costo', array(
             'local' => 'ca_idcosto',
             'foreign' => 'ca_idcosto'));

        $this->hasOne('Usuario as UsuCreado', array(
             'local' => 'ca_usucreado',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as UsuActualizado', array(
             'local' => 'ca_usuactualizado',
             'foreign' => 'ca_login'));
    }
}