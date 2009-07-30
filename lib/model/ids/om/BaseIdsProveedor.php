<?php


abstract class BaseIdsProveedor extends BaseObject  implements Persistent {


  const PEER = 'IdsProveedorPeer';

	
	protected static $peer;

	
	protected $ca_idproveedor;

	
	protected $ca_tipo;

	
	protected $ca_critico;

	
	protected $ca_controladoporsig;

	
	protected $ca_fchaprobado;

	
	protected $ca_usuaprobado;

	
	protected $aIds;

	
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

	
	public function getCaIdproveedor()
	{
		return $this->ca_idproveedor;
	}

	
	public function getCaTipo()
	{
		return $this->ca_tipo;
	}

	
	public function getCaCritico()
	{
		return $this->ca_critico;
	}

	
	public function getCaControladoporsig()
	{
		return $this->ca_controladoporsig;
	}

	
	public function getCaFchaprobado($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchaprobado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchaprobado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchaprobado, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaUsuaprobado()
	{
		return $this->ca_usuaprobado;
	}

	
	public function setCaIdproveedor($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idproveedor !== $v) {
			$this->ca_idproveedor = $v;
			$this->modifiedColumns[] = IdsProveedorPeer::CA_IDPROVEEDOR;
		}

		if ($this->aIds !== null && $this->aIds->getCaId() !== $v) {
			$this->aIds = null;
		}

		return $this;
	} 
	
	public function setCaTipo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_tipo !== $v) {
			$this->ca_tipo = $v;
			$this->modifiedColumns[] = IdsProveedorPeer::CA_TIPO;
		}

		return $this;
	} 
	
	public function setCaCritico($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_critico !== $v) {
			$this->ca_critico = $v;
			$this->modifiedColumns[] = IdsProveedorPeer::CA_CRITICO;
		}

		return $this;
	} 
	
	public function setCaControladoporsig($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_controladoporsig !== $v) {
			$this->ca_controladoporsig = $v;
			$this->modifiedColumns[] = IdsProveedorPeer::CA_CONTROLADOPORSIG;
		}

		return $this;
	} 
	
	public function setCaFchaprobado($v)
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

		if ( $this->ca_fchaprobado !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchaprobado !== null && $tmpDt = new DateTime($this->ca_fchaprobado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchaprobado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = IdsProveedorPeer::CA_FCHAPROBADO;
			}
		} 
		return $this;
	} 
	
	public function setCaUsuaprobado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuaprobado !== $v) {
			$this->ca_usuaprobado = $v;
			$this->modifiedColumns[] = IdsProveedorPeer::CA_USUAPROBADO;
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

			$this->ca_idproveedor = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_tipo = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_critico = ($row[$startcol + 2] !== null) ? (boolean) $row[$startcol + 2] : null;
			$this->ca_controladoporsig = ($row[$startcol + 3] !== null) ? (boolean) $row[$startcol + 3] : null;
			$this->ca_fchaprobado = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_usuaprobado = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating IdsProveedor object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aIds !== null && $this->ca_idproveedor !== $this->aIds->getCaId()) {
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
			$con = Propel::getConnection(IdsProveedorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = IdsProveedorPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aIds = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsProveedor:delete:pre') as $callable)
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
			$con = Propel::getConnection(IdsProveedorPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			IdsProveedorPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseIdsProveedor:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsProveedor:save:pre') as $callable)
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
			$con = Propel::getConnection(IdsProveedorPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseIdsProveedor:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			IdsProveedorPeer::addInstanceToPool($this);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = IdsProveedorPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += IdsProveedorPeer::doUpdate($this, $con);
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


												
			if ($this->aIds !== null) {
				if (!$this->aIds->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aIds->getValidationFailures());
				}
			}


			if (($retval = IdsProveedorPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = IdsProveedorPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdproveedor();
				break;
			case 1:
				return $this->getCaTipo();
				break;
			case 2:
				return $this->getCaCritico();
				break;
			case 3:
				return $this->getCaControladoporsig();
				break;
			case 4:
				return $this->getCaFchaprobado();
				break;
			case 5:
				return $this->getCaUsuaprobado();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = IdsProveedorPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdproveedor(),
			$keys[1] => $this->getCaTipo(),
			$keys[2] => $this->getCaCritico(),
			$keys[3] => $this->getCaControladoporsig(),
			$keys[4] => $this->getCaFchaprobado(),
			$keys[5] => $this->getCaUsuaprobado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = IdsProveedorPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdproveedor($value);
				break;
			case 1:
				$this->setCaTipo($value);
				break;
			case 2:
				$this->setCaCritico($value);
				break;
			case 3:
				$this->setCaControladoporsig($value);
				break;
			case 4:
				$this->setCaFchaprobado($value);
				break;
			case 5:
				$this->setCaUsuaprobado($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = IdsProveedorPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdproveedor($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaTipo($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaCritico($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaControladoporsig($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaFchaprobado($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaUsuaprobado($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(IdsProveedorPeer::DATABASE_NAME);

		if ($this->isColumnModified(IdsProveedorPeer::CA_IDPROVEEDOR)) $criteria->add(IdsProveedorPeer::CA_IDPROVEEDOR, $this->ca_idproveedor);
		if ($this->isColumnModified(IdsProveedorPeer::CA_TIPO)) $criteria->add(IdsProveedorPeer::CA_TIPO, $this->ca_tipo);
		if ($this->isColumnModified(IdsProveedorPeer::CA_CRITICO)) $criteria->add(IdsProveedorPeer::CA_CRITICO, $this->ca_critico);
		if ($this->isColumnModified(IdsProveedorPeer::CA_CONTROLADOPORSIG)) $criteria->add(IdsProveedorPeer::CA_CONTROLADOPORSIG, $this->ca_controladoporsig);
		if ($this->isColumnModified(IdsProveedorPeer::CA_FCHAPROBADO)) $criteria->add(IdsProveedorPeer::CA_FCHAPROBADO, $this->ca_fchaprobado);
		if ($this->isColumnModified(IdsProveedorPeer::CA_USUAPROBADO)) $criteria->add(IdsProveedorPeer::CA_USUAPROBADO, $this->ca_usuaprobado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(IdsProveedorPeer::DATABASE_NAME);

		$criteria->add(IdsProveedorPeer::CA_IDPROVEEDOR, $this->ca_idproveedor);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdproveedor();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdproveedor($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdproveedor($this->ca_idproveedor);

		$copyObj->setCaTipo($this->ca_tipo);

		$copyObj->setCaCritico($this->ca_critico);

		$copyObj->setCaControladoporsig($this->ca_controladoporsig);

		$copyObj->setCaFchaprobado($this->ca_fchaprobado);

		$copyObj->setCaUsuaprobado($this->ca_usuaprobado);


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
			self::$peer = new IdsProveedorPeer();
		}
		return self::$peer;
	}

	
	public function setIds(Ids $v = null)
	{
		if ($v === null) {
			$this->setCaIdproveedor(NULL);
		} else {
			$this->setCaIdproveedor($v->getCaId());
		}

		$this->aIds = $v;

				if ($v !== null) {
			$v->setIdsProveedor($this);
		}

		return $this;
	}


	
	public function getIds(PropelPDO $con = null)
	{
		if ($this->aIds === null && ($this->ca_idproveedor !== null)) {
			$c = new Criteria(IdsPeer::DATABASE_NAME);
			$c->add(IdsPeer::CA_ID, $this->ca_idproveedor);
			$this->aIds = IdsPeer::doSelectOne($c, $con);
						$this->aIds->setIdsProveedor($this);
		}
		return $this->aIds;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aIds = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseIdsProveedor:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseIdsProveedor::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 