<?php


abstract class BaseCiudad extends BaseObject  implements Persistent {


  const PEER = 'CiudadPeer';

	
	protected static $peer;

	
	protected $ca_idciudad;

	
	protected $ca_ciudad;

	
	protected $ca_idtrafico;

	
	protected $ca_puerto;

	
	protected $aTrafico;

	
	protected $collPricRecargosxCiudads;

	
	private $lastPricRecargosxCiudadCriteria = null;

	
	protected $collPricRecargosxCiudadLogs;

	
	private $lastPricRecargosxCiudadLogCriteria = null;

	
	protected $collPricPatios;

	
	private $lastPricPatioCriteria = null;

	
	protected $collClientes;

	
	private $lastClienteCriteria = null;

	
	protected $collAgentes;

	
	private $lastAgenteCriteria = null;

	
	protected $collContactoAgentes;

	
	private $lastContactoAgenteCriteria = null;

	
	protected $collIdsSucursals;

	
	private $lastIdsSucursalCriteria = null;

	
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

	
	public function getCaIdciudad()
	{
		return $this->ca_idciudad;
	}

	
	public function getCaCiudad()
	{
		return $this->ca_ciudad;
	}

	
	public function getCaIdtrafico()
	{
		return $this->ca_idtrafico;
	}

	
	public function getCaPuerto()
	{
		return $this->ca_puerto;
	}

	
	public function setCaIdciudad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idciudad !== $v) {
			$this->ca_idciudad = $v;
			$this->modifiedColumns[] = CiudadPeer::CA_IDCIUDAD;
		}

		return $this;
	} 
	
	public function setCaCiudad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_ciudad !== $v) {
			$this->ca_ciudad = $v;
			$this->modifiedColumns[] = CiudadPeer::CA_CIUDAD;
		}

		return $this;
	} 
	
	public function setCaIdtrafico($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idtrafico !== $v) {
			$this->ca_idtrafico = $v;
			$this->modifiedColumns[] = CiudadPeer::CA_IDTRAFICO;
		}

		if ($this->aTrafico !== null && $this->aTrafico->getCaIdtrafico() !== $v) {
			$this->aTrafico = null;
		}

		return $this;
	} 
	
	public function setCaPuerto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_puerto !== $v) {
			$this->ca_puerto = $v;
			$this->modifiedColumns[] = CiudadPeer::CA_PUERTO;
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

			$this->ca_idciudad = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_ciudad = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_idtrafico = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_puerto = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Ciudad object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aTrafico !== null && $this->ca_idtrafico !== $this->aTrafico->getCaIdtrafico()) {
			$this->aTrafico = null;
		}
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
			$con = Propel::getConnection(CiudadPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = CiudadPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aTrafico = null;
			$this->collPricRecargosxCiudads = null;
			$this->lastPricRecargosxCiudadCriteria = null;

			$this->collPricRecargosxCiudadLogs = null;
			$this->lastPricRecargosxCiudadLogCriteria = null;

			$this->collPricPatios = null;
			$this->lastPricPatioCriteria = null;

			$this->collClientes = null;
			$this->lastClienteCriteria = null;

			$this->collAgentes = null;
			$this->lastAgenteCriteria = null;

			$this->collContactoAgentes = null;
			$this->lastContactoAgenteCriteria = null;

			$this->collIdsSucursals = null;
			$this->lastIdsSucursalCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCiudad:delete:pre') as $callable)
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
			$con = Propel::getConnection(CiudadPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			CiudadPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseCiudad:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCiudad:save:pre') as $callable)
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
			$con = Propel::getConnection(CiudadPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseCiudad:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			CiudadPeer::addInstanceToPool($this);
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

												
			if ($this->aTrafico !== null) {
				if ($this->aTrafico->isModified() || $this->aTrafico->isNew()) {
					$affectedRows += $this->aTrafico->save($con);
				}
				$this->setTrafico($this->aTrafico);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CiudadPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += CiudadPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collPricRecargosxCiudads !== null) {
				foreach ($this->collPricRecargosxCiudads as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPricRecargosxCiudadLogs !== null) {
				foreach ($this->collPricRecargosxCiudadLogs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPricPatios !== null) {
				foreach ($this->collPricPatios as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collClientes !== null) {
				foreach ($this->collClientes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collAgentes !== null) {
				foreach ($this->collAgentes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collContactoAgentes !== null) {
				foreach ($this->collContactoAgentes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collIdsSucursals !== null) {
				foreach ($this->collIdsSucursals as $referrerFK) {
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


												
			if ($this->aTrafico !== null) {
				if (!$this->aTrafico->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTrafico->getValidationFailures());
				}
			}


			if (($retval = CiudadPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPricRecargosxCiudads !== null) {
					foreach ($this->collPricRecargosxCiudads as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPricRecargosxCiudadLogs !== null) {
					foreach ($this->collPricRecargosxCiudadLogs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPricPatios !== null) {
					foreach ($this->collPricPatios as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collClientes !== null) {
					foreach ($this->collClientes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collAgentes !== null) {
					foreach ($this->collAgentes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collContactoAgentes !== null) {
					foreach ($this->collContactoAgentes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collIdsSucursals !== null) {
					foreach ($this->collIdsSucursals as $referrerFK) {
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
		$pos = CiudadPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdciudad();
				break;
			case 1:
				return $this->getCaCiudad();
				break;
			case 2:
				return $this->getCaIdtrafico();
				break;
			case 3:
				return $this->getCaPuerto();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = CiudadPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdciudad(),
			$keys[1] => $this->getCaCiudad(),
			$keys[2] => $this->getCaIdtrafico(),
			$keys[3] => $this->getCaPuerto(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CiudadPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdciudad($value);
				break;
			case 1:
				$this->setCaCiudad($value);
				break;
			case 2:
				$this->setCaIdtrafico($value);
				break;
			case 3:
				$this->setCaPuerto($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CiudadPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdciudad($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaCiudad($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdtrafico($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaPuerto($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CiudadPeer::DATABASE_NAME);

		if ($this->isColumnModified(CiudadPeer::CA_IDCIUDAD)) $criteria->add(CiudadPeer::CA_IDCIUDAD, $this->ca_idciudad);
		if ($this->isColumnModified(CiudadPeer::CA_CIUDAD)) $criteria->add(CiudadPeer::CA_CIUDAD, $this->ca_ciudad);
		if ($this->isColumnModified(CiudadPeer::CA_IDTRAFICO)) $criteria->add(CiudadPeer::CA_IDTRAFICO, $this->ca_idtrafico);
		if ($this->isColumnModified(CiudadPeer::CA_PUERTO)) $criteria->add(CiudadPeer::CA_PUERTO, $this->ca_puerto);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CiudadPeer::DATABASE_NAME);

		$criteria->add(CiudadPeer::CA_IDCIUDAD, $this->ca_idciudad);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdciudad();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdciudad($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdciudad($this->ca_idciudad);

		$copyObj->setCaCiudad($this->ca_ciudad);

		$copyObj->setCaIdtrafico($this->ca_idtrafico);

		$copyObj->setCaPuerto($this->ca_puerto);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getPricRecargosxCiudads() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addPricRecargosxCiudad($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPricRecargosxCiudadLogs() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addPricRecargosxCiudadLog($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPricPatios() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addPricPatio($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getClientes() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addCliente($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getAgentes() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addAgente($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getContactoAgentes() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addContactoAgente($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getIdsSucursals() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addIdsSucursal($relObj->copy($deepCopy));
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
			self::$peer = new CiudadPeer();
		}
		return self::$peer;
	}

	
	public function setTrafico(Trafico $v = null)
	{
		if ($v === null) {
			$this->setCaIdtrafico(NULL);
		} else {
			$this->setCaIdtrafico($v->getCaIdtrafico());
		}

		$this->aTrafico = $v;

						if ($v !== null) {
			$v->addCiudad($this);
		}

		return $this;
	}


	
	public function getTrafico(PropelPDO $con = null)
	{
		if ($this->aTrafico === null && (($this->ca_idtrafico !== "" && $this->ca_idtrafico !== null))) {
			$c = new Criteria(TraficoPeer::DATABASE_NAME);
			$c->add(TraficoPeer::CA_IDTRAFICO, $this->ca_idtrafico);
			$this->aTrafico = TraficoPeer::doSelectOne($c, $con);
			
		}
		return $this->aTrafico;
	}

	
	public function clearPricRecargosxCiudads()
	{
		$this->collPricRecargosxCiudads = null; 	}

	
	public function initPricRecargosxCiudads()
	{
		$this->collPricRecargosxCiudads = array();
	}

	
	public function getPricRecargosxCiudads($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxCiudads === null) {
			if ($this->isNew()) {
			   $this->collPricRecargosxCiudads = array();
			} else {

				$criteria->add(PricRecargosxCiudadPeer::CA_IDCIUDAD, $this->ca_idciudad);

				PricRecargosxCiudadPeer::addSelectColumns($criteria);
				$this->collPricRecargosxCiudads = PricRecargosxCiudadPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargosxCiudadPeer::CA_IDCIUDAD, $this->ca_idciudad);

				PricRecargosxCiudadPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricRecargosxCiudadCriteria) || !$this->lastPricRecargosxCiudadCriteria->equals($criteria)) {
					$this->collPricRecargosxCiudads = PricRecargosxCiudadPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricRecargosxCiudadCriteria = $criteria;
		return $this->collPricRecargosxCiudads;
	}

	
	public function countPricRecargosxCiudads(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricRecargosxCiudads === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricRecargosxCiudadPeer::CA_IDCIUDAD, $this->ca_idciudad);

				$count = PricRecargosxCiudadPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargosxCiudadPeer::CA_IDCIUDAD, $this->ca_idciudad);

				if (!isset($this->lastPricRecargosxCiudadCriteria) || !$this->lastPricRecargosxCiudadCriteria->equals($criteria)) {
					$count = PricRecargosxCiudadPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricRecargosxCiudads);
				}
			} else {
				$count = count($this->collPricRecargosxCiudads);
			}
		}
		return $count;
	}

	
	public function addPricRecargosxCiudad(PricRecargosxCiudad $l)
	{
		if ($this->collPricRecargosxCiudads === null) {
			$this->initPricRecargosxCiudads();
		}
		if (!in_array($l, $this->collPricRecargosxCiudads, true)) { 			array_push($this->collPricRecargosxCiudads, $l);
			$l->setCiudad($this);
		}
	}


	
	public function getPricRecargosxCiudadsJoinTipoRecargo($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxCiudads === null) {
			if ($this->isNew()) {
				$this->collPricRecargosxCiudads = array();
			} else {

				$criteria->add(PricRecargosxCiudadPeer::CA_IDCIUDAD, $this->ca_idciudad);

				$this->collPricRecargosxCiudads = PricRecargosxCiudadPeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(PricRecargosxCiudadPeer::CA_IDCIUDAD, $this->ca_idciudad);

			if (!isset($this->lastPricRecargosxCiudadCriteria) || !$this->lastPricRecargosxCiudadCriteria->equals($criteria)) {
				$this->collPricRecargosxCiudads = PricRecargosxCiudadPeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricRecargosxCiudadCriteria = $criteria;

		return $this->collPricRecargosxCiudads;
	}

	
	public function clearPricRecargosxCiudadLogs()
	{
		$this->collPricRecargosxCiudadLogs = null; 	}

	
	public function initPricRecargosxCiudadLogs()
	{
		$this->collPricRecargosxCiudadLogs = array();
	}

	
	public function getPricRecargosxCiudadLogs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxCiudadLogs === null) {
			if ($this->isNew()) {
			   $this->collPricRecargosxCiudadLogs = array();
			} else {

				$criteria->add(PricRecargosxCiudadLogPeer::CA_IDCIUDAD, $this->ca_idciudad);

				PricRecargosxCiudadLogPeer::addSelectColumns($criteria);
				$this->collPricRecargosxCiudadLogs = PricRecargosxCiudadLogPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargosxCiudadLogPeer::CA_IDCIUDAD, $this->ca_idciudad);

				PricRecargosxCiudadLogPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricRecargosxCiudadLogCriteria) || !$this->lastPricRecargosxCiudadLogCriteria->equals($criteria)) {
					$this->collPricRecargosxCiudadLogs = PricRecargosxCiudadLogPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricRecargosxCiudadLogCriteria = $criteria;
		return $this->collPricRecargosxCiudadLogs;
	}

	
	public function countPricRecargosxCiudadLogs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricRecargosxCiudadLogs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricRecargosxCiudadLogPeer::CA_IDCIUDAD, $this->ca_idciudad);

				$count = PricRecargosxCiudadLogPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargosxCiudadLogPeer::CA_IDCIUDAD, $this->ca_idciudad);

				if (!isset($this->lastPricRecargosxCiudadLogCriteria) || !$this->lastPricRecargosxCiudadLogCriteria->equals($criteria)) {
					$count = PricRecargosxCiudadLogPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricRecargosxCiudadLogs);
				}
			} else {
				$count = count($this->collPricRecargosxCiudadLogs);
			}
		}
		return $count;
	}

	
	public function addPricRecargosxCiudadLog(PricRecargosxCiudadLog $l)
	{
		if ($this->collPricRecargosxCiudadLogs === null) {
			$this->initPricRecargosxCiudadLogs();
		}
		if (!in_array($l, $this->collPricRecargosxCiudadLogs, true)) { 			array_push($this->collPricRecargosxCiudadLogs, $l);
			$l->setCiudad($this);
		}
	}


	
	public function getPricRecargosxCiudadLogsJoinTipoRecargo($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxCiudadLogs === null) {
			if ($this->isNew()) {
				$this->collPricRecargosxCiudadLogs = array();
			} else {

				$criteria->add(PricRecargosxCiudadLogPeer::CA_IDCIUDAD, $this->ca_idciudad);

				$this->collPricRecargosxCiudadLogs = PricRecargosxCiudadLogPeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(PricRecargosxCiudadLogPeer::CA_IDCIUDAD, $this->ca_idciudad);

			if (!isset($this->lastPricRecargosxCiudadLogCriteria) || !$this->lastPricRecargosxCiudadLogCriteria->equals($criteria)) {
				$this->collPricRecargosxCiudadLogs = PricRecargosxCiudadLogPeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricRecargosxCiudadLogCriteria = $criteria;

		return $this->collPricRecargosxCiudadLogs;
	}

	
	public function clearPricPatios()
	{
		$this->collPricPatios = null; 	}

	
	public function initPricPatios()
	{
		$this->collPricPatios = array();
	}

	
	public function getPricPatios($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricPatios === null) {
			if ($this->isNew()) {
			   $this->collPricPatios = array();
			} else {

				$criteria->add(PricPatioPeer::CA_IDCIUDAD, $this->ca_idciudad);

				PricPatioPeer::addSelectColumns($criteria);
				$this->collPricPatios = PricPatioPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricPatioPeer::CA_IDCIUDAD, $this->ca_idciudad);

				PricPatioPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricPatioCriteria) || !$this->lastPricPatioCriteria->equals($criteria)) {
					$this->collPricPatios = PricPatioPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricPatioCriteria = $criteria;
		return $this->collPricPatios;
	}

	
	public function countPricPatios(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricPatios === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricPatioPeer::CA_IDCIUDAD, $this->ca_idciudad);

				$count = PricPatioPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricPatioPeer::CA_IDCIUDAD, $this->ca_idciudad);

				if (!isset($this->lastPricPatioCriteria) || !$this->lastPricPatioCriteria->equals($criteria)) {
					$count = PricPatioPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricPatios);
				}
			} else {
				$count = count($this->collPricPatios);
			}
		}
		return $count;
	}

	
	public function addPricPatio(PricPatio $l)
	{
		if ($this->collPricPatios === null) {
			$this->initPricPatios();
		}
		if (!in_array($l, $this->collPricPatios, true)) { 			array_push($this->collPricPatios, $l);
			$l->setCiudad($this);
		}
	}

	
	public function clearClientes()
	{
		$this->collClientes = null; 	}

	
	public function initClientes()
	{
		$this->collClientes = array();
	}

	
	public function getClientes($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClientes === null) {
			if ($this->isNew()) {
			   $this->collClientes = array();
			} else {

				$criteria->add(ClientePeer::CA_IDCIUDAD, $this->ca_idciudad);

				ClientePeer::addSelectColumns($criteria);
				$this->collClientes = ClientePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ClientePeer::CA_IDCIUDAD, $this->ca_idciudad);

				ClientePeer::addSelectColumns($criteria);
				if (!isset($this->lastClienteCriteria) || !$this->lastClienteCriteria->equals($criteria)) {
					$this->collClientes = ClientePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastClienteCriteria = $criteria;
		return $this->collClientes;
	}

	
	public function countClientes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collClientes === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ClientePeer::CA_IDCIUDAD, $this->ca_idciudad);

				$count = ClientePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ClientePeer::CA_IDCIUDAD, $this->ca_idciudad);

				if (!isset($this->lastClienteCriteria) || !$this->lastClienteCriteria->equals($criteria)) {
					$count = ClientePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collClientes);
				}
			} else {
				$count = count($this->collClientes);
			}
		}
		return $count;
	}

	
	public function addCliente(Cliente $l)
	{
		if ($this->collClientes === null) {
			$this->initClientes();
		}
		if (!in_array($l, $this->collClientes, true)) { 			array_push($this->collClientes, $l);
			$l->setCiudad($this);
		}
	}

	
	public function clearAgentes()
	{
		$this->collAgentes = null; 	}

	
	public function initAgentes()
	{
		$this->collAgentes = array();
	}

	
	public function getAgentes($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAgentes === null) {
			if ($this->isNew()) {
			   $this->collAgentes = array();
			} else {

				$criteria->add(AgentePeer::CA_IDCIUDAD, $this->ca_idciudad);

				AgentePeer::addSelectColumns($criteria);
				$this->collAgentes = AgentePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AgentePeer::CA_IDCIUDAD, $this->ca_idciudad);

				AgentePeer::addSelectColumns($criteria);
				if (!isset($this->lastAgenteCriteria) || !$this->lastAgenteCriteria->equals($criteria)) {
					$this->collAgentes = AgentePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAgenteCriteria = $criteria;
		return $this->collAgentes;
	}

	
	public function countAgentes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collAgentes === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(AgentePeer::CA_IDCIUDAD, $this->ca_idciudad);

				$count = AgentePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AgentePeer::CA_IDCIUDAD, $this->ca_idciudad);

				if (!isset($this->lastAgenteCriteria) || !$this->lastAgenteCriteria->equals($criteria)) {
					$count = AgentePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collAgentes);
				}
			} else {
				$count = count($this->collAgentes);
			}
		}
		return $count;
	}

	
	public function addAgente(Agente $l)
	{
		if ($this->collAgentes === null) {
			$this->initAgentes();
		}
		if (!in_array($l, $this->collAgentes, true)) { 			array_push($this->collAgentes, $l);
			$l->setCiudad($this);
		}
	}

	
	public function clearContactoAgentes()
	{
		$this->collContactoAgentes = null; 	}

	
	public function initContactoAgentes()
	{
		$this->collContactoAgentes = array();
	}

	
	public function getContactoAgentes($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collContactoAgentes === null) {
			if ($this->isNew()) {
			   $this->collContactoAgentes = array();
			} else {

				$criteria->add(ContactoAgentePeer::CA_IDCIUDAD, $this->ca_idciudad);

				ContactoAgentePeer::addSelectColumns($criteria);
				$this->collContactoAgentes = ContactoAgentePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ContactoAgentePeer::CA_IDCIUDAD, $this->ca_idciudad);

				ContactoAgentePeer::addSelectColumns($criteria);
				if (!isset($this->lastContactoAgenteCriteria) || !$this->lastContactoAgenteCriteria->equals($criteria)) {
					$this->collContactoAgentes = ContactoAgentePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastContactoAgenteCriteria = $criteria;
		return $this->collContactoAgentes;
	}

	
	public function countContactoAgentes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collContactoAgentes === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ContactoAgentePeer::CA_IDCIUDAD, $this->ca_idciudad);

				$count = ContactoAgentePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ContactoAgentePeer::CA_IDCIUDAD, $this->ca_idciudad);

				if (!isset($this->lastContactoAgenteCriteria) || !$this->lastContactoAgenteCriteria->equals($criteria)) {
					$count = ContactoAgentePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collContactoAgentes);
				}
			} else {
				$count = count($this->collContactoAgentes);
			}
		}
		return $count;
	}

	
	public function addContactoAgente(ContactoAgente $l)
	{
		if ($this->collContactoAgentes === null) {
			$this->initContactoAgentes();
		}
		if (!in_array($l, $this->collContactoAgentes, true)) { 			array_push($this->collContactoAgentes, $l);
			$l->setCiudad($this);
		}
	}


	
	public function getContactoAgentesJoinAgente($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collContactoAgentes === null) {
			if ($this->isNew()) {
				$this->collContactoAgentes = array();
			} else {

				$criteria->add(ContactoAgentePeer::CA_IDCIUDAD, $this->ca_idciudad);

				$this->collContactoAgentes = ContactoAgentePeer::doSelectJoinAgente($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ContactoAgentePeer::CA_IDCIUDAD, $this->ca_idciudad);

			if (!isset($this->lastContactoAgenteCriteria) || !$this->lastContactoAgenteCriteria->equals($criteria)) {
				$this->collContactoAgentes = ContactoAgentePeer::doSelectJoinAgente($criteria, $con, $join_behavior);
			}
		}
		$this->lastContactoAgenteCriteria = $criteria;

		return $this->collContactoAgentes;
	}

	
	public function clearIdsSucursals()
	{
		$this->collIdsSucursals = null; 	}

	
	public function initIdsSucursals()
	{
		$this->collIdsSucursals = array();
	}

	
	public function getIdsSucursals($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collIdsSucursals === null) {
			if ($this->isNew()) {
			   $this->collIdsSucursals = array();
			} else {

				$criteria->add(IdsSucursalPeer::CA_IDCIUDAD, $this->ca_idciudad);

				IdsSucursalPeer::addSelectColumns($criteria);
				$this->collIdsSucursals = IdsSucursalPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(IdsSucursalPeer::CA_IDCIUDAD, $this->ca_idciudad);

				IdsSucursalPeer::addSelectColumns($criteria);
				if (!isset($this->lastIdsSucursalCriteria) || !$this->lastIdsSucursalCriteria->equals($criteria)) {
					$this->collIdsSucursals = IdsSucursalPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastIdsSucursalCriteria = $criteria;
		return $this->collIdsSucursals;
	}

	
	public function countIdsSucursals(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collIdsSucursals === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(IdsSucursalPeer::CA_IDCIUDAD, $this->ca_idciudad);

				$count = IdsSucursalPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(IdsSucursalPeer::CA_IDCIUDAD, $this->ca_idciudad);

				if (!isset($this->lastIdsSucursalCriteria) || !$this->lastIdsSucursalCriteria->equals($criteria)) {
					$count = IdsSucursalPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collIdsSucursals);
				}
			} else {
				$count = count($this->collIdsSucursals);
			}
		}
		return $count;
	}

	
	public function addIdsSucursal(IdsSucursal $l)
	{
		if ($this->collIdsSucursals === null) {
			$this->initIdsSucursals();
		}
		if (!in_array($l, $this->collIdsSucursals, true)) { 			array_push($this->collIdsSucursals, $l);
			$l->setCiudad($this);
		}
	}


	
	public function getIdsSucursalsJoinIds($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CiudadPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collIdsSucursals === null) {
			if ($this->isNew()) {
				$this->collIdsSucursals = array();
			} else {

				$criteria->add(IdsSucursalPeer::CA_IDCIUDAD, $this->ca_idciudad);

				$this->collIdsSucursals = IdsSucursalPeer::doSelectJoinIds($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(IdsSucursalPeer::CA_IDCIUDAD, $this->ca_idciudad);

			if (!isset($this->lastIdsSucursalCriteria) || !$this->lastIdsSucursalCriteria->equals($criteria)) {
				$this->collIdsSucursals = IdsSucursalPeer::doSelectJoinIds($criteria, $con, $join_behavior);
			}
		}
		$this->lastIdsSucursalCriteria = $criteria;

		return $this->collIdsSucursals;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collPricRecargosxCiudads) {
				foreach ((array) $this->collPricRecargosxCiudads as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPricRecargosxCiudadLogs) {
				foreach ((array) $this->collPricRecargosxCiudadLogs as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPricPatios) {
				foreach ((array) $this->collPricPatios as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collClientes) {
				foreach ((array) $this->collClientes as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collAgentes) {
				foreach ((array) $this->collAgentes as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collContactoAgentes) {
				foreach ((array) $this->collContactoAgentes as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collIdsSucursals) {
				foreach ((array) $this->collIdsSucursals as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collPricRecargosxCiudads = null;
		$this->collPricRecargosxCiudadLogs = null;
		$this->collPricPatios = null;
		$this->collClientes = null;
		$this->collAgentes = null;
		$this->collContactoAgentes = null;
		$this->collIdsSucursals = null;
			$this->aTrafico = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseCiudad:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseCiudad::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 