<?php

namespace AE\Components;

class CompressableAssetDigest{

    /**
     * @var array[CompressableAsset]
     */
    private $compressableAssets = [];
    private $debugMode = false;

    public function __construct($debugMode = false){
        $this->debugMode = $debugMode;
    }

    public function add(CompressableAsset $compressableAsset){
        $this->compressableAssets[] = $compressableAsset;
    }

    public function render(){
        $date = date("Y-m-d H:i:s");
        $output = "/***** Generated at {$date} ******/\n\n";
        #echo "Rendering... " .count($this->compressableAssets) . "\n";
        foreach($this->compressableAssets as $compressableAsset){
            /** @var $compressableAsset CompressableAsset */
            $output .= "\n\n/******** \n * {$compressableAsset->getName()}\n **************/\n\n";
            $output .= $compressableAsset->render();
        };
        return $this->debugMode ? $output : gzcompress($output);
    }

    public function getHash(){
        $hash = '';
        foreach($this->compressableAssets as $compressableAsset){
            /** @var $compressableAsset CompressableAsset */
            $hash .= $compressableAsset->getHash();
        }
        return hash("SHA1", $hash);
    }
}