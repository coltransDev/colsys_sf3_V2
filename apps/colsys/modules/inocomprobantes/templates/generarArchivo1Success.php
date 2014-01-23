<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

header('Content-type: text/plain');

// It will be called downloaded.pdf
//header('Content-Disposition: attachment; filename="downloaded.pdf"');
header('Content-Disposition: attachment; filename="'.$filename.'"');

$file ="";

$lastComp = null;
foreach( $transacciones as $transaccion ){


    $comprobante = $transaccion->getInoComprobante();
    if( $lastComp!=$comprobante->getCaIdcomprobante() ){
        $i = 0;
        $lastComp=$comprobante->getCaIdcomprobante();
    }
    $tipo = $comprobante->getInoTipoComprobante();
    $ids = $comprobante->getIds();
    $cuenta = $transaccion->getInoCuenta();
    //001 ? 001 TIPO DE COMPROBANTE:  1 posici�n alfanum�rica
    $row=$tipo->getCaTipo();    
    //002 ? 004 C�DIGO COMPROBANTE:  3 posiciones num�ricas
    $row.=str_pad( $tipo->getCaComprobante(), 3, "0", STR_PAD_LEFT );    
    //005 ? 015 N�MERO DE DOCUMENTO:  11 posiciones num�ricas
    $row.=str_pad( $comprobante->getCaConsecutivo(), 11, "0", STR_PAD_LEFT );
    //016 ? 020 SECUENCIA:  5 posiciones num�ricas.  M�ximo hasta 250    
    $row.=str_pad( ++$i, 5, "0", STR_PAD_LEFT );
    //021 ? 033 NIT:  13 posiciones num�ricas
    $row.=str_pad( $ids->getCaIdalterno(), 13, "0", STR_PAD_LEFT );    
    //034 ? 036 SUCURSAL:  3 posiciones num�ricas
    //PENDIENTE
    $row.=str_pad( "", 3, "0", STR_PAD_LEFT );
    //037 ? 046 CUENTA CONTABLE:  10 posiciones num�ricas    
    $row.=str_pad( $cuenta->getCaCuenta(), 10, "0", STR_PAD_RIGHT );
    //047 ? 059 C�DIGO DE PRODUCTO:  13 posiciones num�ricas
    //PENDIENTE
    $row.=str_pad( "", 13, "0", STR_PAD_LEFT );    
    //060 ? 067 FECHA DEL DOCUMENTO:  8 posiciones num�ricas (AAAAMMDD)
    $row.=str_pad( Utils::parseDate( $comprobante->getCaFchcomprobante(), "Ymd"), 8, "0", STR_PAD_LEFT );

    $ccosto = $transaccion->getInoCentroCosto();
    //068 ? 071 CENTRO DE COSTO:  4 posiciones num�ricas    
    $row.=str_pad( $ccosto?$ccosto->getCaCentro():"", 4, "0", STR_PAD_LEFT );    
    //072 ? 074 SUBCENTRO DE COSTO:  3 posiciones num�ricas    
    $row.=str_pad( $ccosto?$ccosto->getCaSubcentro():"", 3, "0", STR_PAD_LEFT );
    //075 ? 124 DESCRIPCI�N DEL MOVIMIENTO:  50 posiciones alfanum�ricas, para comentario o detalle del movimiento
    //PENDIENTE EL VALOR ESCRITO POR EL USUARIO
    $row.=str_pad( $cuenta->getCaDescripcion(), 50, " ", STR_PAD_RIGHT );

    //125 ? 125 D�BITO O CR�DITO:  1 posici�n alfanum�rica.  Valor D � C    
    $row.=$transaccion->getCaDb()?"D":"C";
    //126 ? 140 VALOR DEL MOVIMIENTO:  15 posiciones num�ricas, 13 enteros, 2 decimales    
    $row.=str_pad(number_format($transaccion->getCaValor(), 2, "", ""), 15, "0", STR_PAD_LEFT );
    //141 ? 155 BASE DE RETENCI�N:  15 posiciones num�ricas, 13 enteros, 2 decimales
    //PENDIENTE
    $row.=str_pad(number_format(0, 2, "", ""), 15, "0", STR_PAD_LEFT );
    //156 ? 159 C�DIGO DEL VENDEDOR:  4 posiciones num�ricas
    //PENDIENTE    
    $row.=str_pad("", 4, "0", STR_PAD_LEFT );    
    //160 ? 163 C�DIGO DE LA CIUDAD:  4 posiciones num�ricas
    //PENDIENTE
    $row.=str_pad("", 4, "0", STR_PAD_LEFT );
    //164 ? 166 C�DIGO DE LA ZONA:  3 posiciones num�ricas
    //PENDIENTE POSIBLEMENTE NO SE UTILIZA
    $row.=str_pad("", 3, "0", STR_PAD_LEFT );
    //167 ? 170 C�DIGO DE LA BODEGA:  4 posiciones num�ricas
    //PENDIENTE POSIBLEMENTE NO SE UTILIZA
    $row.=str_pad("", 4, "0", STR_PAD_LEFT );
    //171 ? 173 C�DIGO DE LA UBICACI�N:  3 posiciones num�ricas
    //PENDIENTE POSIBLEMENTE NO SE UTILIZA
    $row.=str_pad("", 3, "0", STR_PAD_LEFT );    
    //174 ? 188 CANTIDAD:  15 posiciones num�ricas, 10 enteros, 5 decimales
    //PENDIENTE POSIBLEMENTE NO SE UTILIZA
    $row.=str_pad(number_format(0, 5, "", ""), 15, "0", STR_PAD_LEFT );
    //189 ? 189 TIPO DE DOCUMENTO CRUCE:  1 posici�n alfanum�rica
    //PENDIENTE
    $row.=" ";    
    //190 ? 192 C�DIGO COMPROBANTE CRUCE:  3 posiciones alfanum�ricas, diferentes a espacios
    //PENDIENTE
    //--$row.=str_pad("", 3, "0", STR_PAD_LEFT );
    $row.=str_pad( $tipo->getCaComprobante(), 3, "0", STR_PAD_LEFT );
    //193 ?  203 N�MERO DE DOCUMENTO CRUCE:  11 posiciones num�ricas
    //PENDIENTE
    //--$row.=str_pad("", 11, "0", STR_PAD_LEFT );
    $row.=str_pad( $comprobante->getCaConsecutivo(), 11, "0", STR_PAD_LEFT );
    //204 ? 206 SECUENCIA DEL DOCUMENTO CRUCE:  3 posiciones num�ricas.  Secuencia del documento cruce, m�ximo hasta 250
    //PENDIENTE
    $row.=str_pad("", 3, "0", STR_PAD_LEFT );    
    //207 ? 214 FECHA VENCIMIENTO DE DOCUMENTO CRUCE:  8 posiciones num�ricas (AAAAMMDD)
    //PENDIENTE
    //$row.=str_pad("", 8, "0", STR_PAD_LEFT );
    $row.=str_pad( Utils::parseDate( $comprobante->getCaFchcomprobante(), "Ymd"), 8, "0", STR_PAD_LEFT );
    //215 ? 218 C�DIGO FORMA DE PAGO:  4 posiciones num�ricas, solo se utilizan tres el primer digito debe ser cero.
    //PENDIENTE
    $row.=str_pad("", 4, "0", STR_PAD_LEFT );    
    //219 ? 220 C�DIGO DEL BANCO:  2 posiciones num�ricas
    //PENDIENTE
    $row.=str_pad("", 2, "0", STR_PAD_LEFT );
    //221 ? 221  TIPO DOCUMENTO DE PEDIDO:  1 posici�n alfanum�rica
    $row.=str_pad("", 1, " ", STR_PAD_RIGHT );
    //222 ? 224 C�DIGO COMPROBANTE DE PEDIDO:  3 posiciones num�ricas
    $row.=str_pad("", 3, "0", STR_PAD_LEFT );
    //225 ? 235 N�MERO DE COMPROBANTE PEDIDO:  11 posiciones num�ricas
    $row.=str_pad("", 11, "0", STR_PAD_LEFT );
    //236 ? 238 SECUENCIA DE PEDIDO:  3 posiciones num�ricas, m�ximo hasta 250
    $row.=str_pad("", 3, "0", STR_PAD_LEFT );
    //239 ? 240 C�DIGO DE LA MONEDA:  2 posiciones num�ricas (00 si es local)
    $row.=str_pad("", 2, "0", STR_PAD_LEFT );    
    //241 ? 255 TASA DE CAMBIO:  15 posiciones num�ricas, 8 enteros, 7 decimales
    $row.=str_pad(number_format(0, 7, "", ""), 15, "0", STR_PAD_LEFT );
    //256 ? 270 VALOR DEL MOVIMIENTO EN EXTRANJERA:  15 posiciones num�ricas, 13 enteros, 2 decimales
    //PENDIENTE REVISAR
    $row.=str_pad(number_format(0, 2, "", ""), 15, "0", STR_PAD_LEFT );

    //NOMINA
    //271 ? 273 CONCEPTO DE N�MINA:  3 posiciones num�ricas, m�ximo hasta 99
    $row.=str_pad("", 3, "0", STR_PAD_LEFT );    
    //274 ? 284 CANTIDAD DE PAGO:  11 posiciones num�ricas, 9 enteros, 2 decimales (cantidad de d�as, horas, etc.)
    $row.=str_pad(number_format(0, 2, "", ""), 11, "0", STR_PAD_LEFT );
    //285 ? 288 PORCENTAJE DE DESCUENTO DEL MOVIMIENTO:  4 posiciones num�ricas, 2 enteros, 2 decimales
    $row.=str_pad(number_format(0, 2, "", ""), 4, "0", STR_PAD_LEFT );
    //289 ? 301 VALOR DE DESCUENTO DEL MOVIMIENTO:  13 posiciones num�ricas, 11 enteros, 2 decimales
    $row.=str_pad(number_format(0, 2, "", ""), 13, "0", STR_PAD_LEFT );
    //302 ? 305 PORCENTAJE DE CARGO DEL MOVIMIENTO: 4 posiciones num�ricas, 2 enteros, 2 decimales
    $row.=str_pad(number_format(0, 2, "", ""), 4, "0", STR_PAD_LEFT );
    //306 ? 318 VALOR DE CARGO DEL MOVIMIENTO: 13 posiciones num�ricas, 11 enteros, 2 decimales
    $row.=str_pad(number_format(0, 2, "", ""), 13, "0", STR_PAD_LEFT );
    //319 ? 322 PORCENTAJE DEL IVA DEL MOVIMIENTO: 4 posiciones num�ricas, 2 enteros, 2 decimales
    $row.=str_pad(number_format(0, 2, "", ""), 4, "0", STR_PAD_LEFT );
    //323 ? 335 VALOR DE IVA DEL MOVIMIENTO: 13 posiciones num�ricas, 11 enteros, 2 decimales
    $row.=str_pad(number_format(0, 2, "", ""), 13, "0", STR_PAD_LEFT );
    //336 ? 336 INDICADOR DE N�MINA:  1 posici�n alfanum�rica. Valor S � N, si el movimiento afecta n�mina o no
    $row.=" ";    
    
    //337 ? 337  N�MERO DE PAGO:  1 posici�n num�rica.  Valor de 1 a 5, dependiendo el tipo de pago de n�mina, mensual, decanal, etc.
    $row.="0";
    //FIN NOMINA

    //338 ? 348  NUMERO DE CHEQUE : 11 posiciones num�ricas, solo se usa para egresos en los dem�s documentos debe ir en ceros.
    //PENDIENTE REVISAR
    $row.=str_pad(number_format(0, 2, "", ""), 11, "0", STR_PAD_LEFT );
    //349 ? 349  INDICADOR TIPO MOVIMIENTO: 1 posici�n alfab�tica que indica si el item es Gravado o Excento (Para Peru: Afecto o Inafecto).  Tiene unicamente dos posibles valores (S) o (N), esta variable afectara las correspondientes columnas en libros de ventas y compras.
    //PENDIENTE
    $row.=str_pad("", 1, " ", STR_PAD_RIGHT );
    //350 - 353 NOMBRE DEL COMPUTADOR: Nombre del computador donde se realiza la factura de venta.  4 posiciones alfanum�ricas.
    $row.=str_pad("", 4, " ", STR_PAD_RIGHT );
    //354-354 ESTADO DEL COMPROBANTE: Indica si el comprobante esta anulado, se coloca una ?A? en esta columna a cada uno de los items del comprobante de lo contrario se deja en espacio. 1 posici�n alfabetica.
    $row.=" ";

    //355-356 Para ECUADOR:  Con derecho a devoluci�n  S� o No (una posici�n con la letra ?S? o ?N? y otra posici�n con un espacio en blanco)
    //Otros Pa�ses: 2 posiciones en blanco
    $row.="  ";    

    //357-358 Para ECUADOR:  Cr�dito Tributario (2 posiciones num�ricas)
    //Otros Pa�ses: 2 ceros (00)
    $row.="00";

    //359-362  Para PERU:  NUMERO DE COMPROBANTE DEL PROVEEDOR.  Es el n�mero de comprobante que se digita en la factura de compra y que corresponde al documento origen dado por el proveedor.  4 posiciones alfab�ticas
    $row.=str_pad("", 4, "0", STR_PAD_LEFT );

    //363 - 373 NUMERO DEL DOCUMENTO DEL PROVEEDOR.  Es el n�mero del documento que se digita en la factura de compra y que corresponde al documento origen dado por el proveedor.  11 posiciones num�ricas
    //PENDIENTE REVISAR
    $row.=str_pad("", 11, "0", STR_PAD_LEFT );

    //374 - 383 Para Colombia:  PREFIJO DEL DOCUMENTO DEL PROVEEDOR.  Es el prefijo del documento que se digita en la factura de compra y que corresponde al documento origen dado por el proveedor.  10 posiciones alfab�ticas
    $row.=str_pad("", 10, " ", STR_PAD_RIGHT );
    //384 ? 391 FECHA DOCUMENTO DE PROVEEDOR.  Fecha del documento que se digita en la factura de compra y que corresponde al documento origen dado por el proveedor.  8 posiciones num�ricas
    $row.=str_pad("", 8, "0", STR_PAD_LEFT );
    //392 -  409   PRECIO UNITARIO EN MONEDA LOCAL:  18 posiciones num�ricas, 13 enteros, 5  Decimales
    $row.=str_pad(number_format(0, 5, "", ""), 18, "0", STR_PAD_LEFT );
    //410 - 427 PRECIO UNITARIO EN EXTRANJERA: 18 posiciones num�ricas, 13 enteros, 5 Decimales
    $row.=str_pad(number_format(0, 5, "", ""), 18, "0", STR_PAD_LEFT );
    //428 ? 428INDICAR TIPO DE MOVIMIENTO:  1 posici�n alfanum�rica y puede tener los valores ?A? o espacios. Este campo aplica �nicamente para cuentas marcadas como Activo Fijo (A) y si el registro corresponde a  una mejora o adici�n debe digitarse en este campo la letra ?A? de lo contrario va en espacios.
    $row .=" ";
    
    // 429 ? 431 VECES A DEPRECIAR EL ACTIVO. Campo num�rico de 3 posiciones.   N�mero de veces en que se incrementa las veces a depreciar el Activo.  Aplica �nicamente para registros marcados como mejora o adici�n de lo contrario llenar en ceros.
    $row.=str_pad("", 3, "0", STR_PAD_LEFT );

    //432 ? 433 SECUENCIA DE TRANSACCION: Para Ecuador: 2 posiciones num�ricas. C�digo de secuencia de la transacci�n
    $row.=str_pad("", 2, "0", STR_PAD_LEFT );

    //434 ? 443 AUTORIZACION IMPRENTA: Para Ecuador:  10 posiciones num�ricas. C�digo de autorizaci�n de imprenta. Para Per�: Se indica la Fecha de detracci�n
    $row.=str_pad("", 10, "0", STR_PAD_LEFT );    
    //444 ? 444 SECUENCIA MARCADA COMO IVA PARA EL COA:  Solo para Ecuador. Una posici�n alfabetica. Valores S: Se cobro Iva o N: No cobro Iva o A: No aplica
    $row.="A";
    //445 ? 447 NUMERO DE CAJA: Para tesorero indica el numero de la caja asociada al comprobante. Num�rico de 3 posiciones    
    $row.=str_pad("", 3, "0", STR_PAD_LEFT );
    
    //448 ? 462 NUMERO DE PUNTOS OBTENIDOS: Para M�dulo de Promociones.  Esta conformado por 12 enteros, 2 decimales con signo
    //Debe ser 15 no 14 15
     $row.=str_pad(number_format(0, 2, "", ""), 15, "0", STR_PAD_LEFT );     
    //463 ? 477 CANTIDAD DOS: Para empresas que manejan cantidad dos. Esta conformado por 10 enteros, 5 decimales     
    $row.=str_pad(number_format(0, 5, "", ""), 15, "0", STR_PAD_LEFT );
    //478 ? 492 CANTIDAD ALTERNA DOS: Para empresas que manejan cantidad dos y este campo corresponde a la cantidad alterna. Esta conformado por 10 enteros, 5 decimales
    $row.=str_pad(number_format(0, 5, "", ""), 15, "0", STR_PAD_LEFT );    
    
    //493 ? 493 METODO DE DEPRECIACION: Indica el meto de depreciaci�n que se utilizo. Un campo alfab�tico. Valores L: l�nea recta, S: suma de d�gitos
    $row.=" ";
    //494 ? 511 CANTIDAD DE FACTOR DE CONVERSION:  Para productos que manejan factor de conversi�n, corresponde a la cantidad a convertir digitada. Esta conformado por 13 enteros y 5 decimales
    $row.=str_pad(number_format(0, 5, "", ""), 18, "0", STR_PAD_LEFT );
    //512 ? 512 OPERADOR DE FACTOR DE CONVERSION:  N�mero de operador de factor de conversi�n que se utilizo. Campo num�rico de 1 posici�n. Valores del 1 al 5
    $row.="0";
    //513 ? 522 FACTOR DE CONVERSION: Valor del factor de conversi�n que se aplico al realizar la conversi�n. Campo num�rico de 5 enteros y 5 decimales
    $row.=str_pad(number_format(0, 5, "", ""), 10, "0", STR_PAD_LEFT );    
    //523 ? 530 FECHA DE CADUCIDAD: Solo para Ecuador. Para compras es un campo Num�rico de 8 (AAAAMMDD)
    $row.=str_pad("0", 8, "0", STR_PAD_LEFT );
    //531 ? 532 CODIGO ICE: Solo para Ecuador: Campo num�rico de dos d�gitos, se asocia a los productos marcados como ICE
    $row.=str_pad("0", 2, "0", STR_PAD_LEFT );
    //533 ? 537 CODIGO RETENCION: Solo para Ecuador: Campo alfanum�rico de 5 posiciones y corresponde al c�digo de retenci�n (Tabla 6 o 10)
    $row.=str_pad("0", 5, " ", STR_PAD_RIGHT );
    //538 ? 538 CLASE RETENCION: Solo para Ecuador. Indica si es una Retenci�n AIR o es un tipo de Retenci�n IVA
    $row.=" ";
    //echo "\n".strlen($row)."\n";
    $file.=$row."\n";
}
echo $file;
exit();
?>