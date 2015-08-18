<?php
namespace Du;

class Controller
{
	private  $_di;

	public function setDI(Service $di)
	{
		$this->_di = $di;
	}

	public function getDI()
	{
	    return $this->_di;
	}

	public function input($key="")
	{
		return $this->_di->middleware->input($key);
	}

	public function redirect($action="",$base=FALSE)
	{
	    return $this->_di->request->redirect($action,$base);
	}

	public function __get($name)
	{
		static $m;
		if (strrchr($name,"Model")) {
			$model = "\\Models\\".$name;
			if (!isset($m[$model]))
			{
				$m[$model] = new $model;
				$m[$model]->setDI($this->_di);
			}
			return $m[$model];
		}
		return $this->_di->$name;
	}
}