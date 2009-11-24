<?php

/**
 * BaseCotContactoAg
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $ca_idcontacto
 * @property integer $ca_idcotizacion
 * @property Cotizacion $Cotizacion
 * @property IdsContacto $IdsContacto
 * 
 * @method string        getCaIdcontacto()    Returns the current record's "ca_idcontacto" value
 * @method integer       getCaIdcotizacion()  Returns the current record's "ca_idcotizacion" value
 * @method Cotizacion    getCotizacion()      Returns the current record's "Cotizacion" value
 * @method IdsContacto   getIdsContacto()     Returns the current record's "IdsContacto" value
 * @method CotContactoAg setCaIdcontacto()    Sets the current record's "ca_idcontacto" value
 * @method CotContactoAg setCaIdcotizacion()  Sets the current record's "ca_idcotizacion" value
 * @method CotContactoAg setCotizacion()      Sets the current record's "Cotizacion" value
 * @method CotContactoAg setIdsContacto()     Sets the current record's "IdsContacto" value
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6716 2009-11-12 19:26:28Z jwage $
 */
abstract class BaseCotContactoAg extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_cotcontactosag');
        $this->hasColumn('ca_idcontacto', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('ca_idcotizacion', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));


        $this->setAttribute(Doctrine_Core::ATTR_EXPORT, Doctrine_Core::EXPORT_TABLES);

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Cotizacion', array(
             'local' => 'ca_idcotizacion',
             'foreign' => 'ca_idcotizacion'));

        $this->hasOne('IdsContacto', array(
             'local' => 'ca_idcontacto',
             'foreign' => 'ca_idcontacto'));
    }
}