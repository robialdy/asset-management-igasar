<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Serah Terima Aset</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 50px;
            padding: 0;
            color: #000;
            line-height: 1.6;
            text-align: justify;
            background: #f5f5f5;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 40px;
            border: 2px solid #000;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 18pt;
            text-decoration: underline;
            margin-bottom: 20px;
        }

        .info {
            margin-bottom: 5px;
            font-size: 12pt;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 12pt;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #ddd;
        }

        .signature {
            margin-top: 10px;
            text-align: center;
        }

        .signature div {
            display: inline-block;
            width: 45%;
            text-align: center;
            margin: 0 2%;
        }

        .fine-section {
            margin-top: 20px;
            font-size: 12pt;
        }

        @media print {
            body {
                /* margin: 0; */
                padding: 0;
                margin-left: 0;
                margin-top: 0;
                margin-bottom: 0;
                background: #fff;
                 -webkit-print-color-adjust: exact; /* Pastikan warna tetap terlihat */
            }
            .container {
                border: none;
                box-shadow: none;
            }
            .print-btn {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>BERITA SERAH TERIMA ASET</h1>

    <p class="info">
        Pada hari ini, <b>..., ..........</b>, bertempat di <b>SMK IGASAR PINDAD BANDUNG</b>, telah dilakukan serah terima aset antara:
    </p>

    <p class="info">
        <b>Pihak Pertama:</b> .............., dengan jabatan .............. di SMK IGASAR PINDAD BANDUNG.
        <br>
        <b>Pihak Kedua:</b> .............., dengan jabatan .............. di SMK IGASAR PINDAD BANDUNG.
    </p>

    <p class="info">
        Dengan ini, Pihak Pertama menyerahkan kepada Pihak Kedua aset dengan rincian sebagai berikut:
    </p>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Aset</th>
            <th>Jenis</th>
            <th>Kategori</th>
            <th>Kondisi</th>
        </tr>
        <tr style="height: 120px">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>

    <div class="fine-section">
        <p>
            Apabila terjadi kerusakan pada aset yang diserahkan, maka Pihak Kedua wajib membayar denda sesuai dengan jenis kerusakan berikut:
        </p>

        <table>
            <tr>
                <th>Jenis Kerusakan</th>
                <th>Denda</th>
            </tr>
            <tr>
                <td>Kerusakan Sedang (komponen rusak, tidak berfungsi sebagian)</td>
                <td>Rp 500.000</td>
            </tr>
            <tr>
                <td>Kerusakan Berat (tidak dapat digunakan, perlu penggantian)</td>
                <td>Rp 1.500.000</td>
            </tr>
            <tr>
                <td>Hilang</td>
                <td>Harga penuh aset</td>
            </tr>
        </table>
    </div>

    <p class="info">
        Pihak Kedua menerima aset dalam kondisi sebagaimana disebutkan di atas dan berjanji untuk menjaga serta menggunakannya dengan baik.
        Segala kerusakan yang terjadi di kemudian hari akan menjadi tanggung jawab Pihak Kedua sesuai dengan ketentuan yang berlaku.
    </p>

    <div class="signature">
        <div>
            <p><b>Pihak Pertama</b></p>
            <br><br><br>
            <p>(__________________)</p>
            <p>(......................................)</p>
        </div>
        <div>
            <p><b>Pihak Kedua</b></p>
            <br><br><br>
            <p>(__________________)</p>
            <p>(......................................)</p>
        </div>
    </div>
</div>

<script>
    window.print()
</script>

</body>
</html>
