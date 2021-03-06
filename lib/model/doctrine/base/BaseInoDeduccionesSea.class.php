<?php

/**
 * BaseInoDeduccionesSea
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_iddeduccion
 * @property integer $ca_idinoingreso
 * @property numeric $ca_neto
 * @property numeric $ca_valor
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property InoIngresosSea $InoIngresosSea
 * @property Deducciones $Deducciones
 * 
 * @method integer           getCaIddeduccion()     Returns the current record's "ca_iddeduccion" value
 * @method integer           getCaIdinoingreso()    Returns the current record's "ca_idinoingreso" value
 * @method numeric           getCaNeto()            Returns the current record's "ca_neto" value
 * @method numeric           getCaValor()           Returns the current record's "ca_valor" value
 * @method timestamp         getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string            getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp         getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method string            getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method InoIngresosSea    getInoIngresosSea()    Returns the current record's "InoIngresosSea" value
 * @method Deducciones       getDeducciones()       Returns the current record's "Deducciones" value
 * @method InoDeduccionesSea setCaIddeduccion()     Sets the current record's "ca_iddeduccion" value
 * @method InoDeduccionesSea setCaIdinoingreso()    Sets the current record's "ca_idinoingreso" value
 * @method InoDeduccionesSea setCaNeto()            Sets the current record's "ca_neto" value
 * @method InoDeduccionesSea setCaValor()           Sets the current record's "ca_valor" value
 * @method InoDeduccionesSea setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method InoDeduccionesSea setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method InoDeduccionesSea setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method InoDeduccionesSea setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method InoDeduccionesSea setInoIngresosSea()    Sets the current record's "InoIngresosSea" value
 * @method InoDeduccionesSea setDeducciones()       Sets the current record's "Deducciones" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseInoDeduccionesSea extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_inodeduccion_sea');
        $this->hasColumn('ca_iddeduccion', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_idinoingreso', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_neto', 'numeric', null, array(
             'type' => 'numeric',
             ));
        $this->hasColumn('ca_valor', 'numeric', null, array(
             'type' => 'numeric',
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
        $this->hasOne('InoIngresosSea', array(
             'local' => 'ca_idinoingreso',
             'foreign' => 'ca_idinoingreso'));

        $this->hasOne('Deducciones', array(
             'local' => 'ca_iddeduccion',
             'foreign' => 'ca_iddeduccion'));
    }
}