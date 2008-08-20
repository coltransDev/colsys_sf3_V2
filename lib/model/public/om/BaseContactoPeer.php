<?php

/**
 * Base static class for performing query and update operations on the 'tb_concliente' table.
 *
 * 
 *
 * @package    lib.model.public.om
 */
abstract class BaseContactoPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_concliente';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.public.Contacto';

	/** The total number of columns. */
	const NUM_COLUMNS = 17;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the CA_IDCONTACTO field */
	const CA_IDCONTACTO = 'tb_concliente.CA_IDCONTACTO';

	/** the column name for the CA_IDCLIENTE field */
	const CA_IDCLIENTE = 'tb_concliente.CA_IDCLIENTE';

	/** the column name for the CA_PAPELLIDO field */
	const CA_PAPELLIDO = 'tb_concliente.CA_PAPELLIDO';

	/** the column name for the CA_SAPELLIDO field */
	const CA_SAPELLIDO = 'tb_concliente.CA_SAPELLIDO';

	/** the column name for the CA_NOMBRES field */
	const CA_NOMBRES = 'tb_concliente.CA_NOMBRES';

	/** the column name for the CA_SALUDO field */
	const CA_SALUDO = 'tb_concliente.CA_SALUDO';

	/** the column name for the CA_CARGO field */
	const CA_CARGO = 'tb_concliente.CA_CARGO';

	/** the column name for the CA_DEPARTAMENTO field */
	const CA_DEPARTAMENTO = 'tb_concliente.CA_DEPARTAMENTO';

	/** the column name for the CA_TELEFONOS field */
	const CA_TELEFONOS = 'tb_concliente.CA_TELEFONOS';

	/** the column name for the CA_FAX field */
	const CA_FAX = 'tb_concliente.CA_FAX';

	/** the column name for the CA_EMAIL field */
	const CA_EMAIL = 'tb_concliente.CA_EMAIL';

	/** the column name for the CA_OBSERVACIONES field */
	const CA_OBSERVACIONES = 'tb_concliente.CA_OBSERVACIONES';

	/** the column name for the CA_FCHCREADO field */
	const CA_FCHCREADO = 'tb_concliente.CA_FCHCREADO';

	/** the column name for the CA_FCHACTUALIZADO field */
	const CA_FCHACTUALIZADO = 'tb_concliente.CA_FCHACTUALIZADO';

	/** the column name for the CA_USUCREADO field */
	const CA_USUCREADO = 'tb_concliente.CA_USUCREADO';

	/** the column name for the CA_USUACTUALIZADO field */
	const CA_USUACTUALIZADO = 'tb_concliente.CA_USUACTUALIZADO';

	/** the column name for the CA_CUMPLEANOS field */
	const CA_CUMPLEANOS = 'tb_concliente.CA_CUMPLEANOS';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcontacto', 'CaIdcliente', 'CaPapellido', 'CaSapellido', 'CaNombres', 'CaSaludo', 'CaCargo', 'CaDepartamento', 'CaTelefonos', 'CaFax', 'CaEmail', 'CaObservaciones', 'CaFchcreado', 'CaFchactualizado', 'CaUsucreado', 'CaUsuactualizado', 'CaCumpleanos', ),
		BasePeer::TYPE_COLNAME => array (ContactoPeer::CA_IDCONTACTO, ContactoPeer::CA_IDCLIENTE, ContactoPeer::CA_PAPELLIDO, ContactoPeer::CA_SAPELLIDO, ContactoPeer::CA_NOMBRES, ContactoPeer::CA_SALUDO, ContactoPeer::CA_CARGO, ContactoPeer::CA_DEPARTAMENTO, ContactoPeer::CA_TELEFONOS, ContactoPeer::CA_FAX, ContactoPeer::CA_EMAIL, ContactoPeer::CA_OBSERVACIONES, ContactoPeer::CA_FCHCREADO, ContactoPeer::CA_FCHACTUALIZADO, ContactoPeer::CA_USUCREADO, ContactoPeer::CA_USUACTUALIZADO, ContactoPeer::CA_CUMPLEANOS, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcontacto', 'ca_idcliente', 'ca_papellido', 'ca_sapellido', 'ca_nombres', 'ca_saludo', 'ca_cargo', 'ca_departamento', 'ca_telefonos', 'ca_fax', 'ca_email', 'ca_observaciones', 'ca_fchcreado', 'ca_fchactualizado', 'ca_usucreado', 'ca_usuactualizado', 'ca_cumpleanos', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcontacto' => 0, 'CaIdcliente' => 1, 'CaPapellido' => 2, 'CaSapellido' => 3, 'CaNombres' => 4, 'CaSaludo' => 5, 'CaCargo' => 6, 'CaDepartamento' => 7, 'CaTelefonos' => 8, 'CaFax' => 9, 'CaEmail' => 10, 'CaObservaciones' => 11, 'CaFchcreado' => 12, 'CaFchactualizado' => 13, 'CaUsucreado' => 14, 'CaUsuactualizado' => 15, 'CaCumpleanos' => 16, ),
		BasePeer::TYPE_COLNAME => array (ContactoPeer::CA_IDCONTACTO => 0, ContactoPeer::CA_IDCLIENTE => 1, ContactoPeer::CA_PAPELLIDO => 2, ContactoPeer::CA_SAPELLIDO => 3, ContactoPeer::CA_NOMBRES => 4, ContactoPeer::CA_SALUDO => 5, ContactoPeer::CA_CARGO => 6, ContactoPeer::CA_DEPARTAMENTO => 7, ContactoPeer::CA_TELEFONOS => 8, ContactoPeer::CA_FAX => 9, ContactoPeer::CA_EMAIL => 10, ContactoPeer::CA_OBSERVACIONES => 11, ContactoPeer::CA_FCHCREADO => 12, ContactoPeer::CA_FCHACTUALIZADO => 13, ContactoPeer::CA_USUCREADO => 14, ContactoPeer::CA_USUACTUALIZADO => 15, ContactoPeer::CA_CUMPLEANOS => 16, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcontacto' => 0, 'ca_idcliente' => 1, 'ca_papellido' => 2, 'ca_sapellido' => 3, 'ca_nombres' => 4, 'ca_saludo' => 5, 'ca_cargo' => 6, 'ca_departamento' => 7, 'ca_telefonos' => 8, 'ca_fax' => 9, 'ca_email' => 10, 'ca_observaciones' => 11, 'ca_fchcreado' => 12, 'ca_fchactualizado' => 13, 'ca_usucreado' => 14, 'ca_usuactualizado' => 15, 'ca_cumpleanos' => 16, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.public.map.ContactoMapBuilder');
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
			$map = ContactoPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. ContactoPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(ContactoPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(ContactoPeer::CA_IDCONTACTO);

		$criteria->addSelectColumn(ContactoPeer::CA_IDCLIENTE);

		$criteria->addSelectColumn(ContactoPeer::CA_PAPELLIDO);

		$criteria->addSelectColumn(ContactoPeer::CA_SAPELLIDO);

		$criteria->addSelectColumn(ContactoPeer::CA_NOMBRES);

		$criteria->addSelectColumn(ContactoPeer::CA_SALUDO);

		$criteria->addSelectColumn(ContactoPeer::CA_CARGO);

		$criteria->addSelectColumn(ContactoPeer::CA_DEPARTAMENTO);

		$criteria->addSelectColumn(ContactoPeer::CA_TELEFONOS);

		$criteria->addSelectColumn(ContactoPeer::CA_FAX);

		$criteria->addSelectColumn(ContactoPeer::CA_EMAIL);

		$criteria->addSelectColumn(ContactoPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(ContactoPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(ContactoPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(ContactoPeer::CA_USUCREADO);

		$criteria->addSelectColumn(ContactoPeer::CA_USUACTUALIZADO);

		$criteria->addSelectColumn(ContactoPeer::CA_CUMPLEANOS);

	}

	const COUNT = 'COUNT(tb_concliente.CA_IDCONTACTO)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT tb_concliente.CA_IDCONTACTO)';

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
			$criteria->addSelectColumn(ContactoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ContactoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ContactoPeer::doSelectRS($criteria, $con);
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
	 * @return     Contacto
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = ContactoPeer::doSelect($critcopy, $con);
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
		return ContactoPeer::populateObjects(ContactoPeer::doSelectRS($criteria, $con));
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
			ContactoPeer::addSelectColumns($criteria);
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
		$cls = ContactoPeer::getOMClass();
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
			$criteria->addSelectColumn(ContactoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ContactoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ContactoPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE);

		$rs = ContactoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Contacto objects pre-filled with their Cliente objects.
	 *
	 * @return     array Array of Contacto objects.
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

		ContactoPeer::addSelectColumns($c);
		$startcol = (ContactoPeer::NUM_COLUMNS - ContactoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ClientePeer::addSelectColumns($c);

		$c->addJoin(ContactoPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ContactoPeer::getOMClass();

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
					$temp_obj2->addContacto($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initContactos();
				$obj2->addContacto($obj1); //CHECKME
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
			$criteria->addSelectColumn(ContactoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ContactoPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ContactoPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE);

		$rs = ContactoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Contacto objects pre-filled with all related objects.
	 *
	 * @return     array Array of Contacto objects.
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

		ContactoPeer::addSelectColumns($c);
		$startcol2 = (ContactoPeer::NUM_COLUMNS - ContactoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ClientePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ClientePeer::NUM_COLUMNS;

		$c->addJoin(ContactoPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ContactoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined Cliente rows
	
			$omClass = ClientePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getCliente(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addContacto($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initContactos();
				$obj2->addContacto($obj1);
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
		return ContactoPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a Contacto or Criteria object.
	 *
	 * @param      mixed $values Criteria or Contacto object containing data that is used to create the INSERT statement.
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
			$criteria = $values->buildCriteria(); // build Criteria from Contacto object
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
	 * Method perform an UPDATE on the database, given a Contacto or Criteria object.
	 *
	 * @param      mixed $values Criteria or Contacto object containing data that is used to create the UPDATE statement.
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

			$comparison = $criteria->getComparison(ContactoPeer::CA_IDCONTACTO);
			$selectCriteria->add(ContactoPeer::CA_IDCONTACTO, $criteria->remove(ContactoPeer::CA_IDCONTACTO), $comparison);

		} else { // $values is Contacto object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_concliente table.
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
			$affectedRows += BasePeer::doDeleteAll(ContactoPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a Contacto or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or Contacto object or primary key or array of primary keys
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
			$con = Propel::getConnection(ContactoPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof Contacto) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ContactoPeer::CA_IDCONTACTO, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given Contacto object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      Contacto $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(Contacto $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ContactoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ContactoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ContactoPeer::DATABASE_NAME, ContactoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ContactoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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
	 * @return     Contacto
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(ContactoPeer::DATABASE_NAME);

		$criteria->add(ContactoPeer::CA_IDCONTACTO, $pk);


		$v = ContactoPeer::doSelect($criteria, $con);

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
			$criteria->add(ContactoPeer::CA_IDCONTACTO, $pks, Criteria::IN);
			$objs = ContactoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseContactoPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseContactoPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	Propel::registerMapBuilder('lib.model.public.map.ContactoMapBuilder');
}
