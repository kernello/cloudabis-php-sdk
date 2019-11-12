<?php 
namespace cloudabis_sdk\ApiManager;

/**
 * API Manager
 */
class CloudABISAPI {
    // Given App Key
    private $_appKey = "";
    // Given Secret Key
    private $_secretKey = "";
    // Given Base Api Url
    private $_apiBaseUrl = "";

    // Construct Api Manager
    function __construct($appKey, $secretKey, $apiBaseUrl)
    {
        $this->_appKey = $appKey;
        $this->_secretKey = $secretKey;
        $this->_apiBaseUrl = $apiBaseUrl;

        if ( $this->_apiBaseUrl == "" || is_null($this->_apiBaseUrl) )
            throw new Exception("Please provide the api base url.");
            
        if ( substr($this->_apiBaseUrl, -1) != "/" )
            $this->_apiBaseUrl = $this->_apiBaseUrl . "/"; 
    }

    /**
     * Returns API token object if given app key, secret key is correct otherwise return the proper reason
     */
    function GetToken()
    {
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->_apiBaseUrl . "token",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "username=".$this->_appKey."&password=".urlencode($this->_secretKey)."&grant_type=password",
                CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "content-type: application/x-www-form-urlencoded",
                    "postman-token: 6f57f414-8466-926e-03e0-38a76c201598"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                return "cURL Error #:" . $err;
            } else {
                $response = json_decode($response);
                return $response;
            }
        } catch (Exception $e) {
            throw new Exception("Experiencing technical difficaulties!");
        }
    }
}