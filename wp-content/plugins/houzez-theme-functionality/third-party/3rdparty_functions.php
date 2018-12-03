<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 02/02/16
 * Time: 6:40 PM
 */
/*-----------------------------------------------------------------------------------*/
// Paypal functions - fave get paypal access token
/*-----------------------------------------------------------------------------------*/

if( !function_exists('houzez_get_paypal_access_token') ):

    function houzez_get_paypal_access_token( $url, $postArgs ) {
        $clientID   = houzez_option('paypal_client_id');
        $SecretID   = houzez_option('paypal_client_secret_key');

        $curl = curl_init( $url );
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_USERPWD, $clientID . ":" . $SecretID);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postArgs );
        $response = curl_exec( $curl );

        if (empty($response)) {
            die(curl_error($curl));
            curl_close($curl);
        } else {
            $info = curl_getinfo($curl);
            curl_close($curl);
            if($info['http_code'] != 200 && $info['http_code'] != 201 ) {
                echo "Received error: " . $info['http_code']. "\n";
                echo "Raw response:".$response."\n";
                die();
            }
        }
        // Convert json format to PHP array
        $response = json_decode( $response );
        return $response->access_token;
    }

endif; // end

/*-----------------------------------------------------------------------------------*/
// Paypal functions - fave execute paypal request
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_execute_paypal_request') ):

    function houzez_execute_paypal_request( $url, $jsonData, $access_token ) {

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer '.$access_token,
            'Accept: application/json',
            'Content-Type: application/json'
        ));
    
        curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData);
        $response = curl_exec( $curl );
        if (empty($response)) {
            die(curl_error($curl));
            curl_close($curl);
        } else {
            $info = curl_getinfo($curl);
            curl_close($curl);
            if($info['http_code'] != 200 && $info['http_code'] != 201 ) {
                echo "Received error: " . $info['http_code']. "\n";
                echo "Raw response:".$response."\n";
                die();
            }
        }
        $jsonResponse = json_decode($response, TRUE);
        return $jsonResponse;
    }

endif; // end