<?php


abstract class BaseCotProducto extends BaseObject  implements Persistent {


  const PEER = 'CotProductoPeer';

	
	protected static $peer;

	
	protected $ca_idproducto;

	
	protected $ca_idcotizacion;

	
	protected $ca_transporte;

	
	protected $ca_modalidad;

	
	protected $ca_origen;

	
	protected $ca_destino;

	
	protected $ca_escala;

	
	protected $ca_impoexpo;

	
	protected $ca_imprimir;

	
	protected $ca_producto;

	
	protected $ca_incoterms;

	
	protected $ca_frecuencia;

	
	protected $ca_tiempotransito;

	
	protected $ca_locrecargos;

	
	protected $ca_observaciones;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_fchactualizado;

	
	protected $ca_usuactualizado;

	
	protected $ca_datosag;

	
	protected $ca_idlinea;

	
	protected $ca_postularlinea;

	
	protected $ca_etapa;

	
	protected $ca_idtarea;

	
	protected $aCotizacion;

	
	protected $aTransportador;

	
	protected $aNotTarea;

	
	protected $collCotOpcions;

	
	private $lastCotOpcionCriteria = null;

	
	protected $collCotSeguimientos;

	
	private $lastCotSeguimientoCriteria = null;

	
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

	
	public function getCaIdproducto()
	{
		return $this->ca_idproducto;
	}

	
	public function getCaIdcotizacion()
	{
		return $this->ca_idcotizacion;
	}

	
	public function getCaTransporte()
	{
		return $this->ca_transporte;
	}

	
	public function getCaModalidad()
	{
		return $this->ca_modalidad;
	}

	
	public function getCaOrigen()
	{
		return $this->ca_origen;
	}

	
	public function getCaDestino()
	{
		return $this->ca_destino;
	}

	
	public function getCaEscala()
	{
		return $this->ca_escala;
	}

	
	public function getCaImpoexpo()
	{
		return $this->ca_impoexpo;
	}

	
	public function getCaImprimir()
	{
		return $this->ca_imprimir;
	}

	
	public function getCaProducto()
	{
		return $this->ca_producto;
	}

	
	public function getCaIncoterms()
	{
		return $this->ca_incoterms;
	}

	
	public function getCaFrecuencia()
	{
		return $this->ca_frecuencia;
	}

	
	public function getCaTiempotransito()
	{
		return $this->ca_tiempotransito;
	}

	
	public function getCaLocrecargos()
	{
		return $this->ca_locrecargos;
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

	
	public function getCaDatosag()
	{
		return $this->ca_datosag;
	}

	
	public function getCaIdlinea()
	{
		return $this->ca_idlinea;
	}

	
	public function getCaPostularlinea()
	{
		return $this->ca_postularlinea;
	}

	
	public function getCaEtapa()
	{
		return $this->ca_etapa;
	}

	
	public function getCaIdtarea()
	{
		return $this->ca_idtarea;
	}

	
	public function setCaIdproducto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idproducto !== $v) {
			$this->ca_idproducto = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_IDPRODUCTO;
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
			$this->modifiedColumns[] = CotProductoPeer::CA_IDCOTIZACION;
		}

		if ($this->aCotizacion !== null && $this->aCotizacion->getCaIdcotizacion() !== $v) {
			$this->aCotizacion = null;
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
			$this->modifiedColumns[] = CotProductoPeer::CA_TRANSPORTE;
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
			$this->modifiedColumns[] = CotProductoPeer::CA_MODALIDAD;
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
			$this->modifiedColumns[] = CotProductoPeer::CA_ORIGEN;
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
			$this->modifiedColumns[] = CotProductoPeer::CA_DESTINO;
		}

		return $this;
	} 
	
	public function setCaEscala($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_escala !== $v) {
			$this->ca_escala = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_ESCALA;
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
			$this->modifiedColumns[] = CotProductoPeer::CA_IMPOEXPO;
		}

		return $this;
	} 
	
	public function setCaImprimir($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_imprimir !== $v) {
			$this->ca_imprimir = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_IMPRIMIR;
		}

		return $this;
	} 
	
	public function setCaProducto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_producto !== $v) {
			$this->ca_producto = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_PRODUCTO;
		}

		return $this;
	} 
	
	public function setCaIncoterms($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_incoterms !== $v) {
			$this->ca_incoterms = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_INCOTERMS;
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
			$this->modifiedColumns[] = CotProductoPeer::CA_FRECUENCIA;
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
			$this->modifiedColumns[] = CotProductoPeer::CA_TIEMPOTRANSITO;
		}

		return $this;
	} 
	
	public function setCaLocrecargos($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_locrecargos !== $v) {
			$this->ca_locrecargos = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_LOCRECARGOS;
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
			$this->modifiedColumns[] = CotProductoPeer::CA_OBSERVACIONES;
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
				$this->modifiedColumns[] = CotProductoPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = CotProductoPeer::CA_USUCREADO;
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
				$this->modifiedColumns[] = CotProductoPeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = CotProductoPeer::CA_USUACTUALIZADO;
		}

		return $this;
	} 
	
	public function setCaDatosag($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_datosag !== $v) {
			$this->ca_datosag = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_DATOSAG;
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
			$this->modifiedColumns[] = CotProductoPeer::CA_IDLINEA;
		}

		if ($this->aTransportador !== null && $this->aTransportador->getCaIdlinea() !== $v) {
			$this->aTransportador = null;
		}

		return $this;
	} 
	
	public function setCaPostularlinea($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_postularlinea !== $v) {
			$this->ca_postularlinea = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_POSTULARLINEA;
		}

		return $this;
	} 
	
	public function setCaEtapa($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_etapa !== $v) {
			$this->ca_etapa = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_ETAPA;
		}

		return $this;
	} 
	
	public function setCaIdtarea($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idtarea !== $v) {
			$this->ca_idtarea = $v;
			$this->modifiedColumns[] = CotProductoPeer::CA_IDTAREA;
		}

		if ($this->aNotTarea !== null && $this->aNotTarea->getCaIdtarea() !== $v) {
			$this->aNotTarea = null;
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

			$this->ca_idproducto = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idcotizacion = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_transporte = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_modalidad = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_origen = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_destino = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_escala = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_impoexpo = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_imprimir = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_producto = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_incoterms = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_frecuencia = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_tiempotransito = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_locrecargos = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_observaciones = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_fchcreado = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_usucreado = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->ca_fchactualizado = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
			$this->ca_usuactualizado = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
			$this->ca_datosag = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
			$this->ca_idlinea = ($row[$startcol + 20] !== null) ? (int) $row[$startcol + 20] : null;
			$this->ca_postularlinea = ($row[$startcol + 21] !== null) ? (boolean) $row[$startcol + 21] : null;
			$this->ca_etapa = ($row[$startcol + 22] !== null) ? (string) $row[$startcol + 22] : null;
			$this->ca_idtarea = ($row[$startcol + 23] !== null) ? (int) $row[$startcol + 23] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 24; 
		} catch (Exception $e) {
			throw new PropelException("Error populating CotProducto object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aCotizacion !== null && $this->ca_idcotizacion !== $this->aCotizacion->getCaIdcotizacion()) {
			$this->aCotizacion = null;
		}
		if ($this->aTransportador !== null && $this->ca_idlinea !== $this->aTransportador->getCaIdlinea()) {
			$this->aTransportador = null;
		}
		if ($this->aNotTarea !== null && $this->ca_idtarea !== $this->aNotTarea->getCaIdtarea()) {
			$this->aNotTarea = null;
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
			$con = Propel::getConnection(CotProductoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = CotProductoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aCotizacion = null;
			$this->aTransportador = null;
			$this->aNotTarea = null;
			$this->collCotOpcions = null;
			$this->lastCotOpcionCriteria = null;

			$this->collCotSeguimientos = null;
			$this->lastCotSeguimientoCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotProducto:delete:pre') as $callable)
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
			$con = Propel::getConnection(CotProductoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			CotProductoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseCotProducto:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotProducto:save:pre') as $callable)
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
			$con = Propel::getConnection(CotProductoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseCotProducto:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			CotProductoPeer::addInstanceToPool($this);
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

												
			if ($this->aCotizacion !== null) {
				if ($this->aCotizacion->isModified() || $this->aCotizacion->isNew()) {
					$affectedRows += $this->aCotizacion->save($con);
				}
				$this->setCotizacion($this->aCotizacion);
			}

			if ($this->aTransportador !== null) {
				if ($this->aTransportador->isModified() || $this->aTransportador->isNew()) {
					$affectedRows += $this->aTransportador->save($con);
				}
				$this->setTransportador($this->aTransportador);
			}

			if ($this->aNotTarea !== null) {
				if ($this->aNotTarea->isModified() || $this->aNotTarea->isNew()) {
					$affectedRows += $this->aNotTarea->save($con);
				}
				$this->setNotTarea($this->aNotTarea);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = CotProductoPeer::CA_IDPRODUCTO;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CotProductoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdproducto($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += CotProductoPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collCotOpcions !== null) {
				foreach ($this->collCotOpcions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCotSeguimientos !== null) {
				foreach ($this->collCotSeguimientos as $referrerFK) {
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


												
			if ($this->aCotizacion !== null) {
				if (!$this->aCotizacion->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCotizacion->getValidationFailures());
				}
			}

			if ($this->aTransportador !== null) {
				if (!$this->aTransportador->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTransportador->getValidationFailures());
				}
			}

			if ($this->aNotTarea !== null) {
				if (!$this->aNotTarea->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aNotTarea->getValidationFailures());
				}
			}


			if (($retval = CotProductoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collCotOpcions !== null) {
					foreach ($this->collCotOpcions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCotSeguimientos !== null) {
					foreach ($this->collCotSeguimientos as $referrerFK) {
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
		$pos = CotProductoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdproducto();
				break;
			case 1:
				return $this->getCaIdcotizacion();
				break;
			case 2:
				return $this->getCaTransporte();
				break;
			case 3:
				return $this->getCaModalidad();
				break;
			case 4:
				return $this->getCaOrigen();
				break;
			case 5:
				return $this->getCaDestino();
				break;
			case 6:
				return $this->getCaEscala();
				break;
			case 7:
				return $this->getCaImpoexpo();
				break;
			case 8:
				return $this->getCaImprimir();
				break;
			case 9:
				return $this->getCaProducto();
				break;
			case 10:
				return $this->getCaIncoterms();
				break;
			case 11:
				return $this->getCaFrecuencia();
				break;
			case 12:
				return $this->getCaTiempotransito();
				break;
			case 13:
				return $this->getCaLocrecargos();
				break;
			case 14:
				return $this->getCaObservaciones();
				break;
			case 15:
				return $this->getCaFchcreado();
				break;
			case 16:
				return $this->getCaUsucreado();
				break;
			case 17:
				return $this->getCaFchactualizado();
				break;
			case 18:
				return $this->getCaUsuactualizado();
				break;
			case 19:
				return $this->getCaDatosag();
				break;
			case 20:
				return $this->getCaIdlinea();
				break;
			case 21:
				return $this->getCaPostularlinea();
				break;
			case 22:
				return $this->getCaEtapa();
				break;
			case 23:
				return $this->getCaIdtarea();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = CotProductoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdproducto(),
			$keys[1] => $this->getCaIdcotizacion(),
			$keys[2] => $this->getCaTransporte(),
			$keys[3] => $this->getCaModalidad(),
			$keys[4] => $this->getCaOrigen(),
			$keys[5] => $this->getCaDestino(),
			$keys[6] => $this->getCaEscala(),
			$keys[7] => $this->getCaImpoexpo(),
			$keys[8] => $this->getCaImprimir(),
			$keys[9] => $this->getCaProducto(),
			$keys[10] => $this->getCaIncoterms(),
			$keys[11] => $this->getCaFrecuencia(),
			$keys[12] => $this->getCaTiempotransito(),
			$keys[13] => $this->getCaLocrecargos(),
			$keys[14] => $this->getCaObservaciones(),
			$keys[15] => $this->getCaFchcreado(),
			$keys[16] => $this->getCaUsucreado(),
			$keys[17] => $this->getCaFchactualizado(),
			$keys[18] => $this->getCaUsuactualizado(),
			$keys[19] => $this->getCaDatosag(),
			$keys[20] => $this->getCaIdlinea(),
			$keys[21] => $this->getCaPostularlinea(),
			$keys[22] => $this->getCaEtapa(),
			$keys[23] => $this->getCaIdtarea(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CotProductoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdproducto($value);
				break;
			case 1:
				$this->setCaIdcotizacion($value);
				break;
			case 2:
				$this->setCaTransporte($value);
				break;
			case 3:
				$this->setCaModalidad($value);
				break;
			case 4:
				$this->setCaOrigen($value);
				break;
			case 5:
				$this->setCaDestino($value);
				break;
			case 6:
				$this->setCaEscala($value);
				break;
			case 7:
				$this->setCaImpoexpo($value);
				break;
			case 8:
				$this->setCaImprimir($value);
				break;
			case 9:
				$this->setCaProducto($value);
				break;
			case 10:
				$this->setCaIncoterms($value);
				break;
			case 11:
				$this->setCaFrecuencia($value);
				break;
			case 12:
				$this->setCaTiempotransito($value);
				break;
			case 13:
				$this->setCaLocrecargos($value);
				break;
			case 14:
				$this->setCaObservaciones($value);
				break;
			case 15:
				$this->setCaFchcreado($value);
				break;
			case 16:
				$this->setCaUsucreado($value);
				break;
			case 17:
				$this->setCaFchactualizado($value);
				break;
			case 18:
				$this->setCaUsuactualizado($value);
				break;
			case 19:
				$this->setCaDatosag($value);
				break;
			case 20:
				$this->setCaIdlinea($value);
				break;
			case 21:
				$this->setCaPostularlinea($value);
				break;
			case 22:
				$this->setCaEtapa($value);
				break;
			case 23:
				$this->setCaIdtarea($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CotProductoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdproducto($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdcotizacion($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaTransporte($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaModalidad($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaOrigen($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaDestino($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaEscala($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaImpoexpo($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaImprimir($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaProducto($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaIncoterms($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaFrecuencia($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaTiempotransito($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaLocrecargos($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaObservaciones($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaFchcreado($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaUsucreado($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaFchactualizado($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCaUsuactualizado($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setCaDatosag($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCaIdlinea($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setCaPostularlinea($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setCaEtapa($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setCaIdtarea($arr[$keys[23]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CotProductoPeer::DATABASE_NAME);

		if ($this->isColumnModified(CotProductoPeer::CA_IDPRODUCTO)) $criteria->add(CotProductoPeer::CA_IDPRODUCTO, $this->ca_idproducto);
		if ($this->isColumnModified(CotProductoPeer::CA_IDCOTIZACION)) $criteria->add(CotProductoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);
		if ($this->isColumnModified(CotProductoPeer::CA_TRANSPORTE)) $criteria->add(CotProductoPeer::CA_TRANSPORTE, $this->ca_transporte);
		if ($this->isColumnModified(CotProductoPeer::CA_MODALIDAD)) $criteria->add(CotProductoPeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(CotProductoPeer::CA_ORIGEN)) $criteria->add(CotProductoPeer::CA_ORIGEN, $this->ca_origen);
		if ($this->isColumnModified(CotProductoPeer::CA_DESTINO)) $criteria->add(CotProductoPeer::CA_DESTINO, $this->ca_destino);
		if ($this->isColumnModified(CotProductoPeer::CA_ESCALA)) $criteria->add(CotProductoPeer::CA_ESCALA, $this->ca_escala);
		if ($this->isColumnModified(CotProductoPeer::CA_IMPOEXPO)) $criteria->add(CotProductoPeer::CA_IMPOEXPO, $this->ca_impoexpo);
		if ($this->isColumnModified(CotProductoPeer::CA_IMPRIMIR)) $criteria->add(CotProductoPeer::CA_IMPRIMIR, $this->ca_imprimir);
		if ($this->isColumnModified(CotProductoPeer::CA_PRODUCTO)) $criteria->add(CotProductoPeer::CA_PRODUCTO, $this->ca_producto);
		if ($this->isColumnModified(CotProductoPeer::CA_INCOTERMS)) $criteria->add(CotProductoPeer::CA_INCOTERMS, $this->ca_incoterms);
		if ($this->isColumnModified(CotProductoPeer::CA_FRECUENCIA)) $criteria->add(CotProductoPeer::CA_FRECUENCIA, $this->ca_frecuencia);
		if ($this->isColumnModified(CotProductoPeer::CA_TIEMPOTRANSITO)) $criteria->add(CotProductoPeer::CA_TIEMPOTRANSITO, $this->ca_tiempotransito);
		if ($this->isColumnModified(CotProductoPeer::CA_LOCRECARGOS)) $criteria->add(CotProductoPeer::CA_LOCRECARGOS, $this->ca_locrecargos);
		if ($this->isColumnModified(CotProductoPeer::CA_OBSERVACIONES)) $criteria->add(CotProductoPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(CotProductoPeer::CA_FCHCREADO)) $criteria->add(CotProductoPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(CotProductoPeer::CA_USUCREADO)) $criteria->add(CotProductoPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(CotProductoPeer::CA_FCHACTUALIZADO)) $criteria->add(CotProductoPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(CotProductoPeer::CA_USUACTUALIZADO)) $criteria->add(CotProductoPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);
		if ($this->isColumnModified(CotProductoPeer::CA_DATOSAG)) $criteria->add(CotProductoPeer::CA_DATOSAG, $this->ca_datosag);
		if ($this->isColumnModified(CotProductoPeer::CA_IDLINEA)) $criteria->add(CotProductoPeer::CA_IDLINEA, $this->ca_idlinea);
		if ($this->isColumnModified(CotProductoPeer::CA_POSTULARLINEA)) $criteria->add(CotProductoPeer::CA_POSTULARLINEA, $this->ca_postularlinea);
		if ($this->isColumnModified(CotProductoPeer::CA_ETAPA)) $criteria->add(CotProductoPeer::CA_ETAPA, $this->ca_etapa);
		if ($this->isColumnModified(CotProductoPeer::CA_IDTAREA)) $criteria->add(CotProductoPeer::CA_IDTAREA, $this->ca_idtarea);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CotProductoPeer::DATABASE_NAME);

		$criteria->add(CotProductoPeer::CA_IDPRODUCTO, $this->ca_idproducto);
		$criteria->add(CotProductoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaIdproducto();

		$pks[1] = $this->getCaIdcotizacion();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaIdproducto($keys[0]);

		$this->setCaIdcotizacion($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdcotizacion($this->ca_idcotizacion);

		$copyObj->setCaTransporte($this->ca_transporte);

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaOrigen($this->ca_origen);

		$copyObj->setCaDestino($this->ca_destino);

		$copyObj->setCaEscala($this->ca_escala);

		$copyObj->setCaImpoexpo($this->ca_impoexpo);

		$copyObj->setCaImprimir($this->ca_imprimir);

		$copyObj->setCaProducto($this->ca_producto);

		$copyObj->setCaIncoterms($this->ca_incoterms);

		$copyObj->setCaFrecuencia($this->ca_frecuencia);

		$copyObj->setCaTiempotransito($this->ca_tiempotransito);

		$copyObj->setCaLocrecargos($this->ca_locrecargos);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);

		$copyObj->setCaDatosag($this->ca_datosag);

		$copyObj->setCaIdlinea($this->ca_idlinea);

		$copyObj->setCaPostularlinea($this->ca_postularlinea);

		$copyObj->setCaEtapa($this->ca_etapa);

		$copyObj->setCaIdtarea($this->ca_idtarea);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getCotOpcions() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addCotOpcion($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getCotSeguimientos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addCotSeguimiento($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCaIdproducto(NULL); 
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
			self::$peer = new CotProductoPeer();
		}
		return self::$peer;
	}

	
	public function setCotizacion(Cotizacion $v = null)
	{
		if ($v === null) {
			$this->setCaIdcotizacion(NULL);
		} else {
			$this->setCaIdcotizacion($v->getCaIdcotizacion());
		}

		$this->aCotizacion = $v;

						if ($v !== null) {
			$v->addCotProducto($this);
		}

		return $this;
	}


	
	public function getCotizacion(PropelPDO $con = null)
	{
		if ($this->aCotizacion === null && ($this->ca_idcotizacion !== null)) {
			$c = new Criteria(CotizacionPeer::DATABASE_NAME);
			$c->add(CotizacionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);
			$this->aCotizacion = CotizacionPeer::doSelectOne($c, $con);
			
		}
		return $this->aCotizacion;
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
			$v->addCotProducto($this);
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

	
	public function setNotTarea(NotTarea $v = null)
	{
		if ($v === null) {
			$this->setCaIdtarea(NULL);
		} else {
			$this->setCaIdtarea($v->getCaIdtarea());
		}

		$this->aNotTarea = $v;

						if ($v !== null) {
			$v->addCotProducto($this);
		}

		return $this;
	}


	
	public function getNotTarea(PropelPDO $con = null)
	{
		if ($this->aNotTarea === null && ($this->ca_idtarea !== null)) {
			$c = new Criteria(NotTareaPeer::DATABASE_NAME);
			$c->add(NotTareaPeer::CA_IDTAREA, $this->ca_idtarea);
			$this->aNotTarea = NotTareaPeer::doSelectOne($c, $con);
			
		}
		return $this->aNotTarea;
	}

	
	public function clearCotOpcions()
	{
		$this->collCotOpcions = null; 	}

	
	public function initCotOpcions()
	{
		$this->collCotOpcions = array();
	}

	
	public function getCotOpcions($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotProductoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotOpcions === null) {
			if ($this->isNew()) {
			   $this->collCotOpcions = array();
			} else {

				$criteria->add(CotOpcionPeer::CA_IDPRODUCTO, $this->ca_idproducto);

				$criteria->add(CotOpcionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				CotOpcionPeer::addSelectColumns($criteria);
				$this->collCotOpcions = CotOpcionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotOpcionPeer::CA_IDPRODUCTO, $this->ca_idproducto);


				$criteria->add(CotOpcionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				CotOpcionPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotOpcionCriteria) || !$this->lastCotOpcionCriteria->equals($criteria)) {
					$this->collCotOpcions = CotOpcionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotOpcionCriteria = $criteria;
		return $this->collCotOpcions;
	}

	
	public function countCotOpcions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotProductoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCotOpcions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CotOpcionPeer::CA_IDPRODUCTO, $this->ca_idproducto);

				$criteria->add(CotOpcionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				$count = CotOpcionPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotOpcionPeer::CA_IDPRODUCTO, $this->ca_idproducto);


				$criteria->add(CotOpcionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				if (!isset($this->lastCotOpcionCriteria) || !$this->lastCotOpcionCriteria->equals($criteria)) {
					$count = CotOpcionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCotOpcions);
				}
			} else {
				$count = count($this->collCotOpcions);
			}
		}
		return $count;
	}

	
	public function addCotOpcion(CotOpcion $l)
	{
		if ($this->collCotOpcions === null) {
			$this->initCotOpcions();
		}
		if (!in_array($l, $this->collCotOpcions, true)) { 			array_push($this->collCotOpcions, $l);
			$l->setCotProducto($this);
		}
	}


	
	public function getCotOpcionsJoinConcepto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotProductoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotOpcions === null) {
			if ($this->isNew()) {
				$this->collCotOpcions = array();
			} else {

				$criteria->add(CotOpcionPeer::CA_IDPRODUCTO, $this->ca_idproducto);

				$criteria->add(CotOpcionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				$this->collCotOpcions = CotOpcionPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(CotOpcionPeer::CA_IDPRODUCTO, $this->ca_idproducto);

			$criteria->add(CotOpcionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

			if (!isset($this->lastCotOpcionCriteria) || !$this->lastCotOpcionCriteria->equals($criteria)) {
				$this->collCotOpcions = CotOpcionPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotOpcionCriteria = $criteria;

		return $this->collCotOpcions;
	}

	
	public function clearCotSeguimientos()
	{
		$this->collCotSeguimientos = null; 	}

	
	public function initCotSeguimientos()
	{
		$this->collCotSeguimientos = array();
	}

	
	public function getCotSeguimientos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotProductoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotSeguimientos === null) {
			if ($this->isNew()) {
			   $this->collCotSeguimientos = array();
			} else {

				$criteria->add(CotSeguimientoPeer::CA_IDPRODUCTO, $this->ca_idproducto);

				$criteria->add(CotSeguimientoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				CotSeguimientoPeer::addSelectColumns($criteria);
				$this->collCotSeguimientos = CotSeguimientoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotSeguimientoPeer::CA_IDPRODUCTO, $this->ca_idproducto);


				$criteria->add(CotSeguimientoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				CotSeguimientoPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotSeguimientoCriteria) || !$this->lastCotSeguimientoCriteria->equals($criteria)) {
					$this->collCotSeguimientos = CotSeguimientoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotSeguimientoCriteria = $criteria;
		return $this->collCotSeguimientos;
	}

	
	public function countCotSeguimientos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotProductoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCotSeguimientos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CotSeguimientoPeer::CA_IDPRODUCTO, $this->ca_idproducto);

				$criteria->add(CotSeguimientoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				$count = CotSeguimientoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotSeguimientoPeer::CA_IDPRODUCTO, $this->ca_idproducto);


				$criteria->add(CotSeguimientoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				if (!isset($this->lastCotSeguimientoCriteria) || !$this->lastCotSeguimientoCriteria->equals($criteria)) {
					$count = CotSeguimientoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCotSeguimientos);
				}
			} else {
				$count = count($this->collCotSeguimientos);
			}
		}
		return $count;
	}

	
	public function addCotSeguimiento(CotSeguimiento $l)
	{
		if ($this->collCotSeguimientos === null) {
			$this->initCotSeguimientos();
		}
		if (!in_array($l, $this->collCotSeguimientos, true)) { 			array_push($this->collCotSeguimientos, $l);
			$l->setCotProducto($this);
		}
	}


	
	public function getCotSeguimientosJoinCotizacion($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotProductoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotSeguimientos === null) {
			if ($this->isNew()) {
				$this->collCotSeguimientos = array();
			} else {

				$criteria->add(CotSeguimientoPeer::CA_IDPRODUCTO, $this->ca_idproducto);

				$criteria->add(CotSeguimientoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				$this->collCotSeguimientos = CotSeguimientoPeer::doSelectJoinCotizacion($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(CotSeguimientoPeer::CA_IDPRODUCTO, $this->ca_idproducto);

			$criteria->add(CotSeguimientoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

			if (!isset($this->lastCotSeguimientoCriteria) || !$this->lastCotSeguimientoCriteria->equals($criteria)) {
				$this->collCotSeguimientos = CotSeguimientoPeer::doSelectJoinCotizacion($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotSeguimientoCriteria = $criteria;

		return $this->collCotSeguimientos;
	}


	
	public function getCotSeguimientosJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotProductoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotSeguimientos === null) {
			if ($this->isNew()) {
				$this->collCotSeguimientos = array();
			} else {

				$criteria->add(CotSeguimientoPeer::CA_IDPRODUCTO, $this->ca_idproducto);

				$criteria->add(CotSeguimientoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				$this->collCotSeguimientos = CotSeguimientoPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(CotSeguimientoPeer::CA_IDPRODUCTO, $this->ca_idproducto);

			$criteria->add(CotSeguimientoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

			if (!isset($this->lastCotSeguimientoCriteria) || !$this->lastCotSeguimientoCriteria->equals($criteria)) {
				$this->collCotSeguimientos = CotSeguimientoPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotSeguimientoCriteria = $criteria;

		return $this->collCotSeguimientos;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collCotOpcions) {
				foreach ((array) $this->collCotOpcions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCotSeguimientos) {
				foreach ((array) $this->collCotSeguimientos as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collCotOpcions = null;
		$this->collCotSeguimientos = null;
			$this->aCotizacion = null;
			$this->aTransportador = null;
			$this->aNotTarea = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseCotProducto:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseCotProducto::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 