<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barcode & QR Code</title>
    <style>
        .grid {
            display: grid
        }

        .grid.grid-center {
            justify-content: center;
            align-items: center;
            margin-top: 250px;
        }

        img {
            height: 200px;
        }

    </style>
</head>

<body>
    <div class="grid grid-center">
        <img class="center"
            src="data:image/png;base64,{{ \DNS2D::getBarcodePNG($alat->kode . ' (' . $alat->alat . ')' . ' ' . $alat->rak->rak . '-' . $alat->rak->lokasi, 'QRCODE') }}"
            alt="barcode" />
    </div>
</body>

</html>
