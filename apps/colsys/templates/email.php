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

            div.bigbutton {                
                padding: 8px 14px 10px; /*apply some padding inside the button*/
                border:2px solid #157FCC; /*required or the default border for the browser will appear*/
                cursor:pointer; /*forces the cursor to change to a hand when the button is hovered*/

                font-weight:  bold;
                /*use box-shadow to give the button some depth - see cssdemos.tupence.co.uk/box-shadow.htm#demo7 for more info on this technique*/
                -webkit-box-shadow: inset 0px 1px 0px #638CC2, 0px 5px 0px 0px #454C76, 0px 10px 5px #999;
                -moz-box-shadow: inset 0px 1px 0px #638CC2, 0px 5px 0px 0px #454C76, 0px 10px 5px #999;
                box-shadow: inset 0px 1px 0px #638CC2, 0px 5px 0px 0px #454C76, 0px 10px 5px #999;
                /*give the corners a small curve*/
                -moz-border-radius: 10px;
                -webkit-border-radius: 10px;
                border-radius: 10px;
            }        
        </style>
    </head>
    <body>
    
        <!-- GREY BORDER -->
        <table width="100%" border="0" cellspacing="15" cellpadding="0" bgcolor="#E1E1E1" style="border-radius: 10px;"><tr><td>
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

