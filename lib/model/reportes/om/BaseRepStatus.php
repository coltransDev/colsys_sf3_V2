<?php


abstract class BaseRepStatus extends BaseObject  implements Persistent {


  const PEER = 'RepStatusPeer';

	
	protected static $peer;

	
	protected $ca_idstatus;

	
	protected $ca_idreporte;

	
	protected $ca_idemail;

	
	protected $ca_fchstatus;

	
	protected $ca_status;

	
	protected $ca_comentarios;

	
	protected $ca_fchrecibo;

	
	protected $ca_fchenvio;

	
	protected $ca_usuenvio;

	
	protected $ca_etapa;

	
	protected $ca_introduccion;

	
	protected $ca_fchsalida;

	
	protected $ca_fchllegada;

	
	protected $ca_fchcontinuacion;

	
	protected $ca_piezas;

	
	protected $ca_peso;

	
	protected $ca_volumen;

	
	protected $ca_doctransporte;

	
	protected $ca_idnave;

	
	protected $ca_docmaster;

	
	protected $ca_equipos;

	
	protected $ca_horasalida;

	
	protected $ca_horallegada;

	
	protected $ca_idetapa;

	
	protected $ca_propiedades;

	
	protected $aReporte;

	
	protected $aEmail;

	
	protected $aTrackingEtapa;

	
	protected $collRepStatusRespuestas;

	
	private $lastRepStatusRespuestaCriteria = null;

	
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

	
	public function getCaIdstatus()
	{
		return $this->ca_idstatus;
	}

	
	public function getCaIdreporte()
	{
		return $this->ca_idreporte;
	}

	
	public function getCaIdemail()
	{
		return $this->ca_idemail;
	}

	
	public function getCaFchstatus($format = 'Y-m-d')
	{
		if ($this->ca_fchstatus === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchstatus);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchstatus, true), $x);
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

	
	public function getCaComentarios()
	{
		return $this->ca_comentarios;
	}

	
	public function getCaFchrecibo($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchrecibo === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchrecibo);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchrecibo, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaFchenvio($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchenvio === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchenvio);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchenvio, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaUsuenvio()
	{
		return $this->ca_usuenvio;
	}

	
	public function getCaEtapa()
	{
		return $this->ca_etapa;
	}

	
	public function getCaIntroduccion()
	{
		return $this->ca_introduccion;
	}

	
	public function getCaFchsalida($format = 'Y-m-d')
	{
		if ($this->ca_fchsalida === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchsalida);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchsalida, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaFchllegada($format = 'Y-m-d')
	{
		if ($this->ca_fchllegada === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchllegada);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchllegada, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaFchcontinuacion()
	{
		return $this->ca_fchcontinuacion;
	}

	
	public function getCaPiezas()
	{
		return $this->ca_piezas;
	}

	
	public function getCaPeso()
	{
		return $this->ca_peso;
	}

	
	public function getCaVolumen()
	{
		return $this->ca_volumen;
	}

	
	public function getCaDoctransporte()
	{
		return $this->ca_doctransporte;
	}

	
	public function getCaIdnave()
	{
		return $this->ca_idnave;
	}

	
	public function getCaDocmaster()
	{
		return $this->ca_docmaster;
	}

	
	public function getCaEquipos()
	{
		return $this->ca_equipos;
	}

	
	public function getCaHorasalida($format = 'H:i:s')
	{
		if ($this->ca_horasalida === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_horasalida);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_horasalida, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaHorallegada($format = 'H:i:s')
	{
		if ($this->ca_horallegada === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_horallegada);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_horallegada, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaIdetapa()
	{
		return $this->ca_idetapa;
	}

	
	public function getCaPropiedades()
	{
		return $this->ca_propiedades;
	}

	
	public function setCaIdstatus($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idstatus !== $v) {
			$this->ca_idstatus = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_IDSTATUS;
		}

		return $this;
	} 
	
	public function setCaIdreporte($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idreporte !== $v) {
			$this->ca_idreporte = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_IDREPORTE;
		}

		if ($this->aReporte !== null && $this->aReporte->getCaIdreporte() !== $v) {
			$this->aReporte = null;
		}

		return $this;
	} 
	
	public function setCaIdemail($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idemail !== $v) {
			$this->ca_idemail = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_IDEMAIL;
		}

		if ($this->aEmail !== null && $this->aEmail->getCaIdemail() !== $v) {
			$this->aEmail = null;
		}

		return $this;
	} 
	
	public function setCaFchstatus($v)
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

		if ( $this->ca_fchstatus !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchstatus !== null && $tmpDt = new DateTime($this->ca_fchstatus)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchstatus = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = RepStatusPeer::CA_FCHSTATUS;
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
			$this->modifiedColumns[] = RepStatusPeer::CA_STATUS;
		}

		return $this;
	} 
	
	public function setCaComentarios($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_comentarios !== $v) {
			$this->ca_comentarios = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_COMENTARIOS;
		}

		return $this;
	} 
	
	public function setCaFchrecibo($v)
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

		if ( $this->ca_fchrecibo !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchrecibo !== null && $tmpDt = new DateTime($this->ca_fchrecibo)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchrecibo = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = RepStatusPeer::CA_FCHRECIBO;
			}
		} 
		return $this;
	} 
	
	public function setCaFchenvio($v)
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

		if ( $this->ca_fchenvio !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchenvio !== null && $tmpDt = new DateTime($this->ca_fchenvio)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchenvio = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = RepStatusPeer::CA_FCHENVIO;
			}
		} 
		return $this;
	} 
	
	public function setCaUsuenvio($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuenvio !== $v) {
			$this->ca_usuenvio = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_USUENVIO;
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
			$this->modifiedColumns[] = RepStatusPeer::CA_ETAPA;
		}

		return $this;
	} 
	
	public function setCaIntroduccion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_introduccion !== $v) {
			$this->ca_introduccion = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_INTRODUCCION;
		}

		return $this;
	} 
	
	public function setCaFchsalida($v)
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

		if ( $this->ca_fchsalida !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchsalida !== null && $tmpDt = new DateTime($this->ca_fchsalida)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchsalida = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = RepStatusPeer::CA_FCHSALIDA;
			}
		} 
		return $this;
	} 
	
	public function setCaFchllegada($v)
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

		if ( $this->ca_fchllegada !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchllegada !== null && $tmpDt = new DateTime($this->ca_fchllegada)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchllegada = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = RepStatusPeer::CA_FCHLLEGADA;
			}
		} 
		return $this;
	} 
	
	public function setCaFchcontinuacion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_fchcontinuacion !== $v) {
			$this->ca_fchcontinuacion = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_FCHCONTINUACION;
		}

		return $this;
	} 
	
	public function setCaPiezas($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_piezas !== $v) {
			$this->ca_piezas = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_PIEZAS;
		}

		return $this;
	} 
	
	public function setCaPeso($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_peso !== $v) {
			$this->ca_peso = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_PESO;
		}

		return $this;
	} 
	
	public function setCaVolumen($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_volumen !== $v) {
			$this->ca_volumen = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_VOLUMEN;
		}

		return $this;
	} 
	
	public function setCaDoctransporte($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_doctransporte !== $v) {
			$this->ca_doctransporte = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_DOCTRANSPORTE;
		}

		return $this;
	} 
	
	public function setCaIdnave($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idnave !== $v) {
			$this->ca_idnave = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_IDNAVE;
		}

		return $this;
	} 
	
	public function setCaDocmaster($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_docmaster !== $v) {
			$this->ca_docmaster = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_DOCMASTER;
		}

		return $this;
	} 
	
	public function setCaEquipos($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_equipos !== $v) {
			$this->ca_equipos = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_EQUIPOS;
		}

		return $this;
	} 
	
	public function setCaHorasalida($v)
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

		if ( $this->ca_horasalida !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_horasalida !== null && $tmpDt = new DateTime($this->ca_horasalida)) ? $tmpDt->format('H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('H:i:s') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_horasalida = ($dt ? $dt->format('H:i:s') : null);
				$this->modifiedColumns[] = RepStatusPeer::CA_HORASALIDA;
			}
		} 
		return $this;
	} 
	
	public function setCaHorallegada($v)
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

		if ( $this->ca_horallegada !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_horallegada !== null && $tmpDt = new DateTime($this->ca_horallegada)) ? $tmpDt->format('H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('H:i:s') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_horallegada = ($dt ? $dt->format('H:i:s') : null);
				$this->modifiedColumns[] = RepStatusPeer::CA_HORALLEGADA;
			}
		} 
		return $this;
	} 
	
	public function setCaIdetapa($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idetapa !== $v) {
			$this->ca_idetapa = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_IDETAPA;
		}

		if ($this->aTrackingEtapa !== null && $this->aTrackingEtapa->getCaIdetapa() !== $v) {
			$this->aTrackingEtapa = null;
		}

		return $this;
	} 
	
	public function setCaPropiedades($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_propiedades !== $v) {
			$this->ca_propiedades = $v;
			$this->modifiedColumns[] = RepStatusPeer::CA_PROPIEDADES;
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

			$this->ca_idstatus = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idreporte = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_idemail = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->ca_fchstatus = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_status = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_comentarios = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_fchrecibo = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_fchenvio = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_usuenvio = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_etapa = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_introduccion = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_fchsalida = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_fchllegada = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_fchcontinuacion = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_piezas = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_peso = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_volumen = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->ca_doctransporte = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
			$this->ca_idnave = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
			$this->ca_docmaster = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
			$this->ca_equipos = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
			$this->ca_horasalida = ($row[$startcol + 21] !== null) ? (string) $row[$startcol + 21] : null;
			$this->ca_horallegada = ($row[$startcol + 22] !== null) ? (string) $row[$startcol + 22] : null;
			$this->ca_idetapa = ($row[$startcol + 23] !== null) ? (string) $row[$startcol + 23] : null;
			$this->ca_propiedades = ($row[$startcol + 24] !== null) ? (string) $row[$startcol + 24] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 25; 
		} catch (Exception $e) {
			throw new PropelException("Error populating RepStatus object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aReporte !== null && $this->ca_idreporte !== $this->aReporte->getCaIdreporte()) {
			$this->aReporte = null;
		}
		if ($this->aEmail !== null && $this->ca_idemail !== $this->aEmail->getCaIdemail()) {
			$this->aEmail = null;
		}
		if ($this->aTrackingEtapa !== null && $this->ca_idetapa !== $this->aTrackingEtapa->getCaIdetapa()) {
			$this->aTrackingEtapa = null;
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
			$con = Propel::getConnection(RepStatusPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = RepStatusPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aReporte = null;
			$this->aEmail = null;
			$this->aTrackingEtapa = null;
			$this->collRepStatusRespuestas = null;
			$this->lastRepStatusRespuestaCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepStatus:delete:pre') as $callable)
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
			$con = Propel::getConnection(RepStatusPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			RepStatusPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseRepStatus:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepStatus:save:pre') as $callable)
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
			$con = Propel::getConnection(RepStatusPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseRepStatus:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			RepStatusPeer::addInstanceToPool($this);
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

												
			if ($this->aReporte !== null) {
				if ($this->aReporte->isModified() || $this->aReporte->isNew()) {
					$affectedRows += $this->aReporte->save($con);
				}
				$this->setReporte($this->aReporte);
			}

			if ($this->aEmail !== null) {
				if ($this->aEmail->isModified() || $this->aEmail->isNew()) {
					$affectedRows += $this->aEmail->save($con);
				}
				$this->setEmail($this->aEmail);
			}

			if ($this->aTrackingEtapa !== null) {
				if ($this->aTrackingEtapa->isModified() || $this->aTrackingEtapa->isNew()) {
					$affectedRows += $this->aTrackingEtapa->save($con);
				}
				$this->setTrackingEtapa($this->aTrackingEtapa);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = RepStatusPeer::CA_IDSTATUS;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RepStatusPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdstatus($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += RepStatusPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collRepStatusRespuestas !== null) {
				foreach ($this->collRepStatusRespuestas as $referrerFK) {
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


												
			if ($this->aReporte !== null) {
				if (!$this->aReporte->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aReporte->getValidationFailures());
				}
			}

			if ($this->aEmail !== null) {
				if (!$this->aEmail->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEmail->getValidationFailures());
				}
			}

			if ($this->aTrackingEtapa !== null) {
				if (!$this->aTrackingEtapa->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTrackingEtapa->getValidationFailures());
				}
			}


			if (($retval = RepStatusPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collRepStatusRespuestas !== null) {
					foreach ($this->collRepStatusRespuestas as $referrerFK) {
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
		$pos = RepStatusPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdstatus();
				break;
			case 1:
				return $this->getCaIdreporte();
				break;
			case 2:
				return $this->getCaIdemail();
				break;
			case 3:
				return $this->getCaFchstatus();
				break;
			case 4:
				return $this->getCaStatus();
				break;
			case 5:
				return $this->getCaComentarios();
				break;
			case 6:
				return $this->getCaFchrecibo();
				break;
			case 7:
				return $this->getCaFchenvio();
				break;
			case 8:
				return $this->getCaUsuenvio();
				break;
			case 9:
				return $this->getCaEtapa();
				break;
			case 10:
				return $this->getCaIntroduccion();
				break;
			case 11:
				return $this->getCaFchsalida();
				break;
			case 12:
				return $this->getCaFchllegada();
				break;
			case 13:
				return $this->getCaFchcontinuacion();
				break;
			case 14:
				return $this->getCaPiezas();
				break;
			case 15:
				return $this->getCaPeso();
				break;
			case 16:
				return $this->getCaVolumen();
				break;
			case 17:
				return $this->getCaDoctransporte();
				break;
			case 18:
				return $this->getCaIdnave();
				break;
			case 19:
				return $this->getCaDocmaster();
				break;
			case 20:
				return $this->getCaEquipos();
				break;
			case 21:
				return $this->getCaHorasalida();
				break;
			case 22:
				return $this->getCaHorallegada();
				break;
			case 23:
				return $this->getCaIdetapa();
				break;
			case 24:
				return $this->getCaPropiedades();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = RepStatusPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdstatus(),
			$keys[1] => $this->getCaIdreporte(),
			$keys[2] => $this->getCaIdemail(),
			$keys[3] => $this->getCaFchstatus(),
			$keys[4] => $this->getCaStatus(),
			$keys[5] => $this->getCaComentarios(),
			$keys[6] => $this->getCaFchrecibo(),
			$keys[7] => $this->getCaFchenvio(),
			$keys[8] => $this->getCaUsuenvio(),
			$keys[9] => $this->getCaEtapa(),
			$keys[10] => $this->getCaIntroduccion(),
			$keys[11] => $this->getCaFchsalida(),
			$keys[12] => $this->getCaFchllegada(),
			$keys[13] => $this->getCaFchcontinuacion(),
			$keys[14] => $this->getCaPiezas(),
			$keys[15] => $this->getCaPeso(),
			$keys[16] => $this->getCaVolumen(),
			$keys[17] => $this->getCaDoctransporte(),
			$keys[18] => $this->getCaIdnave(),
			$keys[19] => $this->getCaDocmaster(),
			$keys[20] => $this->getCaEquipos(),
			$keys[21] => $this->getCaHorasalida(),
			$keys[22] => $this->getCaHorallegada(),
			$keys[23] => $this->getCaIdetapa(),
			$keys[24] => $this->getCaPropiedades(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RepStatusPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdstatus($value);
				break;
			case 1:
				$this->setCaIdreporte($value);
				break;
			case 2:
				$this->setCaIdemail($value);
				break;
			case 3:
				$this->setCaFchstatus($value);
				break;
			case 4:
				$this->setCaStatus($value);
				break;
			case 5:
				$this->setCaComentarios($value);
				break;
			case 6:
				$this->setCaFchrecibo($value);
				break;
			case 7:
				$this->setCaFchenvio($value);
				break;
			case 8:
				$this->setCaUsuenvio($value);
				break;
			case 9:
				$this->setCaEtapa($value);
				break;
			case 10:
				$this->setCaIntroduccion($value);
				break;
			case 11:
				$this->setCaFchsalida($value);
				break;
			case 12:
				$this->setCaFchllegada($value);
				break;
			case 13:
				$this->setCaFchcontinuacion($value);
				break;
			case 14:
				$this->setCaPiezas($value);
				break;
			case 15:
				$this->setCaPeso($value);
				break;
			case 16:
				$this->setCaVolumen($value);
				break;
			case 17:
				$this->setCaDoctransporte($value);
				break;
			case 18:
				$this->setCaIdnave($value);
				break;
			case 19:
				$this->setCaDocmaster($value);
				break;
			case 20:
				$this->setCaEquipos($value);
				break;
			case 21:
				$this->setCaHorasalida($value);
				break;
			case 22:
				$this->setCaHorallegada($value);
				break;
			case 23:
				$this->setCaIdetapa($value);
				break;
			case 24:
				$this->setCaPropiedades($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RepStatusPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdstatus($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdreporte($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdemail($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaFchstatus($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaStatus($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaComentarios($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaFchrecibo($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaFchenvio($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaUsuenvio($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaEtapa($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaIntroduccion($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaFchsalida($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaFchllegada($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaFchcontinuacion($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaPiezas($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaPeso($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaVolumen($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaDoctransporte($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCaIdnave($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setCaDocmaster($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCaEquipos($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setCaHorasalida($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setCaHorallegada($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setCaIdetapa($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setCaPropiedades($arr[$keys[24]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RepStatusPeer::DATABASE_NAME);

		if ($this->isColumnModified(RepStatusPeer::CA_IDSTATUS)) $criteria->add(RepStatusPeer::CA_IDSTATUS, $this->ca_idstatus);
		if ($this->isColumnModified(RepStatusPeer::CA_IDREPORTE)) $criteria->add(RepStatusPeer::CA_IDREPORTE, $this->ca_idreporte);
		if ($this->isColumnModified(RepStatusPeer::CA_IDEMAIL)) $criteria->add(RepStatusPeer::CA_IDEMAIL, $this->ca_idemail);
		if ($this->isColumnModified(RepStatusPeer::CA_FCHSTATUS)) $criteria->add(RepStatusPeer::CA_FCHSTATUS, $this->ca_fchstatus);
		if ($this->isColumnModified(RepStatusPeer::CA_STATUS)) $criteria->add(RepStatusPeer::CA_STATUS, $this->ca_status);
		if ($this->isColumnModified(RepStatusPeer::CA_COMENTARIOS)) $criteria->add(RepStatusPeer::CA_COMENTARIOS, $this->ca_comentarios);
		if ($this->isColumnModified(RepStatusPeer::CA_FCHRECIBO)) $criteria->add(RepStatusPeer::CA_FCHRECIBO, $this->ca_fchrecibo);
		if ($this->isColumnModified(RepStatusPeer::CA_FCHENVIO)) $criteria->add(RepStatusPeer::CA_FCHENVIO, $this->ca_fchenvio);
		if ($this->isColumnModified(RepStatusPeer::CA_USUENVIO)) $criteria->add(RepStatusPeer::CA_USUENVIO, $this->ca_usuenvio);
		if ($this->isColumnModified(RepStatusPeer::CA_ETAPA)) $criteria->add(RepStatusPeer::CA_ETAPA, $this->ca_etapa);
		if ($this->isColumnModified(RepStatusPeer::CA_INTRODUCCION)) $criteria->add(RepStatusPeer::CA_INTRODUCCION, $this->ca_introduccion);
		if ($this->isColumnModified(RepStatusPeer::CA_FCHSALIDA)) $criteria->add(RepStatusPeer::CA_FCHSALIDA, $this->ca_fchsalida);
		if ($this->isColumnModified(RepStatusPeer::CA_FCHLLEGADA)) $criteria->add(RepStatusPeer::CA_FCHLLEGADA, $this->ca_fchllegada);
		if ($this->isColumnModified(RepStatusPeer::CA_FCHCONTINUACION)) $criteria->add(RepStatusPeer::CA_FCHCONTINUACION, $this->ca_fchcontinuacion);
		if ($this->isColumnModified(RepStatusPeer::CA_PIEZAS)) $criteria->add(RepStatusPeer::CA_PIEZAS, $this->ca_piezas);
		if ($this->isColumnModified(RepStatusPeer::CA_PESO)) $criteria->add(RepStatusPeer::CA_PESO, $this->ca_peso);
		if ($this->isColumnModified(RepStatusPeer::CA_VOLUMEN)) $criteria->add(RepStatusPeer::CA_VOLUMEN, $this->ca_volumen);
		if ($this->isColumnModified(RepStatusPeer::CA_DOCTRANSPORTE)) $criteria->add(RepStatusPeer::CA_DOCTRANSPORTE, $this->ca_doctransporte);
		if ($this->isColumnModified(RepStatusPeer::CA_IDNAVE)) $criteria->add(RepStatusPeer::CA_IDNAVE, $this->ca_idnave);
		if ($this->isColumnModified(RepStatusPeer::CA_DOCMASTER)) $criteria->add(RepStatusPeer::CA_DOCMASTER, $this->ca_docmaster);
		if ($this->isColumnModified(RepStatusPeer::CA_EQUIPOS)) $criteria->add(RepStatusPeer::CA_EQUIPOS, $this->ca_equipos);
		if ($this->isColumnModified(RepStatusPeer::CA_HORASALIDA)) $criteria->add(RepStatusPeer::CA_HORASALIDA, $this->ca_horasalida);
		if ($this->isColumnModified(RepStatusPeer::CA_HORALLEGADA)) $criteria->add(RepStatusPeer::CA_HORALLEGADA, $this->ca_horallegada);
		if ($this->isColumnModified(RepStatusPeer::CA_IDETAPA)) $criteria->add(RepStatusPeer::CA_IDETAPA, $this->ca_idetapa);
		if ($this->isColumnModified(RepStatusPeer::CA_PROPIEDADES)) $criteria->add(RepStatusPeer::CA_PROPIEDADES, $this->ca_propiedades);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RepStatusPeer::DATABASE_NAME);

		$criteria->add(RepStatusPeer::CA_IDSTATUS, $this->ca_idstatus);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdstatus();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdstatus($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdreporte($this->ca_idreporte);

		$copyObj->setCaIdemail($this->ca_idemail);

		$copyObj->setCaFchstatus($this->ca_fchstatus);

		$copyObj->setCaStatus($this->ca_status);

		$copyObj->setCaComentarios($this->ca_comentarios);

		$copyObj->setCaFchrecibo($this->ca_fchrecibo);

		$copyObj->setCaFchenvio($this->ca_fchenvio);

		$copyObj->setCaUsuenvio($this->ca_usuenvio);

		$copyObj->setCaEtapa($this->ca_etapa);

		$copyObj->setCaIntroduccion($this->ca_introduccion);

		$copyObj->setCaFchsalida($this->ca_fchsalida);

		$copyObj->setCaFchllegada($this->ca_fchllegada);

		$copyObj->setCaFchcontinuacion($this->ca_fchcontinuacion);

		$copyObj->setCaPiezas($this->ca_piezas);

		$copyObj->setCaPeso($this->ca_peso);

		$copyObj->setCaVolumen($this->ca_volumen);

		$copyObj->setCaDoctransporte($this->ca_doctransporte);

		$copyObj->setCaIdnave($this->ca_idnave);

		$copyObj->setCaDocmaster($this->ca_docmaster);

		$copyObj->setCaEquipos($this->ca_equipos);

		$copyObj->setCaHorasalida($this->ca_horasalida);

		$copyObj->setCaHorallegada($this->ca_horallegada);

		$copyObj->setCaIdetapa($this->ca_idetapa);

		$copyObj->setCaPropiedades($this->ca_propiedades);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getRepStatusRespuestas() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addRepStatusRespuesta($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCaIdstatus(NULL); 
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
			self::$peer = new RepStatusPeer();
		}
		return self::$peer;
	}

	
	public function setReporte(Reporte $v = null)
	{
		if ($v === null) {
			$this->setCaIdreporte(NULL);
		} else {
			$this->setCaIdreporte($v->getCaIdreporte());
		}

		$this->aReporte = $v;

						if ($v !== null) {
			$v->addRepStatus($this);
		}

		return $this;
	}


	
	public function getReporte(PropelPDO $con = null)
	{
		if ($this->aReporte === null && ($this->ca_idreporte !== null)) {
			$c = new Criteria(ReportePeer::DATABASE_NAME);
			$c->add(ReportePeer::CA_IDREPORTE, $this->ca_idreporte);
			$this->aReporte = ReportePeer::doSelectOne($c, $con);
			
		}
		return $this->aReporte;
	}

	
	public function setEmail(Email $v = null)
	{
		if ($v === null) {
			$this->setCaIdemail(NULL);
		} else {
			$this->setCaIdemail($v->getCaIdemail());
		}

		$this->aEmail = $v;

						if ($v !== null) {
			$v->addRepStatus($this);
		}

		return $this;
	}


	
	public function getEmail(PropelPDO $con = null)
	{
		if ($this->aEmail === null && ($this->ca_idemail !== null)) {
			$c = new Criteria(EmailPeer::DATABASE_NAME);
			$c->add(EmailPeer::CA_IDEMAIL, $this->ca_idemail);
			$this->aEmail = EmailPeer::doSelectOne($c, $con);
			
		}
		return $this->aEmail;
	}

	
	public function setTrackingEtapa(TrackingEtapa $v = null)
	{
		if ($v === null) {
			$this->setCaIdetapa(NULL);
		} else {
			$this->setCaIdetapa($v->getCaIdetapa());
		}

		$this->aTrackingEtapa = $v;

						if ($v !== null) {
			$v->addRepStatus($this);
		}

		return $this;
	}


	
	public function getTrackingEtapa(PropelPDO $con = null)
	{
		if ($this->aTrackingEtapa === null && (($this->ca_idetapa !== "" && $this->ca_idetapa !== null))) {
			$c = new Criteria(TrackingEtapaPeer::DATABASE_NAME);
			$c->add(TrackingEtapaPeer::CA_IDETAPA, $this->ca_idetapa);
			$this->aTrackingEtapa = TrackingEtapaPeer::doSelectOne($c, $con);
			
		}
		return $this->aTrackingEtapa;
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
			$criteria = new Criteria(RepStatusPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepStatusRespuestas === null) {
			if ($this->isNew()) {
			   $this->collRepStatusRespuestas = array();
			} else {

				$criteria->add(RepStatusRespuestaPeer::CA_IDSTATUS, $this->ca_idstatus);

				RepStatusRespuestaPeer::addSelectColumns($criteria);
				$this->collRepStatusRespuestas = RepStatusRespuestaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepStatusRespuestaPeer::CA_IDSTATUS, $this->ca_idstatus);

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
			$criteria = new Criteria(RepStatusPeer::DATABASE_NAME);
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

				$criteria->add(RepStatusRespuestaPeer::CA_IDSTATUS, $this->ca_idstatus);

				$count = RepStatusRespuestaPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepStatusRespuestaPeer::CA_IDSTATUS, $this->ca_idstatus);

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
			$l->setRepStatus($this);
		}
	}


	
	public function getRepStatusRespuestasJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(RepStatusPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepStatusRespuestas === null) {
			if ($this->isNew()) {
				$this->collRepStatusRespuestas = array();
			} else {

				$criteria->add(RepStatusRespuestaPeer::CA_IDSTATUS, $this->ca_idstatus);

				$this->collRepStatusRespuestas = RepStatusRespuestaPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(RepStatusRespuestaPeer::CA_IDSTATUS, $this->ca_idstatus);

			if (!isset($this->lastRepStatusRespuestaCriteria) || !$this->lastRepStatusRespuestaCriteria->equals($criteria)) {
				$this->collRepStatusRespuestas = RepStatusRespuestaPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepStatusRespuestaCriteria = $criteria;

		return $this->collRepStatusRespuestas;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collRepStatusRespuestas) {
				foreach ((array) $this->collRepStatusRespuestas as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collRepStatusRespuestas = null;
			$this->aReporte = null;
			$this->aEmail = null;
			$this->aTrackingEtapa = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseRepStatus:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseRepStatus::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 