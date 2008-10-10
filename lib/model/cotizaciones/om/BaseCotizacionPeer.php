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
	const NUM_COLUMNS = 19;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the CA_IDCOTIZACION field */
	const CA_IDCOTIZACION = 'tb_cotizaciones.CA_IDCOTIZACION';

	/** the column name for the CA_FCHCOTIZACION field */
	const CA_FCHCOTIZACION = 'tb_cotizaciones.CA_FCHCOTIZACION';

	/** the column name for the CA_FCHPRESENTACION field */
	const CA_FCHPRESENTACION = 'tb_cotizaciones.CA_FCHPRESENTACION';

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

	/** the column name for the CA_FCHANULADO field */
	const CA_FCHANULADO = 'tb_cotizaciones.CA_FCHANULADO';

	/** the column name for the CA_USUANULADO field */
	const CA_USUANULADO = 'tb_cotizaciones.CA_USUANULADO';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcotizacion', 'CaFchcotizacion', 'CaFchpresentacion', 'CaIdcontacto', 'CaConsecutivo', 'CaAsunto', 'CaSaludo', 'CaEntrada', 'CaDespedida', 'CaUsuario', 'CaAnexos', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', 'CaFchsolicitud', 'CaHorasolicitud', 'CaFchanulado', 'CaUsuanulado', ),
		BasePeer::TYPE_COLNAME => array (CotizacionPeer::CA_IDCOTIZACION, CotizacionPeer::CA_FCHCOTIZACION, CotizacionPeer::CA_FCHPRESENTACION, CotizacionPeer::CA_IDCONTACTO, CotizacionPeer::CA_CONSECUTIVO, CotizacionPeer::CA_ASUNTO, CotizacionPeer::CA_SALUDO, CotizacionPeer::CA_ENTRADA, CotizacionPeer::CA_DESPEDIDA, CotizacionPeer::CA_USUARIO, CotizacionPeer::CA_ANEXOS, CotizacionPeer::CA_FCHCREADO, CotizacionPeer::CA_USUCREADO, CotizacionPeer::CA_FCHACTUALIZADO, CotizacionPeer::CA_USUACTUALIZADO, CotizacionPeer::CA_FCHSOLICITUD, CotizacionPeer::CA_HORASOLICITUD, CotizacionPeer::CA_FCHANULADO, CotizacionPeer::CA_USUANULADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcotizacion', 'ca_fchcotizacion', 'ca_fchpresentacion', 'ca_idcontacto', 'ca_consecutivo', 'ca_asunto', 'ca_saludo', 'ca_entrada', 'ca_despedida', 'ca_usuario', 'ca_anexos', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', 'ca_fchsolicitud', 'ca_horasolicitud', 'ca_fchanulado', 'ca_usuanulado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcotizacion' => 0, 'CaFchcotizacion' => 1, 'CaFchpresentacion' => 2, 'CaIdcontacto' => 3, 'CaConsecutivo' => 4, 'CaAsunto' => 5, 'CaSaludo' => 6, 'CaEntrada' => 7, 'CaDespedida' => 8, 'CaUsuario' => 9, 'CaAnexos' => 10, 'CaFchcreado' => 11, 'CaUsucreado' => 12, 'CaFchactualizado' => 13, 'CaUsuactualizado' => 14, 'CaFchsolicitud' => 15, 'CaHorasolicitud' => 16, 'CaFchanulado' => 17, 'CaUsuanulado' => 18, ),
		BasePeer::TYPE_COLNAME => array (CotizacionPeer::CA_IDCOTIZACION => 0, CotizacionPeer::CA_FCHCOTIZACION => 1, CotizacionPeer::CA_FCHPRESENTACION => 2, CotizacionPeer::CA_IDCONTACTO => 3, CotizacionPeer::CA_CONSECUTIVO => 4, CotizacionPeer::CA_ASUNTO => 5, CotizacionPeer::CA_SALUDO => 6, CotizacionPeer::CA_ENTRADA => 7, CotizacionPeer::CA_DESPEDIDA => 8, CotizacionPeer::CA_USUARIO => 9, CotizacionPeer::CA_ANEXOS => 10, CotizacionPeer::CA_FCHCREADO => 11, CotizacionPeer::CA_USUCREADO => 12, CotizacionPeer::CA_FCHACTUALIZADO => 13, CotizacionPeer::CA_USUACTUALIZADO => 14, CotizacionPeer::CA_FCHSOLICITUD => 15, CotizacionPeer::CA_HORASOLICITUD => 16, CotizacionPeer::CA_FCHANULADO => 17, CotizacionPeer::CA_USUANULADO => 18, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcotizacion' => 0, 'ca_fchcotizacion' => 1, 'ca_fchpresentacion' => 2, 'ca_idcontacto' => 3, 'ca_consecutivo' => 4, 'ca_asunto' => 5, 'ca_saludo' => 6, 'ca_entrada' => 7, 'ca_despedida' => 8, 'ca_usuario' => 9, 'ca_anexos' => 10, 'ca_fchcreado' => 11, 'ca_usucreado' => 12, 'ca_fchactualizado' => 13, 'ca_usuactualizado' => 14, 'ca_fchsolicitud' => 15, 'ca_horasolicitud' => 16, 'ca_fchanulado' => 17, 'ca_usuanulado' => 18, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.cotizaciones.map.CotizacionMapBuilder');
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
			$map = CotizacionPeer::getTableMap();
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

		$criteria->addSelectColumn(CotizacionPeer::CA_FCHCOTIZACION);

		$criteria->addSelectColumn(CotizacionPeer::CA_FCHPRESENTACION);

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

		$criteria->addSelectColumn(CotizacionPeer::CA_FCHANULADO);

		$criteria->addSelectColumn(CotizacionPeer::CA_USUANULADO);

	}

	const COUNT = 'COUNT(tb_cotizaciones.CA_IDCOTIZACION)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT tb_cotizaciones.CA_IDCOTIZACION)';

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
			$criteria->addSelectColumn(CotizacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CotizacionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = CotizacionPeer::doSelectRS($criteria, $con);
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
	 * @return     Cotizacion
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
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
	 * @param      Connection $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return CotizacionPeer::populateObjects(CotizacionPeer::doSelectRS($criteria, $con));
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
			CotizacionPeer::addSelectColumns($criteria);
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
		$cls = CotizacionPeer::getOMClass();
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
	 * Returns the number of rows matching criteria, joining the related Contacto table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinContacto(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CotizacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CotizacionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CotizacionPeer::CA_IDCONTACTO, ContactoPeer::CA_IDCONTACTO);

		$rs = CotizacionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Usuario table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinUsuario(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CotizacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CotizacionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CotizacionPeer::CA_USUARIO, UsuarioPeer::CA_LOGIN);

		$rs = CotizacionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Cotizacion objects pre-filled with their Contacto objects.
	 *
	 * @return     array Array of Cotizacion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinContacto(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotizacionPeer::addSelectColumns($c);
		$startcol = (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ContactoPeer::addSelectColumns($c);

		$c->addJoin(CotizacionPeer::CA_IDCONTACTO, ContactoPeer::CA_IDCONTACTO);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CotizacionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ContactoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getContacto(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addCotizacion($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initCotizacions();
				$obj2->addCotizacion($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Cotizacion objects pre-filled with their Usuario objects.
	 *
	 * @return     array Array of Cotizacion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinUsuario(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotizacionPeer::addSelectColumns($c);
		$startcol = (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(CotizacionPeer::CA_USUARIO, UsuarioPeer::CA_LOGIN);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CotizacionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsuarioPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUsuario(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addCotizacion($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initCotizacions();
				$obj2->addCotizacion($obj1); //CHECKME
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
			$criteria->addSelectColumn(CotizacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CotizacionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CotizacionPeer::CA_IDCONTACTO, ContactoPeer::CA_IDCONTACTO);

		$criteria->addJoin(CotizacionPeer::CA_USUARIO, UsuarioPeer::CA_LOGIN);

		$rs = CotizacionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Cotizacion objects pre-filled with all related objects.
	 *
	 * @return     array Array of Cotizacion objects.
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

		CotizacionPeer::addSelectColumns($c);
		$startcol2 = (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ContactoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ContactoPeer::NUM_COLUMNS;

		UsuarioPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UsuarioPeer::NUM_COLUMNS;

		$c->addJoin(CotizacionPeer::CA_IDCONTACTO, ContactoPeer::CA_IDCONTACTO);

		$c->addJoin(CotizacionPeer::CA_USUARIO, UsuarioPeer::CA_LOGIN);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CotizacionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined Contacto rows
	
			$omClass = ContactoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getContacto(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addCotizacion($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initCotizacions();
				$obj2->addCotizacion($obj1);
			}


				// Add objects for joined Usuario rows
	
			$omClass = UsuarioPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUsuario(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addCotizacion($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initCotizacions();
				$obj3->addCotizacion($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Contacto table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptContacto(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CotizacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CotizacionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CotizacionPeer::CA_USUARIO, UsuarioPeer::CA_LOGIN);

		$rs = CotizacionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Usuario table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptUsuario(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(CotizacionPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(CotizacionPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(CotizacionPeer::CA_IDCONTACTO, ContactoPeer::CA_IDCONTACTO);

		$rs = CotizacionPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Cotizacion objects pre-filled with all related objects except Contacto.
	 *
	 * @return     array Array of Cotizacion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptContacto(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotizacionPeer::addSelectColumns($c);
		$startcol2 = (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		$c->addJoin(CotizacionPeer::CA_USUARIO, UsuarioPeer::CA_LOGIN);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CotizacionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsuarioPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUsuario(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addCotizacion($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCotizacions();
				$obj2->addCotizacion($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Cotizacion objects pre-filled with all related objects except Usuario.
	 *
	 * @return     array Array of Cotizacion objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptUsuario(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		CotizacionPeer::addSelectColumns($c);
		$startcol2 = (CotizacionPeer::NUM_COLUMNS - CotizacionPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ContactoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ContactoPeer::NUM_COLUMNS;

		$c->addJoin(CotizacionPeer::CA_IDCONTACTO, ContactoPeer::CA_IDCONTACTO);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = CotizacionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ContactoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getContacto(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addCotizacion($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initCotizacions();
				$obj2->addCotizacion($obj1);
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
		return CotizacionPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a Cotizacion or Criteria object.
	 *
	 * @param      mixed $values Criteria or Cotizacion object containing data that is used to create the INSERT statement.
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
			$criteria = $values->buildCriteria(); // build Criteria from Cotizacion object
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
	 * Method perform an UPDATE on the database, given a Cotizacion or Criteria object.
	 *
	 * @param      mixed $values Criteria or Cotizacion object containing data that is used to create the UPDATE statement.
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
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->begin();
			$affectedRows += BasePeer::doDeleteAll(CotizacionPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a Cotizacion or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or Cotizacion object or primary key or array of primary keys
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
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof Cotizacion) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(CotizacionPeer::CA_IDCOTIZACION, (array) $values, Criteria::IN);
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

			foreach($cols as $colName) {
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
	 * @return     Cotizacion
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
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
			$criteria->add(CotizacionPeer::CA_IDCOTIZACION, $pks, Criteria::IN);
			$objs = CotizacionPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseCotizacionPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseCotizacionPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	Propel::registerMapBuilder('lib.model.cotizaciones.map.CotizacionMapBuilder');
}
