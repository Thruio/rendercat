<?php

namespace AE\Components;

class CompressableAsset{

    private $code;
    private $name;

    public function __construct($code){
        if(file_exists($code)){
            #echo "Opened {$code}";
            $this->name = $code;
            $this->code = file_get_contents($code);
            $bytes = strlen($this->code);
            #echo " and got {$bytes} bytes\n";
        }else {
            $this->code = $code;
            $this->name = 'asset-' . rand(10000,999999);
        }
    }

    public function render(){
        #echo "Render returned " . strlen($this->code) . "\n";
        return $this->code;
    }

    public function getHash(){
        return hash("SHA1", $this->code);
    }

    public function getName(){
        return $this->name;
    }
}