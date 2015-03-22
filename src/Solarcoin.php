<?php

namespace Cryptocurrency;

use \Monolog\Logger;
use \Openclerk\Currencies\Cryptocurrency;
use \Openclerk\Currencies\BlockCurrency;
use \Openclerk\Currencies\BlockBalanceableCurrency;
use \Openclerk\Currencies\DifficultyCurrency;
use \Openclerk\Currencies\ConfirmableCurrency;
use \Openclerk\Currencies\ReceivedCurrency;

/**
 * Represents the Solarcoin cryptocurrency.
 */
class Solarcoin extends Cryptocurrency
  implements BlockCurrency, DifficultyCurrency, ReceivedCurrency {

  function getCode() {
    return "slr";
  }

  function getName() {
    return "Solarcoin";
  }

  function getAbbr() {
    return "SLR";
  }

  function getURL() {
    return "http://solarcoin.org/";
  }

  function getCommunityLinks() {
    return array(
      "http://solarcoin.org/forum/" => "Solarcoin Forum",
    );
  }

  function isValid($address) {
    // based on is_valid_btc_address
    if (strlen($address) >= 27 && strlen($address) <= 34 && (substr($address, 0, 1) == "8")
        && preg_match("#^[A-Za-z0-9]+$#", $address)) {
      return true;
    }
    return false;
  }

  /**
  * Get the main algorithm used by this currency for hashing, as a
  * code from {@link HashAlgorithm#getCode()}.
  */
  public function getAlgorithm() {
    return "scrypt";
  }

  function hasExplorer() {
    return true;
  }

  function getExplorerName() {
    return "Chainz";
  /**
   * @throws {@link BalanceException} if something happened and the balance could not be obtained.
   */
  function getBalance($address, Logger $logger) {
    $fetcher = new Services\SolarcoinExplorer();
    return $fetcher->getBalance($address, $logger);
  }

  /**
   * @throws {@link BalanceException} if something happened and the balance could not be obtained.
   */
  function getReceived($address, Logger $logger) {
    $fetcher = new Services\SolarcoinExplorer();
    return $fetcher->getBalance($address, $logger, true);
  }

  function getBlockCount(Logger $logger) {
    $fetcher = new Services\SolarcoinExplorer();
    return $fetcher->getBlockCount($logger);
  }

  function getDifficulty(Logger $logger) {
    $fetcher = new Services\SolarcoinExplorer();
    return $fetcher->getDifficulty($logger);
  }

}
  }

  function getExplorerURL() {
    return "https://chainz.cryptoid.info/";
  }

  function getBalanceURL($address) {
    return sprintf("https://chainz.cryptoid.info/slr/address.dws?%s.htm", urlencode($address));
  }
