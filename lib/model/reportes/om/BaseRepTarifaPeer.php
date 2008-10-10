<?php

/**
 * Base static class for performing query and update operations on the 'tb_reptarifas' table.
 *
 * 
 *
 * @package    lib.model.reportes.om
 */
abstract class BaseRepTarifaPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_reptarifas';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.reportes.RepTarifa';

	/** The total number of columns. */
	const NUM_COLUMNS = 18;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the OID field */
	const OID = 'tb_reptarifas.OID';

	/** the column name for the CA_IDREPORTE field */
	const CA_IDREPORTE = 'tb_reptarifas.CA_IDREPORTE';

	/** the column name for the CA_IDCONCEPTO field */
	const CA_IDCONCEPTO = 'tb_reptarifas.CA_IDCONCEPTO';

	/** the column name for the CA_CANTIDAD field */
	const CA_CANTIDAD = 'tb_reptarifas.CA_CANTIDAD';

	/** the column name for the CA_NETA_TAR field */
	const CA_NETA_TAR = 'tb_reptarifas.CA_NETA_TAR';

	/** the column name for the CA_NETA_MIN field */
	const CA_NETA_MIN = 'tb_reptarifas.CA_NETA_MIN';

	/** the column name for the CA_NETA_IDM field */
	const CA_NETA_IDM = 'tb_reptarifas.CA_NETA_IDM';

	/** the column name for the CA_REPORTAR_TAR field */
	const CA_REPORTAR_TAR = 'tb_reptarifas.CA_REPORTAR_TAR';

	/** the column name for the CA_REPORTAR_MIN field */
	const CA_REPORTAR_MIN = 'tb_reptarifas.CA_REPORTAR_MIN';

	/** the column name for the CA_REPORTAR_IDM field */
	const CA_REPORTAR_IDM = 'tb_reptarifas.CA_REPORTAR_IDM';

	/** the column name for the CA_COBRAR_TAR field */
	const CA_COBRAR_TAR = 'tb_reptarifas.CA_COBRAR_TAR';

	/** the column name for the CA_COBRAR_MIN field */
	const CA_COBRAR_MIN = 'tb_reptarifas.CA_COBRAR_MIN';

	/** the column name for the CA_COBRAR_IDM field */
	const CA_COBRAR_IDM = 'tb_reptarifas.CA_COBRAR_IDM';

	/** the column name for the CA_OBSERVACIONES field */
	const CA_OBSERVACIONES = 'tb_reptarifas.CA_OBSERVACIONES';

	/** the column name for the CA_FCHCREADO field */
	const CA_FCHCREADO = 'tb_reptarifas.CA_FCHCREADO';

	/** the column name for the CA_USUCREADO field */
	const CA_USUCREADO = 'tb_reptarifas.CA_USUCREADO';

	/** the column name for the CA_FCHACTUALIZADO field */
	const CA_FCHACTUALIZADO = 'tb_reptarifas.CA_FCHACTUALIZADO';

	/** the column name for the CA_USUACTUALIZADO field */
	const CA_USUACTUALIZADO = 'tb_reptarifas.CA_USUACTUALIZADO';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Oid', 'CaIdreporte', 'CaIdconcepto', 'CaCantidad', 'CaNetaTar', 'CaNetaMin', 'CaNetaIdm', 'CaReportarTar', 'CaReportarMin', 'CaReportarIdm', 'CaCobrarTar', 'CaCobrarMin', 'CaCobrarIdm', 'CaObservaciones', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', ),
		BasePeer::TYPE_COLNAME => array (RepTarifaPeer::OID, RepTarifaPeer::CA_IDREPORTE, RepTarifaPeer::CA_IDCONCEPTO, RepTarifaPeer::CA_CANTIDAD, RepTarifaPeer::CA_NETA_TAR, RepTarifaPeer::CA_NETA_MIN, RepTarifaPeer::CA_NETA_IDM, RepTarifaPeer::CA_REPORTAR_TAR, RepTarifaPeer::CA_REPORTAR_MIN, RepTarifaPeer::CA_REPORTAR_IDM, RepTarifaPeer::CA_COBRAR_TAR, RepTarifaPeer::CA_COBRAR_MIN, RepTarifaPeer::CA_COBRAR_IDM, RepTarifaPeer::CA_OBSERVACIONES, RepTarifaPeer::CA_FCHCREADO, RepTarifaPeer::CA_USUCREADO, RepTarifaPeer::CA_FCHACTUALIZADO, RepTarifaPeer::CA_USUACTUALIZADO, ),
		BasePeer::TYPE_FIELDNAME => array ('oid', 'ca_idreporte', 'ca_idconcepto', 'ca_cantidad', 'ca_neta_tar', 'ca_neta_min', 'ca_neta_idm', 'ca_reportar_tar', 'ca_reportar_min', 'ca_reportar_idm', 'ca_cobrar_tar', 'ca_cobrar_min', 'ca_cobrar_idm', 'ca_observaciones', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Oid' => 0, 'CaIdreporte' => 1, 'CaIdconcepto' => 2, 'CaCantidad' => 3, 'CaNetaTar' => 4, 'CaNetaMin' => 5, 'CaNetaIdm' => 6, 'CaReportarTar' => 7, 'CaReportarMin' => 8, 'CaReportarIdm' => 9, 'CaCobrarTar' => 10, 'CaCobrarMin' => 11, 'CaCobrarIdm' => 12, 'CaObservaciones' => 13, 'CaFchcreado' => 14, 'CaUsucreado' => 15, 'CaFchactualizado' => 16, 'CaUsuactualizado' => 17, ),
		BasePeer::TYPE_COLNAME => array (RepTarifaPeer::OID => 0, RepTarifaPeer::CA_IDREPORTE => 1, RepTarifaPeer::CA_IDCONCEPTO => 2, RepTarifaPeer::CA_CANTIDAD => 3, RepTarifaPeer::CA_NETA_TAR => 4, RepTarifaPeer::CA_NETA_MIN => 5, RepTarifaPeer::CA_NETA_IDM => 6, RepTarifaPeer::CA_REPORTAR_TAR => 7, RepTarifaPeer::CA_REPORTAR_MIN => 8, RepTarifaPeer::CA_REPORTAR_IDM => 9, RepTarifaPeer::CA_COBRAR_TAR => 10, RepTarifaPeer::CA_COBRAR_MIN => 11, RepTarifaPeer::CA_COBRAR_IDM => 12, RepTarifaPeer::CA_OBSERVACIONES => 13, RepTarifaPeer::CA_FCHCREADO => 14, RepTarifaPeer::CA_USUCREADO => 15, RepTarifaPeer::CA_FCHACTUALIZADO => 16, RepTarifaPeer::CA_USUACTUALIZADO => 17, ),
		BasePeer::TYPE_FIELDNAME => array ('oid' => 0, 'ca_idreporte' => 1, 'ca_idconcepto' => 2, 'ca_cantidad' => 3, 'ca_neta_tar' => 4, 'ca_neta_min' => 5, 'ca_neta_idm' => 6, 'ca_reportar_tar' => 7, 'ca_reportar_min' => 8, 'ca_reportar_idm' => 9, 'ca_cobrar_tar' => 10, 'ca_cobrar_min' => 11, 'ca_cobrar_idm' => 12, 'ca_observaciones' => 13, 'ca_fchcreado' => 14, 'ca_usucreado' => 15, 'ca_fchactualizado' => 16, 'ca_usuactualizado' => 17, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.reportes.map.RepTarifaMapBuilder');
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
			$map = RepTarifaPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. RepTarifaPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(RepTarifaPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(RepTarifaPeer::OID);

		$criteria->addSelectColumn(RepTarifaPeer::CA_IDREPORTE);

		$criteria->addSelectColumn(RepTarifaPeer::CA_IDCONCEPTO);

		$criteria->addSelectColumn(RepTarifaPeer::CA_CANTIDAD);

		$criteria->addSelectColumn(RepTarifaPeer::CA_NETA_TAR);

		$criteria->addSelectColumn(RepTarifaPeer::CA_NETA_MIN);

		$criteria->addSelectColumn(RepTarifaPeer::CA_NETA_IDM);

		$criteria->addSelectColumn(RepTarifaPeer::CA_REPORTAR_TAR);

		$criteria->addSelectColumn(RepTarifaPeer::CA_REPORTAR_MIN);

		$criteria->addSelectColumn(RepTarifaPeer::CA_REPORTAR_IDM);

		$criteria->addSelectColumn(RepTarifaPeer::CA_COBRAR_TAR);

		$criteria->addSelectColumn(RepTarifaPeer::CA_COBRAR_MIN);

		$criteria->addSelectColumn(RepTarifaPeer::CA_COBRAR_IDM);

		$criteria->addSelectColumn(RepTarifaPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(RepTarifaPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(RepTarifaPeer::CA_USUCREADO);

		$criteria->addSelectColumn(RepTarifaPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(RepTarifaPeer::CA_USUACTUALIZADO);

	}

	const COUNT = 'COUNT(tb_reptarifas.OID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT tb_reptarifas.OID)';

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
			$criteria->addSelectColumn(RepTarifaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepTarifaPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = RepTarifaPeer::doSelectRS($criteria, $con);
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
	 * @return     RepTarifa
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = RepTarifaPeer::doSelect($critcopy, $con);
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
		return RepTarifaPeer::populateObjects(RepTarifaPeer::doSelectRS($criteria, $con));
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
			RepTarifaPeer::addSelectColumns($criteria);
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
		$cls = RepTarifaPeer::getOMClass();
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
			$criteria->addSelectColumn(RepTarifaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepTarifaPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RepTarifaPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$rs = RepTarifaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Concepto table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinConcepto(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RepTarifaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepTarifaPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RepTarifaPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);

		$rs = RepTarifaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of RepTarifa objects pre-filled with their Reporte objects.
	 *
	 * @return     array Array of RepTarifa objects.
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

		RepTarifaPeer::addSelectColumns($c);
		$startcol = (RepTarifaPeer::NUM_COLUMNS - RepTarifaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ReportePeer::addSelectColumns($c);

		$c->addJoin(RepTarifaPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RepTarifaPeer::getOMClass();

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
					$temp_obj2->addRepTarifa($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initRepTarifas();
				$obj2->addRepTarifa($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of RepTarifa objects pre-filled with their Concepto objects.
	 *
	 * @return     array Array of RepTarifa objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinConcepto(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepTarifaPeer::addSelectColumns($c);
		$startcol = (RepTarifaPeer::NUM_COLUMNS - RepTarifaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ConceptoPeer::addSelectColumns($c);

		$c->addJoin(RepTarifaPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RepTarifaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ConceptoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getConcepto(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addRepTarifa($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initRepTarifas();
				$obj2->addRepTarifa($obj1); //CHECKME
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
			$criteria->addSelectColumn(RepTarifaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepTarifaPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RepTarifaPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$criteria->addJoin(RepTarifaPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);

		$rs = RepTarifaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of RepTarifa objects pre-filled with all related objects.
	 *
	 * @return     array Array of RepTarifa objects.
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

		RepTarifaPeer::addSelectColumns($c);
		$startcol2 = (RepTarifaPeer::NUM_COLUMNS - RepTarifaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ReportePeer::NUM_COLUMNS;

		ConceptoPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ConceptoPeer::NUM_COLUMNS;

		$c->addJoin(RepTarifaPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$c->addJoin(RepTarifaPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RepTarifaPeer::getOMClass();


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
					$temp_obj2->addRepTarifa($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initRepTarifas();
				$obj2->addRepTarifa($obj1);
			}


				// Add objects for joined Concepto rows
	
			$omClass = ConceptoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getConcepto(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addRepTarifa($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initRepTarifas();
				$obj3->addRepTarifa($obj1);
			}

			$results[] = $obj1;
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
	public static function doCountJoinAllExceptReporte(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RepTarifaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepTarifaPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RepTarifaPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);

		$rs = RepTarifaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Concepto table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptConcepto(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(RepTarifaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(RepTarifaPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(RepTarifaPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);

		$rs = RepTarifaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of RepTarifa objects pre-filled with all related objects except Reporte.
	 *
	 * @return     array Array of RepTarifa objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptReporte(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepTarifaPeer::addSelectColumns($c);
		$startcol2 = (RepTarifaPeer::NUM_COLUMNS - RepTarifaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ConceptoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ConceptoPeer::NUM_COLUMNS;

		$c->addJoin(RepTarifaPeer::CA_IDCONCEPTO, ConceptoPeer::CA_IDCONCEPTO);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RepTarifaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ConceptoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getConcepto(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRepTarifa($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRepTarifas();
				$obj2->addRepTarifa($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of RepTarifa objects pre-filled with all related objects except Concepto.
	 *
	 * @return     array Array of RepTarifa objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptConcepto(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		RepTarifaPeer::addSelectColumns($c);
		$startcol2 = (RepTarifaPeer::NUM_COLUMNS - RepTarifaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ReportePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ReportePeer::NUM_COLUMNS;

		$c->addJoin(RepTarifaPeer::CA_IDREPORTE, ReportePeer::CA_IDREPORTE);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = RepTarifaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ReportePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getReporte(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addRepTarifa($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initRepTarifas();
				$obj2->addRepTarifa($obj1);
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
		return RepTarifaPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a RepTarifa or Criteria object.
	 *
	 * @param      mixed $values Criteria or RepTarifa object containing data that is used to create the INSERT statement.
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
			$criteria = $values->buildCriteria(); // build Criteria from RepTarifa object
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
	 * Method perform an UPDATE on the database, given a RepTarifa or Criteria object.
	 *
	 * @param      mixed $values Criteria or RepTarifa object containing data that is used to create the UPDATE statement.
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

			$comparison = $criteria->getComparison(RepTarifaPeer::OID);
			$selectCriteria->add(RepTarifaPeer::OID, $criteria->remove(RepTarifaPeer::OID), $comparison);

		} else { // $values is RepTarifa object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_reptarifas table.
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
			$affectedRows += BasePeer::doDeleteAll(RepTarifaPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a RepTarifa or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or RepTarifa object or primary key or array of primary keys
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
			$con = Propel::getConnection(RepTarifaPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof RepTarifa) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(RepTarifaPeer::OID, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given RepTarifa object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      RepTarifa $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(RepTarifa $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(RepTarifaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(RepTarifaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(RepTarifaPeer::DATABASE_NAME, RepTarifaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = RepTarifaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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
	 * @return     RepTarifa
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(RepTarifaPeer::DATABASE_NAME);

		$criteria->add(RepTarifaPeer::OID, $pk);


		$v = RepTarifaPeer::doSelect($criteria, $con);

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
			$criteria->add(RepTarifaPeer::OID, $pks, Criteria::IN);
			$objs = RepTarifaPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseRepTarifaPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseRepTarifaPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	Propel::registerMapBuilder('lib.model.reportes.map.RepTarifaMapBuilder');
}
