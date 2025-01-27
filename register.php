<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Tambahan CSS -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to right, #001f3f, #0074D9, #7FDBFF);
            color: #ffffff;
        }

        .container {
            display: flex;
            width: 80%;
            max-width: 1200px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            overflow: hidden;
        }

        .image-section,
        .login-section {
            flex: 1;
            padding: 10px; 
            margin: -12px;
        }

        .image-section {
            background: linear-gradient(to bottom, #001f3f, #0074D9);
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .image-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 2;
        }

        .image-section::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
        }

        .login-section {
            background: #ffffff;
            color: #003366;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .login-section h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .login-section p {
            font-size: 1rem;
            margin-bottom: 2rem;
            text-align: center;
        }

        .login-section form {
            width: 100%;
            max-width: 400px;
        }

        .login-section input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-section button {
            width: 100%;
            padding: 10px;
            background: #0059b3;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        .login-section button:hover {
            background: #003366;
        }

        .login-section .create-account {
            margin-top: 1rem;
            text-align: center;
        }

        .login-section .create-account a {
            color: #0059b3;
            text-decoration: none;
        }

        .login-section .create-account a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>    
    <div class="container">
        <div class="image-section">
            <img src="assets/images/loginpage.png" alt="Image Placeholder" style="width: 500px; height: 500px;">
        </div>
        <div class="login-section">
            <h1>Registrasi Pasien</h1>
            <p class="login-box-msg text-center">Unggah data diri sesuai KTP <span class="text-primary">Pasien</span> </p>
            <form action="pages/register/checkRegister.php" method="post">
                    <label for="nama">Nama :</label>
                    <input type="text" class="form-control" name="nama" required>

                    <label for="no_hp">Nomor KTP :</label>
                    <input type="number" class="form-control" name="no_ktp" required>

                    <label for="no_hp">Alamat :</label>
                    <input class="form-control" id="alamat" name="alamat" required></input>

                    <label for="no_hp">Password :</label>
                    <input type="password" class="form-control" name="password" required>

                    <label for="no_hp">Nomor Handphone :</label>
                    <input type="number" class="form-control" name="no_hp" required>

                    <button type="submit" class="btn btn-block btn-primary">
                        Daftar Pasien
                    </button>
                </form>
            <div class="create-account">
                <p class="mt-3">Sudah terdaftar? <a href="loginUser.php" style="text-decoration: none;">Masuk pasien</a></p>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>