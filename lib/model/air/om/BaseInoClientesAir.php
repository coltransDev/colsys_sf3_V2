<?php


abstract class BaseInoClientesAir extends BaseObject  implements Persistent {


  const PEER = 'InoClientesAirPeer';

	
	protected static $peer;

	
	protected $ca_referencia;

	
	protected $ca_idcliente;

	
	protected $ca_hawb;

	
	protected $ca_idreporte;

	
	protected $ca_idproveedor;

	
	protected $ca_proveedor;

	
	protected $ca_numpiezas;

	
	protected $ca_peso;

	
	protected $ca_volumen;

	
	protected $ca_numorden;

	
	protected $ca_loginvendedor;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_fchactualizado;

	
	protected $ca_usuactualizado;

	
	protected $ca_idbodega;

	
	protected $aReporte;

	
	protected $aTercero;

	
	protected $aInoMaestraAir;

	
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

	
	public function getCaHawb()
	{
		return $this->ca_hawb;
	}

	
	public function getCaIdreporte()
	{
		return $this->ca_idreporte;
	}

	
	public function getCaIdproveedor()
	{
		return $this->ca_idproveedor;
	}

	
	public function getCaProveedor()
	{
		return $this->ca_proveedor;
	}

	
	public function getCaNumpiezas()
	{
		return $this->ca_numpiezas;
	}

	
	public function getCaPeso()
	{
		return $this->ca_peso;
	}

	
	public function getCaVolumen()
	{
		return $this->ca_volumen;
	}

	
	public function getCaNumorden()
	{
		return $this->ca_numorden;
	}

	
	public function getCaLoginvendedor()
	{
		return $this->ca_loginvendedor;
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

	
	public function getCaFchactualizado($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchactualizado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchactualizado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchactualizado, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaUsuactualizado()
	{
		return $this->ca_usuactualizado;
	}

	
	public function getCaIdbodega()
	{
		return $this->ca_idbodega;
	}

	
	public function setCaReferencia($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_referencia !== $v) {
			$this->ca_referencia = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_REFERENCIA;
		}

		if ($this->aInoMaestraAir !== null && $this->aInoMaestraAir->getCaReferencia() !== $v) {
			$this->aInoMaestraAir = null;
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
			$this->modifiedColumns[] = InoClientesAirPeer::CA_IDCLIENTE;
		}

		return $this;
	} 
	
	public function setCaHawb($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_hawb !== $v) {
			$this->ca_hawb = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_HAWB;
		}

		return $this;
	} 
	
	public function setCaIdreporte($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idreporte !== $v) {
			$this->ca_idreporte = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_IDREPORTE;
		}

		if ($this->aReporte !== null && $this->aReporte->getCaIdreporte() !== $v) {
			$this->aReporte = null;
		}

		return $this;
	} 
	
	public function setCaIdproveedor($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idproveedor !== $v) {
			$this->ca_idproveedor = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_IDPROVEEDOR;
		}

		if ($this->aTercero !== null && $this->aTercero->getCaIdtercero() !== $v) {
			$this->aTercero = null;
		}

		return $this;
	} 
	
	public function setCaProveedor($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_proveedor !== $v) {
			$this->ca_proveedor = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_PROVEEDOR;
		}

		return $this;
	} 
	
	public function setCaNumpiezas($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_numpiezas !== $v) {
			$this->ca_numpiezas = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_NUMPIEZAS;
		}

		return $this;
	} 
	
	public function setCaPeso($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_peso !== $v) {
			$this->ca_peso = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_PESO;
		}

		return $this;
	} 
	
	public function setCaVolumen($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_volumen !== $v) {
			$this->ca_volumen = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_VOLUMEN;
		}

		return $this;
	} 
	
	public function setCaNumorden($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_numorden !== $v) {
			$this->ca_numorden = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_NUMORDEN;
		}

		return $this;
	} 
	
	public function setCaLoginvendedor($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_loginvendedor !== $v) {
			$this->ca_loginvendedor = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_LOGINVENDEDOR;
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
				$this->modifiedColumns[] = InoClientesAirPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = InoClientesAirPeer::CA_USUCREADO;
		}

		return $this;
	} 
	
	public function setCaFchactualizado($v)
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

		if ( $this->ca_fchactualizado !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchactualizado !== null && $tmpDt = new DateTime($this->ca_fchactualizado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchactualizado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = InoClientesAirPeer::CA_FCHACTUALIZADO;
			}
		} 
		return $this;
	} 
	
	public function setCaUsuactualizado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuactualizado !== $v) {
			$this->ca_usuactualizado = $v;
			$this->modifiedColumns[] = InoClientesAirPeer::CA_USUACTUALIZADO;
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
			$this->modifiedColumns[] = InoClientesAirPeer::CA_IDBODEGA;
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
			$this->ca_hawb = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_idreporte = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_idproveedor = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->ca_proveedor = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_numpiezas = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->ca_peso = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
			$this->ca_volumen = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->ca_numorden = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_loginvendedor = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_fchcreado = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_usucreado = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_fchactualizado = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_usuactualizado = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_idbodega = ($row[$startcol + 15] !== null) ? (int) $row[$startcol + 15] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 16; 
		} catch (Exception $e) {
			throw new PropelException("Error populating InoClientesAir object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aInoMaestraAir !== null && $this->ca_referencia !== $this->aInoMaestraAir->getCaReferencia()) {
			$this->aInoMaestraAir = null;
		}
		if ($this->aReporte !== null && $this->ca_idreporte !== $this->aReporte->getCaIdreporte()) {
			$this->aReporte = null;
		}
		if ($this->aTercero !== null && $this->ca_idproveedor !== $this->aTercero->getCaIdtercero()) {
			$this->aTercero = null;
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
			$con = Propel::getConnection(InoClientesAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = InoClientesAirPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aReporte = null;
			$this->aTercero = null;
			$this->aInoMaestraAir = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoClientesAir:delete:pre') as $callable)
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
			$con = Propel::getConnection(InoClientesAirPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			InoClientesAirPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseInoClientesAir:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoClientesAir:save:pre') as $callable)
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
			$con = Propel::getConnection(InoClientesAirPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseInoClientesAir:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			InoClientesAirPeer::addInstanceToPool($this);
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

												
			if ($this->aReporte !== null) {
				if ($this->aReporte->isModified() || $this->aReporte->isNew()) {
					$affectedRows += $this->aReporte->save($con);
				}
				$this->setReporte($this->aReporte);
			}

			if ($this->aTercero !== null) {
				if ($this->aTercero->isModified() || $this->aTercero->isNew()) {
					$affectedRows += $this->aTercero->save($con);
				}
				$this->setTercero($this->aTercero);
			}

			if ($this->aInoMaestraAir !== null) {
				if ($this->aInoMaestraAir->isModified() || $this->aInoMaestraAir->isNew()) {
					$affectedRows += $this->aInoMaestraAir->save($con);
				}
				$this->setInoMaestraAir($this->aInoMaestraAir);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = InoClientesAirPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += InoClientesAirPeer::doUpdate($this, $con);
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


												
			if ($this->aReporte !== null) {
				if (!$this->aReporte->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aReporte->getValidationFailures());
				}
			}

			if ($this->aTercero !== null) {
				if (!$this->aTercero->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTercero->getValidationFailures());
				}
			}

			if ($this->aInoMaestraAir !== null) {
				if (!$this->aInoMaestraAir->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aInoMaestraAir->getValidationFailures());
				}
			}


			if (($retval = InoClientesAirPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InoClientesAirPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaHawb();
				break;
			case 3:
				return $this->getCaIdreporte();
				break;
			case 4:
				return $this->getCaIdproveedor();
				break;
			case 5:
				return $this->getCaProveedor();
				break;
			case 6:
				return $this->getCaNumpiezas();
				break;
			case 7:
				return $this->getCaPeso();
				break;
			case 8:
				return $this->getCaVolumen();
				break;
			case 9:
				return $this->getCaNumorden();
				break;
			case 10:
				return $this->getCaLoginvendedor();
				break;
			case 11:
				return $this->getCaFchcreado();
				break;
			case 12:
				return $this->getCaUsucreado();
				break;
			case 13:
				return $this->getCaFchactualizado();
				break;
			case 14:
				return $this->getCaUsuactualizado();
				break;
			case 15:
				return $this->getCaIdbodega();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = InoClientesAirPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaReferencia(),
			$keys[1] => $this->getCaIdcliente(),
			$keys[2] => $this->getCaHawb(),
			$keys[3] => $this->getCaIdreporte(),
			$keys[4] => $this->getCaIdproveedor(),
			$keys[5] => $this->getCaProveedor(),
			$keys[6] => $this->getCaNumpiezas(),
			$keys[7] => $this->getCaPeso(),
			$keys[8] => $this->getCaVolumen(),
			$keys[9] => $this->getCaNumorden(),
			$keys[10] => $this->getCaLoginvendedor(),
			$keys[11] => $this->getCaFchcreado(),
			$keys[12] => $this->getCaUsucreado(),
			$keys[13] => $this->getCaFchactualizado(),
			$keys[14] => $this->getCaUsuactualizado(),
			$keys[15] => $this->getCaIdbodega(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InoClientesAirPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaHawb($value);
				break;
			case 3:
				$this->setCaIdreporte($value);
				break;
			case 4:
				$this->setCaIdproveedor($value);
				break;
			case 5:
				$this->setCaProveedor($value);
				break;
			case 6:
				$this->setCaNumpiezas($value);
				break;
			case 7:
				$this->setCaPeso($value);
				break;
			case 8:
				$this->setCaVolumen($value);
				break;
			case 9:
				$this->setCaNumorden($value);
				break;
			case 10:
				$this->setCaLoginvendedor($value);
				break;
			case 11:
				$this->setCaFchcreado($value);
				break;
			case 12:
				$this->setCaUsucreado($value);
				break;
			case 13:
				$this->setCaFchactualizado($value);
				break;
			case 14:
				$this->setCaUsuactualizado($value);
				break;
			case 15:
				$this->setCaIdbodega($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InoClientesAirPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaReferencia($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdcliente($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaHawb($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaIdreporte($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaIdproveedor($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaProveedor($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaNumpiezas($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaPeso($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaVolumen($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaNumorden($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaLoginvendedor($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaFchcreado($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaUsucreado($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaFchactualizado($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaUsuactualizado($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaIdbodega($arr[$keys[15]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(InoClientesAirPeer::DATABASE_NAME);

		if ($this->isColumnModified(InoClientesAirPeer::CA_REFERENCIA)) $criteria->add(InoClientesAirPeer::CA_REFERENCIA, $this->ca_referencia);
		if ($this->isColumnModified(InoClientesAirPeer::CA_IDCLIENTE)) $criteria->add(InoClientesAirPeer::CA_IDCLIENTE, $this->ca_idcliente);
		if ($this->isColumnModified(InoClientesAirPeer::CA_HAWB)) $criteria->add(InoClientesAirPeer::CA_HAWB, $this->ca_hawb);
		if ($this->isColumnModified(InoClientesAirPeer::CA_IDREPORTE)) $criteria->add(InoClientesAirPeer::CA_IDREPORTE, $this->ca_idreporte);
		if ($this->isColumnModified(InoClientesAirPeer::CA_IDPROVEEDOR)) $criteria->add(InoClientesAirPeer::CA_IDPROVEEDOR, $this->ca_idproveedor);
		if ($this->isColumnModified(InoClientesAirPeer::CA_PROVEEDOR)) $criteria->add(InoClientesAirPeer::CA_PROVEEDOR, $this->ca_proveedor);
		if ($this->isColumnModified(InoClientesAirPeer::CA_NUMPIEZAS)) $criteria->add(InoClientesAirPeer::CA_NUMPIEZAS, $this->ca_numpiezas);
		if ($this->isColumnModified(InoClientesAirPeer::CA_PESO)) $criteria->add(InoClientesAirPeer::CA_PESO, $this->ca_peso);
		if ($this->isColumnModified(InoClientesAirPeer::CA_VOLUMEN)) $criteria->add(InoClientesAirPeer::CA_VOLUMEN, $this->ca_volumen);
		if ($this->isColumnModified(InoClientesAirPeer::CA_NUMORDEN)) $criteria->add(InoClientesAirPeer::CA_NUMORDEN, $this->ca_numorden);
		if ($this->isColumnModified(InoClientesAirPeer::CA_LOGINVENDEDOR)) $criteria->add(InoClientesAirPeer::CA_LOGINVENDEDOR, $this->ca_loginvendedor);
		if ($this->isColumnModified(InoClientesAirPeer::CA_FCHCREADO)) $criteria->add(InoClientesAirPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(InoClientesAirPeer::CA_USUCREADO)) $criteria->add(InoClientesAirPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(InoClientesAirPeer::CA_FCHACTUALIZADO)) $criteria->add(InoClientesAirPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(InoClientesAirPeer::CA_USUACTUALIZADO)) $criteria->add(InoClientesAirPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);
		if ($this->isColumnModified(InoClientesAirPeer::CA_IDBODEGA)) $criteria->add(InoClientesAirPeer::CA_IDBODEGA, $this->ca_idbodega);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(InoClientesAirPeer::DATABASE_NAME);

		$criteria->add(InoClientesAirPeer::CA_REFERENCIA, $this->ca_referencia);
		$criteria->add(InoClientesAirPeer::CA_IDCLIENTE, $this->ca_idcliente);
		$criteria->add(InoClientesAirPeer::CA_HAWB, $this->ca_hawb);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaReferencia();

		$pks[1] = $this->getCaIdcliente();

		$pks[2] = $this->getCaHawb();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaReferencia($keys[0]);

		$this->setCaIdcliente($keys[1]);

		$this->setCaHawb($keys[2]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaReferencia($this->ca_referencia);

		$copyObj->setCaIdcliente($this->ca_idcliente);

		$copyObj->setCaHawb($this->ca_hawb);

		$copyObj->setCaIdreporte($this->ca_idreporte);

		$copyObj->setCaIdproveedor($this->ca_idproveedor);

		$copyObj->setCaProveedor($this->ca_proveedor);

		$copyObj->setCaNumpiezas($this->ca_numpiezas);

		$copyObj->setCaPeso($this->ca_peso);

		$copyObj->setCaVolumen($this->ca_volumen);

		$copyObj->setCaNumorden($this->ca_numorden);

		$copyObj->setCaLoginvendedor($this->ca_loginvendedor);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);

		$copyObj->setCaIdbodega($this->ca_idbodega);


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
			self::$peer = new InoClientesAirPeer();
		}
		return self::$peer;
	}

	
	public function setReporte(Reporte $v = null)
	{
		if ($v === null) {
			$this->setCaIdreporte(NULL);
		} else {
			$this->setCaIdreporte($v->getCaIdreporte());
		}

		$this->aReporte = $v;

						if ($v !== null) {
			$v->addInoClientesAir($this);
		}

		return $this;
	}


	
	public function getReporte(PropelPDO $con = null)
	{
		if ($this->aReporte === null && (($this->ca_idreporte !== "" && $this->ca_idreporte !== null))) {
			$c = new Criteria(ReportePeer::DATABASE_NAME);
			$c->add(ReportePeer::CA_IDREPORTE, $this->ca_idreporte);
			$this->aReporte = ReportePeer::doSelectOne($c, $con);
			
		}
		return $this->aReporte;
	}

	
	public function setTercero(Tercero $v = null)
	{
		if ($v === null) {
			$this->setCaIdproveedor(NULL);
		} else {
			$this->setCaIdproveedor($v->getCaIdtercero());
		}

		$this->aTercero = $v;

						if ($v !== null) {
			$v->addInoClientesAir($this);
		}

		return $this;
	}


	
	public function getTercero(PropelPDO $con = null)
	{
		if ($this->aTercero === null && ($this->ca_idproveedor !== null)) {
			$c = new Criteria(TerceroPeer::DATABASE_NAME);
			$c->add(TerceroPeer::CA_IDTERCERO, $this->ca_idproveedor);
			$this->aTercero = TerceroPeer::doSelectOne($c, $con);
			
		}
		return $this->aTercero;
	}

	
	public function setInoMaestraAir(InoMaestraAir $v = null)
	{
		if ($v === null) {
			$this->setCaReferencia(NULL);
		} else {
			$this->setCaReferencia($v->getCaReferencia());
		}

		$this->aInoMaestraAir = $v;

						if ($v !== null) {
			$v->addInoClientesAir($this);
		}

		return $this;
	}


	
	public function getInoMaestraAir(PropelPDO $con = null)
	{
		if ($this->aInoMaestraAir === null && (($this->ca_referencia !== "" && $this->ca_referencia !== null))) {
			$c = new Criteria(InoMaestraAirPeer::DATABASE_NAME);
			$c->add(InoMaestraAirPeer::CA_REFERENCIA, $this->ca_referencia);
			$this->aInoMaestraAir = InoMaestraAirPeer::doSelectOne($c, $con);
			
		}
		return $this->aInoMaestraAir;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aReporte = null;
			$this->aTercero = null;
			$this->aInoMaestraAir = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseInoClientesAir:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseInoClientesAir::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 