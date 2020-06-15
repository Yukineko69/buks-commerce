<?php
namespace MyBC\CurrencyConverter\Model\Currency\Import;

class Fcc extends \Magento\Directory\Model\Currency\Import\AbstractImport {

    // api v3
    // const CURRENCY_CONVERTER_URL = 'https://free.currencyconverterapi.com/api/v3/convert?apiKey={{API_KEY}}&q={{CURRENCY_FROM}}_{{CURRENCY_TO}}';

    // api v7
    const CURRENCY_CONVERTER_URL = 'https://free.currconv.com/api/v7/convert?q={{CURRENCY_FROM}}_{{CURRENCY_TO}}&apiKey={{API_KEY}}';


    /** @var \MyBC\CurrencyConverter\Helper\Config */
    private $hlpCfg;
    /** @var \Magento\Framework\HTTP\ZendClient */
    private $httpClient;
    /** @var \Magento\Framework\Json\Helper\Data */
    private $jsonHelper;
    /** @var \Psr\Log\LoggerInterface */
    private $logger;

    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\HTTP\ZendClient $httpClient,
        \Magento\Directory\Model\CurrencyFactory $currencyFactory,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        \MyBC\CurrencyConverter\Helper\Config $hlpCfg
    ) {
        parent::__construct($currencyFactory);
        $this->logger = $logger;
        $this->httpClient = $httpClient;
        $this->jsonHelper = $jsonHelper;
        $this->hlpCfg = $hlpCfg;
    }

    /**
     * @param string $currencyFrom
     * @param string $currencyTo
     * @param int $retry
     * @return float|null
     */
    protected function _convert($currencyFrom, $currencyTo, $retry = 0) {
        $result = null;
        $apiKey = $this->hlpCfg->getApiKey();
        $url = str_replace('{{API_KEY}}', $apiKey, self::CURRENCY_CONVERTER_URL);
        $url = str_replace('{{CURRENCY_FROM}}', $currencyFrom, $url);
        $url = str_replace('{{CURRENCY_TO}}', $currencyTo, $url);
        $this->logger->info("Currency rates request: $url");
        $delay = $this->hlpCfg->getDelay();
        $timeout = $this->hlpCfg->getTimeout();
        try {
            sleep($delay);
            $this->httpClient->setUri($url);
            $this->httpClient->setConfig(['timeout' => $timeout,]);
            $response = $this->httpClient->request('GET');
            $body = $response->getBody();
            $resultKey = $currencyFrom . '_' . $currencyTo;
            $data = $this->jsonHelper->jsonDecode($body);
            // $result = $data[$resultKey];
            // $result = number_format($result, 15);
            $results = $data['results'][$resultKey];
            $queryCount = $data['query']['count'];
            if (!$queryCount && !isset($results)) {
                $this->_messages[] = __('We can\'t retrieve a rate from %1.', $url);
            } else {
                $result = number_format($results['val'], 15); //Đổi number format từ scientific notation sang dạng số thập phân
            }

        } catch (\Exception $e) {
            if ($retry == 0) {
                $this->_convert($currencyFrom, $currencyTo, 1);
            } else {
                $this->_messages[] = __('We can\'t retrieve a rate from %1.', $url);
            }
        }

        return $result;
    }
}
