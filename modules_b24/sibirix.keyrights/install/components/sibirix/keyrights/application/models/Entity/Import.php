<?
/**
 * Class SibirixKeyrights_Model_Entity_Import
 *
 */
class SibirixKeyrights_Model_Entity_Import {

    private $parsedCsvData         = array();
    private $newSections           = array();
    private $existSectionsNames    = array();
    private $existSectionsIds      = array();
    private $existSections         = array();
    private $existPasswords        = array();
    private $errors                = array();

    private $addedPasswords   = 0;
    private $updatedPasswords = 0;
    private $addedSections    = 0;

    private $userModel;
    private $entityModel;

    private $startTime = 0;
    private $currentStep = 0;
    private $currentStep4Index = 0;
    private $maxTime = 15;

    public function __construct() {
        $this->userModel   = new SibirixKeyrightsBackend_Model_User();
        $this->entityModel = new SibirixKeyrightsBackend_Model_Entity();
    }

    /**
     * @param $data
     * @return array
     */
    public function import($data) {
        $this->startTime = time();
        if (!$this->userModel->isAdmin()) {
            return array(
                'result'  => 'error',
                'message' => $this->t('ONLY_ADMIN_CAN'),
            );
        }

        $this->parsedCsvData = $data;
        $this->existPasswords = $this->entityModel->getItem(array('select' => array('ID', 'SECTION', 'NAME')));
        $this->existSections  = $this->entityModel->getSection(array());

        for ($i = 0; $i < count($this->existSections); $i++) {
            $this->existSectionsNames[$this->existSections[$i]['NAME']] = $this->existSections[$i];
            $this->existSectionsIds  [$this->existSections[$i]['ID']]   = $this->existSections[$i];
        }

        // find exist sections
        $tmpResult = $this->findExistSections();
        if (is_array($tmpResult)) return $tmpResult;
        $tmpResult = $this->createSectionTree();
        if (is_array($tmpResult)) return $tmpResult;
        $tmpResult = $this->createPasswords();
        if (is_array($tmpResult)) return $tmpResult;

        return $this->getImportResults();
    }

    /**
     * @return array|bool
     */
    private function checkTimeLimit() {
        $curTime = time();
        if ($this->startTime + $this->maxTime <= $curTime) {
            $this->saveStepData();
            return array('result' => 'ok', 'data' => 'progress', 'step' => $this->currentStep);
        } else {
            return false;
        }
    }

    /**
     *
     */
    private function saveStepData() {
        $_SESSION['keyrights-import'] = array(
            'currentStep'           => $this->currentStep,
            'currentStep4Index'     => $this->currentStep4Index,
            'parsedCsvData'         => $this->parsedCsvData,
            'newSections'           => $this->newSections,
            'existSectionsNames'    => $this->existSectionsNames,
            'existSectionsIds'      => $this->existSectionsIds,
            'existSections'         => $this->existSections,
            'existPasswords'        => $this->existPasswords,
            'errors'                => $this->errors,
            'addedPasswords'        => $this->addedPasswords,
            'updatedPasswords'      => $this->updatedPasswords,
            'addedSections'         => $this->addedSections,
        );
    }

    /**
     * @return bool
     */
    private function restoreStepData() {
        $data = $_SESSION['keyrights-import'];
        if (isset($data) && is_array($data)) {
            $this->currentStep           = $data['currentStep'];
            $this->currentStep4Index     = $data['currentStep4Index'];
            $this->parsedCsvData         = $data['parsedCsvData'];
            $this->newSections           = $data['newSections'];
            $this->existSectionsNames    = $data['existSectionsNames'];
            $this->existSectionsIds      = $data['existSectionsIds'];
            $this->existSections         = $data['existSections'];
            $this->existPasswords        = $data['existPasswords'];
            $this->errors                = $data['errors'];
            $this->addedPasswords        = $data['addedPasswords'];
            $this->updatedPasswords      = $data['updatedPasswords'];
            $this->addedSections         = $data['addedSections'];

            return true;
        }
        return false;
    }

    /**
     * @return array|bool
     */
    public function continueImport() {
        if (!$this->restoreStepData()) {
            return array('result' => 'error', 'error' => $this->t('IMPORT_PROCESS_FAIL'));
        }

        $this->startTime = time();

        if ($this->currentStep == 2) {
            $tmpResult = $this->refindExistSections();
            if (is_array($tmpResult)) return $tmpResult;
            $tmpResult = $this->createSectionTree();
            if (is_array($tmpResult)) return $tmpResult;
            $tmpResult = $this->createPasswords();
            if (is_array($tmpResult)) return $tmpResult;

            return $this->getImportResults();

        } elseif ($this->currentStep == 3) {
            $tmpResult = $this->createSectionTree();
            if (is_array($tmpResult)) return $tmpResult;
            $tmpResult = $this->createPasswords();
            if (is_array($tmpResult)) return $tmpResult;

            return $this->getImportResults();

        } elseif ($this->currentStep == 4) {
            $tmpResult = $this->createPasswords();
            if (is_array($tmpResult)) return $tmpResult;

            return $this->getImportResults();

        } else {
            return $this->import($this->parsedCsvData);
        }
    }

    /**
     * @return bool
     */
    private function findExistSections() {
        $this->currentStep = 1;

        $this->newSections = array();

        for ($i = 0; $i < count($this->parsedCsvData); $i++) {
            if ($this->parsedCsvData[$i]['SECTION_ID']) {
                continue;
            }

            $foundSectionId = $this->findSectionId($this->parsedCsvData[$i]['SECTION'], $this->parsedCsvData[$i]['PARENT_SECTION']);
            $this->parsedCsvData[$i]['SECTION_ID'] = $foundSectionId;

            if (!$foundSectionId) {
                $foundNewSection = false;
                // без дубликатов
                for ($j = 0; $j < count($this->newSections); $j++) {
                    if (($this->newSections[$j]['NAME'] == $this->parsedCsvData[$i]['SECTION']) && ($this->newSections[$j]['PARENT_NAME'] == $this->parsedCsvData[$i]['PARENT_SECTION'])) {
                        $foundNewSection = true;
                        break;
                    }
                }

                if (!$foundNewSection) {
                    $this->newSections[] = array(
                        'NAME'        => $this->parsedCsvData[$i]['SECTION'],
                        'PARENT_NAME' => $this->parsedCsvData[$i]['PARENT_SECTION']
                    );
                }
            }
        }

        return true;
    }

    /**
     * @return bool
     */
    private function refindExistSections() {
        $this->currentStep = 2;

        for ($i = 0; $i < count($this->parsedCsvData); $i++) {
            if ($this->parsedCsvData[$i]['SECTION_ID']) {
                continue;
            }

            $foundSectionId = $this->findSectionId($this->parsedCsvData[$i]['SECTION'], $this->parsedCsvData[$i]['PARENT_SECTION']);
            $this->parsedCsvData[$i]['SECTION_ID'] = $foundSectionId;
        }

        return true;
    }

    /**
     * пробуем найти по паренту
     */
    private function createSectionTree() {
        $this->currentStep = 3;

        do {
            $countActions = 0;

            for ($i = 0; $i < count($this->newSections); $i++) {
                if ($this->newSections[$i]['ID']) continue;

                if (empty($this->newSections[$i]['PARENT_NAME'])) {
                    $countActions++;

                    $fields = array(
                        'NAME' => $this->newSections[$i]['NAME'],
                        'DESCRIPTION' => 1
                    );

                    $newSectionId = $this->entityModel->addSection($fields);

                    $this->newSections[$i] = array('ID' => $newSectionId) + $fields;

                    $this->existSections[] = $this->newSections[$i];
                    $this->existSectionsIds[$this->newSections[$i]['ID']] = $this->newSections[$i];
                    $this->existSectionsNames[$this->newSections[$i]['NAME']] = $this->newSections[$i];

                } elseif ($this->existSectionsNames[$this->newSections[$i]['PARENT_NAME']]) {
                    $countActions++;
                    $fields = array(
                        'NAME' => $this->newSections[$i]['NAME'],
                        'SECTION' => $this->existSectionsNames[$this->newSections[$i]['PARENT_NAME']]['ID'],
                        'IBLOCK_SECTION_ID' => $this->existSectionsNames[$this->newSections[$i]['PARENT_NAME']]['ID'],
                        'DESCRIPTION' => 1
                    );
                    $newSectionId = $this->entityModel->addSection($fields);
                    $this->newSections[$i] = array('ID' => $newSectionId) + $fields;

                    $this->existSections[] = $this->newSections[$i];
                    $this->existSectionsIds[$this->newSections[$i]['ID']] = $this->newSections[$i];
                    $this->existSectionsNames[$this->newSections[$i]['NAME']] = $this->newSections[$i];
                } else {
                    $countActions++;

                    $fields = array(
                        'NAME' => $this->newSections[$i]['PARENT_NAME'],
                        'DESCRIPTION' => 1
                    );

                    $parentSectionId = $this->entityModel->addSection($fields);

                    $newParentSection = array('ID' => $parentSectionId, 'NAME' => $this->newSections[$i]['PARENT_NAME']);

                    $this->existSections[] = $newParentSection;
                    $this->existSectionsIds[$parentSectionId] = $newParentSection;
                    $this->existSectionsNames[$this->newSections[$i]['PARENT_NAME']] = $newParentSection;

                    $countActions++;

                    $fields = array(
                        'NAME' => $this->newSections[$i]['NAME'],
                        'SECTION' => $this->existSectionsNames[$this->newSections[$i]['PARENT_NAME']]['ID'],
                        'IBLOCK_SECTION_ID' => $this->existSectionsNames[$this->newSections[$i]['PARENT_NAME']]['ID'],
                        'DESCRIPTION' => 1
                    );

                    $newSectionId = $this->entityModel->addSection($fields);

                    $this->newSections[$i] = array('ID' => $newSectionId) + $fields;

                    $this->existSections[] = $this->newSections[$i];
                    $this->existSectionsIds[$this->newSections[$i]['ID']] = $this->newSections[$i];
                    $this->existSectionsNames[$this->newSections[$i]['NAME']] = $this->newSections[$i];
                }
            }

            if ($countActions) {
                $this->refindExistSections();
            }

            $tmpResult = $this->checkTimeLimit();
            if (is_array($tmpResult)) {
                $tmpResult['s'] = $this->newSections;
                $tmpResult['ca'] = $countActions;
                return $tmpResult;
            }

        } while ($countActions > 0);

        return true;
    }

    /**
     *
     */
    private function createPasswords() {
        $this->currentStep = 4;

        // Разделы уже не нужны
        $this->existSections = array();
        $this->existSectionsIds = array();
        $this->existSectionsNames = array();

        // Загрузить существующие пароли
        // Сохранить пришедшие пароли,
        for ($i = $this->currentStep4Index; $i < count($this->parsedCsvData); $i++) {
            if ($this->parsedCsvData[$i]['IS_PROCESSED']) continue;

            $this->parsedCsvData[$i]['IS_PROCESSED'] = true;
            $pass = $this->parsedCsvData[$i];
            $sectionId = $pass['SECTION_ID'];

            if (!$sectionId) {
                $this->errors[] = 'For password ' . $pass['NAME'] . ' in section ' . $pass['SECTION'] . ' parent section ID not found';
                continue;
            }

            // Проверить, есть ли пароль с таким же названием в таком же разделе
            $foundExist = false;
            for ($j = 0; $j < count($this->existPasswords); $j++) {
                if (($this->existPasswords[$j]['SECTION'] == $sectionId) && ($this->existPasswords[$j]['NAME'] == $pass['NAME'])) {
                    $foundExist = true;
                    // Дубликат
                    // заменяем на новую версию
                    $this->updatePassword(
                        $this->existPasswords[$j]['ID'],
                        $this->existPasswords[$j]['NAME'],
                        $this->existPasswords[$j]['SECTION'],
                        $pass['CRYPTED']
                    );
                    break;
                }
            }

            if (!$foundExist) {
                $this->addPassword($pass['NAME'], $sectionId, $pass['CRYPTED']);
            }

            $this->parsedCsvData[$i] = array('IS_PROCESSED' => true);
            $tmpResult = $this->checkTimeLimit();
            if (is_array($tmpResult)) return $tmpResult;
        }

        return true;
    }

    /**
     * @return array
     */
    public function getImportResults() {
        unset($_SESSION['keyrights-import']);
        return array(
            'result' => 'ok',
            'data'   => array(
                'errors' => $this->errors,
                'stat' => array(
                    'addedPasswords' => $this->addedPasswords,
                    'updatedPasswords' => $this->updatedPasswords,
                    'addedSections' => $this->addedSections
                )
            )
        );
    }

    /**
     * @param $sectionName
     * @param $parentName
     * @return bool
     */
    private function findSectionId($sectionName, $parentName) {
        for ($i = 0; $i < count($this->existSections); $i++) {
            if ($this->existSections[$i]['NAME'] == $sectionName) {

                if (!empty($parentName)) {
                    $parentId = $this->existSections[$i]['SECTION'];

                    if ($this->existSectionsIds[$parentId] && $this->existSectionsIds[$parentId]['NAME'] == $parentName) {
                        // указано имя родителя и у имя родителя найденного раздела совпадает - всё ок
                        return $this->existSections[$i]['ID'];
                    }

                } else {
                    if (!$this->existSections[$i]['SECTION']) {
                        // не указано имя родителя и у раздела нет родителя - всё ок
                        return $this->existSections[$i]['ID'];
                    }
                }
            }
        }

        return false;
    }

    /**
     * @param $name
     * @param $section
     * @param $crypted
     * @return bool
     */
    private function addPassword($name, $section, $crypted) {
        $this->addedPasswords++;
        $params = array(
            'NAME'      => $name,
            'SECTION'   => $section,
            'PROPERTY_VALUES' => array('CRYPTED' => SibirixKeyrights_Model_Crypt::crypt($crypted))
        );

        return $this->entityModel->addItem($params);
    }

    /**
     * @param $id
     * @param $name
     * @param $section
     * @param $crypted
     * @return int
     */
    private function updatePassword($id, $name, $section, $crypted) {
        $this->updatedPasswords++;
        $params = array(
            'ID' => $id,
            'NAME' => $name,
            'SECTION' => $section,
            'PROPERTY_VALUES' => array('CRYPTED' => SibirixKeyrights_Model_Crypt::crypt($crypted))
        );

        return $this->entityModel->updateItem($params);
    }

    protected function t($key) {
        return Zend_Registry::get('Zend_Translate')->translate($key);
    }
}
