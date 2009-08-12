<?php


abstract class BaseIdsTipo extends BaseObject  implements Persistent {


  const PEER = 'IdsTipoPeer';

	
	protected static $peer;

	
	protected $ca_tipo;

	
	protected $ca_nombre;

	
	protected $ca_aplicacion;

	
	protected $collIdsProveedors;

	
	private $lastIdsProveedorCriteria = null;

	
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

	
	public function getCaTipo()
	{
		return $this->ca_tipo;
	}

	
	public function getCaNombre()
	{
		return $this->ca_nombre;
	}

	
	public function getCaAplicacion()
	{
		return $this->ca_aplicacion;
	}

	
	public function setCaTipo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_tipo !== $v) {
			$this->ca_tipo = $v;
			$this->modifiedColumns[] = IdsTipoPeer::CA_TIPO;
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
			$this->modifiedColumns[] = IdsTipoPeer::CA_NOMBRE;
		}

		return $this;
	} 
	
	public function setCaAplicacion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_aplicacion !== $v) {
			$this->ca_aplicacion = $v;
			$this->modifiedColumns[] = IdsTipoPeer::CA_APLICACION;
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

			$this->ca_tipo = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_nombre = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_aplicacion = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating IdsTipo object", $e);
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
			$con = Propel::getConnection(IdsTipoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = IdsTipoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collIdsProveedors = null;
			$this->lastIdsProveedorCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsTipo:delete:pre') as $callable)
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
			$con = Propel::getConnection(IdsTipoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			IdsTipoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseIdsTipo:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsTipo:save:pre') as $callable)
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
			$con = Propel::getConnection(IdsTipoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseIdsTipo:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			IdsTipoPeer::addInstanceToPool($this);
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
					$pk = IdsTipoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += IdsTipoPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collIdsProveedors !== null) {
				foreach ($this->collIdsProveedors as $referrerFK) {
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


			if (($retval = IdsTipoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collIdsProveedors !== null) {
					foreach ($this->collIdsProveedors as $referrerFK) {
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
		$pos = IdsTipoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaTipo();
				break;
			case 1:
				return $this->getCaNombre();
				break;
			case 2:
				return $this->getCaAplicacion();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = IdsTipoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaTipo(),
			$keys[1] => $this->getCaNombre(),
			$keys[2] => $this->getCaAplicacion(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = IdsTipoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaTipo($value);
				break;
			case 1:
				$this->setCaNombre($value);
				break;
			case 2:
				$this->setCaAplicacion($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = IdsTipoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaTipo($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaAplicacion($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(IdsTipoPeer::DATABASE_NAME);

		if ($this->isColumnModified(IdsTipoPeer::CA_TIPO)) $criteria->add(IdsTipoPeer::CA_TIPO, $this->ca_tipo);
		if ($this->isColumnModified(IdsTipoPeer::CA_NOMBRE)) $criteria->add(IdsTipoPeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(IdsTipoPeer::CA_APLICACION)) $criteria->add(IdsTipoPeer::CA_APLICACION, $this->ca_aplicacion);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(IdsTipoPeer::DATABASE_NAME);

		$criteria->add(IdsTipoPeer::CA_TIPO, $this->ca_tipo);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaTipo();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaTipo($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaTipo($this->ca_tipo);

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaAplicacion($this->ca_aplicacion);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getIdsProveedors() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addIdsProveedor($relObj->copy($deepCopy));
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
			self::$peer = new IdsTipoPeer();
		}
		return self::$peer;
	}

	
	public function clearIdsProveedors()
	{
		$this->collIdsProveedors = null; 	}

	
	public function initIdsProveedors()
	{
		$this->collIdsProveedors = array();
	}

	
	public function getIdsProveedors($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(IdsTipoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collIdsProveedors === null) {
			if ($this->isNew()) {
			   $this->collIdsProveedors = array();
			} else {

				$criteria->add(IdsProveedorPeer::CA_TIPO, $this->ca_tipo);

				IdsProveedorPeer::addSelectColumns($criteria);
				$this->collIdsProveedors = IdsProveedorPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(IdsProveedorPeer::CA_TIPO, $this->ca_tipo);

				IdsProveedorPeer::addSelectColumns($criteria);
				if (!isset($this->lastIdsProveedorCriteria) || !$this->lastIdsProveedorCriteria->equals($criteria)) {
					$this->collIdsProveedors = IdsProveedorPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastIdsProveedorCriteria = $criteria;
		return $this->collIdsProveedors;
	}

	
	public function countIdsProveedors(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(IdsTipoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collIdsProveedors === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(IdsProveedorPeer::CA_TIPO, $this->ca_tipo);

				$count = IdsProveedorPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(IdsProveedorPeer::CA_TIPO, $this->ca_tipo);

				if (!isset($this->lastIdsProveedorCriteria) || !$this->lastIdsProveedorCriteria->equals($criteria)) {
					$count = IdsProveedorPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collIdsProveedors);
				}
			} else {
				$count = count($this->collIdsProveedors);
			}
		}
		return $count;
	}

	
	public function addIdsProveedor(IdsProveedor $l)
	{
		if ($this->collIdsProveedors === null) {
			$this->initIdsProveedors();
		}
		if (!in_array($l, $this->collIdsProveedors, true)) { 			array_push($this->collIdsProveedors, $l);
			$l->setIdsTipo($this);
		}
	}


	
	public function getIdsProveedorsJoinIds($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(IdsTipoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collIdsProveedors === null) {
			if ($this->isNew()) {
				$this->collIdsProveedors = array();
			} else {

				$criteria->add(IdsProveedorPeer::CA_TIPO, $this->ca_tipo);

				$this->collIdsProveedors = IdsProveedorPeer::doSelectJoinIds($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(IdsProveedorPeer::CA_TIPO, $this->ca_tipo);

			if (!isset($this->lastIdsProveedorCriteria) || !$this->lastIdsProveedorCriteria->equals($criteria)) {
				$this->collIdsProveedors = IdsProveedorPeer::doSelectJoinIds($criteria, $con, $join_behavior);
			}
		}
		$this->lastIdsProveedorCriteria = $criteria;

		return $this->collIdsProveedors;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collIdsProveedors) {
				foreach ((array) $this->collIdsProveedors as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collIdsProveedors = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseIdsTipo:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseIdsTipo::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 