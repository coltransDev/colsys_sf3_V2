<?php

/**
 * Base static class for performing query and update operations on the 'tb_inoavisos_sea' table.
 *
 * 
 *
 * @package    lib.model.sea.om
 */
abstract class BaseInoAvisosSeaPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_inoavisos_sea';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.sea.InoAvisosSea';

	/** The total number of columns. */
	const NUM_COLUMNS = 10;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the CA_REFERENCIA field */
	const CA_REFERENCIA = 'tb_inoavisos_sea.CA_REFERENCIA';

	/** the column name for the CA_IDCLIENTE field */
	const CA_IDCLIENTE = 'tb_inoavisos_sea.CA_IDCLIENTE';

	/** the column name for the CA_HBLS field */
	const CA_HBLS = 'tb_inoavisos_sea.CA_HBLS';

	/** the column name for the CA_IDEMAIL field */
	const CA_IDEMAIL = 'tb_inoavisos_sea.CA_IDEMAIL';

	/** the column name for the CA_FCHAVISO field */
	const CA_FCHAVISO = 'tb_inoavisos_sea.CA_FCHAVISO';

	/** the column name for the CA_AVISO field */
	const CA_AVISO = 'tb_inoavisos_sea.CA_AVISO';

	/** the column name for the CA_IDBODEGA field */
	const CA_IDBODEGA = 'tb_inoavisos_sea.CA_IDBODEGA';

	/** the column name for the CA_FCHLLEGADA field */
	const CA_FCHLLEGADA = 'tb_inoavisos_sea.CA_FCHLLEGADA';

	/** the column name for the CA_FCHENVIO field */
	const CA_FCHENVIO = 'tb_inoavisos_sea.CA_FCHENVIO';

	/** the column name for the CA_USUENVIO field */
	const CA_USUENVIO = 'tb_inoavisos_sea.CA_USUENVIO';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaReferencia', 'CaIdcliente', 'CaHbls', 'CaIdemail', 'CaFchaviso', 'CaAviso', 'CaIdbodega', 'CaFchllegada', 'CaFchenvio', 'CaUsuenvio', ),
		BasePeer::TYPE_COLNAME => array (InoAvisosSeaPeer::CA_REFERENCIA, InoAvisosSeaPeer::CA_IDCLIENTE, InoAvisosSeaPeer::CA_HBLS, InoAvisosSeaPeer::CA_IDEMAIL, InoAvisosSeaPeer::CA_FCHAVISO, InoAvisosSeaPeer::CA_AVISO, InoAvisosSeaPeer::CA_IDBODEGA, InoAvisosSeaPeer::CA_FCHLLEGADA, InoAvisosSeaPeer::CA_FCHENVIO, InoAvisosSeaPeer::CA_USUENVIO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_referencia', 'ca_idcliente', 'ca_hbls', 'ca_idemail', 'ca_fchaviso', 'ca_aviso', 'ca_idbodega', 'ca_fchllegada', 'ca_fchenvio', 'ca_usuenvio', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaReferencia' => 0, 'CaIdcliente' => 1, 'CaHbls' => 2, 'CaIdemail' => 3, 'CaFchaviso' => 4, 'CaAviso' => 5, 'CaIdbodega' => 6, 'CaFchllegada' => 7, 'CaFchenvio' => 8, 'CaUsuenvio' => 9, ),
		BasePeer::TYPE_COLNAME => array (InoAvisosSeaPeer::CA_REFERENCIA => 0, InoAvisosSeaPeer::CA_IDCLIENTE => 1, InoAvisosSeaPeer::CA_HBLS => 2, InoAvisosSeaPeer::CA_IDEMAIL => 3, InoAvisosSeaPeer::CA_FCHAVISO => 4, InoAvisosSeaPeer::CA_AVISO => 5, InoAvisosSeaPeer::CA_IDBODEGA => 6, InoAvisosSeaPeer::CA_FCHLLEGADA => 7, InoAvisosSeaPeer::CA_FCHENVIO => 8, InoAvisosSeaPeer::CA_USUENVIO => 9, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_referencia' => 0, 'ca_idcliente' => 1, 'ca_hbls' => 2, 'ca_idemail' => 3, 'ca_fchaviso' => 4, 'ca_aviso' => 5, 'ca_idbodega' => 6, 'ca_fchllegada' => 7, 'ca_fchenvio' => 8, 'ca_usuenvio' => 9, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.sea.map.InoAvisosSeaMapBuilder');
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
			$map = InoAvisosSeaPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. InoAvisosSeaPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(InoAvisosSeaPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(InoAvisosSeaPeer::CA_REFERENCIA);

		$criteria->addSelectColumn(InoAvisosSeaPeer::CA_IDCLIENTE);

		$criteria->addSelectColumn(InoAvisosSeaPeer::CA_HBLS);

		$criteria->addSelectColumn(InoAvisosSeaPeer::CA_IDEMAIL);

		$criteria->addSelectColumn(InoAvisosSeaPeer::CA_FCHAVISO);

		$criteria->addSelectColumn(InoAvisosSeaPeer::CA_AVISO);

		$criteria->addSelectColumn(InoAvisosSeaPeer::CA_IDBODEGA);

		$criteria->addSelectColumn(InoAvisosSeaPeer::CA_FCHLLEGADA);

		$criteria->addSelectColumn(InoAvisosSeaPeer::CA_FCHENVIO);

		$criteria->addSelectColumn(InoAvisosSeaPeer::CA_USUENVIO);

	}

	const COUNT = 'COUNT(tb_inoavisos_sea.CA_REFERENCIA)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT tb_inoavisos_sea.CA_REFERENCIA)';

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
			$criteria->addSelectColumn(InoAvisosSeaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InoAvisosSeaPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = InoAvisosSeaPeer::doSelectRS($criteria, $con);
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
	 * @return     InoAvisosSea
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = InoAvisosSeaPeer::doSelect($critcopy, $con);
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
		return InoAvisosSeaPeer::populateObjects(InoAvisosSeaPeer::doSelectRS($criteria, $con));
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
			InoAvisosSeaPeer::addSelectColumns($criteria);
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
		$cls = InoAvisosSeaPeer::getOMClass();
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
	 * Returns the number of rows matching criteria, joining the related InoMaestraSea table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinInoMaestraSea(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InoAvisosSeaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InoAvisosSeaPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InoAvisosSeaPeer::CA_REFERENCIA, InoMaestraSeaPeer::CA_REFERENCIA);

		$rs = InoAvisosSeaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Cliente table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinCliente(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InoAvisosSeaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InoAvisosSeaPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InoAvisosSeaPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE);

		$rs = InoAvisosSeaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of InoAvisosSea objects pre-filled with their InoMaestraSea objects.
	 *
	 * @return     array Array of InoAvisosSea objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinInoMaestraSea(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoAvisosSeaPeer::addSelectColumns($c);
		$startcol = (InoAvisosSeaPeer::NUM_COLUMNS - InoAvisosSeaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		InoMaestraSeaPeer::addSelectColumns($c);

		$c->addJoin(InoAvisosSeaPeer::CA_REFERENCIA, InoMaestraSeaPeer::CA_REFERENCIA);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InoAvisosSeaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = InoMaestraSeaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getInoMaestraSea(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addInoAvisosSea($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initInoAvisosSeas();
				$obj2->addInoAvisosSea($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of InoAvisosSea objects pre-filled with their Cliente objects.
	 *
	 * @return     array Array of InoAvisosSea objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinCliente(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoAvisosSeaPeer::addSelectColumns($c);
		$startcol = (InoAvisosSeaPeer::NUM_COLUMNS - InoAvisosSeaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ClientePeer::addSelectColumns($c);

		$c->addJoin(InoAvisosSeaPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InoAvisosSeaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ClientePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getCliente(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addInoAvisosSea($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initInoAvisosSeas();
				$obj2->addInoAvisosSea($obj1); //CHECKME
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
			$criteria->addSelectColumn(InoAvisosSeaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InoAvisosSeaPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InoAvisosSeaPeer::CA_REFERENCIA, InoMaestraSeaPeer::CA_REFERENCIA);

		$criteria->addJoin(InoAvisosSeaPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE);

		$rs = InoAvisosSeaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of InoAvisosSea objects pre-filled with all related objects.
	 *
	 * @return     array Array of InoAvisosSea objects.
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

		InoAvisosSeaPeer::addSelectColumns($c);
		$startcol2 = (InoAvisosSeaPeer::NUM_COLUMNS - InoAvisosSeaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		InoMaestraSeaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + InoMaestraSeaPeer::NUM_COLUMNS;

		ClientePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ClientePeer::NUM_COLUMNS;

		$c->addJoin(InoAvisosSeaPeer::CA_REFERENCIA, InoMaestraSeaPeer::CA_REFERENCIA);

		$c->addJoin(InoAvisosSeaPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InoAvisosSeaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined InoMaestraSea rows
	
			$omClass = InoMaestraSeaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getInoMaestraSea(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addInoAvisosSea($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initInoAvisosSeas();
				$obj2->addInoAvisosSea($obj1);
			}


				// Add objects for joined Cliente rows
	
			$omClass = ClientePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getCliente(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addInoAvisosSea($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initInoAvisosSeas();
				$obj3->addInoAvisosSea($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related InoMaestraSea table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptInoMaestraSea(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InoAvisosSeaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InoAvisosSeaPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InoAvisosSeaPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE);

		$rs = InoAvisosSeaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Cliente table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptCliente(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InoAvisosSeaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InoAvisosSeaPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InoAvisosSeaPeer::CA_REFERENCIA, InoMaestraSeaPeer::CA_REFERENCIA);

		$rs = InoAvisosSeaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of InoAvisosSea objects pre-filled with all related objects except InoMaestraSea.
	 *
	 * @return     array Array of InoAvisosSea objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptInoMaestraSea(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoAvisosSeaPeer::addSelectColumns($c);
		$startcol2 = (InoAvisosSeaPeer::NUM_COLUMNS - InoAvisosSeaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ClientePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ClientePeer::NUM_COLUMNS;

		$c->addJoin(InoAvisosSeaPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InoAvisosSeaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ClientePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getCliente(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addInoAvisosSea($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initInoAvisosSeas();
				$obj2->addInoAvisosSea($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of InoAvisosSea objects pre-filled with all related objects except Cliente.
	 *
	 * @return     array Array of InoAvisosSea objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptCliente(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InoAvisosSeaPeer::addSelectColumns($c);
		$startcol2 = (InoAvisosSeaPeer::NUM_COLUMNS - InoAvisosSeaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		InoMaestraSeaPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + InoMaestraSeaPeer::NUM_COLUMNS;

		$c->addJoin(InoAvisosSeaPeer::CA_REFERENCIA, InoMaestraSeaPeer::CA_REFERENCIA);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InoAvisosSeaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = InoMaestraSeaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getInoMaestraSea(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addInoAvisosSea($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initInoAvisosSeas();
				$obj2->addInoAvisosSea($obj1);
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
		return InoAvisosSeaPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a InoAvisosSea or Criteria object.
	 *
	 * @param      mixed $values Criteria or InoAvisosSea object containing data that is used to create the INSERT statement.
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
			$criteria = $values->buildCriteria(); // build Criteria from InoAvisosSea object
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
	 * Method perform an UPDATE on the database, given a InoAvisosSea or Criteria object.
	 *
	 * @param      mixed $values Criteria or InoAvisosSea object containing data that is used to create the UPDATE statement.
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

			$comparison = $criteria->getComparison(InoAvisosSeaPeer::CA_REFERENCIA);
			$selectCriteria->add(InoAvisosSeaPeer::CA_REFERENCIA, $criteria->remove(InoAvisosSeaPeer::CA_REFERENCIA), $comparison);

			$comparison = $criteria->getComparison(InoAvisosSeaPeer::CA_IDCLIENTE);
			$selectCriteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $criteria->remove(InoAvisosSeaPeer::CA_IDCLIENTE), $comparison);

			$comparison = $criteria->getComparison(InoAvisosSeaPeer::CA_HBLS);
			$selectCriteria->add(InoAvisosSeaPeer::CA_HBLS, $criteria->remove(InoAvisosSeaPeer::CA_HBLS), $comparison);

			$comparison = $criteria->getComparison(InoAvisosSeaPeer::CA_IDEMAIL);
			$selectCriteria->add(InoAvisosSeaPeer::CA_IDEMAIL, $criteria->remove(InoAvisosSeaPeer::CA_IDEMAIL), $comparison);

		} else { // $values is InoAvisosSea object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_inoavisos_sea table.
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
			$affectedRows += BasePeer::doDeleteAll(InoAvisosSeaPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a InoAvisosSea or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or InoAvisosSea object or primary key or array of primary keys
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
			$con = Propel::getConnection(InoAvisosSeaPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof InoAvisosSea) {

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
				$vals[3][] = $value[3];
			}

			$criteria->add(InoAvisosSeaPeer::CA_REFERENCIA, $vals[0], Criteria::IN);
			$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $vals[1], Criteria::IN);
			$criteria->add(InoAvisosSeaPeer::CA_HBLS, $vals[2], Criteria::IN);
			$criteria->add(InoAvisosSeaPeer::CA_IDEMAIL, $vals[3], Criteria::IN);
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
	 * Validates all modified columns of given InoAvisosSea object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      InoAvisosSea $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(InoAvisosSea $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(InoAvisosSeaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(InoAvisosSeaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(InoAvisosSeaPeer::DATABASE_NAME, InoAvisosSeaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = InoAvisosSeaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	/**
	 * Retrieve object using using composite pkey values.
	 * @param string $ca_referencia
	   @param int $ca_idcliente
	   @param string $ca_hbls
	   @param int $ca_idemail
	   
	 * @param      Connection $con
	 * @return     InoAvisosSea
	 */
	public static function retrieveByPK( $ca_referencia, $ca_idcliente, $ca_hbls, $ca_idemail, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(InoAvisosSeaPeer::CA_REFERENCIA, $ca_referencia);
		$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $ca_idcliente);
		$criteria->add(InoAvisosSeaPeer::CA_HBLS, $ca_hbls);
		$criteria->add(InoAvisosSeaPeer::CA_IDEMAIL, $ca_idemail);
		$v = InoAvisosSeaPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} // BaseInoAvisosSeaPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseInoAvisosSeaPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	Propel::registerMapBuilder('lib.model.sea.map.InoAvisosSeaMapBuilder');
}
