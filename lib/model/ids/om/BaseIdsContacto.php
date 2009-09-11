<?php


abstract class BaseIdsContacto extends BaseObject  implements Persistent {


  const PEER = 'IdsContactoPeer';

	
	protected static $peer;

	
	protected $ca_idcontacto;

	
	protected $ca_idsucursal;

	
	protected $ca_nombres;

	
	protected $ca_papellido;

	
	protected $ca_sapellido;

	
	protected $ca_saludo;

	
	protected $ca_direccion;

	
	protected $ca_telefonos;

	
	protected $ca_fax;

	
	protected $ca_email;

	
	protected $ca_impoexpo;

	
	protected $ca_transporte;

	
	protected $ca_cargo;

	
	protected $ca_departamento;

	
	protected $ca_observaciones;

	
	protected $ca_sugerido;

	
	protected $ca_activo;

	
	protected $ca_visibilidad;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_fchactualizado;

	
	protected $ca_usuactualizado;

	
	protected $ca_fcheliminado;

	
	protected $ca_usueliminado;

	
	protected $aIdsSucursal;

	
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

	
	public function getCaIdcontacto()
	{
		return $this->ca_idcontacto;
	}

	
	public function getCaIdsucursal()
	{
		return $this->ca_idsucursal;
	}

	
	public function getCaNombres()
	{
		return $this->ca_nombres;
	}

	
	public function getCaPapellido()
	{
		return $this->ca_papellido;
	}

	
	public function getCaSapellido()
	{
		return $this->ca_sapellido;
	}

	
	public function getCaSaludo()
	{
		return $this->ca_saludo;
	}

	
	public function getCaDireccion()
	{
		return $this->ca_direccion;
	}

	
	public function getCaTelefonos()
	{
		return $this->ca_telefonos;
	}

	
	public function getCaFax()
	{
		return $this->ca_fax;
	}

	
	public function getCaEmail()
	{
		return $this->ca_email;
	}

	
	public function getCaImpoexpo()
	{
		return $this->ca_impoexpo;
	}

	
	public function getCaTransporte()
	{
		return $this->ca_transporte;
	}

	
	public function getCaCargo()
	{
		return $this->ca_cargo;
	}

	
	public function getCaDepartamento()
	{
		return $this->ca_departamento;
	}

	
	public function getCaObservaciones()
	{
		return $this->ca_observaciones;
	}

	
	public function getCaSugerido()
	{
		return $this->ca_sugerido;
	}

	
	public function getCaActivo()
	{
		return $this->ca_activo;
	}

	
	public function getCaVisibilidad()
	{
		return $this->ca_visibilidad;
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

	
	public function getCaFcheliminado($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fcheliminado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fcheliminado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fcheliminado, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaUsueliminado()
	{
		return $this->ca_usueliminado;
	}

	
	public function setCaIdcontacto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcontacto !== $v) {
			$this->ca_idcontacto = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_IDCONTACTO;
		}

		return $this;
	} 
	
	public function setCaIdsucursal($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idsucursal !== $v) {
			$this->ca_idsucursal = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_IDSUCURSAL;
		}

		if ($this->aIdsSucursal !== null && $this->aIdsSucursal->getCaIdsucursal() !== $v) {
			$this->aIdsSucursal = null;
		}

		return $this;
	} 
	
	public function setCaNombres($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_nombres !== $v) {
			$this->ca_nombres = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_NOMBRES;
		}

		return $this;
	} 
	
	public function setCaPapellido($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_papellido !== $v) {
			$this->ca_papellido = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_PAPELLIDO;
		}

		return $this;
	} 
	
	public function setCaSapellido($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_sapellido !== $v) {
			$this->ca_sapellido = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_SAPELLIDO;
		}

		return $this;
	} 
	
	public function setCaSaludo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_saludo !== $v) {
			$this->ca_saludo = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_SALUDO;
		}

		return $this;
	} 
	
	public function setCaDireccion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_direccion !== $v) {
			$this->ca_direccion = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_DIRECCION;
		}

		return $this;
	} 
	
	public function setCaTelefonos($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_telefonos !== $v) {
			$this->ca_telefonos = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_TELEFONOS;
		}

		return $this;
	} 
	
	public function setCaFax($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_fax !== $v) {
			$this->ca_fax = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_FAX;
		}

		return $this;
	} 
	
	public function setCaEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_email !== $v) {
			$this->ca_email = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_EMAIL;
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
			$this->modifiedColumns[] = IdsContactoPeer::CA_IMPOEXPO;
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
			$this->modifiedColumns[] = IdsContactoPeer::CA_TRANSPORTE;
		}

		return $this;
	} 
	
	public function setCaCargo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_cargo !== $v) {
			$this->ca_cargo = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_CARGO;
		}

		return $this;
	} 
	
	public function setCaDepartamento($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_departamento !== $v) {
			$this->ca_departamento = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_DEPARTAMENTO;
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
			$this->modifiedColumns[] = IdsContactoPeer::CA_OBSERVACIONES;
		}

		return $this;
	} 
	
	public function setCaSugerido($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_sugerido !== $v) {
			$this->ca_sugerido = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_SUGERIDO;
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
			$this->modifiedColumns[] = IdsContactoPeer::CA_ACTIVO;
		}

		return $this;
	} 
	
	public function setCaVisibilidad($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_visibilidad !== $v) {
			$this->ca_visibilidad = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_VISIBILIDAD;
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
				$this->modifiedColumns[] = IdsContactoPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = IdsContactoPeer::CA_USUCREADO;
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
				$this->modifiedColumns[] = IdsContactoPeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = IdsContactoPeer::CA_USUACTUALIZADO;
		}

		return $this;
	} 
	
	public function setCaFcheliminado($v)
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

		if ( $this->ca_fcheliminado !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fcheliminado !== null && $tmpDt = new DateTime($this->ca_fcheliminado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fcheliminado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = IdsContactoPeer::CA_FCHELIMINADO;
			}
		} 
		return $this;
	} 
	
	public function setCaUsueliminado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usueliminado !== $v) {
			$this->ca_usueliminado = $v;
			$this->modifiedColumns[] = IdsContactoPeer::CA_USUELIMINADO;
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

			$this->ca_idcontacto = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idsucursal = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_nombres = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_papellido = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_sapellido = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_saludo = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_direccion = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_telefonos = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_fax = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_email = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_impoexpo = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_transporte = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_cargo = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_departamento = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_observaciones = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_sugerido = ($row[$startcol + 15] !== null) ? (boolean) $row[$startcol + 15] : null;
			$this->ca_activo = ($row[$startcol + 16] !== null) ? (boolean) $row[$startcol + 16] : null;
			$this->ca_visibilidad = ($row[$startcol + 17] !== null) ? (int) $row[$startcol + 17] : null;
			$this->ca_fchcreado = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
			$this->ca_usucreado = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
			$this->ca_fchactualizado = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
			$this->ca_usuactualizado = ($row[$startcol + 21] !== null) ? (string) $row[$startcol + 21] : null;
			$this->ca_fcheliminado = ($row[$startcol + 22] !== null) ? (string) $row[$startcol + 22] : null;
			$this->ca_usueliminado = ($row[$startcol + 23] !== null) ? (string) $row[$startcol + 23] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 24; 
		} catch (Exception $e) {
			throw new PropelException("Error populating IdsContacto object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aIdsSucursal !== null && $this->ca_idsucursal !== $this->aIdsSucursal->getCaIdsucursal()) {
			$this->aIdsSucursal = null;
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
			$con = Propel::getConnection(IdsContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = IdsContactoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aIdsSucursal = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsContacto:delete:pre') as $callable)
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
			$con = Propel::getConnection(IdsContactoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			IdsContactoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseIdsContacto:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsContacto:save:pre') as $callable)
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
			$con = Propel::getConnection(IdsContactoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseIdsContacto:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			IdsContactoPeer::addInstanceToPool($this);
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

												
			if ($this->aIdsSucursal !== null) {
				if ($this->aIdsSucursal->isModified() || $this->aIdsSucursal->isNew()) {
					$affectedRows += $this->aIdsSucursal->save($con);
				}
				$this->setIdsSucursal($this->aIdsSucursal);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = IdsContactoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += IdsContactoPeer::doUpdate($this, $con);
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


												
			if ($this->aIdsSucursal !== null) {
				if (!$this->aIdsSucursal->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aIdsSucursal->getValidationFailures());
				}
			}


			if (($retval = IdsContactoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = IdsContactoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdcontacto();
				break;
			case 1:
				return $this->getCaIdsucursal();
				break;
			case 2:
				return $this->getCaNombres();
				break;
			case 3:
				return $this->getCaPapellido();
				break;
			case 4:
				return $this->getCaSapellido();
				break;
			case 5:
				return $this->getCaSaludo();
				break;
			case 6:
				return $this->getCaDireccion();
				break;
			case 7:
				return $this->getCaTelefonos();
				break;
			case 8:
				return $this->getCaFax();
				break;
			case 9:
				return $this->getCaEmail();
				break;
			case 10:
				return $this->getCaImpoexpo();
				break;
			case 11:
				return $this->getCaTransporte();
				break;
			case 12:
				return $this->getCaCargo();
				break;
			case 13:
				return $this->getCaDepartamento();
				break;
			case 14:
				return $this->getCaObservaciones();
				break;
			case 15:
				return $this->getCaSugerido();
				break;
			case 16:
				return $this->getCaActivo();
				break;
			case 17:
				return $this->getCaVisibilidad();
				break;
			case 18:
				return $this->getCaFchcreado();
				break;
			case 19:
				return $this->getCaUsucreado();
				break;
			case 20:
				return $this->getCaFchactualizado();
				break;
			case 21:
				return $this->getCaUsuactualizado();
				break;
			case 22:
				return $this->getCaFcheliminado();
				break;
			case 23:
				return $this->getCaUsueliminado();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = IdsContactoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdcontacto(),
			$keys[1] => $this->getCaIdsucursal(),
			$keys[2] => $this->getCaNombres(),
			$keys[3] => $this->getCaPapellido(),
			$keys[4] => $this->getCaSapellido(),
			$keys[5] => $this->getCaSaludo(),
			$keys[6] => $this->getCaDireccion(),
			$keys[7] => $this->getCaTelefonos(),
			$keys[8] => $this->getCaFax(),
			$keys[9] => $this->getCaEmail(),
			$keys[10] => $this->getCaImpoexpo(),
			$keys[11] => $this->getCaTransporte(),
			$keys[12] => $this->getCaCargo(),
			$keys[13] => $this->getCaDepartamento(),
			$keys[14] => $this->getCaObservaciones(),
			$keys[15] => $this->getCaSugerido(),
			$keys[16] => $this->getCaActivo(),
			$keys[17] => $this->getCaVisibilidad(),
			$keys[18] => $this->getCaFchcreado(),
			$keys[19] => $this->getCaUsucreado(),
			$keys[20] => $this->getCaFchactualizado(),
			$keys[21] => $this->getCaUsuactualizado(),
			$keys[22] => $this->getCaFcheliminado(),
			$keys[23] => $this->getCaUsueliminado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = IdsContactoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdcontacto($value);
				break;
			case 1:
				$this->setCaIdsucursal($value);
				break;
			case 2:
				$this->setCaNombres($value);
				break;
			case 3:
				$this->setCaPapellido($value);
				break;
			case 4:
				$this->setCaSapellido($value);
				break;
			case 5:
				$this->setCaSaludo($value);
				break;
			case 6:
				$this->setCaDireccion($value);
				break;
			case 7:
				$this->setCaTelefonos($value);
				break;
			case 8:
				$this->setCaFax($value);
				break;
			case 9:
				$this->setCaEmail($value);
				break;
			case 10:
				$this->setCaImpoexpo($value);
				break;
			case 11:
				$this->setCaTransporte($value);
				break;
			case 12:
				$this->setCaCargo($value);
				break;
			case 13:
				$this->setCaDepartamento($value);
				break;
			case 14:
				$this->setCaObservaciones($value);
				break;
			case 15:
				$this->setCaSugerido($value);
				break;
			case 16:
				$this->setCaActivo($value);
				break;
			case 17:
				$this->setCaVisibilidad($value);
				break;
			case 18:
				$this->setCaFchcreado($value);
				break;
			case 19:
				$this->setCaUsucreado($value);
				break;
			case 20:
				$this->setCaFchactualizado($value);
				break;
			case 21:
				$this->setCaUsuactualizado($value);
				break;
			case 22:
				$this->setCaFcheliminado($value);
				break;
			case 23:
				$this->setCaUsueliminado($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = IdsContactoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdcontacto($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdsucursal($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaNombres($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaPapellido($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaSapellido($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaSaludo($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaDireccion($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaTelefonos($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaFax($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaEmail($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaImpoexpo($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaTransporte($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaCargo($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaDepartamento($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaObservaciones($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaSugerido($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaActivo($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaVisibilidad($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCaFchcreado($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setCaUsucreado($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCaFchactualizado($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setCaUsuactualizado($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setCaFcheliminado($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setCaUsueliminado($arr[$keys[23]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(IdsContactoPeer::DATABASE_NAME);

		if ($this->isColumnModified(IdsContactoPeer::CA_IDCONTACTO)) $criteria->add(IdsContactoPeer::CA_IDCONTACTO, $this->ca_idcontacto);
		if ($this->isColumnModified(IdsContactoPeer::CA_IDSUCURSAL)) $criteria->add(IdsContactoPeer::CA_IDSUCURSAL, $this->ca_idsucursal);
		if ($this->isColumnModified(IdsContactoPeer::CA_NOMBRES)) $criteria->add(IdsContactoPeer::CA_NOMBRES, $this->ca_nombres);
		if ($this->isColumnModified(IdsContactoPeer::CA_PAPELLIDO)) $criteria->add(IdsContactoPeer::CA_PAPELLIDO, $this->ca_papellido);
		if ($this->isColumnModified(IdsContactoPeer::CA_SAPELLIDO)) $criteria->add(IdsContactoPeer::CA_SAPELLIDO, $this->ca_sapellido);
		if ($this->isColumnModified(IdsContactoPeer::CA_SALUDO)) $criteria->add(IdsContactoPeer::CA_SALUDO, $this->ca_saludo);
		if ($this->isColumnModified(IdsContactoPeer::CA_DIRECCION)) $criteria->add(IdsContactoPeer::CA_DIRECCION, $this->ca_direccion);
		if ($this->isColumnModified(IdsContactoPeer::CA_TELEFONOS)) $criteria->add(IdsContactoPeer::CA_TELEFONOS, $this->ca_telefonos);
		if ($this->isColumnModified(IdsContactoPeer::CA_FAX)) $criteria->add(IdsContactoPeer::CA_FAX, $this->ca_fax);
		if ($this->isColumnModified(IdsContactoPeer::CA_EMAIL)) $criteria->add(IdsContactoPeer::CA_EMAIL, $this->ca_email);
		if ($this->isColumnModified(IdsContactoPeer::CA_IMPOEXPO)) $criteria->add(IdsContactoPeer::CA_IMPOEXPO, $this->ca_impoexpo);
		if ($this->isColumnModified(IdsContactoPeer::CA_TRANSPORTE)) $criteria->add(IdsContactoPeer::CA_TRANSPORTE, $this->ca_transporte);
		if ($this->isColumnModified(IdsContactoPeer::CA_CARGO)) $criteria->add(IdsContactoPeer::CA_CARGO, $this->ca_cargo);
		if ($this->isColumnModified(IdsContactoPeer::CA_DEPARTAMENTO)) $criteria->add(IdsContactoPeer::CA_DEPARTAMENTO, $this->ca_departamento);
		if ($this->isColumnModified(IdsContactoPeer::CA_OBSERVACIONES)) $criteria->add(IdsContactoPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(IdsContactoPeer::CA_SUGERIDO)) $criteria->add(IdsContactoPeer::CA_SUGERIDO, $this->ca_sugerido);
		if ($this->isColumnModified(IdsContactoPeer::CA_ACTIVO)) $criteria->add(IdsContactoPeer::CA_ACTIVO, $this->ca_activo);
		if ($this->isColumnModified(IdsContactoPeer::CA_VISIBILIDAD)) $criteria->add(IdsContactoPeer::CA_VISIBILIDAD, $this->ca_visibilidad);
		if ($this->isColumnModified(IdsContactoPeer::CA_FCHCREADO)) $criteria->add(IdsContactoPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(IdsContactoPeer::CA_USUCREADO)) $criteria->add(IdsContactoPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(IdsContactoPeer::CA_FCHACTUALIZADO)) $criteria->add(IdsContactoPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(IdsContactoPeer::CA_USUACTUALIZADO)) $criteria->add(IdsContactoPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);
		if ($this->isColumnModified(IdsContactoPeer::CA_FCHELIMINADO)) $criteria->add(IdsContactoPeer::CA_FCHELIMINADO, $this->ca_fcheliminado);
		if ($this->isColumnModified(IdsContactoPeer::CA_USUELIMINADO)) $criteria->add(IdsContactoPeer::CA_USUELIMINADO, $this->ca_usueliminado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(IdsContactoPeer::DATABASE_NAME);

		$criteria->add(IdsContactoPeer::CA_IDCONTACTO, $this->ca_idcontacto);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdcontacto();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdcontacto($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdcontacto($this->ca_idcontacto);

		$copyObj->setCaIdsucursal($this->ca_idsucursal);

		$copyObj->setCaNombres($this->ca_nombres);

		$copyObj->setCaPapellido($this->ca_papellido);

		$copyObj->setCaSapellido($this->ca_sapellido);

		$copyObj->setCaSaludo($this->ca_saludo);

		$copyObj->setCaDireccion($this->ca_direccion);

		$copyObj->setCaTelefonos($this->ca_telefonos);

		$copyObj->setCaFax($this->ca_fax);

		$copyObj->setCaEmail($this->ca_email);

		$copyObj->setCaImpoexpo($this->ca_impoexpo);

		$copyObj->setCaTransporte($this->ca_transporte);

		$copyObj->setCaCargo($this->ca_cargo);

		$copyObj->setCaDepartamento($this->ca_departamento);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaSugerido($this->ca_sugerido);

		$copyObj->setCaActivo($this->ca_activo);

		$copyObj->setCaVisibilidad($this->ca_visibilidad);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);

		$copyObj->setCaFcheliminado($this->ca_fcheliminado);

		$copyObj->setCaUsueliminado($this->ca_usueliminado);


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
			self::$peer = new IdsContactoPeer();
		}
		return self::$peer;
	}

	
	public function setIdsSucursal(IdsSucursal $v = null)
	{
		if ($v === null) {
			$this->setCaIdsucursal(NULL);
		} else {
			$this->setCaIdsucursal($v->getCaIdsucursal());
		}

		$this->aIdsSucursal = $v;

						if ($v !== null) {
			$v->addIdsContacto($this);
		}

		return $this;
	}


	
	public function getIdsSucursal(PropelPDO $con = null)
	{
		if ($this->aIdsSucursal === null && ($this->ca_idsucursal !== null)) {
			$c = new Criteria(IdsSucursalPeer::DATABASE_NAME);
			$c->add(IdsSucursalPeer::CA_IDSUCURSAL, $this->ca_idsucursal);
			$this->aIdsSucursal = IdsSucursalPeer::doSelectOne($c, $con);
			
		}
		return $this->aIdsSucursal;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aIdsSucursal = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseIdsContacto:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseIdsContacto::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 