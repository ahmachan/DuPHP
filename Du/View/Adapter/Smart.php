<?php
namespace Du\View\Adapter;

use Du\View\Template;

class Smart extends Template
{

    /**
     * 解析引擎
     * @var \Du\Smart\SmartParser
     */
    public $smart;

    public function render($tPath, $tVars)
    {
        $smart = new \Du\Smart\SmartParser();
        $path = join(DS, $tPath);
        $this->cacheFile = CACHE_PATH . DS . __MODULE__ . DS . $path . $this->suffix;
        $this->fileName = $tPath[1] . $this->suffix;
        $tplDir = APP_PATH . DS . __MODULE__ . DS . VIEW_NAME . DS . $this->theme . DS . __CONTROLLER__;
        $file = $tplDir . DS . $this->fileName;
        if (file_exists($file)) {
            $smart->compile(file_get_contents($file), $tplDir . DS . $tPath[0], $this->suffix);
            $this->buildCacheFile($smart->data);
            if (is_file($this->cacheFile)) {
                extract($tVars);
                require $this->cacheFile;
            }
        }
    }

    public function getResult()
    {
        return $this->smart->data;
    }
}