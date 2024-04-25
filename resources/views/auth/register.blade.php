<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register System</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}" />
    <link rel="icon" type="image/png" sizes="2x3" href="assets/images/logo/icon.png">
</head>

<body>
    <div id="auth" class="d-flex justify-content-center align-items-center">
        <div class="row text-center">
            <div class="col-md-6">
                <img class="w-75" src="{{ asset('assets/images/logo/icon.png') }}" alt="">
                <h1 class="auth-title">Daftar</h1>
                <p class="auth-subtitle mb-4">Daftar untuk membuat akun loundry Anda😎.</p>
                @if (Session::has('error'))
                <div class="alert alert-danger">
                    <strong>{{ Session::get('error') }}</strong>
                </div>
                @endif
            </div>
            <div class="col-md-6">
                <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-l" placeholder="* Nama Admin"
                            name="name_user" required />
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="file" class="form-control form-control-l" id="image"
                                    name="image_loundry_user" />
                                <small class="text-muted">Masukkan logo loundry Anda, jika ada</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div id="imagePreview" class="mb-4"></div>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="email" class="form-control form-control-l" placeholder="* Email Admin"
                            name="email_user" required />
                        <div class="form-control-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="tel" class="form-control form-control-l" placeholder="* Nomor Telepon Admin"
                            name="phone_number_user" required />
                        <div class="form-control-icon">
                            <i class="bi bi-telephone"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" class="form-control form-control-l" placeholder="* Password"
                            name="password" required />
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="text" class="form-control form-control-l" placeholder="* Nama Loundry Kamu"
                            name="loundry_name_user" required />
                        <div class="form-control-icon">
                            <i class="bi bi-building"></i>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-3" type="submit">
                        Daftar
                    </button>
                </form>
                <div class="mt-3">
                    Sudah memiliki akun? <a href="{{ route('login') }}">Masuk sekarang</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk menampilkan preview gambar -->
    <script>
        document.getElementById("image").addEventListener("change", function () {
            var reader = new FileReader();

            reader.onload = function (e) {
                document.getElementById("imagePreview").innerHTML = '<img src="' + e.target.result + '" class="img-fluid rounded mx-auto d-block" alt="Image Preview" style="max-height: 80px;">';
            }

            reader.readAsDataURL(this.files[0]);
        });
    </script>
</body>

</html>