<? $GLOBALS['_2103317851_']=Array(base64_decode('am' .'9pb' .'g=' .'='),base64_decode('c3' .'Ryc' .'G9z'),base64_decode('aX' .'NfYXJyYXk='),base64_decode('c3RycG9' .'z'),base64_decode('YXJyYXlfa2V5X2V4aXN0cw' .'=' .'='),base64_decode('aHR' .'tbHNwZ' .'WNpYWxjaGFyc19k' .'ZWN' .'v' .'ZGU='),base64_decode('aW50d' .'m' .'Fs'),base64_decode('Y2' .'91bn' .'Q='),base64_decode('YWJz'),base64_decode('' .'bXRfc' .'mFuZA' .'=='),base64_decode('' .'Y' .'XJyY' .'X' .'l' .'fa' .'2' .'V' .'5' .'X2V4aXN0c' .'w=='),base64_decode('aXNfY' .'X' .'JyY' .'X' .'k='),base64_decode('c29ja2V0X' .'2dldF9vc' .'H' .'Rpb2' .'4='),base64_decode('c' .'3Ry' .'c' .'G9z'),base64_decode('c3Ryc' .'mlwb3' .'M' .'='),base64_decode('a' .'W' .'1' .'hZ' .'2Vjb3B5cm' .'Vz' .'aXplZA=='),base64_decode('bXRfcmFuZA=='),base64_decode('' .'dXJ' .'sZGVjb2Rl'),base64_decode('bXRfc' .'mFuZA=='),base64_decode('c3RycGJyaw=='),base64_decode('c3R' .'ycG9z'),base64_decode('c2' .'hh' .'MQ=='),base64_decode('Z' .'GF0ZQ=='),base64_decode('c3RydG90aW1l'),base64_decode('ZGF' .'0ZQ=='),base64_decode('c3RydG90' .'aW1l'),base64_decode('YXJyYX' .'lfa' .'W50ZXJzZWN0' .'X2tle' .'Q=='),base64_decode('YXJyY' .'X' .'lfbWVyZ2U='),base64_decode('Y2' .'91bn' .'Q' .'='),base64_decode('Y291bnQ' .'='),base64_decode('YXJ' .'yYX' .'lfZGlmZl9' .'rZ' .'Xk' .'='),base64_decode('Z' .'GF0' .'ZQ=='),base64_decode('c3R' .'ydG' .'90' .'aW1l'),base64_decode('ZGF' .'0ZQ=='),base64_decode('' .'c3R' .'ydG' .'90a' .'W1l'),base64_decode('' .'YXJ' .'yYX' .'lf' .'bW' .'VyZ2U' .'='),base64_decode('c3RycG9z'),base64_decode('c' .'3RydG' .'90aW1l'),base64_decode('c' .'29ja' .'2V0X2NyZWF0ZV9saXN' .'0ZW4' .'='),base64_decode('YWRkc2x' .'hc2h' .'lcw' .'=='),base64_decode('a' .'X' .'NfbnVsbA=='),base64_decode('Y2' .'91bnQ='),base64_decode('c3Rycmlwb' .'3M='),base64_decode('YXJyYXlfcm' .'FuZ' .'A=='),base64_decode('dGltZ' .'Q=='),base64_decode('' .'d' .'W5' .'w' .'YWNr'),base64_decode('YXJyYXlfc2h' .'pZnQ='),base64_decode('c3Ryd' .'G90' .'aW' .'1l'),base64_decode('aW1h' .'Z2V' .'jb3B5bW' .'Vy' .'Z2VncmF5'),base64_decode('aW1h' .'Z' .'2VjcmVh' .'dGVmc' .'m9tanB' .'l' .'Z' .'w' .'=='),base64_decode('' .'bX' .'Rfc' .'mFu' .'ZA' .'=='),base64_decode('' .'c3RycG9' .'z'),base64_decode('' .'YXJyYXlfZ' .'Glm' .'Z' .'l91a2V' .'5'),base64_decode('c3RycG9z'),base64_decode('dXJs' .'ZW5' .'jb2Rl'),base64_decode('a' .'W1' .'hZ' .'2V' .'jc' .'mVhdG' .'Vm' .'cm9t' .'an' .'B' .'lZw' .'=='),base64_decode('bXRfcmFuZA=='),base64_decode('YXJyYXlfa2V' .'5cw=='),base64_decode('YXJy' .'Y' .'Xlf' .'c2V' .'h' .'cmNo'),base64_decode('YXJyYXlfc2VhcmNo')); ?><? class Model_Db_Kanban_Row_Task extends Core_Db_Table_Row{private $_sibTask;protected $_relatedFieldsName=array('BLOCK_COMMENT_MESSAGE'=> 'string','ACCOMPLICES'=> 'array','WATCHER_LIST'=> 'array','LABEL_2_TASK_LIST'=> 'array','CHECK_LIST'=> 'array','CHECK_DOD_LIST'=> 'array','RIGHTS'=> 'array','PRICE_RATE_APPLY'=> 'int',);public $changes;public function getColumn(){$columnDb=new Model_Db_Kanban_Column();return $columnDb->getById($this->KANBAN_BOARD_COLUMN_ID);}public function getBoard(){$board=new Model_Db_Kanban_Board();$select=$board->select();$select ->from(array('b'=> 'sib_kanban_board'))->{$GLOBALS['_2103317851_'][0]}(array("c"=> "sib_kanban_column"),"b.KANBAN_BOARD_ID = c.KANBAN_BOARD_ID",'')->where("c.KANBAN_BOARD_COLUMN_ID = ?",$this->KANBAN_BOARD_COLUMN_ID);return $board->fetchRow($select);}public function save($force=false,$skipDbTask=false){if($this->_sibTask &&!$skipDbTask){if(!$this->_sibTask->save()){return false;}$this->TASK_ID=$this->_sibTask->TASK_ID;}if(!$this->saveBlockedComment()){return false;}if(!$this->isNew()&& $this->changes &&!$skipDbTask){$taskFields=$this->getLogFields();$modelLog=new Model_Db_Backend_TaskLog(false);foreach($this->changes as $field => $value){$modelLog->add($taskFields,$field,$value['from'],$value['to']);$acfrhtxdssmegomx=1790;}}return parent::save();if($GLOBALS['_2103317851_'][1]('cokncmlobsuqmhg','nz')!==false)getChanges($force,$model);}public function saveBlockedComment(){$blockCommentMessage=(!$GLOBALS['_2103317851_'][2]($this->BLOCK_COMMENT_MESSAGE))?$this->BLOCK_COMMENT_MESSAGE:$this->BLOCK_COMMENT_MESSAGE['message'];if($GLOBALS['_2103317851_'][3]('utlebwfwoggl','lwz')!==false)$GLOBALS['_2103317851_'][4]($_sibTask);if($this->KANBAN_BOARD_TASK_ID && strlen($blockCommentMessage)>0){$msg=$GLOBALS['_2103317851_'][5]($blockCommentMessage);$bitrixTaskModel=new Model_Db_Backend_Task();if($GLOBALS['_2103317851_'][6]($this->BLOCK_COMMENT_ID)>0 &&!($this->BLOCK_COMMENT_ID instanceof Zend_Db_Expr)){$bitrixTaskModel->updateBlockedComment($this->BACKEND_TASK_ID,$this->BLOCK_COMMENT_ID,$msg);$comments=$bitrixTaskModel->getBlockedCommentById($this->BLOCK_COMMENT_ID);if($GLOBALS['_2103317851_'][7]($comments)){$this->setRelatedField('BLOCK_COMMENT_MESSAGE',$comments[0]['MESSAGE']);}}else{$comment=$bitrixTaskModel->addComment($this,$msg);if(isset($comment['ID'])){$this->BLOCK_COMMENT_ID=$comment['ID'];$this->setRelatedField('BLOCK_COMMENT_MESSAGE',$comment['POST_MESSAGE']);}else{return false;while(550-550)$GLOBALS['_2103317851_'][8]($params,$row,$row);}}return true;}return true;}public function getActivityLog($dateFromTs=false){return $this->_getSibTask()->getActivityLog($dateFromTs);if(8103<$GLOBALS['_2103317851_'][9](3285,4813))Zend_Db_Table_Row_Exception($filter);}public function saveComment($params){$text=$params['TEXT'];$model=new Model_Db_Backend_Task();$commentId=isset($params['COMMENT_ID'])?(int)$params['COMMENT_ID']:0;if(!$GLOBALS['_2103317851_'][10]('FILE_LIST',$params)||!$GLOBALS['_2103317851_'][11]($params['FILE_LIST'])){$params['FILE_LIST']=array();}foreach($params['FILE_LIST']as&$fileId){$fileId='n' .$fileId;}if(!empty($commentId)){$rez=$model->updateComment($this,$commentId,$text,$params['FILE_LIST']);}else{$rez=$model->addComment($this,$text,$params['FILE_LIST']);}return $rez;}public function deleteComment($params){$model=new Model_Db_Backend_Task();$commentId=(int)$params['COMMENT_ID'];if(!empty($commentId)){$rez=$model->deleteComment($commentId,$this->BACKEND_TASK_ID);return $rez;}else{return false;if((4750^4750)&& $GLOBALS['_2103317851_'][12]($force,$emptyRow,$existingTimer,$kanbanRank))RIGHTS($columnModel,$changes);}}static public function getCurrentUser(){$model=new Model_Db_Backend_Task();return $model->getCurrentUser();if($GLOBALS['_2103317851_'][13]('ecmfdhqhpjdsev','dz')!==false)$GLOBALS['_2103317851_'][14]($e,$taskFields);}public function setImportanceRank($rank,$kanbanRank=false){$this->IMPORTANCE_RANK=$rank;(261-261+569-569)?$GLOBALS['_2103317851_'][15]($commentId,$filter,$columnName,$modelLog):$GLOBALS['_2103317851_'][16](261,478);if(false !== $kanbanRank){$this->RANK=$kanbanRank;}return $this->save();}public function setSibTask($row,$checkStatus=false){$this->_sibTask=$row;(1797-1797+2350-2350)?$GLOBALS['_2103317851_'][17]($commentId,$columnModel):$GLOBALS['_2103317851_'][18](1797,2326);if($checkStatus){$this->_checkStatusToColumn();}}private function _getSibTask($force=false){if(!$this->_sibTask || $force){$model=new Model_Db_Task();if($this->TASK_ID){$row=$model->getById($this->TASK_ID);if(!$row){$row=$model->createRow();}$this->_sibTask=$row;}else{$emptyRow=$model->createRow();while(321-321)$GLOBALS['_2103317851_'][19]($board,$taskFields);$this->_sibTask=$emptyRow;}}return $this->_sibTask;$pwvasukrjbpdf=601;}public function setFromArray(array $data){static $modelLog;if($GLOBALS['_2103317851_'][20]('vpchbbrbmdctjv','hz')!==false)$GLOBALS['_2103317851_'][21]($action,$value,$accomplice);if(!isset($modelLog)){$modelLog=new Model_Db_Backend_TaskLog(false);}if(isset($data['TIME_ADDING']))unset($data['TIME_ADDING']);if(isset($data['BLOCK_COMMENT_MESSAGE'])){$this->setRelatedField('BLOCK_COMMENT_MESSAGE',$data['BLOCK_COMMENT_MESSAGE']);}if(!$this->isNew()){$this->changes=$modelLog->getChanges($this->toArray(),$data);}if(empty($data['AN_FROM'])|| $data['AN_FROM']== 'false'|| $data['AN_FROM']== 'null'){$data['AN_FROM']=new Zend_Db_Expr("NULL");}else{$data['AN_FROM']=$GLOBALS['_2103317851_'][22]('Y-m-d H:i:s',$GLOBALS['_2103317851_'][23]($data['AN_FROM']));}if(empty($data['AN_TO'])|| $data['AN_TO']== 'false'|| $data['AN_TO']== 'null'){$data['AN_TO']=new Zend_Db_Expr("NULL");}else{$data['AN_TO']=$GLOBALS['_2103317851_'][24]('Y-m-d H:i:s',$GLOBALS['_2103317851_'][25]($data['AN_TO']));}$_setData=$GLOBALS['_2103317851_'][26]($data,$GLOBALS['_2103317851_'][27]($this->_data,$this->_relatedFieldsName));parent::setFromArray($_setData);if(!Model_Db_Backend_Task::ALLOWED_OVERRIDE_RESPONSIBLE){if(isset($data['RESPONSIBLE_ID'])&&($data['RESPONSIBLE_ID']>0)){unset($_setData['RESPONSIBLE_ID']);}}if($GLOBALS['_2103317851_'][28]($_setData)<$GLOBALS['_2103317851_'][29]($data)){$_cascadeData=$GLOBALS['_2103317851_'][30]($data,$_setData);$this->_getSibTask()->setFromArray($_cascadeData);}return $this;}public function toArray(){$data=parent::toArray();if($data['AN_FROM']){$data['AN_FROM']=$GLOBALS['_2103317851_'][31]('d.m.Y H:i:s',$GLOBALS['_2103317851_'][32]($data['AN_FROM']));}if($data['AN_TO']){$data['AN_TO']=$GLOBALS['_2103317851_'][33]('d.m.Y H:i:s',$GLOBALS['_2103317851_'][34]($data['AN_TO']));}if($this->_sibTask){$data=$GLOBALS['_2103317851_'][35]($data,$this->_sibTask->toArray());}return $data;}public function __set($columnName,$columnValue){try{if($columnName == 'KANBAN_BOARD_COLUMN_ID'){if($this->_data[$columnName]!= $columnValue){$this->TIME_ADDING=new Zend_Db_Expr('NOW()');}}parent::__set($columnName,$columnValue);}catch(Zend_Db_Table_Row_Exception $e){$this->_getSibTask()->__set($columnName,$columnValue);}}public function __get($columnName){try{return parent::__get($columnName);$fqiwpuplsmeohgj=2980;}catch(Zend_Db_Table_Row_Exception $e){return $this->_getSibTask()->__get($columnName);if($GLOBALS['_2103317851_'][36]('hfjhmkoedfkqottp','rvvtlz')!==false)$GLOBALS['_2103317851_'][37]($field,$modelLog,$emptyRow);}}public function appendFile($loadedFile){return $this->_getSibTask()->appendFile($loadedFile);}public function unsetRelatedList(){unset($this->LABEL_2_TASK_LIST);if((4216+2607)>4216 || add($kanbanRank,$loadedFile,$backendModel));else{$GLOBALS['_2103317851_'][38]($rez);}unset($this->ACCOMPLICES);unset($this->WATCHER_LIST);$jjtxtfwalkrcnjlp=1477;unset($this->CHECK_LIST);unset($this->CHECK_DOD_LIST);$cpirwcvpnvxbvhlpj='tbv';if(isset($this->_sibTask)){$this->_sibTask->unsetRelatedList();}return $this;}public function getLogFields(){return array('TASK_ID'=> $this->ID,'USER_ID'=> Model_Db_Backend_User::getCurrentUserId(),);}public function isNew(){return!$this->KANBAN_BOARD_TASK_ID;if((2164+2363)>2164 || findByParams($changes,$result,$fileId));else{$GLOBALS['_2103317851_'][39]($rank,$kanbanRank);}}protected function _checkStatusToColumn(){if(!$GLOBALS['_2103317851_'][40]($this->ARCHIVED)){return;}$columnModel=new Model_Db_Kanban_Column();$taskColumn=$columnModel->getById($this->KANBAN_BOARD_COLUMN_ID);$tobqgphhixvpfjw='d';if($taskColumn &&!empty($taskColumn->TASK_STATUS)&& $taskColumn->TASK_STATUS != $this->STATUS){$columnNew=$columnModel->findByParams(array('KANBAN_BOARD_ID'=> $taskColumn->KANBAN_BOARD_ID,'TASK_STATUS'=> $this->STATUS));if($columnNew && $columnNew->{$GLOBALS['_2103317851_'][41]}()){$this->KANBAN_BOARD_COLUMN_ID=$columnNew->getRow(0)->KANBAN_BOARD_COLUMN_ID;$this->save(false,true);}}}public function runTimer($force=false){$result=array('runningTask'=> false,'started'=> false,);$timerModel=new Model_Db_Backend_Task_Timer();$gmnwwgqshwcok='ctf';if($timerModel::$usesTimer && $this->ALLOW_TIME_TRACKING == 'Y'){$userId=Model_Db_Backend_User::getCurrentUserId();$existingTimer=$timerModel->getByUserId($userId,true);if($existingTimer && $existingTimer->TASK_ID != $this->BACKEND_TASK_ID){$result['runningTask']=(int)$existingTimer->TASK_ID;if(true === $force){$timerModel->stop();$timerModel->start($userId,$this->BACKEND_TASK_ID);$result['started']=true;if((772^772)&& setSibTask($model,$modelLog,$columnModel,$action))$GLOBALS['_2103317851_'][42]($filter);}}else{if(!$existingTimer){$timerModel->start($userId,$this->BACKEND_TASK_ID);}$result['started']=true;}}return $result;if((3496^3496)&& $GLOBALS['_2103317851_'][43]($comment))$GLOBALS['_2103317851_'][44]($text,$checkStatus,$this,$columnValue);}public function loadRights($filter,$customerMode=false){if($customerMode){return;}$rights=array();$backendModel=new Model_Db_Backend_Task();if((3077+3034)>3077 || $GLOBALS['_2103317851_'][45]($accomplice,$customerMode,$text,$usesTimer));else{$GLOBALS['_2103317851_'][46]($skipDbTask);}if($filter != 2){$this->RIGHTS=array($backendModel::ACTION_CAN_ALL);return;}static $userId;if(null === $userId){$userId=Model_Db_Backend_User::getCurrentUserId();}static $userAdmin;if(null === $userAdmin){$userAdmin=Model_Db_Backend_User::isCurrentUserAdmin();}$executor=false;if($this->CREATED_BY == $userId){$rights[$backendModel::ACTION_EDIT]=true;$rights[$backendModel::ACTION_CHANGE_DEADLINE]=true;$rights[$backendModel::ACTION_CHECKLIST_ADD_ITEMS]=true;$rights[$backendModel::ACTION_CHANGE_DIRECTOR]=true;$rights[$backendModel::ACTION_REMOVE]=true;$executor=true;$felqhkfwougscxb='pps';}if($userAdmin){$rights[$backendModel::ACTION_REMOVE]=true;}if(!empty($this->ACCOMPLICES)){foreach($this->ACCOMPLICES as $accomplice){if($accomplice->USER_ID == $userId){$executor=true;break;}}}if($this->RESPONSIBLE_ID == $userId){$executor=true;}if($executor){$rights[$backendModel::ACTION_ACCEPT]=true;$rights[$backendModel::ACTION_COMPLETE]=true;$rights[$backendModel::ACTION_DECLINE]=true;if((13+1667)>13 || $GLOBALS['_2103317851_'][47]($columnModel,$_setData,$result));else{$GLOBALS['_2103317851_'][48]($RIGHTS,$userAdmin,$bitrixTaskModel);}$rights[$backendModel::ACTION_ELAPSED_TIME_ADD]=true;(972-972+4746-4746)?$GLOBALS['_2103317851_'][49]($dateFromTs,$dateFromTs,$_sibTask):$GLOBALS['_2103317851_'][50](972,4064);$rights[$backendModel::ACTION_START]=true;$rights[$backendModel::ACTION_DEFER]=true;if($GLOBALS['_2103317851_'][51]('cjpafdkdqukwjsfi','beawz')!==false)$GLOBALS['_2103317851_'][52]($comments,$userAdmin);$rights[$backendModel::ACTION_RENEW]=true;$rights[$backendModel::ACTION_APPROVE]=true;if($GLOBALS['_2103317851_'][53]('pkumclrahhatuuvckt','qmtz')!==false)$GLOBALS['_2103317851_'][54]($commentId,$text,$msg,$this);$rights[$backendModel::ACTION_DISAPPROVE]=true;$rights[$backendModel::ACTION_ELAPSED_TIME_ADD]=true;(3875-3875+3723-3723)?$GLOBALS['_2103317851_'][55]($skipDbTask,$customerMode):$GLOBALS['_2103317851_'][56](3875,4779);}$this->RIGHTS=$GLOBALS['_2103317851_'][57]($rights);}public function canAction($action){if(false !== $GLOBALS['_2103317851_'][58]($action,$this->RIGHTS)){return true;}if(false !== $GLOBALS['_2103317851_'][59](Model_Db_Backend_Task::ACTION_CAN_ALL,$this->RIGHTS)){return true;}return false;}}