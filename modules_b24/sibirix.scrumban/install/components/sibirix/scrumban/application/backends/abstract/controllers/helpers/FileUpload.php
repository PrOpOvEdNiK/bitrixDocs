<?php
abstract class Abstract_Controller_Action_Helper_FileUpload extends Zend_Controller_Action_Helper_Abstract {

    public function appendUploadedFile($params) {
        $task = new Model_Db_Kanban_Task();

        $htmlUpload   = $params['UP'];
        $fileInBase64 = $params['BASE64'];
        $taskId       = !empty($params['ID']) ? $params['ID'] : $_SERVER['HTTP_ID'];

        if (!$taskId) return false;

        $file = false;
        if (!empty($_FILES)) {
            $uploadedFile = array_pop($_FILES);
            if (!empty($uploadedFile)) {
                $file = $task->appendDirectFile($taskId, $uploadedFile);
            }
        } else if($htmlUpload) {
            $file = $task->appendEncodedFile(file_get_contents('php://input'), self::getAllHeaders(), $fileInBase64);
        }

        if ($file) {
            $userId = Model_Db_Backend_User::getCurrentUserId();

            if ($userId) {

                $taskFields = array(
                    'TASK_ID' => $task->getById($taskId)->ID,
                    'USER_ID' => $userId
                );

                Model_Db_Backend_TaskLog::model()->add($taskFields, 'FILE_ADD', false, $file->ORIGINAL_NAME);
            }
        }

        return $file;
    }

    private static function getAllHeaders() {
        if (!function_exists('getallheaders')) {
            $headers = '';
            foreach ($_SERVER as $name => $value) {
                if (substr($name, 0, 5) == 'HTTP_') {
                    $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
                }
            }
            return $headers;
        } else {
            return getallheaders();
        }
    }

    /**
     * Подготовка встроенных (через data-uri) файлов
     * @param $text
     * @return mixed
     */
    public function prepareImprintedFiles($text) {
        global $fileUploaderObject;
        $fileUploaderObject = $this;

        if (!function_exists('prepareImprintedFilesCallback')) {
            function prepareImprintedFilesCallback($match) {
                global $fileUploaderObject;
                static $index;

                if (!isset($index)) {
                    $index = 1;
                }
                $ext = $fileUploaderObject->getExtension(array("type" => $match[2]));
                $filename = "image-" . $index . "-" . date("Y-m-d_h-i-s") . $ext;
                $fileHandler = fopen($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . SCRUMBAN_UPLOAD_TEMP_FOLDER . $filename, "w");
                $contents = base64_decode($match[3]);
                fwrite($fileHandler, $contents);
                fclose($fileHandler);

                $newFile = $fileUploaderObject->addMediaLibItem(array(
                    'name'  => $filename,
                    'type'  => $match[1],
                    'tmp_name' => $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . SCRUMBAN_UPLOAD_TEMP_FOLDER . $filename,
                    'error' => 0,
                    'size'  => strlen($contents)
                ));

                $index++;

                return $newFile;
            }
        }

        $regexp = '/dat(\s?)a:([^;]*;)base64,([0-9a-zA-Z\/\+\=]*)/';
        $text = preg_replace_callback($regexp, "prepareImprintedFilesCallback", $text);

        return $text;
    }

    /**
     * Загрузить вставленные через copy-paste в браузер картинки
     * @param $text
     * @return mixed
     */
    public function preparePastedFiles($text) {
        $parsedText = $text;

        foreach ($_FILES as $path => $file) {
            $pathParts = explode("//", $path);
            $pathParts[1] = explode("/", $pathParts[1]);
            $pathParts[1][0] = str_replace("_", ".", $pathParts[1][0]);
            $filename = $pathParts[1][1];
            $pathParts[1] = implode("/", $pathParts[1]);
            $pathParts = implode("//", $pathParts);

            $file['name'] = $filename . $this->getExtension($file);
            $filename = $this->addPastedItem($file);

            $parsedText = str_replace($pathParts, $filename, $parsedText);
        }

        return $parsedText;
    }

    /**
     * Загрузить отдельно отправленные файлы, вернуть массив
     * @param int|bool $taskId
     * @return array
     */
    public function uploadPastedFiles($taskId = false) {
        $files = array();

        foreach ($_FILES as $path => $file) {
            $pathParts = explode("//", $path);
            $pathParts[1] = explode("/", $pathParts[1]);
            $pathParts[1][0] = str_replace("_", ".", $pathParts[1][0]);
            $filename = $pathParts[1][1];
            $pathParts[1] = implode("/", $pathParts[1]);
            $pathParts = implode("//", $pathParts);

            $file['name'] = $filename . $this->getExtension($file);
            $filename = $this->addPastedItem($file, $taskId);

            $files[$pathParts] = $filename;
        }

        return $files;
    }

    /**
     * Определить расширение файла по его MIME-типу
     * @param $file
     * @return string
     */
    public function getExtension($file) {
        $type = $file['type'];
        if ($type == 'image/png') {
            return ".png";
        } elseif (($type == 'image/jpeg') || ($type == 'image/jpg') || ($type == 'image/pjpeg')) {
            return ".jpg";
        } elseif ($type == 'image/gif') {
            return ".gif";
        }

        return ".png";
    }

    /**
     * Добавить сам файл в медиабиблиотеку
     * @param $file
     * @param bool $taskId
     * @return mixed
     */
    public function addPastedItem($file, $taskId = false) {
        // Должна быть абстрактной, но сделана обычной, т.к. обфускатор заваливается на абстрактных
    }

    public function addImage($file, $width = 48, $height = 48) {
        // Должна быть абстрактной, но сделана обычной, т.к. обфускатор заваливается на абстрактных
    }

    public function getFileArray($params) {
        $htmlUpload   = $params['UP'];
        $fileInBase64 = $params['BASE64'];

        $file = false;
        if (!empty($_FILES)) {
            $uploadedFile = array_pop($_FILES);
            if (!empty($uploadedFile)) {
                return $uploadedFile;
            }
        } else if($htmlUpload) {
            $headers = self::getAllHeaders();
            $content = file_get_contents('php://input');

            if($fileInBase64) {
                $content = base64_decode($content);
            }

            $headers = array_change_key_case($headers, CASE_UPPER);

            $dir = $_SERVER['DOCUMENT_ROOT'] . '/' . SCRUMBAN_UPLOAD_TEMP_FOLDER;
            $fileName = $dir . md5(microtime()) . ".tmp";

            if (!file_exists($dir)) {
                mkdir($dir, 0755, true);
            }

            if (!file_put_contents($fileName, $content)) {
                return false;
            }

            return array(
                'name'     => urldecode($headers['UP-FILENAME']),
                'tmp_name' => $fileName,
                'type'     => 'application/octet-stream',
                'size'     => filesize($fileName)
            );
        }

        return $file;
    }
}
