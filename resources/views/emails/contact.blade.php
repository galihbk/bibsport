<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Email dari page kontak</title>
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
        <p><strong>Nama:</strong> {{ $nama }}</p>
        <p><strong>Email:</strong> {{ $email }}</p>
        <p><strong>Pesan:</strong><br>{{ $pesan }}</p>
    </div>
</body>

</html>
