<?php


abstract class BaseInoIngresosAir extends BaseObject  implements Persistent {


  const PEER = 'InoIngresosAirPeer';

	
	protected static $peer;

	
	protected $ca_referencia;

	
	protected $ca_idcliente;

	
	protected $ca_hawb;

	
	protected $ca_factura;

	
	protected $ca_fchfactura;

	
	protected $ca_valor;

	
	protected $ca_reccaja;

	
	protected $ca_fchpago;

	
	protected $ca_tcalaico;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $aInoMaestraAir;

	
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

	
	public function getCaFactura()
	{
		return $this->ca_factura;
	}

	
	public function getCaFchfactura($format = 'Y-m-d')
	{
		if ($this->ca_fchfactura === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchfactura);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchfactura, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaValor()
	{
		return $this->ca_valor;
	}

	
	public function getCaReccaja()
	{
		return $this->ca_reccaja;
	}

	
	public function getCaFchpago($format = 'Y-m-d')
	{
		if ($this->ca_fchpago === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchpago);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchpago, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaTcalaico()
	{
		return $this->ca_tcalaico;
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

	
	public function setCaReferencia($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_referencia !== $v) {
			$this->ca_referencia = $v;
			$this->modifiedColumns[] = InoIngresosAirPeer::CA_REFERENCIA;
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
			$this->modifiedColumns[] = InoIngresosAirPeer::CA_IDCLIENTE;
		}

		if ($this->aCliente !== null && $this->aCliente->getCaIdcliente() !== $v) {
			$this->aCliente = null;
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
			$this->modifiedColumns[] = InoIngresosAirPeer::CA_HAWB;
		}

		return $this;
	} 
	
	public function setCaFactura($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_factura !== $v) {
			$this->ca_factura = $v;
			$this->modifiedColumns[] = InoIngresosAirPeer::CA_FACTURA;
		}

		return $this;
	} 
	
	public function setCaFchfactura($v)
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

		if ( $this->ca_fchfactura !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchfactura !== null && $tmpDt = new DateTime($this->ca_fchfactura)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchfactura = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = InoIngresosAirPeer::CA_FCHFACTURA;
			}
		} 
		return $this;
	} 
	
	public function setCaValor($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_valor !== $v) {
			$this->ca_valor = $v;
			$this->modifiedColumns[] = InoIngresosAirPeer::CA_VALOR;
		}

		return $this;
	} 
	
	public function setCaReccaja($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_reccaja !== $v) {
			$this->ca_reccaja = $v;
			$this->modifiedColumns[] = InoIngresosAirPeer::CA_RECCAJA;
		}

		return $this;
	} 
	
	public function setCaFchpago($v)
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

		if ( $this->ca_fchpago !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchpago !== null && $tmpDt = new DateTime($this->ca_fchpago)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchpago = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = InoIngresosAirPeer::CA_FCHPAGO;
			}
		} 
		return $this;
	} 
	
	public function setCaTcalaico($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_tcalaico !== $v) {
			$this->ca_tcalaico = $v;
			$this->modifiedColumns[] = InoIngresosAirPeer::CA_TCALAICO;
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
				$this->modifiedColumns[] = InoIngresosAirPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = InoIngresosAirPeer::CA_USUCREADO;
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
			$this->ca_factura = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_fchfactura = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_valor = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_reccaja = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_fchpago = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_tcalaico = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_fchcreado = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_usucreado = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 11; 
		} catch (Exception $e) {
			throw new PropelException("Error populating InoIngresosAir object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aInoMaestraAir !== null && $this->ca_referencia !== $this->aInoMaestraAir->getCaReferencia()) {
			$this->aInoMaestraAir = null;
		}
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
			$con = Propel::getConnection(InoIngresosAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = InoIngresosAirPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aInoMaestraAir = null;
			$this->aCliente = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoIngresosAir:delete:pre') as $callable)
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
			$con = Propel::getConnection(InoIngresosAirPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			InoIngresosAirPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseInoIngresosAir:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoIngresosAir:save:pre') as $callable)
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
			$con = Propel::getConnection(InoIngresosAirPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseInoIngresosAir:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			InoIngresosAirPeer::addInstanceToPool($this);
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

												
			if ($this->aInoMaestraAir !== null) {
				if ($this->aInoMaestraAir->isModified() || $this->aInoMaestraAir->isNew()) {
					$affectedRows += $this->aInoMaestraAir->save($con);
				}
				$this->setInoMaestraAir($this->aInoMaestraAir);
			}

			if ($this->aCliente !== null) {
				if ($this->aCliente->isModified() || $this->aCliente->isNew()) {
					$affectedRows += $this->aCliente->save($con);
				}
				$this->setCliente($this->aCliente);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = InoIngresosAirPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += InoIngresosAirPeer::doUpdate($this, $con);
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


												
			if ($this->aInoMaestraAir !== null) {
				if (!$this->aInoMaestraAir->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aInoMaestraAir->getValidationFailures());
				}
			}

			if ($this->aCliente !== null) {
				if (!$this->aCliente->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCliente->getValidationFailures());
				}
			}


			if (($retval = InoIngresosAirPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InoIngresosAirPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaFactura();
				break;
			case 4:
				return $this->getCaFchfactura();
				break;
			case 5:
				return $this->getCaValor();
				break;
			case 6:
				return $this->getCaReccaja();
				break;
			case 7:
				return $this->getCaFchpago();
				break;
			case 8:
				return $this->getCaTcalaico();
				break;
			case 9:
				return $this->getCaFchcreado();
				break;
			case 10:
				return $this->getCaUsucreado();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = InoIngresosAirPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaReferencia(),
			$keys[1] => $this->getCaIdcliente(),
			$keys[2] => $this->getCaHawb(),
			$keys[3] => $this->getCaFactura(),
			$keys[4] => $this->getCaFchfactura(),
			$keys[5] => $this->getCaValor(),
			$keys[6] => $this->getCaReccaja(),
			$keys[7] => $this->getCaFchpago(),
			$keys[8] => $this->getCaTcalaico(),
			$keys[9] => $this->getCaFchcreado(),
			$keys[10] => $this->getCaUsucreado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InoIngresosAirPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaFactura($value);
				break;
			case 4:
				$this->setCaFchfactura($value);
				break;
			case 5:
				$this->setCaValor($value);
				break;
			case 6:
				$this->setCaReccaja($value);
				break;
			case 7:
				$this->setCaFchpago($value);
				break;
			case 8:
				$this->setCaTcalaico($value);
				break;
			case 9:
				$this->setCaFchcreado($value);
				break;
			case 10:
				$this->setCaUsucreado($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InoIngresosAirPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaReferencia($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdcliente($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaHawb($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaFactura($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaFchfactura($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaValor($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaReccaja($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaFchpago($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaTcalaico($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaFchcreado($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaUsucreado($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(InoIngresosAirPeer::DATABASE_NAME);

		if ($this->isColumnModified(InoIngresosAirPeer::CA_REFERENCIA)) $criteria->add(InoIngresosAirPeer::CA_REFERENCIA, $this->ca_referencia);
		if ($this->isColumnModified(InoIngresosAirPeer::CA_IDCLIENTE)) $criteria->add(InoIngresosAirPeer::CA_IDCLIENTE, $this->ca_idcliente);
		if ($this->isColumnModified(InoIngresosAirPeer::CA_HAWB)) $criteria->add(InoIngresosAirPeer::CA_HAWB, $this->ca_hawb);
		if ($this->isColumnModified(InoIngresosAirPeer::CA_FACTURA)) $criteria->add(InoIngresosAirPeer::CA_FACTURA, $this->ca_factura);
		if ($this->isColumnModified(InoIngresosAirPeer::CA_FCHFACTURA)) $criteria->add(InoIngresosAirPeer::CA_FCHFACTURA, $this->ca_fchfactura);
		if ($this->isColumnModified(InoIngresosAirPeer::CA_VALOR)) $criteria->add(InoIngresosAirPeer::CA_VALOR, $this->ca_valor);
		if ($this->isColumnModified(InoIngresosAirPeer::CA_RECCAJA)) $criteria->add(InoIngresosAirPeer::CA_RECCAJA, $this->ca_reccaja);
		if ($this->isColumnModified(InoIngresosAirPeer::CA_FCHPAGO)) $criteria->add(InoIngresosAirPeer::CA_FCHPAGO, $this->ca_fchpago);
		if ($this->isColumnModified(InoIngresosAirPeer::CA_TCALAICO)) $criteria->add(InoIngresosAirPeer::CA_TCALAICO, $this->ca_tcalaico);
		if ($this->isColumnModified(InoIngresosAirPeer::CA_FCHCREADO)) $criteria->add(InoIngresosAirPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(InoIngresosAirPeer::CA_USUCREADO)) $criteria->add(InoIngresosAirPeer::CA_USUCREADO, $this->ca_usucreado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(InoIngresosAirPeer::DATABASE_NAME);

		$criteria->add(InoIngresosAirPeer::CA_REFERENCIA, $this->ca_referencia);
		$criteria->add(InoIngresosAirPeer::CA_IDCLIENTE, $this->ca_idcliente);
		$criteria->add(InoIngresosAirPeer::CA_HAWB, $this->ca_hawb);
		$criteria->add(InoIngresosAirPeer::CA_FACTURA, $this->ca_factura);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaReferencia();

		$pks[1] = $this->getCaIdcliente();

		$pks[2] = $this->getCaHawb();

		$pks[3] = $this->getCaFactura();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaReferencia($keys[0]);

		$this->setCaIdcliente($keys[1]);

		$this->setCaHawb($keys[2]);

		$this->setCaFactura($keys[3]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaReferencia($this->ca_referencia);

		$copyObj->setCaIdcliente($this->ca_idcliente);

		$copyObj->setCaHawb($this->ca_hawb);

		$copyObj->setCaFactura($this->ca_factura);

		$copyObj->setCaFchfactura($this->ca_fchfactura);

		$copyObj->setCaValor($this->ca_valor);

		$copyObj->setCaReccaja($this->ca_reccaja);

		$copyObj->setCaFchpago($this->ca_fchpago);

		$copyObj->setCaTcalaico($this->ca_tcalaico);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);


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
			self::$peer = new InoIngresosAirPeer();
		}
		return self::$peer;
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
			$v->addInoIngresosAir($this);
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

	
	public function setCliente(Cliente $v = null)
	{
		if ($v === null) {
			$this->setCaIdcliente(NULL);
		} else {
			$this->setCaIdcliente($v->getCaIdcliente());
		}

		$this->aCliente = $v;

						if ($v !== null) {
			$v->addInoIngresosAir($this);
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
			$this->aInoMaestraAir = null;
			$this->aCliente = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseInoIngresosAir:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseInoIngresosAir::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 