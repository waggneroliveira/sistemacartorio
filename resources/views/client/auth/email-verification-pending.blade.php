<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação de E-mail Pendente</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0a2b3e 0%, #1b4f6e 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .verification-container {
            max-width: 500px;
            width: 100%;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 50px 40px;
            text-align: center;
        }

        .verification-icon {
            font-size: 60px;
            color: #ffd966;
            margin-bottom: 30px;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .verification-title {
            font-size: 28px;
            font-weight: 700;
            color: #0a2b3e;
            margin-bottom: 15px;
        }

        .verification-email {
            font-size: 16px;
            color: #5c6f7e;
            margin-bottom: 30px;
        }

        .verification-email strong {
            color: #1b4f6e;
            font-weight: 600;
        }

        .verification-message {
            font-size: 14px;
            color: #5c6f7e;
            line-height: 1.8;
            margin-bottom: 40px;
            background: #f0f4f8;
            padding: 20px;
            border-radius: 10px;
            border-left: 4px solid #1b4f6e;
            text-align: left;
        }

        .verification-message strong {
            color: #0a2b3e;
            display: block;
            margin-bottom: 10px;
        }

        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 40px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary {
            background: #0a2b3e;
            color: white;
        }

        .btn-primary:hover {
            background: #1b4f6e;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(10, 43, 62, 0.2);
        }

        .btn-secondary {
            background: #e8eef5;
            color: #0a2b3e;
        }

        .btn-secondary:hover {
            background: #d4dce8;
        }

        .verification-footer {
            margin-top: 30px;
            font-size: 13px;
            color: #8ba0ae;
        }

        .verification-footer a {
            color: #1b4f6e;
            text-decoration: none;
            font-weight: 600;
        }

        .verification-footer a:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="verification-container">
        <div class="verification-icon">
            <i class="fas fa-envelope-open"></i>
        </div>

        <h1 class="verification-title">Verificação de E-mail</h1>

        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        <p class="verification-email">
            Enviamos um link de confirmação para:<br>
            <strong>{{ $client->email ?? 'seu email' }}</strong>
        </p>

        <div class="verification-message">
            <strong><i class="fas fa-info-circle"></i> Próximos Passos:</strong>
            Verifique sua caixa de entrada e sua pasta de spam. Clique no link de confirmação para ativar sua conta e começar a usar todos os recursos do Cartório Central.
        </div>

        <div class="btn-group">
            <form action="{{ route('client.email.resend') }}" method="POST" style="width: 100%;">
                @csrf
                <input type="hidden" name="email" value="{{ $client->email }}">
                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fas fa-redo"></i> Reenviar E-mail
                </button>
            </form>

            <a href="{{ route('login') }}" class="btn btn-secondary" style="width: 100%;">
                <i class="fas fa-arrow-left"></i> Voltar ao Login
            </a>
        </div>

        <div class="verification-footer">
            <p>Já confirmou seu e-mail? <a href="{{ route('login') }}">Faça login aqui</a></p>
            <p style="margin-top: 10px;">
                Não recebeu o e-mail? <a href="{{ route('client.email.resend-form') }}">Solicitar novo envio</a>
            </p>
        </div>
    </div>
</body>
</html>
