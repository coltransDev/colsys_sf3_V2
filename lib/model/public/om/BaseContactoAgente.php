<?php


abstract class BaseContactoAgente extends BaseObject  implements Persistent {


  const PEER = 'ContactoAgentePeer';

	
	protected static $peer;

	
	protected $ca_idcontacto;

	
	protected $ca_idagente;

	
	protected $ca_nombre;

	
	protected $ca_apellido;

	
	protected $ca_direccion;

	
	protected $ca_telefonos;

	
	protected $ca_fax;

	
	protected $ca_idciudad;

	
	protected $ca_email;

	
	protected $ca_impoexpo;

	
	protected $ca_transporte;

	
	protected $ca_cargo;

	
	protected $ca_detalle;

	
	protected $ca_sugerido;

	
	protected $ca_activo;

	
	protected $ca_fchcreado;

	
	protected $ca_fchactualizado;

	
	protected $ca_usucreado;

	
	protected $ca_usuactualizado;

	
	protected $aAgente;

	
	protected $aCiudad;

	
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

	
	public function getCaIdagente()
	{
		return $this->ca_idagente;
	}

	
	public function getCaNombre()
	{
		return $this->ca_nombre;
	}

	
	public function getCaApellido()
	{
		return $this->ca_apellido;
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

	
	public function getCaIdciudad()
	{
		return $this->ca_idciudad;
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

	
	public function getCaDetalle()
	{
		return $this->ca_detalle;
	}

	
	public function getCaSugerido()
	{
		return $this->ca_sugerido;
	}

	
	public function getCaActivo()
	{
		return $this->ca_activo;
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

	
	public function getCaUsucreado()
	{
		return $this->ca_usucreado;
	}

	
	public function getCaUsuactualizado()
	{
		return $this->ca_usuactualizado;
	}

	
	public function setCaIdcontacto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idcontacto !== $v) {
			$this->ca_idcontacto = $v;
			$this->modifiedColumns[] = ContactoAgentePeer::CA_IDCONTACTO;
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
			$this->modifiedColumns[] = ContactoAgentePeer::CA_IDAGENTE;
		}

		if ($this->aAgente !== null && $this->aAgente->getCaIdagente() !== $v) {
			$this->aAgente = null;
		}

		return $this;
	} 
	
	public function setCaNombre($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_nombre !== $v) {
			$this->ca_nombre = $v;
			$this->modifiedColumns[] = ContactoAgentePeer::CA_NOMBRE;
		}

		return $this;
	} 
	
	public function setCaApellido($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_apellido !== $v) {
			$this->ca_apellido = $v;
			$this->modifiedColumns[] = ContactoAgentePeer::CA_APELLIDO;
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
			$this->modifiedColumns[] = ContactoAgentePeer::CA_DIRECCION;
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
			$this->modifiedColumns[] = ContactoAgentePeer::CA_TELEFONOS;
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
			$this->modifiedColumns[] = ContactoAgentePeer::CA_FAX;
		}

		return $this;
	} 
	
	public function setCaIdciudad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idciudad !== $v) {
			$this->ca_idciudad = $v;
			$this->modifiedColumns[] = ContactoAgentePeer::CA_IDCIUDAD;
		}

		if ($this->aCiudad !== null && $this->aCiudad->getCaIdciudad() !== $v) {
			$this->aCiudad = null;
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
			$this->modifiedColumns[] = ContactoAgentePeer::CA_EMAIL;
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
			$this->modifiedColumns[] = ContactoAgentePeer::CA_IMPOEXPO;
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
			$this->modifiedColumns[] = ContactoAgentePeer::CA_TRANSPORTE;
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
			$this->modifiedColumns[] = ContactoAgentePeer::CA_CARGO;
		}

		return $this;
	} 
	
	public function setCaDetalle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_detalle !== $v) {
			$this->ca_detalle = $v;
			$this->modifiedColumns[] = ContactoAgentePeer::CA_DETALLE;
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
			$this->modifiedColumns[] = ContactoAgentePeer::CA_SUGERIDO;
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
			$this->modifiedColumns[] = ContactoAgentePeer::CA_ACTIVO;
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
				$this->modifiedColumns[] = ContactoAgentePeer::CA_FCHCREADO;
			}
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
				$this->modifiedColumns[] = ContactoAgentePeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = ContactoAgentePeer::CA_USUCREADO;
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
			$this->modifiedColumns[] = ContactoAgentePeer::CA_USUACTUALIZADO;
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

			$this->ca_idcontacto = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_idagente = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_nombre = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_apellido = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_direccion = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_telefonos = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_fax = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_idciudad = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_email = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_impoexpo = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_transporte = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_cargo = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_detalle = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_sugerido = ($row[$startcol + 13] !== null) ? (boolean) $row[$startcol + 13] : null;
			$this->ca_activo = ($row[$startcol + 14] !== null) ? (boolean) $row[$startcol + 14] : null;
			$this->ca_fchcreado = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_fchactualizado = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->ca_usucreado = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
			$this->ca_usuactualizado = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 19; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ContactoAgente object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aAgente !== null && $this->ca_idagente !== $this->aAgente->getCaIdagente()) {
			$this->aAgente = null;
		}
		if ($this->aCiudad !== null && $this->ca_idciudad !== $this->aCiudad->getCaIdciudad()) {
			$this->aCiudad = null;
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
			$con = Propel::getConnection(ContactoAgentePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = ContactoAgentePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aAgente = null;
			$this->aCiudad = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseContactoAgente:delete:pre') as $callable)
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
			$con = Propel::getConnection(ContactoAgentePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			ContactoAgentePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseContactoAgente:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseContactoAgente:save:pre') as $callable)
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
			$con = Propel::getConnection(ContactoAgentePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseContactoAgente:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			ContactoAgentePeer::addInstanceToPool($this);
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

												
			if ($this->aAgente !== null) {
				if ($this->aAgente->isModified() || $this->aAgente->isNew()) {
					$affectedRows += $this->aAgente->save($con);
				}
				$this->setAgente($this->aAgente);
			}

			if ($this->aCiudad !== null) {
				if ($this->aCiudad->isModified() || $this->aCiudad->isNew()) {
					$affectedRows += $this->aCiudad->save($con);
				}
				$this->setCiudad($this->aCiudad);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ContactoAgentePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += ContactoAgentePeer::doUpdate($this, $con);
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


												
			if ($this->aAgente !== null) {
				if (!$this->aAgente->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAgente->getValidationFailures());
				}
			}

			if ($this->aCiudad !== null) {
				if (!$this->aCiudad->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCiudad->getValidationFailures());
				}
			}


			if (($retval = ContactoAgentePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ContactoAgentePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdagente();
				break;
			case 2:
				return $this->getCaNombre();
				break;
			case 3:
				return $this->getCaApellido();
				break;
			case 4:
				return $this->getCaDireccion();
				break;
			case 5:
				return $this->getCaTelefonos();
				break;
			case 6:
				return $this->getCaFax();
				break;
			case 7:
				return $this->getCaIdciudad();
				break;
			case 8:
				return $this->getCaEmail();
				break;
			case 9:
				return $this->getCaImpoexpo();
				break;
			case 10:
				return $this->getCaTransporte();
				break;
			case 11:
				return $this->getCaCargo();
				break;
			case 12:
				return $this->getCaDetalle();
				break;
			case 13:
				return $this->getCaSugerido();
				break;
			case 14:
				return $this->getCaActivo();
				break;
			case 15:
				return $this->getCaFchcreado();
				break;
			case 16:
				return $this->getCaFchactualizado();
				break;
			case 17:
				return $this->getCaUsucreado();
				break;
			case 18:
				return $this->getCaUsuactualizado();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = ContactoAgentePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdcontacto(),
			$keys[1] => $this->getCaIdagente(),
			$keys[2] => $this->getCaNombre(),
			$keys[3] => $this->getCaApellido(),
			$keys[4] => $this->getCaDireccion(),
			$keys[5] => $this->getCaTelefonos(),
			$keys[6] => $this->getCaFax(),
			$keys[7] => $this->getCaIdciudad(),
			$keys[8] => $this->getCaEmail(),
			$keys[9] => $this->getCaImpoexpo(),
			$keys[10] => $this->getCaTransporte(),
			$keys[11] => $this->getCaCargo(),
			$keys[12] => $this->getCaDetalle(),
			$keys[13] => $this->getCaSugerido(),
			$keys[14] => $this->getCaActivo(),
			$keys[15] => $this->getCaFchcreado(),
			$keys[16] => $this->getCaFchactualizado(),
			$keys[17] => $this->getCaUsucreado(),
			$keys[18] => $this->getCaUsuactualizado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ContactoAgentePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdcontacto($value);
				break;
			case 1:
				$this->setCaIdagente($value);
				break;
			case 2:
				$this->setCaNombre($value);
				break;
			case 3:
				$this->setCaApellido($value);
				break;
			case 4:
				$this->setCaDireccion($value);
				break;
			case 5:
				$this->setCaTelefonos($value);
				break;
			case 6:
				$this->setCaFax($value);
				break;
			case 7:
				$this->setCaIdciudad($value);
				break;
			case 8:
				$this->setCaEmail($value);
				break;
			case 9:
				$this->setCaImpoexpo($value);
				break;
			case 10:
				$this->setCaTransporte($value);
				break;
			case 11:
				$this->setCaCargo($value);
				break;
			case 12:
				$this->setCaDetalle($value);
				break;
			case 13:
				$this->setCaSugerido($value);
				break;
			case 14:
				$this->setCaActivo($value);
				break;
			case 15:
				$this->setCaFchcreado($value);
				break;
			case 16:
				$this->setCaFchactualizado($value);
				break;
			case 17:
				$this->setCaUsucreado($value);
				break;
			case 18:
				$this->setCaUsuactualizado($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ContactoAgentePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdcontacto($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdagente($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaNombre($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaApellido($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaDireccion($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaTelefonos($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaFax($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaIdciudad($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaEmail($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaImpoexpo($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaTransporte($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaCargo($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaDetalle($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaSugerido($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaActivo($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaFchcreado($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaFchactualizado($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaUsucreado($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCaUsuactualizado($arr[$keys[18]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ContactoAgentePeer::DATABASE_NAME);

		if ($this->isColumnModified(ContactoAgentePeer::CA_IDCONTACTO)) $criteria->add(ContactoAgentePeer::CA_IDCONTACTO, $this->ca_idcontacto);
		if ($this->isColumnModified(ContactoAgentePeer::CA_IDAGENTE)) $criteria->add(ContactoAgentePeer::CA_IDAGENTE, $this->ca_idagente);
		if ($this->isColumnModified(ContactoAgentePeer::CA_NOMBRE)) $criteria->add(ContactoAgentePeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(ContactoAgentePeer::CA_APELLIDO)) $criteria->add(ContactoAgentePeer::CA_APELLIDO, $this->ca_apellido);
		if ($this->isColumnModified(ContactoAgentePeer::CA_DIRECCION)) $criteria->add(ContactoAgentePeer::CA_DIRECCION, $this->ca_direccion);
		if ($this->isColumnModified(ContactoAgentePeer::CA_TELEFONOS)) $criteria->add(ContactoAgentePeer::CA_TELEFONOS, $this->ca_telefonos);
		if ($this->isColumnModified(ContactoAgentePeer::CA_FAX)) $criteria->add(ContactoAgentePeer::CA_FAX, $this->ca_fax);
		if ($this->isColumnModified(ContactoAgentePeer::CA_IDCIUDAD)) $criteria->add(ContactoAgentePeer::CA_IDCIUDAD, $this->ca_idciudad);
		if ($this->isColumnModified(ContactoAgentePeer::CA_EMAIL)) $criteria->add(ContactoAgentePeer::CA_EMAIL, $this->ca_email);
		if ($this->isColumnModified(ContactoAgentePeer::CA_IMPOEXPO)) $criteria->add(ContactoAgentePeer::CA_IMPOEXPO, $this->ca_impoexpo);
		if ($this->isColumnModified(ContactoAgentePeer::CA_TRANSPORTE)) $criteria->add(ContactoAgentePeer::CA_TRANSPORTE, $this->ca_transporte);
		if ($this->isColumnModified(ContactoAgentePeer::CA_CARGO)) $criteria->add(ContactoAgentePeer::CA_CARGO, $this->ca_cargo);
		if ($this->isColumnModified(ContactoAgentePeer::CA_DETALLE)) $criteria->add(ContactoAgentePeer::CA_DETALLE, $this->ca_detalle);
		if ($this->isColumnModified(ContactoAgentePeer::CA_SUGERIDO)) $criteria->add(ContactoAgentePeer::CA_SUGERIDO, $this->ca_sugerido);
		if ($this->isColumnModified(ContactoAgentePeer::CA_ACTIVO)) $criteria->add(ContactoAgentePeer::CA_ACTIVO, $this->ca_activo);
		if ($this->isColumnModified(ContactoAgentePeer::CA_FCHCREADO)) $criteria->add(ContactoAgentePeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(ContactoAgentePeer::CA_FCHACTUALIZADO)) $criteria->add(ContactoAgentePeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(ContactoAgentePeer::CA_USUCREADO)) $criteria->add(ContactoAgentePeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(ContactoAgentePeer::CA_USUACTUALIZADO)) $criteria->add(ContactoAgentePeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ContactoAgentePeer::DATABASE_NAME);

		$criteria->add(ContactoAgentePeer::CA_IDCONTACTO, $this->ca_idcontacto);

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

		$copyObj->setCaIdagente($this->ca_idagente);

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaApellido($this->ca_apellido);

		$copyObj->setCaDireccion($this->ca_direccion);

		$copyObj->setCaTelefonos($this->ca_telefonos);

		$copyObj->setCaFax($this->ca_fax);

		$copyObj->setCaIdciudad($this->ca_idciudad);

		$copyObj->setCaEmail($this->ca_email);

		$copyObj->setCaImpoexpo($this->ca_impoexpo);

		$copyObj->setCaTransporte($this->ca_transporte);

		$copyObj->setCaCargo($this->ca_cargo);

		$copyObj->setCaDetalle($this->ca_detalle);

		$copyObj->setCaSugerido($this->ca_sugerido);

		$copyObj->setCaActivo($this->ca_activo);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);


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
			self::$peer = new ContactoAgentePeer();
		}
		return self::$peer;
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
			$v->addContactoAgente($this);
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

	
	public function setCiudad(Ciudad $v = null)
	{
		if ($v === null) {
			$this->setCaIdciudad(NULL);
		} else {
			$this->setCaIdciudad($v->getCaIdciudad());
		}

		$this->aCiudad = $v;

						if ($v !== null) {
			$v->addContactoAgente($this);
		}

		return $this;
	}


	
	public function getCiudad(PropelPDO $con = null)
	{
		if ($this->aCiudad === null && (($this->ca_idciudad !== "" && $this->ca_idciudad !== null))) {
			$c = new Criteria(CiudadPeer::DATABASE_NAME);
			$c->add(CiudadPeer::CA_IDCIUDAD, $this->ca_idciudad);
			$this->aCiudad = CiudadPeer::doSelectOne($c, $con);
			
		}
		return $this->aCiudad;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aAgente = null;
			$this->aCiudad = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseContactoAgente:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseContactoAgente::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 