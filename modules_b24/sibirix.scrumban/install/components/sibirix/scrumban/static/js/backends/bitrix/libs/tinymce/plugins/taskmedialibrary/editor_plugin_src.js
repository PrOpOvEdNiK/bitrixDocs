/**
 * editor_plugin_src.js
 */
(function() {
    tinymce.create('tinymce.plugins.TaskMediaLibraryPlugin', {
        init : function(ed/*, url*/) {
            // Register commands

            if (!window.LHEDailogs || !window.LHEDailogs['Image']) {
                return;
            }

            var $textarea = $("#" + ed.editorId);
            $textarea.arConfig = {
                bUseMedialib: true,
                bUseFileDialogs: false,
                bBBCode: (typeof ed.plugins.bbcode !== 'undefined')
            };
            var oDialog = new window.LHEDailogs['Image']({
                pLEditor: $textarea
            });
            var arDConfig = {
                title : oDialog.title,
                width: 500,
                height: 320,
                resizable: false
            };

            ed.addCommand('mceBxImage', function() {
                var obLHEDialog = new BX.CDialog(arDConfig);
                obLHEDialog.Show();
                obLHEDialog.SetContent(oDialog.innerHTML);

                if (oDialog.OnLoad && typeof oDialog.OnLoad == 'function') {
                    oDialog.OnLoad();
                }

                obLHEDialog.oDialog = oDialog;
                obLHEDialog.ClearButtons();

                obLHEDialog.SetButtons([
                    new BX.CWindowButton({
                        title: window.LHE_MESS.DialogSave ? window.LHE_MESS.DialogSave: BX.message('DialogSave'),
                        action: function() {
                            var src = $("#lhed_img_src").val();

                            ed.execCommand("mceInsertContent", false, ed.dom.createHTML('img', {src: src, alt: ""}));
                            ed.execCommand("mceRepaint", false);
                            obLHEDialog.Close();
                            $(".bx-core-dialog-overlay, .bx-core-dialog, #bxmedialib_shadow").remove();
                        }
                    }),
                    new BX.CWindowButton({
                        title: window.LHE_MESS.DialogCancel ? window.LHE_MESS.DialogCancel: BX.message('DialogCancel'),
                        action: function() {
                            obLHEDialog.Close();
                            $(".bx-core-dialog-overlay, .bx-core-dialog, #bxmedialib_shadow").remove();
                        }
                    })
                ]);
                BX.addClass(obLHEDialog.PARTS.CONTENT, "lhe-dialog");
                obLHEDialog.adjustSizeEx();
            });

            // Register buttons
            ed.addButton('image', {
                title : 'Bitrix image selector',
                cmd : 'mceBxImage'
            });
        },

        getInfo : function() {
            return {
                longname : 'Bitrix image selector',
                author : 'Smiling Cheater <ivan.kozhevin@sibirix.ru>',
                authorurl : 'http://www.sibirix.ru/',
                infourl : '',
                version : "0.1"
            };
        }
    });

    // Register plugin
    tinymce.PluginManager.add('taskmedialibrary', tinymce.plugins.TaskMediaLibraryPlugin);
})();