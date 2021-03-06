<?php

/**
 * BaseFalaIdg
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_ididg
 * @property integer $ca_ano
 * @property string $ca_via
 * @property integer $ca_periodo
 * @property integer $ca_idgrafica
 * @property string $ca_idtrafico
 * @property text $ca_observacion
 * @property string $ca_usucreado
 * @property timestamp $ca_fchcreado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchactualizado
 * 
 * @method integer   getCaIdidg()           Returns the current record's "ca_ididg" value
 * @method integer   getCaAno()             Returns the current record's "ca_ano" value
 * @method string    getCaVia()             Returns the current record's "ca_via" value
 * @method integer   getCaPeriodo()         Returns the current record's "ca_periodo" value
 * @method integer   getCaIdgrafica()       Returns the current record's "ca_idgrafica" value
 * @method string    getCaIdtrafico()       Returns the current record's "ca_idtrafico" value
 * @method text      getCaObservacion()     Returns the current record's "ca_observacion" value
 * @method string    getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string    getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method timestamp getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method FalaIdg   setCaIdidg()           Sets the current record's "ca_ididg" value
 * @method FalaIdg   setCaAno()             Sets the current record's "ca_ano" value
 * @method FalaIdg   setCaVia()             Sets the current record's "ca_via" value
 * @method FalaIdg   setCaPeriodo()         Sets the current record's "ca_periodo" value
 * @method FalaIdg   setCaIdgrafica()       Sets the current record's "ca_idgrafica" value
 * @method FalaIdg   setCaIdtrafico()       Sets the current record's "ca_idtrafico" value
 * @method FalaIdg   setCaObservacion()     Sets the current record's "ca_observacion" value
 * @method FalaIdg   setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method FalaIdg   setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method FalaIdg   setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method FalaIdg   setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseFalaIdg extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_falaidg');
        $this->hasColumn('ca_ididg', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_ano', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_via', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('ca_periodo', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_idgrafica', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_idtrafico', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('ca_observacion', 'text', null, array(
             'type' => 'text',
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
        
    }
}