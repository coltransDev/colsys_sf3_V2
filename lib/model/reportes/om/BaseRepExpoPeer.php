<?php

/**
 * Base static class for performing query and update operations on the 'tb_repexpo' table.
 *
 * 
 *
 * @package    lib.model.reportes.om
 */
abstract class BaseRepExpoPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_repexpo';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.reportes.RepExpo';

	/** The total number of columns. */
	const NUM_COLUMNS = 14;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the CA_IDREPORTE field */
	const CA_IDREPORTE = 'tb_repexpo.CA_IDREPORTE';

	/** the column name for the CA_PESO field */
	const CA_PESO = 'tb_repexpo.CA_PESO';

	/** the column name for the CA_VOLUMEN field */
	const CA_VOLUMEN = 'tb_repexpo.CA_VOLUMEN';

	/** the column name for the CA_PIEZAS field */
	const CA_PIEZAS = 'tb_repexpo.CA_PIEZAS';

	/** the column name for the CA_DIMENSIONES field */
	const CA_DIMENSIONES = 'tb_repexpo.CA_DIMENSIONES';

	/** the column name for the CA_VALORCARGA field */
	const CA_VALORCARGA = 'tb_repexpo.CA_VALORCARGA';

	/** the column name for the CA_ANTICIPO field */
	const CA_ANTICIPO = 'tb_repexpo.CA_ANTICIPO';

	/** the column name for the CA_IDSIA field */
	const CA_IDSIA = 'tb_repexpo.CA_IDSIA';

	/** the column name for the CA_TIPOEXPO field */
	const CA_TIPOEXPO = 'tb_repexpo.CA_TIPOEXPO';

	/** the column name for the CA_IDLINEATERRESTRE field */
	const CA_IDLINEATERRESTRE = 'tb_repexpo.CA_IDLINEATERRESTRE';

	/** the column name for the CA_MOTONAVE field */
	const CA_MOTONAVE = 'tb_repexpo.CA_MOTONAVE';

	/** the column name for the CA_EMISIONBL field */
	const CA_EMISIONBL = 'tb_repexpo.CA_EMISIONBL';

	/** the column name for the CA_DATOSBL field */
	const CA_DATOSBL = 'tb_repexpo.CA_DATOSBL';

	/** the column name for the CA_NUMBL field */
	const CA_NUMBL = 'tb_repexpo.CA_NUMBL';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdreporte', 'CaPeso', 'CaVolumen', 'CaPiezas', 'CaDimensiones', 'CaValorcarga', 'CaAnticipo', 'CaIdsia', 'CaTipoexpo', 'CaIdlineaterrestre', 'CaMotonave', 'CaEmisionbl', 'CaDatosbl', 'CaNumbl', ),
		BasePeer::TYPE_COLNAME => array (RepExpoPeer::CA_IDREPORTE, RepExpoPeer::CA_PESO, RepExpoPeer::CA_VOLUMEN, RepExpoPeer::CA_PIEZAS, RepExpoPeer::CA_DIMENSIONES, RepExpoPeer::CA_VALORCARGA, RepExpoPeer::CA_ANTICIPO, RepExpoPeer::CA_IDSIA, RepExpoPeer::CA_TIPOEXPO, RepExpoPeer::CA_IDLINEATERRESTRE, RepExpoPeer::CA_MOTONAVE, RepExpoPeer::CA_EMISIONBL, RepExpoPeer::CA_DATOSBL, RepExpoPeer::CA_NUMBL, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idreporte', 'ca_peso', 'ca_volumen', 'ca_piezas', 'ca_dimensiones', 'ca_valorcarga', 'ca_anticipo', 'ca_idsia', 'ca_tipoexpo', 'ca_idlineaterrestre', 'ca_motonave', 'ca_emisionbl', 'ca_datosbl', 'ca_numbl', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdreporte' => 0, 'CaPeso' => 1, 'CaVolumen' => 2, 'CaPiezas' => 3, 'CaDimensiones' => 4, 'CaValorcarga' => 5, 'CaAnticipo' => 6, 'CaIdsia' => 7, 'CaTipoexpo' => 8, 'CaIdlineaterrestre' => 9, 'CaMotonave' => 10, 'CaEmisionbl' => 11, 'CaDatosbl' => 12, 'CaNumbl' => 13, ),
		BasePeer::TYPE_COLNAME => array (RepExpoPeer::CA_IDREPORTE => 0, RepExpoPeer::CA_PESO => 1, RepExpoPeer::CA_VOLUMEN => 2, RepExpoPeer::CA_PIEZAS => 3, RepExpoPeer::CA_DIMENSIONES => 4, RepExpoPeer::CA_VALORCARGA => 5, RepExpoPeer::CA_ANTICIPO => 6, RepExpoPeer::CA_IDSIA => 7, RepExpoPeer::CA_TIPOEXPO => 8, RepExpoPeer::CA_IDLINEATERRESTRE => 9, RepExpoPeer::CA_MOTONAVE => 10, RepExpoPeer::CA_EMISIONBL => 11, RepExpoPeer::CA_DATOSBL => 12, RepExpoPeer::CA_NUMBL => 13, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idreporte' => 0, 'ca_peso' => 1, 'ca_volumen' => 2, 'ca_piezas' => 3, 'ca_dimensiones' => 4, 'ca_valorcarga' => 5, 'ca_anticipo' => 6, 'ca_idsia' => 7, 'ca_tipoexpo' => 8, 'ca_idlineaterrestre' => 9, 'ca_motonave' => 10, 'ca_emisionbl' => 11, 'ca_datosbl' => 12, 'ca_numbl' => 13, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.reportes.map.RepExpoMapBuilder');
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
			$map = RepExpoPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. RepExpoPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(RepExpoPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(RepExpoPeer::CA_IDREPORTE);

		$criteria->addSelectColumn(RepExpoPeer::CA_PESO);

		$criteria->addSelectColumn(RepExpoPeer::CA_VOLUMEN);

		$criteria->addSelectColumn(RepExpoPeer::CA_PIEZAS);

		$criteria->addSelectColumn(RepExpoPeer::CA_DIMENSIONES);

		$criteria->addSelectColumn(RepExpoPeer::CA_VALORCARGA);

		$criteria->addSelectColumn(RepExpoPeer::CA_ANTICIPO);

		$criteria->addSelectColumn(RepExpoPeer::CA_IDSIA);

		$criteria->addSelectColumn(RepExpoPeer::CA_TIPOEXPO);

		$criteria->addSelectColumn(RepExpoPeer::CA_IDLINEATERRESTRE);

		$criteria->addSelectColumn(RepExpoPeer::CA_MOTONAVE);

		$criteria->addSelectColumn(RepExpoPeer::CA_EMISIONBL);

		$criteria->addSelectColumn(RepExpoPeer::CA_DATOSBL);

		$criteria->addSelectColumn(RepExpoPeer::CA_NUMBL);

	}

	const COUNT = 'COUNT(tb_repexpo.CA_IDREPORTE)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT tb_repexpo.CA_IDREPORTE)';

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
			$criteria->addSelectColumn(RepExpoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepExpoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = RepExpoPeer::doSelectRS($criteria, $con);
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
	 * @return     RepExpo
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = RepExpoPeer::doSelect($critcopy, $con);
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
		return RepExpoPeer::populateObjects(RepExpoPeer::doSelectRS($criteria, $con));
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
			RepExpoPeer::addSelectColumns($criteria);
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
		$cls = RepExpoPeer::getOMClass();
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
	 * Returns the number of rows matching criteria, joining the related Reporte table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinReporte(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RepExpoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepExpoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RepExpoPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$rs = RepExpoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of RepExpo objects pre-filled with their Reporte objects.
	 *
	 * @return     array Array of RepExpo objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinReporte(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepExpoPeer::addSelectColumns($c);
		$startcol = (RepExpoPeer::NUM_COLUMNS - RepExpoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ReportePeer::addSelectColumns($c);

		$c->addJoin(RepExpoPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RepExpoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ReportePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getReporte(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addRepExpo($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initRepExpos();
				$obj2->addRepExpo($obj1); //CHECKME
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
			$criteria->addSelectColumn(RepExpoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepExpoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RepExpoPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$rs = RepExpoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of RepExpo objects pre-filled with all related objects.
	 *
	 * @return     array Array of RepExpo objects.
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

		RepExpoPeer::addSelectColumns($c);
		$startcol2 = (RepExpoPeer::NUM_COLUMNS - RepExpoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ReportePeer::NUM_COLUMNS;

		$c->addJoin(RepExpoPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RepExpoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined Reporte rows
	
			$omClass = ReportePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getReporte(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRepExpo($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initRepExpos();
				$obj2->addRepExpo($obj1);
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
		return RepExpoPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a RepExpo or Criteria object.
	 *
	 * @param      mixed $values Criteria or RepExpo object containing data that is used to create the INSERT statement.
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
			$criteria = $values->buildCriteria(); // build Criteria from RepExpo object
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
	 * Method perform an UPDATE on the database, given a RepExpo or Criteria object.
	 *
	 * @param      mixed $values Criteria or RepExpo object containing data that is used to create the UPDATE statement.
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

			$comparison = $criteria->getComparison(RepExpoPeer::CA_IDREPORTE);
			$selectCriteria->add(RepExpoPeer::CA_IDREPORTE, $criteria->remove(RepExpoPeer::CA_IDREPORTE), $comparison);

		} else { // $values is RepExpo object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_repexpo table.
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
			$affectedRows += BasePeer::doDeleteAll(RepExpoPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a RepExpo or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or RepExpo object or primary key or array of primary keys
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
			$con = Propel::getConnection(RepExpoPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof RepExpo) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(RepExpoPeer::CA_IDREPORTE, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given RepExpo object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      RepExpo $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(RepExpo $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RepExpoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RepExpoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(RepExpoPeer::DATABASE_NAME, RepExpoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = RepExpoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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
	 * @return     RepExpo
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(RepExpoPeer::DATABASE_NAME);

		$criteria->add(RepExpoPeer::CA_IDREPORTE, $pk);


		$v = RepExpoPeer::doSelect($criteria, $con);

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
			$criteria->add(RepExpoPeer::CA_IDREPORTE, $pks, Criteria::IN);
			$objs = RepExpoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseRepExpoPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseRepExpoPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	Propel::registerMapBuilder('lib.model.reportes.map.RepExpoMapBuilder');
}
