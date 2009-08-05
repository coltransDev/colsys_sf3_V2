<?php


abstract class BaseIdsEvaluacion extends BaseObject  implements Persistent {


  const PEER = 'IdsEvaluacionPeer';

	
	protected static $peer;

	
	protected $ca_idevaluacion;

	
	protected $ca_id;

	
	protected $ca_concepto;

	
	protected $ca_tipo;

	
	protected $ca_fchevaluacion;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $aIds;

	
	protected $collIdsEvaluacionxCriterios;

	
	private $lastIdsEvaluacionxCriterioCriteria = null;

	
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

	
	public function getCaIdevaluacion()
	{
		return $this->ca_idevaluacion;
	}

	
	public function getCaId()
	{
		return $this->ca_id;
	}

	
	public function getCaConcepto()
	{
		return $this->ca_concepto;
	}

	
	public function getCaTipo()
	{
		return $this->ca_tipo;
	}

	
	public function getCaFchevaluacion($format = 'Y-m-d')
	{
		if ($this->ca_fchevaluacion === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchevaluacion);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchevaluacion, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
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

	
	public function setCaIdevaluacion($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idevaluacion !== $v) {
			$this->ca_idevaluacion = $v;
			$this->modifiedColumns[] = IdsEvaluacionPeer::CA_IDEVALUACION;
		}

		return $this;
	} 
	
	public function setCaId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_id !== $v) {
			$this->ca_id = $v;
			$this->modifiedColumns[] = IdsEvaluacionPeer::CA_ID;
		}

		if ($this->aIds !== null && $this->aIds->getCaId() !== $v) {
			$this->aIds = null;
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
			$this->modifiedColumns[] = IdsEvaluacionPeer::CA_CONCEPTO;
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
			$this->modifiedColumns[] = IdsEvaluacionPeer::CA_TIPO;
		}

		return $this;
	} 
	
	public function setCaFchevaluacion($v)
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

		if ( $this->ca_fchevaluacion !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchevaluacion !== null && $tmpDt = new DateTime($this->ca_fchevaluacion)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchevaluacion = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = IdsEvaluacionPeer::CA_FCHEVALUACION;
			}
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
				$this->modifiedColumns[] = IdsEvaluacionPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = IdsEvaluacionPeer::CA_USUCREADO;
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

			$this->ca_idevaluacion = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_concepto = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_tipo = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_fchevaluacion = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_fchcreado = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_usucreado = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating IdsEvaluacion object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aIds !== null && $this->ca_id !== $this->aIds->getCaId()) {
			$this->aIds = null;
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
			$con = Propel::getConnection(IdsEvaluacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = IdsEvaluacionPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aIds = null;
			$this->collIdsEvaluacionxCriterios = null;
			$this->lastIdsEvaluacionxCriterioCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsEvaluacion:delete:pre') as $callable)
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
			$con = Propel::getConnection(IdsEvaluacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			IdsEvaluacionPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseIdsEvaluacion:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsEvaluacion:save:pre') as $callable)
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
			$con = Propel::getConnection(IdsEvaluacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseIdsEvaluacion:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			IdsEvaluacionPeer::addInstanceToPool($this);
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

												
			if ($this->aIds !== null) {
				if ($this->aIds->isModified() || $this->aIds->isNew()) {
					$affectedRows += $this->aIds->save($con);
				}
				$this->setIds($this->aIds);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = IdsEvaluacionPeer::CA_IDEVALUACION;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = IdsEvaluacionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdevaluacion($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += IdsEvaluacionPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collIdsEvaluacionxCriterios !== null) {
				foreach ($this->collIdsEvaluacionxCriterios as $referrerFK) {
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


												
			if ($this->aIds !== null) {
				if (!$this->aIds->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aIds->getValidationFailures());
				}
			}


			if (($retval = IdsEvaluacionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collIdsEvaluacionxCriterios !== null) {
					foreach ($this->collIdsEvaluacionxCriterios as $referrerFK) {
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
		$pos = IdsEvaluacionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdevaluacion();
				break;
			case 1:
				return $this->getCaId();
				break;
			case 2:
				return $this->getCaConcepto();
				break;
			case 3:
				return $this->getCaTipo();
				break;
			case 4:
				return $this->getCaFchevaluacion();
				break;
			case 5:
				return $this->getCaFchcreado();
				break;
			case 6:
				return $this->getCaUsucreado();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = IdsEvaluacionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdevaluacion(),
			$keys[1] => $this->getCaId(),
			$keys[2] => $this->getCaConcepto(),
			$keys[3] => $this->getCaTipo(),
			$keys[4] => $this->getCaFchevaluacion(),
			$keys[5] => $this->getCaFchcreado(),
			$keys[6] => $this->getCaUsucreado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = IdsEvaluacionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdevaluacion($value);
				break;
			case 1:
				$this->setCaId($value);
				break;
			case 2:
				$this->setCaConcepto($value);
				break;
			case 3:
				$this->setCaTipo($value);
				break;
			case 4:
				$this->setCaFchevaluacion($value);
				break;
			case 5:
				$this->setCaFchcreado($value);
				break;
			case 6:
				$this->setCaUsucreado($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = IdsEvaluacionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdevaluacion($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaConcepto($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaTipo($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaFchevaluacion($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaFchcreado($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaUsucreado($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(IdsEvaluacionPeer::DATABASE_NAME);

		if ($this->isColumnModified(IdsEvaluacionPeer::CA_IDEVALUACION)) $criteria->add(IdsEvaluacionPeer::CA_IDEVALUACION, $this->ca_idevaluacion);
		if ($this->isColumnModified(IdsEvaluacionPeer::CA_ID)) $criteria->add(IdsEvaluacionPeer::CA_ID, $this->ca_id);
		if ($this->isColumnModified(IdsEvaluacionPeer::CA_CONCEPTO)) $criteria->add(IdsEvaluacionPeer::CA_CONCEPTO, $this->ca_concepto);
		if ($this->isColumnModified(IdsEvaluacionPeer::CA_TIPO)) $criteria->add(IdsEvaluacionPeer::CA_TIPO, $this->ca_tipo);
		if ($this->isColumnModified(IdsEvaluacionPeer::CA_FCHEVALUACION)) $criteria->add(IdsEvaluacionPeer::CA_FCHEVALUACION, $this->ca_fchevaluacion);
		if ($this->isColumnModified(IdsEvaluacionPeer::CA_FCHCREADO)) $criteria->add(IdsEvaluacionPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(IdsEvaluacionPeer::CA_USUCREADO)) $criteria->add(IdsEvaluacionPeer::CA_USUCREADO, $this->ca_usucreado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(IdsEvaluacionPeer::DATABASE_NAME);

		$criteria->add(IdsEvaluacionPeer::CA_IDEVALUACION, $this->ca_idevaluacion);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdevaluacion();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdevaluacion($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaId($this->ca_id);

		$copyObj->setCaConcepto($this->ca_concepto);

		$copyObj->setCaTipo($this->ca_tipo);

		$copyObj->setCaFchevaluacion($this->ca_fchevaluacion);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getIdsEvaluacionxCriterios() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addIdsEvaluacionxCriterio($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCaIdevaluacion(NULL); 
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
			self::$peer = new IdsEvaluacionPeer();
		}
		return self::$peer;
	}

	
	public function setIds(Ids $v = null)
	{
		if ($v === null) {
			$this->setCaId(NULL);
		} else {
			$this->setCaId($v->getCaId());
		}

		$this->aIds = $v;

						if ($v !== null) {
			$v->addIdsEvaluacion($this);
		}

		return $this;
	}


	
	public function getIds(PropelPDO $con = null)
	{
		if ($this->aIds === null && ($this->ca_id !== null)) {
			$c = new Criteria(IdsPeer::DATABASE_NAME);
			$c->add(IdsPeer::CA_ID, $this->ca_id);
			$this->aIds = IdsPeer::doSelectOne($c, $con);
			
		}
		return $this->aIds;
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
			$criteria = new Criteria(IdsEvaluacionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collIdsEvaluacionxCriterios === null) {
			if ($this->isNew()) {
			   $this->collIdsEvaluacionxCriterios = array();
			} else {

				$criteria->add(IdsEvaluacionxCriterioPeer::CA_IDEVALUACION, $this->ca_idevaluacion);

				IdsEvaluacionxCriterioPeer::addSelectColumns($criteria);
				$this->collIdsEvaluacionxCriterios = IdsEvaluacionxCriterioPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(IdsEvaluacionxCriterioPeer::CA_IDEVALUACION, $this->ca_idevaluacion);

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
			$criteria = new Criteria(IdsEvaluacionPeer::DATABASE_NAME);
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

				$criteria->add(IdsEvaluacionxCriterioPeer::CA_IDEVALUACION, $this->ca_idevaluacion);

				$count = IdsEvaluacionxCriterioPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(IdsEvaluacionxCriterioPeer::CA_IDEVALUACION, $this->ca_idevaluacion);

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
			$l->setIdsEvaluacion($this);
		}
	}


	
	public function getIdsEvaluacionxCriteriosJoinIdsCriterio($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(IdsEvaluacionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collIdsEvaluacionxCriterios === null) {
			if ($this->isNew()) {
				$this->collIdsEvaluacionxCriterios = array();
			} else {

				$criteria->add(IdsEvaluacionxCriterioPeer::CA_IDEVALUACION, $this->ca_idevaluacion);

				$this->collIdsEvaluacionxCriterios = IdsEvaluacionxCriterioPeer::doSelectJoinIdsCriterio($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(IdsEvaluacionxCriterioPeer::CA_IDEVALUACION, $this->ca_idevaluacion);

			if (!isset($this->lastIdsEvaluacionxCriterioCriteria) || !$this->lastIdsEvaluacionxCriterioCriteria->equals($criteria)) {
				$this->collIdsEvaluacionxCriterios = IdsEvaluacionxCriterioPeer::doSelectJoinIdsCriterio($criteria, $con, $join_behavior);
			}
		}
		$this->lastIdsEvaluacionxCriterioCriteria = $criteria;

		return $this->collIdsEvaluacionxCriterios;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collIdsEvaluacionxCriterios) {
				foreach ((array) $this->collIdsEvaluacionxCriterios as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collIdsEvaluacionxCriterios = null;
			$this->aIds = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseIdsEvaluacion:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseIdsEvaluacion::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 