<?php


abstract class BaseRutina extends BaseObject  implements Persistent {


  const PEER = 'RutinaPeer';

	
	protected static $peer;

	
	protected $ca_rutina;

	
	protected $ca_opcion;

	
	protected $ca_descripcion;

	
	protected $ca_programa;

	
	protected $ca_grupo;

	
	protected $collRutinaNivels;

	
	private $lastRutinaNivelCriteria = null;

	
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

	
	public function getCaRutina()
	{
		return $this->ca_rutina;
	}

	
	public function getCaOpcion()
	{
		return $this->ca_opcion;
	}

	
	public function getCaDescripcion()
	{
		return $this->ca_descripcion;
	}

	
	public function getCaPrograma()
	{
		return $this->ca_programa;
	}

	
	public function getCaGrupo()
	{
		return $this->ca_grupo;
	}

	
	public function setCaRutina($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_rutina !== $v) {
			$this->ca_rutina = $v;
			$this->modifiedColumns[] = RutinaPeer::CA_RUTINA;
		}

		return $this;
	} 
	
	public function setCaOpcion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_opcion !== $v) {
			$this->ca_opcion = $v;
			$this->modifiedColumns[] = RutinaPeer::CA_OPCION;
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
			$this->modifiedColumns[] = RutinaPeer::CA_DESCRIPCION;
		}

		return $this;
	} 
	
	public function setCaPrograma($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_programa !== $v) {
			$this->ca_programa = $v;
			$this->modifiedColumns[] = RutinaPeer::CA_PROGRAMA;
		}

		return $this;
	} 
	
	public function setCaGrupo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_grupo !== $v) {
			$this->ca_grupo = $v;
			$this->modifiedColumns[] = RutinaPeer::CA_GRUPO;
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

			$this->ca_rutina = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_opcion = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_descripcion = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_programa = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_grupo = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Rutina object", $e);
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
			$con = Propel::getConnection(RutinaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = RutinaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collRutinaNivels = null;
			$this->lastRutinaNivelCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRutina:delete:pre') as $callable)
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
			$con = Propel::getConnection(RutinaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			RutinaPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseRutina:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRutina:save:pre') as $callable)
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
			$con = Propel::getConnection(RutinaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseRutina:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			RutinaPeer::addInstanceToPool($this);
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
					$pk = RutinaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += RutinaPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collRutinaNivels !== null) {
				foreach ($this->collRutinaNivels as $referrerFK) {
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


			if (($retval = RutinaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collRutinaNivels !== null) {
					foreach ($this->collRutinaNivels as $referrerFK) {
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
		$pos = RutinaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaRutina();
				break;
			case 1:
				return $this->getCaOpcion();
				break;
			case 2:
				return $this->getCaDescripcion();
				break;
			case 3:
				return $this->getCaPrograma();
				break;
			case 4:
				return $this->getCaGrupo();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = RutinaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaRutina(),
			$keys[1] => $this->getCaOpcion(),
			$keys[2] => $this->getCaDescripcion(),
			$keys[3] => $this->getCaPrograma(),
			$keys[4] => $this->getCaGrupo(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RutinaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaRutina($value);
				break;
			case 1:
				$this->setCaOpcion($value);
				break;
			case 2:
				$this->setCaDescripcion($value);
				break;
			case 3:
				$this->setCaPrograma($value);
				break;
			case 4:
				$this->setCaGrupo($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RutinaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaRutina($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaOpcion($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaDescripcion($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaPrograma($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaGrupo($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RutinaPeer::DATABASE_NAME);

		if ($this->isColumnModified(RutinaPeer::CA_RUTINA)) $criteria->add(RutinaPeer::CA_RUTINA, $this->ca_rutina);
		if ($this->isColumnModified(RutinaPeer::CA_OPCION)) $criteria->add(RutinaPeer::CA_OPCION, $this->ca_opcion);
		if ($this->isColumnModified(RutinaPeer::CA_DESCRIPCION)) $criteria->add(RutinaPeer::CA_DESCRIPCION, $this->ca_descripcion);
		if ($this->isColumnModified(RutinaPeer::CA_PROGRAMA)) $criteria->add(RutinaPeer::CA_PROGRAMA, $this->ca_programa);
		if ($this->isColumnModified(RutinaPeer::CA_GRUPO)) $criteria->add(RutinaPeer::CA_GRUPO, $this->ca_grupo);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RutinaPeer::DATABASE_NAME);

		$criteria->add(RutinaPeer::CA_RUTINA, $this->ca_rutina);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaRutina();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaRutina($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaRutina($this->ca_rutina);

		$copyObj->setCaOpcion($this->ca_opcion);

		$copyObj->setCaDescripcion($this->ca_descripcion);

		$copyObj->setCaPrograma($this->ca_programa);

		$copyObj->setCaGrupo($this->ca_grupo);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getRutinaNivels() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addRutinaNivel($relObj->copy($deepCopy));
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
			self::$peer = new RutinaPeer();
		}
		return self::$peer;
	}

	
	public function clearRutinaNivels()
	{
		$this->collRutinaNivels = null; 	}

	
	public function initRutinaNivels()
	{
		$this->collRutinaNivels = array();
	}

	
	public function getRutinaNivels($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(RutinaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRutinaNivels === null) {
			if ($this->isNew()) {
			   $this->collRutinaNivels = array();
			} else {

				$criteria->add(RutinaNivelPeer::CA_RUTINA, $this->ca_rutina);

				RutinaNivelPeer::addSelectColumns($criteria);
				$this->collRutinaNivels = RutinaNivelPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RutinaNivelPeer::CA_RUTINA, $this->ca_rutina);

				RutinaNivelPeer::addSelectColumns($criteria);
				if (!isset($this->lastRutinaNivelCriteria) || !$this->lastRutinaNivelCriteria->equals($criteria)) {
					$this->collRutinaNivels = RutinaNivelPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRutinaNivelCriteria = $criteria;
		return $this->collRutinaNivels;
	}

	
	public function countRutinaNivels(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(RutinaPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRutinaNivels === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RutinaNivelPeer::CA_RUTINA, $this->ca_rutina);

				$count = RutinaNivelPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RutinaNivelPeer::CA_RUTINA, $this->ca_rutina);

				if (!isset($this->lastRutinaNivelCriteria) || !$this->lastRutinaNivelCriteria->equals($criteria)) {
					$count = RutinaNivelPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRutinaNivels);
				}
			} else {
				$count = count($this->collRutinaNivels);
			}
		}
		return $count;
	}

	
	public function addRutinaNivel(RutinaNivel $l)
	{
		if ($this->collRutinaNivels === null) {
			$this->initRutinaNivels();
		}
		if (!in_array($l, $this->collRutinaNivels, true)) { 			array_push($this->collRutinaNivels, $l);
			$l->setRutina($this);
		}
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collRutinaNivels) {
				foreach ((array) $this->collRutinaNivels as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collRutinaNivels = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseRutina:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseRutina::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 