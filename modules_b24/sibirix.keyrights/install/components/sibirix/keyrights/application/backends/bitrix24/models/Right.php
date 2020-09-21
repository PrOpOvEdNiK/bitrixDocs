<?php


class SibirixKeyrightsBackend_Model_Right extends SibirixKeyrights_Model_Right {
    protected $domainData;

    public function __construct($config = array()) {
        parent::__construct($config);
        $session = new Zend_Session_Namespace('authdata');
        $this->domainData = $session->domainData;
    }

    /**
     * Fetches a new blank row (not from the database).
     *
     * @param  array $data OPTIONAL data to populate in the new row.
     * @param  string $defaultSource OPTIONAL flag to force default values into new row
     * @return Zend_Db_Table_Row_Abstract
     */
    public function createRow(array $data = array(), $defaultSource = null) {
        $data['domain_id'] = $this->domainData['id'];
        return parent::createRow($data, $defaultSource);
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
        if ($where instanceof Zend_Db_Table_Select) {
            $where->where('domain_id = ?', $this->domainData['id']);
        } elseif (is_array($where)) {
            $where['domain_id = ?'] = $this->domainData['id'];
        } else {
            if (!empty($where)) {
                $where .= ' AND ';
            }
            $where .= 'domain_id = ' . $this->domainData['id'];
        }
        return parent::fetchAll($where, $order, $count, $offset);
    }

    /**
     * Deletes existing rows.
     *
     * @param  array|string $where SQL WHERE clause(s).
     * @return int          The number of rows deleted.
     */
    public function delete($where) {
        if (is_array($where)) {
            $where['domain_id = ?'] = $this->domainData['id'];
        } else {
            if (!empty($where)) {
                $where .= ' AND ';
            }
            $where .= 'domain_id = ' . $this->domainData['id'];
        }

        return parent::delete($where);
    }
}
