<?php


abstract class BaseRepExpo extends BaseObject  implements Persistent {


  const PEER = 'RepExpoPeer';

	
	protected static $peer;

	
	protected $ca_idreporte;

	
	protected $ca_peso;

	
	protected $ca_volumen;

	
	protected $ca_piezas;

	
	protected $ca_dimensiones;

	
	protected $ca_valorcarga;

	
	protected $ca_anticipo;

	
	protected $ca_idsia;

	
	protected $ca_tipoexpo;

	
	protected $ca_idlineaterrestre;

	
	protected $ca_motonave;

	
	protected $ca_emisionbl;

	
	protected $ca_datosbl;

	
	protected $ca_numbl;

	
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

	
	public function getCaPeso()
	{
		return $this->ca_peso;
	}

	
	public function getCaVolumen()
	{
		return $this->ca_volumen;
	}

	
	public function getCaPiezas()
	{
		return $this->ca_piezas;
	}

	
	public function getCaDimensiones()
	{
		return $this->ca_dimensiones;
	}

	
	public function getCaValorcarga()
	{
		return $this->ca_valorcarga;
	}

	
	public function getCaAnticipo()
	{
		return $this->ca_anticipo;
	}

	
	public function getCaIdsia()
	{
		return $this->ca_idsia;
	}

	
	public function getCaTipoexpo()
	{
		return $this->ca_tipoexpo;
	}

	
	public function getCaIdlineaterrestre()
	{
		return $this->ca_idlineaterrestre;
	}

	
	public function getCaMotonave()
	{
		return $this->ca_motonave;
	}

	
	public function getCaEmisionbl()
	{
		return $this->ca_emisionbl;
	}

	
	public function getCaDatosbl()
	{
		return $this->ca_datosbl;
	}

	
	public function getCaNumbl()
	{
		return $this->ca_numbl;
	}

	
	public function setCaIdreporte($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idreporte !== $v) {
			$this->ca_idreporte = $v;
			$this->modifiedColumns[] = RepExpoPeer::CA_IDREPORTE;
		}

		if ($this->aReporte !== null && $this->aReporte->getCaIdreporte() !== $v) {
			$this->aReporte = null;
		}

		return $this;
	} 
	
	public function setCaPeso($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_peso !== $v) {
			$this->ca_peso = $v;
			$this->modifiedColumns[] = RepExpoPeer::CA_PESO;
		}

		return $this;
	} 
	
	public function setCaVolumen($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_volumen !== $v) {
			$this->ca_volumen = $v;
			$this->modifiedColumns[] = RepExpoPeer::CA_VOLUMEN;
		}

		return $this;
	} 
	
	public function setCaPiezas($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_piezas !== $v) {
			$this->ca_piezas = $v;
			$this->modifiedColumns[] = RepExpoPeer::CA_PIEZAS;
		}

		return $this;
	} 
	
	public function setCaDimensiones($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_dimensiones !== $v) {
			$this->ca_dimensiones = $v;
			$this->modifiedColumns[] = RepExpoPeer::CA_DIMENSIONES;
		}

		return $this;
	} 
	
	public function setCaValorcarga($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_valorcarga !== $v) {
			$this->ca_valorcarga = $v;
			$this->modifiedColumns[] = RepExpoPeer::CA_VALORCARGA;
		}

		return $this;
	} 
	
	public function setCaAnticipo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_anticipo !== $v) {
			$this->ca_anticipo = $v;
			$this->modifiedColumns[] = RepExpoPeer::CA_ANTICIPO;
		}

		return $this;
	} 
	
	public function setCaIdsia($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idsia !== $v) {
			$this->ca_idsia = $v;
			$this->modifiedColumns[] = RepExpoPeer::CA_IDSIA;
		}

		return $this;
	} 
	
	public function setCaTipoexpo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_tipoexpo !== $v) {
			$this->ca_tipoexpo = $v;
			$this->modifiedColumns[] = RepExpoPeer::CA_TIPOEXPO;
		}

		return $this;
	} 
	
	public function setCaIdlineaterrestre($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idlineaterrestre !== $v) {
			$this->ca_idlineaterrestre = $v;
			$this->modifiedColumns[] = RepExpoPeer::CA_IDLINEATERRESTRE;
		}

		return $this;
	} 
	
	public function setCaMotonave($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_motonave !== $v) {
			$this->ca_motonave = $v;
			$this->modifiedColumns[] = RepExpoPeer::CA_MOTONAVE;
		}

		return $this;
	} 
	
	public function setCaEmisionbl($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_emisionbl !== $v) {
			$this->ca_emisionbl = $v;
			$this->modifiedColumns[] = RepExpoPeer::CA_EMISIONBL;
		}

		return $this;
	} 
	
	public function setCaDatosbl($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_datosbl !== $v) {
			$this->ca_datosbl = $v;
			$this->modifiedColumns[] = RepExpoPeer::CA_DATOSBL;
		}

		return $this;
	} 
	
	public function setCaNumbl($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_numbl !== $v) {
			$this->ca_numbl = $v;
			$this->modifiedColumns[] = RepExpoPeer::CA_NUMBL;
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
			$this->ca_peso = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_volumen = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_piezas = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_dimensiones = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_valorcarga = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_anticipo = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_idsia = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->ca_tipoexpo = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->ca_idlineaterrestre = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->ca_motonave = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_emisionbl = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_datosbl = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_numbl = ($row[$startcol + 13] !== null) ? (int) $row[$startcol + 13] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 14; 
		} catch (Exception $e) {
			throw new PropelException("Error populating RepExpo object", $e);
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
			$con = Propel::getConnection(RepExpoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = RepExpoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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

    foreach (sfMixer::getCallables('BaseRepExpo:delete:pre') as $callable)
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
			$con = Propel::getConnection(RepExpoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			RepExpoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseRepExpo:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepExpo:save:pre') as $callable)
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
			$con = Propel::getConnection(RepExpoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseRepExpo:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			RepExpoPeer::addInstanceToPool($this);
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
					$pk = RepExpoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += RepExpoPeer::doUpdate($this, $con);
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


			if (($retval = RepExpoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RepExpoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaPeso();
				break;
			case 2:
				return $this->getCaVolumen();
				break;
			case 3:
				return $this->getCaPiezas();
				break;
			case 4:
				return $this->getCaDimensiones();
				break;
			case 5:
				return $this->getCaValorcarga();
				break;
			case 6:
				return $this->getCaAnticipo();
				break;
			case 7:
				return $this->getCaIdsia();
				break;
			case 8:
				return $this->getCaTipoexpo();
				break;
			case 9:
				return $this->getCaIdlineaterrestre();
				break;
			case 10:
				return $this->getCaMotonave();
				break;
			case 11:
				return $this->getCaEmisionbl();
				break;
			case 12:
				return $this->getCaDatosbl();
				break;
			case 13:
				return $this->getCaNumbl();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = RepExpoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdreporte(),
			$keys[1] => $this->getCaPeso(),
			$keys[2] => $this->getCaVolumen(),
			$keys[3] => $this->getCaPiezas(),
			$keys[4] => $this->getCaDimensiones(),
			$keys[5] => $this->getCaValorcarga(),
			$keys[6] => $this->getCaAnticipo(),
			$keys[7] => $this->getCaIdsia(),
			$keys[8] => $this->getCaTipoexpo(),
			$keys[9] => $this->getCaIdlineaterrestre(),
			$keys[10] => $this->getCaMotonave(),
			$keys[11] => $this->getCaEmisionbl(),
			$keys[12] => $this->getCaDatosbl(),
			$keys[13] => $this->getCaNumbl(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RepExpoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdreporte($value);
				break;
			case 1:
				$this->setCaPeso($value);
				break;
			case 2:
				$this->setCaVolumen($value);
				break;
			case 3:
				$this->setCaPiezas($value);
				break;
			case 4:
				$this->setCaDimensiones($value);
				break;
			case 5:
				$this->setCaValorcarga($value);
				break;
			case 6:
				$this->setCaAnticipo($value);
				break;
			case 7:
				$this->setCaIdsia($value);
				break;
			case 8:
				$this->setCaTipoexpo($value);
				break;
			case 9:
				$this->setCaIdlineaterrestre($value);
				break;
			case 10:
				$this->setCaMotonave($value);
				break;
			case 11:
				$this->setCaEmisionbl($value);
				break;
			case 12:
				$this->setCaDatosbl($value);
				break;
			case 13:
				$this->setCaNumbl($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RepExpoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdreporte($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaPeso($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaVolumen($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaPiezas($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaDimensiones($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaValorcarga($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaAnticipo($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaIdsia($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaTipoexpo($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaIdlineaterrestre($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaMotonave($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaEmisionbl($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaDatosbl($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaNumbl($arr[$keys[13]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RepExpoPeer::DATABASE_NAME);

		if ($this->isColumnModified(RepExpoPeer::CA_IDREPORTE)) $criteria->add(RepExpoPeer::CA_IDREPORTE, $this->ca_idreporte);
		if ($this->isColumnModified(RepExpoPeer::CA_PESO)) $criteria->add(RepExpoPeer::CA_PESO, $this->ca_peso);
		if ($this->isColumnModified(RepExpoPeer::CA_VOLUMEN)) $criteria->add(RepExpoPeer::CA_VOLUMEN, $this->ca_volumen);
		if ($this->isColumnModified(RepExpoPeer::CA_PIEZAS)) $criteria->add(RepExpoPeer::CA_PIEZAS, $this->ca_piezas);
		if ($this->isColumnModified(RepExpoPeer::CA_DIMENSIONES)) $criteria->add(RepExpoPeer::CA_DIMENSIONES, $this->ca_dimensiones);
		if ($this->isColumnModified(RepExpoPeer::CA_VALORCARGA)) $criteria->add(RepExpoPeer::CA_VALORCARGA, $this->ca_valorcarga);
		if ($this->isColumnModified(RepExpoPeer::CA_ANTICIPO)) $criteria->add(RepExpoPeer::CA_ANTICIPO, $this->ca_anticipo);
		if ($this->isColumnModified(RepExpoPeer::CA_IDSIA)) $criteria->add(RepExpoPeer::CA_IDSIA, $this->ca_idsia);
		if ($this->isColumnModified(RepExpoPeer::CA_TIPOEXPO)) $criteria->add(RepExpoPeer::CA_TIPOEXPO, $this->ca_tipoexpo);
		if ($this->isColumnModified(RepExpoPeer::CA_IDLINEATERRESTRE)) $criteria->add(RepExpoPeer::CA_IDLINEATERRESTRE, $this->ca_idlineaterrestre);
		if ($this->isColumnModified(RepExpoPeer::CA_MOTONAVE)) $criteria->add(RepExpoPeer::CA_MOTONAVE, $this->ca_motonave);
		if ($this->isColumnModified(RepExpoPeer::CA_EMISIONBL)) $criteria->add(RepExpoPeer::CA_EMISIONBL, $this->ca_emisionbl);
		if ($this->isColumnModified(RepExpoPeer::CA_DATOSBL)) $criteria->add(RepExpoPeer::CA_DATOSBL, $this->ca_datosbl);
		if ($this->isColumnModified(RepExpoPeer::CA_NUMBL)) $criteria->add(RepExpoPeer::CA_NUMBL, $this->ca_numbl);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RepExpoPeer::DATABASE_NAME);

		$criteria->add(RepExpoPeer::CA_IDREPORTE, $this->ca_idreporte);

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

		$copyObj->setCaPeso($this->ca_peso);

		$copyObj->setCaVolumen($this->ca_volumen);

		$copyObj->setCaPiezas($this->ca_piezas);

		$copyObj->setCaDimensiones($this->ca_dimensiones);

		$copyObj->setCaValorcarga($this->ca_valorcarga);

		$copyObj->setCaAnticipo($this->ca_anticipo);

		$copyObj->setCaIdsia($this->ca_idsia);

		$copyObj->setCaTipoexpo($this->ca_tipoexpo);

		$copyObj->setCaIdlineaterrestre($this->ca_idlineaterrestre);

		$copyObj->setCaMotonave($this->ca_motonave);

		$copyObj->setCaEmisionbl($this->ca_emisionbl);

		$copyObj->setCaDatosbl($this->ca_datosbl);

		$copyObj->setCaNumbl($this->ca_numbl);


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
			self::$peer = new RepExpoPeer();
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
			$v->setRepExpo($this);
		}

		return $this;
	}


	
	public function getReporte(PropelPDO $con = null)
	{
		if ($this->aReporte === null && ($this->ca_idreporte !== null)) {
			$c = new Criteria(ReportePeer::DATABASE_NAME);
			$c->add(ReportePeer::CA_IDREPORTE, $this->ca_idreporte);
			$this->aReporte = ReportePeer::doSelectOne($c, $con);
						$this->aReporte->setRepExpo($this);
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
    if (!$callable = sfMixer::getCallable('BaseRepExpo:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseRepExpo::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 