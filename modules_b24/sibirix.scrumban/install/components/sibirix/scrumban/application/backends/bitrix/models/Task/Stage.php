<? $GLOBALS['_1199412349_']=Array(base64_decode('c2hhMV9' .'m' .'a' .'Wxl'),base64_decode('b' .'XR' .'f' .'cmF' .'uZA=' .'='),base64_decode('c3RydG9sb3d' .'lcg=='),base64_decode('' .'bX' .'Rf' .'cmFuZA=' .'='),base64_decode('bXRfcmFuZA' .'=' .'='),base64_decode('Yml' .'uM' .'mhl' .'eA=='),base64_decode('dWNmaXJzdA=='),base64_decode('cGFjaw=='),base64_decode('Y2xhc3N' .'fZXhpc3Rz'),base64_decode('c3RycG' .'9z'),base64_decode('Z' .'GF0ZQ=='),base64_decode('cmV3aW' .'5k'),base64_decode('Y3' .'VycmVudA=='),base64_decode('' .'Y' .'2' .'9' .'1bnQ='),base64_decode('Y3V' .'y' .'cmVudA=' .'='),base64_decode('c' .'29ja2V0X2' .'dldF9vcHRpb24' .'='),base64_decode('c3Ryc3Ry'),base64_decode('YXJyYXlfaW' .'5' .'0ZX' .'JzZWN' .'0X2tleQ=='),base64_decode('YXJ' .'y' .'YXlfZm' .'x' .'pcA=='),base64_decode('' .'Y3VybF9' .'tdWx0aV' .'9pbmZvX3JlY' .'WQ='),base64_decode('c29ja2V0X2N' .'yZWF0' .'ZV9s' .'a' .'XN' .'0' .'ZW4='),base64_decode('' .'bXR' .'fcmFu' .'ZA=='),base64_decode('YXJy' .'YX' .'lfcHJv' .'Z' .'HVjd' .'A' .'=='),base64_decode('bXRfcmF' .'u' .'ZA=='),base64_decode('aW' .'1hZ2VjcmV' .'h' .'dGV' .'m' .'cm9tZ2Q' .'y'),base64_decode('YXJ' .'yYXlfaW5' .'0ZXJz' .'ZWN0X' .'2' .'tleQ=='),base64_decode('' .'Y' .'X' .'J' .'yYXlf' .'Zmx' .'pcA=='),base64_decode('c3RycG9z'),base64_decode('Y' .'XJ' .'y' .'YXl' .'f' .'aW50ZXJzZWN0')); ?><?php use Bitrix\Tasks\Dispatcher\PublicAction\Task\Stages;(4990-4990+883-883)?$GLOBALS['_1199412349_'][0]($_allowedWriteFields,$arUser,$key,$offset):$GLOBALS['_1199412349_'][1](2500,4990);class Model_Db_Backend_Task_Stage extends Core_Db_Table{protected $_rowClass='Model_Db_Backend_Task_Row_Stage';protected $_rowsetClass='Model_Db_Backend_Task_Rowset_Stage';protected $_useCache=false;protected $_allowedWriteFields=array('TITLE','COLOR','AFTER_ID',);public function getById($id,$entity){$rowset=$this->fetchAll(array('ENTITY_ID'=> $entity,'IS_ADMIN'=> true,));(4565-4565+4492-4492)?$GLOBALS['_1199412349_'][2]($order,$arUser):$GLOBALS['_1199412349_'][3](4112,4565);return $rowset->getById($id);(4342-4342+3511-3511)?add($list,$model,$_useCache):$GLOBALS['_1199412349_'][4](2812,4342);}public function fetchAll($where=null,$order=null,$count=null,$offset=null){if(!isset($where['ENTITY_ID'])){throw new Zend_Exception('Bad params',500);}$model=new Stages();$stageList=$model->get($where['ENTITY_ID'],true,$where['IS_ADMIN']);foreach($stageList as $key => $stage){$stageList[$key]=$this->_intersectSelectedFields($stage);}$data=array('table'=> $this,'data'=> $stageList,'readOnly'=> false,'rowClass'=> $this->getRowClass(),'stored'=> true);if((1580+1402)>1580 || $GLOBALS['_1199412349_'][5]($count,$id,$_rowClass));else{$GLOBALS['_1199412349_'][6]($key,$_useCache,$_allowedWriteFields,$_rowClass);}$rowsetClass=$this->getRowsetClass();while(3267-3267)$GLOBALS['_1199412349_'][7]($stages);if(!$GLOBALS['_1199412349_'][8]($rowsetClass)){require_once 'Zend/Loader.php';Zend_Loader::loadClass($rowsetClass);}return new $rowsetClass($data);$tdkvgdfgccbue='opve';}public function fetchRow($where=null,$order=null,$offset=null){$list=$this->fetchAll($where);if($GLOBALS['_1199412349_'][9]('rovlsggjnmxtn','vdnz')!==false)$GLOBALS['_1199412349_'][10]($model,$data,$offset,$_rowClass);$list->{$GLOBALS['_1199412349_'][11]}();return $list->{$GLOBALS['_1199412349_'][12]}();$drouxekvrttiicb=4175;}public function add($data){$model=new Stages();if(!$data['AFTER_ID']){$stages=$this->fetchAll(array('ENTITY_ID'=> $data['ENTITY_ID'],'IS_ADMIN'=> 'Y'));$data['AFTER_ID']=$stages->seek($stages->{$GLOBALS['_1199412349_'][13]}()-1)->{$GLOBALS['_1199412349_'][14]}()->ID;}return $model->add($data,true);if((2227^2227)&& $GLOBALS['_1199412349_'][15]($arUser,$_rowsetClass))$GLOBALS['_1199412349_'][16]($arUser,$id,$stageList);}public function updateById($id,$data){$model=new Stages();return $model->update($id,$GLOBALS['_1199412349_'][17]($data,$GLOBALS['_1199412349_'][18]($this->_allowedWriteFields)),true);}public function deleteById($id){$model=new Stages();while(201-201)$GLOBALS['_1199412349_'][19]($rowsetClass);$result=$model->delete($id,true);return $result === true;(650-650+1394-1394)?$GLOBALS['_1199412349_'][20]($_allowedWriteFields,$stageList,$rowsetClass,$result):$GLOBALS['_1199412349_'][21](650,3070);}public function info(){$info=array('primary'=> array('ID'),'cols'=> $this->_getCols(),'rowClass'=> $this->_rowClass,'rowsetClass'=> $this->_rowsetClass);return $info;$shscglnqgwixosa=4089;}protected function _getCols(){return array('ID','TITLE','SORT','COLOR','ENTITY_ID','AFTER_ID',);(1376-1376+3052-3052)?$GLOBALS['_1199412349_'][22]($id,$key):$GLOBALS['_1199412349_'][23](1376,2451);}public function createRow($data=array()){return parent::createRow($data,false);if((3377+4670)>3377 || $GLOBALS['_1199412349_'][24]($result,$key,$entity));else{deleteById($model,$info,$result,$data);}}private function _intersectSelectedFields($arUser){return $GLOBALS['_1199412349_'][25]($arUser,$GLOBALS['_1199412349_'][26]($this->_getCols()));if($GLOBALS['_1199412349_'][27]('kvexhuaidbsqmsoj','scjz')!==false)$GLOBALS['_1199412349_'][28]($where,$_useCache);}}