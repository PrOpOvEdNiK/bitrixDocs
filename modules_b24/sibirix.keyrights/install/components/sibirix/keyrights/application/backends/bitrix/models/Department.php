<?
/**
 * Class SibirixKeyrights_Model_Department
 * Модель для работы с пользователями
 */
class SibirixKeyrightsBackend_Model_Department extends SibirixKeyrightsBackend_Model_Abstract {

    static $_available_methods = array(
        'department.get' => 'getDepartmentList',
    );

    private $_fields = array(
        'ID',
        'NAME',
        'PARENT'
    );

    private function getDepartmentsIblockId() {
        $iblockId = COption::GetOptionInt('intranet', 'iblock_structure', 0);
        if (!$iblockId) {
            $bxIblock = new CIBlock();
            $res = $bxIblock->GetList(array(), array('CODE' => 'departments'));
            $iblock = $res->Fetch();
            $iblockId = is_array($iblock) ? $iblock['ID'] : 0;
        }

        return $iblockId;
    }

    /**
     * @param $params
     * @return array
     */
    public function getDepartmentList($params) {
        $iblockId = $this->getDepartmentsIblockId();
        if (!$iblockId) return array();

        $ibs = new CIBlockSection();
        $field = !empty($params['SORT'])  ? $params['SORT']  : 'ID';
        $dir   = !empty($params['ORDER']) ? $params['ORDER'] : 'DESC';
        $res = $ibs->GetList(array($field => $dir), array('IBLOCK_ID' => $iblockId));

        $fields = array_flip($this->_fields);

        $departments = array();
        while ($dep = $res->Fetch()) {
            $dep['PARENT'] = $dep['IBLOCK_SECTION_ID'];
            $dep = array_intersect_key($dep, $fields);
            $departments[] = $dep;
        }
        return $departments;
    }
}
