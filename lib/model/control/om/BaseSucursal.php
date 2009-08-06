<?php


abstract class BaseSucursal extends BaseObject  implements Persistent {


  const PEER = 'SucursalPeer';

	
	protected static $peer;

	
	protected $ca_idsucursal;

	
	protected $ca_nombre;

	
	protected $ca_telefono;

	
	protected $ca_fax;

	
	protected $ca_direccion;

	
	protected $collUsuarios;

	
	private $lastUsuarioCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	
	public function applyDefaultValues()
	{
	}

	
	public function getCaIdsucursal()
	{
		return $this->ca_idsucursal;
	}

	
	public function getCaNombre()
	{
		return $this->ca_nombre;
	}

	
	public function getCaTelefono()
	{
		return $this->ca_telefono;
	}

	
	public function getCaFax()
	{
		return $this->ca_fax;
	}

	
	public function getCaDireccion()
	{
		return $this->ca_direccion;
	}

	
	public function setCaIdsucursal($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idsucursal !== $v) {
			$this->ca_idsucursal = $v;
			$this->modifiedColumns[] = SucursalPeer::CA_IDSUCURSAL;
		}

		return $this;
	} 
	
	public function setCaNombre($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_nombre !== $v) {
			$this->ca_nombre = $v;
			$this->modifiedColumns[] = SucursalPeer::CA_NOMBRE;
		}

		return $this;
	} 
	
	public function setCaTelefono($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_telefono !== $v) {
			$this->ca_telefono = $v;
			$this->modifiedColumns[] = SucursalPeer::CA_TELEFONO;
		}

		return $this;
	} 
	
	public function setCaFax($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_fax !== $v) {
			$this->ca_fax = $v;
			$this->modifiedColumns[] = SucursalPeer::CA_FAX;
		}

		return $this;
	} 
	
	public function setCaDireccion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_direccion !== $v) {
			$this->ca_direccion = $v;
			$this->modifiedColumns[] = SucursalPeer::CA_DIRECCION;
		}

		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
						if (array_diff($this->modifiedColumns, array())) {
				return false;
			}

				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->ca_idsucursal = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_nombre = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_telefono = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_fax = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_direccion = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Sucursal object", $e);
		}
	}

	
	public function ensureConsistency()
	{

	} 
	
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SucursalPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = SucursalPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collUsuarios = null;
			$this->lastUsuarioCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseSucursal:delete:pre') as $callable)
    {
      $ret = call_user_func($callable, $this, $con);
      if ($ret)
      {
        return;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SucursalPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			SucursalPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseSucursal:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseSucursal:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SucursalPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseSucursal:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			SucursalPeer::addInstanceToPool($this);
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SucursalPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += SucursalPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collUsuarios !== null) {
				foreach ($this->collUsuarios as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = SucursalPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collUsuarios !== null) {
					foreach ($this->collUsuarios as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SucursalPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdsucursal();
				break;
			case 1:
				return $this->getCaNombre();
				break;
			case 2:
				return $this->getCaTelefono();
				break;
			case 3:
				return $this->getCaFax();
				break;
			case 4:
				return $this->getCaDireccion();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = SucursalPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdsucursal(),
			$keys[1] => $this->getCaNombre(),
			$keys[2] => $this->getCaTelefono(),
			$keys[3] => $this->getCaFax(),
			$keys[4] => $this->getCaDireccion(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SucursalPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdsucursal($value);
				break;
			case 1:
				$this->setCaNombre($value);
				break;
			case 2:
				$this->setCaTelefono($value);
				break;
			case 3:
				$this->setCaFax($value);
				break;
			case 4:
				$this->setCaDireccion($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SucursalPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdsucursal($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaTelefono($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaFax($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaDireccion($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SucursalPeer::DATABASE_NAME);

		if ($this->isColumnModified(SucursalPeer::CA_IDSUCURSAL)) $criteria->add(SucursalPeer::CA_IDSUCURSAL, $this->ca_idsucursal);
		if ($this->isColumnModified(SucursalPeer::CA_NOMBRE)) $criteria->add(SucursalPeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(SucursalPeer::CA_TELEFONO)) $criteria->add(SucursalPeer::CA_TELEFONO, $this->ca_telefono);
		if ($this->isColumnModified(SucursalPeer::CA_FAX)) $criteria->add(SucursalPeer::CA_FAX, $this->ca_fax);
		if ($this->isColumnModified(SucursalPeer::CA_DIRECCION)) $criteria->add(SucursalPeer::CA_DIRECCION, $this->ca_direccion);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SucursalPeer::DATABASE_NAME);

		$criteria->add(SucursalPeer::CA_IDSUCURSAL, $this->ca_idsucursal);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdsucursal();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdsucursal($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdsucursal($this->ca_idsucursal);

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaTelefono($this->ca_telefono);

		$copyObj->setCaFax($this->ca_fax);

		$copyObj->setCaDireccion($this->ca_direccion);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getUsuarios() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addUsuario($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SucursalPeer();
		}
		return self::$peer;
	}

	
	public function clearUsuarios()
	{
		$this->collUsuarios = null; 	}

	
	public function initUsuarios()
	{
		$this->collUsuarios = array();
	}

	
	public function getUsuarios($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SucursalPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUsuarios === null) {
			if ($this->isNew()) {
			   $this->collUsuarios = array();
			} else {

				$criteria->add(UsuarioPeer::CA_IDSUCURSAL, $this->ca_idsucursal);

				UsuarioPeer::addSelectColumns($criteria);
				$this->collUsuarios = UsuarioPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UsuarioPeer::CA_IDSUCURSAL, $this->ca_idsucursal);

				UsuarioPeer::addSelectColumns($criteria);
				if (!isset($this->lastUsuarioCriteria) || !$this->lastUsuarioCriteria->equals($criteria)) {
					$this->collUsuarios = UsuarioPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUsuarioCriteria = $criteria;
		return $this->collUsuarios;
	}

	
	public function countUsuarios(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(SucursalPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collUsuarios === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(UsuarioPeer::CA_IDSUCURSAL, $this->ca_idsucursal);

				$count = UsuarioPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UsuarioPeer::CA_IDSUCURSAL, $this->ca_idsucursal);

				if (!isset($this->lastUsuarioCriteria) || !$this->lastUsuarioCriteria->equals($criteria)) {
					$count = UsuarioPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collUsuarios);
				}
			} else {
				$count = count($this->collUsuarios);
			}
		}
		return $count;
	}

	
	public function addUsuario(Usuario $l)
	{
		if ($this->collUsuarios === null) {
			$this->initUsuarios();
		}
		if (!in_array($l, $this->collUsuarios, true)) { 			array_push($this->collUsuarios, $l);
			$l->setSucursal($this);
		}
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collUsuarios) {
				foreach ((array) $this->collUsuarios as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collUsuarios = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseSucursal:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseSucursal::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 