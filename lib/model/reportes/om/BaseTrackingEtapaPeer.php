<?php


abstract class BaseTrackingEtapaPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_tracking_etapas';

	
	const CLASS_DEFAULT = 'lib.model.reportes.TrackingEtapa';

	
	const NUM_COLUMNS = 13;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDETAPA = 'tb_tracking_etapas.CA_IDETAPA';

	
	const CA_IMPOEXPO = 'tb_tracking_etapas.CA_IMPOEXPO';

	
	const CA_TRANSPORTE = 'tb_tracking_etapas.CA_TRANSPORTE';

	
	const CA_DEPARTAMENTO = 'tb_tracking_etapas.CA_DEPARTAMENTO';

	
	const CA_ETAPA = 'tb_tracking_etapas.CA_ETAPA';

	
	const CA_ORDEN = 'tb_tracking_etapas.CA_ORDEN';

	
	const CA_TTL = 'tb_tracking_etapas.CA_TTL';

	
	const CA_CLASS = 'tb_tracking_etapas.CA_CLASS';

	
	const CA_TEMPLATE = 'tb_tracking_etapas.CA_TEMPLATE';

	
	const CA_MESSAGE = 'tb_tracking_etapas.CA_MESSAGE';

	
	const CA_MESSAGE_DEFAULT = 'tb_tracking_etapas.CA_MESSAGE_DEFAULT';

	
	const CA_INTRO = 'tb_tracking_etapas.CA_INTRO';

	
	const CA_TITLE = 'tb_tracking_etapas.CA_TITLE';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdetapa', 'CaImpoexpo', 'CaTransporte', 'CaDepartamento', 'CaEtapa', 'CaOrden', 'CaTtl', 'CaClass', 'CaTemplate', 'CaMessage', 'CaMessageDefault', 'CaIntro', 'CaTitle', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdetapa', 'caImpoexpo', 'caTransporte', 'caDepartamento', 'caEtapa', 'caOrden', 'caTtl', 'caClass', 'caTemplate', 'caMessage', 'caMessageDefault', 'caIntro', 'caTitle', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDETAPA, self::CA_IMPOEXPO, self::CA_TRANSPORTE, self::CA_DEPARTAMENTO, self::CA_ETAPA, self::CA_ORDEN, self::CA_TTL, self::CA_CLASS, self::CA_TEMPLATE, self::CA_MESSAGE, self::CA_MESSAGE_DEFAULT, self::CA_INTRO, self::CA_TITLE, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idetapa', 'ca_impoexpo', 'ca_transporte', 'ca_departamento', 'ca_etapa', 'ca_orden', 'ca_ttl', 'ca_class', 'ca_template', 'ca_message', 'ca_message_default', 'ca_intro', 'ca_title', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdetapa' => 0, 'CaImpoexpo' => 1, 'CaTransporte' => 2, 'CaDepartamento' => 3, 'CaEtapa' => 4, 'CaOrden' => 5, 'CaTtl' => 6, 'CaClass' => 7, 'CaTemplate' => 8, 'CaMessage' => 9, 'CaMessageDefault' => 10, 'CaIntro' => 11, 'CaTitle' => 12, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdetapa' => 0, 'caImpoexpo' => 1, 'caTransporte' => 2, 'caDepartamento' => 3, 'caEtapa' => 4, 'caOrden' => 5, 'caTtl' => 6, 'caClass' => 7, 'caTemplate' => 8, 'caMessage' => 9, 'caMessageDefault' => 10, 'caIntro' => 11, 'caTitle' => 12, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDETAPA => 0, self::CA_IMPOEXPO => 1, self::CA_TRANSPORTE => 2, self::CA_DEPARTAMENTO => 3, self::CA_ETAPA => 4, self::CA_ORDEN => 5, self::CA_TTL => 6, self::CA_CLASS => 7, self::CA_TEMPLATE => 8, self::CA_MESSAGE => 9, self::CA_MESSAGE_DEFAULT => 10, self::CA_INTRO => 11, self::CA_TITLE => 12, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idetapa' => 0, 'ca_impoexpo' => 1, 'ca_transporte' => 2, 'ca_departamento' => 3, 'ca_etapa' => 4, 'ca_orden' => 5, 'ca_ttl' => 6, 'ca_class' => 7, 'ca_template' => 8, 'ca_message' => 9, 'ca_message_default' => 10, 'ca_intro' => 11, 'ca_title' => 12, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new TrackingEtapaMapBuilder();
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
		return str_replace(TrackingEtapaPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(TrackingEtapaPeer::CA_IDETAPA);

		$criteria->addSelectColumn(TrackingEtapaPeer::CA_IMPOEXPO);

		$criteria->addSelectColumn(TrackingEtapaPeer::CA_TRANSPORTE);

		$criteria->addSelectColumn(TrackingEtapaPeer::CA_DEPARTAMENTO);

		$criteria->addSelectColumn(TrackingEtapaPeer::CA_ETAPA);

		$criteria->addSelectColumn(TrackingEtapaPeer::CA_ORDEN);

		$criteria->addSelectColumn(TrackingEtapaPeer::CA_TTL);

		$criteria->addSelectColumn(TrackingEtapaPeer::CA_CLASS);

		$criteria->addSelectColumn(TrackingEtapaPeer::CA_TEMPLATE);

		$criteria->addSelectColumn(TrackingEtapaPeer::CA_MESSAGE);

		$criteria->addSelectColumn(TrackingEtapaPeer::CA_MESSAGE_DEFAULT);

		$criteria->addSelectColumn(TrackingEtapaPeer::CA_INTRO);

		$criteria->addSelectColumn(TrackingEtapaPeer::CA_TITLE);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(TrackingEtapaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TrackingEtapaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(TrackingEtapaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseTrackingEtapaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseTrackingEtapaPeer', $criteria, $con);
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
		$objects = TrackingEtapaPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return TrackingEtapaPeer::populateObjects(TrackingEtapaPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTrackingEtapaPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseTrackingEtapaPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(TrackingEtapaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			TrackingEtapaPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(TrackingEtapa $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdetapa();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof TrackingEtapa) {
				$key = (string) $value->getCaIdetapa();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or TrackingEtapa object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = TrackingEtapaPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = TrackingEtapaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = TrackingEtapaPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				TrackingEtapaPeer::addInstanceToPool($obj, $key);
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
		return TrackingEtapaPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTrackingEtapaPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseTrackingEtapaPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(TrackingEtapaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseTrackingEtapaPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseTrackingEtapaPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTrackingEtapaPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseTrackingEtapaPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(TrackingEtapaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(TrackingEtapaPeer::CA_IDETAPA);
			$selectCriteria->add(TrackingEtapaPeer::CA_IDETAPA, $criteria->remove(TrackingEtapaPeer::CA_IDETAPA), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseTrackingEtapaPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseTrackingEtapaPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(TrackingEtapaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(TrackingEtapaPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(TrackingEtapaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												TrackingEtapaPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof TrackingEtapa) {
						TrackingEtapaPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(TrackingEtapaPeer::CA_IDETAPA, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								TrackingEtapaPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(TrackingEtapa $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(TrackingEtapaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(TrackingEtapaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(TrackingEtapaPeer::DATABASE_NAME, TrackingEtapaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = TrackingEtapaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = TrackingEtapaPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(TrackingEtapaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(TrackingEtapaPeer::DATABASE_NAME);
		$criteria->add(TrackingEtapaPeer::CA_IDETAPA, $pk);

		$v = TrackingEtapaPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(TrackingEtapaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(TrackingEtapaPeer::DATABASE_NAME);
			$criteria->add(TrackingEtapaPeer::CA_IDETAPA, $pks, Criteria::IN);
			$objs = TrackingEtapaPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseTrackingEtapaPeer::DATABASE_NAME)->addTableBuilder(BaseTrackingEtapaPeer::TABLE_NAME, BaseTrackingEtapaPeer::getMapBuilder());

