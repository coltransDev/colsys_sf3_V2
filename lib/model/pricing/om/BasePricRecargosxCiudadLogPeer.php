<?php

/**
 * Base static class for performing query and update operations on the 'bs_pricrecargosxciudad' table.
 *
 * 
 *
 * @package    lib.model.pricing.om
 */
abstract class BasePricRecargosxCiudadLogPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'bs_pricrecargosxciudad';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.pricing.PricRecargosxCiudadLog';

	/** The total number of columns. */
	const NUM_COLUMNS = 16;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the CA_IDTRAFICO field */
	const CA_IDTRAFICO = 'bs_pricrecargosxciudad.CA_IDTRAFICO';

	/** the column name for the CA_IDCIUDAD field */
	const CA_IDCIUDAD = 'bs_pricrecargosxciudad.CA_IDCIUDAD';

	/** the column name for the CA_IDRECARGO field */
	const CA_IDRECARGO = 'bs_pricrecargosxciudad.CA_IDRECARGO';

	/** the column name for the CA_MODALIDAD field */
	const CA_MODALIDAD = 'bs_pricrecargosxciudad.CA_MODALIDAD';

	/** the column name for the CA_IMPOEXPO field */
	const CA_IMPOEXPO = 'bs_pricrecargosxciudad.CA_IMPOEXPO';

	/** the column name for the CA_VLRRECARGO field */
	const CA_VLRRECARGO = 'bs_pricrecargosxciudad.CA_VLRRECARGO';

	/** the column name for the CA_APLICACION field */
	const CA_APLICACION = 'bs_pricrecargosxciudad.CA_APLICACION';

	/** the column name for the CA_VLRMINIMO field */
	const CA_VLRMINIMO = 'bs_pricrecargosxciudad.CA_VLRMINIMO';

	/** the column name for the CA_APLICACION_MIN field */
	const CA_APLICACION_MIN = 'bs_pricrecargosxciudad.CA_APLICACION_MIN';

	/** the column name for the CA_OBSERVACIONES field */
	const CA_OBSERVACIONES = 'bs_pricrecargosxciudad.CA_OBSERVACIONES';

	/** the column name for the CA_FCHINICIO field */
	const CA_FCHINICIO = 'bs_pricrecargosxciudad.CA_FCHINICIO';

	/** the column name for the CA_FCHVENCIMIENTO field */
	const CA_FCHVENCIMIENTO = 'bs_pricrecargosxciudad.CA_FCHVENCIMIENTO';

	/** the column name for the CA_FCHCREADO field */
	const CA_FCHCREADO = 'bs_pricrecargosxciudad.CA_FCHCREADO';

	/** the column name for the CA_USUCREADO field */
	const CA_USUCREADO = 'bs_pricrecargosxciudad.CA_USUCREADO';

	/** the column name for the CA_IDMONEDA field */
	const CA_IDMONEDA = 'bs_pricrecargosxciudad.CA_IDMONEDA';

	/** the column name for the CA_CONSECUTIVO field */
	const CA_CONSECUTIVO = 'bs_pricrecargosxciudad.CA_CONSECUTIVO';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdtrafico', 'CaIdciudad', 'CaIdrecargo', 'CaModalidad', 'CaImpoexpo', 'CaVlrrecargo', 'CaAplicacion', 'CaVlrminimo', 'CaAplicacionMin', 'CaObservaciones', 'CaFchinicio', 'CaFchvencimiento', 'CaFchcreado', 'CaUsucreado', 'CaIdmoneda', 'CaConsecutivo', ),
		BasePeer::TYPE_COLNAME => array (PricRecargosxCiudadLogPeer::CA_IDTRAFICO, PricRecargosxCiudadLogPeer::CA_IDCIUDAD, PricRecargosxCiudadLogPeer::CA_IDRECARGO, PricRecargosxCiudadLogPeer::CA_MODALIDAD, PricRecargosxCiudadLogPeer::CA_IMPOEXPO, PricRecargosxCiudadLogPeer::CA_VLRRECARGO, PricRecargosxCiudadLogPeer::CA_APLICACION, PricRecargosxCiudadLogPeer::CA_VLRMINIMO, PricRecargosxCiudadLogPeer::CA_APLICACION_MIN, PricRecargosxCiudadLogPeer::CA_OBSERVACIONES, PricRecargosxCiudadLogPeer::CA_FCHINICIO, PricRecargosxCiudadLogPeer::CA_FCHVENCIMIENTO, PricRecargosxCiudadLogPeer::CA_FCHCREADO, PricRecargosxCiudadLogPeer::CA_USUCREADO, PricRecargosxCiudadLogPeer::CA_IDMONEDA, PricRecargosxCiudadLogPeer::CA_CONSECUTIVO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtrafico', 'ca_idciudad', 'ca_idrecargo', 'ca_modalidad', 'ca_impoexpo', 'ca_vlrrecargo', 'ca_aplicacion', 'ca_vlrminimo', 'ca_aplicacion_min', 'ca_observaciones', 'ca_fchinicio', 'ca_fchvencimiento', 'ca_fchcreado', 'ca_usucreado', 'ca_idmoneda', 'ca_consecutivo', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdtrafico' => 0, 'CaIdciudad' => 1, 'CaIdrecargo' => 2, 'CaModalidad' => 3, 'CaImpoexpo' => 4, 'CaVlrrecargo' => 5, 'CaAplicacion' => 6, 'CaVlrminimo' => 7, 'CaAplicacionMin' => 8, 'CaObservaciones' => 9, 'CaFchinicio' => 10, 'CaFchvencimiento' => 11, 'CaFchcreado' => 12, 'CaUsucreado' => 13, 'CaIdmoneda' => 14, 'CaConsecutivo' => 15, ),
		BasePeer::TYPE_COLNAME => array (PricRecargosxCiudadLogPeer::CA_IDTRAFICO => 0, PricRecargosxCiudadLogPeer::CA_IDCIUDAD => 1, PricRecargosxCiudadLogPeer::CA_IDRECARGO => 2, PricRecargosxCiudadLogPeer::CA_MODALIDAD => 3, PricRecargosxCiudadLogPeer::CA_IMPOEXPO => 4, PricRecargosxCiudadLogPeer::CA_VLRRECARGO => 5, PricRecargosxCiudadLogPeer::CA_APLICACION => 6, PricRecargosxCiudadLogPeer::CA_VLRMINIMO => 7, PricRecargosxCiudadLogPeer::CA_APLICACION_MIN => 8, PricRecargosxCiudadLogPeer::CA_OBSERVACIONES => 9, PricRecargosxCiudadLogPeer::CA_FCHINICIO => 10, PricRecargosxCiudadLogPeer::CA_FCHVENCIMIENTO => 11, PricRecargosxCiudadLogPeer::CA_FCHCREADO => 12, PricRecargosxCiudadLogPeer::CA_USUCREADO => 13, PricRecargosxCiudadLogPeer::CA_IDMONEDA => 14, PricRecargosxCiudadLogPeer::CA_CONSECUTIVO => 15, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtrafico' => 0, 'ca_idciudad' => 1, 'ca_idrecargo' => 2, 'ca_modalidad' => 3, 'ca_impoexpo' => 4, 'ca_vlrrecargo' => 5, 'ca_aplicacion' => 6, 'ca_vlrminimo' => 7, 'ca_aplicacion_min' => 8, 'ca_observaciones' => 9, 'ca_fchinicio' => 10, 'ca_fchvencimiento' => 11, 'ca_fchcreado' => 12, 'ca_usucreado' => 13, 'ca_idmoneda' => 14, 'ca_consecutivo' => 15, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.pricing.map.PricRecargosxCiudadLogMapBuilder');
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
			$map = PricRecargosxCiudadLogPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. PricRecargosxCiudadLogPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(PricRecargosxCiudadLogPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_IDTRAFICO);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_IDCIUDAD);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_IDRECARGO);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_MODALIDAD);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_IMPOEXPO);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_VLRRECARGO);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_APLICACION);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_VLRMINIMO);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_APLICACION_MIN);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_FCHINICIO);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_FCHVENCIMIENTO);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_USUCREADO);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_IDMONEDA);

		$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::CA_CONSECUTIVO);

	}

	const COUNT = 'COUNT(bs_pricrecargosxciudad.CA_CONSECUTIVO)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT bs_pricrecargosxciudad.CA_CONSECUTIVO)';

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
			$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = PricRecargosxCiudadLogPeer::doSelectRS($criteria, $con);
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
	 * @return     PricRecargosxCiudadLog
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = PricRecargosxCiudadLogPeer::doSelect($critcopy, $con);
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
		return PricRecargosxCiudadLogPeer::populateObjects(PricRecargosxCiudadLogPeer::doSelectRS($criteria, $con));
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
			PricRecargosxCiudadLogPeer::addSelectColumns($criteria);
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
		$cls = PricRecargosxCiudadLogPeer::getOMClass();
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
	 * Returns the number of rows matching criteria, joining the related Ciudad table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinCiudad(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PricRecargosxCiudadLogPeer::CA_IDCIUDAD, CiudadPeer::CA_IDCIUDAD);

		$rs = PricRecargosxCiudadLogPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related TipoRecargo table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinTipoRecargo(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PricRecargosxCiudadLogPeer::CA_IDRECARGO, TipoRecargoPeer::CA_IDRECARGO);

		$rs = PricRecargosxCiudadLogPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of PricRecargosxCiudadLog objects pre-filled with their Ciudad objects.
	 *
	 * @return     array Array of PricRecargosxCiudadLog objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinCiudad(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricRecargosxCiudadLogPeer::addSelectColumns($c);
		$startcol = (PricRecargosxCiudadLogPeer::NUM_COLUMNS - PricRecargosxCiudadLogPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CiudadPeer::addSelectColumns($c);

		$c->addJoin(PricRecargosxCiudadLogPeer::CA_IDCIUDAD, CiudadPeer::CA_IDCIUDAD);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PricRecargosxCiudadLogPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CiudadPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getCiudad(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addPricRecargosxCiudadLog($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initPricRecargosxCiudadLogs();
				$obj2->addPricRecargosxCiudadLog($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of PricRecargosxCiudadLog objects pre-filled with their TipoRecargo objects.
	 *
	 * @return     array Array of PricRecargosxCiudadLog objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinTipoRecargo(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricRecargosxCiudadLogPeer::addSelectColumns($c);
		$startcol = (PricRecargosxCiudadLogPeer::NUM_COLUMNS - PricRecargosxCiudadLogPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TipoRecargoPeer::addSelectColumns($c);

		$c->addJoin(PricRecargosxCiudadLogPeer::CA_IDRECARGO, TipoRecargoPeer::CA_IDRECARGO);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PricRecargosxCiudadLogPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TipoRecargoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getTipoRecargo(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addPricRecargosxCiudadLog($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initPricRecargosxCiudadLogs();
				$obj2->addPricRecargosxCiudadLog($obj1); //CHECKME
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
			$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PricRecargosxCiudadLogPeer::CA_IDCIUDAD, CiudadPeer::CA_IDCIUDAD);

		$criteria->addJoin(PricRecargosxCiudadLogPeer::CA_IDRECARGO, TipoRecargoPeer::CA_IDRECARGO);

		$rs = PricRecargosxCiudadLogPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of PricRecargosxCiudadLog objects pre-filled with all related objects.
	 *
	 * @return     array Array of PricRecargosxCiudadLog objects.
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

		PricRecargosxCiudadLogPeer::addSelectColumns($c);
		$startcol2 = (PricRecargosxCiudadLogPeer::NUM_COLUMNS - PricRecargosxCiudadLogPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CiudadPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CiudadPeer::NUM_COLUMNS;

		TipoRecargoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TipoRecargoPeer::NUM_COLUMNS;

		$c->addJoin(PricRecargosxCiudadLogPeer::CA_IDCIUDAD, CiudadPeer::CA_IDCIUDAD);

		$c->addJoin(PricRecargosxCiudadLogPeer::CA_IDRECARGO, TipoRecargoPeer::CA_IDRECARGO);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PricRecargosxCiudadLogPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined Ciudad rows
	
			$omClass = CiudadPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getCiudad(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPricRecargosxCiudadLog($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initPricRecargosxCiudadLogs();
				$obj2->addPricRecargosxCiudadLog($obj1);
			}


				// Add objects for joined TipoRecargo rows
	
			$omClass = TipoRecargoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getTipoRecargo(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addPricRecargosxCiudadLog($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initPricRecargosxCiudadLogs();
				$obj3->addPricRecargosxCiudadLog($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Ciudad table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptCiudad(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PricRecargosxCiudadLogPeer::CA_IDRECARGO, TipoRecargoPeer::CA_IDRECARGO);

		$rs = PricRecargosxCiudadLogPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related TipoRecargo table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptTipoRecargo(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PricRecargosxCiudadLogPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PricRecargosxCiudadLogPeer::CA_IDCIUDAD, CiudadPeer::CA_IDCIUDAD);

		$rs = PricRecargosxCiudadLogPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of PricRecargosxCiudadLog objects pre-filled with all related objects except Ciudad.
	 *
	 * @return     array Array of PricRecargosxCiudadLog objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptCiudad(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricRecargosxCiudadLogPeer::addSelectColumns($c);
		$startcol2 = (PricRecargosxCiudadLogPeer::NUM_COLUMNS - PricRecargosxCiudadLogPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TipoRecargoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TipoRecargoPeer::NUM_COLUMNS;

		$c->addJoin(PricRecargosxCiudadLogPeer::CA_IDRECARGO, TipoRecargoPeer::CA_IDRECARGO);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PricRecargosxCiudadLogPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = TipoRecargoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getTipoRecargo(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPricRecargosxCiudadLog($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPricRecargosxCiudadLogs();
				$obj2->addPricRecargosxCiudadLog($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of PricRecargosxCiudadLog objects pre-filled with all related objects except TipoRecargo.
	 *
	 * @return     array Array of PricRecargosxCiudadLog objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptTipoRecargo(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricRecargosxCiudadLogPeer::addSelectColumns($c);
		$startcol2 = (PricRecargosxCiudadLogPeer::NUM_COLUMNS - PricRecargosxCiudadLogPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		CiudadPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + CiudadPeer::NUM_COLUMNS;

		$c->addJoin(PricRecargosxCiudadLogPeer::CA_IDCIUDAD, CiudadPeer::CA_IDCIUDAD);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PricRecargosxCiudadLogPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CiudadPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getCiudad(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPricRecargosxCiudadLog($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPricRecargosxCiudadLogs();
				$obj2->addPricRecargosxCiudadLog($obj1);
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
		return PricRecargosxCiudadLogPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a PricRecargosxCiudadLog or Criteria object.
	 *
	 * @param      mixed $values Criteria or PricRecargosxCiudadLog object containing data that is used to create the INSERT statement.
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
			$criteria = $values->buildCriteria(); // build Criteria from PricRecargosxCiudadLog object
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
	 * Method perform an UPDATE on the database, given a PricRecargosxCiudadLog or Criteria object.
	 *
	 * @param      mixed $values Criteria or PricRecargosxCiudadLog object containing data that is used to create the UPDATE statement.
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

			$comparison = $criteria->getComparison(PricRecargosxCiudadLogPeer::CA_CONSECUTIVO);
			$selectCriteria->add(PricRecargosxCiudadLogPeer::CA_CONSECUTIVO, $criteria->remove(PricRecargosxCiudadLogPeer::CA_CONSECUTIVO), $comparison);

		} else { // $values is PricRecargosxCiudadLog object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the bs_pricrecargosxciudad table.
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
			$affectedRows += BasePeer::doDeleteAll(PricRecargosxCiudadLogPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a PricRecargosxCiudadLog or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or PricRecargosxCiudadLog object or primary key or array of primary keys
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
			$con = Propel::getConnection(PricRecargosxCiudadLogPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof PricRecargosxCiudadLog) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PricRecargosxCiudadLogPeer::CA_CONSECUTIVO, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given PricRecargosxCiudadLog object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      PricRecargosxCiudadLog $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(PricRecargosxCiudadLog $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PricRecargosxCiudadLogPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PricRecargosxCiudadLogPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PricRecargosxCiudadLogPeer::DATABASE_NAME, PricRecargosxCiudadLogPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PricRecargosxCiudadLogPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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
	 * @return     PricRecargosxCiudadLog
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(PricRecargosxCiudadLogPeer::DATABASE_NAME);

		$criteria->add(PricRecargosxCiudadLogPeer::CA_CONSECUTIVO, $pk);


		$v = PricRecargosxCiudadLogPeer::doSelect($criteria, $con);

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
			$criteria->add(PricRecargosxCiudadLogPeer::CA_CONSECUTIVO, $pks, Criteria::IN);
			$objs = PricRecargosxCiudadLogPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BasePricRecargosxCiudadLogPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BasePricRecargosxCiudadLogPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	Propel::registerMapBuilder('lib.model.pricing.map.PricRecargosxCiudadLogMapBuilder');
}
