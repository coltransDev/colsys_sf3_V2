<?php

/**
 * BaseCliente
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $ca_idcliente
 * @property string $ca_compania
 * @property string $ca_idalterno
 * @property integer $ca_tipoidentificacion
 * @property integer $ca_digito
 * @property string $ca_papellido
 * @property string $ca_sapellido
 * @property string $ca_nombres
 * @property string $ca_saludo
 * @property string $ca_sexo
 * @property string $ca_cumpleanos
 * @property string $ca_direccion
 * @property string $ca_oficina
 * @property string $ca_torre
 * @property string $ca_bloque
 * @property string $ca_interior
 * @property string $ca_localidad
 * @property string $ca_complemento
 * @property string $ca_telefonos
 * @property string $ca_fax
 * @property string $ca_idciudad
 * @property string $ca_website
 * @property string $ca_email
 * @property string $ca_actividad
 * @property string $ca_sectoreco
 * @property string $ca_vendedor
 * @property string $ca_status
 * @property string $ca_calificacion
 * @property string $ca_preferencias
 * @property string $ca_confirmar
 * @property string $ca_coordinador
 * @property date $ca_fchcircular
 * @property string $ca_nvlriesgo
 * @property date $ca_fchcotratoag
 * @property string $ca_listaclinton
 * @property string $ca_leyinsolvencia
 * @property string $ca_comentario
 * @property string $ca_idgrupo
 * @property string $ca_tipo
 * @property string $ca_propiedades
 * @property string $ca_entidad
 * @property timestamp $ca_fchcreado
 * @property string $ca_usucreado
 * @property timestamp $ca_fchactualizado
 * @property string $ca_usuactualizado
 * @property timestamp $ca_fchfinanciero
 * @property string $ca_usufinanciero
 * @property date $ca_fchacuerdoconf
 * @property string $ca_zipcode
 * @property string $ca_stdcircular
 * @property Ids $Ids
 * @property Doctrine_Collection $Contacto
 * @property Usuario $Usuario
 * @property Ciudad $Ciudad
 * @property Doctrine_Collection $StdCliente
 * @property LibCliente $LibCliente
 * @property Doctrine_Collection $ManCliente
 * @property Doctrine_Collection $DocCliente
 * @property Doctrine_Collection $IdsBalance
 * @property Doctrine_Collection $AduCliente
 * @property FichaTecnica $FichaTecnica
 * @property Doctrine_Collection $InoMaestraAdu
 * @property Doctrine_Collection $TransporteAdu
 * @property Doctrine_Collection $UsuParametros
 * @property Doctrine_Collection $ViControlEncuesta
 * @property Doctrine_Collection $IdgEventos
 * @property Doctrine_Collection $InoHouse
 * @property Doctrine_Collection $InoClientesSea
 * @property Doctrine_Collection $InoClientesAir
 * @property Doctrine_Collection $InoMaestraExpo
 * @property Doctrine_Collection $ConceptoAduanaCliente
 * @property Doctrine_Collection $PricRecargoCliente
 * @property Doctrine_Collection $PricRecargoClienteBs
 * @property Doctrine_Collection $ComCliente
 * @property Doctrine_Collection $PorcentajesComisiones
 * @property Doctrine_Collection $Reporte
 * 
 * @method integer             getCaIdcliente()           Returns the current record's "ca_idcliente" value
 * @method string              getCaCompania()            Returns the current record's "ca_compania" value
 * @method string              getCaIdalterno()           Returns the current record's "ca_idalterno" value
 * @method integer             getCaTipoidentificacion()  Returns the current record's "ca_tipoidentificacion" value
 * @method integer             getCaDigito()              Returns the current record's "ca_digito" value
 * @method string              getCaPapellido()           Returns the current record's "ca_papellido" value
 * @method string              getCaSapellido()           Returns the current record's "ca_sapellido" value
 * @method string              getCaNombres()             Returns the current record's "ca_nombres" value
 * @method string              getCaSaludo()              Returns the current record's "ca_saludo" value
 * @method string              getCaSexo()                Returns the current record's "ca_sexo" value
 * @method string              getCaCumpleanos()          Returns the current record's "ca_cumpleanos" value
 * @method string              getCaDireccion()           Returns the current record's "ca_direccion" value
 * @method string              getCaOficina()             Returns the current record's "ca_oficina" value
 * @method string              getCaTorre()               Returns the current record's "ca_torre" value
 * @method string              getCaBloque()              Returns the current record's "ca_bloque" value
 * @method string              getCaInterior()            Returns the current record's "ca_interior" value
 * @method string              getCaLocalidad()           Returns the current record's "ca_localidad" value
 * @method string              getCaComplemento()         Returns the current record's "ca_complemento" value
 * @method string              getCaTelefonos()           Returns the current record's "ca_telefonos" value
 * @method string              getCaFax()                 Returns the current record's "ca_fax" value
 * @method string              getCaIdciudad()            Returns the current record's "ca_idciudad" value
 * @method string              getCaWebsite()             Returns the current record's "ca_website" value
 * @method string              getCaEmail()               Returns the current record's "ca_email" value
 * @method string              getCaActividad()           Returns the current record's "ca_actividad" value
 * @method string              getCaSectoreco()           Returns the current record's "ca_sectoreco" value
 * @method string              getCaVendedor()            Returns the current record's "ca_vendedor" value
 * @method string              getCaStatus()              Returns the current record's "ca_status" value
 * @method string              getCaCalificacion()        Returns the current record's "ca_calificacion" value
 * @method string              getCaPreferencias()        Returns the current record's "ca_preferencias" value
 * @method string              getCaConfirmar()           Returns the current record's "ca_confirmar" value
 * @method string              getCaCoordinador()         Returns the current record's "ca_coordinador" value
 * @method date                getCaFchcircular()         Returns the current record's "ca_fchcircular" value
 * @method string              getCaNvlriesgo()           Returns the current record's "ca_nvlriesgo" value
 * @method date                getCaFchcotratoag()        Returns the current record's "ca_fchcotratoag" value
 * @method string              getCaListaclinton()        Returns the current record's "ca_listaclinton" value
 * @method string              getCaLeyinsolvencia()      Returns the current record's "ca_leyinsolvencia" value
 * @method string              getCaComentario()          Returns the current record's "ca_comentario" value
 * @method string              getCaIdgrupo()             Returns the current record's "ca_idgrupo" value
 * @method string              getCaTipo()                Returns the current record's "ca_tipo" value
 * @method string              getCaPropiedades()         Returns the current record's "ca_propiedades" value
 * @method string              getCaEntidad()             Returns the current record's "ca_entidad" value
 * @method timestamp           getCaFchcreado()           Returns the current record's "ca_fchcreado" value
 * @method string              getCaUsucreado()           Returns the current record's "ca_usucreado" value
 * @method timestamp           getCaFchactualizado()      Returns the current record's "ca_fchactualizado" value
 * @method string              getCaUsuactualizado()      Returns the current record's "ca_usuactualizado" value
 * @method timestamp           getCaFchfinanciero()       Returns the current record's "ca_fchfinanciero" value
 * @method string              getCaUsufinanciero()       Returns the current record's "ca_usufinanciero" value
 * @method date                getCaFchacuerdoconf()      Returns the current record's "ca_fchacuerdoconf" value
 * @method string              getCaZipcode()             Returns the current record's "ca_zipcode" value
 * @method string              getCaStdcircular()         Returns the current record's "ca_stdcircular" value
 * @method Ids                 getIds()                   Returns the current record's "Ids" value
 * @method Doctrine_Collection getContacto()              Returns the current record's "Contacto" collection
 * @method Usuario             getUsuario()               Returns the current record's "Usuario" value
 * @method Ciudad              getCiudad()                Returns the current record's "Ciudad" value
 * @method Doctrine_Collection getStdCliente()            Returns the current record's "StdCliente" collection
 * @method LibCliente          getLibCliente()            Returns the current record's "LibCliente" value
 * @method Doctrine_Collection getManCliente()            Returns the current record's "ManCliente" collection
 * @method Doctrine_Collection getDocCliente()            Returns the current record's "DocCliente" collection
 * @method Doctrine_Collection getIdsBalance()            Returns the current record's "IdsBalance" collection
 * @method Doctrine_Collection getAduCliente()            Returns the current record's "AduCliente" collection
 * @method FichaTecnica        getFichaTecnica()          Returns the current record's "FichaTecnica" value
 * @method Doctrine_Collection getInoMaestraAdu()         Returns the current record's "InoMaestraAdu" collection
 * @method Doctrine_Collection getTransporteAdu()         Returns the current record's "TransporteAdu" collection
 * @method Doctrine_Collection getUsuParametros()         Returns the current record's "UsuParametros" collection
 * @method Doctrine_Collection getViControlEncuesta()     Returns the current record's "ViControlEncuesta" collection
 * @method Doctrine_Collection getIdgEventos()            Returns the current record's "IdgEventos" collection
 * @method Doctrine_Collection getInoHouse()              Returns the current record's "InoHouse" collection
 * @method Doctrine_Collection getInoClientesSea()        Returns the current record's "InoClientesSea" collection
 * @method Doctrine_Collection getInoClientesAir()        Returns the current record's "InoClientesAir" collection
 * @method Doctrine_Collection getInoMaestraExpo()        Returns the current record's "InoMaestraExpo" collection
 * @method Doctrine_Collection getConceptoAduanaCliente() Returns the current record's "ConceptoAduanaCliente" collection
 * @method Doctrine_Collection getPricRecargoCliente()    Returns the current record's "PricRecargoCliente" collection
 * @method Doctrine_Collection getPricRecargoClienteBs()  Returns the current record's "PricRecargoClienteBs" collection
 * @method Doctrine_Collection getComCliente()            Returns the current record's "ComCliente" collection
 * @method Doctrine_Collection getPorcentajesComisiones() Returns the current record's "PorcentajesComisiones" collection
 * @method Doctrine_Collection getReporte()               Returns the current record's "Reporte" collection
 * @method Cliente             setCaIdcliente()           Sets the current record's "ca_idcliente" value
 * @method Cliente             setCaCompania()            Sets the current record's "ca_compania" value
 * @method Cliente             setCaIdalterno()           Sets the current record's "ca_idalterno" value
 * @method Cliente             setCaTipoidentificacion()  Sets the current record's "ca_tipoidentificacion" value
 * @method Cliente             setCaDigito()              Sets the current record's "ca_digito" value
 * @method Cliente             setCaPapellido()           Sets the current record's "ca_papellido" value
 * @method Cliente             setCaSapellido()           Sets the current record's "ca_sapellido" value
 * @method Cliente             setCaNombres()             Sets the current record's "ca_nombres" value
 * @method Cliente             setCaSaludo()              Sets the current record's "ca_saludo" value
 * @method Cliente             setCaSexo()                Sets the current record's "ca_sexo" value
 * @method Cliente             setCaCumpleanos()          Sets the current record's "ca_cumpleanos" value
 * @method Cliente             setCaDireccion()           Sets the current record's "ca_direccion" value
 * @method Cliente             setCaOficina()             Sets the current record's "ca_oficina" value
 * @method Cliente             setCaTorre()               Sets the current record's "ca_torre" value
 * @method Cliente             setCaBloque()              Sets the current record's "ca_bloque" value
 * @method Cliente             setCaInterior()            Sets the current record's "ca_interior" value
 * @method Cliente             setCaLocalidad()           Sets the current record's "ca_localidad" value
 * @method Cliente             setCaComplemento()         Sets the current record's "ca_complemento" value
 * @method Cliente             setCaTelefonos()           Sets the current record's "ca_telefonos" value
 * @method Cliente             setCaFax()                 Sets the current record's "ca_fax" value
 * @method Cliente             setCaIdciudad()            Sets the current record's "ca_idciudad" value
 * @method Cliente             setCaWebsite()             Sets the current record's "ca_website" value
 * @method Cliente             setCaEmail()               Sets the current record's "ca_email" value
 * @method Cliente             setCaActividad()           Sets the current record's "ca_actividad" value
 * @method Cliente             setCaSectoreco()           Sets the current record's "ca_sectoreco" value
 * @method Cliente             setCaVendedor()            Sets the current record's "ca_vendedor" value
 * @method Cliente             setCaStatus()              Sets the current record's "ca_status" value
 * @method Cliente             setCaCalificacion()        Sets the current record's "ca_calificacion" value
 * @method Cliente             setCaPreferencias()        Sets the current record's "ca_preferencias" value
 * @method Cliente             setCaConfirmar()           Sets the current record's "ca_confirmar" value
 * @method Cliente             setCaCoordinador()         Sets the current record's "ca_coordinador" value
 * @method Cliente             setCaFchcircular()         Sets the current record's "ca_fchcircular" value
 * @method Cliente             setCaNvlriesgo()           Sets the current record's "ca_nvlriesgo" value
 * @method Cliente             setCaFchcotratoag()        Sets the current record's "ca_fchcotratoag" value
 * @method Cliente             setCaListaclinton()        Sets the current record's "ca_listaclinton" value
 * @method Cliente             setCaLeyinsolvencia()      Sets the current record's "ca_leyinsolvencia" value
 * @method Cliente             setCaComentario()          Sets the current record's "ca_comentario" value
 * @method Cliente             setCaIdgrupo()             Sets the current record's "ca_idgrupo" value
 * @method Cliente             setCaTipo()                Sets the current record's "ca_tipo" value
 * @method Cliente             setCaPropiedades()         Sets the current record's "ca_propiedades" value
 * @method Cliente             setCaEntidad()             Sets the current record's "ca_entidad" value
 * @method Cliente             setCaFchcreado()           Sets the current record's "ca_fchcreado" value
 * @method Cliente             setCaUsucreado()           Sets the current record's "ca_usucreado" value
 * @method Cliente             setCaFchactualizado()      Sets the current record's "ca_fchactualizado" value
 * @method Cliente             setCaUsuactualizado()      Sets the current record's "ca_usuactualizado" value
 * @method Cliente             setCaFchfinanciero()       Sets the current record's "ca_fchfinanciero" value
 * @method Cliente             setCaUsufinanciero()       Sets the current record's "ca_usufinanciero" value
 * @method Cliente             setCaFchacuerdoconf()      Sets the current record's "ca_fchacuerdoconf" value
 * @method Cliente             setCaZipcode()             Sets the current record's "ca_zipcode" value
 * @method Cliente             setCaStdcircular()         Sets the current record's "ca_stdcircular" value
 * @method Cliente             setIds()                   Sets the current record's "Ids" value
 * @method Cliente             setContacto()              Sets the current record's "Contacto" collection
 * @method Cliente             setUsuario()               Sets the current record's "Usuario" value
 * @method Cliente             setCiudad()                Sets the current record's "Ciudad" value
 * @method Cliente             setStdCliente()            Sets the current record's "StdCliente" collection
 * @method Cliente             setLibCliente()            Sets the current record's "LibCliente" value
 * @method Cliente             setManCliente()            Sets the current record's "ManCliente" collection
 * @method Cliente             setDocCliente()            Sets the current record's "DocCliente" collection
 * @method Cliente             setIdsBalance()            Sets the current record's "IdsBalance" collection
 * @method Cliente             setAduCliente()            Sets the current record's "AduCliente" collection
 * @method Cliente             setFichaTecnica()          Sets the current record's "FichaTecnica" value
 * @method Cliente             setInoMaestraAdu()         Sets the current record's "InoMaestraAdu" collection
 * @method Cliente             setTransporteAdu()         Sets the current record's "TransporteAdu" collection
 * @method Cliente             setUsuParametros()         Sets the current record's "UsuParametros" collection
 * @method Cliente             setViControlEncuesta()     Sets the current record's "ViControlEncuesta" collection
 * @method Cliente             setIdgEventos()            Sets the current record's "IdgEventos" collection
 * @method Cliente             setInoHouse()              Sets the current record's "InoHouse" collection
 * @method Cliente             setInoClientesSea()        Sets the current record's "InoClientesSea" collection
 * @method Cliente             setInoClientesAir()        Sets the current record's "InoClientesAir" collection
 * @method Cliente             setInoMaestraExpo()        Sets the current record's "InoMaestraExpo" collection
 * @method Cliente             setConceptoAduanaCliente() Sets the current record's "ConceptoAduanaCliente" collection
 * @method Cliente             setPricRecargoCliente()    Sets the current record's "PricRecargoCliente" collection
 * @method Cliente             setPricRecargoClienteBs()  Sets the current record's "PricRecargoClienteBs" collection
 * @method Cliente             setComCliente()            Sets the current record's "ComCliente" collection
 * @method Cliente             setPorcentajesComisiones() Sets the current record's "PorcentajesComisiones" collection
 * @method Cliente             setReporte()               Sets the current record's "Reporte" collection
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseCliente extends myDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('vi_clientes_reduc');
        $this->hasColumn('ca_idcliente', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('ca_compania', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idalterno', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_tipoidentificacion', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_digito', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('ca_papellido', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_sapellido', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_nombres', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_saludo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_sexo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_cumpleanos', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_direccion', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_oficina', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_torre', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_bloque', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_interior', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_localidad', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_complemento', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_telefonos', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fax', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idciudad', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_website', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_email', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_actividad', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_sectoreco', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_vendedor', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_status', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_calificacion', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_preferencias', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_confirmar', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_coordinador', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchcircular', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_nvlriesgo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchcotratoag', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_listaclinton', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_leyinsolvencia', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_comentario', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_idgrupo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_tipo', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_propiedades', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_entidad', 'string', null, array(
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
        $this->hasColumn('ca_fchfinanciero', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('ca_usufinanciero', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('ca_fchacuerdoconf', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('ca_zipcode', 'string', 20, array(
             'type' => 'string',
             'length' => '20',
             ));
        $this->hasColumn('ca_stdcircular', 'string', null, array(
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
        $this->hasOne('Ids', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_id'));

        $this->hasMany('Contacto', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idcliente'));

        $this->hasOne('Usuario', array(
             'local' => 'ca_vendedor',
             'foreign' => 'ca_login'));

        $this->hasOne('Ciudad', array(
             'local' => 'ca_idciudad',
             'foreign' => 'ca_idciudad'));

        $this->hasMany('StdCliente', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idcliente'));

        $this->hasOne('LibCliente', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idcliente'));

        $this->hasMany('ManCliente', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idcliente'));

        $this->hasMany('DocCliente', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idcliente'));

        $this->hasMany('IdsBalance', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_id'));

        $this->hasMany('AduCliente', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idcliente'));

        $this->hasOne('FichaTecnica', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idcliente'));

        $this->hasMany('InoMaestraAdu', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idcliente'));

        $this->hasMany('TransporteAdu', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idcliente'));

        $this->hasMany('UsuParametros', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idcliente'));

        $this->hasMany('ViControlEncuesta', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idcliente'));

        $this->hasMany('IdgEventos', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idcliente'));

        $this->hasMany('InoHouse', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idcliente'));

        $this->hasMany('InoClientesSea', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idcliente'));

        $this->hasMany('InoClientesAir', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idcliente'));

        $this->hasMany('InoMaestraExpo', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idcliente'));

        $this->hasMany('ConceptoAduanaCliente', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idcliente'));

        $this->hasMany('PricRecargoCliente', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idcliente'));

        $this->hasMany('PricRecargoClienteBs', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idcliente'));

        $this->hasMany('ComCliente', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idcliente'));

        $this->hasMany('PorcentajesComisiones', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idcliente'));

        $this->hasMany('Reporte', array(
             'local' => 'ca_idcliente',
             'foreign' => 'ca_idclientefac'));
    }
}