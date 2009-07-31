<?php


abstract class BaseTransportistaPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'tb_transportistas';

	
	const CLASS_DEFAULT = 'lib.model.public.Transportista';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;

	
	const CA_IDTRANSPORTISTA = 'tb_transportistas.CA_IDTRANSPORTISTA';

	
	const CA_DIGITO = 'tb_transportistas.CA_DIGITO';

	
	const CA_NOMBRE = 'tb_transportistas.CA_NOMBRE';

	
	const CA_DIRECCION = 'tb_transportistas.CA_DIRECCION';

	
	const CA_TELEFONOS = 'tb_transportistas.CA_TELEFONOS';

	
	const CA_FAX = 'tb_transportistas.CA_FAX';

	
	const CA_IDCIUDAD = 'tb_transportistas.CA_IDCIUDAD';

	
	const CA_WEBSITE = 'tb_transportistas.CA_WEBSITE';

	
	const CA_EMAIL = 'tb_transportistas.CA_EMAIL';

	
	public static $instances = array();

	
	private static $mapBuilder = null;

	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdtransportista', 'CaDigito', 'CaNombre', 'CaDireccion', 'CaTelefonos', 'CaFax', 'CaIdciudad', 'CaWebsite', 'CaEmail', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdtransportista', 'caDigito', 'caNombre', 'caDireccion', 'caTelefonos', 'caFax', 'caIdciudad', 'caWebsite', 'caEmail', ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTRANSPORTISTA, self::CA_DIGITO, self::CA_NOMBRE, self::CA_DIRECCION, self::CA_TELEFONOS, self::CA_FAX, self::CA_IDCIUDAD, self::CA_WEBSITE, self::CA_EMAIL, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtransportista', 'ca_digito', 'ca_nombre', 'ca_direccion', 'ca_telefonos', 'ca_fax', 'ca_idciudad', 'ca_website', 'ca_email', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaIdtransportista' => 0, 'CaDigito' => 1, 'CaNombre' => 2, 'CaDireccion' => 3, 'CaTelefonos' => 4, 'CaFax' => 5, 'CaIdciudad' => 6, 'CaWebsite' => 7, 'CaEmail' => 8, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('caIdtransportista' => 0, 'caDigito' => 1, 'caNombre' => 2, 'caDireccion' => 3, 'caTelefonos' => 4, 'caFax' => 5, 'caIdciudad' => 6, 'caWebsite' => 7, 'caEmail' => 8, ),
		BasePeer::TYPE_COLNAME => array (self::CA_IDTRANSPORTISTA => 0, self::CA_DIGITO => 1, self::CA_NOMBRE => 2, self::CA_DIRECCION => 3, self::CA_TELEFONOS => 4, self::CA_FAX => 5, self::CA_IDCIUDAD => 6, self::CA_WEBSITE => 7, self::CA_EMAIL => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_idtransportista' => 0, 'ca_digito' => 1, 'ca_nombre' => 2, 'ca_direccion' => 3, 'ca_telefonos' => 4, 'ca_fax' => 5, 'ca_idciudad' => 6, 'ca_website' => 7, 'ca_email' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		if (self::$mapBuilder === null) {
			self::$mapBuilder = new TransportistaMapBuilder();
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
		return str_replace(TransportistaPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(TransportistaPeer::CA_IDTRANSPORTISTA);

		$criteria->addSelectColumn(TransportistaPeer::CA_DIGITO);

		$criteria->addSelectColumn(TransportistaPeer::CA_NOMBRE);

		$criteria->addSelectColumn(TransportistaPeer::CA_DIRECCION);

		$criteria->addSelectColumn(TransportistaPeer::CA_TELEFONOS);

		$criteria->addSelectColumn(TransportistaPeer::CA_FAX);

		$criteria->addSelectColumn(TransportistaPeer::CA_IDCIUDAD);

		$criteria->addSelectColumn(TransportistaPeer::CA_WEBSITE);

		$criteria->addSelectColumn(TransportistaPeer::CA_EMAIL);

	}

	
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
				$criteria = clone $criteria;

								$criteria->setPrimaryTableName(TransportistaPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			TransportistaPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); 		$criteria->setDbName(self::DATABASE_NAME); 
		if ($con === null) {
			$con = Propel::getConnection(TransportistaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}


    foreach (sfMixer::getCallables('BaseTransportistaPeer:doCount:doCount') as $callable)
    {
      call_user_func($callable, 'BaseTransportistaPeer', $criteria, $con);
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
		$objects = TransportistaPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return TransportistaPeer::populateObjects(TransportistaPeer::doSelectStmt($criteria, $con));
	}
	
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTransportistaPeer:doSelectStmt:doSelectStmt') as $callable)
    {
      call_user_func($callable, 'BaseTransportistaPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(TransportistaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			TransportistaPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

				return BasePeer::doSelect($criteria, $con);
	}
	
	public static function addInstanceToPool(Transportista $obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getCaIdtransportista();
			} 			self::$instances[$key] = $obj;
		}
	}

	
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof Transportista) {
				$key = (string) $value->getCaIdtransportista();
			} elseif (is_scalar($value)) {
								$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Transportista object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
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
	
				$cls = TransportistaPeer::getOMClass();
		$cls = substr('.'.$cls, strrpos('.'.$cls, '.') + 1);
				while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = TransportistaPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = TransportistaPeer::getInstanceFromPool($key))) {
																$results[] = $obj;
			} else {
		
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				TransportistaPeer::addInstanceToPool($obj, $key);
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
		return TransportistaPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTransportistaPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseTransportistaPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(TransportistaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		if ($criteria->containsKey(TransportistaPeer::CA_IDTRANSPORTISTA) && $criteria->keyContainsValue(TransportistaPeer::CA_IDTRANSPORTISTA) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.TransportistaPeer::CA_IDTRANSPORTISTA.')');
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

		
    foreach (sfMixer::getCallables('BaseTransportistaPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseTransportistaPeer', $values, $con, $pk);
    }

    return $pk;
	}

	
	public static function doUpdate($values, PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTransportistaPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseTransportistaPeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(TransportistaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(TransportistaPeer::CA_IDTRANSPORTISTA);
			$selectCriteria->add(TransportistaPeer::CA_IDTRANSPORTISTA, $criteria->remove(TransportistaPeer::CA_IDTRANSPORTISTA), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseTransportistaPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseTransportistaPeer', $values, $con, $ret);
    }

    return $ret;
  }

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(TransportistaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; 		try {
									$con->beginTransaction();
			$affectedRows += BasePeer::doDeleteAll(TransportistaPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(TransportistaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
												TransportistaPeer::clearInstancePool();

						$criteria = clone $values;
		} elseif ($values instanceof Transportista) {
						TransportistaPeer::removeInstanceFromPool($values);
						$criteria = $values->buildPkeyCriteria();
		} else {
			


			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(TransportistaPeer::CA_IDTRANSPORTISTA, (array) $values, Criteria::IN);

			foreach ((array) $values as $singleval) {
								TransportistaPeer::removeInstanceFromPool($singleval);
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

	
	public static function doValidate(Transportista $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(TransportistaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(TransportistaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(TransportistaPeer::DATABASE_NAME, TransportistaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = TransportistaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = TransportistaPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(TransportistaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(TransportistaPeer::DATABASE_NAME);
		$criteria->add(TransportistaPeer::CA_IDTRANSPORTISTA, $pk);

		$v = TransportistaPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(TransportistaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(TransportistaPeer::DATABASE_NAME);
			$criteria->add(TransportistaPeer::CA_IDTRANSPORTISTA, $pks, Criteria::IN);
			$objs = TransportistaPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 

Propel::getDatabaseMap(BaseTransportistaPeer::DATABASE_NAME)->addTableBuilder(BaseTransportistaPeer::TABLE_NAME, BaseTransportistaPeer::getMapBuilder());

