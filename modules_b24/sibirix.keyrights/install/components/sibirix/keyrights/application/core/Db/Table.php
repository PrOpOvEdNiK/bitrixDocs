<?php
class Core_Db_Table extends Zend_Db_Table_Abstract {
    static $_cache = array();
    static $_rcache = array();

    protected $_useCache = true;

    protected $_rowClass = 'Core_Db_Table_Row';

    public static function model() {
        return new static();
    }

    /**
     * Get row(s) by id(s)
     * @param $id
     * @return null|Zend_Db_Table_Row_Abstract|Zend_Db_Table_Rowset_Abstract|Core_Db_Table_Row
     */
    public function getById($id){

        if (is_array($id) && count($id) > 0){

            return $this->find($id);

        } elseif (is_numeric($id) && ($id)) {
            $rowset = $this->find($id);

            if (!is_object($rowset) || $rowset->count() == 0) {
                return false;
            }
            $rowset->rewind();
            return $rowset->current();
        }

        return false;
    }

    /**
     * Get rows count
     * @return string
     */
    public function getRowsCount(){

         $select = $this->select()
            ->from($this->_name, new Zend_Db_Expr('COUNT(1)'));
        return $select->query()->fetchColumn();
    }

    /**
     * Is exist row by id
     * @param $id
     * @return bool
     */
    public function isExist($id) {

        $select = $this->select()
                    ->from($this->_name, new Zend_Db_Expr('COUNT(*)'))
                    ->where('id = ?', $id);
        $result = ($select->query()->fetchColumn() > 0) ? true : false;
        return $result;
    }

    /**
     * Get max id from table
     * @return int
     */
    public function getLastId() {

        $select = $this->select()
            ->from($this->_name, array('max(id) AS max'));

        $row = $this->fetchRow($select);
        return $row->max;
    }

    /**
     * Trauncate this table
     * @return Zend_Db_Statement_Interface
     */
    public function truncate() {
        $sql = 'TRUNCATE TABLE ' . $this->_name;
        return $this->getAdapter()->query($sql);
    }

    /**
     * Insert row
     * @param array $data
     * @return string
     */
    public function insertData(array $data) {
        parent::insert($data);
        return $this->getAdapter()->lastInsertId();
    }

    /**
     * Multi insert
     * @param array $data
     * @return Zend_Db_Statement_Interface
     */
    public function multiInsert(array $data) {

        $keys = array_keys(current($data));

        foreach ($keys as $num=>$key) {
            $keys[$num] = $this->_name.'.'.$key;
        }

        $value_titles = '(' .implode(',', $keys). ")\n";

        $pre_val = array();
        foreach($data as $values) {

            foreach($values as $key=>$value) {
                $values[$key] = $this->getAdapter()->quote($value);

            }

            $pre_val[] = "(" .implode(", ", $values). ")\n";
        }

        $inserted_values = implode(",\n", $pre_val);

        $sql = 'INSERT INTO
        '.$this->_name.'
        '.$value_titles.'
        VALUES '.$inserted_values;

        // Core_Log::info($sql);

        return $this->getAdapter()->query($sql);
    }

    /**
     * Update one row by id
     * @throws Exception
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function updateData(array $data, $id) {

        if ($this->isExist($id)){
            $sql = $this->getAdapter()->quoteInto('id = ?', $id);
            parent::update($data, $sql);
            return true;
        } else {
            throw new Exception('This id is not exist');
        }
    }

    /**
     * Delete rows
     * @param array $array
     * @return int|null
     */
    public function deleteRows(array $array) {

        if ($array){
            $where = $this->getAdapter()->quoteInto('id IN (?)', $array);
            return $this->delete($where);
        }
        return null;
    }

    /**
     * Explain select
     * @param Zend_Db_Table_Select $select
     * @return Zend_Db_Table_Select
     */
    public function explain(Zend_Db_Table_Select $select) {

        $sql = $select->__toString();
        $sql = 'EXPLAIN ' . $sql;

        return $this->getAdapter()->query($sql);
    }

    /**
     * Fetches all rows.
     *
     * Honors the Zend_Db_Adapter fetch mode.
     *
     * @param string|array|Zend_Db_Table_Select $where  OPTIONAL An SQL WHERE clause or Zend_Db_Table_Select object.
     * @param string|array                      $order  OPTIONAL An SQL ORDER clause.
     * @param int                               $count  OPTIONAL An SQL LIMIT count.
     * @param int                               $offset OPTIONAL An SQL LIMIT offset.
     * @return Zend_Db_Table_Rowset_Abstract The row results per the Zend_Db_Adapter fetch mode.
     */
    public function fetchAll($where = null, $order = null, $count = null, $offset = null) {
        $cache = false;
        if ($where instanceof Zend_Db_Table_Select) {
            $cache = md5($where);
        } else {
            $select = $this->select();

            if ($where !== null) {
                $this->_where($select, $where);
            }

            if ($order !== null) {
                $this->_order($select, $order);
            }

            if ($count !== null || $offset !== null) {
                $select->limit($count, $offset);
            }

            $where = $select;
            $cache = md5($where);
        }

        if ($this->_useCache && $cache && isset(self::$_cache[$cache])) {
            return self::$_cache[$cache];
        }

        $res = parent::fetchAll($where, $order, $count, $offset);

        if ($cache) {
            self::$_cache[$cache] = $res;
        }
        return $res;
    }

    /**
     * Fetches one row in an object of type Zend_Db_Table_Row_Abstract,
     * or returns null if no row matches the specified criteria.
     *
     * @param string|array|Zend_Db_Table_Select $where  OPTIONAL An SQL WHERE clause or Zend_Db_Table_Select object.
     * @param string|array                      $order  OPTIONAL An SQL ORDER clause.
     * @param int                               $offset OPTIONAL An SQL OFFSET value.
     * @return Zend_Db_Table_Row_Abstract|null The row results per the
     *     Zend_Db_Adapter fetch mode, or null if no row found.
     */
    public function fetchRow($where = null, $order = null, $offset = null)
    {
        $cache = false;
        if ($where instanceof Zend_Db_Table_Select) {
            $cache = md5($where);
        } else {
            $select = $this->select();

            if ($where !== null) {
                $this->_where($select, $where);
            }

            if ($order !== null) {
                $this->_order($select, $order);
            }

            $select->limit(1, ((is_numeric($offset)) ? (int) $offset : null));

            $where = $select;
            $cache = md5($where);
        }

        if ($this->_useCache && $cache && isset(self::$_rcache[$cache])) {
            return self::$_rcache[$cache];
        }

        $res = parent::fetchRow($where, $order, $offset);

        if ($cache) {
            self::$_rcache[$cache] = $res;
        }
        return $res;
    }

    public function cacheOff() {
        $this->_useCache = false;

        return $this;
    }

    public function cacheOn() {
        $this->_useCache = true;

        return $this;
    }
    public static function invalidateCache() {
        self::$_rcache = array();
        self::$_cache = array();
    }
}
