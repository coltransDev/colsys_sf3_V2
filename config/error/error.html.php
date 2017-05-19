<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php $path = sfConfig::get('sf_relative_url_root', preg_replace('#/[^/]+\.php5?$#', '', isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : (isset($_SERVER['ORIG_SCRIPT_NAME']) ? $_SERVER['ORIG_SCRIPT_NAME'] : ''))) ?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="title" content="colsys project" />
<meta name="robots" content="index, follow" />
<meta name="description" content="colsys project" />
<meta name="keywords" content="colsys, project" />
<meta name="language" content="en" />
<title>Colsys</title>

<link rel="shortcut icon" href="/favicon.ico" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $path ?>/css/error500.css" />


</head>
<body>
<div class="sfTContainer">
  <a title="Colsys" href="https://www.colsys.com.co/"><img alt="Colsys" class="sfTLogo" src="<?php echo $path ?>/images/logo_colsys_big.gif"  /></a>
  <div class="sfTMessageContainer sfTAlert">
    <img alt="page not found" class="sfTMessageIcon" src="<?php echo $path ?>/sf/sf_default/images/icons/tools48.png" height="48" width="48" />
    <div class="sfTMessageWrap">
      <h1>Ha ocurrido un error</h1>
      <h5>El servidor retorno: "<?php echo $code ?> <?php echo $text ?>".</h5>
    </div>
  </div>

  <dl class="sfTMessageInfo">
    <dt>Algo ha fallado</dt>
    <dd>Por favor haganos saber donde ha ocurrido este error. Lo arreglaremos tan pronto como sea posible.
    Por favor disculpenos por los inconvenientes causados.</dd>

    <dt>¿Que desea hacer?</dt>
    <dd>
      <ul class="sfTIconList">
        <li class="sfTLinkMessage"><a href="javascript:history.go(-1)">Ir a la pagina anterior</a></li>
        <li class="sfTLinkMessage"><a href="/">Ir a la p&aacute;gina principal</a></li>
      </ul>
    </dd>
  </dl>
</div>
</body>
</html>
