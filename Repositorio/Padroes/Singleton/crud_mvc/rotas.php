<?php

class route{
{
private $_url;
private $_callback;
private $_name;

	// REFACTORED
	public function __construct($_url, $callback)
	{
		$this->_setURL($_url);

		try
		{
			$this->_setCallback($callback);
		}
		catch(InvalidArgumentException $e)
		{
		   exit('Error!');
		}
	}

	// ADDED
	protected function _setCallback($callback)
	{
		$callback = (string) $callback;
		$aCallback = explode('@', $callback);

		if (is_callable($callback)) {
			$this->_callback = $callback;
		}
		else if (count($aCallback) == 2 && file_exists(CONTROLLER_PATH . '/' . $aCallback[0] . '.php'))
		{
			require_once CONTROLLER_PATH . '/' . $aCallback[0] . '.php'; // instead of including the class you can make usage of http://php.net/manual/en/function.spl-autoload-register.php
			$this->_callback = new $aCallback[0];
		}
		else
		{
			throw new InvalidArgumentException('$callback is invalid.');
		}
	}

	// ADDED
	protected function _setURL($url)
	{
		$this->_url = '/^' . str_replace('/', '\\/', $url) . '$/';
	}

	public function getURL()
	{
		return $this->_url;
	}

	public function getCallback()
	{
		return $this->_callback;
	}

}