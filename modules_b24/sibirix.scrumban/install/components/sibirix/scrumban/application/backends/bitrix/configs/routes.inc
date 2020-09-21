<?php

return array(
    'routes' => array(
        'task-view-kp' => array(
            'route' => '/company/personal/user/:userId/tasks/task/view/:taskId/',
        ),
        'lead-view-kp' => array(
            'route' => '/crm/lead/show/#ID#/',
        ),
        'deal-view-kp' => array(
            'route' => '/crm/deal/show/#ID#/',
        ),
        'system-workgroup-settings' => array(
            'route' => '/workgroups/group/:projectId/',
        ),
        'projects-projectInvite' => array(
            'route' => '/workgroups/group/:projectId/edit/?tab=invite&IFRAME=Y&SONET=Y'
        ),
        'user-profile-24' => array(
            'route'    => '/company/personal/user/#id#/',
            'defaults' => array(
                'module'     => 'local',
                'controller' => 'auth',
                'action'     => 'index'
            )
        ),
    ),
);
