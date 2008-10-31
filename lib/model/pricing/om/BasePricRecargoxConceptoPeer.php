<?php

/**
 * Base static class for performing query and update operations on the 'tb_pricrecargosxconcepto' table.
 *
 * 
 *
 * @package    lib.model.pricing.om
 */
abstract class BasePricRecargoxConceptoPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_pricrecargosxconcepto';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.pricing.PricRecargoxConcepto';

	/** The total number of columns. */
	const NUM_COLUMNS = 13;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the CA_IDTRAYECTO field */
	const CA_IDTRAYECTO = 'tb_pricrecargosxconcepto.CA_IDTRAYECTO';

	/** the column name for the CA_IDCONCEPTO field */
	const CA_IDCONCEPTO = 'tb_pricrecargosxconcepto.CA_IDCONCEPTO';

	/** the column name for the CA_IDRECARGO field */
	const CA_IDRECARGO = 'tb_pricrecargosxconcepto.CA_IDRECARGO';

	/** the column name for the CA_VLRRECARGO field */
	const CA_VLRRECARGO = 'tb_pricrecargosxconcepto.CA_VLRRECARGO';

	/** the column name for the CA_APLICACION field */
	const CA_APLICACION = 'tb_pricrecargosxconcepto.CA_APLICACION';

	/** the column name for the CA_VLRMINIMO field */
	const CA_VLRMINIMO = 'tb_pricrecargosxconcepto.CA_VLRMINIMO';

	/** the column name for the CA_APLICACION_MIN field */
	const CA_APLICACION_MIN = 'tb_pricrecargosxconcepto.CA_APLICACION_MIN';

	/** the column name for the CA_OBSERVACIONES field */
	const CA_OBSERVACIONES = 'tb_pricrecargosxconcepto.CA_OBSERVACIONES';

	/** the column name for the CA_IDMONEDA field */
	const CA_IDMONEDA = 'tb_pricrecargosxconcepto.CA_IDMONEDA';

	/** the column name for the CA_FCHINICIO field */
	const CA_FCHINICIO = 'tb_pricrecargosxconcepto.CA_FCHINICIO';

	/** the column name for the CA_FCHVENCIMIENTO field */
	const CA_FCHVENCIMIENTO = 'tb_pricrecargosxconcepto.CA_FCHVENCIMIENTO';

	/** the column name for the CA_FCHCREADO field */
	const CA_FCHCREADO = 'tb_pricrecargosxconcepto.CA_FCHCREADO';

	/** the column name for the CA_USUCREADO field */
	const CA_USUCREADO = 'tb_pricrecargosxconcepto.CA_USUCREADO';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdtrayecto', 'CaIdconcepto', 'CaIdrecargo', 'CaVlrrecargo', 'CaAplicacion', 'CaVlrminimo', 'CaAplicacionMin', 'CaObservaciones', 'CaIdmoneda', 'CaFchinicio', 'CaFchvencimiento', 'CaFchcreado', 'CaUsucreado', ),
		BasePeer::TYPE_COLNAME => array (PricRecargoxConceptoPeer::CA_IDTRAYECTO, PricRecargoxConceptoPeer::CA_IDCONCEPTO, PricRecargoxConceptoPeer::CA_IDRECARGO, PricRecargoxConceptoPeer::CA_VLRRECARGO, PricRecargoxConceptoPeer::CA_APLICACION, PricRecargoxConceptoPeer::CA_VLRMINIMO, PricRecargoxConceptoPeer::CA_APLICACION_MIN, PricRecargoxConceptoPeer::CA_OBSERVACIONES, PricRecargoxConceptoPeer::CA_IDMONEDA, PricRecargoxConceptoPeer::CA_FCHINICIO, PricRecargoxConceptoPeer::CA_FCHVENCIMIENTO, PricRecargoxConceptoPeer::CA_FCHCREADO, PricRecargoxConceptoPeer::CA_USUCREADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtrayecto', 'ca_idconcepto', 'ca_idrecargo', 'ca_vlrrecargo', 'ca_aplicacion', 'ca_vlrminimo', 'ca_aplicacion_min', 'ca_observaciones', 'ca_idmoneda', 'ca_fchinicio', 'ca_fchvencimiento', 'ca_fchcreado', 'ca_usucreado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdtrayecto' => 0, 'CaIdconcepto' => 1, 'CaIdrecargo' => 2, 'CaVlrrecargo' => 3, 'CaAplicacion' => 4, 'CaVlrminimo' => 5, 'CaAplicacionMin' => 6, 'CaObservaciones' => 7, 'CaIdmoneda' => 8, 'CaFchinicio' => 9, 'CaFchvencimiento' => 10, 'CaFchcreado' => 11, 'CaUsucreado' => 12, ),
		BasePeer::TYPE_COLNAME => array (PricRecargoxConceptoPeer::CA_IDTRAYECTO => 0, PricRecargoxConceptoPeer::CA_IDCONCEPTO => 1, PricRecargoxConceptoPeer::CA_IDRECARGO => 2, PricRecargoxConceptoPeer::CA_VLRRECARGO => 3, PricRecargoxConceptoPeer::CA_APLICACION => 4, PricRecargoxConceptoPeer::CA_VLRMINIMO => 5, PricRecargoxConceptoPeer::CA_APLICACION_MIN => 6, PricRecargoxConceptoPeer::CA_OBSERVACIONES => 7, PricRecargoxConceptoPeer::CA_IDMONEDA => 8, PricRecargoxConceptoPeer::CA_FCHINICIO => 9, PricRecargoxConceptoPeer::CA_FCHVENCIMIENTO => 10, PricRecargoxConceptoPeer::CA_FCHCREADO => 11, PricRecargoxConceptoPeer::CA_USUCREADO => 12, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtrayecto' => 0, 'ca_idconcepto' => 1, 'ca_idrecargo' => 2, 'ca_vlrrecargo' => 3, 'ca_aplicacion' => 4, 'ca_vlrminimo' => 5, 'ca_aplicacion_min' => 6, 'ca_observaciones' => 7, 'ca_idmoneda' => 8, 'ca_fchinicio' => 9, 'ca_fchvencimiento' => 10, 'ca_fchcreado' => 11, 'ca_usucreado' => 12, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.pricing.map.PricRecargoxConceptoMapBuilder');
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
			$map = PricRecargoxConceptoPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. PricRecargoxConceptoPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(PricRecargoxConceptoPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(PricRecargoxConceptoPeer::CA_IDTRAYECTO);

		$criteria->addSelectColumn(PricRecargoxConceptoPeer::CA_IDCONCEPTO);

		$criteria->addSelectColumn(PricRecargoxConceptoPeer::CA_IDRECARGO);

		$criteria->addSelectColumn(PricRecargoxConceptoPeer::CA_VLRRECARGO);

		$criteria->addSelectColumn(PricRecargoxConceptoPeer::CA_APLICACION);

		$criteria->addSelectColumn(PricRecargoxConceptoPeer::CA_VLRMINIMO);

		$criteria->addSelectColumn(PricRecargoxConceptoPeer::CA_APLICACION_MIN);

		$criteria->addSelectColumn(PricRecargoxConceptoPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(PricRecargoxConceptoPeer::CA_IDMONEDA);

		$criteria->addSelectColumn(PricRecargoxConceptoPeer::CA_FCHINICIO);

		$criteria->addSelectColumn(PricRecargoxConceptoPeer::CA_FCHVENCIMIENTO);

		$criteria->addSelectColumn(PricRecargoxConceptoPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(PricRecargoxConceptoPeer::CA_USUCREADO);

	}

	const COUNT = 'COUNT(tb_pricrecargosxconcepto.CA_IDTRAYECTO)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT tb_pricrecargosxconcepto.CA_IDTRAYECTO)';

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
			$criteria->addSelectColumn(PricRecargoxConceptoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PricRecargoxConceptoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = PricRecargoxConceptoPeer::doSelectRS($criteria, $con);
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
	 * @return     PricRecargoxConcepto
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = PricRecargoxConceptoPeer::doSelect($critcopy, $con);
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
		return PricRecargoxConceptoPeer::populateObjects(PricRecargoxConceptoPeer::doSelectRS($criteria, $con));
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
			PricRecargoxConceptoPeer::addSelectColumns($criteria);
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
		$cls = PricRecargoxConceptoPeer::getOMClass();
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
	 * Returns the number of rows matching criteria, joining the related PricFlete table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinPricFlete(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PricRecargoxConceptoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PricRecargoxConceptoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PricRecargoxConceptoPeer::CA_IDTRAYECTO, PricFletePeer::CA_IDTRAYECTO);

		$criteria->addJoin(PricRecargoxConceptoPeer::CA_IDCONCEPTO, PricFletePeer::CA_IDCONCEPTO);

		$rs = PricRecargoxConceptoPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(PricRecargoxConceptoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PricRecargoxConceptoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PricRecargoxConceptoPeer::CA_IDRECARGO, TipoRecargoPeer::CA_IDRECARGO);

		$rs = PricRecargoxConceptoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of PricRecargoxConcepto objects pre-filled with their PricFlete objects.
	 *
	 * @return     array Array of PricRecargoxConcepto objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinPricFlete(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricRecargoxConceptoPeer::addSelectColumns($c);
		$startcol = (PricRecargoxConceptoPeer::NUM_COLUMNS - PricRecargoxConceptoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PricFletePeer::addSelectColumns($c);

		$c->addJoin(PricRecargoxConceptoPeer::CA_IDTRAYECTO, PricFletePeer::CA_IDTRAYECTO);
		$c->addJoin(PricRecargoxConceptoPeer::CA_IDCONCEPTO, PricFletePeer::CA_IDCONCEPTO);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PricRecargoxConceptoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PricFletePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getPricFlete(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addPricRecargoxConcepto($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initPricRecargoxConceptos();
				$obj2->addPricRecargoxConcepto($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of PricRecargoxConcepto objects pre-filled with their TipoRecargo objects.
	 *
	 * @return     array Array of PricRecargoxConcepto objects.
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

		PricRecargoxConceptoPeer::addSelectColumns($c);
		$startcol = (PricRecargoxConceptoPeer::NUM_COLUMNS - PricRecargoxConceptoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TipoRecargoPeer::addSelectColumns($c);

		$c->addJoin(PricRecargoxConceptoPeer::CA_IDRECARGO, TipoRecargoPeer::CA_IDRECARGO);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PricRecargoxConceptoPeer::getOMClass();

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
					$temp_obj2->addPricRecargoxConcepto($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initPricRecargoxConceptos();
				$obj2->addPricRecargoxConcepto($obj1); //CHECKME
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
			$criteria->addSelectColumn(PricRecargoxConceptoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PricRecargoxConceptoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PricRecargoxConceptoPeer::CA_IDTRAYECTO, PricFletePeer::CA_IDTRAYECTO);

		$criteria->addJoin(PricRecargoxConceptoPeer::CA_IDCONCEPTO, PricFletePeer::CA_IDCONCEPTO);

		$criteria->addJoin(PricRecargoxConceptoPeer::CA_IDRECARGO, TipoRecargoPeer::CA_IDRECARGO);

		$rs = PricRecargoxConceptoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of PricRecargoxConcepto objects pre-filled with all related objects.
	 *
	 * @return     array Array of PricRecargoxConcepto objects.
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

		PricRecargoxConceptoPeer::addSelectColumns($c);
		$startcol2 = (PricRecargoxConceptoPeer::NUM_COLUMNS - PricRecargoxConceptoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PricFletePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PricFletePeer::NUM_COLUMNS;

		TipoRecargoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + TipoRecargoPeer::NUM_COLUMNS;

		$c->addJoin(PricRecargoxConceptoPeer::CA_IDTRAYECTO, PricFletePeer::CA_IDTRAYECTO);

		$c->addJoin(PricRecargoxConceptoPeer::CA_IDCONCEPTO, PricFletePeer::CA_IDCONCEPTO);

		$c->addJoin(PricRecargoxConceptoPeer::CA_IDRECARGO, TipoRecargoPeer::CA_IDRECARGO);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PricRecargoxConceptoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined PricFlete rows
	
			$omClass = PricFletePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPricFlete(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPricRecargoxConcepto($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initPricRecargoxConceptos();
				$obj2->addPricRecargoxConcepto($obj1);
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
					$temp_obj3->addPricRecargoxConcepto($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initPricRecargoxConceptos();
				$obj3->addPricRecargoxConcepto($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related PricFlete table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptPricFlete(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PricRecargoxConceptoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PricRecargoxConceptoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PricRecargoxConceptoPeer::CA_IDRECARGO, TipoRecargoPeer::CA_IDRECARGO);

		$rs = PricRecargoxConceptoPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(PricRecargoxConceptoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PricRecargoxConceptoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PricRecargoxConceptoPeer::CA_IDTRAYECTO, PricFletePeer::CA_IDTRAYECTO);

		$criteria->addJoin(PricRecargoxConceptoPeer::CA_IDCONCEPTO, PricFletePeer::CA_IDCONCEPTO);

		$rs = PricRecargoxConceptoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of PricRecargoxConcepto objects pre-filled with all related objects except PricFlete.
	 *
	 * @return     array Array of PricRecargoxConcepto objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptPricFlete(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PricRecargoxConceptoPeer::addSelectColumns($c);
		$startcol2 = (PricRecargoxConceptoPeer::NUM_COLUMNS - PricRecargoxConceptoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TipoRecargoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TipoRecargoPeer::NUM_COLUMNS;

		$c->addJoin(PricRecargoxConceptoPeer::CA_IDRECARGO, TipoRecargoPeer::CA_IDRECARGO);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PricRecargoxConceptoPeer::getOMClass();

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
					$temp_obj2->addPricRecargoxConcepto($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPricRecargoxConceptos();
				$obj2->addPricRecargoxConcepto($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of PricRecargoxConcepto objects pre-filled with all related objects except TipoRecargo.
	 *
	 * @return     array Array of PricRecargoxConcepto objects.
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

		PricRecargoxConceptoPeer::addSelectColumns($c);
		$startcol2 = (PricRecargoxConceptoPeer::NUM_COLUMNS - PricRecargoxConceptoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PricFletePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PricFletePeer::NUM_COLUMNS;

		$c->addJoin(PricRecargoxConceptoPeer::CA_IDTRAYECTO, PricFletePeer::CA_IDTRAYECTO);

		$c->addJoin(PricRecargoxConceptoPeer::CA_IDCONCEPTO, PricFletePeer::CA_IDCONCEPTO);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PricRecargoxConceptoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PricFletePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPricFlete(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPricRecargoxConcepto($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPricRecargoxConceptos();
				$obj2->addPricRecargoxConcepto($obj1);
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
		return PricRecargoxConceptoPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a PricRecargoxConcepto or Criteria object.
	 *
	 * @param      mixed $values Criteria or PricRecargoxConcepto object containing data that is used to create the INSERT statement.
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
			$criteria = $values->buildCriteria(); // build Criteria from PricRecargoxConcepto object
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
	 * Method perform an UPDATE on the database, given a PricRecargoxConcepto or Criteria object.
	 *
	 * @param      mixed $values Criteria or PricRecargoxConcepto object containing data that is used to create the UPDATE statement.
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

			$comparison = $criteria->getComparison(PricRecargoxConceptoPeer::CA_IDTRAYECTO);
			$selectCriteria->add(PricRecargoxConceptoPeer::CA_IDTRAYECTO, $criteria->remove(PricRecargoxConceptoPeer::CA_IDTRAYECTO), $comparison);

			$comparison = $criteria->getComparison(PricRecargoxConceptoPeer::CA_IDCONCEPTO);
			$selectCriteria->add(PricRecargoxConceptoPeer::CA_IDCONCEPTO, $criteria->remove(PricRecargoxConceptoPeer::CA_IDCONCEPTO), $comparison);

			$comparison = $criteria->getComparison(PricRecargoxConceptoPeer::CA_IDRECARGO);
			$selectCriteria->add(PricRecargoxConceptoPeer::CA_IDRECARGO, $criteria->remove(PricRecargoxConceptoPeer::CA_IDRECARGO), $comparison);

		} else { // $values is PricRecargoxConcepto object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_pricrecargosxconcepto table.
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
			$affectedRows += BasePeer::doDeleteAll(PricRecargoxConceptoPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a PricRecargoxConcepto or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or PricRecargoxConcepto object or primary key or array of primary keys
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
			$con = Propel::getConnection(PricRecargoxConceptoPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof PricRecargoxConcepto) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			// primary key is composite; we therefore, expect
			// the primary key passed to be an array of pkey
			// values
			if(count($values) == count($values, COUNT_RECURSIVE))
			{
				// array is not multi-dimensional
				$values = array($values);
			}
			$vals = array();
			foreach($values as $value)
			{

				$vals[0][] = $value[0];
				$vals[1][] = $value[1];
				$vals[2][] = $value[2];
			}

			$criteria->add(PricRecargoxConceptoPeer::CA_IDTRAYECTO, $vals[0], Criteria::IN);
			$criteria->add(PricRecargoxConceptoPeer::CA_IDCONCEPTO, $vals[1], Criteria::IN);
			$criteria->add(PricRecargoxConceptoPeer::CA_IDRECARGO, $vals[2], Criteria::IN);
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
	 * Validates all modified columns of given PricRecargoxConcepto object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      PricRecargoxConcepto $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(PricRecargoxConcepto $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PricRecargoxConceptoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PricRecargoxConceptoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PricRecargoxConceptoPeer::DATABASE_NAME, PricRecargoxConceptoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PricRecargoxConceptoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	/**
	 * Retrieve object using using composite pkey values.
	 * @param int $ca_idtrayecto
	   @param int $ca_idconcepto
	   @param int $ca_idrecargo
	   
	 * @param      Connection $con
	 * @return     PricRecargoxConcepto
	 */
	public static function retrieveByPK( $ca_idtrayecto, $ca_idconcepto, $ca_idrecargo, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(PricRecargoxConceptoPeer::CA_IDTRAYECTO, $ca_idtrayecto);
		$criteria->add(PricRecargoxConceptoPeer::CA_IDCONCEPTO, $ca_idconcepto);
		$criteria->add(PricRecargoxConceptoPeer::CA_IDRECARGO, $ca_idrecargo);
		$v = PricRecargoxConceptoPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} // BasePricRecargoxConceptoPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BasePricRecargoxConceptoPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	Propel::registerMapBuilder('lib.model.pricing.map.PricRecargoxConceptoMapBuilder');
}
