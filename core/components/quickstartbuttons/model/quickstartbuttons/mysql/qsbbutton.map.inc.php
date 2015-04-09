<?php
$xpdo_meta_map['qsbButton']= array (
  'package' => 'quickstartbuttons',
  'version' => '1.0',
  'table' => 'quickstartbuttons_buttons',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'set' => NULL,
    'icon' => 0,
    'icon_ms' => 0,
    'icon_file' => NULL,
    'text' => NULL,
    'description' => '',
    'action_id' => 0,
    'action_key' => '',
    'action_namespace' => '',
    'action_props' => NULL,
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
      'index' => 'index',
    ),
    'icon' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => true,
      'default' => 0,
      'index' => 'index',
    ),
    'icon_ms' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => true,
      'default' => 0,
      'index' => 'index',
    ),
    'icon_file' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
      'default' => NULL,
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
    'action_key' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '256',
      'phptype' => 'string',
      'null' => true,
      'default' => '',
    ),
    'action_namespace' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '256',
      'phptype' => 'string',
      'null' => true,
      'default' => '',
    ),
    'action_props' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
      'default' => NULL,
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
    'MediaSource' => 
    array (
      'class' => 'modMediaSource',
      'local' => 'icon_ms',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);
