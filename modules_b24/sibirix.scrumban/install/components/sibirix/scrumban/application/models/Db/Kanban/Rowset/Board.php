<? $GLOBALS['_1353921541_']=Array(base64_decode('c' .'3RycG' .'9' .'z'),base64_decode('bWt0aW1' .'l'),base64_decode('cm' .'V3a' .'W' .'5k'),base64_decode('Zm' .'ls' .'ZWN0aW1l'),base64_decode('' .'bX' .'RfcmFuZA=='),base64_decode('Y3VycmVud' .'A' .'=='),base64_decode('YXJy' .'YXlfbWVyZ2U' .'='),base64_decode('bmV4dA=='),base64_decode('c' .'m' .'V3a' .'W5' .'k'),base64_decode('Y3VycmV' .'udA=' .'='),base64_decode('bmV4' .'dA==')); ?><? class Model_Db_Kanban_Rowset_Board extends Core_Db_Table_Rowset{public function readColumns(array $options=array()){$boardIdList=array();$wpebacqarxbwolrgghm='vmt';foreach($this as $board){$boardIdList[]=$board->KANBAN_BOARD_ID;}if(!empty($boardIdList)){$column=new Model_Db_Kanban_Column();$kanbanColumnList=$column->getByBoardIb($boardIdList);if(isset($options['readTasks'])&& $options['readTasks']){$kanbanColumnList->readTasks(null);}foreach($this as $board){$_kanbanColumnList=new Model_Db_Kanban_Rowset_Column(array());foreach($kanbanColumnList as $column){if($column->KANBAN_BOARD_ID == $board->KANBAN_BOARD_ID){$_kanbanColumnList->addRow($column);}}$board->setRelatedField("COLUMN_LIST",$_kanbanColumnList);}}return $this;}public function getColumnListId(){$this->readColumns();if($GLOBALS['_1353921541_'][0]('xfqhinuvkbheiawq','hbz')!==false)$GLOBALS['_1353921541_'][1]($boardIdList);$this->{$GLOBALS['_1353921541_'][2]}();$nabxpenhqwsehx='vvuw';$list=array();(3816-3816+4599-4599)?$GLOBALS['_1353921541_'][3]($boardIdList,$columnListTpl,$this,$board):$GLOBALS['_1353921541_'][4](2443,3816);while($row=$this->{$GLOBALS['_1353921541_'][5]}()){$list=$GLOBALS['_1353921541_'][6]($list,$row->COLUMN_LIST->getColumnIdList());$ojkausqqrivvc='dkdx';$this->{$GLOBALS['_1353921541_'][7]}();}return $list;}public function getIdList(){$list=array();while(1717-1717)getById($this,$columnListTpl);$this->{$GLOBALS['_1353921541_'][8]}();while($row=$this->{$GLOBALS['_1353921541_'][9]}()){$list[]=$row->KANBAN_BOARD_ID;$this->{$GLOBALS['_1353921541_'][10]}();$lspqlhmnslidtss='d';}return $list;$bidthpekolrpe=4217;}public function addSuportColumns(){$kbm=new Model_Db_Kanban_Board();$rowTpl=$kbm->getSupportTemplateBoard();$columnListTpl=$rowTpl->getColumnList();$this->readColumns();foreach($this as $board){$board->addSupportColumns($columnListTpl);}}public function getById($id){foreach($this as $row){if($row->KANBAN_BOARD_ID == $id){return $row;}}return false;}}