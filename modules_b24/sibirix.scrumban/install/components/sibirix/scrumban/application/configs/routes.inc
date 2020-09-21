<?php

return array(
    'routes' => array(
        'index-index'               => array(
            'route'    => '/index/*/',
            'defaults' => array(
                'controller' => 'index',
                'action'     => 'index'
            )
        ),
        'index-all'               => array(
            'route'    => '/all/*/',
            'defaults' => array(
                'controller' => 'index',
                'action'     => 'all'
            )
        ),
        'redirect-301-index-all'               => array(
            'route'    => '/index/all/*/',
            'defaults' => array(
                'controller' => 'index',
                'action'     => 'all',
                '?redirect301?' => 'index-all'
            )
        ),
        'index-loadBoard'         => array(
            'route'    => '/index/load-board/*/',
            'defaults' => array(
                'controller' => 'index',
                'action'     => 'load-board'
            )
        ),
        'task-findOne'              => array(
            'route'    => '/task/find/kanbanBoardTaskId/:kanbanBoardTaskId/*/',
            'defaults' => array(
                'controller' => 'task',
                'action'     => 'find',
            ),
        ),
        'task-findAll'              => array(
            'route'    => '/task/find/*/',
            'defaults' => array(
                'controller' => 'task',
                'action'     => 'find',
            ),
        ),
        'task-update'               => array(
            'route'    => '/task/save/*/',
            'defaults' => array(
                'controller' => 'task',
                'action'     => 'save',
            ),
        ),
        'task-saveField'               => array(
            'route'    => '/task/save-field/*/',
            'defaults' => array(
                'controller' => 'task',
                'action'     => 'save-field',
            ),
        ),
        'task-massArchivate'        => array(
            'route'    => '/task/mass-archivate/*/',
            'defaults' => array(
                'controller' => 'task',
                'action'     => 'mass-archivate',
            ),
        ),
        'task-massColumnChange'        => array(
            'route'    => '/task/mass-column-change/*/',
            'defaults' => array(
                'controller' => 'task',
                'action'     => 'mass-column-change',
            ),
        ),
        'task-create'               => array(
            'route'    => '/task/save/*/',
            'defaults' => array(
                'controller' => 'task',
                'action'     => 'save',
            ),
        ),
        'task-destroy'              => array(
            'route'    => '/task/destroy/*/',
            'defaults' => array(
                'controller' => 'task',
                'action'     => 'destroy',
            ),
        ),
        'task-allUpdate'            => array(
            'route'    => '/task/all-update/*/',
            'defaults' => array(
                'controller' => 'task',
                'action'     => 'all-update',
            ),
        ),
        'task-accompliceAdd'        => array(
            'route'    => '/task/accomplice-add/*/',
            'defaults' => array(
                'controller' => 'task',
                'action'     => 'accomplice-add',
            ),
        ),
        'task-accompliceDestroy'    => array(
            'route'    => '/task/accomplice-destroy/*/',
            'defaults' => array(
                'controller' => 'task',
                'action'     => 'accomplice-destroy',
            ),
        ),
        'task-watcherAdd'           => array(
            'route'    => '/task/watcher-add/*/',
            'defaults' => array(
                'controller' => 'task',
                'action'     => 'watcher-add',
            ),
        ),
        'task-watcherDestroy'       => array(
            'route'    => '/task/watcher-destroy/*/',
            'defaults' => array(
                'controller' => 'task',
                'action'     => 'watcher-destroy',
            ),
        ),
        'task-workPlanAdd'          => array(
            'route'    => '/task/add-to-work-plan/*/',
            'defaults' => array(
                'controller' => 'task',
                'action'     => 'add-to-work-plan',
            ),
        ),
        'task-workPlanRemove'       => array(
            'route'    => '/task/remove-from-work-plan/*/',
            'defaults' => array(
                'controller' => 'task',
                'action'     => 'remove-from-work-plan',
            ),
        ),
        'task-elapsedTimeCreate'    => array(
            'route'    => '/task/elapsed-time-add/*/',
            'defaults' => array(
                'controller' => 'task',
                'action'     => 'elapsed-time-add',
            ),
        ),
        'task-elapsedTimeUpdate'    => array(
            'route'    => '/task/elapsed-time-update/*/',
            'defaults' => array(
                'controller' => 'task',
                'action'     => 'elapsed-time-update',
            ),
        ),
        'task-elapsedTimeDestroy'   => array(
            'route'    => '/task/elapsed-time-destroy/*/',
            'defaults' => array(
                'controller' => 'task',
                'action'     => 'elapsed-time-destroy',
            ),
        ),
        'task-setDodStatus'         => array(
            'route'    => '/task/set-dod-status/*/',
            'defaults' => array(
                'controller' => 'task',
                'action'     => 'set-dod-status',
            ),
        ),
        'task-getFile'              => array(
            'route'    => '/task/get-file/:fileId',
            'defaults' => array(
                'controller' => 'task',
                'action'     => 'get-file',
            ),
        ),
        'task-moveToBoard'          => array(
            'route'    => '/task/move-to-board/*/',
            'defaults' => array(
                'controller' => 'task',
                'action'     => 'move-to-board',
            ),
        ),
        'task-startTimer'          => array(
            'route'    => '/task/timer-start/*/',
            'defaults' => array(
                'controller' => 'task',
                'action'     => 'timer-start',
            ),
        ),
        'task-pauseTimer'          => array(
            'route'    => '/task/timer-pause/*/',
            'defaults' => array(
                'controller' => 'task',
                'action'     => 'timer-pause',
            ),
        ),
        'task-supposeState'          => array(
            'route'    => '/task/suppose-state/*/',
            'defaults' => array(
                'controller' => 'task',
                'action'     => 'suppose-state',
            ),
        ),
        'comment-getList'           => array(
            'route'    => '/comment/get-list/*/',
            'defaults' => array(
                'controller' => 'comment',
                'action'     => 'get-list',
            ),
        ),
        'comment-save'              => array(
            'route'    => '/comment/save/*/',
            'defaults' => array(
                'controller' => 'comment',
                'action'     => 'save',
            ),
        ),
        'comment-destroy'           => array(
            'route'    => '/comment/destroy/*/',
            'defaults' => array(
                'controller' => 'comment',
                'action'     => 'destroy',
            ),
        ),
        'comment-fileUpload'           => array(
            'route'    => '/comment/upload/*/',
            'defaults' => array(
                'controller' => 'comment',
                'action'     => 'upload',
            ),
        ),
        'comment-updateViewedTime'           => array(
            'route'    => '/comment/update-viewed-time/*/',
            'defaults' => array(
                'controller' => 'comment',
                'action'     => 'update-viewed-time',
            ),
        ),
        'task-fileUpload'           => array(
            'route'    => '/task/file-upload/*/',
            'defaults' => array(
                'controller' => 'task',
                'action'     => 'file-upload',
            ),
        ),
        'task-filePaste'            => array(
            'route'    => '/task/file-paste/*/',
            'defaults' => array(
                'controller' => 'task',
                'action'     => 'file-paste',
            ),
        ),
        'task-fileDelete'           => array(
            'route'    => '/task/file-delete/*/',
            'defaults' => array(
                'controller' => 'task',
                'action'     => 'file-delete',
            ),
        ),
        'column-findOne'            => array(
            'route'    => '/column/find/kanbanBoardColumnId/:kanbanBoardColumnId/*/',
            'defaults' => array(
                'controller' => 'column',
                'action'     => 'find',
            ),
        ),
        'column-findAll'            => array(
            'route'    => '/column/find/*/',
            'defaults' => array(
                'controller' => 'column',
                'action'     => 'find',
            ),
        ),
        'column-update'             => array(
            'route'    => '/column/save/*/',
            'defaults' => array(
                'controller' => 'column',
                'action'     => 'save',
            ),
        ),
        'column-create'             => array(
            'route'    => '/column/save/*/',
            'defaults' => array(
                'controller' => 'column',
                'action'     => 'save',
            ),
        ),
        'column-destroy'            => array(
            'route'    => '/column/destroy/*/',
            'defaults' => array(
                'controller' => 'column',
                'action'     => 'destroy',
            ),
        ),
        'column-saveTaskSorts'      => array(
            'route'    => '/column/save-task-sorts/*/',
            'defaults' => array(
                'controller' => 'column',
                'action'     => 'save-task-sorts',
            ),
        ),
        'board-findOne'             => array(
            'route'    => '/board/find/kanbanBoardId/:kanbanBoardId/*/',
            'defaults' => array(
                'controller' => 'board',
                'action'     => 'find',
            ),
        ),
        'board-findAll'             => array(
            'route'    => '/board/find/*/',
            'defaults' => array(
                'controller' => 'board',
                'action'     => 'find',
            ),
        ),
        'board-update'              => array(
            'route'    => '/board/save/*/',
            'defaults' => array(
                'controller' => 'board',
                'action'     => 'save',
            ),
        ),
        'board-create'              => array(
            'route'    => '/board/save/*/',
            'defaults' => array(
                'controller' => 'board',
                'action'     => 'save',
            ),
        ),
        'board-destroy'             => array(
            'route'    => '/board/destroy/*/',
            'defaults' => array(
                'controller' => 'board',
                'action'     => 'destroy',
            ),
        ),
        'board-saveSettings'        => array(
            'route'    => '/board/save-settings/kanbanBoardId/:kanbanBoardId/*/',
            'defaults' => array(
                'controller' => 'board',
                'action'     => 'save-settings',
            ),
        ),
        'board-archiveList'         => array(
            'route'    => '/board/archive-list/kanbanBoardId/:kanbanBoardId/*/',
            'defaults' => array(
                'controller' => 'board',
                'action'     => 'archive-list',
            ),
        ),
        'board-getArchivedTask'     => array(
            'route'    => '/board/get-archived-task/kanbanBoardId/:kanbanBoardId/backendTaskId/:backendTaskId/',
            'defaults' => array(
                'controller' => 'board',
                'action'     => 'get-archived-task',
            ),
        ),
        'board-getUserList'     => array(
            'route'    => '/board/get-user-list/',
            'defaults' => array(
                'controller' => 'board',
                'action'     => 'get-user-list',
            ),
        ),
        'planning-index'            => array(
            'route'    => '/planning/project/:projectId/*/',
            'defaults' => array(
                'controller' => 'planning',
                'action'     => 'index',
            ),
        ),
        'redirect-301-planning-index'            => array(
            'route'    => '/planning/index/project/:projectId/*/',
            'defaults' => array(
                'controller' => 'planning',
                'action'     => 'index',
                '?redirect301?' => 'planning-index'
            ),
        ),
        'planning-sprint'            => array(
            'route'    => '/planning/project/:projectId/sprint/:sprintId/*/',
            'defaults' => array(
                'controller' => 'planning',
                'action'     => 'index',
            ),
        ),
        'redirect-301-planning-sprint'            => array(
            'route'    => '/planning/index/project/:projectId/sprint/:sprintId/*/',
            'defaults' => array(
                'controller' => 'planning',
                'action'     => 'index',
                '?redirect301?' => 'planning-sprint'
            ),
        ),
        'planning-taskList'         => array(
            'route'    => '/planning/task-list/',
            'defaults' => array(
                'controller' => 'planning',
                'action'     => 'task-list'
            ),
        ),
        'planning-updateSorts'      => array(
            'route'    => '/planning/save-task-sorts/*/',
            'defaults' => array(
                'controller' => 'planning',
                'action'     => 'update-sorts',
            ),
        ),
        'planning-moveToSprint'     => array(
            'route'    => '/planning/move-to-sprint/*/',
            'defaults' => array(
                'controller' => 'planning',
                'action'     => 'move-to-sprint',
            ),
        ),
        'project-index'             => array(
            'route'    => '/index/project/:projectId/*/',
            'defaults' => array(
                'controller' => 'index',
                'action'     => 'index'
            ),
        ),
        'redirect-301-project-index'             => array(
            'route'    => '/index/index/project/:projectId/*/',
            'defaults' => array(
                'controller' => 'index',
                'action'     => 'index',
                '?redirect301?'    => 'project-index'
            ),
        ),
        'sprint-index'              => array(
            'route'    => '/index/sprint/:sprintId/*/',
            'defaults' => array(
                'controller' => 'index',
                'action'     => 'index',
            ),
        ),
        'redirect-301-sprint-index'              => array(
            'route'    => '/index/index/sprint/:sprintId/*/',
            'defaults' => array(
                'controller' => 'index',
                'action'     => 'index',
                '?redirect301?'    => 'sprint-index'
            ),
        ),
        'sprint-findOne'            => array(
            'route'    => '/sprint/find/sprintId/:sprintId/*/',
            'defaults' => array(
                'controller' => 'sprint',
                'action'     => 'find',
            ),
        ),
        'sprint-findActive'            => array(
            'route'    => '/sprint/find-active/',
            'defaults' => array(
                'controller' => 'sprint',
                'action'     => 'find-active',
            ),
        ),
        'sprint-findAll'            => array(
            'route'    => '/sprint/find/*/',
            'defaults' => array(
                'controller' => 'sprint',
                'action'     => 'find',
            ),
        ),
        'sprint-update'             => array(
            'route'    => '/sprint/save/*/',
            'defaults' => array(
                'controller' => 'sprint',
                'action'     => 'save',
            ),
        ),
        'sprint-setName'             => array(
            'route'    => '/sprint/set-name/*/',
            'defaults' => array(
                'controller' => 'sprint',
                'action'     => 'set-name',
            ),
        ),
        'sprint-create'             => array(
            'route'    => '/sprint/save/*/',
            'defaults' => array(
                'controller' => 'sprint',
                'action'     => 'save',
            ),
        ),
        'sprint-destroy'            => array(
            'route'    => '/sprint/destroy/*/',
            'defaults' => array(
                'controller' => 'sprint',
                'action'     => 'destroy',
            ),
        ),
        'sprint-getChartData'            => array(
            'route'    => '/sprint/get-chart-data/*/',
            'defaults' => array(
                'controller' => 'sprint',
                'action'     => 'get-chart-data',
            ),
        ),
        'sprint-moveTasks'          => array(
            'route'    => '/sprint/move-tasks/*/',
            'defaults' => array(
                'controller' => 'sprint',
                'action'     => 'move-tasks',
            ),
        ),
        'sprint-archive'          => array(
            'route'    => '/sprint/archive/*/',
            'defaults' => array(
                'controller' => 'sprint',
                'action'     => 'archive',
            ),
        ),
        'checklist-update'          => array(
            'route'    => '/checklist/save/checklistItemId/:checklistItemId/*/',
            'defaults' => array(
                'controller' => 'checklist',
                'action'     => 'save',
            ),
        ),
        'checklist-create'          => array(
            'route'    => '/checklist/save/*/',
            'defaults' => array(
                'controller' => 'checklist',
                'action'     => 'save',
            ),
        ),
        'checklist-destroy'         => array(
            'route'    => '/checklist/destroy/*/',
            'defaults' => array(
                'controller' => 'checklist',
                'action'     => 'destroy',
            ),
        ),
        'checklist-convert'         => array(
            'route'    => '/checklist/convert/*/',
            'defaults' => array(
                'controller' => 'checklist',
                'action'     => 'convert',
            ),
        ),
        'checklist-saveNew'         => array(
            'route'    => '/checklist/save-new/*/',
            'defaults' => array(
                'controller' => 'checklist',
                'action'     => 'save-new',
            ),
        ),
        'checklist-getList' => array(
            'route'    => '/checklist/getlist/*/',
            'defaults' => array(
                'controller' => 'checklist',
                'action'     => 'get-list',
            ),
        ),
        'label-create'              => array(
            'route'    => '/label/save/*/',
            'defaults' => array(
                'controller' => 'label',
                'action'     => 'save',
            ),
        ),
        'label-destroy'             => array(
            'route'    => '/label/destroy/*/',
            'defaults' => array(
                'controller' => 'label',
                'action'     => 'destroy',
            ),
        ),
        'label2task-create'         => array(
            'route'    => '/label2task/save/*/',
            'defaults' => array(
                'controller' => 'label2task',
                'action'     => 'save',
            ),
        ),
        'label2task-destroy'        => array(
            'route'    => '/label2task/destroy/*/',
            'defaults' => array(
                'controller' => 'label2task',
                'action'     => 'destroy',
            ),
        ),
        'dodCheckList-create'       => array(
            'route'    => '/dod/add-check/*/',
            'defaults' => array(
                'controller' => 'dod',
                'action'     => 'add-check',
            ),
        ),
        'dodCheckList-destroy'      => array(
            'route'    => '/dod/destroy-check/*/',
            'defaults' => array(
                'controller' => 'dod',
                'action'     => 'destroy-check',
            ),
        ),
        'dodList-create'            => array(
            'route'    => '/dod/save/*/',
            'defaults' => array(
                'controller' => 'dod',
                'action'     => 'save',
            ),
        ),
        'dodList-update'            => array(
            'route'    => '/dod/save/dodId/:dodId/*/',
            'defaults' => array(
                'controller' => 'dod',
                'action'     => 'save',
            ),
        ),
        'dodList-destroy'           => array(
            'route'    => '/dod/destroy/*/',
            'defaults' => array(
                'controller' => 'dod',
                'action'     => 'destroy',
            ),
        ),
        /* Projects board routes */
        'projects-index'            => array(
            'route'    => '/projects/*/',
            'defaults' => array(
                'controller' => 'projects',
                'action'     => 'index',
            ),
        ),
        'projects-syncAll'            => array(
            'route'    => '/projects-sync-all/',
            'defaults' => array(
                'controller' => 'projects',
                'action'     => 'sync-all',
            ),
        ),
        'redirect-301-projects-index'            => array(
            'route'    => '/projects/index/*/',
            'defaults' => array(
                'controller' => 'projects',
                'action'     => 'index',
                '?redirect301?' => 'projects-index'
            ),
        ),
        'projects-update'           => array(
            'route'    => '/projects/save/*/',
            'defaults' => array(
                'controller' => 'projects',
                'action'     => 'save',
            ),
        ),
        'projects-logoUpload'       => array(
            'route'    => '/projects/logo-upload/*/',
            'defaults' => array(
                'controller' => 'projects',
                'action'     => 'logo-upload'
            ),
        ),
        'projects-userExclude'      => array(
            'route'    => '/projects/user-exclude/:projectId/:userId/',
            'defaults' => array(
                'controller' => 'projects',
                'action'     => 'user-exclude'
            ),
        ),
        'projects-userInvite'      => array(
            'route'    => '/projects/user-invite/:projectId/:userId/',
            'defaults' => array(
                'controller' => 'projects',
                'action'     => 'user-invite'
            ),
        ),
        'projects-loadAdditionalData'      => array(
            'route'    => '/projects/load-additional-data/',
            'defaults' => array(
                'controller' => 'projects',
                'action'     => 'load-additional-data'
            ),
        ),
        /* end of projects board */

        /* Lead board routes */
        'leads-index'            => array(
            'route'    => '/leads/*/',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'lead',
                'action'     => 'index',
            ),
        ),

        'load'         => array(
            'route'    => '/leads/lead/:id/',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'lead',
                'action'     => 'load',
            ),
        ),
        'leads-activity-add'            => array(
            'route'    => '/crm-activity/:entity/add/',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'activity',
                'action'     => 'add',
            ),
        ),

        'leads-activity-save'            => array(
            'route'    => '/crm-activity/:entity/:id/save',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'activity',
                'action'     => 'save',
            ),
        ),

        'leads-activity-postpone'            => array(
            'route'    => '/crm-activity/:entity/:id/postpone/:days',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'activity',
                'action'     => 'postpone',
            ),
        ),

        'leads-activity-finish'            => array(
            'route'    => '/crm-activity/:entity/:id/finish',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'activity',
                'action'     => 'finish',
            ),
        ),
        'leads-activity-remove'            => array(
            'route'    => '/crm-activity/:entity/:id/remove',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'activity',
                'action'     => 'delete',
            ),
        ),
        'leads-activity-load-prev'            => array(
            'route'    => '/crm-activity/:entity/load-prev',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'activity',
                'action'     => 'load-prev',
            ),
        ),

        'leads-test'            => array(
            'route'    => '/leads/test/',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'lead',
                'action'     => 'test',
            ),
        ),
        'leads-delete-all'            => array(
            'route'    => '/leads/delete-leads/',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'lead',
                'action'     => 'delete-leads',
            ),
        ),
        'leads-generate'            => array(
            'route'    => '/leads/generate-leads/*',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'lead',
                'action'     => 'generate-leads',
            ),
        ),
        'activity-generate'            => array(
            'route'    => '/leads/generate-activity/*',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'lead',
                'action'     => 'generate-activity',
            ),
        ),
        'activity-delete-all'            => array(
            'route'    => '/leads/delete-activity/',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'lead',
                'action'     => 'delete-activity',
            ),
        ),
        'leads-hideTutorial'            => array(
            'route'    => '/leads/hide-tutorial/',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'lead',
                'action'     => 'hide-tutorial',
            ),
        ),
        'leads-save'            => array(
            'route'    => '/leads/leads/save/*/',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'lead',
                'action'     => 'save',
            ),
        ),
        'leads-set-status'            => array(
            'route'    => '/leads/lead/:id/set-status/:status',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'lead',
                'action'     => 'set-status',
            ),
        ),
        'leads-set-responsible'            => array(
            'route'    => '/leads/lead/:id/set-responsible/:userId',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'lead',
                'action'     => 'set-responsible',
            ),
        ),
        'leads-set-fields'            => array(
            'route'    => '/leads/lead/:id/set-fields/',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'lead',
                'action'     => 'set-fields',
            ),
        ),
        'leads-delete'         => array(
            'route'    => '/leads/lead/:id/delete/',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'lead',
                'action'     => 'delete',
            ),
        ),
        'leads-add'         => array(
            'route'    => '/leads/lead/add/*/',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'lead',
                'action'     => 'add',
            ),
        ),
        'leads-convert'         => array(
            'route'    => '/leads/lead/:id/convert/*/',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'lead',
                'action'     => 'convert',
            ),
        ),
        'leads-loadArchive'         => array(
            'route'    => '/leads/load-archive/',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'lead',
                'action'     => 'load-archive',
            ),
        ),
        'leads-editStart'         => array(
            'route'    => '/leads/edit-start/:id/',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'lead',
                'action'     => 'edit-start',
            ),
        ),
        'leads-editEnd'         => array(
            'route'    => '/leads/edit-end/:id/',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'lead',
                'action'     => 'edit-end',
            ),
        ),
        /* End of leads routes */



        /* start of deals routes */
        'deals-index' => array(
            'route'    => '/deals/*/',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'deal',
                'action'     => 'index',
            ),
        ),
        'deals-hideTutorial'            => array(
            'route'    => '/deals/hide-tutorial/',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'deal',
                'action'     => 'hide-tutorial',
            ),
        ),
        'deals-save'            => array(
            'route'    => '/deals/save/*/',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'deal',
                'action'     => 'save',
            ),
        ),
        'deals-set-status'            => array(
            'route'    => '/deals/deal/:id/set-status/:status',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'deal',
                'action'     => 'set-status',
            ),
        ),
        'deals-set-responsible'            => array(
            'route'    => '/deals/deal/:id/set-responsible/:userId',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'deal',
                'action'     => 'set-responsible',
            ),
        ),
        'deals-set-fields'            => array(
            'route'    => '/deals/deal/:id/set-fields/',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'deal',
                'action'     => 'set-fields',
            ),
        ),
        'deals-delete'         => array(
            'route'    => '/deals/deal/:id/delete/',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'deal',
                'action'     => 'delete',
            ),
        ),
        'deals-loadArchive'         => array(
            'route'    => '/deals/load-archive/',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'deal',
                'action'     => 'load-archive',
            ),
        ),
        'deals-editStart'         => array(
            'route'    => '/deals/edit-start/:id/',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'deal',
                'action'     => 'edit-start',
            ),
        ),
        'deals-editEnd'         => array(
            'route'    => '/deals/edit-end/:id/',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'deal',
                'action'     => 'edit-end',
            ),
        ),
        'deal-load'         => array(
            'route'    => '/deals/deal/:id/',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'deal',
                'action'     => 'load',
            ),
        ),
        'deals-add'         => array(
            'route'    => '/deals/deal/add/*',
            'defaults' => array(
                'module'     => 'crm',
                'controller' => 'deal',
                'action'     => 'add',
            ),
        ),
        /* end of deals routes */



        'projects-reports' => array(
            'route' => '/reports/:projectId/',
            'defaults' => array(
                'controller' => 'reports',
                'action' => 'index'
            )
        ),
        'projects-reports-archive' => array(
            'route' => '/reports/archive/:projectId/',
            'defaults' => array(
                'controller' => 'reports',
                'action' => 'archive'
            )
        ),
        'projects-reports-data' => array(
            'route' => '/reports/:projectId/get-data/',
            'defaults' => array(
                'controller' => 'reports',
                'action' => 'get-data'
            )
        ),
        'projects-reports-archive-data' => array(
            'route' => '/reports/archive/:projectId/get-data/',
            'defaults' => array(
                'controller' => 'reports',
                'action' => 'get-archive-data'
            )
        ),
        'projects-reports-period-stat-export' => array(
            'route' => '/reports/:projectId/period-stat-export/',
            'defaults' => array(
                'controller' => 'reports',
                'action' => 'period-stat-export'
            )
        ),
        'projects-reports-get-act' => array(
            'route' => '/reports/:projectId/get-act/',
            'defaults' => array(
                'controller' => 'reports',
                'action' => 'get-act'
            )
        ),
        'projects-reports-plan-to-fact' => array(
            'route' => '/reports/plan-to-fact/',
            'defaults' => array(
                'controller' => 'reports',
                'action' => 'plan-to-fact'
            )
        ),
        'projects-reports-migrate' => array(
            'route' => '/reports/move-uf-to-kanban/',
            'defaults' => array(
                'controller' => 'reports',
                'action' => 'move-uf-to-kanban'
            )
        ),
        'projects-reports-getTaskDetail' => array(
            'route' => '/reports/get-task-detail/',
            'defaults' => array(
                'controller' => 'reports',
                'action' => 'get-task-detail'
            )
        ),
        'projects-getBalance' => array(
            'route' => '/projects/get-balance/*/',
            'defaults' => array(
                'controller' => 'projects',
                'action' => 'get-balance'
            )
        ),
        /* end of deal board routes */

        'launchpad-search' => array(
            'route' => '/launchpad/search/',
            'defaults' => array(
                'controller' => 'launchpad',
                'action' => 'search',
            ),
        ),

        'debug-exception'           => array(
            'route' => '/error/exception',
        ),
        'user-save' => array(
            'route' => '/user/save/',
            'defaults' => array(
                'module'     => 'local',
                'controller' => 'user',
                'action'     => 'save',
            )
        ),
        'close-crm-notify' => array(
            'route' => '/close-crm-notify/',
            'defaults' => array(
                'controller' => 'index',
                'action' => 'close-crm-notify',
            ),
        ),
        'task-open'        => array(
            'route'    => '/open/:backendId/',
            'defaults' => array(
                'controller' => 'task',
                'action'     => 'open'
            )
        ),

        'close-update-kanban-notify' => array(
            'route'    => '/projects/close-update-kanban/:projectId',
            'defaults' => array(
                'controller' => 'projects',
                'action'     => 'close-update-kanban-notify'
            )
        ),

        'projects-sync-kanban'      => array(
            'route'    => '/projects/sync-kanban/',
            'defaults' => array(
                'controller' => 'projects',
                'action'     => 'sync-kanban'
            ),
        ),

    ),
);
