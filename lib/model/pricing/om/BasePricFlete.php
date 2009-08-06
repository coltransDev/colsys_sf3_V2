<?php


abstract class BasePricFlete extends BaseObject  implements Persistent {


  const PEER = 'PricFletePeer';

	
	protected static $peer;

	
	protected $ca_idtrayecto;

	
	protected $ca_idconcepto;

	
	protected $ca_vlrneto;

	
	protected $ca_vlrsugerido;

	
	protected $ca_fchinicio;

	
	protected $ca_fchvencimiento;

	
	protected $ca_idmoneda;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_estado;

	
	protected $ca_aplicacion;

	
	protected $ca_consecutivo;

	
	protected $aTrayecto;

	
	protected $aConcepto;

	
	protected $collPricRecargoxConceptos;

	
	private $lastPricRecargoxConceptoCriteria = null;

	
	protected $collPricRecargoxConceptoLogs;

	
	private $lastPricRecargoxConceptoLogCriteria = null;

	
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

	
	public function getCaVlrsugerido()
	{
		return $this->ca_vlrsugerido;
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

	
	public function getCaEstado()
	{
		return $this->ca_estado;
	}

	
	public function getCaAplicacion()
	{
		return $this->ca_aplicacion;
	}

	
	public function getCaConsecutivo()
	{
		return $this->ca_consecutivo;
	}

	
	public function setCaIdtrayecto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idtrayecto !== $v) {
			$this->ca_idtrayecto = $v;
			$this->modifiedColumns[] = PricFletePeer::CA_IDTRAYECTO;
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
			$this->modifiedColumns[] = PricFletePeer::CA_IDCONCEPTO;
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
			$this->modifiedColumns[] = PricFletePeer::CA_VLRNETO;
		}

		return $this;
	} 
	
	public function setCaVlrsugerido($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vlrsugerido !== $v) {
			$this->ca_vlrsugerido = $v;
			$this->modifiedColumns[] = PricFletePeer::CA_VLRSUGERIDO;
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
				$this->modifiedColumns[] = PricFletePeer::CA_FCHINICIO;
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
				$this->modifiedColumns[] = PricFletePeer::CA_FCHVENCIMIENTO;
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
			$this->modifiedColumns[] = PricFletePeer::CA_IDMONEDA;
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
				$this->modifiedColumns[] = PricFletePeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = PricFletePeer::CA_USUCREADO;
		}

		return $this;
	} 
	
	public function setCaEstado($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_estado !== $v) {
			$this->ca_estado = $v;
			$this->modifiedColumns[] = PricFletePeer::CA_ESTADO;
		}

		return $this;
	} 
	
	public function setCaAplicacion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_aplicacion !== $v) {
			$this->ca_aplicacion = $v;
			$this->modifiedColumns[] = PricFletePeer::CA_APLICACION;
		}

		return $this;
	} 
	
	public function setCaConsecutivo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_consecutivo !== $v) {
			$this->ca_consecutivo = $v;
			$this->modifiedColumns[] = PricFletePeer::CA_CONSECUTIVO;
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
			$this->ca_vlrsugerido = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_fchinicio = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_fchvencimiento = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_idmoneda = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_fchcreado = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_usucreado = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_estado = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->ca_aplicacion = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_consecutivo = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 12; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PricFlete object", $e);
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
			$con = Propel::getConnection(PricFletePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = PricFletePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aTrayecto = null;
			$this->aConcepto = null;
			$this->collPricRecargoxConceptos = null;
			$this->lastPricRecargoxConceptoCriteria = null;

			$this->collPricRecargoxConceptoLogs = null;
			$this->lastPricRecargoxConceptoLogCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricFlete:delete:pre') as $callable)
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
			$con = Propel::getConnection(PricFletePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			PricFletePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasePricFlete:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricFlete:save:pre') as $callable)
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
			$con = Propel::getConnection(PricFletePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasePricFlete:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			PricFletePeer::addInstanceToPool($this);
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
					$pk = PricFletePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += PricFletePeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collPricRecargoxConceptos !== null) {
				foreach ($this->collPricRecargoxConceptos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPricRecargoxConceptoLogs !== null) {
				foreach ($this->collPricRecargoxConceptoLogs as $referrerFK) {
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


			if (($retval = PricFletePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPricRecargoxConceptos !== null) {
					foreach ($this->collPricRecargoxConceptos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPricRecargoxConceptoLogs !== null) {
					foreach ($this->collPricRecargoxConceptoLogs as $referrerFK) {
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
		$pos = PricFletePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaVlrsugerido();
				break;
			case 4:
				return $this->getCaFchinicio();
				break;
			case 5:
				return $this->getCaFchvencimiento();
				break;
			case 6:
				return $this->getCaIdmoneda();
				break;
			case 7:
				return $this->getCaFchcreado();
				break;
			case 8:
				return $this->getCaUsucreado();
				break;
			case 9:
				return $this->getCaEstado();
				break;
			case 10:
				return $this->getCaAplicacion();
				break;
			case 11:
				return $this->getCaConsecutivo();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = PricFletePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdtrayecto(),
			$keys[1] => $this->getCaIdconcepto(),
			$keys[2] => $this->getCaVlrneto(),
			$keys[3] => $this->getCaVlrsugerido(),
			$keys[4] => $this->getCaFchinicio(),
			$keys[5] => $this->getCaFchvencimiento(),
			$keys[6] => $this->getCaIdmoneda(),
			$keys[7] => $this->getCaFchcreado(),
			$keys[8] => $this->getCaUsucreado(),
			$keys[9] => $this->getCaEstado(),
			$keys[10] => $this->getCaAplicacion(),
			$keys[11] => $this->getCaConsecutivo(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PricFletePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaVlrsugerido($value);
				break;
			case 4:
				$this->setCaFchinicio($value);
				break;
			case 5:
				$this->setCaFchvencimiento($value);
				break;
			case 6:
				$this->setCaIdmoneda($value);
				break;
			case 7:
				$this->setCaFchcreado($value);
				break;
			case 8:
				$this->setCaUsucreado($value);
				break;
			case 9:
				$this->setCaEstado($value);
				break;
			case 10:
				$this->setCaAplicacion($value);
				break;
			case 11:
				$this->setCaConsecutivo($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PricFletePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdtrayecto($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdconcepto($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaVlrneto($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaVlrsugerido($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaFchinicio($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaFchvencimiento($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaIdmoneda($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaFchcreado($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaUsucreado($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaEstado($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaAplicacion($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaConsecutivo($arr[$keys[11]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PricFletePeer::DATABASE_NAME);

		if ($this->isColumnModified(PricFletePeer::CA_IDTRAYECTO)) $criteria->add(PricFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);
		if ($this->isColumnModified(PricFletePeer::CA_IDCONCEPTO)) $criteria->add(PricFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);
		if ($this->isColumnModified(PricFletePeer::CA_VLRNETO)) $criteria->add(PricFletePeer::CA_VLRNETO, $this->ca_vlrneto);
		if ($this->isColumnModified(PricFletePeer::CA_VLRSUGERIDO)) $criteria->add(PricFletePeer::CA_VLRSUGERIDO, $this->ca_vlrsugerido);
		if ($this->isColumnModified(PricFletePeer::CA_FCHINICIO)) $criteria->add(PricFletePeer::CA_FCHINICIO, $this->ca_fchinicio);
		if ($this->isColumnModified(PricFletePeer::CA_FCHVENCIMIENTO)) $criteria->add(PricFletePeer::CA_FCHVENCIMIENTO, $this->ca_fchvencimiento);
		if ($this->isColumnModified(PricFletePeer::CA_IDMONEDA)) $criteria->add(PricFletePeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(PricFletePeer::CA_FCHCREADO)) $criteria->add(PricFletePeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(PricFletePeer::CA_USUCREADO)) $criteria->add(PricFletePeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(PricFletePeer::CA_ESTADO)) $criteria->add(PricFletePeer::CA_ESTADO, $this->ca_estado);
		if ($this->isColumnModified(PricFletePeer::CA_APLICACION)) $criteria->add(PricFletePeer::CA_APLICACION, $this->ca_aplicacion);
		if ($this->isColumnModified(PricFletePeer::CA_CONSECUTIVO)) $criteria->add(PricFletePeer::CA_CONSECUTIVO, $this->ca_consecutivo);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PricFletePeer::DATABASE_NAME);

		$criteria->add(PricFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);
		$criteria->add(PricFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);

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

		$copyObj->setCaVlrsugerido($this->ca_vlrsugerido);

		$copyObj->setCaFchinicio($this->ca_fchinicio);

		$copyObj->setCaFchvencimiento($this->ca_fchvencimiento);

		$copyObj->setCaIdmoneda($this->ca_idmoneda);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaEstado($this->ca_estado);

		$copyObj->setCaAplicacion($this->ca_aplicacion);

		$copyObj->setCaConsecutivo($this->ca_consecutivo);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getPricRecargoxConceptos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addPricRecargoxConcepto($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPricRecargoxConceptoLogs() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addPricRecargoxConceptoLog($relObj->copy($deepCopy));
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
			self::$peer = new PricFletePeer();
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
			$v->addPricFlete($this);
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
			$v->addPricFlete($this);
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

	
	public function clearPricRecargoxConceptos()
	{
		$this->collPricRecargoxConceptos = null; 	}

	
	public function initPricRecargoxConceptos()
	{
		$this->collPricRecargoxConceptos = array();
	}

	
	public function getPricRecargoxConceptos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(PricFletePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargoxConceptos === null) {
			if ($this->isNew()) {
			   $this->collPricRecargoxConceptos = array();
			} else {

				$criteria->add(PricRecargoxConceptoPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				$criteria->add(PricRecargoxConceptoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				PricRecargoxConceptoPeer::addSelectColumns($criteria);
				$this->collPricRecargoxConceptos = PricRecargoxConceptoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargoxConceptoPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);


				$criteria->add(PricRecargoxConceptoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				PricRecargoxConceptoPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricRecargoxConceptoCriteria) || !$this->lastPricRecargoxConceptoCriteria->equals($criteria)) {
					$this->collPricRecargoxConceptos = PricRecargoxConceptoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricRecargoxConceptoCriteria = $criteria;
		return $this->collPricRecargoxConceptos;
	}

	
	public function countPricRecargoxConceptos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(PricFletePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricRecargoxConceptos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricRecargoxConceptoPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				$criteria->add(PricRecargoxConceptoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$count = PricRecargoxConceptoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargoxConceptoPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);


				$criteria->add(PricRecargoxConceptoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				if (!isset($this->lastPricRecargoxConceptoCriteria) || !$this->lastPricRecargoxConceptoCriteria->equals($criteria)) {
					$count = PricRecargoxConceptoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricRecargoxConceptos);
				}
			} else {
				$count = count($this->collPricRecargoxConceptos);
			}
		}
		return $count;
	}

	
	public function addPricRecargoxConcepto(PricRecargoxConcepto $l)
	{
		if ($this->collPricRecargoxConceptos === null) {
			$this->initPricRecargoxConceptos();
		}
		if (!in_array($l, $this->collPricRecargoxConceptos, true)) { 			array_push($this->collPricRecargoxConceptos, $l);
			$l->setPricFlete($this);
		}
	}


	
	public function getPricRecargoxConceptosJoinTipoRecargo($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(PricFletePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargoxConceptos === null) {
			if ($this->isNew()) {
				$this->collPricRecargoxConceptos = array();
			} else {

				$criteria->add(PricRecargoxConceptoPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				$criteria->add(PricRecargoxConceptoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$this->collPricRecargoxConceptos = PricRecargoxConceptoPeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(PricRecargoxConceptoPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

			$criteria->add(PricRecargoxConceptoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

			if (!isset($this->lastPricRecargoxConceptoCriteria) || !$this->lastPricRecargoxConceptoCriteria->equals($criteria)) {
				$this->collPricRecargoxConceptos = PricRecargoxConceptoPeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricRecargoxConceptoCriteria = $criteria;

		return $this->collPricRecargoxConceptos;
	}

	
	public function clearPricRecargoxConceptoLogs()
	{
		$this->collPricRecargoxConceptoLogs = null; 	}

	
	public function initPricRecargoxConceptoLogs()
	{
		$this->collPricRecargoxConceptoLogs = array();
	}

	
	public function getPricRecargoxConceptoLogs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(PricFletePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargoxConceptoLogs === null) {
			if ($this->isNew()) {
			   $this->collPricRecargoxConceptoLogs = array();
			} else {

				$criteria->add(PricRecargoxConceptoLogPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				$criteria->add(PricRecargoxConceptoLogPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				PricRecargoxConceptoLogPeer::addSelectColumns($criteria);
				$this->collPricRecargoxConceptoLogs = PricRecargoxConceptoLogPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargoxConceptoLogPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);


				$criteria->add(PricRecargoxConceptoLogPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				PricRecargoxConceptoLogPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricRecargoxConceptoLogCriteria) || !$this->lastPricRecargoxConceptoLogCriteria->equals($criteria)) {
					$this->collPricRecargoxConceptoLogs = PricRecargoxConceptoLogPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricRecargoxConceptoLogCriteria = $criteria;
		return $this->collPricRecargoxConceptoLogs;
	}

	
	public function countPricRecargoxConceptoLogs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(PricFletePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricRecargoxConceptoLogs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricRecargoxConceptoLogPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				$criteria->add(PricRecargoxConceptoLogPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$count = PricRecargoxConceptoLogPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargoxConceptoLogPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);


				$criteria->add(PricRecargoxConceptoLogPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				if (!isset($this->lastPricRecargoxConceptoLogCriteria) || !$this->lastPricRecargoxConceptoLogCriteria->equals($criteria)) {
					$count = PricRecargoxConceptoLogPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricRecargoxConceptoLogs);
				}
			} else {
				$count = count($this->collPricRecargoxConceptoLogs);
			}
		}
		return $count;
	}

	
	public function addPricRecargoxConceptoLog(PricRecargoxConceptoLog $l)
	{
		if ($this->collPricRecargoxConceptoLogs === null) {
			$this->initPricRecargoxConceptoLogs();
		}
		if (!in_array($l, $this->collPricRecargoxConceptoLogs, true)) { 			array_push($this->collPricRecargoxConceptoLogs, $l);
			$l->setPricFlete($this);
		}
	}


	
	public function getPricRecargoxConceptoLogsJoinTipoRecargo($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(PricFletePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargoxConceptoLogs === null) {
			if ($this->isNew()) {
				$this->collPricRecargoxConceptoLogs = array();
			} else {

				$criteria->add(PricRecargoxConceptoLogPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				$criteria->add(PricRecargoxConceptoLogPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

				$this->collPricRecargoxConceptoLogs = PricRecargoxConceptoLogPeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(PricRecargoxConceptoLogPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

			$criteria->add(PricRecargoxConceptoLogPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

			if (!isset($this->lastPricRecargoxConceptoLogCriteria) || !$this->lastPricRecargoxConceptoLogCriteria->equals($criteria)) {
				$this->collPricRecargoxConceptoLogs = PricRecargoxConceptoLogPeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricRecargoxConceptoLogCriteria = $criteria;

		return $this->collPricRecargoxConceptoLogs;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collPricRecargoxConceptos) {
				foreach ((array) $this->collPricRecargoxConceptos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPricRecargoxConceptoLogs) {
				foreach ((array) $this->collPricRecargoxConceptoLogs as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collPricRecargoxConceptos = null;
		$this->collPricRecargoxConceptoLogs = null;
			$this->aTrayecto = null;
			$this->aConcepto = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasePricFlete:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasePricFlete::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 