<?php


abstract class BaseEmailAttachmentPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_attachments';

	
	const CLASS_DEFAULT = 'lib.model.public.EmailAttachment';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDATTACHMENT = 'tb_attachments.CA_IDATTACHMENT';

	
	const CA_IDEMAIL = 'tb_attachments.CA_IDEMAIL';

	
	const CA_EXTENSION = 'tb_attachments.CA_EXTENSION';

	
	const CA_HEADER_FILE = 'tb_attachments.CA_HEADER_FILE';

	
	const CA_FILESIZE = 'tb_attachments.CA_FILESIZE';

	
	const CA_CONTENT = 'tb_attachments.CA_CONTENT';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdattachment', 'CaIdemail', 'CaExtension', 'CaHeaderFile', 'CaFilesize', 'CaContent', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdattachment', 'caIdemail', 'caExtension', 'caHeaderFile', 'caFilesize', 'caContent', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDATTACHMENT, self::CA_IDEMAIL, self::CA_EXTENSION, self::CA_HEADER_FILE, self::CA_FILESIZE, self::CA_CONTENT, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idattachment', 'ca_idemail', 'ca_extension', 'ca_header_file', 'ca_filesize', 'ca_content', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdattachment' => 0, 'CaIdemail' => 1, 'CaExtension' => 2, 'CaHeaderFile' => 3, 'CaFilesize' => 4, 'CaContent' => 5, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdattachment' => 0, 'caIdemail' => 1, 'caExtension' => 2, 'caHeaderFile' => 3, 'caFilesize' => 4, 'caContent' => 5, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDATTACHMENT => 0, self::CA_IDEMAIL => 1, self::CA_EXTENSION => 2, self::CA_HEADER_FILE => 3, self::CA_FILESIZE => 4, self::CA_CONTENT => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idattachment' => 0, 'ca_idemail' => 1, 'ca_extension' => 2, 'ca_header_file' => 3, 'ca_filesize' => 4, 'ca_content' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new EmailAttachmentMapBuilder();
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
		return str_replace(EmailAttachmentPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EmailAttachmentPeer::CA_IDATTACHMENT);

		$criteria->addSelectColumn(EmailAttachmentPeer::CA_IDEMAIL);

		$criteria->addSelectColumn(EmailAttachmentPeer::CA_EXTENSION);

		$criteria->addSelectColumn(EmailAttachmentPeer::CA_HEADER_FILE);

		$criteria->addSelectColumn(EmailAttachmentPeer::CA_FILESIZE);

		$criteria->addSelectColumn(EmailAttachmentPeer::CA_CONTENT);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(EmailAttachmentPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			EmailAttachmentPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(EmailAttachmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseEmailAttachmentPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseEmailAttachmentPeer', $criteria, $con);
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
		$objects = EmailAttachmentPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return EmailAttachmentPeer::populateObjects(EmailAttachmentPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseEmailAttachmentPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseEmailAttachmentPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(EmailAttachmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			EmailAttachmentPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(EmailAttachment $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdattachment();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof EmailAttachment) {
				$key = (string) $value->getCaIdattachment();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or EmailAttachment object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = EmailAttachmentPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = EmailAttachmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = EmailAttachmentPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				EmailAttachmentPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinEmail(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(EmailAttachmentPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			EmailAttachmentPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(EmailAttachmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(EmailAttachmentPeer::CA_IDEMAIL,), array(EmailPeer::CA_IDEMAIL,), $join_behavior);


    foreach (sfMixer::getCallables('BaseEmailAttachmentPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseEmailAttachmentPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinEmail(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseEmailAttachmentPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseEmailAttachmentPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EmailAttachmentPeer::addSelectColumns($c);
		$startcol = (EmailAttachmentPeer::NUM_COLUMNS - EmailAttachmentPeer::NUM_LAZY_LOAD_COLUMNS);
		EmailPeer::addSelectColumns($c);

		$c->addJoin(array(EmailAttachmentPeer::CA_IDEMAIL,), array(EmailPeer::CA_IDEMAIL,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = EmailAttachmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = EmailAttachmentPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = EmailAttachmentPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				EmailAttachmentPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = EmailPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = EmailPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = EmailPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					EmailPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addEmailAttachment($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(EmailAttachmentPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			EmailAttachmentPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(EmailAttachmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(EmailAttachmentPeer::CA_IDEMAIL,), array(EmailPeer::CA_IDEMAIL,), $join_behavior);

    foreach (sfMixer::getCallables('BaseEmailAttachmentPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseEmailAttachmentPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseEmailAttachmentPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseEmailAttachmentPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		EmailAttachmentPeer::addSelectColumns($c);
		$startcol2 = (EmailAttachmentPeer::NUM_COLUMNS - EmailAttachmentPeer::NUM_LAZY_LOAD_COLUMNS);

		EmailPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (EmailPeer::NUM_COLUMNS - EmailPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(EmailAttachmentPeer::CA_IDEMAIL,), array(EmailPeer::CA_IDEMAIL,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = EmailAttachmentPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = EmailAttachmentPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = EmailAttachmentPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				EmailAttachmentPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = EmailPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = EmailPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = EmailPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					EmailPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addEmailAttachment($obj1);
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
		return EmailAttachmentPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseEmailAttachmentPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseEmailAttachmentPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(EmailAttachmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(EmailAttachmentPeer::CA_IDATTACHMENT) && $criteria->keyContainsValue(EmailAttachmentPeer::CA_IDATTACHMENT) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.EmailAttachmentPeer::CA_IDATTACHMENT.')');
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

		
    foreach (sfMixer::getCallables('BaseEmailAttachmentPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseEmailAttachmentPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseEmailAttachmentPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseEmailAttachmentPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(EmailAttachmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(EmailAttachmentPeer::CA_IDATTACHMENT);
			$selectCriteria->add(EmailAttachmentPeer::CA_IDATTACHMENT, $criteria->remove(EmailAttachmentPeer::CA_IDATTACHMENT), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseEmailAttachmentPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseEmailAttachmentPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(EmailAttachmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(EmailAttachmentPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(EmailAttachmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												EmailAttachmentPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof EmailAttachment) {
						EmailAttachmentPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(EmailAttachmentPeer::CA_IDATTACHMENT, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								EmailAttachmentPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(EmailAttachment $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EmailAttachmentPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EmailAttachmentPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EmailAttachmentPeer::DATABASE_NAME, EmailAttachmentPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EmailAttachmentPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = EmailAttachmentPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(EmailAttachmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(EmailAttachmentPeer::DATABASE_NAME);
		$criteria->add(EmailAttachmentPeer::CA_IDATTACHMENT, $pk);

		$v = EmailAttachmentPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(EmailAttachmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(EmailAttachmentPeer::DATABASE_NAME);
			$criteria->add(EmailAttachmentPeer::CA_IDATTACHMENT, $pks, Criteria::IN);
			$objs = EmailAttachmentPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseEmailAttachmentPeer::DATABASE_NAME)->addTableBuilder(BaseEmailAttachmentPeer::TABLE_NAME, BaseEmailAttachmentPeer::getMapBuilder());

