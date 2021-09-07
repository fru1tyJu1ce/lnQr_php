function randomN(min, max) { 
    return Math.random() * (max - min) + min;
} 

function createQR(qr){
    console.log("creating qr");
    var qrcode = new QRious({
        element: document.getElementById("qrcode"),
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
    var value = (val).toLocaleString(
        undefined, // leave undefined to use the visitor's browser 
                   // locale or a string like 'en-US' to override it.
        { minimumFractionDigits: 2 }
      );
      return value;
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


createQR(document.getElementById('invoiceTxt').value);
console.log(balance);
animateValue("value", 0, balance, 10); // -->  last value = count speed
console.log("finish");