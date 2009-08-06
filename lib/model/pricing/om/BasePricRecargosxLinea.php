<?php


abstract class BasePricRecargosxLinea extends BaseObject  implements Persistent {


  const PEER = 'PricRecargosxLineaPeer';

	
	protected static $peer;

	
	protected $ca_idtrafico;

	
	protected $ca_idlinea;

	
	protected $ca_idrecargo;

	
	protected $ca_idconcepto;

	
	protected $ca_modalidad;

	
	protected $ca_impoexpo;

	
	protected $ca_vlrrecargo;

	
	protected $ca_aplicacion;

	
	protected $ca_vlrminimo;

	
	protected $ca_aplicacion_min;

	
	protected $ca_observaciones;

	
	protected $ca_fchinicio;

	
	protected $ca_fchvencimiento;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_idmoneda;

	
	protected $ca_consecutivo;

	
	protected $aTransportador;

	
	protected $aTipoRecargo;

	
	protected $aConcepto;

	
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

	
	public function getCaIdtrafico()
	{
		return $this->ca_idtrafico;
	}

	
	public function getCaIdlinea()
	{
		return $this->ca_idlinea;
	}

	
	public function getCaIdrecargo()
	{
		return $this->ca_idrecargo;
	}

	
	public function getCaIdconcepto()
	{
		return $this->ca_idconcepto;
	}

	
	public function getCaModalidad()
	{
		return $this->ca_modalidad;
	}

	
	public function getCaImpoexpo()
	{
		return $this->ca_impoexpo;
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

	
	public function getCaIdmoneda()
	{
		return $this->ca_idmoneda;
	}

	
	public function getCaConsecutivo()
	{
		return $this->ca_consecutivo;
	}

	
	public function setCaIdtrafico($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idtrafico !== $v) {
			$this->ca_idtrafico = $v;
			$this->modifiedColumns[] = PricRecargosxLineaPeer::CA_IDTRAFICO;
		}

		return $this;
	} 
	
	public function setCaIdlinea($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idlinea !== $v) {
			$this->ca_idlinea = $v;
			$this->modifiedColumns[] = PricRecargosxLineaPeer::CA_IDLINEA;
		}

		if ($this->aTransportador !== null && $this->aTransportador->getCaIdlinea() !== $v) {
			$this->aTransportador = null;
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
			$this->modifiedColumns[] = PricRecargosxLineaPeer::CA_IDRECARGO;
		}

		if ($this->aTipoRecargo !== null && $this->aTipoRecargo->getCaIdrecargo() !== $v) {
			$this->aTipoRecargo = null;
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
			$this->modifiedColumns[] = PricRecargosxLineaPeer::CA_IDCONCEPTO;
		}

		if ($this->aConcepto !== null && $this->aConcepto->getCaIdconcepto() !== $v) {
			$this->aConcepto = null;
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
			$this->modifiedColumns[] = PricRecargosxLineaPeer::CA_MODALIDAD;
		}

		return $this;
	} 
	
	public function setCaImpoexpo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_impoexpo !== $v) {
			$this->ca_impoexpo = $v;
			$this->modifiedColumns[] = PricRecargosxLineaPeer::CA_IMPOEXPO;
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
			$this->modifiedColumns[] = PricRecargosxLineaPeer::CA_VLRRECARGO;
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
			$this->modifiedColumns[] = PricRecargosxLineaPeer::CA_APLICACION;
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
			$this->modifiedColumns[] = PricRecargosxLineaPeer::CA_VLRMINIMO;
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
			$this->modifiedColumns[] = PricRecargosxLineaPeer::CA_APLICACION_MIN;
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
			$this->modifiedColumns[] = PricRecargosxLineaPeer::CA_OBSERVACIONES;
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
				$this->modifiedColumns[] = PricRecargosxLineaPeer::CA_FCHINICIO;
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
				$this->modifiedColumns[] = PricRecargosxLineaPeer::CA_FCHVENCIMIENTO;
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
				$this->modifiedColumns[] = PricRecargosxLineaPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = PricRecargosxLineaPeer::CA_USUCREADO;
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
			$this->modifiedColumns[] = PricRecargosxLineaPeer::CA_IDMONEDA;
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
			$this->modifiedColumns[] = PricRecargosxLineaPeer::CA_CONSECUTIVO;
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

			$this->ca_idtrafico = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_idlinea = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_idrecargo = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->ca_idconcepto = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->ca_modalidad = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_impoexpo = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_vlrrecargo = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_aplicacion = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_vlrminimo = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_aplicacion_min = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_observaciones = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_fchinicio = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_fchvencimiento = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_fchcreado = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_usucreado = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_idmoneda = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_consecutivo = ($row[$startcol + 16] !== null) ? (int) $row[$startcol + 16] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 17; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PricRecargosxLinea object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aTransportador !== null && $this->ca_idlinea !== $this->aTransportador->getCaIdlinea()) {
			$this->aTransportador = null;
		}
		if ($this->aTipoRecargo !== null && $this->ca_idrecargo !== $this->aTipoRecargo->getCaIdrecargo()) {
			$this->aTipoRecargo = null;
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
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = PricRecargosxLineaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aTransportador = null;
			$this->aTipoRecargo = null;
			$this->aConcepto = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricRecargosxLinea:delete:pre') as $callable)
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
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			PricRecargosxLineaPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasePricRecargosxLinea:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricRecargosxLinea:save:pre') as $callable)
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
			$con = Propel::getConnection(PricRecargosxLineaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasePricRecargosxLinea:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			PricRecargosxLineaPeer::addInstanceToPool($this);
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

												
			if ($this->aTransportador !== null) {
				if ($this->aTransportador->isModified() || $this->aTransportador->isNew()) {
					$affectedRows += $this->aTransportador->save($con);
				}
				$this->setTransportador($this->aTransportador);
			}

			if ($this->aTipoRecargo !== null) {
				if ($this->aTipoRecargo->isModified() || $this->aTipoRecargo->isNew()) {
					$affectedRows += $this->aTipoRecargo->save($con);
				}
				$this->setTipoRecargo($this->aTipoRecargo);
			}

			if ($this->aConcepto !== null) {
				if ($this->aConcepto->isModified() || $this->aConcepto->isNew()) {
					$affectedRows += $this->aConcepto->save($con);
				}
				$this->setConcepto($this->aConcepto);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PricRecargosxLineaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += PricRecargosxLineaPeer::doUpdate($this, $con);
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


												
			if ($this->aTransportador !== null) {
				if (!$this->aTransportador->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTransportador->getValidationFailures());
				}
			}

			if ($this->aTipoRecargo !== null) {
				if (!$this->aTipoRecargo->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTipoRecargo->getValidationFailures());
				}
			}

			if ($this->aConcepto !== null) {
				if (!$this->aConcepto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aConcepto->getValidationFailures());
				}
			}


			if (($retval = PricRecargosxLineaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PricRecargosxLineaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdtrafico();
				break;
			case 1:
				return $this->getCaIdlinea();
				break;
			case 2:
				return $this->getCaIdrecargo();
				break;
			case 3:
				return $this->getCaIdconcepto();
				break;
			case 4:
				return $this->getCaModalidad();
				break;
			case 5:
				return $this->getCaImpoexpo();
				break;
			case 6:
				return $this->getCaVlrrecargo();
				break;
			case 7:
				return $this->getCaAplicacion();
				break;
			case 8:
				return $this->getCaVlrminimo();
				break;
			case 9:
				return $this->getCaAplicacionMin();
				break;
			case 10:
				return $this->getCaObservaciones();
				break;
			case 11:
				return $this->getCaFchinicio();
				break;
			case 12:
				return $this->getCaFchvencimiento();
				break;
			case 13:
				return $this->getCaFchcreado();
				break;
			case 14:
				return $this->getCaUsucreado();
				break;
			case 15:
				return $this->getCaIdmoneda();
				break;
			case 16:
				return $this->getCaConsecutivo();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = PricRecargosxLineaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdtrafico(),
			$keys[1] => $this->getCaIdlinea(),
			$keys[2] => $this->getCaIdrecargo(),
			$keys[3] => $this->getCaIdconcepto(),
			$keys[4] => $this->getCaModalidad(),
			$keys[5] => $this->getCaImpoexpo(),
			$keys[6] => $this->getCaVlrrecargo(),
			$keys[7] => $this->getCaAplicacion(),
			$keys[8] => $this->getCaVlrminimo(),
			$keys[9] => $this->getCaAplicacionMin(),
			$keys[10] => $this->getCaObservaciones(),
			$keys[11] => $this->getCaFchinicio(),
			$keys[12] => $this->getCaFchvencimiento(),
			$keys[13] => $this->getCaFchcreado(),
			$keys[14] => $this->getCaUsucreado(),
			$keys[15] => $this->getCaIdmoneda(),
			$keys[16] => $this->getCaConsecutivo(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PricRecargosxLineaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdtrafico($value);
				break;
			case 1:
				$this->setCaIdlinea($value);
				break;
			case 2:
				$this->setCaIdrecargo($value);
				break;
			case 3:
				$this->setCaIdconcepto($value);
				break;
			case 4:
				$this->setCaModalidad($value);
				break;
			case 5:
				$this->setCaImpoexpo($value);
				break;
			case 6:
				$this->setCaVlrrecargo($value);
				break;
			case 7:
				$this->setCaAplicacion($value);
				break;
			case 8:
				$this->setCaVlrminimo($value);
				break;
			case 9:
				$this->setCaAplicacionMin($value);
				break;
			case 10:
				$this->setCaObservaciones($value);
				break;
			case 11:
				$this->setCaFchinicio($value);
				break;
			case 12:
				$this->setCaFchvencimiento($value);
				break;
			case 13:
				$this->setCaFchcreado($value);
				break;
			case 14:
				$this->setCaUsucreado($value);
				break;
			case 15:
				$this->setCaIdmoneda($value);
				break;
			case 16:
				$this->setCaConsecutivo($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PricRecargosxLineaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdtrafico($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdlinea($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdrecargo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaIdconcepto($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaModalidad($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaImpoexpo($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaVlrrecargo($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaAplicacion($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaVlrminimo($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaAplicacionMin($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaObservaciones($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaFchinicio($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaFchvencimiento($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaFchcreado($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaUsucreado($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaIdmoneda($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaConsecutivo($arr[$keys[16]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PricRecargosxLineaPeer::DATABASE_NAME);

		if ($this->isColumnModified(PricRecargosxLineaPeer::CA_IDTRAFICO)) $criteria->add(PricRecargosxLineaPeer::CA_IDTRAFICO, $this->ca_idtrafico);
		if ($this->isColumnModified(PricRecargosxLineaPeer::CA_IDLINEA)) $criteria->add(PricRecargosxLineaPeer::CA_IDLINEA, $this->ca_idlinea);
		if ($this->isColumnModified(PricRecargosxLineaPeer::CA_IDRECARGO)) $criteria->add(PricRecargosxLineaPeer::CA_IDRECARGO, $this->ca_idrecargo);
		if ($this->isColumnModified(PricRecargosxLineaPeer::CA_IDCONCEPTO)) $criteria->add(PricRecargosxLineaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);
		if ($this->isColumnModified(PricRecargosxLineaPeer::CA_MODALIDAD)) $criteria->add(PricRecargosxLineaPeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(PricRecargosxLineaPeer::CA_IMPOEXPO)) $criteria->add(PricRecargosxLineaPeer::CA_IMPOEXPO, $this->ca_impoexpo);
		if ($this->isColumnModified(PricRecargosxLineaPeer::CA_VLRRECARGO)) $criteria->add(PricRecargosxLineaPeer::CA_VLRRECARGO, $this->ca_vlrrecargo);
		if ($this->isColumnModified(PricRecargosxLineaPeer::CA_APLICACION)) $criteria->add(PricRecargosxLineaPeer::CA_APLICACION, $this->ca_aplicacion);
		if ($this->isColumnModified(PricRecargosxLineaPeer::CA_VLRMINIMO)) $criteria->add(PricRecargosxLineaPeer::CA_VLRMINIMO, $this->ca_vlrminimo);
		if ($this->isColumnModified(PricRecargosxLineaPeer::CA_APLICACION_MIN)) $criteria->add(PricRecargosxLineaPeer::CA_APLICACION_MIN, $this->ca_aplicacion_min);
		if ($this->isColumnModified(PricRecargosxLineaPeer::CA_OBSERVACIONES)) $criteria->add(PricRecargosxLineaPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(PricRecargosxLineaPeer::CA_FCHINICIO)) $criteria->add(PricRecargosxLineaPeer::CA_FCHINICIO, $this->ca_fchinicio);
		if ($this->isColumnModified(PricRecargosxLineaPeer::CA_FCHVENCIMIENTO)) $criteria->add(PricRecargosxLineaPeer::CA_FCHVENCIMIENTO, $this->ca_fchvencimiento);
		if ($this->isColumnModified(PricRecargosxLineaPeer::CA_FCHCREADO)) $criteria->add(PricRecargosxLineaPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(PricRecargosxLineaPeer::CA_USUCREADO)) $criteria->add(PricRecargosxLineaPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(PricRecargosxLineaPeer::CA_IDMONEDA)) $criteria->add(PricRecargosxLineaPeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(PricRecargosxLineaPeer::CA_CONSECUTIVO)) $criteria->add(PricRecargosxLineaPeer::CA_CONSECUTIVO, $this->ca_consecutivo);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PricRecargosxLineaPeer::DATABASE_NAME);

		$criteria->add(PricRecargosxLineaPeer::CA_IDTRAFICO, $this->ca_idtrafico);
		$criteria->add(PricRecargosxLineaPeer::CA_IDLINEA, $this->ca_idlinea);
		$criteria->add(PricRecargosxLineaPeer::CA_IDRECARGO, $this->ca_idrecargo);
		$criteria->add(PricRecargosxLineaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);
		$criteria->add(PricRecargosxLineaPeer::CA_MODALIDAD, $this->ca_modalidad);
		$criteria->add(PricRecargosxLineaPeer::CA_IMPOEXPO, $this->ca_impoexpo);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaIdtrafico();

		$pks[1] = $this->getCaIdlinea();

		$pks[2] = $this->getCaIdrecargo();

		$pks[3] = $this->getCaIdconcepto();

		$pks[4] = $this->getCaModalidad();

		$pks[5] = $this->getCaImpoexpo();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaIdtrafico($keys[0]);

		$this->setCaIdlinea($keys[1]);

		$this->setCaIdrecargo($keys[2]);

		$this->setCaIdconcepto($keys[3]);

		$this->setCaModalidad($keys[4]);

		$this->setCaImpoexpo($keys[5]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdtrafico($this->ca_idtrafico);

		$copyObj->setCaIdlinea($this->ca_idlinea);

		$copyObj->setCaIdrecargo($this->ca_idrecargo);

		$copyObj->setCaIdconcepto($this->ca_idconcepto);

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaImpoexpo($this->ca_impoexpo);

		$copyObj->setCaVlrrecargo($this->ca_vlrrecargo);

		$copyObj->setCaAplicacion($this->ca_aplicacion);

		$copyObj->setCaVlrminimo($this->ca_vlrminimo);

		$copyObj->setCaAplicacionMin($this->ca_aplicacion_min);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchinicio($this->ca_fchinicio);

		$copyObj->setCaFchvencimiento($this->ca_fchvencimiento);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaIdmoneda($this->ca_idmoneda);

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
			self::$peer = new PricRecargosxLineaPeer();
		}
		return self::$peer;
	}

	
	public function setTransportador(Transportador $v = null)
	{
		if ($v === null) {
			$this->setCaIdlinea(NULL);
		} else {
			$this->setCaIdlinea($v->getCaIdlinea());
		}

		$this->aTransportador = $v;

						if ($v !== null) {
			$v->addPricRecargosxLinea($this);
		}

		return $this;
	}


	
	public function getTransportador(PropelPDO $con = null)
	{
		if ($this->aTransportador === null && (($this->ca_idlinea !== "" && $this->ca_idlinea !== null))) {
			$c = new Criteria(TransportadorPeer::DATABASE_NAME);
			$c->add(TransportadorPeer::CA_IDLINEA, $this->ca_idlinea);
			$this->aTransportador = TransportadorPeer::doSelectOne($c, $con);
			
		}
		return $this->aTransportador;
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
			$v->addPricRecargosxLinea($this);
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

	
	public function setConcepto(Concepto $v = null)
	{
		if ($v === null) {
			$this->setCaIdconcepto(NULL);
		} else {
			$this->setCaIdconcepto($v->getCaIdconcepto());
		}

		$this->aConcepto = $v;

						if ($v !== null) {
			$v->addPricRecargosxLinea($this);
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

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aTransportador = null;
			$this->aTipoRecargo = null;
			$this->aConcepto = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasePricRecargosxLinea:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasePricRecargosxLinea::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 