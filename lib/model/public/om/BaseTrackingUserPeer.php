<?php


abstract class BaseTrackingUserPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_tracking_users';

	
	const CLASS_DEFAULT = 'lib.model.public.TrackingUser';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_EMAIL = 'tb_tracking_users.CA_EMAIL';

	
	const CA_BLOCKED = 'tb_tracking_users.CA_BLOCKED';

	
	const CA_ACTIVATION_CODE = 'tb_tracking_users.CA_ACTIVATION_CODE';

	
	const CA_PASSWD = 'tb_tracking_users.CA_PASSWD';

	
	const CA_PASSWORD_EXPIRY = 'tb_tracking_users.CA_PASSWORD_EXPIRY';

	
	const CA_ACTIVATED = 'tb_tracking_users.CA_ACTIVATED';

	
	const CA_IDCONTACTO = 'tb_tracking_users.CA_IDCONTACTO';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaEmail', 'CaBlocked', 'CaActivationCode', 'CaPasswd', 'CaPasswordExpiry', 'CaActivated', 'CaIdcontacto', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caEmail', 'caBlocked', 'caActivationCode', 'caPasswd', 'caPasswordExpiry', 'caActivated', 'caIdcontacto', ),
		BasePeer::TYPE_COLNAME => array (self::CA_EMAIL, self::CA_BLOCKED, self::CA_ACTIVATION_CODE, self::CA_PASSWD, self::CA_PASSWORD_EXPIRY, self::CA_ACTIVATED, self::CA_IDCONTACTO, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_email', 'ca_blocked', 'ca_activation_code', 'ca_passwd', 'ca_password_expiry', 'ca_activated', 'ca_idcontacto', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaEmail' => 0, 'CaBlocked' => 1, 'CaActivationCode' => 2, 'CaPasswd' => 3, 'CaPasswordExpiry' => 4, 'CaActivated' => 5, 'CaIdcontacto' => 6, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caEmail' => 0, 'caBlocked' => 1, 'caActivationCode' => 2, 'caPasswd' => 3, 'caPasswordExpiry' => 4, 'caActivated' => 5, 'caIdcontacto' => 6, ),
		BasePeer::TYPE_COLNAME => array (self::CA_EMAIL => 0, self::CA_BLOCKED => 1, self::CA_ACTIVATION_CODE => 2, self::CA_PASSWD => 3, self::CA_PASSWORD_EXPIRY => 4, self::CA_ACTIVATED => 5, self::CA_IDCONTACTO => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_email' => 0, 'ca_blocked' => 1, 'ca_activation_code' => 2, 'ca_passwd' => 3, 'ca_password_expiry' => 4, 'ca_activated' => 5, 'ca_idcontacto' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new TrackingUserMapBuilder();
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
		return str_replace(TrackingUserPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(TrackingUserPeer::CA_EMAIL);

		$criteria->addSelectColumn(TrackingUserPeer::CA_BLOCKED);

		$criteria->addSelectColumn(TrackingUserPeer::CA_ACTIVATION_CODE);

		$criteria->addSelectColumn(TrackingUserPeer::CA_PASSWD);

		$criteria->addSelectColumn(TrackingUserPeer::CA_PASSWORD_EXPIRY);

		$criteria->addSelectColumn(TrackingUserPeer::CA_ACTIVATED);

		$criteria->addSelectColumn(TrackingUserPeer::CA_IDCONTACTO);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(TrackingUserPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TrackingUserPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(TrackingUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseTrackingUserPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseTrackingUserPeer', $criteria, $con);
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
		$objects = TrackingUserPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return TrackingUserPeer::populateObjects(TrackingUserPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTrackingUserPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseTrackingUserPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(TrackingUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			TrackingUserPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(TrackingUser $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaEmail();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof TrackingUser) {
				$key = (string) $value->getCaEmail();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or TrackingUser object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = TrackingUserPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = TrackingUserPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = TrackingUserPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				TrackingUserPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinContacto(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(TrackingUserPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TrackingUserPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(TrackingUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(TrackingUserPeer::CA_IDCONTACTO,), array(ContactoPeer::CA_IDCONTACTO,), $join_behavior);


    foreach (sfMixer::getCallables('BaseTrackingUserPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseTrackingUserPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinContacto(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseTrackingUserPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseTrackingUserPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		TrackingUserPeer::addSelectColumns($c);
		$startcol = (TrackingUserPeer::NUM_COLUMNS - TrackingUserPeer::NUM_LAZY_LOAD_COLUMNS);
		ContactoPeer::addSelectColumns($c);

		$c->addJoin(array(TrackingUserPeer::CA_IDCONTACTO,), array(ContactoPeer::CA_IDCONTACTO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = TrackingUserPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = TrackingUserPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = TrackingUserPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				TrackingUserPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = ContactoPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = ContactoPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ContactoPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					ContactoPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addTrackingUser($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(TrackingUserPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TrackingUserPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(TrackingUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(TrackingUserPeer::CA_IDCONTACTO,), array(ContactoPeer::CA_IDCONTACTO,), $join_behavior);

    foreach (sfMixer::getCallables('BaseTrackingUserPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseTrackingUserPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseTrackingUserPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseTrackingUserPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		TrackingUserPeer::addSelectColumns($c);
		$startcol2 = (TrackingUserPeer::NUM_COLUMNS - TrackingUserPeer::NUM_LAZY_LOAD_COLUMNS);

		ContactoPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ContactoPeer::NUM_COLUMNS - ContactoPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(TrackingUserPeer::CA_IDCONTACTO,), array(ContactoPeer::CA_IDCONTACTO,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = TrackingUserPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = TrackingUserPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = TrackingUserPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				TrackingUserPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = ContactoPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = ContactoPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ContactoPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ContactoPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addTrackingUser($obj1);
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
		return TrackingUserPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTrackingUserPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseTrackingUserPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(TrackingUserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseTrackingUserPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseTrackingUserPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTrackingUserPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseTrackingUserPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(TrackingUserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(TrackingUserPeer::CA_EMAIL);
			$selectCriteria->add(TrackingUserPeer::CA_EMAIL, $criteria->remove(TrackingUserPeer::CA_EMAIL), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseTrackingUserPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseTrackingUserPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(TrackingUserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(TrackingUserPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(TrackingUserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												TrackingUserPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof TrackingUser) {
						TrackingUserPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(TrackingUserPeer::CA_EMAIL, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								TrackingUserPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(TrackingUser $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(TrackingUserPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(TrackingUserPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(TrackingUserPeer::DATABASE_NAME, TrackingUserPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = TrackingUserPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = TrackingUserPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(TrackingUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(TrackingUserPeer::DATABASE_NAME);
		$criteria->add(TrackingUserPeer::CA_EMAIL, $pk);

		$v = TrackingUserPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(TrackingUserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(TrackingUserPeer::DATABASE_NAME);
			$criteria->add(TrackingUserPeer::CA_EMAIL, $pks, Criteria::IN);
			$objs = TrackingUserPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseTrackingUserPeer::DATABASE_NAME)->addTableBuilder(BaseTrackingUserPeer::TABLE_NAME, BaseTrackingUserPeer::getMapBuilder());

