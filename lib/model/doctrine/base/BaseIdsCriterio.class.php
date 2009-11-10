<?php

/**
 * BaseIdsCriterio
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idcriterio
 * @property string $ca_tipo
 * @property string $ca_criterio
 * @property integer $ca_ponderacion
 * @property string $ca_tipocriterio
 * @property boolean $ca_activo
 * @property string $ca_usucreado
 * @property timestamp $ca_fchcreado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchactualizado
 * @property Doctrine_Collection $IdsEvaluacionxCriterio
 * @property Doctrine_Collection $IdsEvento
 * 
 * @method integer             getCaIdcriterio()           Returns the current record's "ca_idcriterio" value
 * @method string              getCaTipo()                 Returns the current record's "ca_tipo" value
 * @method string              getCaCriterio()             Returns the current record's "ca_criterio" value
 * @method integer             getCaPonderacion()          Returns the current record's "ca_ponderacion" value
 * @method string              getCaTipocriterio()         Returns the current record's "ca_tipocriterio" value
 * @method boolean             getCaActivo()               Returns the current record's "ca_activo" value
 * @method string              getCaUsucreado()            Returns the current record's "ca_usucreado" value
 * @method timestamp           getCaFchcreado()            Returns the current record's "ca_fchcreado" value
 * @method string              getCaUsuactualizado()       Returns the current record's "ca_usuactualizado" value
 * @method timestamp           getCaFchactualizado()       Returns the current record's "ca_fchactualizado" value
 * @method Doctrine_Collection getIdsEvaluacionxCriterio() Returns the current record's "IdsEvaluacionxCriterio" collection
 * @method Doctrine_Collection getIdsEvento()              Returns the current record's "IdsEvento" collection
 * @method IdsCriterio         setCaIdcriterio()           Sets the current record's "ca_idcriterio" value
 * @method IdsCriterio         setCaTipo()                 Sets the current record's "ca_tipo" value
 * @method IdsCriterio         setCaCriterio()             Sets the current record's "ca_criterio" value
 * @method IdsCriterio         setCaPonderacion()          Sets the current record's "ca_ponderacion" value
 * @method IdsCriterio         setCaTipocriterio()         Sets the current record's "ca_tipocriterio" value
 * @method IdsCriterio         setCaActivo()               Sets the current record's "ca_activo" value
 * @method IdsCriterio         setCaUsucreado()            Sets the current record's "ca_usucreado" value
 * @method IdsCriterio         setCaFchcreado()            Sets the current record's "ca_fchcreado" value
 * @method IdsCriterio         setCaUsuactualizado()       Sets the current record's "ca_usuactualizado" value
 * @method IdsCriterio         setCaFchactualizado()       Sets the current record's "ca_fchactualizado" value
 * @method IdsCriterio         setIdsEvaluacionxCriterio() Sets the current record's "IdsEvaluacionxCriterio" collection
 * @method IdsCriterio         setIdsEvento()              Sets the current record's "IdsEvento" collection
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6508 2009-10-14 06:28:49Z jwage $
 */
abstract class BaseIdsCriterio extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ids.tb_criterios');
        $this->hasColumn('ca_idcriterio', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_tipo', 'string', 3, array(
             'type' => 'string',
             'length' => '3',
             ));
        $this->hasColumn('ca_criterio', 'string', 60, array(
             'type' => 'string',
             'length' => '60',
             ));
        $this->hasColumn('ca_ponderacion', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));
        $this->hasColumn('ca_tipocriterio', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             ));
        $this->hasColumn('ca_activo', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_usucreado', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_fchcreado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuactualizado', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_fchactualizado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('IdsEvaluacionxCriterio', array(
             'local' => 'ca_idcriterio',
             'foreign' => 'ca_idcriterio'));

        $this->hasMany('IdsEvento', array(
             'local' => 'ca_idcriterio',
             'foreign' => 'ca_idcriterio'));
    }
}