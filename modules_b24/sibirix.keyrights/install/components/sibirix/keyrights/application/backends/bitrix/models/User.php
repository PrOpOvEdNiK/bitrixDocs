<?
/**
 * Class Model_User
 * Модель для работы с пользователями
 */
class SibirixKeyrightsBackend_Model_User extends SibirixKeyrightsBackend_Model_Abstract {

    static $_available_methods = array(
        'user.get'     => 'getUserList',
        'user.current' => 'getCurrentUser',
        'user.admin'   => 'isAdmin',
    );

    static $departments = null;

    protected $_selectFields = array(
        'ACTIVE',
        'EMAIL',
        'ID',
        'IS_ONLINE',
        'LAST_NAME',
        'LOGIN',
        'NAME',
        'PERSONAL_PHOTO',
        'SECOND_NAME',
        'TITLE',
    );

    public function getUserListById($userIdList = array()) {

        $order = "ID";
        $direction = "desc";
        $bxUser = new CUser();
        $res = $bxUser->GetList($order, $direction, array('ID' => implode('|', $userIdList)));
        $userList = array();

        while ($user = $res->Fetch()) {
            $userList[$user['ID']] = $user;
        }

        return $userList;
    }
    /**
     * @param $params
     * @return array
     */
    public function getUserList($params = array()) {
        $bxUser = new CUser();
        $field = $params['SORT']  ? $params['SORT']  : 'ID';
        $order = $params['ORDER'] ? $params['ORDER'] : 'ASC';

        $res = $bxUser->GetList($field, $order, array(/*'ACTIVE' => 'Y'*/), array(
            'FIELDS' => $this->_selectFields,
            'SELECT' => array('UF_DEPARTMENT')
        ));
        $users = array();

        $departmentList = $this->_getDepartments();

        $fileIds = array();
        while ($user = $res->Fetch()) {
            if (!empty($user['PERSONAL_PHOTO'])) $fileIds[] = $user['PERSONAL_PHOTO'];
            $user['UF_DEPARTMENT'] = $this->_getAllDepartments($user['UF_DEPARTMENT'], $departmentList);
            $users[] = $user;
        }

        if (count($fileIds)) {
            $bxFile = new CFile();

            $files = array();
            foreach ($fileIds as $file) {
                $files[$file] = $bxFile->ResizeImageGet($file, array('width' => 26, 'height' => 26), BX_RESIZE_IMAGE_EXACT);
                $files[$file] = $files[$file]['src'];
            }

            foreach ($users as $ind => $user) {
                if (!empty($user['PERSONAL_PHOTO']) && $files[$user['PERSONAL_PHOTO']]) {
                    $users[$ind]['PERSONAL_PHOTO'] = $files[$user['PERSONAL_PHOTO']];
                } else {
                    $users[$ind]['PERSONAL_PHOTO'] = false;
                }
            }
        }

        return $users;
    }

    /**
     * @return bool
     */
    public function getCurrentUser() {
        global $USER;
        $userId = $USER->GetID();
        if (!$userId) return false;

        return $this->getUserById($userId);
    }

    public function getUserById($id) {
        $order = "ID";
        $direction = "desc";
        $bxUser = new CUser();
        $userRes = $bxUser->GetList($order, $direction, array('ID' => $id), array(
            'FIELDS' => $this->_selectFields,
            'SELECT' => array('UF_DEPARTMENT')
        ));
        $user = $userRes->Fetch();

        $departmentList = $this->_getDepartments();
        $user['UF_DEPARTMENT'] = $this->_getAllDepartments($user['UF_DEPARTMENT'], $departmentList);

        return $user;
    }

    /**
     * @return null
     */
    public function getUserId() {
        global $USER;
        return $USER->GetID();
    }

    /**
     * @param bool $id
     * @return bool
     */
    public function isAdmin($id = false) {
        if ($id) {
            if(false === array_search('1', CUser::GetUserGroup($id))) {
                return false;
            } else {
                return true;
            }
        }
        global $USER;
        return $USER->IsAdmin();
    }


    /**
     * @param bool $id
     * @return array
     */
    public function getUserData($id = false) {
        if (!$id) {
            $userData = $this->getCurrentUser();
        } else {
            $userData = $this->getUserById($id);
        }
        //Если передавать ид в метод то все падает
        $userData['admin'] = $this->isAdmin($id);

        $departmentList = $this->_getDepartments();
        $userData['UF_DEPARTMENT'] = $this->_getAllDepartments($userData['UF_DEPARTMENT'], $departmentList);
        unset($userData['PASSWORD'], $userData['CHECKWORD'], $userData['CHECKWORD_TIME']);

        return $userData;
    }

    protected function _getDepartments() {
        if (is_null(self::$departments)) {
            $depModel = new SibirixKeyrightsBackend_Model_Department();
            self::$departments = $depModel->getDepartmentList(array());
        }

        return self::$departments;
    }

    protected function _getAllDepartments($userDeps, $depList) {
        $depListById = array();
        $allUserDeps = array();

        foreach ($depList as $dep) {
            $depListById[$dep['ID']] = $dep;
        }

        foreach ($depListById as $id => $dep) {
            $depListById[$id]['PARENT_LIST'] = $this->_recursiveGetParents($dep['PARENT'], $depListById);
        }

        if ($userDeps) {
            foreach ($userDeps as $userDep) {
                $allUserDeps[] = $userDep;
                $allUserDeps = array_merge($allUserDeps, $depListById[$userDep]['PARENT_LIST']);
            }
        }

        return array_values(array_unique($allUserDeps));
    }

    public function _recursiveGetParents($parentId, $depList) {
        if (!$parentId) {
            return array();
        }

        $parentList = array((int)$parentId);

        if ($depList[$parentId] && $depList[$parentId]['PARENT']) {
            $parentList = array_merge($parentList, $this->_recursiveGetParents($depList[$parentId]['PARENT'], $depList));
        }

        return $parentList;
    }
}
