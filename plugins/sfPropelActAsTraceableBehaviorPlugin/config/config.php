<?php

$hooks = array (
  ':save:pre' => array ('sfPropelActAsTraceableBehaviorPlugin', 'preSave'),
  ':delete:pre' => array ('sfPropelActAsTraceableBehaviorPlugin', 'preDelete'),
  'Peer:doSelectStmt:doSelectStmt' => array('sfPropelActAsTraceableBehaviorPlugin', 'doSelectStmt'),
  'Peer:doSelectJoin'          => array('sfPropelActAsTraceableBehaviorPlugin', 'doSelectStmt'),
  'Peer:doSelectJoinAll'       => array('sfPropelActAsTraceableBehaviorPlugin', 'doSelectStmt'),
  'Peer:doSelectJoinAllExcept' => array('sfPropelActAsTraceableBehaviorPlugin', 'doSelectStmt'),
);
sfPropelBehavior::registerHooks('sfPropelActAsTraceableBehaviorPlugin', $hooks );
sfPropelBehavior::registerHooks('traceable', $hooks );

sfPropelBehavior::registerMethods('sfPropelActAsTraceableBehaviorPlugin', array(
  array('sfPropelActAsTraceableBehaviorPlugin', 'forceDelete'),
));

sfPropelBehavior::registerMethods('traceable', array(
  array('sfPropelActAsTraceableBehaviorPlugin', 'forceDelete'),
));

?>