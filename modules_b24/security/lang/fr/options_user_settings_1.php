<?
$MESS["SEC_OTP_CONNECTED"] = "Connecté";
$MESS["SEC_OTP_CONNECT_DEVICE"] = "Connectez dongle";
$MESS["SEC_OTP_CONNECT_DEVICE_TITLE"] = "Connectez dongle";
$MESS["SEC_OTP_CONNECT_DONE"] = "Prêt";
$MESS["SEC_OTP_CONNECT_MOBILE"] = "Connectez appareil mobile";
$MESS["SEC_OTP_CONNECT_MOBILE_ENTER_CODE"] = "Entrez le code";
$MESS["SEC_OTP_CONNECT_MOBILE_ENTER_NEXT_CODE"] = "Entrez le code suivant";
$MESS["SEC_OTP_CONNECT_MOBILE_INPUT_DESCRIPTION"] = "Une fois que le code a été scannée ou saisie manuellement avec succès, votre téléphone mobile affiche le code que vous devrez entrer ci-dessous.";
$MESS["SEC_OTP_CONNECT_MOBILE_INPUT_NEXT_DESCRIPTION"] = "L'algorithme OTP nécessite deux codes d'authentification. S'il vous plaît générer le code suivant et saisir ci-dessous.";
$MESS["SEC_OTP_CONNECT_MOBILE_MANUAL_INPUT"] = "Pour saisir les données manuellement, indiquez l'adresse du site, votre Adresse emailor connexion, un code secret sur l'image et sélectionnez le type de clé.";
$MESS["SEC_OTP_CONNECT_MOBILE_MANUAL_INPUT_HOTP"] = "compteur basé";
$MESS["SEC_OTP_CONNECT_MOBILE_MANUAL_INPUT_TOTP"] = "en fonction du temps";
$MESS["SEC_OTP_CONNECT_MOBILE_SCAN_QR"] = "Apportez votre appareil mobile à l'écran et d'attendre que l'application scanne le code.";
$MESS["SEC_OTP_CONNECT_MOBILE_STEP_1"] = "Téléchargez l'application mobile Bitrix OTP pour votre téléphone sur <a href='https://itunes.apple.com/en/app/bitrix24-otp/id929604673?l=fr' target='_new'>AppStore</a> sur <a href='https://play.google.com/store/apps/details?id=com.bitrixsoft.otp' target='_new'>GooglePlay</a>";
$MESS["SEC_OTP_CONNECT_MOBILE_STEP_2"] = "Exécutez l'application et cliquez sur <b>Configurer</b>";
$MESS["SEC_OTP_CONNECT_MOBILE_STEP_3"] = "Choisissez comment vous voulez entrer des données: en utilisant le code QR ou manuellement";
$MESS["SEC_OTP_CONNECT_MOBILE_TITLE"] = "Connectez appareil mobile";
$MESS["SEC_OTP_CONNECT_NEW_DEVICE"] = "Connectez nouveau dongle";
$MESS["SEC_OTP_CONNECT_NEW_MOBILE"] = "Connectez nouvel appareil mobile";
$MESS["SEC_OTP_DEACTIVATE_UNTIL"] = "Désactivées jusqu'à #DATE#";
$MESS["SEC_OTP_DESCRIPTION_ABOUT"] = "One-Time Password (OTP) a été développé dans le cadre de l'initiative de serment.<br>
OTP est basée sur HMAC SHA-1 et / SHA-256 / SHA-512. À l'heure actuelle, les deux algorithmes sont pris en charge pour générer des codes:
<ul><li>counter base (HMAC-Basé one-time password, HOTP) comme décrit dans a href='https://tools.ietf.org/html/rfc4226' target='_blank'>RFC4226</a></li>
<li>le temps en fonction (basé sur le temps Un temps passe, TOTP) comme décrit dans <a href='https://tools.ietf.org/html/rfc6238' target='_blank'>RFC6238</a></li></ul>
Pour calculer la valeur OTP l'algorithme prend deux paramètres d'entrée: une clé secrète (valeur initiale) et une valeur courante du compteur (le nombre de cycles nécessaires de génération ou d'une heure en fonction de l'algorithme). La valeur initiale est enregistrée dans l'appareil ainsi que sur le site une fois un dispositif a été initialisé. Si l'on utilise HOTP, le compteur est incrémenté de dispositif sur chaque génération OTP, tandis que le compteur de serveur est modifié à chaque authentification réussie OTP. Si vous utilisez TOTP, aucun compteur est enregistré dans l'appareil, et le serveur garde la trace du changement d'heure possible du dispositif sur chaque authentification OTP succès.<br>
Chacun des dispositifs OTP dans un lot comprend un fichier crypté contenant les valeurs initiales (clés secrètes) pour chaque appareil dans le lot, le fichier est lié au numéro de série de l'appareil qui peut être trouvé sur le dispositif.<br>
Si les compteurs de l'appareil et le serveur se développent hors de synchronisation, ils peuvent être facilement synchronisés retour en apportant la valeur du serveur à celle de l'appareil. Pour ce faire, l'administrateur (ou un utilisateur avec l'autorisation appropriée) doit générer deux années consécutives de OTP et les entrer sur le site.<br>
Vous pouvez trouver l'application mobile sur l'AppStore et GooglePlay.";
$MESS["SEC_OTP_DESCRIPTION_ABOUT_TITLE"] = "Description";
$MESS["SEC_OTP_DESCRIPTION_ACTIVATION"] = "Un code unique pour l'authentification en deux étapes peut être obtenu en utilisant un dispositif spécial (un dongle), ou une application mobile gratuite (Bitrix OTP) chaque utilisateur doit avoir installé sur leurs appareils mobiles.<br>
Pour permettre à un dongle, l'administrateur devra ouvrir le profil de l'utilisateur et entrez les deux mots de passe générés par le.<br>
Pour obtenir un code unique sur un appareil mobile, un utilisateur peut télécharger et exécuter l'application et de scanner le code QR sur la page des paramètres dans leur profil d'utilisateur ou d'entrer les données de compte manuellement.";
$MESS["SEC_OTP_DESCRIPTION_ACTIVATION_TITLE"] = "Activation";
$MESS["SEC_OTP_DESCRIPTION_INTRO_INTRANET"] = "Aujourd'hui, un utilisateur utilise une paire de connexion et mot de passe pour authentifier sur votre Bitrix24. Cependant, il ya des outils à une personne malveillante
peut employer pour entrer dans un ordinateur et de voler ces données, par exemple si un utilisateur enregistre son mot de passe.<br>
<b>L'authentification à deux-étape</b> est l'option recommandée pour protéger votre Bitrix24 contre les logiciels d'intrus. Chaque fois qu'un utilisateur se connecte au système, ils auront à passer deux niveaux de vérification. Tout d'abord, entrer le login et le mot de passe. Ensuite, entrez un code de sécurité unique envoyé à leur appareil mobile. La ligne de fond est un attaquant ne peut pas faire usage des données volées, car ils ne savent pas le code de sécurité.
";
$MESS["SEC_OTP_DESCRIPTION_INTRO_SITE"] = "Aujourd'hui, un utilisateur est en utilisant une paire de connexion et mot de passe pour authentifier sur votre site. Toutefois, il existe des outils à une personne malveillante
peut employer pour entrer dans un ordinateur et de voler ces données, par exemple si un utilisateur enregistre son mot de passe.<br>
<b>L'authentification à deux-étape</b> est l'option recommandée pour protéger contre les logiciels d'intrus. Chaque fois qu'un utilisateur se connecte au système, ils auront à passer deux niveaux de vérification. Tout d'abord, entrer le login et le mot de passe. Ensuite, entrez un code de sécurité unique envoyé à leur appareil mobile. La ligne de fond est un attaquant ne peut pas faire usage des données volées, car ils ne savent pas le code de sécurité.
";
$MESS["SEC_OTP_DESCRIPTION_INTRO_TITLE"] = "Mots de passe à une seule utilisation";
$MESS["SEC_OTP_DESCRIPTION_USING"] = "Lorsque l'authentification en deux étapes est activée, un utilisateur devra passer deux niveaux de vérification lors de la connexion. <br> Tout d'abord, entrer leur mot de passe Adresse emailand comme d'habitude. <br>
Ensuite, entrez un code de sécurité unique envoyé à leur appareil mobile ou obtenu en utilisant un dongle dédié. 
";
$MESS["SEC_OTP_DESCRIPTION_USING_STEP_0"] = "tape 1";
$MESS["SEC_OTP_DESCRIPTION_USING_STEP_1"] = "tape 2";
$MESS["SEC_OTP_DESCRIPTION_USING_TITLE"] = "Utilisation de One Time Passwords";
$MESS["SEC_OTP_DISABLE"] = "Désactivé";
$MESS["SEC_OTP_ENABLE"] = "Activé";
$MESS["SEC_OTP_ERROR_TITLE"] = "Erreur de sauvegarde.";
$MESS["SEC_OTP_INIT"] = "Initialisation";
$MESS["SEC_OTP_MANDATORY_ALMOST_EXPIRED"] = "Le temps pendant lequel un utilisateur doit mettre en place une authentification en deux étapes viendra à expiration le #DATE#.";
$MESS["SEC_OTP_MANDATORY_DEFFER"] = "tendre";
$MESS["SEC_OTP_MANDATORY_DISABLED"] = "L'authentification obligatoire en deux étapes désactivée.";
$MESS["SEC_OTP_MANDATORY_ENABLE"] = "Exiger l'activation de l'authentification en deux étapes dans les";
$MESS["SEC_OTP_MANDATORY_ENABLE_DEFAULT"] = "Exiger l'activation de l'authentification en deux étapes";
$MESS["SEC_OTP_MANDATORY_EXPIRED"] = "Le temps pendant lequel un utilisateur a dû mettre en place une authentification en deux étapes a maintenant expiré.";
$MESS["SEC_OTP_MOBILE_INPUT_METHODS_SEPARATOR"] = "ou";
$MESS["SEC_OTP_MOBILE_MANUAL_INPUT"] = "Entrez le code manuellement";
$MESS["SEC_OTP_MOBILE_SCAN_QR"] = "Scannez le code QR";
$MESS["SEC_OTP_NEW_ACCESS_DENIED"] = "L'accès aux deux étapes de contrôle d'authentification a été refusée.";
$MESS["SEC_OTP_NEW_SWITCH_ON"] = "Activer l'authentification en deux étapes";
$MESS["SEC_OTP_NO_DAYS"] = "toujours";
$MESS["SEC_OTP_PASS1"] = "La première valeur du mot de passe sur l'appareil (la presser et enregistrer de l'écran)";
$MESS["SEC_OTP_PASS2"] = "La valeur suivante du mot de passe sur l'appareil (appuyez de nouveau et enregistrez à partir de l'écran)";
$MESS["SEC_OTP_RECOVERY_CODES_BUTTON"] = "Codes de sauvegarde";
$MESS["SEC_OTP_RECOVERY_CODES_DESCRIPTION"] = "Copiez les codes de sauvegarde que vous pourriez avoir besoin si vous avez perdu votre appareil mobile ou ne pouvez pas obtenir un code via l'application pour toute autre raison.";
$MESS["SEC_OTP_RECOVERY_CODES_NOTE"] = "Un code ne peut être utilisé qu'une seule fois. Astuce: grève codes utilisés au large de la liste.";
$MESS["SEC_OTP_RECOVERY_CODES_PRINT"] = "Enregistrement imprimant";
$MESS["SEC_OTP_RECOVERY_CODES_REGENERATE"] = "Générer de nouveaux codes";
$MESS["SEC_OTP_RECOVERY_CODES_REGENERATE_DESCRIPTION"] = "Short sur les codes de sauvegarde ?<br/>
Créer de nouveaux.<br/><br/>
Création de nouveaux codes de sauvegarde invalide <br/>les codes générés précédemment.
";
$MESS["SEC_OTP_RECOVERY_CODES_SAVE_FILE"] = "Enregistrer dans un fichier texte";
$MESS["SEC_OTP_RECOVERY_CODES_TITLE"] = "Codes de sauvegarde";
$MESS["SEC_OTP_RECOVERY_CODES_WARNING"] = "Gardez à portée de main, dire dans votre portefeuille ou votre sac. Chacun des codes ne peut être utilisé qu'une seule fois.";
$MESS["SEC_OTP_SECRET_KEY"] = "Clé secrète (disponible individuellement pour chaque appareil)";
$MESS["SEC_OTP_STATUS"] = "Statut courant";
$MESS["SEC_OTP_STATUS_ON"] = "Activé(e)s";
$MESS["SEC_OTP_SYNC_NOW"] = "Importation";
$MESS["SEC_OTP_TYPE"] = "Algorithme de génération de mot de passe";
$MESS["SEC_OTP_UNKNOWN_ERROR"] = "Erreur inattendue. Veuillez réessayer plus tard.";
$MESS["SEC_OTP_WARNING_RECOVERY_CODES"] = "L'authentification à deux étapes est activée mais vous ne créer des codes de sauvegarde. Vous pourriez en avoir besoin si vous avez perdu votre appareil mobile ou ne pouvez pas obtenir un code via l'application pour toute autre raison.";
?>