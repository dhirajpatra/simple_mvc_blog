<?php

/**
 * Class View
 * This is primary class for all views
 */
class View
{
	protected $_file;
	protected $_data = array();

	/**
	 * View constructor.
	 * @param $file
	 */
	public function __construct($file)
	{
		$this->_file = $file;
	}

    /**
     * @param $key
     * @param $value
     */
	public function set($key, $value)
	{
		$this->_data[$key] = $value;
	}

    /**
     * @param $key
     * @return mixed
     */
	public function get($key)
	{
   		return $this->_data[$key];
  	}

    /**
     * To show the content
     * @throws Exception
     */
	public function output()
	{
		if (!file_exists($this->_file))
		{
			throw new Exception("View " . $this->_file . " doesn't exist.");
		}
		
		extract($this->_data);

		ob_start();
		include($this->_file);
		$output = ob_get_contents();
		ob_end_clean();

		echo $output;
	}
}