<?php

namespace Bitrix\Sale\TradingPlatform\Vk;

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class Helper
{
	public static function getHint($str)
	{
		return '<span id="hint_UF_TEST"></span><script>BX.hint_replace(BX("hint_UF_TEST"), "' . $str . '");</script>&nbsp;';
	}
}