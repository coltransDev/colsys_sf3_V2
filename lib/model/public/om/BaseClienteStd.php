<?php


abstract class BaseClienteStd extends BaseObject  implements Persistent {


  const PEER = 'ClienteStdPeer';

	
	protected static $peer;

	
	protected $ca_idcliente;

	
	protected $ca_fchestado;

	
	protected $ca_estado;

	
	protected $ca_empresa;

	
	protected $aCliente;

	
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

	
	public function getCaIdcliente()
	{
		return $this->ca_idcliente;
	}

	
	public function getCaFchestado($format = 'Y-m-d')
	{
		if ($this->ca_fchestado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchestado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchestado, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaEstado()
	{
		return $this->ca_estado;
	}

	
	public function getCaEmpresa()
	{
		return $this->ca_empresa;
	}

	
	public function setCaIdcliente($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcliente !== $v) {
			$this->ca_idcliente = $v;
			$this->modifiedColumns[] = ClienteStdPeer::CA_IDCLIENTE;
		}

		if ($this->aCliente !== null && $this->aCliente->getCaIdcliente() !== $v) {
			$this->aCliente = null;
		}

		return $this;
	} 
	
	public function setCaFchestado($v)
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

		if ( $this->ca_fchestado !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchestado !== null && $tmpDt = new DateTime($this->ca_fchestado)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchestado = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = ClienteStdPeer::CA_FCHESTADO;
			}
		} 
		return $this;
	} 
	
	public function setCaEstado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_estado !== $v) {
			$this->ca_estado = $v;
			$this->modifiedColumns[] = ClienteStdPeer::CA_ESTADO;
		}

		return $this;
	} 
	
	public function setCaEmpresa($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_empresa !== $v) {
			$this->ca_empresa = $v;
			$this->modifiedColumns[] = ClienteStdPeer::CA_EMPRESA;
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

			$this->ca_idcliente = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_fchestado = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_estado = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_empresa = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ClienteStd object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aCliente !== null && $this->ca_idcliente !== $this->aCliente->getCaIdcliente()) {
			$this->aCliente = null;
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
			$con = Propel::getConnection(ClienteStdPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = ClienteStdPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aCliente = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseClienteStd:delete:pre') as $callable)
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
			$con = Propel::getConnection(ClienteStdPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			ClienteStdPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseClienteStd:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseClienteStd:save:pre') as $callable)
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
			$con = Propel::getConnection(ClienteStdPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseClienteStd:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			ClienteStdPeer::addInstanceToPool($this);
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

												
			if ($this->aCliente !== null) {
				if ($this->aCliente->isModified() || $this->aCliente->isNew()) {
					$affectedRows += $this->aCliente->save($con);
				}
				$this->setCliente($this->aCliente);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ClienteStdPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += ClienteStdPeer::doUpdate($this, $con);
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


												
			if ($this->aCliente !== null) {
				if (!$this->aCliente->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCliente->getValidationFailures());
				}
			}


			if (($retval = ClienteStdPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ClienteStdPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdcliente();
				break;
			case 1:
				return $this->getCaFchestado();
				break;
			case 2:
				return $this->getCaEstado();
				break;
			case 3:
				return $this->getCaEmpresa();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = ClienteStdPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdcliente(),
			$keys[1] => $this->getCaFchestado(),
			$keys[2] => $this->getCaEstado(),
			$keys[3] => $this->getCaEmpresa(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ClienteStdPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdcliente($value);
				break;
			case 1:
				$this->setCaFchestado($value);
				break;
			case 2:
				$this->setCaEstado($value);
				break;
			case 3:
				$this->setCaEmpresa($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ClienteStdPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdcliente($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaFchestado($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaEstado($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaEmpresa($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ClienteStdPeer::DATABASE_NAME);

		if ($this->isColumnModified(ClienteStdPeer::CA_IDCLIENTE)) $criteria->add(ClienteStdPeer::CA_IDCLIENTE, $this->ca_idcliente);
		if ($this->isColumnModified(ClienteStdPeer::CA_FCHESTADO)) $criteria->add(ClienteStdPeer::CA_FCHESTADO, $this->ca_fchestado);
		if ($this->isColumnModified(ClienteStdPeer::CA_ESTADO)) $criteria->add(ClienteStdPeer::CA_ESTADO, $this->ca_estado);
		if ($this->isColumnModified(ClienteStdPeer::CA_EMPRESA)) $criteria->add(ClienteStdPeer::CA_EMPRESA, $this->ca_empresa);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ClienteStdPeer::DATABASE_NAME);

		$criteria->add(ClienteStdPeer::CA_IDCLIENTE, $this->ca_idcliente);
		$criteria->add(ClienteStdPeer::CA_FCHESTADO, $this->ca_fchestado);
		$criteria->add(ClienteStdPeer::CA_EMPRESA, $this->ca_empresa);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaIdcliente();

		$pks[1] = $this->getCaFchestado();

		$pks[2] = $this->getCaEmpresa();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaIdcliente($keys[0]);

		$this->setCaFchestado($keys[1]);

		$this->setCaEmpresa($keys[2]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdcliente($this->ca_idcliente);

		$copyObj->setCaFchestado($this->ca_fchestado);

		$copyObj->setCaEstado($this->ca_estado);

		$copyObj->setCaEmpresa($this->ca_empresa);


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
			self::$peer = new ClienteStdPeer();
		}
		return self::$peer;
	}

	
	public function setCliente(Cliente $v = null)
	{
		if ($v === null) {
			$this->setCaIdcliente(NULL);
		} else {
			$this->setCaIdcliente($v->getCaIdcliente());
		}

		$this->aCliente = $v;

						if ($v !== null) {
			$v->addClienteStd($this);
		}

		return $this;
	}


	
	public function getCliente(PropelPDO $con = null)
	{
		if ($this->aCliente === null && ($this->ca_idcliente !== null)) {
			$c = new Criteria(ClientePeer::DATABASE_NAME);
			$c->add(ClientePeer::CA_IDCLIENTE, $this->ca_idcliente);
			$this->aCliente = ClientePeer::doSelectOne($c, $con);
			
		}
		return $this->aCliente;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aCliente = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseClienteStd:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseClienteStd::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 