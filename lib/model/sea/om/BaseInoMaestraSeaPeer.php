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

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaFchreferencia', 'CaReferencia', 'CaImpoexpo', 'CaOrigen', 'CaDestino', 'CaFchembarque', 'CaFcharribo', 'CaModalidad', 'CaIdlinea', 'CaMotonave', 'CaCiclo', 'CaMbls', 'CaObservaciones', 'CaFchconfirmacion', 'CaHoraconfirmacion', 'CaRegistroadu', 'CaRegistrocap', 'CaBandera', 'CaFchliberacion', 'CaNroliberacion', 'CaAnulado', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', 'CaFchliquidado', 'CaUsuliquidado', 'CaFchcerrado', 'CaUsucerrado', 'CaMensaje', 'CaFchdesconsolidacion', 'CaMnllegada', 'CaFchregistroadu', 'CaFchconfirmado', 'CaUsuconfirmado', 'CaAsuntoOtm', 'CaMensajeOtm', 'CaFchllegadaOtm', 'CaCiudadOtm', 'CaFchconfirmaOtm', 'CaUsuconfirmaOtm', 'CaProvisional', 'CaSitiodevolucion', ),
		BasePeer::TYPE_COLNAME => array (InoMaestraSeaPeer::CA_FCHREFERENCIA, InoMaestraSeaPeer::CA_REFERENCIA, InoMaestraSeaPeer::CA_IMPOEXPO, InoMaestraSeaPeer::CA_ORIGEN, InoMaestraSeaPeer::CA_DESTINO, InoMaestraSeaPeer::CA_FCHEMBARQUE, InoMaestraSeaPeer::CA_FCHARRIBO, InoMaestraSeaPeer::CA_MODALIDAD, InoMaestraSeaPeer::CA_IDLINEA, InoMaestraSeaPeer::CA_MOTONAVE, InoMaestraSeaPeer::CA_CICLO, InoMaestraSeaPeer::CA_MBLS, InoMaestraSeaPeer::CA_OBSERVACIONES, InoMaestraSeaPeer::CA_FCHCONFIRMACION, InoMaestraSeaPeer::CA_HORACONFIRMACION, InoMaestraSeaPeer::CA_REGISTROADU, InoMaestraSeaPeer::CA_REGISTROCAP, InoMaestraSeaPeer::CA_BANDERA, InoMaestraSeaPeer::CA_FCHLIBERACION, InoMaestraSeaPeer::CA_NROLIBERACION, InoMaestraSeaPeer::CA_ANULADO, InoMaestraSeaPeer::CA_FCHCREADO, InoMaestraSeaPeer::CA_USUCREADO, InoMaestraSeaPeer::CA_FCHACTUALIZADO, InoMaestraSeaPeer::CA_USUACTUALIZADO, InoMaestraSeaPeer::CA_FCHLIQUIDADO, InoMaestraSeaPeer::CA_USULIQUIDADO, InoMaestraSeaPeer::CA_FCHCERRADO, InoMaestraSeaPeer::CA_USUCERRADO, InoMaestraSeaPeer::CA_MENSAJE, InoMaestraSeaPeer::CA_FCHDESCONSOLIDACION, InoMaestraSeaPeer::CA_MNLLEGADA, InoMaestraSeaPeer::CA_FCHREGISTROADU, InoMaestraSeaPeer::CA_FCHCONFIRMADO, InoMaestraSeaPeer::CA_USUCONFIRMADO, InoMaestraSeaPeer::CA_ASUNTO_OTM, InoMaestraSeaPeer::CA_MENSAJE_OTM, InoMaestraSeaPeer::CA_FCHLLEGADA_OTM, InoMaestraSeaPeer::CA_CIUDAD_OTM, InoMaestraSeaPeer::CA_FCHCONFIRMA_OTM, InoMaestraSeaPeer::CA_USUCONFIRMA_OTM, InoMaestraSeaPeer::CA_PROVISIONAL, InoMaestraSeaPeer::CA_SITIODEVOLUCION, ),
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
		BasePeer::TYPE_COLNAME => array (InoMaestraSeaPeer::CA_FCHREFERENCIA => 0, InoMaestraSeaPeer::CA_REFERENCIA => 1, InoMaestraSeaPeer::CA_IMPOEXPO => 2, InoMaestraSeaPeer::CA_ORIGEN => 3, InoMaestraSeaPeer::CA_DESTINO => 4, InoMaestraSeaPeer::CA_FCHEMBARQUE => 5, InoMaestraSeaPeer::CA_FCHARRIBO => 6, InoMaestraSeaPeer::CA_MODALIDAD => 7, InoMaestraSeaPeer::CA_IDLINEA => 8, InoMaestraSeaPeer::CA_MOTONAVE => 9, InoMaestraSeaPeer::CA_CICLO => 10, InoMaestraSeaPeer::CA_MBLS => 11, InoMaestraSeaPeer::CA_OBSERVACIONES => 12, InoMaestraSeaPeer::CA_FCHCONFIRMACION => 13, InoMaestraSeaPeer::CA_HORACONFIRMACION => 14, InoMaestraSeaPeer::CA_REGISTROADU => 15, InoMaestraSeaPeer::CA_REGISTROCAP => 16, InoMaestraSeaPeer::CA_BANDERA => 17, InoMaestraSeaPeer::CA_FCHLIBERACION => 18, InoMaestraSeaPeer::CA_NROLIBERACION => 19, InoMaestraSeaPeer::CA_ANULADO => 20, InoMaestraSeaPeer::CA_FCHCREADO => 21, InoMaestraSeaPeer::CA_USUCREADO => 22, InoMaestraSeaPeer::CA_FCHACTUALIZADO => 23, InoMaestraSeaPeer::CA_USUACTUALIZADO => 24, InoMaestraSeaPeer::CA_FCHLIQUIDADO => 25, InoMaestraSeaPeer::CA_USULIQUIDADO => 26, InoMaestraSeaPeer::CA_FCHCERRADO => 27, InoMaestraSeaPeer::CA_USUCERRADO => 28, InoMaestraSeaPeer::CA_MENSAJE => 29, InoMaestraSeaPeer::CA_FCHDESCONSOLIDACION => 30, InoMaestraSeaPeer::CA_MNLLEGADA => 31, InoMaestraSeaPeer::CA_FCHREGISTROADU => 32, InoMaestraSeaPeer::CA_FCHCONFIRMADO => 33, InoMaestraSeaPeer::CA_USUCONFIRMADO => 34, InoMaestraSeaPeer::CA_ASUNTO_OTM => 35, InoMaestraSeaPeer::CA_MENSAJE_OTM => 36, InoMaestraSeaPeer::CA_FCHLLEGADA_OTM => 37, InoMaestraSeaPeer::CA_CIUDAD_OTM => 38, InoMaestraSeaPeer::CA_FCHCONFIRMA_OTM => 39, InoMaestraSeaPeer::CA_USUCONFIRMA_OTM => 40, InoMaestraSeaPeer::CA_PROVISIONAL => 41, InoMaestraSeaPeer::CA_SITIODEVOLUCION => 42, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_fchreferencia' => 0, 'ca_referencia' => 1, 'ca_impoexpo' => 2, 'ca_origen' => 3, 'ca_destino' => 4, 'ca_fchembarque' => 5, 'ca_fcharribo' => 6, 'ca_modalidad' => 7, 'ca_idlinea' => 8, 'ca_motonave' => 9, 'ca_ciclo' => 10, 'ca_mbls' => 11, 'ca_observaciones' => 12, 'ca_fchconfirmacion' => 13, 'ca_horaconfirmacion' => 14, 'ca_registroadu' => 15, 'ca_registrocap' => 16, 'ca_bandera' => 17, 'ca_fchliberacion' => 18, 'ca_nroliberacion' => 19, 'ca_anulado' => 20, 'ca_fchcreado' => 21, 'ca_usucreado' => 22, 'ca_fchactualizado' => 23, 'ca_usuactualizado' => 24, 'ca_fchliquidado' => 25, 'ca_usuliquidado' => 26, 'ca_fchcerrado' => 27, 'ca_usucerrado' => 28, 'ca_mensaje' => 29, 'ca_fchdesconsolidacion' => 30, 'ca_mnllegada' => 31, 'ca_fchregistroadu' => 32, 'ca_fchconfirmado' => 33, 'ca_usuconfirmado' => 34, 'ca_asunto_otm' => 35, 'ca_mensaje_otm' => 36, 'ca_fchllegada_otm' => 37, 'ca_ciudad_otm' => 38, 'ca_fchconfirma_otm' => 39, 'ca_usuconfirma_otm' => 40, 'ca_provisional' => 41, 'ca_sitiodevolucion' => 42, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.sea.map.InoMaestraSeaMapBuilder');
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
			$map = InoMaestraSeaPeer::getTableMap();
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

	const COUNT = 'COUNT(tb_inomaestra_sea.CA_REFERENCIA)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT tb_inomaestra_sea.CA_REFERENCIA)';

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
			$criteria->addSelectColumn(InoMaestraSeaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InoMaestraSeaPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = InoMaestraSeaPeer::doSelectRS($criteria, $con);
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
	 * @return     InoMaestraSea
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
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
	 * @param      Connection $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return InoMaestraSeaPeer::populateObjects(InoMaestraSeaPeer::doSelectRS($criteria, $con));
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
			InoMaestraSeaPeer::addSelectColumns($criteria);
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
		$cls = InoMaestraSeaPeer::getOMClass();
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
			$criteria->addSelectColumn(InoMaestraSeaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InoMaestraSeaPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InoMaestraSeaPeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA);

		$rs = InoMaestraSeaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of InoMaestraSea objects pre-filled with their Transportador objects.
	 *
	 * @return     array Array of InoMaestraSea objects.
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

		InoMaestraSeaPeer::addSelectColumns($c);
		$startcol = (InoMaestraSeaPeer::NUM_COLUMNS - InoMaestraSeaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TransportadorPeer::addSelectColumns($c);

		$c->addJoin(InoMaestraSeaPeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InoMaestraSeaPeer::getOMClass();

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
					$temp_obj2->addInoMaestraSea($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initInoMaestraSeas();
				$obj2->addInoMaestraSea($obj1); //CHECKME
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
			$criteria->addSelectColumn(InoMaestraSeaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InoMaestraSeaPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InoMaestraSeaPeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA);

		$rs = InoMaestraSeaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of InoMaestraSea objects pre-filled with all related objects.
	 *
	 * @return     array Array of InoMaestraSea objects.
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

		InoMaestraSeaPeer::addSelectColumns($c);
		$startcol2 = (InoMaestraSeaPeer::NUM_COLUMNS - InoMaestraSeaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TransportadorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TransportadorPeer::NUM_COLUMNS;

		$c->addJoin(InoMaestraSeaPeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InoMaestraSeaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined Transportador rows
	
			$omClass = TransportadorPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getTransportador(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addInoMaestraSea($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initInoMaestraSeas();
				$obj2->addInoMaestraSea($obj1);
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
		return InoMaestraSeaPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a InoMaestraSea or Criteria object.
	 *
	 * @param      mixed $values Criteria or InoMaestraSea object containing data that is used to create the INSERT statement.
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
			$criteria = $values->buildCriteria(); // build Criteria from InoMaestraSea object
		}


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
	 * Method perform an UPDATE on the database, given a InoMaestraSea or Criteria object.
	 *
	 * @param      mixed $values Criteria or InoMaestraSea object containing data that is used to create the UPDATE statement.
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
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->begin();
			$affectedRows += BasePeer::doDeleteAll(InoMaestraSeaPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a InoMaestraSea or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or InoMaestraSea object or primary key or array of primary keys
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
			$con = Propel::getConnection(InoMaestraSeaPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof InoMaestraSea) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(InoMaestraSeaPeer::CA_REFERENCIA, (array) $values, Criteria::IN);
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

			foreach($cols as $colName) {
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
	 * @return     InoMaestraSea
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
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
			$criteria->add(InoMaestraSeaPeer::CA_REFERENCIA, $pks, Criteria::IN);
			$objs = InoMaestraSeaPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseInoMaestraSeaPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseInoMaestraSeaPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	Propel::registerMapBuilder('lib.model.sea.map.InoMaestraSeaMapBuilder');
}
