<?php

/**
 * BaseRepSeguro
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idreporte
 * @property decimal $ca_vlrasegurado
 * @property string $ca_idmoneda_vlr
 * @property decimal $ca_primaventa
 * @property decimal $ca_minimaventa
 * @property string $ca_idmoneda_vta
 * @property decimal $ca_obtencionpoliza
 * @property string $ca_idmoneda_pol
 * @property string $ca_seguro_conf
 * @property Reporte $Reporte
 * 
 * @method integer   getCaIdreporte()        Returns the current record's "ca_idreporte" value
 * @method decimal   getCaVlrasegurado()     Returns the current record's "ca_vlrasegurado" value
 * @method string    getCaIdmonedaVlr()      Returns the current record's "ca_idmoneda_vlr" value
 * @method decimal   getCaPrimaventa()       Returns the current record's "ca_primaventa" value
 * @method decimal   getCaMinimaventa()      Returns the current record's "ca_minimaventa" value
 * @method string    getCaIdmonedaVta()      Returns the current record's "ca_idmoneda_vta" value
 * @method decimal   getCaObtencionpoliza()  Returns the current record's "ca_obtencionpoliza" value
 * @method string    getCaIdmonedaPol()      Returns the current record's "ca_idmoneda_pol" value
 * @method string    getCaSeguroConf()       Returns the current record's "ca_seguro_conf" value
 * @method Reporte   getReporte()            Returns the current record's "Reporte" value
 * @method RepSeguro setCaIdreporte()        Sets the current record's "ca_idreporte" value
 * @method RepSeguro setCaVlrasegurado()     Sets the current record's "ca_vlrasegurado" value
 * @method RepSeguro setCaIdmonedaVlr()      Sets the current record's "ca_idmoneda_vlr" value
 * @method RepSeguro setCaPrimaventa()       Sets the current record's "ca_primaventa" value
 * @method RepSeguro setCaMinimaventa()      Sets the current record's "ca_minimaventa" value
 * @method RepSeguro setCaIdmonedaVta()      Sets the current record's "ca_idmoneda_vta" value
 * @method RepSeguro setCaObtencionpoliza()  Sets the current record's "ca_obtencionpoliza" value
 * @method RepSeguro setCaIdmonedaPol()      Sets the current record's "ca_idmoneda_pol" value
 * @method RepSeguro setCaSeguroConf()       Sets the current record's "ca_seguro_conf" value
 * @method RepSeguro setReporte()            Sets the current record's "Reporte" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseRepSeguro extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_repseguro');
        $this->hasColumn('ca_idreporte', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_vlrasegurado', 'decimal', null, array(
             'type' => 'decimal',
             'notnull' => true,
             ));
        $this->hasColumn('ca_idmoneda_vlr', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_primaventa', 'decimal', null, array(
             'type' => 'decimal',
             'notnull' => true,
             ));
        $this->hasColumn('ca_minimaventa', 'decimal', null, array(
             'type' => 'decimal',
             'notnull' => true,
             ));
        $this->hasColumn('ca_idmoneda_vta', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_obtencionpoliza', 'decimal', null, array(
             'type' => 'decimal',
             'notnull' => true,
             ));
        $this->hasColumn('ca_idmoneda_pol', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_seguro_conf', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));


        $this->setAttribute(Doctrine_Core::ATTR_EXPORT, Doctrine_Core::EXPORT_TABLES);

        $this->option('symfony', array(
             'form' => true,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Reporte', array(
             'local' => 'ca_idreporte',
             'foreign' => 'ca_idreporte'));
    }
}