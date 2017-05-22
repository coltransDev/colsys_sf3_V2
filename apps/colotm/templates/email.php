<html>
    <head>        
        <style type="text/css" >

            img.img{
                border: 0px;
            }



            a.link:link {
               text-decoration:none;
               color:#0000FF;
            }
            a.link:active {
               text-decoration:none;
               color:#0000FF;
            }
            a.link:visited {
               text-decoration: none;
               color: #062A7D;
            }

            .entry {
                border-bottom: 1px solid #DDDDDD;
                clear:both;
                padding: 0 0 10px;
            }


            .entry-even {
                background-color:#F6F6F6;
                border-color:#CCCCCC;
                border-style:dotted;
                border-width:1px ;
                margin:12px 0 0;
                padding:12px 12px 24px;
                font-size: 12px;
                font-family: arial, helvetica, sans-serif;

            }

            .entry-odd {
                background-color:#FFFFFF;
                border-color:#CCCCCC;
                border-style:dotted;
                border-width:1px ;
                margin:12px 0 0;
                padding:12px 12px 24px;
                font-size: 12px;
                font-family: arial, helvetica, sans-serif;

            }

            .entry-yellow {
                background-color:#FFFFCC;
                border-color:#CCCCCC;
                border-style:dotted;
                border-width:1px ;
                margin:12px 0 0;
                padding:12px 12px 24px;
                font-size: 12px;
                font-family: arial, helvetica, sans-serif;

            }
            .entry-date{
                float: right;
                color: #0464BB;
            }

            .vigencia{
            font-size:9px;
            font-family:Arial, Helvetica, sans-serif;
        }

        .htmlContent{
            font-size:12px;
            font-family:Arial, Helvetica, sans-serif;
        }

        table.tableList th{

            border:solid 0.5px #EBEBEB;
            padding:2px;
            font-size:11px;
            font-family:Arial, Helvetica, sans-serif;
            font-weight:bold;
            background-color:#F8F8F8;
        }

        table.tableList td{

            border:solid 1px #EBEBEB;
            padding:2px;
            font-size:11px;
            font-family:Arial, Helvetica, sans-serif;
            border-collapse:collapse;


        }
        </style>
    </head>
    <body>
    
        <!-- GREY BORDER -->
        <table width="100%" border="0" cellspacing="15" cellpadding="0" bgcolor="#E1E1E1"><tr><td>
                    <!-- WHITE BACKGROUND -->
                    <table width="100%" border="0" cellspacing="15" cellpadding="0" bgcolor="#FFFFFF"><tr><td>
                                <!-- MAIN CONTENT TABLE -->

                                <?php
                                echo $sf_content;
                                ?>
                            </td></tr>
                    </table>
                </td></tr>
            <!-- COPYRIGHT -->
            <tr><td><font size="1" face="arial, helvetica, sans-serif" color="#666666"><!--&copy; <? //=sfConfig::get('app_branding_name1');?>--> </font></td></tr>
        </table>

    </body>
</html>

