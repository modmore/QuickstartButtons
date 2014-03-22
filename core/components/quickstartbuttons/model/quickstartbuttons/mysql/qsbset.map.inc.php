<?php
$xpdo_meta_map['qsbSet']= array (
  'package' => 'quickstartbuttons',
  'version' => '1.0',
  'table' => 'quickstartbuttons_sets',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'name' => NULL,
    'description' => '',
    'size' => 'full',
    'perrow' => 'four',
    'active' => 1,
  ),
  'fieldMeta' => 
  array (
    'name' => 
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
    'size' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '25',
      'phptype' => 'string',
      'null' => false,
      'default' => 'full',
    ),
    'perrow' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '25',
      'phptype' => 'string',
      'null' => false,
      'default' => 'four',
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
  'composites' => 
  array (
    'UserGroup' => 
    array (
      'class' => 'qsbSetUserGroup',
      'local' => 'id',
      'foreign' => 'set',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
    'Button' => 
    array (
      'class' => 'qsbButton',
      'local' => 'id',
      'foreign' => 'set',
      'cardinality' => 'many',
      'owner' => 'local',
    ),
  ),
);
