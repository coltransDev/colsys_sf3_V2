<?php


abstract class BaseNotTarea extends BaseObject  implements Persistent {


  const PEER = 'NotTareaPeer';

	
	protected static $peer;

	
	protected $ca_idtarea;

	
	protected $ca_idlistatarea;

	
	protected $ca_url;

	
	protected $ca_titulo;

	
	protected $ca_texto;

	
	protected $ca_fchvisible;

	
	protected $ca_fchvencimiento;

	
	protected $ca_fchterminada;

	
	protected $ca_usuterminada;

	
	protected $ca_prioridad;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_observaciones;

	
	protected $ca_notificar;

	
	protected $aNotListaTareas;

	
	protected $collHdeskTickets;

	
	private $lastHdeskTicketCriteria = null;

	
	protected $collNotificacions;

	
	private $lastNotificacionCriteria = null;

	
	protected $collNotTareaAsignacions;

	
	private $lastNotTareaAsignacionCriteria = null;

	
	protected $collReportes;

	
	private $lastReporteCriteria = null;

	
	protected $collRepAsignacions;

	
	private $lastRepAsignacionCriteria = null;

	
	protected $collCotizacions;

	
	private $lastCotizacionCriteria = null;

	
	protected $collCotProductos;

	
	private $lastCotProductoCriteria = null;

	
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

	
	public function getCaIdtarea()
	{
		return $this->ca_idtarea;
	}

	
	public function getCaIdlistatarea()
	{
		return $this->ca_idlistatarea;
	}

	
	public function getCaUrl()
	{
		return $this->ca_url;
	}

	
	public function getCaTitulo()
	{
		return $this->ca_titulo;
	}

	
	public function getCaTexto()
	{
		return $this->ca_texto;
	}

	
	public function getCaFchvisible($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchvisible === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchvisible);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchvisible, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaFchvencimiento($format = 'Y-m-d H:i:s')
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

	
	public function getCaFchterminada($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchterminada === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchterminada);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchterminada, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaUsuterminada()
	{
		return $this->ca_usuterminada;
	}

	
	public function getCaPrioridad()
	{
		return $this->ca_prioridad;
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

	
	public function getCaObservaciones()
	{
		return $this->ca_observaciones;
	}

	
	public function getCaNotificar()
	{
		return $this->ca_notificar;
	}

	
	public function setCaIdtarea($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idtarea !== $v) {
			$this->ca_idtarea = $v;
			$this->modifiedColumns[] = NotTareaPeer::CA_IDTAREA;
		}

		return $this;
	} 
	
	public function setCaIdlistatarea($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idlistatarea !== $v) {
			$this->ca_idlistatarea = $v;
			$this->modifiedColumns[] = NotTareaPeer::CA_IDLISTATAREA;
		}

		if ($this->aNotListaTareas !== null && $this->aNotListaTareas->getCaIdlistatarea() !== $v) {
			$this->aNotListaTareas = null;
		}

		return $this;
	} 
	
	public function setCaUrl($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_url !== $v) {
			$this->ca_url = $v;
			$this->modifiedColumns[] = NotTareaPeer::CA_URL;
		}

		return $this;
	} 
	
	public function setCaTitulo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_titulo !== $v) {
			$this->ca_titulo = $v;
			$this->modifiedColumns[] = NotTareaPeer::CA_TITULO;
		}

		return $this;
	} 
	
	public function setCaTexto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_texto !== $v) {
			$this->ca_texto = $v;
			$this->modifiedColumns[] = NotTareaPeer::CA_TEXTO;
		}

		return $this;
	} 
	
	public function setCaFchvisible($v)
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

		if ( $this->ca_fchvisible !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchvisible !== null && $tmpDt = new DateTime($this->ca_fchvisible)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchvisible = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = NotTareaPeer::CA_FCHVISIBLE;
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
			
			$currNorm = ($this->ca_fchvencimiento !== null && $tmpDt = new DateTime($this->ca_fchvencimiento)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchvencimiento = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = NotTareaPeer::CA_FCHVENCIMIENTO;
			}
		} 
		return $this;
	} 
	
	public function setCaFchterminada($v)
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

		if ( $this->ca_fchterminada !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchterminada !== null && $tmpDt = new DateTime($this->ca_fchterminada)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchterminada = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = NotTareaPeer::CA_FCHTERMINADA;
			}
		} 
		return $this;
	} 
	
	public function setCaUsuterminada($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuterminada !== $v) {
			$this->ca_usuterminada = $v;
			$this->modifiedColumns[] = NotTareaPeer::CA_USUTERMINADA;
		}

		return $this;
	} 
	
	public function setCaPrioridad($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_prioridad !== $v) {
			$this->ca_prioridad = $v;
			$this->modifiedColumns[] = NotTareaPeer::CA_PRIORIDAD;
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
				$this->modifiedColumns[] = NotTareaPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = NotTareaPeer::CA_USUCREADO;
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
			$this->modifiedColumns[] = NotTareaPeer::CA_OBSERVACIONES;
		}

		return $this;
	} 
	
	public function setCaNotificar($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_notificar !== $v) {
			$this->ca_notificar = $v;
			$this->modifiedColumns[] = NotTareaPeer::CA_NOTIFICAR;
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

			$this->ca_idtarea = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idlistatarea = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_url = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_titulo = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_texto = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_fchvisible = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_fchvencimiento = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_fchterminada = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_usuterminada = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_prioridad = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->ca_fchcreado = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_usucreado = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_observaciones = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_notificar = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 14; 
		} catch (Exception $e) {
			throw new PropelException("Error populating NotTarea object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aNotListaTareas !== null && $this->ca_idlistatarea !== $this->aNotListaTareas->getCaIdlistatarea()) {
			$this->aNotListaTareas = null;
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
			$con = Propel::getConnection(NotTareaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = NotTareaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aNotListaTareas = null;
			$this->collHdeskTickets = null;
			$this->lastHdeskTicketCriteria = null;

			$this->collNotificacions = null;
			$this->lastNotificacionCriteria = null;

			$this->collNotTareaAsignacions = null;
			$this->lastNotTareaAsignacionCriteria = null;

			$this->collReportes = null;
			$this->lastReporteCriteria = null;

			$this->collRepAsignacions = null;
			$this->lastRepAsignacionCriteria = null;

			$this->collCotizacions = null;
			$this->lastCotizacionCriteria = null;

			$this->collCotProductos = null;
			$this->lastCotProductoCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseNotTarea:delete:pre') as $callable)
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
			$con = Propel::getConnection(NotTareaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			NotTareaPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseNotTarea:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseNotTarea:save:pre') as $callable)
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
			$con = Propel::getConnection(NotTareaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseNotTarea:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			NotTareaPeer::addInstanceToPool($this);
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

												
			if ($this->aNotListaTareas !== null) {
				if ($this->aNotListaTareas->isModified() || $this->aNotListaTareas->isNew()) {
					$affectedRows += $this->aNotListaTareas->save($con);
				}
				$this->setNotListaTareas($this->aNotListaTareas);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = NotTareaPeer::CA_IDTAREA;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = NotTareaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdtarea($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += NotTareaPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collHdeskTickets !== null) {
				foreach ($this->collHdeskTickets as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collNotificacions !== null) {
				foreach ($this->collNotificacions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collNotTareaAsignacions !== null) {
				foreach ($this->collNotTareaAsignacions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collReportes !== null) {
				foreach ($this->collReportes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepAsignacions !== null) {
				foreach ($this->collRepAsignacions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCotizacions !== null) {
				foreach ($this->collCotizacions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCotProductos !== null) {
				foreach ($this->collCotProductos as $referrerFK) {
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


												
			if ($this->aNotListaTareas !== null) {
				if (!$this->aNotListaTareas->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aNotListaTareas->getValidationFailures());
				}
			}


			if (($retval = NotTareaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collHdeskTickets !== null) {
					foreach ($this->collHdeskTickets as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collNotificacions !== null) {
					foreach ($this->collNotificacions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collNotTareaAsignacions !== null) {
					foreach ($this->collNotTareaAsignacions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collReportes !== null) {
					foreach ($this->collReportes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepAsignacions !== null) {
					foreach ($this->collRepAsignacions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCotizacions !== null) {
					foreach ($this->collCotizacions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCotProductos !== null) {
					foreach ($this->collCotProductos as $referrerFK) {
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
		$pos = NotTareaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdtarea();
				break;
			case 1:
				return $this->getCaIdlistatarea();
				break;
			case 2:
				return $this->getCaUrl();
				break;
			case 3:
				return $this->getCaTitulo();
				break;
			case 4:
				return $this->getCaTexto();
				break;
			case 5:
				return $this->getCaFchvisible();
				break;
			case 6:
				return $this->getCaFchvencimiento();
				break;
			case 7:
				return $this->getCaFchterminada();
				break;
			case 8:
				return $this->getCaUsuterminada();
				break;
			case 9:
				return $this->getCaPrioridad();
				break;
			case 10:
				return $this->getCaFchcreado();
				break;
			case 11:
				return $this->getCaUsucreado();
				break;
			case 12:
				return $this->getCaObservaciones();
				break;
			case 13:
				return $this->getCaNotificar();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = NotTareaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdtarea(),
			$keys[1] => $this->getCaIdlistatarea(),
			$keys[2] => $this->getCaUrl(),
			$keys[3] => $this->getCaTitulo(),
			$keys[4] => $this->getCaTexto(),
			$keys[5] => $this->getCaFchvisible(),
			$keys[6] => $this->getCaFchvencimiento(),
			$keys[7] => $this->getCaFchterminada(),
			$keys[8] => $this->getCaUsuterminada(),
			$keys[9] => $this->getCaPrioridad(),
			$keys[10] => $this->getCaFchcreado(),
			$keys[11] => $this->getCaUsucreado(),
			$keys[12] => $this->getCaObservaciones(),
			$keys[13] => $this->getCaNotificar(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = NotTareaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdtarea($value);
				break;
			case 1:
				$this->setCaIdlistatarea($value);
				break;
			case 2:
				$this->setCaUrl($value);
				break;
			case 3:
				$this->setCaTitulo($value);
				break;
			case 4:
				$this->setCaTexto($value);
				break;
			case 5:
				$this->setCaFchvisible($value);
				break;
			case 6:
				$this->setCaFchvencimiento($value);
				break;
			case 7:
				$this->setCaFchterminada($value);
				break;
			case 8:
				$this->setCaUsuterminada($value);
				break;
			case 9:
				$this->setCaPrioridad($value);
				break;
			case 10:
				$this->setCaFchcreado($value);
				break;
			case 11:
				$this->setCaUsucreado($value);
				break;
			case 12:
				$this->setCaObservaciones($value);
				break;
			case 13:
				$this->setCaNotificar($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = NotTareaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdtarea($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdlistatarea($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaUrl($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaTitulo($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaTexto($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaFchvisible($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaFchvencimiento($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaFchterminada($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaUsuterminada($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaPrioridad($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaFchcreado($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaUsucreado($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaObservaciones($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaNotificar($arr[$keys[13]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);

		if ($this->isColumnModified(NotTareaPeer::CA_IDTAREA)) $criteria->add(NotTareaPeer::CA_IDTAREA, $this->ca_idtarea);
		if ($this->isColumnModified(NotTareaPeer::CA_IDLISTATAREA)) $criteria->add(NotTareaPeer::CA_IDLISTATAREA, $this->ca_idlistatarea);
		if ($this->isColumnModified(NotTareaPeer::CA_URL)) $criteria->add(NotTareaPeer::CA_URL, $this->ca_url);
		if ($this->isColumnModified(NotTareaPeer::CA_TITULO)) $criteria->add(NotTareaPeer::CA_TITULO, $this->ca_titulo);
		if ($this->isColumnModified(NotTareaPeer::CA_TEXTO)) $criteria->add(NotTareaPeer::CA_TEXTO, $this->ca_texto);
		if ($this->isColumnModified(NotTareaPeer::CA_FCHVISIBLE)) $criteria->add(NotTareaPeer::CA_FCHVISIBLE, $this->ca_fchvisible);
		if ($this->isColumnModified(NotTareaPeer::CA_FCHVENCIMIENTO)) $criteria->add(NotTareaPeer::CA_FCHVENCIMIENTO, $this->ca_fchvencimiento);
		if ($this->isColumnModified(NotTareaPeer::CA_FCHTERMINADA)) $criteria->add(NotTareaPeer::CA_FCHTERMINADA, $this->ca_fchterminada);
		if ($this->isColumnModified(NotTareaPeer::CA_USUTERMINADA)) $criteria->add(NotTareaPeer::CA_USUTERMINADA, $this->ca_usuterminada);
		if ($this->isColumnModified(NotTareaPeer::CA_PRIORIDAD)) $criteria->add(NotTareaPeer::CA_PRIORIDAD, $this->ca_prioridad);
		if ($this->isColumnModified(NotTareaPeer::CA_FCHCREADO)) $criteria->add(NotTareaPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(NotTareaPeer::CA_USUCREADO)) $criteria->add(NotTareaPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(NotTareaPeer::CA_OBSERVACIONES)) $criteria->add(NotTareaPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(NotTareaPeer::CA_NOTIFICAR)) $criteria->add(NotTareaPeer::CA_NOTIFICAR, $this->ca_notificar);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);

		$criteria->add(NotTareaPeer::CA_IDTAREA, $this->ca_idtarea);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdtarea();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdtarea($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdlistatarea($this->ca_idlistatarea);

		$copyObj->setCaUrl($this->ca_url);

		$copyObj->setCaTitulo($this->ca_titulo);

		$copyObj->setCaTexto($this->ca_texto);

		$copyObj->setCaFchvisible($this->ca_fchvisible);

		$copyObj->setCaFchvencimiento($this->ca_fchvencimiento);

		$copyObj->setCaFchterminada($this->ca_fchterminada);

		$copyObj->setCaUsuterminada($this->ca_usuterminada);

		$copyObj->setCaPrioridad($this->ca_prioridad);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaNotificar($this->ca_notificar);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getHdeskTickets() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addHdeskTicket($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getNotificacions() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addNotificacion($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getNotTareaAsignacions() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addNotTareaAsignacion($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getReportes() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addReporte($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRepAsignacions() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addRepAsignacion($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getCotizacions() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addCotizacion($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getCotProductos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addCotProducto($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCaIdtarea(NULL); 
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
			self::$peer = new NotTareaPeer();
		}
		return self::$peer;
	}

	
	public function setNotListaTareas(NotListaTareas $v = null)
	{
		if ($v === null) {
			$this->setCaIdlistatarea(NULL);
		} else {
			$this->setCaIdlistatarea($v->getCaIdlistatarea());
		}

		$this->aNotListaTareas = $v;

						if ($v !== null) {
			$v->addNotTarea($this);
		}

		return $this;
	}


	
	public function getNotListaTareas(PropelPDO $con = null)
	{
		if ($this->aNotListaTareas === null && ($this->ca_idlistatarea !== null)) {
			$c = new Criteria(NotListaTareasPeer::DATABASE_NAME);
			$c->add(NotListaTareasPeer::CA_IDLISTATAREA, $this->ca_idlistatarea);
			$this->aNotListaTareas = NotListaTareasPeer::doSelectOne($c, $con);
			
		}
		return $this->aNotListaTareas;
	}

	
	public function clearHdeskTickets()
	{
		$this->collHdeskTickets = null; 	}

	
	public function initHdeskTickets()
	{
		$this->collHdeskTickets = array();
	}

	
	public function getHdeskTickets($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
			   $this->collHdeskTickets = array();
			} else {

				$criteria->add(HdeskTicketPeer::CA_IDTAREA, $this->ca_idtarea);

				HdeskTicketPeer::addSelectColumns($criteria);
				$this->collHdeskTickets = HdeskTicketPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HdeskTicketPeer::CA_IDTAREA, $this->ca_idtarea);

				HdeskTicketPeer::addSelectColumns($criteria);
				if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
					$this->collHdeskTickets = HdeskTicketPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHdeskTicketCriteria = $criteria;
		return $this->collHdeskTickets;
	}

	
	public function countHdeskTickets(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(HdeskTicketPeer::CA_IDTAREA, $this->ca_idtarea);

				$count = HdeskTicketPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HdeskTicketPeer::CA_IDTAREA, $this->ca_idtarea);

				if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
					$count = HdeskTicketPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collHdeskTickets);
				}
			} else {
				$count = count($this->collHdeskTickets);
			}
		}
		return $count;
	}

	
	public function addHdeskTicket(HdeskTicket $l)
	{
		if ($this->collHdeskTickets === null) {
			$this->initHdeskTickets();
		}
		if (!in_array($l, $this->collHdeskTickets, true)) { 			array_push($this->collHdeskTickets, $l);
			$l->setNotTarea($this);
		}
	}


	
	public function getHdeskTicketsJoinHdeskGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
				$this->collHdeskTickets = array();
			} else {

				$criteria->add(HdeskTicketPeer::CA_IDTAREA, $this->ca_idtarea);

				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinHdeskGroup($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(HdeskTicketPeer::CA_IDTAREA, $this->ca_idtarea);

			if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinHdeskGroup($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskTicketCriteria = $criteria;

		return $this->collHdeskTickets;
	}


	
	public function getHdeskTicketsJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
				$this->collHdeskTickets = array();
			} else {

				$criteria->add(HdeskTicketPeer::CA_IDTAREA, $this->ca_idtarea);

				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(HdeskTicketPeer::CA_IDTAREA, $this->ca_idtarea);

			if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskTicketCriteria = $criteria;

		return $this->collHdeskTickets;
	}


	
	public function getHdeskTicketsJoinHdeskProject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
				$this->collHdeskTickets = array();
			} else {

				$criteria->add(HdeskTicketPeer::CA_IDTAREA, $this->ca_idtarea);

				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinHdeskProject($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(HdeskTicketPeer::CA_IDTAREA, $this->ca_idtarea);

			if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinHdeskProject($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskTicketCriteria = $criteria;

		return $this->collHdeskTickets;
	}

	
	public function clearNotificacions()
	{
		$this->collNotificacions = null; 	}

	
	public function initNotificacions()
	{
		$this->collNotificacions = array();
	}

	
	public function getNotificacions($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotificacions === null) {
			if ($this->isNew()) {
			   $this->collNotificacions = array();
			} else {

				$criteria->add(NotificacionPeer::CA_IDTAREA, $this->ca_idtarea);

				NotificacionPeer::addSelectColumns($criteria);
				$this->collNotificacions = NotificacionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NotificacionPeer::CA_IDTAREA, $this->ca_idtarea);

				NotificacionPeer::addSelectColumns($criteria);
				if (!isset($this->lastNotificacionCriteria) || !$this->lastNotificacionCriteria->equals($criteria)) {
					$this->collNotificacions = NotificacionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastNotificacionCriteria = $criteria;
		return $this->collNotificacions;
	}

	
	public function countNotificacions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collNotificacions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(NotificacionPeer::CA_IDTAREA, $this->ca_idtarea);

				$count = NotificacionPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NotificacionPeer::CA_IDTAREA, $this->ca_idtarea);

				if (!isset($this->lastNotificacionCriteria) || !$this->lastNotificacionCriteria->equals($criteria)) {
					$count = NotificacionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collNotificacions);
				}
			} else {
				$count = count($this->collNotificacions);
			}
		}
		return $count;
	}

	
	public function addNotificacion(Notificacion $l)
	{
		if ($this->collNotificacions === null) {
			$this->initNotificacions();
		}
		if (!in_array($l, $this->collNotificacions, true)) { 			array_push($this->collNotificacions, $l);
			$l->setNotTarea($this);
		}
	}


	
	public function getNotificacionsJoinEmail($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotificacions === null) {
			if ($this->isNew()) {
				$this->collNotificacions = array();
			} else {

				$criteria->add(NotificacionPeer::CA_IDTAREA, $this->ca_idtarea);

				$this->collNotificacions = NotificacionPeer::doSelectJoinEmail($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(NotificacionPeer::CA_IDTAREA, $this->ca_idtarea);

			if (!isset($this->lastNotificacionCriteria) || !$this->lastNotificacionCriteria->equals($criteria)) {
				$this->collNotificacions = NotificacionPeer::doSelectJoinEmail($criteria, $con, $join_behavior);
			}
		}
		$this->lastNotificacionCriteria = $criteria;

		return $this->collNotificacions;
	}

	
	public function clearNotTareaAsignacions()
	{
		$this->collNotTareaAsignacions = null; 	}

	
	public function initNotTareaAsignacions()
	{
		$this->collNotTareaAsignacions = array();
	}

	
	public function getNotTareaAsignacions($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotTareaAsignacions === null) {
			if ($this->isNew()) {
			   $this->collNotTareaAsignacions = array();
			} else {

				$criteria->add(NotTareaAsignacionPeer::CA_IDTAREA, $this->ca_idtarea);

				NotTareaAsignacionPeer::addSelectColumns($criteria);
				$this->collNotTareaAsignacions = NotTareaAsignacionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NotTareaAsignacionPeer::CA_IDTAREA, $this->ca_idtarea);

				NotTareaAsignacionPeer::addSelectColumns($criteria);
				if (!isset($this->lastNotTareaAsignacionCriteria) || !$this->lastNotTareaAsignacionCriteria->equals($criteria)) {
					$this->collNotTareaAsignacions = NotTareaAsignacionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastNotTareaAsignacionCriteria = $criteria;
		return $this->collNotTareaAsignacions;
	}

	
	public function countNotTareaAsignacions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collNotTareaAsignacions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(NotTareaAsignacionPeer::CA_IDTAREA, $this->ca_idtarea);

				$count = NotTareaAsignacionPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NotTareaAsignacionPeer::CA_IDTAREA, $this->ca_idtarea);

				if (!isset($this->lastNotTareaAsignacionCriteria) || !$this->lastNotTareaAsignacionCriteria->equals($criteria)) {
					$count = NotTareaAsignacionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collNotTareaAsignacions);
				}
			} else {
				$count = count($this->collNotTareaAsignacions);
			}
		}
		return $count;
	}

	
	public function addNotTareaAsignacion(NotTareaAsignacion $l)
	{
		if ($this->collNotTareaAsignacions === null) {
			$this->initNotTareaAsignacions();
		}
		if (!in_array($l, $this->collNotTareaAsignacions, true)) { 			array_push($this->collNotTareaAsignacions, $l);
			$l->setNotTarea($this);
		}
	}


	
	public function getNotTareaAsignacionsJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotTareaAsignacions === null) {
			if ($this->isNew()) {
				$this->collNotTareaAsignacions = array();
			} else {

				$criteria->add(NotTareaAsignacionPeer::CA_IDTAREA, $this->ca_idtarea);

				$this->collNotTareaAsignacions = NotTareaAsignacionPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(NotTareaAsignacionPeer::CA_IDTAREA, $this->ca_idtarea);

			if (!isset($this->lastNotTareaAsignacionCriteria) || !$this->lastNotTareaAsignacionCriteria->equals($criteria)) {
				$this->collNotTareaAsignacions = NotTareaAsignacionPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		}
		$this->lastNotTareaAsignacionCriteria = $criteria;

		return $this->collNotTareaAsignacions;
	}

	
	public function clearReportes()
	{
		$this->collReportes = null; 	}

	
	public function initReportes()
	{
		$this->collReportes = array();
	}

	
	public function getReportes($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
			   $this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

				ReportePeer::addSelectColumns($criteria);
				$this->collReportes = ReportePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

				ReportePeer::addSelectColumns($criteria);
				if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
					$this->collReportes = ReportePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastReporteCriteria = $criteria;
		return $this->collReportes;
	}

	
	public function countReportes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

				$count = ReportePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

				if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
					$count = ReportePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collReportes);
				}
			} else {
				$count = count($this->collReportes);
			}
		}
		return $count;
	}

	
	public function addReporte(Reporte $l)
	{
		if ($this->collReportes === null) {
			$this->initReportes();
		}
		if (!in_array($l, $this->collReportes, true)) { 			array_push($this->collReportes, $l);
			$l->setNotTarea($this);
		}
	}


	
	public function getReportesJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

				$this->collReportes = ReportePeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}


	
	public function getReportesJoinTransportador($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

				$this->collReportes = ReportePeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}


	
	public function getReportesJoinTercero($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

				$this->collReportes = ReportePeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}


	
	public function getReportesJoinAgente($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

				$this->collReportes = ReportePeer::doSelectJoinAgente($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinAgente($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}


	
	public function getReportesJoinBodega($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

				$this->collReportes = ReportePeer::doSelectJoinBodega($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinBodega($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}


	
	public function getReportesJoinTrackingEtapa($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

				$this->collReportes = ReportePeer::doSelectJoinTrackingEtapa($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDSEGUIMIENTO, $this->ca_idtarea);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinTrackingEtapa($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}

	
	public function clearRepAsignacions()
	{
		$this->collRepAsignacions = null; 	}

	
	public function initRepAsignacions()
	{
		$this->collRepAsignacions = array();
	}

	
	public function getRepAsignacions($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepAsignacions === null) {
			if ($this->isNew()) {
			   $this->collRepAsignacions = array();
			} else {

				$criteria->add(RepAsignacionPeer::CA_IDTAREA, $this->ca_idtarea);

				RepAsignacionPeer::addSelectColumns($criteria);
				$this->collRepAsignacions = RepAsignacionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepAsignacionPeer::CA_IDTAREA, $this->ca_idtarea);

				RepAsignacionPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepAsignacionCriteria) || !$this->lastRepAsignacionCriteria->equals($criteria)) {
					$this->collRepAsignacions = RepAsignacionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepAsignacionCriteria = $criteria;
		return $this->collRepAsignacions;
	}

	
	public function countRepAsignacions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRepAsignacions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RepAsignacionPeer::CA_IDTAREA, $this->ca_idtarea);

				$count = RepAsignacionPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepAsignacionPeer::CA_IDTAREA, $this->ca_idtarea);

				if (!isset($this->lastRepAsignacionCriteria) || !$this->lastRepAsignacionCriteria->equals($criteria)) {
					$count = RepAsignacionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRepAsignacions);
				}
			} else {
				$count = count($this->collRepAsignacions);
			}
		}
		return $count;
	}

	
	public function addRepAsignacion(RepAsignacion $l)
	{
		if ($this->collRepAsignacions === null) {
			$this->initRepAsignacions();
		}
		if (!in_array($l, $this->collRepAsignacions, true)) { 			array_push($this->collRepAsignacions, $l);
			$l->setNotTarea($this);
		}
	}


	
	public function getRepAsignacionsJoinReporte($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepAsignacions === null) {
			if ($this->isNew()) {
				$this->collRepAsignacions = array();
			} else {

				$criteria->add(RepAsignacionPeer::CA_IDTAREA, $this->ca_idtarea);

				$this->collRepAsignacions = RepAsignacionPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(RepAsignacionPeer::CA_IDTAREA, $this->ca_idtarea);

			if (!isset($this->lastRepAsignacionCriteria) || !$this->lastRepAsignacionCriteria->equals($criteria)) {
				$this->collRepAsignacions = RepAsignacionPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepAsignacionCriteria = $criteria;

		return $this->collRepAsignacions;
	}

	
	public function clearCotizacions()
	{
		$this->collCotizacions = null; 	}

	
	public function initCotizacions()
	{
		$this->collCotizacions = array();
	}

	
	public function getCotizacions($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotizacions === null) {
			if ($this->isNew()) {
			   $this->collCotizacions = array();
			} else {

				$criteria->add(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO, $this->ca_idtarea);

				CotizacionPeer::addSelectColumns($criteria);
				$this->collCotizacions = CotizacionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO, $this->ca_idtarea);

				CotizacionPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotizacionCriteria) || !$this->lastCotizacionCriteria->equals($criteria)) {
					$this->collCotizacions = CotizacionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotizacionCriteria = $criteria;
		return $this->collCotizacions;
	}

	
	public function countCotizacions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCotizacions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO, $this->ca_idtarea);

				$count = CotizacionPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO, $this->ca_idtarea);

				if (!isset($this->lastCotizacionCriteria) || !$this->lastCotizacionCriteria->equals($criteria)) {
					$count = CotizacionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCotizacions);
				}
			} else {
				$count = count($this->collCotizacions);
			}
		}
		return $count;
	}

	
	public function addCotizacion(Cotizacion $l)
	{
		if ($this->collCotizacions === null) {
			$this->initCotizacions();
		}
		if (!in_array($l, $this->collCotizacions, true)) { 			array_push($this->collCotizacions, $l);
			$l->setNotTarea($this);
		}
	}


	
	public function getCotizacionsJoinContacto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotizacions === null) {
			if ($this->isNew()) {
				$this->collCotizacions = array();
			} else {

				$criteria->add(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO, $this->ca_idtarea);

				$this->collCotizacions = CotizacionPeer::doSelectJoinContacto($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO, $this->ca_idtarea);

			if (!isset($this->lastCotizacionCriteria) || !$this->lastCotizacionCriteria->equals($criteria)) {
				$this->collCotizacions = CotizacionPeer::doSelectJoinContacto($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotizacionCriteria = $criteria;

		return $this->collCotizacions;
	}


	
	public function getCotizacionsJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotizacions === null) {
			if ($this->isNew()) {
				$this->collCotizacions = array();
			} else {

				$criteria->add(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO, $this->ca_idtarea);

				$this->collCotizacions = CotizacionPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO, $this->ca_idtarea);

			if (!isset($this->lastCotizacionCriteria) || !$this->lastCotizacionCriteria->equals($criteria)) {
				$this->collCotizacions = CotizacionPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotizacionCriteria = $criteria;

		return $this->collCotizacions;
	}

	
	public function clearCotProductos()
	{
		$this->collCotProductos = null; 	}

	
	public function initCotProductos()
	{
		$this->collCotProductos = array();
	}

	
	public function getCotProductos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotProductos === null) {
			if ($this->isNew()) {
			   $this->collCotProductos = array();
			} else {

				$criteria->add(CotProductoPeer::CA_IDTAREA, $this->ca_idtarea);

				CotProductoPeer::addSelectColumns($criteria);
				$this->collCotProductos = CotProductoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotProductoPeer::CA_IDTAREA, $this->ca_idtarea);

				CotProductoPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotProductoCriteria) || !$this->lastCotProductoCriteria->equals($criteria)) {
					$this->collCotProductos = CotProductoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotProductoCriteria = $criteria;
		return $this->collCotProductos;
	}

	
	public function countCotProductos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCotProductos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CotProductoPeer::CA_IDTAREA, $this->ca_idtarea);

				$count = CotProductoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotProductoPeer::CA_IDTAREA, $this->ca_idtarea);

				if (!isset($this->lastCotProductoCriteria) || !$this->lastCotProductoCriteria->equals($criteria)) {
					$count = CotProductoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCotProductos);
				}
			} else {
				$count = count($this->collCotProductos);
			}
		}
		return $count;
	}

	
	public function addCotProducto(CotProducto $l)
	{
		if ($this->collCotProductos === null) {
			$this->initCotProductos();
		}
		if (!in_array($l, $this->collCotProductos, true)) { 			array_push($this->collCotProductos, $l);
			$l->setNotTarea($this);
		}
	}


	
	public function getCotProductosJoinCotizacion($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotProductos === null) {
			if ($this->isNew()) {
				$this->collCotProductos = array();
			} else {

				$criteria->add(CotProductoPeer::CA_IDTAREA, $this->ca_idtarea);

				$this->collCotProductos = CotProductoPeer::doSelectJoinCotizacion($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(CotProductoPeer::CA_IDTAREA, $this->ca_idtarea);

			if (!isset($this->lastCotProductoCriteria) || !$this->lastCotProductoCriteria->equals($criteria)) {
				$this->collCotProductos = CotProductoPeer::doSelectJoinCotizacion($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotProductoCriteria = $criteria;

		return $this->collCotProductos;
	}


	
	public function getCotProductosJoinTransportador($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(NotTareaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotProductos === null) {
			if ($this->isNew()) {
				$this->collCotProductos = array();
			} else {

				$criteria->add(CotProductoPeer::CA_IDTAREA, $this->ca_idtarea);

				$this->collCotProductos = CotProductoPeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(CotProductoPeer::CA_IDTAREA, $this->ca_idtarea);

			if (!isset($this->lastCotProductoCriteria) || !$this->lastCotProductoCriteria->equals($criteria)) {
				$this->collCotProductos = CotProductoPeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotProductoCriteria = $criteria;

		return $this->collCotProductos;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collHdeskTickets) {
				foreach ((array) $this->collHdeskTickets as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collNotificacions) {
				foreach ((array) $this->collNotificacions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collNotTareaAsignacions) {
				foreach ((array) $this->collNotTareaAsignacions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collReportes) {
				foreach ((array) $this->collReportes as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRepAsignacions) {
				foreach ((array) $this->collRepAsignacions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCotizacions) {
				foreach ((array) $this->collCotizacions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCotProductos) {
				foreach ((array) $this->collCotProductos as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collHdeskTickets = null;
		$this->collNotificacions = null;
		$this->collNotTareaAsignacions = null;
		$this->collReportes = null;
		$this->collRepAsignacions = null;
		$this->collCotizacions = null;
		$this->collCotProductos = null;
			$this->aNotListaTareas = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseNotTarea:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseNotTarea::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 