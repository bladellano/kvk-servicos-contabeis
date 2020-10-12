<?php

namespace Source;

use Rain\Tpl;

class Page
{

    private $tpl;
    private $options = [];
    private $defaults = [
        "_header"=>true,
        "_footer"=>true,
        "data" => [],
    ];

    public function __construct($opts = array(),$tpl_dir="/views/")
    {
        $this->options = array_merge($this->defaults, $opts);
        $config = array(
            "tpl_dir" => self::reverse_strrchr($_SERVER['SCRIPT_FILENAME'],'/') . $tpl_dir,
            "cache_dir" => self::reverse_strrchr($_SERVER['SCRIPT_FILENAME'],'/') . "/views-cache/",
            "debug" => false         
        );

        Tpl::configure($config);
        $this->tpl = new Tpl;
        
        $this->setData($this->options["data"]);       
        if($this->options["_header"]===true) $this->tpl->draw("_header");

    }

    private function setData($data = array()){
        foreach ($data as $key => $value) {
            $this->tpl->assign($key, $value);
        }
    }
    public function setTpl($name, $data = array(), $returnHTML = false)
    {
        if(!file_exists(self::reverse_strrchr($_SERVER['SCRIPT_FILENAME'],'/').'/views/'.$name.'.html'))
            $name = 'not-found';

        $this->setData($data);
        return $this->tpl->draw($name,$returnHTML);
    }

    public function __destruct()
    {
        if($this->options["_header"]===true) $this->tpl->draw("_footer");
    }

    private static function reverse_strrchr($haystack, $needle)
    {
        $pos = strrpos($haystack, $needle);
        if($pos === false) {
            return $haystack;
        }
        return substr($haystack, 0, $pos + 1);
    }

}
