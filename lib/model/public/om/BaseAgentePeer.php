<?php


abstract class BaseAgentePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_agentes';

	
	const CLASS_DEFAULT = 'lib.model.public.Agente';

	
	const NUM_COLUMNS = 15;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDAGENTE = 'tb_agentes.CA_IDAGENTE';

	
	const CA_NOMBRE = 'tb_agentes.CA_NOMBRE';

	
	const CA_DIRECCION = 'tb_agentes.CA_DIRECCION';

	
	const CA_TELEFONOS = 'tb_agentes.CA_TELEFONOS';

	
	const CA_FAX = 'tb_agentes.CA_FAX';

	
	const CA_IDCIUDAD = 'tb_agentes.CA_IDCIUDAD';

	
	const CA_ZIPCODE = 'tb_agentes.CA_ZIPCODE';

	
	const CA_WEBSITE = 'tb_agentes.CA_WEBSITE';

	
	const CA_EMAIL = 'tb_agentes.CA_EMAIL';

	
	const CA_TIPO = 'tb_agentes.CA_TIPO';

	
	const CA_ACTIVO = 'tb_agentes.CA_ACTIVO';

	
	const CA_FCHCREADO = 'tb_agentes.CA_FCHCREADO';

	
	const CA_FCHACTUALIZADO = 'tb_agentes.CA_FCHACTUALIZADO';

	
	const CA_USUCREADO = 'tb_agentes.CA_USUCREADO';

	
	const CA_USUACTUALIZADO = 'tb_agentes.CA_USUACTUALIZADO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdagente', 'CaNombre', 'CaDireccion', 'CaTelefonos', 'CaFax', 'CaIdciudad', 'CaZipcode', 'CaWebsite', 'CaEmail', 'CaTipo', 'CaActivo', 'CaFchcreado', 'CaFchactualizado', 'CaUsucreado', 'CaUsuactualizado', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdagente', 'caNombre', 'caDireccion', 'caTelefonos', 'caFax', 'caIdciudad', 'caZipcode', 'caWebsite', 'caEmail', 'caTipo', 'caActivo', 'caFchcreado', 'caFchactualizado', 'caUsucreado', 'caUsuactualizado', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDAGENTE, self::CA_NOMBRE, self::CA_DIRECCION, self::CA_TELEFONOS, self::CA_FAX, self::CA_IDCIUDAD, self::CA_ZIPCODE, self::CA_WEBSITE, self::CA_EMAIL, self::CA_TIPO, self::CA_ACTIVO, self::CA_FCHCREADO, self::CA_FCHACTUALIZADO, self::CA_USUCREADO, self::CA_USUACTUALIZADO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idagente', 'ca_nombre', 'ca_direccion', 'ca_telefonos', 'ca_fax', 'ca_idciudad', 'ca_zipcode', 'ca_website', 'ca_email', 'ca_tipo', 'ca_activo', 'ca_fchcreado', 'ca_fchactualizado', 'ca_usucreado', 'ca_usuactualizado', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdagente' => 0, 'CaNombre' => 1, 'CaDireccion' => 2, 'CaTelefonos' => 3, 'CaFax' => 4, 'CaIdciudad' => 5, 'CaZipcode' => 6, 'CaWebsite' => 7, 'CaEmail' => 8, 'CaTipo' => 9, 'CaActivo' => 10, 'CaFchcreado' => 11, 'CaFchactualizado' => 12, 'CaUsucreado' => 13, 'CaUsuactualizado' => 14, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdagente' => 0, 'caNombre' => 1, 'caDireccion' => 2, 'caTelefonos' => 3, 'caFax' => 4, 'caIdciudad' => 5, 'caZipcode' => 6, 'caWebsite' => 7, 'caEmail' => 8, 'caTipo' => 9, 'caActivo' => 10, 'caFchcreado' => 11, 'caFchactualizado' => 12, 'caUsucreado' => 13, 'caUsuactualizado' => 14, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDAGENTE => 0, self::CA_NOMBRE => 1, self::CA_DIRECCION => 2, self::CA_TELEFONOS => 3, self::CA_FAX => 4, self::CA_IDCIUDAD => 5, self::CA_ZIPCODE => 6, self::CA_WEBSITE => 7, self::CA_EMAIL => 8, self::CA_TIPO => 9, self::CA_ACTIVO => 10, self::CA_FCHCREADO => 11, self::CA_FCHACTUALIZADO => 12, self::CA_USUCREADO => 13, self::CA_USUACTUALIZADO => 14, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idagente' => 0, 'ca_nombre' => 1, 'ca_direccion' => 2, 'ca_telefonos' => 3, 'ca_fax' => 4, 'ca_idciudad' => 5, 'ca_zipcode' => 6, 'ca_website' => 7, 'ca_email' => 8, 'ca_tipo' => 9, 'ca_activo' => 10, 'ca_fchcreado' => 11, 'ca_fchactualizado' => 12, 'ca_usucreado' => 13, 'ca_usuactualizado' => 14, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new AgenteMapBuilder();
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
		return str_replace(AgentePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(AgentePeer::CA_IDAGENTE);

		$criteria->addSelectColumn(AgentePeer::CA_NOMBRE);

		$criteria->addSelectColumn(AgentePeer::CA_DIRECCION);

		$criteria->addSelectColumn(AgentePeer::CA_TELEFONOS);

		$criteria->addSelectColumn(AgentePeer::CA_FAX);

		$criteria->addSelectColumn(AgentePeer::CA_IDCIUDAD);

		$criteria->addSelectColumn(AgentePeer::CA_ZIPCODE);

		$criteria->addSelectColumn(AgentePeer::CA_WEBSITE);

		$criteria->addSelectColumn(AgentePeer::CA_EMAIL);

		$criteria->addSelectColumn(AgentePeer::CA_TIPO);

		$criteria->addSelectColumn(AgentePeer::CA_ACTIVO);

		$criteria->addSelectColumn(AgentePeer::CA_FCHCREADO);

		$criteria->addSelectColumn(AgentePeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(AgentePeer::CA_USUCREADO);

		$criteria->addSelectColumn(AgentePeer::CA_USUACTUALIZADO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(AgentePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AgentePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(AgentePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseAgentePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseAgentePeer', $criteria, $con);
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
		$objects = AgentePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return AgentePeer::populateObjects(AgentePeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAgentePeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseAgentePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(AgentePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			AgentePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(Agente $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdagente();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Agente) {
				$key = (string) $value->getCaIdagente();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Agente object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = AgentePeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = AgentePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = AgentePeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				AgentePeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinCiudad(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(AgentePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AgentePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AgentePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(AgentePeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);


    foreach (sfMixer::getCallables('BaseAgentePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseAgentePeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseAgentePeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseAgentePeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AgentePeer::addSelectColumns($c);
		$startcol = (AgentePeer::NUM_COLUMNS - AgentePeer::NUM_LAZY_LOAD_COLUMNS);
		CiudadPeer::addSelectColumns($c);

		$c->addJoin(array(AgentePeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AgentePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AgentePeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = AgentePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				AgentePeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addAgente($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(AgentePeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			AgentePeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(AgentePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(AgentePeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);

    foreach (sfMixer::getCallables('BaseAgentePeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseAgentePeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseAgentePeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseAgentePeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		AgentePeer::addSelectColumns($c);
		$startcol2 = (AgentePeer::NUM_COLUMNS - AgentePeer::NUM_LAZY_LOAD_COLUMNS);

		CiudadPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (CiudadPeer::NUM_COLUMNS - CiudadPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(AgentePeer::CA_IDCIUDAD,), array(CiudadPeer::CA_IDCIUDAD,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = AgentePeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = AgentePeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = AgentePeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				AgentePeer::addInstanceToPool($obj1, $key1);
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
								$obj2->addAgente($obj1);
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
		return AgentePeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAgentePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseAgentePeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(AgentePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(AgentePeer::CA_IDAGENTE) && $criteria->keyContainsValue(AgentePeer::CA_IDAGENTE) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.AgentePeer::CA_IDAGENTE.')');
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

		
    foreach (sfMixer::getCallables('BaseAgentePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseAgentePeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAgentePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseAgentePeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(AgentePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(AgentePeer::CA_IDAGENTE);
			$selectCriteria->add(AgentePeer::CA_IDAGENTE, $criteria->remove(AgentePeer::CA_IDAGENTE), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseAgentePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseAgentePeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(AgentePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(AgentePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(AgentePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												AgentePeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof Agente) {
						AgentePeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(AgentePeer::CA_IDAGENTE, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								AgentePeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(Agente $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(AgentePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(AgentePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(AgentePeer::DATABASE_NAME, AgentePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = AgentePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = AgentePeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(AgentePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(AgentePeer::DATABASE_NAME);
		$criteria->add(AgentePeer::CA_IDAGENTE, $pk);

		$v = AgentePeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(AgentePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(AgentePeer::DATABASE_NAME);
			$criteria->add(AgentePeer::CA_IDAGENTE, $pks, Criteria::IN);
			$objs = AgentePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseAgentePeer::DATABASE_NAME)->addTableBuilder(BaseAgentePeer::TABLE_NAME, BaseAgentePeer::getMapBuilder());

