<?php


abstract class BaseFlete extends BaseObject  implements Persistent {


  const PEER = 'FletePeer';

	
	protected static $peer;

	
	protected $ca_idtrayecto;

	
	protected $ca_idconcepto;

	
	protected $ca_vlrneto;

	
	protected $ca_vlrminimo;

	
	protected $ca_fleteminimo;

	
	protected $ca_fchinicio;

	
	protected $ca_fchvencimiento;

	
	protected $ca_idmoneda;

	
	protected $ca_observaciones;

	
	protected $ca_fchcreado;

	
	protected $ca_sugerida;

	
	protected $ca_mantenimiento;

	
	protected $aTrayecto;

	
	protected $aConcepto;

	
	protected $collRecargoFletes;

	
	private $lastRecargoFleteCriteria = null;

	
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

	
	public function getCaIdtrayecto()
	{
		return $this->ca_idtrayecto;
	}

	
	public function getCaIdconcepto()
	{
		return $this->ca_idconcepto;
	}

	
	public function getCaVlrneto()
	{
		return $this->ca_vlrneto;
	}

	
	public function getCaVlrminimo()
	{
		return $this->ca_vlrminimo;
	}

	
	public function getCaFleteminimo()
	{
		return $this->ca_fleteminimo;
	}

	
	public function getCaFchinicio($format = 'Y-m-d')
	{
		if ($this->ca_fchinicio === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchinicio);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchinicio, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaFchvencimiento($format = 'Y-m-d')
	{
		if ($this->ca_fchvencimiento === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchvencimiento);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchvencimiento, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaIdmoneda()
	{
		return $this->ca_idmoneda;
	}

	
	public function getCaObservaciones()
	{
		return $this->ca_observaciones;
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

	
	public function getCaSugerida()
	{
		return $this->ca_sugerida;
	}

	
	public function getCaMantenimiento()
	{
		return $this->ca_mantenimiento;
	}

	
	public function setCaIdtrayecto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idtrayecto !== $v) {
			$this->ca_idtrayecto = $v;
			$this->modifiedColumns[] = FletePeer::CA_IDTRAYECTO;
		}

		if ($this->aTrayecto !== null && $this->aTrayecto->getCaIdtrayecto() !== $v) {
			$this->aTrayecto = null;
		}

		return $this;
	} 
	
	public function setCaIdconcepto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idconcepto !== $v) {
			$this->ca_idconcepto = $v;
			$this->modifiedColumns[] = FletePeer::CA_IDCONCEPTO;
		}

		if ($this->aConcepto !== null && $this->aConcepto->getCaIdconcepto() !== $v) {
			$this->aConcepto = null;
		}

		return $this;
	} 
	
	public function setCaVlrneto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vlrneto !== $v) {
			$this->ca_vlrneto = $v;
			$this->modifiedColumns[] = FletePeer::CA_VLRNETO;
		}

		return $this;
	} 
	
	public function setCaVlrminimo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vlrminimo !== $v) {
			$this->ca_vlrminimo = $v;
			$this->modifiedColumns[] = FletePeer::CA_VLRMINIMO;
		}

		return $this;
	} 
	
	public function setCaFleteminimo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_fleteminimo !== $v) {
			$this->ca_fleteminimo = $v;
			$this->modifiedColumns[] = FletePeer::CA_FLETEMINIMO;
		}

		return $this;
	} 
	
	public function setCaFchinicio($v)
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

		if ( $this->ca_fchinicio !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchinicio !== null && $tmpDt = new DateTime($this->ca_fchinicio)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchinicio = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = FletePeer::CA_FCHINICIO;
			}
		} 
		return $this;
	} 
	
	public function setCaFchvencimiento($v)
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

		if ( $this->ca_fchvencimiento !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchvencimiento !== null && $tmpDt = new DateTime($this->ca_fchvencimiento)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchvencimiento = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = FletePeer::CA_FCHVENCIMIENTO;
			}
		} 
		return $this;
	} 
	
	public function setCaIdmoneda($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idmoneda !== $v) {
			$this->ca_idmoneda = $v;
			$this->modifiedColumns[] = FletePeer::CA_IDMONEDA;
		}

		return $this;
	} 
	
	public function setCaObservaciones($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_observaciones !== $v) {
			$this->ca_observaciones = $v;
			$this->modifiedColumns[] = FletePeer::CA_OBSERVACIONES;
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
				$this->modifiedColumns[] = FletePeer::CA_FCHCREADO;
			}
		} 
		return $this;
	} 
	
	public function setCaSugerida($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_sugerida !== $v) {
			$this->ca_sugerida = $v;
			$this->modifiedColumns[] = FletePeer::CA_SUGERIDA;
		}

		return $this;
	} 
	
	public function setCaMantenimiento($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_mantenimiento !== $v) {
			$this->ca_mantenimiento = $v;
			$this->modifiedColumns[] = FletePeer::CA_MANTENIMIENTO;
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

			$this->ca_idtrayecto = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idconcepto = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_vlrneto = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_vlrminimo = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_fleteminimo = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_fchinicio = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_fchvencimiento = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_idmoneda = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_observaciones = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_fchcreado = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_sugerida = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_mantenimiento = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Flete object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aTrayecto !== null && $this->ca_idtrayecto !== $this->aTrayecto->getCaIdtrayecto()) {
			$this->aTrayecto = null;
		}
		if ($this->aConcepto !== null && $this->ca_idconcepto !== $this->aConcepto->getCaIdconcepto()) {
			$this->aConcepto = null;
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
			$con = Propel::getConnection(FletePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = FletePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aTrayecto = null;
			$this->aConcepto = null;
			$this->collRecargoFletes = null;
			$this->lastRecargoFleteCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFlete:delete:pre') as $callable)
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
			$con = Propel::getConnection(FletePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			FletePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseFlete:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFlete:save:pre') as $callable)
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
			$con = Propel::getConnection(FletePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseFlete:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			FletePeer::addInstanceToPool($this);
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

												
			if ($this->aTrayecto !== null) {
				if ($this->aTrayecto->isModified() || $this->aTrayecto->isNew()) {
					$affectedRows += $this->aTrayecto->save($con);
				}
				$this->setTrayecto($this->aTrayecto);
			}

			if ($this->aConcepto !== null) {
				if ($this->aConcepto->isModified() || $this->aConcepto->isNew()) {
					$affectedRows += $this->aConcepto->save($con);
				}
				$this->setConcepto($this->aConcepto);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = FletePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += FletePeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collRecargoFletes !== null) {
				foreach ($this->collRecargoFletes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

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


												
			if ($this->aTrayecto !== null) {
				if (!$this->aTrayecto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTrayecto->getValidationFailures());
				}
			}

			if ($this->aConcepto !== null) {
				if (!$this->aConcepto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aConcepto->getValidationFailures());
				}
			}


			if (($retval = FletePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collRecargoFletes !== null) {
					foreach ($this->collRecargoFletes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FletePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdtrayecto();
				break;
			case 1:
				return $this->getCaIdconcepto();
				break;
			case 2:
				return $this->getCaVlrneto();
				break;
			case 3:
				return $this->getCaVlrminimo();
				break;
			case 4:
				return $this->getCaFleteminimo();
				break;
			case 5:
				return $this->getCaFchinicio();
				break;
			case 6:
				return $this->getCaFchvencimiento();
				break;
			case 7:
				return $this->getCaIdmoneda();
				break;
			case 8:
				return $this->getCaObservaciones();
				break;
			case 9:
				return $this->getCaFchcreado();
				break;
			case 10:
				return $this->getCaSugerida();
				break;
			case 11:
				return $this->getCaMantenimiento();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = FletePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdtrayecto(),
			$keys[1] => $this->getCaIdconcepto(),
			$keys[2] => $this->getCaVlrneto(),
			$keys[3] => $this->getCaVlrminimo(),
			$keys[4] => $this->getCaFleteminimo(),
			$keys[5] => $this->getCaFchinicio(),
			$keys[6] => $this->getCaFchvencimiento(),
			$keys[7] => $this->getCaIdmoneda(),
			$keys[8] => $this->getCaObservaciones(),
			$keys[9] => $this->getCaFchcreado(),
			$keys[10] => $this->getCaSugerida(),
			$keys[11] => $this->getCaMantenimiento(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FletePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdtrayecto($value);
				break;
			case 1:
				$this->setCaIdconcepto($value);
				break;
			case 2:
				$this->setCaVlrneto($value);
				break;
			case 3:
				$this->setCaVlrminimo($value);
				break;
			case 4:
				$this->setCaFleteminimo($value);
				break;
			case 5:
				$this->setCaFchinicio($value);
				break;
			case 6:
				$this->setCaFchvencimiento($value);
				break;
			case 7:
				$this->setCaIdmoneda($value);
				break;
			case 8:
				$this->setCaObservaciones($value);
				break;
			case 9:
				$this->setCaFchcreado($value);
				break;
			case 10:
				$this->setCaSugerida($value);
				break;
			case 11:
				$this->setCaMantenimiento($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FletePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdtrayecto($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdconcepto($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaVlrneto($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaVlrminimo($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaFleteminimo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaFchinicio($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaFchvencimiento($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaIdmoneda($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaObservaciones($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaFchcreado($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaSugerida($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaMantenimiento($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(FletePeer::DATABASE_NAME);

		if ($this->isColumnModified(FletePeer::CA_IDTRAYECTO)) $criteria->add(FletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);
		if ($this->isColumnModified(FletePeer::CA_IDCONCEPTO)) $criteria->add(FletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);
		if ($this->isColumnModified(FletePeer::CA_VLRNETO)) $criteria->add(FletePeer::CA_VLRNETO, $this->ca_vlrneto);
		if ($this->isColumnModified(FletePeer::CA_VLRMINIMO)) $criteria->add(FletePeer::CA_VLRMINIMO, $this->ca_vlrminimo);
		if ($this->isColumnModified(FletePeer::CA_FLETEMINIMO)) $criteria->add(FletePeer::CA_FLETEMINIMO, $this->ca_fleteminimo);
		if ($this->isColumnModified(FletePeer::CA_FCHINICIO)) $criteria->add(FletePeer::CA_FCHINICIO, $this->ca_fchinicio);
		if ($this->isColumnModified(FletePeer::CA_FCHVENCIMIENTO)) $criteria->add(FletePeer::CA_FCHVENCIMIENTO, $this->ca_fchvencimiento);
		if ($this->isColumnModified(FletePeer::CA_IDMONEDA)) $criteria->add(FletePeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(FletePeer::CA_OBSERVACIONES)) $criteria->add(FletePeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(FletePeer::CA_FCHCREADO)) $criteria->add(FletePeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(FletePeer::CA_SUGERIDA)) $criteria->add(FletePeer::CA_SUGERIDA, $this->ca_sugerida);
		if ($this->isColumnModified(FletePeer::CA_MANTENIMIENTO)) $criteria->add(FletePeer::CA_MANTENIMIENTO, $this->ca_mantenimiento);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(FletePeer::DATABASE_NAME);

		$criteria->add(FletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);
		$criteria->add(FletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaIdtrayecto();

		$pks[1] = $this->getCaIdconcepto();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaIdtrayecto($keys[0]);

		$this->setCaIdconcepto($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdtrayecto($this->ca_idtrayecto);

		$copyObj->setCaIdconcepto($this->ca_idconcepto);

		$copyObj->setCaVlrneto($this->ca_vlrneto);

		$copyObj->setCaVlrminimo($this->ca_vlrminimo);

		$copyObj->setCaFleteminimo($this->ca_fleteminimo);

		$copyObj->setCaFchinicio($this->ca_fchinicio);

		$copyObj->setCaFchvencimiento($this->ca_fchvencimiento);

		$copyObj->setCaIdmoneda($this->ca_idmoneda);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaSugerida($this->ca_sugerida);

		$copyObj->setCaMantenimiento($this->ca_mantenimiento);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getRecargoFletes() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addRecargoFlete($relObj->copy($deepCopy));
				}
			}

		} 

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
			self::$peer = new FletePeer();
		}
		return self::$peer;
	}

	
	public function setTrayecto(Trayecto $v = null)
	{
		if ($v === null) {
			$this->setCaIdtrayecto(NULL);
		} else {
			$this->setCaIdtrayecto($v->getCaIdtrayecto());
		}

		$this->aTrayecto = $v;

						if ($v !== null) {
			$v->addFlete($this);
		}

		return $this;
	}


	
	public function getTrayecto(PropelPDO $con = null)
	{
		if ($this->aTrayecto === null && ($this->ca_idtrayecto !== null)) {
			$c = new Criteria(TrayectoPeer::DATABASE_NAME);
			$c->add(TrayectoPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);
			$this->aTrayecto = TrayectoPeer::doSelectOne($c, $con);
			
		}
		return $this->aTrayecto;
	}

	
	public function setConcepto(Concepto $v = null)
	{
		if ($v === null) {
			$this->setCaIdconcepto(NULL);
		} else {
			$this->setCaIdconcepto($v->getCaIdconcepto());
		}

		$this->aConcepto = $v;

						if ($v !== null) {
			$v->addFlete($this);
		}

		return $this;
	}


	
	public function getConcepto(PropelPDO $con = null)
	{
		if ($this->aConcepto === null && ($this->ca_idconcepto !== null)) {
			$c = new Criteria(ConceptoPeer::DATABASE_NAME);
			$c->add(ConceptoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);
			$this->aConcepto = ConceptoPeer::doSelectOne($c, $con);
			
		}
		return $this->aConcepto;
	}

	
	public function clearRecargoFletes()
	{
		$this->collRecargoFletes = null; 	}

	
	public function initRecargoFletes()
	{
		$this->collRecargoFletes = array();
	}

	
	public function getRecargoFletes($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(FletePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRecargoFletes === null) {
			if ($this->isNew()) {
			   $this->collRecargoFletes = array();
			} else {

				$criteria->add(RecargoFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				$criteria->add(RecargoFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				RecargoFletePeer::addSelectColumns($criteria);
				$this->collRecargoFletes = RecargoFletePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RecargoFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);


				$criteria->add(RecargoFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				RecargoFletePeer::addSelectColumns($criteria);
				if (!isset($this->lastRecargoFleteCriteria) || !$this->lastRecargoFleteCriteria->equals($criteria)) {
					$this->collRecargoFletes = RecargoFletePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRecargoFleteCriteria = $criteria;
		return $this->collRecargoFletes;
	}

	
	public function countRecargoFletes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(FletePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRecargoFletes === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RecargoFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				$criteria->add(RecargoFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$count = RecargoFletePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RecargoFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);


				$criteria->add(RecargoFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				if (!isset($this->lastRecargoFleteCriteria) || !$this->lastRecargoFleteCriteria->equals($criteria)) {
					$count = RecargoFletePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRecargoFletes);
				}
			} else {
				$count = count($this->collRecargoFletes);
			}
		}
		return $count;
	}

	
	public function addRecargoFlete(RecargoFlete $l)
	{
		if ($this->collRecargoFletes === null) {
			$this->initRecargoFletes();
		}
		if (!in_array($l, $this->collRecargoFletes, true)) { 			array_push($this->collRecargoFletes, $l);
			$l->setFlete($this);
		}
	}


	
	public function getRecargoFletesJoinTipoRecargo($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(FletePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRecargoFletes === null) {
			if ($this->isNew()) {
				$this->collRecargoFletes = array();
			} else {

				$criteria->add(RecargoFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				$criteria->add(RecargoFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$this->collRecargoFletes = RecargoFletePeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(RecargoFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

			$criteria->add(RecargoFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

			if (!isset($this->lastRecargoFleteCriteria) || !$this->lastRecargoFleteCriteria->equals($criteria)) {
				$this->collRecargoFletes = RecargoFletePeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		}
		$this->lastRecargoFleteCriteria = $criteria;

		return $this->collRecargoFletes;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collRecargoFletes) {
				foreach ((array) $this->collRecargoFletes as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collRecargoFletes = null;
			$this->aTrayecto = null;
			$this->aConcepto = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseFlete:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseFlete::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 