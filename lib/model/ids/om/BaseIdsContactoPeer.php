<?php

/**
 * Base static class for performing query and update operations on the 'ids.tb_contactos' table.
 *
 * 
 *
 * @package    lib.model.ids.om
 */
abstract class BaseIdsContactoPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'ids.tb_contactos';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.ids.IdsContacto';

	/** The total number of columns. */
	const NUM_COLUMNS = 25;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** the column name for the CA_IDCONTACTO field */
	const CA_IDCONTACTO = 'ids.tb_contactos.CA_IDCONTACTO';

	/** the column name for the CA_IDSUCURSAL field */
	const CA_IDSUCURSAL = 'ids.tb_contactos.CA_IDSUCURSAL';

	/** the column name for the CA_NOMBRES field */
	const CA_NOMBRES = 'ids.tb_contactos.CA_NOMBRES';

	/** the column name for the CA_PAPELLIDO field */
	const CA_PAPELLIDO = 'ids.tb_contactos.CA_PAPELLIDO';

	/** the column name for the CA_SAPELLIDO field */
	const CA_SAPELLIDO = 'ids.tb_contactos.CA_SAPELLIDO';

	/** the column name for the CA_NOMBRES field */
	const CA_NOMBRES = 'ids.tb_contactos.CA_NOMBRES';

	/** the column name for the CA_SALUDO field */
	const CA_SALUDO = 'ids.tb_contactos.CA_SALUDO';

	/** the column name for the CA_DIRECCION field */
	const CA_DIRECCION = 'ids.tb_contactos.CA_DIRECCION';

	/** the column name for the CA_TELEFONOS field */
	const CA_TELEFONOS = 'ids.tb_contactos.CA_TELEFONOS';

	/** the column name for the CA_FAX field */
	const CA_FAX = 'ids.tb_contactos.CA_FAX';

	/** the column name for the CA_IDCIUDAD field */
	const CA_IDCIUDAD = 'ids.tb_contactos.CA_IDCIUDAD';

	/** the column name for the CA_EMAIL field */
	const CA_EMAIL = 'ids.tb_contactos.CA_EMAIL';

	/** the column name for the CA_IMPOEXPO field */
	const CA_IMPOEXPO = 'ids.tb_contactos.CA_IMPOEXPO';

	/** the column name for the CA_TRANSPORTE field */
	const CA_TRANSPORTE = 'ids.tb_contactos.CA_TRANSPORTE';

	/** the column name for the CA_CARGO field */
	const CA_CARGO = 'ids.tb_contactos.CA_CARGO';

	/** the column name for the CA_DEPARTAMENTO field */
	const CA_DEPARTAMENTO = 'ids.tb_contactos.CA_DEPARTAMENTO';

	/** the column name for the CA_OBSERVACIONES field */
	const CA_OBSERVACIONES = 'ids.tb_contactos.CA_OBSERVACIONES';

	/** the column name for the CA_SUGERIDO field */
	const CA_SUGERIDO = 'ids.tb_contactos.CA_SUGERIDO';

	/** the column name for the CA_ACTIVO field */
	const CA_ACTIVO = 'ids.tb_contactos.CA_ACTIVO';

	/** the column name for the CA_FCHCREADO field */
	const CA_FCHCREADO = 'ids.tb_contactos.CA_FCHCREADO';

	/** the column name for the CA_USUCREADO field */
	const CA_USUCREADO = 'ids.tb_contactos.CA_USUCREADO';

	/** the column name for the CA_FCHACTUALIZADO field */
	const CA_FCHACTUALIZADO = 'ids.tb_contactos.CA_FCHACTUALIZADO';

	/** the column name for the CA_USUACTUALIZADO field */
	const CA_USUACTUALIZADO = 'ids.tb_contactos.CA_USUACTUALIZADO';

	/** the column name for the CA_FCHELIMINADO field */
	const CA_FCHELIMINADO = 'ids.tb_contactos.CA_FCHELIMINADO';

	/** the column name for the CA_USUELIMINADO field */
	const CA_USUELIMINADO = 'ids.tb_contactos.CA_USUELIMINADO';

	/**
	 * An identiy map to hold any loaded instances of IdsContacto objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array IdsContacto[]
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
		BasePeer::TYPE_PHPNAME => array ('CaIdcontacto', 'CaIdsucursal', 'CaNombres', 'CaPapellido', 'CaSapellido', 'CaNombres', 'CaSaludo', 'CaDireccion', 'CaTelefonos', 'CaFax', 'CaIdciudad', 'CaEmail', 'CaImpoexpo', 'CaTransporte', 'CaCargo', 'CaDepartamento', 'CaObservaciones', 'CaSugerido', 'CaActivo', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', 'CaFcheliminado', 'CaUsueliminado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcontacto', 'caIdsucursal', 'caNombres', 'caPapellido', 'caSapellido', 'caNombres', 'caSaludo', 'caDireccion', 'caTelefonos', 'caFax', 'caIdciudad', 'caEmail', 'caImpoexpo', 'caTransporte', 'caCargo', 'caDepartamento', 'caObservaciones', 'caSugerido', 'caActivo', 'caFchcreado', 'caUsucreado', 'caFchactualizado', 'caUsuactualizado', 'caFcheliminado', 'caUsueliminado', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCONTACTO, self::CA_IDSUCURSAL, self::CA_NOMBRES, self::CA_PAPELLIDO, self::CA_SAPELLIDO, self::CA_NOMBRES, self::CA_SALUDO, self::CA_DIRECCION, self::CA_TELEFONOS, self::CA_FAX, self::CA_IDCIUDAD, self::CA_EMAIL, self::CA_IMPOEXPO, self::CA_TRANSPORTE, self::CA_CARGO, self::CA_DEPARTAMENTO, self::CA_OBSERVACIONES, self::CA_SUGERIDO, self::CA_ACTIVO, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_FCHACTUALIZADO, self::CA_USUACTUALIZADO, self::CA_FCHELIMINADO, self::CA_USUELIMINADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcontacto', 'ca_idsucursal', 'ca_nombres', 'ca_papellido', 'ca_sapellido', 'ca_nombres', 'ca_saludo', 'ca_direccion', 'ca_telefonos', 'ca_fax', 'ca_idciudad', 'ca_email', 'ca_impoexpo', 'ca_transporte', 'ca_cargo', 'ca_departamento', 'ca_observaciones', 'ca_sugerido', 'ca_activo', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', 'ca_fcheliminado', 'ca_usueliminado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcontacto' => 0, 'CaIdsucursal' => 1, 'CaNombres' => 2, 'CaPapellido' => 3, 'CaSapellido' => 4, 'CaNombres' => 5, 'CaSaludo' => 6, 'CaDireccion' => 7, 'CaTelefonos' => 8, 'CaFax' => 9, 'CaIdciudad' => 10, 'CaEmail' => 11, 'CaImpoexpo' => 12, 'CaTransporte' => 13, 'CaCargo' => 14, 'CaDepartamento' => 15, 'CaObservaciones' => 16, 'CaSugerido' => 17, 'CaActivo' => 18, 'CaFchcreado' => 19, 'CaUsucreado' => 20, 'CaFchactualizado' => 21, 'CaUsuactualizado' => 22, 'CaFcheliminado' => 23, 'CaUsueliminado' => 24, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcontacto' => 0, 'caIdsucursal' => 1, 'caNombres' => 2, 'caPapellido' => 3, 'caSapellido' => 4, 'caNombres' => 5, 'caSaludo' => 6, 'caDireccion' => 7, 'caTelefonos' => 8, 'caFax' => 9, 'caIdciudad' => 10, 'caEmail' => 11, 'caImpoexpo' => 12, 'caTransporte' => 13, 'caCargo' => 14, 'caDepartamento' => 15, 'caObservaciones' => 16, 'caSugerido' => 17, 'caActivo' => 18, 'caFchcreado' => 19, 'caUsucreado' => 20, 'caFchactualizado' => 21, 'caUsuactualizado' => 22, 'caFcheliminado' => 23, 'caUsueliminado' => 24, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCONTACTO => 0, self::CA_IDSUCURSAL => 1, self::CA_NOMBRES => 2, self::CA_PAPELLIDO => 3, self::CA_SAPELLIDO => 4, self::CA_NOMBRES => 5, self::CA_SALUDO => 6, self::CA_DIRECCION => 7, self::CA_TELEFONOS => 8, self::CA_FAX => 9, self::CA_IDCIUDAD => 10, self::CA_EMAIL => 11, self::CA_IMPOEXPO => 12, self::CA_TRANSPORTE => 13, self::CA_CARGO => 14, self::CA_DEPARTAMENTO => 15, self::CA_OBSERVACIONES => 16, self::CA_SUGERIDO => 17, self::CA_ACTIVO => 18, self::CA_FCHCREADO => 19, self::CA_USUCREADO => 20, self::CA_FCHACTUALIZADO => 21, self::CA_USUACTUALIZADO => 22, self::CA_FCHELIMINADO => 23, self::CA_USUELIMINADO => 24, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcontacto' => 0, 'ca_idsucursal' => 1, 'ca_nombres' => 2, 'ca_papellido' => 3, 'ca_sapellido' => 4, 'ca_nombres' => 5, 'ca_saludo' => 6, 'ca_direccion' => 7, 'ca_telefonos' => 8, 'ca_fax' => 9, 'ca_idciudad' => 10, 'ca_email' => 11, 'ca_impoexpo' => 12, 'ca_transporte' => 13, 'ca_cargo' => 14, 'ca_departamento' => 15, 'ca_observaciones' => 16, 'ca_sugerido' => 17, 'ca_activo' => 18, 'ca_fchcreado' => 19, 'ca_usucreado' => 20, 'ca_fchactualizado' => 21, 'ca_usuactualizado' => 22, 'ca_fcheliminado' => 23, 'ca_usueliminado' => 24, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, )
	);

	/**
	 * Get a (singleton) instance of the MapBuilder for this peer class.
	 * @return     MapBuilder The map builder for this peer
	 */
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new IdsContactoMapBuilder();
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
	 * @param      string $column The column name for current table. (i.e. IdsContactoPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(IdsContactoPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(IdsContactoPeer::CA_IDCONTACTO);

		$criteria->addSelectColumn(IdsContactoPeer::CA_IDSUCURSAL);

		$criteria->addSelectColumn(IdsContactoPeer::CA_NOMBRES);

		$criteria->addSelectColumn(IdsContactoPeer::CA_PAPELLIDO);

		$criteria->addSelectColumn(IdsContactoPeer::CA_SAPELLIDO);

		$criteria->addSelectColumn(IdsContactoPeer::CA_NOMBRES);

		$criteria->addSelectColumn(IdsContactoPeer::CA_SALUDO);

		$criteria->addSelectColumn(IdsContactoPeer::CA_DIRECCION);

		$criteria->addSelectColumn(IdsContactoPeer::CA_TELEFONOS);

		$criteria->addSelectColumn(IdsContactoPeer::CA_FAX);

		$criteria->addSelectColumn(IdsContactoPeer::CA_IDCIUDAD);

		$criteria->addSelectColumn(IdsContactoPeer::CA_EMAIL);

		$criteria->addSelectColumn(IdsContactoPeer::CA_IMPOEXPO);

		$criteria->addSelectColumn(IdsContactoPeer::CA_TRANSPORTE);

		$criteria->addSelectColumn(IdsContactoPeer::CA_CARGO);

		$criteria->addSelectColumn(IdsContactoPeer::CA_DEPARTAMENTO);

		$criteria->addSelectColumn(IdsContactoPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(IdsContactoPeer::CA_SUGERIDO);

		$criteria->addSelectColumn(IdsContactoPeer::CA_ACTIVO);

		$criteria->addSelectColumn(IdsContactoPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(IdsContactoPeer::CA_USUCREADO);

		$criteria->addSelectColumn(IdsContactoPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(IdsContactoPeer::CA_USUACTUALIZADO);

		$criteria->addSelectColumn(IdsContactoPeer::CA_FCHELIMINADO);

		$criteria->addSelectColumn(IdsContactoPeer::CA_USUELIMINADO);

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
		$criteria->setPrimaryTableName(IdsContactoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsContactoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(IdsContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return     IdsContacto
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = IdsContactoPeer::doSelect($critcopy, $con);
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
		return IdsContactoPeer::populateObjects(IdsContactoPeer::doSelectStmt($criteria, $con));
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
			$con = Propel::getConnection(IdsContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			IdsContactoPeer::addSelectColumns($criteria);
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
	 * @param      IdsContacto $value A IdsContacto object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool(IdsContacto $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdcontacto();
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
	 * @param      mixed $value A IdsContacto object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof IdsContacto) {
				$key = (string) $value->getCaIdcontacto();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or IdsContacto object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	 * @return     IdsContacto Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
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
		$cls = IdsContactoPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = IdsContactoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = IdsContactoPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				IdsContactoPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related Ciudad table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinCiudad(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(IdsContactoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsContactoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(IdsContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(IdsContactoPeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);

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
	 * Returns the number of rows matching criteria, joining the related IdsSucursal table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinIdsSucursal(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(IdsContactoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsContactoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(IdsContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(IdsContactoPeer::CA_IDSUCURSAL,), array(IdsSucursalPeer::CA_IDSUCURSAL,), $join_behavior);

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
	 * Selects a collection of IdsContacto objects pre-filled with their Ciudad objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of IdsContacto objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinCiudad(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		IdsContactoPeer::addSelectColumns($c);
		$startcol = (IdsContactoPeer::NUM_COLUMNS - IdsContactoPeer::NUM_LAZY_LOAD_COLUMNS);
		CiudadPeer::addSelectColumns($c);

		$c->addJoin(array(IdsContactoPeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = IdsContactoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = IdsContactoPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = IdsContactoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				IdsContactoPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = CiudadPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = CiudadPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = CiudadPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					CiudadPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (IdsContacto) to $obj2 (Ciudad)
				$obj2->addIdsContacto($obj1);

			} // if joined row was not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of IdsContacto objects pre-filled with their IdsSucursal objects.
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of IdsContacto objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinIdsSucursal(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		IdsContactoPeer::addSelectColumns($c);
		$startcol = (IdsContactoPeer::NUM_COLUMNS - IdsContactoPeer::NUM_LAZY_LOAD_COLUMNS);
		IdsSucursalPeer::addSelectColumns($c);

		$c->addJoin(array(IdsContactoPeer::CA_IDSUCURSAL,), array(IdsSucursalPeer::CA_IDSUCURSAL,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = IdsContactoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = IdsContactoPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {

				$omClass = IdsContactoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				IdsContactoPeer::addInstanceToPool($obj1, $key1);
			} // if $obj1 already loaded

			$key2 = IdsSucursalPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = IdsSucursalPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = IdsSucursalPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					IdsSucursalPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 already loaded

				// Add the $obj1 (IdsContacto) to $obj2 (IdsSucursal)
				$obj2->addIdsContacto($obj1);

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
		$criteria->setPrimaryTableName(IdsContactoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsContactoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(IdsContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(IdsContactoPeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);
		$criteria->addJoin(array(IdsContactoPeer::CA_IDSUCURSAL,), array(IdsSucursalPeer::CA_IDSUCURSAL,), $join_behavior);
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
	 * Selects a collection of IdsContacto objects pre-filled with all related objects.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of IdsContacto objects.
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

		IdsContactoPeer::addSelectColumns($c);
		$startcol2 = (IdsContactoPeer::NUM_COLUMNS - IdsContactoPeer::NUM_LAZY_LOAD_COLUMNS);

		CiudadPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CiudadPeer::NUM_COLUMNS - CiudadPeer::NUM_LAZY_LOAD_COLUMNS);

		IdsSucursalPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + (IdsSucursalPeer::NUM_COLUMNS - IdsSucursalPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(IdsContactoPeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);
		$c->addJoin(array(IdsContactoPeer::CA_IDSUCURSAL,), array(IdsSucursalPeer::CA_IDSUCURSAL,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = IdsContactoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = IdsContactoPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = IdsContactoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				IdsContactoPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

			// Add objects for joined Ciudad rows

			$key2 = CiudadPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = CiudadPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = CiudadPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					CiudadPeer::addInstanceToPool($obj2, $key2);
				} // if obj2 loaded

				// Add the $obj1 (IdsContacto) to the collection in $obj2 (Ciudad)
				$obj2->addIdsContacto($obj1);
			} // if joined row not null

			// Add objects for joined IdsSucursal rows

			$key3 = IdsSucursalPeer::getPrimaryKeyHashFromRow($row, $startcol3);
			if ($key3 !== null) {
				$obj3 = IdsSucursalPeer::getInstanceFromPool($key3);
				if (!$obj3) {

					$omClass = IdsSucursalPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj3 = new $cls();
					$obj3->hydrate($row, $startcol3);
					IdsSucursalPeer::addInstanceToPool($obj3, $key3);
				} // if obj3 loaded

				// Add the $obj1 (IdsContacto) to the collection in $obj3 (IdsSucursal)
				$obj3->addIdsContacto($obj1);
			} // if joined row not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Ciudad table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptCiudad(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsContactoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(IdsContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(IdsContactoPeer::CA_IDSUCURSAL,), array(IdsSucursalPeer::CA_IDSUCURSAL,), $join_behavior);
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
	 * Returns the number of rows matching criteria, joining the related IdsSucursal table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptIdsSucursal(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			IdsContactoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(IdsContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
	
				$criteria->addJoin(array(IdsContactoPeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);
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
	 * Selects a collection of IdsContacto objects pre-filled with all related objects except Ciudad.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of IdsContacto objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptCiudad(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		IdsContactoPeer::addSelectColumns($c);
		$startcol2 = (IdsContactoPeer::NUM_COLUMNS - IdsContactoPeer::NUM_LAZY_LOAD_COLUMNS);

		IdsSucursalPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (IdsSucursalPeer::NUM_COLUMNS - IdsSucursalPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(IdsContactoPeer::CA_IDSUCURSAL,), array(IdsSucursalPeer::CA_IDSUCURSAL,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = IdsContactoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = IdsContactoPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = IdsContactoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				IdsContactoPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined IdsSucursal rows

				$key2 = IdsSucursalPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = IdsSucursalPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = IdsSucursalPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					IdsSucursalPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (IdsContacto) to the collection in $obj2 (IdsSucursal)
				$obj2->addIdsContacto($obj1);

			} // if joined row is not null

			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	/**
	 * Selects a collection of IdsContacto objects pre-filled with all related objects except IdsSucursal.
	 *
	 * @param      Criteria  $c
	 * @param      PropelPDO $con
	 * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
	 * @return     array Array of IdsContacto objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptIdsSucursal(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		IdsContactoPeer::addSelectColumns($c);
		$startcol2 = (IdsContactoPeer::NUM_COLUMNS - IdsContactoPeer::NUM_LAZY_LOAD_COLUMNS);

		CiudadPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CiudadPeer::NUM_COLUMNS - CiudadPeer::NUM_LAZY_LOAD_COLUMNS);

				$c->addJoin(array(IdsContactoPeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);

		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = IdsContactoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = IdsContactoPeer::getInstanceFromPool($key1))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://propel.phpdb.org/trac/ticket/509
				// $obj1->hydrate($row, 0, true); // rehydrate
			} else {
				$omClass = IdsContactoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				IdsContactoPeer::addInstanceToPool($obj1, $key1);
			} // if obj1 already loaded

				// Add objects for joined Ciudad rows

				$key2 = CiudadPeer::getPrimaryKeyHashFromRow($row, $startcol2);
				if ($key2 !== null) {
					$obj2 = CiudadPeer::getInstanceFromPool($key2);
					if (!$obj2) {
	
						$omClass = CiudadPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					CiudadPeer::addInstanceToPool($obj2, $key2);
				} // if $obj2 already loaded

				// Add the $obj1 (IdsContacto) to the collection in $obj2 (Ciudad)
				$obj2->addIdsContacto($obj1);

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
		return IdsContactoPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a IdsContacto or Criteria object.
	 *
	 * @param      mixed $values Criteria or IdsContacto object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(IdsContactoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from IdsContacto object
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
	 * Method perform an UPDATE on the database, given a IdsContacto or Criteria object.
	 *
	 * @param      mixed $values Criteria or IdsContacto object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(IdsContactoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(IdsContactoPeer::CA_IDCONTACTO);
			$selectCriteria->add(IdsContactoPeer::CA_IDCONTACTO, $criteria->remove(IdsContactoPeer::CA_IDCONTACTO), $comparison);

		} else { // $values is IdsContacto object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the ids.tb_contactos table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(IdsContactoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(IdsContactoPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a IdsContacto or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or IdsContacto object or primary key or array of primary keys
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
			$con = Propel::getConnection(IdsContactoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// invalidate the cache for all objects of this type, since we have no
			// way of knowing (without running a query) what objects should be invalidated
			// from the cache based on this Criteria.
			IdsContactoPeer::clearInstancePool();

			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof IdsContacto) {
			// invalidate the cache for this single object
			IdsContactoPeer::removeInstanceFromPool($values);
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key



			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(IdsContactoPeer::CA_IDCONTACTO, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
				// we can invalidate the cache for this single object
				IdsContactoPeer::removeInstanceFromPool($singleval);
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
	 * Validates all modified columns of given IdsContacto object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      IdsContacto $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(IdsContacto $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(IdsContactoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(IdsContactoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(IdsContactoPeer::DATABASE_NAME, IdsContactoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = IdsContactoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     IdsContacto
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = IdsContactoPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(IdsContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(IdsContactoPeer::DATABASE_NAME);
		$criteria->add(IdsContactoPeer::CA_IDCONTACTO, $pk);

		$v = IdsContactoPeer::doSelect($criteria, $con);

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
			$con = Propel::getConnection(IdsContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(IdsContactoPeer::DATABASE_NAME);
			$criteria->add(IdsContactoPeer::CA_IDCONTACTO, $pks, Criteria::IN);
			$objs = IdsContactoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseIdsContactoPeer

// This is the static code needed to register the MapBuilder for this table with the main Propel class.
//
// NOTE: This static code cannot call methods on the IdsContactoPeer class, because it is not defined yet.
// If you need to use overridden methods, you can add this code to the bottom of the IdsContactoPeer class:
//
// Propel::getDatabaseMap(IdsContactoPeer::DATABASE_NAME)->addTableBuilder(IdsContactoPeer::TABLE_NAME, IdsContactoPeer::getMapBuilder());
//
// Doing so will effectively overwrite the registration below.

Propel::getDatabaseMap(BaseIdsContactoPeer::DATABASE_NAME)->addTableBuilder(BaseIdsContactoPeer::TABLE_NAME, BaseIdsContactoPeer::getMapBuilder());

