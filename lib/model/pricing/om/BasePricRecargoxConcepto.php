<?php


abstract class BasePricRecargoxConcepto extends BaseObject  implements Persistent {


  const PEER = 'PricRecargoxConceptoPeer';

	
	protected static $peer;

	
	protected $ca_idtrayecto;

	
	protected $ca_idconcepto;

	
	protected $ca_idrecargo;

	
	protected $ca_vlrrecargo;

	
	protected $ca_aplicacion;

	
	protected $ca_vlrminimo;

	
	protected $ca_aplicacion_min;

	
	protected $ca_observaciones;

	
	protected $ca_idmoneda;

	
	protected $ca_fchinicio;

	
	protected $ca_fchvencimiento;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_consecutivo;

	
	protected $aPricFlete;

	
	protected $aTipoRecargo;

	
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

	
	public function getCaIdrecargo()
	{
		return $this->ca_idrecargo;
	}

	
	public function getCaVlrrecargo()
	{
		return $this->ca_vlrrecargo;
	}

	
	public function getCaAplicacion()
	{
		return $this->ca_aplicacion;
	}

	
	public function getCaVlrminimo()
	{
		return $this->ca_vlrminimo;
	}

	
	public function getCaAplicacionMin()
	{
		return $this->ca_aplicacion_min;
	}

	
	public function getCaObservaciones()
	{
		return $this->ca_observaciones;
	}

	
	public function getCaIdmoneda()
	{
		return $this->ca_idmoneda;
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
			$this->modifiedColumns[] = PricRecargoxConceptoPeer::CA_IDTRAYECTO;
		}

		if ($this->aPricFlete !== null && $this->aPricFlete->getCaIdtrayecto() !== $v) {
			$this->aPricFlete = null;
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
			$this->modifiedColumns[] = PricRecargoxConceptoPeer::CA_IDCONCEPTO;
		}

		if ($this->aPricFlete !== null && $this->aPricFlete->getCaIdconcepto() !== $v) {
			$this->aPricFlete = null;
		}

		return $this;
	} 
	
	public function setCaIdrecargo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idrecargo !== $v) {
			$this->ca_idrecargo = $v;
			$this->modifiedColumns[] = PricRecargoxConceptoPeer::CA_IDRECARGO;
		}

		if ($this->aTipoRecargo !== null && $this->aTipoRecargo->getCaIdrecargo() !== $v) {
			$this->aTipoRecargo = null;
		}

		return $this;
	} 
	
	public function setCaVlrrecargo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vlrrecargo !== $v) {
			$this->ca_vlrrecargo = $v;
			$this->modifiedColumns[] = PricRecargoxConceptoPeer::CA_VLRRECARGO;
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
			$this->modifiedColumns[] = PricRecargoxConceptoPeer::CA_APLICACION;
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
			$this->modifiedColumns[] = PricRecargoxConceptoPeer::CA_VLRMINIMO;
		}

		return $this;
	} 
	
	public function setCaAplicacionMin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_aplicacion_min !== $v) {
			$this->ca_aplicacion_min = $v;
			$this->modifiedColumns[] = PricRecargoxConceptoPeer::CA_APLICACION_MIN;
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
			$this->modifiedColumns[] = PricRecargoxConceptoPeer::CA_OBSERVACIONES;
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
			$this->modifiedColumns[] = PricRecargoxConceptoPeer::CA_IDMONEDA;
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
				$this->modifiedColumns[] = PricRecargoxConceptoPeer::CA_FCHINICIO;
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
				$this->modifiedColumns[] = PricRecargoxConceptoPeer::CA_FCHVENCIMIENTO;
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
				$this->modifiedColumns[] = PricRecargoxConceptoPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = PricRecargoxConceptoPeer::CA_USUCREADO;
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
			$this->modifiedColumns[] = PricRecargoxConceptoPeer::CA_CONSECUTIVO;
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
			$this->ca_idrecargo = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->ca_vlrrecargo = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_aplicacion = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_vlrminimo = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_aplicacion_min = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_observaciones = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_idmoneda = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_fchinicio = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_fchvencimiento = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_fchcreado = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_usucreado = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_consecutivo = ($row[$startcol + 13] !== null) ? (int) $row[$startcol + 13] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 14; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PricRecargoxConcepto object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aPricFlete !== null && $this->ca_idtrayecto !== $this->aPricFlete->getCaIdtrayecto()) {
			$this->aPricFlete = null;
		}
		if ($this->aPricFlete !== null && $this->ca_idconcepto !== $this->aPricFlete->getCaIdconcepto()) {
			$this->aPricFlete = null;
		}
		if ($this->aTipoRecargo !== null && $this->ca_idrecargo !== $this->aTipoRecargo->getCaIdrecargo()) {
			$this->aTipoRecargo = null;
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
			$con = Propel::getConnection(PricRecargoxConceptoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = PricRecargoxConceptoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aPricFlete = null;
			$this->aTipoRecargo = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricRecargoxConcepto:delete:pre') as $callable)
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
			$con = Propel::getConnection(PricRecargoxConceptoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			PricRecargoxConceptoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasePricRecargoxConcepto:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricRecargoxConcepto:save:pre') as $callable)
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
			$con = Propel::getConnection(PricRecargoxConceptoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasePricRecargoxConcepto:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			PricRecargoxConceptoPeer::addInstanceToPool($this);
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

												
			if ($this->aPricFlete !== null) {
				if ($this->aPricFlete->isModified() || $this->aPricFlete->isNew()) {
					$affectedRows += $this->aPricFlete->save($con);
				}
				$this->setPricFlete($this->aPricFlete);
			}

			if ($this->aTipoRecargo !== null) {
				if ($this->aTipoRecargo->isModified() || $this->aTipoRecargo->isNew()) {
					$affectedRows += $this->aTipoRecargo->save($con);
				}
				$this->setTipoRecargo($this->aTipoRecargo);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PricRecargoxConceptoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += PricRecargoxConceptoPeer::doUpdate($this, $con);
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


												
			if ($this->aPricFlete !== null) {
				if (!$this->aPricFlete->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPricFlete->getValidationFailures());
				}
			}

			if ($this->aTipoRecargo !== null) {
				if (!$this->aTipoRecargo->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTipoRecargo->getValidationFailures());
				}
			}


			if (($retval = PricRecargoxConceptoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PricRecargoxConceptoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdrecargo();
				break;
			case 3:
				return $this->getCaVlrrecargo();
				break;
			case 4:
				return $this->getCaAplicacion();
				break;
			case 5:
				return $this->getCaVlrminimo();
				break;
			case 6:
				return $this->getCaAplicacionMin();
				break;
			case 7:
				return $this->getCaObservaciones();
				break;
			case 8:
				return $this->getCaIdmoneda();
				break;
			case 9:
				return $this->getCaFchinicio();
				break;
			case 10:
				return $this->getCaFchvencimiento();
				break;
			case 11:
				return $this->getCaFchcreado();
				break;
			case 12:
				return $this->getCaUsucreado();
				break;
			case 13:
				return $this->getCaConsecutivo();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = PricRecargoxConceptoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdtrayecto(),
			$keys[1] => $this->getCaIdconcepto(),
			$keys[2] => $this->getCaIdrecargo(),
			$keys[3] => $this->getCaVlrrecargo(),
			$keys[4] => $this->getCaAplicacion(),
			$keys[5] => $this->getCaVlrminimo(),
			$keys[6] => $this->getCaAplicacionMin(),
			$keys[7] => $this->getCaObservaciones(),
			$keys[8] => $this->getCaIdmoneda(),
			$keys[9] => $this->getCaFchinicio(),
			$keys[10] => $this->getCaFchvencimiento(),
			$keys[11] => $this->getCaFchcreado(),
			$keys[12] => $this->getCaUsucreado(),
			$keys[13] => $this->getCaConsecutivo(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PricRecargoxConceptoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdrecargo($value);
				break;
			case 3:
				$this->setCaVlrrecargo($value);
				break;
			case 4:
				$this->setCaAplicacion($value);
				break;
			case 5:
				$this->setCaVlrminimo($value);
				break;
			case 6:
				$this->setCaAplicacionMin($value);
				break;
			case 7:
				$this->setCaObservaciones($value);
				break;
			case 8:
				$this->setCaIdmoneda($value);
				break;
			case 9:
				$this->setCaFchinicio($value);
				break;
			case 10:
				$this->setCaFchvencimiento($value);
				break;
			case 11:
				$this->setCaFchcreado($value);
				break;
			case 12:
				$this->setCaUsucreado($value);
				break;
			case 13:
				$this->setCaConsecutivo($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PricRecargoxConceptoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdtrayecto($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdconcepto($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdrecargo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaVlrrecargo($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaAplicacion($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaVlrminimo($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaAplicacionMin($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaObservaciones($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaIdmoneda($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaFchinicio($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaFchvencimiento($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaFchcreado($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaUsucreado($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaConsecutivo($arr[$keys[13]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PricRecargoxConceptoPeer::DATABASE_NAME);

		if ($this->isColumnModified(PricRecargoxConceptoPeer::CA_IDTRAYECTO)) $criteria->add(PricRecargoxConceptoPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);
		if ($this->isColumnModified(PricRecargoxConceptoPeer::CA_IDCONCEPTO)) $criteria->add(PricRecargoxConceptoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);
		if ($this->isColumnModified(PricRecargoxConceptoPeer::CA_IDRECARGO)) $criteria->add(PricRecargoxConceptoPeer::CA_IDRECARGO, $this->ca_idrecargo);
		if ($this->isColumnModified(PricRecargoxConceptoPeer::CA_VLRRECARGO)) $criteria->add(PricRecargoxConceptoPeer::CA_VLRRECARGO, $this->ca_vlrrecargo);
		if ($this->isColumnModified(PricRecargoxConceptoPeer::CA_APLICACION)) $criteria->add(PricRecargoxConceptoPeer::CA_APLICACION, $this->ca_aplicacion);
		if ($this->isColumnModified(PricRecargoxConceptoPeer::CA_VLRMINIMO)) $criteria->add(PricRecargoxConceptoPeer::CA_VLRMINIMO, $this->ca_vlrminimo);
		if ($this->isColumnModified(PricRecargoxConceptoPeer::CA_APLICACION_MIN)) $criteria->add(PricRecargoxConceptoPeer::CA_APLICACION_MIN, $this->ca_aplicacion_min);
		if ($this->isColumnModified(PricRecargoxConceptoPeer::CA_OBSERVACIONES)) $criteria->add(PricRecargoxConceptoPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(PricRecargoxConceptoPeer::CA_IDMONEDA)) $criteria->add(PricRecargoxConceptoPeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(PricRecargoxConceptoPeer::CA_FCHINICIO)) $criteria->add(PricRecargoxConceptoPeer::CA_FCHINICIO, $this->ca_fchinicio);
		if ($this->isColumnModified(PricRecargoxConceptoPeer::CA_FCHVENCIMIENTO)) $criteria->add(PricRecargoxConceptoPeer::CA_FCHVENCIMIENTO, $this->ca_fchvencimiento);
		if ($this->isColumnModified(PricRecargoxConceptoPeer::CA_FCHCREADO)) $criteria->add(PricRecargoxConceptoPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(PricRecargoxConceptoPeer::CA_USUCREADO)) $criteria->add(PricRecargoxConceptoPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(PricRecargoxConceptoPeer::CA_CONSECUTIVO)) $criteria->add(PricRecargoxConceptoPeer::CA_CONSECUTIVO, $this->ca_consecutivo);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PricRecargoxConceptoPeer::DATABASE_NAME);

		$criteria->add(PricRecargoxConceptoPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);
		$criteria->add(PricRecargoxConceptoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);
		$criteria->add(PricRecargoxConceptoPeer::CA_IDRECARGO, $this->ca_idrecargo);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaIdtrayecto();

		$pks[1] = $this->getCaIdconcepto();

		$pks[2] = $this->getCaIdrecargo();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaIdtrayecto($keys[0]);

		$this->setCaIdconcepto($keys[1]);

		$this->setCaIdrecargo($keys[2]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdtrayecto($this->ca_idtrayecto);

		$copyObj->setCaIdconcepto($this->ca_idconcepto);

		$copyObj->setCaIdrecargo($this->ca_idrecargo);

		$copyObj->setCaVlrrecargo($this->ca_vlrrecargo);

		$copyObj->setCaAplicacion($this->ca_aplicacion);

		$copyObj->setCaVlrminimo($this->ca_vlrminimo);

		$copyObj->setCaAplicacionMin($this->ca_aplicacion_min);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaIdmoneda($this->ca_idmoneda);

		$copyObj->setCaFchinicio($this->ca_fchinicio);

		$copyObj->setCaFchvencimiento($this->ca_fchvencimiento);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaConsecutivo($this->ca_consecutivo);


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
			self::$peer = new PricRecargoxConceptoPeer();
		}
		return self::$peer;
	}

	
	public function setPricFlete(PricFlete $v = null)
	{
		if ($v === null) {
			$this->setCaIdtrayecto(NULL);
		} else {
			$this->setCaIdtrayecto($v->getCaIdtrayecto());
		}

		if ($v === null) {
			$this->setCaIdconcepto(NULL);
		} else {
			$this->setCaIdconcepto($v->getCaIdconcepto());
		}

		$this->aPricFlete = $v;

						if ($v !== null) {
			$v->addPricRecargoxConcepto($this);
		}

		return $this;
	}


	
	public function getPricFlete(PropelPDO $con = null)
	{
		if ($this->aPricFlete === null && ($this->ca_idtrayecto !== null && $this->ca_idconcepto !== null)) {
			$c = new Criteria(PricFletePeer::DATABASE_NAME);
			$c->add(PricFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);
			$c->add(PricFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);
			$this->aPricFlete = PricFletePeer::doSelectOne($c, $con);
			
		}
		return $this->aPricFlete;
	}

	
	public function setTipoRecargo(TipoRecargo $v = null)
	{
		if ($v === null) {
			$this->setCaIdrecargo(NULL);
		} else {
			$this->setCaIdrecargo($v->getCaIdrecargo());
		}

		$this->aTipoRecargo = $v;

						if ($v !== null) {
			$v->addPricRecargoxConcepto($this);
		}

		return $this;
	}


	
	public function getTipoRecargo(PropelPDO $con = null)
	{
		if ($this->aTipoRecargo === null && ($this->ca_idrecargo !== null)) {
			$c = new Criteria(TipoRecargoPeer::DATABASE_NAME);
			$c->add(TipoRecargoPeer::CA_IDRECARGO, $this->ca_idrecargo);
			$this->aTipoRecargo = TipoRecargoPeer::doSelectOne($c, $con);
			
		}
		return $this->aTipoRecargo;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aPricFlete = null;
			$this->aTipoRecargo = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasePricRecargoxConcepto:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasePricRecargoxConcepto::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 