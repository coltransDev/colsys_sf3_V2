<?php


abstract class BaseInoAvisosSea extends BaseObject  implements Persistent {


  const PEER = 'InoAvisosSeaPeer';

	
	protected static $peer;

	
	protected $ca_referencia;

	
	protected $ca_idcliente;

	
	protected $ca_hbls;

	
	protected $ca_idemail;

	
	protected $ca_fchaviso;

	
	protected $ca_aviso;

	
	protected $ca_idbodega;

	
	protected $ca_fchllegada;

	
	protected $ca_fchenvio;

	
	protected $ca_usuenvio;

	
	protected $aInoClientesSea;

	
	protected $aInoMaestraSea;

	
	protected $aCliente;

	
	protected $aEmail;

	
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

	
	public function getCaReferencia()
	{
		return $this->ca_referencia;
	}

	
	public function getCaIdcliente()
	{
		return $this->ca_idcliente;
	}

	
	public function getCaHbls()
	{
		return $this->ca_hbls;
	}

	
	public function getCaIdemail()
	{
		return $this->ca_idemail;
	}

	
	public function getCaFchaviso($format = 'Y-m-d')
	{
		if ($this->ca_fchaviso === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchaviso);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchaviso, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaAviso()
	{
		return $this->ca_aviso;
	}

	
	public function getCaIdbodega()
	{
		return $this->ca_idbodega;
	}

	
	public function getCaFchllegada($format = 'Y-m-d')
	{
		if ($this->ca_fchllegada === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchllegada);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchllegada, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaFchenvio($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchenvio === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchenvio);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchenvio, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaUsuenvio()
	{
		return $this->ca_usuenvio;
	}

	
	public function setCaReferencia($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_referencia !== $v) {
			$this->ca_referencia = $v;
			$this->modifiedColumns[] = InoAvisosSeaPeer::CA_REFERENCIA;
		}

		if ($this->aInoClientesSea !== null && $this->aInoClientesSea->getCaReferencia() !== $v) {
			$this->aInoClientesSea = null;
		}

		if ($this->aInoMaestraSea !== null && $this->aInoMaestraSea->getCaReferencia() !== $v) {
			$this->aInoMaestraSea = null;
		}

		return $this;
	} 
	
	public function setCaIdcliente($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcliente !== $v) {
			$this->ca_idcliente = $v;
			$this->modifiedColumns[] = InoAvisosSeaPeer::CA_IDCLIENTE;
		}

		if ($this->aInoClientesSea !== null && $this->aInoClientesSea->getCaIdcliente() !== $v) {
			$this->aInoClientesSea = null;
		}

		if ($this->aCliente !== null && $this->aCliente->getCaIdcliente() !== $v) {
			$this->aCliente = null;
		}

		return $this;
	} 
	
	public function setCaHbls($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_hbls !== $v) {
			$this->ca_hbls = $v;
			$this->modifiedColumns[] = InoAvisosSeaPeer::CA_HBLS;
		}

		if ($this->aInoClientesSea !== null && $this->aInoClientesSea->getCaHbls() !== $v) {
			$this->aInoClientesSea = null;
		}

		return $this;
	} 
	
	public function setCaIdemail($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idemail !== $v) {
			$this->ca_idemail = $v;
			$this->modifiedColumns[] = InoAvisosSeaPeer::CA_IDEMAIL;
		}

		if ($this->aEmail !== null && $this->aEmail->getCaIdemail() !== $v) {
			$this->aEmail = null;
		}

		return $this;
	} 
	
	public function setCaFchaviso($v)
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

		if ( $this->ca_fchaviso !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchaviso !== null && $tmpDt = new DateTime($this->ca_fchaviso)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchaviso = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = InoAvisosSeaPeer::CA_FCHAVISO;
			}
		} 
		return $this;
	} 
	
	public function setCaAviso($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_aviso !== $v) {
			$this->ca_aviso = $v;
			$this->modifiedColumns[] = InoAvisosSeaPeer::CA_AVISO;
		}

		return $this;
	} 
	
	public function setCaIdbodega($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idbodega !== $v) {
			$this->ca_idbodega = $v;
			$this->modifiedColumns[] = InoAvisosSeaPeer::CA_IDBODEGA;
		}

		return $this;
	} 
	
	public function setCaFchllegada($v)
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

		if ( $this->ca_fchllegada !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchllegada !== null && $tmpDt = new DateTime($this->ca_fchllegada)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchllegada = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = InoAvisosSeaPeer::CA_FCHLLEGADA;
			}
		} 
		return $this;
	} 
	
	public function setCaFchenvio($v)
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

		if ( $this->ca_fchenvio !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchenvio !== null && $tmpDt = new DateTime($this->ca_fchenvio)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchenvio = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = InoAvisosSeaPeer::CA_FCHENVIO;
			}
		} 
		return $this;
	} 
	
	public function setCaUsuenvio($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuenvio !== $v) {
			$this->ca_usuenvio = $v;
			$this->modifiedColumns[] = InoAvisosSeaPeer::CA_USUENVIO;
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

			$this->ca_referencia = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_idcliente = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_hbls = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_idemail = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->ca_fchaviso = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_aviso = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_idbodega = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->ca_fchllegada = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_fchenvio = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_usuenvio = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating InoAvisosSea object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aInoClientesSea !== null && $this->ca_referencia !== $this->aInoClientesSea->getCaReferencia()) {
			$this->aInoClientesSea = null;
		}
		if ($this->aInoMaestraSea !== null && $this->ca_referencia !== $this->aInoMaestraSea->getCaReferencia()) {
			$this->aInoMaestraSea = null;
		}
		if ($this->aInoClientesSea !== null && $this->ca_idcliente !== $this->aInoClientesSea->getCaIdcliente()) {
			$this->aInoClientesSea = null;
		}
		if ($this->aCliente !== null && $this->ca_idcliente !== $this->aCliente->getCaIdcliente()) {
			$this->aCliente = null;
		}
		if ($this->aInoClientesSea !== null && $this->ca_hbls !== $this->aInoClientesSea->getCaHbls()) {
			$this->aInoClientesSea = null;
		}
		if ($this->aEmail !== null && $this->ca_idemail !== $this->aEmail->getCaIdemail()) {
			$this->aEmail = null;
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
			$con = Propel::getConnection(InoAvisosSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = InoAvisosSeaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aInoClientesSea = null;
			$this->aInoMaestraSea = null;
			$this->aCliente = null;
			$this->aEmail = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoAvisosSea:delete:pre') as $callable)
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
			$con = Propel::getConnection(InoAvisosSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			InoAvisosSeaPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseInoAvisosSea:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoAvisosSea:save:pre') as $callable)
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
			$con = Propel::getConnection(InoAvisosSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseInoAvisosSea:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			InoAvisosSeaPeer::addInstanceToPool($this);
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

												
			if ($this->aInoClientesSea !== null) {
				if ($this->aInoClientesSea->isModified() || $this->aInoClientesSea->isNew()) {
					$affectedRows += $this->aInoClientesSea->save($con);
				}
				$this->setInoClientesSea($this->aInoClientesSea);
			}

			if ($this->aInoMaestraSea !== null) {
				if ($this->aInoMaestraSea->isModified() || $this->aInoMaestraSea->isNew()) {
					$affectedRows += $this->aInoMaestraSea->save($con);
				}
				$this->setInoMaestraSea($this->aInoMaestraSea);
			}

			if ($this->aCliente !== null) {
				if ($this->aCliente->isModified() || $this->aCliente->isNew()) {
					$affectedRows += $this->aCliente->save($con);
				}
				$this->setCliente($this->aCliente);
			}

			if ($this->aEmail !== null) {
				if ($this->aEmail->isModified() || $this->aEmail->isNew()) {
					$affectedRows += $this->aEmail->save($con);
				}
				$this->setEmail($this->aEmail);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = InoAvisosSeaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += InoAvisosSeaPeer::doUpdate($this, $con);
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


												
			if ($this->aInoClientesSea !== null) {
				if (!$this->aInoClientesSea->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aInoClientesSea->getValidationFailures());
				}
			}

			if ($this->aInoMaestraSea !== null) {
				if (!$this->aInoMaestraSea->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aInoMaestraSea->getValidationFailures());
				}
			}

			if ($this->aCliente !== null) {
				if (!$this->aCliente->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCliente->getValidationFailures());
				}
			}

			if ($this->aEmail !== null) {
				if (!$this->aEmail->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEmail->getValidationFailures());
				}
			}


			if (($retval = InoAvisosSeaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InoAvisosSeaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaReferencia();
				break;
			case 1:
				return $this->getCaIdcliente();
				break;
			case 2:
				return $this->getCaHbls();
				break;
			case 3:
				return $this->getCaIdemail();
				break;
			case 4:
				return $this->getCaFchaviso();
				break;
			case 5:
				return $this->getCaAviso();
				break;
			case 6:
				return $this->getCaIdbodega();
				break;
			case 7:
				return $this->getCaFchllegada();
				break;
			case 8:
				return $this->getCaFchenvio();
				break;
			case 9:
				return $this->getCaUsuenvio();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = InoAvisosSeaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaReferencia(),
			$keys[1] => $this->getCaIdcliente(),
			$keys[2] => $this->getCaHbls(),
			$keys[3] => $this->getCaIdemail(),
			$keys[4] => $this->getCaFchaviso(),
			$keys[5] => $this->getCaAviso(),
			$keys[6] => $this->getCaIdbodega(),
			$keys[7] => $this->getCaFchllegada(),
			$keys[8] => $this->getCaFchenvio(),
			$keys[9] => $this->getCaUsuenvio(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InoAvisosSeaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaReferencia($value);
				break;
			case 1:
				$this->setCaIdcliente($value);
				break;
			case 2:
				$this->setCaHbls($value);
				break;
			case 3:
				$this->setCaIdemail($value);
				break;
			case 4:
				$this->setCaFchaviso($value);
				break;
			case 5:
				$this->setCaAviso($value);
				break;
			case 6:
				$this->setCaIdbodega($value);
				break;
			case 7:
				$this->setCaFchllegada($value);
				break;
			case 8:
				$this->setCaFchenvio($value);
				break;
			case 9:
				$this->setCaUsuenvio($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InoAvisosSeaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaReferencia($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdcliente($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaHbls($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaIdemail($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaFchaviso($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaAviso($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaIdbodega($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaFchllegada($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaFchenvio($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaUsuenvio($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(InoAvisosSeaPeer::DATABASE_NAME);

		if ($this->isColumnModified(InoAvisosSeaPeer::CA_REFERENCIA)) $criteria->add(InoAvisosSeaPeer::CA_REFERENCIA, $this->ca_referencia);
		if ($this->isColumnModified(InoAvisosSeaPeer::CA_IDCLIENTE)) $criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);
		if ($this->isColumnModified(InoAvisosSeaPeer::CA_HBLS)) $criteria->add(InoAvisosSeaPeer::CA_HBLS, $this->ca_hbls);
		if ($this->isColumnModified(InoAvisosSeaPeer::CA_IDEMAIL)) $criteria->add(InoAvisosSeaPeer::CA_IDEMAIL, $this->ca_idemail);
		if ($this->isColumnModified(InoAvisosSeaPeer::CA_FCHAVISO)) $criteria->add(InoAvisosSeaPeer::CA_FCHAVISO, $this->ca_fchaviso);
		if ($this->isColumnModified(InoAvisosSeaPeer::CA_AVISO)) $criteria->add(InoAvisosSeaPeer::CA_AVISO, $this->ca_aviso);
		if ($this->isColumnModified(InoAvisosSeaPeer::CA_IDBODEGA)) $criteria->add(InoAvisosSeaPeer::CA_IDBODEGA, $this->ca_idbodega);
		if ($this->isColumnModified(InoAvisosSeaPeer::CA_FCHLLEGADA)) $criteria->add(InoAvisosSeaPeer::CA_FCHLLEGADA, $this->ca_fchllegada);
		if ($this->isColumnModified(InoAvisosSeaPeer::CA_FCHENVIO)) $criteria->add(InoAvisosSeaPeer::CA_FCHENVIO, $this->ca_fchenvio);
		if ($this->isColumnModified(InoAvisosSeaPeer::CA_USUENVIO)) $criteria->add(InoAvisosSeaPeer::CA_USUENVIO, $this->ca_usuenvio);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(InoAvisosSeaPeer::DATABASE_NAME);

		$criteria->add(InoAvisosSeaPeer::CA_REFERENCIA, $this->ca_referencia);
		$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);
		$criteria->add(InoAvisosSeaPeer::CA_HBLS, $this->ca_hbls);
		$criteria->add(InoAvisosSeaPeer::CA_IDEMAIL, $this->ca_idemail);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaReferencia();

		$pks[1] = $this->getCaIdcliente();

		$pks[2] = $this->getCaHbls();

		$pks[3] = $this->getCaIdemail();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaReferencia($keys[0]);

		$this->setCaIdcliente($keys[1]);

		$this->setCaHbls($keys[2]);

		$this->setCaIdemail($keys[3]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaReferencia($this->ca_referencia);

		$copyObj->setCaIdcliente($this->ca_idcliente);

		$copyObj->setCaHbls($this->ca_hbls);

		$copyObj->setCaIdemail($this->ca_idemail);

		$copyObj->setCaFchaviso($this->ca_fchaviso);

		$copyObj->setCaAviso($this->ca_aviso);

		$copyObj->setCaIdbodega($this->ca_idbodega);

		$copyObj->setCaFchllegada($this->ca_fchllegada);

		$copyObj->setCaFchenvio($this->ca_fchenvio);

		$copyObj->setCaUsuenvio($this->ca_usuenvio);


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
			self::$peer = new InoAvisosSeaPeer();
		}
		return self::$peer;
	}

	
	public function setInoClientesSea(InoClientesSea $v = null)
	{
		if ($v === null) {
			$this->setCaReferencia(NULL);
		} else {
			$this->setCaReferencia($v->getCaReferencia());
		}

		if ($v === null) {
			$this->setCaIdcliente(NULL);
		} else {
			$this->setCaIdcliente($v->getCaIdcliente());
		}

		if ($v === null) {
			$this->setCaHbls(NULL);
		} else {
			$this->setCaHbls($v->getCaHbls());
		}

		$this->aInoClientesSea = $v;

						if ($v !== null) {
			$v->addInoAvisosSea($this);
		}

		return $this;
	}


	
	public function getInoClientesSea(PropelPDO $con = null)
	{
		if ($this->aInoClientesSea === null && (($this->ca_referencia !== "" && $this->ca_referencia !== null) && $this->ca_idcliente !== null && ($this->ca_hbls !== "" && $this->ca_hbls !== null))) {
			$c = new Criteria(InoClientesSeaPeer::DATABASE_NAME);
			$c->add(InoClientesSeaPeer::CA_REFERENCIA, $this->ca_referencia);
			$c->add(InoClientesSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);
			$c->add(InoClientesSeaPeer::CA_HBLS, $this->ca_hbls);
			$this->aInoClientesSea = InoClientesSeaPeer::doSelectOne($c, $con);
			
		}
		return $this->aInoClientesSea;
	}

	
	public function setInoMaestraSea(InoMaestraSea $v = null)
	{
		if ($v === null) {
			$this->setCaReferencia(NULL);
		} else {
			$this->setCaReferencia($v->getCaReferencia());
		}

		$this->aInoMaestraSea = $v;

						if ($v !== null) {
			$v->addInoAvisosSea($this);
		}

		return $this;
	}


	
	public function getInoMaestraSea(PropelPDO $con = null)
	{
		if ($this->aInoMaestraSea === null && (($this->ca_referencia !== "" && $this->ca_referencia !== null))) {
			$c = new Criteria(InoMaestraSeaPeer::DATABASE_NAME);
			$c->add(InoMaestraSeaPeer::CA_REFERENCIA, $this->ca_referencia);
			$this->aInoMaestraSea = InoMaestraSeaPeer::doSelectOne($c, $con);
			
		}
		return $this->aInoMaestraSea;
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
			$v->addInoAvisosSea($this);
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

	
	public function setEmail(Email $v = null)
	{
		if ($v === null) {
			$this->setCaIdemail(NULL);
		} else {
			$this->setCaIdemail($v->getCaIdemail());
		}

		$this->aEmail = $v;

						if ($v !== null) {
			$v->addInoAvisosSea($this);
		}

		return $this;
	}


	
	public function getEmail(PropelPDO $con = null)
	{
		if ($this->aEmail === null && ($this->ca_idemail !== null)) {
			$c = new Criteria(EmailPeer::DATABASE_NAME);
			$c->add(EmailPeer::CA_IDEMAIL, $this->ca_idemail);
			$this->aEmail = EmailPeer::doSelectOne($c, $con);
			
		}
		return $this->aEmail;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aInoClientesSea = null;
			$this->aInoMaestraSea = null;
			$this->aCliente = null;
			$this->aEmail = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseInoAvisosSea:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseInoAvisosSea::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 