<?php

/**
 * BasePricSeguro
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idgrupo
 * @property string $ca_transporte
 * @property decimal $ca_vlrprima
 * @property decimal $ca_vlrminima
 * @property decimal $ca_vlrobtencionpoliza
 * @property string $ca_idmoneda
 * @property string $ca_observaciones
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * 
 * @method integer    getCaIdgrupo()             Returns the current record's "ca_idgrupo" value
 * @method string     getCaTransporte()          Returns the current record's "ca_transporte" value
 * @method decimal    getCaVlrprima()            Returns the current record's "ca_vlrprima" value
 * @method decimal    getCaVlrminima()           Returns the current record's "ca_vlrminima" value
 * @method decimal    getCaVlrobtencionpoliza()  Returns the current record's "ca_vlrobtencionpoliza" value
 * @method string     getCaIdmoneda()            Returns the current record's "ca_idmoneda" value
 * @method string     getCaObservaciones()       Returns the current record's "ca_observaciones" value
 * @method timestamp  getCaFchcreado()           Returns the current record's "ca_fchcreado" value
 * @method string     getCaUsucreado()           Returns the current record's "ca_usucreado" value
 * @method PricSeguro setCaIdgrupo()             Sets the current record's "ca_idgrupo" value
 * @method PricSeguro setCaTransporte()          Sets the current record's "ca_transporte" value
 * @method PricSeguro setCaVlrprima()            Sets the current record's "ca_vlrprima" value
 * @method PricSeguro setCaVlrminima()           Sets the current record's "ca_vlrminima" value
 * @method PricSeguro setCaVlrobtencionpoliza()  Sets the current record's "ca_vlrobtencionpoliza" value
 * @method PricSeguro setCaIdmoneda()            Sets the current record's "ca_idmoneda" value
 * @method PricSeguro setCaObservaciones()       Sets the current record's "ca_observaciones" value
 * @method PricSeguro setCaFchcreado()           Sets the current record's "ca_fchcreado" value
 * @method PricSeguro setCaUsucreado()           Sets the current record's "ca_usucreado" value
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6508 2009-10-14 06:28:49Z jwage $
 */
abstract class BasePricSeguro extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_pricseguros');
        $this->hasColumn('ca_idgrupo', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_transporte', 'string', null, array(
             'type' => 'string',
             'primary' => true,
             ));
        $this->hasColumn('ca_vlrprima', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_vlrminima', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_vlrobtencionpoliza', 'decimal', null, array(
             'type' => 'decimal',
             ));
        $this->hasColumn('ca_idmoneda', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_observaciones', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usucreado', 'string', null, array(
             'type' => 'string',
             ));


        $this->setAttribute(Doctrine_Core::ATTR_EXPORT, Doctrine_Core::EXPORT_TABLES);
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}