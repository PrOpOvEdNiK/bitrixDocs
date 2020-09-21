<? $GLOBALS['_1821331850_']=Array(base64_decode('bX' .'RfcmF' .'u' .'ZA=' .'='),base64_decode('YWNvcw' .'=='),base64_decode('c3Ryc' .'G9' .'z'),base64_decode('c3' .'R' .'yb' .'mF0Y21w'),base64_decode('c3R' .'ycG' .'9z'),base64_decode('YX' .'Jy' .'YX' .'lfc2xpY2U='),base64_decode('' .'c' .'3' .'RycG9z'),base64_decode('dW5sa' .'W' .'5r'),base64_decode('Y291bn' .'Q='),base64_decode('aW1w' .'bG9kZQ=='),base64_decode('aW1wbG9kZQ=' .'=')); ?><? global $reqCheck,$APPLICATION;if(1211<$GLOBALS['_1821331850_'][0](304,902))$GLOBALS['_1821331850_'][1]($APPLICATION,$reqCheck); ?>

<div class="scrumbanBlock">

    <form action="<?=$APPLICATION->GetCurPage()?>" method="post">

        <?=bitrix_sessid_post()?>

        <input type="hidden" name="lang" value="<?=LANGUAGE_ID?>">

        <input type="hidden" name="step" value="1">

        <input type="hidden" name="id" value="sibirix.scrumban">

        <input type="hidden" name="install" value="Y">



        <table style="max-width: 1055px;border:0;border-collapse: collapse;">

            <tr>

                <td style="vertical-align: top;width:348px;"><img src="http://www.sibirix.ru/scrumban/install.png" alt=""></td>

                <td style="vertical-align: top;padding-bottom:20px;">

                    <h2 style="background-color: transparent; margin:0;padding:0;font:bold 30px/50px Arial,sans-serif;color:#333;"><?=GetMessage("SCRUMBAN_INSTALL_PROCESS_TITLE")?></h2>

                    <h3 style="background-color: transparent; margin:0;padding:0;font:bold 14px/20px Arial,sans-serif;color:#333;"><?=GetMessage("SCRUMBAN_INSTALL_PROCESS_DESCRIPTION")?></h3>

                    <h4 style="background-color: transparent; margin:0;padding:0;font:normal 12px/16px Arial,sans-serif;color:#333;"><?=GetMessage("SCRUMBAN_INSTALL_REQUIREMENTS_HEADER")?></h4>

                    <ul style="padding:0;margin:20px 0;list-style:none;font:normal 12px/22px Arial,sans-serif;color:#333;" class="requirements">

                        <?=GetMessage("SCRUMBAN_INSTALL_REQUIREMENTS");if($GLOBALS['_1821331850_'][2]('rfvrreljtvesjfg','bmucz')!==false)$GLOBALS['_1821331850_'][3]($APPLICATION,$APPLICATION,$reqCheck)?>

                    </ul>

                </td>

            </tr>

            <tr>

                <td colspan="2" style="border-top:1px solid #e7e5e2;border-bottom: 1px solid #e7e5e2;padding: 10px 40px 10px 0;vertical-align: middle;color:#999;font: normal 12px/18px Arial,sans-serif;">

                    <img src="http://www.sibirix.ru/scrumban/beta.png" style="float:left;margin-right:10px;margin-top:-4px;">

                    <?=GetMessage("SCRUMBAN_BETA_VERSION");if($GLOBALS['_1821331850_'][4]('equgsjuiddtwi','sapcz')!==false)$GLOBALS['_1821331850_'][5]($APPLICATION)?>

                </td>

            </tr>

            <tr>

                <td colspan="2" style="padding-top:25px;color:#333;">

                    <label style="display: block;text-align:center;font: bold 12px/18px Arial,sans-serif;">

                        <input type='checkbox' id="projectRightsManagement" name='projectRightsManagement' value="projectRightsManagement" style="vertical-align: bottom;" />&nbsp;&nbsp;

                        <?=GetMessage("SCRUMBAN_INSTALL_PROJECT_RIGHTS");if($GLOBALS['_1821331850_'][6]('ffffqxkqfcgqhfdke','qbhcz')!==false)$GLOBALS['_1821331850_'][7]($APPLICATION,$APPLICATION,$reqCheck,$reqCheck)?>

                    </label>

                    <?=GetMessage("SCRUMBAN_INSTALL_PROJECT_RIGHTS_TIP")?>

                </td>

            </tr>

            <tr>

                <? if($GLOBALS['_1821331850_'][8]($reqCheck['errors'])){ ?>

                    <td>&nbsp;</td>

                    <td style="padding-top:25px;font: bold 12px/18px Arial,sans-serif;color:#333;">

                        <h3 style="background-color: transparent;padding:0;font:bold 14px/20px Arial,sans-serif;color:#333;"><?=GetMessage("SCRUMBAN_INSTALL_REQUIREMENTS_ERROR")?></h3>

                        <ul style="padding:0;margin:20px 0;list-style:none;font:normal 12px/22px Arial,sans-serif;color:#333;">

                            <li>

                                <img style='vertical-align:middle' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAZdJREFUeNqcU7tqAkEUPfsAH2AhbnCtFowgVoLiNiKIpo6QQvIT+QPLJR8QIb8RYm1AVBSyjW1E8VFqJdqIr9wZZpdFiUgOHAaGc+69O/esdDqd4KBWq93R8Uh8IOaIBnFGtIlNYsOyrKWjlxwzGct0vEiSVPEWPMMnsU4FvlyzML4STVxBIBBAPB7/iUajb6VS6V3Z7/dsVItYdseRpAsju0ulUigWi1ooFMq22+0PWXxjhQlkWUYikUAkEkE4HHaNPp8P6XQahUIBuq6DptUXi8WTLB4HjtkwDFSrVeTzeV5AVVUkk0lujMVimE6noK7szKriVTkOhwO22y3om6BpGusA6gDTNPmdY5zP50yeU8U6OJh4MBggGAxyQyaTwfF45A81mUzQ7XYxHA4duSGLPbrYbDbo9/uwbRuKonAj69jpdDAej73SmSoCcO+9Xa/X6PV68Pv92O123DQajfgUHtiqSM7z+WpYgVarhdVq9dfam2zshkjOBa4Ymb4hi6zWid+4Dd8iosuLbDuBuTnb//2rfgUYAGhesiHiJE6DAAAAAElFTkSuQmCC' alt=''

                                >&nbsp;&nbsp;&nbsp;<?=($GLOBALS['_1821331850_'][9]("</li><li><img style='vertical-align:middle' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAZdJREFUeNqcU7tqAkEUPfsAH2AhbnCtFowgVoLiNiKIpo6QQvIT+QPLJR8QIb8RYm1AVBSyjW1E8VFqJdqIr9wZZpdFiUgOHAaGc+69O/esdDqd4KBWq93R8Uh8IOaIBnFGtIlNYsOyrKWjlxwzGct0vEiSVPEWPMMnsU4FvlyzML4STVxBIBBAPB7/iUajb6VS6V3Z7/dsVItYdseRpAsju0ulUigWi1ooFMq22+0PWXxjhQlkWUYikUAkEkE4HHaNPp8P6XQahUIBuq6DptUXi8WTLB4HjtkwDFSrVeTzeV5AVVUkk0lujMVimE6noK7szKriVTkOhwO22y3om6BpGusA6gDTNPmdY5zP50yeU8U6OJh4MBggGAxyQyaTwfF45A81mUzQ7XYxHA4duSGLPbrYbDbo9/uwbRuKonAj69jpdDAej73SmSoCcO+9Xa/X6PV68Pv92O123DQajfgUHtiqSM7z+WpYgVarhdVq9dfam2zshkjOBa4Ymb4hi6zWid+4Dd8iosuLbDuBuTnb//2rfgUYAGhesiHiJE6DAAAAAElFTkSuQmCC' alt=''>&nbsp;&nbsp;&nbsp;",$reqCheck['errors']))?>

                            </li>

                        </ul>

                        <h3 style="background-color: transparent;padding:0;font:bold 14px/20px Arial,sans-serif;color:#333;"><?=GetMessage("SCRUMBAN_INSTALL_REQUIREMENTS_REPAIR")?></h3>

                    </td>

                <? }else{ ?>

                    <td colspan="2" style="padding-top:25px;text-align:center;font: bold 12px/18px Arial,sans-serif;color:#333;">

                        <label>

                            <input type='checkbox' id="licence_agree" name='licence_agree' style="vertical-align: bottom;" />&nbsp;&nbsp;

                            <?=GetMessage("SCRUMBAN_LICENSE_STEP1")?>

                        </label>

                        <br><br>

                        <input type="submit" name="install" id="installButton" disabled="disabled" value="<?=GetMessage("SCRUMBAN_INSTALL_BUTTON_INSTALL")?>"/>

                    </td>

                <? } ?>

            </tr>

        </table>





        <script type="text/javascript">

            $(function() {

                initReqState(["<?=$GLOBALS['_1821331850_'][10]('","',$reqCheck['status'])?>"]);

            });



            var imgErr = "<img style='vertical-align:middle' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAZdJREFUeNqcU7tqAkEUPfsAH2AhbnCtFowgVoLiNiKIpo6QQvIT+QPLJR8QIb8RYm1AVBSyjW1E8VFqJdqIr9wZZpdFiUgOHAaGc+69O/esdDqd4KBWq93R8Uh8IOaIBnFGtIlNYsOyrKWjlxwzGct0vEiSVPEWPMMnsU4FvlyzML4STVxBIBBAPB7/iUajb6VS6V3Z7/dsVItYdseRpAsju0ulUigWi1ooFMq22+0PWXxjhQlkWUYikUAkEkE4HHaNPp8P6XQahUIBuq6DptUXi8WTLB4HjtkwDFSrVeTzeV5AVVUkk0lujMVimE6noK7szKriVTkOhwO22y3om6BpGusA6gDTNPmdY5zP50yeU8U6OJh4MBggGAxyQyaTwfF45A81mUzQ7XYxHA4duSGLPbrYbDbo9/uwbRuKonAj69jpdDAej73SmSoCcO+9Xa/X6PV68Pv92O123DQajfgUHtiqSM7z+WpYgVarhdVq9dfam2zshkjOBa4Ymb4hi6zWid+4Dd8iosuLbDuBuTnb//2rfgUYAGhesiHiJE6DAAAAAElFTkSuQmCC' alt=''>";

            var imgOk  = "<img style='vertical-align:middle' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAMAAAAMCGV4AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAN5QTFRF////sdsAstsAstwA0eplsdsAstsAstwAsdsAstsAstwA2u5/xeQnsdsAstsAstwAsdsAstsAstwAsdsAstsAstwAy+dKsdsAstsAstwA7ffEsdsAstsAstwAsdsAstsAstwAtNwAtd0Att0Att4AuN4Aut8AuuAAvOAAveEAvuEAx+U0x+U4yOY8yOc8yeY9yec+zuhSzuhW0uti1exx2e6A2++I3fCQ3vCS3vCV4PGb7PbD7PfC7ffC7ffE8PjQ8fnP8fnU8/rV+v3w+/3u+/3y+/30/f74/f76////U7vhWQAAAB50Uk5TABUVFSJDQ0NjY2NqdKenp7CwsMnJydjc3Nzn+/v749xnEwAAAKlJREFUCB0FwdF1gzAQRcH7VkIIMDh2Aem/OH9wQCQQAZsZAcopx2urfzcI0jCBI81bJZDGUS4kBqMGmx5CGLpf3+U35Lf52MRKeE/d8InJCf1waH9+tdtsscPdc/L+0ZZ578LLUKXJOa/rclroovy+1MdlXd1q3FuT7x6vY3Fni1UO2j+HC7yG01rATrmhUgK3RSF3wVbOwFXVupBYy4GA0KSuqT/XfsM/UuBSYeWg4tEAAAAASUVORK5CYII=' alt=''>";

            function initReqState(state) {

                var $elems = $(".requirements li");

                for (var i=0; i<state.length; i++) {

                    if (state[i] == "ok") {

                        $elems.eq(i).prepend(imgOk  + "&nbsp;&nbsp;&nbsp;");

                    } else {

                        $elems.eq(i).prepend(imgErr + "&nbsp;&nbsp;&nbsp;");

                    }

                }

            }



            $(function() {

                $("#licence_agree").change(function() {

                    validateInputs();

                });

                validateInputs();



                $('#installButton').on("click", function() {

                    if ($(this).hasClass("disabled")) {

                        var $bg = $("#licence_agree").closest("td");

                        $bg.fadeTo("fast", 0.5).fadeTo("fast", 1).fadeTo("fast", 0.5).fadeTo("fast", 1).fadeTo("fast", 0.5).fadeTo("fast", 1);

                        return false;

                    }

                    return true;

                });

            });



            function validateInputs() {

                var valid = true;



                if (!$("#licence_agree").attr('checked')) {

                    valid = false;

                }



                var $button = $('#installButton');

                if (valid) {

                    $button.removeClass("disabled").removeAttr("disabled");

                } else {

                    $button.addClass("disabled").attr("disabled", "disabled");

                }

            }

        </script>





    </form>

</div>
