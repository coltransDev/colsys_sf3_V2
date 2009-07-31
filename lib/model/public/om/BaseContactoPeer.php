<?php


abstract class BaseContactoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_concliente';

	
	const CLASS_DEFAULT = 'lib.model.public.Contacto';

	
	const NUM_COLUMNS = 17;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDCONTACTO = 'tb_concliente.CA_IDCONTACTO';

	
	const CA_IDCLIENTE = 'tb_concliente.CA_IDCLIENTE';

	
	const CA_PAPELLIDO = 'tb_concliente.CA_PAPELLIDO';

	
	const CA_SAPELLIDO = 'tb_concliente.CA_SAPELLIDO';

	
	const CA_NOMBRES = 'tb_concliente.CA_NOMBRES';

	
	const CA_SALUDO = 'tb_concliente.CA_SALUDO';

	
	const CA_CARGO = 'tb_concliente.CA_CARGO';

	
	const CA_DEPARTAMENTO = 'tb_concliente.CA_DEPARTAMENTO';

	
	const CA_TELEFONOS = 'tb_concliente.CA_TELEFONOS';

	
	const CA_FAX = 'tb_concliente.CA_FAX';

	
	const CA_EMAIL = 'tb_concliente.CA_EMAIL';

	
	const CA_OBSERVACIONES = 'tb_concliente.CA_OBSERVACIONES';

	
	const CA_FCHCREADO = 'tb_concliente.CA_FCHCREADO';

	
	const CA_FCHACTUALIZADO = 'tb_concliente.CA_FCHACTUALIZADO';

	
	const CA_USUCREADO = 'tb_concliente.CA_USUCREADO';

	
	const CA_USUACTUALIZADO = 'tb_concliente.CA_USUACTUALIZADO';

	
	const CA_CUMPLEANOS = 'tb_concliente.CA_CUMPLEANOS';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcontacto', 'CaIdcliente', 'CaPapellido', 'CaSapellido', 'CaNombres', 'CaSaludo', 'CaCargo', 'CaDepartamento', 'CaTelefonos', 'CaFax', 'CaEmail', 'CaObservaciones', 'CaFchcreado', 'CaFchactualizado', 'CaUsucreado', 'CaUsuactualizado', 'CaCumpleanos', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcontacto', 'caIdcliente', 'caPapellido', 'caSapellido', 'caNombres', 'caSaludo', 'caCargo', 'caDepartamento', 'caTelefonos', 'caFax', 'caEmail', 'caObservaciones', 'caFchcreado', 'caFchactualizado', 'caUsucreado', 'caUsuactualizado', 'caCumpleanos', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCONTACTO, self::CA_IDCLIENTE, self::CA_PAPELLIDO, self::CA_SAPELLIDO, self::CA_NOMBRES, self::CA_SALUDO, self::CA_CARGO, self::CA_DEPARTAMENTO, self::CA_TELEFONOS, self::CA_FAX, self::CA_EMAIL, self::CA_OBSERVACIONES, self::CA_FCHCREADO, self::CA_FCHACTUALIZADO, self::CA_USUCREADO, self::CA_USUACTUALIZADO, self::CA_CUMPLEANOS, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcontacto', 'ca_idcliente', 'ca_papellido', 'ca_sapellido', 'ca_nombres', 'ca_saludo', 'ca_cargo', 'ca_departamento', 'ca_telefonos', 'ca_fax', 'ca_email', 'ca_observaciones', 'ca_fchcreado', 'ca_fchactualizado', 'ca_usucreado', 'ca_usuactualizado', 'ca_cumpleanos', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdcontacto' => 0, 'CaIdcliente' => 1, 'CaPapellido' => 2, 'CaSapellido' => 3, 'CaNombres' => 4, 'CaSaludo' => 5, 'CaCargo' => 6, 'CaDepartamento' => 7, 'CaTelefonos' => 8, 'CaFax' => 9, 'CaEmail' => 10, 'CaObservaciones' => 11, 'CaFchcreado' => 12, 'CaFchactualizado' => 13, 'CaUsucreado' => 14, 'CaUsuactualizado' => 15, 'CaCumpleanos' => 16, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdcontacto' => 0, 'caIdcliente' => 1, 'caPapellido' => 2, 'caSapellido' => 3, 'caNombres' => 4, 'caSaludo' => 5, 'caCargo' => 6, 'caDepartamento' => 7, 'caTelefonos' => 8, 'caFax' => 9, 'caEmail' => 10, 'caObservaciones' => 11, 'caFchcreado' => 12, 'caFchactualizado' => 13, 'caUsucreado' => 14, 'caUsuactualizado' => 15, 'caCumpleanos' => 16, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDCONTACTO => 0, self::CA_IDCLIENTE => 1, self::CA_PAPELLIDO => 2, self::CA_SAPELLIDO => 3, self::CA_NOMBRES => 4, self::CA_SALUDO => 5, self::CA_CARGO => 6, self::CA_DEPARTAMENTO => 7, self::CA_TELEFONOS => 8, self::CA_FAX => 9, self::CA_EMAIL => 10, self::CA_OBSERVACIONES => 11, self::CA_FCHCREADO => 12, self::CA_FCHACTUALIZADO => 13, self::CA_USUCREADO => 14, self::CA_USUACTUALIZADO => 15, self::CA_CUMPLEANOS => 16, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idcontacto' => 0, 'ca_idcliente' => 1, 'ca_papellido' => 2, 'ca_sapellido' => 3, 'ca_nombres' => 4, 'ca_saludo' => 5, 'ca_cargo' => 6, 'ca_departamento' => 7, 'ca_telefonos' => 8, 'ca_fax' => 9, 'ca_email' => 10, 'ca_observaciones' => 11, 'ca_fchcreado' => 12, 'ca_fchactualizado' => 13, 'ca_usucreado' => 14, 'ca_usuactualizado' => 15, 'ca_cumpleanos' => 16, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new ContactoMapBuilder();
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
		return str_replace(ContactoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ContactoPeer::CA_IDCONTACTO);

		$criteria->addSelectColumn(ContactoPeer::CA_IDCLIENTE);

		$criteria->addSelectColumn(ContactoPeer::CA_PAPELLIDO);

		$criteria->addSelectColumn(ContactoPeer::CA_SAPELLIDO);

		$criteria->addSelectColumn(ContactoPeer::CA_NOMBRES);

		$criteria->addSelectColumn(ContactoPeer::CA_SALUDO);

		$criteria->addSelectColumn(ContactoPeer::CA_CARGO);

		$criteria->addSelectColumn(ContactoPeer::CA_DEPARTAMENTO);

		$criteria->addSelectColumn(ContactoPeer::CA_TELEFONOS);

		$criteria->addSelectColumn(ContactoPeer::CA_FAX);

		$criteria->addSelectColumn(ContactoPeer::CA_EMAIL);

		$criteria->addSelectColumn(ContactoPeer::CA_OBSERVACIONES);

		$criteria->addSelectColumn(ContactoPeer::CA_FCHCREADO);

		$criteria->addSelectColumn(ContactoPeer::CA_FCHACTUALIZADO);

		$criteria->addSelectColumn(ContactoPeer::CA_USUCREADO);

		$criteria->addSelectColumn(ContactoPeer::CA_USUACTUALIZADO);

		$criteria->addSelectColumn(ContactoPeer::CA_CUMPLEANOS);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(ContactoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ContactoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(ContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseContactoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseContactoPeer', $criteria, $con);
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
		$objects = ContactoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return ContactoPeer::populateObjects(ContactoPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseContactoPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseContactoPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(ContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			ContactoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(Contacto $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdcontacto();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Contacto) {
				$key = (string) $value->getCaIdcontacto();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Contacto object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = ContactoPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = ContactoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = ContactoPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				ContactoPeer::addInstanceToPool($obj, $key);
			} 		}
		$stmt->closeCursor();
		return $results;
	}

	
	public static function doCountJoinCliente(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(ContactoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ContactoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(ContactoPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);


    foreach (sfMixer::getCallables('BaseContactoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseContactoPeer', $criteria, $con);
    }


		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; 		}
		$stmt->closeCursor();
		return $count;
	}


	
	public static function doSelectJoinCliente(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{

    foreach (sfMixer::getCallables('BaseContactoPeer:doSelectJoin:doSelectJoin') as $callable)
    {
      call_user_func($callable, 'BaseContactoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ContactoPeer::addSelectColumns($c);
		$startcol = (ContactoPeer::NUM_COLUMNS - ContactoPeer::NUM_LAZY_LOAD_COLUMNS);
		ClientePeer::addSelectColumns($c);

		$c->addJoin(array(ContactoPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ContactoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ContactoPeer::getInstanceFromPool($key1))) {
															} else {

				$omClass = ContactoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ContactoPeer::addInstanceToPool($obj1, $key1);
			} 
			$key2 = ClientePeer::getPrimaryKeyHashFromRow($row, $startcol);
			if ($key2 !== null) {
				$obj2 = ClientePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ClientePeer::getOMClass();

					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol);
					ClientePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addContacto($obj1);

			} 
			$results[] = $obj1;
		}
		$stmt->closeCursor();
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(ContactoPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			ContactoPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 
				$criteria->setDbName(self::DATABASE_NAME);

		if ($con === null) {
			$con = Propel::getConnection(ContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria->addJoin(array(ContactoPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);

    foreach (sfMixer::getCallables('BaseContactoPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseContactoPeer', $criteria, $con);
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

    foreach (sfMixer::getCallables('BaseContactoPeer:doSelectJoinAll:doSelectJoinAll') as $callable)
    {
      call_user_func($callable, 'BaseContactoPeer', $c, $con);
    }


		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ContactoPeer::addSelectColumns($c);
		$startcol2 = (ContactoPeer::NUM_COLUMNS - ContactoPeer::NUM_LAZY_LOAD_COLUMNS);

		ClientePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + (ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS);

		$c->addJoin(array(ContactoPeer::CA_IDCLIENTE,), array(ClientePeer::CA_IDCLIENTE,), $join_behavior);
		$stmt = BasePeer::doSelect($c, $con);
		$results = array();

		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key1 = ContactoPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj1 = ContactoPeer::getInstanceFromPool($key1))) {
															} else {
				$omClass = ContactoPeer::getOMClass();

				$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
				$obj1 = new $cls();
				$obj1->hydrate($row);
				ContactoPeer::addInstanceToPool($obj1, $key1);
			} 
			
			$key2 = ClientePeer::getPrimaryKeyHashFromRow($row, $startcol2);
			if ($key2 !== null) {
				$obj2 = ClientePeer::getInstanceFromPool($key2);
				if (!$obj2) {

					$omClass = ClientePeer::getOMClass();


					$cls = substr('.'.$omClass, strrpos('.'.$omClass, '.') + 1);
					$obj2 = new $cls();
					$obj2->hydrate($row, $startcol2);
					ClientePeer::addInstanceToPool($obj2, $key2);
				} 
								$obj2->addContacto($obj1);
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
		return ContactoPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseContactoPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseContactoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(ContactoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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

		
    foreach (sfMixer::getCallables('BaseContactoPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseContactoPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseContactoPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseContactoPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(ContactoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(ContactoPeer::CA_IDCONTACTO);
			$selectCriteria->add(ContactoPeer::CA_IDCONTACTO, $criteria->remove(ContactoPeer::CA_IDCONTACTO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseContactoPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseContactoPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ContactoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(ContactoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ContactoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												ContactoPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof Contacto) {
						ContactoPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(ContactoPeer::CA_IDCONTACTO, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								ContactoPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(Contacto $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ContactoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ContactoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ContactoPeer::DATABASE_NAME, ContactoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ContactoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = ContactoPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(ContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(ContactoPeer::DATABASE_NAME);
		$criteria->add(ContactoPeer::CA_IDCONTACTO, $pk);

		$v = ContactoPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(ContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(ContactoPeer::DATABASE_NAME);
			$criteria->add(ContactoPeer::CA_IDCONTACTO, $pks, Criteria::IN);
			$objs = ContactoPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseContactoPeer::DATABASE_NAME)->addTableBuilder(BaseContactoPeer::TABLE_NAME, BaseContactoPeer::getMapBuilder());

