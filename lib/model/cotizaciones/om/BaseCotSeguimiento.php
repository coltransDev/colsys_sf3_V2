<?php


abstract class BaseCotSeguimiento extends BaseObject  implements Persistent {


  const PEER = 'CotSeguimientoPeer';

	
	protected static $peer;

	
	protected $ca_idcotizacion;

	
	protected $ca_idproducto;

	
	protected $ca_fchseguimiento;

	
	protected $ca_login;

	
	protected $ca_seguimiento;

	
	protected $ca_etapa;

	
	protected $aCotizacion;

	
	protected $aCotProducto;

	
	protected $aUsuario;

	
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

	
	public function getCaIdcotizacion()
	{
		return $this->ca_idcotizacion;
	}

	
	public function getCaIdproducto()
	{
		return $this->ca_idproducto;
	}

	
	public function getCaFchseguimiento($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchseguimiento === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchseguimiento);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchseguimiento, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaLogin()
	{
		return $this->ca_login;
	}

	
	public function getCaSeguimiento()
	{
		return $this->ca_seguimiento;
	}

	
	public function getCaEtapa()
	{
		return $this->ca_etapa;
	}

	
	public function setCaIdcotizacion($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcotizacion !== $v) {
			$this->ca_idcotizacion = $v;
			$this->modifiedColumns[] = CotSeguimientoPeer::CA_IDCOTIZACION;
		}

		if ($this->aCotizacion !== null && $this->aCotizacion->getCaIdcotizacion() !== $v) {
			$this->aCotizacion = null;
		}

		if ($this->aCotProducto !== null && $this->aCotProducto->getCaIdcotizacion() !== $v) {
			$this->aCotProducto = null;
		}

		return $this;
	} 
	
	public function setCaIdproducto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idproducto !== $v) {
			$this->ca_idproducto = $v;
			$this->modifiedColumns[] = CotSeguimientoPeer::CA_IDPRODUCTO;
		}

		if ($this->aCotProducto !== null && $this->aCotProducto->getCaIdproducto() !== $v) {
			$this->aCotProducto = null;
		}

		return $this;
	} 
	
	public function setCaFchseguimiento($v)
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

		if ( $this->ca_fchseguimiento !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchseguimiento !== null && $tmpDt = new DateTime($this->ca_fchseguimiento)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchseguimiento = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = CotSeguimientoPeer::CA_FCHSEGUIMIENTO;
			}
		} 
		return $this;
	} 
	
	public function setCaLogin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_login !== $v) {
			$this->ca_login = $v;
			$this->modifiedColumns[] = CotSeguimientoPeer::CA_LOGIN;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getCaLogin() !== $v) {
			$this->aUsuario = null;
		}

		return $this;
	} 
	
	public function setCaSeguimiento($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_seguimiento !== $v) {
			$this->ca_seguimiento = $v;
			$this->modifiedColumns[] = CotSeguimientoPeer::CA_SEGUIMIENTO;
		}

		return $this;
	} 
	
	public function setCaEtapa($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_etapa !== $v) {
			$this->ca_etapa = $v;
			$this->modifiedColumns[] = CotSeguimientoPeer::CA_ETAPA;
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

			$this->ca_idcotizacion = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idproducto = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_fchseguimiento = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_login = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_seguimiento = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_etapa = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating CotSeguimiento object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aCotizacion !== null && $this->ca_idcotizacion !== $this->aCotizacion->getCaIdcotizacion()) {
			$this->aCotizacion = null;
		}
		if ($this->aCotProducto !== null && $this->ca_idcotizacion !== $this->aCotProducto->getCaIdcotizacion()) {
			$this->aCotProducto = null;
		}
		if ($this->aCotProducto !== null && $this->ca_idproducto !== $this->aCotProducto->getCaIdproducto()) {
			$this->aCotProducto = null;
		}
		if ($this->aUsuario !== null && $this->ca_login !== $this->aUsuario->getCaLogin()) {
			$this->aUsuario = null;
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
			$con = Propel::getConnection(CotSeguimientoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = CotSeguimientoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aCotizacion = null;
			$this->aCotProducto = null;
			$this->aUsuario = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotSeguimiento:delete:pre') as $callable)
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
			$con = Propel::getConnection(CotSeguimientoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			CotSeguimientoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseCotSeguimiento:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotSeguimiento:save:pre') as $callable)
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
			$con = Propel::getConnection(CotSeguimientoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseCotSeguimiento:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			CotSeguimientoPeer::addInstanceToPool($this);
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

			if ($this->aCotProducto !== null) {
				if ($this->aCotProducto->isModified() || $this->aCotProducto->isNew()) {
					$affectedRows += $this->aCotProducto->save($con);
				}
				$this->setCotProducto($this->aCotProducto);
			}

			if ($this->aUsuario !== null) {
				if ($this->aUsuario->isModified() || $this->aUsuario->isNew()) {
					$affectedRows += $this->aUsuario->save($con);
				}
				$this->setUsuario($this->aUsuario);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CotSeguimientoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += CotSeguimientoPeer::doUpdate($this, $con);
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

			if ($this->aCotProducto !== null) {
				if (!$this->aCotProducto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCotProducto->getValidationFailures());
				}
			}

			if ($this->aUsuario !== null) {
				if (!$this->aUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuario->getValidationFailures());
				}
			}


			if (($retval = CotSeguimientoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CotSeguimientoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdcotizacion();
				break;
			case 1:
				return $this->getCaIdproducto();
				break;
			case 2:
				return $this->getCaFchseguimiento();
				break;
			case 3:
				return $this->getCaLogin();
				break;
			case 4:
				return $this->getCaSeguimiento();
				break;
			case 5:
				return $this->getCaEtapa();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = CotSeguimientoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdcotizacion(),
			$keys[1] => $this->getCaIdproducto(),
			$keys[2] => $this->getCaFchseguimiento(),
			$keys[3] => $this->getCaLogin(),
			$keys[4] => $this->getCaSeguimiento(),
			$keys[5] => $this->getCaEtapa(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CotSeguimientoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdcotizacion($value);
				break;
			case 1:
				$this->setCaIdproducto($value);
				break;
			case 2:
				$this->setCaFchseguimiento($value);
				break;
			case 3:
				$this->setCaLogin($value);
				break;
			case 4:
				$this->setCaSeguimiento($value);
				break;
			case 5:
				$this->setCaEtapa($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CotSeguimientoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdcotizacion($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdproducto($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaFchseguimiento($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaLogin($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaSeguimiento($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaEtapa($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CotSeguimientoPeer::DATABASE_NAME);

		if ($this->isColumnModified(CotSeguimientoPeer::CA_IDCOTIZACION)) $criteria->add(CotSeguimientoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);
		if ($this->isColumnModified(CotSeguimientoPeer::CA_IDPRODUCTO)) $criteria->add(CotSeguimientoPeer::CA_IDPRODUCTO, $this->ca_idproducto);
		if ($this->isColumnModified(CotSeguimientoPeer::CA_FCHSEGUIMIENTO)) $criteria->add(CotSeguimientoPeer::CA_FCHSEGUIMIENTO, $this->ca_fchseguimiento);
		if ($this->isColumnModified(CotSeguimientoPeer::CA_LOGIN)) $criteria->add(CotSeguimientoPeer::CA_LOGIN, $this->ca_login);
		if ($this->isColumnModified(CotSeguimientoPeer::CA_SEGUIMIENTO)) $criteria->add(CotSeguimientoPeer::CA_SEGUIMIENTO, $this->ca_seguimiento);
		if ($this->isColumnModified(CotSeguimientoPeer::CA_ETAPA)) $criteria->add(CotSeguimientoPeer::CA_ETAPA, $this->ca_etapa);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CotSeguimientoPeer::DATABASE_NAME);

		$criteria->add(CotSeguimientoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);
		$criteria->add(CotSeguimientoPeer::CA_IDPRODUCTO, $this->ca_idproducto);
		$criteria->add(CotSeguimientoPeer::CA_FCHSEGUIMIENTO, $this->ca_fchseguimiento);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaIdcotizacion();

		$pks[1] = $this->getCaIdproducto();

		$pks[2] = $this->getCaFchseguimiento();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaIdcotizacion($keys[0]);

		$this->setCaIdproducto($keys[1]);

		$this->setCaFchseguimiento($keys[2]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdcotizacion($this->ca_idcotizacion);

		$copyObj->setCaIdproducto($this->ca_idproducto);

		$copyObj->setCaFchseguimiento($this->ca_fchseguimiento);

		$copyObj->setCaLogin($this->ca_login);

		$copyObj->setCaSeguimiento($this->ca_seguimiento);

		$copyObj->setCaEtapa($this->ca_etapa);


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
			self::$peer = new CotSeguimientoPeer();
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
			$v->addCotSeguimiento($this);
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

	
	public function setCotProducto(CotProducto $v = null)
	{
		if ($v === null) {
			$this->setCaIdproducto(NULL);
		} else {
			$this->setCaIdproducto($v->getCaIdproducto());
		}

		if ($v === null) {
			$this->setCaIdcotizacion(NULL);
		} else {
			$this->setCaIdcotizacion($v->getCaIdcotizacion());
		}

		$this->aCotProducto = $v;

						if ($v !== null) {
			$v->addCotSeguimiento($this);
		}

		return $this;
	}


	
	public function getCotProducto(PropelPDO $con = null)
	{
		if ($this->aCotProducto === null && ($this->ca_idproducto !== null && $this->ca_idcotizacion !== null)) {
			$c = new Criteria(CotProductoPeer::DATABASE_NAME);
			$c->add(CotProductoPeer::CA_IDPRODUCTO, $this->ca_idproducto);
			$c->add(CotProductoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);
			$this->aCotProducto = CotProductoPeer::doSelectOne($c, $con);
			
		}
		return $this->aCotProducto;
	}

	
	public function setUsuario(Usuario $v = null)
	{
		if ($v === null) {
			$this->setCaLogin(NULL);
		} else {
			$this->setCaLogin($v->getCaLogin());
		}

		$this->aUsuario = $v;

						if ($v !== null) {
			$v->addCotSeguimiento($this);
		}

		return $this;
	}


	
	public function getUsuario(PropelPDO $con = null)
	{
		if ($this->aUsuario === null && (($this->ca_login !== "" && $this->ca_login !== null))) {
			$c = new Criteria(UsuarioPeer::DATABASE_NAME);
			$c->add(UsuarioPeer::CA_LOGIN, $this->ca_login);
			$this->aUsuario = UsuarioPeer::doSelectOne($c, $con);
			
		}
		return $this->aUsuario;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aCotizacion = null;
			$this->aCotProducto = null;
			$this->aUsuario = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseCotSeguimiento:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseCotSeguimiento::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 