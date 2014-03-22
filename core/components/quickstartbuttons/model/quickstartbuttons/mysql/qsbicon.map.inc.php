<?php
$xpdo_meta_map['qsbIcon']= array (
  'package' => 'quickstartbuttons',
  'version' => '1.0',
  'table' => 'quickstartbuttons_icons',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'name' => '',
    'class' => '',
    'path' => NULL,
    'preset' => 0,
  ),
  'fieldMeta' => 
  array (
    'name' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '50',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
      'index' => 'index',
    ),
    'class' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '50',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
      'index' => 'unique',
    ),
    'path' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => true,
      'default' => NULL,
    ),
    'preset' => 
    array (
      'dbtype' => 'tinyint',
      'precision' => '1',
      'phptype' => 'boolean',
      'default' => 0,
      'index' => 'index',
    ),
  ),
  'aggregates' => 
  array (
    'Button' => 
    array (
      'class' => 'qsbButton',
      'local' => 'id',
      'foreign' => 'icon',
      'cardinality' => 'many',
      'owner' => 'foreign',
    ),
  ),
);
