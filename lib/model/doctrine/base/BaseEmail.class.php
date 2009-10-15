<?php

/**
 * BaseEmail
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idemail
 * @property timestamp $ca_fchenvio
 * @property string $ca_usuenvio
 * @property string $ca_tipo
 * @property string $ca_idcaso
 * @property string $ca_from
 * @property string $ca_fromname
 * @property string $ca_cc
 * @property string $ca_replyto
 * @property string $ca_address
 * @property string $ca_attachment
 * @property string $ca_subject
 * @property string $ca_body
 * @property string $ca_bodyhtml
 * @property boolean $ca_readreceipt
 * @property Reporte $Reporte
 * @property Doctrine_Collection $EmailAttachment
 * @property Doctrine_Collection $RepStatus
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 5845 2009-06-09 07:36:57Z jwage $
 */
abstract class BaseEmail extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_emails');
        $this->hasColumn('ca_idemail', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_fchenvio', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuenvio', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_tipo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idcaso', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_from', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fromname', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_cc', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_replyto', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_address', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_attachment', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_subject', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_body', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_bodyhtml', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_readreceipt', 'boolean', null, array(
             'type' => 'boolean',
             ));
    }

    public function setUp()
    {
        $this->hasOne('Reporte', array(
             'local' => 'ca_idcaso',
             'foreign' => 'ca_idreporte'));

        $this->hasMany('EmailAttachment', array(
             'local' => 'ca_idemail',
             'foreign' => 'ca_idemail'));

        $this->hasMany('RepStatus', array(
             'local' => 'ca_idemail',
             'foreign' => 'ca_idemail'));
    }
}