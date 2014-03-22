<?php

class QuickstartButtons {

    /** @var modX $modx */
    public $modx;

	/**
     * Constructs the object
     *
     * @param modX &$modx A reference to the modX object
     * @param array $config An array of configuration options
     */
    public function __construct(modX &$modx, array $config=array()) {
		$this->modx =& $modx;

		$basePath = $this->modx->getOption('quickstartbuttons.core_path', $config, $this->modx->getOption('core_path').'components/quickstartbuttons/');
		$assetsPath = $this->modx->getOption('quickstartbuttons.assets_path', $config, $this->modx->getOption('assets_path').'components/quickstartbuttons/');
        $assetsUrl = $this->modx->getOption('quickstartbuttons.assets_url', $config, $this->modx->getOption('assets_url').'components/quickstartbuttons/');

		$this->config = array_merge(array(
			'basePath' => $basePath,
			'corePath' => $basePath,
			'lexiconPath' => $basePath.'lexicon/',
			'modelPath' => $basePath.'model/',
			'controllersPath' => $basePath.'controllers/',
			'processorsPath' => $basePath.'processors/',
            'templatesPath' => $basePath.'templates/',
            'elementsPath' => $basePath.'elements/',
			'chunksPath' => $basePath.'elements/chunks/',
			'hooksPath' => $basePath.'hooks/',
			'assetsPath' => $assetsPath,
			'ordersPath' => $assetsPath.'orders/',
			'assetsUrl' => $assetsUrl,
			'connectorUrl' => $assetsUrl.'connector.php',

			'jsUrl' => $assetsUrl.'js/',
			'cssUrl' => $assetsUrl.'css/',
			'imgsUrl' => $assetsUrl.'images/',

		), $config);

        $this->modx->addPackage('quickstartbuttons', $this->config['modelPath']);
    }

    /**
    * Gets a Chunk and caches it; also falls back to file-based templates
    * for easier debugging.
    *
    * @author Shaun McCormick
    * @access public
    * @param string $name The name of the Chunk
    * @param array $properties The properties for the Chunk
    * @return string The processed content of the Chunk
    */
    public function getChunk($name,$properties = array()) {
        $chunk = null;
        if (!isset($this->chunks[$name])) {
            $chunk = $this->modx->getObject('modChunk',array('name' => $name),true);
            if (empty($chunk)) {
                $chunk = $this->_getTplChunk($name);
                if ($chunk == false) return false;
            }
            $this->chunks[$name] = $chunk->getContent();
        } else {
            $o = $this->chunks[$name];
            $chunk = $this->modx->newObject('modChunk');
            $chunk->setContent($o);
        }
        $chunk->setCacheable(false);
        return $chunk->process($properties);
    }

    /**
    * Returns a modChunk object from a template file.
    *
    * @author Shaun McCormick
    * @access private
    * @param string $name The name of the Chunk. Will parse to name.chunk.tpl
    * @param string $postFix The postfix to append to the name
    * @return modChunk/boolean Returns the modChunk object if found, otherwise
    * false.
    */
    private function _getTplChunk($name,$postFix = '.chunk.tpl') {
        $chunk = false;
        $f = $this->config['chunksPath'].strtolower($name).$postFix;
        if (file_exists($f)) {
            $o = file_get_contents($f);
            /* @var modChunk $chunk */
            $chunk = $this->modx->newObject('modChunk');
            $chunk->set('name',$name);
            $chunk->setContent($o);
        }
        return $chunk;
    }
}