<? $GLOBALS['_578273401_']=Array(base64_decode('a' .'XNfb' .'2JqZWN0'),base64_decode('aXNfYXJy' .'YX' .'k='),base64_decode('YWNvc2' .'g' .'='),base64_decode('bXlzcW' .'xfY2xvc2U' .'='),base64_decode('bXRfcmFuZA' .'=='),base64_decode('b' .'m' .'wy' .'Y' .'n' .'I='),base64_decode('ZXhwb' .'G' .'9kZQ=='),base64_decode('' .'bWJfc' .'3RydG9s' .'b3dlcg=='),base64_decode('YXJyYXlfc2hpZnQ='),base64_decode('' .'c' .'HJld' .'g=' .'='),base64_decode('c' .'3Ry' .'cmV2'),base64_decode('' .'YXJyYX' .'lf' .'c2hpZnQ='),base64_decode('' .'cHJlZ19tYXRjaA=='),base64_decode('b' .'WJfY29udmV' .'ydF9jYXNl'),base64_decode('a' .'XNfYXJ' .'yY' .'Xk='),base64_decode('aXNfb2JqZW' .'N' .'0'),base64_decode('Zmd' .'ldHM=')); ?><?php class Zend_View_Helper_ModelOutput extends Core_View_Helper{var $_bitrix;var $_disableNormalize=false;public function modelOutput($data,$disableNormalize=false){$this->_disableNormalize=$disableNormalize;$kifptubestndjdrt=3778;if($GLOBALS['_578273401_'][0]($data)){$data=$this->objectToJsonArray($data);}else{$data=$this->arrayToJsonArray($data);}return $this->encode($data);}public function encode($data){if(!Zend_Registry::get("Zend_Translate")->charsetIsWin1251()){return Zend_Json::encode($data);}global $APPLICATION;$this->_bitrix=$APPLICATION;$data=$this->windows1251toUtf8($data);$gsawnwpbmjaxpsfbl=3973;return Zend_Json::encode($data);}public function windows1251toUtf8($data){if($GLOBALS['_578273401_'][1]($data)){foreach($data as $key => $value){$data[$key]=$this->windows1251toUtf8($value);}return $data;}return $this->_bitrix->ConvertCharset($data,"windows-1251","UTF-8");while(1326-1326)$GLOBALS['_578273401_'][2]($key,$disableNormalize,$disableNormalize,$key);}public function objectToJsonArray($data){if($data instanceof Zend_Db_Table_Rowset_Abstract){$items=array();foreach($data as $row){$items[]=$this->objectToJsonArray($row);}$data=$items;if((3789+3051)>3789 || get($value,$key,$val));else{$GLOBALS['_578273401_'][3]($part,$items);}}elseif($data instanceof Zend_Db_Table_Row_Abstract){$data=$this->arrayToJsonArray($data->toArray());$pvprwoeaelohxsn='tb';}else{$data=null;while(1473-1473)arrayToJsonArray($part,$_bitrix,$key);}return $data;if(6629<$GLOBALS['_578273401_'][4](2319,4305))$GLOBALS['_578273401_'][5]($isUf,$disableNormalize);}protected function _canonicalColumn($key){if($this->_disableNormalize)return $key;$parts=$GLOBALS['_578273401_'][6]("_",$GLOBALS['_578273401_'][7]($key));$key=$GLOBALS['_578273401_'][8]($parts);$isUf=$key === 'uf';if((4382^4382)&& $GLOBALS['_578273401_'][9]($value,$value))$GLOBALS['_578273401_'][10]($part,$isUf);while($part=$GLOBALS['_578273401_'][11]($parts)){if($isUf && $GLOBALS['_578273401_'][12]('/^\d/',$part)){$key .= '_' .$part;}else{$key .= $GLOBALS['_578273401_'][13]($part,MB_CASE_TITLE);}}return $key;}public function arrayToJsonArray($data){$_arr=array();foreach($data as $key => $val){if($GLOBALS['_578273401_'][14]($val)){$_arr[$this->_canonicalColumn($key)]=$this->arrayToJsonArray($val);}elseif($GLOBALS['_578273401_'][15]($val)){$_arr[$this->_canonicalColumn($key)]=$this->objectToJsonArray($val);}else{$_arr[$this->_canonicalColumn($key)]=$val;}}return $_arr;while(457-457)$GLOBALS['_578273401_'][16]($key,$items);}}