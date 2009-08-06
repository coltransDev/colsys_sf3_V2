<?php


abstract class BaseUsuarioPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'control.tb_usuarios';

	
	const CLASS_DEFAULT = 'lib.model.control.Usuario';

	
	const NUM_COLUMNS = 14;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_LOGIN = 'control.tb_usuarios.CA_LOGIN';

	
	const CA_NOMBRE = 'control.tb_usuarios.CA_NOMBRE';

	
	const CA_CARGO = 'control.tb_usuarios.CA_CARGO';

	
	const CA_DEPARTAMENTO = 'control.tb_usuarios.CA_DEPARTAMENTO';

	
	const CA_IDSUCURSAL = 'control.tb_usuarios.CA_IDSUCURSAL';

	
	const CA_EMAIL = 'control.tb_usuarios.CA_EMAIL';

	
	const CA_RUTINAS = 'control.tb_usuarios.CA_RUTINAS';

	
	const CA_EXTENSION = 'control.tb_usuarios.CA_EXTENSION';

	
	const CA_AUTHMETHOD = 'control.tb_usuarios.CA_AUTHMETHOD';

	
	const CA_PASSWD = 'control.tb_usuarios.CA_PASSWD';

	
	const CA_SALT = 'control.tb_usuarios.CA_SALT';

	
	const CA_ACTIVO = 'control.tb_usuarios.CA_ACTIVO';

	
	const CA_FORCECHANGE = 'control.tb_usuarios.CA_FORCECHANGE';

	
	const CA_SUCURSAL = 'control.tb_usuarios.CA_SUCURSAL';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaLogin', 'CaNombre', 'CaCargo', 'CaDepartamento', 'CaIdsucursal', 'CaEmail', 'CaRutinas', 'CaExtension', 'CaAuthmethod', 'CaPasswd', 'CaSalt', 'CaActivo', 'CaForcechange', 'CaSucursal', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caLogin', 'caNombre', 'caCargo', 'caDepartamento', 'caIdsucursal', 'caEmail', 'caRutinas', 'caExtension', 'caAuthmethod', 'caPasswd', 'caSalt', 'caActivo', 'caForcechange', 'caSucursal', ),
		BasePeer::TYPE_COLNAME => array (self::CA_LOGIN, self::CA_NOMBRE, self::CA_CARGO, self::CA_DEPARTAMENTO, self::CA_IDSUCURSAL, self::CA_EMAIL, self::CA_RUTINAS, self::CA_EXTENSION, self::CA_AUTHMETHOD, self::CA_PASSWD, self::CA_SALT, self::CA_ACTIVO, self::CA_FORCECHANGE, self::CA_SUCURSAL, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_login', 'ca_nombre', 'ca_cargo', 'ca_departamento', 'ca_idsucursal', 'ca_email', 'ca_rutinas', 'ca_extension', 'ca_authmethod', 'ca_passwd', 'ca_salt', 'ca_activo', 'ca_forcechange', 'ca_sucursal', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaLogin' => 0, 'CaNombre' => 1, 'CaCargo' => 2, 'CaDepartamento' => 3, 'CaIdsucursal' => 4, 'CaEmail' => 5, 'CaRutinas' => 6, 'CaExtension' => 7, 'CaAuthmethod' => 8, 'CaPasswd' => 9, 'CaSalt' => 10, 'CaActivo' => 11, 'CaForcechange' => 12, 'CaSucursal' => 13, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caLogin' => 0, 'caNombre' => 1, 'caCargo' => 2, 'caDepartamento' => 3, 'caIdsucursal' => 4, 'caEmail' => 5, 'caRutinas' => 6, 'caExtension' => 7, 'caAuthmethod' => 8, 'caPasswd' => 9, 'caSalt' => 10, 'caActivo' => 11, 'caForcechange' => 12, 'caSucursal' => 13, ),
		BasePeer::TYPE_COLNAME => array (self::CA_LOGIN => 0, self::CA_NOMBRE => 1, self::CA_CARGO => 2, self::CA_DEPARTAMENTO => 3, self::CA_IDSUCURSAL => 4, self::CA_EMAIL => 5, self::CA_RUTINAS => 6, self::CA_EXTENSION => 7, self::CA_AUTHMETHOD => 8, self::CA_PASSWD => 9, self::CA_SALT => 10, self::CA_ACTIVO => 11, self::CA_FORCECHANGE => 12, self::CA_SUCURSAL => 13, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_login' => 0, 'ca_nombre' => 1, 'ca_cargo' => 2, 'ca_departamento' => 3, 'ca_idsucursal' => 4, 'ca_email' => 5, 'ca_rutinas' => 6, 'ca_extension' => 7, 'ca_authmethod' => 8, 'ca_passwd' => 9, 'ca_salt' => 10, 'ca_activo' => 11, 'ca_forcechange' => 12, 'ca_sucursal' => 13, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new UsuarioMapBuilder();
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
		return str_replace(UsuarioPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(UsuarioPeer::CA_LOGIN);

		$criteria->addSelectColumn(UsuarioPeer::CA_NOMBRE);

		$criteria->addSelectColumn(UsuarioPeer::CA_CARGO);

		$criteria->addSelectColumn(UsuarioPeer::CA_DEPARTAMENTO);

		$criteria->addSelectColumn(UsuarioPeer::CA_IDSUCURSAL);

		$criteria->addSelectColumn(UsuarioPeer::CA_EMAIL);

		$criteria->addSelectColumn(UsuarioPeer::CA_RUTINAS);

		$criteria->addSelectColumn(UsuarioPeer::CA_EXTENSION);

		$criteria->addSelectColumn(UsuarioPeer::CA_AUTHMETHOD);

		$criteria->addSelectColumn(UsuarioPeer::CA_PASSWD);

		$criteria->addSelectColumn(UsuarioPeer::CA_SALT);

		$criteria->addSelectColumn(UsuarioPeer::CA_ACTIVO);

		$criteria->addSelectColumn(UsuarioPeer::CA_FORCECHANGE);

		$criteria->addSelectColumn(UsuarioPeer::CA_SUCURSAL);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(UsuarioPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			UsuarioPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseUsuarioPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseUsuarioPeer', $criteria, $con);
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
		$objects = UsuarioPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return UsuarioPeer::populateObjects(UsuarioPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseUsuarioPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseUsuarioPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			UsuarioPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(Usuario $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaLogin();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Usuario) {
				$key = (string) $value->getCaLogin();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Usuario object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = UsuarioPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = UsuarioPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = UsuarioPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				UsuarioPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinSucursal(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(UsuarioPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			UsuarioPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(UsuarioPeer::CA_IDSUCURSAL,), array(SucursalPeer::CA_IDSUCURSAL,), $join_behavior);


    foreach (sfMixer::getCallables('BaseUsuarioPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseUsuarioPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinSucursal(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseUsuarioPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseUsuarioPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		UsuarioPeer::addSelectColumns($c);
		$startcol = (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);
		SucursalPeer::addSelectColumns($c);

		$c->addJoin(array(UsuarioPeer::CA_IDSUCURSAL,), array(SucursalPeer::CA_IDSUCURSAL,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = UsuarioPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = UsuarioPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = UsuarioPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				UsuarioPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = SucursalPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = SucursalPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = SucursalPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					SucursalPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addUsuario($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(UsuarioPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			UsuarioPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(UsuarioPeer::CA_IDSUCURSAL,), array(SucursalPeer::CA_IDSUCURSAL,), $join_behavior);

    foreach (sfMixer::getCallables('BaseUsuarioPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseUsuarioPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseUsuarioPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseUsuarioPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		UsuarioPeer::addSelectColumns($c);
		$startcol2 = (UsuarioPeer::NUM_COLUMNS - UsuarioPeer::NUM_LAZY_LOAD_COLUMNS);

		SucursalPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (SucursalPeer::NUM_COLUMNS - SucursalPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(UsuarioPeer::CA_IDSUCURSAL,), array(SucursalPeer::CA_IDSUCURSAL,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = UsuarioPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = UsuarioPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = UsuarioPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				UsuarioPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = SucursalPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = SucursalPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = SucursalPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					SucursalPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addUsuario($obj1);
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
		return UsuarioPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseUsuarioPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseUsuarioPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}


				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseUsuarioPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseUsuarioPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseUsuarioPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseUsuarioPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(UsuarioPeer::CA_LOGIN);
			$selectCriteria->add(UsuarioPeer::CA_LOGIN, $criteria->remove(UsuarioPeer::CA_LOGIN), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseUsuarioPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseUsuarioPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(UsuarioPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												UsuarioPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof Usuario) {
						UsuarioPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(UsuarioPeer::CA_LOGIN, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								UsuarioPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(Usuario $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(UsuarioPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(UsuarioPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(UsuarioPeer::DATABASE_NAME, UsuarioPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = UsuarioPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = UsuarioPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		$criteria->add(UsuarioPeer::CA_LOGIN, $pk);

		$v = UsuarioPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
			$criteria->add(UsuarioPeer::CA_LOGIN, $pks, Criteria::IN);
			$objs = UsuarioPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseUsuarioPeer::DATABASE_NAME)->addTableBuilder(BaseUsuarioPeer::TABLE_NAME, BaseUsuarioPeer::getMapBuilder());

