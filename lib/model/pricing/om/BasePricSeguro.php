<?php


abstract class BasePricSeguro extends BaseObject  implements Persistent {


  const PEER = 'PricSeguroPeer';

	
	protected static $peer;

	
	protected $ca_idgrupo;

	
	protected $ca_transporte;

	
	protected $ca_vlrprima;

	
	protected $ca_vlrminima;

	
	protected $ca_vlrobtencionpoliza;

	
	protected $ca_idmoneda;

	
	protected $ca_observaciones;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $aTraficoGrupo;

	
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

	
	public function getCaIdgrupo()
	{
		return $this->ca_idgrupo;
	}

	
	public function getCaTransporte()
	{
		return $this->ca_transporte;
	}

	
	public function getCaVlrprima()
	{
		return $this->ca_vlrprima;
	}

	
	public function getCaVlrminima()
	{
		return $this->ca_vlrminima;
	}

	
	public function getCaVlrobtencionpoliza()
	{
		return $this->ca_vlrobtencionpoliza;
	}

	
	public function getCaIdmoneda()
	{
		return $this->ca_idmoneda;
	}

	
	public function getCaObservaciones()
	{
		return $this->ca_observaciones;
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

	
	public function setCaIdgrupo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idgrupo !== $v) {
			$this->ca_idgrupo = $v;
			$this->modifiedColumns[] = PricSeguroPeer::CA_IDGRUPO;
		}

		if ($this->aTraficoGrupo !== null && $this->aTraficoGrupo->getCaIdgrupo() !== $v) {
			$this->aTraficoGrupo = null;
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
			$this->modifiedColumns[] = PricSeguroPeer::CA_TRANSPORTE;
		}

		return $this;
	} 
	
	public function setCaVlrprima($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vlrprima !== $v) {
			$this->ca_vlrprima = $v;
			$this->modifiedColumns[] = PricSeguroPeer::CA_VLRPRIMA;
		}

		return $this;
	} 
	
	public function setCaVlrminima($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vlrminima !== $v) {
			$this->ca_vlrminima = $v;
			$this->modifiedColumns[] = PricSeguroPeer::CA_VLRMINIMA;
		}

		return $this;
	} 
	
	public function setCaVlrobtencionpoliza($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vlrobtencionpoliza !== $v) {
			$this->ca_vlrobtencionpoliza = $v;
			$this->modifiedColumns[] = PricSeguroPeer::CA_VLROBTENCIONPOLIZA;
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
			$this->modifiedColumns[] = PricSeguroPeer::CA_IDMONEDA;
		}

		return $this;
	} 
	
	public function setCaObservaciones($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_observaciones !== $v) {
			$this->ca_observaciones = $v;
			$this->modifiedColumns[] = PricSeguroPeer::CA_OBSERVACIONES;
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
				$this->modifiedColumns[] = PricSeguroPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = PricSeguroPeer::CA_USUCREADO;
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

			$this->ca_idgrupo = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_transporte = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_vlrprima = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_vlrminima = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_vlrobtencionpoliza = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_idmoneda = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_observaciones = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_fchcreado = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_usucreado = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PricSeguro object", $e);
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
			$con = Propel::getConnection(PricSeguroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = PricSeguroPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aTraficoGrupo = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricSeguro:delete:pre') as $callable)
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
			$con = Propel::getConnection(PricSeguroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			PricSeguroPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasePricSeguro:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricSeguro:save:pre') as $callable)
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
			$con = Propel::getConnection(PricSeguroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasePricSeguro:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			PricSeguroPeer::addInstanceToPool($this);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PricSeguroPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += PricSeguroPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

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


			if (($retval = PricSeguroPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PricSeguroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdgrupo();
				break;
			case 1:
				return $this->getCaTransporte();
				break;
			case 2:
				return $this->getCaVlrprima();
				break;
			case 3:
				return $this->getCaVlrminima();
				break;
			case 4:
				return $this->getCaVlrobtencionpoliza();
				break;
			case 5:
				return $this->getCaIdmoneda();
				break;
			case 6:
				return $this->getCaObservaciones();
				break;
			case 7:
				return $this->getCaFchcreado();
				break;
			case 8:
				return $this->getCaUsucreado();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = PricSeguroPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdgrupo(),
			$keys[1] => $this->getCaTransporte(),
			$keys[2] => $this->getCaVlrprima(),
			$keys[3] => $this->getCaVlrminima(),
			$keys[4] => $this->getCaVlrobtencionpoliza(),
			$keys[5] => $this->getCaIdmoneda(),
			$keys[6] => $this->getCaObservaciones(),
			$keys[7] => $this->getCaFchcreado(),
			$keys[8] => $this->getCaUsucreado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PricSeguroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdgrupo($value);
				break;
			case 1:
				$this->setCaTransporte($value);
				break;
			case 2:
				$this->setCaVlrprima($value);
				break;
			case 3:
				$this->setCaVlrminima($value);
				break;
			case 4:
				$this->setCaVlrobtencionpoliza($value);
				break;
			case 5:
				$this->setCaIdmoneda($value);
				break;
			case 6:
				$this->setCaObservaciones($value);
				break;
			case 7:
				$this->setCaFchcreado($value);
				break;
			case 8:
				$this->setCaUsucreado($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PricSeguroPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdgrupo($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaTransporte($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaVlrprima($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaVlrminima($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaVlrobtencionpoliza($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaIdmoneda($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaObservaciones($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaFchcreado($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaUsucreado($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PricSeguroPeer::DATABASE_NAME);

		if ($this->isColumnModified(PricSeguroPeer::CA_IDGRUPO)) $criteria->add(PricSeguroPeer::CA_IDGRUPO, $this->ca_idgrupo);
		if ($this->isColumnModified(PricSeguroPeer::CA_TRANSPORTE)) $criteria->add(PricSeguroPeer::CA_TRANSPORTE, $this->ca_transporte);
		if ($this->isColumnModified(PricSeguroPeer::CA_VLRPRIMA)) $criteria->add(PricSeguroPeer::CA_VLRPRIMA, $this->ca_vlrprima);
		if ($this->isColumnModified(PricSeguroPeer::CA_VLRMINIMA)) $criteria->add(PricSeguroPeer::CA_VLRMINIMA, $this->ca_vlrminima);
		if ($this->isColumnModified(PricSeguroPeer::CA_VLROBTENCIONPOLIZA)) $criteria->add(PricSeguroPeer::CA_VLROBTENCIONPOLIZA, $this->ca_vlrobtencionpoliza);
		if ($this->isColumnModified(PricSeguroPeer::CA_IDMONEDA)) $criteria->add(PricSeguroPeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(PricSeguroPeer::CA_OBSERVACIONES)) $criteria->add(PricSeguroPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(PricSeguroPeer::CA_FCHCREADO)) $criteria->add(PricSeguroPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(PricSeguroPeer::CA_USUCREADO)) $criteria->add(PricSeguroPeer::CA_USUCREADO, $this->ca_usucreado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PricSeguroPeer::DATABASE_NAME);

		$criteria->add(PricSeguroPeer::CA_IDGRUPO, $this->ca_idgrupo);
		$criteria->add(PricSeguroPeer::CA_TRANSPORTE, $this->ca_transporte);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaIdgrupo();

		$pks[1] = $this->getCaTransporte();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaIdgrupo($keys[0]);

		$this->setCaTransporte($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdgrupo($this->ca_idgrupo);

		$copyObj->setCaTransporte($this->ca_transporte);

		$copyObj->setCaVlrprima($this->ca_vlrprima);

		$copyObj->setCaVlrminima($this->ca_vlrminima);

		$copyObj->setCaVlrobtencionpoliza($this->ca_vlrobtencionpoliza);

		$copyObj->setCaIdmoneda($this->ca_idmoneda);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);


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
			self::$peer = new PricSeguroPeer();
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
			$v->addPricSeguro($this);
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

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aTraficoGrupo = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasePricSeguro:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasePricSeguro::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 