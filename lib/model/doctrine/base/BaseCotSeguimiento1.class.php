<?php

/**
 * BaseCotSeguimiento1
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idseguimiento
 * @property timestamp $ca_fchseguimiento
 * @property integer $ca_idcotizacion
 * @property integer $ca_idproducto
 * @property string $ca_login
 * @property string $ca_seguimiento
 * @property string $ca_etapa
 * @property CotProducto $CotProducto
 * @property Cotizacion $Cotizacion
 * @property Usuario $Usuario
 * 
 * @method integer         getCaIdseguimiento()   Returns the current record's "ca_idseguimiento" value
 * @method timestamp       getCaFchseguimiento()  Returns the current record's "ca_fchseguimiento" value
 * @method integer         getCaIdcotizacion()    Returns the current record's "ca_idcotizacion" value
 * @method integer         getCaIdproducto()      Returns the current record's "ca_idproducto" value
 * @method string          getCaLogin()           Returns the current record's "ca_login" value
 * @method string          getCaSeguimiento()     Returns the current record's "ca_seguimiento" value
 * @method string          getCaEtapa()           Returns the current record's "ca_etapa" value
 * @method CotProducto     getCotProducto()       Returns the current record's "CotProducto" value
 * @method Cotizacion      getCotizacion()        Returns the current record's "Cotizacion" value
 * @method Usuario         getUsuario()           Returns the current record's "Usuario" value
 * @method CotSeguimiento1 setCaIdseguimiento()   Sets the current record's "ca_idseguimiento" value
 * @method CotSeguimiento1 setCaFchseguimiento()  Sets the current record's "ca_fchseguimiento" value
 * @method CotSeguimiento1 setCaIdcotizacion()    Sets the current record's "ca_idcotizacion" value
 * @method CotSeguimiento1 setCaIdproducto()      Sets the current record's "ca_idproducto" value
 * @method CotSeguimiento1 setCaLogin()           Sets the current record's "ca_login" value
 * @method CotSeguimiento1 setCaSeguimiento()     Sets the current record's "ca_seguimiento" value
 * @method CotSeguimiento1 setCaEtapa()           Sets the current record's "ca_etapa" value
 * @method CotSeguimiento1 setCotProducto()       Sets the current record's "CotProducto" value
 * @method CotSeguimiento1 setCotizacion()        Sets the current record's "Cotizacion" value
 * @method CotSeguimiento1 setUsuario()           Sets the current record's "Usuario" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseCotSeguimiento1 extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_cotseguimientos');
        $this->hasColumn('ca_idseguimiento', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_fchseguimiento', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_idcotizacion', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idproducto', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_login', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_seguimiento', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_etapa', 'string', null, array(
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
        $this->hasOne('CotProducto', array(
             'local' => 'ca_idproducto',
             'foreign' => 'ca_idproducto'));

        $this->hasOne('Cotizacion', array(
             'local' => 'ca_idcotizacion',
             'foreign' => 'ca_idcotizacion'));

        $this->hasOne('Usuario', array(
             'local' => 'ca_login',
             'foreign' => 'ca_login'));
    }
}