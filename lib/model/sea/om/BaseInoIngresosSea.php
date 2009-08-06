<?php


abstract class BaseInoIngresosSea extends BaseObject  implements Persistent {


  const PEER = 'InoIngresosSeaPeer';

	
	protected static $peer;

	
	protected $ca_referencia;

	
	protected $ca_idcliente;

	
	protected $ca_hbls;

	
	protected $ca_factura;

	
	protected $ca_fchfactura;

	
	protected $ca_idmoneda;

	
	protected $ca_neto;

	
	protected $ca_valor;

	
	protected $ca_reccaja;

	
	protected $ca_fchpago;

	
	protected $ca_tcambio;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_fchactualizado;

	
	protected $ca_usuactualizado;

	
	protected $ca_observaciones;

	
	protected $aInoMaestraSea;

	
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

	
	public function getCaHbls()
	{
		return $this->ca_hbls;
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

	
	public function getCaIdmoneda()
	{
		return $this->ca_idmoneda;
	}

	
	public function getCaNeto()
	{
		return $this->ca_neto;
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

	
	public function getCaTcambio()
	{
		return $this->ca_tcambio;
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

	
	public function getCaObservaciones()
	{
		return $this->ca_observaciones;
	}

	
	public function setCaReferencia($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_referencia !== $v) {
			$this->ca_referencia = $v;
			$this->modifiedColumns[] = InoIngresosSeaPeer::CA_REFERENCIA;
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
			$this->modifiedColumns[] = InoIngresosSeaPeer::CA_IDCLIENTE;
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
			$this->modifiedColumns[] = InoIngresosSeaPeer::CA_HBLS;
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
			$this->modifiedColumns[] = InoIngresosSeaPeer::CA_FACTURA;
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
				$this->modifiedColumns[] = InoIngresosSeaPeer::CA_FCHFACTURA;
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
			$this->modifiedColumns[] = InoIngresosSeaPeer::CA_IDMONEDA;
		}

		return $this;
	} 
	
	public function setCaNeto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_neto !== $v) {
			$this->ca_neto = $v;
			$this->modifiedColumns[] = InoIngresosSeaPeer::CA_NETO;
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
			$this->modifiedColumns[] = InoIngresosSeaPeer::CA_VALOR;
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
			$this->modifiedColumns[] = InoIngresosSeaPeer::CA_RECCAJA;
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
				$this->modifiedColumns[] = InoIngresosSeaPeer::CA_FCHPAGO;
			}
		} 
		return $this;
	} 
	
	public function setCaTcambio($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_tcambio !== $v) {
			$this->ca_tcambio = $v;
			$this->modifiedColumns[] = InoIngresosSeaPeer::CA_TCAMBIO;
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
				$this->modifiedColumns[] = InoIngresosSeaPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = InoIngresosSeaPeer::CA_USUCREADO;
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
				$this->modifiedColumns[] = InoIngresosSeaPeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = InoIngresosSeaPeer::CA_USUACTUALIZADO;
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
			$this->modifiedColumns[] = InoIngresosSeaPeer::CA_OBSERVACIONES;
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
			$this->ca_factura = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_fchfactura = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_idmoneda = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_neto = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_valor = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_reccaja = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_fchpago = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_tcambio = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_fchcreado = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_usucreado = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_fchactualizado = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_usuactualizado = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_observaciones = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 16; 
		} catch (Exception $e) {
			throw new PropelException("Error populating InoIngresosSea object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aInoMaestraSea !== null && $this->ca_referencia !== $this->aInoMaestraSea->getCaReferencia()) {
			$this->aInoMaestraSea = null;
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
			$con = Propel::getConnection(InoIngresosSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = InoIngresosSeaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aInoMaestraSea = null;
			$this->aCliente = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoIngresosSea:delete:pre') as $callable)
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
			$con = Propel::getConnection(InoIngresosSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			InoIngresosSeaPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseInoIngresosSea:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoIngresosSea:save:pre') as $callable)
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
			$con = Propel::getConnection(InoIngresosSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseInoIngresosSea:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			InoIngresosSeaPeer::addInstanceToPool($this);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = InoIngresosSeaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += InoIngresosSeaPeer::doUpdate($this, $con);
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


			if (($retval = InoIngresosSeaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InoIngresosSeaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaFactura();
				break;
			case 4:
				return $this->getCaFchfactura();
				break;
			case 5:
				return $this->getCaIdmoneda();
				break;
			case 6:
				return $this->getCaNeto();
				break;
			case 7:
				return $this->getCaValor();
				break;
			case 8:
				return $this->getCaReccaja();
				break;
			case 9:
				return $this->getCaFchpago();
				break;
			case 10:
				return $this->getCaTcambio();
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
				return $this->getCaObservaciones();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = InoIngresosSeaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaReferencia(),
			$keys[1] => $this->getCaIdcliente(),
			$keys[2] => $this->getCaHbls(),
			$keys[3] => $this->getCaFactura(),
			$keys[4] => $this->getCaFchfactura(),
			$keys[5] => $this->getCaIdmoneda(),
			$keys[6] => $this->getCaNeto(),
			$keys[7] => $this->getCaValor(),
			$keys[8] => $this->getCaReccaja(),
			$keys[9] => $this->getCaFchpago(),
			$keys[10] => $this->getCaTcambio(),
			$keys[11] => $this->getCaFchcreado(),
			$keys[12] => $this->getCaUsucreado(),
			$keys[13] => $this->getCaFchactualizado(),
			$keys[14] => $this->getCaUsuactualizado(),
			$keys[15] => $this->getCaObservaciones(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InoIngresosSeaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaFactura($value);
				break;
			case 4:
				$this->setCaFchfactura($value);
				break;
			case 5:
				$this->setCaIdmoneda($value);
				break;
			case 6:
				$this->setCaNeto($value);
				break;
			case 7:
				$this->setCaValor($value);
				break;
			case 8:
				$this->setCaReccaja($value);
				break;
			case 9:
				$this->setCaFchpago($value);
				break;
			case 10:
				$this->setCaTcambio($value);
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
				$this->setCaObservaciones($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InoIngresosSeaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaReferencia($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdcliente($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaHbls($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaFactura($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaFchfactura($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaIdmoneda($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaNeto($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaValor($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaReccaja($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaFchpago($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaTcambio($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaFchcreado($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaUsucreado($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaFchactualizado($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaUsuactualizado($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaObservaciones($arr[$keys[15]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(InoIngresosSeaPeer::DATABASE_NAME);

		if ($this->isColumnModified(InoIngresosSeaPeer::CA_REFERENCIA)) $criteria->add(InoIngresosSeaPeer::CA_REFERENCIA, $this->ca_referencia);
		if ($this->isColumnModified(InoIngresosSeaPeer::CA_IDCLIENTE)) $criteria->add(InoIngresosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);
		if ($this->isColumnModified(InoIngresosSeaPeer::CA_HBLS)) $criteria->add(InoIngresosSeaPeer::CA_HBLS, $this->ca_hbls);
		if ($this->isColumnModified(InoIngresosSeaPeer::CA_FACTURA)) $criteria->add(InoIngresosSeaPeer::CA_FACTURA, $this->ca_factura);
		if ($this->isColumnModified(InoIngresosSeaPeer::CA_FCHFACTURA)) $criteria->add(InoIngresosSeaPeer::CA_FCHFACTURA, $this->ca_fchfactura);
		if ($this->isColumnModified(InoIngresosSeaPeer::CA_IDMONEDA)) $criteria->add(InoIngresosSeaPeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(InoIngresosSeaPeer::CA_NETO)) $criteria->add(InoIngresosSeaPeer::CA_NETO, $this->ca_neto);
		if ($this->isColumnModified(InoIngresosSeaPeer::CA_VALOR)) $criteria->add(InoIngresosSeaPeer::CA_VALOR, $this->ca_valor);
		if ($this->isColumnModified(InoIngresosSeaPeer::CA_RECCAJA)) $criteria->add(InoIngresosSeaPeer::CA_RECCAJA, $this->ca_reccaja);
		if ($this->isColumnModified(InoIngresosSeaPeer::CA_FCHPAGO)) $criteria->add(InoIngresosSeaPeer::CA_FCHPAGO, $this->ca_fchpago);
		if ($this->isColumnModified(InoIngresosSeaPeer::CA_TCAMBIO)) $criteria->add(InoIngresosSeaPeer::CA_TCAMBIO, $this->ca_tcambio);
		if ($this->isColumnModified(InoIngresosSeaPeer::CA_FCHCREADO)) $criteria->add(InoIngresosSeaPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(InoIngresosSeaPeer::CA_USUCREADO)) $criteria->add(InoIngresosSeaPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(InoIngresosSeaPeer::CA_FCHACTUALIZADO)) $criteria->add(InoIngresosSeaPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(InoIngresosSeaPeer::CA_USUACTUALIZADO)) $criteria->add(InoIngresosSeaPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);
		if ($this->isColumnModified(InoIngresosSeaPeer::CA_OBSERVACIONES)) $criteria->add(InoIngresosSeaPeer::CA_OBSERVACIONES, $this->ca_observaciones);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(InoIngresosSeaPeer::DATABASE_NAME);

		$criteria->add(InoIngresosSeaPeer::CA_REFERENCIA, $this->ca_referencia);
		$criteria->add(InoIngresosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);
		$criteria->add(InoIngresosSeaPeer::CA_HBLS, $this->ca_hbls);
		$criteria->add(InoIngresosSeaPeer::CA_FACTURA, $this->ca_factura);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaReferencia();

		$pks[1] = $this->getCaIdcliente();

		$pks[2] = $this->getCaHbls();

		$pks[3] = $this->getCaFactura();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaReferencia($keys[0]);

		$this->setCaIdcliente($keys[1]);

		$this->setCaHbls($keys[2]);

		$this->setCaFactura($keys[3]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaReferencia($this->ca_referencia);

		$copyObj->setCaIdcliente($this->ca_idcliente);

		$copyObj->setCaHbls($this->ca_hbls);

		$copyObj->setCaFactura($this->ca_factura);

		$copyObj->setCaFchfactura($this->ca_fchfactura);

		$copyObj->setCaIdmoneda($this->ca_idmoneda);

		$copyObj->setCaNeto($this->ca_neto);

		$copyObj->setCaValor($this->ca_valor);

		$copyObj->setCaReccaja($this->ca_reccaja);

		$copyObj->setCaFchpago($this->ca_fchpago);

		$copyObj->setCaTcambio($this->ca_tcambio);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);

		$copyObj->setCaObservaciones($this->ca_observaciones);


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
			self::$peer = new InoIngresosSeaPeer();
		}
		return self::$peer;
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
			$v->addInoIngresosSea($this);
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
			$v->addInoIngresosSea($this);
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
			$this->aInoMaestraSea = null;
			$this->aCliente = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseInoIngresosSea:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseInoIngresosSea::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 