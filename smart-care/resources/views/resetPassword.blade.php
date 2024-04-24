<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Lại Mật Khẩu - SmartCare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .password-reset-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        .submit-btn {
            width: 100%;
            padding: 10px;
            border-radius: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="password-reset-container">
            <h2 class="text-center mb-4">Đặt Lại Mật Khẩu</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}" class="needs-validation" novalidate>
                @csrf
                <input type="hidden" name="token" value="{{ request()->query('token') }}">
                <input type="hidden" name="email" value="{{ request()->query('email') }}">

                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Mật khẩu mới" required>
                    <div class="invalid-feedback">Vui lòng nhập mật khẩu mới.</div>
                </div>

                <div class="mb-3">
                    <input type="password" class="form-control" name="password_confirmation"
                        placeholder="Xác nhận mật khẩu" required>
                    <div class="invalid-feedback">Vui lòng xác nhận mật khẩu.</div>
                </div>

                <button type="submit" class="btn btn-primary submit-btn">Đặt lại mật khẩu</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>

</html>
