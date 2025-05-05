<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Verifikasi Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            padding: 30px;
            text-align: center
        }

        .email-container {
            text-align: start;
            background: white;
            padding: 30px;
            border-radius: 10px;
            max-width: 600px;
            margin: auto;
        }

        .btn {
            background: #5bcfc5;
            padding: 15px 25px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }
    </style>
</head>

<body>
    <img src="{{ url('assets') }}/img/logo-bibsport.png" alt="" width="200px" style="margin-bottom: 20px">
    <div class="email-container">
        <h2>Hai, {{ $name }} 👋</h2>
        <p>Terima kasih telah mendaftar BibSport.id. Silakan klik tombol di bawah ini untuk memverifikasi alamat email
            Anda:</p>
        <p style="text-align: center;">
            <a href="{{ $url }}" class="btn">Verifikasi Email</a>
        </p>
        <p>Jika kamu tidak membuat akun, abaikan saja email ini.</p><br>
        <p>Salam hangat,<br><strong>Tim Bibsport.id</strong></p>
    </div>
</body>

</html>
