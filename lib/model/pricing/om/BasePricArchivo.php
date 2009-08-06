<?php


abstract class BasePricArchivo extends BaseObject  implements Persistent {


  const PEER = 'PricArchivoPeer';

	
	protected static $peer;

	
	protected $ca_idarchivo;

	
	protected $ca_idtrafico;

	
	protected $ca_nombre;

	
	protected $ca_descripcion;

	
	protected $ca_tamano;

	
	protected $ca_tipo;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_datos;

	
	protected $ca_impoexpo;

	
	protected $ca_transporte;

	
	protected $ca_modalidad;

	
	protected $aTrafico;

	
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

	
	public function getCaIdarchivo()
	{
		return $this->ca_idarchivo;
	}

	
	public function getCaIdtrafico()
	{
		return $this->ca_idtrafico;
	}

	
	public function getCaNombre()
	{
		return $this->ca_nombre;
	}

	
	public function getCaDescripcion()
	{
		return $this->ca_descripcion;
	}

	
	public function getCaTamano()
	{
		return $this->ca_tamano;
	}

	
	public function getCaTipo()
	{
		return $this->ca_tipo;
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

	
	public function getCaDatos()
	{
		return $this->ca_datos;
	}

	
	public function getCaImpoexpo()
	{
		return $this->ca_impoexpo;
	}

	
	public function getCaTransporte()
	{
		return $this->ca_transporte;
	}

	
	public function getCaModalidad()
	{
		return $this->ca_modalidad;
	}

	
	public function setCaIdarchivo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idarchivo !== $v) {
			$this->ca_idarchivo = $v;
			$this->modifiedColumns[] = PricArchivoPeer::CA_IDARCHIVO;
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
			$this->modifiedColumns[] = PricArchivoPeer::CA_IDTRAFICO;
		}

		if ($this->aTrafico !== null && $this->aTrafico->getCaIdtrafico() !== $v) {
			$this->aTrafico = null;
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
			$this->modifiedColumns[] = PricArchivoPeer::CA_NOMBRE;
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
			$this->modifiedColumns[] = PricArchivoPeer::CA_DESCRIPCION;
		}

		return $this;
	} 
	
	public function setCaTamano($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_tamano !== $v) {
			$this->ca_tamano = $v;
			$this->modifiedColumns[] = PricArchivoPeer::CA_TAMANO;
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
			$this->modifiedColumns[] = PricArchivoPeer::CA_TIPO;
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
				$this->modifiedColumns[] = PricArchivoPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = PricArchivoPeer::CA_USUCREADO;
		}

		return $this;
	} 
	
	public function setCaDatos($v)
	{
								if (!is_resource($v)) {
			$this->ca_datos = fopen('php://memory', 'r+');
			fwrite($this->ca_datos, $v);
			rewind($this->ca_datos);
		} else { 			$this->ca_datos = $v;
		}
		$this->modifiedColumns[] = PricArchivoPeer::CA_DATOS;

		return $this;
	} 
	
	public function setCaImpoexpo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_impoexpo !== $v) {
			$this->ca_impoexpo = $v;
			$this->modifiedColumns[] = PricArchivoPeer::CA_IMPOEXPO;
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
			$this->modifiedColumns[] = PricArchivoPeer::CA_TRANSPORTE;
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
			$this->modifiedColumns[] = PricArchivoPeer::CA_MODALIDAD;
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

			$this->ca_idarchivo = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_idtrafico = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_nombre = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_descripcion = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_tamano = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_tipo = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_fchcreado = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_usucreado = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_datos = $row[$startcol + 8];
			$this->ca_impoexpo = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_transporte = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_modalidad = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PricArchivo object", $e);
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
			$con = Propel::getConnection(PricArchivoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = PricArchivoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aTrafico = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricArchivo:delete:pre') as $callable)
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
			$con = Propel::getConnection(PricArchivoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			PricArchivoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasePricArchivo:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricArchivo:save:pre') as $callable)
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
			$con = Propel::getConnection(PricArchivoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasePricArchivo:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			PricArchivoPeer::addInstanceToPool($this);
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

			if ($this->isNew() ) {
				$this->modifiedColumns[] = PricArchivoPeer::CA_IDARCHIVO;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PricArchivoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdarchivo($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PricArchivoPeer::doUpdate($this, $con);
				}

								if ($this->ca_datos !== null && is_resource($this->ca_datos)) {
					rewind($this->ca_datos);
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


												
			if ($this->aTrafico !== null) {
				if (!$this->aTrafico->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTrafico->getValidationFailures());
				}
			}


			if (($retval = PricArchivoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PricArchivoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdarchivo();
				break;
			case 1:
				return $this->getCaIdtrafico();
				break;
			case 2:
				return $this->getCaNombre();
				break;
			case 3:
				return $this->getCaDescripcion();
				break;
			case 4:
				return $this->getCaTamano();
				break;
			case 5:
				return $this->getCaTipo();
				break;
			case 6:
				return $this->getCaFchcreado();
				break;
			case 7:
				return $this->getCaUsucreado();
				break;
			case 8:
				return $this->getCaDatos();
				break;
			case 9:
				return $this->getCaImpoexpo();
				break;
			case 10:
				return $this->getCaTransporte();
				break;
			case 11:
				return $this->getCaModalidad();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = PricArchivoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdarchivo(),
			$keys[1] => $this->getCaIdtrafico(),
			$keys[2] => $this->getCaNombre(),
			$keys[3] => $this->getCaDescripcion(),
			$keys[4] => $this->getCaTamano(),
			$keys[5] => $this->getCaTipo(),
			$keys[6] => $this->getCaFchcreado(),
			$keys[7] => $this->getCaUsucreado(),
			$keys[8] => $this->getCaDatos(),
			$keys[9] => $this->getCaImpoexpo(),
			$keys[10] => $this->getCaTransporte(),
			$keys[11] => $this->getCaModalidad(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PricArchivoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdarchivo($value);
				break;
			case 1:
				$this->setCaIdtrafico($value);
				break;
			case 2:
				$this->setCaNombre($value);
				break;
			case 3:
				$this->setCaDescripcion($value);
				break;
			case 4:
				$this->setCaTamano($value);
				break;
			case 5:
				$this->setCaTipo($value);
				break;
			case 6:
				$this->setCaFchcreado($value);
				break;
			case 7:
				$this->setCaUsucreado($value);
				break;
			case 8:
				$this->setCaDatos($value);
				break;
			case 9:
				$this->setCaImpoexpo($value);
				break;
			case 10:
				$this->setCaTransporte($value);
				break;
			case 11:
				$this->setCaModalidad($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PricArchivoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdarchivo($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdtrafico($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaNombre($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaDescripcion($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaTamano($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaTipo($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaFchcreado($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaUsucreado($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaDatos($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaImpoexpo($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaTransporte($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaModalidad($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PricArchivoPeer::DATABASE_NAME);

		if ($this->isColumnModified(PricArchivoPeer::CA_IDARCHIVO)) $criteria->add(PricArchivoPeer::CA_IDARCHIVO, $this->ca_idarchivo);
		if ($this->isColumnModified(PricArchivoPeer::CA_IDTRAFICO)) $criteria->add(PricArchivoPeer::CA_IDTRAFICO, $this->ca_idtrafico);
		if ($this->isColumnModified(PricArchivoPeer::CA_NOMBRE)) $criteria->add(PricArchivoPeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(PricArchivoPeer::CA_DESCRIPCION)) $criteria->add(PricArchivoPeer::CA_DESCRIPCION, $this->ca_descripcion);
		if ($this->isColumnModified(PricArchivoPeer::CA_TAMANO)) $criteria->add(PricArchivoPeer::CA_TAMANO, $this->ca_tamano);
		if ($this->isColumnModified(PricArchivoPeer::CA_TIPO)) $criteria->add(PricArchivoPeer::CA_TIPO, $this->ca_tipo);
		if ($this->isColumnModified(PricArchivoPeer::CA_FCHCREADO)) $criteria->add(PricArchivoPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(PricArchivoPeer::CA_USUCREADO)) $criteria->add(PricArchivoPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(PricArchivoPeer::CA_DATOS)) $criteria->add(PricArchivoPeer::CA_DATOS, $this->ca_datos);
		if ($this->isColumnModified(PricArchivoPeer::CA_IMPOEXPO)) $criteria->add(PricArchivoPeer::CA_IMPOEXPO, $this->ca_impoexpo);
		if ($this->isColumnModified(PricArchivoPeer::CA_TRANSPORTE)) $criteria->add(PricArchivoPeer::CA_TRANSPORTE, $this->ca_transporte);
		if ($this->isColumnModified(PricArchivoPeer::CA_MODALIDAD)) $criteria->add(PricArchivoPeer::CA_MODALIDAD, $this->ca_modalidad);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PricArchivoPeer::DATABASE_NAME);

		$criteria->add(PricArchivoPeer::CA_IDARCHIVO, $this->ca_idarchivo);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdarchivo();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdarchivo($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdtrafico($this->ca_idtrafico);

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaDescripcion($this->ca_descripcion);

		$copyObj->setCaTamano($this->ca_tamano);

		$copyObj->setCaTipo($this->ca_tipo);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaDatos($this->ca_datos);

		$copyObj->setCaImpoexpo($this->ca_impoexpo);

		$copyObj->setCaTransporte($this->ca_transporte);

		$copyObj->setCaModalidad($this->ca_modalidad);


		$copyObj->setNew(true);

		$copyObj->setCaIdarchivo(NULL); 
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
			self::$peer = new PricArchivoPeer();
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
			$v->addPricArchivo($this);
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

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aTrafico = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasePricArchivo:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasePricArchivo::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 