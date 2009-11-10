<?php

/**
 * BaseIdsEvento
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idevento
 * @property integer $ca_id
 * @property string $ca_evento
 * @property string $ca_referencia
 * @property integer $ca_idcriterio
 * @property string $ca_usucreado
 * @property timestamp $ca_fchcreado
 * @property IdsCriterio $IdsCriterio
 * @property Ids $Ids
 * 
 * @method integer     getCaIdevento()    Returns the current record's "ca_idevento" value
 * @method integer     getCaId()          Returns the current record's "ca_id" value
 * @method string      getCaEvento()      Returns the current record's "ca_evento" value
 * @method string      getCaReferencia()  Returns the current record's "ca_referencia" value
 * @method integer     getCaIdcriterio()  Returns the current record's "ca_idcriterio" value
 * @method string      getCaUsucreado()   Returns the current record's "ca_usucreado" value
 * @method timestamp   getCaFchcreado()   Returns the current record's "ca_fchcreado" value
 * @method IdsCriterio getIdsCriterio()   Returns the current record's "IdsCriterio" value
 * @method Ids         getIds()           Returns the current record's "Ids" value
 * @method IdsEvento   setCaIdevento()    Sets the current record's "ca_idevento" value
 * @method IdsEvento   setCaId()          Sets the current record's "ca_id" value
 * @method IdsEvento   setCaEvento()      Sets the current record's "ca_evento" value
 * @method IdsEvento   setCaReferencia()  Sets the current record's "ca_referencia" value
 * @method IdsEvento   setCaIdcriterio()  Sets the current record's "ca_idcriterio" value
 * @method IdsEvento   setCaUsucreado()   Sets the current record's "ca_usucreado" value
 * @method IdsEvento   setCaFchcreado()   Sets the current record's "ca_fchcreado" value
 * @method IdsEvento   setIdsCriterio()   Sets the current record's "IdsCriterio" value
 * @method IdsEvento   setIds()           Sets the current record's "Ids" value
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6508 2009-10-14 06:28:49Z jwage $
 */
abstract class BaseIdsEvento extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ids.tb_eventos');
        $this->hasColumn('ca_idevento', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_evento', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_referencia', 'string', 16, array(
             'type' => 'string',
             'length' => '16',
             ));
        $this->hasColumn('ca_idcriterio', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_usucreado', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('IdsCriterio', array(
             'local' => 'ca_idcriterio',
             'foreign' => 'ca_idcriterio'));

        $this->hasOne('Ids', array(
             'local' => 'ca_id',
             'foreign' => 'ca_id'));
    }
}