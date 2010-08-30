<?php

/**
 * BaseSdnAddress
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_uid
 * @property integer $ca_uid_address
 * @property string $ca_address1
 * @property string $ca_address2
 * @property string $ca_address3
 * @property string $ca_city
 * @property string $ca_state
 * @property string $ca_postal
 * @property string $ca_country
 * @property Sdn $Sdn
 * 
 * @method integer    getCaUid()          Returns the current record's "ca_uid" value
 * @method integer    getCaUidAddress()   Returns the current record's "ca_uid_address" value
 * @method string     getCaAddress1()     Returns the current record's "ca_address1" value
 * @method string     getCaAddress2()     Returns the current record's "ca_address2" value
 * @method string     getCaAddress3()     Returns the current record's "ca_address3" value
 * @method string     getCaCity()         Returns the current record's "ca_city" value
 * @method string     getCaState()        Returns the current record's "ca_state" value
 * @method string     getCaPostal()       Returns the current record's "ca_postal" value
 * @method string     getCaCountry()      Returns the current record's "ca_country" value
 * @method Sdn        getSdn()            Returns the current record's "Sdn" value
 * @method SdnAddress setCaUid()          Sets the current record's "ca_uid" value
 * @method SdnAddress setCaUidAddress()   Sets the current record's "ca_uid_address" value
 * @method SdnAddress setCaAddress1()     Sets the current record's "ca_address1" value
 * @method SdnAddress setCaAddress2()     Sets the current record's "ca_address2" value
 * @method SdnAddress setCaAddress3()     Sets the current record's "ca_address3" value
 * @method SdnAddress setCaCity()         Sets the current record's "ca_city" value
 * @method SdnAddress setCaState()        Sets the current record's "ca_state" value
 * @method SdnAddress setCaPostal()       Sets the current record's "ca_postal" value
 * @method SdnAddress setCaCountry()      Sets the current record's "ca_country" value
 * @method SdnAddress setSdn()            Sets the current record's "Sdn" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseSdnAddress extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_sdnaddress');
        $this->hasColumn('ca_uid', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_uid_address', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_address1', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_address2', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_address3', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_city', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_state', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_postal', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_country', 'string', null, array(
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
        $this->hasOne('Sdn', array(
             'local' => 'ca_uid',
             'foreign' => 'ca_uid'));
    }
}