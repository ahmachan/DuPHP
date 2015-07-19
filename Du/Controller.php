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
		$this->_di->middleware->setDI($this->_di);
		return $this->_di->middleware->input($key);
	}

	public function redirect($action="",$base=FALSE)
	{
	    $this->_di->request->setDI($this->_di);
	    return $this->_di->request->redirect($action,$base);
	}

	public function __get($name)
	{
		if (strrchr($name,"Model")) {
			$model = "\\Models\\".$name;
			$model = new $model;
			$model->setDI($this->_di);
			return $model;
		}
		return $this->_di->$name;
	}
}