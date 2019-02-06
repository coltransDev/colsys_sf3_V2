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
                        <div class="label">VENDEDOR</div>
                        <div class="value"><?=$house->getVendedor()?></div>
                    </div>
                    <div class="item">
                        <div class="label">HBL</div>
                        <div class="value"><b><?=$house->getCaDoctransporte()?></b></div>
                    </div>
                    
                </div>
                <div class="block-section">
                    <div class="item">
                        <div class="label">PIEZAS</div>
                        <div class="value"><?=$house->getCaNumpiezas()?></div>
                    </div>                
                    <div class="item">
                        <div class="label">ID PROVEEDOR</div>
                        <div class="value"><?=$house->getRepViProveedor()->getCaIdproveedor()?></div>
                    </div>
                    
                </div>
                <div class="block-section">
                    <div class="item">
                        <div class="label">PESO (Kg)</div>
                        <div class="value"><?=$house->getCaPeso()?></div>
                    </div> 
                    
                    <div class="item">
                        <div class="label">PROVEEDOR</div>
                        <div class="value"><?=$house->getRepViProveedor()->getProveedores()?></div>
                    </div>       
                    
                </div>
                <div class="block-section">
                    <div class="item">
                        <div class="label">VOLUMEN (CMB)</div>
                        <div class="value"><?=$house->getCaVolumen()?></div>
                    </div>
                    
                </div>                               
            </div>
        </div>
    </body>
</html>