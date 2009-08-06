<?php


abstract class BaseUsuario extends BaseObject  implements Persistent {


  const PEER = 'UsuarioPeer';

	
	protected static $peer;

	
	protected $ca_login;

	
	protected $ca_nombre;

	
	protected $ca_cargo;

	
	protected $ca_departamento;

	
	protected $ca_idsucursal;

	
	protected $ca_email;

	
	protected $ca_rutinas;

	
	protected $ca_extension;

	
	protected $ca_authmethod;

	
	protected $ca_passwd;

	
	protected $ca_salt;

	
	protected $ca_activo;

	
	protected $ca_forcechange;

	
	protected $ca_sucursal;

	
	protected $aSucursal;

	
	protected $collNivelesAccesos;

	
	private $lastNivelesAccesoCriteria = null;

	
	protected $collAccesoUsuarios;

	
	private $lastAccesoUsuarioCriteria = null;

	
	protected $collUsuarioPerfils;

	
	private $lastUsuarioPerfilCriteria = null;

	
	protected $collUsuarioLogs;

	
	private $lastUsuarioLogCriteria = null;

	
	protected $collHdeskTickets;

	
	private $lastHdeskTicketCriteria = null;

	
	protected $collHdeskResponses;

	
	private $lastHdeskResponseCriteria = null;

	
	protected $collHdeskUserGroups;

	
	private $lastHdeskUserGroupCriteria = null;

	
	protected $collHdeskKBases;

	
	private $lastHdeskKBaseCriteria = null;

	
	protected $collNotTareaAsignacions;

	
	private $lastNotTareaAsignacionCriteria = null;

	
	protected $collReportes;

	
	private $lastReporteCriteria = null;

	
	protected $collRepStatusRespuestas;

	
	private $lastRepStatusRespuestaCriteria = null;

	
	protected $collCotizacions;

	
	private $lastCotizacionCriteria = null;

	
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

	
	public function getCaLogin()
	{
		return $this->ca_login;
	}

	
	public function getCaNombre()
	{
		return $this->ca_nombre;
	}

	
	public function getCaCargo()
	{
		return $this->ca_cargo;
	}

	
	public function getCaDepartamento()
	{
		return $this->ca_departamento;
	}

	
	public function getCaIdsucursal()
	{
		return $this->ca_idsucursal;
	}

	
	public function getCaEmail()
	{
		return $this->ca_email;
	}

	
	public function getCaRutinas()
	{
		return $this->ca_rutinas;
	}

	
	public function getCaExtension()
	{
		return $this->ca_extension;
	}

	
	public function getCaAuthmethod()
	{
		return $this->ca_authmethod;
	}

	
	public function getCaPasswd()
	{
		return $this->ca_passwd;
	}

	
	public function getCaSalt()
	{
		return $this->ca_salt;
	}

	
	public function getCaActivo()
	{
		return $this->ca_activo;
	}

	
	public function getCaForcechange()
	{
		return $this->ca_forcechange;
	}

	
	public function getCaSucursal()
	{
		return $this->ca_sucursal;
	}

	
	public function setCaLogin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_login !== $v) {
			$this->ca_login = $v;
			$this->modifiedColumns[] = UsuarioPeer::CA_LOGIN;
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
			$this->modifiedColumns[] = UsuarioPeer::CA_NOMBRE;
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
			$this->modifiedColumns[] = UsuarioPeer::CA_CARGO;
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
			$this->modifiedColumns[] = UsuarioPeer::CA_DEPARTAMENTO;
		}

		return $this;
	} 
	
	public function setCaIdsucursal($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idsucursal !== $v) {
			$this->ca_idsucursal = $v;
			$this->modifiedColumns[] = UsuarioPeer::CA_IDSUCURSAL;
		}

		if ($this->aSucursal !== null && $this->aSucursal->getCaIdsucursal() !== $v) {
			$this->aSucursal = null;
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
			$this->modifiedColumns[] = UsuarioPeer::CA_EMAIL;
		}

		return $this;
	} 
	
	public function setCaRutinas($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_rutinas !== $v) {
			$this->ca_rutinas = $v;
			$this->modifiedColumns[] = UsuarioPeer::CA_RUTINAS;
		}

		return $this;
	} 
	
	public function setCaExtension($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_extension !== $v) {
			$this->ca_extension = $v;
			$this->modifiedColumns[] = UsuarioPeer::CA_EXTENSION;
		}

		return $this;
	} 
	
	public function setCaAuthmethod($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_authmethod !== $v) {
			$this->ca_authmethod = $v;
			$this->modifiedColumns[] = UsuarioPeer::CA_AUTHMETHOD;
		}

		return $this;
	} 
	
	public function setCaPasswd($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_passwd !== $v) {
			$this->ca_passwd = $v;
			$this->modifiedColumns[] = UsuarioPeer::CA_PASSWD;
		}

		return $this;
	} 
	
	public function setCaSalt($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_salt !== $v) {
			$this->ca_salt = $v;
			$this->modifiedColumns[] = UsuarioPeer::CA_SALT;
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
			$this->modifiedColumns[] = UsuarioPeer::CA_ACTIVO;
		}

		return $this;
	} 
	
	public function setCaForcechange($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_forcechange !== $v) {
			$this->ca_forcechange = $v;
			$this->modifiedColumns[] = UsuarioPeer::CA_FORCECHANGE;
		}

		return $this;
	} 
	
	public function setCaSucursal($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_sucursal !== $v) {
			$this->ca_sucursal = $v;
			$this->modifiedColumns[] = UsuarioPeer::CA_SUCURSAL;
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

			$this->ca_login = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_nombre = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_cargo = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_departamento = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_idsucursal = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_email = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_rutinas = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_extension = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_authmethod = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_passwd = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_salt = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_activo = ($row[$startcol + 11] !== null) ? (boolean) $row[$startcol + 11] : null;
			$this->ca_forcechange = ($row[$startcol + 12] !== null) ? (boolean) $row[$startcol + 12] : null;
			$this->ca_sucursal = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 14; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Usuario object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aSucursal !== null && $this->ca_idsucursal !== $this->aSucursal->getCaIdsucursal()) {
			$this->aSucursal = null;
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
			$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = UsuarioPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aSucursal = null;
			$this->collNivelesAccesos = null;
			$this->lastNivelesAccesoCriteria = null;

			$this->collAccesoUsuarios = null;
			$this->lastAccesoUsuarioCriteria = null;

			$this->collUsuarioPerfils = null;
			$this->lastUsuarioPerfilCriteria = null;

			$this->collUsuarioLogs = null;
			$this->lastUsuarioLogCriteria = null;

			$this->collHdeskTickets = null;
			$this->lastHdeskTicketCriteria = null;

			$this->collHdeskResponses = null;
			$this->lastHdeskResponseCriteria = null;

			$this->collHdeskUserGroups = null;
			$this->lastHdeskUserGroupCriteria = null;

			$this->collHdeskKBases = null;
			$this->lastHdeskKBaseCriteria = null;

			$this->collNotTareaAsignacions = null;
			$this->lastNotTareaAsignacionCriteria = null;

			$this->collReportes = null;
			$this->lastReporteCriteria = null;

			$this->collRepStatusRespuestas = null;
			$this->lastRepStatusRespuestaCriteria = null;

			$this->collCotizacions = null;
			$this->lastCotizacionCriteria = null;

			$this->collCotSeguimientos = null;
			$this->lastCotSeguimientoCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseUsuario:delete:pre') as $callable)
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
			$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			UsuarioPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseUsuario:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseUsuario:save:pre') as $callable)
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
			$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseUsuario:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			UsuarioPeer::addInstanceToPool($this);
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

												
			if ($this->aSucursal !== null) {
				if ($this->aSucursal->isModified() || $this->aSucursal->isNew()) {
					$affectedRows += $this->aSucursal->save($con);
				}
				$this->setSucursal($this->aSucursal);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = UsuarioPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += UsuarioPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collNivelesAccesos !== null) {
				foreach ($this->collNivelesAccesos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collAccesoUsuarios !== null) {
				foreach ($this->collAccesoUsuarios as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collUsuarioPerfils !== null) {
				foreach ($this->collUsuarioPerfils as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collUsuarioLogs !== null) {
				foreach ($this->collUsuarioLogs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collHdeskTickets !== null) {
				foreach ($this->collHdeskTickets as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collHdeskResponses !== null) {
				foreach ($this->collHdeskResponses as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collHdeskUserGroups !== null) {
				foreach ($this->collHdeskUserGroups as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collHdeskKBases !== null) {
				foreach ($this->collHdeskKBases as $referrerFK) {
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

			if ($this->collRepStatusRespuestas !== null) {
				foreach ($this->collRepStatusRespuestas as $referrerFK) {
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


												
			if ($this->aSucursal !== null) {
				if (!$this->aSucursal->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSucursal->getValidationFailures());
				}
			}


			if (($retval = UsuarioPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collNivelesAccesos !== null) {
					foreach ($this->collNivelesAccesos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collAccesoUsuarios !== null) {
					foreach ($this->collAccesoUsuarios as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collUsuarioPerfils !== null) {
					foreach ($this->collUsuarioPerfils as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collUsuarioLogs !== null) {
					foreach ($this->collUsuarioLogs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collHdeskTickets !== null) {
					foreach ($this->collHdeskTickets as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collHdeskResponses !== null) {
					foreach ($this->collHdeskResponses as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collHdeskUserGroups !== null) {
					foreach ($this->collHdeskUserGroups as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collHdeskKBases !== null) {
					foreach ($this->collHdeskKBases as $referrerFK) {
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

				if ($this->collRepStatusRespuestas !== null) {
					foreach ($this->collRepStatusRespuestas as $referrerFK) {
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
		$pos = UsuarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaLogin();
				break;
			case 1:
				return $this->getCaNombre();
				break;
			case 2:
				return $this->getCaCargo();
				break;
			case 3:
				return $this->getCaDepartamento();
				break;
			case 4:
				return $this->getCaIdsucursal();
				break;
			case 5:
				return $this->getCaEmail();
				break;
			case 6:
				return $this->getCaRutinas();
				break;
			case 7:
				return $this->getCaExtension();
				break;
			case 8:
				return $this->getCaAuthmethod();
				break;
			case 9:
				return $this->getCaPasswd();
				break;
			case 10:
				return $this->getCaSalt();
				break;
			case 11:
				return $this->getCaActivo();
				break;
			case 12:
				return $this->getCaForcechange();
				break;
			case 13:
				return $this->getCaSucursal();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = UsuarioPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaLogin(),
			$keys[1] => $this->getCaNombre(),
			$keys[2] => $this->getCaCargo(),
			$keys[3] => $this->getCaDepartamento(),
			$keys[4] => $this->getCaIdsucursal(),
			$keys[5] => $this->getCaEmail(),
			$keys[6] => $this->getCaRutinas(),
			$keys[7] => $this->getCaExtension(),
			$keys[8] => $this->getCaAuthmethod(),
			$keys[9] => $this->getCaPasswd(),
			$keys[10] => $this->getCaSalt(),
			$keys[11] => $this->getCaActivo(),
			$keys[12] => $this->getCaForcechange(),
			$keys[13] => $this->getCaSucursal(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UsuarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaLogin($value);
				break;
			case 1:
				$this->setCaNombre($value);
				break;
			case 2:
				$this->setCaCargo($value);
				break;
			case 3:
				$this->setCaDepartamento($value);
				break;
			case 4:
				$this->setCaIdsucursal($value);
				break;
			case 5:
				$this->setCaEmail($value);
				break;
			case 6:
				$this->setCaRutinas($value);
				break;
			case 7:
				$this->setCaExtension($value);
				break;
			case 8:
				$this->setCaAuthmethod($value);
				break;
			case 9:
				$this->setCaPasswd($value);
				break;
			case 10:
				$this->setCaSalt($value);
				break;
			case 11:
				$this->setCaActivo($value);
				break;
			case 12:
				$this->setCaForcechange($value);
				break;
			case 13:
				$this->setCaSucursal($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UsuarioPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaLogin($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaCargo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaDepartamento($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaIdsucursal($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaEmail($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaRutinas($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaExtension($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaAuthmethod($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaPasswd($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaSalt($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaActivo($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaForcechange($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaSucursal($arr[$keys[13]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);

		if ($this->isColumnModified(UsuarioPeer::CA_LOGIN)) $criteria->add(UsuarioPeer::CA_LOGIN, $this->ca_login);
		if ($this->isColumnModified(UsuarioPeer::CA_NOMBRE)) $criteria->add(UsuarioPeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(UsuarioPeer::CA_CARGO)) $criteria->add(UsuarioPeer::CA_CARGO, $this->ca_cargo);
		if ($this->isColumnModified(UsuarioPeer::CA_DEPARTAMENTO)) $criteria->add(UsuarioPeer::CA_DEPARTAMENTO, $this->ca_departamento);
		if ($this->isColumnModified(UsuarioPeer::CA_IDSUCURSAL)) $criteria->add(UsuarioPeer::CA_IDSUCURSAL, $this->ca_idsucursal);
		if ($this->isColumnModified(UsuarioPeer::CA_EMAIL)) $criteria->add(UsuarioPeer::CA_EMAIL, $this->ca_email);
		if ($this->isColumnModified(UsuarioPeer::CA_RUTINAS)) $criteria->add(UsuarioPeer::CA_RUTINAS, $this->ca_rutinas);
		if ($this->isColumnModified(UsuarioPeer::CA_EXTENSION)) $criteria->add(UsuarioPeer::CA_EXTENSION, $this->ca_extension);
		if ($this->isColumnModified(UsuarioPeer::CA_AUTHMETHOD)) $criteria->add(UsuarioPeer::CA_AUTHMETHOD, $this->ca_authmethod);
		if ($this->isColumnModified(UsuarioPeer::CA_PASSWD)) $criteria->add(UsuarioPeer::CA_PASSWD, $this->ca_passwd);
		if ($this->isColumnModified(UsuarioPeer::CA_SALT)) $criteria->add(UsuarioPeer::CA_SALT, $this->ca_salt);
		if ($this->isColumnModified(UsuarioPeer::CA_ACTIVO)) $criteria->add(UsuarioPeer::CA_ACTIVO, $this->ca_activo);
		if ($this->isColumnModified(UsuarioPeer::CA_FORCECHANGE)) $criteria->add(UsuarioPeer::CA_FORCECHANGE, $this->ca_forcechange);
		if ($this->isColumnModified(UsuarioPeer::CA_SUCURSAL)) $criteria->add(UsuarioPeer::CA_SUCURSAL, $this->ca_sucursal);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);

		$criteria->add(UsuarioPeer::CA_LOGIN, $this->ca_login);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaLogin();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaLogin($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaLogin($this->ca_login);

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaCargo($this->ca_cargo);

		$copyObj->setCaDepartamento($this->ca_departamento);

		$copyObj->setCaIdsucursal($this->ca_idsucursal);

		$copyObj->setCaEmail($this->ca_email);

		$copyObj->setCaRutinas($this->ca_rutinas);

		$copyObj->setCaExtension($this->ca_extension);

		$copyObj->setCaAuthmethod($this->ca_authmethod);

		$copyObj->setCaPasswd($this->ca_passwd);

		$copyObj->setCaSalt($this->ca_salt);

		$copyObj->setCaActivo($this->ca_activo);

		$copyObj->setCaForcechange($this->ca_forcechange);

		$copyObj->setCaSucursal($this->ca_sucursal);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getNivelesAccesos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addNivelesAcceso($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getAccesoUsuarios() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addAccesoUsuario($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getUsuarioPerfils() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addUsuarioPerfil($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getUsuarioLogs() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addUsuarioLog($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getHdeskTickets() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addHdeskTicket($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getHdeskResponses() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addHdeskResponse($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getHdeskUserGroups() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addHdeskUserGroup($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getHdeskKBases() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addHdeskKBase($relObj->copy($deepCopy));
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

			foreach ($this->getRepStatusRespuestas() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addRepStatusRespuesta($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getCotizacions() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addCotizacion($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getCotSeguimientos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addCotSeguimiento($relObj->copy($deepCopy));
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
			self::$peer = new UsuarioPeer();
		}
		return self::$peer;
	}

	
	public function setSucursal(Sucursal $v = null)
	{
		if ($v === null) {
			$this->setCaIdsucursal(NULL);
		} else {
			$this->setCaIdsucursal($v->getCaIdsucursal());
		}

		$this->aSucursal = $v;

						if ($v !== null) {
			$v->addUsuario($this);
		}

		return $this;
	}


	
	public function getSucursal(PropelPDO $con = null)
	{
		if ($this->aSucursal === null && (($this->ca_idsucursal !== "" && $this->ca_idsucursal !== null))) {
			$c = new Criteria(SucursalPeer::DATABASE_NAME);
			$c->add(SucursalPeer::CA_IDSUCURSAL, $this->ca_idsucursal);
			$this->aSucursal = SucursalPeer::doSelectOne($c, $con);
			
		}
		return $this->aSucursal;
	}

	
	public function clearNivelesAccesos()
	{
		$this->collNivelesAccesos = null; 	}

	
	public function initNivelesAccesos()
	{
		$this->collNivelesAccesos = array();
	}

	
	public function getNivelesAccesos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNivelesAccesos === null) {
			if ($this->isNew()) {
			   $this->collNivelesAccesos = array();
			} else {

				$criteria->add(NivelesAccesoPeer::CA_LOGIN, $this->ca_login);

				NivelesAccesoPeer::addSelectColumns($criteria);
				$this->collNivelesAccesos = NivelesAccesoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NivelesAccesoPeer::CA_LOGIN, $this->ca_login);

				NivelesAccesoPeer::addSelectColumns($criteria);
				if (!isset($this->lastNivelesAccesoCriteria) || !$this->lastNivelesAccesoCriteria->equals($criteria)) {
					$this->collNivelesAccesos = NivelesAccesoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastNivelesAccesoCriteria = $criteria;
		return $this->collNivelesAccesos;
	}

	
	public function countNivelesAccesos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collNivelesAccesos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(NivelesAccesoPeer::CA_LOGIN, $this->ca_login);

				$count = NivelesAccesoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NivelesAccesoPeer::CA_LOGIN, $this->ca_login);

				if (!isset($this->lastNivelesAccesoCriteria) || !$this->lastNivelesAccesoCriteria->equals($criteria)) {
					$count = NivelesAccesoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collNivelesAccesos);
				}
			} else {
				$count = count($this->collNivelesAccesos);
			}
		}
		return $count;
	}

	
	public function addNivelesAcceso(NivelesAcceso $l)
	{
		if ($this->collNivelesAccesos === null) {
			$this->initNivelesAccesos();
		}
		if (!in_array($l, $this->collNivelesAccesos, true)) { 			array_push($this->collNivelesAccesos, $l);
			$l->setUsuario($this);
		}
	}

	
	public function clearAccesoUsuarios()
	{
		$this->collAccesoUsuarios = null; 	}

	
	public function initAccesoUsuarios()
	{
		$this->collAccesoUsuarios = array();
	}

	
	public function getAccesoUsuarios($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAccesoUsuarios === null) {
			if ($this->isNew()) {
			   $this->collAccesoUsuarios = array();
			} else {

				$criteria->add(AccesoUsuarioPeer::CA_LOGIN, $this->ca_login);

				AccesoUsuarioPeer::addSelectColumns($criteria);
				$this->collAccesoUsuarios = AccesoUsuarioPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AccesoUsuarioPeer::CA_LOGIN, $this->ca_login);

				AccesoUsuarioPeer::addSelectColumns($criteria);
				if (!isset($this->lastAccesoUsuarioCriteria) || !$this->lastAccesoUsuarioCriteria->equals($criteria)) {
					$this->collAccesoUsuarios = AccesoUsuarioPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAccesoUsuarioCriteria = $criteria;
		return $this->collAccesoUsuarios;
	}

	
	public function countAccesoUsuarios(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collAccesoUsuarios === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(AccesoUsuarioPeer::CA_LOGIN, $this->ca_login);

				$count = AccesoUsuarioPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AccesoUsuarioPeer::CA_LOGIN, $this->ca_login);

				if (!isset($this->lastAccesoUsuarioCriteria) || !$this->lastAccesoUsuarioCriteria->equals($criteria)) {
					$count = AccesoUsuarioPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collAccesoUsuarios);
				}
			} else {
				$count = count($this->collAccesoUsuarios);
			}
		}
		return $count;
	}

	
	public function addAccesoUsuario(AccesoUsuario $l)
	{
		if ($this->collAccesoUsuarios === null) {
			$this->initAccesoUsuarios();
		}
		if (!in_array($l, $this->collAccesoUsuarios, true)) { 			array_push($this->collAccesoUsuarios, $l);
			$l->setUsuario($this);
		}
	}

	
	public function clearUsuarioPerfils()
	{
		$this->collUsuarioPerfils = null; 	}

	
	public function initUsuarioPerfils()
	{
		$this->collUsuarioPerfils = array();
	}

	
	public function getUsuarioPerfils($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUsuarioPerfils === null) {
			if ($this->isNew()) {
			   $this->collUsuarioPerfils = array();
			} else {

				$criteria->add(UsuarioPerfilPeer::CA_LOGIN, $this->ca_login);

				UsuarioPerfilPeer::addSelectColumns($criteria);
				$this->collUsuarioPerfils = UsuarioPerfilPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UsuarioPerfilPeer::CA_LOGIN, $this->ca_login);

				UsuarioPerfilPeer::addSelectColumns($criteria);
				if (!isset($this->lastUsuarioPerfilCriteria) || !$this->lastUsuarioPerfilCriteria->equals($criteria)) {
					$this->collUsuarioPerfils = UsuarioPerfilPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUsuarioPerfilCriteria = $criteria;
		return $this->collUsuarioPerfils;
	}

	
	public function countUsuarioPerfils(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collUsuarioPerfils === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(UsuarioPerfilPeer::CA_LOGIN, $this->ca_login);

				$count = UsuarioPerfilPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UsuarioPerfilPeer::CA_LOGIN, $this->ca_login);

				if (!isset($this->lastUsuarioPerfilCriteria) || !$this->lastUsuarioPerfilCriteria->equals($criteria)) {
					$count = UsuarioPerfilPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collUsuarioPerfils);
				}
			} else {
				$count = count($this->collUsuarioPerfils);
			}
		}
		return $count;
	}

	
	public function addUsuarioPerfil(UsuarioPerfil $l)
	{
		if ($this->collUsuarioPerfils === null) {
			$this->initUsuarioPerfils();
		}
		if (!in_array($l, $this->collUsuarioPerfils, true)) { 			array_push($this->collUsuarioPerfils, $l);
			$l->setUsuario($this);
		}
	}


	
	public function getUsuarioPerfilsJoinPerfil($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUsuarioPerfils === null) {
			if ($this->isNew()) {
				$this->collUsuarioPerfils = array();
			} else {

				$criteria->add(UsuarioPerfilPeer::CA_LOGIN, $this->ca_login);

				$this->collUsuarioPerfils = UsuarioPerfilPeer::doSelectJoinPerfil($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(UsuarioPerfilPeer::CA_LOGIN, $this->ca_login);

			if (!isset($this->lastUsuarioPerfilCriteria) || !$this->lastUsuarioPerfilCriteria->equals($criteria)) {
				$this->collUsuarioPerfils = UsuarioPerfilPeer::doSelectJoinPerfil($criteria, $con, $join_behavior);
			}
		}
		$this->lastUsuarioPerfilCriteria = $criteria;

		return $this->collUsuarioPerfils;
	}

	
	public function clearUsuarioLogs()
	{
		$this->collUsuarioLogs = null; 	}

	
	public function initUsuarioLogs()
	{
		$this->collUsuarioLogs = array();
	}

	
	public function getUsuarioLogs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUsuarioLogs === null) {
			if ($this->isNew()) {
			   $this->collUsuarioLogs = array();
			} else {

				$criteria->add(UsuarioLogPeer::CA_LOGIN, $this->ca_login);

				UsuarioLogPeer::addSelectColumns($criteria);
				$this->collUsuarioLogs = UsuarioLogPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UsuarioLogPeer::CA_LOGIN, $this->ca_login);

				UsuarioLogPeer::addSelectColumns($criteria);
				if (!isset($this->lastUsuarioLogCriteria) || !$this->lastUsuarioLogCriteria->equals($criteria)) {
					$this->collUsuarioLogs = UsuarioLogPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUsuarioLogCriteria = $criteria;
		return $this->collUsuarioLogs;
	}

	
	public function countUsuarioLogs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collUsuarioLogs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(UsuarioLogPeer::CA_LOGIN, $this->ca_login);

				$count = UsuarioLogPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UsuarioLogPeer::CA_LOGIN, $this->ca_login);

				if (!isset($this->lastUsuarioLogCriteria) || !$this->lastUsuarioLogCriteria->equals($criteria)) {
					$count = UsuarioLogPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collUsuarioLogs);
				}
			} else {
				$count = count($this->collUsuarioLogs);
			}
		}
		return $count;
	}

	
	public function addUsuarioLog(UsuarioLog $l)
	{
		if ($this->collUsuarioLogs === null) {
			$this->initUsuarioLogs();
		}
		if (!in_array($l, $this->collUsuarioLogs, true)) { 			array_push($this->collUsuarioLogs, $l);
			$l->setUsuario($this);
		}
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
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
			   $this->collHdeskTickets = array();
			} else {

				$criteria->add(HdeskTicketPeer::CA_LOGIN, $this->ca_login);

				HdeskTicketPeer::addSelectColumns($criteria);
				$this->collHdeskTickets = HdeskTicketPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HdeskTicketPeer::CA_LOGIN, $this->ca_login);

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
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
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

				$criteria->add(HdeskTicketPeer::CA_LOGIN, $this->ca_login);

				$count = HdeskTicketPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HdeskTicketPeer::CA_LOGIN, $this->ca_login);

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
			$l->setUsuario($this);
		}
	}


	
	public function getHdeskTicketsJoinHdeskGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
				$this->collHdeskTickets = array();
			} else {

				$criteria->add(HdeskTicketPeer::CA_LOGIN, $this->ca_login);

				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinHdeskGroup($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(HdeskTicketPeer::CA_LOGIN, $this->ca_login);

			if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinHdeskGroup($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskTicketCriteria = $criteria;

		return $this->collHdeskTickets;
	}


	
	public function getHdeskTicketsJoinHdeskProject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
				$this->collHdeskTickets = array();
			} else {

				$criteria->add(HdeskTicketPeer::CA_LOGIN, $this->ca_login);

				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinHdeskProject($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(HdeskTicketPeer::CA_LOGIN, $this->ca_login);

			if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinHdeskProject($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskTicketCriteria = $criteria;

		return $this->collHdeskTickets;
	}


	
	public function getHdeskTicketsJoinNotTarea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskTickets === null) {
			if ($this->isNew()) {
				$this->collHdeskTickets = array();
			} else {

				$criteria->add(HdeskTicketPeer::CA_LOGIN, $this->ca_login);

				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(HdeskTicketPeer::CA_LOGIN, $this->ca_login);

			if (!isset($this->lastHdeskTicketCriteria) || !$this->lastHdeskTicketCriteria->equals($criteria)) {
				$this->collHdeskTickets = HdeskTicketPeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskTicketCriteria = $criteria;

		return $this->collHdeskTickets;
	}

	
	public function clearHdeskResponses()
	{
		$this->collHdeskResponses = null; 	}

	
	public function initHdeskResponses()
	{
		$this->collHdeskResponses = array();
	}

	
	public function getHdeskResponses($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskResponses === null) {
			if ($this->isNew()) {
			   $this->collHdeskResponses = array();
			} else {

				$criteria->add(HdeskResponsePeer::CA_LOGIN, $this->ca_login);

				HdeskResponsePeer::addSelectColumns($criteria);
				$this->collHdeskResponses = HdeskResponsePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HdeskResponsePeer::CA_LOGIN, $this->ca_login);

				HdeskResponsePeer::addSelectColumns($criteria);
				if (!isset($this->lastHdeskResponseCriteria) || !$this->lastHdeskResponseCriteria->equals($criteria)) {
					$this->collHdeskResponses = HdeskResponsePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHdeskResponseCriteria = $criteria;
		return $this->collHdeskResponses;
	}

	
	public function countHdeskResponses(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collHdeskResponses === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(HdeskResponsePeer::CA_LOGIN, $this->ca_login);

				$count = HdeskResponsePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HdeskResponsePeer::CA_LOGIN, $this->ca_login);

				if (!isset($this->lastHdeskResponseCriteria) || !$this->lastHdeskResponseCriteria->equals($criteria)) {
					$count = HdeskResponsePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collHdeskResponses);
				}
			} else {
				$count = count($this->collHdeskResponses);
			}
		}
		return $count;
	}

	
	public function addHdeskResponse(HdeskResponse $l)
	{
		if ($this->collHdeskResponses === null) {
			$this->initHdeskResponses();
		}
		if (!in_array($l, $this->collHdeskResponses, true)) { 			array_push($this->collHdeskResponses, $l);
			$l->setUsuario($this);
		}
	}


	
	public function getHdeskResponsesJoinHdeskTicket($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskResponses === null) {
			if ($this->isNew()) {
				$this->collHdeskResponses = array();
			} else {

				$criteria->add(HdeskResponsePeer::CA_LOGIN, $this->ca_login);

				$this->collHdeskResponses = HdeskResponsePeer::doSelectJoinHdeskTicket($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(HdeskResponsePeer::CA_LOGIN, $this->ca_login);

			if (!isset($this->lastHdeskResponseCriteria) || !$this->lastHdeskResponseCriteria->equals($criteria)) {
				$this->collHdeskResponses = HdeskResponsePeer::doSelectJoinHdeskTicket($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskResponseCriteria = $criteria;

		return $this->collHdeskResponses;
	}

	
	public function clearHdeskUserGroups()
	{
		$this->collHdeskUserGroups = null; 	}

	
	public function initHdeskUserGroups()
	{
		$this->collHdeskUserGroups = array();
	}

	
	public function getHdeskUserGroups($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskUserGroups === null) {
			if ($this->isNew()) {
			   $this->collHdeskUserGroups = array();
			} else {

				$criteria->add(HdeskUserGroupPeer::CA_LOGIN, $this->ca_login);

				HdeskUserGroupPeer::addSelectColumns($criteria);
				$this->collHdeskUserGroups = HdeskUserGroupPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HdeskUserGroupPeer::CA_LOGIN, $this->ca_login);

				HdeskUserGroupPeer::addSelectColumns($criteria);
				if (!isset($this->lastHdeskUserGroupCriteria) || !$this->lastHdeskUserGroupCriteria->equals($criteria)) {
					$this->collHdeskUserGroups = HdeskUserGroupPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHdeskUserGroupCriteria = $criteria;
		return $this->collHdeskUserGroups;
	}

	
	public function countHdeskUserGroups(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collHdeskUserGroups === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(HdeskUserGroupPeer::CA_LOGIN, $this->ca_login);

				$count = HdeskUserGroupPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HdeskUserGroupPeer::CA_LOGIN, $this->ca_login);

				if (!isset($this->lastHdeskUserGroupCriteria) || !$this->lastHdeskUserGroupCriteria->equals($criteria)) {
					$count = HdeskUserGroupPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collHdeskUserGroups);
				}
			} else {
				$count = count($this->collHdeskUserGroups);
			}
		}
		return $count;
	}

	
	public function addHdeskUserGroup(HdeskUserGroup $l)
	{
		if ($this->collHdeskUserGroups === null) {
			$this->initHdeskUserGroups();
		}
		if (!in_array($l, $this->collHdeskUserGroups, true)) { 			array_push($this->collHdeskUserGroups, $l);
			$l->setUsuario($this);
		}
	}


	
	public function getHdeskUserGroupsJoinHdeskGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskUserGroups === null) {
			if ($this->isNew()) {
				$this->collHdeskUserGroups = array();
			} else {

				$criteria->add(HdeskUserGroupPeer::CA_LOGIN, $this->ca_login);

				$this->collHdeskUserGroups = HdeskUserGroupPeer::doSelectJoinHdeskGroup($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(HdeskUserGroupPeer::CA_LOGIN, $this->ca_login);

			if (!isset($this->lastHdeskUserGroupCriteria) || !$this->lastHdeskUserGroupCriteria->equals($criteria)) {
				$this->collHdeskUserGroups = HdeskUserGroupPeer::doSelectJoinHdeskGroup($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskUserGroupCriteria = $criteria;

		return $this->collHdeskUserGroups;
	}

	
	public function clearHdeskKBases()
	{
		$this->collHdeskKBases = null; 	}

	
	public function initHdeskKBases()
	{
		$this->collHdeskKBases = array();
	}

	
	public function getHdeskKBases($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskKBases === null) {
			if ($this->isNew()) {
			   $this->collHdeskKBases = array();
			} else {

				$criteria->add(HdeskKBasePeer::CA_LOGIN, $this->ca_login);

				HdeskKBasePeer::addSelectColumns($criteria);
				$this->collHdeskKBases = HdeskKBasePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HdeskKBasePeer::CA_LOGIN, $this->ca_login);

				HdeskKBasePeer::addSelectColumns($criteria);
				if (!isset($this->lastHdeskKBaseCriteria) || !$this->lastHdeskKBaseCriteria->equals($criteria)) {
					$this->collHdeskKBases = HdeskKBasePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHdeskKBaseCriteria = $criteria;
		return $this->collHdeskKBases;
	}

	
	public function countHdeskKBases(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collHdeskKBases === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(HdeskKBasePeer::CA_LOGIN, $this->ca_login);

				$count = HdeskKBasePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HdeskKBasePeer::CA_LOGIN, $this->ca_login);

				if (!isset($this->lastHdeskKBaseCriteria) || !$this->lastHdeskKBaseCriteria->equals($criteria)) {
					$count = HdeskKBasePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collHdeskKBases);
				}
			} else {
				$count = count($this->collHdeskKBases);
			}
		}
		return $count;
	}

	
	public function addHdeskKBase(HdeskKBase $l)
	{
		if ($this->collHdeskKBases === null) {
			$this->initHdeskKBases();
		}
		if (!in_array($l, $this->collHdeskKBases, true)) { 			array_push($this->collHdeskKBases, $l);
			$l->setUsuario($this);
		}
	}


	
	public function getHdeskKBasesJoinHdeskKBaseCategory($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskKBases === null) {
			if ($this->isNew()) {
				$this->collHdeskKBases = array();
			} else {

				$criteria->add(HdeskKBasePeer::CA_LOGIN, $this->ca_login);

				$this->collHdeskKBases = HdeskKBasePeer::doSelectJoinHdeskKBaseCategory($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(HdeskKBasePeer::CA_LOGIN, $this->ca_login);

			if (!isset($this->lastHdeskKBaseCriteria) || !$this->lastHdeskKBaseCriteria->equals($criteria)) {
				$this->collHdeskKBases = HdeskKBasePeer::doSelectJoinHdeskKBaseCategory($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskKBaseCriteria = $criteria;

		return $this->collHdeskKBases;
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
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotTareaAsignacions === null) {
			if ($this->isNew()) {
			   $this->collNotTareaAsignacions = array();
			} else {

				$criteria->add(NotTareaAsignacionPeer::CA_LOGIN, $this->ca_login);

				NotTareaAsignacionPeer::addSelectColumns($criteria);
				$this->collNotTareaAsignacions = NotTareaAsignacionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NotTareaAsignacionPeer::CA_LOGIN, $this->ca_login);

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
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
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

				$criteria->add(NotTareaAsignacionPeer::CA_LOGIN, $this->ca_login);

				$count = NotTareaAsignacionPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NotTareaAsignacionPeer::CA_LOGIN, $this->ca_login);

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
			$l->setUsuario($this);
		}
	}


	
	public function getNotTareaAsignacionsJoinNotTarea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNotTareaAsignacions === null) {
			if ($this->isNew()) {
				$this->collNotTareaAsignacions = array();
			} else {

				$criteria->add(NotTareaAsignacionPeer::CA_LOGIN, $this->ca_login);

				$this->collNotTareaAsignacions = NotTareaAsignacionPeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(NotTareaAsignacionPeer::CA_LOGIN, $this->ca_login);

			if (!isset($this->lastNotTareaAsignacionCriteria) || !$this->lastNotTareaAsignacionCriteria->equals($criteria)) {
				$this->collNotTareaAsignacions = NotTareaAsignacionPeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
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
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
			   $this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

				ReportePeer::addSelectColumns($criteria);
				$this->collReportes = ReportePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

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
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
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

				$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

				$count = ReportePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

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
			$l->setUsuario($this);
		}
	}


	
	public function getReportesJoinTransportador($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

				$this->collReportes = ReportePeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

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
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

				$this->collReportes = ReportePeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

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
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

				$this->collReportes = ReportePeer::doSelectJoinAgente($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

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
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

				$this->collReportes = ReportePeer::doSelectJoinBodega($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

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
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

				$this->collReportes = ReportePeer::doSelectJoinTrackingEtapa($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinTrackingEtapa($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}


	
	public function getReportesJoinNotTarea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

				$this->collReportes = ReportePeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_LOGIN, $this->ca_login);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}

	
	public function clearRepStatusRespuestas()
	{
		$this->collRepStatusRespuestas = null; 	}

	
	public function initRepStatusRespuestas()
	{
		$this->collRepStatusRespuestas = array();
	}

	
	public function getRepStatusRespuestas($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepStatusRespuestas === null) {
			if ($this->isNew()) {
			   $this->collRepStatusRespuestas = array();
			} else {

				$criteria->add(RepStatusRespuestaPeer::CA_LOGIN, $this->ca_login);

				RepStatusRespuestaPeer::addSelectColumns($criteria);
				$this->collRepStatusRespuestas = RepStatusRespuestaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepStatusRespuestaPeer::CA_LOGIN, $this->ca_login);

				RepStatusRespuestaPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepStatusRespuestaCriteria) || !$this->lastRepStatusRespuestaCriteria->equals($criteria)) {
					$this->collRepStatusRespuestas = RepStatusRespuestaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepStatusRespuestaCriteria = $criteria;
		return $this->collRepStatusRespuestas;
	}

	
	public function countRepStatusRespuestas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRepStatusRespuestas === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RepStatusRespuestaPeer::CA_LOGIN, $this->ca_login);

				$count = RepStatusRespuestaPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepStatusRespuestaPeer::CA_LOGIN, $this->ca_login);

				if (!isset($this->lastRepStatusRespuestaCriteria) || !$this->lastRepStatusRespuestaCriteria->equals($criteria)) {
					$count = RepStatusRespuestaPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRepStatusRespuestas);
				}
			} else {
				$count = count($this->collRepStatusRespuestas);
			}
		}
		return $count;
	}

	
	public function addRepStatusRespuesta(RepStatusRespuesta $l)
	{
		if ($this->collRepStatusRespuestas === null) {
			$this->initRepStatusRespuestas();
		}
		if (!in_array($l, $this->collRepStatusRespuestas, true)) { 			array_push($this->collRepStatusRespuestas, $l);
			$l->setUsuario($this);
		}
	}


	
	public function getRepStatusRespuestasJoinRepStatus($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepStatusRespuestas === null) {
			if ($this->isNew()) {
				$this->collRepStatusRespuestas = array();
			} else {

				$criteria->add(RepStatusRespuestaPeer::CA_LOGIN, $this->ca_login);

				$this->collRepStatusRespuestas = RepStatusRespuestaPeer::doSelectJoinRepStatus($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(RepStatusRespuestaPeer::CA_LOGIN, $this->ca_login);

			if (!isset($this->lastRepStatusRespuestaCriteria) || !$this->lastRepStatusRespuestaCriteria->equals($criteria)) {
				$this->collRepStatusRespuestas = RepStatusRespuestaPeer::doSelectJoinRepStatus($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepStatusRespuestaCriteria = $criteria;

		return $this->collRepStatusRespuestas;
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
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotizacions === null) {
			if ($this->isNew()) {
			   $this->collCotizacions = array();
			} else {

				$criteria->add(CotizacionPeer::CA_USUARIO, $this->ca_login);

				CotizacionPeer::addSelectColumns($criteria);
				$this->collCotizacions = CotizacionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotizacionPeer::CA_USUARIO, $this->ca_login);

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
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
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

				$criteria->add(CotizacionPeer::CA_USUARIO, $this->ca_login);

				$count = CotizacionPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotizacionPeer::CA_USUARIO, $this->ca_login);

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
			$l->setUsuario($this);
		}
	}


	
	public function getCotizacionsJoinContacto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotizacions === null) {
			if ($this->isNew()) {
				$this->collCotizacions = array();
			} else {

				$criteria->add(CotizacionPeer::CA_USUARIO, $this->ca_login);

				$this->collCotizacions = CotizacionPeer::doSelectJoinContacto($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(CotizacionPeer::CA_USUARIO, $this->ca_login);

			if (!isset($this->lastCotizacionCriteria) || !$this->lastCotizacionCriteria->equals($criteria)) {
				$this->collCotizacions = CotizacionPeer::doSelectJoinContacto($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotizacionCriteria = $criteria;

		return $this->collCotizacions;
	}


	
	public function getCotizacionsJoinNotTarea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotizacions === null) {
			if ($this->isNew()) {
				$this->collCotizacions = array();
			} else {

				$criteria->add(CotizacionPeer::CA_USUARIO, $this->ca_login);

				$this->collCotizacions = CotizacionPeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(CotizacionPeer::CA_USUARIO, $this->ca_login);

			if (!isset($this->lastCotizacionCriteria) || !$this->lastCotizacionCriteria->equals($criteria)) {
				$this->collCotizacions = CotizacionPeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotizacionCriteria = $criteria;

		return $this->collCotizacions;
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
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotSeguimientos === null) {
			if ($this->isNew()) {
			   $this->collCotSeguimientos = array();
			} else {

				$criteria->add(CotSeguimientoPeer::CA_LOGIN, $this->ca_login);

				CotSeguimientoPeer::addSelectColumns($criteria);
				$this->collCotSeguimientos = CotSeguimientoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotSeguimientoPeer::CA_LOGIN, $this->ca_login);

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
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
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

				$criteria->add(CotSeguimientoPeer::CA_LOGIN, $this->ca_login);

				$count = CotSeguimientoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotSeguimientoPeer::CA_LOGIN, $this->ca_login);

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
			$l->setUsuario($this);
		}
	}


	
	public function getCotSeguimientosJoinCotizacion($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotSeguimientos === null) {
			if ($this->isNew()) {
				$this->collCotSeguimientos = array();
			} else {

				$criteria->add(CotSeguimientoPeer::CA_LOGIN, $this->ca_login);

				$this->collCotSeguimientos = CotSeguimientoPeer::doSelectJoinCotizacion($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(CotSeguimientoPeer::CA_LOGIN, $this->ca_login);

			if (!isset($this->lastCotSeguimientoCriteria) || !$this->lastCotSeguimientoCriteria->equals($criteria)) {
				$this->collCotSeguimientos = CotSeguimientoPeer::doSelectJoinCotizacion($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotSeguimientoCriteria = $criteria;

		return $this->collCotSeguimientos;
	}


	
	public function getCotSeguimientosJoinCotProducto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotSeguimientos === null) {
			if ($this->isNew()) {
				$this->collCotSeguimientos = array();
			} else {

				$criteria->add(CotSeguimientoPeer::CA_LOGIN, $this->ca_login);

				$this->collCotSeguimientos = CotSeguimientoPeer::doSelectJoinCotProducto($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(CotSeguimientoPeer::CA_LOGIN, $this->ca_login);

			if (!isset($this->lastCotSeguimientoCriteria) || !$this->lastCotSeguimientoCriteria->equals($criteria)) {
				$this->collCotSeguimientos = CotSeguimientoPeer::doSelectJoinCotProducto($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotSeguimientoCriteria = $criteria;

		return $this->collCotSeguimientos;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collNivelesAccesos) {
				foreach ((array) $this->collNivelesAccesos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collAccesoUsuarios) {
				foreach ((array) $this->collAccesoUsuarios as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collUsuarioPerfils) {
				foreach ((array) $this->collUsuarioPerfils as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collUsuarioLogs) {
				foreach ((array) $this->collUsuarioLogs as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collHdeskTickets) {
				foreach ((array) $this->collHdeskTickets as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collHdeskResponses) {
				foreach ((array) $this->collHdeskResponses as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collHdeskUserGroups) {
				foreach ((array) $this->collHdeskUserGroups as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collHdeskKBases) {
				foreach ((array) $this->collHdeskKBases as $o) {
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
			if ($this->collRepStatusRespuestas) {
				foreach ((array) $this->collRepStatusRespuestas as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCotizacions) {
				foreach ((array) $this->collCotizacions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCotSeguimientos) {
				foreach ((array) $this->collCotSeguimientos as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collNivelesAccesos = null;
		$this->collAccesoUsuarios = null;
		$this->collUsuarioPerfils = null;
		$this->collUsuarioLogs = null;
		$this->collHdeskTickets = null;
		$this->collHdeskResponses = null;
		$this->collHdeskUserGroups = null;
		$this->collHdeskKBases = null;
		$this->collNotTareaAsignacions = null;
		$this->collReportes = null;
		$this->collRepStatusRespuestas = null;
		$this->collCotizacions = null;
		$this->collCotSeguimientos = null;
			$this->aSucursal = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseUsuario:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseUsuario::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 