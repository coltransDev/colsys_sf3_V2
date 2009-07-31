<?php


abstract class BaseConcepto extends BaseObject  implements Persistent {


  const PEER = 'ConceptoPeer';

	
	protected static $peer;

	
	protected $ca_idconcepto;

	
	protected $ca_concepto;

	
	protected $ca_unidad;

	
	protected $ca_transporte;

	
	protected $ca_modalidad;

	
	protected $ca_liminferior;

	
	protected $collPricFletes;

	
	private $lastPricFleteCriteria = null;

	
	protected $collPricFleteLogs;

	
	private $lastPricFleteLogCriteria = null;

	
	protected $collPricRecargosxLineas;

	
	private $lastPricRecargosxLineaCriteria = null;

	
	protected $collPricRecargosxLineaLogs;

	
	private $lastPricRecargosxLineaLogCriteria = null;

	
	protected $collFletes;

	
	private $lastFleteCriteria = null;

	
	protected $collRepEquipos;

	
	private $lastRepEquipoCriteria = null;

	
	protected $collRepGastos;

	
	private $lastRepGastoCriteria = null;

	
	protected $collRepTarifas;

	
	private $lastRepTarifaCriteria = null;

	
	protected $collCotOpcions;

	
	private $lastCotOpcionCriteria = null;

	
	protected $collCotContinuacions;

	
	private $lastCotContinuacionCriteria = null;

	
	protected $collInoEquiposSeas;

	
	private $lastInoEquiposSeaCriteria = null;

	
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

	
	public function getCaIdconcepto()
	{
		return $this->ca_idconcepto;
	}

	
	public function getCaConcepto()
	{
		return $this->ca_concepto;
	}

	
	public function getCaUnidad()
	{
		return $this->ca_unidad;
	}

	
	public function getCaTransporte()
	{
		return $this->ca_transporte;
	}

	
	public function getCaModalidad()
	{
		return $this->ca_modalidad;
	}

	
	public function getCaLiminferior()
	{
		return $this->ca_liminferior;
	}

	
	public function setCaIdconcepto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idconcepto !== $v) {
			$this->ca_idconcepto = $v;
			$this->modifiedColumns[] = ConceptoPeer::CA_IDCONCEPTO;
		}

		return $this;
	} 
	
	public function setCaConcepto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_concepto !== $v) {
			$this->ca_concepto = $v;
			$this->modifiedColumns[] = ConceptoPeer::CA_CONCEPTO;
		}

		return $this;
	} 
	
	public function setCaUnidad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_unidad !== $v) {
			$this->ca_unidad = $v;
			$this->modifiedColumns[] = ConceptoPeer::CA_UNIDAD;
		}

		return $this;
	} 
	
	public function setCaTransporte($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_transporte !== $v) {
			$this->ca_transporte = $v;
			$this->modifiedColumns[] = ConceptoPeer::CA_TRANSPORTE;
		}

		return $this;
	} 
	
	public function setCaModalidad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_modalidad !== $v) {
			$this->ca_modalidad = $v;
			$this->modifiedColumns[] = ConceptoPeer::CA_MODALIDAD;
		}

		return $this;
	} 
	
	public function setCaLiminferior($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_liminferior !== $v) {
			$this->ca_liminferior = $v;
			$this->modifiedColumns[] = ConceptoPeer::CA_LIMINFERIOR;
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

			$this->ca_idconcepto = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_concepto = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_unidad = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_transporte = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_modalidad = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_liminferior = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Concepto object", $e);
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
			$con = Propel::getConnection(ConceptoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = ConceptoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collPricFletes = null;
			$this->lastPricFleteCriteria = null;

			$this->collPricFleteLogs = null;
			$this->lastPricFleteLogCriteria = null;

			$this->collPricRecargosxLineas = null;
			$this->lastPricRecargosxLineaCriteria = null;

			$this->collPricRecargosxLineaLogs = null;
			$this->lastPricRecargosxLineaLogCriteria = null;

			$this->collFletes = null;
			$this->lastFleteCriteria = null;

			$this->collRepEquipos = null;
			$this->lastRepEquipoCriteria = null;

			$this->collRepGastos = null;
			$this->lastRepGastoCriteria = null;

			$this->collRepTarifas = null;
			$this->lastRepTarifaCriteria = null;

			$this->collCotOpcions = null;
			$this->lastCotOpcionCriteria = null;

			$this->collCotContinuacions = null;
			$this->lastCotContinuacionCriteria = null;

			$this->collInoEquiposSeas = null;
			$this->lastInoEquiposSeaCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseConcepto:delete:pre') as $callable)
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
			$con = Propel::getConnection(ConceptoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			ConceptoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseConcepto:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseConcepto:save:pre') as $callable)
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
			$con = Propel::getConnection(ConceptoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseConcepto:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			ConceptoPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = ConceptoPeer::CA_IDCONCEPTO;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ConceptoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdconcepto($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ConceptoPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collPricFletes !== null) {
				foreach ($this->collPricFletes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPricFleteLogs !== null) {
				foreach ($this->collPricFleteLogs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPricRecargosxLineas !== null) {
				foreach ($this->collPricRecargosxLineas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPricRecargosxLineaLogs !== null) {
				foreach ($this->collPricRecargosxLineaLogs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFletes !== null) {
				foreach ($this->collFletes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepEquipos !== null) {
				foreach ($this->collRepEquipos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepGastos !== null) {
				foreach ($this->collRepGastos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepTarifas !== null) {
				foreach ($this->collRepTarifas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCotOpcions !== null) {
				foreach ($this->collCotOpcions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCotContinuacions !== null) {
				foreach ($this->collCotContinuacions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInoEquiposSeas !== null) {
				foreach ($this->collInoEquiposSeas as $referrerFK) {
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


			if (($retval = ConceptoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPricFletes !== null) {
					foreach ($this->collPricFletes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPricFleteLogs !== null) {
					foreach ($this->collPricFleteLogs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPricRecargosxLineas !== null) {
					foreach ($this->collPricRecargosxLineas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPricRecargosxLineaLogs !== null) {
					foreach ($this->collPricRecargosxLineaLogs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFletes !== null) {
					foreach ($this->collFletes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepEquipos !== null) {
					foreach ($this->collRepEquipos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepGastos !== null) {
					foreach ($this->collRepGastos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepTarifas !== null) {
					foreach ($this->collRepTarifas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCotOpcions !== null) {
					foreach ($this->collCotOpcions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCotContinuacions !== null) {
					foreach ($this->collCotContinuacions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoEquiposSeas !== null) {
					foreach ($this->collInoEquiposSeas as $referrerFK) {
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
		$pos = ConceptoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdconcepto();
				break;
			case 1:
				return $this->getCaConcepto();
				break;
			case 2:
				return $this->getCaUnidad();
				break;
			case 3:
				return $this->getCaTransporte();
				break;
			case 4:
				return $this->getCaModalidad();
				break;
			case 5:
				return $this->getCaLiminferior();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = ConceptoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdconcepto(),
			$keys[1] => $this->getCaConcepto(),
			$keys[2] => $this->getCaUnidad(),
			$keys[3] => $this->getCaTransporte(),
			$keys[4] => $this->getCaModalidad(),
			$keys[5] => $this->getCaLiminferior(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ConceptoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdconcepto($value);
				break;
			case 1:
				$this->setCaConcepto($value);
				break;
			case 2:
				$this->setCaUnidad($value);
				break;
			case 3:
				$this->setCaTransporte($value);
				break;
			case 4:
				$this->setCaModalidad($value);
				break;
			case 5:
				$this->setCaLiminferior($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ConceptoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdconcepto($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaConcepto($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaUnidad($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaTransporte($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaModalidad($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaLiminferior($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);

		if ($this->isColumnModified(ConceptoPeer::CA_IDCONCEPTO)) $criteria->add(ConceptoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);
		if ($this->isColumnModified(ConceptoPeer::CA_CONCEPTO)) $criteria->add(ConceptoPeer::CA_CONCEPTO, $this->ca_concepto);
		if ($this->isColumnModified(ConceptoPeer::CA_UNIDAD)) $criteria->add(ConceptoPeer::CA_UNIDAD, $this->ca_unidad);
		if ($this->isColumnModified(ConceptoPeer::CA_TRANSPORTE)) $criteria->add(ConceptoPeer::CA_TRANSPORTE, $this->ca_transporte);
		if ($this->isColumnModified(ConceptoPeer::CA_MODALIDAD)) $criteria->add(ConceptoPeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(ConceptoPeer::CA_LIMINFERIOR)) $criteria->add(ConceptoPeer::CA_LIMINFERIOR, $this->ca_liminferior);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);

		$criteria->add(ConceptoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdconcepto();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdconcepto($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaConcepto($this->ca_concepto);

		$copyObj->setCaUnidad($this->ca_unidad);

		$copyObj->setCaTransporte($this->ca_transporte);

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaLiminferior($this->ca_liminferior);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getPricFletes() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addPricFlete($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPricFleteLogs() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addPricFleteLog($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPricRecargosxLineas() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addPricRecargosxLinea($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPricRecargosxLineaLogs() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addPricRecargosxLineaLog($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getFletes() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addFlete($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRepEquipos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addRepEquipo($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRepGastos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addRepGasto($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRepTarifas() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addRepTarifa($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getCotOpcions() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addCotOpcion($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getCotContinuacions() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addCotContinuacion($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getInoEquiposSeas() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addInoEquiposSea($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCaIdconcepto(NULL); 
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
			self::$peer = new ConceptoPeer();
		}
		return self::$peer;
	}

	
	public function clearPricFletes()
	{
		$this->collPricFletes = null; 	}

	
	public function initPricFletes()
	{
		$this->collPricFletes = array();
	}

	
	public function getPricFletes($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricFletes === null) {
			if ($this->isNew()) {
			   $this->collPricFletes = array();
			} else {

				$criteria->add(PricFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				PricFletePeer::addSelectColumns($criteria);
				$this->collPricFletes = PricFletePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				PricFletePeer::addSelectColumns($criteria);
				if (!isset($this->lastPricFleteCriteria) || !$this->lastPricFleteCriteria->equals($criteria)) {
					$this->collPricFletes = PricFletePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricFleteCriteria = $criteria;
		return $this->collPricFletes;
	}

	
	public function countPricFletes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricFletes === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$count = PricFletePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				if (!isset($this->lastPricFleteCriteria) || !$this->lastPricFleteCriteria->equals($criteria)) {
					$count = PricFletePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricFletes);
				}
			} else {
				$count = count($this->collPricFletes);
			}
		}
		return $count;
	}

	
	public function addPricFlete(PricFlete $l)
	{
		if ($this->collPricFletes === null) {
			$this->initPricFletes();
		}
		if (!in_array($l, $this->collPricFletes, true)) { 			array_push($this->collPricFletes, $l);
			$l->setConcepto($this);
		}
	}


	
	public function getPricFletesJoinTrayecto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricFletes === null) {
			if ($this->isNew()) {
				$this->collPricFletes = array();
			} else {

				$criteria->add(PricFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$this->collPricFletes = PricFletePeer::doSelectJoinTrayecto($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(PricFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

			if (!isset($this->lastPricFleteCriteria) || !$this->lastPricFleteCriteria->equals($criteria)) {
				$this->collPricFletes = PricFletePeer::doSelectJoinTrayecto($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricFleteCriteria = $criteria;

		return $this->collPricFletes;
	}

	
	public function clearPricFleteLogs()
	{
		$this->collPricFleteLogs = null; 	}

	
	public function initPricFleteLogs()
	{
		$this->collPricFleteLogs = array();
	}

	
	public function getPricFleteLogs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricFleteLogs === null) {
			if ($this->isNew()) {
			   $this->collPricFleteLogs = array();
			} else {

				$criteria->add(PricFleteLogPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				PricFleteLogPeer::addSelectColumns($criteria);
				$this->collPricFleteLogs = PricFleteLogPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricFleteLogPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				PricFleteLogPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricFleteLogCriteria) || !$this->lastPricFleteLogCriteria->equals($criteria)) {
					$this->collPricFleteLogs = PricFleteLogPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricFleteLogCriteria = $criteria;
		return $this->collPricFleteLogs;
	}

	
	public function countPricFleteLogs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricFleteLogs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricFleteLogPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$count = PricFleteLogPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricFleteLogPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				if (!isset($this->lastPricFleteLogCriteria) || !$this->lastPricFleteLogCriteria->equals($criteria)) {
					$count = PricFleteLogPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricFleteLogs);
				}
			} else {
				$count = count($this->collPricFleteLogs);
			}
		}
		return $count;
	}

	
	public function addPricFleteLog(PricFleteLog $l)
	{
		if ($this->collPricFleteLogs === null) {
			$this->initPricFleteLogs();
		}
		if (!in_array($l, $this->collPricFleteLogs, true)) { 			array_push($this->collPricFleteLogs, $l);
			$l->setConcepto($this);
		}
	}


	
	public function getPricFleteLogsJoinTrayecto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricFleteLogs === null) {
			if ($this->isNew()) {
				$this->collPricFleteLogs = array();
			} else {

				$criteria->add(PricFleteLogPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$this->collPricFleteLogs = PricFleteLogPeer::doSelectJoinTrayecto($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(PricFleteLogPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

			if (!isset($this->lastPricFleteLogCriteria) || !$this->lastPricFleteLogCriteria->equals($criteria)) {
				$this->collPricFleteLogs = PricFleteLogPeer::doSelectJoinTrayecto($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricFleteLogCriteria = $criteria;

		return $this->collPricFleteLogs;
	}

	
	public function clearPricRecargosxLineas()
	{
		$this->collPricRecargosxLineas = null; 	}

	
	public function initPricRecargosxLineas()
	{
		$this->collPricRecargosxLineas = array();
	}

	
	public function getPricRecargosxLineas($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxLineas === null) {
			if ($this->isNew()) {
			   $this->collPricRecargosxLineas = array();
			} else {

				$criteria->add(PricRecargosxLineaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				PricRecargosxLineaPeer::addSelectColumns($criteria);
				$this->collPricRecargosxLineas = PricRecargosxLineaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargosxLineaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				PricRecargosxLineaPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricRecargosxLineaCriteria) || !$this->lastPricRecargosxLineaCriteria->equals($criteria)) {
					$this->collPricRecargosxLineas = PricRecargosxLineaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricRecargosxLineaCriteria = $criteria;
		return $this->collPricRecargosxLineas;
	}

	
	public function countPricRecargosxLineas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricRecargosxLineas === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricRecargosxLineaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$count = PricRecargosxLineaPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargosxLineaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				if (!isset($this->lastPricRecargosxLineaCriteria) || !$this->lastPricRecargosxLineaCriteria->equals($criteria)) {
					$count = PricRecargosxLineaPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricRecargosxLineas);
				}
			} else {
				$count = count($this->collPricRecargosxLineas);
			}
		}
		return $count;
	}

	
	public function addPricRecargosxLinea(PricRecargosxLinea $l)
	{
		if ($this->collPricRecargosxLineas === null) {
			$this->initPricRecargosxLineas();
		}
		if (!in_array($l, $this->collPricRecargosxLineas, true)) { 			array_push($this->collPricRecargosxLineas, $l);
			$l->setConcepto($this);
		}
	}


	
	public function getPricRecargosxLineasJoinTransportador($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxLineas === null) {
			if ($this->isNew()) {
				$this->collPricRecargosxLineas = array();
			} else {

				$criteria->add(PricRecargosxLineaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$this->collPricRecargosxLineas = PricRecargosxLineaPeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(PricRecargosxLineaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

			if (!isset($this->lastPricRecargosxLineaCriteria) || !$this->lastPricRecargosxLineaCriteria->equals($criteria)) {
				$this->collPricRecargosxLineas = PricRecargosxLineaPeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricRecargosxLineaCriteria = $criteria;

		return $this->collPricRecargosxLineas;
	}


	
	public function getPricRecargosxLineasJoinTipoRecargo($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxLineas === null) {
			if ($this->isNew()) {
				$this->collPricRecargosxLineas = array();
			} else {

				$criteria->add(PricRecargosxLineaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$this->collPricRecargosxLineas = PricRecargosxLineaPeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(PricRecargosxLineaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

			if (!isset($this->lastPricRecargosxLineaCriteria) || !$this->lastPricRecargosxLineaCriteria->equals($criteria)) {
				$this->collPricRecargosxLineas = PricRecargosxLineaPeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricRecargosxLineaCriteria = $criteria;

		return $this->collPricRecargosxLineas;
	}

	
	public function clearPricRecargosxLineaLogs()
	{
		$this->collPricRecargosxLineaLogs = null; 	}

	
	public function initPricRecargosxLineaLogs()
	{
		$this->collPricRecargosxLineaLogs = array();
	}

	
	public function getPricRecargosxLineaLogs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxLineaLogs === null) {
			if ($this->isNew()) {
			   $this->collPricRecargosxLineaLogs = array();
			} else {

				$criteria->add(PricRecargosxLineaLogPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				PricRecargosxLineaLogPeer::addSelectColumns($criteria);
				$this->collPricRecargosxLineaLogs = PricRecargosxLineaLogPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargosxLineaLogPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				PricRecargosxLineaLogPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricRecargosxLineaLogCriteria) || !$this->lastPricRecargosxLineaLogCriteria->equals($criteria)) {
					$this->collPricRecargosxLineaLogs = PricRecargosxLineaLogPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricRecargosxLineaLogCriteria = $criteria;
		return $this->collPricRecargosxLineaLogs;
	}

	
	public function countPricRecargosxLineaLogs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricRecargosxLineaLogs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricRecargosxLineaLogPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$count = PricRecargosxLineaLogPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargosxLineaLogPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				if (!isset($this->lastPricRecargosxLineaLogCriteria) || !$this->lastPricRecargosxLineaLogCriteria->equals($criteria)) {
					$count = PricRecargosxLineaLogPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricRecargosxLineaLogs);
				}
			} else {
				$count = count($this->collPricRecargosxLineaLogs);
			}
		}
		return $count;
	}

	
	public function addPricRecargosxLineaLog(PricRecargosxLineaLog $l)
	{
		if ($this->collPricRecargosxLineaLogs === null) {
			$this->initPricRecargosxLineaLogs();
		}
		if (!in_array($l, $this->collPricRecargosxLineaLogs, true)) { 			array_push($this->collPricRecargosxLineaLogs, $l);
			$l->setConcepto($this);
		}
	}


	
	public function getPricRecargosxLineaLogsJoinTransportador($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxLineaLogs === null) {
			if ($this->isNew()) {
				$this->collPricRecargosxLineaLogs = array();
			} else {

				$criteria->add(PricRecargosxLineaLogPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$this->collPricRecargosxLineaLogs = PricRecargosxLineaLogPeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(PricRecargosxLineaLogPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

			if (!isset($this->lastPricRecargosxLineaLogCriteria) || !$this->lastPricRecargosxLineaLogCriteria->equals($criteria)) {
				$this->collPricRecargosxLineaLogs = PricRecargosxLineaLogPeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricRecargosxLineaLogCriteria = $criteria;

		return $this->collPricRecargosxLineaLogs;
	}


	
	public function getPricRecargosxLineaLogsJoinTipoRecargo($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxLineaLogs === null) {
			if ($this->isNew()) {
				$this->collPricRecargosxLineaLogs = array();
			} else {

				$criteria->add(PricRecargosxLineaLogPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$this->collPricRecargosxLineaLogs = PricRecargosxLineaLogPeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(PricRecargosxLineaLogPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

			if (!isset($this->lastPricRecargosxLineaLogCriteria) || !$this->lastPricRecargosxLineaLogCriteria->equals($criteria)) {
				$this->collPricRecargosxLineaLogs = PricRecargosxLineaLogPeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricRecargosxLineaLogCriteria = $criteria;

		return $this->collPricRecargosxLineaLogs;
	}

	
	public function clearFletes()
	{
		$this->collFletes = null; 	}

	
	public function initFletes()
	{
		$this->collFletes = array();
	}

	
	public function getFletes($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFletes === null) {
			if ($this->isNew()) {
			   $this->collFletes = array();
			} else {

				$criteria->add(FletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				FletePeer::addSelectColumns($criteria);
				$this->collFletes = FletePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				FletePeer::addSelectColumns($criteria);
				if (!isset($this->lastFleteCriteria) || !$this->lastFleteCriteria->equals($criteria)) {
					$this->collFletes = FletePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFleteCriteria = $criteria;
		return $this->collFletes;
	}

	
	public function countFletes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collFletes === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(FletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$count = FletePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				if (!isset($this->lastFleteCriteria) || !$this->lastFleteCriteria->equals($criteria)) {
					$count = FletePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collFletes);
				}
			} else {
				$count = count($this->collFletes);
			}
		}
		return $count;
	}

	
	public function addFlete(Flete $l)
	{
		if ($this->collFletes === null) {
			$this->initFletes();
		}
		if (!in_array($l, $this->collFletes, true)) { 			array_push($this->collFletes, $l);
			$l->setConcepto($this);
		}
	}


	
	public function getFletesJoinTrayecto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFletes === null) {
			if ($this->isNew()) {
				$this->collFletes = array();
			} else {

				$criteria->add(FletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$this->collFletes = FletePeer::doSelectJoinTrayecto($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(FletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

			if (!isset($this->lastFleteCriteria) || !$this->lastFleteCriteria->equals($criteria)) {
				$this->collFletes = FletePeer::doSelectJoinTrayecto($criteria, $con, $join_behavior);
			}
		}
		$this->lastFleteCriteria = $criteria;

		return $this->collFletes;
	}

	
	public function clearRepEquipos()
	{
		$this->collRepEquipos = null; 	}

	
	public function initRepEquipos()
	{
		$this->collRepEquipos = array();
	}

	
	public function getRepEquipos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepEquipos === null) {
			if ($this->isNew()) {
			   $this->collRepEquipos = array();
			} else {

				$criteria->add(RepEquipoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				RepEquipoPeer::addSelectColumns($criteria);
				$this->collRepEquipos = RepEquipoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepEquipoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				RepEquipoPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepEquipoCriteria) || !$this->lastRepEquipoCriteria->equals($criteria)) {
					$this->collRepEquipos = RepEquipoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepEquipoCriteria = $criteria;
		return $this->collRepEquipos;
	}

	
	public function countRepEquipos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRepEquipos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RepEquipoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$count = RepEquipoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepEquipoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				if (!isset($this->lastRepEquipoCriteria) || !$this->lastRepEquipoCriteria->equals($criteria)) {
					$count = RepEquipoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRepEquipos);
				}
			} else {
				$count = count($this->collRepEquipos);
			}
		}
		return $count;
	}

	
	public function addRepEquipo(RepEquipo $l)
	{
		if ($this->collRepEquipos === null) {
			$this->initRepEquipos();
		}
		if (!in_array($l, $this->collRepEquipos, true)) { 			array_push($this->collRepEquipos, $l);
			$l->setConcepto($this);
		}
	}


	
	public function getRepEquiposJoinReporte($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepEquipos === null) {
			if ($this->isNew()) {
				$this->collRepEquipos = array();
			} else {

				$criteria->add(RepEquipoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$this->collRepEquipos = RepEquipoPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(RepEquipoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

			if (!isset($this->lastRepEquipoCriteria) || !$this->lastRepEquipoCriteria->equals($criteria)) {
				$this->collRepEquipos = RepEquipoPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepEquipoCriteria = $criteria;

		return $this->collRepEquipos;
	}

	
	public function clearRepGastos()
	{
		$this->collRepGastos = null; 	}

	
	public function initRepGastos()
	{
		$this->collRepGastos = array();
	}

	
	public function getRepGastos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepGastos === null) {
			if ($this->isNew()) {
			   $this->collRepGastos = array();
			} else {

				$criteria->add(RepGastoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				RepGastoPeer::addSelectColumns($criteria);
				$this->collRepGastos = RepGastoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepGastoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				RepGastoPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepGastoCriteria) || !$this->lastRepGastoCriteria->equals($criteria)) {
					$this->collRepGastos = RepGastoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepGastoCriteria = $criteria;
		return $this->collRepGastos;
	}

	
	public function countRepGastos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRepGastos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RepGastoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$count = RepGastoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepGastoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				if (!isset($this->lastRepGastoCriteria) || !$this->lastRepGastoCriteria->equals($criteria)) {
					$count = RepGastoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRepGastos);
				}
			} else {
				$count = count($this->collRepGastos);
			}
		}
		return $count;
	}

	
	public function addRepGasto(RepGasto $l)
	{
		if ($this->collRepGastos === null) {
			$this->initRepGastos();
		}
		if (!in_array($l, $this->collRepGastos, true)) { 			array_push($this->collRepGastos, $l);
			$l->setConcepto($this);
		}
	}


	
	public function getRepGastosJoinReporte($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepGastos === null) {
			if ($this->isNew()) {
				$this->collRepGastos = array();
			} else {

				$criteria->add(RepGastoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$this->collRepGastos = RepGastoPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(RepGastoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

			if (!isset($this->lastRepGastoCriteria) || !$this->lastRepGastoCriteria->equals($criteria)) {
				$this->collRepGastos = RepGastoPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepGastoCriteria = $criteria;

		return $this->collRepGastos;
	}


	
	public function getRepGastosJoinTipoRecargo($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepGastos === null) {
			if ($this->isNew()) {
				$this->collRepGastos = array();
			} else {

				$criteria->add(RepGastoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$this->collRepGastos = RepGastoPeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(RepGastoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

			if (!isset($this->lastRepGastoCriteria) || !$this->lastRepGastoCriteria->equals($criteria)) {
				$this->collRepGastos = RepGastoPeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepGastoCriteria = $criteria;

		return $this->collRepGastos;
	}

	
	public function clearRepTarifas()
	{
		$this->collRepTarifas = null; 	}

	
	public function initRepTarifas()
	{
		$this->collRepTarifas = array();
	}

	
	public function getRepTarifas($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepTarifas === null) {
			if ($this->isNew()) {
			   $this->collRepTarifas = array();
			} else {

				$criteria->add(RepTarifaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				RepTarifaPeer::addSelectColumns($criteria);
				$this->collRepTarifas = RepTarifaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepTarifaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				RepTarifaPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepTarifaCriteria) || !$this->lastRepTarifaCriteria->equals($criteria)) {
					$this->collRepTarifas = RepTarifaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepTarifaCriteria = $criteria;
		return $this->collRepTarifas;
	}

	
	public function countRepTarifas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRepTarifas === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RepTarifaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$count = RepTarifaPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepTarifaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				if (!isset($this->lastRepTarifaCriteria) || !$this->lastRepTarifaCriteria->equals($criteria)) {
					$count = RepTarifaPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRepTarifas);
				}
			} else {
				$count = count($this->collRepTarifas);
			}
		}
		return $count;
	}

	
	public function addRepTarifa(RepTarifa $l)
	{
		if ($this->collRepTarifas === null) {
			$this->initRepTarifas();
		}
		if (!in_array($l, $this->collRepTarifas, true)) { 			array_push($this->collRepTarifas, $l);
			$l->setConcepto($this);
		}
	}


	
	public function getRepTarifasJoinReporte($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepTarifas === null) {
			if ($this->isNew()) {
				$this->collRepTarifas = array();
			} else {

				$criteria->add(RepTarifaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$this->collRepTarifas = RepTarifaPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(RepTarifaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

			if (!isset($this->lastRepTarifaCriteria) || !$this->lastRepTarifaCriteria->equals($criteria)) {
				$this->collRepTarifas = RepTarifaPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepTarifaCriteria = $criteria;

		return $this->collRepTarifas;
	}

	
	public function clearCotOpcions()
	{
		$this->collCotOpcions = null; 	}

	
	public function initCotOpcions()
	{
		$this->collCotOpcions = array();
	}

	
	public function getCotOpcions($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotOpcions === null) {
			if ($this->isNew()) {
			   $this->collCotOpcions = array();
			} else {

				$criteria->add(CotOpcionPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				CotOpcionPeer::addSelectColumns($criteria);
				$this->collCotOpcions = CotOpcionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotOpcionPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				CotOpcionPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotOpcionCriteria) || !$this->lastCotOpcionCriteria->equals($criteria)) {
					$this->collCotOpcions = CotOpcionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotOpcionCriteria = $criteria;
		return $this->collCotOpcions;
	}

	
	public function countCotOpcions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCotOpcions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CotOpcionPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$count = CotOpcionPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotOpcionPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				if (!isset($this->lastCotOpcionCriteria) || !$this->lastCotOpcionCriteria->equals($criteria)) {
					$count = CotOpcionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCotOpcions);
				}
			} else {
				$count = count($this->collCotOpcions);
			}
		}
		return $count;
	}

	
	public function addCotOpcion(CotOpcion $l)
	{
		if ($this->collCotOpcions === null) {
			$this->initCotOpcions();
		}
		if (!in_array($l, $this->collCotOpcions, true)) { 			array_push($this->collCotOpcions, $l);
			$l->setConcepto($this);
		}
	}


	
	public function getCotOpcionsJoinCotProducto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotOpcions === null) {
			if ($this->isNew()) {
				$this->collCotOpcions = array();
			} else {

				$criteria->add(CotOpcionPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$this->collCotOpcions = CotOpcionPeer::doSelectJoinCotProducto($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(CotOpcionPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

			if (!isset($this->lastCotOpcionCriteria) || !$this->lastCotOpcionCriteria->equals($criteria)) {
				$this->collCotOpcions = CotOpcionPeer::doSelectJoinCotProducto($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotOpcionCriteria = $criteria;

		return $this->collCotOpcions;
	}

	
	public function clearCotContinuacions()
	{
		$this->collCotContinuacions = null; 	}

	
	public function initCotContinuacions()
	{
		$this->collCotContinuacions = array();
	}

	
	public function getCotContinuacions($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotContinuacions === null) {
			if ($this->isNew()) {
			   $this->collCotContinuacions = array();
			} else {

				$criteria->add(CotContinuacionPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				CotContinuacionPeer::addSelectColumns($criteria);
				$this->collCotContinuacions = CotContinuacionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotContinuacionPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				CotContinuacionPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotContinuacionCriteria) || !$this->lastCotContinuacionCriteria->equals($criteria)) {
					$this->collCotContinuacions = CotContinuacionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotContinuacionCriteria = $criteria;
		return $this->collCotContinuacions;
	}

	
	public function countCotContinuacions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCotContinuacions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CotContinuacionPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$count = CotContinuacionPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotContinuacionPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				if (!isset($this->lastCotContinuacionCriteria) || !$this->lastCotContinuacionCriteria->equals($criteria)) {
					$count = CotContinuacionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCotContinuacions);
				}
			} else {
				$count = count($this->collCotContinuacions);
			}
		}
		return $count;
	}

	
	public function addCotContinuacion(CotContinuacion $l)
	{
		if ($this->collCotContinuacions === null) {
			$this->initCotContinuacions();
		}
		if (!in_array($l, $this->collCotContinuacions, true)) { 			array_push($this->collCotContinuacions, $l);
			$l->setConcepto($this);
		}
	}


	
	public function getCotContinuacionsJoinCotizacion($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotContinuacions === null) {
			if ($this->isNew()) {
				$this->collCotContinuacions = array();
			} else {

				$criteria->add(CotContinuacionPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$this->collCotContinuacions = CotContinuacionPeer::doSelectJoinCotizacion($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(CotContinuacionPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

			if (!isset($this->lastCotContinuacionCriteria) || !$this->lastCotContinuacionCriteria->equals($criteria)) {
				$this->collCotContinuacions = CotContinuacionPeer::doSelectJoinCotizacion($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotContinuacionCriteria = $criteria;

		return $this->collCotContinuacions;
	}

	
	public function clearInoEquiposSeas()
	{
		$this->collInoEquiposSeas = null; 	}

	
	public function initInoEquiposSeas()
	{
		$this->collInoEquiposSeas = array();
	}

	
	public function getInoEquiposSeas($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoEquiposSeas === null) {
			if ($this->isNew()) {
			   $this->collInoEquiposSeas = array();
			} else {

				$criteria->add(InoEquiposSeaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				InoEquiposSeaPeer::addSelectColumns($criteria);
				$this->collInoEquiposSeas = InoEquiposSeaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoEquiposSeaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				InoEquiposSeaPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoEquiposSeaCriteria) || !$this->lastInoEquiposSeaCriteria->equals($criteria)) {
					$this->collInoEquiposSeas = InoEquiposSeaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoEquiposSeaCriteria = $criteria;
		return $this->collInoEquiposSeas;
	}

	
	public function countInoEquiposSeas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collInoEquiposSeas === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(InoEquiposSeaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$count = InoEquiposSeaPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoEquiposSeaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				if (!isset($this->lastInoEquiposSeaCriteria) || !$this->lastInoEquiposSeaCriteria->equals($criteria)) {
					$count = InoEquiposSeaPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collInoEquiposSeas);
				}
			} else {
				$count = count($this->collInoEquiposSeas);
			}
		}
		return $count;
	}

	
	public function addInoEquiposSea(InoEquiposSea $l)
	{
		if ($this->collInoEquiposSeas === null) {
			$this->initInoEquiposSeas();
		}
		if (!in_array($l, $this->collInoEquiposSeas, true)) { 			array_push($this->collInoEquiposSeas, $l);
			$l->setConcepto($this);
		}
	}


	
	public function getInoEquiposSeasJoinInoMaestraSea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ConceptoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoEquiposSeas === null) {
			if ($this->isNew()) {
				$this->collInoEquiposSeas = array();
			} else {

				$criteria->add(InoEquiposSeaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$this->collInoEquiposSeas = InoEquiposSeaPeer::doSelectJoinInoMaestraSea($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoEquiposSeaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

			if (!isset($this->lastInoEquiposSeaCriteria) || !$this->lastInoEquiposSeaCriteria->equals($criteria)) {
				$this->collInoEquiposSeas = InoEquiposSeaPeer::doSelectJoinInoMaestraSea($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoEquiposSeaCriteria = $criteria;

		return $this->collInoEquiposSeas;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collPricFletes) {
				foreach ((array) $this->collPricFletes as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPricFleteLogs) {
				foreach ((array) $this->collPricFleteLogs as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPricRecargosxLineas) {
				foreach ((array) $this->collPricRecargosxLineas as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPricRecargosxLineaLogs) {
				foreach ((array) $this->collPricRecargosxLineaLogs as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collFletes) {
				foreach ((array) $this->collFletes as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRepEquipos) {
				foreach ((array) $this->collRepEquipos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRepGastos) {
				foreach ((array) $this->collRepGastos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRepTarifas) {
				foreach ((array) $this->collRepTarifas as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCotOpcions) {
				foreach ((array) $this->collCotOpcions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCotContinuacions) {
				foreach ((array) $this->collCotContinuacions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collInoEquiposSeas) {
				foreach ((array) $this->collInoEquiposSeas as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collPricFletes = null;
		$this->collPricFleteLogs = null;
		$this->collPricRecargosxLineas = null;
		$this->collPricRecargosxLineaLogs = null;
		$this->collFletes = null;
		$this->collRepEquipos = null;
		$this->collRepGastos = null;
		$this->collRepTarifas = null;
		$this->collCotOpcions = null;
		$this->collCotContinuacions = null;
		$this->collInoEquiposSeas = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseConcepto:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseConcepto::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 