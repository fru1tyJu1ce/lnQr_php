
<html>
 <head>
  <title>PHP-Test</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
 </head>
  <body>
   <?php

function btcInfo(): stdClass
{
  //https://www.blockchain.com/api/exchange_rates_api
  $url = 'https://blockchain.info/ticker';//API URL 4 btc to eur


  $options = array(
      'http' => array(
      'method'  => 'GET'
      )
  );
    
  $context  = stream_context_create( $options );
  $result = file_get_contents( $url, false, $context );
  $response = json_decode( $result );

  return $response;
}


    function getWalletDetails(): stdClass
    {
      //$url = 'https://lnbits.satoshibox.de/api/v1/wallet';//API URL
      $url = 'https://node.coincreek.com/api/v1/wallet';//API URL

      $options = array(
          'http' => array(
          'method'  => 'GET',
          'header'=>  "Content-Type: application/json\r\n".
                      "Accept: application/json\r\n".
                      //"X-Api-Key: 38f5cf4f52004b49856518fb0178c40b\r\n" //Invoice Key
                      "X-Api-Key: 192f309f5d49476da6a8540e8320d77e\r\n" //Invoice Key

          )
      );
        
      $context  = stream_context_create( $options );
      $result = file_get_contents( $url, false, $context );
      $response = json_decode( $result );

      return $response;
    }

     
    function createInvoice(): stdClass
    {
      $data = array(  // body anpassen
        'out'      => false,
        'amount'    => 5,
        'memo'       => 'Ernold Tusk'
      );
      

      //$url = 'https://lnbits.satoshibox.de/api/v1/payments';//API URL
      $url = 'https://node.coincreek.com/api/v1/payments';//API URL
      $options = array(
          'http' => array(
          'method'  => 'POST',
          'content' => json_encode( $data ),
          'header'=>  "Content-Type: application/json\r\n".
                      "Accept: application/json\r\n".
                      //"X-Api-Key: 38f5cf4f52004b49856518fb0178c40b\r\n" //Invoice Key
                      "X-Api-Key: 192f309f5d49476da6a8540e8320d77e\r\n" //Invoice Key

          )
      );
        
      $context  = stream_context_create( $options );
      $result = file_get_contents( $url, false, $context );
      $response = json_decode( $result );
      return $response;
    }

    function getInvoices(): array
    {
  
      //$url = 'https://lnbits.satoshibox.de/api/v1/payments';//API URL
      $url = 'https://node.coincreek.com/api/v1/payments';//API URL
      $options = array(
        'http' => array(
        'method'  => 'GET',
        'header'=>  "Content-Type: application/json\r\n".
              "Accept: application/json\r\n".
              //"X-Api-Key: 38f5cf4f52004b49856518fb0178c40b\r\n" //Invoice Key
              "X-Api-Key: 192f309f5d49476da6a8540e8320d77e\r\n" //Invoice Key
  
        )
      );
      
      $context  = stream_context_create( $options );
      $result = file_get_contents( $url, false, $context );
      $response = json_decode( $result );
      return $response;
    }
    
    ?>
  <!--
    <canvas id="payment_requestQr" readonly="yes"> </canvas> 

    <br/>
    <br/>

    <textarea id="payment_requestTxt" rows="6" cols="50"></textarea>

    <br/>
    <br/>

  -->
   <div id="balanceSat">0</div>
   <div id="balanceEur">0</div>
  
  <script>
    var btcInfo = <?=json_encode(btcInfo())?>; 
    //var payment_request = json_encode(createInvoice()->payment_request); 
    var balance = <?=json_encode(getWalletDetails()->balance)?>; 
    var invoices = <?=json_encode(getInvoices())?>;
  </script>
    
    <script language="javascript" type="text/javascript" src="script.js"></script>

  </body>
</html>
