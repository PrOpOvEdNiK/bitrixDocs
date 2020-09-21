// jQuery from Bitrix core are loaded
BX.ready(function () {
    var SCRUMBAN = window.scrumban;
    var SITE_DIR = SCRUMBAN.SITE_DIR;
    var SITE_TEMPLATE  = SCRUMBAN.SITE_TEMPLATE ;
    var EXTRANET_SITE_ID = SCRUMBAN.scrumbanPageControllsConfig.EXTRANET_SITE_ID;
    var scrumbanProjectsEnabled = SCRUMBAN.scrumbanPageControllsConfig.SCRUMBAN_PROJECTS_ENABLED;
    var l10n = SCRUMBAN.scrumbanPageControllsConfig.l10n;

    var scrumbanPageControlls = {
        init: function() {
            if (this.isNeedAddWorkgroupLinks()) {
                this.addWorkgroupLinks();
            }

            if (this.isNeedAddTopIcon()) {
                this.addTopIcon();
            }

            if (this.isNeedAddTextLink()) {
                this.addTextLink();
            }

            if (this.isNeedAddTaskButton()) {
                this.addTaskButton();
            }
        },

        /**
         * Надо ли добавлять иконку в верхнее меню
         * @returns {Number|boolean}
         */
        isNeedAddTopIcon: function(){
            var header = document.getElementById('header');
            if (!header) {
                return false;
            }
            var top = header.querySelector('#header-inner .header-logo-block');
            var sc = top.querySelector('.scrumban-head-informers');
            return (top && !sc);
        },

        /**
         * Надо ли добавлять ссылки на Скрамбан внутри битриксовых проектов
         * @returns {boolean}
         */
        isNeedAddWorkgroupLinks: function() {
            return (window.scrumban.scrumbanPageControllsConfig.WORKGROUP_ID !== false);
        },

        /**
         * Надо ли добавлять текстовую ссылку в меню
         * @returns {boolean}
         */
        isNeedAddTextLink: function() {
            var link;
            var leftMenu = document.querySelector('#menu > .menu-favorites');

            if (!leftMenu) {
                leftMenu = document.querySelector('#menu #bx_b24_menu > .menu-favorites');
            }

            if (leftMenu) {
                link = leftMenu.querySelector('a[href*=scrumban]');
                return !link;
            } else {
                var topMenu = document.querySelector('#navigation-block #top-menu-layout #top-menu');
                if (topMenu) {
                    link = topMenu.querySelector('a[href*=scrumban]');
                    return !link;
                }
            }
            return false;
        },

        /**
         * Надо ли добавлять кнопку перехода к задаче в скрамбане
         * @returns {boolean}
         */
        isNeedAddTaskButton: function(){
            return (window.scrumban.scrumbanPageControllsConfig.TASK_ID !== false);
        },

        /**
         * Добавить ссылку на задачу
         */
        addTaskButton: function() {
            var taskId = window.scrumban.scrumbanPageControllsConfig.TASK_ID;

            var url = SITE_DIR + 'scrumban/task/open/backendId/' + taskId;
            var button = document.createElement('a');
            button.setAttribute('class', 'webform-small-button task-list-toolbar-scrumban');
            button.setAttribute('title', l10n['SCRUMBAN_TASK']);
            button.setAttribute('href', url);
            button.innerHTML = '<span class="webform-small-button-left"></span>'
                + '<span class="webform-small-button-icon"></span>'
                + '<span class="webform-small-button-right"></span>';

            var sep = document.createElement('span');
            sep.setAttribute('class', 'task-title-button-separator');

            if (SCRUMBAN.SITE_TEMPLATE == 'bitrix24') {
                var appendTo = document.querySelector('.task-buttons');

                if (!appendTo) {
                    appendTo = document.querySelector('.task-view-buttonset');
                }

                if (!appendTo) {
                    return;
                }

                appendTo.append(button);
                appendTo.append(sep);
            } else {
                var prependTo = document.querySelector('.task-list-toolbar-actions');
                prependTo.prepend(sep);
                prependTo.prepend(button);
            }
        },

        /**
         * Добавить ссылки на проект
         */
        addWorkgroupLinks: function () {
            var i, obj, groupId = window.scrumban.scrumbanPageControllsConfig.WORKGROUP_ID;
            var action = 'append';
            var workgroupLinks = [
                {
                    url:  SITE_DIR + 'scrumban/index/index/project/#groupId#/',
                    text: l10n['SCRUMBAN_TASK_BOARD']
                },
                {
                    url:  SITE_DIR + 'scrumban/planning/index/project/#groupId#/',
                    text: l10n['SCRUMBAN_PLANNING_BOARD']
                }
            ];

            if (SCRUMBAN.SITE_TEMPLATE == 'bitrix24') {
                obj = document.querySelector(".profile-menu-items");
                if (!obj) {
                    obj = document.getElementById("profile-menu-filter");
                }
                if (!obj) {
                    obj = document.querySelector('.profile-menu-items-new .main-buttons-inner-container .main-buttons-item');
                    action = 'after';
                }
            } else {
                obj = document.getElementById("profile-menu-filter");
            }

            if (!obj) {
                return;
            }

            for (i = 0; i < workgroupLinks.length; i++) {
                workgroupLinks[i].url = workgroupLinks[i].url.replace('#groupId#', groupId);
            }

            for (i = 0; i < workgroupLinks.length; i++) {
                obj[action](this.getWorkgroupLink(workgroupLinks[i].url, workgroupLinks[i].text));
            }
        },

        /**
         * Сгенерить ссылку в зависимости от используемого шаблона
         * @param url
         * @param text
         * @returns {string}
         */
        getWorkgroupLink: function(url, text) {
            var link = document.createElement('a');
            link.setAttribute('href', url);
            if (SITE_TEMPLATE == "bitrix24") {
                if (document.querySelector('.profile-menu-items-new')) {
                    // новый шаблон портала
                    link = document.createElement('div');
                    link.innerHTML = '<a class="main-buttons-item-link" href="' + url + '">' +
                        '<span class="main-buttons-item-icon"></span>' +
                        '<span class="main-buttons-item-text">' +
                            '<span class="main-buttons-item-edit-button"></span>' +
                            '<span class="main-buttons-item-text-title">' + text + '</span>' +
                            '<span class="main-buttons-item-drag-button"></span>' +
                            '<span class="main-buttons-item-text-marker"></span>' +
                        '</span>' +
                    '</a>';
                    link.setAttribute('class', 'main-buttons-item');
                    link.setAttribute('data-url', url);
                    link.setAttribute('tabindex', -1);
                    // link.setAttribute('data-link', 'item2');
                } else {
                    link.innerHTML = '<span class="filter-but-left"></span><span class="filter-but-text-block">' + text + '</span>' +
                        '<span class="filter-but-right"></span>';
                    link.setAttribute('class', 'filter-but-wrap');
                }
            } else {
                link.innerHTML = '<span class="profile-menu-item-left"></span><span class="profile-menu-item-text">' + text + '</span>' +
                    '<span class="profile-menu-item-right"></span>';
                link.setAttribute('class', 'profile-menu-item');
            }

            return link;
        },

        /**
         * Добавить иконку в верхнее меню
         */
        addTopIcon: function() {
            var styles = document.createElement('style');
            styles.innerText = '.scrumban-head-informers { padding: 5px 5px 4px; margin-top: 8px; vertical-align: top; border: 1px solid transparent; border-radius: 2px; display:inline-block; visibility: visible; }.scrumban-head-informers:hover { border-color: #7c8491; border-top-color: #393d45; border-left-color: #393d45;  background-color: #424750; }';
            document.querySelector('head').append(styles);

            var image = '<img src="data:image/gif;base64,R0lGODlhEwAPAIABAKSst////yH5BAEAAAEALAAAAAATAA8AAAIrhI+pyxf/AIwzGHul05lr/G2eVY1dmIGYapbS1IrlLMMz3OTVzvf+DwwUAAA7" alt="">';
            var url = SITE_DIR + 'scrumban/';
            var dir = window.location.pathname;
            var parts = dir.match(/\/workgroups\/group\/(\d*)/i);
            if (parts && parts.length && parts[1]) {
                if (typeof scrumbanProjectsEnabled !== 'undefined') {
                    parts[1] = parseInt(parts[1], 10);
                    if (scrumbanProjectsEnabled.indexOf(parts[1]) !== -1) {
                        url = SITE_DIR + 'scrumban/index/index/project/' + parts[1];
                    }
                } else {
                    url = SITE_DIR + 'scrumban/index/index/project/' + parts[1];
                }
            }

            var header = document.getElementById('header-inner');
            var text = document.createElement('a');
            text.setAttribute('href', url);
            text.setAttribute('title', l10n['SCRUMBAN_TASK_BOARD']);
            text.setAttribute('class', 'scrumban-head-informers');
            text.innerHTML = image;
            var top = header.querySelector('.header-logo-block .header-informers-wrap');
            if (!top) {
                top = header.querySelector('.header-logo-block');
            }
            top.append(text);
        },

        /**
         * Добавить текстовую ссылку в меню
         * @returns {boolean}
         */
        addTextLink: function () {
            var after, block;
            var url = SITE_DIR + 'scrumban/index/index/';
            var dir = window.location.pathname;
            var parts = dir.match(/\/workgroups\/group\/(\d*)/i);
            if (parts && parts.length && parts[1]) {
                if (typeof scrumbanProjectsEnabled !== 'undefined') {
                    parts[1] = parseInt(parts[1], 10);
                    if (scrumbanProjectsEnabled.indexOf(parts[1]) !== -1) {
                        url = SITE_DIR + 'scrumban/index/index/project/' + parts[1];
                    }
                } else {
                    url = SITE_DIR + 'scrumban/index/index/project/' + parts[1];
                }
            } else {
                if (SCRUMBAN.scrumbanPageControllsConfig.IS_EXTRANET) {
                    url += 'project/empty/site/' + EXTRANET_SITE_ID + '/';
                }
            }

            var leftMenu = document.querySelector('#menu > .menu-favorites');

            if (!leftMenu) {
                leftMenu = document.querySelector('#menu #bx_b24_menu > .menu-favorites');
            }

            if (leftMenu) {
                after = leftMenu.querySelector('li:not(.menu-items-empty-li)');
                block = after.cloneNode(true);
                block.setAttribute('class', block.className.replace('menu-item-active', ''));
                block.querySelector('a').setAttribute('href', url);
                block.querySelector('.menu-item-link-text').innerText = l10n.SCRUMBAN_TASK_BOARD;
                block.querySelector('.menu-item-link-text').setAttribute('title', l10n.SCRUMBAN_TASK_BOARD);
                after.after(block);
            } else {
                var topMenu = document.getElementById('top-menu');
                if (topMenu) {
                    after = topMenu.querySelectorAll('.root-item')[1];
                    block = after.cloneNode(true);
                    block.setAttribute('class', block.className.replace('home', '').replace('selected', ''));
                    block.removeAttribute('id');
                    block.removeAttribute('onmouseout');
                    block.removeAttribute('onmouseover');
                    block.onmouseout = null;
                    block.onmouseover = null;
                    block.querySelector('a').setAttribute('href', url);
                    block.querySelector('.root-item-text-line').innerText = l10n.SCRUMBAN_TASK_BOARD;

                    after.before(block);
                }
            }
            return false;
        }
    };

    scrumbanPageControlls.init();
});
