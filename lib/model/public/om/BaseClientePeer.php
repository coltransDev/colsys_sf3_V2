<?php


abstract class BaseClientePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_clientes';

	
	const CLASS_DEFAULT = 'lib.model.public.Cliente';

	
	const NUM_COLUMNS = 25;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDCLIENTE = 'tb_clientes.CA_IDCLIENTE';

	
	const CA_DIGITO = 'tb_clientes.CA_DIGITO';

	
	const CA_COMPANIA = 'tb_clientes.CA_COMPANIA';

	
	const CA_PAPELLIDO = 'tb_clientes.CA_PAPELLIDO';

	
	const CA_SAPELLIDO = 'tb_clientes.CA_SAPELLIDO';

	
	const CA_NOMBRES = 'tb_clientes.CA_NOMBRES';

	
	const CA_SALUDO = 'tb_clientes.CA_SALUDO';

	
	const CA_SEXO = 'tb_clientes.CA_SEXO';

	
	const CA_CUMPLEANOS = 'tb_clientes.CA_CUMPLEANOS';

	
	const CA_OFICINA = 'tb_clientes.CA_OFICINA';

	
	const CA_VENDEDOR = 'tb_clientes.CA_VENDEDOR';

	
	const CA_EMAIL = 'tb_clientes.CA_EMAIL';

	
	const CA_COORDINADOR = 'tb_clientes.CA_COORDINADOR';

	
	const CA_DIRECCION = 'tb_clientes.CA_DIRECCION';

	
	const CA_LOCALIDAD = 'tb_clientes.CA_LOCALIDAD';

	
	const CA_COMPLEMENTO = 'tb_clientes.CA_COMPLEMENTO';

	
	const CA_TELEFONOS = 'tb_clientes.CA_TELEFONOS';

	
	const CA_FAX = 'tb_clientes.CA_FAX';

	
	const CA_PREFERENCIAS = 'tb_clientes.CA_PREFERENCIAS';

	
	const CA_CONFIRMAR = 'tb_clientes.CA_CONFIRMAR';

	
	const CA_IDCIUDAD = 'tb_clientes.CA_IDCIUDAD';

	
	const CA_IDGRUPO = 'tb_clientes.CA_IDGRUPO';

	
	const CA_LISTACLINTON = 'tb_clientes.CA_LISTACLINTON';

	
	const CA_FCHCIRCULAR = 'tb_clientes.CA_FCHCIRCULAR';

	
	const CA_STATUS = 'tb_clientes.CA_STATUS';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcliente', 'CaDigito', 'CaCompania', 'CaPapellido', 'CaSapellido', 'CaNombres', 'CaSaludo', 'CaSexo', 'CaCumpleanos', 'CaOficina', 'CaVendedor', 'CaEmail', 'CaCoordinador', 'CaDireccion', 'CaLocalidad', 'CaComplemento', 'CaTelefonos', 'CaFax', 'CaPreferencias', 'CaConfirmar', 'CaIdciudad', 'CaIdgrupo', 'CaListaclinton', 'CaFchcircular', 'CaStatus', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcliente', 'caDigito', 'caCompania', 'caPapellido', 'caSapellido', 'caNombres', 'caSaludo', 'caSexo', 'caCumpleanos', 'caOficina', 'caVendedor', 'caEmail', 'caCoordinador', 'caDireccion', 'caLocalidad', 'caComplemento', 'caTelefonos', 'caFax', 'caPreferencias', 'caConfirmar', 'caIdciudad', 'caIdgrupo', 'caListaclinton', 'caFchcircular', 'caStatus', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCLIENTE, self::CA_DIGITO, self::CA_COMPANIA, self::CA_PAPELLIDO, self::CA_SAPELLIDO, self::CA_NOMBRES, self::CA_SALUDO, self::CA_SEXO, self::CA_CUMPLEANOS, self::CA_OFICINA, self::CA_VENDEDOR, self::CA_EMAIL, self::CA_COORDINADOR, self::CA_DIRECCION, self::CA_LOCALIDAD, self::CA_COMPLEMENTO, self::CA_TELEFONOS, self::CA_FAX, self::CA_PREFERENCIAS, self::CA_CONFIRMAR, self::CA_IDCIUDAD, self::CA_IDGRUPO, self::CA_LISTACLINTON, self::CA_FCHCIRCULAR, self::CA_STATUS, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcliente', 'ca_digito', 'ca_compania', 'ca_papellido', 'ca_sapellido', 'ca_nombres', 'ca_saludo', 'ca_sexo', 'ca_cumpleanos', 'ca_oficina', 'ca_vendedor', 'ca_email', 'ca_coordinador', 'ca_direccion', 'ca_localidad', 'ca_complemento', 'ca_telefonos', 'ca_fax', 'ca_preferencias', 'ca_confirmar', 'ca_idciudad', 'ca_idgrupo', 'ca_listaclinton', 'ca_fchcircular', 'ca_status', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcliente' => 0, 'CaDigito' => 1, 'CaCompania' => 2, 'CaPapellido' => 3, 'CaSapellido' => 4, 'CaNombres' => 5, 'CaSaludo' => 6, 'CaSexo' => 7, 'CaCumpleanos' => 8, 'CaOficina' => 9, 'CaVendedor' => 10, 'CaEmail' => 11, 'CaCoordinador' => 12, 'CaDireccion' => 13, 'CaLocalidad' => 14, 'CaComplemento' => 15, 'CaTelefonos' => 16, 'CaFax' => 17, 'CaPreferencias' => 18, 'CaConfirmar' => 19, 'CaIdciudad' => 20, 'CaIdgrupo' => 21, 'CaListaclinton' => 22, 'CaFchcircular' => 23, 'CaStatus' => 24, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcliente' => 0, 'caDigito' => 1, 'caCompania' => 2, 'caPapellido' => 3, 'caSapellido' => 4, 'caNombres' => 5, 'caSaludo' => 6, 'caSexo' => 7, 'caCumpleanos' => 8, 'caOficina' => 9, 'caVendedor' => 10, 'caEmail' => 11, 'caCoordinador' => 12, 'caDireccion' => 13, 'caLocalidad' => 14, 'caComplemento' => 15, 'caTelefonos' => 16, 'caFax' => 17, 'caPreferencias' => 18, 'caConfirmar' => 19, 'caIdciudad' => 20, 'caIdgrupo' => 21, 'caListaclinton' => 22, 'caFchcircular' => 23, 'caStatus' => 24, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCLIENTE => 0, self::CA_DIGITO => 1, self::CA_COMPANIA => 2, self::CA_PAPELLIDO => 3, self::CA_SAPELLIDO => 4, self::CA_NOMBRES => 5, self::CA_SALUDO => 6, self::CA_SEXO => 7, self::CA_CUMPLEANOS => 8, self::CA_OFICINA => 9, self::CA_VENDEDOR => 10, self::CA_EMAIL => 11, self::CA_COORDINADOR => 12, self::CA_DIRECCION => 13, self::CA_LOCALIDAD => 14, self::CA_COMPLEMENTO => 15, self::CA_TELEFONOS => 16, self::CA_FAX => 17, self::CA_PREFERENCIAS => 18, self::CA_CONFIRMAR => 19, self::CA_IDCIUDAD => 20, self::CA_IDGRUPO => 21, self::CA_LISTACLINTON => 22, self::CA_FCHCIRCULAR => 23, self::CA_STATUS => 24, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcliente' => 0, 'ca_digito' => 1, 'ca_compania' => 2, 'ca_papellido' => 3, 'ca_sapellido' => 4, 'ca_nombres' => 5, 'ca_saludo' => 6, 'ca_sexo' => 7, 'ca_cumpleanos' => 8, 'ca_oficina' => 9, 'ca_vendedor' => 10, 'ca_email' => 11, 'ca_coordinador' => 12, 'ca_direccion' => 13, 'ca_localidad' => 14, 'ca_complemento' => 15, 'ca_telefonos' => 16, 'ca_fax' => 17, 'ca_preferencias' => 18, 'ca_confirmar' => 19, 'ca_idciudad' => 20, 'ca_idgrupo' => 21, 'ca_listaclinton' => 22, 'ca_fchcircular' => 23, 'ca_status' => 24, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new ClienteMapBuilder();
		}
		return self::$mapBuilder;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(ClientePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ClientePeer::CA_IDCLIENTE);

		$criteria->addSelectColumn(ClientePeer::CA_DIGITO);

		$criteria->addSelectColumn(ClientePeer::CA_COMPANIA);

		$criteria->addSelectColumn(ClientePeer::CA_PAPELLIDO);

		$criteria->addSelectColumn(ClientePeer::CA_SAPELLIDO);

		$criteria->addSelectColumn(ClientePeer::CA_NOMBRES);

		$criteria->addSelectColumn(ClientePeer::CA_SALUDO);

		$criteria->addSelectColumn(ClientePeer::CA_SEXO);

		$criteria->addSelectColumn(ClientePeer::CA_CUMPLEANOS);

		$criteria->addSelectColumn(ClientePeer::CA_OFICINA);

		$criteria->addSelectColumn(ClientePeer::CA_VENDEDOR);

		$criteria->addSelectColumn(ClientePeer::CA_EMAIL);

		$criteria->addSelectColumn(ClientePeer::CA_COORDINADOR);

		$criteria->addSelectColumn(ClientePeer::CA_DIRECCION);

		$criteria->addSelectColumn(ClientePeer::CA_LOCALIDAD);

		$criteria->addSelectColumn(ClientePeer::CA_COMPLEMENTO);

		$criteria->addSelectColumn(ClientePeer::CA_TELEFONOS);

		$criteria->addSelectColumn(ClientePeer::CA_FAX);

		$criteria->addSelectColumn(ClientePeer::CA_PREFERENCIAS);

		$criteria->addSelectColumn(ClientePeer::CA_CONFIRMAR);

		$criteria->addSelectColumn(ClientePeer::CA_IDCIUDAD);

		$criteria->addSelectColumn(ClientePeer::CA_IDGRUPO);

		$criteria->addSelectColumn(ClientePeer::CA_LISTACLINTON);

		$criteria->addSelectColumn(ClientePeer::CA_FCHCIRCULAR);

		$criteria->addSelectColumn(ClientePeer::CA_STATUS);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(ClientePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ClientePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseClientePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseClientePeer', $criteria, $con);
    }


				$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}
	
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = ClientePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return ClientePeer::populateObjects(ClientePeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseClientePeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseClientePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			ClientePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(Cliente $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdcliente();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Cliente) {
				$key = (string) $value->getCaIdcliente();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Cliente object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} 
	
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; 	}
	
	
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
				if ($row[$startcol + 0] === null) {
			return null;
		}
		return (string) $row[$startcol + 0];
	}

	
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
				$cls = ClientePeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = ClientePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = ClientePeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				ClientePeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinCiudad(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(ClientePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ClientePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(ClientePeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);


    foreach (sfMixer::getCallables('BaseClientePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseClientePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinCiudad(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseClientePeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseClientePeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ClientePeer::addSelectColumns($c);
		$startcol = (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS);
		CiudadPeer::addSelectColumns($c);

		$c->addJoin(array(ClientePeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ClientePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ClientePeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = ClientePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ClientePeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = CiudadPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = CiudadPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = CiudadPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					CiudadPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addCliente($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(ClientePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ClientePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(ClientePeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);

    foreach (sfMixer::getCallables('BaseClientePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseClientePeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}

	
	public static function doSelectJoinAll(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseClientePeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseClientePeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ClientePeer::addSelectColumns($c);
		$startcol2 = (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS);

		CiudadPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CiudadPeer::NUM_COLUMNS - CiudadPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(ClientePeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ClientePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ClientePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = ClientePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ClientePeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = CiudadPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = CiudadPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = CiudadPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					CiudadPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addCliente($obj1);
			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


  static public function getUniqueColumnNames()
  {
    return array();
  }
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return ClientePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseClientePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseClientePeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(ClientePeer::CA_IDCLIENTE) && $criteria->keyContainsValue(ClientePeer::CA_IDCLIENTE) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.ClientePeer::CA_IDCLIENTE.')');
		}


				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseClientePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseClientePeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseClientePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseClientePeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(ClientePeer::CA_IDCLIENTE);
			$selectCriteria->add(ClientePeer::CA_IDCLIENTE, $criteria->remove(ClientePeer::CA_IDCLIENTE), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseClientePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseClientePeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(ClientePeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												ClientePeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof Cliente) {
						ClientePeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ClientePeer::CA_IDCLIENTE, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								ClientePeer::removeInstanceFromPool($singleval);
			}
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->beginTransaction();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);

			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	public static function doValidate(Cliente $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ClientePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ClientePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ClientePeer::DATABASE_NAME, ClientePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ClientePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = ClientePeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		$criteria->add(ClientePeer::CA_IDCLIENTE, $pk);

		$v = ClientePeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
			$criteria->add(ClientePeer::CA_IDCLIENTE, $pks, Criteria::IN);
			$objs = ClientePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseClientePeer::DATABASE_NAME)->addTableBuilder(BaseClientePeer::TABLE_NAME, BaseClientePeer::getMapBuilder());

