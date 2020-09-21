{"version":3,"sources":["mobile_ui.js"],"names":["window","BX","MobileUI","events","MOBILE_UI_TEXT_FIELD_SET_PARAMS","TextField","__generateParams","params","userId","message","panelParams","smileButton","useImageButton","mentionDataSource","outsection","url","attachFileSettings","resize","quality","destinationType","sourceType","targetWidth","targetHeight","encodingType","mediaType","allowsEdit","correctOrientation","saveToPhotoAlbum","popoverOptions","cameraDirection","maxAttachedFilesCount","attachButton","items","id","name","dataSource","multiple","TABLE_SETTINGS","searchField","showtitle","modal","text","placeholder","action","data","attachedFiles","length","map","file","callback","setDefaultParams","defaultParams","onCustomEvent","show","BXMPage","TextPanel","createLoader","loader","this","setText","view","parentNode","overlay","style","top","document","body","scrollTop","screen","height","appendChild","addEventListener","_prevent","hide","removeChild","removeEventListener","e","preventDefault","onCancel","textView","innerHTML","_onCancel","loaderView","create","props","className","children","attrs","html","click","bottomPanel","bindHover","node","bind","addClass","removeClass","panel","holderContainer","holder","buttons","setButtons","buttonsArray","clear","i","push","FastClick","attach","firstChild","addCopyableDialog","highlightBlockClass","textBlockClass","getTextFunction","MobileApp","Gesture","addLongTapListener","targetNode","highlightNode","findParent","textBlock","copyableBlock","findChild","BXMobileApp","UI","ActionSheet","title","app","exec","NotificationBar","color","textColor","groupId","maxLines","align","isGlobal","useCloseButton","autoHideTimeout","hideOnTap","setTimeout","addLivefeedLongTapHandler","likeButtonNode","BXRL","render","type","isNotEmptyString","likeNodeClass","hasClass","likeId","getAttribute","showReactionsPopup","bindElement","menuItems","copyItemClass","copyTextClass","MobileTools","getTextBlock","menuItemsNode","menuEventName","emitter","Event","EventEmitter","eventResult","emit","List","onEvent","list","objectId","ListObject","internalId","showMenu","instance","eventName","Events","ON_ITEM_MORE_CHOOSED","ON_MENU_ITEM_CHOOSED","enableInVersion","Table","addListener","listener","addCustomEvent","BXCordovaPlugin","eventListener","proxy","jsCallbackProvider"],"mappings":"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","file":"mobile_ui.map.js"}