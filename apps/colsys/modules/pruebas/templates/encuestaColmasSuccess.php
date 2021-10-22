<?
sfContext::getInstance()->getResponse()->removeStylesheet("coltrans");
sfContext::getInstance()->getResponse()->removeStylesheet("jquery/jquery.tooltip.css");
sfContext::getInstance()->getResponse()->removeStylesheet("menu/menu");

sfContext::getInstance()->getResponse()->removeJavascript("ext4/ext-all.js");
sfContext::getInstance()->getResponse()->removeJavascript("ext4/ux/multiupload/swfobject.js");


//use_stylesheet('ext/css/ext-all.css');
//use_javascript('ext/adapter/ext/ext-base.js');
//use_javascript('ext/ext-all.js');
//use_javascript('ext/src/locale/ext-lang-es.js');

use_stylesheet('bootstrap/css/ligth-bootstrap/all.min.css');
use_javascript('ext/adapter/ext/ext-base.js');
use_javascript('ext/ext-all.js');
use_javascript('ext/src/locale/ext-lang-es.js');
?>


<!DOCTYPE html><html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?=$formulario->getCaTitulo()?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" crossorigin="anonymous">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" crossorigin="anonymous">
        </script><script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" crossorigin="anonymous">
        </script><script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" crossorigin="anonymous">            
        </script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head><body><br /><h4 class="text-sm-center"><?=$formulario->getCaTitulo()?></h4><br /><div class="container">
    <div class="col-md-2">        
    </div>
    <form>
        <p><label for="age">Your age:</label><input type="radio" id="age" title="We ask for your age only for statistical purposes."></p>
        <p>Hover the field to see the tooltip.</p>
    <div class="col-md-8">
        <div class="card ">
            <div class="card-header"><?=$formulario->getCaIntroduccion()?></div>
            <div class="card-header">1. El Servicio al cliente (Coordinador de la cuenta) durante el proceso de desaduanamiento fue:</div>
            <div class="card-block">
                <!--Gender:
                <br />
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-secondary">
                        <input type="radio" autocomplete="off" /> Male
                    </label>
                    <label class="btn btn-secondary">
                        <input type="radio" autocomplete="off" /> Female
                    </label>
                </div>
                <br />
                <br />

                Age Group:-->
                <br />
                <div class="form-group">
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-secondary">
                        <input type="radio" autocomplete="off" />Deficiente
                    </label>
                    <label class="btn btn-secondary">
                        <input type="radio" autocomplete="off" />Regular
                    </label>
                    <label class="btn btn-secondary">
                        <input type="radio" autocomplete="off" />Aceptable
                    </label>
                    <label class="btn btn-secondary">
                        <input type="radio" autocomplete="off" />Bueno
                    </label>
                    <label class="btn btn-secondary">
                        <input type="radio" autocomplete="off" />Excelente
                    </label>
                    
                    
                </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Observaciones</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    
                <br />
                <br />
            </div>
        </div>

        <div class="card ">
            <div class="card-header">1. El Servicio al cliente (Coordinador de la cuenta) durante el proceso de desaduanamiento fue:</div>
            <div class="card-block">
                <div class="row">                    
                    <div class="col-md-10 col-sm-10 col-xs-7">
                        <div id="rate1" style="margin-top:6px;"></div>
                    </div>
                </div>                
            </div>
        </div>
        <div class="card ">
            <div class="card-header">1. El Servicio al cliente (Coordinador de la cuenta) durante el proceso de desaduanamiento fue:</div>
            <div class="card-block">
                <div class="row">                    
                    <div class="col-md-12">
                        <div class="col-md-2">
                            <div class="radio">
                                <label style="font-size: 1.1em">
                                    <!--<input type="radio" name="B" value="" title="Deficiente"/>-->
                                    dasdfasd<input type="radio" id="age" title="We ask for your age only for statistical purposes.">
                                    <span class="cr"><i class="cr-icon fa fa-check-circle"></i></span>
                                    1
                                </label>
                            </div>
                        </div>  
                        <div class="col-md-2">
                            <div class="radio">
                                <label style="font-size: 1">
                                    <input type="radio" name="B" value=""/>
                                    <span class="cr"><i class="cr-icon fa fa-check-circle"></i></span>
                                    2
                                </label>
                            </div>
                        </div>  
                        <div class="col-md-2">
                            <div class="radio">
                                <label style="font-size: 1">
                                    <input type="radio" name="B" value=""/>
                                    <span class="cr"><i class="cr-icon fa fa-check-circle"></i></span>
                                    3
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="radio">
                                <label style="font-size: 1">
                                    <input type="radio" name="B" value=""/>
                                    <span class="cr"><i class="cr-icon fa fa-check-circle"></i></span>
                                    4
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="radio">
                                <label style="font-size: 1">
                                    <input type="radio" name="B" value=""/>
                                    <span class="cr"><i class="cr-icon fa fa-check-circle"></i></span>
                                    5
                                </label>
                            </div>
                        </div>  
                    </div>
                </div>             
            </div>
        </div>

        <div class="card ">
            <div class="card-header">Travel Satisfaction</div>
            <div class="card-block">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <span style="font-size:22px;">Travel:</span>
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-2 text-xs-center">
                        <button id="decrease1" style="width:100%; max-width:35px;">-</button>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                        <div style="width:100%;" id="progress1"></div>
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-2 text-xs-center">
                        <button id="increase1" style="width:100%; max-width:35px;">+</button>
                    </div>
                </div>
                <div class="clearfix"><br /></div>
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <span style="font-size:22px;">Transfer:</span>
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-2 text-xs-center">
                        <button id="decrease2" style="width:100%; max-width:35px;">-</button>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                        <div style="width:100%;" id="progress2"></div>
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-2 text-xs-center">
                        <button id="increase2" style="width:100%; max-width:35px;">+</button>
                    </div>
                </div>
                <div class="clearfix"><br /></div>
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <span style="font-size:22px;">Checkin:</span>
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-2 text-xs-center">
                        <button id="decrease3" style="width:100%; max-width:35px;">-</button>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                        <div style="width:100%;" id="progress3"></div>
                    </div>
                    <div class="col-md-1 col-sm-1 col-xs-2 text-xs-center">
                        <button id="increase3" style="width:100%; max-width:35px;">+</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </form>
</div>

<!-- you need to include the shieldui css and js assets in order for the components to work -->
<link rel="stylesheet" type="text/css" href="/css/bootstrap/css/ligth-bootstrap/all.min.css" />
<script type="text/javascript" src="/css/bootstrap/js/shieldui-all.min.js"></script>

<script type="text/javascript">
    jQuery(function ($) {
        $('#rate1').shieldRating({
            max: 5,
            step: 1,
            value: 1,
            markPreset: true
        });

        $('#rate2').shieldRating({
            max: 7,
            step: 0.1,
            value: 0,
            markPreset: false
        });

        $('#rate3').shieldRating({
            max: 7,
            step: 0.1,
            value: 0,
            markPreset: false
        });

        var progress1 = $("#progress1").shieldProgressBar({
            value: 50,
            text: {
                enabled: true,
                template: "{0} %"
            }
        }).swidget();

        var progress2 = $("#progress2").shieldProgressBar({
            value: 50,
            text: {
                enabled: true,
                template: "{0} %"
            }
        }).swidget();

        var progress3 = $("#progress3").shieldProgressBar({
            value: 50,
            text: {
                enabled: true,
                template: "{0} %"
            }
        }).swidget();


        $("#increase1").shieldButton({
            events: {
                click: function () {
                    progress1.value(progress1.value() + 10);
                }
            }
        });
        $("#decrease1").shieldButton({
            events: {
                click: function () {
                    progress1.value(progress1.value() - 10);
                }
            }
        });

        $("#increase2").shieldButton({
            events: {
                click: function () {
                    progress2.value(progress2.value() + 10);
                }
            }
        });
        $("#decrease2").shieldButton({
            events: {
                click: function () {
                    progress2.value(progress2.value() - 10);
                }
            }
        });

        $("#increase3").shieldButton({
            events: {
                click: function () {
                    progress3.value(progress3.value() + 10);
                }
            }
        });
        $("#decrease3").shieldButton({
            events: {
                click: function () {
                    progress3.value(progress3.value() - 10);
                }
            }
        });
    });
    
    $( function() {
        $( document ).tooltip();
    } );
</script>

<style>
    .slider {
        width: 100%;
    }
    .checkbox label:after, 
    .radio label:after {
        content: '';
        display: table;
        clear: both;
    }
    .checkbox .cr,
    .radio .cr {
        position: relative;
        display: inline-block;
        border: 2px solid blue;
        border-radius: .25em;
        width: 1.3em;
        height: 1.3em;
        float: left;
        margin-right: .5em;
        color: red;
    }

    .radio .cr {
        border-radius: 75%;
        border-color: blue;
    }

    .checkbox .cr .cr-icon,
    .radio .cr .cr-icon {
        position: absolute;
        font-size: .8em;
        line-height: 0;
        top: 50%;
        left: 20%;
    }

    .radio .cr .cr-icon {
        margin-left: 0.04em;
    }

    .checkbox label input[type="checkbox"],
    .radio label input[type="radio"] {
        display: none;
    }

    .checkbox label input[type="checkbox"] + .cr > .cr-icon,
    .radio label input[type="radio"] + .cr > .cr-icon {
        transform: scale(3) rotateZ(-220deg);
        opacity: 0;
        transition: all .7s ease-in;
    }

    .checkbox label input[type="checkbox"]:checked + .cr > .cr-icon,
    .radio label input[type="radio"]:checked + .cr > .cr-icon {
        transform: scale(1) rotateZ(0deg);
        opacity: 1;
    }

    .checkbox label input[type="checkbox"]:disabled + .cr,
    .radio label input[type="radio"]:disabled + .cr {
        opacity: .5;
    }
</style>
<br /><br /><br /></body></html>