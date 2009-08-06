<?php


abstract class BasePricNotificacion extends BaseObject  implements Persistent {


  const PEER = 'PricNotificacionPeer';

	
	protected static $peer;

	
	protected $ca_idnotificacion;

	
	protected $ca_titulo;

	
	protected $ca_mensaje;

	
	protected $ca_caducidad;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
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

	
	public function getCaIdnotificacion()
	{
		return $this->ca_idnotificacion;
	}

	
	public function getCaTitulo()
	{
		return $this->ca_titulo;
	}

	
	public function getCaMensaje()
	{
		return $this->ca_mensaje;
	}

	
	public function getCaCaducidad($format = 'Y-m-d')
	{
		if ($this->ca_caducidad === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_caducidad);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_caducidad, true), $x);
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

	
	public function setCaIdnotificacion($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idnotificacion !== $v) {
			$this->ca_idnotificacion = $v;
			$this->modifiedColumns[] = PricNotificacionPeer::CA_IDNOTIFICACION;
		}

		return $this;
	} 
	
	public function setCaTitulo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_titulo !== $v) {
			$this->ca_titulo = $v;
			$this->modifiedColumns[] = PricNotificacionPeer::CA_TITULO;
		}

		return $this;
	} 
	
	public function setCaMensaje($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_mensaje !== $v) {
			$this->ca_mensaje = $v;
			$this->modifiedColumns[] = PricNotificacionPeer::CA_MENSAJE;
		}

		return $this;
	} 
	
	public function setCaCaducidad($v)
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

		if ( $this->ca_caducidad !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_caducidad !== null && $tmpDt = new DateTime($this->ca_caducidad)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_caducidad = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = PricNotificacionPeer::CA_CADUCIDAD;
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
				$this->modifiedColumns[] = PricNotificacionPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = PricNotificacionPeer::CA_USUCREADO;
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

			$this->ca_idnotificacion = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_titulo = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_mensaje = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_caducidad = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_fchcreado = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_usucreado = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PricNotificacion object", $e);
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
			$con = Propel::getConnection(PricNotificacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = PricNotificacionPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricNotificacion:delete:pre') as $callable)
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
			$con = Propel::getConnection(PricNotificacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			PricNotificacionPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasePricNotificacion:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricNotificacion:save:pre') as $callable)
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
			$con = Propel::getConnection(PricNotificacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasePricNotificacion:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			PricNotificacionPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = PricNotificacionPeer::CA_IDNOTIFICACION;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PricNotificacionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdnotificacion($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PricNotificacionPeer::doUpdate($this, $con);
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


			if (($retval = PricNotificacionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PricNotificacionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdnotificacion();
				break;
			case 1:
				return $this->getCaTitulo();
				break;
			case 2:
				return $this->getCaMensaje();
				break;
			case 3:
				return $this->getCaCaducidad();
				break;
			case 4:
				return $this->getCaFchcreado();
				break;
			case 5:
				return $this->getCaUsucreado();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = PricNotificacionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdnotificacion(),
			$keys[1] => $this->getCaTitulo(),
			$keys[2] => $this->getCaMensaje(),
			$keys[3] => $this->getCaCaducidad(),
			$keys[4] => $this->getCaFchcreado(),
			$keys[5] => $this->getCaUsucreado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PricNotificacionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdnotificacion($value);
				break;
			case 1:
				$this->setCaTitulo($value);
				break;
			case 2:
				$this->setCaMensaje($value);
				break;
			case 3:
				$this->setCaCaducidad($value);
				break;
			case 4:
				$this->setCaFchcreado($value);
				break;
			case 5:
				$this->setCaUsucreado($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PricNotificacionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdnotificacion($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaTitulo($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaMensaje($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaCaducidad($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaFchcreado($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaUsucreado($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PricNotificacionPeer::DATABASE_NAME);

		if ($this->isColumnModified(PricNotificacionPeer::CA_IDNOTIFICACION)) $criteria->add(PricNotificacionPeer::CA_IDNOTIFICACION, $this->ca_idnotificacion);
		if ($this->isColumnModified(PricNotificacionPeer::CA_TITULO)) $criteria->add(PricNotificacionPeer::CA_TITULO, $this->ca_titulo);
		if ($this->isColumnModified(PricNotificacionPeer::CA_MENSAJE)) $criteria->add(PricNotificacionPeer::CA_MENSAJE, $this->ca_mensaje);
		if ($this->isColumnModified(PricNotificacionPeer::CA_CADUCIDAD)) $criteria->add(PricNotificacionPeer::CA_CADUCIDAD, $this->ca_caducidad);
		if ($this->isColumnModified(PricNotificacionPeer::CA_FCHCREADO)) $criteria->add(PricNotificacionPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(PricNotificacionPeer::CA_USUCREADO)) $criteria->add(PricNotificacionPeer::CA_USUCREADO, $this->ca_usucreado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PricNotificacionPeer::DATABASE_NAME);

		$criteria->add(PricNotificacionPeer::CA_IDNOTIFICACION, $this->ca_idnotificacion);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdnotificacion();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdnotificacion($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaTitulo($this->ca_titulo);

		$copyObj->setCaMensaje($this->ca_mensaje);

		$copyObj->setCaCaducidad($this->ca_caducidad);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);


		$copyObj->setNew(true);

		$copyObj->setCaIdnotificacion(NULL); 
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
			self::$peer = new PricNotificacionPeer();
		}
		return self::$peer;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasePricNotificacion:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasePricNotificacion::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 