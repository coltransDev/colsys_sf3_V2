<html>
    <style>
        .info-header {
            margin: 0 8px 8px 0;
            display: flex; position: relative;
            border-width: 0 !important;
            box-sizing: border-box;
            min-height: 53px;
            border-bottom-width: 0 !important;
            background-color: #f5f5f5;            
            text-align:center;
            justify-content: center;
            align-items: center;
        }

        .block-section {
            display: inline-block;
            vertical-align: top;
            line-height: 1.4;
        }

        .block-section .item {
            padding: 10px;
        }

        .block-section .item .label {
            color: #3487C3;
            font-size: 14px;
            text-transform: uppercase;
            font-family: "Open Sans", "Helvetica Neue", helvetica, arial, sans-serif
        }

        .block-section .item .value {
            font-weight: 500;
            font-size: 13px;
        }
    </style>

    <body>
        <div class="info-header">
            <div>
                <div class="block-section">
                    <div class="item">
                        <div class="label">REFERENCIA</div>
                        <div class="value"><b><?= $master->getCaReferencia() ?></b></div>
                    </div>
                    <div class="item">
                        <div class="label">MODALIDAD</div>
                        <div class="value"><?= $master->getCaModalidad() ?></div>
                    </div>
                </div>
                <div class="block-section">
                    <div class="item">
                        <div class="label">FCH. REGISTRO</div>
                        <div class="value"><?= $master->getCaFchreferencia() ?></div>
                    </div>  
                    <div class="item">
                        <div class="label">MBL'S</div>
                        <div class="value"><?= $master->getCaMaster() ?></div>
                    </div>       
                </div>
                <div class="block-section">
                    <div class="item">
                        <div class="label">TRA. ORIGEN</div>
                        <div class="value"><?= $master->getOrigen()->getTrafico()->getCaNombre() ?></div>
                    </div>                
                    <div class="item">
                        <div class="label">LINEA</div>
                        <div class="value"><?= $master->getIdsProveedor()->getIds()->getCaNombre() ?></div>
                    </div>
                </div>
                <div class="block-section">
                    <div class="item">
                        <div class="label">CIU. ORIGEN</div>
                        <div class="value"><?= $master->getOrigen()->getCaCiudad() ?></div>
                    </div> 
                    <div class="item">
                        <div class="label">MOTONAVE</div>
                        <div class="value"><?= $master->getCaMotonave() ?></div>
                    </div>
                </div>
                <div class="block-section">
                    <div class="item">
                        <div class="label">TRA. DESTINO</div>
                        <div class="value"><?= $master->getDestino()->getTrafico()->getCaNombre() ?></div>
                    </div> 
                    <div class="item">
                        <div class="label">FCH ESTIMADA EMBARQUE</div>
                        <div class="value"><?= $master->getCaFchsalida() ?></div>
                    </div>
                </div>
                <div class="block-section">
                    <div class="item">
                        <div class="label">CIU. DESTINO</div>
                        <div class="value"><?= $master->getDestino()->getCaCiudad() ?></div>
                    </div>
                    <div class="item">
                        <div class="label">FCH. ESTIMADA ARRIBO</div>
                        <div class="value"><?= $master->getCaFchllegada() ?></div>
                    </div>
                </div>
                <div class="block-section">
                    <div class="item">
                        <div class="label">OBSERVACIONES</div>
                        <div class="value"><?=$master->getCaObservaciones() ?></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>