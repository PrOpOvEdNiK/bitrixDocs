<?php

/**
 * @property Zend_View view
 */
class Zend_View_Helper_InitJs extends Core_View_Helper {
    private $_blocks = array(
        100  => 'libs',
        300  => 'models',
        400  => 'controllers',
        600  => 'app',
        1100 => 'other'
    );

    private $_block_elements_conter = array(
        'libs'        => 0,
        'models'      => 0,
        'controllers' => 0,
        'app'         => 0,
        'other'       => 0
    );

    private $_init = false;

    function initJs() {
        if (!$this->_init) {
            $this->_init = true;

            $this->addFile('libs/base64.min.js', 'libs');
            $this->addFile('libs/jquery.min.js', 'libs');

            $this->addFile('libs/dhtmlx-grid/dhtmlxcommon.js', 'libs');
            $this->addFile('libs/dhtmlx-grid/dhtmlxgrid.js', 'libs');
            $this->addFile('libs/dhtmlx-grid/dhtmlxgridcell.js', 'libs');
            $this->addFile('libs/dhtmlx-grid/dhtmlxtreegrid.js', 'libs');
            $this->addFile('libs/dhtmlx-grid/ext/dhtmlxgrid_drag.js', 'libs');
            $this->addFile('libs/dhtmlx-grid/ext/dhtmlxgrid_keymap_excel.js', 'libs');
            $this->addFile('libs/dhtmlx-grid/ext/dhtmlxgrid_json.js', 'libs');

            if (Model_Options::model()->get('settings.magicHeadScript')->combine) {
                $this->addFile('noConflictStart.js', 'libs');
            }

            $this->addFile('libs/small.plugins.js', 'libs', array('charset' => "UTF-8"));

            $this->addFile('libs/hammer/hammer.min.js', 'libs');
            $this->addFile('libs/hammer/jquery.hammer.min.js', 'libs');

            $this->addFile('libs/jquery-ui.custom.min.js', 'libs', array('charset' => "UTF-8"));
            $this->addFile('libs/jquery-ui/jquery.ui.sortable.js', 'libs');
            $this->addFile('libs/jquery-ui/jquery.ui.resizable.js', 'libs');

            $this->addFile('libs/jquery.form.min.js', 'libs');
            $this->addFile('libs/jquery.timepicker.min.js', 'libs');
            $this->addFile('libs/jquery.scrollto.min.js', 'libs');
            $this->addFile('libs/jquery.chosen.js', 'libs');
            $this->addFile('libs/jquery.mousewheel.min.js', 'libs');
            $this->addFile('libs/jquery.jscrollpane.min.js', 'libs');
            $this->addFile('libs/jquery.tooltip.min.js', 'libs');
            $this->addFile('libs/jquery.uploadify.js', 'libs', array("magic" => false));

            $this->addFile('libs/tinymce/tiny_mce.js', 'libs', array("magic" => false));
            $this->addFile('libs/tinymce/langs/ru.js', 'libs', array("magic" => false));
            $this->addBackendFile('libs/tinymce/plugins/taskmedialibrary/editor_plugin_src.js', 'libs', array("magic" => false));
            $this->addFile('libs/tinymce/plugins/pasteimage/editor_plugin.js', 'libs', array("magic" => false));
            $this->addFile('libs/tinymce/themes/advanced/editor_template.js', 'libs', array("magic" => false));
            $this->addFile('libs/tinymce/plugins/autoresize/editor_plugin.js', 'libs', array("magic" => false));
            $this->addFile('libs/tinymce/plugins/autolink/editor_plugin.js', 'libs', array("magic" => false));
            $this->addFile('libs/tinymce/plugins/lists/editor_plugin.js', 'libs', array("magic" => false));
            $this->addFile('libs/tinymce/plugins/paste/editor_plugin.js', 'libs', array("magic" => false));
            $this->addFile('libs/tinymce/themes/advanced/langs/ru.js', 'libs', array("magic" => false));

            $this->addFile('libs/html5uploader.min.js', 'libs');
            $this->addFile('libs/stacktrace.min.js', 'libs');
            $this->addFile('libs/ZeroClipboard.min.js', 'libs');
            $this->addFile('libs/clipboard.min.js', 'libs');
            $this->addFile('libs/jquery.fancybox.pack.js', 'libs');
            $this->addFile('libs/slick.min.js', 'libs');
            $this->addFile('libs/jquery.menu-aim.js', 'libs');

            $this->addFile('libs/jquery-mvc/jquerymx.custom.js', 'libs');

            $this->addFile('models/Base.js', 'models');

            $this->addFile('models/Kanban/Sprint.js', 'models');
            $this->addFile('models/Kanban/Checklist.js', 'models');
            $this->addFile('models/Kanban/Dodlist.js', 'models');
            $this->addFile('models/Kanban/Dodchecklist.js', 'models');
            $this->addFile('models/Kanban/Label2task.js', 'models');
            $this->addFile('models/Kanban/Label.js', 'models');
            $this->addFile('models/Kanban/User.js', 'models');
            $this->addFile('models/Kanban/ElapsedTime.js', 'models');
            $this->addFile('models/Kanban/Accomplice.js', 'models');
            $this->addFile('models/Kanban/Watcher.js', 'models');
            $this->addFile('models/Kanban/Board.js', 'models');
            $this->addFile('models/Kanban/Column.js', 'models');
            $this->addFile('models/Kanban/Task.js', 'models');
            $this->addFile('models/Kanban/Comment.js', 'models');
            $this->addFile('models/Kanban/Activity.js', 'models');
            $this->addFile('models/Projects/Board.js', 'models');
            $this->addFile('models/Projects/Column.js', 'models');
            $this->addFile('models/Projects/Project.js', 'models');
            $this->addFile('models/Leads/Board.js', 'models');
            $this->addFile('models/Leads/Column.js', 'models');
            $this->addFile('models/Leads/Lead.js', 'models');

            $this->addFile('Controller.js', 'controllers');

            $this->addFile('controllers/Logo.js', 'controllers');
            $this->addFile('controllers/FullScreenButton.js', 'controllers');
            $this->addFile('controllers/Spring.js', 'controllers');
            $this->addFile('controllers/SprintProgressIndicator.js', 'controllers');
            $this->addFile('controllers/TaskGrid.js', 'controllers');
            $this->addFile('controllers/TaskDetails.js', 'controllers');
            $this->addFile('controllers/TextEditor.js', 'controllers');
            $this->addFile('controllers/Alert.js', 'controllers');
            $this->addFile('controllers/Alert/Blocker.js', 'controllers');
            $this->addFile('controllers/Launchpad.js', 'controllers');
            $this->addFile('controllers/KanbanSync.js', 'controllers');
            $this->addFile('controllers/Confirm.js', 'controllers');
            $this->addFile('controllers/Confirm/KanbanSync.js', 'controllers');
            $this->addFile('controllers/Confirm/Medialibrary.js', 'controllers');
            $this->addFile('controllers/Confirm/TasksDelete.js', 'controllers');
            $this->addFile('controllers/Confirm/SprintCharts.js', 'controllers');
            $this->addFile('controllers/Confirm/SupposeChart.js', 'controllers');

            $this->addFile('controllers/Panel.js', 'controllers');
            $this->addFile('controllers/Panel/Column.js', 'controllers');

            $this->addFile('controllers/Column/Abstract.js', 'controllers');
            $this->addFile('controllers/Column/List/Abstract.js', 'controllers');

            $this->addFile('controllers/Popup.js', 'controllers');
            $this->addFile('controllers/Popup/ElapsedTimeAdd.js', 'controllers');
            $this->addFile('controllers/Popup/TaskMenu.js', 'controllers');
            $this->addFile('controllers/Popup/Users.js', 'controllers');
            $this->addFile('controllers/Popup/TopMenu/ProjectSelector.js', 'controllers');
            $this->addFile('controllers/Popup/Task/CreateEvent.js', 'controllers');
            $this->addFile('controllers/Popup/TaskDetails/Priority.js', 'controllers');
            $this->addFile('controllers/Popup/TaskDetails/TaskStatus.js', 'controllers');
            $this->addFile('controllers/Popup/TaskDetails/TaskType.js', 'controllers');
            $this->addFile('controllers/Popup/TaskDetails/TaskType/Short.js', 'controllers');
            $this->addFile('controllers/Popup/TaskDetails/Labels.js', 'controllers');

            $this->addFile('controllers/TaskDetails/Accomplices.js', 'controllers');
            $this->addFile('controllers/TaskDetails/Checklist.js', 'controllers');
            $this->addFile('controllers/TaskDetails/Comments.js', 'controllers');
            $this->addFile('controllers/TaskDetails/Files.js', 'controllers');
            $this->addFile('controllers/TaskDetails/CommentFiles.js', 'controllers');
            $this->addFile('controllers/TaskDetails/Fuckup.js', 'controllers');
            $this->addFile('controllers/TaskDetails/TagEditor.js', 'controllers');
            $this->addFile('controllers/TaskDetails/TimeElapsed.js', 'controllers');
            $this->addFile('controllers/TaskDetails/TimePlanned.js', 'controllers');
            $this->addFile('controllers/TaskDetails/Watchers.js', 'controllers');
            $this->addFile('controllers/TaskDetails/Responsible.js', 'controllers');
            $this->addFile('controllers/TaskDetails/Creator.js', 'controllers');

            $this->addFile('controllers/Kanban/Board.js', 'controllers');
            $this->addFile('controllers/Kanban/PanelsList.js', 'controllers');
            $this->addFile('controllers/Kanban/Task.js', 'controllers');
            $this->addFile('controllers/Kanban/Task/Images.js', 'controllers');
            $this->addFile('controllers/Kanban/Task/Multitask.js', 'controllers');
            $this->addFile('controllers/Kanban/Task/Sibling.js', 'controllers');
            $this->addFile('controllers/Kanban/Task/Timer.js', 'controllers');
            $this->addFile('controllers/Kanban/TaskDetails.js', 'controllers');
            $this->addFile('controllers/Kanban/TaskDetails/Anchors.js', 'controllers');
            $this->addFile('controllers/Kanban/TaskDetails/SiblingsList.js', 'controllers');
            $this->addFile('controllers/Kanban/TaskDetails/SubtasksGrid.js', 'controllers');
            $this->addFile('controllers/Kanban/TaskDetails/Suppose.js', 'controllers');
            $this->addFile('controllers/Kanban/Popup/ColumnMenu.js', 'controllers');
            $this->addFile('controllers/Kanban/Popup/TopMenu/ViewType.js', 'controllers');
            $this->addFile('controllers/Kanban/Popup/TopMenu/BoardOptionsPopup.js', 'controllers');
            $this->addFile('controllers/Kanban/Popup/TopMenu/SprintSelector.js', 'controllers');

            $this->addFile('controllers/Kanban/Confirm/ChangeColumnStatus.js', 'controllers');
            $this->addFile('controllers/Kanban/Confirm/NoColumnsOnBoard.js', 'controllers');
            $this->addFile('controllers/Kanban/Confirm/TimeInputRequired.js', 'controllers');
            $this->addFile('controllers/Kanban/Confirm/UncheckedDods.js', 'controllers');
            $this->addFile('controllers/Kanban/Confirm/TimerConflict.js', 'controllers');

            $this->addFile('controllers/Kanban/Panel/Archive.js', 'controllers');
            $this->addFile('controllers/Kanban/Panel/Filter.js', 'controllers');
            $this->addFile('controllers/Kanban/Panel/Backlog.js', 'controllers');
            $this->addFile('controllers/Kanban/Panel/Backlog/BacklogSprintSelector.js', 'controllers');

            $this->addFile('controllers/Kanban/BoardSettings.js', 'controllers');
            $this->addFile('controllers/Kanban/BoardSettings/ColumnDods.js', 'controllers');
            $this->addFile('controllers/Kanban/BoardSettings/ColumnListSettings.js', 'controllers');
            $this->addFile('controllers/Kanban/BoardSettings/ColumnSettings.js', 'controllers');
            $this->addFile('controllers/Kanban/BoardSettings/CommonDataEditor.js', 'controllers');
            $this->addFile('controllers/Kanban/BoardSettings/MarkersGrid.js', 'controllers');

            $this->addFile('controllers/Kanban/Column/List/Body.js', 'controllers');
            $this->addFile('controllers/Kanban/Column/List/Multitask.js', 'controllers');

            $this->addFile('controllers/Kanban/Column/Header.js', 'controllers');
            $this->addFile('controllers/Kanban/Column/Body.js', 'controllers');
            $this->addFile('controllers/Kanban/Column/ArchiveBody.js', 'controllers');
            $this->addFile('controllers/Kanban/Column/Multitask.js', 'controllers');
            $this->addFile('controllers/Kanban/Column/Vertical.js', 'controllers');
            $this->addFile('controllers/Kanban/TopMenu/SprintDates.js', 'controllers');

            $this->addFile('controllers/Planning/Board.js', 'controllers');
            $this->addFile('controllers/Planning/PacketFormer.js', 'controllers');
            $this->addFile('controllers/Planning/PanelsList.js', 'controllers');
            $this->addFile('controllers/Planning/TaskDetails.js', 'controllers');
            $this->addFile('controllers/Planning/TaskGrid.js', 'controllers');
            $this->addFile('controllers/Planning/Confirm/SprintPacketCreate.js', 'controllers');
            $this->addFile('controllers/Planning/Panel/Sprints.js', 'controllers');
            $this->addFile('controllers/Planning/Panel/Sprints/One.js', 'controllers');
            $this->addFile('controllers/Planning/Panel/TaskDetails.js', 'controllers');

            $this->addBackendFile('controllers/Projects/Popup/Invite.js', 'controllers');
            $this->addBackendFile('controllers/Confirm/UserFields.js', 'controllers');

            $this->addFile('controllers/Projects/Board.js', 'controllers');
            $this->addFile('controllers/Projects/PanelsList.js', 'controllers');
            $this->addFile('controllers/Projects/Panel/ProjectDetails.js', 'controllers');
            $this->addFile('controllers/Projects/Confirm/UserExclude.js', 'controllers');
            $this->addFile('controllers/Projects/Board/HeaderFilter.js', 'controllers');
            $this->addFile('controllers/Projects/Column/Header.js', 'controllers');
            $this->addFile('controllers/Projects/Column/Body.js', 'controllers');
            $this->addFile('controllers/Projects/Project/Members.js', 'controllers');
            $this->addFile('controllers/Projects/Project.js', 'controllers');

            $this->addFile('controllers/Reports/Confirm/Export.js', 'controllers');
            $this->addFile('controllers/Reports/Popup/SprintMenu.js', 'controllers');
            $this->addFile('controllers/Reports/TaskDetails.js', 'controllers');
            $this->addFile('controllers/Reports.js', 'controllers');
            $this->addFile('controllers/ReportsArchive.js', 'controllers');

            $this->addFile('controllers/Leads/Confirm/Convert.js', 'controllers');
            $this->addFile('controllers/Leads/Column/Header.js', 'controllers');
            $this->addFile('controllers/Leads/Column/Body.js', 'controllers');
            $this->addFile('controllers/Leads/Board.js', 'controllers');
            $this->addFile('controllers/Leads/Lead.js', 'controllers');

            $this->addFile('controllers/TotalKanban/Board.js', 'controllers');
            $this->addFile('controllers/TotalKanban/BoardBlock.js', 'controllers');
            $this->addFile('controllers/TotalKanban/PanelsList.js', 'controllers');
            $this->addFile('controllers/TotalKanban/Panel/Filter.js', 'controllers');
            $this->addFile('controllers/TotalKanban/Column/Header.js', 'controllers');
            $this->addFile('controllers/TotalKanban/Column/SubColumn.js', 'controllers');
            $this->addFile('controllers/TotalKanban/Column/List/Body.js', 'controllers');
            $this->addFile('controllers/TimePlannedPicker.js', 'controllers');
            $this->addFile('controllers/SimpleInput.js', 'controllers');

            $this->addFile('controllers/Support/Board.js', 'controllers');
            $this->addFile('controllers/Support/TopMenu/SupportBlock.js', 'controllers');
            $this->addFile('controllers/Support/TopMenu/SupportBlock/Budget.js', 'controllers');

            $this->addBackendFile('controllers/AccessRights.js', 'controllers');
            $this->addBackendFile('scope.js', 'app');

            $this->addFile('plugins.js', 'app');
            $this->addFile('script.js', 'app');

            $this->addFile('Eraser.js', 'app');

            $this->addFile('Application.js', 'app');

            if (Model_Options::model()->get('settings.magicHeadScript')->combine) {
                $this->addFile('noConflictEnd.js', 'other');
            }

            $this->addFile('GridExtends.js', 'other');
        }

        return $this;
    }

    public function _addFileParams($args) {
        $block = 'libs';
        $attributes = array();

        $name = array_shift($args);
        if (count($args)) {
            $attributes = array_shift($args);

            if (is_string($attributes)) {
                $block      = $attributes;
                $attributes = array();

                if (count($args)) {
                    $attributes = array_shift($args);
                }
            }
        }

        $attributes = array_merge($attributes, array("allowDuplicate" => true));

        return array(
            $name,
            $block,
            $attributes
        );
    }

    public function addBackendFile($name, $block, $attributes = array()) {
        list($name, $block, $attributes) = $this->_addFileParams(func_get_args());
        $name = 'backends/' . APPLICATION_BACKEND . '/' . $name;
        $this->addFile($name, $block, $attributes);
    }

    public function addFile($name, $block, $attributes = array()) {

        $type = 'text/javascript';
        $uri  = SCRUMBAN_PATH_STATIC . '/js/' . $name;

        if (APPLICATION_ENV == SCRUMBAN_DEVELOPMENT && file_exists($_SERVER['DOCUMENT_ROOT'] . $uri)) {
            $uri .= '?_=' . filemtime($_SERVER['DOCUMENT_ROOT'] . $uri);
        }

        $this->_addToBlock($block, $uri, $type, $attributes);

        return $this;
    }

    private function _addToBlock($block, $uri, $type, $attributes) {
        $key = array_search($block, $this->_blocks);
        if ($key === false) {
            $block = 'other';
            $key   = array_search($block, $this->_blocks);
        }

        $offset = $key + $this->_block_elements_conter[$block];
        $this->view->headScript()->offsetSetFile($offset, $uri, $type, $attributes);

        $this->_block_elements_conter[$block]++;
    }
}
