<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Flor é Vida</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #810477 0%, #ff00f2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-box {
            background: white;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            max-width: 400px;
        }
        .login-box h1 {
            color: #e91e63;
            font-size: 32px;
            margin-bottom: 30px;
            text-align: center;
        }
        .login-info {
            background: #e3f2fd;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="w-100">
        <div class="login-box mx-auto">
            <h1>Flor é Vida</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('auth.login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Login</label>
                    <input type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ old('login') }}" required autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label">Senha</label>
                    <input type="password" class="form-control @error('senha') is-invalid @enderror" name="senha" required>
                </div>
                <button class="btn btn-primary w-100" type="submit">Entrar</button>
            </form>

        </div>
    </div>
</body>
</html>