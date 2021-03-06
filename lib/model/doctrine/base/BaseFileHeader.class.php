<?php

/**
 * BaseFileHeader
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idfileheader
 * @property string $ca_descripcion
 * @property string $ca_tipoarchivo
 * @property string $ca_separador
 * @property boolean $ca_separadordec
 * @property string $ca_in_out
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property Doctrine_Collection $FileColumn
 * @property Doctrine_Collection $FileImported
 * 
 * @method integer             getCaIdfileheader()    Returns the current record's "ca_idfileheader" value
 * @method string              getCaDescripcion()     Returns the current record's "ca_descripcion" value
 * @method string              getCaTipoarchivo()     Returns the current record's "ca_tipoarchivo" value
 * @method string              getCaSeparador()       Returns the current record's "ca_separador" value
 * @method boolean             getCaSeparadordec()    Returns the current record's "ca_separadordec" value
 * @method string              getCaInOut()           Returns the current record's "ca_in_out" value
 * @method timestamp           getCaFchcreado()       Returns the current record's "ca_fchcreado" value
 * @method string              getCaUsucreado()       Returns the current record's "ca_usucreado" value
 * @method timestamp           getCaFchactualizado()  Returns the current record's "ca_fchactualizado" value
 * @method string              getCaUsuactualizado()  Returns the current record's "ca_usuactualizado" value
 * @method Doctrine_Collection getFileColumn()        Returns the current record's "FileColumn" collection
 * @method Doctrine_Collection getFileImported()      Returns the current record's "FileImported" collection
 * @method FileHeader          setCaIdfileheader()    Sets the current record's "ca_idfileheader" value
 * @method FileHeader          setCaDescripcion()     Sets the current record's "ca_descripcion" value
 * @method FileHeader          setCaTipoarchivo()     Sets the current record's "ca_tipoarchivo" value
 * @method FileHeader          setCaSeparador()       Sets the current record's "ca_separador" value
 * @method FileHeader          setCaSeparadordec()    Sets the current record's "ca_separadordec" value
 * @method FileHeader          setCaInOut()           Sets the current record's "ca_in_out" value
 * @method FileHeader          setCaFchcreado()       Sets the current record's "ca_fchcreado" value
 * @method FileHeader          setCaUsucreado()       Sets the current record's "ca_usucreado" value
 * @method FileHeader          setCaFchactualizado()  Sets the current record's "ca_fchactualizado" value
 * @method FileHeader          setCaUsuactualizado()  Sets the current record's "ca_usuactualizado" value
 * @method FileHeader          setFileColumn()        Sets the current record's "FileColumn" collection
 * @method FileHeader          setFileImported()      Sets the current record's "FileImported" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseFileHeader extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_fileheader');
        $this->hasColumn('ca_idfileheader', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_descripcion', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_tipoarchivo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_separador', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_separadordec', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('ca_in_out', 'string', null, array(
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

        $this->option('symfony', array(
             'form' => false,
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('FileColumn', array(
             'local' => 'ca_idfileheader',
             'foreign' => 'ca_idfileheader'));

        $this->hasMany('FileImported', array(
             'local' => 'ca_idfileheader',
             'foreign' => 'ca_idfileheader'));
    }
}