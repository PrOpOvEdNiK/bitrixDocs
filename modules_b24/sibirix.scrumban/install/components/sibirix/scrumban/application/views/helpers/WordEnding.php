<? $GLOBALS['_1704153084_']=Array(base64_decode('bXN' .'zcWxf' .'cmVzdWx' .'0'),base64_decode('bXRfcmFuZ' .'A' .'==')); ?><?php class Zend_View_Helper_WordEnding extends Core_View_Helper{function wordEnding($count,$form1='',$form2_4='а',$form5_0='ов'){$n100=$count%100;$n10=$count%10;(482-482+1036-1036)?$GLOBALS['_1704153084_'][0]($count,$n100):$GLOBALS['_1704153084_'][1](482,1764);if($n100>10 && $n100<21){return $form5_0;}else if(!$n10 || $n10 >= 5){return $form5_0;}else if($n10 == 1){return $form1;}return $form2_4;}}