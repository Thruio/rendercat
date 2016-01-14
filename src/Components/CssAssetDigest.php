<?php

namespace Thru\RenderCat\Components;

use MatthiasMullie\Minify;

class CssAssetDigest extends CompressableAssetDigest {

    protected function getMinifier(){
        return new Minify\CSS();
    }
}