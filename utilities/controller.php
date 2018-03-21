<?php

/**
 * Class Controller
 * this is primary class for all controllers
 */
class Controller
{
	protected $_model;
	protected $_controller;
	protected $_action;
	protected $_view;
	protected $_modelBaseName;

    /**
     * Controller constructor.
     * @param $model
     * @param $action
     */
	public function __construct($model, $action)
	{
		$this->_controller = ucwords(__CLASS__);
		$this->_action = $action;
		$this->_modelBaseName = $model;
		
		$this->_view = new View('views' . DS . strtolower($this->_modelBaseName) . DS . $action . '.phtml');
	}

    /**
     * setting up model
     * @param $modelName
     */
	protected function _setModel($modelName)
	{
		$modelName .= 'Model';
		$this->_model = new $modelName();
	}

    /**
     * setiting up view
     * @param $viewName
     */
	protected function _setView($viewName)
	{
		$this->_view = new View('views' . DS . strtolower($this->_modelBaseName) . DS . $viewName . '.phtml');
	}
}
