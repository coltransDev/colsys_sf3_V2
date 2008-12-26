<?php

/**
 * Base static class for performing query and update operations on the 'tb_inomaestra_sea' table.
 *
 * 
 *
 * @package    lib.model.sea.om
 */
abstract class BaseInoMaestraSeaPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_inomaestra_sea';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.sea.InoMaestraSea';

	/** The total number of columns. */
	const NUM_COLUMNS = 43;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the CA_FCHREFERENCIA field */
	const CA_FCHREFERENCIA = 'tb_inomaestra_sea.CA_FCHREFERENCIA';

	/** the column name for the CA_REFERENCIA field */
	const CA_REFERENCIA = 'tb_inomaestra_sea.CA_REFERENCIA';

	/** the column name for the CA_IMPOEXPO field */
	const CA_IMPOEXPO = 'tb_inomaestra_sea.CA_IMPOEXPO';

	/** the column name for the CA_ORIGEN field */
	const CA_ORIGEN = 'tb_inomaestra_sea.CA_ORIGEN';

	/** the column name for the CA_DESTINO field */
	const CA_DESTINO = 'tb_inomaestra_sea.CA_DESTINO';

	/** the column name for the CA_FCHEMBARQUE field */
	const CA_FCHEMBARQUE = 'tb_inomaestra_sea.CA_FCHEMBARQUE';

	/** the column name for the CA_FCHARRIBO field */
	const CA_FCHARRIBO = 'tb_inomaestra_sea.CA_FCHARRIBO';

	/** the column name for the CA_MODALIDAD field */
	const CA_MODALIDAD = 'tb_inomaestra_sea.CA_MODALIDAD';

	/** the column name for the CA_IDLINEA field */
	const CA_IDLINEA = 'tb_inomaestra_sea.CA_IDLINEA';

	/** the column name for the CA_MOTONAVE field */
	const CA_MOTONAVE = 'tb_inomaestra_sea.CA_MOTONAVE';

	/** the column name for the CA_CICLO field */
	const CA_CICLO = 'tb_inomaestra_sea.CA_CICLO';

	/** the column name for the CA_MBLS field */
	const CA_MBLS = 'tb_inomaestra_sea.CA_MBLS';

	/** the column name for the CA_OBSERVACIONES field */
	const CA_OBSERVACIONES = 'tb_inomaestra_sea.CA_OBSERVACIONES';

	/** the column name for the CA_FCHCONFIRMACION field */
	const CA_FCHCONFIRMACION = 'tb_inomaestra_sea.CA_FCHCONFIRMACION';

	/** the column name for the CA_HORACONFIRMACION field */
	const CA_HORACONFIRMACION = 'tb_inomaestra_sea.CA_HORACONFIRMACION';

	/** the column name for the CA_REGISTROADU field */
	const CA_REGISTROADU = 'tb_inomaestra_sea.CA_REGISTROADU';

	/** the column name for the CA_REGISTROCAP field */
	const CA_REGISTROCAP = 'tb_inomaestra_sea.CA_REGISTROCAP';

	/** the column name for the CA_BANDERA field */
	const CA_BANDERA = 'tb_inomaestra_sea.CA_BANDERA';

	/** the column name for the CA_FCHLIBERACION field */
	const CA_FCHLIBERACION = 'tb_inomaestra_sea.CA_FCHLIBERACION';

	/** the column name for the CA_NROLIBERACION field */
	const CA_NROLIBERACION = 'tb_inomaestra_sea.CA_NROLIBERACION';

	/** the column name for the CA_ANULADO field */
	const CA_ANULADO = 'tb_inomaestra_sea.CA_ANULADO';

	/** the column name for the CA_FCHCREADO field */
	const CA_FCHCREADO = 'tb_inomaestra_sea.CA_FCHCREADO';

	/** the column name for the CA_USUCREADO field */
	const CA_USUCREADO = 'tb_inomaestra_sea.CA_USUCREADO';

	/** the column name for the CA_FCHACTUALIZADO field */
	const CA_FCHACTUALIZADO = 'tb_inomaestra_sea.CA_FCHACTUALIZADO';

	/** the column name for the CA_USUACTUALIZADO field */
	const CA_USUACTUALIZADO = 'tb_inomaestra_sea.CA_USUACTUALIZADO';

	/** the column name for the CA_FCHLIQUIDADO field */
	const CA_FCHLIQUIDADO = 'tb_inomaestra_sea.CA_FCHLIQUIDADO';

	/** the column name for the CA_USULIQUIDADO field */
	const CA_USULIQUIDADO = 'tb_inomaestra_sea.CA_USULIQUIDADO';

	/** the column name for the CA_FCHCERRADO field */
	const CA_FCHCERRADO = 'tb_inomaestra_sea.CA_FCHCERRADO';

	/** the column name for the CA_USUCERRADO field */
	const CA_USUCERRADO = 'tb_inomaestra_sea.CA_USUCERRADO';

	/** the column name for the CA_MENSAJE field */
	const CA_MENSAJE = 'tb_inomaestra_sea.CA_MENSAJE';

	/** the column name for the CA_FCHDESCONSOLIDACION field */
	const CA_FCHDESCONSOLIDACION = 'tb_inomaestra_sea.CA_FCHDESCONSOLIDACION';

	/** the column name for the CA_MNLLEGADA field */
	const CA_MNLLEGADA = 'tb_inomaestra_sea.CA_MNLLEGADA';

	/** the column name for the CA_FCHREGISTROADU field */
	const CA_FCHREGISTROADU = 'tb_inomaestra_sea.CA_FCHREGISTROADU';

	/** the column name for the CA_FCHCONFIRMADO field */
	const CA_FCHCONFIRMADO = 'tb_inomaestra_sea.CA_FCHCONFIRMADO';

	/** the column name for the CA_USUCONFIRMADO field */
	const CA_USUCONFIRMADO = 'tb_inomaestra_sea.CA_USUCONFIRMADO';

	/** the column name for the CA_ASUNTO_OTM field */
	const CA_ASUNTO_OTM = 'tb_inomaestra_sea.CA_ASUNTO_OTM';

	/** the column name for the CA_MENSAJE_OTM field */
	const CA_MENSAJE_OTM = 'tb_inomaestra_sea.CA_MENSAJE_OTM';

	/** the column name for the CA_FCHLLEGADA_OTM field */
	const CA_FCHLLEGADA_OTM = 'tb_inomaestra_sea.CA_FCHLLEGADA_OTM';

	/** the column name for the CA_CIUDAD_OTM field */
	const CA_CIUDAD_OTM = 'tb_inomaestra_sea.CA_CIUDAD_OTM';

	/** the column name for the CA_FCHCONFIRMA_OTM field */
	const CA_FCHCONFIRMA_OTM = 'tb_inomaestra_sea.CA_FCHCONFIRMA_OTM';

	/** the column name for the CA_USUCONFIRMA_OTM field */
	const CA_USUCONFIRMA_OTM = 'tb_inomaestra_sea.CA_USUCONFIRMA_OTM';

	/** the column name for the CA_PROVISIONAL field */
	const CA_PROVISIONAL = 'tb_inomaestra_sea.CA_PROVISIONAL';

	/** the column name for the CA_SITIODEVOLUCION field */
	const CA_SITIODEVOLUCION = 'tb_inomaestra_sea.CA_SITIODEVOLUCION';

	/**
	 * An identiy map to hold any loaded instances of InoMaestraSea objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array InoMaestraSea[]
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
		BasePeer::TYPE_PHPNAME => array ('CaFchreferencia', 'CaReferencia', 'CaImpoexpo', 'CaOrigen', 'CaDestino', 'CaFchembarque', 'CaFcharribo', 'CaModalidad', 'CaIdlinea', 'CaMotonave', 'CaCiclo', 'CaMbls', 'CaObservaciones', 'CaFchconfirmacion', 'CaHoraconfirmacion', 'CaRegistroadu', 'CaRegistrocap', 'CaBandera', 'CaFchliberacion', 'CaNroliberacion', 'CaAnulado', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', 'CaFchliquidado', 'CaUsuliquidado', 'CaFchcerrado', 'CaUsucerrado', 'CaMensaje', 'CaFchdesconsolidacion', 'CaMnllegada', 'CaFchregistroadu', 'CaFchconfirmado', 'CaUsuconfirmado', 'CaAsuntoOtm', 'CaMensajeOtm', 'CaFchllegadaOtm', 'CaCiudadOtm', 'CaFchconfirmaOtm', 'CaUsuconfirmaOtm', 'CaProvisional', 'CaSitiodevolucion', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caFchreferencia', 'caReferencia', 'caImpoexpo', 'caOrigen', 'caDestino', 'caFchembarque', 'caFcharribo', 'caModalidad', 'caIdlinea', 'caMotonave', 'caCiclo', 'caMbls', 'caObservaciones', 'caFchconfirmacion', 'caHoraconfirmacion', 'caRegistroadu', 'caRegistrocap', 'caBandera', 'caFchliberacion', 'caNroliberacion', 'caAnulado', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', 'caFchliquidado', 'caUsuliquidado', 'caFchcerrado', 'caUsucerrado', 'caMensaje', 'caFchdesconsolidacion', 'caMnllegada', 'caFchregistroadu', 'caFchconfirmado', 'caUsuconfirmado', 'caAsuntoOtm', 'caMensajeOtm', 'caFchllegadaOtm', 'caCiudadOtm', 'caFchconfirmaOtm', 'caUsuconfirmaOtm', 'caProvisional', 'caSitiodevolucion', ),
		BasePeer::TYPE_COLNAME => array (self::CA_FCHREFERENCIA, self::CA_REFERENCIA, self::CA_IMPOEXPO, self::CA_ORIGEN, self::CA_DESTINO, self::CA_FCHEMBARQUE, self::CA_FCHARRIBO, self::CA_MODALIDAD, self::CA_IDLINEA, self::CA_MOTONAVE, self::CA_CICLO, self::CA_MBLS, self::CA_OBSERVACIONES, self::CA_FCHCONFIRMACION, self::CA_HORACONFIRMACION, self::CA_REGISTROADU, self::CA_REGISTROCAP, self::CA_BANDERA, self::CA_FCHLIBERACION, self::CA_NROLIBERACION, self::CA_ANULADO, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, self::CA_FCHLIQUIDADO, self::CA_USULIQUIDADO, self::CA_FCHCERRADO, self::CA_USUCERRADO, self::CA_MENSAJE, self::CA_FCHDESCONSOLIDACION, self::CA_MNLLEGADA, self::CA_FCHREGISTROADU, self::CA_FCHCONFIRMADO, self::CA_USUCONFIRMADO, self::CA_ASUNTO_OTM, self::CA_MENSAJE_OTM, self::CA_FCHLLEGADA_OTM, self::CA_CIUDAD_OTM, self::CA_FCHCONFIRMA_OTM, self::CA_USUCONFIRMA_OTM, self::CA_PROVISIONAL, self::CA_SITIODEVOLUCION, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_fchreferencia', 'ca_referencia', 'ca_impoexpo', 'ca_origen', 'ca_destino', 'ca_fchembarque', 'ca_fcharribo', 'ca_modalidad', 'ca_idlinea', 'ca_motonave', 'ca_ciclo', 'ca_mbls', 'ca_observaciones', 'ca_fchconfirmacion', 'ca_horaconfirmacion', 'ca_registroadu', 'ca_registrocap', 'ca_bandera', 'ca_fchliberacion', 'ca_nroliberacion', 'ca_anulado', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', 'ca_fchliquidado', 'ca_usuliquidado', 'ca_fchcerrado', 'ca_usucerrado', 'ca_mensaje', 'ca_fchdesconsolidacion', 'ca_mnllegada', 'ca_fchregistroadu', 'ca_fchconfirmado', 'ca_usuconfirmado', 'ca_asunto_otm', 'ca_mensaje_otm', 'ca_fchllegada_otm', 'ca_ciudad_otm', 'ca_fchconfirma_otm', 'ca_usuconfirma_otm', 'ca_provisional', 'ca_sitiodevolucion', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaFchreferencia' => 0, 'CaReferencia' => 1, 'CaImpoexpo' => 2, 'CaOrigen' => 3, 'CaDestino' => 4, 'CaFchembarque' => 5, 'CaFcharribo' => 6, 'CaModalidad' => 7, 'CaIdlinea' => 8, 'CaMotonave' => 9, 'CaCiclo' => 10, 'CaMbls' => 11, 'CaObservaciones' => 12, 'CaFchconfirmacion' => 13, 'CaHoraconfirmacion' => 14, 'CaRegistroadu' => 15, 'CaRegistrocap' => 16, 'CaBandera' => 17, 'CaFchliberacion' => 18, 'CaNroliberacion' => 19, 'CaAnulado' => 20, 'CaFchcreado' => 21, 'CaUsucreado' => 22, 'CaFchactualizado' => 23, 'CaUsuactualizado' => 24, 'CaFchliquidado' => 25, 'CaUsuliquidado' => 26, 'CaFchcerrado' => 27, 'CaUsucerrado' => 28, 'CaMensaje' => 29, 'CaFchdesconsolidacion' => 30, 'CaMnllegada' => 31, 'CaFchregistroadu' => 32, 'CaFchconfirmado' => 33, 'CaUsuconfirmado' => 34, 'CaAsuntoOtm' => 35, 'CaMensajeOtm' => 36, 'CaFchllegadaOtm' => 37, 'CaCiudadOtm' => 38, 'CaFchconfirmaOtm' => 39, 'CaUsuconfirmaOtm' => 40, 'CaProvisional' => 41, 'CaSitiodevolucion' => 42, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caFchreferencia' => 0, 'caReferencia' => 1, 'caImpoexpo' => 2, 'caOrigen' => 3, 'caDestino' => 4, 'caFchembarque' => 5, 'caFcharribo' => 6, 'caModalidad' => 7, 'caIdlinea' => 8, 'caMotonave' => 9, 'caCiclo' => 10, 'caMbls' => 11, 'caObservaciones' => 12, 'caFchconfirmacion' => 13, 'caHoraconfirmacion' => 14, 'caRegistroadu' => 15, 'caRegistrocap' => 16, 'caBandera' => 17, 'caFchliberacion' => 18, 'caNroliberacion' => 19, 'caAnulado' => 20, 'caFchcreado' => 21, 'caUsucreado' => 22, 'caFchactualizado' => 23, 'caUsuactualizado' => 24, 'caFchliquidado' => 25, 'caUsuliquidado' => 26, 'caFchcerrado' => 27, 'caUsucerrado' => 28, 'caMensaje' => 29, 'caFchdesconsolidacion' => 30, 'caMnllegada' => 31, 'caFchregistroadu' => 32, 'caFchconfirmado' => 33, 'caUsuconfirmado' => 34, 'caAsuntoOtm' => 35, 'caMensajeOtm' => 36, 'caFchllegadaOtm' => 37, 'caCiudadOtm' => 38, 'caFchconfirmaOtm' => 39, 'caUsuconfirmaOtm' => 40, 'caProvisional' => 41, 'caSitiodevolucion' => 42, ),
		BasePeer::TYPE_COLNAME => array (self::CA_FCHREFERENCIA => 0, self::CA_REFERENCIA => 1, self::CA_IMPOEXPO => 2, self::CA_ORIGEN => 3, self::CA_DESTINO => 4, self::CA_FCHEMBARQUE => 5, self::CA_FCHARRIBO => 6, self::CA_MODALIDAD => 7, self::CA_IDLINEA => 8, self::CA_MOTONAVE => 9, self::CA_CICLO => 10, self::CA_MBLS => 11, self::CA_OBSERVACIONES => 12, self::CA_FCHCONFIRMACION => 13, self::CA_HORACONFIRMACION => 14, self::CA_REGISTROADU => 15, self::CA_REGISTROCAP => 16, self::CA_BANDERA => 17, self::CA_FCHLIBERACION => 18, self::CA_NROLIBERACION => 19, self::CA_ANULADO => 20, self::CA_FCHCREADO => 21, self::CA_USUCREADO => 22, self::CA_FCHACTUALIZADO => 23, self::CA_USUACTUALIZADO => 24, self::CA_FCHLIQUIDADO => 25, self::CA_USULIQUIDADO => 26, self::CA_FCHCERRADO => 27, self::CA_USUCERRADO => 28, self::CA_MENSAJE => 29, self::CA_FCHDESCONSOLIDACION => 30, self::CA_MNLLEGADA => 31, self::CA_FCHREGISTROADU => 32, self::CA_FCHCONFIRMADO => 33, self::CA_USUCONFIRMADO => 34, self::CA_ASUNTO_OTM => 35, self::CA_MENSAJE_OTM => 36, self::CA_FCHLLEGADA_OTM => 37, self::CA_CIUDAD_OTM => 38, self::CA_FCHCONFIRMA_OTM => 39, self::CA_USUCONFIRMA_OTM => 40, self::CA_PROVISIONAL => 41, self::CA_SITIODEVOLUCION => 42, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_fchreferencia' => 0, 'ca_referencia' => 1, 'ca_impoexpo' => 2, 'ca_origen' => 3, 'ca_destino' => 4, 'ca_fchembarque' => 5, 'ca_fcharribo' => 6, 'ca_modalidad' => 7, 'ca_idlinea' => 8, 'ca_motonave' => 9, 'ca_ciclo' => 10, 'ca_mbls' => 11, 'ca_observaciones' => 12, 'ca_fchconfirmacion' => 13, 'ca_horaconfirmacion' => 14, 'ca_registroadu' => 15, 'ca_registrocap' => 16, 'ca_bandera' => 17, 'ca_fchliberacion' => 18, 'ca_nroliberacion' => 19, 'ca_anulado' => 20, 'ca_fchcreado' => 21, 'ca_usucreado' => 22, 'ca_fchactualizado' => 23, 'ca_usuactualizado' => 24, 'ca_fchliquidado' => 25, 'ca_usuliquidado' => 26, 'ca_fchcerrado' => 27, 'ca_usucerrado' => 28, 'ca_mensaje' => 29, 'ca_fchdesconsolidacion' => 30, 'ca_mnllegada' => 31, 'ca_fchregistroadu' => 32, 'ca_fchconfirmado' => 33, 'ca_usuconfirmado' => 34, 'ca_asunto_otm' => 35, 'ca_mensaje_otm' => 36, 'ca_fchllegada_otm' => 37, 'ca_ciudad_otm' => 38, 'ca_fchconfirma_otm' => 39, 'ca_usuconfirma_otm' => 40, 'ca_provisional' => 41, 'ca_sitiodevolucion' => 42, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, )
	);

	/**
	 * Get a (singleton) instance of the MapBuilder for this peer class.
	 * @return     MapBuilder The map builder for this peer
	 */
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new InoMaestraSeaMapBuilder();
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
	 * @param      string $column The column name for current table. (i.e. InoMaestraSeaPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(InoMaestraSeaPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_FCHREFERENCIA);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_REFERENCIA);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_IMPOEXPO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_ORIGEN);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_DESTINO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_FCHEMBARQUE);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_FCHARRIBO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_MODALIDAD);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_IDLINEA);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_MOTONAVE);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_CICLO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_MBLS);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_FCHCONFIRMACION);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_HORACONFIRMACION);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_REGISTROADU);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_REGISTROCAP);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_BANDERA);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_FCHLIBERACION);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_NROLIBERACION);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_ANULADO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_USUCREADO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_USUACTUALIZADO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_FCHLIQUIDADO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_USULIQUIDADO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_FCHCERRADO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_USUCERRADO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_MENSAJE);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_FCHDESCONSOLIDACION);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_MNLLEGADA);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_FCHREGISTROADU);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_FCHCONFIRMADO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_USUCONFIRMADO);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_ASUNTO_OTM);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_MENSAJE_OTM);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_FCHLLEGADA_OTM);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_CIUDAD_OTM);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_FCHCONFIRMA_OTM);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_USUCONFIRMA_OTM);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_PROVISIONAL);

		$criteria->addSelectColumn(InoMaestraSeaPeer::CA_SITIODEVOLUCION);

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
		$criteria->setPrimaryTableName(InoMaestraSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoMaestraSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(InoMaestraSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return     InoMaestraSea
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = InoMaestraSeaPeer::doSelect($critcopy, $con);
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
		return InoMaestraSeaPeer::populateObjects(InoMaestraSeaPeer::doSelectStmt($criteria, $con));
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
			$con = Propel::getConnection(InoMaestraSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			InoMaestraSeaPeer::addSelectColumns($criteria);
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
	 * @param      InoMaestraSea $value A InoMaestraSea object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(InoMaestraSea $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaReferencia();
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
	 * @param      mixed $value A InoMaestraSea object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof InoMaestraSea) {
				$key = (string) $value->getCaReferencia();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or InoMaestraSea object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     InoMaestraSea Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
		if ($row[$startcol + 1] === null) {
			return null;
		}
		return (string) $row[$startcol + 1];
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
		$cls = InoMaestraSeaPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = InoMaestraSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = InoMaestraSeaPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				InoMaestraSeaPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
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
		$criteria->setPrimaryTableName(InoMaestraSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoMaestraSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoMaestraSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoMaestraSeaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);

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
	 * Selects a collection of InoMaestraSea objects pre-filled with their Transportador objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of InoMaestraSea objects.
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

		InoMaestraSeaPeer::addSelectColumns($c);
		$startcol = (InoMaestraSeaPeer::NUM_COLUMNS - InoMaestraSeaPeer::NUM_LAZY_LOAD_COLUMNS);
		TransportadorPeer::addSelectColumns($c);

		$c->addJoin(array(InoMaestraSeaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoMaestraSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoMaestraSeaPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = InoMaestraSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoMaestraSeaPeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (InoMaestraSea) to $obj2 (Transportador)
				$obj2->addInoMaestraSea($obj1);

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
		$criteria->setPrimaryTableName(InoMaestraSeaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			InoMaestraSeaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(InoMaestraSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(InoMaestraSeaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
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
	 * Selects a collection of InoMaestraSea objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of InoMaestraSea objects.
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

		InoMaestraSeaPeer::addSelectColumns($c);
		$startcol2 = (InoMaestraSeaPeer::NUM_COLUMNS - InoMaestraSeaPeer::NUM_LAZY_LOAD_COLUMNS);

		TransportadorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (TransportadorPeer::NUM_COLUMNS - TransportadorPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(InoMaestraSeaPeer::CA_IDLINEA,), array(TransportadorPeer::CA_IDLINEA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = InoMaestraSeaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = InoMaestraSeaPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = InoMaestraSeaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				InoMaestraSeaPeer::addInstanceToPool($obj1, $key1);
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
				} // if obj2 loaded

				// Add the $obj1 (InoMaestraSea) to the collection in $obj2 (Transportador)
				$obj2->addInoMaestraSea($obj1);
			} // if joined row not null

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
		return InoMaestraSeaPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a InoMaestraSea or Criteria object.
	 *
	 * @param      mixed $values Criteria or InoMaestraSea object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(InoMaestraSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from InoMaestraSea object
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
	 * Method perform an UPDATE on the database, given a InoMaestraSea or Criteria object.
	 *
	 * @param      mixed $values Criteria or InoMaestraSea object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(InoMaestraSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(InoMaestraSeaPeer::CA_REFERENCIA);
			$selectCriteria->add(InoMaestraSeaPeer::CA_REFERENCIA, $criteria->remove(InoMaestraSeaPeer::CA_REFERENCIA), $comparison);

		} else { // $values is InoMaestraSea object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_inomaestra_sea table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(InoMaestraSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(InoMaestraSeaPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a InoMaestraSea or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or InoMaestraSea object or primary key or array of primary keys
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
			$con = Propel::getConnection(InoMaestraSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			InoMaestraSeaPeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof InoMaestraSea) {
			// invalidate the cache for this single object
			InoMaestraSeaPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key



			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(InoMaestraSeaPeer::CA_REFERENCIA, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
				// we can invalidate the cache for this single object
				InoMaestraSeaPeer::removeInstanceFromPool($singleval);
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
	 * Validates all modified columns of given InoMaestraSea object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      InoMaestraSea $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(InoMaestraSea $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(InoMaestraSeaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(InoMaestraSeaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(InoMaestraSeaPeer::DATABASE_NAME, InoMaestraSeaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = InoMaestraSeaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      string $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     InoMaestraSea
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = InoMaestraSeaPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(InoMaestraSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(InoMaestraSeaPeer::DATABASE_NAME);
		$criteria->add(InoMaestraSeaPeer::CA_REFERENCIA, $pk);

		$v = InoMaestraSeaPeer::doSelect($criteria, $con);

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
			$con = Propel::getConnection(InoMaestraSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(InoMaestraSeaPeer::DATABASE_NAME);
			$criteria->add(InoMaestraSeaPeer::CA_REFERENCIA, $pks, Criteria::IN);
			$objs = InoMaestraSeaPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseInoMaestraSeaPeer

// This is the static code needed to register the MapBuilder for this table with the main Propel class.
//
// NOTE: This static code cannot call methods on the InoMaestraSeaPeer class, because it is not defined yet.
// If you need to use overridden methods, you can add this code to the bottom of the InoMaestraSeaPeer class:
//
// Propel::getDatabaseMap(InoMaestraSeaPeer::DATABASE_NAME)->addTableBuilder(InoMaestraSeaPeer::TABLE_NAME, InoMaestraSeaPeer::getMapBuilder());
//
// Doing so will effectively overwrite the registration below.

Propel::getDatabaseMap(BaseInoMaestraSeaPeer::DATABASE_NAME)->addTableBuilder(BaseInoMaestraSeaPeer::TABLE_NAME, BaseInoMaestraSeaPeer::getMapBuilder());

