<?php

/**
 * Base static class for performing query and update operations on the 'tb_trayectos' table.
 *
 * 
 *
 * @package    lib.model.pricing.om
 */
abstract class BaseTrayectoPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_trayectos';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.pricing.Trayecto';

	/** The total number of columns. */
	const NUM_COLUMNS = 15;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the OID field */
	const OID = 'tb_trayectos.OID';

	/** the column name for the CA_IDTRAYECTO field */
	const CA_IDTRAYECTO = 'tb_trayectos.CA_IDTRAYECTO';

	/** the column name for the CA_ORIGEN field */
	const CA_ORIGEN = 'tb_trayectos.CA_ORIGEN';

	/** the column name for the CA_DESTINO field */
	const CA_DESTINO = 'tb_trayectos.CA_DESTINO';

	/** the column name for the CA_IDLINEA field */
	const CA_IDLINEA = 'tb_trayectos.CA_IDLINEA';

	/** the column name for the CA_TRANSPORTE field */
	const CA_TRANSPORTE = 'tb_trayectos.CA_TRANSPORTE';

	/** the column name for the CA_TERMINAL field */
	const CA_TERMINAL = 'tb_trayectos.CA_TERMINAL';

	/** the column name for the CA_IMPOEXPO field */
	const CA_IMPOEXPO = 'tb_trayectos.CA_IMPOEXPO';

	/** the column name for the CA_FRECUENCIA field */
	const CA_FRECUENCIA = 'tb_trayectos.CA_FRECUENCIA';

	/** the column name for the CA_TIEMPOTRANSITO field */
	const CA_TIEMPOTRANSITO = 'tb_trayectos.CA_TIEMPOTRANSITO';

	/** the column name for the CA_MODALIDAD field */
	const CA_MODALIDAD = 'tb_trayectos.CA_MODALIDAD';

	/** the column name for the CA_FCHCREADO field */
	const CA_FCHCREADO = 'tb_trayectos.CA_FCHCREADO';

	/** the column name for the CA_IDTARIFAS field */
	const CA_IDTARIFAS = 'tb_trayectos.CA_IDTARIFAS';

	/** the column name for the CA_OBSERVACIONES field */
	const CA_OBSERVACIONES = 'tb_trayectos.CA_OBSERVACIONES';

	/** the column name for the CA_IDAGENTE field */
	const CA_IDAGENTE = 'tb_trayectos.CA_IDAGENTE';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Oid', 'CaIdtrayecto', 'CaOrigen', 'CaDestino', 'CaIdlinea', 'CaTransporte', 'CaTerminal', 'CaImpoexpo', 'CaFrecuencia', 'CaTiempotransito', 'CaModalidad', 'CaFchcreado', 'CaIdtarifas', 'CaObservaciones', 'CaIdagente', ),
		BasePeer::TYPE_COLNAME => array (TrayectoPeer::OID, TrayectoPeer::CA_IDTRAYECTO, TrayectoPeer::CA_ORIGEN, TrayectoPeer::CA_DESTINO, TrayectoPeer::CA_IDLINEA, TrayectoPeer::CA_TRANSPORTE, TrayectoPeer::CA_TERMINAL, TrayectoPeer::CA_IMPOEXPO, TrayectoPeer::CA_FRECUENCIA, TrayectoPeer::CA_TIEMPOTRANSITO, TrayectoPeer::CA_MODALIDAD, TrayectoPeer::CA_FCHCREADO, TrayectoPeer::CA_IDTARIFAS, TrayectoPeer::CA_OBSERVACIONES, TrayectoPeer::CA_IDAGENTE, ),
		BasePeer::TYPE_FIELDNAME => array ('oid', 'ca_idtrayecto', 'ca_origen', 'ca_destino', 'ca_idlinea', 'ca_transporte', 'ca_terminal', 'ca_impoexpo', 'ca_frecuencia', 'ca_tiempotransito', 'ca_modalidad', 'ca_fchcreado', 'ca_idtarifas', 'ca_observaciones', 'ca_idagente', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Oid' => 0, 'CaIdtrayecto' => 1, 'CaOrigen' => 2, 'CaDestino' => 3, 'CaIdlinea' => 4, 'CaTransporte' => 5, 'CaTerminal' => 6, 'CaImpoexpo' => 7, 'CaFrecuencia' => 8, 'CaTiempotransito' => 9, 'CaModalidad' => 10, 'CaFchcreado' => 11, 'CaIdtarifas' => 12, 'CaObservaciones' => 13, 'CaIdagente' => 14, ),
		BasePeer::TYPE_COLNAME => array (TrayectoPeer::OID => 0, TrayectoPeer::CA_IDTRAYECTO => 1, TrayectoPeer::CA_ORIGEN => 2, TrayectoPeer::CA_DESTINO => 3, TrayectoPeer::CA_IDLINEA => 4, TrayectoPeer::CA_TRANSPORTE => 5, TrayectoPeer::CA_TERMINAL => 6, TrayectoPeer::CA_IMPOEXPO => 7, TrayectoPeer::CA_FRECUENCIA => 8, TrayectoPeer::CA_TIEMPOTRANSITO => 9, TrayectoPeer::CA_MODALIDAD => 10, TrayectoPeer::CA_FCHCREADO => 11, TrayectoPeer::CA_IDTARIFAS => 12, TrayectoPeer::CA_OBSERVACIONES => 13, TrayectoPeer::CA_IDAGENTE => 14, ),
		BasePeer::TYPE_FIELDNAME => array ('oid' => 0, 'ca_idtrayecto' => 1, 'ca_origen' => 2, 'ca_destino' => 3, 'ca_idlinea' => 4, 'ca_transporte' => 5, 'ca_terminal' => 6, 'ca_impoexpo' => 7, 'ca_frecuencia' => 8, 'ca_tiempotransito' => 9, 'ca_modalidad' => 10, 'ca_fchcreado' => 11, 'ca_idtarifas' => 12, 'ca_observaciones' => 13, 'ca_idagente' => 14, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.pricing.map.TrayectoMapBuilder');
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
			$map = TrayectoPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. TrayectoPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(TrayectoPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(TrayectoPeer::OID);

		$criteria->addSelectColumn(TrayectoPeer::CA_IDTRAYECTO);

		$criteria->addSelectColumn(TrayectoPeer::CA_ORIGEN);

		$criteria->addSelectColumn(TrayectoPeer::CA_DESTINO);

		$criteria->addSelectColumn(TrayectoPeer::CA_IDLINEA);

		$criteria->addSelectColumn(TrayectoPeer::CA_TRANSPORTE);

		$criteria->addSelectColumn(TrayectoPeer::CA_TERMINAL);

		$criteria->addSelectColumn(TrayectoPeer::CA_IMPOEXPO);

		$criteria->addSelectColumn(TrayectoPeer::CA_FRECUENCIA);

		$criteria->addSelectColumn(TrayectoPeer::CA_TIEMPOTRANSITO);

		$criteria->addSelectColumn(TrayectoPeer::CA_MODALIDAD);

		$criteria->addSelectColumn(TrayectoPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(TrayectoPeer::CA_IDTARIFAS);

		$criteria->addSelectColumn(TrayectoPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(TrayectoPeer::CA_IDAGENTE);

	}

	const COUNT = 'COUNT(tb_trayectos.CA_IDTRAYECTO)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT tb_trayectos.CA_IDTRAYECTO)';

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
			$criteria->addSelectColumn(TrayectoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(TrayectoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = TrayectoPeer::doSelectRS($criteria, $con);
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
	 * @return     Trayecto
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = TrayectoPeer::doSelect($critcopy, $con);
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
		return TrayectoPeer::populateObjects(TrayectoPeer::doSelectRS($criteria, $con));
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
			TrayectoPeer::addSelectColumns($criteria);
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
		$cls = TrayectoPeer::getOMClass();
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
			$criteria->addSelectColumn(TrayectoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(TrayectoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(TrayectoPeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA);

		$rs = TrayectoPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(TrayectoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(TrayectoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(TrayectoPeer::CA_IDAGENTE, AgentePeer::CA_IDAGENTE);

		$rs = TrayectoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Trayecto objects pre-filled with their Transportador objects.
	 *
	 * @return     array Array of Trayecto objects.
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

		TrayectoPeer::addSelectColumns($c);
		$startcol = (TrayectoPeer::NUM_COLUMNS - TrayectoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		TransportadorPeer::addSelectColumns($c);

		$c->addJoin(TrayectoPeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = TrayectoPeer::getOMClass();

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
					$temp_obj2->addTrayecto($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initTrayectos();
				$obj2->addTrayecto($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Trayecto objects pre-filled with their Agente objects.
	 *
	 * @return     array Array of Trayecto objects.
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

		TrayectoPeer::addSelectColumns($c);
		$startcol = (TrayectoPeer::NUM_COLUMNS - TrayectoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		AgentePeer::addSelectColumns($c);

		$c->addJoin(TrayectoPeer::CA_IDAGENTE, AgentePeer::CA_IDAGENTE);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = TrayectoPeer::getOMClass();

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
					$temp_obj2->addTrayecto($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initTrayectos();
				$obj2->addTrayecto($obj1); //CHECKME
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
			$criteria->addSelectColumn(TrayectoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(TrayectoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(TrayectoPeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA);

		$criteria->addJoin(TrayectoPeer::CA_IDAGENTE, AgentePeer::CA_IDAGENTE);

		$rs = TrayectoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Trayecto objects pre-filled with all related objects.
	 *
	 * @return     array Array of Trayecto objects.
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

		TrayectoPeer::addSelectColumns($c);
		$startcol2 = (TrayectoPeer::NUM_COLUMNS - TrayectoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TransportadorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TransportadorPeer::NUM_COLUMNS;

		AgentePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + AgentePeer::NUM_COLUMNS;

		$c->addJoin(TrayectoPeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA);

		$c->addJoin(TrayectoPeer::CA_IDAGENTE, AgentePeer::CA_IDAGENTE);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = TrayectoPeer::getOMClass();


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
					$temp_obj2->addTrayecto($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initTrayectos();
				$obj2->addTrayecto($obj1);
			}


				// Add objects for joined Agente rows
	
			$omClass = AgentePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getAgente(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addTrayecto($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initTrayectos();
				$obj3->addTrayecto($obj1);
			}

			$results[] = $obj1;
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
	public static function doCountJoinAllExceptTransportador(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(TrayectoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(TrayectoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(TrayectoPeer::CA_IDAGENTE, AgentePeer::CA_IDAGENTE);

		$rs = TrayectoPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(TrayectoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(TrayectoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(TrayectoPeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA);

		$rs = TrayectoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Trayecto objects pre-filled with all related objects except Transportador.
	 *
	 * @return     array Array of Trayecto objects.
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

		TrayectoPeer::addSelectColumns($c);
		$startcol2 = (TrayectoPeer::NUM_COLUMNS - TrayectoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		AgentePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + AgentePeer::NUM_COLUMNS;

		$c->addJoin(TrayectoPeer::CA_IDAGENTE, AgentePeer::CA_IDAGENTE);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = TrayectoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = AgentePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getAgente(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addTrayecto($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initTrayectos();
				$obj2->addTrayecto($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Trayecto objects pre-filled with all related objects except Agente.
	 *
	 * @return     array Array of Trayecto objects.
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

		TrayectoPeer::addSelectColumns($c);
		$startcol2 = (TrayectoPeer::NUM_COLUMNS - TrayectoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		TransportadorPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + TransportadorPeer::NUM_COLUMNS;

		$c->addJoin(TrayectoPeer::CA_IDLINEA, TransportadorPeer::CA_IDLINEA);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = TrayectoPeer::getOMClass();

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
					$temp_obj2->addTrayecto($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initTrayectos();
				$obj2->addTrayecto($obj1);
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
		return TrayectoPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a Trayecto or Criteria object.
	 *
	 * @param      mixed $values Criteria or Trayecto object containing data that is used to create the INSERT statement.
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
			$criteria = $values->buildCriteria(); // build Criteria from Trayecto object
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
	 * Method perform an UPDATE on the database, given a Trayecto or Criteria object.
	 *
	 * @param      mixed $values Criteria or Trayecto object containing data that is used to create the UPDATE statement.
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

			$comparison = $criteria->getComparison(TrayectoPeer::CA_IDTRAYECTO);
			$selectCriteria->add(TrayectoPeer::CA_IDTRAYECTO, $criteria->remove(TrayectoPeer::CA_IDTRAYECTO), $comparison);

		} else { // $values is Trayecto object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_trayectos table.
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
			$affectedRows += BasePeer::doDeleteAll(TrayectoPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a Trayecto or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or Trayecto object or primary key or array of primary keys
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
			$con = Propel::getConnection(TrayectoPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof Trayecto) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(TrayectoPeer::CA_IDTRAYECTO, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given Trayecto object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      Trayecto $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(Trayecto $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(TrayectoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(TrayectoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(TrayectoPeer::DATABASE_NAME, TrayectoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = TrayectoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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
	 * @return     Trayecto
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(TrayectoPeer::DATABASE_NAME);

		$criteria->add(TrayectoPeer::CA_IDTRAYECTO, $pk);


		$v = TrayectoPeer::doSelect($criteria, $con);

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
			$criteria->add(TrayectoPeer::CA_IDTRAYECTO, $pks, Criteria::IN);
			$objs = TrayectoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseTrayectoPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseTrayectoPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	Propel::registerMapBuilder('lib.model.pricing.map.TrayectoMapBuilder');
}
