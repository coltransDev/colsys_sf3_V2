<?php

/**
 * Base static class for performing query and update operations on the 'tb_cotizaciones' table.
 *
 * 
 *
 * @package    lib.model.cotizaciones.om
 */
abstract class BaseCotizacionPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_cotizaciones';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.cotizaciones.Cotizacion';

	/** The total number of columns. */
	const NUM_COLUMNS = 22;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the CA_IDCOTIZACION field */
	const CA_IDCOTIZACION = 'tb_cotizaciones.CA_IDCOTIZACION';

	/** the column name for the CA_IDCONTACTO field */
	const CA_IDCONTACTO = 'tb_cotizaciones.CA_IDCONTACTO';

	/** the column name for the CA_CONSECUTIVO field */
	const CA_CONSECUTIVO = 'tb_cotizaciones.CA_CONSECUTIVO';

	/** the column name for the CA_ASUNTO field */
	const CA_ASUNTO = 'tb_cotizaciones.CA_ASUNTO';

	/** the column name for the CA_SALUDO field */
	const CA_SALUDO = 'tb_cotizaciones.CA_SALUDO';

	/** the column name for the CA_ENTRADA field */
	const CA_ENTRADA = 'tb_cotizaciones.CA_ENTRADA';

	/** the column name for the CA_DESPEDIDA field */
	const CA_DESPEDIDA = 'tb_cotizaciones.CA_DESPEDIDA';

	/** the column name for the CA_USUARIO field */
	const CA_USUARIO = 'tb_cotizaciones.CA_USUARIO';

	/** the column name for the CA_ANEXOS field */
	const CA_ANEXOS = 'tb_cotizaciones.CA_ANEXOS';

	/** the column name for the CA_FCHCREADO field */
	const CA_FCHCREADO = 'tb_cotizaciones.CA_FCHCREADO';

	/** the column name for the CA_USUCREADO field */
	const CA_USUCREADO = 'tb_cotizaciones.CA_USUCREADO';

	/** the column name for the CA_FCHACTUALIZADO field */
	const CA_FCHACTUALIZADO = 'tb_cotizaciones.CA_FCHACTUALIZADO';

	/** the column name for the CA_USUACTUALIZADO field */
	const CA_USUACTUALIZADO = 'tb_cotizaciones.CA_USUACTUALIZADO';

	/** the column name for the CA_FCHSOLICITUD field */
	const CA_FCHSOLICITUD = 'tb_cotizaciones.CA_FCHSOLICITUD';

	/** the column name for the CA_HORASOLICITUD field */
	const CA_HORASOLICITUD = 'tb_cotizaciones.CA_HORASOLICITUD';

	/** the column name for the CA_FCHPRESENTACION field */
	const CA_FCHPRESENTACION = 'tb_cotizaciones.CA_FCHPRESENTACION';

	/** the column name for the CA_FCHANULADO field */
	const CA_FCHANULADO = 'tb_cotizaciones.CA_FCHANULADO';

	/** the column name for the CA_USUANULADO field */
	const CA_USUANULADO = 'tb_cotizaciones.CA_USUANULADO';

	/** the column name for the CA_EMPRESA field */
	const CA_EMPRESA = 'tb_cotizaciones.CA_EMPRESA';

	/** the column name for the CA_DATOSAG field */
	const CA_DATOSAG = 'tb_cotizaciones.CA_DATOSAG';

	/** the column name for the CA_FUENTE field */
	const CA_FUENTE = 'tb_cotizaciones.CA_FUENTE';

	/** the column name for the CA_IDG_ENVIO_OPORTUNO field */
	const CA_IDG_ENVIO_OPORTUNO = 'tb_cotizaciones.CA_IDG_ENVIO_OPORTUNO';

	/**
	 * An identiy map to hold any loaded instances of Cotizacion objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array Cotizacion[]
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
		BasePeer::TYPE_PHPNAME => array ('CaIdcotizacion', 'CaIdcontacto', 'CaConsecutivo', 'CaAsunto', 'CaSaludo', 'CaEntrada', 'CaDespedida', 'CaUsuario', 'CaAnexos', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', 'CaFchsolicitud', 'CaHorasolicitud', 'CaFchpresentacion', 'CaFchanulado', 'CaUsuanulado', 'CaEmpresa', 'CaDatosag', 'CaFuente', 'CaIdgEnvioOportuno', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcotizacion', 'caIdcontacto', 'caConsecutivo', 'caAsunto', 'caSaludo', 'caEntrada', 'caDespedida', 'caUsuario', 'caAnexos', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', 'caFchsolicitud', 'caHorasolicitud', 'caFchpresentacion', 'caFchanulado', 'caUsuanulado', 'caEmpresa', 'caDatosag', 'caFuente', 'caIdgEnvioOportuno', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCOTIZACION, self::CA_IDCONTACTO, self::CA_CONSECUTIVO, self::CA_ASUNTO, self::CA_SALUDO, self::CA_ENTRADA, self::CA_DESPEDIDA, self::CA_USUARIO, self::CA_ANEXOS, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, self::CA_FCHSOLICITUD, self::CA_HORASOLICITUD, self::CA_FCHPRESENTACION, self::CA_FCHANULADO, self::CA_USUANULADO, self::CA_EMPRESA, self::CA_DATOSAG, self::CA_FUENTE, self::CA_IDG_ENVIO_OPORTUNO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcotizacion', 'ca_idcontacto', 'ca_consecutivo', 'ca_asunto', 'ca_saludo', 'ca_entrada', 'ca_despedida', 'ca_usuario', 'ca_anexos', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', 'ca_fchsolicitud', 'ca_horasolicitud', 'ca_fchpresentacion', 'ca_fchanulado', 'ca_usuanulado', 'ca_empresa', 'ca_datosag', 'ca_fuente', 'ca_idg_envio_oportuno', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcotizacion' => 0, 'CaIdcontacto' => 1, 'CaConsecutivo' => 2, 'CaAsunto' => 3, 'CaSaludo' => 4, 'CaEntrada' => 5, 'CaDespedida' => 6, 'CaUsuario' => 7, 'CaAnexos' => 8, 'CaFchcreado' => 9, 'CaUsucreado' => 10, 'CaFchactualizado' => 11, 'CaUsuactualizado' => 12, 'CaFchsolicitud' => 13, 'CaHorasolicitud' => 14, 'CaFchpresentacion' => 15, 'CaFchanulado' => 16, 'CaUsuanulado' => 17, 'CaEmpresa' => 18, 'CaDatosag' => 19, 'CaFuente' => 20, 'CaIdgEnvioOportuno' => 21, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcotizacion' => 0, 'caIdcontacto' => 1, 'caConsecutivo' => 2, 'caAsunto' => 3, 'caSaludo' => 4, 'caEntrada' => 5, 'caDespedida' => 6, 'caUsuario' => 7, 'caAnexos' => 8, 'caFchcreado' => 9, 'caUsucreado' => 10, 'caFchactualizado' => 11, 'caUsuactualizado' => 12, 'caFchsolicitud' => 13, 'caHorasolicitud' => 14, 'caFchpresentacion' => 15, 'caFchanulado' => 16, 'caUsuanulado' => 17, 'caEmpresa' => 18, 'caDatosag' => 19, 'caFuente' => 20, 'caIdgEnvioOportuno' => 21, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCOTIZACION => 0, self::CA_IDCONTACTO => 1, self::CA_CONSECUTIVO => 2, self::CA_ASUNTO => 3, self::CA_SALUDO => 4, self::CA_ENTRADA => 5, self::CA_DESPEDIDA => 6, self::CA_USUARIO => 7, self::CA_ANEXOS => 8, self::CA_FCHCREADO => 9, self::CA_USUCREADO => 10, self::CA_FCHACTUALIZADO => 11, self::CA_USUACTUALIZADO => 12, self::CA_FCHSOLICITUD => 13, self::CA_HORASOLICITUD => 14, self::CA_FCHPRESENTACION => 15, self::CA_FCHANULADO => 16, self::CA_USUANULADO => 17, self::CA_EMPRESA => 18, self::CA_DATOSAG => 19, self::CA_FUENTE => 20, self::CA_IDG_ENVIO_OPORTUNO => 21, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcotizacion' => 0, 'ca_idcontacto' => 1, 'ca_consecutivo' => 2, 'ca_asunto' => 3, 'ca_saludo' => 4, 'ca_entrada' => 5, 'ca_despedida' => 6, 'ca_usuario' => 7, 'ca_anexos' => 8, 'ca_fchcreado' => 9, 'ca_usucreado' => 10, 'ca_fchactualizado' => 11, 'ca_usuactualizado' => 12, 'ca_fchsolicitud' => 13, 'ca_horasolicitud' => 14, 'ca_fchpresentacion' => 15, 'ca_fchanulado' => 16, 'ca_usuanulado' => 17, 'ca_empresa' => 18, 'ca_datosag' => 19, 'ca_fuente' => 20, 'ca_idg_envio_oportuno' => 21, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, )
	);

	/**
	 * Get a (singleton) instance of the MapBuilder for this peer class.
	 * @return     MapBuilder The map builder for this peer
	 */
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new CotizacionMapBuilder();
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
	 * @param      string $column The column name for current table. (i.e. CotizacionPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(CotizacionPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(CotizacionPeer::CA_IDCOTIZACION);

		$criteria->addSelectColumn(CotizacionPeer::CA_IDCONTACTO);

		$criteria->addSelectColumn(CotizacionPeer::CA_CONSECUTIVO);

		$criteria->addSelectColumn(CotizacionPeer::CA_ASUNTO);

		$criteria->addSelectColumn(CotizacionPeer::CA_SALUDO);

		$criteria->addSelectColumn(CotizacionPeer::CA_ENTRADA);

		$criteria->addSelectColumn(CotizacionPeer::CA_DESPEDIDA);

		$criteria->addSelectColumn(CotizacionPeer::CA_USUARIO);

		$criteria->addSelectColumn(CotizacionPeer::CA_ANEXOS);

		$criteria->addSelectColumn(CotizacionPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(CotizacionPeer::CA_USUCREADO);

		$criteria->addSelectColumn(CotizacionPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(CotizacionPeer::CA_USUACTUALIZADO);

		$criteria->addSelectColumn(CotizacionPeer::CA_FCHSOLICITUD);

		$criteria->addSelectColumn(CotizacionPeer::CA_HORASOLICITUD);

		$criteria->addSelectColumn(CotizacionPeer::CA_FCHPRESENTACION);

		$criteria->addSelectColumn(CotizacionPeer::CA_FCHANULADO);

		$criteria->addSelectColumn(CotizacionPeer::CA_USUANULADO);

		$criteria->addSelectColumn(CotizacionPeer::CA_EMPRESA);

		$criteria->addSelectColumn(CotizacionPeer::CA_DATOSAG);

		$criteria->addSelectColumn(CotizacionPeer::CA_FUENTE);

		$criteria->addSelectColumn(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO);

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
		$criteria->setPrimaryTableName(CotizacionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotizacionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return     Cotizacion
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = CotizacionPeer::doSelect($critcopy, $con);
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
		return CotizacionPeer::populateObjects(CotizacionPeer::doSelectStmt($criteria, $con));
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
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			CotizacionPeer::addSelectColumns($criteria);
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
	 * @param      Cotizacion $value A Cotizacion object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(Cotizacion $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdcotizacion();
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
	 * @param      mixed $value A Cotizacion object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Cotizacion) {
				$key = (string) $value->getCaIdcotizacion();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Cotizacion object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     Cotizacion Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
		$cls = CotizacionPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = CotizacionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = CotizacionPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				CotizacionPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related Contacto table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinContacto(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(CotizacionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotizacionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotizacionPeer::CA_IDCONTACTO,), array(ContactoPeer::CA_IDCONTACTO,), $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related NotTarea table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinNotTarea(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(CotizacionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotizacionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

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
		$criteria->setPrimaryTableName(CotizacionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotizacionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotizacionPeer::CA_USUARIO,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);

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
	 * Selects a collection of Cotizacion objects pre-filled with their Contacto objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Cotizacion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinContacto(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotizacionPeer::addSelectColumns($c);
		$startcol = (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS);
		ContactoPeer::addSelectColumns($c);

		$c->addJoin(array(CotizacionPeer::CA_IDCONTACTO,), array(ContactoPeer::CA_IDCONTACTO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotizacionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotizacionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = CotizacionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotizacionPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = ContactoPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = ContactoPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ContactoPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					ContactoPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (Cotizacion) to $obj2 (Contacto)
				$obj2->addCotizacion($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Cotizacion objects pre-filled with their NotTarea objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Cotizacion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinNotTarea(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotizacionPeer::addSelectColumns($c);
		$startcol = (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS);
		NotTareaPeer::addSelectColumns($c);

		$c->addJoin(array(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotizacionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotizacionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = CotizacionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotizacionPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = NotTareaPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = NotTareaPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = NotTareaPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					NotTareaPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (Cotizacion) to $obj2 (NotTarea)
				$obj2->addCotizacion($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Cotizacion objects pre-filled with their Usuario objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Cotizacion objects.
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

		CotizacionPeer::addSelectColumns($c);
		$startcol = (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS);
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(array(CotizacionPeer::CA_USUARIO,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotizacionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotizacionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = CotizacionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotizacionPeer::addInstanceToPool($obj1, $key1);
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

				// Add the $obj1 (Cotizacion) to $obj2 (Usuario)
				$obj2->addCotizacion($obj1);

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
		$criteria->setPrimaryTableName(CotizacionPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotizacionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(CotizacionPeer::CA_IDCONTACTO,), array(ContactoPeer::CA_IDCONTACTO,), $join_behavior);
		$criteria->addJoin(array(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);
		$criteria->addJoin(array(CotizacionPeer::CA_USUARIO,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
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
	 * Selects a collection of Cotizacion objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Cotizacion objects.
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

		CotizacionPeer::addSelectColumns($c);
		$startcol2 = (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS);

		ContactoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ContactoPeer::NUM_COLUMNS - ContactoPeer::NUM_LAZY_LOAD_COLUMNS);

		NotTareaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (NotTareaPeer::NUM_COLUMNS - NotTareaPeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(CotizacionPeer::CA_IDCONTACTO,), array(ContactoPeer::CA_IDCONTACTO,), $join_behavior);
		$c->addJoin(array(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);
		$c->addJoin(array(CotizacionPeer::CA_USUARIO,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotizacionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotizacionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = CotizacionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotizacionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined Contacto rows

			$key2 = ContactoPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = ContactoPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ContactoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ContactoPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (Cotizacion) to the collection in $obj2 (Contacto)
				$obj2->addCotizacion($obj1);
			} // if joined row not null

			// Add objects for joined NotTarea rows

			$key3 = NotTareaPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = NotTareaPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = NotTareaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					NotTareaPeer::addInstanceToPool($obj3, $key3);
				} // if obj3 loaded

				// Add the $obj1 (Cotizacion) to the collection in $obj3 (NotTarea)
				$obj3->addCotizacion($obj1);
			} // if joined row not null

			// Add objects for joined Usuario rows

			$key4 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol4);
			if ($key4 !== null) {
				$obj4 = UsuarioPeer::getInstanceFromPool($key4);
				if (!$obj4) {

					$omClass = UsuarioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj4 = new $cls();
					$obj4->hydrate($row, $startcol4);
					UsuarioPeer::addInstanceToPool($obj4, $key4);
				} // if obj4 loaded

				// Add the $obj1 (Cotizacion) to the collection in $obj4 (Usuario)
				$obj4->addCotizacion($obj1);
			} // if joined row not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Contacto table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptContacto(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotizacionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);
				$criteria->addJoin(array(CotizacionPeer::CA_USUARIO,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
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
	 * Returns the number of rows matching criteria, joining the related NotTarea table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptNotTarea(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			CotizacionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(CotizacionPeer::CA_IDCONTACTO,), array(ContactoPeer::CA_IDCONTACTO,), $join_behavior);
				$criteria->addJoin(array(CotizacionPeer::CA_USUARIO,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);
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
			CotizacionPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(CotizacionPeer::CA_IDCONTACTO,), array(ContactoPeer::CA_IDCONTACTO,), $join_behavior);
				$criteria->addJoin(array(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);
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
	 * Selects a collection of Cotizacion objects pre-filled with all related objects except Contacto.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Cotizacion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptContacto(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotizacionPeer::addSelectColumns($c);
		$startcol2 = (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS);

		NotTareaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (NotTareaPeer::NUM_COLUMNS - NotTareaPeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);
				$c->addJoin(array(CotizacionPeer::CA_USUARIO,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotizacionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotizacionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = CotizacionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotizacionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined NotTarea rows

				$key2 = NotTareaPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = NotTareaPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = NotTareaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					NotTareaPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (Cotizacion) to the collection in $obj2 (NotTarea)
				$obj2->addCotizacion($obj1);

			} // if joined row is not null

				// Add objects for joined Usuario rows

				$key3 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = UsuarioPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = UsuarioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					UsuarioPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (Cotizacion) to the collection in $obj3 (Usuario)
				$obj3->addCotizacion($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Cotizacion objects pre-filled with all related objects except NotTarea.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Cotizacion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptNotTarea(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotizacionPeer::addSelectColumns($c);
		$startcol2 = (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS);

		ContactoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ContactoPeer::NUM_COLUMNS - ContactoPeer::NUM_LAZY_LOAD_COLUMNS);

		UsuarioPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(CotizacionPeer::CA_IDCONTACTO,), array(ContactoPeer::CA_IDCONTACTO,), $join_behavior);
				$c->addJoin(array(CotizacionPeer::CA_USUARIO,), array(UsuarioPeer::CA_LOGIN,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotizacionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotizacionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = CotizacionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotizacionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Contacto rows

				$key2 = ContactoPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = ContactoPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = ContactoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ContactoPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (Cotizacion) to the collection in $obj2 (Contacto)
				$obj2->addCotizacion($obj1);

			} // if joined row is not null

				// Add objects for joined Usuario rows

				$key3 = UsuarioPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = UsuarioPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = UsuarioPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					UsuarioPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (Cotizacion) to the collection in $obj3 (Usuario)
				$obj3->addCotizacion($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of Cotizacion objects pre-filled with all related objects except Usuario.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of Cotizacion objects.
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

		CotizacionPeer::addSelectColumns($c);
		$startcol2 = (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS);

		ContactoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ContactoPeer::NUM_COLUMNS - ContactoPeer::NUM_LAZY_LOAD_COLUMNS);

		NotTareaPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (NotTareaPeer::NUM_COLUMNS - NotTareaPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(CotizacionPeer::CA_IDCONTACTO,), array(ContactoPeer::CA_IDCONTACTO,), $join_behavior);
				$c->addJoin(array(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO,), array(NotTareaPeer::CA_IDTAREA,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = CotizacionPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = CotizacionPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = CotizacionPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				CotizacionPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Contacto rows

				$key2 = ContactoPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = ContactoPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = ContactoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ContactoPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (Cotizacion) to the collection in $obj2 (Contacto)
				$obj2->addCotizacion($obj1);

			} // if joined row is not null

				// Add objects for joined NotTarea rows

				$key3 = NotTareaPeer::getPrimaryKeyHashFromRow($row, $startcol3);
				if ($key3 !== null) {
					$obj3 = NotTareaPeer::getInstanceFromPool($key3);
					if (!$obj3) {
	
						$omClass = NotTareaPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					NotTareaPeer::addInstanceToPool($obj3, $key3);
				} // if $obj3 already loaded

				// Add the $obj1 (Cotizacion) to the collection in $obj3 (NotTarea)
				$obj3->addCotizacion($obj1);

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
		return CotizacionPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a Cotizacion or Criteria object.
	 *
	 * @param      mixed $values Criteria or Cotizacion object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from Cotizacion object
		}

		if ($criteria->containsKey(CotizacionPeer::CA_IDCOTIZACION) && $criteria->keyContainsValue(CotizacionPeer::CA_IDCOTIZACION) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.CotizacionPeer::CA_IDCOTIZACION.')');
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
	 * Method perform an UPDATE on the database, given a Cotizacion or Criteria object.
	 *
	 * @param      mixed $values Criteria or Cotizacion object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(CotizacionPeer::CA_IDCOTIZACION);
			$selectCriteria->add(CotizacionPeer::CA_IDCOTIZACION, $criteria->remove(CotizacionPeer::CA_IDCOTIZACION), $comparison);

		} else { // $values is Cotizacion object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_cotizaciones table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(CotizacionPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a Cotizacion or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or Cotizacion object or primary key or array of primary keys
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
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			CotizacionPeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof Cotizacion) {
			// invalidate the cache for this single object
			CotizacionPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key



			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(CotizacionPeer::CA_IDCOTIZACION, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
				// we can invalidate the cache for this single object
				CotizacionPeer::removeInstanceFromPool($singleval);
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
	 * Validates all modified columns of given Cotizacion object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      Cotizacion $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(Cotizacion $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(CotizacionPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(CotizacionPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(CotizacionPeer::DATABASE_NAME, CotizacionPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = CotizacionPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     Cotizacion
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = CotizacionPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		$criteria->add(CotizacionPeer::CA_IDCOTIZACION, $pk);

		$v = CotizacionPeer::doSelect($criteria, $con);

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
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
			$criteria->add(CotizacionPeer::CA_IDCOTIZACION, $pks, Criteria::IN);
			$objs = CotizacionPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseCotizacionPeer

// This is the static code needed to register the MapBuilder for this table with the main Propel class.
//
// NOTE: This static code cannot call methods on the CotizacionPeer class, because it is not defined yet.
// If you need to use overridden methods, you can add this code to the bottom of the CotizacionPeer class:
//
// Propel::getDatabaseMap(CotizacionPeer::DATABASE_NAME)->addTableBuilder(CotizacionPeer::TABLE_NAME, CotizacionPeer::getMapBuilder());
//
// Doing so will effectively overwrite the registration below.

Propel::getDatabaseMap(BaseCotizacionPeer::DATABASE_NAME)->addTableBuilder(BaseCotizacionPeer::TABLE_NAME, BaseCotizacionPeer::getMapBuilder());

