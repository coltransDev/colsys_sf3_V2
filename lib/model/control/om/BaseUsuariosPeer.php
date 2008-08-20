<?php


abstract class BaseUsuariosPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'control.tb_usuarios';

	
	const CLASS_DEFAULT = 'lib.model.control.Usuarios';

	
	const NUM_COLUMNS = 8;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const CA_LOGIN = 'control.tb_usuarios.CA_LOGIN';

	
	const CA_NOMBRE = 'control.tb_usuarios.CA_NOMBRE';

	
	const CA_CARGO = 'control.tb_usuarios.CA_CARGO';

	
	const CA_DEPARTAMENTO = 'control.tb_usuarios.CA_DEPARTAMENTO';

	
	const CA_SUCURSAL = 'control.tb_usuarios.CA_SUCURSAL';

	
	const CA_EMAIL = 'control.tb_usuarios.CA_EMAIL';

	
	const CA_RUTINAS = 'control.tb_usuarios.CA_RUTINAS';

	
	const CA_EXTENSION = 'control.tb_usuarios.CA_EXTENSION';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CaLogin', 'CaNombre', 'CaCargo', 'CaDepartamento', 'CaSucursal', 'CaEmail', 'CaRutinas', 'CaExtension', ),
		BasePeer::TYPE_COLNAME => array (UsuariosPeer::CA_LOGIN, UsuariosPeer::CA_NOMBRE, UsuariosPeer::CA_CARGO, UsuariosPeer::CA_DEPARTAMENTO, UsuariosPeer::CA_SUCURSAL, UsuariosPeer::CA_EMAIL, UsuariosPeer::CA_RUTINAS, UsuariosPeer::CA_EXTENSION, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_login', 'ca_nombre', 'ca_cargo', 'ca_departamento', 'ca_sucursal', 'ca_email', 'ca_rutinas', 'ca_extension', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CaLogin' => 0, 'CaNombre' => 1, 'CaCargo' => 2, 'CaDepartamento' => 3, 'CaSucursal' => 4, 'CaEmail' => 5, 'CaRutinas' => 6, 'CaExtension' => 7, ),
		BasePeer::TYPE_COLNAME => array (UsuariosPeer::CA_LOGIN => 0, UsuariosPeer::CA_NOMBRE => 1, UsuariosPeer::CA_CARGO => 2, UsuariosPeer::CA_DEPARTAMENTO => 3, UsuariosPeer::CA_SUCURSAL => 4, UsuariosPeer::CA_EMAIL => 5, UsuariosPeer::CA_RUTINAS => 6, UsuariosPeer::CA_EXTENSION => 7, ),
		BasePeer::TYPE_FIELDNAME => array ('ca_login' => 0, 'ca_nombre' => 1, 'ca_cargo' => 2, 'ca_departamento' => 3, 'ca_sucursal' => 4, 'ca_email' => 5, 'ca_rutinas' => 6, 'ca_extension' => 7, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/control/map/UsuariosMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.control.map.UsuariosMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = UsuariosPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
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
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(UsuariosPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(UsuariosPeer::CA_LOGIN);

		$criteria->addSelectColumn(UsuariosPeer::CA_NOMBRE);

		$criteria->addSelectColumn(UsuariosPeer::CA_CARGO);

		$criteria->addSelectColumn(UsuariosPeer::CA_DEPARTAMENTO);

		$criteria->addSelectColumn(UsuariosPeer::CA_SUCURSAL);

		$criteria->addSelectColumn(UsuariosPeer::CA_EMAIL);

		$criteria->addSelectColumn(UsuariosPeer::CA_RUTINAS);

		$criteria->addSelectColumn(UsuariosPeer::CA_EXTENSION);

	}

	const COUNT = 'COUNT(control.tb_usuarios.CA_LOGIN)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT control.tb_usuarios.CA_LOGIN)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(UsuariosPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(UsuariosPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = UsuariosPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = UsuariosPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return UsuariosPeer::populateObjects(UsuariosPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			UsuariosPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = UsuariosPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return UsuariosPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(UsuariosPeer::CA_LOGIN); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(UsuariosPeer::CA_LOGIN);
			$selectCriteria->add(UsuariosPeer::CA_LOGIN, $criteria->remove(UsuariosPeer::CA_LOGIN), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(UsuariosPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(UsuariosPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Usuarios) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(UsuariosPeer::CA_LOGIN, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(Usuarios $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(UsuariosPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(UsuariosPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(UsuariosPeer::DATABASE_NAME, UsuariosPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = UsuariosPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(UsuariosPeer::DATABASE_NAME);

		$criteria->add(UsuariosPeer::CA_LOGIN, $pk);


		$v = UsuariosPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(UsuariosPeer::CA_LOGIN, $pks, Criteria::IN);
			$objs = UsuariosPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseUsuariosPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/control/map/UsuariosMapBuilder.php';
	Propel::registerMapBuilder('lib.model.control.map.UsuariosMapBuilder');
}
