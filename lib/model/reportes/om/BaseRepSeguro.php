<?php


abstract class BaseRepSeguro extends BaseObject  implements Persistent {


  const PEER = 'RepSeguroPeer';

	
	protected static $peer;

	
	protected $ca_idreporte;

	
	protected $ca_vlrasegurado;

	
	protected $ca_idmoneda_vlr;

	
	protected $ca_primaventa;

	
	protected $ca_minimaventa;

	
	protected $ca_idmoneda_vta;

	
	protected $ca_obtencionpoliza;

	
	protected $ca_idmoneda_pol;

	
	protected $ca_seguro_conf;

	
	protected $aReporte;

	
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

	
	public function getCaIdreporte()
	{
		return $this->ca_idreporte;
	}

	
	public function getCaVlrasegurado()
	{
		return $this->ca_vlrasegurado;
	}

	
	public function getCaIdmonedaVlr()
	{
		return $this->ca_idmoneda_vlr;
	}

	
	public function getCaPrimaventa()
	{
		return $this->ca_primaventa;
	}

	
	public function getCaMinimaventa()
	{
		return $this->ca_minimaventa;
	}

	
	public function getCaIdmonedaVta()
	{
		return $this->ca_idmoneda_vta;
	}

	
	public function getCaObtencionpoliza()
	{
		return $this->ca_obtencionpoliza;
	}

	
	public function getCaIdmonedaPol()
	{
		return $this->ca_idmoneda_pol;
	}

	
	public function getCaSeguroConf()
	{
		return $this->ca_seguro_conf;
	}

	
	public function setCaIdreporte($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idreporte !== $v) {
			$this->ca_idreporte = $v;
			$this->modifiedColumns[] = RepSeguroPeer::CA_IDREPORTE;
		}

		if ($this->aReporte !== null && $this->aReporte->getCaIdreporte() !== $v) {
			$this->aReporte = null;
		}

		return $this;
	} 
	
	public function setCaVlrasegurado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vlrasegurado !== $v) {
			$this->ca_vlrasegurado = $v;
			$this->modifiedColumns[] = RepSeguroPeer::CA_VLRASEGURADO;
		}

		return $this;
	} 
	
	public function setCaIdmonedaVlr($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idmoneda_vlr !== $v) {
			$this->ca_idmoneda_vlr = $v;
			$this->modifiedColumns[] = RepSeguroPeer::CA_IDMONEDA_VLR;
		}

		return $this;
	} 
	
	public function setCaPrimaventa($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_primaventa !== $v) {
			$this->ca_primaventa = $v;
			$this->modifiedColumns[] = RepSeguroPeer::CA_PRIMAVENTA;
		}

		return $this;
	} 
	
	public function setCaMinimaventa($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_minimaventa !== $v) {
			$this->ca_minimaventa = $v;
			$this->modifiedColumns[] = RepSeguroPeer::CA_MINIMAVENTA;
		}

		return $this;
	} 
	
	public function setCaIdmonedaVta($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idmoneda_vta !== $v) {
			$this->ca_idmoneda_vta = $v;
			$this->modifiedColumns[] = RepSeguroPeer::CA_IDMONEDA_VTA;
		}

		return $this;
	} 
	
	public function setCaObtencionpoliza($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_obtencionpoliza !== $v) {
			$this->ca_obtencionpoliza = $v;
			$this->modifiedColumns[] = RepSeguroPeer::CA_OBTENCIONPOLIZA;
		}

		return $this;
	} 
	
	public function setCaIdmonedaPol($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idmoneda_pol !== $v) {
			$this->ca_idmoneda_pol = $v;
			$this->modifiedColumns[] = RepSeguroPeer::CA_IDMONEDA_POL;
		}

		return $this;
	} 
	
	public function setCaSeguroConf($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_seguro_conf !== $v) {
			$this->ca_seguro_conf = $v;
			$this->modifiedColumns[] = RepSeguroPeer::CA_SEGURO_CONF;
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

			$this->ca_idreporte = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_vlrasegurado = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_idmoneda_vlr = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_primaventa = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_minimaventa = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_idmoneda_vta = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_obtencionpoliza = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_idmoneda_pol = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_seguro_conf = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating RepSeguro object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aReporte !== null && $this->ca_idreporte !== $this->aReporte->getCaIdreporte()) {
			$this->aReporte = null;
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
			$con = Propel::getConnection(RepSeguroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = RepSeguroPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aReporte = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepSeguro:delete:pre') as $callable)
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
			$con = Propel::getConnection(RepSeguroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			RepSeguroPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseRepSeguro:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepSeguro:save:pre') as $callable)
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
			$con = Propel::getConnection(RepSeguroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseRepSeguro:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			RepSeguroPeer::addInstanceToPool($this);
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

												
			if ($this->aReporte !== null) {
				if ($this->aReporte->isModified() || $this->aReporte->isNew()) {
					$affectedRows += $this->aReporte->save($con);
				}
				$this->setReporte($this->aReporte);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RepSeguroPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += RepSeguroPeer::doUpdate($this, $con);
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


												
			if ($this->aReporte !== null) {
				if (!$this->aReporte->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aReporte->getValidationFailures());
				}
			}


			if (($retval = RepSeguroPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RepSeguroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdreporte();
				break;
			case 1:
				return $this->getCaVlrasegurado();
				break;
			case 2:
				return $this->getCaIdmonedaVlr();
				break;
			case 3:
				return $this->getCaPrimaventa();
				break;
			case 4:
				return $this->getCaMinimaventa();
				break;
			case 5:
				return $this->getCaIdmonedaVta();
				break;
			case 6:
				return $this->getCaObtencionpoliza();
				break;
			case 7:
				return $this->getCaIdmonedaPol();
				break;
			case 8:
				return $this->getCaSeguroConf();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = RepSeguroPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdreporte(),
			$keys[1] => $this->getCaVlrasegurado(),
			$keys[2] => $this->getCaIdmonedaVlr(),
			$keys[3] => $this->getCaPrimaventa(),
			$keys[4] => $this->getCaMinimaventa(),
			$keys[5] => $this->getCaIdmonedaVta(),
			$keys[6] => $this->getCaObtencionpoliza(),
			$keys[7] => $this->getCaIdmonedaPol(),
			$keys[8] => $this->getCaSeguroConf(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RepSeguroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdreporte($value);
				break;
			case 1:
				$this->setCaVlrasegurado($value);
				break;
			case 2:
				$this->setCaIdmonedaVlr($value);
				break;
			case 3:
				$this->setCaPrimaventa($value);
				break;
			case 4:
				$this->setCaMinimaventa($value);
				break;
			case 5:
				$this->setCaIdmonedaVta($value);
				break;
			case 6:
				$this->setCaObtencionpoliza($value);
				break;
			case 7:
				$this->setCaIdmonedaPol($value);
				break;
			case 8:
				$this->setCaSeguroConf($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RepSeguroPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdreporte($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaVlrasegurado($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdmonedaVlr($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaPrimaventa($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaMinimaventa($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaIdmonedaVta($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaObtencionpoliza($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaIdmonedaPol($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaSeguroConf($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RepSeguroPeer::DATABASE_NAME);

		if ($this->isColumnModified(RepSeguroPeer::CA_IDREPORTE)) $criteria->add(RepSeguroPeer::CA_IDREPORTE, $this->ca_idreporte);
		if ($this->isColumnModified(RepSeguroPeer::CA_VLRASEGURADO)) $criteria->add(RepSeguroPeer::CA_VLRASEGURADO, $this->ca_vlrasegurado);
		if ($this->isColumnModified(RepSeguroPeer::CA_IDMONEDA_VLR)) $criteria->add(RepSeguroPeer::CA_IDMONEDA_VLR, $this->ca_idmoneda_vlr);
		if ($this->isColumnModified(RepSeguroPeer::CA_PRIMAVENTA)) $criteria->add(RepSeguroPeer::CA_PRIMAVENTA, $this->ca_primaventa);
		if ($this->isColumnModified(RepSeguroPeer::CA_MINIMAVENTA)) $criteria->add(RepSeguroPeer::CA_MINIMAVENTA, $this->ca_minimaventa);
		if ($this->isColumnModified(RepSeguroPeer::CA_IDMONEDA_VTA)) $criteria->add(RepSeguroPeer::CA_IDMONEDA_VTA, $this->ca_idmoneda_vta);
		if ($this->isColumnModified(RepSeguroPeer::CA_OBTENCIONPOLIZA)) $criteria->add(RepSeguroPeer::CA_OBTENCIONPOLIZA, $this->ca_obtencionpoliza);
		if ($this->isColumnModified(RepSeguroPeer::CA_IDMONEDA_POL)) $criteria->add(RepSeguroPeer::CA_IDMONEDA_POL, $this->ca_idmoneda_pol);
		if ($this->isColumnModified(RepSeguroPeer::CA_SEGURO_CONF)) $criteria->add(RepSeguroPeer::CA_SEGURO_CONF, $this->ca_seguro_conf);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RepSeguroPeer::DATABASE_NAME);

		$criteria->add(RepSeguroPeer::CA_IDREPORTE, $this->ca_idreporte);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdreporte();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdreporte($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdreporte($this->ca_idreporte);

		$copyObj->setCaVlrasegurado($this->ca_vlrasegurado);

		$copyObj->setCaIdmonedaVlr($this->ca_idmoneda_vlr);

		$copyObj->setCaPrimaventa($this->ca_primaventa);

		$copyObj->setCaMinimaventa($this->ca_minimaventa);

		$copyObj->setCaIdmonedaVta($this->ca_idmoneda_vta);

		$copyObj->setCaObtencionpoliza($this->ca_obtencionpoliza);

		$copyObj->setCaIdmonedaPol($this->ca_idmoneda_pol);

		$copyObj->setCaSeguroConf($this->ca_seguro_conf);


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
			self::$peer = new RepSeguroPeer();
		}
		return self::$peer;
	}

	
	public function setReporte(Reporte $v = null)
	{
		if ($v === null) {
			$this->setCaIdreporte(NULL);
		} else {
			$this->setCaIdreporte($v->getCaIdreporte());
		}

		$this->aReporte = $v;

				if ($v !== null) {
			$v->setRepSeguro($this);
		}

		return $this;
	}


	
	public function getReporte(PropelPDO $con = null)
	{
		if ($this->aReporte === null && ($this->ca_idreporte !== null)) {
			$c = new Criteria(ReportePeer::DATABASE_NAME);
			$c->add(ReportePeer::CA_IDREPORTE, $this->ca_idreporte);
			$this->aReporte = ReportePeer::doSelectOne($c, $con);
						$this->aReporte->setRepSeguro($this);
		}
		return $this->aReporte;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aReporte = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseRepSeguro:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseRepSeguro::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 