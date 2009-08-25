<?php


abstract class BaseIdsCriterio extends BaseObject  implements Persistent {


  const PEER = 'IdsCriterioPeer';

	
	protected static $peer;

	
	protected $ca_idcriterio;

	
	protected $ca_tipo;

	
	protected $ca_tipocriterio;

	
	protected $ca_criterio;

	
	protected $ca_activo;

	
	protected $ca_ponderacion;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_fchactualizado;

	
	protected $ca_usuactualizado;

	
	protected $collIdsEvaluacionxCriterios;

	
	private $lastIdsEvaluacionxCriterioCriteria = null;

	
	protected $collIdsEventos;

	
	private $lastIdsEventoCriteria = null;

	
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

	
	public function getCaIdcriterio()
	{
		return $this->ca_idcriterio;
	}

	
	public function getCaTipo()
	{
		return $this->ca_tipo;
	}

	
	public function getCaTipocriterio()
	{
		return $this->ca_tipocriterio;
	}

	
	public function getCaCriterio()
	{
		return $this->ca_criterio;
	}

	
	public function getCaActivo()
	{
		return $this->ca_activo;
	}

	
	public function getCaPonderacion()
	{
		return $this->ca_ponderacion;
	}

	
	public function getCaFchcreado($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchcreado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchcreado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchcreado, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaUsucreado()
	{
		return $this->ca_usucreado;
	}

	
	public function getCaFchactualizado($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchactualizado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchactualizado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchactualizado, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaUsuactualizado()
	{
		return $this->ca_usuactualizado;
	}

	
	public function setCaIdcriterio($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcriterio !== $v) {
			$this->ca_idcriterio = $v;
			$this->modifiedColumns[] = IdsCriterioPeer::CA_IDCRITERIO;
		}

		return $this;
	} 
	
	public function setCaTipo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_tipo !== $v) {
			$this->ca_tipo = $v;
			$this->modifiedColumns[] = IdsCriterioPeer::CA_TIPO;
		}

		return $this;
	} 
	
	public function setCaTipocriterio($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_tipocriterio !== $v) {
			$this->ca_tipocriterio = $v;
			$this->modifiedColumns[] = IdsCriterioPeer::CA_TIPOCRITERIO;
		}

		return $this;
	} 
	
	public function setCaCriterio($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_criterio !== $v) {
			$this->ca_criterio = $v;
			$this->modifiedColumns[] = IdsCriterioPeer::CA_CRITERIO;
		}

		return $this;
	} 
	
	public function setCaActivo($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_activo !== $v) {
			$this->ca_activo = $v;
			$this->modifiedColumns[] = IdsCriterioPeer::CA_ACTIVO;
		}

		return $this;
	} 
	
	public function setCaPonderacion($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_ponderacion !== $v) {
			$this->ca_ponderacion = $v;
			$this->modifiedColumns[] = IdsCriterioPeer::CA_PONDERACION;
		}

		return $this;
	} 
	
	public function setCaFchcreado($v)
	{
						if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
									try {
				if (is_numeric($v)) { 					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
															$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fchcreado !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchcreado !== null && $tmpDt = new DateTime($this->ca_fchcreado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchcreado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = IdsCriterioPeer::CA_FCHCREADO;
			}
		} 
		return $this;
	} 
	
	public function setCaUsucreado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usucreado !== $v) {
			$this->ca_usucreado = $v;
			$this->modifiedColumns[] = IdsCriterioPeer::CA_USUCREADO;
		}

		return $this;
	} 
	
	public function setCaFchactualizado($v)
	{
						if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
									try {
				if (is_numeric($v)) { 					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
															$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fchactualizado !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchactualizado !== null && $tmpDt = new DateTime($this->ca_fchactualizado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchactualizado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = IdsCriterioPeer::CA_FCHACTUALIZADO;
			}
		} 
		return $this;
	} 
	
	public function setCaUsuactualizado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuactualizado !== $v) {
			$this->ca_usuactualizado = $v;
			$this->modifiedColumns[] = IdsCriterioPeer::CA_USUACTUALIZADO;
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

			$this->ca_idcriterio = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_tipo = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_tipocriterio = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_criterio = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_activo = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
			$this->ca_ponderacion = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->ca_fchcreado = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_usucreado = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_fchactualizado = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_usuactualizado = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating IdsCriterio object", $e);
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
			$con = Propel::getConnection(IdsCriterioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = IdsCriterioPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collIdsEvaluacionxCriterios = null;
			$this->lastIdsEvaluacionxCriterioCriteria = null;

			$this->collIdsEventos = null;
			$this->lastIdsEventoCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsCriterio:delete:pre') as $callable)
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
			$con = Propel::getConnection(IdsCriterioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			IdsCriterioPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseIdsCriterio:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsCriterio:save:pre') as $callable)
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
			$con = Propel::getConnection(IdsCriterioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseIdsCriterio:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			IdsCriterioPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = IdsCriterioPeer::CA_IDCRITERIO;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = IdsCriterioPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdcriterio($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += IdsCriterioPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collIdsEvaluacionxCriterios !== null) {
				foreach ($this->collIdsEvaluacionxCriterios as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collIdsEventos !== null) {
				foreach ($this->collIdsEventos as $referrerFK) {
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


			if (($retval = IdsCriterioPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collIdsEvaluacionxCriterios !== null) {
					foreach ($this->collIdsEvaluacionxCriterios as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collIdsEventos !== null) {
					foreach ($this->collIdsEventos as $referrerFK) {
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
		$pos = IdsCriterioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdcriterio();
				break;
			case 1:
				return $this->getCaTipo();
				break;
			case 2:
				return $this->getCaTipocriterio();
				break;
			case 3:
				return $this->getCaCriterio();
				break;
			case 4:
				return $this->getCaActivo();
				break;
			case 5:
				return $this->getCaPonderacion();
				break;
			case 6:
				return $this->getCaFchcreado();
				break;
			case 7:
				return $this->getCaUsucreado();
				break;
			case 8:
				return $this->getCaFchactualizado();
				break;
			case 9:
				return $this->getCaUsuactualizado();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = IdsCriterioPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdcriterio(),
			$keys[1] => $this->getCaTipo(),
			$keys[2] => $this->getCaTipocriterio(),
			$keys[3] => $this->getCaCriterio(),
			$keys[4] => $this->getCaActivo(),
			$keys[5] => $this->getCaPonderacion(),
			$keys[6] => $this->getCaFchcreado(),
			$keys[7] => $this->getCaUsucreado(),
			$keys[8] => $this->getCaFchactualizado(),
			$keys[9] => $this->getCaUsuactualizado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = IdsCriterioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdcriterio($value);
				break;
			case 1:
				$this->setCaTipo($value);
				break;
			case 2:
				$this->setCaTipocriterio($value);
				break;
			case 3:
				$this->setCaCriterio($value);
				break;
			case 4:
				$this->setCaActivo($value);
				break;
			case 5:
				$this->setCaPonderacion($value);
				break;
			case 6:
				$this->setCaFchcreado($value);
				break;
			case 7:
				$this->setCaUsucreado($value);
				break;
			case 8:
				$this->setCaFchactualizado($value);
				break;
			case 9:
				$this->setCaUsuactualizado($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = IdsCriterioPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdcriterio($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaTipo($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaTipocriterio($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaCriterio($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaActivo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaPonderacion($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaFchcreado($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaUsucreado($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaFchactualizado($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaUsuactualizado($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(IdsCriterioPeer::DATABASE_NAME);

		if ($this->isColumnModified(IdsCriterioPeer::CA_IDCRITERIO)) $criteria->add(IdsCriterioPeer::CA_IDCRITERIO, $this->ca_idcriterio);
		if ($this->isColumnModified(IdsCriterioPeer::CA_TIPO)) $criteria->add(IdsCriterioPeer::CA_TIPO, $this->ca_tipo);
		if ($this->isColumnModified(IdsCriterioPeer::CA_TIPOCRITERIO)) $criteria->add(IdsCriterioPeer::CA_TIPOCRITERIO, $this->ca_tipocriterio);
		if ($this->isColumnModified(IdsCriterioPeer::CA_CRITERIO)) $criteria->add(IdsCriterioPeer::CA_CRITERIO, $this->ca_criterio);
		if ($this->isColumnModified(IdsCriterioPeer::CA_ACTIVO)) $criteria->add(IdsCriterioPeer::CA_ACTIVO, $this->ca_activo);
		if ($this->isColumnModified(IdsCriterioPeer::CA_PONDERACION)) $criteria->add(IdsCriterioPeer::CA_PONDERACION, $this->ca_ponderacion);
		if ($this->isColumnModified(IdsCriterioPeer::CA_FCHCREADO)) $criteria->add(IdsCriterioPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(IdsCriterioPeer::CA_USUCREADO)) $criteria->add(IdsCriterioPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(IdsCriterioPeer::CA_FCHACTUALIZADO)) $criteria->add(IdsCriterioPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(IdsCriterioPeer::CA_USUACTUALIZADO)) $criteria->add(IdsCriterioPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(IdsCriterioPeer::DATABASE_NAME);

		$criteria->add(IdsCriterioPeer::CA_IDCRITERIO, $this->ca_idcriterio);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdcriterio();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdcriterio($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaTipo($this->ca_tipo);

		$copyObj->setCaTipocriterio($this->ca_tipocriterio);

		$copyObj->setCaCriterio($this->ca_criterio);

		$copyObj->setCaActivo($this->ca_activo);

		$copyObj->setCaPonderacion($this->ca_ponderacion);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getIdsEvaluacionxCriterios() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addIdsEvaluacionxCriterio($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getIdsEventos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addIdsEvento($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCaIdcriterio(NULL); 
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
			self::$peer = new IdsCriterioPeer();
		}
		return self::$peer;
	}

	
	public function clearIdsEvaluacionxCriterios()
	{
		$this->collIdsEvaluacionxCriterios = null; 	}

	
	public function initIdsEvaluacionxCriterios()
	{
		$this->collIdsEvaluacionxCriterios = array();
	}

	
	public function getIdsEvaluacionxCriterios($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(IdsCriterioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collIdsEvaluacionxCriterios === null) {
			if ($this->isNew()) {
			   $this->collIdsEvaluacionxCriterios = array();
			} else {

				$criteria->add(IdsEvaluacionxCriterioPeer::CA_IDCRITERIO, $this->ca_idcriterio);

				IdsEvaluacionxCriterioPeer::addSelectColumns($criteria);
				$this->collIdsEvaluacionxCriterios = IdsEvaluacionxCriterioPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(IdsEvaluacionxCriterioPeer::CA_IDCRITERIO, $this->ca_idcriterio);

				IdsEvaluacionxCriterioPeer::addSelectColumns($criteria);
				if (!isset($this->lastIdsEvaluacionxCriterioCriteria) || !$this->lastIdsEvaluacionxCriterioCriteria->equals($criteria)) {
					$this->collIdsEvaluacionxCriterios = IdsEvaluacionxCriterioPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastIdsEvaluacionxCriterioCriteria = $criteria;
		return $this->collIdsEvaluacionxCriterios;
	}

	
	public function countIdsEvaluacionxCriterios(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(IdsCriterioPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collIdsEvaluacionxCriterios === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(IdsEvaluacionxCriterioPeer::CA_IDCRITERIO, $this->ca_idcriterio);

				$count = IdsEvaluacionxCriterioPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(IdsEvaluacionxCriterioPeer::CA_IDCRITERIO, $this->ca_idcriterio);

				if (!isset($this->lastIdsEvaluacionxCriterioCriteria) || !$this->lastIdsEvaluacionxCriterioCriteria->equals($criteria)) {
					$count = IdsEvaluacionxCriterioPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collIdsEvaluacionxCriterios);
				}
			} else {
				$count = count($this->collIdsEvaluacionxCriterios);
			}
		}
		return $count;
	}

	
	public function addIdsEvaluacionxCriterio(IdsEvaluacionxCriterio $l)
	{
		if ($this->collIdsEvaluacionxCriterios === null) {
			$this->initIdsEvaluacionxCriterios();
		}
		if (!in_array($l, $this->collIdsEvaluacionxCriterios, true)) { 			array_push($this->collIdsEvaluacionxCriterios, $l);
			$l->setIdsCriterio($this);
		}
	}


	
	public function getIdsEvaluacionxCriteriosJoinIdsEvaluacion($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(IdsCriterioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collIdsEvaluacionxCriterios === null) {
			if ($this->isNew()) {
				$this->collIdsEvaluacionxCriterios = array();
			} else {

				$criteria->add(IdsEvaluacionxCriterioPeer::CA_IDCRITERIO, $this->ca_idcriterio);

				$this->collIdsEvaluacionxCriterios = IdsEvaluacionxCriterioPeer::doSelectJoinIdsEvaluacion($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(IdsEvaluacionxCriterioPeer::CA_IDCRITERIO, $this->ca_idcriterio);

			if (!isset($this->lastIdsEvaluacionxCriterioCriteria) || !$this->lastIdsEvaluacionxCriterioCriteria->equals($criteria)) {
				$this->collIdsEvaluacionxCriterios = IdsEvaluacionxCriterioPeer::doSelectJoinIdsEvaluacion($criteria, $con, $join_behavior);
			}
		}
		$this->lastIdsEvaluacionxCriterioCriteria = $criteria;

		return $this->collIdsEvaluacionxCriterios;
	}

	
	public function clearIdsEventos()
	{
		$this->collIdsEventos = null; 	}

	
	public function initIdsEventos()
	{
		$this->collIdsEventos = array();
	}

	
	public function getIdsEventos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(IdsCriterioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collIdsEventos === null) {
			if ($this->isNew()) {
			   $this->collIdsEventos = array();
			} else {

				$criteria->add(IdsEventoPeer::CA_IDCRITERIO, $this->ca_idcriterio);

				IdsEventoPeer::addSelectColumns($criteria);
				$this->collIdsEventos = IdsEventoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(IdsEventoPeer::CA_IDCRITERIO, $this->ca_idcriterio);

				IdsEventoPeer::addSelectColumns($criteria);
				if (!isset($this->lastIdsEventoCriteria) || !$this->lastIdsEventoCriteria->equals($criteria)) {
					$this->collIdsEventos = IdsEventoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastIdsEventoCriteria = $criteria;
		return $this->collIdsEventos;
	}

	
	public function countIdsEventos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(IdsCriterioPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collIdsEventos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(IdsEventoPeer::CA_IDCRITERIO, $this->ca_idcriterio);

				$count = IdsEventoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(IdsEventoPeer::CA_IDCRITERIO, $this->ca_idcriterio);

				if (!isset($this->lastIdsEventoCriteria) || !$this->lastIdsEventoCriteria->equals($criteria)) {
					$count = IdsEventoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collIdsEventos);
				}
			} else {
				$count = count($this->collIdsEventos);
			}
		}
		return $count;
	}

	
	public function addIdsEvento(IdsEvento $l)
	{
		if ($this->collIdsEventos === null) {
			$this->initIdsEventos();
		}
		if (!in_array($l, $this->collIdsEventos, true)) { 			array_push($this->collIdsEventos, $l);
			$l->setIdsCriterio($this);
		}
	}


	
	public function getIdsEventosJoinIds($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(IdsCriterioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collIdsEventos === null) {
			if ($this->isNew()) {
				$this->collIdsEventos = array();
			} else {

				$criteria->add(IdsEventoPeer::CA_IDCRITERIO, $this->ca_idcriterio);

				$this->collIdsEventos = IdsEventoPeer::doSelectJoinIds($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(IdsEventoPeer::CA_IDCRITERIO, $this->ca_idcriterio);

			if (!isset($this->lastIdsEventoCriteria) || !$this->lastIdsEventoCriteria->equals($criteria)) {
				$this->collIdsEventos = IdsEventoPeer::doSelectJoinIds($criteria, $con, $join_behavior);
			}
		}
		$this->lastIdsEventoCriteria = $criteria;

		return $this->collIdsEventos;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collIdsEvaluacionxCriterios) {
				foreach ((array) $this->collIdsEvaluacionxCriterios as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collIdsEventos) {
				foreach ((array) $this->collIdsEventos as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collIdsEvaluacionxCriterios = null;
		$this->collIdsEventos = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseIdsCriterio:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseIdsCriterio::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 