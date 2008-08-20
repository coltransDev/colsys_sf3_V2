<?php

/**
 * Base static class for performing query and update operations on the 'tb_brk_maestra' table.
 *
 * 
 *
 * @package    lib.model.aduana.om
 */
abstract class BaseAduanaMaestraPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'tb_brk_maestra';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.aduana.AduanaMaestra';

	/** The total number of columns. */
	const NUM_COLUMNS = 27;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the CA_FCHREFERENCIA field */
	const CA_FCHREFERENCIA = 'tb_brk_maestra.CA_FCHREFERENCIA';

	/** the column name for the CA_REFERENCIA field */
	const CA_REFERENCIA = 'tb_brk_maestra.CA_REFERENCIA';

	/** the column name for the CA_ORIGEN field */
	const CA_ORIGEN = 'tb_brk_maestra.CA_ORIGEN';

	/** the column name for the CA_DESTINO field */
	const CA_DESTINO = 'tb_brk_maestra.CA_DESTINO';

	/** the column name for the CA_IDCLIENTE field */
	const CA_IDCLIENTE = 'tb_brk_maestra.CA_IDCLIENTE';

	/** the column name for the CA_VENDEDOR field */
	const CA_VENDEDOR = 'tb_brk_maestra.CA_VENDEDOR';

	/** the column name for the CA_COORDINADOR field */
	const CA_COORDINADOR = 'tb_brk_maestra.CA_COORDINADOR';

	/** the column name for the CA_PROVEEDOR field */
	const CA_PROVEEDOR = 'tb_brk_maestra.CA_PROVEEDOR';

	/** the column name for the CA_PEDIDO field */
	const CA_PEDIDO = 'tb_brk_maestra.CA_PEDIDO';

	/** the column name for the CA_PIEZAS field */
	const CA_PIEZAS = 'tb_brk_maestra.CA_PIEZAS';

	/** the column name for the CA_PESO field */
	const CA_PESO = 'tb_brk_maestra.CA_PESO';

	/** the column name for the CA_MERCANCIA field */
	const CA_MERCANCIA = 'tb_brk_maestra.CA_MERCANCIA';

	/** the column name for the CA_DEPOSITO field */
	const CA_DEPOSITO = 'tb_brk_maestra.CA_DEPOSITO';

	/** the column name for the CA_FCHARRIBO field */
	const CA_FCHARRIBO = 'tb_brk_maestra.CA_FCHARRIBO';

	/** the column name for the CA_MODALIDAD field */
	const CA_MODALIDAD = 'tb_brk_maestra.CA_MODALIDAD';

	/** the column name for the CA_FCHCREADO field */
	const CA_FCHCREADO = 'tb_brk_maestra.CA_FCHCREADO';

	/** the column name for the CA_USUCREADO field */
	const CA_USUCREADO = 'tb_brk_maestra.CA_USUCREADO';

	/** the column name for the CA_FCHACTUALIZADO field */
	const CA_FCHACTUALIZADO = 'tb_brk_maestra.CA_FCHACTUALIZADO';

	/** the column name for the CA_USUACTUALIZADO field */
	const CA_USUACTUALIZADO = 'tb_brk_maestra.CA_USUACTUALIZADO';

	/** the column name for the CA_FCHLIQUIDADO field */
	const CA_FCHLIQUIDADO = 'tb_brk_maestra.CA_FCHLIQUIDADO';

	/** the column name for the CA_USULIQUIDADO field */
	const CA_USULIQUIDADO = 'tb_brk_maestra.CA_USULIQUIDADO';

	/** the column name for the CA_FCHCERRADO field */
	const CA_FCHCERRADO = 'tb_brk_maestra.CA_FCHCERRADO';

	/** the column name for the CA_USUCERRADO field */
	const CA_USUCERRADO = 'tb_brk_maestra.CA_USUCERRADO';

	/** the column name for the CA_NOMBRECONTACTO field */
	const CA_NOMBRECONTACTO = 'tb_brk_maestra.CA_NOMBRECONTACTO';

	/** the column name for the CA_EMAIL field */
	const CA_EMAIL = 'tb_brk_maestra.CA_EMAIL';

	/** the column name for the CA_ANALISTA field */
	const CA_ANALISTA = 'tb_brk_maestra.CA_ANALISTA';

	/** the column name for the CA_TRACKINGCODE field */
	const CA_TRACKINGCODE = 'tb_brk_maestra.CA_TRACKINGCODE';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaFchreferencia', 'CaReferencia', 'CaOrigen', 'CaDestino', 'CaIdcliente', 'CaVendedor', 'CaCoordinador', 'CaProveedor', 'CaPedido', 'CaPiezas', 'CaPeso', 'CaMercancia', 'CaDeposito', 'CaFcharribo', 'CaModalidad', 'CaFchcreado', 'CaUsucreado', 'CaFchactualizado', 'CaUsuactualizado', 'CaFchliquidado', 'CaUsuliquidado', 'CaFchcerrado', 'CaUsucerrado', 'CaNombrecontacto', 'CaEmail', 'CaAnalista', 'CaTrackingcode', ),
		BasePeer::TYPE_COLNAME => array (AduanaMaestraPeer::CA_FCHREFERENCIA, AduanaMaestraPeer::CA_REFERENCIA, AduanaMaestraPeer::CA_ORIGEN, AduanaMaestraPeer::CA_DESTINO, AduanaMaestraPeer::CA_IDCLIENTE, AduanaMaestraPeer::CA_VENDEDOR, AduanaMaestraPeer::CA_COORDINADOR, AduanaMaestraPeer::CA_PROVEEDOR, AduanaMaestraPeer::CA_PEDIDO, AduanaMaestraPeer::CA_PIEZAS, AduanaMaestraPeer::CA_PESO, AduanaMaestraPeer::CA_MERCANCIA, AduanaMaestraPeer::CA_DEPOSITO, AduanaMaestraPeer::CA_FCHARRIBO, AduanaMaestraPeer::CA_MODALIDAD, AduanaMaestraPeer::CA_FCHCREADO, AduanaMaestraPeer::CA_USUCREADO, AduanaMaestraPeer::CA_FCHACTUALIZADO, AduanaMaestraPeer::CA_USUACTUALIZADO, AduanaMaestraPeer::CA_FCHLIQUIDADO, AduanaMaestraPeer::CA_USULIQUIDADO, AduanaMaestraPeer::CA_FCHCERRADO, AduanaMaestraPeer::CA_USUCERRADO, AduanaMaestraPeer::CA_NOMBRECONTACTO, AduanaMaestraPeer::CA_EMAIL, AduanaMaestraPeer::CA_ANALISTA, AduanaMaestraPeer::CA_TRACKINGCODE, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_fchreferencia', 'ca_referencia', 'ca_origen', 'ca_destino', 'ca_idcliente', 'ca_vendedor', 'ca_coordinador', 'ca_proveedor', 'ca_pedido', 'ca_piezas', 'ca_peso', 'ca_mercancia', 'ca_deposito', 'ca_fcharribo', 'ca_modalidad', 'ca_fchcreado', 'ca_usucreado', 'ca_fchactualizado', 'ca_usuactualizado', 'ca_fchliquidado', 'ca_usuliquidado', 'ca_fchcerrado', 'ca_usucerrado', 'ca_nombrecontacto', 'ca_email', 'ca_analista', 'ca_trackingcode', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaFchreferencia' => 0, 'CaReferencia' => 1, 'CaOrigen' => 2, 'CaDestino' => 3, 'CaIdcliente' => 4, 'CaVendedor' => 5, 'CaCoordinador' => 6, 'CaProveedor' => 7, 'CaPedido' => 8, 'CaPiezas' => 9, 'CaPeso' => 10, 'CaMercancia' => 11, 'CaDeposito' => 12, 'CaFcharribo' => 13, 'CaModalidad' => 14, 'CaFchcreado' => 15, 'CaUsucreado' => 16, 'CaFchactualizado' => 17, 'CaUsuactualizado' => 18, 'CaFchliquidado' => 19, 'CaUsuliquidado' => 20, 'CaFchcerrado' => 21, 'CaUsucerrado' => 22, 'CaNombrecontacto' => 23, 'CaEmail' => 24, 'CaAnalista' => 25, 'CaTrackingcode' => 26, ),
		BasePeer::TYPE_COLNAME => array (AduanaMaestraPeer::CA_FCHREFERENCIA => 0, AduanaMaestraPeer::CA_REFERENCIA => 1, AduanaMaestraPeer::CA_ORIGEN => 2, AduanaMaestraPeer::CA_DESTINO => 3, AduanaMaestraPeer::CA_IDCLIENTE => 4, AduanaMaestraPeer::CA_VENDEDOR => 5, AduanaMaestraPeer::CA_COORDINADOR => 6, AduanaMaestraPeer::CA_PROVEEDOR => 7, AduanaMaestraPeer::CA_PEDIDO => 8, AduanaMaestraPeer::CA_PIEZAS => 9, AduanaMaestraPeer::CA_PESO => 10, AduanaMaestraPeer::CA_MERCANCIA => 11, AduanaMaestraPeer::CA_DEPOSITO => 12, AduanaMaestraPeer::CA_FCHARRIBO => 13, AduanaMaestraPeer::CA_MODALIDAD => 14, AduanaMaestraPeer::CA_FCHCREADO => 15, AduanaMaestraPeer::CA_USUCREADO => 16, AduanaMaestraPeer::CA_FCHACTUALIZADO => 17, AduanaMaestraPeer::CA_USUACTUALIZADO => 18, AduanaMaestraPeer::CA_FCHLIQUIDADO => 19, AduanaMaestraPeer::CA_USULIQUIDADO => 20, AduanaMaestraPeer::CA_FCHCERRADO => 21, AduanaMaestraPeer::CA_USUCERRADO => 22, AduanaMaestraPeer::CA_NOMBRECONTACTO => 23, AduanaMaestraPeer::CA_EMAIL => 24, AduanaMaestraPeer::CA_ANALISTA => 25, AduanaMaestraPeer::CA_TRACKINGCODE => 26, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_fchreferencia' => 0, 'ca_referencia' => 1, 'ca_origen' => 2, 'ca_destino' => 3, 'ca_idcliente' => 4, 'ca_vendedor' => 5, 'ca_coordinador' => 6, 'ca_proveedor' => 7, 'ca_pedido' => 8, 'ca_piezas' => 9, 'ca_peso' => 10, 'ca_mercancia' => 11, 'ca_deposito' => 12, 'ca_fcharribo' => 13, 'ca_modalidad' => 14, 'ca_fchcreado' => 15, 'ca_usucreado' => 16, 'ca_fchactualizado' => 17, 'ca_usuactualizado' => 18, 'ca_fchliquidado' => 19, 'ca_usuliquidado' => 20, 'ca_fchcerrado' => 21, 'ca_usucerrado' => 22, 'ca_nombrecontacto' => 23, 'ca_email' => 24, 'ca_analista' => 25, 'ca_trackingcode' => 26, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		return BasePeer::getMapBuilder('lib.model.aduana.map.AduanaMaestraMapBuilder');
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
			$map = AduanaMaestraPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. AduanaMaestraPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(AduanaMaestraPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_FCHREFERENCIA);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_REFERENCIA);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_ORIGEN);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_DESTINO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_IDCLIENTE);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_VENDEDOR);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_COORDINADOR);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_PROVEEDOR);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_PEDIDO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_PIEZAS);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_PESO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_MERCANCIA);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_DEPOSITO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_FCHARRIBO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_MODALIDAD);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_USUCREADO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_USUACTUALIZADO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_FCHLIQUIDADO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_USULIQUIDADO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_FCHCERRADO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_USUCERRADO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_NOMBRECONTACTO);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_EMAIL);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_ANALISTA);

		$criteria->addSelectColumn(AduanaMaestraPeer::CA_TRACKINGCODE);

	}

	const COUNT = 'COUNT(tb_brk_maestra.CA_REFERENCIA)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT tb_brk_maestra.CA_REFERENCIA)';

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
			$criteria->addSelectColumn(AduanaMaestraPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AduanaMaestraPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = AduanaMaestraPeer::doSelectRS($criteria, $con);
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
	 * @return     AduanaMaestra
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = AduanaMaestraPeer::doSelect($critcopy, $con);
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
		return AduanaMaestraPeer::populateObjects(AduanaMaestraPeer::doSelectRS($criteria, $con));
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
			AduanaMaestraPeer::addSelectColumns($criteria);
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
		$cls = AduanaMaestraPeer::getOMClass();
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
			$criteria->addSelectColumn(AduanaMaestraPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AduanaMaestraPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(AduanaMaestraPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE);

		$rs = AduanaMaestraPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of AduanaMaestra objects pre-filled with their Cliente objects.
	 *
	 * @return     array Array of AduanaMaestra objects.
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

		AduanaMaestraPeer::addSelectColumns($c);
		$startcol = (AduanaMaestraPeer::NUM_COLUMNS - AduanaMaestraPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ClientePeer::addSelectColumns($c);

		$c->addJoin(AduanaMaestraPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AduanaMaestraPeer::getOMClass();

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
					$temp_obj2->addAduanaMaestra($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initAduanaMaestras();
				$obj2->addAduanaMaestra($obj1); //CHECKME
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
			$criteria->addSelectColumn(AduanaMaestraPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(AduanaMaestraPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(AduanaMaestraPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE);

		$rs = AduanaMaestraPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of AduanaMaestra objects pre-filled with all related objects.
	 *
	 * @return     array Array of AduanaMaestra objects.
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

		AduanaMaestraPeer::addSelectColumns($c);
		$startcol2 = (AduanaMaestraPeer::NUM_COLUMNS - AduanaMaestraPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ClientePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ClientePeer::NUM_COLUMNS;

		$c->addJoin(AduanaMaestraPeer::CA_IDCLIENTE, ClientePeer::CA_IDCLIENTE);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = AduanaMaestraPeer::getOMClass();


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
					$temp_obj2->addAduanaMaestra($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initAduanaMaestras();
				$obj2->addAduanaMaestra($obj1);
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
		return AduanaMaestraPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a AduanaMaestra or Criteria object.
	 *
	 * @param      mixed $values Criteria or AduanaMaestra object containing data that is used to create the INSERT statement.
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
			$criteria = $values->buildCriteria(); // build Criteria from AduanaMaestra object
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
	 * Method perform an UPDATE on the database, given a AduanaMaestra or Criteria object.
	 *
	 * @param      mixed $values Criteria or AduanaMaestra object containing data that is used to create the UPDATE statement.
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

			$comparison = $criteria->getComparison(AduanaMaestraPeer::CA_REFERENCIA);
			$selectCriteria->add(AduanaMaestraPeer::CA_REFERENCIA, $criteria->remove(AduanaMaestraPeer::CA_REFERENCIA), $comparison);

		} else { // $values is AduanaMaestra object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Method to DELETE all rows from the tb_brk_maestra table.
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
			$affectedRows += BasePeer::doDeleteAll(AduanaMaestraPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a AduanaMaestra or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or AduanaMaestra object or primary key or array of primary keys
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
			$con = Propel::getConnection(AduanaMaestraPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof AduanaMaestra) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(AduanaMaestraPeer::CA_REFERENCIA, (array) $values, Criteria::IN);
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
	 * Validates all modified columns of given AduanaMaestra object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      AduanaMaestra $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(AduanaMaestra $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(AduanaMaestraPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(AduanaMaestraPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(AduanaMaestraPeer::DATABASE_NAME, AduanaMaestraPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = AduanaMaestraPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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
	 * @return     AduanaMaestra
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(AduanaMaestraPeer::DATABASE_NAME);

		$criteria->add(AduanaMaestraPeer::CA_REFERENCIA, $pk);


		$v = AduanaMaestraPeer::doSelect($criteria, $con);

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
			$criteria->add(AduanaMaestraPeer::CA_REFERENCIA, $pks, Criteria::IN);
			$objs = AduanaMaestraPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseAduanaMaestraPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseAduanaMaestraPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	Propel::registerMapBuilder('lib.model.aduana.map.AduanaMaestraMapBuilder');
}
