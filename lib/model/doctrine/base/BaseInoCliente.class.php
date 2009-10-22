<?php

/**
 * BaseInoCliente
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idinocliente
 * @property integer $ca_idmaestra
 * @property integer $ca_idcliente
 * @property string $ca_hbls
 * @property date $ca_fchhbls
 * @property integer $ca_idreporte
 * @property integer $ca_idproveedor
 * @property string $ca_proveedor
 * @property decimal $ca_numpiezas
 * @property decimal $ca_peso
 * @property decimal $ca_volumen
 * @property string $ca_numorden
 * @property string $ca_vendedor
 * @property integer $ca_idsubtrayecto
 * @property integer $ca_idbodega
 * @property string $ca_observaciones
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property Cliente $Cliente
 * @property Doctrine_Collection $InoMaestra
 * @property Tercero $Proveedor
 * @property Usuario $Vendedor
 * @property Usuario $UsuCreado
 * @property Usuario $UsuActualizado
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6508 2009-10-14 06:28:49Z jwage $
 */
abstract class BaseInoCliente extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('ino.tb_clientes');
        $this->hasColumn('ca_idinocliente', 'integer', null, array(
             'type' => 'integer',
             'autoincrement' => true,
             'primary' => true,
             ));
        $this->hasColumn('ca_idmaestra', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('ca_idcliente', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('ca_hbls', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('ca_fchhbls', 'date', null, array(
             'type' => 'date',
             'notnull' => true,
             ));
        $this->hasColumn('ca_idreporte', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('ca_idproveedor', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('ca_proveedor', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_numpiezas', 'decimal', null, array(
             'type' => 'decimal',
             'notnull' => true,
             ));
        $this->hasColumn('ca_peso', 'decimal', null, array(
             'type' => 'decimal',
             'notnull' => true,
             ));
        $this->hasColumn('ca_volumen', 'decimal', null, array(
             'type' => 'decimal',
             'notnull' => true,
             ));
        $this->hasColumn('ca_numorden', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('ca_vendedor', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
        $this->hasColumn('ca_idsubtrayecto', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_idbodega', 'integer', null, array(
             'type' => 'integer',
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
        $this->hasColumn('ca_fchactualizado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usuactualizado', 'string', null, array(
             'type' => 'string',
             ));


        $this->setAttribute(Doctrine_Core::ATTR_EXPORT, Doctrine_Core::EXPORT_TABLES);
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Cliente', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idcliente'));

        $this->hasMany('InoMaestra', array(
             'local' => 'ca_idmaestra',
             'foreign' => 'ca_idmaestra'));

        $this->hasOne('Tercero as Proveedor', array(
             'local' => 'ca_idproveedor',
             'foreign' => 'ca_idtercero'));

        $this->hasOne('Usuario as Vendedor', array(
             'local' => 'ca_vendedor',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as UsuCreado', array(
             'local' => 'ca_usucreado',
             'foreign' => 'ca_login'));

        $this->hasOne('Usuario as UsuActualizado', array(
             'local' => 'ca_usuactualizado',
             'foreign' => 'ca_login'));
    }
}