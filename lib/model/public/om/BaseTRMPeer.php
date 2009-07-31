<?php


abstract class BaseTRMPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_trms';

	
	const CLASS_DEFAULT = 'lib.model.public.TRM';

	
	const NUM_COLUMNS = 13;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_FECHA = 'tb_trms.CA_FECHA';

	
	const CA_EURO = 'tb_trms.CA_EURO';

	
	const CA_PESOS = 'tb_trms.CA_PESOS';

	
	const CA_LIBRA = 'tb_trms.CA_LIBRA';

	
	const CA_FSUIZO = 'tb_trms.CA_FSUIZO';

	
	const CA_MARCO = 'tb_trms.CA_MARCO';

	
	const CA_YEN = 'tb_trms.CA_YEN';

	
	const CA_RUPEE = 'tb_trms.CA_RUPEE';

	
	const CA_AUSDOLAR = 'tb_trms.CA_AUSDOLAR';

	
	const CA_CANDOLAR = 'tb_trms.CA_CANDOLAR';

	
	const CA_CORNORUEGA = 'tb_trms.CA_CORNORUEGA';

	
	const CA_SINGDOLAR = 'tb_trms.CA_SINGDOLAR';

	
	const CA_RAND = 'tb_trms.CA_RAND';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaFecha', 'CaEuro', 'CaPesos', 'CaLibra', 'CaFsuizo', 'CaMarco', 'CaYen', 'CaRupee', 'CaAusdolar', 'CaCandolar', 'CaCornoruega', 'CaSingdolar', 'CaRand', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caFecha', 'caEuro', 'caPesos', 'caLibra', 'caFsuizo', 'caMarco', 'caYen', 'caRupee', 'caAusdolar', 'caCandolar', 'caCornoruega', 'caSingdolar', 'caRand', ),
		BasePeer::TYPE_COLNAME => array (self::CA_FECHA, self::CA_EURO, self::CA_PESOS, self::CA_LIBRA, self::CA_FSUIZO, self::CA_MARCO, self::CA_YEN, self::CA_RUPEE, self::CA_AUSDOLAR, self::CA_CANDOLAR, self::CA_CORNORUEGA, self::CA_SINGDOLAR, self::CA_RAND, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_fecha', 'ca_euro', 'ca_pesos', 'ca_libra', 'ca_fsuizo', 'ca_marco', 'ca_yen', 'ca_rupee', 'ca_ausdolar', 'ca_candolar', 'ca_cornoruega', 'ca_singdolar', 'ca_rand', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaFecha' => 0, 'CaEuro' => 1, 'CaPesos' => 2, 'CaLibra' => 3, 'CaFsuizo' => 4, 'CaMarco' => 5, 'CaYen' => 6, 'CaRupee' => 7, 'CaAusdolar' => 8, 'CaCandolar' => 9, 'CaCornoruega' => 10, 'CaSingdolar' => 11, 'CaRand' => 12, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caFecha' => 0, 'caEuro' => 1, 'caPesos' => 2, 'caLibra' => 3, 'caFsuizo' => 4, 'caMarco' => 5, 'caYen' => 6, 'caRupee' => 7, 'caAusdolar' => 8, 'caCandolar' => 9, 'caCornoruega' => 10, 'caSingdolar' => 11, 'caRand' => 12, ),
		BasePeer::TYPE_COLNAME => array (self::CA_FECHA => 0, self::CA_EURO => 1, self::CA_PESOS => 2, self::CA_LIBRA => 3, self::CA_FSUIZO => 4, self::CA_MARCO => 5, self::CA_YEN => 6, self::CA_RUPEE => 7, self::CA_AUSDOLAR => 8, self::CA_CANDOLAR => 9, self::CA_CORNORUEGA => 10, self::CA_SINGDOLAR => 11, self::CA_RAND => 12, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_fecha' => 0, 'ca_euro' => 1, 'ca_pesos' => 2, 'ca_libra' => 3, 'ca_fsuizo' => 4, 'ca_marco' => 5, 'ca_yen' => 6, 'ca_rupee' => 7, 'ca_ausdolar' => 8, 'ca_candolar' => 9, 'ca_cornoruega' => 10, 'ca_singdolar' => 11, 'ca_rand' => 12, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new TRMMapBuilder();
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
		return str_replace(TRMPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(TRMPeer::CA_FECHA);

		$criteria->addSelectColumn(TRMPeer::CA_EURO);

		$criteria->addSelectColumn(TRMPeer::CA_PESOS);

		$criteria->addSelectColumn(TRMPeer::CA_LIBRA);

		$criteria->addSelectColumn(TRMPeer::CA_FSUIZO);

		$criteria->addSelectColumn(TRMPeer::CA_MARCO);

		$criteria->addSelectColumn(TRMPeer::CA_YEN);

		$criteria->addSelectColumn(TRMPeer::CA_RUPEE);

		$criteria->addSelectColumn(TRMPeer::CA_AUSDOLAR);

		$criteria->addSelectColumn(TRMPeer::CA_CANDOLAR);

		$criteria->addSelectColumn(TRMPeer::CA_CORNORUEGA);

		$criteria->addSelectColumn(TRMPeer::CA_SINGDOLAR);

		$criteria->addSelectColumn(TRMPeer::CA_RAND);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(TRMPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TRMPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(TRMPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseTRMPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseTRMPeer', $criteria, $con);
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
		$objects = TRMPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return TRMPeer::populateObjects(TRMPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTRMPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseTRMPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(TRMPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			TRMPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(TRM $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaFecha();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof TRM) {
				$key = (string) $value->getCaFecha();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or TRM object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = TRMPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = TRMPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = TRMPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				TRMPeer::addInstanceToPool($obj, $key);
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
		return TRMPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTRMPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseTRMPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(TRMPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseTRMPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseTRMPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTRMPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseTRMPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(TRMPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(TRMPeer::CA_FECHA);
			$selectCriteria->add(TRMPeer::CA_FECHA, $criteria->remove(TRMPeer::CA_FECHA), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseTRMPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseTRMPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(TRMPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(TRMPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(TRMPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												TRMPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof TRM) {
						TRMPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(TRMPeer::CA_FECHA, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								TRMPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(TRM $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(TRMPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(TRMPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(TRMPeer::DATABASE_NAME, TRMPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = TRMPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = TRMPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(TRMPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(TRMPeer::DATABASE_NAME);
		$criteria->add(TRMPeer::CA_FECHA, $pk);

		$v = TRMPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(TRMPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(TRMPeer::DATABASE_NAME);
			$criteria->add(TRMPeer::CA_FECHA, $pks, Criteria::IN);
			$objs = TRMPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseTRMPeer::DATABASE_NAME)->addTableBuilder(BaseTRMPeer::TABLE_NAME, BaseTRMPeer::getMapBuilder());

