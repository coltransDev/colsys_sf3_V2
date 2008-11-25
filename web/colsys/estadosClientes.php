<?

require_once(dirname(__FILE__).'/../../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('colsys', 'dev', true);
sfContext::createInstance($configuration)->dispatch();


$dispatcher = new sfEventDispatcher();

$task = new EstadosClientesTask( $dispatcher, new sfAnsiColorFormatter() );
$task->runFromCli( new sfCommandManager() );

// $task->configure();
// $task->execute();
?>
