<?php


abstract class BaseCotArchivo extends BaseObject  implements Persistent {


  const PEER = 'CotArchivoPeer';

	
	protected static $peer;

	
	protected $ca_idarchivo;

	
	protected $ca_idcotizacion;

	
	protected $ca_nombre;

	
	protected $ca_tamano;

	
	protected $ca_tipo;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_datos;

	
	protected $aCotizacion;

	
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

	
	public function getCaIdcotizacion()
	{
		return $this->ca_idcotizacion;
	}

	
	public function getCaNombre()
	{
		return $this->ca_nombre;
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

	
	public function setCaIdarchivo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idarchivo !== $v) {
			$this->ca_idarchivo = $v;
			$this->modifiedColumns[] = CotArchivoPeer::CA_IDARCHIVO;
		}

		return $this;
	} 
	
	public function setCaIdcotizacion($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcotizacion !== $v) {
			$this->ca_idcotizacion = $v;
			$this->modifiedColumns[] = CotArchivoPeer::CA_IDCOTIZACION;
		}

		if ($this->aCotizacion !== null && $this->aCotizacion->getCaIdcotizacion() !== $v) {
			$this->aCotizacion = null;
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
			$this->modifiedColumns[] = CotArchivoPeer::CA_NOMBRE;
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
			$this->modifiedColumns[] = CotArchivoPeer::CA_TAMANO;
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
			$this->modifiedColumns[] = CotArchivoPeer::CA_TIPO;
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
				$this->modifiedColumns[] = CotArchivoPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = CotArchivoPeer::CA_USUCREADO;
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
		$this->modifiedColumns[] = CotArchivoPeer::CA_DATOS;

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
			$this->ca_idcotizacion = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_nombre = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_tamano = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_tipo = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_fchcreado = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_usucreado = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_datos = $row[$startcol + 7];
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating CotArchivo object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aCotizacion !== null && $this->ca_idcotizacion !== $this->aCotizacion->getCaIdcotizacion()) {
			$this->aCotizacion = null;
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
			$con = Propel::getConnection(CotArchivoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = CotArchivoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aCotizacion = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotArchivo:delete:pre') as $callable)
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
			$con = Propel::getConnection(CotArchivoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			CotArchivoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseCotArchivo:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotArchivo:save:pre') as $callable)
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
			$con = Propel::getConnection(CotArchivoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseCotArchivo:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			CotArchivoPeer::addInstanceToPool($this);
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

												
			if ($this->aCotizacion !== null) {
				if ($this->aCotizacion->isModified() || $this->aCotizacion->isNew()) {
					$affectedRows += $this->aCotizacion->save($con);
				}
				$this->setCotizacion($this->aCotizacion);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = CotArchivoPeer::CA_IDARCHIVO;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CotArchivoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdarchivo($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += CotArchivoPeer::doUpdate($this, $con);
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


												
			if ($this->aCotizacion !== null) {
				if (!$this->aCotizacion->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCotizacion->getValidationFailures());
				}
			}


			if (($retval = CotArchivoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CotArchivoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdcotizacion();
				break;
			case 2:
				return $this->getCaNombre();
				break;
			case 3:
				return $this->getCaTamano();
				break;
			case 4:
				return $this->getCaTipo();
				break;
			case 5:
				return $this->getCaFchcreado();
				break;
			case 6:
				return $this->getCaUsucreado();
				break;
			case 7:
				return $this->getCaDatos();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = CotArchivoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdarchivo(),
			$keys[1] => $this->getCaIdcotizacion(),
			$keys[2] => $this->getCaNombre(),
			$keys[3] => $this->getCaTamano(),
			$keys[4] => $this->getCaTipo(),
			$keys[5] => $this->getCaFchcreado(),
			$keys[6] => $this->getCaUsucreado(),
			$keys[7] => $this->getCaDatos(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CotArchivoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdarchivo($value);
				break;
			case 1:
				$this->setCaIdcotizacion($value);
				break;
			case 2:
				$this->setCaNombre($value);
				break;
			case 3:
				$this->setCaTamano($value);
				break;
			case 4:
				$this->setCaTipo($value);
				break;
			case 5:
				$this->setCaFchcreado($value);
				break;
			case 6:
				$this->setCaUsucreado($value);
				break;
			case 7:
				$this->setCaDatos($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CotArchivoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdarchivo($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdcotizacion($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaNombre($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaTamano($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaTipo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaFchcreado($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaUsucreado($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaDatos($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CotArchivoPeer::DATABASE_NAME);

		if ($this->isColumnModified(CotArchivoPeer::CA_IDARCHIVO)) $criteria->add(CotArchivoPeer::CA_IDARCHIVO, $this->ca_idarchivo);
		if ($this->isColumnModified(CotArchivoPeer::CA_IDCOTIZACION)) $criteria->add(CotArchivoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);
		if ($this->isColumnModified(CotArchivoPeer::CA_NOMBRE)) $criteria->add(CotArchivoPeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(CotArchivoPeer::CA_TAMANO)) $criteria->add(CotArchivoPeer::CA_TAMANO, $this->ca_tamano);
		if ($this->isColumnModified(CotArchivoPeer::CA_TIPO)) $criteria->add(CotArchivoPeer::CA_TIPO, $this->ca_tipo);
		if ($this->isColumnModified(CotArchivoPeer::CA_FCHCREADO)) $criteria->add(CotArchivoPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(CotArchivoPeer::CA_USUCREADO)) $criteria->add(CotArchivoPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(CotArchivoPeer::CA_DATOS)) $criteria->add(CotArchivoPeer::CA_DATOS, $this->ca_datos);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CotArchivoPeer::DATABASE_NAME);

		$criteria->add(CotArchivoPeer::CA_IDARCHIVO, $this->ca_idarchivo);

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

		$copyObj->setCaIdcotizacion($this->ca_idcotizacion);

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaTamano($this->ca_tamano);

		$copyObj->setCaTipo($this->ca_tipo);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaDatos($this->ca_datos);


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
			self::$peer = new CotArchivoPeer();
		}
		return self::$peer;
	}

	
	public function setCotizacion(Cotizacion $v = null)
	{
		if ($v === null) {
			$this->setCaIdcotizacion(NULL);
		} else {
			$this->setCaIdcotizacion($v->getCaIdcotizacion());
		}

		$this->aCotizacion = $v;

						if ($v !== null) {
			$v->addCotArchivo($this);
		}

		return $this;
	}


	
	public function getCotizacion(PropelPDO $con = null)
	{
		if ($this->aCotizacion === null && ($this->ca_idcotizacion !== null)) {
			$c = new Criteria(CotizacionPeer::DATABASE_NAME);
			$c->add(CotizacionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);
			$this->aCotizacion = CotizacionPeer::doSelectOne($c, $con);
			
		}
		return $this->aCotizacion;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aCotizacion = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseCotArchivo:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseCotArchivo::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 