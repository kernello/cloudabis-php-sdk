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
    public function __construct($appKey, $secretKey, $apiBaseUrl)
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
    public function GetToken()
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

    public function IsRegistered($biometricRequest)
    {
        $id = $biometricRequest->RegistrationID;
        $engineName = $biometricRequest->EngineName;
        $customerKey = $biometricRequest->CustomerKey;
        $token = $biometricRequest->Token;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->_apiBaseUrl . "api/Biometric/IsRegistered",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\r\n  \"CustomerKey\": \"$customerKey\",\r\n  \"EngineName\": \"$engineName\",\r\n  \"RegistrationID\": \"$id\"\r\n}",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer $token",
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: f33d9566-866e-d6f9-5b85-bb5eabd25da5"
                ),
            )
        );

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    public function Register($biometricRequest)
    {
        $registrationid = $biometricRequest->RegistrationID;
        $engineName = $biometricRequest->EngineName;
        $customerKey = $biometricRequest->CustomerKey;
        $format = $biometricRequest->Format;
        $biometricXml = $biometricRequest->BiometricXml;
        $token = $biometricRequest->Token;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->_apiBaseUrl . "api/Biometric/Register",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\r\n  \"CustomerKey\": \"$customerKey\",\r\n  \"EngineName\": \"$engineName\",\r\n  \"RegistrationID\": \"$registrationid\",\r\n  \"Format\": \"$format\",\r\n  \"BiometricXml\": \"$biometricXml\"\r\n}",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer $token",
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: 2f03c3f1-3cb4-796f-096f-fdf87126e8c8",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    public function Verify($biometricRequest)
    {
        $registrationid = $biometricRequest->RegistrationID;
        $engineName = $biometricRequest->EngineName;
        $customerKey = $biometricRequest->CustomerKey;
        $format = $biometricRequest->Format;
        $biometricXml = $biometricRequest->BiometricXml;
        $token = $biometricRequest->Token;

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $this->_apiBaseUrl . "api/Biometric/Verify",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\r\n  \"CustomerKey\": \"$customerKey\",\r\n  \"EngineName\": \"$engineName\",\r\n  \"RegistrationID\": \"$registrationid\",\r\n  \"Format\": \"$format\",\r\n  \"BiometricXml\": \"$biometricXml\"\r\n}",
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer $token",
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: fc270662-9e46-7308-3851-f86ea8a66430"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    public function ChangeID($biometricRequest)
    {
        $registrationid = $biometricRequest->RegistrationID;
        $NewRegistrationID = $biometricRequest->NewRegistrationID;
        $engineName = $biometricRequest->EngineName;
        $customerKey = $biometricRequest->CustomerKey;
        $token = $biometricRequest->Token;

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $this->_apiBaseUrl . "api/Biometric/ChangeID",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\r\n  \"CustomerKey\": \"$customerKey\",\r\n  \"EngineName\": \"$engineName\",\r\n  \"RegistrationID\": \"$registrationid\",\r\n  \"NewRegistrationID\":\"$NewRegistrationID\"\r\n}",
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer $token",
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: d4840688-9803-9c65-67fe-046ec594531c"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    public function RemoveID($biometricRequest)
    {
        $id = $biometricRequest->RegistrationID;
        $engineName = $biometricRequest->EngineName;
        $customerKey = $biometricRequest->CustomerKey;
        $token = $biometricRequest->Token;

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $this->_apiBaseUrl . "api/Biometric/RemoveID",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\r\n  \"CustomerKey\": \"$customerKey\",\r\n  \"EngineName\": \"$engineName\",\r\n  \"RegistrationID\": \"$id\"\r\n}",
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer $token",
            "cache-control: no-cache",
            "content-type: application/json",
            "postman-token: 4679e34d-f18e-59e8-79ef-5e8241008796"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }
}