<?php

/**
 * BasePricFleteBs
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idtrayecto
 * @property integer $ca_idconcepto
 * @property decimal $ca_vlrneto
 * @property decimal $ca_vlrsugerido
 * @property date $ca_fchinicio
 * @property date $ca_fchvencimiento
 * @property string $ca_idmoneda
 * @property string $ca_estado
 * @property string $ca_aplicacion
 * @property integer $ca_consecutivo
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fcheliminado
 * @property Concepto $Concepto
 * 
 * @method integer     getCaIdtrayecto()      Returns the current record's "ca_idtrayecto" value
 * @method integer     getCaIdconcepto()      Returns the current record's "ca_idconcepto" value
 * @method decimal     getCaVlrneto()         Returns the current record's "ca_vlrneto" value
 * @method decimal     getCaVlrsugerido()     Returns the current record's "ca_vlrsugerido" value
 * @method date        getCaFchinicio()       Returns the current record's "ca_fchinicio" value
 * @method date        getCaFchvencimiento()  Returns the current record's "ca_fchvencimiento" value
 * @method string      getCaIdmoneda()        Returns the current record's "ca_idmoneda" value
 * @method string      getCaEstado()          Returns the current record's "ca_estado" value
 * @method string      getCaAplicacion()      Returns the current record's "ca_aplicacion" value
 * @method integer     getCaConsecutivo()     Returns the current record's "ca_consecutivo" value
 * @method timestamp   getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string      getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp   getCaFcheliminado()    Returns the current record's "ca_fcheliminado" value
 * @method Concepto    getConcepto()          Returns the current record's "Concepto" value
 * @method PricFleteBs setCaIdtrayecto()      Sets the current record's "ca_idtrayecto" value
 * @method PricFleteBs setCaIdconcepto()      Sets the current record's "ca_idconcepto" value
 * @method PricFleteBs setCaVlrneto()         Sets the current record's "ca_vlrneto" value
 * @method PricFleteBs setCaVlrsugerido()     Sets the current record's "ca_vlrsugerido" value
 * @method PricFleteBs setCaFchinicio()       Sets the current record's "ca_fchinicio" value
 * @method PricFleteBs setCaFchvencimiento()  Sets the current record's "ca_fchvencimiento" value
 * @method PricFleteBs setCaIdmoneda()        Sets the current record's "ca_idmoneda" value
 * @method PricFleteBs setCaEstado()          Sets the current record's "ca_estado" value
 * @method PricFleteBs setCaAplicacion()      Sets the current record's "ca_aplicacion" value
 * @method PricFleteBs setCaConsecutivo()     Sets the current record's "ca_consecutivo" value
 * @method PricFleteBs setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method PricFleteBs setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method PricFleteBs setCaFcheliminado()    Sets the current record's "ca_fcheliminado" value
 * @method PricFleteBs setConcepto()          Sets the current record's "Concepto" value
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6508 2009-10-14 06:28:49Z jwage $
 */
abstract class BasePricFleteBs extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('bs_pricfletes');
        $this->hasColumn('ca_idtrayecto', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idconcepto', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_vlrneto', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_vlrsugerido', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_fchinicio', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_fchvencimiento', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_idmoneda', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_estado', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_aplicacion', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_consecutivo', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usucreado', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fcheliminado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));


        $this->setAttribute(Doctrine_Core::ATTR_EXPORT, Doctrine_Core::EXPORT_TABLES);
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Concepto', array(
             'local' => 'ca_idconcepto',
             'foreign' => 'ca_idconcepto'));
    }
}