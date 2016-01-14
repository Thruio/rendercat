<?php

namespace Thru\RenderCat\Components;

use MatthiasMullie\Minify;

class JavascriptAssetDigest extends CompressableAssetDigest {

    protected function getMinifier(){
        return new Minify\JS();
    }
}