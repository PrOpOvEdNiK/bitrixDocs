<?
/**
 * Class SibirixKeyrights_Model_Backend_Entity
 *
 */
class SibirixKeyrightsBackend_Model_Entity {

    /** @var SibirixKeyrightsBackend_Model_Api */
    protected $restModel;
    protected $config;

    function __construct() {
        $this->config = Zend_Registry::get('config');
        $this->config = $this->config->bx24config;
        $this->restModel = SibirixKeyrightsBackend_Model_Api::getInstance();
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
        $res = $this->restModel->callMethod('entity.section.add', [
            'ENTITY' =>      $this->config->entity,
            'NAME' =>        $params['NAME'],
            'DESCRIPTION' => (int)$params['DESCRIPTION'],
            'SECTION' => (int)$params['SECTION'],
        ]);
        return $res['result'];
    }

    /**
     * @param $params
     * @return array
     */
    public function getSection($params = array()) {
        if (count($params)) {
            $res = $this->restModel->callMethod('entity.section.get', [
                'ENTITY' => $this->config->entity,
                'FILTER' => $params
            ]);
        } else {
            $res = $this->restModel->callMethod('entity.section.get', ['ENTITY' => $this->config->entity]);
        }

        $result = $res['result'];
        foreach ($result as &$section) {
            if (!$section['SECTION']) {
                $section['SECTION'] = 0;
            }
        }
        unset($section);

        return $result;
    }

    /**
     * @return array
     */
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

    /**
     * @param bool $includeRoot
     * @return array
     */
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
                'NAME' => 'Корневая папка',
                'CREATED_BY' => 1,
                'OWNER' => 1,
                'DESCRIPTION' => 1,
            );

            $sectionList[] = $root;
        }

        foreach ($sectionList as &$section) {
            $owner = $section['CREATED_BY'];

            if (!isset($rowRightsCache[$section['ID']])) {
                $itemModel->create($section['ID'], false, $section['CREATED_BY']);
            } else {
                $sectionRight = $rowRightsCache[$section['ID']];
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
        $params['ENTITY'] = $this->config->entity;
        $res = $this->restModel->callMethod('entity.section.update', $params);
        return $res['result'];
    }

    /**
     * Удалить раздел
     * проверка, что он находится в нашем инфоблоке
     * @param $params
     * @return bool
     */
    public function deleteSection($params) {
        $fields = [
            'ID'     => (int)$params['ID'],
            'ENTITY' => $this->config->entity
        ];
        $res = $this->restModel->callMethod('entity.section.delete', $fields);
        return $res['result'];
    }

    /****
     * Работа с элементами
     ****/

    /**
     * @param $params
     * @return bool
     */
    public function addItem($params) {
        $fields = array(
            "ENTITY"            => $this->config->entity,
            "NAME"              => $params['NAME'],
            "SECTION"           => (int)$params['SECTION'],
            "PROPERTY_VALUES"   => $params['PROPERTY_VALUES'],
        );
        $res = $this->restModel->callMethod('entity.item.add', $fields);
        return $res['result'];
    }

    /**
     * @param $params
     * @return array
     */
    public function getItem($params = array()) {
        $result = $this->restModel->callMethod('entity.item.get', ['ENTITY' => $this->config->entity, 'FILTER' => $params]);
        $result = $result['result'];

        foreach ($result as $ind => $item) {
            $result[$ind]['CRYPTED'] = SibirixKeyrights_Model_Crypt::decrypt($item['PROPERTY_VALUES']['CRYPTED']);
            unset($result[$ind]['PROPERTY_VALUES']);
        }

        return $result;
    }

    /**
     * @param $params
     * @return int
     */
    public function updateItem($params) {
        $params['ENTITY'] = $this->config->entity;
        $result = $this->restModel->callMethod('entity.item.update', $params);
        return $result['result'];
    }

    /**
     * Удалить пароль
     * @param $params
     * @return bool
     */
    public function deleteItem($params) {
        $params['ENTITY'] = $this->config->entity;
        $result = $this->restModel->callMethod('entity.item.delete', $params);
        return $result['result'];
    }

    /**
     * @return mixed
     */
    public function getPassCount() {
        $params['ENTITY'] = $this->config->entity;
        $result = $this->restModel->callMethod('entity.item.get', $params);
        return $result['total'];
    }
}
