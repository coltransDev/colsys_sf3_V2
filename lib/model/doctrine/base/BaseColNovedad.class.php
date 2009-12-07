<?php

/**
 * BaseColNovedad
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idnovedad
 * @property date $ca_fchpublicacion
 * @property string $ca_asunto
 * @property string $ca_detalle
 * @property date $ca_fcharchivar
 * @property string $ca_extension
 * @property string $ca_header_file
 * @property string $ca_content
 * @property timestamp $ca_fchpublicado
 * @property string $ca_usupublicado
 * 
 * @method integer    getCaIdnovedad()       Returns the current record's "ca_idnovedad" value
 * @method date       getCaFchpublicacion()  Returns the current record's "ca_fchpublicacion" value
 * @method string     getCaAsunto()          Returns the current record's "ca_asunto" value
 * @method string     getCaDetalle()         Returns the current record's "ca_detalle" value
 * @method date       getCaFcharchivar()     Returns the current record's "ca_fcharchivar" value
 * @method string     getCaExtension()       Returns the current record's "ca_extension" value
 * @method string     getCaHeaderFile()      Returns the current record's "ca_header_file" value
 * @method string     getCaContent()         Returns the current record's "ca_content" value
 * @method timestamp  getCaFchpublicado()    Returns the current record's "ca_fchpublicado" value
 * @method string     getCaUsupublicado()    Returns the current record's "ca_usupublicado" value
 * @method ColNovedad setCaIdnovedad()       Sets the current record's "ca_idnovedad" value
 * @method ColNovedad setCaFchpublicacion()  Sets the current record's "ca_fchpublicacion" value
 * @method ColNovedad setCaAsunto()          Sets the current record's "ca_asunto" value
 * @method ColNovedad setCaDetalle()         Sets the current record's "ca_detalle" value
 * @method ColNovedad setCaFcharchivar()     Sets the current record's "ca_fcharchivar" value
 * @method ColNovedad setCaExtension()       Sets the current record's "ca_extension" value
 * @method ColNovedad setCaHeaderFile()      Sets the current record's "ca_header_file" value
 * @method ColNovedad setCaContent()         Sets the current record's "ca_content" value
 * @method ColNovedad setCaFchpublicado()    Sets the current record's "ca_fchpublicado" value
 * @method ColNovedad setCaUsupublicado()    Sets the current record's "ca_usupublicado" value
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseColNovedad extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('tb_colnovedades');
        $this->hasColumn('ca_idnovedad', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('ca_fchpublicacion', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_asunto', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_detalle', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fcharchivar', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_extension', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_header_file', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_content', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchpublicado', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usupublicado', 'string', null, array(
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
        
    }
}