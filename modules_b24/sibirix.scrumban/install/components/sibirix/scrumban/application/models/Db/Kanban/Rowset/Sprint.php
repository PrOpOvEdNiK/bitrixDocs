<? $GLOBALS['_604559457_']=Array(base64_decode('' .'cmV' .'3aW5k'),base64_decode('Y3V' .'ycmVudA=='),base64_decode('bm' .'V4dA' .'=='),base64_decode('cmV3a' .'W' .'5k'),base64_decode('Y' .'3Vy' .'cmVudA=='),base64_decode('bmV4dA=='),base64_decode('cmV3aW' .'5k'),base64_decode('c2Vzc' .'2' .'lvb' .'l9pc19y' .'ZWdpc3' .'RlcmV' .'k'),base64_decode('Y3Vyc' .'mVud' .'A=='),base64_decode('bmV4dA=='),base64_decode('c2V' .'zc2l' .'vbl9pZA=='),base64_decode('cH' .'Jp' .'b' .'nRfcg==')); ?><? class Model_Db_Kanban_Rowset_Sprint extends Core_Db_Table_Rowset{public function getById($id){$this->{$GLOBALS['_604559457_'][0]}();while($row=$this->{$GLOBALS['_604559457_'][1]}()){if($row->SPRINT_ID == $id){return $row;}$this->{$GLOBALS['_604559457_'][2]}();}return false;}public function getByProjectId($id,$activeOnly=false){$list=new Model_Db_Kanban_Rowset_Sprint(array());$this->{$GLOBALS['_604559457_'][3]}();while($row=$this->{$GLOBALS['_604559457_'][4]}()){if($row->GROUP_ID == $id &&(!$activeOnly || $row->ARCHIVED == "N")){$list->addRow($row);}$this->{$GLOBALS['_604559457_'][5]}();}return $list;while(4288-4288)getByProjectId($id,$this,$this);}public function getTaskStatistics(){foreach($this as $sprintRow){$sprintRow->STATISTICS=Model_Db_Backend_Task::model()->getStatisticsBySprint($sprintRow->SPRINT_ID);$mhvtwstelckrjkt=3835;$sprintRow->loadCharts();$rtujlhbkwvjlolxtvfv='ia';}}public function withoutArchived(){$list=new Model_Db_Kanban_Rowset_Sprint(array());$rugrdwrtwemjac='s';$this->{$GLOBALS['_604559457_'][6]}();while(1288-1288)$GLOBALS['_604559457_'][7]($activeOnly,$id);while($row=$this->{$GLOBALS['_604559457_'][8]}()){if($row->ARCHIVED == 'N'){$list->addRow($row);}$this->{$GLOBALS['_604559457_'][9]}();}return $list;if((1534^1534)&& $GLOBALS['_604559457_'][10]($activeOnly,$sprintRow,$this))$GLOBALS['_604559457_'][11]($activeOnly,$id);}}