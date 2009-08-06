<?php


abstract class BaseNotTareaPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'notificaciones.tb_tareas';

	
	const CLASS_DEFAULT = 'lib.model.notificaciones.NotTarea';

	
	const NUM_COLUMNS = 13;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDTAREA = 'notificaciones.tb_tareas.CA_IDTAREA';

	
	const CA_IDLISTATAREA = 'notificaciones.tb_tareas.CA_IDLISTATAREA';

	
	const CA_URL = 'notificaciones.tb_tareas.CA_URL';

	
	const CA_TITULO = 'notificaciones.tb_tareas.CA_TITULO';

	
	const CA_TEXTO = 'notificaciones.tb_tareas.CA_TEXTO';

	
	const CA_FCHVISIBLE = 'notificaciones.tb_tareas.CA_FCHVISIBLE';

	
	const CA_FCHVENCIMIENTO = 'notificaciones.tb_tareas.CA_FCHVENCIMIENTO';

	
	const CA_FCHTERMINADA = 'notificaciones.tb_tareas.CA_FCHTERMINADA';

	
	const CA_USUTERMINADA = 'notificaciones.tb_tareas.CA_USUTERMINADA';

	
	const CA_PRIORIDAD = 'notificaciones.tb_tareas.CA_PRIORIDAD';

	
	const CA_FCHCREADO = 'notificaciones.tb_tareas.CA_FCHCREADO';

	
	const CA_USUCREADO = 'notificaciones.tb_tareas.CA_USUCREADO';

	
	const CA_OBSERVACIONES = 'notificaciones.tb_tareas.CA_OBSERVACIONES';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdtarea', 'CaIdlistatarea', 'CaUrl', 'CaTitulo', 'CaTexto', 'CaFchvisible', 'CaFchvencimiento', 'CaFchterminada', 'CaUsuterminada', 'CaPrioridad', 'CaFchcreado', 'CaUsucreado', 'CaObservaciones', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdtarea', 'caIdlistatarea', 'caUrl', 'caTitulo', 'caTexto', 'caFchvisible', 'caFchvencimiento', 'caFchterminada', 'caUsuterminada', 'caPrioridad', 'caFchcreado', 'caUsucreado', 'caObservaciones', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTAREA, self::CA_IDLISTATAREA, self::CA_URL, self::CA_TITULO, self::CA_TEXTO, self::CA_FCHVISIBLE, self::CA_FCHVENCIMIENTO, self::CA_FCHTERMINADA, self::CA_USUTERMINADA, self::CA_PRIORIDAD, self::CA_FCHCREADO, self::CA_USUCREADO, self::CA_OBSERVACIONES, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtarea', 'ca_idlistatarea', 'ca_url', 'ca_titulo', 'ca_texto', 'ca_fchvisible', 'ca_fchvencimiento', 'ca_fchterminada', 'ca_usuterminada', 'ca_prioridad', 'ca_fchcreado', 'ca_usucreado', 'ca_observaciones', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdtarea' => 0, 'CaIdlistatarea' => 1, 'CaUrl' => 2, 'CaTitulo' => 3, 'CaTexto' => 4, 'CaFchvisible' => 5, 'CaFchvencimiento' => 6, 'CaFchterminada' => 7, 'CaUsuterminada' => 8, 'CaPrioridad' => 9, 'CaFchcreado' => 10, 'CaUsucreado' => 11, 'CaObservaciones' => 12, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdtarea' => 0, 'caIdlistatarea' => 1, 'caUrl' => 2, 'caTitulo' => 3, 'caTexto' => 4, 'caFchvisible' => 5, 'caFchvencimiento' => 6, 'caFchterminada' => 7, 'caUsuterminada' => 8, 'caPrioridad' => 9, 'caFchcreado' => 10, 'caUsucreado' => 11, 'caObservaciones' => 12, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTAREA => 0, self::CA_IDLISTATAREA => 1, self::CA_URL => 2, self::CA_TITULO => 3, self::CA_TEXTO => 4, self::CA_FCHVISIBLE => 5, self::CA_FCHVENCIMIENTO => 6, self::CA_FCHTERMINADA => 7, self::CA_USUTERMINADA => 8, self::CA_PRIORIDAD => 9, self::CA_FCHCREADO => 10, self::CA_USUCREADO => 11, self::CA_OBSERVACIONES => 12, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtarea' => 0, 'ca_idlistatarea' => 1, 'ca_url' => 2, 'ca_titulo' => 3, 'ca_texto' => 4, 'ca_fchvisible' => 5, 'ca_fchvencimiento' => 6, 'ca_fchterminada' => 7, 'ca_usuterminada' => 8, 'ca_prioridad' => 9, 'ca_fchcreado' => 10, 'ca_usucreado' => 11, 'ca_observaciones' => 12, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new NotTareaMapBuilder();
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
		return str_replace(NotTareaPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(NotTareaPeer::CA_IDTAREA);

		$criteria->addSelectColumn(NotTareaPeer::CA_IDLISTATAREA);

		$criteria->addSelectColumn(NotTareaPeer::CA_URL);

		$criteria->addSelectColumn(NotTareaPeer::CA_TITULO);

		$criteria->addSelectColumn(NotTareaPeer::CA_TEXTO);

		$criteria->addSelectColumn(NotTareaPeer::CA_FCHVISIBLE);

		$criteria->addSelectColumn(NotTareaPeer::CA_FCHVENCIMIENTO);

		$criteria->addSelectColumn(NotTareaPeer::CA_FCHTERMINADA);

		$criteria->addSelectColumn(NotTareaPeer::CA_USUTERMINADA);

		$criteria->addSelectColumn(NotTareaPeer::CA_PRIORIDAD);

		$criteria->addSelectColumn(NotTareaPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(NotTareaPeer::CA_USUCREADO);

		$criteria->addSelectColumn(NotTareaPeer::CA_OBSERVACIONES);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(NotTareaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			NotTareaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(NotTareaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseNotTareaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseNotTareaPeer', $criteria, $con);
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
		$objects = NotTareaPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return NotTareaPeer::populateObjects(NotTareaPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseNotTareaPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseNotTareaPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(NotTareaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			NotTareaPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(NotTarea $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdtarea();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof NotTarea) {
				$key = (string) $value->getCaIdtarea();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or NotTarea object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = NotTareaPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = NotTareaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = NotTareaPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				NotTareaPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinNotListaTareas(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(NotTareaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			NotTareaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(NotTareaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(NotTareaPeer::CA_IDLISTATAREA,), array(NotListaTareasPeer::CA_IDLISTATAREA,), $join_behavior);


    foreach (sfMixer::getCallables('BaseNotTareaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseNotTareaPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinNotListaTareas(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseNotTareaPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseNotTareaPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		NotTareaPeer::addSelectColumns($c);
		$startcol = (NotTareaPeer::NUM_COLUMNS - NotTareaPeer::NUM_LAZY_LOAD_COLUMNS);
		NotListaTareasPeer::addSelectColumns($c);

		$c->addJoin(array(NotTareaPeer::CA_IDLISTATAREA,), array(NotListaTareasPeer::CA_IDLISTATAREA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = NotTareaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = NotTareaPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = NotTareaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				NotTareaPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = NotListaTareasPeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = NotListaTareasPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = NotListaTareasPeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					NotListaTareasPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addNotTarea($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(NotTareaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			NotTareaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(NotTareaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(NotTareaPeer::CA_IDLISTATAREA,), array(NotListaTareasPeer::CA_IDLISTATAREA,), $join_behavior);

    foreach (sfMixer::getCallables('BaseNotTareaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseNotTareaPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseNotTareaPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseNotTareaPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		NotTareaPeer::addSelectColumns($c);
		$startcol2 = (NotTareaPeer::NUM_COLUMNS - NotTareaPeer::NUM_LAZY_LOAD_COLUMNS);

		NotListaTareasPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (NotListaTareasPeer::NUM_COLUMNS - NotListaTareasPeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(NotTareaPeer::CA_IDLISTATAREA,), array(NotListaTareasPeer::CA_IDLISTATAREA,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = NotTareaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = NotTareaPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = NotTareaPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				NotTareaPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = NotListaTareasPeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = NotListaTareasPeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = NotListaTareasPeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					NotListaTareasPeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addNotTarea($obj1);
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
		return NotTareaPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseNotTareaPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseNotTareaPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(NotTareaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(NotTareaPeer::CA_IDTAREA) && $criteria->keyContainsValue(NotTareaPeer::CA_IDTAREA) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.NotTareaPeer::CA_IDTAREA.')');
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

		
    foreach (sfMixer::getCallables('BaseNotTareaPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseNotTareaPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseNotTareaPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseNotTareaPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(NotTareaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(NotTareaPeer::CA_IDTAREA);
			$selectCriteria->add(NotTareaPeer::CA_IDTAREA, $criteria->remove(NotTareaPeer::CA_IDTAREA), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseNotTareaPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseNotTareaPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(NotTareaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(NotTareaPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(NotTareaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												NotTareaPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof NotTarea) {
						NotTareaPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(NotTareaPeer::CA_IDTAREA, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								NotTareaPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(NotTarea $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(NotTareaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(NotTareaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(NotTareaPeer::DATABASE_NAME, NotTareaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = NotTareaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = NotTareaPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(NotTareaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		$criteria->add(NotTareaPeer::CA_IDTAREA, $pk);

		$v = NotTareaPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(NotTareaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
			$criteria->add(NotTareaPeer::CA_IDTAREA, $pks, Criteria::IN);
			$objs = NotTareaPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseNotTareaPeer::DATABASE_NAME)->addTableBuilder(BaseNotTareaPeer::TABLE_NAME, BaseNotTareaPeer::getMapBuilder());

