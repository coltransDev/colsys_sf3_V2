<?php

/**
 * BaseIdsBalance
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_id
 * @property integer $ca_anno
 * @property integer $ca_activostotales
 * @property integer $ca_activoscorrientes
 * @property integer $ca_pasivostotales
 * @property integer $ca_pasivoscorrientes
 * @property integer $ca_inventarios
 * @property integer $ca_patrimonios
 * @property integer $ca_utilidades
 * @property integer $ca_ventas
 * @property date $ca_fchcreado
 * @property string $ca_usucreado
 * @property date $ca_fchanulado
 * @property string $ca_usuanulado
 * @property Cliente $Cliente
 * @property IdsCliente $IdsCliente
 * 
 * @method integer    getCaId()                 Returns the current record's "ca_id" value
 * @method integer    getCaAnno()               Returns the current record's "ca_anno" value
 * @method integer    getCaActivostotales()     Returns the current record's "ca_activostotales" value
 * @method integer    getCaActivoscorrientes()  Returns the current record's "ca_activoscorrientes" value
 * @method integer    getCaPasivostotales()     Returns the current record's "ca_pasivostotales" value
 * @method integer    getCaPasivoscorrientes()  Returns the current record's "ca_pasivoscorrientes" value
 * @method integer    getCaInventarios()        Returns the current record's "ca_inventarios" value
 * @method integer    getCaPatrimonios()        Returns the current record's "ca_patrimonios" value
 * @method integer    getCaUtilidades()         Returns the current record's "ca_utilidades" value
 * @method integer    getCaVentas()             Returns the current record's "ca_ventas" value
 * @method date       getCaFchcreado()          Returns the current record's "ca_fchcreado" value
 * @method string     getCaUsucreado()          Returns the current record's "ca_usucreado" value
 * @method date       getCaFchanulado()         Returns the current record's "ca_fchanulado" value
 * @method string     getCaUsuanulado()         Returns the current record's "ca_usuanulado" value
 * @method Cliente    getCliente()              Returns the current record's "Cliente" value
 * @method IdsCliente getIdsCliente()           Returns the current record's "IdsCliente" value
 * @method IdsBalance setCaId()                 Sets the current record's "ca_id" value
 * @method IdsBalance setCaAnno()               Sets the current record's "ca_anno" value
 * @method IdsBalance setCaActivostotales()     Sets the current record's "ca_activostotales" value
 * @method IdsBalance setCaActivoscorrientes()  Sets the current record's "ca_activoscorrientes" value
 * @method IdsBalance setCaPasivostotales()     Sets the current record's "ca_pasivostotales" value
 * @method IdsBalance setCaPasivoscorrientes()  Sets the current record's "ca_pasivoscorrientes" value
 * @method IdsBalance setCaInventarios()        Sets the current record's "ca_inventarios" value
 * @method IdsBalance setCaPatrimonios()        Sets the current record's "ca_patrimonios" value
 * @method IdsBalance setCaUtilidades()         Sets the current record's "ca_utilidades" value
 * @method IdsBalance setCaVentas()             Sets the current record's "ca_ventas" value
 * @method IdsBalance setCaFchcreado()          Sets the current record's "ca_fchcreado" value
 * @method IdsBalance setCaUsucreado()          Sets the current record's "ca_usucreado" value
 * @method IdsBalance setCaFchanulado()         Sets the current record's "ca_fchanulado" value
 * @method IdsBalance setCaUsuanulado()         Sets the current record's "ca_usuanulado" value
 * @method IdsBalance setCliente()              Sets the current record's "Cliente" value
 * @method IdsBalance setIdsCliente()           Sets the current record's "IdsCliente" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseIdsBalance extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ids.tb_balances');
        $this->hasColumn('ca_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_anno', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_activostotales', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_activoscorrientes', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_pasivostotales', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_pasivoscorrientes', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_inventarios', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_patrimonios', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_utilidades', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_ventas', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_fchcreado', 'date', null, array(
             'type' => 'date',
             'notnull' => true,
             ));
        $this->hasColumn('ca_usucreado', 'string', 20, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '20',
             ));
        $this->hasColumn('ca_fchanulado', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_usuanulado', 'string', 20, array(
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
        $this->hasOne('Ids', array(
             'local' => 'ca_id',
             'foreign' => 'ca_id'));
    }
}