<?php


abstract class BaseReportePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_reportes';

	
	const CLASS_DEFAULT = 'lib.model.reportes.Reporte';

	
	const NUM_COLUMNS = 57;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDREPORTE = 'tb_reportes.CA_IDREPORTE';

	
	const CA_FCHREPORTE = 'tb_reportes.CA_FCHREPORTE';

	
	const CA_CONSECUTIVO = 'tb_reportes.CA_CONSECUTIVO';

	
	const CA_VERSION = 'tb_reportes.CA_VERSION';

	
	const CA_IDCOTIZACION = 'tb_reportes.CA_IDCOTIZACION';

	
	const CA_ORIGEN = 'tb_reportes.CA_ORIGEN';

	
	const CA_DESTINO = 'tb_reportes.CA_DESTINO';

	
	const CA_IMPOEXPO = 'tb_reportes.CA_IMPOEXPO';

	
	const CA_FCHDESPACHO = 'tb_reportes.CA_FCHDESPACHO';

	
	const CA_IDAGENTE = 'tb_reportes.CA_IDAGENTE';

	
	const CA_INCOTERMS = 'tb_reportes.CA_INCOTERMS';

	
	const CA_MERCANCIA_DESC = 'tb_reportes.CA_MERCANCIA_DESC';

	
	const CA_IDPROVEEDOR = 'tb_reportes.CA_IDPROVEEDOR';

	
	const CA_ORDEN_PROV = 'tb_reportes.CA_ORDEN_PROV';

	
	const CA_IDCONCLIENTE = 'tb_reportes.CA_IDCONCLIENTE';

	
	const CA_ORDEN_CLIE = 'tb_reportes.CA_ORDEN_CLIE';

	
	const CA_CONFIRMAR_CLIE = 'tb_reportes.CA_CONFIRMAR_CLIE';

	
	const CA_IDREPRESENTANTE = 'tb_reportes.CA_IDREPRESENTANTE';

	
	const CA_INFORMAR_REPR = 'tb_reportes.CA_INFORMAR_REPR';

	
	const CA_IDCONSIGNATARIO = 'tb_reportes.CA_IDCONSIGNATARIO';

	
	const CA_INFORMAR_CONS = 'tb_reportes.CA_INFORMAR_CONS';

	
	const CA_IDNOTIFY = 'tb_reportes.CA_IDNOTIFY';

	
	const CA_INFORMAR_NOTI = 'tb_reportes.CA_INFORMAR_NOTI';

	
	const CA_IDMASTER = 'tb_reportes.CA_IDMASTER';

	
	const CA_INFORMAR_MAST = 'tb_reportes.CA_INFORMAR_MAST';

	
	const CA_NOTIFY = 'tb_reportes.CA_NOTIFY';

	
	const CA_TRANSPORTE = 'tb_reportes.CA_TRANSPORTE';

	
	const CA_MODALIDAD = 'tb_reportes.CA_MODALIDAD';

	
	const CA_SEGURO = 'tb_reportes.CA_SEGURO';

	
	const CA_LIBERACION = 'tb_reportes.CA_LIBERACION';

	
	const CA_TIEMPOCREDITO = 'tb_reportes.CA_TIEMPOCREDITO';

	
	const CA_PREFERENCIAS_CLIE = 'tb_reportes.CA_PREFERENCIAS_CLIE';

	
	const CA_INSTRUCCIONES = 'tb_reportes.CA_INSTRUCCIONES';

	
	const CA_IDLINEA = 'tb_reportes.CA_IDLINEA';

	
	const CA_IDCONSIGNAR = 'tb_reportes.CA_IDCONSIGNAR';

	
	const CA_IDCONSIGNARMASTER = 'tb_reportes.CA_IDCONSIGNARMASTER';

	
	const CA_IDBODEGA = 'tb_reportes.CA_IDBODEGA';

	
	const CA_MASTERSAME = 'tb_reportes.CA_MASTERSAME';

	
	const CA_CONTINUACION = 'tb_reportes.CA_CONTINUACION';

	
	const CA_CONTINUACION_DEST = 'tb_reportes.CA_CONTINUACION_DEST';

	
	const CA_CONTINUACION_CONF = 'tb_reportes.CA_CONTINUACION_CONF';

	
	const CA_ETAPA_ACTUAL = 'tb_reportes.CA_ETAPA_ACTUAL';

	
	const CA_LOGIN = 'tb_reportes.CA_LOGIN';

	
	const CA_FCHCREADO = 'tb_reportes.CA_FCHCREADO';

	
	const CA_USUCREADO = 'tb_reportes.CA_USUCREADO';

	
	const CA_FCHACTUALIZADO = 'tb_reportes.CA_FCHACTUALIZADO';

	
	const CA_USUACTUALIZADO = 'tb_reportes.CA_USUACTUALIZADO';

	
	const CA_FCHANULADO = 'tb_reportes.CA_FCHANULADO';

	
	const CA_USUANULADO = 'tb_reportes.CA_USUANULADO';

	
	const CA_FCHCERRADO = 'tb_reportes.CA_FCHCERRADO';

	
	const CA_USUCERRADO = 'tb_reportes.CA_USUCERRADO';

	
	const CA_COLMAS = 'tb_reportes.CA_COLMAS';

	
	const CA_PROPIEDADES = 'tb_reportes.CA_PROPIEDADES';

	
	const CA_IDETAPA = 'tb_reportes.CA_IDETAPA';

	
	const CA_FCHULTSTATUS = 'tb_reportes.CA_FCHULTSTATUS';

	
	const CA_IDTAREA_REXT = 'tb_reportes.CA_IDTAREA_REXT';

	
	const CA_IDSEGUIMIENTO = 'tb_reportes.CA_IDSEGUIMIENTO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdreporte', 'CaFchreporte', 'CaConsecutivo', 'CaVersion', 'CaIdcotizacion', 'CaOrigen', 'CaDestino', 'CaImpoexpo', 'CaFchdespacho', 'CaIdagente', 'CaIncoterms', 'CaMercanciaDesc', 'CaIdproveedor', 'CaOrdenProv', 'CaIdconcliente', 'CaOrdenClie', 'CaConfirmarClie', 'CaIdrepresentante', 'CaInformarRepr', 'CaIdconsignatario', 'CaInformarCons', 'CaIdnotify', 'CaInformarNoti', 'CaIdmaster', 'CaInformarMast', 'CaNotify', 'CaTransporte', 'CaModalidad', 'CaSeguro', 'CaLiberacion', 'CaTiempocredito', 'CaPreferenciasClie', 'CaInstrucciones', 'CaIdlinea', 'CaIdconsignar', 'CaIdconsignarmaster', 'CaIdbodega', 'CaMastersame', 'CaContinuacion', 'CaContinuacionDest', 'CaContinuacionConf', 'CaEtapaActual', 'CaLogin', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', 'CaFchanulado', 'CaUsuanulado', 'CaFchcerrado', 'CaUsucerrado', 'CaColmas', 'CaPropiedades', 'CaIdetapa', 'CaFchultstatus', 'CaIdtareaRext', 'CaIdseguimiento', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdreporte', 'caFchreporte', 'caConsecutivo', 'caVersion', 'caIdcotizacion', 'caOrigen', 'caDestino', 'caImpoexpo', 'caFchdespacho', 'caIdagente', 'caIncoterms', 'caMercanciaDesc', 'caIdproveedor', 'caOrdenProv', 'caIdconcliente', 'caOrdenClie', 'caConfirmarClie', 'caIdrepresentante', 'caInformarRepr', 'caIdconsignatario', 'caInformarCons', 'caIdnotify', 'caInformarNoti', 'caIdmaster', 'caInformarMast', 'caNotify', 'caTransporte', 'caModalidad', 'caSeguro', 'caLiberacion', 'caTiempocredito', 'caPreferenciasClie', 'caInstrucciones', 'caIdlinea', 'caIdconsignar', 'caIdconsignarmaster', 'caIdbodega', 'caMastersame', 'caContinuacion', 'caContinuacionDest', 'caContinuacionConf', 'caEtapaActual', 'caLogin', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', 'caFchanulado', 'caUsuanulado', 'caFchcerrado', 'caUsucerrado', 'caColmas', 'caPropiedades', 'caIdetapa', 'caFchultstatus', 'caIdtareaRext', 'caIdseguimiento', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDREPORTE, self::CA_FCHREPORTE, self::CA_CONSECUTIVO, self::CA_VERSION, self::CA_IDCOTIZACION, self::CA_ORIGEN, self::CA_DESTINO, self::CA_IMPOEXPO, self::CA_FCHDESPACHO, self::CA_IDAGENTE, self::CA_INCOTERMS, self::CA_MERCANCIA_DESC, self::CA_IDPROVEEDOR, self::CA_ORDEN_PROV, self::CA_IDCONCLIENTE, self::CA_ORDEN_CLIE, self::CA_CONFIRMAR_CLIE, self::CA_IDREPRESENTANTE, self::CA_INFORMAR_REPR, self::CA_IDCONSIGNATARIO, self::CA_INFORMAR_CONS, self::CA_IDNOTIFY, self::CA_INFORMAR_NOTI, self::CA_IDMASTER, self::CA_INFORMAR_MAST, self::CA_NOTIFY, self::CA_TRANSPORTE, self::CA_MODALIDAD, self::CA_SEGURO, self::CA_LIBERACION, self::CA_TIEMPOCREDITO, self::CA_PREFERENCIAS_CLIE, self::CA_INSTRUCCIONES, self::CA_IDLINEA, self::CA_IDCONSIGNAR, self::CA_IDCONSIGNARMASTER, self::CA_IDBODEGA, self::CA_MASTERSAME, self::CA_CONTINUACION, self::CA_CONTINUACION_DEST, self::CA_CONTINUACION_CONF, self::CA_ETAPA_ACTUAL, self::CA_LOGIN, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, self::CA_FCHANULADO, self::CA_USUANULADO, self::CA_FCHCERRADO, self::CA_USUCERRADO, self::CA_COLMAS, self::CA_PROPIEDADES, self::CA_IDETAPA, self::CA_FCHULTSTATUS, self::CA_IDTAREA_REXT, self::CA_IDSEGUIMIENTO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idreporte', 'ca_fchreporte', 'ca_consecutivo', 'ca_version', 'ca_idcotizacion', 'ca_origen', 'ca_destino', 'ca_impoexpo', 'ca_fchdespacho', 'ca_idagente', 'ca_incoterms', 'ca_mercancia_desc', 'ca_idproveedor', 'ca_orden_prov', 'ca_idconcliente', 'ca_orden_clie', 'ca_confirmar_clie', 'ca_idrepresentante', 'ca_informar_repr', 'ca_idconsignatario', 'ca_informar_cons', 'ca_idnotify', 'ca_informar_noti', 'ca_idmaster', 'ca_informar_mast', 'ca_notify', 'ca_transporte', 'ca_modalidad', 'ca_seguro', 'ca_liberacion', 'ca_tiempocredito', 'ca_preferencias_clie', 'ca_instrucciones', 'ca_idlinea', 'ca_idconsignar', 'ca_idconsignarmaster', 'ca_idbodega', 'ca_mastersame', 'ca_continuacion', 'ca_continuacion_dest', 'ca_continuacion_conf', 'ca_etapa_actual', 'ca_login', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', 'ca_fchanulado', 'ca_usuanulado', 'ca_fchcerrado', 'ca_usucerrado', 'ca_colmas', 'ca_propiedades', 'ca_idetapa', 'ca_fchultstatus', 'ca_idtarea_rext', 'ca_idseguimiento', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdreporte' => 0, 'CaFchreporte' => 1, 'CaConsecutivo' => 2, 'CaVersion' => 3, 'CaIdcotizacion' => 4, 'CaOrigen' => 5, 'CaDestino' => 6, 'CaImpoexpo' => 7, 'CaFchdespacho' => 8, 'CaIdagente' => 9, 'CaIncoterms' => 10, 'CaMercanciaDesc' => 11, 'CaIdproveedor' => 12, 'CaOrdenProv' => 13, 'CaIdconcliente' => 14, 'CaOrdenClie' => 15, 'CaConfirmarClie' => 16, 'CaIdrepresentante' => 17, 'CaInformarRepr' => 18, 'CaIdconsignatario' => 19, 'CaInformarCons' => 20, 'CaIdnotify' => 21, 'CaInformarNoti' => 22, 'CaIdmaster' => 23, 'CaInformarMast' => 24, 'CaNotify' => 25, 'CaTransporte' => 26, 'CaModalidad' => 27, 'CaSeguro' => 28, 'CaLiberacion' => 29, 'CaTiempocredito' => 30, 'CaPreferenciasClie' => 31, 'CaInstrucciones' => 32, 'CaIdlinea' => 33, 'CaIdconsignar' => 34, 'CaIdconsignarmaster' => 35, 'CaIdbodega' => 36, 'CaMastersame' => 37, 'CaContinuacion' => 38, 'CaContinuacionDest' => 39, 'CaContinuacionConf' => 40, 'CaEtapaActual' => 41, 'CaLogin' => 42, 'CaFchcreado' => 43, 'CaUsucreado' => 44, 'CaFchactualizado' => 45, 'CaUsuactualizado' => 46, 'CaFchanulado' => 47, 'CaUsuanulado' => 48, 'CaFchcerrado' => 49, 'CaUsucerrado' => 50, 'CaColmas' => 51, 'CaPropiedades' => 52, 'CaIdetapa' => 53, 'CaFchultstatus' => 54, 'CaIdtareaRext' => 55, 'CaIdseguimiento' => 56, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdreporte' => 0, 'caFchreporte' => 1, 'caConsecutivo' => 2, 'caVersion' => 3, 'caIdcotizacion' => 4, 'caOrigen' => 5, 'caDestino' => 6, 'caImpoexpo' => 7, 'caFchdespacho' => 8, 'caIdagente' => 9, 'caIncoterms' => 10, 'caMercanciaDesc' => 11, 'caIdproveedor' => 12, 'caOrdenProv' => 13, 'caIdconcliente' => 14, 'caOrdenClie' => 15, 'caConfirmarClie' => 16, 'caIdrepresentante' => 17, 'caInformarRepr' => 18, 'caIdconsignatario' => 19, 'caInformarCons' => 20, 'caIdnotify' => 21, 'caInformarNoti' => 22, 'caIdmaster' => 23, 'caInformarMast' => 24, 'caNotify' => 25, 'caTransporte' => 26, 'caModalidad' => 27, 'caSeguro' => 28, 'caLiberacion' => 29, 'caTiempocredito' => 30, 'caPreferenciasClie' => 31, 'caInstrucciones' => 32, 'caIdlinea' => 33, 'caIdconsignar' => 34, 'caIdconsignarmaster' => 35, 'caIdbodega' => 36, 'caMastersame' => 37, 'caContinuacion' => 38, 'caContinuacionDest' => 39, 'caContinuacionConf' => 40, 'caEtapaActual' => 41, 'caLogin' => 42, 'caFchcreado' => 43, 'caUsucreado' => 44, 'caFchactualizado' => 45, 'caUsuactualizado' => 46, 'caFchanulado' => 47, 'caUsuanulado' => 48, 'caFchcerrado' => 49, 'caUsucerrado' => 50, 'caColmas' => 51, 'caPropiedades' => 52, 'caIdetapa' => 53, 'caFchultstatus' => 54, 'caIdtareaRext' => 55, 'caIdseguimiento' => 56, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDREPORTE => 0, self::CA_FCHREPORTE => 1, self::CA_CONSECUTIVO => 2, self::CA_VERSION => 3, self::CA_IDCOTIZACION => 4, self::CA_ORIGEN => 5, self::CA_DESTINO => 6, self::CA_IMPOEXPO => 7, self::CA_FCHDESPACHO => 8, self::CA_IDAGENTE => 9, self::CA_INCOTERMS => 10, self::CA_MERCANCIA_DESC => 11, self::CA_IDPROVEEDOR => 12, self::CA_ORDEN_PROV => 13, self::CA_IDCONCLIENTE => 14, self::CA_ORDEN_CLIE => 15, self::CA_CONFIRMAR_CLIE => 16, self::CA_IDREPRESENTANTE => 17, self::CA_INFORMAR_REPR => 18, self::CA_IDCONSIGNATARIO => 19, self::CA_INFORMAR_CONS => 20, self::CA_IDNOTIFY => 21, self::CA_INFORMAR_NOTI => 22, self::CA_IDMASTER => 23, self::CA_INFORMAR_MAST => 24, self::CA_NOTIFY => 25, self::CA_TRANSPORTE => 26, self::CA_MODALIDAD => 27, self::CA_SEGURO => 28, self::CA_LIBERACION => 29, self::CA_TIEMPOCREDITO => 30, self::CA_PREFERENCIAS_CLIE => 31, self::CA_INSTRUCCIONES => 32, self::CA_IDLINEA => 33, self::CA_IDCONSIGNAR => 34, self::CA_IDCONSIGNARMASTER => 35, self::CA_IDBODEGA => 36, self::CA_MASTERSAME => 37, self::CA_CONTINUACION => 38, self::CA_CONTINUACION_DEST => 39, self::CA_CONTINUACION_CONF => 40, self::CA_ETAPA_ACTUAL => 41, self::CA_LOGIN => 42, self::CA_FCHCREADO => 43, self::CA_USUCREADO => 44, self::CA_FCHACTUALIZADO => 45, self::CA_USUACTUALIZADO => 46, self::CA_FCHANULADO => 47, self::CA_USUANULADO => 48, self::CA_FCHCERRADO => 49, self::CA_USUCERRADO => 50, self::CA_COLMAS => 51, self::CA_PROPIEDADES => 52, self::CA_IDETAPA => 53, self::CA_FCHULTSTATUS => 54, self::CA_IDTAREA_REXT => 55, self::CA_IDSEGUIMIENTO => 56, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idreporte' => 0, 'ca_fchreporte' => 1, 'ca_consecutivo' => 2, 'ca_version' => 3, 'ca_idcotizacion' => 4, 'ca_origen' => 5, 'ca_destino' => 6, 'ca_impoexpo' => 7, 'ca_fchdespacho' => 8, 'ca_idagente' => 9, 'ca_incoterms' => 10, 'ca_mercancia_desc' => 11, 'ca_idproveedor' => 12, 'ca_orden_prov' => 13, 'ca_idconcliente' => 14, 'ca_orden_clie' => 15, 'ca_confirmar_clie' => 16, 'ca_idrepresentante' => 17, 'ca_informar_repr' => 18, 'ca_idconsignatario' => 19, 'ca_informar_cons' => 20, 'ca_idnotify' => 21, 'ca_informar_noti' => 22, 'ca_idmaster' => 23, 'ca_informar_mast' => 24, 'ca_notify' => 25, 'ca_transporte' => 26, 'ca_modalidad' => 27, 'ca_seguro' => 28, 'ca_liberacion' => 29, 'ca_tiempocredito' => 30, 'ca_preferencias_clie' => 31, 'ca_instrucciones' => 32, 'ca_idlinea' => 33, 'ca_idconsignar' => 34, 'ca_idconsignarmaster' => 35, 'ca_idbodega' => 36, 'ca_mastersame' => 37, 'ca_continuacion' => 38, 'ca_continuacion_dest' => 39, 'ca_continuacion_conf' => 40, 'ca_etapa_actual' => 41, 'ca_login' => 42, 'ca_fchcreado' => 43, 'ca_usucreado' => 44, 'ca_fchactualizado' => 45, 'ca_usuactualizado' => 46, 'ca_fchanulado' => 47, 'ca_usuanulado' => 48, 'ca_fchcerrado' => 49, 'ca_usucerrado' => 50, 'ca_colmas' => 51, 'ca_propiedades' => 52, 'ca_idetapa' => 53, 'ca_fchultstatus' => 54, 'ca_idtarea_rext' => 55, 'ca_idseguimiento' => 56, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new ReporteMapBuilder();
		}
		return self::$mapBuilder;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(ReportePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
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

		$criteria->addSelectColumn(ReportePeer::CA_IDMASTER);

		$criteria->addSelectColumn(ReportePeer::CA_INFORMAR_MAST);

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

		$criteria->addSelectColumn(ReportePeer::CA_IDTAREA_REXT);

		$criteria->addSelectColumn(ReportePeer::CA_IDSEGUIMIENTO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(ReportePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseReportePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseReportePeer', $criteria, $con);
    }


				$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}
	
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
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return ReportePeer::populateObjects(ReportePeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseReportePeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseReportePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			ReportePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(Reporte $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdreporte();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Reporte) {
				$key = (string) $value->getCaIdreporte();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Reporte object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} 
	
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; 	}
	
	
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
				if ($row[$startcol + 0] === null) {
			return null;
		}
		return (string) $row[$startcol + 0];
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = ReportePeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = ReportePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = ReportePeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				ReportePeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinUsuario(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(ReportePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(ReportePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);


    foreach (sfMixer::getCallables('BaseReportePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseReportePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinTransportador(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(ReportePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(ReportePeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);


    foreach (sfMixer::getCallables('BaseReportePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseReportePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinTercero(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(ReportePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(ReportePeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);


    foreach (sfMixer::getCallables('BaseReportePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseReportePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAgente(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(ReportePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(ReportePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);


    foreach (sfMixer::getCallables('BaseReportePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseReportePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinBodega(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(ReportePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(ReportePeer::CA_IDBODEGA,), array(BodegaPeer::CA_IDBODEGA,), $join_behavior);


    foreach (sfMixer::getCallables('BaseReportePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseReportePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinTrackingEtapa(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(ReportePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(ReportePeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);


    foreach (sfMixer::getCallables('BaseReportePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseReportePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinNotTarea(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(ReportePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(ReportePeer::CA_IDSEGUIMIENTO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);


    foreach (sfMixer::getCallables('BaseReportePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseReportePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinUsuario(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseReportePeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseReportePeer', $c, $con);
    }


		$c = clone $c;

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
															} else {

				$omClass = ReportePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ReportePeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = UsuarioPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = UsuarioPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					UsuarioPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addReporte($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinTransportador(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

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
															} else {

				$omClass = ReportePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ReportePeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = TransportadorPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = TransportadorPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					TransportadorPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addReporte($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinTercero(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

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
															} else {

				$omClass = ReportePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ReportePeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = TerceroPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = TerceroPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = TerceroPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					TerceroPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addReporte($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAgente(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

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
															} else {

				$omClass = ReportePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ReportePeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = AgentePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = AgentePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = AgentePeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					AgentePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addReporte($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinBodega(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

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
															} else {

				$omClass = ReportePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ReportePeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = BodegaPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = BodegaPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = BodegaPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					BodegaPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addReporte($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinTrackingEtapa(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

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
															} else {

				$omClass = ReportePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ReportePeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = TrackingEtapaPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = TrackingEtapaPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = TrackingEtapaPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					TrackingEtapaPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addReporte($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinNotTarea(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReportePeer::addSelectColumns($c);
		$startcol = (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS);
		NotTareaPeer::addSelectColumns($c);

		$c->addJoin(array(ReportePeer::CA_IDSEGUIMIENTO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ReportePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ReportePeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = ReportePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ReportePeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = NotTareaPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = NotTareaPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = NotTareaPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					NotTareaPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addReporte($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(ReportePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
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
		$criteria->addJoin(array(ReportePeer::CA_IDSEGUIMIENTO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseReportePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseReportePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}

	
	public static function doSelectJoinAll(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseReportePeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseReportePeer', $c, $con);
    }


		$c = clone $c;

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

		NotTareaPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + (NotTareaPeer::NUM_COLUMNS - NotTareaPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(ReportePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
		$c->addJoin(array(ReportePeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
		$c->addJoin(array(ReportePeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
		$c->addJoin(array(ReportePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);
		$c->addJoin(array(ReportePeer::CA_IDBODEGA,), array(BodegaPeer::CA_IDBODEGA,), $join_behavior);
		$c->addJoin(array(ReportePeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);
		$c->addJoin(array(ReportePeer::CA_IDSEGUIMIENTO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ReportePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ReportePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = ReportePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ReportePeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = UsuarioPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = UsuarioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					UsuarioPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addReporte($obj1);
			} 
			
			$key3 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = TransportadorPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = TransportadorPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TransportadorPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addReporte($obj1);
			} 
			
			$key4 = TerceroPeer::getPrimaryKeyHashFromRow($row, $startcol4);
			if ($key4 !== null) {
				$obj4 = TerceroPeer::getInstanceFromPool($key4);
				if (!$obj4) {

					$omClass = TerceroPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					TerceroPeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addReporte($obj1);
			} 
			
			$key5 = AgentePeer::getPrimaryKeyHashFromRow($row, $startcol5);
			if ($key5 !== null) {
				$obj5 = AgentePeer::getInstanceFromPool($key5);
				if (!$obj5) {

					$omClass = AgentePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					AgentePeer::addInstanceToPool($obj5, $key5);
				} 
								$obj5->addReporte($obj1);
			} 
			
			$key6 = BodegaPeer::getPrimaryKeyHashFromRow($row, $startcol6);
			if ($key6 !== null) {
				$obj6 = BodegaPeer::getInstanceFromPool($key6);
				if (!$obj6) {

					$omClass = BodegaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj6 = new $cls();
					$obj6->hydrate($row, $startcol6);
					BodegaPeer::addInstanceToPool($obj6, $key6);
				} 
								$obj6->addReporte($obj1);
			} 
			
			$key7 = TrackingEtapaPeer::getPrimaryKeyHashFromRow($row, $startcol7);
			if ($key7 !== null) {
				$obj7 = TrackingEtapaPeer::getInstanceFromPool($key7);
				if (!$obj7) {

					$omClass = TrackingEtapaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj7 = new $cls();
					$obj7->hydrate($row, $startcol7);
					TrackingEtapaPeer::addInstanceToPool($obj7, $key7);
				} 
								$obj7->addReporte($obj1);
			} 
			
			$key8 = NotTareaPeer::getPrimaryKeyHashFromRow($row, $startcol8);
			if ($key8 !== null) {
				$obj8 = NotTareaPeer::getInstanceFromPool($key8);
				if (!$obj8) {

					$omClass = NotTareaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj8 = new $cls();
					$obj8->hydrate($row, $startcol8);
					NotTareaPeer::addInstanceToPool($obj8, $key8);
				} 
								$obj8->addReporte($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAllExceptUsuario(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(ReportePeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDBODEGA,), array(BodegaPeer::CA_IDBODEGA,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDSEGUIMIENTO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseReportePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseReportePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptTransportador(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(ReportePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDBODEGA,), array(BodegaPeer::CA_IDBODEGA,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDSEGUIMIENTO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseReportePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseReportePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptTercero(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(ReportePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDBODEGA,), array(BodegaPeer::CA_IDBODEGA,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDSEGUIMIENTO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseReportePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseReportePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptAgente(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(ReportePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDBODEGA,), array(BodegaPeer::CA_IDBODEGA,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDSEGUIMIENTO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseReportePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseReportePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptBodega(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(ReportePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDSEGUIMIENTO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseReportePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseReportePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptTrackingEtapa(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(ReportePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDBODEGA,), array(BodegaPeer::CA_IDBODEGA,), $join_behavior);
				$criteria->addJoin(array(ReportePeer::CA_IDSEGUIMIENTO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseReportePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseReportePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doCountJoinAllExceptNotTarea(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ReportePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
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

    foreach (sfMixer::getCallables('BaseReportePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseReportePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinAllExceptUsuario(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseReportePeer:doSelectJoinAllExcept:doSelectJoinAllExcept') as $callable)
    {
      call_user_func($callable, 'BaseReportePeer', $c, $con);
    }


		$c = clone $c;

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

		NotTareaPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + (NotTareaPeer::NUM_COLUMNS - NotTareaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(ReportePeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDBODEGA,), array(BodegaPeer::CA_IDBODEGA,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDSEGUIMIENTO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ReportePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ReportePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = ReportePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ReportePeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = TransportadorPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = TransportadorPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					TransportadorPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addReporte($obj1);

			} 
				
				$key3 = TerceroPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = TerceroPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = TerceroPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TerceroPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addReporte($obj1);

			} 
				
				$key4 = AgentePeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = AgentePeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = AgentePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					AgentePeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addReporte($obj1);

			} 
				
				$key5 = BodegaPeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = BodegaPeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$omClass = BodegaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					BodegaPeer::addInstanceToPool($obj5, $key5);
				} 
								$obj5->addReporte($obj1);

			} 
				
				$key6 = TrackingEtapaPeer::getPrimaryKeyHashFromRow($row, $startcol6);
				if ($key6 !== null) {
					$obj6 = TrackingEtapaPeer::getInstanceFromPool($key6);
					if (!$obj6) {
	
						$omClass = TrackingEtapaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj6 = new $cls();
					$obj6->hydrate($row, $startcol6);
					TrackingEtapaPeer::addInstanceToPool($obj6, $key6);
				} 
								$obj6->addReporte($obj1);

			} 
				
				$key7 = NotTareaPeer::getPrimaryKeyHashFromRow($row, $startcol7);
				if ($key7 !== null) {
					$obj7 = NotTareaPeer::getInstanceFromPool($key7);
					if (!$obj7) {
	
						$omClass = NotTareaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj7 = new $cls();
					$obj7->hydrate($row, $startcol7);
					NotTareaPeer::addInstanceToPool($obj7, $key7);
				} 
								$obj7->addReporte($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptTransportador(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

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

		NotTareaPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + (NotTareaPeer::NUM_COLUMNS - NotTareaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(ReportePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDBODEGA,), array(BodegaPeer::CA_IDBODEGA,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDSEGUIMIENTO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ReportePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ReportePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = ReportePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ReportePeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = UsuarioPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = UsuarioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					UsuarioPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addReporte($obj1);

			} 
				
				$key3 = TerceroPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = TerceroPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = TerceroPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TerceroPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addReporte($obj1);

			} 
				
				$key4 = AgentePeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = AgentePeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = AgentePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					AgentePeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addReporte($obj1);

			} 
				
				$key5 = BodegaPeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = BodegaPeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$omClass = BodegaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					BodegaPeer::addInstanceToPool($obj5, $key5);
				} 
								$obj5->addReporte($obj1);

			} 
				
				$key6 = TrackingEtapaPeer::getPrimaryKeyHashFromRow($row, $startcol6);
				if ($key6 !== null) {
					$obj6 = TrackingEtapaPeer::getInstanceFromPool($key6);
					if (!$obj6) {
	
						$omClass = TrackingEtapaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj6 = new $cls();
					$obj6->hydrate($row, $startcol6);
					TrackingEtapaPeer::addInstanceToPool($obj6, $key6);
				} 
								$obj6->addReporte($obj1);

			} 
				
				$key7 = NotTareaPeer::getPrimaryKeyHashFromRow($row, $startcol7);
				if ($key7 !== null) {
					$obj7 = NotTareaPeer::getInstanceFromPool($key7);
					if (!$obj7) {
	
						$omClass = NotTareaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj7 = new $cls();
					$obj7->hydrate($row, $startcol7);
					NotTareaPeer::addInstanceToPool($obj7, $key7);
				} 
								$obj7->addReporte($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptTercero(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

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

		NotTareaPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + (NotTareaPeer::NUM_COLUMNS - NotTareaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(ReportePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDBODEGA,), array(BodegaPeer::CA_IDBODEGA,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDSEGUIMIENTO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ReportePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ReportePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = ReportePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ReportePeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = UsuarioPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = UsuarioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					UsuarioPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addReporte($obj1);

			} 
				
				$key3 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = TransportadorPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = TransportadorPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TransportadorPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addReporte($obj1);

			} 
				
				$key4 = AgentePeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = AgentePeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = AgentePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					AgentePeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addReporte($obj1);

			} 
				
				$key5 = BodegaPeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = BodegaPeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$omClass = BodegaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					BodegaPeer::addInstanceToPool($obj5, $key5);
				} 
								$obj5->addReporte($obj1);

			} 
				
				$key6 = TrackingEtapaPeer::getPrimaryKeyHashFromRow($row, $startcol6);
				if ($key6 !== null) {
					$obj6 = TrackingEtapaPeer::getInstanceFromPool($key6);
					if (!$obj6) {
	
						$omClass = TrackingEtapaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj6 = new $cls();
					$obj6->hydrate($row, $startcol6);
					TrackingEtapaPeer::addInstanceToPool($obj6, $key6);
				} 
								$obj6->addReporte($obj1);

			} 
				
				$key7 = NotTareaPeer::getPrimaryKeyHashFromRow($row, $startcol7);
				if ($key7 !== null) {
					$obj7 = NotTareaPeer::getInstanceFromPool($key7);
					if (!$obj7) {
	
						$omClass = NotTareaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj7 = new $cls();
					$obj7->hydrate($row, $startcol7);
					NotTareaPeer::addInstanceToPool($obj7, $key7);
				} 
								$obj7->addReporte($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptAgente(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

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

		NotTareaPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + (NotTareaPeer::NUM_COLUMNS - NotTareaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(ReportePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDBODEGA,), array(BodegaPeer::CA_IDBODEGA,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDSEGUIMIENTO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ReportePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ReportePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = ReportePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ReportePeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = UsuarioPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = UsuarioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					UsuarioPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addReporte($obj1);

			} 
				
				$key3 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = TransportadorPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = TransportadorPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TransportadorPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addReporte($obj1);

			} 
				
				$key4 = TerceroPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = TerceroPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = TerceroPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					TerceroPeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addReporte($obj1);

			} 
				
				$key5 = BodegaPeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = BodegaPeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$omClass = BodegaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					BodegaPeer::addInstanceToPool($obj5, $key5);
				} 
								$obj5->addReporte($obj1);

			} 
				
				$key6 = TrackingEtapaPeer::getPrimaryKeyHashFromRow($row, $startcol6);
				if ($key6 !== null) {
					$obj6 = TrackingEtapaPeer::getInstanceFromPool($key6);
					if (!$obj6) {
	
						$omClass = TrackingEtapaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj6 = new $cls();
					$obj6->hydrate($row, $startcol6);
					TrackingEtapaPeer::addInstanceToPool($obj6, $key6);
				} 
								$obj6->addReporte($obj1);

			} 
				
				$key7 = NotTareaPeer::getPrimaryKeyHashFromRow($row, $startcol7);
				if ($key7 !== null) {
					$obj7 = NotTareaPeer::getInstanceFromPool($key7);
					if (!$obj7) {
	
						$omClass = NotTareaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj7 = new $cls();
					$obj7->hydrate($row, $startcol7);
					NotTareaPeer::addInstanceToPool($obj7, $key7);
				} 
								$obj7->addReporte($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptBodega(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

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

		NotTareaPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + (NotTareaPeer::NUM_COLUMNS - NotTareaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(ReportePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDETAPA,), array(TrackingEtapaPeer::CA_IDETAPA,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDSEGUIMIENTO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ReportePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ReportePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = ReportePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ReportePeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = UsuarioPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = UsuarioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					UsuarioPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addReporte($obj1);

			} 
				
				$key3 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = TransportadorPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = TransportadorPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TransportadorPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addReporte($obj1);

			} 
				
				$key4 = TerceroPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = TerceroPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = TerceroPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					TerceroPeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addReporte($obj1);

			} 
				
				$key5 = AgentePeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = AgentePeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$omClass = AgentePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					AgentePeer::addInstanceToPool($obj5, $key5);
				} 
								$obj5->addReporte($obj1);

			} 
				
				$key6 = TrackingEtapaPeer::getPrimaryKeyHashFromRow($row, $startcol6);
				if ($key6 !== null) {
					$obj6 = TrackingEtapaPeer::getInstanceFromPool($key6);
					if (!$obj6) {
	
						$omClass = TrackingEtapaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj6 = new $cls();
					$obj6->hydrate($row, $startcol6);
					TrackingEtapaPeer::addInstanceToPool($obj6, $key6);
				} 
								$obj6->addReporte($obj1);

			} 
				
				$key7 = NotTareaPeer::getPrimaryKeyHashFromRow($row, $startcol7);
				if ($key7 !== null) {
					$obj7 = NotTareaPeer::getInstanceFromPool($key7);
					if (!$obj7) {
	
						$omClass = NotTareaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj7 = new $cls();
					$obj7->hydrate($row, $startcol7);
					NotTareaPeer::addInstanceToPool($obj7, $key7);
				} 
								$obj7->addReporte($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptTrackingEtapa(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

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

		NotTareaPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + (NotTareaPeer::NUM_COLUMNS - NotTareaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(ReportePeer::CA_LOGIN,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDPROVEEDOR,), array(TerceroPeer::CA_IDTERCERO,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDAGENTE,), array(AgentePeer::CA_IDAGENTE,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDBODEGA,), array(BodegaPeer::CA_IDBODEGA,), $join_behavior);
				$c->addJoin(array(ReportePeer::CA_IDSEGUIMIENTO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ReportePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ReportePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = ReportePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ReportePeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = UsuarioPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = UsuarioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					UsuarioPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addReporte($obj1);

			} 
				
				$key3 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = TransportadorPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = TransportadorPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TransportadorPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addReporte($obj1);

			} 
				
				$key4 = TerceroPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = TerceroPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = TerceroPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					TerceroPeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addReporte($obj1);

			} 
				
				$key5 = AgentePeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = AgentePeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$omClass = AgentePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					AgentePeer::addInstanceToPool($obj5, $key5);
				} 
								$obj5->addReporte($obj1);

			} 
				
				$key6 = BodegaPeer::getPrimaryKeyHashFromRow($row, $startcol6);
				if ($key6 !== null) {
					$obj6 = BodegaPeer::getInstanceFromPool($key6);
					if (!$obj6) {
	
						$omClass = BodegaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj6 = new $cls();
					$obj6->hydrate($row, $startcol6);
					BodegaPeer::addInstanceToPool($obj6, $key6);
				} 
								$obj6->addReporte($obj1);

			} 
				
				$key7 = NotTareaPeer::getPrimaryKeyHashFromRow($row, $startcol7);
				if ($key7 !== null) {
					$obj7 = NotTareaPeer::getInstanceFromPool($key7);
					if (!$obj7) {
	
						$omClass = NotTareaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj7 = new $cls();
					$obj7->hydrate($row, $startcol7);
					NotTareaPeer::addInstanceToPool($obj7, $key7);
				} 
								$obj7->addReporte($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doSelectJoinAllExceptNotTarea(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

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
															} else {
				$omClass = ReportePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ReportePeer::addInstanceToPool($obj1, $key1);
			} 
				
				$key2 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = UsuarioPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = UsuarioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					UsuarioPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addReporte($obj1);

			} 
				
				$key3 = TransportadorPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = TransportadorPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = TransportadorPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					TransportadorPeer::addInstanceToPool($obj3, $key3);
				} 
								$obj3->addReporte($obj1);

			} 
				
				$key4 = TerceroPeer::getPrimaryKeyHashFromRow($row, $startcol4);
				if ($key4 !== null) {
					$obj4 = TerceroPeer::getInstanceFromPool($key4);
					if (!$obj4) {
	
						$omClass = TerceroPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					TerceroPeer::addInstanceToPool($obj4, $key4);
				} 
								$obj4->addReporte($obj1);

			} 
				
				$key5 = AgentePeer::getPrimaryKeyHashFromRow($row, $startcol5);
				if ($key5 !== null) {
					$obj5 = AgentePeer::getInstanceFromPool($key5);
					if (!$obj5) {
	
						$omClass = AgentePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj5 = new $cls();
					$obj5->hydrate($row, $startcol5);
					AgentePeer::addInstanceToPool($obj5, $key5);
				} 
								$obj5->addReporte($obj1);

			} 
				
				$key6 = BodegaPeer::getPrimaryKeyHashFromRow($row, $startcol6);
				if ($key6 !== null) {
					$obj6 = BodegaPeer::getInstanceFromPool($key6);
					if (!$obj6) {
	
						$omClass = BodegaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj6 = new $cls();
					$obj6->hydrate($row, $startcol6);
					BodegaPeer::addInstanceToPool($obj6, $key6);
				} 
								$obj6->addReporte($obj1);

			} 
				
				$key7 = TrackingEtapaPeer::getPrimaryKeyHashFromRow($row, $startcol7);
				if ($key7 !== null) {
					$obj7 = TrackingEtapaPeer::getInstanceFromPool($key7);
					if (!$obj7) {
	
						$omClass = TrackingEtapaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj7 = new $cls();
					$obj7->hydrate($row, $startcol7);
					TrackingEtapaPeer::addInstanceToPool($obj7, $key7);
				} 
								$obj7->addReporte($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


  static public function getUniqueColumnNames()
  {
    return array();
  }
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return ReportePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseReportePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseReportePeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(ReportePeer::CA_IDREPORTE) && $criteria->keyContainsValue(ReportePeer::CA_IDREPORTE) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.ReportePeer::CA_IDREPORTE.')');
		}


				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseReportePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseReportePeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseReportePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseReportePeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(ReportePeer::CA_IDREPORTE);
			$selectCriteria->add(ReportePeer::CA_IDREPORTE, $criteria->remove(ReportePeer::CA_IDREPORTE), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseReportePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseReportePeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(ReportePeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												ReportePeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof Reporte) {
						ReportePeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ReportePeer::CA_IDREPORTE, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								ReportePeer::removeInstanceFromPool($singleval);
			}
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);

			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
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

} 

Propel::getDatabaseMap(BaseReportePeer::DATABASE_NAME)->addTableBuilder(BaseReportePeer::TABLE_NAME, BaseReportePeer::getMapBuilder());

