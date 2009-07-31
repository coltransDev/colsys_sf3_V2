<?php


abstract class BaseContacto extends BaseObject  implements Persistent {


  const PEER = 'ContactoPeer';

	
	protected static $peer;

	
	protected $ca_idcontacto;

	
	protected $ca_idcliente;

	
	protected $ca_papellido;

	
	protected $ca_sapellido;

	
	protected $ca_nombres;

	
	protected $ca_saludo;

	
	protected $ca_cargo;

	
	protected $ca_departamento;

	
	protected $ca_telefonos;

	
	protected $ca_fax;

	
	protected $ca_email;

	
	protected $ca_observaciones;

	
	protected $ca_fchcreado;

	
	protected $ca_fchactualizado;

	
	protected $ca_usucreado;

	
	protected $ca_usuactualizado;

	
	protected $ca_cumpleanos;

	
	protected $aCliente;

	
	protected $collTrackingUsers;

	
	private $lastTrackingUserCriteria = null;

	
	protected $collCotizacions;

	
	private $lastCotizacionCriteria = null;

	
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

	
	public function getCaIdcliente()
	{
		return $this->ca_idcliente;
	}

	
	public function getCaPapellido()
	{
		return $this->ca_papellido;
	}

	
	public function getCaSapellido()
	{
		return $this->ca_sapellido;
	}

	
	public function getCaNombres()
	{
		return $this->ca_nombres;
	}

	
	public function getCaSaludo()
	{
		return $this->ca_saludo;
	}

	
	public function getCaCargo()
	{
		return $this->ca_cargo;
	}

	
	public function getCaDepartamento()
	{
		return $this->ca_departamento;
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

	
	public function getCaObservaciones()
	{
		return $this->ca_observaciones;
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

	
	public function getCaFchactualizado($format = 'Y-m-d')
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

	
	public function getCaCumpleanos()
	{
		return $this->ca_cumpleanos;
	}

	
	public function setCaIdcontacto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcontacto !== $v) {
			$this->ca_idcontacto = $v;
			$this->modifiedColumns[] = ContactoPeer::CA_IDCONTACTO;
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
			$this->modifiedColumns[] = ContactoPeer::CA_IDCLIENTE;
		}

		if ($this->aCliente !== null && $this->aCliente->getCaIdcliente() !== $v) {
			$this->aCliente = null;
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
			$this->modifiedColumns[] = ContactoPeer::CA_PAPELLIDO;
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
			$this->modifiedColumns[] = ContactoPeer::CA_SAPELLIDO;
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
			$this->modifiedColumns[] = ContactoPeer::CA_NOMBRES;
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
			$this->modifiedColumns[] = ContactoPeer::CA_SALUDO;
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
			$this->modifiedColumns[] = ContactoPeer::CA_CARGO;
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
			$this->modifiedColumns[] = ContactoPeer::CA_DEPARTAMENTO;
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
			$this->modifiedColumns[] = ContactoPeer::CA_TELEFONOS;
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
			$this->modifiedColumns[] = ContactoPeer::CA_FAX;
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
			$this->modifiedColumns[] = ContactoPeer::CA_EMAIL;
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
			$this->modifiedColumns[] = ContactoPeer::CA_OBSERVACIONES;
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
				$this->modifiedColumns[] = ContactoPeer::CA_FCHCREADO;
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
			
			$currNorm = ($this->ca_fchactualizado !== null && $tmpDt = new DateTime($this->ca_fchactualizado)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchactualizado = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = ContactoPeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = ContactoPeer::CA_USUCREADO;
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
			$this->modifiedColumns[] = ContactoPeer::CA_USUACTUALIZADO;
		}

		return $this;
	} 
	
	public function setCaCumpleanos($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_cumpleanos !== $v) {
			$this->ca_cumpleanos = $v;
			$this->modifiedColumns[] = ContactoPeer::CA_CUMPLEANOS;
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
			$this->ca_idcliente = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_papellido = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_sapellido = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_nombres = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_saludo = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_cargo = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_departamento = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_telefonos = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_fax = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_email = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_observaciones = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_fchcreado = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_fchactualizado = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_usucreado = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_usuactualizado = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_cumpleanos = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 17; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Contacto object", $e);
		}
	}

	
	public function ensureConsistency()
	{

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
			$con = Propel::getConnection(ContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = ContactoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aCliente = null;
			$this->collTrackingUsers = null;
			$this->lastTrackingUserCriteria = null;

			$this->collCotizacions = null;
			$this->lastCotizacionCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseContacto:delete:pre') as $callable)
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
			$con = Propel::getConnection(ContactoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			ContactoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseContacto:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseContacto:save:pre') as $callable)
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
			$con = Propel::getConnection(ContactoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseContacto:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			ContactoPeer::addInstanceToPool($this);
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

												
			if ($this->aCliente !== null) {
				if ($this->aCliente->isModified() || $this->aCliente->isNew()) {
					$affectedRows += $this->aCliente->save($con);
				}
				$this->setCliente($this->aCliente);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ContactoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += ContactoPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collTrackingUsers !== null) {
				foreach ($this->collTrackingUsers as $referrerFK) {
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


												
			if ($this->aCliente !== null) {
				if (!$this->aCliente->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCliente->getValidationFailures());
				}
			}


			if (($retval = ContactoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collTrackingUsers !== null) {
					foreach ($this->collTrackingUsers as $referrerFK) {
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


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ContactoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdcliente();
				break;
			case 2:
				return $this->getCaPapellido();
				break;
			case 3:
				return $this->getCaSapellido();
				break;
			case 4:
				return $this->getCaNombres();
				break;
			case 5:
				return $this->getCaSaludo();
				break;
			case 6:
				return $this->getCaCargo();
				break;
			case 7:
				return $this->getCaDepartamento();
				break;
			case 8:
				return $this->getCaTelefonos();
				break;
			case 9:
				return $this->getCaFax();
				break;
			case 10:
				return $this->getCaEmail();
				break;
			case 11:
				return $this->getCaObservaciones();
				break;
			case 12:
				return $this->getCaFchcreado();
				break;
			case 13:
				return $this->getCaFchactualizado();
				break;
			case 14:
				return $this->getCaUsucreado();
				break;
			case 15:
				return $this->getCaUsuactualizado();
				break;
			case 16:
				return $this->getCaCumpleanos();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = ContactoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdcontacto(),
			$keys[1] => $this->getCaIdcliente(),
			$keys[2] => $this->getCaPapellido(),
			$keys[3] => $this->getCaSapellido(),
			$keys[4] => $this->getCaNombres(),
			$keys[5] => $this->getCaSaludo(),
			$keys[6] => $this->getCaCargo(),
			$keys[7] => $this->getCaDepartamento(),
			$keys[8] => $this->getCaTelefonos(),
			$keys[9] => $this->getCaFax(),
			$keys[10] => $this->getCaEmail(),
			$keys[11] => $this->getCaObservaciones(),
			$keys[12] => $this->getCaFchcreado(),
			$keys[13] => $this->getCaFchactualizado(),
			$keys[14] => $this->getCaUsucreado(),
			$keys[15] => $this->getCaUsuactualizado(),
			$keys[16] => $this->getCaCumpleanos(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ContactoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdcontacto($value);
				break;
			case 1:
				$this->setCaIdcliente($value);
				break;
			case 2:
				$this->setCaPapellido($value);
				break;
			case 3:
				$this->setCaSapellido($value);
				break;
			case 4:
				$this->setCaNombres($value);
				break;
			case 5:
				$this->setCaSaludo($value);
				break;
			case 6:
				$this->setCaCargo($value);
				break;
			case 7:
				$this->setCaDepartamento($value);
				break;
			case 8:
				$this->setCaTelefonos($value);
				break;
			case 9:
				$this->setCaFax($value);
				break;
			case 10:
				$this->setCaEmail($value);
				break;
			case 11:
				$this->setCaObservaciones($value);
				break;
			case 12:
				$this->setCaFchcreado($value);
				break;
			case 13:
				$this->setCaFchactualizado($value);
				break;
			case 14:
				$this->setCaUsucreado($value);
				break;
			case 15:
				$this->setCaUsuactualizado($value);
				break;
			case 16:
				$this->setCaCumpleanos($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ContactoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdcontacto($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdcliente($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaPapellido($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaSapellido($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaNombres($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaSaludo($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaCargo($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaDepartamento($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaTelefonos($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaFax($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaEmail($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaObservaciones($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaFchcreado($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaFchactualizado($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaUsucreado($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaUsuactualizado($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaCumpleanos($arr[$keys[16]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ContactoPeer::DATABASE_NAME);

		if ($this->isColumnModified(ContactoPeer::CA_IDCONTACTO)) $criteria->add(ContactoPeer::CA_IDCONTACTO, $this->ca_idcontacto);
		if ($this->isColumnModified(ContactoPeer::CA_IDCLIENTE)) $criteria->add(ContactoPeer::CA_IDCLIENTE, $this->ca_idcliente);
		if ($this->isColumnModified(ContactoPeer::CA_PAPELLIDO)) $criteria->add(ContactoPeer::CA_PAPELLIDO, $this->ca_papellido);
		if ($this->isColumnModified(ContactoPeer::CA_SAPELLIDO)) $criteria->add(ContactoPeer::CA_SAPELLIDO, $this->ca_sapellido);
		if ($this->isColumnModified(ContactoPeer::CA_NOMBRES)) $criteria->add(ContactoPeer::CA_NOMBRES, $this->ca_nombres);
		if ($this->isColumnModified(ContactoPeer::CA_SALUDO)) $criteria->add(ContactoPeer::CA_SALUDO, $this->ca_saludo);
		if ($this->isColumnModified(ContactoPeer::CA_CARGO)) $criteria->add(ContactoPeer::CA_CARGO, $this->ca_cargo);
		if ($this->isColumnModified(ContactoPeer::CA_DEPARTAMENTO)) $criteria->add(ContactoPeer::CA_DEPARTAMENTO, $this->ca_departamento);
		if ($this->isColumnModified(ContactoPeer::CA_TELEFONOS)) $criteria->add(ContactoPeer::CA_TELEFONOS, $this->ca_telefonos);
		if ($this->isColumnModified(ContactoPeer::CA_FAX)) $criteria->add(ContactoPeer::CA_FAX, $this->ca_fax);
		if ($this->isColumnModified(ContactoPeer::CA_EMAIL)) $criteria->add(ContactoPeer::CA_EMAIL, $this->ca_email);
		if ($this->isColumnModified(ContactoPeer::CA_OBSERVACIONES)) $criteria->add(ContactoPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(ContactoPeer::CA_FCHCREADO)) $criteria->add(ContactoPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(ContactoPeer::CA_FCHACTUALIZADO)) $criteria->add(ContactoPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(ContactoPeer::CA_USUCREADO)) $criteria->add(ContactoPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(ContactoPeer::CA_USUACTUALIZADO)) $criteria->add(ContactoPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);
		if ($this->isColumnModified(ContactoPeer::CA_CUMPLEANOS)) $criteria->add(ContactoPeer::CA_CUMPLEANOS, $this->ca_cumpleanos);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ContactoPeer::DATABASE_NAME);

		$criteria->add(ContactoPeer::CA_IDCONTACTO, $this->ca_idcontacto);

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

		$copyObj->setCaIdcliente($this->ca_idcliente);

		$copyObj->setCaPapellido($this->ca_papellido);

		$copyObj->setCaSapellido($this->ca_sapellido);

		$copyObj->setCaNombres($this->ca_nombres);

		$copyObj->setCaSaludo($this->ca_saludo);

		$copyObj->setCaCargo($this->ca_cargo);

		$copyObj->setCaDepartamento($this->ca_departamento);

		$copyObj->setCaTelefonos($this->ca_telefonos);

		$copyObj->setCaFax($this->ca_fax);

		$copyObj->setCaEmail($this->ca_email);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);

		$copyObj->setCaCumpleanos($this->ca_cumpleanos);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getTrackingUsers() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addTrackingUser($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getCotizacions() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addCotizacion($relObj->copy($deepCopy));
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
			self::$peer = new ContactoPeer();
		}
		return self::$peer;
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
			$v->addContacto($this);
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

	
	public function clearTrackingUsers()
	{
		$this->collTrackingUsers = null; 	}

	
	public function initTrackingUsers()
	{
		$this->collTrackingUsers = array();
	}

	
	public function getTrackingUsers($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ContactoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTrackingUsers === null) {
			if ($this->isNew()) {
			   $this->collTrackingUsers = array();
			} else {

				$criteria->add(TrackingUserPeer::CA_IDCONTACTO, $this->ca_idcontacto);

				TrackingUserPeer::addSelectColumns($criteria);
				$this->collTrackingUsers = TrackingUserPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TrackingUserPeer::CA_IDCONTACTO, $this->ca_idcontacto);

				TrackingUserPeer::addSelectColumns($criteria);
				if (!isset($this->lastTrackingUserCriteria) || !$this->lastTrackingUserCriteria->equals($criteria)) {
					$this->collTrackingUsers = TrackingUserPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTrackingUserCriteria = $criteria;
		return $this->collTrackingUsers;
	}

	
	public function countTrackingUsers(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ContactoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collTrackingUsers === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(TrackingUserPeer::CA_IDCONTACTO, $this->ca_idcontacto);

				$count = TrackingUserPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TrackingUserPeer::CA_IDCONTACTO, $this->ca_idcontacto);

				if (!isset($this->lastTrackingUserCriteria) || !$this->lastTrackingUserCriteria->equals($criteria)) {
					$count = TrackingUserPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collTrackingUsers);
				}
			} else {
				$count = count($this->collTrackingUsers);
			}
		}
		return $count;
	}

	
	public function addTrackingUser(TrackingUser $l)
	{
		if ($this->collTrackingUsers === null) {
			$this->initTrackingUsers();
		}
		if (!in_array($l, $this->collTrackingUsers, true)) { 			array_push($this->collTrackingUsers, $l);
			$l->setContacto($this);
		}
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
			$criteria = new Criteria(ContactoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotizacions === null) {
			if ($this->isNew()) {
			   $this->collCotizacions = array();
			} else {

				$criteria->add(CotizacionPeer::CA_IDCONTACTO, $this->ca_idcontacto);

				CotizacionPeer::addSelectColumns($criteria);
				$this->collCotizacions = CotizacionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotizacionPeer::CA_IDCONTACTO, $this->ca_idcontacto);

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
			$criteria = new Criteria(ContactoPeer::DATABASE_NAME);
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

				$criteria->add(CotizacionPeer::CA_IDCONTACTO, $this->ca_idcontacto);

				$count = CotizacionPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotizacionPeer::CA_IDCONTACTO, $this->ca_idcontacto);

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
			$l->setContacto($this);
		}
	}


	
	public function getCotizacionsJoinNotTarea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ContactoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotizacions === null) {
			if ($this->isNew()) {
				$this->collCotizacions = array();
			} else {

				$criteria->add(CotizacionPeer::CA_IDCONTACTO, $this->ca_idcontacto);

				$this->collCotizacions = CotizacionPeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(CotizacionPeer::CA_IDCONTACTO, $this->ca_idcontacto);

			if (!isset($this->lastCotizacionCriteria) || !$this->lastCotizacionCriteria->equals($criteria)) {
				$this->collCotizacions = CotizacionPeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotizacionCriteria = $criteria;

		return $this->collCotizacions;
	}


	
	public function getCotizacionsJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ContactoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotizacions === null) {
			if ($this->isNew()) {
				$this->collCotizacions = array();
			} else {

				$criteria->add(CotizacionPeer::CA_IDCONTACTO, $this->ca_idcontacto);

				$this->collCotizacions = CotizacionPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(CotizacionPeer::CA_IDCONTACTO, $this->ca_idcontacto);

			if (!isset($this->lastCotizacionCriteria) || !$this->lastCotizacionCriteria->equals($criteria)) {
				$this->collCotizacions = CotizacionPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotizacionCriteria = $criteria;

		return $this->collCotizacions;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collTrackingUsers) {
				foreach ((array) $this->collTrackingUsers as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCotizacions) {
				foreach ((array) $this->collCotizacions as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collTrackingUsers = null;
		$this->collCotizacions = null;
			$this->aCliente = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseContacto:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseContacto::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 