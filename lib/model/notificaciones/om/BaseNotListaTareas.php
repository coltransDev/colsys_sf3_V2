<?php


abstract class BaseNotListaTareas extends BaseObject  implements Persistent {


  const PEER = 'NotListaTareasPeer';

	
	protected static $peer;

	
	protected $ca_idlistatarea;

	
	protected $ca_nombre;

	
	protected $ca_descripcion;

	
	protected $collNotTareas;

	
	private $lastNotTareaCriteria = null;

	
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

	
	public function getCaIdlistatarea()
	{
		return $this->ca_idlistatarea;
	}

	
	public function getCaNombre()
	{
		return $this->ca_nombre;
	}

	
	public function getCaDescripcion()
	{
		return $this->ca_descripcion;
	}

	
	public function setCaIdlistatarea($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idlistatarea !== $v) {
			$this->ca_idlistatarea = $v;
			$this->modifiedColumns[] = NotListaTareasPeer::CA_IDLISTATAREA;
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
			$this->modifiedColumns[] = NotListaTareasPeer::CA_NOMBRE;
		}

		return $this;
	} 
	
	public function setCaDescripcion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_descripcion !== $v) {
			$this->ca_descripcion = $v;
			$this->modifiedColumns[] = NotListaTareasPeer::CA_DESCRIPCION;
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

			$this->ca_idlistatarea = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_nombre = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_descripcion = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating NotListaTareas object", $e);
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
			$con = Propel::getConnection(NotListaTareasPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = NotListaTareasPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collNotTareas = null;
			$this->lastNotTareaCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseNotListaTareas:delete:pre') as $callable)
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
			$con = Propel::getConnection(NotListaTareasPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			NotListaTareasPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseNotListaTareas:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseNotListaTareas:save:pre') as $callable)
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
			$con = Propel::getConnection(NotListaTareasPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseNotListaTareas:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			NotListaTareasPeer::addInstanceToPool($this);
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

			if ($this->isNew() ) {
				$this->modifiedColumns[] = NotListaTareasPeer::CA_IDLISTATAREA;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = NotListaTareasPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdlistatarea($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += NotListaTareasPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collNotTareas !== null) {
				foreach ($this->collNotTareas as $referrerFK) {
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


			if (($retval = NotListaTareasPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collNotTareas !== null) {
					foreach ($this->collNotTareas as $referrerFK) {
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
		$pos = NotListaTareasPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdlistatarea();
				break;
			case 1:
				return $this->getCaNombre();
				break;
			case 2:
				return $this->getCaDescripcion();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = NotListaTareasPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdlistatarea(),
			$keys[1] => $this->getCaNombre(),
			$keys[2] => $this->getCaDescripcion(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = NotListaTareasPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdlistatarea($value);
				break;
			case 1:
				$this->setCaNombre($value);
				break;
			case 2:
				$this->setCaDescripcion($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = NotListaTareasPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdlistatarea($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaDescripcion($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(NotListaTareasPeer::DATABASE_NAME);

		if ($this->isColumnModified(NotListaTareasPeer::CA_IDLISTATAREA)) $criteria->add(NotListaTareasPeer::CA_IDLISTATAREA, $this->ca_idlistatarea);
		if ($this->isColumnModified(NotListaTareasPeer::CA_NOMBRE)) $criteria->add(NotListaTareasPeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(NotListaTareasPeer::CA_DESCRIPCION)) $criteria->add(NotListaTareasPeer::CA_DESCRIPCION, $this->ca_descripcion);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(NotListaTareasPeer::DATABASE_NAME);

		$criteria->add(NotListaTareasPeer::CA_IDLISTATAREA, $this->ca_idlistatarea);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdlistatarea();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdlistatarea($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaDescripcion($this->ca_descripcion);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getNotTareas() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addNotTarea($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCaIdlistatarea(NULL); 
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
			self::$peer = new NotListaTareasPeer();
		}
		return self::$peer;
	}

	
	public function clearNotTareas()
	{
		$this->collNotTareas = null; 	}

	
	public function initNotTareas()
	{
		$this->collNotTareas = array();
	}

	
	public function getNotTareas($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotListaTareasPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotTareas === null) {
			if ($this->isNew()) {
			   $this->collNotTareas = array();
			} else {

				$criteria->add(NotTareaPeer::CA_IDLISTATAREA, $this->ca_idlistatarea);

				NotTareaPeer::addSelectColumns($criteria);
				$this->collNotTareas = NotTareaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NotTareaPeer::CA_IDLISTATAREA, $this->ca_idlistatarea);

				NotTareaPeer::addSelectColumns($criteria);
				if (!isset($this->lastNotTareaCriteria) || !$this->lastNotTareaCriteria->equals($criteria)) {
					$this->collNotTareas = NotTareaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastNotTareaCriteria = $criteria;
		return $this->collNotTareas;
	}

	
	public function countNotTareas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotListaTareasPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collNotTareas === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(NotTareaPeer::CA_IDLISTATAREA, $this->ca_idlistatarea);

				$count = NotTareaPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NotTareaPeer::CA_IDLISTATAREA, $this->ca_idlistatarea);

				if (!isset($this->lastNotTareaCriteria) || !$this->lastNotTareaCriteria->equals($criteria)) {
					$count = NotTareaPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collNotTareas);
				}
			} else {
				$count = count($this->collNotTareas);
			}
		}
		return $count;
	}

	
	public function addNotTarea(NotTarea $l)
	{
		if ($this->collNotTareas === null) {
			$this->initNotTareas();
		}
		if (!in_array($l, $this->collNotTareas, true)) { 			array_push($this->collNotTareas, $l);
			$l->setNotListaTareas($this);
		}
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collNotTareas) {
				foreach ((array) $this->collNotTareas as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collNotTareas = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseNotListaTareas:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseNotListaTareas::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 