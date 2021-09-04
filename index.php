
<html>
 <head>
  <title>PHP-Test</title>
 </head>
  <body>
   <?php
    function getWalletDetails(): mixed
    {
      $url = 'https://lnbits.satoshibox.de/api/v1/wallet';//API URL

      $options = array(
          'http' => array(
          'method'  => 'GET',
          'header'=>  "Content-Type: application/json\r\n".
                      "Accept: application/json\r\n".
                      "X-Api-Key: 38f5cf4f52004b49856518fb0178c40b\r\n" //Invoice Key
          )
      );
        
      $context  = stream_context_create( $options );
      $result = file_get_contents( $url, false, $context );
      $response = json_decode( $result );

      return $response;
    }
    ?>

    <!--<canvas id="qrcode"></canvas>  </body>-->
    <p> <?php echo getWalletDetails()->balance/1000; ?> </p>
  </body>
</html>