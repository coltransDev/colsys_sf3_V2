<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Intranet</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <link href="style.css" rel="stylesheet" type="text/css" media="screen" />
    </head>
    <body>

        <div id="wrapper">

            <div id="header">
                <div id="menu">
                    <ul>
                        <li class="current_page_item"><a href="#">Inicio</a></li>
                        <li><a href="#">Novedades</a></li>
                        <li><a href="#">Noticias</a></li>
                        <li><a href="#">Exprésate</a></li>
                    </ul>
                </div>
                <!-- end #menu -->
                <div id="search">
                    <form method="get" action="">
                        <fieldset>
                            <input type="text" name="s" id="search-text" size="15" />
                            <input type="submit" id="search-submit" value="Buscar" />
                        </fieldset>
                    </form>
                </div>
                <!-- end #search -->
            </div>
            <!-- end #header -->
            <!--
            <div id="logo">
                <h1><a href="#">Un Espacio </a></h1>
                <p><em> Para Tu Servicio</em></p>
            </div>
            -->
            <hr />
            <!-- end #logo -->
            <!-- end #header-wrapper -->

            <div id="page">
                <div id="content">
                    <?php echo $sf_content ?>
                    <!--
                    <div class="post">
                        <h2 class="title">Lectura del dia</h2>
                        <p class="date">25.03.2010</p>
                        <div class="entry">
                            <p><strong>LA RANITA SORDA</strong><br />
                                <p>Un grupo de ranas viajaba por el bosque, cuando de repente dos de ellas cayeron en un pozo profundo. Las dem&aacute;s se reunieron alrededor del agujero y, cuando vieron lo hondo que era, le dijeron a las ca&iacute;das que, para efectos pr&aacute;cticos deb&iacute;an darse por muertas. Sin embargo, ellas segu&iacute;an tratando de salir del hoyo con todas sus fuerzas. Las otras les dec&iacute;an que esos esfuerzos ser&iacute;an in&uacute;tiles.Finalmente, una de las ranas atendi&oacute; a lo que las dem&aacute;s dec&iacute;an, se dio vencida y muri&oacute;. La otra continu&oacute; saltando con tanto esfuerzo como le era posible. La multitud le gritaba que era in&uacute;til pero la rana segu&iacute;a saltando, cada vez con m&aacute;s fuerza, hasta que finalmente sali&oacute; del hoyo. Las otras le preguntaron: &iquest;No escuchabas lo que te dec&iacute;amos? La ranita les explic&oacute; que era sorda, y cre&iacute;a que las dem&aacute;s la estaban animando desde el borde a esforzarse m&aacute;s y m&aacute;s para salir del hueco.</p>
                                <p class="links"><a href="#" class="comments">Comentarios</a> &nbsp;&nbsp;&nbsp; <a href="#" class="permalink">Lecci&oacute;n</a></p>
                        </div>
                    </div>
                    -->
                </div>
                <!-- end #content -->
                <div id="sidebar">
                    <ul>
                        <li>
                            <?
                                include_component('homepage','birthday');
                            ?>

                        </li>
                        <li id="calendar">
                            <h2>Calendario</h2>
                            <div id="calendar_wrap">
                                <table summary="Calendar">
                                    <caption>
						Marzo 2010
                                    </caption>
                                    <thead>
                                        <tr>
                                            <th abbr="Monday" scope="col" title="Monday">L</th>
                                            <th abbr="Tuesday" scope="col" title="Tuesday">M</th>
                                            <th abbr="Wednesday" scope="col" title="Wednesday">M</th>
                                            <th abbr="Thursday" scope="col" title="Thursday">J</th>
                                            <th abbr="Friday" scope="col" title="Friday">V</th>
                                            <th abbr="Saturday" scope="col" title="Saturday">S</th>
                                            <th abbr="Sunday" scope="col" title="Sunday">D</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <td abbr="February" colspan="3" id="prev"><a href="#" title="">&laquo; Feb</a></td>
                                            <td class="pad">&nbsp;</td>
                                            <td abbr="April" colspan="3" id="next"><a href="#" title="">Abr &raquo;</a></td>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td colspan="5" class="pad">&nbsp;</td>
                                            <td>1</td>
                                            <td>2</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>4</td>
                                            <td>5</td>
                                            <td>6</td>
                                            <td>7</td>
                                            <td>8</td>
                                            <td>9</td>
                                        </tr>
                                        <tr>
                                            <td>10</td>
                                            <td id="today">11</td>
                                            <td>12</td>
                                            <td>13</td>
                                            <td>14</td>
                                            <td>15</td>
                                            <td>16</td>
                                        </tr>
                                        <tr>
                                            <td>17</td>
                                            <td>18</td>
                                            <td>19</td>
                                            <td>20</td>
                                            <td>21</td>
                                            <td>22</td>
                                            <td>23</td>
                                        </tr>
                                        <tr>
                                            <td>24</td>
                                            <td>25</td>
                                            <td>26</td>
                                            <td>27</td>
                                            <td>28</td>
                                            <td>29</td>
                                            <td>30</td>
                                        </tr>
                                        <tr>
                                            <td>31</td>
                                            <td class="pad" colspan="6">&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </li>
                        <li>
                            <h2>Noticias</h2>
                            <ul>
                                <li><a href="#"></a><a href="#">Bogot&aacute;. Visita Asesora Compensar</a></li>
                                <li><a href="#">Medell&iacute;n: Pr&oacute;ximo viernes corte de Luz</a></li>
                                <li><a href="#">Cal&iacute;: Por Feria, jueves trabajeremos medio d&iacute;a</a></li>
                                <li><a href="#">Miami: Por temporada invernal cierre de oficinas</a></li>
                                <li><a href="#">Consolcargo: Fiesta para los ni&ntilde;os en la Calera</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- end #sidebar -->
                <div style="clear: both;">&nbsp;</div>
            </div>
            <!-- end #page -->

            <div id="footer">
                <p>Copyright (c) 2010. Todos los derechos reservados. Diseñado por <a href="http://www.freecsstemplates.org/">Andrea Ramírez</a>.</p>
            </div>
            <!-- end #footer -->
        </div>
    </body>
</html>
