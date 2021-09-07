
<html>
 <head>
  <title>PHP-Test</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
 </head>
  <body>
   <?php
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

    ?>

    <canvas id="qrcode"></canvas>  </body>

    <br/>
    <br/>

    <textarea id="invoiceTxt" rows="7" cols="50">
      <?php echo createInvoice()->payment_request; ?>
    </textarea>

    <br/>
    <br/>
   <!--<p> <?php //echo getWalletDetails()->balance/1000; ?> </p> -->
   
   <div id="value">0</div>

    <script>
    var balance = <?=json_encode(getWalletDetails()->balance/1000)?>; 
    </script>
    
    <script language="javascript" type="text/javascript" src="script.js"></script>

  </body>
</html>
