<?php

/**
 * BasePorcentajesComisiones
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idcliente
 * @property date $ca_inicio
 * @property date $ca_fin
 * @property numeric $ca_porcentaje
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property string $ca_empresa
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property Cliente $Cliente
 * @property Usuario $Usuario
 * 
 * @method integer               getCaIdcliente()       Returns the current record's "ca_idcliente" value
 * @method date                  getCaInicio()          Returns the current record's "ca_inicio" value
 * @method date                  getCaFin()             Returns the current record's "ca_fin" value
 * @method numeric               getCaPorcentaje()      Returns the current record's "ca_porcentaje" value
 * @method timestamp             getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string                getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method string                getCaEmpresa()         Returns the current record's "ca_empresa" value
 * @method timestamp             getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method string                getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method Cliente               getCliente()           Returns the current record's "Cliente" value
 * @method Usuario               getUsuario()           Returns the current record's "Usuario" value
 * @method PorcentajesComisiones setCaIdcliente()       Sets the current record's "ca_idcliente" value
 * @method PorcentajesComisiones setCaInicio()          Sets the current record's "ca_inicio" value
 * @method PorcentajesComisiones setCaFin()             Sets the current record's "ca_fin" value
 * @method PorcentajesComisiones setCaPorcentaje()      Sets the current record's "ca_porcentaje" value
 * @method PorcentajesComisiones setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method PorcentajesComisiones setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method PorcentajesComisiones setCaEmpresa()         Sets the current record's "ca_empresa" value
 * @method PorcentajesComisiones setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method PorcentajesComisiones setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method PorcentajesComisiones setCliente()           Sets the current record's "Cliente" value
 * @method PorcentajesComisiones setUsuario()           Sets the current record's "Usuario" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BasePorcentajesComisiones extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_porcentajescomisiones');
        $this->hasColumn('ca_idcliente', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_inicio', 'date', null, array(
             'primary' => true,
             'type' => 'date',
             ));
        $this->hasColumn('ca_fin', 'date', null, array(
             'primary' => true,
             'type' => 'date',
             ));
        $this->hasColumn('ca_porcentaje', 'numeric', null, array(
             'type' => 'numeric',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usucreado', 'string', 15, array(
             'type' => 'string',
             'length' => '15',
             ));
        $this->hasColumn('ca_empresa', 'string', 20, array(
             'type' => 'string',
             'primary' => true,
             'length' => '20',
             ));
        $this->hasColumn('ca_fchactualizado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuactualizado', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Cliente', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idcliente'));

        $this->hasOne('Usuario', array(
             'local' => 'ca_usucreado',
             'foreign' => 'ca_login'));
    }
}