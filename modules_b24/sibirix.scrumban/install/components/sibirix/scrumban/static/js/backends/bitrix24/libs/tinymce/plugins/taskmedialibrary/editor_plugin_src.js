/**
 * editor_plugin_src.js
 */
(function($) {
    tinymce.create('tinymce.plugins.TaskMediaLibraryPlugin', {
        init : function(ed/*, url*/) {
            // Register commands

            var $taskView = $("#" + ed.editorId).closest('.kanbanTaskDetailEditor');

            if (!$taskView.length) {
                $taskView = $("#" + ed.editorId).closest('.planningTaskDetailEditor');
            }

            var model = $taskView.controller().options.model;

            ed.addCommand('mceScrumbanImage', function() {
                new Sibirix.Controller.Confirm.TaskMediaLibrary('<div/>', {
                    model: model,
                    callback: function(image){
                        ed.execCommand("mceInsertContent", false, ed.dom.createHTML('img', {src: image.fileName, alt: ""}));
                        ed.execCommand("mceRepaint", false);
                    }
                });
            });

            // Register buttons
            ed.addButton('image', {
                title : 'Scrumban task images',
                cmd : 'mceScrumbanImage'
            });
        },

        getInfo : function() {
            return {
                longname : 'Scrumban task media library',
                author : 'Peskovatskov Denis',
                authorurl : 'http://www.sibirix.ru/',
                infourl : '',
                version : "0.1"
            };
        }
    });

    // Register plugin
    tinymce.PluginManager.add('taskmedialibrary', tinymce.plugins.TaskMediaLibraryPlugin);
})(SCRUMBAN.jQuery);