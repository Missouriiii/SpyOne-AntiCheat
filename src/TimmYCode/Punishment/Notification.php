<?php

namespace TimmYCode\Punishment;

use TimmYCode\SpyOne;
use pocketmine\player\Player;
use TimmYCode\Utils\PlayerUtil;

class Notification
{

	function __construct(Player $player, String $moduleName)
	{
		foreach (SpyOne::getInstance()->getServer()->getOnlinePlayers() as $onlineplayer) {
			if($onlineplayer->hasPermission("spyone.notify")) {
				$onlineplayer->sendMessage(SpyOne::PREFIX . $player->getNameTag() . " §7flagged for §b" . substr($moduleName, 4) . " §8[§7Ping: §b" . PlayerUtil::getPing($player) . "§8]");
			}
		}
	}

}
