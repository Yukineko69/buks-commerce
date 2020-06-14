<?php
namespace MyBC\CurrencyConverter\Helper;

class Config {

    /** @var \Magento\Framework\App\Config\ScopeConfigInterface */
    private $scopeConfig;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return int
     */
    public function getApiKey() {
        $result = (string)$this->scopeConfig->getValue('currency/fcc/api_key');
        return $result;
    }

    /**
     * @return int
     */
    public function getDelay() {
        $result = (int)$this->scopeConfig->getValue('currency/fcc/delay');
        return $result;
    }

    /**
     * @return int
     */
    public function getTimeout() {
        $result = (int)$this->scopeConfig->getValue('currency/fcc/timeout');
        return $result;
    }
}
