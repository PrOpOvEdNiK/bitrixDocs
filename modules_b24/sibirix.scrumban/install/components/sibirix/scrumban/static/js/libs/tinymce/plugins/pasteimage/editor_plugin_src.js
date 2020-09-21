/**
 *
 */
(function() {
    tinymce.create('tinymce.plugins.PasteImagePlugin', {
        init : function(ed/*, url*/) {

            var editorController;

            ed.onInit.add(function(ed){
                initPasting(ed);
                editorController = $("#" + ed.editorId).closest(".scrumbanTextEditor").controller();
            });

            function initPasting(ed) {
                var editorWindow = ed.contentWindow;
                if (editorWindow && editorWindow.addEventListener) {
                    editorWindow.addEventListener("paste", pasteHandler, false);
                }
            }


            function pasteHandler(e) {
                if (!e.clipboardData || !e.clipboardData.items) {
                    return;
                }

                var items = e.clipboardData.items;
                for (var i = 0; i < items.length; i++) {
                    if (items[i].type.indexOf("image") !== -1) {
                        var blob = items[i].getAsFile();
                        var URLObj = window.URL || window.webkitURL;
                        var source = URLObj.createObjectURL(blob);
                        createImage(source);

                        editorController.appendPastedImage(blob, source);
                    }
                }
            }

            function createImage(source) {
                ed.execCommand("mceInsertContent", false, ed.dom.createHTML('img', {src: source, alt: ""}));
            }
        },

        getInfo : function() {
            return {
                longname : 'Clipboard image pasting',
                author : 'Smiling Cheater <ivan.kozhevin@sibirix.ru>',
                authorurl : 'http://www.sibirix.ru/',
                infourl : '',
                version : "0.1"
            };
        }
    });

    // Register plugin
    tinymce.PluginManager.add('pasteimage', tinymce.plugins.PasteImagePlugin);
})();