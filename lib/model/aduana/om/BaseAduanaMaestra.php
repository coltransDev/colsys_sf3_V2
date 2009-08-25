<?php


abstract class BaseAduanaMaestra extends BaseObject  implements Persistent {


  const PEER = 'AduanaMaestraPeer';

	
	protected static $peer;

	
	protected $ca_fchreferencia;

	
	protected $ca_referencia;

	
	protected $ca_origen;

	
	protected $ca_destino;

	
	protected $ca_idcliente;

	
	protected $ca_vendedor;

	
	protected $ca_coordinador;

	
	protected $ca_proveedor;

	
	protected $ca_pedido;

	
	protected $ca_piezas;

	
	protected $ca_peso;

	
	protected $ca_mercancia;

	
	protected $ca_deposito;

	
	protected $ca_fcharribo;

	
	protected $ca_modalidad;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_fchactualizado;

	
	protected $ca_usuactualizado;

	
	protected $ca_fchliquidado;

	
	protected $ca_usuliquidado;

	
	protected $ca_fchcerrado;

	
	protected $ca_usucerrado;

	
	protected $ca_nombrecontacto;

	
	protected $ca_email;

	
	protected $ca_analista;

	
	protected $ca_trackingcode;

	
	protected $aCliente;

	
	protected $collAduanaEventos;

	
	private $lastAduanaEventoCriteria = null;

	
	protected $collAduanaEventoExtras;

	
	private $lastAduanaEventoExtraCriteria = null;

	
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

	
	public function getCaFchreferencia($format = 'Y-m-d')
	{
		if ($this->ca_fchreferencia === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchreferencia);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchreferencia, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaReferencia()
	{
		return $this->ca_referencia;
	}

	
	public function getCaOrigen()
	{
		return $this->ca_origen;
	}

	
	public function getCaDestino()
	{
		return $this->ca_destino;
	}

	
	public function getCaIdcliente()
	{
		return $this->ca_idcliente;
	}

	
	public function getCaVendedor()
	{
		return $this->ca_vendedor;
	}

	
	public function getCaCoordinador()
	{
		return $this->ca_coordinador;
	}

	
	public function getCaProveedor()
	{
		return $this->ca_proveedor;
	}

	
	public function getCaPedido()
	{
		return $this->ca_pedido;
	}

	
	public function getCaPiezas()
	{
		return $this->ca_piezas;
	}

	
	public function getCaPeso()
	{
		return $this->ca_peso;
	}

	
	public function getCaMercancia()
	{
		return $this->ca_mercancia;
	}

	
	public function getCaDeposito()
	{
		return $this->ca_deposito;
	}

	
	public function getCaFcharribo($format = 'Y-m-d')
	{
		if ($this->ca_fcharribo === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fcharribo);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fcharribo, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaModalidad()
	{
		return $this->ca_modalidad;
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

	
	public function getCaUsucreado()
	{
		return $this->ca_usucreado;
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

	
	public function getCaUsuactualizado()
	{
		return $this->ca_usuactualizado;
	}

	
	public function getCaFchliquidado($format = 'Y-m-d')
	{
		if ($this->ca_fchliquidado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchliquidado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchliquidado, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaUsuliquidado()
	{
		return $this->ca_usuliquidado;
	}

	
	public function getCaFchcerrado($format = 'Y-m-d')
	{
		if ($this->ca_fchcerrado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchcerrado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchcerrado, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaUsucerrado()
	{
		return $this->ca_usucerrado;
	}

	
	public function getCaNombrecontacto()
	{
		return $this->ca_nombrecontacto;
	}

	
	public function getCaEmail()
	{
		return $this->ca_email;
	}

	
	public function getCaAnalista()
	{
		return $this->ca_analista;
	}

	
	public function getCaTrackingcode()
	{
		return $this->ca_trackingcode;
	}

	
	public function setCaFchreferencia($v)
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

		if ( $this->ca_fchreferencia !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchreferencia !== null && $tmpDt = new DateTime($this->ca_fchreferencia)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchreferencia = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = AduanaMaestraPeer::CA_FCHREFERENCIA;
			}
		} 
		return $this;
	} 
	
	public function setCaReferencia($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_referencia !== $v) {
			$this->ca_referencia = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_REFERENCIA;
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
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_ORIGEN;
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
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_DESTINO;
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
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_IDCLIENTE;
		}

		if ($this->aCliente !== null && $this->aCliente->getCaIdcliente() !== $v) {
			$this->aCliente = null;
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
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_VENDEDOR;
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
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_COORDINADOR;
		}

		return $this;
	} 
	
	public function setCaProveedor($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_proveedor !== $v) {
			$this->ca_proveedor = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_PROVEEDOR;
		}

		return $this;
	} 
	
	public function setCaPedido($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_pedido !== $v) {
			$this->ca_pedido = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_PEDIDO;
		}

		return $this;
	} 
	
	public function setCaPiezas($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_piezas !== $v) {
			$this->ca_piezas = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_PIEZAS;
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
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_PESO;
		}

		return $this;
	} 
	
	public function setCaMercancia($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_mercancia !== $v) {
			$this->ca_mercancia = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_MERCANCIA;
		}

		return $this;
	} 
	
	public function setCaDeposito($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_deposito !== $v) {
			$this->ca_deposito = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_DEPOSITO;
		}

		return $this;
	} 
	
	public function setCaFcharribo($v)
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

		if ( $this->ca_fcharribo !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fcharribo !== null && $tmpDt = new DateTime($this->ca_fcharribo)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fcharribo = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = AduanaMaestraPeer::CA_FCHARRIBO;
			}
		} 
		return $this;
	} 
	
	public function setCaModalidad($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_modalidad !== $v) {
			$this->ca_modalidad = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_MODALIDAD;
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
				$this->modifiedColumns[] = AduanaMaestraPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_USUCREADO;
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
				$this->modifiedColumns[] = AduanaMaestraPeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_USUACTUALIZADO;
		}

		return $this;
	} 
	
	public function setCaFchliquidado($v)
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

		if ( $this->ca_fchliquidado !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchliquidado !== null && $tmpDt = new DateTime($this->ca_fchliquidado)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchliquidado = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = AduanaMaestraPeer::CA_FCHLIQUIDADO;
			}
		} 
		return $this;
	} 
	
	public function setCaUsuliquidado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuliquidado !== $v) {
			$this->ca_usuliquidado = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_USULIQUIDADO;
		}

		return $this;
	} 
	
	public function setCaFchcerrado($v)
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

		if ( $this->ca_fchcerrado !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchcerrado !== null && $tmpDt = new DateTime($this->ca_fchcerrado)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchcerrado = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = AduanaMaestraPeer::CA_FCHCERRADO;
			}
		} 
		return $this;
	} 
	
	public function setCaUsucerrado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usucerrado !== $v) {
			$this->ca_usucerrado = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_USUCERRADO;
		}

		return $this;
	} 
	
	public function setCaNombrecontacto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_nombrecontacto !== $v) {
			$this->ca_nombrecontacto = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_NOMBRECONTACTO;
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
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_EMAIL;
		}

		return $this;
	} 
	
	public function setCaAnalista($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_analista !== $v) {
			$this->ca_analista = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_ANALISTA;
		}

		return $this;
	} 
	
	public function setCaTrackingcode($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_trackingcode !== $v) {
			$this->ca_trackingcode = $v;
			$this->modifiedColumns[] = AduanaMaestraPeer::CA_TRACKINGCODE;
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

			$this->ca_fchreferencia = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_referencia = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_origen = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_destino = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_idcliente = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->ca_vendedor = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_coordinador = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_proveedor = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_pedido = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_piezas = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->ca_peso = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_mercancia = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_deposito = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_fcharribo = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_modalidad = ($row[$startcol + 14] !== null) ? (int) $row[$startcol + 14] : null;
			$this->ca_fchcreado = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_usucreado = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->ca_fchactualizado = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
			$this->ca_usuactualizado = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
			$this->ca_fchliquidado = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
			$this->ca_usuliquidado = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
			$this->ca_fchcerrado = ($row[$startcol + 21] !== null) ? (string) $row[$startcol + 21] : null;
			$this->ca_usucerrado = ($row[$startcol + 22] !== null) ? (string) $row[$startcol + 22] : null;
			$this->ca_nombrecontacto = ($row[$startcol + 23] !== null) ? (string) $row[$startcol + 23] : null;
			$this->ca_email = ($row[$startcol + 24] !== null) ? (string) $row[$startcol + 24] : null;
			$this->ca_analista = ($row[$startcol + 25] !== null) ? (string) $row[$startcol + 25] : null;
			$this->ca_trackingcode = ($row[$startcol + 26] !== null) ? (string) $row[$startcol + 26] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 27; 
		} catch (Exception $e) {
			throw new PropelException("Error populating AduanaMaestra object", $e);
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
			$con = Propel::getConnection(AduanaMaestraPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = AduanaMaestraPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aCliente = null;
			$this->collAduanaEventos = null;
			$this->lastAduanaEventoCriteria = null;

			$this->collAduanaEventoExtras = null;
			$this->lastAduanaEventoExtraCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAduanaMaestra:delete:pre') as $callable)
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
			$con = Propel::getConnection(AduanaMaestraPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			AduanaMaestraPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseAduanaMaestra:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAduanaMaestra:save:pre') as $callable)
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
			$con = Propel::getConnection(AduanaMaestraPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseAduanaMaestra:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			AduanaMaestraPeer::addInstanceToPool($this);
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
					$pk = AduanaMaestraPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += AduanaMaestraPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collAduanaEventos !== null) {
				foreach ($this->collAduanaEventos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collAduanaEventoExtras !== null) {
				foreach ($this->collAduanaEventoExtras as $referrerFK) {
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


			if (($retval = AduanaMaestraPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collAduanaEventos !== null) {
					foreach ($this->collAduanaEventos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collAduanaEventoExtras !== null) {
					foreach ($this->collAduanaEventoExtras as $referrerFK) {
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
		$pos = AduanaMaestraPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaFchreferencia();
				break;
			case 1:
				return $this->getCaReferencia();
				break;
			case 2:
				return $this->getCaOrigen();
				break;
			case 3:
				return $this->getCaDestino();
				break;
			case 4:
				return $this->getCaIdcliente();
				break;
			case 5:
				return $this->getCaVendedor();
				break;
			case 6:
				return $this->getCaCoordinador();
				break;
			case 7:
				return $this->getCaProveedor();
				break;
			case 8:
				return $this->getCaPedido();
				break;
			case 9:
				return $this->getCaPiezas();
				break;
			case 10:
				return $this->getCaPeso();
				break;
			case 11:
				return $this->getCaMercancia();
				break;
			case 12:
				return $this->getCaDeposito();
				break;
			case 13:
				return $this->getCaFcharribo();
				break;
			case 14:
				return $this->getCaModalidad();
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
				return $this->getCaFchliquidado();
				break;
			case 20:
				return $this->getCaUsuliquidado();
				break;
			case 21:
				return $this->getCaFchcerrado();
				break;
			case 22:
				return $this->getCaUsucerrado();
				break;
			case 23:
				return $this->getCaNombrecontacto();
				break;
			case 24:
				return $this->getCaEmail();
				break;
			case 25:
				return $this->getCaAnalista();
				break;
			case 26:
				return $this->getCaTrackingcode();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = AduanaMaestraPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaFchreferencia(),
			$keys[1] => $this->getCaReferencia(),
			$keys[2] => $this->getCaOrigen(),
			$keys[3] => $this->getCaDestino(),
			$keys[4] => $this->getCaIdcliente(),
			$keys[5] => $this->getCaVendedor(),
			$keys[6] => $this->getCaCoordinador(),
			$keys[7] => $this->getCaProveedor(),
			$keys[8] => $this->getCaPedido(),
			$keys[9] => $this->getCaPiezas(),
			$keys[10] => $this->getCaPeso(),
			$keys[11] => $this->getCaMercancia(),
			$keys[12] => $this->getCaDeposito(),
			$keys[13] => $this->getCaFcharribo(),
			$keys[14] => $this->getCaModalidad(),
			$keys[15] => $this->getCaFchcreado(),
			$keys[16] => $this->getCaUsucreado(),
			$keys[17] => $this->getCaFchactualizado(),
			$keys[18] => $this->getCaUsuactualizado(),
			$keys[19] => $this->getCaFchliquidado(),
			$keys[20] => $this->getCaUsuliquidado(),
			$keys[21] => $this->getCaFchcerrado(),
			$keys[22] => $this->getCaUsucerrado(),
			$keys[23] => $this->getCaNombrecontacto(),
			$keys[24] => $this->getCaEmail(),
			$keys[25] => $this->getCaAnalista(),
			$keys[26] => $this->getCaTrackingcode(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AduanaMaestraPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaFchreferencia($value);
				break;
			case 1:
				$this->setCaReferencia($value);
				break;
			case 2:
				$this->setCaOrigen($value);
				break;
			case 3:
				$this->setCaDestino($value);
				break;
			case 4:
				$this->setCaIdcliente($value);
				break;
			case 5:
				$this->setCaVendedor($value);
				break;
			case 6:
				$this->setCaCoordinador($value);
				break;
			case 7:
				$this->setCaProveedor($value);
				break;
			case 8:
				$this->setCaPedido($value);
				break;
			case 9:
				$this->setCaPiezas($value);
				break;
			case 10:
				$this->setCaPeso($value);
				break;
			case 11:
				$this->setCaMercancia($value);
				break;
			case 12:
				$this->setCaDeposito($value);
				break;
			case 13:
				$this->setCaFcharribo($value);
				break;
			case 14:
				$this->setCaModalidad($value);
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
				$this->setCaFchliquidado($value);
				break;
			case 20:
				$this->setCaUsuliquidado($value);
				break;
			case 21:
				$this->setCaFchcerrado($value);
				break;
			case 22:
				$this->setCaUsucerrado($value);
				break;
			case 23:
				$this->setCaNombrecontacto($value);
				break;
			case 24:
				$this->setCaEmail($value);
				break;
			case 25:
				$this->setCaAnalista($value);
				break;
			case 26:
				$this->setCaTrackingcode($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AduanaMaestraPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaFchreferencia($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaReferencia($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaOrigen($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaDestino($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaIdcliente($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaVendedor($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaCoordinador($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaProveedor($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaPedido($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaPiezas($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaPeso($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaMercancia($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaDeposito($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaFcharribo($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaModalidad($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaFchcreado($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaUsucreado($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaFchactualizado($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCaUsuactualizado($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setCaFchliquidado($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCaUsuliquidado($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setCaFchcerrado($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setCaUsucerrado($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setCaNombrecontacto($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setCaEmail($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setCaAnalista($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setCaTrackingcode($arr[$keys[26]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(AduanaMaestraPeer::DATABASE_NAME);

		if ($this->isColumnModified(AduanaMaestraPeer::CA_FCHREFERENCIA)) $criteria->add(AduanaMaestraPeer::CA_FCHREFERENCIA, $this->ca_fchreferencia);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_REFERENCIA)) $criteria->add(AduanaMaestraPeer::CA_REFERENCIA, $this->ca_referencia);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_ORIGEN)) $criteria->add(AduanaMaestraPeer::CA_ORIGEN, $this->ca_origen);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_DESTINO)) $criteria->add(AduanaMaestraPeer::CA_DESTINO, $this->ca_destino);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_IDCLIENTE)) $criteria->add(AduanaMaestraPeer::CA_IDCLIENTE, $this->ca_idcliente);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_VENDEDOR)) $criteria->add(AduanaMaestraPeer::CA_VENDEDOR, $this->ca_vendedor);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_COORDINADOR)) $criteria->add(AduanaMaestraPeer::CA_COORDINADOR, $this->ca_coordinador);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_PROVEEDOR)) $criteria->add(AduanaMaestraPeer::CA_PROVEEDOR, $this->ca_proveedor);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_PEDIDO)) $criteria->add(AduanaMaestraPeer::CA_PEDIDO, $this->ca_pedido);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_PIEZAS)) $criteria->add(AduanaMaestraPeer::CA_PIEZAS, $this->ca_piezas);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_PESO)) $criteria->add(AduanaMaestraPeer::CA_PESO, $this->ca_peso);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_MERCANCIA)) $criteria->add(AduanaMaestraPeer::CA_MERCANCIA, $this->ca_mercancia);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_DEPOSITO)) $criteria->add(AduanaMaestraPeer::CA_DEPOSITO, $this->ca_deposito);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_FCHARRIBO)) $criteria->add(AduanaMaestraPeer::CA_FCHARRIBO, $this->ca_fcharribo);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_MODALIDAD)) $criteria->add(AduanaMaestraPeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_FCHCREADO)) $criteria->add(AduanaMaestraPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_USUCREADO)) $criteria->add(AduanaMaestraPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_FCHACTUALIZADO)) $criteria->add(AduanaMaestraPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_USUACTUALIZADO)) $criteria->add(AduanaMaestraPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_FCHLIQUIDADO)) $criteria->add(AduanaMaestraPeer::CA_FCHLIQUIDADO, $this->ca_fchliquidado);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_USULIQUIDADO)) $criteria->add(AduanaMaestraPeer::CA_USULIQUIDADO, $this->ca_usuliquidado);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_FCHCERRADO)) $criteria->add(AduanaMaestraPeer::CA_FCHCERRADO, $this->ca_fchcerrado);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_USUCERRADO)) $criteria->add(AduanaMaestraPeer::CA_USUCERRADO, $this->ca_usucerrado);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_NOMBRECONTACTO)) $criteria->add(AduanaMaestraPeer::CA_NOMBRECONTACTO, $this->ca_nombrecontacto);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_EMAIL)) $criteria->add(AduanaMaestraPeer::CA_EMAIL, $this->ca_email);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_ANALISTA)) $criteria->add(AduanaMaestraPeer::CA_ANALISTA, $this->ca_analista);
		if ($this->isColumnModified(AduanaMaestraPeer::CA_TRACKINGCODE)) $criteria->add(AduanaMaestraPeer::CA_TRACKINGCODE, $this->ca_trackingcode);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(AduanaMaestraPeer::DATABASE_NAME);

		$criteria->add(AduanaMaestraPeer::CA_REFERENCIA, $this->ca_referencia);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaReferencia();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaReferencia($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaFchreferencia($this->ca_fchreferencia);

		$copyObj->setCaReferencia($this->ca_referencia);

		$copyObj->setCaOrigen($this->ca_origen);

		$copyObj->setCaDestino($this->ca_destino);

		$copyObj->setCaIdcliente($this->ca_idcliente);

		$copyObj->setCaVendedor($this->ca_vendedor);

		$copyObj->setCaCoordinador($this->ca_coordinador);

		$copyObj->setCaProveedor($this->ca_proveedor);

		$copyObj->setCaPedido($this->ca_pedido);

		$copyObj->setCaPiezas($this->ca_piezas);

		$copyObj->setCaPeso($this->ca_peso);

		$copyObj->setCaMercancia($this->ca_mercancia);

		$copyObj->setCaDeposito($this->ca_deposito);

		$copyObj->setCaFcharribo($this->ca_fcharribo);

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);

		$copyObj->setCaFchliquidado($this->ca_fchliquidado);

		$copyObj->setCaUsuliquidado($this->ca_usuliquidado);

		$copyObj->setCaFchcerrado($this->ca_fchcerrado);

		$copyObj->setCaUsucerrado($this->ca_usucerrado);

		$copyObj->setCaNombrecontacto($this->ca_nombrecontacto);

		$copyObj->setCaEmail($this->ca_email);

		$copyObj->setCaAnalista($this->ca_analista);

		$copyObj->setCaTrackingcode($this->ca_trackingcode);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getAduanaEventos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addAduanaEvento($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getAduanaEventoExtras() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addAduanaEventoExtra($relObj->copy($deepCopy));
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
			self::$peer = new AduanaMaestraPeer();
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
			$v->addAduanaMaestra($this);
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

	
	public function clearAduanaEventos()
	{
		$this->collAduanaEventos = null; 	}

	
	public function initAduanaEventos()
	{
		$this->collAduanaEventos = array();
	}

	
	public function getAduanaEventos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AduanaMaestraPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAduanaEventos === null) {
			if ($this->isNew()) {
			   $this->collAduanaEventos = array();
			} else {

				$criteria->add(AduanaEventoPeer::CA_REFERENCIA, $this->ca_referencia);

				AduanaEventoPeer::addSelectColumns($criteria);
				$this->collAduanaEventos = AduanaEventoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AduanaEventoPeer::CA_REFERENCIA, $this->ca_referencia);

				AduanaEventoPeer::addSelectColumns($criteria);
				if (!isset($this->lastAduanaEventoCriteria) || !$this->lastAduanaEventoCriteria->equals($criteria)) {
					$this->collAduanaEventos = AduanaEventoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAduanaEventoCriteria = $criteria;
		return $this->collAduanaEventos;
	}

	
	public function countAduanaEventos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AduanaMaestraPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collAduanaEventos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(AduanaEventoPeer::CA_REFERENCIA, $this->ca_referencia);

				$count = AduanaEventoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AduanaEventoPeer::CA_REFERENCIA, $this->ca_referencia);

				if (!isset($this->lastAduanaEventoCriteria) || !$this->lastAduanaEventoCriteria->equals($criteria)) {
					$count = AduanaEventoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collAduanaEventos);
				}
			} else {
				$count = count($this->collAduanaEventos);
			}
		}
		return $count;
	}

	
	public function addAduanaEvento(AduanaEvento $l)
	{
		if ($this->collAduanaEventos === null) {
			$this->initAduanaEventos();
		}
		if (!in_array($l, $this->collAduanaEventos, true)) { 			array_push($this->collAduanaEventos, $l);
			$l->setAduanaMaestra($this);
		}
	}

	
	public function clearAduanaEventoExtras()
	{
		$this->collAduanaEventoExtras = null; 	}

	
	public function initAduanaEventoExtras()
	{
		$this->collAduanaEventoExtras = array();
	}

	
	public function getAduanaEventoExtras($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AduanaMaestraPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAduanaEventoExtras === null) {
			if ($this->isNew()) {
			   $this->collAduanaEventoExtras = array();
			} else {

				$criteria->add(AduanaEventoExtraPeer::CA_REFERENCIA, $this->ca_referencia);

				AduanaEventoExtraPeer::addSelectColumns($criteria);
				$this->collAduanaEventoExtras = AduanaEventoExtraPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AduanaEventoExtraPeer::CA_REFERENCIA, $this->ca_referencia);

				AduanaEventoExtraPeer::addSelectColumns($criteria);
				if (!isset($this->lastAduanaEventoExtraCriteria) || !$this->lastAduanaEventoExtraCriteria->equals($criteria)) {
					$this->collAduanaEventoExtras = AduanaEventoExtraPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAduanaEventoExtraCriteria = $criteria;
		return $this->collAduanaEventoExtras;
	}

	
	public function countAduanaEventoExtras(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AduanaMaestraPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collAduanaEventoExtras === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(AduanaEventoExtraPeer::CA_REFERENCIA, $this->ca_referencia);

				$count = AduanaEventoExtraPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AduanaEventoExtraPeer::CA_REFERENCIA, $this->ca_referencia);

				if (!isset($this->lastAduanaEventoExtraCriteria) || !$this->lastAduanaEventoExtraCriteria->equals($criteria)) {
					$count = AduanaEventoExtraPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collAduanaEventoExtras);
				}
			} else {
				$count = count($this->collAduanaEventoExtras);
			}
		}
		return $count;
	}

	
	public function addAduanaEventoExtra(AduanaEventoExtra $l)
	{
		if ($this->collAduanaEventoExtras === null) {
			$this->initAduanaEventoExtras();
		}
		if (!in_array($l, $this->collAduanaEventoExtras, true)) { 			array_push($this->collAduanaEventoExtras, $l);
			$l->setAduanaMaestra($this);
		}
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collAduanaEventos) {
				foreach ((array) $this->collAduanaEventos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collAduanaEventoExtras) {
				foreach ((array) $this->collAduanaEventoExtras as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collAduanaEventos = null;
		$this->collAduanaEventoExtras = null;
			$this->aCliente = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseAduanaMaestra:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseAduanaMaestra::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 