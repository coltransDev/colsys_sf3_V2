<?php


abstract class BaseTrafico extends BaseObject  implements Persistent {


  const PEER = 'TraficoPeer';

	
	protected static $peer;

	
	protected $ca_idtrafico;

	
	protected $ca_nombre;

	
	protected $ca_bandera;

	
	protected $ca_idmoneda;

	
	protected $ca_idgrupo;

	
	protected $ca_link;

	
	protected $ca_conceptos;

	
	protected $aTraficoGrupo;

	
	protected $collPricArchivos;

	
	private $lastPricArchivoCriteria = null;

	
	protected $collCiudads;

	
	private $lastCiudadCriteria = null;

	
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

	
	public function getCaIdtrafico()
	{
		return $this->ca_idtrafico;
	}

	
	public function getCaNombre()
	{
		return $this->ca_nombre;
	}

	
	public function getCaBandera()
	{
		return $this->ca_bandera;
	}

	
	public function getCaIdmoneda()
	{
		return $this->ca_idmoneda;
	}

	
	public function getCaIdgrupo()
	{
		return $this->ca_idgrupo;
	}

	
	public function getCaLink()
	{
		return $this->ca_link;
	}

	
	public function getCaConceptos()
	{
		return $this->ca_conceptos;
	}

	
	public function setCaIdtrafico($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idtrafico !== $v) {
			$this->ca_idtrafico = $v;
			$this->modifiedColumns[] = TraficoPeer::CA_IDTRAFICO;
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
			$this->modifiedColumns[] = TraficoPeer::CA_NOMBRE;
		}

		return $this;
	} 
	
	public function setCaBandera($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_bandera !== $v) {
			$this->ca_bandera = $v;
			$this->modifiedColumns[] = TraficoPeer::CA_BANDERA;
		}

		return $this;
	} 
	
	public function setCaIdmoneda($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idmoneda !== $v) {
			$this->ca_idmoneda = $v;
			$this->modifiedColumns[] = TraficoPeer::CA_IDMONEDA;
		}

		return $this;
	} 
	
	public function setCaIdgrupo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idgrupo !== $v) {
			$this->ca_idgrupo = $v;
			$this->modifiedColumns[] = TraficoPeer::CA_IDGRUPO;
		}

		if ($this->aTraficoGrupo !== null && $this->aTraficoGrupo->getCaIdgrupo() !== $v) {
			$this->aTraficoGrupo = null;
		}

		return $this;
	} 
	
	public function setCaLink($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_link !== $v) {
			$this->ca_link = $v;
			$this->modifiedColumns[] = TraficoPeer::CA_LINK;
		}

		return $this;
	} 
	
	public function setCaConceptos($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_conceptos !== $v) {
			$this->ca_conceptos = $v;
			$this->modifiedColumns[] = TraficoPeer::CA_CONCEPTOS;
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

			$this->ca_idtrafico = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_nombre = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_bandera = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_idmoneda = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_idgrupo = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->ca_link = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_conceptos = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Trafico object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aTraficoGrupo !== null && $this->ca_idgrupo !== $this->aTraficoGrupo->getCaIdgrupo()) {
			$this->aTraficoGrupo = null;
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
			$con = Propel::getConnection(TraficoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = TraficoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aTraficoGrupo = null;
			$this->collPricArchivos = null;
			$this->lastPricArchivoCriteria = null;

			$this->collCiudads = null;
			$this->lastCiudadCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTrafico:delete:pre') as $callable)
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
			$con = Propel::getConnection(TraficoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			TraficoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseTrafico:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTrafico:save:pre') as $callable)
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
			$con = Propel::getConnection(TraficoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseTrafico:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			TraficoPeer::addInstanceToPool($this);
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

												
			if ($this->aTraficoGrupo !== null) {
				if ($this->aTraficoGrupo->isModified() || $this->aTraficoGrupo->isNew()) {
					$affectedRows += $this->aTraficoGrupo->save($con);
				}
				$this->setTraficoGrupo($this->aTraficoGrupo);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = TraficoPeer::CA_IDTRAFICO;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TraficoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdtrafico($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TraficoPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collPricArchivos !== null) {
				foreach ($this->collPricArchivos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCiudads !== null) {
				foreach ($this->collCiudads as $referrerFK) {
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


												
			if ($this->aTraficoGrupo !== null) {
				if (!$this->aTraficoGrupo->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTraficoGrupo->getValidationFailures());
				}
			}


			if (($retval = TraficoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPricArchivos !== null) {
					foreach ($this->collPricArchivos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCiudads !== null) {
					foreach ($this->collCiudads as $referrerFK) {
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
		$pos = TraficoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdtrafico();
				break;
			case 1:
				return $this->getCaNombre();
				break;
			case 2:
				return $this->getCaBandera();
				break;
			case 3:
				return $this->getCaIdmoneda();
				break;
			case 4:
				return $this->getCaIdgrupo();
				break;
			case 5:
				return $this->getCaLink();
				break;
			case 6:
				return $this->getCaConceptos();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = TraficoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdtrafico(),
			$keys[1] => $this->getCaNombre(),
			$keys[2] => $this->getCaBandera(),
			$keys[3] => $this->getCaIdmoneda(),
			$keys[4] => $this->getCaIdgrupo(),
			$keys[5] => $this->getCaLink(),
			$keys[6] => $this->getCaConceptos(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TraficoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdtrafico($value);
				break;
			case 1:
				$this->setCaNombre($value);
				break;
			case 2:
				$this->setCaBandera($value);
				break;
			case 3:
				$this->setCaIdmoneda($value);
				break;
			case 4:
				$this->setCaIdgrupo($value);
				break;
			case 5:
				$this->setCaLink($value);
				break;
			case 6:
				$this->setCaConceptos($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TraficoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdtrafico($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaBandera($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaIdmoneda($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaIdgrupo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaLink($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaConceptos($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TraficoPeer::DATABASE_NAME);

		if ($this->isColumnModified(TraficoPeer::CA_IDTRAFICO)) $criteria->add(TraficoPeer::CA_IDTRAFICO, $this->ca_idtrafico);
		if ($this->isColumnModified(TraficoPeer::CA_NOMBRE)) $criteria->add(TraficoPeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(TraficoPeer::CA_BANDERA)) $criteria->add(TraficoPeer::CA_BANDERA, $this->ca_bandera);
		if ($this->isColumnModified(TraficoPeer::CA_IDMONEDA)) $criteria->add(TraficoPeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(TraficoPeer::CA_IDGRUPO)) $criteria->add(TraficoPeer::CA_IDGRUPO, $this->ca_idgrupo);
		if ($this->isColumnModified(TraficoPeer::CA_LINK)) $criteria->add(TraficoPeer::CA_LINK, $this->ca_link);
		if ($this->isColumnModified(TraficoPeer::CA_CONCEPTOS)) $criteria->add(TraficoPeer::CA_CONCEPTOS, $this->ca_conceptos);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TraficoPeer::DATABASE_NAME);

		$criteria->add(TraficoPeer::CA_IDTRAFICO, $this->ca_idtrafico);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdtrafico();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdtrafico($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaBandera($this->ca_bandera);

		$copyObj->setCaIdmoneda($this->ca_idmoneda);

		$copyObj->setCaIdgrupo($this->ca_idgrupo);

		$copyObj->setCaLink($this->ca_link);

		$copyObj->setCaConceptos($this->ca_conceptos);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getPricArchivos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addPricArchivo($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getCiudads() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addCiudad($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCaIdtrafico(NULL); 
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
			self::$peer = new TraficoPeer();
		}
		return self::$peer;
	}

	
	public function setTraficoGrupo(TraficoGrupo $v = null)
	{
		if ($v === null) {
			$this->setCaIdgrupo(NULL);
		} else {
			$this->setCaIdgrupo($v->getCaIdgrupo());
		}

		$this->aTraficoGrupo = $v;

						if ($v !== null) {
			$v->addTrafico($this);
		}

		return $this;
	}


	
	public function getTraficoGrupo(PropelPDO $con = null)
	{
		if ($this->aTraficoGrupo === null && ($this->ca_idgrupo !== null)) {
			$c = new Criteria(TraficoGrupoPeer::DATABASE_NAME);
			$c->add(TraficoGrupoPeer::CA_IDGRUPO, $this->ca_idgrupo);
			$this->aTraficoGrupo = TraficoGrupoPeer::doSelectOne($c, $con);
			
		}
		return $this->aTraficoGrupo;
	}

	
	public function clearPricArchivos()
	{
		$this->collPricArchivos = null; 	}

	
	public function initPricArchivos()
	{
		$this->collPricArchivos = array();
	}

	
	public function getPricArchivos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TraficoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricArchivos === null) {
			if ($this->isNew()) {
			   $this->collPricArchivos = array();
			} else {

				$criteria->add(PricArchivoPeer::CA_IDTRAFICO, $this->ca_idtrafico);

				PricArchivoPeer::addSelectColumns($criteria);
				$this->collPricArchivos = PricArchivoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricArchivoPeer::CA_IDTRAFICO, $this->ca_idtrafico);

				PricArchivoPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricArchivoCriteria) || !$this->lastPricArchivoCriteria->equals($criteria)) {
					$this->collPricArchivos = PricArchivoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricArchivoCriteria = $criteria;
		return $this->collPricArchivos;
	}

	
	public function countPricArchivos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TraficoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricArchivos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricArchivoPeer::CA_IDTRAFICO, $this->ca_idtrafico);

				$count = PricArchivoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricArchivoPeer::CA_IDTRAFICO, $this->ca_idtrafico);

				if (!isset($this->lastPricArchivoCriteria) || !$this->lastPricArchivoCriteria->equals($criteria)) {
					$count = PricArchivoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricArchivos);
				}
			} else {
				$count = count($this->collPricArchivos);
			}
		}
		return $count;
	}

	
	public function addPricArchivo(PricArchivo $l)
	{
		if ($this->collPricArchivos === null) {
			$this->initPricArchivos();
		}
		if (!in_array($l, $this->collPricArchivos, true)) { 			array_push($this->collPricArchivos, $l);
			$l->setTrafico($this);
		}
	}

	
	public function clearCiudads()
	{
		$this->collCiudads = null; 	}

	
	public function initCiudads()
	{
		$this->collCiudads = array();
	}

	
	public function getCiudads($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TraficoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCiudads === null) {
			if ($this->isNew()) {
			   $this->collCiudads = array();
			} else {

				$criteria->add(CiudadPeer::CA_IDTRAFICO, $this->ca_idtrafico);

				CiudadPeer::addSelectColumns($criteria);
				$this->collCiudads = CiudadPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CiudadPeer::CA_IDTRAFICO, $this->ca_idtrafico);

				CiudadPeer::addSelectColumns($criteria);
				if (!isset($this->lastCiudadCriteria) || !$this->lastCiudadCriteria->equals($criteria)) {
					$this->collCiudads = CiudadPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCiudadCriteria = $criteria;
		return $this->collCiudads;
	}

	
	public function countCiudads(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TraficoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCiudads === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CiudadPeer::CA_IDTRAFICO, $this->ca_idtrafico);

				$count = CiudadPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CiudadPeer::CA_IDTRAFICO, $this->ca_idtrafico);

				if (!isset($this->lastCiudadCriteria) || !$this->lastCiudadCriteria->equals($criteria)) {
					$count = CiudadPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCiudads);
				}
			} else {
				$count = count($this->collCiudads);
			}
		}
		return $count;
	}

	
	public function addCiudad(Ciudad $l)
	{
		if ($this->collCiudads === null) {
			$this->initCiudads();
		}
		if (!in_array($l, $this->collCiudads, true)) { 			array_push($this->collCiudads, $l);
			$l->setTrafico($this);
		}
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collPricArchivos) {
				foreach ((array) $this->collPricArchivos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCiudads) {
				foreach ((array) $this->collCiudads as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collPricArchivos = null;
		$this->collCiudads = null;
			$this->aTraficoGrupo = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseTrafico:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseTrafico::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 