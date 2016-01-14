<?php

namespace Thru\RenderCat\Components;

use MatthiasMullie\Minify;

abstract class CompressableAssetDigest
{

    /**
     * @var array[CompressableAsset]
     */
    private $compressableAssets = [];
    private $debugMode = false;

    public function __construct($debugMode = false)
    {
        $this->debugMode = $debugMode;
    }

    public function add(CompressableAsset $compressableAsset)
    {
        $this->compressableAssets[] = $compressableAsset;
    }

    public function render()
    {
        $date = date("Y-m-d H:i:s");
        $minifier = $this->getMinifier();
        $minifier->add("/***** Generated at {$date} ******/\n\n");

        foreach ($this->compressableAssets as $compressableAsset) {
            /** @var $compressableAsset CompressableAsset */
            $minifier->add("\n\n/******** \n * {$compressableAsset->getName()}\n **************/\n\n");
            $minifier->add($compressableAsset->render());
        };

        return $minifier->minify();
    }

    public function getHash()
    {
        $hash = '';
        foreach ($this->compressableAssets as $compressableAsset) {
            /** @var $compressableAsset CompressableAsset */
            $hash .= $compressableAsset->getHash();
        }
        return hash("SHA1", $hash);
    }

    abstract protected function getMinifier();
}
