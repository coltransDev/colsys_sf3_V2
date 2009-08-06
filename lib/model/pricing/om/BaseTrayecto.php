<?php


abstract class BaseTrayecto extends BaseObject  implements Persistent {


  const PEER = 'TrayectoPeer';

	
	protected static $peer;

	
	protected $oid;

	
	protected $ca_idtrayecto;

	
	protected $ca_origen;

	
	protected $ca_destino;

	
	protected $ca_idlinea;

	
	protected $ca_transporte;

	
	protected $ca_terminal;

	
	protected $ca_impoexpo;

	
	protected $ca_frecuencia;

	
	protected $ca_tiempotransito;

	
	protected $ca_modalidad;

	
	protected $ca_fchcreado;

	
	protected $ca_idtarifas;

	
	protected $ca_observaciones;

	
	protected $ca_idagente;

	
	protected $ca_activo;

	
	protected $aTransportador;

	
	protected $aAgente;

	
	protected $collPricFletes;

	
	private $lastPricFleteCriteria = null;

	
	protected $collPricFleteLogs;

	
	private $lastPricFleteLogCriteria = null;

	
	protected $collFletes;

	
	private $lastFleteCriteria = null;

	
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

	
	public function getOid()
	{
		return $this->oid;
	}

	
	public function getCaIdtrayecto()
	{
		return $this->ca_idtrayecto;
	}

	
	public function getCaOrigen()
	{
		return $this->ca_origen;
	}

	
	public function getCaDestino()
	{
		return $this->ca_destino;
	}

	
	public function getCaIdlinea()
	{
		return $this->ca_idlinea;
	}

	
	public function getCaTransporte()
	{
		return $this->ca_transporte;
	}

	
	public function getCaTerminal()
	{
		return $this->ca_terminal;
	}

	
	public function getCaImpoexpo()
	{
		return $this->ca_impoexpo;
	}

	
	public function getCaFrecuencia()
	{
		return $this->ca_frecuencia;
	}

	
	public function getCaTiempotransito()
	{
		return $this->ca_tiempotransito;
	}

	
	public function getCaModalidad()
	{
		return $this->ca_modalidad;
	}

	
	public function getCaFchcreado($format = 'Y-m-d')
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

	
	public function getCaIdtarifas()
	{
		return $this->ca_idtarifas;
	}

	
	public function getCaObservaciones()
	{
		return $this->ca_observaciones;
	}

	
	public function getCaIdagente()
	{
		return $this->ca_idagente;
	}

	
	public function getCaActivo()
	{
		return $this->ca_activo;
	}

	
	public function setOid($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->oid !== $v) {
			$this->oid = $v;
			$this->modifiedColumns[] = TrayectoPeer::OID;
		}

		return $this;
	} 
	
	public function setCaIdtrayecto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idtrayecto !== $v) {
			$this->ca_idtrayecto = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_IDTRAYECTO;
		}

		return $this;
	} 
	
	public function setCaOrigen($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_origen !== $v) {
			$this->ca_origen = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_ORIGEN;
		}

		return $this;
	} 
	
	public function setCaDestino($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_destino !== $v) {
			$this->ca_destino = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_DESTINO;
		}

		return $this;
	} 
	
	public function setCaIdlinea($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idlinea !== $v) {
			$this->ca_idlinea = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_IDLINEA;
		}

		if ($this->aTransportador !== null && $this->aTransportador->getCaIdlinea() !== $v) {
			$this->aTransportador = null;
		}

		return $this;
	} 
	
	public function setCaTransporte($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_transporte !== $v) {
			$this->ca_transporte = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_TRANSPORTE;
		}

		return $this;
	} 
	
	public function setCaTerminal($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_terminal !== $v) {
			$this->ca_terminal = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_TERMINAL;
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
			$this->modifiedColumns[] = TrayectoPeer::CA_IMPOEXPO;
		}

		return $this;
	} 
	
	public function setCaFrecuencia($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_frecuencia !== $v) {
			$this->ca_frecuencia = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_FRECUENCIA;
		}

		return $this;
	} 
	
	public function setCaTiempotransito($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_tiempotransito !== $v) {
			$this->ca_tiempotransito = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_TIEMPOTRANSITO;
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
			$this->modifiedColumns[] = TrayectoPeer::CA_MODALIDAD;
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
			
			$currNorm = ($this->ca_fchcreado !== null && $tmpDt = new DateTime($this->ca_fchcreado)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchcreado = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = TrayectoPeer::CA_FCHCREADO;
			}
		} 
		return $this;
	} 
	
	public function setCaIdtarifas($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idtarifas !== $v) {
			$this->ca_idtarifas = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_IDTARIFAS;
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
			$this->modifiedColumns[] = TrayectoPeer::CA_OBSERVACIONES;
		}

		return $this;
	} 
	
	public function setCaIdagente($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idagente !== $v) {
			$this->ca_idagente = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_IDAGENTE;
		}

		if ($this->aAgente !== null && $this->aAgente->getCaIdagente() !== $v) {
			$this->aAgente = null;
		}

		return $this;
	} 
	
	public function setCaActivo($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_activo !== $v) {
			$this->ca_activo = $v;
			$this->modifiedColumns[] = TrayectoPeer::CA_ACTIVO;
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

			$this->oid = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idtrayecto = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_origen = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_destino = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_idlinea = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->ca_transporte = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_terminal = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_impoexpo = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_frecuencia = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_tiempotransito = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_modalidad = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_fchcreado = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_idtarifas = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
			$this->ca_observaciones = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_idagente = ($row[$startcol + 14] !== null) ? (int) $row[$startcol + 14] : null;
			$this->ca_activo = ($row[$startcol + 15] !== null) ? (boolean) $row[$startcol + 15] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 16; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Trayecto object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aTransportador !== null && $this->ca_idlinea !== $this->aTransportador->getCaIdlinea()) {
			$this->aTransportador = null;
		}
		if ($this->aAgente !== null && $this->ca_idagente !== $this->aAgente->getCaIdagente()) {
			$this->aAgente = null;
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
			$con = Propel::getConnection(TrayectoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = TrayectoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aTransportador = null;
			$this->aAgente = null;
			$this->collPricFletes = null;
			$this->lastPricFleteCriteria = null;

			$this->collPricFleteLogs = null;
			$this->lastPricFleteLogCriteria = null;

			$this->collFletes = null;
			$this->lastFleteCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTrayecto:delete:pre') as $callable)
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
			$con = Propel::getConnection(TrayectoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			TrayectoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseTrayecto:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTrayecto:save:pre') as $callable)
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
			$con = Propel::getConnection(TrayectoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseTrayecto:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			TrayectoPeer::addInstanceToPool($this);
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

			if ($this->aAgente !== null) {
				if ($this->aAgente->isModified() || $this->aAgente->isNew()) {
					$affectedRows += $this->aAgente->save($con);
				}
				$this->setAgente($this->aAgente);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TrayectoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += TrayectoPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collPricFletes !== null) {
				foreach ($this->collPricFletes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPricFleteLogs !== null) {
				foreach ($this->collPricFleteLogs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFletes !== null) {
				foreach ($this->collFletes as $referrerFK) {
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


												
			if ($this->aTransportador !== null) {
				if (!$this->aTransportador->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTransportador->getValidationFailures());
				}
			}

			if ($this->aAgente !== null) {
				if (!$this->aAgente->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAgente->getValidationFailures());
				}
			}


			if (($retval = TrayectoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPricFletes !== null) {
					foreach ($this->collPricFletes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPricFleteLogs !== null) {
					foreach ($this->collPricFleteLogs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFletes !== null) {
					foreach ($this->collFletes as $referrerFK) {
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
		$pos = TrayectoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getOid();
				break;
			case 1:
				return $this->getCaIdtrayecto();
				break;
			case 2:
				return $this->getCaOrigen();
				break;
			case 3:
				return $this->getCaDestino();
				break;
			case 4:
				return $this->getCaIdlinea();
				break;
			case 5:
				return $this->getCaTransporte();
				break;
			case 6:
				return $this->getCaTerminal();
				break;
			case 7:
				return $this->getCaImpoexpo();
				break;
			case 8:
				return $this->getCaFrecuencia();
				break;
			case 9:
				return $this->getCaTiempotransito();
				break;
			case 10:
				return $this->getCaModalidad();
				break;
			case 11:
				return $this->getCaFchcreado();
				break;
			case 12:
				return $this->getCaIdtarifas();
				break;
			case 13:
				return $this->getCaObservaciones();
				break;
			case 14:
				return $this->getCaIdagente();
				break;
			case 15:
				return $this->getCaActivo();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = TrayectoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getOid(),
			$keys[1] => $this->getCaIdtrayecto(),
			$keys[2] => $this->getCaOrigen(),
			$keys[3] => $this->getCaDestino(),
			$keys[4] => $this->getCaIdlinea(),
			$keys[5] => $this->getCaTransporte(),
			$keys[6] => $this->getCaTerminal(),
			$keys[7] => $this->getCaImpoexpo(),
			$keys[8] => $this->getCaFrecuencia(),
			$keys[9] => $this->getCaTiempotransito(),
			$keys[10] => $this->getCaModalidad(),
			$keys[11] => $this->getCaFchcreado(),
			$keys[12] => $this->getCaIdtarifas(),
			$keys[13] => $this->getCaObservaciones(),
			$keys[14] => $this->getCaIdagente(),
			$keys[15] => $this->getCaActivo(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TrayectoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setOid($value);
				break;
			case 1:
				$this->setCaIdtrayecto($value);
				break;
			case 2:
				$this->setCaOrigen($value);
				break;
			case 3:
				$this->setCaDestino($value);
				break;
			case 4:
				$this->setCaIdlinea($value);
				break;
			case 5:
				$this->setCaTransporte($value);
				break;
			case 6:
				$this->setCaTerminal($value);
				break;
			case 7:
				$this->setCaImpoexpo($value);
				break;
			case 8:
				$this->setCaFrecuencia($value);
				break;
			case 9:
				$this->setCaTiempotransito($value);
				break;
			case 10:
				$this->setCaModalidad($value);
				break;
			case 11:
				$this->setCaFchcreado($value);
				break;
			case 12:
				$this->setCaIdtarifas($value);
				break;
			case 13:
				$this->setCaObservaciones($value);
				break;
			case 14:
				$this->setCaIdagente($value);
				break;
			case 15:
				$this->setCaActivo($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TrayectoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setOid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdtrayecto($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaOrigen($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaDestino($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaIdlinea($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaTransporte($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaTerminal($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaImpoexpo($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaFrecuencia($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaTiempotransito($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaModalidad($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaFchcreado($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaIdtarifas($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaObservaciones($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaIdagente($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaActivo($arr[$keys[15]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TrayectoPeer::DATABASE_NAME);

		if ($this->isColumnModified(TrayectoPeer::OID)) $criteria->add(TrayectoPeer::OID, $this->oid);
		if ($this->isColumnModified(TrayectoPeer::CA_IDTRAYECTO)) $criteria->add(TrayectoPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);
		if ($this->isColumnModified(TrayectoPeer::CA_ORIGEN)) $criteria->add(TrayectoPeer::CA_ORIGEN, $this->ca_origen);
		if ($this->isColumnModified(TrayectoPeer::CA_DESTINO)) $criteria->add(TrayectoPeer::CA_DESTINO, $this->ca_destino);
		if ($this->isColumnModified(TrayectoPeer::CA_IDLINEA)) $criteria->add(TrayectoPeer::CA_IDLINEA, $this->ca_idlinea);
		if ($this->isColumnModified(TrayectoPeer::CA_TRANSPORTE)) $criteria->add(TrayectoPeer::CA_TRANSPORTE, $this->ca_transporte);
		if ($this->isColumnModified(TrayectoPeer::CA_TERMINAL)) $criteria->add(TrayectoPeer::CA_TERMINAL, $this->ca_terminal);
		if ($this->isColumnModified(TrayectoPeer::CA_IMPOEXPO)) $criteria->add(TrayectoPeer::CA_IMPOEXPO, $this->ca_impoexpo);
		if ($this->isColumnModified(TrayectoPeer::CA_FRECUENCIA)) $criteria->add(TrayectoPeer::CA_FRECUENCIA, $this->ca_frecuencia);
		if ($this->isColumnModified(TrayectoPeer::CA_TIEMPOTRANSITO)) $criteria->add(TrayectoPeer::CA_TIEMPOTRANSITO, $this->ca_tiempotransito);
		if ($this->isColumnModified(TrayectoPeer::CA_MODALIDAD)) $criteria->add(TrayectoPeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(TrayectoPeer::CA_FCHCREADO)) $criteria->add(TrayectoPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(TrayectoPeer::CA_IDTARIFAS)) $criteria->add(TrayectoPeer::CA_IDTARIFAS, $this->ca_idtarifas);
		if ($this->isColumnModified(TrayectoPeer::CA_OBSERVACIONES)) $criteria->add(TrayectoPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(TrayectoPeer::CA_IDAGENTE)) $criteria->add(TrayectoPeer::CA_IDAGENTE, $this->ca_idagente);
		if ($this->isColumnModified(TrayectoPeer::CA_ACTIVO)) $criteria->add(TrayectoPeer::CA_ACTIVO, $this->ca_activo);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TrayectoPeer::DATABASE_NAME);

		$criteria->add(TrayectoPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdtrayecto();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdtrayecto($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setOid($this->oid);

		$copyObj->setCaIdtrayecto($this->ca_idtrayecto);

		$copyObj->setCaOrigen($this->ca_origen);

		$copyObj->setCaDestino($this->ca_destino);

		$copyObj->setCaIdlinea($this->ca_idlinea);

		$copyObj->setCaTransporte($this->ca_transporte);

		$copyObj->setCaTerminal($this->ca_terminal);

		$copyObj->setCaImpoexpo($this->ca_impoexpo);

		$copyObj->setCaFrecuencia($this->ca_frecuencia);

		$copyObj->setCaTiempotransito($this->ca_tiempotransito);

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaIdtarifas($this->ca_idtarifas);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaIdagente($this->ca_idagente);

		$copyObj->setCaActivo($this->ca_activo);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getPricFletes() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addPricFlete($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPricFleteLogs() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addPricFleteLog($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getFletes() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addFlete($relObj->copy($deepCopy));
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
			self::$peer = new TrayectoPeer();
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
			$v->addTrayecto($this);
		}

		return $this;
	}


	
	public function getTransportador(PropelPDO $con = null)
	{
		if ($this->aTransportador === null && ($this->ca_idlinea !== null)) {
			$c = new Criteria(TransportadorPeer::DATABASE_NAME);
			$c->add(TransportadorPeer::CA_IDLINEA, $this->ca_idlinea);
			$this->aTransportador = TransportadorPeer::doSelectOne($c, $con);
			
		}
		return $this->aTransportador;
	}

	
	public function setAgente(Agente $v = null)
	{
		if ($v === null) {
			$this->setCaIdagente(NULL);
		} else {
			$this->setCaIdagente($v->getCaIdagente());
		}

		$this->aAgente = $v;

						if ($v !== null) {
			$v->addTrayecto($this);
		}

		return $this;
	}


	
	public function getAgente(PropelPDO $con = null)
	{
		if ($this->aAgente === null && ($this->ca_idagente !== null)) {
			$c = new Criteria(AgentePeer::DATABASE_NAME);
			$c->add(AgentePeer::CA_IDAGENTE, $this->ca_idagente);
			$this->aAgente = AgentePeer::doSelectOne($c, $con);
			
		}
		return $this->aAgente;
	}

	
	public function clearPricFletes()
	{
		$this->collPricFletes = null; 	}

	
	public function initPricFletes()
	{
		$this->collPricFletes = array();
	}

	
	public function getPricFletes($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrayectoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricFletes === null) {
			if ($this->isNew()) {
			   $this->collPricFletes = array();
			} else {

				$criteria->add(PricFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				PricFletePeer::addSelectColumns($criteria);
				$this->collPricFletes = PricFletePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				PricFletePeer::addSelectColumns($criteria);
				if (!isset($this->lastPricFleteCriteria) || !$this->lastPricFleteCriteria->equals($criteria)) {
					$this->collPricFletes = PricFletePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricFleteCriteria = $criteria;
		return $this->collPricFletes;
	}

	
	public function countPricFletes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrayectoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricFletes === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				$count = PricFletePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				if (!isset($this->lastPricFleteCriteria) || !$this->lastPricFleteCriteria->equals($criteria)) {
					$count = PricFletePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricFletes);
				}
			} else {
				$count = count($this->collPricFletes);
			}
		}
		return $count;
	}

	
	public function addPricFlete(PricFlete $l)
	{
		if ($this->collPricFletes === null) {
			$this->initPricFletes();
		}
		if (!in_array($l, $this->collPricFletes, true)) { 			array_push($this->collPricFletes, $l);
			$l->setTrayecto($this);
		}
	}


	
	public function getPricFletesJoinConcepto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrayectoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricFletes === null) {
			if ($this->isNew()) {
				$this->collPricFletes = array();
			} else {

				$criteria->add(PricFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				$this->collPricFletes = PricFletePeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(PricFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

			if (!isset($this->lastPricFleteCriteria) || !$this->lastPricFleteCriteria->equals($criteria)) {
				$this->collPricFletes = PricFletePeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricFleteCriteria = $criteria;

		return $this->collPricFletes;
	}

	
	public function clearPricFleteLogs()
	{
		$this->collPricFleteLogs = null; 	}

	
	public function initPricFleteLogs()
	{
		$this->collPricFleteLogs = array();
	}

	
	public function getPricFleteLogs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrayectoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricFleteLogs === null) {
			if ($this->isNew()) {
			   $this->collPricFleteLogs = array();
			} else {

				$criteria->add(PricFleteLogPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				PricFleteLogPeer::addSelectColumns($criteria);
				$this->collPricFleteLogs = PricFleteLogPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricFleteLogPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				PricFleteLogPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricFleteLogCriteria) || !$this->lastPricFleteLogCriteria->equals($criteria)) {
					$this->collPricFleteLogs = PricFleteLogPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricFleteLogCriteria = $criteria;
		return $this->collPricFleteLogs;
	}

	
	public function countPricFleteLogs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrayectoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricFleteLogs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricFleteLogPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				$count = PricFleteLogPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricFleteLogPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				if (!isset($this->lastPricFleteLogCriteria) || !$this->lastPricFleteLogCriteria->equals($criteria)) {
					$count = PricFleteLogPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricFleteLogs);
				}
			} else {
				$count = count($this->collPricFleteLogs);
			}
		}
		return $count;
	}

	
	public function addPricFleteLog(PricFleteLog $l)
	{
		if ($this->collPricFleteLogs === null) {
			$this->initPricFleteLogs();
		}
		if (!in_array($l, $this->collPricFleteLogs, true)) { 			array_push($this->collPricFleteLogs, $l);
			$l->setTrayecto($this);
		}
	}


	
	public function getPricFleteLogsJoinConcepto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrayectoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricFleteLogs === null) {
			if ($this->isNew()) {
				$this->collPricFleteLogs = array();
			} else {

				$criteria->add(PricFleteLogPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				$this->collPricFleteLogs = PricFleteLogPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(PricFleteLogPeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

			if (!isset($this->lastPricFleteLogCriteria) || !$this->lastPricFleteLogCriteria->equals($criteria)) {
				$this->collPricFleteLogs = PricFleteLogPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricFleteLogCriteria = $criteria;

		return $this->collPricFleteLogs;
	}

	
	public function clearFletes()
	{
		$this->collFletes = null; 	}

	
	public function initFletes()
	{
		$this->collFletes = array();
	}

	
	public function getFletes($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrayectoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFletes === null) {
			if ($this->isNew()) {
			   $this->collFletes = array();
			} else {

				$criteria->add(FletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				FletePeer::addSelectColumns($criteria);
				$this->collFletes = FletePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				FletePeer::addSelectColumns($criteria);
				if (!isset($this->lastFleteCriteria) || !$this->lastFleteCriteria->equals($criteria)) {
					$this->collFletes = FletePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFleteCriteria = $criteria;
		return $this->collFletes;
	}

	
	public function countFletes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrayectoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collFletes === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(FletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				$count = FletePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				if (!isset($this->lastFleteCriteria) || !$this->lastFleteCriteria->equals($criteria)) {
					$count = FletePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collFletes);
				}
			} else {
				$count = count($this->collFletes);
			}
		}
		return $count;
	}

	
	public function addFlete(Flete $l)
	{
		if ($this->collFletes === null) {
			$this->initFletes();
		}
		if (!in_array($l, $this->collFletes, true)) { 			array_push($this->collFletes, $l);
			$l->setTrayecto($this);
		}
	}


	
	public function getFletesJoinConcepto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrayectoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFletes === null) {
			if ($this->isNew()) {
				$this->collFletes = array();
			} else {

				$criteria->add(FletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

				$this->collFletes = FletePeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(FletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);

			if (!isset($this->lastFleteCriteria) || !$this->lastFleteCriteria->equals($criteria)) {
				$this->collFletes = FletePeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		}
		$this->lastFleteCriteria = $criteria;

		return $this->collFletes;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collPricFletes) {
				foreach ((array) $this->collPricFletes as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPricFleteLogs) {
				foreach ((array) $this->collPricFleteLogs as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collFletes) {
				foreach ((array) $this->collFletes as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collPricFletes = null;
		$this->collPricFleteLogs = null;
		$this->collFletes = null;
			$this->aTransportador = null;
			$this->aAgente = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseTrayecto:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseTrayecto::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 