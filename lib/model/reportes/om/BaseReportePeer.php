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
	const NUM_COLUMNS = 51;

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

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdreporte', 'CaFchreporte', 'CaConsecutivo', 'CaVersion', 'CaIdcotizacion', 'CaOrigen', 'CaDestino', 'CaImpoexpo', 'CaFchdespacho', 'CaIdagente', 'CaIncoterms', 'CaMercanciaDesc', 'CaIdproveedor', 'CaOrdenProv', 'CaIdconcliente', 'CaOrdenClie', 'CaConfirmarClie', 'CaIdrepresentante', 'CaInformarRepr', 'CaIdconsignatario', 'CaInformarCons', 'CaIdnotify', 'CaInformarNoti', 'CaNotify', 'CaTransporte', 'CaModalidad', 'CaSeguro', 'CaLiberacion', 'CaTiempocredito', 'CaPreferenciasClie', 'CaInstrucciones', 'CaIdlinea', 'CaIdconsignar', 'CaIdconsignarmaster', 'CaIdbodega', 'CaMastersame', 'CaContinuacion', 'CaContinuacionDest', 'CaContinuacionConf', 'CaEtapaActual', 'CaLogin', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', 'CaFchanulado', 'CaUsuanulado', 'CaFchcerrado', 'CaUsucerrado', 'CaColmas', 'CaPropiedades', ),
		BasePeer::TYPE_COLNAME => array (ReportePeer::CA_IDREPORTE, ReportePeer::CA_FCHREPORTE, ReportePeer::CA_CONSECUTIVO, ReportePeer::CA_VERSION, ReportePeer::CA_IDCOTIZACION, ReportePeer::CA_ORIGEN, ReportePeer::CA_DESTINO, ReportePeer::CA_IMPOEXPO, ReportePeer::CA_FCHDESPACHO, ReportePeer::CA_IDAGENTE, ReportePeer::CA_INCOTERMS, ReportePeer::CA_MERCANCIA_DESC, ReportePeer::CA_IDPROVEEDOR, ReportePeer::CA_ORDEN_PROV, ReportePeer::CA_IDCONCLIENTE, ReportePeer::CA_ORDEN_CLIE, ReportePeer::CA_CONFIRMAR_CLIE, ReportePeer::CA_IDREPRESENTANTE, ReportePeer::CA_INFORMAR_REPR, ReportePeer::CA_IDCONSIGNATARIO, ReportePeer::CA_INFORMAR_CONS, ReportePeer::CA_IDNOTIFY, ReportePeer::CA_INFORMAR_NOTI, ReportePeer::CA_NOTIFY, ReportePeer::CA_TRANSPORTE, ReportePeer::CA_MODALIDAD, ReportePeer::CA_SEGURO, ReportePeer::CA_LIBERACION, ReportePeer::CA_TIEMPOCREDITO, ReportePeer::CA_PREFERENCIAS_CLIE, ReportePeer::CA_INSTRUCCIONES, ReportePeer::CA_IDLINEA, ReportePeer::CA_IDCONSIGNAR, ReportePeer::CA_IDCONSIGNARMASTER, ReportePeer::CA_IDBODEGA, ReportePeer::CA_MASTERSAME, ReportePeer::CA_CONTINUACION, ReportePeer::CA_CONTINUACION_DEST, ReportePeer::CA_CONTINUACION_CONF, ReportePeer::CA_ETAPA_ACTUAL, ReportePeer::CA_LOGIN, ReportePeer::CA_FCHCREADO, ReportePeer::CA_USUCREADO, ReportePeer::CA_FCHACTUALIZADO, ReportePeer::CA_USUACTUALIZADO, ReportePeer::CA_FCHANULADO, ReportePeer::CA_USUANULADO, ReportePeer::CA_FCHCERRADO, ReportePeer::CA_USUCERRADO, ReportePeer::CA_COLMAS, ReportePeer::CA_PROPIEDADES, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idreporte', 'ca_fchreporte', 'ca_consecutivo', 'ca_version', 'ca_idcotizacion', 'ca_origen', 'ca_destino', 'ca_impoexpo', 'ca_fchdespacho', 'ca_idagente', 'ca_incoterms', 'ca_mercancia_desc', 'ca_idproveedor', 'ca_orden_prov', 'ca_idconcliente', 'ca_orden_clie', 'ca_confirmar_clie', 'ca_idrepresentante', 'ca_informar_repr', 'ca_idconsignatario', 'ca_informar_cons', 'ca_idnotify', 'ca_informar_noti', 'ca_notify', 'ca_transporte', 'ca_modalidad', 'ca_seguro', 'ca_liberacion', 'ca_tiempocredito', 'ca_preferencias_clie', 'ca_instrucciones', 'ca_idlinea', 'ca_idconsignar', 'ca_idconsignarmaster', 'ca_idbodega', 'ca_mastersame', 'ca_continuacion', 'ca_continuacion_dest', 'ca_continuacion_conf', 'ca_etapa_actual', 'ca_login', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', 'ca_fchanulado', 'ca_usuanulado', 'ca_fchcerrado', 'ca_usucerrado', 'ca_colmas', 'ca_propiedades', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdreporte' => 0, 'CaFchreporte' => 1, 'CaConsecutivo' => 2, 'CaVersion' => 3, 'CaIdcotizacion' => 4, 'CaOrigen' => 5, 'CaDestino' => 6, 'CaImpoexpo' => 7, 'CaFchdespacho' => 8, 'CaIdagente' => 9, 'CaIncoterms' => 10, 'CaMercanciaDesc' => 11, 'CaIdproveedor' => 12, 'CaOrdenProv' => 13, 'CaIdconcliente' => 14, 'CaOrdenClie' => 15, 'CaConfirmarClie' => 16, 'CaIdrepresentante' => 17, 'CaInformarRepr' => 18, 'CaIdconsignatario' => 19, 'CaInformarCons' => 20, 'CaIdnotify' => 21, 'CaInformarNoti' => 22, 'CaNotify' => 23, 'CaTransporte' => 24, 'CaModalidad' => 25, 'CaSeguro' => 26, 'CaLiberacion' => 27, 'CaTiempocredito' => 28, 'CaPreferenciasClie' => 29, 'CaInstrucciones' => 30, 'CaIdlinea' => 31, 'CaIdconsignar' => 32, 'CaIdconsignarmaster' => 33, 'CaIdbodega' => 34, 'CaMastersame' => 35, 'CaContinuacion' => 36, 'CaContinuacionDest' => 37, 'CaContinuacionConf' => 38, 'CaEtapaActual' => 39, 'CaLogin' => 40, 'CaFchcreado' => 41, 'CaUsucreado' => 42, 'CaFchactualizado' => 43, 'CaUsuactualizado' => 44, 'CaFchanulado' => 45, 'CaUsuanulado' => 46, 'CaFchcerrado' => 47, 'CaUsucerrado' => 48, 'CaColmas' => 49, 'CaPropiedades' => 50, ),
		BasePeer::TYPE_COLNAME => array (ReportePeer::CA_IDREPORTE => 0, ReportePeer::CA_FCHREPORTE => 1, ReportePeer::CA_CONSECUTIVO => 2, ReportePeer::CA_VERSION => 3, ReportePeer::CA_IDCOTIZACION => 4, ReportePeer::CA_ORIGEN => 5, ReportePeer::CA_DESTINO => 6, ReportePeer::CA_IMPOEXPO => 7, ReportePeer::CA_FCHDESPACHO => 8, ReportePeer::CA_IDAGENTE => 9, ReportePeer::CA_INCOTERMS => 10, ReportePeer::CA_MERCANCIA_DESC => 11, ReportePeer::CA_IDPROVEEDOR => 12, ReportePeer::CA_ORDEN_PROV => 13, ReportePeer::CA_IDCONCLIENTE => 14, ReportePeer::CA_ORDEN_CLIE => 15, ReportePeer::CA_CONFIRMAR_CLIE => 16, ReportePeer::CA_IDREPRESENTANTE => 17, ReportePeer::CA_INFORMAR_REPR => 18, ReportePeer::CA_IDCONSIGNATARIO => 19, ReportePeer::CA_INFORMAR_CONS => 20, ReportePeer::CA_IDNOTIFY => 21, ReportePeer::CA_INFORMAR_NOTI => 22, ReportePeer::CA_NOTIFY => 23, ReportePeer::CA_TRANSPORTE => 24, ReportePeer::CA_MODALIDAD => 25, ReportePeer::CA_SEGURO => 26, ReportePeer::CA_LIBERACION => 27, ReportePeer::CA_TIEMPOCREDITO => 28, ReportePeer::CA_PREFERENCIAS_CLIE => 29, ReportePeer::CA_INSTRUCCIONES => 30, ReportePeer::CA_IDLINEA => 31, ReportePeer::CA_IDCONSIGNAR => 32, ReportePeer::CA_IDCONSIGNARMASTER => 33, ReportePeer::CA_IDBODEGA => 34, ReportePeer::CA_MASTERSAME => 35, ReportePeer::CA_CONTINUACION => 36, ReportePeer::CA_CONTINUACION_DEST => 37, ReportePeer::CA_CONTINUACION_CONF => 38, ReportePeer::CA_ETAPA_ACTUAL => 39, ReportePeer::CA_LOGIN => 40, ReportePeer::CA_FCHCREADO => 41, ReportePeer::CA_USUCREADO => 42, ReportePeer::CA_FCHACTUALIZADO => 43, ReportePeer::CA_USUACTUALIZADO => 44, ReportePeer::CA_FCHANULADO => 45, ReportePeer::CA_USUANULADO => 46, ReportePeer::CA_FCHCERRADO => 47, ReportePeer::CA_USUCERRADO => 48, ReportePeer::CA_COLMAS => 49, ReportePeer::CA_PROPIEDADES => 50, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idreporte' => 0, 'ca_fchreporte' => 1, 'ca_consecutivo' => 2, 'ca_version' => 3, 'ca_idcotizacion' => 4, 'ca_origen' => 5, 'ca_destino' => 6, 'ca_impoexpo' => 7, 'ca_fchdespacho' => 8, 'ca_idagente' => 9, 'ca_incoterms' => 10, 'ca_mercancia_desc' => 11, 'ca_idproveedor' => 12, 'ca_orden_prov' => 13, 'ca_idconcliente' => 14, 'ca_orden_clie' => 15, 'ca_confirmar_clie' => 16, 'ca_idrepresentante' => 17, 'ca_informar_repr' => 18, 'ca_idconsignatario' => 19, 'ca_informar_cons' => 20, 'ca_idnotify' => 21, 'ca_informar_noti' => 22, 'ca_notify' => 23, 'ca_transporte' => 24, 'ca_modalidad' => 25, 'ca_seguro' => 26, 'ca_liberacion' => 27, 'ca_tiempocredito' => 28, 'ca_preferencias_clie' => 29, 'ca_instrucciones' => 30, 'ca_idlinea' => 31, 'ca_idconsignar' => 32, 'ca_idconsignarmaster' => 33, 'ca_idbodega' => 34, 'ca_mastersame' => 35, 'ca_continuacion' => 36, 'ca_continuacion_dest' => 37, 'ca_continuacion_conf' => 38, 'ca_etapa_actual' => 39, 'ca_login' => 40, 'ca_fchcreado' => 41, 'ca_usucreado' => 42, 'ca_fchactualizado' => 43, 'ca_usuactualizado' => 44, 'ca_fchanulado' => 45, 'ca_usuanulado' => 46, 'ca_fchcerrado' => 47, 'ca_usucerrado' => 48, 'ca_colmas' => 49, 'ca_propiedades' => 50, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.reportes.map.ReporteMapBuilder');
	}
	/**
	 * Gets a map (hash) of PHP names to DB column names.
	 *
	 * @return     array The PHP to DB name map for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @deprecated Use the getFieldNames() and translateFieldName() methods instead of this.
	 */
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ReportePeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants TYPE_PHPNAME,
	 *                         TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
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
	 * Returns an array of of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants TYPE_PHPNAME,
	 *                      TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
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

	}

	const COUNT = 'COUNT(tb_reportes.CA_IDREPORTE)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT tb_reportes.CA_IDREPORTE)';

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ReportePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ReportePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ReportePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}
	/**
	 * Method to select one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      Connection $con
	 * @return     Reporte
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
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
	 * @param      Connection $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ReportePeer::populateObjects(ReportePeer::doSelectRS($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect()
	 * method to get a ResultSet.
	 *
	 * Use this method directly if you want to just get the resultset
	 * (instead of an array of objects).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      Connection $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     ResultSet The resultset object with numerically-indexed fields.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ReportePeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		// BasePeer returns a Creole ResultSet, set to return
		// rows indexed numerically.
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = ReportePeer::getOMClass();
		$cls = Propel::import($cls);
		// populate the object(s)
		while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related Usuario table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinUsuario(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ReportePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ReportePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ReportePeer::CA_LOGIN, UsuarioPeer::CA_LOGIN);

		$rs = ReportePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Transportador table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinTransportador(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ReportePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ReportePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ReportePeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA);

		$rs = ReportePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Tercero table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinTercero(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ReportePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ReportePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ReportePeer::CA_IDPROVEEDOR, TerceroPeer::CA_IDTERCERO);

		$rs = ReportePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Agente table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAgente(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ReportePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ReportePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ReportePeer::CA_IDAGENTE, AgentePeer::CA_IDAGENTE);

		$rs = ReportePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Bodega table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinBodega(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ReportePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ReportePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ReportePeer::CA_IDBODEGA, BodegaPeer::CA_IDBODEGA);

		$rs = ReportePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Reporte objects pre-filled with their Usuario objects.
	 *
	 * @return     array Array of Reporte objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUsuario(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReportePeer::addSelectColumns($c);
		$startcol = (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(ReportePeer::CA_LOGIN, UsuarioPeer::CA_LOGIN);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ReportePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsuarioPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUsuario(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addReporte($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initReportes();
				$obj2->addReporte($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Reporte objects pre-filled with their Transportador objects.
	 *
	 * @return     array Array of Reporte objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinTransportador(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReportePeer::addSelectColumns($c);
		$startcol = (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TransportadorPeer::addSelectColumns($c);

		$c->addJoin(ReportePeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ReportePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TransportadorPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTransportador(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addReporte($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initReportes();
				$obj2->addReporte($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Reporte objects pre-filled with their Tercero objects.
	 *
	 * @return     array Array of Reporte objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinTercero(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReportePeer::addSelectColumns($c);
		$startcol = (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TerceroPeer::addSelectColumns($c);

		$c->addJoin(ReportePeer::CA_IDPROVEEDOR, TerceroPeer::CA_IDTERCERO);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ReportePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TerceroPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTercero(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addReporte($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initReportes();
				$obj2->addReporte($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Reporte objects pre-filled with their Agente objects.
	 *
	 * @return     array Array of Reporte objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAgente(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReportePeer::addSelectColumns($c);
		$startcol = (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		AgentePeer::addSelectColumns($c);

		$c->addJoin(ReportePeer::CA_IDAGENTE, AgentePeer::CA_IDAGENTE);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ReportePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = AgentePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getAgente(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addReporte($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initReportes();
				$obj2->addReporte($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Reporte objects pre-filled with their Bodega objects.
	 *
	 * @return     array Array of Reporte objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinBodega(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReportePeer::addSelectColumns($c);
		$startcol = (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		BodegaPeer::addSelectColumns($c);

		$c->addJoin(ReportePeer::CA_IDBODEGA, BodegaPeer::CA_IDBODEGA);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ReportePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = BodegaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getBodega(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addReporte($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initReportes();
				$obj2->addReporte($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining all related tables
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ReportePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ReportePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ReportePeer::CA_LOGIN, UsuarioPeer::CA_LOGIN);

		$criteria->addJoin(ReportePeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA);

		$criteria->addJoin(ReportePeer::CA_IDPROVEEDOR, TerceroPeer::CA_IDTERCERO);

		$criteria->addJoin(ReportePeer::CA_IDAGENTE, AgentePeer::CA_IDAGENTE);

		$criteria->addJoin(ReportePeer::CA_IDBODEGA, BodegaPeer::CA_IDBODEGA);

		$rs = ReportePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Reporte objects pre-filled with all related objects.
	 *
	 * @return     array Array of Reporte objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReportePeer::addSelectColumns($c);
		$startcol2 = (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		TransportadorPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TransportadorPeer::NUM_COLUMNS;

		TerceroPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TerceroPeer::NUM_COLUMNS;

		AgentePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + AgentePeer::NUM_COLUMNS;

		BodegaPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + BodegaPeer::NUM_COLUMNS;

		$c->addJoin(ReportePeer::CA_LOGIN, UsuarioPeer::CA_LOGIN);

		$c->addJoin(ReportePeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA);

		$c->addJoin(ReportePeer::CA_IDPROVEEDOR, TerceroPeer::CA_IDTERCERO);

		$c->addJoin(ReportePeer::CA_IDAGENTE, AgentePeer::CA_IDAGENTE);

		$c->addJoin(ReportePeer::CA_IDBODEGA, BodegaPeer::CA_IDBODEGA);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ReportePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined Usuario rows
	
			$omClass = UsuarioPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUsuario(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addReporte($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initReportes();
				$obj2->addReporte($obj1);
			}


				// Add objects for joined Transportador rows
	
			$omClass = TransportadorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTransportador(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addReporte($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initReportes();
				$obj3->addReporte($obj1);
			}


				// Add objects for joined Tercero rows
	
			$omClass = TerceroPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getTercero(); // CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addReporte($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj4->initReportes();
				$obj4->addReporte($obj1);
			}


				// Add objects for joined Agente rows
	
			$omClass = AgentePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getAgente(); // CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addReporte($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj5->initReportes();
				$obj5->addReporte($obj1);
			}


				// Add objects for joined Bodega rows
	
			$omClass = BodegaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6 = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getBodega(); // CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addReporte($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj6->initReportes();
				$obj6->addReporte($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Usuario table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUsuario(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ReportePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ReportePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ReportePeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA);

		$criteria->addJoin(ReportePeer::CA_IDPROVEEDOR, TerceroPeer::CA_IDTERCERO);

		$criteria->addJoin(ReportePeer::CA_IDAGENTE, AgentePeer::CA_IDAGENTE);

		$criteria->addJoin(ReportePeer::CA_IDBODEGA, BodegaPeer::CA_IDBODEGA);

		$rs = ReportePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Transportador table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptTransportador(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ReportePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ReportePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ReportePeer::CA_LOGIN, UsuarioPeer::CA_LOGIN);

		$criteria->addJoin(ReportePeer::CA_IDPROVEEDOR, TerceroPeer::CA_IDTERCERO);

		$criteria->addJoin(ReportePeer::CA_IDAGENTE, AgentePeer::CA_IDAGENTE);

		$criteria->addJoin(ReportePeer::CA_IDBODEGA, BodegaPeer::CA_IDBODEGA);

		$rs = ReportePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Tercero table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptTercero(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ReportePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ReportePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ReportePeer::CA_LOGIN, UsuarioPeer::CA_LOGIN);

		$criteria->addJoin(ReportePeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA);

		$criteria->addJoin(ReportePeer::CA_IDAGENTE, AgentePeer::CA_IDAGENTE);

		$criteria->addJoin(ReportePeer::CA_IDBODEGA, BodegaPeer::CA_IDBODEGA);

		$rs = ReportePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Agente table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptAgente(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ReportePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ReportePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ReportePeer::CA_LOGIN, UsuarioPeer::CA_LOGIN);

		$criteria->addJoin(ReportePeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA);

		$criteria->addJoin(ReportePeer::CA_IDPROVEEDOR, TerceroPeer::CA_IDTERCERO);

		$criteria->addJoin(ReportePeer::CA_IDBODEGA, BodegaPeer::CA_IDBODEGA);

		$rs = ReportePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Bodega table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptBodega(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ReportePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ReportePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ReportePeer::CA_LOGIN, UsuarioPeer::CA_LOGIN);

		$criteria->addJoin(ReportePeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA);

		$criteria->addJoin(ReportePeer::CA_IDPROVEEDOR, TerceroPeer::CA_IDTERCERO);

		$criteria->addJoin(ReportePeer::CA_IDAGENTE, AgentePeer::CA_IDAGENTE);

		$rs = ReportePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Reporte objects pre-filled with all related objects except Usuario.
	 *
	 * @return     array Array of Reporte objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUsuario(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReportePeer::addSelectColumns($c);
		$startcol2 = (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TransportadorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TransportadorPeer::NUM_COLUMNS;

		TerceroPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TerceroPeer::NUM_COLUMNS;

		AgentePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + AgentePeer::NUM_COLUMNS;

		BodegaPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + BodegaPeer::NUM_COLUMNS;

		$c->addJoin(ReportePeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA);

		$c->addJoin(ReportePeer::CA_IDPROVEEDOR, TerceroPeer::CA_IDTERCERO);

		$c->addJoin(ReportePeer::CA_IDAGENTE, AgentePeer::CA_IDAGENTE);

		$c->addJoin(ReportePeer::CA_IDBODEGA, BodegaPeer::CA_IDBODEGA);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ReportePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TransportadorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getTransportador(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addReporte($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initReportes();
				$obj2->addReporte($obj1);
			}

			$omClass = TerceroPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTercero(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addReporte($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initReportes();
				$obj3->addReporte($obj1);
			}

			$omClass = AgentePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getAgente(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addReporte($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initReportes();
				$obj4->addReporte($obj1);
			}

			$omClass = BodegaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getBodega(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addReporte($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initReportes();
				$obj5->addReporte($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Reporte objects pre-filled with all related objects except Transportador.
	 *
	 * @return     array Array of Reporte objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptTransportador(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReportePeer::addSelectColumns($c);
		$startcol2 = (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		TerceroPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TerceroPeer::NUM_COLUMNS;

		AgentePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + AgentePeer::NUM_COLUMNS;

		BodegaPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + BodegaPeer::NUM_COLUMNS;

		$c->addJoin(ReportePeer::CA_LOGIN, UsuarioPeer::CA_LOGIN);

		$c->addJoin(ReportePeer::CA_IDPROVEEDOR, TerceroPeer::CA_IDTERCERO);

		$c->addJoin(ReportePeer::CA_IDAGENTE, AgentePeer::CA_IDAGENTE);

		$c->addJoin(ReportePeer::CA_IDBODEGA, BodegaPeer::CA_IDBODEGA);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ReportePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsuarioPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUsuario(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addReporte($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initReportes();
				$obj2->addReporte($obj1);
			}

			$omClass = TerceroPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTercero(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addReporte($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initReportes();
				$obj3->addReporte($obj1);
			}

			$omClass = AgentePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getAgente(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addReporte($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initReportes();
				$obj4->addReporte($obj1);
			}

			$omClass = BodegaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getBodega(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addReporte($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initReportes();
				$obj5->addReporte($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Reporte objects pre-filled with all related objects except Tercero.
	 *
	 * @return     array Array of Reporte objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptTercero(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReportePeer::addSelectColumns($c);
		$startcol2 = (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		TransportadorPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TransportadorPeer::NUM_COLUMNS;

		AgentePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + AgentePeer::NUM_COLUMNS;

		BodegaPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + BodegaPeer::NUM_COLUMNS;

		$c->addJoin(ReportePeer::CA_LOGIN, UsuarioPeer::CA_LOGIN);

		$c->addJoin(ReportePeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA);

		$c->addJoin(ReportePeer::CA_IDAGENTE, AgentePeer::CA_IDAGENTE);

		$c->addJoin(ReportePeer::CA_IDBODEGA, BodegaPeer::CA_IDBODEGA);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ReportePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsuarioPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUsuario(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addReporte($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initReportes();
				$obj2->addReporte($obj1);
			}

			$omClass = TransportadorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTransportador(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addReporte($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initReportes();
				$obj3->addReporte($obj1);
			}

			$omClass = AgentePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getAgente(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addReporte($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initReportes();
				$obj4->addReporte($obj1);
			}

			$omClass = BodegaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getBodega(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addReporte($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initReportes();
				$obj5->addReporte($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Reporte objects pre-filled with all related objects except Agente.
	 *
	 * @return     array Array of Reporte objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptAgente(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReportePeer::addSelectColumns($c);
		$startcol2 = (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		TransportadorPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TransportadorPeer::NUM_COLUMNS;

		TerceroPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TerceroPeer::NUM_COLUMNS;

		BodegaPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + BodegaPeer::NUM_COLUMNS;

		$c->addJoin(ReportePeer::CA_LOGIN, UsuarioPeer::CA_LOGIN);

		$c->addJoin(ReportePeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA);

		$c->addJoin(ReportePeer::CA_IDPROVEEDOR, TerceroPeer::CA_IDTERCERO);

		$c->addJoin(ReportePeer::CA_IDBODEGA, BodegaPeer::CA_IDBODEGA);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ReportePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsuarioPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUsuario(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addReporte($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initReportes();
				$obj2->addReporte($obj1);
			}

			$omClass = TransportadorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTransportador(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addReporte($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initReportes();
				$obj3->addReporte($obj1);
			}

			$omClass = TerceroPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getTercero(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addReporte($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initReportes();
				$obj4->addReporte($obj1);
			}

			$omClass = BodegaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getBodega(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addReporte($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initReportes();
				$obj5->addReporte($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Reporte objects pre-filled with all related objects except Bodega.
	 *
	 * @return     array Array of Reporte objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptBodega(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ReportePeer::addSelectColumns($c);
		$startcol2 = (ReportePeer::NUM_COLUMNS - ReportePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		TransportadorPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TransportadorPeer::NUM_COLUMNS;

		TerceroPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + TerceroPeer::NUM_COLUMNS;

		AgentePeer::addSelectColumns($c);
		$startcol6 = $startcol5 + AgentePeer::NUM_COLUMNS;

		$c->addJoin(ReportePeer::CA_LOGIN, UsuarioPeer::CA_LOGIN);

		$c->addJoin(ReportePeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA);

		$c->addJoin(ReportePeer::CA_IDPROVEEDOR, TerceroPeer::CA_IDTERCERO);

		$c->addJoin(ReportePeer::CA_IDAGENTE, AgentePeer::CA_IDAGENTE);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ReportePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsuarioPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUsuario(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addReporte($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initReportes();
				$obj2->addReporte($obj1);
			}

			$omClass = TransportadorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTransportador(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addReporte($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initReportes();
				$obj3->addReporte($obj1);
			}

			$omClass = TerceroPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getTercero(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addReporte($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initReportes();
				$obj4->addReporte($obj1);
			}

			$omClass = AgentePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getAgente(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addReporte($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initReportes();
				$obj5->addReporte($obj1);
			}

			$results[] = $obj1;
		}
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
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from Reporte object
		}

		$criteria->remove(ReportePeer::CA_IDREPORTE); // remove pkey col since this table uses auto-increment


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a Reporte or Criteria object.
	 *
	 * @param      mixed $values Criteria or Reporte object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
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
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->begin();
			$affectedRows += BasePeer::doDeleteAll(ReportePeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a Reporte or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or Reporte object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      Connection $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(ReportePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof Reporte) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ReportePeer::CA_IDREPORTE, (array) $values, Criteria::IN);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
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

			foreach($cols as $colName) {
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
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      mixed $pk the primary key.
	 * @param      Connection $con the connection to use
	 * @return     Reporte
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
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
	 * @param      Connection $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(ReportePeer::CA_IDREPORTE, $pks, Criteria::IN);
			$objs = ReportePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseReportePeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseReportePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	Propel::registerMapBuilder('lib.model.reportes.map.ReporteMapBuilder');
}
