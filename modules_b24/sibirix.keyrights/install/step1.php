<? global $reqCheck, $APPLICATION; ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<div class="keyrightsBlock">
    <form action="<?= $APPLICATION->GetCurPage()?>" method="post">
        <?=bitrix_sessid_post();?>
        <input type="hidden" name="lang" value="<?=LANGUAGE_ID?>">
        <input type="hidden" name="step" value="1">
        <input type="hidden" name="id" value="sibirix.keyrights">
        <input type="hidden" name="install" value="Y">

        <? if (!empty($GLOBALS['errors']) && !empty($GLOBALS['errors']['keyphrase'])) : ?>
            <h2 style="color: #f00;"><?= GetMessage('KEYRIGHTS_INSTALL_PASS_EMPTY'); ?></h2>
        <? endif; ?>

        <table style="max-width: 1055px;border:0;border-collapse: collapse;">
            <tr>
                <td style="vertical-align: top;padding-bottom:20px;">
                    <h2 style="background-color: transparent; margin:0;padding:0;font:bold 30px/50px Arial,sans-serif;color:#333;"><?=GetMessage("KEYRIGHTS_INSTALL_PROCESS_TITLE")?></h2>
                    <h3 style="background-color: transparent; margin:0;padding:0;font:bold 14px/20px Arial,sans-serif;color:#333;"><?=GetMessage("KEYRIGHTS_INSTALL_PROCESS_DESCRIPTION")?></h3>
                    <h4 style="background-color: transparent; margin:0;padding:0;font:normal 12px/16px Arial,sans-serif;color:#333;"><?=GetMessage("KEYRIGHTS_INSTALL_REQUIREMENTS_HEADER")?></h4>
                    <ul style="padding:0;margin:20px 0;list-style:none;font:normal 12px/22px Arial,sans-serif;color:#333;" class="requirements">
                        <?= GetMessage("KEYRIGHTS_INSTALL_REQUIREMENTS"); ?>
                    </ul>
                </td>
            </tr>
            <tr>
                <? if (count($reqCheck['errors'])) { ?>
                    <td style="padding-top:25px;font: bold 12px/18px Arial,sans-serif;color:#333;">
                        <h3 style="background-color: transparent;padding:0;font:bold 14px/20px Arial,sans-serif;color:#333;"><?=GetMessage("KEYRIGHTS_INSTALL_REQUIREMENTS_ERROR")?></h3>
                        <ul style="padding:0;margin:20px 0;list-style:none;font:normal 12px/22px Arial,sans-serif;color:#333;">
                            <li>
                                <img style='vertical-align:middle' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAZdJREFUeNqcU7tqAkEUPfsAH2AhbnCtFowgVoLiNiKIpo6QQvIT+QPLJR8QIb8RYm1AVBSyjW1E8VFqJdqIr9wZZpdFiUgOHAaGc+69O/esdDqd4KBWq93R8Uh8IOaIBnFGtIlNYsOyrKWjlxwzGct0vEiSVPEWPMMnsU4FvlyzML4STVxBIBBAPB7/iUajb6VS6V3Z7/dsVItYdseRpAsju0ulUigWi1ooFMq22+0PWXxjhQlkWUYikUAkEkE4HHaNPp8P6XQahUIBuq6DptUXi8WTLB4HjtkwDFSrVeTzeV5AVVUkk0lujMVimE6noK7szKriVTkOhwO22y3om6BpGusA6gDTNPmdY5zP50yeU8U6OJh4MBggGAxyQyaTwfF45A81mUzQ7XYxHA4duSGLPbrYbDbo9/uwbRuKonAj69jpdDAej73SmSoCcO+9Xa/X6PV68Pv92O123DQajfgUHtiqSM7z+WpYgVarhdVq9dfam2zshkjOBa4Ymb4hi6zWid+4Dd8iosuLbDuBuTnb//2rfgUYAGhesiHiJE6DAAAAAElFTkSuQmCC' alt=''
                                >&nbsp;&nbsp;&nbsp;<?=(implode("</li><li><img style='vertical-align:middle' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAZdJREFUeNqcU7tqAkEUPfsAH2AhbnCtFowgVoLiNiKIpo6QQvIT+QPLJR8QIb8RYm1AVBSyjW1E8VFqJdqIr9wZZpdFiUgOHAaGc+69O/esdDqd4KBWq93R8Uh8IOaIBnFGtIlNYsOyrKWjlxwzGct0vEiSVPEWPMMnsU4FvlyzML4STVxBIBBAPB7/iUajb6VS6V3Z7/dsVItYdseRpAsju0ulUigWi1ooFMq22+0PWXxjhQlkWUYikUAkEkE4HHaNPp8P6XQahUIBuq6DptUXi8WTLB4HjtkwDFSrVeTzeV5AVVUkk0lujMVimE6noK7szKriVTkOhwO22y3om6BpGusA6gDTNPmdY5zP50yeU8U6OJh4MBggGAxyQyaTwfF45A81mUzQ7XYxHA4duSGLPbrYbDbo9/uwbRuKonAj69jpdDAej73SmSoCcO+9Xa/X6PV68Pv92O123DQajfgUHtiqSM7z+WpYgVarhdVq9dfam2zshkjOBa4Ymb4hi6zWid+4Dd8iosuLbDuBuTnb//2rfgUYAGhesiHiJE6DAAAAAElFTkSuQmCC' alt=''>&nbsp;&nbsp;&nbsp;", $reqCheck['errors']));?>
                            </li>
                        </ul>
                        <h3 style="background-color: transparent;padding:0;font:bold 14px/20px Arial,sans-serif;color:#333;"><?=GetMessage("KEYRIGHTS_INSTALL_REQUIREMENTS_REPAIR")?></h3>
                    </td>
                <? } else { ?>
                    <td style="padding-top:25px;text-align:center;font: bold 12px/18px Arial,sans-serif;color:#333;">
                        <label>
                            <?= GetMessage('KEYRIGHTS_INSTALL_PASS_LABEL'); ?>
                            <input type="password" name="keyphrase" placeholder="" />
                        </label>
                        <br><br>
                        <label>
                            <input type='checkbox' id="licence_agree" name='licence_agree' style="vertical-align: bottom;" />&nbsp;&nbsp;
                            <?=GetMessage("KEYRIGHTS_LICENSE_STEP1")?>
                        </label>
                        <br><br>
                        <input type="submit" name="install" id="installButton" disabled="disabled" value="<?=GetMessage("KEYRIGHTS_INSTALL_BUTTON_INSTALL")?>"/>
                    </td>
                <? } ?>
            </tr>
        </table>


        <script type="text/javascript">
            $(function() {
                initReqState(["<?=  implode('","', $reqCheck['status']); ?>"]);
                $('[name="keyphrase"]').focus();
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

                if (!$("#licence_agree").is(':checked')) {
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
