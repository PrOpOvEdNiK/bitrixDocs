<?php
class Backend_Controller_Action_Helper_FileUpload extends Abstract_Controller_Action_Helper_FileUpload {
    /**
     * Добавить сам файл в медиабиблиотеку
     * @param $file
     * @return mixed
     */
    public function addMediaLibItem($file) {
        $module = new CModule();
        $module->IncludeModule("fileman");

        new CMedialib();
        // Надо явно загрузить именно этот класс, т.к. CMedialibItem лежит в том же файле, что и CMedialib и отдельно в автозагрузку не добавлен

        $res = CMedialibItem::Edit(array(
            'file'          => $file,
            'path'          => false,
            'arFields'      => array(
                'ID'          => 0,
                'NAME'        => 'Image ' . date("Y.m.d H:i:s"),
                'DESCRIPTION' => "",
                'KEYWORDS'    => ""
            ),
            'arCollections' => array($this->getCollectionId())
        ));

        $path = $res['PATH'];

        return $path;
    }

    /**
     * Получить ID коллекции, в которой мы храним наши файлы. При отсутствии - создать
     * @return int
     */
    public function getCollectionId() {
        static $collectionId;

        if (isset($collectionId)) {
            return $collectionId;
        }

        $module = new CModule();
        $module->IncludeModule("fileman");

        new CMedialib();

        $items = CMedialibCollection::GetList(array(
            'arFilter' => array(
                'ACTIVE' => 'Y',
                'NAME'  => 'SCRUMBAN'
            )
        ));

        if (count($items)) {
            $collectionId = $items[0]['ID'];
        } else {
            /** @noinspection PhpUndefinedClassInspection */
            $res = CMedialibCollection::Edit(array("arFields" => array(
                "NAME"      => "SCRUMBAN",
                "ACTIVE"    => "Y",
                "PARENT_ID" => 0
            )));
            if ($res) {
                $collectionId = $res;
            } else {
                $collectionId = 1;
            }
        }

        return $collectionId;
    }

    public function addPastedItem($file, $taskId = false) {
        return $this->addMediaLibItem($file);
    }

    public function addImage($file, $width = 48, $height = 48) {
        $fileClass = new Model_Db_Backend_File();

        $fileRow = $fileClass->createRow($file);

        if (stripos($fileRow->type, 'image') !== false && $fileRow->save()) {
            $resizeSrc = $fileRow->resize($fileClass::GROUP_LOGO_WIDTH, $fileClass::GROUP_LOGO_HEIGHT);
            return array('IMAGE_SRC' => $resizeSrc, 'IMAGE_ID' => $fileRow->ID);
        } else {
            $t = Zend_Registry::get('Zend_Translate');
            return array('error' => $t->translate('IMAGE_WRONG_TYPE'));
        }
    }
}