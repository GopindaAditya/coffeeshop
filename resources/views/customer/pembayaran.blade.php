<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QR Code Pembayaran</title>
</head>
<body>
    <div class="container">        
        <h2>QR Code Pembayaran</h2>
        <div id="qrcode"></div>
    </div>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script>
        // Mendapatkan data dari parameter URL
        var urlParams = new URLSearchParams(window.location.search);
        var qrCodeText = urlParams.get('data');

        // Mengisi QR Code dengan data yang diterima dari parameter URL
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: qrCodeText,
            width: 256,
            height: 256
        });
    </script>
</body>
</html>
