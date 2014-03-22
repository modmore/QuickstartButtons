<?php
$xpdo_meta_map['qsbButton']= array (
  'package' => 'quickstartbuttons',
  'version' => '1.0',
  'table' => 'quickstartbuttons_buttons',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'set' => 0,
    'icon' => 0,
    'text' => NULL,
    'description' => '',
    'action_id' => 0,
    'handler' => NULL,
    'link' => NULL,
    'newwindow' => 0,
    'ranking' => 1,
    'active' => 1,
  ),
  'fieldMeta' => 
  array (
    'set' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
      'index' => 'index',
    ),
    'icon' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
      'index' => 'index',
    ),
    'text' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'index' => 'index',
    ),
    'description' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'action_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => true,
      'default' => 0,
    ),
    'handler' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
      'default' => NULL,
    ),
    'link' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
      'default' => NULL,
    ),
    'newwindow' => 
    array (
      'dbtype' => 'tinyint',
      'precision' => '1',
      'phptype' => 'boolean',
      'null' => false,
      'default' => 0,
    ),
    'ranking' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'default' => 1,
      'index' => 'index',
    ),
    'active' => 
    array (
      'dbtype' => 'tinyint',
      'precision' => '1',
      'phptype' => 'boolean',
      'default' => 1,
      'index' => 'index',
    ),
  ),
  'aggregates' => 
  array (
    'Set' => 
    array (
      'class' => 'qsbSet',
      'local' => 'profile',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
    'Icon' => 
    array (
      'class' => 'qsbIcon',
      'local' => 'icon',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
    'Action' => 
    array (
      'class' => 'modAction',
      'local' => 'action_id',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
