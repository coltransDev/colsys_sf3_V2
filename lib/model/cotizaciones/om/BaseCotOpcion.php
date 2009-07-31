<?php


abstract class BaseCotOpcion extends BaseObject  implements Persistent {


  const PEER = 'CotOpcionPeer';

	
	protected static $peer;

	
	protected $ca_idopcion;

	
	protected $ca_idcotizacion;

	
	protected $ca_idproducto;

	
	protected $ca_idconcepto;

	
	protected $ca_valor_tar;

	
	protected $ca_aplica_tar;

	
	protected $ca_valor_min;

	
	protected $ca_aplica_min;

	
	protected $ca_idmoneda;

	
	protected $ca_recargos;

	
	protected $ca_observaciones;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_fchactualizado;

	
	protected $ca_usuactualizado;

	
	protected $ca_consecutivo;

	
	protected $aCotProducto;

	
	protected $aConcepto;

	
	protected $collCotRecargos;

	
	private $lastCotRecargoCriteria = null;

	
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

	
	public function getCaIdopcion()
	{
		return $this->ca_idopcion;
	}

	
	public function getCaIdcotizacion()
	{
		return $this->ca_idcotizacion;
	}

	
	public function getCaIdproducto()
	{
		return $this->ca_idproducto;
	}

	
	public function getCaIdconcepto()
	{
		return $this->ca_idconcepto;
	}

	
	public function getCaValorTar()
	{
		return $this->ca_valor_tar;
	}

	
	public function getCaAplicaTar()
	{
		return $this->ca_aplica_tar;
	}

	
	public function getCaValorMin()
	{
		return $this->ca_valor_min;
	}

	
	public function getCaAplicaMin()
	{
		return $this->ca_aplica_min;
	}

	
	public function getCaIdmoneda()
	{
		return $this->ca_idmoneda;
	}

	
	public function getCaRecargos()
	{
		return $this->ca_recargos;
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

	
	public function getCaConsecutivo()
	{
		return $this->ca_consecutivo;
	}

	
	public function setCaIdopcion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idopcion !== $v) {
			$this->ca_idopcion = $v;
			$this->modifiedColumns[] = CotOpcionPeer::CA_IDOPCION;
		}

		return $this;
	} 
	
	public function setCaIdcotizacion($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcotizacion !== $v) {
			$this->ca_idcotizacion = $v;
			$this->modifiedColumns[] = CotOpcionPeer::CA_IDCOTIZACION;
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
			$this->modifiedColumns[] = CotOpcionPeer::CA_IDPRODUCTO;
		}

		if ($this->aCotProducto !== null && $this->aCotProducto->getCaIdproducto() !== $v) {
			$this->aCotProducto = null;
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
			$this->modifiedColumns[] = CotOpcionPeer::CA_IDCONCEPTO;
		}

		if ($this->aConcepto !== null && $this->aConcepto->getCaIdconcepto() !== $v) {
			$this->aConcepto = null;
		}

		return $this;
	} 
	
	public function setCaValorTar($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_valor_tar !== $v) {
			$this->ca_valor_tar = $v;
			$this->modifiedColumns[] = CotOpcionPeer::CA_VALOR_TAR;
		}

		return $this;
	} 
	
	public function setCaAplicaTar($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_aplica_tar !== $v) {
			$this->ca_aplica_tar = $v;
			$this->modifiedColumns[] = CotOpcionPeer::CA_APLICA_TAR;
		}

		return $this;
	} 
	
	public function setCaValorMin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_valor_min !== $v) {
			$this->ca_valor_min = $v;
			$this->modifiedColumns[] = CotOpcionPeer::CA_VALOR_MIN;
		}

		return $this;
	} 
	
	public function setCaAplicaMin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_aplica_min !== $v) {
			$this->ca_aplica_min = $v;
			$this->modifiedColumns[] = CotOpcionPeer::CA_APLICA_MIN;
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
			$this->modifiedColumns[] = CotOpcionPeer::CA_IDMONEDA;
		}

		return $this;
	} 
	
	public function setCaRecargos($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_recargos !== $v) {
			$this->ca_recargos = $v;
			$this->modifiedColumns[] = CotOpcionPeer::CA_RECARGOS;
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
			$this->modifiedColumns[] = CotOpcionPeer::CA_OBSERVACIONES;
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
				$this->modifiedColumns[] = CotOpcionPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = CotOpcionPeer::CA_USUCREADO;
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
				$this->modifiedColumns[] = CotOpcionPeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = CotOpcionPeer::CA_USUACTUALIZADO;
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
			$this->modifiedColumns[] = CotOpcionPeer::CA_CONSECUTIVO;
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

			$this->ca_idopcion = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_idcotizacion = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_idproducto = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->ca_idconcepto = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->ca_valor_tar = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_aplica_tar = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_valor_min = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_aplica_min = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_idmoneda = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_recargos = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_observaciones = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_fchcreado = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_usucreado = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_fchactualizado = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_usuactualizado = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_consecutivo = ($row[$startcol + 15] !== null) ? (int) $row[$startcol + 15] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 16; 
		} catch (Exception $e) {
			throw new PropelException("Error populating CotOpcion object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aCotProducto !== null && $this->ca_idcotizacion !== $this->aCotProducto->getCaIdcotizacion()) {
			$this->aCotProducto = null;
		}
		if ($this->aCotProducto !== null && $this->ca_idproducto !== $this->aCotProducto->getCaIdproducto()) {
			$this->aCotProducto = null;
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
			$con = Propel::getConnection(CotOpcionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = CotOpcionPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aCotProducto = null;
			$this->aConcepto = null;
			$this->collCotRecargos = null;
			$this->lastCotRecargoCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotOpcion:delete:pre') as $callable)
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
			$con = Propel::getConnection(CotOpcionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			CotOpcionPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseCotOpcion:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotOpcion:save:pre') as $callable)
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
			$con = Propel::getConnection(CotOpcionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseCotOpcion:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			CotOpcionPeer::addInstanceToPool($this);
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

												
			if ($this->aCotProducto !== null) {
				if ($this->aCotProducto->isModified() || $this->aCotProducto->isNew()) {
					$affectedRows += $this->aCotProducto->save($con);
				}
				$this->setCotProducto($this->aCotProducto);
			}

			if ($this->aConcepto !== null) {
				if ($this->aConcepto->isModified() || $this->aConcepto->isNew()) {
					$affectedRows += $this->aConcepto->save($con);
				}
				$this->setConcepto($this->aConcepto);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = CotOpcionPeer::CA_IDOPCION;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CotOpcionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdopcion($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += CotOpcionPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collCotRecargos !== null) {
				foreach ($this->collCotRecargos as $referrerFK) {
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


												
			if ($this->aCotProducto !== null) {
				if (!$this->aCotProducto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCotProducto->getValidationFailures());
				}
			}

			if ($this->aConcepto !== null) {
				if (!$this->aConcepto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aConcepto->getValidationFailures());
				}
			}


			if (($retval = CotOpcionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collCotRecargos !== null) {
					foreach ($this->collCotRecargos as $referrerFK) {
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
		$pos = CotOpcionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdopcion();
				break;
			case 1:
				return $this->getCaIdcotizacion();
				break;
			case 2:
				return $this->getCaIdproducto();
				break;
			case 3:
				return $this->getCaIdconcepto();
				break;
			case 4:
				return $this->getCaValorTar();
				break;
			case 5:
				return $this->getCaAplicaTar();
				break;
			case 6:
				return $this->getCaValorMin();
				break;
			case 7:
				return $this->getCaAplicaMin();
				break;
			case 8:
				return $this->getCaIdmoneda();
				break;
			case 9:
				return $this->getCaRecargos();
				break;
			case 10:
				return $this->getCaObservaciones();
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
				return $this->getCaConsecutivo();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = CotOpcionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdopcion(),
			$keys[1] => $this->getCaIdcotizacion(),
			$keys[2] => $this->getCaIdproducto(),
			$keys[3] => $this->getCaIdconcepto(),
			$keys[4] => $this->getCaValorTar(),
			$keys[5] => $this->getCaAplicaTar(),
			$keys[6] => $this->getCaValorMin(),
			$keys[7] => $this->getCaAplicaMin(),
			$keys[8] => $this->getCaIdmoneda(),
			$keys[9] => $this->getCaRecargos(),
			$keys[10] => $this->getCaObservaciones(),
			$keys[11] => $this->getCaFchcreado(),
			$keys[12] => $this->getCaUsucreado(),
			$keys[13] => $this->getCaFchactualizado(),
			$keys[14] => $this->getCaUsuactualizado(),
			$keys[15] => $this->getCaConsecutivo(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CotOpcionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdopcion($value);
				break;
			case 1:
				$this->setCaIdcotizacion($value);
				break;
			case 2:
				$this->setCaIdproducto($value);
				break;
			case 3:
				$this->setCaIdconcepto($value);
				break;
			case 4:
				$this->setCaValorTar($value);
				break;
			case 5:
				$this->setCaAplicaTar($value);
				break;
			case 6:
				$this->setCaValorMin($value);
				break;
			case 7:
				$this->setCaAplicaMin($value);
				break;
			case 8:
				$this->setCaIdmoneda($value);
				break;
			case 9:
				$this->setCaRecargos($value);
				break;
			case 10:
				$this->setCaObservaciones($value);
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
				$this->setCaConsecutivo($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CotOpcionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdopcion($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdcotizacion($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdproducto($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaIdconcepto($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaValorTar($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaAplicaTar($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaValorMin($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaAplicaMin($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaIdmoneda($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaRecargos($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaObservaciones($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaFchcreado($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaUsucreado($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaFchactualizado($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaUsuactualizado($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaConsecutivo($arr[$keys[15]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CotOpcionPeer::DATABASE_NAME);

		if ($this->isColumnModified(CotOpcionPeer::CA_IDOPCION)) $criteria->add(CotOpcionPeer::CA_IDOPCION, $this->ca_idopcion);
		if ($this->isColumnModified(CotOpcionPeer::CA_IDCOTIZACION)) $criteria->add(CotOpcionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);
		if ($this->isColumnModified(CotOpcionPeer::CA_IDPRODUCTO)) $criteria->add(CotOpcionPeer::CA_IDPRODUCTO, $this->ca_idproducto);
		if ($this->isColumnModified(CotOpcionPeer::CA_IDCONCEPTO)) $criteria->add(CotOpcionPeer::CA_IDCONCEPTO, $this->ca_idconcepto);
		if ($this->isColumnModified(CotOpcionPeer::CA_VALOR_TAR)) $criteria->add(CotOpcionPeer::CA_VALOR_TAR, $this->ca_valor_tar);
		if ($this->isColumnModified(CotOpcionPeer::CA_APLICA_TAR)) $criteria->add(CotOpcionPeer::CA_APLICA_TAR, $this->ca_aplica_tar);
		if ($this->isColumnModified(CotOpcionPeer::CA_VALOR_MIN)) $criteria->add(CotOpcionPeer::CA_VALOR_MIN, $this->ca_valor_min);
		if ($this->isColumnModified(CotOpcionPeer::CA_APLICA_MIN)) $criteria->add(CotOpcionPeer::CA_APLICA_MIN, $this->ca_aplica_min);
		if ($this->isColumnModified(CotOpcionPeer::CA_IDMONEDA)) $criteria->add(CotOpcionPeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(CotOpcionPeer::CA_RECARGOS)) $criteria->add(CotOpcionPeer::CA_RECARGOS, $this->ca_recargos);
		if ($this->isColumnModified(CotOpcionPeer::CA_OBSERVACIONES)) $criteria->add(CotOpcionPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(CotOpcionPeer::CA_FCHCREADO)) $criteria->add(CotOpcionPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(CotOpcionPeer::CA_USUCREADO)) $criteria->add(CotOpcionPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(CotOpcionPeer::CA_FCHACTUALIZADO)) $criteria->add(CotOpcionPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(CotOpcionPeer::CA_USUACTUALIZADO)) $criteria->add(CotOpcionPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);
		if ($this->isColumnModified(CotOpcionPeer::CA_CONSECUTIVO)) $criteria->add(CotOpcionPeer::CA_CONSECUTIVO, $this->ca_consecutivo);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CotOpcionPeer::DATABASE_NAME);

		$criteria->add(CotOpcionPeer::CA_IDOPCION, $this->ca_idopcion);
		$criteria->add(CotOpcionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);
		$criteria->add(CotOpcionPeer::CA_IDPRODUCTO, $this->ca_idproducto);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaIdopcion();

		$pks[1] = $this->getCaIdcotizacion();

		$pks[2] = $this->getCaIdproducto();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaIdopcion($keys[0]);

		$this->setCaIdcotizacion($keys[1]);

		$this->setCaIdproducto($keys[2]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdcotizacion($this->ca_idcotizacion);

		$copyObj->setCaIdproducto($this->ca_idproducto);

		$copyObj->setCaIdconcepto($this->ca_idconcepto);

		$copyObj->setCaValorTar($this->ca_valor_tar);

		$copyObj->setCaAplicaTar($this->ca_aplica_tar);

		$copyObj->setCaValorMin($this->ca_valor_min);

		$copyObj->setCaAplicaMin($this->ca_aplica_min);

		$copyObj->setCaIdmoneda($this->ca_idmoneda);

		$copyObj->setCaRecargos($this->ca_recargos);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);

		$copyObj->setCaConsecutivo($this->ca_consecutivo);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getCotRecargos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addCotRecargo($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCaIdopcion(NULL); 
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
			self::$peer = new CotOpcionPeer();
		}
		return self::$peer;
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
			$v->addCotOpcion($this);
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

	
	public function setConcepto(Concepto $v = null)
	{
		if ($v === null) {
			$this->setCaIdconcepto(NULL);
		} else {
			$this->setCaIdconcepto($v->getCaIdconcepto());
		}

		$this->aConcepto = $v;

						if ($v !== null) {
			$v->addCotOpcion($this);
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

	
	public function clearCotRecargos()
	{
		$this->collCotRecargos = null; 	}

	
	public function initCotRecargos()
	{
		$this->collCotRecargos = array();
	}

	
	public function getCotRecargos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotOpcionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotRecargos === null) {
			if ($this->isNew()) {
			   $this->collCotRecargos = array();
			} else {

				$criteria->add(CotRecargoPeer::CA_IDOPCION, $this->ca_idopcion);

				CotRecargoPeer::addSelectColumns($criteria);
				$this->collCotRecargos = CotRecargoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotRecargoPeer::CA_IDOPCION, $this->ca_idopcion);

				CotRecargoPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotRecargoCriteria) || !$this->lastCotRecargoCriteria->equals($criteria)) {
					$this->collCotRecargos = CotRecargoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotRecargoCriteria = $criteria;
		return $this->collCotRecargos;
	}

	
	public function countCotRecargos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotOpcionPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCotRecargos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CotRecargoPeer::CA_IDOPCION, $this->ca_idopcion);

				$count = CotRecargoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotRecargoPeer::CA_IDOPCION, $this->ca_idopcion);

				if (!isset($this->lastCotRecargoCriteria) || !$this->lastCotRecargoCriteria->equals($criteria)) {
					$count = CotRecargoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCotRecargos);
				}
			} else {
				$count = count($this->collCotRecargos);
			}
		}
		return $count;
	}

	
	public function addCotRecargo(CotRecargo $l)
	{
		if ($this->collCotRecargos === null) {
			$this->initCotRecargos();
		}
		if (!in_array($l, $this->collCotRecargos, true)) { 			array_push($this->collCotRecargos, $l);
			$l->setCotOpcion($this);
		}
	}


	
	public function getCotRecargosJoinTipoRecargo($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotOpcionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotRecargos === null) {
			if ($this->isNew()) {
				$this->collCotRecargos = array();
			} else {

				$criteria->add(CotRecargoPeer::CA_IDOPCION, $this->ca_idopcion);

				$this->collCotRecargos = CotRecargoPeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(CotRecargoPeer::CA_IDOPCION, $this->ca_idopcion);

			if (!isset($this->lastCotRecargoCriteria) || !$this->lastCotRecargoCriteria->equals($criteria)) {
				$this->collCotRecargos = CotRecargoPeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotRecargoCriteria = $criteria;

		return $this->collCotRecargos;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collCotRecargos) {
				foreach ((array) $this->collCotRecargos as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collCotRecargos = null;
			$this->aCotProducto = null;
			$this->aConcepto = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseCotOpcion:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseCotOpcion::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 