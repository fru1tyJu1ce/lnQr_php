function randomN(min, max) { 
    return Math.random() * (max - min) + min;
} 

function createQR(qr){
    //console.log("creating qr");
    var qrcode = new QRious({
        element: document.getElementById("payment_requestQr"),
        background: '#ffffff',
        backgroundAlpha: 1,
        foreground: '#000000',
        foregroundAlpha: 1,
        level: 'H',
        padding: 0,
        size: 256,
        value: qr
      });
}

function formatValueAsSatoshi(val){
    var value = (val).toLocaleString('de-DE');
      return value;
}

function formatValueAsEUR(val){

    var eur = {
        style: "currency",
        currency: "EUR"
      }

    return (val).toLocaleString('de-DE', eur);
}

function animateValue(id, start, end, duration) {
    if (start === end) return;
    var range = end - start;
    var current = start;
    var increment = end > start? 1 : -1;
    var stepTime = Math.abs(Math.floor(duration / range));
    var obj = document.getElementById(id);
    var timer = setInterval(function() {
        current += increment;
        obj.innerHTML = formatValueAsSatoshi(current);
        if (current == end) {
            clearInterval(timer);
        }
    }, stepTime);
}

createQR(payment_request);
document.getElementById('payment_requestTxt').innerHTML = payment_request;
document.getElementById('balanceSat').innerHTML = formatValueAsSatoshi(balance/1000);
document.getElementById('balanceEur').innerHTML = formatValueAsEUR(btcInfo.EUR.last*0.00000001*(balance/1000));
//animateValue("value", 0, balance, 10); // -->  last value = count speed
//console.log(btcInfo.EUR.last*0.00000001*(balance/1000));