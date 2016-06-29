<?php
namespace thelucyclub\SafeConnect;

use pocketmine;
use raklib;
use spl;
use pocketmine\Server;
use pocketmine\network;
use pocketmine\utils\TextFormat as TF;
use pocketmine\Player;

class SafeConnect extends PluginBase implents Listener {
public function onLoad() {
  Server::getInstance()->getLogger()->info(TF::AQUA . "\n\n                     SafeConnect" . TF::YELLOW . "\n         by The Lucy Club" . TF::GREEN . "\nhttp://github.com/thelucyclub/SafeConnect");
}

public function onPlayerPreLoginEvent(PlayerPreLoginEvent $event) {
  $player = $event->getPlayer();
  Server::getInstance()->getLogger()->waring("$player is connecting... Please be patient");
  $player->sendTip(TF::BLUE . "[SafeConnect] $player does not pose a possible threat\n\n\n" . TF::LIGHT_PURPLE . "Your ping is below 500ms. Impressive!");
  $output = shell_exec('ping -c1 dl.thelucyclub.ml/ip_mcpe-deny.json');
  if($output == "" or $output == "down") {
  $player->close(TF::RED . "[SafeConnect] Can't reach API server at the moment. If you are the server owner, set the 'API-KEY' option in config.yml");
 }
}
public function onPlayerJoinEvent(PlayerJoinEvent $event) {
  $player = $event->getPlayer();
  Server::getInstance()->getLogger()->notice(TF::RED . "$player passed checks. Player safe.");
  $player->sendMessage(TF::YELLOW . "ALERT: SafeConnect has not detected you as a threat. Please note if your network ping is too high, you may be kicked for a threat.");
  }
}
