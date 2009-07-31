<?php


abstract class BaseTerceroPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_terceros';

	
	const CLASS_DEFAULT = 'lib.model.public.Tercero';

	
	const NUM_COLUMNS = 11;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDTERCERO = 'tb_terceros.CA_IDTERCERO';

	
	const CA_NOMBRE = 'tb_terceros.CA_NOMBRE';

	
	const CA_CONTACTO = 'tb_terceros.CA_CONTACTO';

	
	const CA_DIRECCION = 'tb_terceros.CA_DIRECCION';

	
	const CA_TELEFONOS = 'tb_terceros.CA_TELEFONOS';

	
	const CA_FAX = 'tb_terceros.CA_FAX';

	
	const CA_IDCIUDAD = 'tb_terceros.CA_IDCIUDAD';

	
	const CA_EMAIL = 'tb_terceros.CA_EMAIL';

	
	const CA_VENDEDOR = 'tb_terceros.CA_VENDEDOR';

	
	const CA_TIPO = 'tb_terceros.CA_TIPO';

	
	const CA_IDENTIFICACION = 'tb_terceros.CA_IDENTIFICACION';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdtercero', 'CaNombre', 'CaContacto', 'CaDireccion', 'CaTelefonos', 'CaFax', 'CaIdciudad', 'CaEmail', 'CaVendedor', 'CaTipo', 'CaIdentificacion', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdtercero', 'caNombre', 'caContacto', 'caDireccion', 'caTelefonos', 'caFax', 'caIdciudad', 'caEmail', 'caVendedor', 'caTipo', 'caIdentificacion', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTERCERO, self::CA_NOMBRE, self::CA_CONTACTO, self::CA_DIRECCION, self::CA_TELEFONOS, self::CA_FAX, self::CA_IDCIUDAD, self::CA_EMAIL, self::CA_VENDEDOR, self::CA_TIPO, self::CA_IDENTIFICACION, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtercero', 'ca_nombre', 'ca_contacto', 'ca_direccion', 'ca_telefonos', 'ca_fax', 'ca_idciudad', 'ca_email', 'ca_vendedor', 'ca_tipo', 'ca_identificacion', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdtercero' => 0, 'CaNombre' => 1, 'CaContacto' => 2, 'CaDireccion' => 3, 'CaTelefonos' => 4, 'CaFax' => 5, 'CaIdciudad' => 6, 'CaEmail' => 7, 'CaVendedor' => 8, 'CaTipo' => 9, 'CaIdentificacion' => 10, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdtercero' => 0, 'caNombre' => 1, 'caContacto' => 2, 'caDireccion' => 3, 'caTelefonos' => 4, 'caFax' => 5, 'caIdciudad' => 6, 'caEmail' => 7, 'caVendedor' => 8, 'caTipo' => 9, 'caIdentificacion' => 10, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTERCERO => 0, self::CA_NOMBRE => 1, self::CA_CONTACTO => 2, self::CA_DIRECCION => 3, self::CA_TELEFONOS => 4, self::CA_FAX => 5, self::CA_IDCIUDAD => 6, self::CA_EMAIL => 7, self::CA_VENDEDOR => 8, self::CA_TIPO => 9, self::CA_IDENTIFICACION => 10, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtercero' => 0, 'ca_nombre' => 1, 'ca_contacto' => 2, 'ca_direccion' => 3, 'ca_telefonos' => 4, 'ca_fax' => 5, 'ca_idciudad' => 6, 'ca_email' => 7, 'ca_vendedor' => 8, 'ca_tipo' => 9, 'ca_identificacion' => 10, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new TerceroMapBuilder();
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
		return str_replace(TerceroPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(TerceroPeer::CA_IDTERCERO);

		$criteria->addSelectColumn(TerceroPeer::CA_NOMBRE);

		$criteria->addSelectColumn(TerceroPeer::CA_CONTACTO);

		$criteria->addSelectColumn(TerceroPeer::CA_DIRECCION);

		$criteria->addSelectColumn(TerceroPeer::CA_TELEFONOS);

		$criteria->addSelectColumn(TerceroPeer::CA_FAX);

		$criteria->addSelectColumn(TerceroPeer::CA_IDCIUDAD);

		$criteria->addSelectColumn(TerceroPeer::CA_EMAIL);

		$criteria->addSelectColumn(TerceroPeer::CA_VENDEDOR);

		$criteria->addSelectColumn(TerceroPeer::CA_TIPO);

		$criteria->addSelectColumn(TerceroPeer::CA_IDENTIFICACION);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(TerceroPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TerceroPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(TerceroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseTerceroPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseTerceroPeer', $criteria, $con);
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
		$objects = TerceroPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return TerceroPeer::populateObjects(TerceroPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTerceroPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseTerceroPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(TerceroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			TerceroPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(Tercero $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdtercero();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Tercero) {
				$key = (string) $value->getCaIdtercero();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Tercero object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = TerceroPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = TerceroPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = TerceroPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				TerceroPeer::addInstanceToPool($obj, $key);
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
		return TerceroPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTerceroPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseTerceroPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(TerceroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(TerceroPeer::CA_IDTERCERO) && $criteria->keyContainsValue(TerceroPeer::CA_IDTERCERO) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.TerceroPeer::CA_IDTERCERO.')');
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

		
    foreach (sfMixer::getCallables('BaseTerceroPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseTerceroPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTerceroPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseTerceroPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(TerceroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(TerceroPeer::CA_IDTERCERO);
			$selectCriteria->add(TerceroPeer::CA_IDTERCERO, $criteria->remove(TerceroPeer::CA_IDTERCERO), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseTerceroPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseTerceroPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(TerceroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(TerceroPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(TerceroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												TerceroPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof Tercero) {
						TerceroPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(TerceroPeer::CA_IDTERCERO, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								TerceroPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(Tercero $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(TerceroPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(TerceroPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(TerceroPeer::DATABASE_NAME, TerceroPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = TerceroPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = TerceroPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(TerceroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(TerceroPeer::DATABASE_NAME);
		$criteria->add(TerceroPeer::CA_IDTERCERO, $pk);

		$v = TerceroPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(TerceroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(TerceroPeer::DATABASE_NAME);
			$criteria->add(TerceroPeer::CA_IDTERCERO, $pks, Criteria::IN);
			$objs = TerceroPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseTerceroPeer::DATABASE_NAME)->addTableBuilder(BaseTerceroPeer::TABLE_NAME, BaseTerceroPeer::getMapBuilder());

