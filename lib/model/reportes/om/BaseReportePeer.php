<?php

/**
 * Base static class for performing query and update operations on the 'tb_reportes' table.
 *
 * 
 *
 * @package    lib.model.reportes.om
 */
abstract class BaseReportePeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_reportes';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.reportes.Reporte';

	/** The total number of columns. */
	const NUM_COLUMNS = 53;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the CA_IDREPORTE field */
	const CA_IDREPORTE = 'tb_reportes.CA_IDREPORTE';

	/** the column name for the CA_FCHREPORTE field */
	const CA_FCHREPORTE = 'tb_reportes.CA_FCHREPORTE';

	/** the column name for the CA_CONSECUTIVO field */
	const CA_CONSECUTIVO = 'tb_reportes.CA_CONSECUTIVO';

	/** the column name for the CA_VERSION field */
	const CA_VERSION = 'tb_reportes.CA_VERSION';

	/** the column name for the CA_IDCOTIZACION field */
	const CA_IDCOTIZACION = 'tb_reportes.CA_IDCOTIZACION';

	/** the column name for the CA_ORIGEN field */
	const CA_ORIGEN = 'tb_reportes.CA_ORIGEN';

	/** the column name for the CA_DESTINO field */
	const CA_DESTINO = 'tb_reportes.CA_DESTINO';

	/** the column name for the CA_IMPOEXPO field */
	const CA_IMPOEXPO = 'tb_reportes.CA_IMPOEXPO';

	/** the column name for the CA_FCHDESPACHO field */
	const CA_FCHDESPACHO = 'tb_reportes.CA_FCHDESPACHO';

	/** the column name for the CA_IDAGENTE field */
	const CA_IDAGENTE = 'tb_reportes.CA_IDAGENTE';

	/** the column name for the CA_INCOTERMS field */
	const CA_INCOTERMS = 'tb_reportes.CA_INCOTERMS';

	/** the column name for the CA_MERCANCIA_DESC field */
	const CA_MERCANCIA_DESC = 'tb_reportes.CA_MERCANCIA_DESC';

	/** the column name for the CA_IDPROVEEDOR field */
	const CA_IDPROVEEDOR = 'tb_reportes.CA_IDPROVEEDOR';

	/** the column name for the CA_ORDEN_PROV field */
	const CA_ORDEN_PROV = 'tb_reportes.CA_ORDEN_PROV';

	/** the column name for the CA_IDCONCLIENTE field */
	const CA_IDCONCLIENTE = 'tb_reportes.CA_IDCONCLIENTE';

	/** the column name for the CA_ORDEN_CLIE field */
	const CA_ORDEN_CLIE = 'tb_reportes.CA_ORDEN_CLIE';

	/** the column name for the CA_CONFIRMAR_CLIE field */
	const CA_CONFIRMAR_CLIE = 'tb_reportes.CA_CONFIRMAR_CLIE';

	/** the column name for the CA_IDREPRESENTANTE field */
	const CA_IDREPRESENTANTE = 'tb_reportes.CA_IDREPRESENTANTE';

	/** the column name for the CA_INFORMAR_REPR field */
	const CA_INFORMAR_REPR = 'tb_reportes.CA_INFORMAR_REPR';

	/** the column name for the CA_IDCONSIGNATARIO field */
	const CA_IDCONSIGNATARIO = 'tb_reportes.CA_IDCONSIGNATARIO';

	/** the column name for the CA_INFORMAR_CONS field */
	const CA_INFORMAR_CONS = 'tb_reportes.CA_INFORMAR_CONS';

	/** the column name for the CA_IDNOTIFY field */
	const CA_IDNOTIFY = 'tb_reportes.CA_IDNOTIFY';

	/** the column name for the CA_INFORMAR_NOTI field */
	const CA_INFORMAR_NOTI = 'tb_reportes.CA_INFORMAR_NOTI';

	/** the column name for the CA_NOTIFY field */
	const CA_NOTIFY = 'tb_reportes.CA_NOTIFY';

	/** the column name for the CA_TRANSPORTE field */
	const CA_TRANSPORTE = 'tb_reportes.CA_TRANSPORTE';

	/** the column name for the CA_MODALIDAD field */
	const CA_MODALIDAD = 'tb_reportes.CA_MODALIDAD';

	/** the column name for the CA_SEGURO field */
	const CA_SEGURO = 'tb_reportes.CA_SEGURO';

	/** the column name for the CA_LIBERACION field */
	const CA_LIBERACION = 'tb_reportes.CA_LIBERACION';

	/** the column name for the CA_TIEMPOCREDITO field */
	const CA_TIEMPOCREDITO = 'tb_reportes.CA_TIEMPOCREDITO';

	/** the column name for the CA_PREFERENCIAS_CLIE field */
	const CA_PREFERENCIAS_CLIE = 'tb_reportes.CA_PREFERENCIAS_CLIE';

	/** the column name for the CA_INSTRUCCIONES field */
	const CA_INSTRUCCIONES = 'tb_reportes.CA_INSTRUCCIONES';

	/** the column name for the CA_IDLINEA field */
	const CA_IDLINEA = 'tb_reportes.CA_IDLINEA';

	/** the column name for the CA_IDCONSIGNAR field */
	const CA_IDCONSIGNAR = 'tb_reportes.CA_IDCONSIGNAR';

	/** the column name for the CA_IDCONSIGNARMASTER field */
	const CA_IDCONSIGNARMASTER = 'tb_reportes.CA_IDCONSIGNARMASTER';

	/** the column name for the CA_IDBODEGA field */
	const CA_IDBODEGA = 'tb_reportes.CA_IDBODEGA';

	/** the column name for the CA_MASTERSAME field */
	const CA_MASTERSAME = 'tb_reportes.CA_MASTERSAME';

	/** the column name for the CA_CONTINUACION field */
	const CA_CONTINUACION = 'tb_reportes.CA_CONTINUACION';

	/** the column name for the CA_CONTINUACION_DEST field */
	const CA_CONTINUACION_DEST = 'tb_reportes.CA_CONTINUACION_DEST';

	/** the column name for the CA_CONTINUACION_CONF field */
	const CA_CONTINUACION_CONF = 'tb_reportes.CA_CONTINUACION_CONF';

	/** the column name for the CA_ETAPA_ACTUAL field */
	const CA_ETAPA_ACTUAL = 'tb_reportes.CA_ETAPA_ACTUAL';

	/** the column name for the CA_LOGIN field */
	const CA_LOGIN = 'tb_reportes.CA_LOGIN';

	/** the column name for the CA_FCHCREADO field */
	const CA_FCHCREADO = 'tb_reportes.CA_FCHCREADO';

	/** the column name for the CA_USUCREADO field */
	const CA_USUCREADO = 'tb_reportes.CA_USUCREADO';

	/** the column name for the CA_FCHACTUALIZADO field */
	const CA_FCHACTUALIZADO = 'tb_reportes.CA_FCHACTUALIZADO';

	/** the column name for the CA_USUACTUALIZADO field */
	const CA_USUACTUALIZADO = 'tb_reportes.CA_USUACTUALIZADO';

	/** the column name for the CA_FCHANULADO field */
	const CA_FCHANULADO = 'tb_reportes.CA_FCHANULADO';

	/** the column name for the CA_USUANULADO field */
	const CA_USUANULADO = 'tb_reportes.CA_USUANULADO';

	/** the column name for the CA_FCHCERRADO field */
	const CA_FCHCERRADO = 'tb_reportes.CA_FCHCERRADO';

	/** the column name for the CA_USUCERRADO field */
	const CA_USUCERRADO = 'tb_reportes.CA_USUCERRADO';

	/** the column name for the CA_COLMAS field */
	const CA_COLMAS = 'tb_reportes.CA_COLMAS';

	/** the column name for the CA_PROPIEDADES field */
	const CA_PROPIEDADES = 'tb_reportes.CA_PROPIEDADES';

	/** the column name for the CA_IDETAPA field */
	const CA_IDETAPA = 'tb_reportes.CA_IDETAPA';

	/** the column name for the CA_FCHULTSTATUS field */
	const CA_FCHULTSTATUS = 'tb_reportes.CA_FCHULTSTATUS';

	/**
	 * An identiy map to hold any loaded instances of Reporte objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array Reporte[]
	 */
	public static $instances = array();

	/**
	 * The MapBuilder instance for this peer.
	 * @var        MapBuilder
	 */
	private static $mapBuilder = null;

	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdreporte', 'CaFchreporte', 'CaConsecutivo', 'CaVersion', 'CaIdcotizacion', 'CaOrigen', 'CaDestino', 'CaImpoexpo', 'CaFchdespacho', 'CaIdagente', 'CaIncoterms', 'CaMercanciaDesc', 'CaIdproveedor', 'CaOrdenProv', 'CaIdconcliente', 'CaOrdenClie', 'CaConfirmarClie', 'CaIdrepresentante', 'CaInformarRepr', 'CaIdconsignatario', 'CaInformarCons', 'CaIdnotify', 'CaInformarNoti', 'CaNotify', 'CaTransporte', 'CaModalidad', 'CaSeguro', 'CaLiberacion', 'CaTiempocredito', 'CaPreferenciasClie', 'CaInstrucciones', 'CaIdlinea', 'CaIdconsignar', 'CaIdconsignarmaster', 'CaIdbodega', 'CaMastersame', 'CaContinuacion', 'CaContinuacionDest', 'CaContinuacionConf', 'CaEtapaActual', 'CaLogin', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', 'CaFchanulado', 'CaUsuanulado', 'CaFchcerrado', 'CaUsucerrado', 'CaColmas', 'CaPropiedades', 'CaIdetapa', 'CaFchultstatus', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdreporte', 'caFchreporte', 'caConsecutivo', 'caVersion', 'caIdcotizacion', 'caOrigen', 'caDestino', 'caImpoexpo', 'caFchdespacho', 'caIdagente', 'caIncoterms', 'caMercanciaDesc', 'caIdproveedor', 'caOrdenProv', 'caIdconcliente', 'caOrdenClie', 'caConfirmarClie', 'caIdrepresentante', 'caInformarRepr', 'caIdconsignatario', 'caInformarCons', 'caIdnotify', 'caInformarNoti', 'caNotify', 'caTransporte', 'caModalidad', 'caSeguro', 'caLiberacion', 'caTiempocredito', 'caPreferenciasClie', 'caInstrucciones', 'caIdlinea', 'caIdconsignar', 'caIdconsignarmaster', 'caIdbodega', 'caMastersame', 'caContinuacion', 'caContinuacionDest', 'caContinuacionConf', 'caEtapaActual', 'caLogin', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', 'caFchanulado', 'caUsuanulado', 'caFchcerrado', 'caUsucerrado', 'caColmas', 'caPropiedades', 'caIdetapa', 'caFchultstatus', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDREPORTE, self::CA_FCHREPORTE, self::CA_CONSECUTIVO, self::CA_VERSION, self::CA_IDCOTIZACION, self::CA_ORIGEN, self::CA_DESTINO, self::CA_IMPOEXPO, self::CA_FCHDESPACHO, self::CA_IDAGENTE, self::CA_INCOTERMS, self::CA_MERCANCIA_DESC, self::CA_IDPROVEEDOR, self::CA_ORDEN_PROV, self::CA_IDCONCLIENTE, self::CA_ORDEN_CLIE, self::CA_CONFIRMAR_CLIE, self::CA_IDREPRESENTANTE, self::CA_INFORMAR_REPR, self::CA_IDCONSIGNATARIO, self::CA_INFORMAR_CONS, self::CA_IDNOTIFY, self::CA_INFORMAR_NOTI, self::CA_NOTIFY, self::CA_TRANSPORTE, self::CA_MODALIDAD, self::CA_SEGURO, self::CA_LIBERACION, self::CA_TIEMPOCREDITO, self::CA_PREFERENCIAS_CLIE, self::CA_INSTRUCCIONES, self::CA_IDLINEA, self::CA_IDCONSIGNAR, self::CA_IDCONSIGNARMASTER, self::CA_IDBODEGA, self::CA_MASTERSAME, self::CA_CONTINUACION, self::CA_CONTINUACION_DEST, self::CA_CONTINUACION_CONF, self::CA_ETAPA_ACTUAL, self::CA_LOGIN, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, self::CA_FCHANULADO, self::CA_USUANULADO, self::CA_FCHCERRADO, self::CA_USUCERRADO, self::CA_COLMAS, self::CA_PROPIEDADES, self::CA_IDETAPA, self::CA_FCHULTSTATUS, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idreporte', 'ca_fchreporte', 'ca_consecutivo', 'ca_version', 'ca_idcotizacion', 'ca_origen', 'ca_destino', 'ca_impoexpo', 'ca_fchdespacho', 'ca_idagente', 'ca_incoterms', 'ca_mercancia_desc', 'ca_idproveedor', 'ca_orden_prov', 'ca_idconcliente', 'ca_orden_clie', 'ca_confirmar_clie', 'ca_idrepresentante', 'ca_informar_repr', 'ca_idconsignatario', 'ca_informar_cons', 'ca_idnotify', 'ca_informar_noti', 'ca_notify', 'ca_transporte', 'ca_modalidad', 'ca_seguro', 'ca_liberacion', 'ca_tiempocredito', 'ca_preferencias_clie', 'ca_instrucciones', 'ca_idlinea', 'ca_idconsignar', 'ca_idconsignarmaster', 'ca_idbodega', 'ca_mastersame', 'ca_continuacion', 'ca_continuacion_dest', 'ca_continuacion_conf', 'ca_etapa_actual', 'ca_login', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', 'ca_fchanulado', 'ca_usuanulado', 'ca_fchcerrado', 'ca_usucerrado', 'ca_colmas', 'ca_propiedades', 'ca_idetapa', 'ca_fchultstatus', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdreporte' => 0, 'CaFchreporte' => 1, 'CaConsecutivo' => 2, 'CaVersion' => 3, 'CaIdcotizacion' => 4, 'CaOrigen' => 5, 'CaDestino' => 6, 'CaImpoexpo' => 7, 'CaFchdespacho' => 8, 'CaIdagente' => 9, 'CaIncoterms' => 10, 'CaMercanciaDesc' => 11, 'CaIdproveedor' => 12, 'CaOrdenProv' => 13, 'CaIdconcliente' => 14, 'CaOrdenClie' => 15, 'CaConfirmarClie' => 16, 'CaIdrepresentante' => 17, 'CaInformarRepr' => 18, 'CaIdconsignatario' => 19, 'CaInformarCons' => 20, 'CaIdnotify' => 21, 'CaInformarNoti' => 22, 'CaNotify' => 23, 'CaTransporte' => 24, 'CaModalidad' => 25, 'CaSeguro' => 26, 'CaLiberacion' => 27, 'CaTiempocredito' => 28, 'CaPreferenciasClie' => 29, 'CaInstrucciones' => 30, 'CaIdlinea' => 31, 'CaIdconsignar' => 32, 'CaIdconsignarmaster' => 33, 'CaIdbodega' => 34, 'CaMastersame' => 35, 'CaContinuacion' => 36, 'CaContinuacionDest' => 37, 'CaContinuacionConf' => 38, 'CaEtapaActual' => 39, 'CaLogin' => 40, 'CaFchcreado' => 41, 'CaUsucreado' => 42, 'CaFchactualizado' => 43, 'CaUsuactualizado' => 44, 'CaFchanulado' => 45, 'CaUsuanulado' => 46, 'CaFchcerrado' => 47, 'CaUsucerrado' => 48, 'CaColmas' => 49, 'CaPropiedades' => 50, 'CaIdetapa' => 51, 'CaFchultstatus' => 52, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdreporte' => 0, 'caFchreporte' => 1, 'caConsecutivo' => 2, 'caVersion' => 3, 'caIdcotizacion' => 4, 'caOrigen' => 5, 'caDestino' => 6, 'caImpoexpo' => 7, 'caFchdespacho' => 8, 'caIdagente' => 9, 'caIncoterms' => 10, 'caMercanciaDesc' => 11, 'caIdproveedor' => 12, 'caOrdenProv' => 13, 'caIdconcliente' => 14, 'caOrdenClie' => 15, 'caConfirmarClie' => 16, 'caIdrepresentante' => 17, 'caInformarRepr' => 18, 'caIdconsignatario' => 19, 'caInformarCons' => 20, 'caIdnotify' => 21, 'caInformarNoti' => 22, 'caNotify' => 23, 'caTransporte' => 24, 'caModalidad' => 25, 'caSeguro' => 26, 'caLiberacion' => 27, 'caTiempocredito' => 28, 'caPreferenciasClie' => 29, 'caInstrucciones' => 30, 'caIdlinea' => 31, 'caIdconsignar' => 32, 'caIdconsignarmaster' => 33, 'caIdbodega' => 34, 'caMastersame' => 35, 'caContinuacion' => 36, 'caContinuacionDest' => 37, 'caContinuacionConf' => 38, 'caEtapaActual' => 39, 'caLogin' => 40, 'caFchcreado' => 41, 'caUsucreado' => 42, 'caFchactualizado' => 43, 'caUsuactualizado' => 44, 'caFchanulado' => 45, 'caUsuanulado' => 46, 'caFchcerrado' => 47, 'caUsucerrado' => 48, 'caColmas' => 49, 'caPropiedades' => 50, 'caIdetapa' => 51, 'caFchultstatus' => 52, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDREPORTE => 0, self::CA_FCHREPORTE => 1, self::CA_CONSECUTIVO => 2, self::CA_VERSION => 3, self::CA_IDCOTIZACION => 4, self::CA_ORIGEN => 5, self::CA_DESTINO => 6, self::CA_IMPOEXPO => 7, self::CA_FCHDESPACHO => 8, self::CA_IDAGENTE => 9, self::CA_INCOTERMS => 10, self::CA_MERCANCIA_DESC => 11, self::CA_IDPROVEEDOR => 12, self::CA_ORDEN_PROV => 13, self::CA_IDCONCLIENTE => 14, self::CA_ORDEN_CLIE => 15, self::CA_CONFIRMAR_CLIE => 16, self::CA_IDREPRESENTANTE => 17, self::CA_INFORMAR_REPR => 18, self::CA_IDCONSIGNATARIO => 19, self::CA_INFORMAR_CONS => 20, self::CA_IDNOTIFY => 21, self::CA_INFORMAR_NOTI => 22, self::CA_NOTIFY => 23, self::CA_TRANSPORTE => 24, self::CA_MODALIDAD => 25, self::CA_SEGURO => 26, self::CA_LIBERACION => 27, self::CA_TIEMPOCREDITO => 28, self::CA_PREFERENCIAS_CLIE => 29, self::CA_INSTRUCCIONES => 30, self::CA_IDLINEA => 31, self::CA_IDCONSIGNAR => 32, self::CA_IDCONSIGNARMASTER => 33, self::CA_IDBODEGA => 34, self::CA_MASTERSAME => 35, self::CA_CONTINUACION => 36, self::CA_CONTINUACION_DEST => 37, self::CA_CONTINUACION_CONF => 38, self::CA_ETAPA_ACTUAL => 39, self::CA_LOGIN => 40, self::CA_FCHCREADO => 41, self::CA_USUCREADO => 42, self::CA_FCHACTUALIZADO => 43, self::CA_USUACTUALIZADO => 44, self::CA_FCHANULADO => 45, self::CA_USUANULADO => 46, self::CA_FCHCERRADO => 47, self::CA_USUCERRADO => 48, self::CA_COLMAS => 49, self::CA_PROPIEDADES => 50, self::CA_IDETAPA => 51, self::CA_FCHULTSTATUS => 52, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idreporte' => 0, 'ca_fchreporte' => 1, 'ca_consecutivo' => 2, 'ca_version' => 3, 'ca_idcotizacion' => 4, 'ca_origen' => 5, 'ca_destino' => 6, 'ca_impoexpo' => 7, 'ca_fchdespacho' => 8, 'ca_idagente' => 9, 'ca_incoterms' => 10, 'ca_mercancia_desc' => 11, 'ca_idproveedor' => 12, 'ca_orden_prov' => 13, 'ca_idconcliente' => 14, 'ca_orden_clie' => 15, 'ca_confirmar_clie' => 16, 'ca_idrepresentante' => 17, 'ca_informar_repr' => 18, 'ca_idconsignatario' => 19, 'ca_informar_cons' => 20, 'ca_idnotify' => 21, 'ca_informar_noti' => 22, 'ca_notify' => 23, 'ca_transporte' => 24, 'ca_modalidad' => 25, 'ca_seguro' => 26, 'ca_liberacion' => 27, 'ca_tiempocredito' => 28, 'ca_preferencias_clie' => 29, 'ca_instrucciones' => 30, 'ca_idlinea' => 31, 'ca_idconsignar' => 32, 'ca_idconsignarmaster' => 33, 'ca_idbodega' => 34, 'ca_mastersame' => 35, 'ca_continuacion' => 36, 'ca_continuacion_dest' => 37, 'ca_continuacion_conf' => 38, 'ca_etapa_actual' => 39, 'ca_login' => 40, 'ca_fchcreado' => 41, 'ca_usucreado' => 42, 'ca_fchactualizado' => 43, 'ca_usuactualizado' => 44, 'ca_fchanulado' => 45, 'ca_usuanulado' => 46, 'ca_fchcerrado' => 47, 'ca_usucerrado' => 48, 'ca_colmas' => 49, 'ca_propiedades' => 50, 'ca_idetapa' => 51, 'ca_fchultstatus' => 52, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, )
	);

	/**
	 * Get a (singleton) instance of the MapBuilder for this peer class.
	 * @return     MapBuilder The map builder for this peer
	 */
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new ReporteMapBuilder();
		}
		return self::$mapBuilder;
	}
	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 * @throws     PropelException - if the specified name could not be found in the fieldname mappings.
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	/**
	 * Convenience method which changes table.column to alias.column.
	 *
	 * Using this method you can maintain SQL abstraction while using column aliases.
	 * <code>
	 *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
	 *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
	 * </code>
	 * @param      string $alias The alias for the current table.
	 * @param      string $column The column name for current table. (i.e. ReportePeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(ReportePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      criteria object containing the columns to add.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ReportePeer::CA_IDREPORTE);

		$criteria->addSelectColumn(ReportePeer::CA_FCHREPORTE);

		$criteria->addSelectColumn(ReportePeer::CA_CONSECUTIVO);

		$criteria->addSelectColumn(ReportePeer::CA_VERSION);

		$criteria->addSelectColumn(ReportePeer::CA_IDCOTIZACION);

		$criteria->addSelectColumn(ReportePeer::CA_ORIGEN);

		$criteria->addSelectColumn(ReportePeer::CA_DESTINO);

		$criteria->addSelectColumn(ReportePeer::CA_IMPOEXPO);

		$criteria->addSelectColumn(ReportePeer::CA_FCHDESPACHO);

		$criteria->addSelectColumn(ReportePeer::CA_IDAGENTE);

		$criteria->addSelectColumn(ReportePeer::CA_INCOTERMS);

		$criteria->addSelectColumn(ReportePeer::CA_MERCANCIA_DESC);

		$criteria->addSelectColumn(ReportePeer::CA_IDPROVEEDOR);

		$criteria->addSelectColumn(ReportePeer::CA_ORDEN_PROV);

		$criteria->addSelectColumn(ReportePeer::CA_IDCONCLIENTE);

		$criteria->addSelectColumn(ReportePeer::CA_ORDEN_CLIE);

		$criteria->addSelectColumn(ReportePeer::CA_CONFIRMAR_CLIE);

		$criteria->addSelectColumn(ReportePeer::CA_IDREPRESENTANTE);

		$criteria->addSelectColumn(ReportePeer::CA_INFORMAR_REPR);

		$criteria->addSelectColumn(ReportePeer::CA_IDCONSIGNATARIO);

		$criteria->addSelectColumn(ReportePeer::CA_INFORMAR_CONS);

		$criteria->addSelectColumn(ReportePeer::CA_IDNOTIFY);

		$criteria->addSelectColumn(ReportePeer::CA_INFORMAR_NOTI);

		$criteria->addSelectColumn(ReportePeer::CA_NOTIFY);

		$criteria->addSelectColumn(ReportePeer::CA_TRANSPORTE);

		$criteria->addSelectColumn(ReportePeer::CA_MODALIDAD);

		$criteria->addSelectColumn(ReportePeer::CA_SEGURO);

		$criteria->addSelectColumn(ReportePeer::CA_LIBERACION);

		$criteria->addSelectColumn(ReportePeer::CA_TIEMPOCREDITO);

		$criteria->addSelectColumn(ReportePeer::CA_PREFERENCIAS_CLIE);

		$criteria->addSelectColumn(ReportePeer::CA_INSTRUCCIONES);

		$criteria->addSelectColumn(ReportePeer::CA_IDLINEA);

		$criteria->addSelectColumn(ReportePeer::CA_IDCONSIGNAR);

		$criteria->addSelectColumn(ReportePeer::CA_IDCONSIGNARMASTER);

		$criteria->addSelectColumn(ReportePeer::CA_IDBODEGA);

		$criteria->addSelectColumn(ReportePeer::CA_MASTERSAME);

		$criteria->addSelectColumn(ReportePeer::CA_CONTINUACION);

		$criteria->addSelectColumn(ReportePeer::CA_CONTINUACION_DEST);

		$criteria->addSelectColumn(ReportePeer::CA_CONTINUACION_CONF);

		$criteria->addSelectColumn(ReportePeer::CA_ETAPA_ACTUAL);

		$criteria->addSelectColumn(ReportePeer::CA_LOGIN);

		$criteria->addSelectColumn(ReportePeer::CA_FCHCREADO);

		$criteria->addSelectColumn(ReportePeer::CA_USUCREADO);

		$criteria->addSelectColumn(ReportePeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(ReportePeer::CA_USUACTUALIZADO);

		$criteria->addSelectColumn(ReportePeer::CA_FCHANULADO);

		$criteria->addSelectColumn(ReportePeer::CA_USUANULADO);

		$criteria->addSelectColumn(ReportePeer::CA_FCHCERRADO);

		$criteria->addSelectColumn(ReportePeer::CA_USUCERRADO);

		$criteria->addSelectColumn(ReportePeer::CA_COLMAS);

		$criteria->addSelectColumn(ReportePeer::CA_PROPIEDADES);

		$criteria->addSelectColumn(ReportePeer::CA_IDETAPA);

		$criteria->addSelectColumn(ReportePeer::CA_FCHULTSTATUS);

	}

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
		// we may modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(ReportePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// BasePeer returns a PDOStatement
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}
	/**
	 * Method to select one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     Reporte
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = ReportePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Method to do selects.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return ReportePeer::populateObjects(ReportePeer::doSelectStmt($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
	 *
	 * Use this method directly if you want to work with an executed statement durirectly (for example
	 * to perform your own object hydration).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con The connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     PDOStatement The executed PDOStatement object.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			ReportePeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		// BasePeer returns a PDOStatement
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * Adds an object to the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doSelect*()
	 * methods in your stub classes -- you may need to explicitly add objects
	 * to the cache in order to ensure that the same objects are always returned by doSelect*()
	 * and retrieveByPK*() calls.
	 *
	 * @param      Reporte $value A Reporte object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(Reporte $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdreporte();
			} // if key === null
			self::$instances[$key] = $obj;
		}
	}

	/**
	 * Removes an object from the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doDelete
	 * methods in your stub classes -- you may need to explicitly remove objects
	 * from the cache in order to prevent returning objects that no longer exist.
	 *
	 * @param      mixed $value A Reporte object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Reporte) {
				$key = (string) $value->getCaIdreporte();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Reporte object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} // removeInstanceFromPool()

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
	 * @return     Reporte Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
	 * @see        getPrimaryKeyHash()
	 */
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; // just to be explicit
	}
	
	/**
	 * Clear the instance pool.
	 *
	 * @return     void
	 */
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     string A string version of PK or NULL if the components of primary key in result array are all null.
	 */
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
		// If the PK cannot be derived from the row, return NULL.
		if ($row[$startcol + 0] === null) {
			return null;
		}
		return (string) $row[$startcol + 0];
	}

	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = ReportePeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = ReportePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = ReportePeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				ReportePeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related Usuario table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinUsuario(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(ReportePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(ReportePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Transportador table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinTransportador(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(ReportePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(ReportePeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Tercero table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinTercero(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(ReportePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(ReportePeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Agente table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAgente(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(ReportePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(ReportePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Bodega table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinBodega(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(ReportePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(ReportePeer::CA_IDBODEGA,), array(BodegaPeer::CA_IDBODEGA,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related TrackingEtapa table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinTrackingEtapa(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(ReportePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(ReportePeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);

		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Selects a collection of Reporte objects pre-filled with their Usuario objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Reporte objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUsuario(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReportePeer::addSelectColumns($c);
		$startcol = (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(array(ReportePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ReportePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ReportePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = ReportePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ReportePeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = UsuarioPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = UsuarioPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					UsuarioPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (Reporte) to $obj2 (Usuario)
				$obj2->addReporte($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Reporte objects pre-filled with their Transportador objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Reporte objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinTransportador(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReportePeer::addSelectColumns($c);
		$startcol = (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);
		TransportadorPeer::addSelectColumns($c);

		$c->addJoin(array(ReportePeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ReportePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ReportePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = ReportePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ReportePeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = TransportadorPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = TransportadorPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					TransportadorPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (Reporte) to $obj2 (Transportador)
				$obj2->addReporte($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Reporte objects pre-filled with their Tercero objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Reporte objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinTercero(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReportePeer::addSelectColumns($c);
		$startcol = (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);
		TerceroPeer::addSelectColumns($c);

		$c->addJoin(array(ReportePeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ReportePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ReportePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = ReportePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ReportePeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = TerceroPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = TerceroPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = TerceroPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					TerceroPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (Reporte) to $obj2 (Tercero)
				$obj2->addReporte($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Reporte objects pre-filled with their Agente objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Reporte objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAgente(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReportePeer::addSelectColumns($c);
		$startcol = (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);
		AgentePeer::addSelectColumns($c);

		$c->addJoin(array(ReportePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ReportePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ReportePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = ReportePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ReportePeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = AgentePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = AgentePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = AgentePeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					AgentePeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (Reporte) to $obj2 (Agente)
				$obj2->addReporte($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Reporte objects pre-filled with their Bodega objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Reporte objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinBodega(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReportePeer::addSelectColumns($c);
		$startcol = (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);
		BodegaPeer::addSelectColumns($c);

		$c->addJoin(array(ReportePeer::CA_IDBODEGA,), array(BodegaPeer::CA_IDBODEGA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ReportePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ReportePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = ReportePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ReportePeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = BodegaPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = BodegaPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = BodegaPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					BodegaPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (Reporte) to $obj2 (Bodega)
				$obj2->addReporte($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Reporte objects pre-filled with their TrackingEtapa objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Reporte objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinTrackingEtapa(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReportePeer::addSelectColumns($c);
		$startcol = (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);
		TrackingEtapaPeer::addSelectColumns($c);

		$c->addJoin(array(ReportePeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ReportePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ReportePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = ReportePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ReportePeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = TrackingEtapaPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = TrackingEtapaPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = TrackingEtapaPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					TrackingEtapaPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (Reporte) to $obj2 (TrackingEtapa)
				$obj2->addReporte($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining all related tables
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(ReportePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(ReportePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
		$criteria->addJoin(array(ReportePeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
		$criteria->addJoin(array(ReportePeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
		$criteria->addJoin(array(ReportePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);
		$criteria->addJoin(array(ReportePeer::CA_IDBODEGA,), array(BodegaPeer::CA_IDBODEGA,), $join_behavior);
		$criteria->addJoin(array(ReportePeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}

	/**
	 * Selects a collection of Reporte objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Reporte objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAll(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReportePeer::addSelectColumns($c);
		$startcol2 = (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

		TransportadorPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS);

		TerceroPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (TerceroPeer::NUM_COLUMNS - TerceroPeer::NUM_LAZY_LOAD_COLUMNS);

		AgentePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + (AgentePeer::NUM_COLUMNS - AgentePeer::NUM_LAZY_LOAD_COLUMNS);

		BodegaPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + (BodegaPeer::NUM_COLUMNS - BodegaPeer::NUM_LAZY_LOAD_COLUMNS);

		TrackingEtapaPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + (TrackingEtapaPeer::NUM_COLUMNS - TrackingEtapaPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(ReportePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
		$c->addJoin(array(ReportePeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
		$c->addJoin(array(ReportePeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
		$c->addJoin(array(ReportePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);
		$c->addJoin(array(ReportePeer::CA_IDBODEGA,), array(BodegaPeer::CA_IDBODEGA,), $join_behavior);
		$c->addJoin(array(ReportePeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ReportePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ReportePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = ReportePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ReportePeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined Usuario rows

			$key2 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = UsuarioPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = UsuarioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					UsuarioPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (Reporte) to the collection in $obj2 (Usuario)
				$obj2->addReporte($obj1);
			} // if joined row not null

			// Add objects for joined Transportador rows

			$key3 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = TransportadorPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = TransportadorPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TransportadorPeer::addInstanceToPool($obj3, $key3);
				} // if obj3 loaded

				// Add the $obj1 (Reporte) to the collection in $obj3 (Transportador)
				$obj3->addReporte($obj1);
			} // if joined row not null

			// Add objects for joined Tercero rows

			$key4 = TerceroPeer::getPrimaryKeyHashFromRow($row, $startcol4);
			if ($key4 !== null) {
				$obj4 = TerceroPeer::getInstanceFromPool($key4);
				if (!$obj4) {

					$omClass = TerceroPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					TerceroPeer::addInstanceToPool($obj4, $key4);
				} // if obj4 loaded

				// Add the $obj1 (Reporte) to the collection in $obj4 (Tercero)
				$obj4->addReporte($obj1);
			} // if joined row not null

			// Add objects for joined Agente rows

			$key5 = AgentePeer::getPrimaryKeyHashFromRow($row, $startcol5);
			if ($key5 !== null) {
				$obj5 = AgentePeer::getInstanceFromPool($key5);
				if (!$obj5) {

					$omClass = AgentePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					AgentePeer::addInstanceToPool($obj5, $key5);
				} // if obj5 loaded

				// Add the $obj1 (Reporte) to the collection in $obj5 (Agente)
				$obj5->addReporte($obj1);
			} // if joined row not null

			// Add objects for joined Bodega rows

			$key6 = BodegaPeer::getPrimaryKeyHashFromRow($row, $startcol6);
			if ($key6 !== null) {
				$obj6 = BodegaPeer::getInstanceFromPool($key6);
				if (!$obj6) {

					$omClass = BodegaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj6 = new $cls();
					$obj6->hydrate($row, $startcol6);
					BodegaPeer::addInstanceToPool($obj6, $key6);
				} // if obj6 loaded

				// Add the $obj1 (Reporte) to the collection in $obj6 (Bodega)
				$obj6->addReporte($obj1);
			} // if joined row not null

			// Add objects for joined TrackingEtapa rows

			$key7 = TrackingEtapaPeer::getPrimaryKeyHashFromRow($row, $startcol7);
			if ($key7 !== null) {
				$obj7 = TrackingEtapaPeer::getInstanceFromPool($key7);
				if (!$obj7) {

					$omClass = TrackingEtapaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj7 = new $cls();
					$obj7->hydrate($row, $startcol7);
					TrackingEtapaPeer::addInstanceToPool($obj7, $key7);
				} // if obj7 loaded

				// Add the $obj1 (Reporte) to the collection in $obj7 (TrackingEtapa)
				$obj7->addReporte($obj1);
			} // if joined row not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Usuario table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUsuario(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(ReportePeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDBODEGA,), array(BodegaPeer::CA_IDBODEGA,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Transportador table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptTransportador(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(ReportePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDBODEGA,), array(BodegaPeer::CA_IDBODEGA,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Tercero table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptTercero(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(ReportePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDBODEGA,), array(BodegaPeer::CA_IDBODEGA,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Agente table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptAgente(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(ReportePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDBODEGA,), array(BodegaPeer::CA_IDBODEGA,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Bodega table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptBodega(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(ReportePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related TrackingEtapa table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptTrackingEtapa(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(ReportePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDBODEGA,), array(BodegaPeer::CA_IDBODEGA,), $join_behavior);
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}


	/**
	 * Selects a collection of Reporte objects pre-filled with all related objects except Usuario.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Reporte objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUsuario(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReportePeer::addSelectColumns($c);
		$startcol2 = (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);

		TransportadorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS);

		TerceroPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TerceroPeer::NUM_COLUMNS - TerceroPeer::NUM_LAZY_LOAD_COLUMNS);

		AgentePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (AgentePeer::NUM_COLUMNS - AgentePeer::NUM_LAZY_LOAD_COLUMNS);

		BodegaPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + (BodegaPeer::NUM_COLUMNS - BodegaPeer::NUM_LAZY_LOAD_COLUMNS);

		TrackingEtapaPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + (TrackingEtapaPeer::NUM_COLUMNS - TrackingEtapaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(ReportePeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDBODEGA,), array(BodegaPeer::CA_IDBODEGA,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ReportePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ReportePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = ReportePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ReportePeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Transportador rows

				$key2 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = TransportadorPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = TransportadorPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					TransportadorPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj2 (Transportador)
				$obj2->addReporte($obj1);

			} // if joined row is not null

				// Add objects for joined Tercero rows

				$key3 = TerceroPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = TerceroPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = TerceroPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TerceroPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj3 (Tercero)
				$obj3->addReporte($obj1);

			} // if joined row is not null

				// Add objects for joined Agente rows

				$key4 = AgentePeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = AgentePeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = AgentePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					AgentePeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj4 (Agente)
				$obj4->addReporte($obj1);

			} // if joined row is not null

				// Add objects for joined Bodega rows

				$key5 = BodegaPeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = BodegaPeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$omClass = BodegaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					BodegaPeer::addInstanceToPool($obj5, $key5);
				} // if $obj5 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj5 (Bodega)
				$obj5->addReporte($obj1);

			} // if joined row is not null

				// Add objects for joined TrackingEtapa rows

				$key6 = TrackingEtapaPeer::getPrimaryKeyHashFromRow($row, $startcol6);
				if ($key6 !== null) {
					$obj6 = TrackingEtapaPeer::getInstanceFromPool($key6);
					if (!$obj6) {
	
						$omClass = TrackingEtapaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj6 = new $cls();
					$obj6->hydrate($row, $startcol6);
					TrackingEtapaPeer::addInstanceToPool($obj6, $key6);
				} // if $obj6 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj6 (TrackingEtapa)
				$obj6->addReporte($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Reporte objects pre-filled with all related objects except Transportador.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Reporte objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptTransportador(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReportePeer::addSelectColumns($c);
		$startcol2 = (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

		TerceroPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TerceroPeer::NUM_COLUMNS - TerceroPeer::NUM_LAZY_LOAD_COLUMNS);

		AgentePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (AgentePeer::NUM_COLUMNS - AgentePeer::NUM_LAZY_LOAD_COLUMNS);

		BodegaPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + (BodegaPeer::NUM_COLUMNS - BodegaPeer::NUM_LAZY_LOAD_COLUMNS);

		TrackingEtapaPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + (TrackingEtapaPeer::NUM_COLUMNS - TrackingEtapaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(ReportePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDBODEGA,), array(BodegaPeer::CA_IDBODEGA,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ReportePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ReportePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = ReportePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ReportePeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Usuario rows

				$key2 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = UsuarioPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = UsuarioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					UsuarioPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj2 (Usuario)
				$obj2->addReporte($obj1);

			} // if joined row is not null

				// Add objects for joined Tercero rows

				$key3 = TerceroPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = TerceroPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = TerceroPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TerceroPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj3 (Tercero)
				$obj3->addReporte($obj1);

			} // if joined row is not null

				// Add objects for joined Agente rows

				$key4 = AgentePeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = AgentePeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = AgentePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					AgentePeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj4 (Agente)
				$obj4->addReporte($obj1);

			} // if joined row is not null

				// Add objects for joined Bodega rows

				$key5 = BodegaPeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = BodegaPeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$omClass = BodegaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					BodegaPeer::addInstanceToPool($obj5, $key5);
				} // if $obj5 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj5 (Bodega)
				$obj5->addReporte($obj1);

			} // if joined row is not null

				// Add objects for joined TrackingEtapa rows

				$key6 = TrackingEtapaPeer::getPrimaryKeyHashFromRow($row, $startcol6);
				if ($key6 !== null) {
					$obj6 = TrackingEtapaPeer::getInstanceFromPool($key6);
					if (!$obj6) {
	
						$omClass = TrackingEtapaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj6 = new $cls();
					$obj6->hydrate($row, $startcol6);
					TrackingEtapaPeer::addInstanceToPool($obj6, $key6);
				} // if $obj6 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj6 (TrackingEtapa)
				$obj6->addReporte($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Reporte objects pre-filled with all related objects except Tercero.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Reporte objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptTercero(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReportePeer::addSelectColumns($c);
		$startcol2 = (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

		TransportadorPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS);

		AgentePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (AgentePeer::NUM_COLUMNS - AgentePeer::NUM_LAZY_LOAD_COLUMNS);

		BodegaPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + (BodegaPeer::NUM_COLUMNS - BodegaPeer::NUM_LAZY_LOAD_COLUMNS);

		TrackingEtapaPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + (TrackingEtapaPeer::NUM_COLUMNS - TrackingEtapaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(ReportePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDBODEGA,), array(BodegaPeer::CA_IDBODEGA,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ReportePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ReportePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = ReportePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ReportePeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Usuario rows

				$key2 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = UsuarioPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = UsuarioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					UsuarioPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj2 (Usuario)
				$obj2->addReporte($obj1);

			} // if joined row is not null

				// Add objects for joined Transportador rows

				$key3 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = TransportadorPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = TransportadorPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TransportadorPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj3 (Transportador)
				$obj3->addReporte($obj1);

			} // if joined row is not null

				// Add objects for joined Agente rows

				$key4 = AgentePeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = AgentePeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = AgentePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					AgentePeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj4 (Agente)
				$obj4->addReporte($obj1);

			} // if joined row is not null

				// Add objects for joined Bodega rows

				$key5 = BodegaPeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = BodegaPeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$omClass = BodegaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					BodegaPeer::addInstanceToPool($obj5, $key5);
				} // if $obj5 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj5 (Bodega)
				$obj5->addReporte($obj1);

			} // if joined row is not null

				// Add objects for joined TrackingEtapa rows

				$key6 = TrackingEtapaPeer::getPrimaryKeyHashFromRow($row, $startcol6);
				if ($key6 !== null) {
					$obj6 = TrackingEtapaPeer::getInstanceFromPool($key6);
					if (!$obj6) {
	
						$omClass = TrackingEtapaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj6 = new $cls();
					$obj6->hydrate($row, $startcol6);
					TrackingEtapaPeer::addInstanceToPool($obj6, $key6);
				} // if $obj6 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj6 (TrackingEtapa)
				$obj6->addReporte($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Reporte objects pre-filled with all related objects except Agente.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Reporte objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptAgente(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReportePeer::addSelectColumns($c);
		$startcol2 = (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

		TransportadorPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS);

		TerceroPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (TerceroPeer::NUM_COLUMNS - TerceroPeer::NUM_LAZY_LOAD_COLUMNS);

		BodegaPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + (BodegaPeer::NUM_COLUMNS - BodegaPeer::NUM_LAZY_LOAD_COLUMNS);

		TrackingEtapaPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + (TrackingEtapaPeer::NUM_COLUMNS - TrackingEtapaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(ReportePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDBODEGA,), array(BodegaPeer::CA_IDBODEGA,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ReportePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ReportePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = ReportePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ReportePeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Usuario rows

				$key2 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = UsuarioPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = UsuarioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					UsuarioPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj2 (Usuario)
				$obj2->addReporte($obj1);

			} // if joined row is not null

				// Add objects for joined Transportador rows

				$key3 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = TransportadorPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = TransportadorPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TransportadorPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj3 (Transportador)
				$obj3->addReporte($obj1);

			} // if joined row is not null

				// Add objects for joined Tercero rows

				$key4 = TerceroPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = TerceroPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = TerceroPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					TerceroPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj4 (Tercero)
				$obj4->addReporte($obj1);

			} // if joined row is not null

				// Add objects for joined Bodega rows

				$key5 = BodegaPeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = BodegaPeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$omClass = BodegaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					BodegaPeer::addInstanceToPool($obj5, $key5);
				} // if $obj5 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj5 (Bodega)
				$obj5->addReporte($obj1);

			} // if joined row is not null

				// Add objects for joined TrackingEtapa rows

				$key6 = TrackingEtapaPeer::getPrimaryKeyHashFromRow($row, $startcol6);
				if ($key6 !== null) {
					$obj6 = TrackingEtapaPeer::getInstanceFromPool($key6);
					if (!$obj6) {
	
						$omClass = TrackingEtapaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj6 = new $cls();
					$obj6->hydrate($row, $startcol6);
					TrackingEtapaPeer::addInstanceToPool($obj6, $key6);
				} // if $obj6 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj6 (TrackingEtapa)
				$obj6->addReporte($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Reporte objects pre-filled with all related objects except Bodega.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Reporte objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptBodega(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReportePeer::addSelectColumns($c);
		$startcol2 = (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

		TransportadorPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS);

		TerceroPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (TerceroPeer::NUM_COLUMNS - TerceroPeer::NUM_LAZY_LOAD_COLUMNS);

		AgentePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + (AgentePeer::NUM_COLUMNS - AgentePeer::NUM_LAZY_LOAD_COLUMNS);

		TrackingEtapaPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + (TrackingEtapaPeer::NUM_COLUMNS - TrackingEtapaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(ReportePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ReportePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ReportePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = ReportePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ReportePeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Usuario rows

				$key2 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = UsuarioPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = UsuarioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					UsuarioPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj2 (Usuario)
				$obj2->addReporte($obj1);

			} // if joined row is not null

				// Add objects for joined Transportador rows

				$key3 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = TransportadorPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = TransportadorPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TransportadorPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj3 (Transportador)
				$obj3->addReporte($obj1);

			} // if joined row is not null

				// Add objects for joined Tercero rows

				$key4 = TerceroPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = TerceroPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = TerceroPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					TerceroPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj4 (Tercero)
				$obj4->addReporte($obj1);

			} // if joined row is not null

				// Add objects for joined Agente rows

				$key5 = AgentePeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = AgentePeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$omClass = AgentePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					AgentePeer::addInstanceToPool($obj5, $key5);
				} // if $obj5 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj5 (Agente)
				$obj5->addReporte($obj1);

			} // if joined row is not null

				// Add objects for joined TrackingEtapa rows

				$key6 = TrackingEtapaPeer::getPrimaryKeyHashFromRow($row, $startcol6);
				if ($key6 !== null) {
					$obj6 = TrackingEtapaPeer::getInstanceFromPool($key6);
					if (!$obj6) {
	
						$omClass = TrackingEtapaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj6 = new $cls();
					$obj6->hydrate($row, $startcol6);
					TrackingEtapaPeer::addInstanceToPool($obj6, $key6);
				} // if $obj6 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj6 (TrackingEtapa)
				$obj6->addReporte($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Reporte objects pre-filled with all related objects except TrackingEtapa.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Reporte objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptTrackingEtapa(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReportePeer::addSelectColumns($c);
		$startcol2 = (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

		TransportadorPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS);

		TerceroPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (TerceroPeer::NUM_COLUMNS - TerceroPeer::NUM_LAZY_LOAD_COLUMNS);

		AgentePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + (AgentePeer::NUM_COLUMNS - AgentePeer::NUM_LAZY_LOAD_COLUMNS);

		BodegaPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + (BodegaPeer::NUM_COLUMNS - BodegaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(ReportePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDBODEGA,), array(BodegaPeer::CA_IDBODEGA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ReportePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ReportePeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = ReportePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ReportePeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Usuario rows

				$key2 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = UsuarioPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = UsuarioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					UsuarioPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj2 (Usuario)
				$obj2->addReporte($obj1);

			} // if joined row is not null

				// Add objects for joined Transportador rows

				$key3 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = TransportadorPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = TransportadorPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TransportadorPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj3 (Transportador)
				$obj3->addReporte($obj1);

			} // if joined row is not null

				// Add objects for joined Tercero rows

				$key4 = TerceroPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = TerceroPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = TerceroPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					TerceroPeer::addInstanceToPool($obj4, $key4);
				} // if $obj4 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj4 (Tercero)
				$obj4->addReporte($obj1);

			} // if joined row is not null

				// Add objects for joined Agente rows

				$key5 = AgentePeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = AgentePeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$omClass = AgentePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					AgentePeer::addInstanceToPool($obj5, $key5);
				} // if $obj5 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj5 (Agente)
				$obj5->addReporte($obj1);

			} // if joined row is not null

				// Add objects for joined Bodega rows

				$key6 = BodegaPeer::getPrimaryKeyHashFromRow($row, $startcol6);
				if ($key6 !== null) {
					$obj6 = BodegaPeer::getInstanceFromPool($key6);
					if (!$obj6) {
	
						$omClass = BodegaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj6 = new $cls();
					$obj6->hydrate($row, $startcol6);
					BodegaPeer::addInstanceToPool($obj6, $key6);
				} // if $obj6 already loaded

				// Add the $obj1 (Reporte) to the collection in $obj6 (Bodega)
				$obj6->addReporte($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


  static public function getUniqueColumnNames()
  {
    return array();
  }
	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 * This uses a dot-path notation which is tranalted into a path
	 * relative to a location on the PHP include_path.
	 * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
	 *
	 * @return     string path.to.ClassName
	 */
	public static function getOMClass()
	{
		return ReportePeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a Reporte or Criteria object.
	 *
	 * @param      mixed $values Criteria or Reporte object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from Reporte object
		}

		if ($criteria->containsKey(ReportePeer::CA_IDREPORTE) && $criteria->keyContainsValue(ReportePeer::CA_IDREPORTE) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.ReportePeer::CA_IDREPORTE.')');
		}


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a Reporte or Criteria object.
	 *
	 * @param      mixed $values Criteria or Reporte object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(ReportePeer::CA_IDREPORTE);
			$selectCriteria->add(ReportePeer::CA_IDREPORTE, $criteria->remove(ReportePeer::CA_IDREPORTE), $comparison);

		} else { // $values is Reporte object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_reportes table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(ReportePeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a Reporte or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or Reporte object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      PropelPDO $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			ReportePeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof Reporte) {
			// invalidate the cache for this single object
			ReportePeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key



			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ReportePeer::CA_IDREPORTE, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
				// we can invalidate the cache for this single object
				ReportePeer::removeInstanceFromPool($singleval);
			}
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);

			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given Reporte object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      Reporte $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(Reporte $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ReportePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ReportePeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach ($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(ReportePeer::DATABASE_NAME, ReportePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ReportePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     Reporte
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = ReportePeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(ReportePeer::DATABASE_NAME);
		$criteria->add(ReportePeer::CA_IDREPORTE, $pk);

		$v = ReportePeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      PropelPDO $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(ReportePeer::DATABASE_NAME);
			$criteria->add(ReportePeer::CA_IDREPORTE, $pks, Criteria::IN);
			$objs = ReportePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseReportePeer

// This is the static code needed to register the MapBuilder for this table with the main Propel class.
//
// NOTE: This static code cannot call methods on the ReportePeer class, because it is not defined yet.
// If you need to use overridden methods, you can add this code to the bottom of the ReportePeer class:
//
// Propel::getDatabaseMap(ReportePeer::DATABASE_NAME)->addTableBuilder(ReportePeer::TABLE_NAME, ReportePeer::getMapBuilder());
//
// Doing so will effectively overwrite the registration below.

Propel::getDatabaseMap(BaseReportePeer::DATABASE_NAME)->addTableBuilder(BaseReportePeer::TABLE_NAME, BaseReportePeer::getMapBuilder());

