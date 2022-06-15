<?php

/**
 * BaseDeduccion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_iddeduccion
 * @property string $ca_deduccion
 * @property string $ca_transporte
 * @property string $ca_impoexpo
 * @property string $ca_modalidad
 * @property boolean $ca_habilitado
 * @property Doctrine_Collection $InoDeduccionesSea
 * @property Doctrine_Collection $InoDeduccion
 * @property Doctrine_Collection $InoDeduccionesAir
 * 
 * @method integer             getCaIddeduccion()     Returns the current record's "ca_iddeduccion" value
 * @method string              getCaDeduccion()       Returns the current record's "ca_deduccion" value
 * @method string              getCaTransporte()      Returns the current record's "ca_transporte" value
 * @method string              getCaImpoexpo()        Returns the current record's "ca_impoexpo" value
 * @method string              getCaModalidad()       Returns the current record's "ca_modalidad" value
 * @method boolean             getCaHabilitado()      Returns the current record's "ca_habilitado" value
 * @method Doctrine_Collection getInoDeduccionesSea() Returns the current record's "InoDeduccionesSea" collection
 * @method Doctrine_Collection getInoDeduccion()      Returns the current record's "InoDeduccion" collection
 * @method Doctrine_Collection getInoDeduccionesAir() Returns the current record's "InoDeduccionesAir" collection
 * @method Deduccion           setCaIddeduccion()     Sets the current record's "ca_iddeduccion" value
 * @method Deduccion           setCaDeduccion()       Sets the current record's "ca_deduccion" value
 * @method Deduccion           setCaTransporte()      Sets the current record's "ca_transporte" value
 * @method Deduccion           setCaImpoexpo()        Sets the current record's "ca_impoexpo" value
 * @method Deduccion           setCaModalidad()       Sets the current record's "ca_modalidad" value
 * @method Deduccion           setCaHabilitado()      Sets the current record's "ca_habilitado" value
 * @method Deduccion           setInoDeduccionesSea() Sets the current record's "InoDeduccionesSea" collection
 * @method Deduccion           setInoDeduccion()      Sets the current record's "InoDeduccion" collection
 * @method Deduccion           setInoDeduccionesAir() Sets the current record's "InoDeduccionesAir" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseDeduccion extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_deducciones');
        $this->hasColumn('ca_iddeduccion', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_deduccion', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_transporte', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_impoexpo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_modalidad', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_habilitado', 'boolean', null, array(
             'type' => 'boolean',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('InoDeduccionesSea', array(
             'local' => 'ca_iddeduccion',
             'foreign' => 'ca_iddeduccion'));

        $this->hasMany('InoDeduccion', array(
             'local' => 'ca_iddeduccion',
             'foreign' => 'ca_iddeduccion'));

        $this->hasMany('InoDeduccionesAir', array(
             'local' => 'ca_iddeduccion',
             'foreign' => 'ca_iddeduccion'));
    }
}