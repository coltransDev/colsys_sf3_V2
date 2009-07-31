<?php


abstract class BaseEmailPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_emails';

	
	const CLASS_DEFAULT = 'lib.model.public.Email';

	
	const NUM_COLUMNS = 15;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDEMAIL = 'tb_emails.CA_IDEMAIL';

	
	const CA_FCHENVIO = 'tb_emails.CA_FCHENVIO';

	
	const CA_USUENVIO = 'tb_emails.CA_USUENVIO';

	
	const CA_TIPO = 'tb_emails.CA_TIPO';

	
	const CA_IDCASO = 'tb_emails.CA_IDCASO';

	
	const CA_FROM = 'tb_emails.CA_FROM';

	
	const CA_FROMNAME = 'tb_emails.CA_FROMNAME';

	
	const CA_CC = 'tb_emails.CA_CC';

	
	const CA_REPLYTO = 'tb_emails.CA_REPLYTO';

	
	const CA_ADDRESS = 'tb_emails.CA_ADDRESS';

	
	const CA_ATTACHMENT = 'tb_emails.CA_ATTACHMENT';

	
	const CA_SUBJECT = 'tb_emails.CA_SUBJECT';

	
	const CA_BODY = 'tb_emails.CA_BODY';

	
	const CA_BODYHTML = 'tb_emails.CA_BODYHTML';

	
	const CA_READRECEIPT = 'tb_emails.CA_READRECEIPT';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdemail', 'CaFchenvio', 'CaUsuenvio', 'CaTipo', 'CaIdcaso', 'CaFrom', 'CaFromname', 'CaCc', 'CaReplyto', 'CaAddress', 'CaAttachment', 'CaSubject', 'CaBody', 'CaBodyhtml', 'CaReadreceipt', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdemail', 'caFchenvio', 'caUsuenvio', 'caTipo', 'caIdcaso', 'caFrom', 'caFromname', 'caCc', 'caReplyto', 'caAddress', 'caAttachment', 'caSubject', 'caBody', 'caBodyhtml', 'caReadreceipt', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDEMAIL, self::CA_FCHENVIO, self::CA_USUENVIO, self::CA_TIPO, self::CA_IDCASO, self::CA_FROM, self::CA_FROMNAME, self::CA_CC, self::CA_REPLYTO, self::CA_ADDRESS, self::CA_ATTACHMENT, self::CA_SUBJECT, self::CA_BODY, self::CA_BODYHTML, self::CA_READRECEIPT, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idemail', 'ca_fchenvio', 'ca_usuenvio', 'ca_tipo', 'ca_idcaso', 'ca_from', 'ca_fromname', 'ca_cc', 'ca_replyto', 'ca_address', 'ca_attachment', 'ca_subject', 'ca_body', 'ca_bodyhtml', 'ca_readreceipt', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdemail' => 0, 'CaFchenvio' => 1, 'CaUsuenvio' => 2, 'CaTipo' => 3, 'CaIdcaso' => 4, 'CaFrom' => 5, 'CaFromname' => 6, 'CaCc' => 7, 'CaReplyto' => 8, 'CaAddress' => 9, 'CaAttachment' => 10, 'CaSubject' => 11, 'CaBody' => 12, 'CaBodyhtml' => 13, 'CaReadreceipt' => 14, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdemail' => 0, 'caFchenvio' => 1, 'caUsuenvio' => 2, 'caTipo' => 3, 'caIdcaso' => 4, 'caFrom' => 5, 'caFromname' => 6, 'caCc' => 7, 'caReplyto' => 8, 'caAddress' => 9, 'caAttachment' => 10, 'caSubject' => 11, 'caBody' => 12, 'caBodyhtml' => 13, 'caReadreceipt' => 14, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDEMAIL => 0, self::CA_FCHENVIO => 1, self::CA_USUENVIO => 2, self::CA_TIPO => 3, self::CA_IDCASO => 4, self::CA_FROM => 5, self::CA_FROMNAME => 6, self::CA_CC => 7, self::CA_REPLYTO => 8, self::CA_ADDRESS => 9, self::CA_ATTACHMENT => 10, self::CA_SUBJECT => 11, self::CA_BODY => 12, self::CA_BODYHTML => 13, self::CA_READRECEIPT => 14, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idemail' => 0, 'ca_fchenvio' => 1, 'ca_usuenvio' => 2, 'ca_tipo' => 3, 'ca_idcaso' => 4, 'ca_from' => 5, 'ca_fromname' => 6, 'ca_cc' => 7, 'ca_replyto' => 8, 'ca_address' => 9, 'ca_attachment' => 10, 'ca_subject' => 11, 'ca_body' => 12, 'ca_bodyhtml' => 13, 'ca_readreceipt' => 14, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new EmailMapBuilder();
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
		return str_replace(EmailPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(EmailPeer::CA_IDEMAIL);

		$criteria->addSelectColumn(EmailPeer::CA_FCHENVIO);

		$criteria->addSelectColumn(EmailPeer::CA_USUENVIO);

		$criteria->addSelectColumn(EmailPeer::CA_TIPO);

		$criteria->addSelectColumn(EmailPeer::CA_IDCASO);

		$criteria->addSelectColumn(EmailPeer::CA_FROM);

		$criteria->addSelectColumn(EmailPeer::CA_FROMNAME);

		$criteria->addSelectColumn(EmailPeer::CA_CC);

		$criteria->addSelectColumn(EmailPeer::CA_REPLYTO);

		$criteria->addSelectColumn(EmailPeer::CA_ADDRESS);

		$criteria->addSelectColumn(EmailPeer::CA_ATTACHMENT);

		$criteria->addSelectColumn(EmailPeer::CA_SUBJECT);

		$criteria->addSelectColumn(EmailPeer::CA_BODY);

		$criteria->addSelectColumn(EmailPeer::CA_BODYHTML);

		$criteria->addSelectColumn(EmailPeer::CA_READRECEIPT);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(EmailPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			EmailPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(EmailPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseEmailPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseEmailPeer', $criteria, $con);
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
		$objects = EmailPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return EmailPeer::populateObjects(EmailPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseEmailPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseEmailPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(EmailPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			EmailPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(Email $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdemail();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Email) {
				$key = (string) $value->getCaIdemail();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Email object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = EmailPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = EmailPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = EmailPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				EmailPeer::addInstanceToPool($obj, $key);
			} 		}
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
		return EmailPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseEmailPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseEmailPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(EmailPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(EmailPeer::CA_IDEMAIL) && $criteria->keyContainsValue(EmailPeer::CA_IDEMAIL) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.EmailPeer::CA_IDEMAIL.')');
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

		
    foreach (sfMixer::getCallables('BaseEmailPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseEmailPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseEmailPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseEmailPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(EmailPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(EmailPeer::CA_IDEMAIL);
			$selectCriteria->add(EmailPeer::CA_IDEMAIL, $criteria->remove(EmailPeer::CA_IDEMAIL), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseEmailPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseEmailPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(EmailPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(EmailPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(EmailPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												EmailPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof Email) {
						EmailPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(EmailPeer::CA_IDEMAIL, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								EmailPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(Email $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(EmailPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(EmailPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(EmailPeer::DATABASE_NAME, EmailPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = EmailPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = EmailPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(EmailPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(EmailPeer::DATABASE_NAME);
		$criteria->add(EmailPeer::CA_IDEMAIL, $pk);

		$v = EmailPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(EmailPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(EmailPeer::DATABASE_NAME);
			$criteria->add(EmailPeer::CA_IDEMAIL, $pks, Criteria::IN);
			$objs = EmailPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseEmailPeer::DATABASE_NAME)->addTableBuilder(BaseEmailPeer::TABLE_NAME, BaseEmailPeer::getMapBuilder());

