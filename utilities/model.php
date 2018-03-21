<?php

/**
 * Class Model
 * this is primary class for all models
 */
class Model
{
	protected $_db;
	protected $_sql;

	/**
	 * Model constructor.
	 */
	public function __construct()
	{
		$this->_db = Db::init();
	}

    /**
     * @param $sql
     */
	protected function _setSql($sql)
	{
		$this->_sql = $sql;
	}

    /**
     * To fetch all rows
     * @param null $data
     * @return array
     * @throws Exception
     */
	public function getAll($data = null)
	{
		if (!$this->_sql)
		{
			throw new Exception("No SQL query!");
		}

		$sth = $this->_db->prepare($this->_sql);
		$sth->execute($data);
		return $sth->fetchAll();
	}

    /**
     * To fetch single row
     * @param null $data
     * @return mixed
     * @throws Exception
     */
	public function getRow($data = null)
	{
		if (!$this->_sql)
		{
			throw new Exception("No SQL query!");
		}

		$sth = $this->_db->prepare($this->_sql);
		$sth->execute($data);
		return $sth->fetch();
	}
}