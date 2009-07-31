<?php


abstract class BaseRepAduana extends BaseObject  implements Persistent {


  const PEER = 'RepAduanaPeer';

	
	protected static $peer;

	
	protected $ca_idreporte;

	
	protected $ca_coordinador;

	
	protected $ca_transnacarga;

	
	protected $ca_transnatipo;

	
	protected $ca_instrucciones;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_fchactualizado;

	
	protected $ca_usuactualizado;

	
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

	
	public function getCaCoordinador()
	{
		return $this->ca_coordinador;
	}

	
	public function getCaTransnacarga()
	{
		return $this->ca_transnacarga;
	}

	
	public function getCaTransnatipo()
	{
		return $this->ca_transnatipo;
	}

	
	public function getCaInstrucciones()
	{
		return $this->ca_instrucciones;
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

	
	public function setCaIdreporte($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idreporte !== $v) {
			$this->ca_idreporte = $v;
			$this->modifiedColumns[] = RepAduanaPeer::CA_IDREPORTE;
		}

		if ($this->aReporte !== null && $this->aReporte->getCaIdreporte() !== $v) {
			$this->aReporte = null;
		}

		return $this;
	} 
	
	public function setCaCoordinador($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_coordinador !== $v) {
			$this->ca_coordinador = $v;
			$this->modifiedColumns[] = RepAduanaPeer::CA_COORDINADOR;
		}

		return $this;
	} 
	
	public function setCaTransnacarga($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_transnacarga !== $v) {
			$this->ca_transnacarga = $v;
			$this->modifiedColumns[] = RepAduanaPeer::CA_TRANSNACARGA;
		}

		return $this;
	} 
	
	public function setCaTransnatipo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_transnatipo !== $v) {
			$this->ca_transnatipo = $v;
			$this->modifiedColumns[] = RepAduanaPeer::CA_TRANSNATIPO;
		}

		return $this;
	} 
	
	public function setCaInstrucciones($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_instrucciones !== $v) {
			$this->ca_instrucciones = $v;
			$this->modifiedColumns[] = RepAduanaPeer::CA_INSTRUCCIONES;
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
				$this->modifiedColumns[] = RepAduanaPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = RepAduanaPeer::CA_USUCREADO;
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
				$this->modifiedColumns[] = RepAduanaPeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = RepAduanaPeer::CA_USUACTUALIZADO;
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
			$this->ca_coordinador = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_transnacarga = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_transnatipo = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_instrucciones = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_fchcreado = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_usucreado = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_fchactualizado = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_usuactualizado = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating RepAduana object", $e);
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
			$con = Propel::getConnection(RepAduanaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = RepAduanaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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

    foreach (sfMixer::getCallables('BaseRepAduana:delete:pre') as $callable)
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
			$con = Propel::getConnection(RepAduanaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			RepAduanaPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseRepAduana:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepAduana:save:pre') as $callable)
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
			$con = Propel::getConnection(RepAduanaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseRepAduana:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			RepAduanaPeer::addInstanceToPool($this);
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
					$pk = RepAduanaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += RepAduanaPeer::doUpdate($this, $con);
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


			if (($retval = RepAduanaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RepAduanaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaCoordinador();
				break;
			case 2:
				return $this->getCaTransnacarga();
				break;
			case 3:
				return $this->getCaTransnatipo();
				break;
			case 4:
				return $this->getCaInstrucciones();
				break;
			case 5:
				return $this->getCaFchcreado();
				break;
			case 6:
				return $this->getCaUsucreado();
				break;
			case 7:
				return $this->getCaFchactualizado();
				break;
			case 8:
				return $this->getCaUsuactualizado();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = RepAduanaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdreporte(),
			$keys[1] => $this->getCaCoordinador(),
			$keys[2] => $this->getCaTransnacarga(),
			$keys[3] => $this->getCaTransnatipo(),
			$keys[4] => $this->getCaInstrucciones(),
			$keys[5] => $this->getCaFchcreado(),
			$keys[6] => $this->getCaUsucreado(),
			$keys[7] => $this->getCaFchactualizado(),
			$keys[8] => $this->getCaUsuactualizado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RepAduanaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdreporte($value);
				break;
			case 1:
				$this->setCaCoordinador($value);
				break;
			case 2:
				$this->setCaTransnacarga($value);
				break;
			case 3:
				$this->setCaTransnatipo($value);
				break;
			case 4:
				$this->setCaInstrucciones($value);
				break;
			case 5:
				$this->setCaFchcreado($value);
				break;
			case 6:
				$this->setCaUsucreado($value);
				break;
			case 7:
				$this->setCaFchactualizado($value);
				break;
			case 8:
				$this->setCaUsuactualizado($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RepAduanaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdreporte($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaCoordinador($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaTransnacarga($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaTransnatipo($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaInstrucciones($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaFchcreado($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaUsucreado($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaFchactualizado($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaUsuactualizado($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RepAduanaPeer::DATABASE_NAME);

		if ($this->isColumnModified(RepAduanaPeer::CA_IDREPORTE)) $criteria->add(RepAduanaPeer::CA_IDREPORTE, $this->ca_idreporte);
		if ($this->isColumnModified(RepAduanaPeer::CA_COORDINADOR)) $criteria->add(RepAduanaPeer::CA_COORDINADOR, $this->ca_coordinador);
		if ($this->isColumnModified(RepAduanaPeer::CA_TRANSNACARGA)) $criteria->add(RepAduanaPeer::CA_TRANSNACARGA, $this->ca_transnacarga);
		if ($this->isColumnModified(RepAduanaPeer::CA_TRANSNATIPO)) $criteria->add(RepAduanaPeer::CA_TRANSNATIPO, $this->ca_transnatipo);
		if ($this->isColumnModified(RepAduanaPeer::CA_INSTRUCCIONES)) $criteria->add(RepAduanaPeer::CA_INSTRUCCIONES, $this->ca_instrucciones);
		if ($this->isColumnModified(RepAduanaPeer::CA_FCHCREADO)) $criteria->add(RepAduanaPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(RepAduanaPeer::CA_USUCREADO)) $criteria->add(RepAduanaPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(RepAduanaPeer::CA_FCHACTUALIZADO)) $criteria->add(RepAduanaPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(RepAduanaPeer::CA_USUACTUALIZADO)) $criteria->add(RepAduanaPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RepAduanaPeer::DATABASE_NAME);

		$criteria->add(RepAduanaPeer::CA_IDREPORTE, $this->ca_idreporte);

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

		$copyObj->setCaCoordinador($this->ca_coordinador);

		$copyObj->setCaTransnacarga($this->ca_transnacarga);

		$copyObj->setCaTransnatipo($this->ca_transnatipo);

		$copyObj->setCaInstrucciones($this->ca_instrucciones);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);


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
			self::$peer = new RepAduanaPeer();
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
			$v->setRepAduana($this);
		}

		return $this;
	}


	
	public function getReporte(PropelPDO $con = null)
	{
		if ($this->aReporte === null && ($this->ca_idreporte !== null)) {
			$c = new Criteria(ReportePeer::DATABASE_NAME);
			$c->add(ReportePeer::CA_IDREPORTE, $this->ca_idreporte);
			$this->aReporte = ReportePeer::doSelectOne($c, $con);
						$this->aReporte->setRepAduana($this);
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
    if (!$callable = sfMixer::getCallable('BaseRepAduana:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseRepAduana::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 