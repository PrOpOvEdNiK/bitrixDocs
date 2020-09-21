<?
/**
 * Class SibirixKeyrights_Model_Entity
 *
 */
class SibirixKeyrightsBackend_Model_Entity extends SibirixKeyrightsBackend_Model_Abstract {

    static $_available_methods = array(
        'entity.section.add'    => 'addSection',
        'entity.section.get'    => 'getSection',
        'entity.section.update' => 'updateSection',
        'entity.section.delete' => 'deleteSection',
        'entity.item.add'       => 'addItem',
        'entity.item.get'       => 'secureGetItem',
        'entity.item.update'    => 'updateItem',
        'entity.item.delete'    => 'deleteItem',
    );

    private $_fields = array(
        'ID',
        'SECTION',
        'NAME',
        'TIMESTAMP_X',
        'DATE_CREATE',
        'CREATED_BY',
        'CRYPTED',
        'COLOR',
    );

    private $iblockId;
    private $ibs;
    private $ibe;

    private $_lastError = '';

    /**
     *
     */
    function __construct() {
        $this->iblockId = static::getIblockId();
        $this->ibs = new CIBlockSection();
        $this->ibe = new CIBlockElement();
    }

    /**
     * @return bool|null|string
     */
    public static function getIblockId() {
        return COption::GetOptionString(CKeyrights::MODULE_ID, 'iblockId', -1);
    }

    /****
     * Работа с разделами
     ****/

    /**
     * Добавить раздел
     * @param $params
     * @return int
     */
    public function addSection($params) {
        $userModel = new SibirixKeyrightsBackend_Model_User();
        $fields = Array(
            "IBLOCK_ID"         => $this->iblockId,
            "CREATED_BY"        => $userModel->getUserId(),
            "NAME"              => $params['NAME'],
            "IBLOCK_SECTION_ID" => (int)$params['IBLOCK_SECTION_ID'],
            "DESCRIPTION"       => substr('0' . $params['ICON'], -2) . strip_tags($params['NOTE']),
            // DETAIL_PICTURE: "" // todo
        );

        $res = $this->ibs->Add($fields);
        return $res;
    }

    /**
     * @param $params
     * @return array
     */
    public function getSection($params = array()) {
        $sort = !empty($params['SORT']) ? $params['SORT'] : array('ID' => 'ASC');
        $filter = array('IBLOCK_ID' => $this->iblockId, 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y');
        if ($params['ID']) $filter['ID'] = (int)$params['ID'];
        $select = array('ID', 'IBLOCK_SECTION_ID', 'NAME', 'DATE_CREATE', 'TIMESTAMP_X', 'DESCRIPTION', 'CREATED_BY');

        $res = $this->ibs->GetList($sort, $filter, false, $select);

        $result = array();
        while ($section = $res->Fetch()) {
            $section['SECTION']  = $section['IBLOCK_SECTION_ID'] ? $section['IBLOCK_SECTION_ID'] : 0;
            $section['DATE_CREATE'] = date('c', strtotime($section['DATE_CREATE']));
            $section['TIMESTAMP_X'] = date('c', strtotime($section['TIMESTAMP_X']));
            $section['ICON'] = intval(substr($section['DESCRIPTION'], 0, 2));
            $section['NOTE'] = substr(trim($section['DESCRIPTION']), 2);
            if (false === $section['NOTE']) {
                $section['NOTE'] = '';
            }
            $result[] = $section;
        }
        return $result;
    }

    public function getSectionHierarchy() {
        $sectionList = $this->getSection();
        $hierarchy = array();
        foreach ($sectionList as $section) {
            $hierarchy[$section['ID']] = array(
                'parent' => $section['SECTION'] ? $section['SECTION'] : 0,
                'owner' => $section['CREATED_BY'],
            );
        }

        return $hierarchy;
    }

    public function getSectionsTree($includeRoot = false) {
        $sectionList = $this->getSection();

        $itemModel = new SibirixKeyrightsBackend_Model_Item();
        $rightList = $itemModel->getRights();

        $rowRightsCache = array();
        foreach ($rightList as $rowRight) {
            $rowRightsCache[$rowRight->section_id] = $rowRight->toArray();
        }

        if ($includeRoot) {
            $root = array(
                'ID' => 0,
                'SECTION' => false,
                'NAME' => Zend_Registry::get('Zend_Translate')->translate('SECTIONS_ROOT'),
                'CREATED_BY' => 1,
                'OWNER' => 1,
                'ICON' => '1',
                'NOTE' => '',
            );

            $sectionList[] = $root;
        }

        foreach ($sectionList as &$section) {
            $sectionRight = $rowRightsCache[$section['ID']];
            $owner = $section['CREATED_BY'];

            if (!$sectionRight) {
                $itemModel->create($section['ID'], false, $section['CREATED_BY']);
            } else {
                $owner = $sectionRight['owner'];
            }

            $section['OWNER'] = $owner;
            $section['RIGHTS'] = $sectionRight ? $sectionRight['rights'] : array();
        }
        unset($section);

        return $sectionList;
    }

    /**
     * @param $params
     * @return int
     */
    public function updateSection($params) {
        $id = (int)$params['ID'];

        $fields = array();

        if (!empty($params['NAME'])) {
            $fields['NAME'] = $params['NAME'];
        }

        if (isset($params['SECTION'])) {
            $fields['IBLOCK_SECTION_ID'] = $params['SECTION'];
        }

        if (isset($params['ICON']) && isset($params['NOTE'])) {
            $fields['DESCRIPTION'] = substr('0' . $params['ICON'], -2) . strip_tags($params['NOTE']);
        }

        $res = $this->ibs->Update($id, $fields);
        return $res;
    }

    /**
     * Удалить раздел
     * проверка, что он находится в нашем инфоблоке
     * @param $params
     * @return bool
     */
    public function deleteSection($params) {
        $id = (int)$params['ID'];

        $res = $this->ibs->GetList(array(), array('IBLOCK_ID' => $this->iblockId, 'ID' => $id));
        $section = $res->Fetch();

        if ($section) {
            $this->ibs->Delete($id);
            return true;
        }

        return false;
    }

    /****
     * Работа с элементами
     ****/

    /**
     * @param $params
     * @return bool
     */
    public function addItem($params) {
        $userModel = new SibirixKeyrightsBackend_Model_User();

        $data = array(
            'CRYPTED' => array("VALUE" => array("TYPE" => "TEXT","TEXT" => $params['PROPERTY_VALUES']['CRYPTED']))
        );
        $fields = array(
            "IBLOCK_ID"         => $this->iblockId,
            "CREATED_BY"        => $userModel->getUserId(),
            "NAME"              => $params['NAME'],
            "IBLOCK_SECTION_ID" => (int)$params['SECTION'],
            "PREVIEW_TEXT"      => $params['PREVIEW_TEXT'],
            "PROPERTY_VALUES"   => $data,
        );

        $res = $this->ibe->Add($fields);
        return $res;
    }

    /**
     * @param $params
     * @return array
     */
    public function getItem($params = array()) {
        if (($params['ENTITY'] == 'keyrightsuser') && ($params['NAME'] == 'passPhrase')) {
            $key = CKeyrights::getClientCypherKey();

            return array(
                array(
                    'NAME' => 'passPhrase',
                    'PREVIEW_TEXT' => $key
                )
            );
        }

        $sort = !empty($params['SORT']) ? $params['SORT'] : array('ID' => 'ASC');
        $filter = array(
            'ACTIVE' => 'Y',
            'GLOBAL_ACTIVE' => 'Y',
            'SECTION_ACTIVE' => 'Y',
            'SECTION_GLOBAL_ACTIVE' => 'Y',
            'IBLOCK_ID' => $this->iblockId
        );

        if (!empty($params['ID'])) {
            $filter['ID'] = $params['ID'];
        }

        $res = $this->ibe->GetList($sort, $filter, false, false, array('*', 'PROPERTY_CRYPTED'));

        $result = array();
        $fields = array_flip($params['select'] ? $params['select'] : $this->_fields);
        while ($entity = $res->Fetch()) {
            $entity['SECTION']  = $entity['IBLOCK_SECTION_ID'];
            $entity['DATE_CREATE'] = date('c', strtotime($entity['DATE_CREATE']));
            $entity['TIMESTAMP_X'] = date('c', strtotime($entity['TIMESTAMP_X']));
            $entity['CRYPTED'] = SibirixKeyrights_Model_Crypt::decrypt($entity['PROPERTY_CRYPTED_VALUE']['TEXT']);
            $entity['COLOR'] = $entity['PREVIEW_TEXT'];
            unset($entity['PROPERTY_CRYPTED_VALUE']);
            $entity = array_intersect_key($entity, $fields);
            $result[] = $entity;
        }

        return $result;
    }

    /**
     * @param $params
     * @return array
     */
    public function secureGetItem($params = array()) {
        if (($params['ENTITY'] == 'keyrightsuser') && ($params['NAME'] == 'passPhrase')) {
            $key = CKeyrights::getClientCypherKey();

            return array(
                array(
                    'NAME' => 'passPhrase',
                    'PREVIEW_TEXT' => $key
                )
            );
        } else {
            return array();
        }
    }

    /**
     * @param $params
     * @return int
     */
    public function updateItem($params) {
        $id = (int)$params['ID'];

        $fields = array(
            "IBLOCK_SECTION_ID" => (int)$params['SECTION'],
        );

        if (!empty($params['NAME'])) {
            $fields['NAME'] = $params['NAME'];
        }

        if (!empty($params['PREVIEW_TEXT'])) {
            $fields['PREVIEW_TEXT'] = $params['PREVIEW_TEXT'];
        }

        if (!empty($params['PROPERTY_VALUES'])) {
            $data = array(
                'CRYPTED' => array("VALUE" => array("TYPE" => "TEXT","TEXT" => $params['PROPERTY_VALUES']['CRYPTED']))
            );
            $fields['PROPERTY_VALUES'] = $data;
        }

        $res = $this->ibe->Update($id, $fields);

        if (false === $res) {
            $this->_setError(Zend_Registry::get('Zend_Translate')->translate('PASSWORD_NOT_EXIST'));
        }

        return $res;
    }

    /**
     * Удалить пароль
     * проверка, что он находится в нашем инфоблоке
     * @param $params
     * @return bool
     */
    public function deleteItem($params) {
        $id = (int)$params['ID'];

        $res = $this->ibe->GetList(array(), array('IBLOCK_ID' => $this->iblockId, 'ID' => $id));
        $element = $res->Fetch();

        if ($element) {
            $this->ibe->Delete($id);
            return true;
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function getPassCount() {
        $filter = array('IBLOCK_ID' => $this->iblockId);
        $count = $this->ibe->GetList(array(), $filter, array());
        return $count;
    }

    /**
     * @param $error
     */
    protected function _setError($error) {
        $this->_lastError = $error;
    }

    /**
     * @return string
     */
    public function getLastError() {
        if (empty($this->_lastError)) {
            if (!empty($this->ibe->LAST_ERROR)) {
                return $this->ibe->LAST_ERROR;
            } else {
                return $this->ibs->LAST_ERROR;
            }
        }

        return $this->_lastError;
    }
}
