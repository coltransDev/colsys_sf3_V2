<?php


abstract class BaseCliente extends BaseObject  implements Persistent {


  const PEER = 'ClientePeer';

	
	protected static $peer;

	
	protected $ca_idcliente;

	
	protected $ca_digito;

	
	protected $ca_compania;

	
	protected $ca_papellido;

	
	protected $ca_sapellido;

	
	protected $ca_nombres;

	
	protected $ca_saludo;

	
	protected $ca_sexo;

	
	protected $ca_cumpleanos;

	
	protected $ca_oficina;

	
	protected $ca_vendedor;

	
	protected $ca_email;

	
	protected $ca_coordinador;

	
	protected $ca_direccion;

	
	protected $ca_torre;

	
	protected $ca_bloque;

	
	protected $ca_interior;

	
	protected $ca_localidad;

	
	protected $ca_complemento;

	
	protected $ca_telefonos;

	
	protected $ca_fax;

	
	protected $ca_preferencias;

	
	protected $ca_confirmar;

	
	protected $ca_idciudad;

	
	protected $ca_idgrupo;

	
	protected $ca_listaclinton;

	
	protected $ca_fchcircular;

	
	protected $ca_status;

	
	protected $aCiudad;

	
	protected $collAduanaMaestras;

	
	private $lastAduanaMaestraCriteria = null;

	
	protected $collContactos;

	
	private $lastContactoCriteria = null;

	
	protected $collClienteStds;

	
	private $lastClienteStdCriteria = null;

	
	protected $collInoClientesSeas;

	
	private $lastInoClientesSeaCriteria = null;

	
	protected $collInoIngresosSeas;

	
	private $lastInoIngresosSeaCriteria = null;

	
	protected $collInoAvisosSeas;

	
	private $lastInoAvisosSeaCriteria = null;

	
	protected $collInoIngresosAirs;

	
	private $lastInoIngresosAirCriteria = null;

	
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

	
	public function getCaIdcliente()
	{
		return $this->ca_idcliente;
	}

	
	public function getCaDigito()
	{
		return $this->ca_digito;
	}

	
	public function getCaCompania()
	{
		return $this->ca_compania;
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

	
	public function getCaSexo()
	{
		return $this->ca_sexo;
	}

	
	public function getCaCumpleanos()
	{
		return $this->ca_cumpleanos;
	}

	
	public function getCaOficina()
	{
		return $this->ca_oficina;
	}

	
	public function getCaVendedor()
	{
		return $this->ca_vendedor;
	}

	
	public function getCaEmail()
	{
		return $this->ca_email;
	}

	
	public function getCaCoordinador()
	{
		return $this->ca_coordinador;
	}

	
	public function getCaDireccion()
	{
		return $this->ca_direccion;
	}

	
	public function getCaTorre()
	{
		return $this->ca_torre;
	}

	
	public function getCaBloque()
	{
		return $this->ca_bloque;
	}

	
	public function getCaInterior()
	{
		return $this->ca_interior;
	}

	
	public function getCaLocalidad()
	{
		return $this->ca_localidad;
	}

	
	public function getCaComplemento()
	{
		return $this->ca_complemento;
	}

	
	public function getCaTelefonos()
	{
		return $this->ca_telefonos;
	}

	
	public function getCaFax()
	{
		return $this->ca_fax;
	}

	
	public function getCaPreferencias()
	{
		return $this->ca_preferencias;
	}

	
	public function getCaConfirmar()
	{
		return $this->ca_confirmar;
	}

	
	public function getCaIdciudad()
	{
		return $this->ca_idciudad;
	}

	
	public function getCaIdgrupo()
	{
		return $this->ca_idgrupo;
	}

	
	public function getCaListaclinton()
	{
		return $this->ca_listaclinton;
	}

	
	public function getCaFchcircular($format = 'Y-m-d')
	{
		if ($this->ca_fchcircular === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchcircular);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchcircular, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaStatus()
	{
		return $this->ca_status;
	}

	
	public function setCaIdcliente($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcliente !== $v) {
			$this->ca_idcliente = $v;
			$this->modifiedColumns[] = ClientePeer::CA_IDCLIENTE;
		}

		return $this;
	} 
	
	public function setCaDigito($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_digito !== $v) {
			$this->ca_digito = $v;
			$this->modifiedColumns[] = ClientePeer::CA_DIGITO;
		}

		return $this;
	} 
	
	public function setCaCompania($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_compania !== $v) {
			$this->ca_compania = $v;
			$this->modifiedColumns[] = ClientePeer::CA_COMPANIA;
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
			$this->modifiedColumns[] = ClientePeer::CA_PAPELLIDO;
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
			$this->modifiedColumns[] = ClientePeer::CA_SAPELLIDO;
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
			$this->modifiedColumns[] = ClientePeer::CA_NOMBRES;
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
			$this->modifiedColumns[] = ClientePeer::CA_SALUDO;
		}

		return $this;
	} 
	
	public function setCaSexo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_sexo !== $v) {
			$this->ca_sexo = $v;
			$this->modifiedColumns[] = ClientePeer::CA_SEXO;
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
			$this->modifiedColumns[] = ClientePeer::CA_CUMPLEANOS;
		}

		return $this;
	} 
	
	public function setCaOficina($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_oficina !== $v) {
			$this->ca_oficina = $v;
			$this->modifiedColumns[] = ClientePeer::CA_OFICINA;
		}

		return $this;
	} 
	
	public function setCaVendedor($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vendedor !== $v) {
			$this->ca_vendedor = $v;
			$this->modifiedColumns[] = ClientePeer::CA_VENDEDOR;
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
			$this->modifiedColumns[] = ClientePeer::CA_EMAIL;
		}

		return $this;
	} 
	
	public function setCaCoordinador($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_coordinador !== $v) {
			$this->ca_coordinador = $v;
			$this->modifiedColumns[] = ClientePeer::CA_COORDINADOR;
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
			$this->modifiedColumns[] = ClientePeer::CA_DIRECCION;
		}

		return $this;
	} 
	
	public function setCaTorre($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_torre !== $v) {
			$this->ca_torre = $v;
			$this->modifiedColumns[] = ClientePeer::CA_TORRE;
		}

		return $this;
	} 
	
	public function setCaBloque($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_bloque !== $v) {
			$this->ca_bloque = $v;
			$this->modifiedColumns[] = ClientePeer::CA_BLOQUE;
		}

		return $this;
	} 
	
	public function setCaInterior($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_interior !== $v) {
			$this->ca_interior = $v;
			$this->modifiedColumns[] = ClientePeer::CA_INTERIOR;
		}

		return $this;
	} 
	
	public function setCaLocalidad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_localidad !== $v) {
			$this->ca_localidad = $v;
			$this->modifiedColumns[] = ClientePeer::CA_LOCALIDAD;
		}

		return $this;
	} 
	
	public function setCaComplemento($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_complemento !== $v) {
			$this->ca_complemento = $v;
			$this->modifiedColumns[] = ClientePeer::CA_COMPLEMENTO;
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
			$this->modifiedColumns[] = ClientePeer::CA_TELEFONOS;
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
			$this->modifiedColumns[] = ClientePeer::CA_FAX;
		}

		return $this;
	} 
	
	public function setCaPreferencias($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_preferencias !== $v) {
			$this->ca_preferencias = $v;
			$this->modifiedColumns[] = ClientePeer::CA_PREFERENCIAS;
		}

		return $this;
	} 
	
	public function setCaConfirmar($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_confirmar !== $v) {
			$this->ca_confirmar = $v;
			$this->modifiedColumns[] = ClientePeer::CA_CONFIRMAR;
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
			$this->modifiedColumns[] = ClientePeer::CA_IDCIUDAD;
		}

		if ($this->aCiudad !== null && $this->aCiudad->getCaIdciudad() !== $v) {
			$this->aCiudad = null;
		}

		return $this;
	} 
	
	public function setCaIdgrupo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idgrupo !== $v) {
			$this->ca_idgrupo = $v;
			$this->modifiedColumns[] = ClientePeer::CA_IDGRUPO;
		}

		return $this;
	} 
	
	public function setCaListaclinton($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_listaclinton !== $v) {
			$this->ca_listaclinton = $v;
			$this->modifiedColumns[] = ClientePeer::CA_LISTACLINTON;
		}

		return $this;
	} 
	
	public function setCaFchcircular($v)
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

		if ( $this->ca_fchcircular !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchcircular !== null && $tmpDt = new DateTime($this->ca_fchcircular)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchcircular = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = ClientePeer::CA_FCHCIRCULAR;
			}
		} 
		return $this;
	} 
	
	public function setCaStatus($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_status !== $v) {
			$this->ca_status = $v;
			$this->modifiedColumns[] = ClientePeer::CA_STATUS;
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

			$this->ca_idcliente = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_digito = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_compania = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_papellido = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_sapellido = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_nombres = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_saludo = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_sexo = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_cumpleanos = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_oficina = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_vendedor = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_email = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_coordinador = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_direccion = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_torre = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_bloque = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_interior = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->ca_localidad = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
			$this->ca_complemento = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
			$this->ca_telefonos = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
			$this->ca_fax = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
			$this->ca_preferencias = ($row[$startcol + 21] !== null) ? (string) $row[$startcol + 21] : null;
			$this->ca_confirmar = ($row[$startcol + 22] !== null) ? (string) $row[$startcol + 22] : null;
			$this->ca_idciudad = ($row[$startcol + 23] !== null) ? (string) $row[$startcol + 23] : null;
			$this->ca_idgrupo = ($row[$startcol + 24] !== null) ? (int) $row[$startcol + 24] : null;
			$this->ca_listaclinton = ($row[$startcol + 25] !== null) ? (string) $row[$startcol + 25] : null;
			$this->ca_fchcircular = ($row[$startcol + 26] !== null) ? (string) $row[$startcol + 26] : null;
			$this->ca_status = ($row[$startcol + 27] !== null) ? (string) $row[$startcol + 27] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 28; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Cliente object", $e);
		}
	}

	
	public function ensureConsistency()
	{

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
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = ClientePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aCiudad = null;
			$this->collAduanaMaestras = null;
			$this->lastAduanaMaestraCriteria = null;

			$this->collContactos = null;
			$this->lastContactoCriteria = null;

			$this->collClienteStds = null;
			$this->lastClienteStdCriteria = null;

			$this->collInoClientesSeas = null;
			$this->lastInoClientesSeaCriteria = null;

			$this->collInoIngresosSeas = null;
			$this->lastInoIngresosSeaCriteria = null;

			$this->collInoAvisosSeas = null;
			$this->lastInoAvisosSeaCriteria = null;

			$this->collInoIngresosAirs = null;
			$this->lastInoIngresosAirCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCliente:delete:pre') as $callable)
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
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			ClientePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseCliente:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCliente:save:pre') as $callable)
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
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseCliente:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			ClientePeer::addInstanceToPool($this);
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

												
			if ($this->aCiudad !== null) {
				if ($this->aCiudad->isModified() || $this->aCiudad->isNew()) {
					$affectedRows += $this->aCiudad->save($con);
				}
				$this->setCiudad($this->aCiudad);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = ClientePeer::CA_IDCLIENTE;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ClientePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdcliente($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ClientePeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collAduanaMaestras !== null) {
				foreach ($this->collAduanaMaestras as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collContactos !== null) {
				foreach ($this->collContactos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collClienteStds !== null) {
				foreach ($this->collClienteStds as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInoClientesSeas !== null) {
				foreach ($this->collInoClientesSeas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInoIngresosSeas !== null) {
				foreach ($this->collInoIngresosSeas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInoAvisosSeas !== null) {
				foreach ($this->collInoAvisosSeas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInoIngresosAirs !== null) {
				foreach ($this->collInoIngresosAirs as $referrerFK) {
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


												
			if ($this->aCiudad !== null) {
				if (!$this->aCiudad->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCiudad->getValidationFailures());
				}
			}


			if (($retval = ClientePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collAduanaMaestras !== null) {
					foreach ($this->collAduanaMaestras as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collContactos !== null) {
					foreach ($this->collContactos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collClienteStds !== null) {
					foreach ($this->collClienteStds as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoClientesSeas !== null) {
					foreach ($this->collInoClientesSeas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoIngresosSeas !== null) {
					foreach ($this->collInoIngresosSeas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoAvisosSeas !== null) {
					foreach ($this->collInoAvisosSeas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoIngresosAirs !== null) {
					foreach ($this->collInoIngresosAirs as $referrerFK) {
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
		$pos = ClientePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdcliente();
				break;
			case 1:
				return $this->getCaDigito();
				break;
			case 2:
				return $this->getCaCompania();
				break;
			case 3:
				return $this->getCaPapellido();
				break;
			case 4:
				return $this->getCaSapellido();
				break;
			case 5:
				return $this->getCaNombres();
				break;
			case 6:
				return $this->getCaSaludo();
				break;
			case 7:
				return $this->getCaSexo();
				break;
			case 8:
				return $this->getCaCumpleanos();
				break;
			case 9:
				return $this->getCaOficina();
				break;
			case 10:
				return $this->getCaVendedor();
				break;
			case 11:
				return $this->getCaEmail();
				break;
			case 12:
				return $this->getCaCoordinador();
				break;
			case 13:
				return $this->getCaDireccion();
				break;
			case 14:
				return $this->getCaTorre();
				break;
			case 15:
				return $this->getCaBloque();
				break;
			case 16:
				return $this->getCaInterior();
				break;
			case 17:
				return $this->getCaLocalidad();
				break;
			case 18:
				return $this->getCaComplemento();
				break;
			case 19:
				return $this->getCaTelefonos();
				break;
			case 20:
				return $this->getCaFax();
				break;
			case 21:
				return $this->getCaPreferencias();
				break;
			case 22:
				return $this->getCaConfirmar();
				break;
			case 23:
				return $this->getCaIdciudad();
				break;
			case 24:
				return $this->getCaIdgrupo();
				break;
			case 25:
				return $this->getCaListaclinton();
				break;
			case 26:
				return $this->getCaFchcircular();
				break;
			case 27:
				return $this->getCaStatus();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = ClientePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdcliente(),
			$keys[1] => $this->getCaDigito(),
			$keys[2] => $this->getCaCompania(),
			$keys[3] => $this->getCaPapellido(),
			$keys[4] => $this->getCaSapellido(),
			$keys[5] => $this->getCaNombres(),
			$keys[6] => $this->getCaSaludo(),
			$keys[7] => $this->getCaSexo(),
			$keys[8] => $this->getCaCumpleanos(),
			$keys[9] => $this->getCaOficina(),
			$keys[10] => $this->getCaVendedor(),
			$keys[11] => $this->getCaEmail(),
			$keys[12] => $this->getCaCoordinador(),
			$keys[13] => $this->getCaDireccion(),
			$keys[14] => $this->getCaTorre(),
			$keys[15] => $this->getCaBloque(),
			$keys[16] => $this->getCaInterior(),
			$keys[17] => $this->getCaLocalidad(),
			$keys[18] => $this->getCaComplemento(),
			$keys[19] => $this->getCaTelefonos(),
			$keys[20] => $this->getCaFax(),
			$keys[21] => $this->getCaPreferencias(),
			$keys[22] => $this->getCaConfirmar(),
			$keys[23] => $this->getCaIdciudad(),
			$keys[24] => $this->getCaIdgrupo(),
			$keys[25] => $this->getCaListaclinton(),
			$keys[26] => $this->getCaFchcircular(),
			$keys[27] => $this->getCaStatus(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ClientePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdcliente($value);
				break;
			case 1:
				$this->setCaDigito($value);
				break;
			case 2:
				$this->setCaCompania($value);
				break;
			case 3:
				$this->setCaPapellido($value);
				break;
			case 4:
				$this->setCaSapellido($value);
				break;
			case 5:
				$this->setCaNombres($value);
				break;
			case 6:
				$this->setCaSaludo($value);
				break;
			case 7:
				$this->setCaSexo($value);
				break;
			case 8:
				$this->setCaCumpleanos($value);
				break;
			case 9:
				$this->setCaOficina($value);
				break;
			case 10:
				$this->setCaVendedor($value);
				break;
			case 11:
				$this->setCaEmail($value);
				break;
			case 12:
				$this->setCaCoordinador($value);
				break;
			case 13:
				$this->setCaDireccion($value);
				break;
			case 14:
				$this->setCaTorre($value);
				break;
			case 15:
				$this->setCaBloque($value);
				break;
			case 16:
				$this->setCaInterior($value);
				break;
			case 17:
				$this->setCaLocalidad($value);
				break;
			case 18:
				$this->setCaComplemento($value);
				break;
			case 19:
				$this->setCaTelefonos($value);
				break;
			case 20:
				$this->setCaFax($value);
				break;
			case 21:
				$this->setCaPreferencias($value);
				break;
			case 22:
				$this->setCaConfirmar($value);
				break;
			case 23:
				$this->setCaIdciudad($value);
				break;
			case 24:
				$this->setCaIdgrupo($value);
				break;
			case 25:
				$this->setCaListaclinton($value);
				break;
			case 26:
				$this->setCaFchcircular($value);
				break;
			case 27:
				$this->setCaStatus($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ClientePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdcliente($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaDigito($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaCompania($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaPapellido($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaSapellido($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaNombres($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaSaludo($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaSexo($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaCumpleanos($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaOficina($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaVendedor($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaEmail($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaCoordinador($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaDireccion($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaTorre($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaBloque($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaInterior($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaLocalidad($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCaComplemento($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setCaTelefonos($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCaFax($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setCaPreferencias($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setCaConfirmar($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setCaIdciudad($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setCaIdgrupo($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setCaListaclinton($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setCaFchcircular($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setCaStatus($arr[$keys[27]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ClientePeer::DATABASE_NAME);

		if ($this->isColumnModified(ClientePeer::CA_IDCLIENTE)) $criteria->add(ClientePeer::CA_IDCLIENTE, $this->ca_idcliente);
		if ($this->isColumnModified(ClientePeer::CA_DIGITO)) $criteria->add(ClientePeer::CA_DIGITO, $this->ca_digito);
		if ($this->isColumnModified(ClientePeer::CA_COMPANIA)) $criteria->add(ClientePeer::CA_COMPANIA, $this->ca_compania);
		if ($this->isColumnModified(ClientePeer::CA_PAPELLIDO)) $criteria->add(ClientePeer::CA_PAPELLIDO, $this->ca_papellido);
		if ($this->isColumnModified(ClientePeer::CA_SAPELLIDO)) $criteria->add(ClientePeer::CA_SAPELLIDO, $this->ca_sapellido);
		if ($this->isColumnModified(ClientePeer::CA_NOMBRES)) $criteria->add(ClientePeer::CA_NOMBRES, $this->ca_nombres);
		if ($this->isColumnModified(ClientePeer::CA_SALUDO)) $criteria->add(ClientePeer::CA_SALUDO, $this->ca_saludo);
		if ($this->isColumnModified(ClientePeer::CA_SEXO)) $criteria->add(ClientePeer::CA_SEXO, $this->ca_sexo);
		if ($this->isColumnModified(ClientePeer::CA_CUMPLEANOS)) $criteria->add(ClientePeer::CA_CUMPLEANOS, $this->ca_cumpleanos);
		if ($this->isColumnModified(ClientePeer::CA_OFICINA)) $criteria->add(ClientePeer::CA_OFICINA, $this->ca_oficina);
		if ($this->isColumnModified(ClientePeer::CA_VENDEDOR)) $criteria->add(ClientePeer::CA_VENDEDOR, $this->ca_vendedor);
		if ($this->isColumnModified(ClientePeer::CA_EMAIL)) $criteria->add(ClientePeer::CA_EMAIL, $this->ca_email);
		if ($this->isColumnModified(ClientePeer::CA_COORDINADOR)) $criteria->add(ClientePeer::CA_COORDINADOR, $this->ca_coordinador);
		if ($this->isColumnModified(ClientePeer::CA_DIRECCION)) $criteria->add(ClientePeer::CA_DIRECCION, $this->ca_direccion);
		if ($this->isColumnModified(ClientePeer::CA_TORRE)) $criteria->add(ClientePeer::CA_TORRE, $this->ca_torre);
		if ($this->isColumnModified(ClientePeer::CA_BLOQUE)) $criteria->add(ClientePeer::CA_BLOQUE, $this->ca_bloque);
		if ($this->isColumnModified(ClientePeer::CA_INTERIOR)) $criteria->add(ClientePeer::CA_INTERIOR, $this->ca_interior);
		if ($this->isColumnModified(ClientePeer::CA_LOCALIDAD)) $criteria->add(ClientePeer::CA_LOCALIDAD, $this->ca_localidad);
		if ($this->isColumnModified(ClientePeer::CA_COMPLEMENTO)) $criteria->add(ClientePeer::CA_COMPLEMENTO, $this->ca_complemento);
		if ($this->isColumnModified(ClientePeer::CA_TELEFONOS)) $criteria->add(ClientePeer::CA_TELEFONOS, $this->ca_telefonos);
		if ($this->isColumnModified(ClientePeer::CA_FAX)) $criteria->add(ClientePeer::CA_FAX, $this->ca_fax);
		if ($this->isColumnModified(ClientePeer::CA_PREFERENCIAS)) $criteria->add(ClientePeer::CA_PREFERENCIAS, $this->ca_preferencias);
		if ($this->isColumnModified(ClientePeer::CA_CONFIRMAR)) $criteria->add(ClientePeer::CA_CONFIRMAR, $this->ca_confirmar);
		if ($this->isColumnModified(ClientePeer::CA_IDCIUDAD)) $criteria->add(ClientePeer::CA_IDCIUDAD, $this->ca_idciudad);
		if ($this->isColumnModified(ClientePeer::CA_IDGRUPO)) $criteria->add(ClientePeer::CA_IDGRUPO, $this->ca_idgrupo);
		if ($this->isColumnModified(ClientePeer::CA_LISTACLINTON)) $criteria->add(ClientePeer::CA_LISTACLINTON, $this->ca_listaclinton);
		if ($this->isColumnModified(ClientePeer::CA_FCHCIRCULAR)) $criteria->add(ClientePeer::CA_FCHCIRCULAR, $this->ca_fchcircular);
		if ($this->isColumnModified(ClientePeer::CA_STATUS)) $criteria->add(ClientePeer::CA_STATUS, $this->ca_status);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ClientePeer::DATABASE_NAME);

		$criteria->add(ClientePeer::CA_IDCLIENTE, $this->ca_idcliente);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdcliente();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdcliente($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaDigito($this->ca_digito);

		$copyObj->setCaCompania($this->ca_compania);

		$copyObj->setCaPapellido($this->ca_papellido);

		$copyObj->setCaSapellido($this->ca_sapellido);

		$copyObj->setCaNombres($this->ca_nombres);

		$copyObj->setCaSaludo($this->ca_saludo);

		$copyObj->setCaSexo($this->ca_sexo);

		$copyObj->setCaCumpleanos($this->ca_cumpleanos);

		$copyObj->setCaOficina($this->ca_oficina);

		$copyObj->setCaVendedor($this->ca_vendedor);

		$copyObj->setCaEmail($this->ca_email);

		$copyObj->setCaCoordinador($this->ca_coordinador);

		$copyObj->setCaDireccion($this->ca_direccion);

		$copyObj->setCaTorre($this->ca_torre);

		$copyObj->setCaBloque($this->ca_bloque);

		$copyObj->setCaInterior($this->ca_interior);

		$copyObj->setCaLocalidad($this->ca_localidad);

		$copyObj->setCaComplemento($this->ca_complemento);

		$copyObj->setCaTelefonos($this->ca_telefonos);

		$copyObj->setCaFax($this->ca_fax);

		$copyObj->setCaPreferencias($this->ca_preferencias);

		$copyObj->setCaConfirmar($this->ca_confirmar);

		$copyObj->setCaIdciudad($this->ca_idciudad);

		$copyObj->setCaIdgrupo($this->ca_idgrupo);

		$copyObj->setCaListaclinton($this->ca_listaclinton);

		$copyObj->setCaFchcircular($this->ca_fchcircular);

		$copyObj->setCaStatus($this->ca_status);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getAduanaMaestras() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addAduanaMaestra($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getContactos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addContacto($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getClienteStds() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addClienteStd($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getInoClientesSeas() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addInoClientesSea($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getInoIngresosSeas() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addInoIngresosSea($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getInoAvisosSeas() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addInoAvisosSea($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getInoIngresosAirs() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addInoIngresosAir($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCaIdcliente(NULL); 
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
			self::$peer = new ClientePeer();
		}
		return self::$peer;
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
			$v->addCliente($this);
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

	
	public function clearAduanaMaestras()
	{
		$this->collAduanaMaestras = null; 	}

	
	public function initAduanaMaestras()
	{
		$this->collAduanaMaestras = array();
	}

	
	public function getAduanaMaestras($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAduanaMaestras === null) {
			if ($this->isNew()) {
			   $this->collAduanaMaestras = array();
			} else {

				$criteria->add(AduanaMaestraPeer::CA_IDCLIENTE, $this->ca_idcliente);

				AduanaMaestraPeer::addSelectColumns($criteria);
				$this->collAduanaMaestras = AduanaMaestraPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AduanaMaestraPeer::CA_IDCLIENTE, $this->ca_idcliente);

				AduanaMaestraPeer::addSelectColumns($criteria);
				if (!isset($this->lastAduanaMaestraCriteria) || !$this->lastAduanaMaestraCriteria->equals($criteria)) {
					$this->collAduanaMaestras = AduanaMaestraPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAduanaMaestraCriteria = $criteria;
		return $this->collAduanaMaestras;
	}

	
	public function countAduanaMaestras(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collAduanaMaestras === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(AduanaMaestraPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$count = AduanaMaestraPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AduanaMaestraPeer::CA_IDCLIENTE, $this->ca_idcliente);

				if (!isset($this->lastAduanaMaestraCriteria) || !$this->lastAduanaMaestraCriteria->equals($criteria)) {
					$count = AduanaMaestraPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collAduanaMaestras);
				}
			} else {
				$count = count($this->collAduanaMaestras);
			}
		}
		return $count;
	}

	
	public function addAduanaMaestra(AduanaMaestra $l)
	{
		if ($this->collAduanaMaestras === null) {
			$this->initAduanaMaestras();
		}
		if (!in_array($l, $this->collAduanaMaestras, true)) { 			array_push($this->collAduanaMaestras, $l);
			$l->setCliente($this);
		}
	}

	
	public function clearContactos()
	{
		$this->collContactos = null; 	}

	
	public function initContactos()
	{
		$this->collContactos = array();
	}

	
	public function getContactos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collContactos === null) {
			if ($this->isNew()) {
			   $this->collContactos = array();
			} else {

				$criteria->add(ContactoPeer::CA_IDCLIENTE, $this->ca_idcliente);

				ContactoPeer::addSelectColumns($criteria);
				$this->collContactos = ContactoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ContactoPeer::CA_IDCLIENTE, $this->ca_idcliente);

				ContactoPeer::addSelectColumns($criteria);
				if (!isset($this->lastContactoCriteria) || !$this->lastContactoCriteria->equals($criteria)) {
					$this->collContactos = ContactoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastContactoCriteria = $criteria;
		return $this->collContactos;
	}

	
	public function countContactos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collContactos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ContactoPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$count = ContactoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ContactoPeer::CA_IDCLIENTE, $this->ca_idcliente);

				if (!isset($this->lastContactoCriteria) || !$this->lastContactoCriteria->equals($criteria)) {
					$count = ContactoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collContactos);
				}
			} else {
				$count = count($this->collContactos);
			}
		}
		return $count;
	}

	
	public function addContacto(Contacto $l)
	{
		if ($this->collContactos === null) {
			$this->initContactos();
		}
		if (!in_array($l, $this->collContactos, true)) { 			array_push($this->collContactos, $l);
			$l->setCliente($this);
		}
	}

	
	public function clearClienteStds()
	{
		$this->collClienteStds = null; 	}

	
	public function initClienteStds()
	{
		$this->collClienteStds = array();
	}

	
	public function getClienteStds($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClienteStds === null) {
			if ($this->isNew()) {
			   $this->collClienteStds = array();
			} else {

				$criteria->add(ClienteStdPeer::CA_IDCLIENTE, $this->ca_idcliente);

				ClienteStdPeer::addSelectColumns($criteria);
				$this->collClienteStds = ClienteStdPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ClienteStdPeer::CA_IDCLIENTE, $this->ca_idcliente);

				ClienteStdPeer::addSelectColumns($criteria);
				if (!isset($this->lastClienteStdCriteria) || !$this->lastClienteStdCriteria->equals($criteria)) {
					$this->collClienteStds = ClienteStdPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastClienteStdCriteria = $criteria;
		return $this->collClienteStds;
	}

	
	public function countClienteStds(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collClienteStds === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ClienteStdPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$count = ClienteStdPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ClienteStdPeer::CA_IDCLIENTE, $this->ca_idcliente);

				if (!isset($this->lastClienteStdCriteria) || !$this->lastClienteStdCriteria->equals($criteria)) {
					$count = ClienteStdPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collClienteStds);
				}
			} else {
				$count = count($this->collClienteStds);
			}
		}
		return $count;
	}

	
	public function addClienteStd(ClienteStd $l)
	{
		if ($this->collClienteStds === null) {
			$this->initClienteStds();
		}
		if (!in_array($l, $this->collClienteStds, true)) { 			array_push($this->collClienteStds, $l);
			$l->setCliente($this);
		}
	}

	
	public function clearInoClientesSeas()
	{
		$this->collInoClientesSeas = null; 	}

	
	public function initInoClientesSeas()
	{
		$this->collInoClientesSeas = array();
	}

	
	public function getInoClientesSeas($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
			   $this->collInoClientesSeas = array();
			} else {

				$criteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				InoClientesSeaPeer::addSelectColumns($criteria);
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				InoClientesSeaPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
					$this->collInoClientesSeas = InoClientesSeaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;
		return $this->collInoClientesSeas;
	}

	
	public function countInoClientesSeas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$count = InoClientesSeaPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
					$count = InoClientesSeaPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collInoClientesSeas);
				}
			} else {
				$count = count($this->collInoClientesSeas);
			}
		}
		return $count;
	}

	
	public function addInoClientesSea(InoClientesSea $l)
	{
		if ($this->collInoClientesSeas === null) {
			$this->initInoClientesSeas();
		}
		if (!in_array($l, $this->collInoClientesSeas, true)) { 			array_push($this->collInoClientesSeas, $l);
			$l->setCliente($this);
		}
	}


	
	public function getInoClientesSeasJoinReporte($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
				$this->collInoClientesSeas = array();
			} else {

				$criteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

			if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;

		return $this->collInoClientesSeas;
	}


	
	public function getInoClientesSeasJoinTercero($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
				$this->collInoClientesSeas = array();
			} else {

				$criteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

			if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;

		return $this->collInoClientesSeas;
	}


	
	public function getInoClientesSeasJoinInoMaestraSea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
				$this->collInoClientesSeas = array();
			} else {

				$criteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinInoMaestraSea($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

			if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinInoMaestraSea($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;

		return $this->collInoClientesSeas;
	}

	
	public function clearInoIngresosSeas()
	{
		$this->collInoIngresosSeas = null; 	}

	
	public function initInoIngresosSeas()
	{
		$this->collInoIngresosSeas = array();
	}

	
	public function getInoIngresosSeas($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoIngresosSeas === null) {
			if ($this->isNew()) {
			   $this->collInoIngresosSeas = array();
			} else {

				$criteria->add(InoIngresosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				InoIngresosSeaPeer::addSelectColumns($criteria);
				$this->collInoIngresosSeas = InoIngresosSeaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoIngresosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				InoIngresosSeaPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoIngresosSeaCriteria) || !$this->lastInoIngresosSeaCriteria->equals($criteria)) {
					$this->collInoIngresosSeas = InoIngresosSeaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoIngresosSeaCriteria = $criteria;
		return $this->collInoIngresosSeas;
	}

	
	public function countInoIngresosSeas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collInoIngresosSeas === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(InoIngresosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$count = InoIngresosSeaPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoIngresosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				if (!isset($this->lastInoIngresosSeaCriteria) || !$this->lastInoIngresosSeaCriteria->equals($criteria)) {
					$count = InoIngresosSeaPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collInoIngresosSeas);
				}
			} else {
				$count = count($this->collInoIngresosSeas);
			}
		}
		return $count;
	}

	
	public function addInoIngresosSea(InoIngresosSea $l)
	{
		if ($this->collInoIngresosSeas === null) {
			$this->initInoIngresosSeas();
		}
		if (!in_array($l, $this->collInoIngresosSeas, true)) { 			array_push($this->collInoIngresosSeas, $l);
			$l->setCliente($this);
		}
	}


	
	public function getInoIngresosSeasJoinInoMaestraSea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoIngresosSeas === null) {
			if ($this->isNew()) {
				$this->collInoIngresosSeas = array();
			} else {

				$criteria->add(InoIngresosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$this->collInoIngresosSeas = InoIngresosSeaPeer::doSelectJoinInoMaestraSea($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoIngresosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

			if (!isset($this->lastInoIngresosSeaCriteria) || !$this->lastInoIngresosSeaCriteria->equals($criteria)) {
				$this->collInoIngresosSeas = InoIngresosSeaPeer::doSelectJoinInoMaestraSea($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoIngresosSeaCriteria = $criteria;

		return $this->collInoIngresosSeas;
	}

	
	public function clearInoAvisosSeas()
	{
		$this->collInoAvisosSeas = null; 	}

	
	public function initInoAvisosSeas()
	{
		$this->collInoAvisosSeas = array();
	}

	
	public function getInoAvisosSeas($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoAvisosSeas === null) {
			if ($this->isNew()) {
			   $this->collInoAvisosSeas = array();
			} else {

				$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				InoAvisosSeaPeer::addSelectColumns($criteria);
				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				InoAvisosSeaPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoAvisosSeaCriteria) || !$this->lastInoAvisosSeaCriteria->equals($criteria)) {
					$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoAvisosSeaCriteria = $criteria;
		return $this->collInoAvisosSeas;
	}

	
	public function countInoAvisosSeas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collInoAvisosSeas === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$count = InoAvisosSeaPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				if (!isset($this->lastInoAvisosSeaCriteria) || !$this->lastInoAvisosSeaCriteria->equals($criteria)) {
					$count = InoAvisosSeaPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collInoAvisosSeas);
				}
			} else {
				$count = count($this->collInoAvisosSeas);
			}
		}
		return $count;
	}

	
	public function addInoAvisosSea(InoAvisosSea $l)
	{
		if ($this->collInoAvisosSeas === null) {
			$this->initInoAvisosSeas();
		}
		if (!in_array($l, $this->collInoAvisosSeas, true)) { 			array_push($this->collInoAvisosSeas, $l);
			$l->setCliente($this);
		}
	}


	
	public function getInoAvisosSeasJoinInoClientesSea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoAvisosSeas === null) {
			if ($this->isNew()) {
				$this->collInoAvisosSeas = array();
			} else {

				$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinInoClientesSea($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

			if (!isset($this->lastInoAvisosSeaCriteria) || !$this->lastInoAvisosSeaCriteria->equals($criteria)) {
				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinInoClientesSea($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoAvisosSeaCriteria = $criteria;

		return $this->collInoAvisosSeas;
	}


	
	public function getInoAvisosSeasJoinInoMaestraSea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoAvisosSeas === null) {
			if ($this->isNew()) {
				$this->collInoAvisosSeas = array();
			} else {

				$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinInoMaestraSea($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

			if (!isset($this->lastInoAvisosSeaCriteria) || !$this->lastInoAvisosSeaCriteria->equals($criteria)) {
				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinInoMaestraSea($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoAvisosSeaCriteria = $criteria;

		return $this->collInoAvisosSeas;
	}


	
	public function getInoAvisosSeasJoinEmail($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoAvisosSeas === null) {
			if ($this->isNew()) {
				$this->collInoAvisosSeas = array();
			} else {

				$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinEmail($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

			if (!isset($this->lastInoAvisosSeaCriteria) || !$this->lastInoAvisosSeaCriteria->equals($criteria)) {
				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinEmail($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoAvisosSeaCriteria = $criteria;

		return $this->collInoAvisosSeas;
	}

	
	public function clearInoIngresosAirs()
	{
		$this->collInoIngresosAirs = null; 	}

	
	public function initInoIngresosAirs()
	{
		$this->collInoIngresosAirs = array();
	}

	
	public function getInoIngresosAirs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoIngresosAirs === null) {
			if ($this->isNew()) {
			   $this->collInoIngresosAirs = array();
			} else {

				$criteria->add(InoIngresosAirPeer::CA_IDCLIENTE, $this->ca_idcliente);

				InoIngresosAirPeer::addSelectColumns($criteria);
				$this->collInoIngresosAirs = InoIngresosAirPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoIngresosAirPeer::CA_IDCLIENTE, $this->ca_idcliente);

				InoIngresosAirPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoIngresosAirCriteria) || !$this->lastInoIngresosAirCriteria->equals($criteria)) {
					$this->collInoIngresosAirs = InoIngresosAirPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoIngresosAirCriteria = $criteria;
		return $this->collInoIngresosAirs;
	}

	
	public function countInoIngresosAirs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collInoIngresosAirs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(InoIngresosAirPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$count = InoIngresosAirPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoIngresosAirPeer::CA_IDCLIENTE, $this->ca_idcliente);

				if (!isset($this->lastInoIngresosAirCriteria) || !$this->lastInoIngresosAirCriteria->equals($criteria)) {
					$count = InoIngresosAirPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collInoIngresosAirs);
				}
			} else {
				$count = count($this->collInoIngresosAirs);
			}
		}
		return $count;
	}

	
	public function addInoIngresosAir(InoIngresosAir $l)
	{
		if ($this->collInoIngresosAirs === null) {
			$this->initInoIngresosAirs();
		}
		if (!in_array($l, $this->collInoIngresosAirs, true)) { 			array_push($this->collInoIngresosAirs, $l);
			$l->setCliente($this);
		}
	}


	
	public function getInoIngresosAirsJoinInoMaestraAir($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(ClientePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoIngresosAirs === null) {
			if ($this->isNew()) {
				$this->collInoIngresosAirs = array();
			} else {

				$criteria->add(InoIngresosAirPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$this->collInoIngresosAirs = InoIngresosAirPeer::doSelectJoinInoMaestraAir($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoIngresosAirPeer::CA_IDCLIENTE, $this->ca_idcliente);

			if (!isset($this->lastInoIngresosAirCriteria) || !$this->lastInoIngresosAirCriteria->equals($criteria)) {
				$this->collInoIngresosAirs = InoIngresosAirPeer::doSelectJoinInoMaestraAir($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoIngresosAirCriteria = $criteria;

		return $this->collInoIngresosAirs;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collAduanaMaestras) {
				foreach ((array) $this->collAduanaMaestras as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collContactos) {
				foreach ((array) $this->collContactos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collClienteStds) {
				foreach ((array) $this->collClienteStds as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collInoClientesSeas) {
				foreach ((array) $this->collInoClientesSeas as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collInoIngresosSeas) {
				foreach ((array) $this->collInoIngresosSeas as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collInoAvisosSeas) {
				foreach ((array) $this->collInoAvisosSeas as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collInoIngresosAirs) {
				foreach ((array) $this->collInoIngresosAirs as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collAduanaMaestras = null;
		$this->collContactos = null;
		$this->collClienteStds = null;
		$this->collInoClientesSeas = null;
		$this->collInoIngresosSeas = null;
		$this->collInoAvisosSeas = null;
		$this->collInoIngresosAirs = null;
			$this->aCiudad = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseCliente:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseCliente::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 