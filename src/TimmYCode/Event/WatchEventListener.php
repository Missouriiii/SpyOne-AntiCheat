<?php

namespace TimmYCode\Event;

use TimmYCode\Modules\ModuleBase;
use TimmYCode\SpyOne;
use TimmYCode\Utils\ClientUtil;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

class WatchEventListener implements Listener
{

	static array $spyOnePlayerList = array();
	static array $spyOnePlayerModuleList = array();
	public ModuleBase $moduleBase;

	public function onJoin(PlayerJoinEvent $event) {
		$this->moduleBase = new ModuleBase();
		$this->moduleBase->registerModules(true);

		self::$spyOnePlayerList += [$event->getPlayer()->getXuid() => $event->getPlayer()];
		self::$spyOnePlayerModuleList[] = $this->moduleBase;
		$event->getPlayer()->sendMessage(SpyOne::PREFIX . "§3Remember to not hack or you will be banned!");
	}

	public function onLeave(PlayerQuitEvent $event) {
		unset(self::$spyOnePlayerList[$event->getPlayer()->getXuid()]);
		unset(self::$spyOnePlayerModuleList[ClientUtil::playerExistsInArray($event->getPlayer(), self::$spyOnePlayerList)]);
	}

}
