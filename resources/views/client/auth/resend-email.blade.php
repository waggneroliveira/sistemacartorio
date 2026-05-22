<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reenviar E-mail de Confirmação</title>
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

        .resend-container {
            max-width: 450px;
            width: 100%;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 50px 40px;
        }

        .resend-icon {
            font-size: 50px;
            color: #ffd966;
            text-align: center;
            margin-bottom: 30px;
        }

        .resend-title {
            font-size: 26px;
            font-weight: 700;
            color: #0a2b3e;
            margin-bottom: 12px;
            text-align: center;
        }

        .resend-subtitle {
            font-size: 14px;
            color: #5c6f7e;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #0a2b3e;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s ease;
        }

        .form-group input:focus {
            border-color: #1b4f6e;
            box-shadow: 0 0 0 3px rgba(27, 79, 110, 0.1);
            outline: none;
        }

        .form-group input::placeholder {
            color: #8ba0ae;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: #0a2b3e;
            color: white;
            border: none;
            border-radius: 40px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background: #1b4f6e;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(10, 43, 62, 0.2);
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #5c6f7e;
        }

        .form-footer a {
            color: #1b4f6e;
            text-decoration: none;
            font-weight: 600;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
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

        .alert-info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }

        .info-message {
            background: #f0f4f8;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #1b4f6e;
            margin-bottom: 25px;
            font-size: 14px;
            color: #333;
            line-height: 1.6;
        }

        .info-message strong {
            color: #0a2b3e;
            display: block;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    <div class="resend-container">
        <div class="resend-icon">
            <i class="fas fa-envelope"></i>
        </div>

        <h1 class="resend-title">Reenviar Confirmação</h1>
        <p class="resend-subtitle">Digite seu e-mail para receber o link de confirmação</p>

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

        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif

        <div class="info-message">
            <strong><i class="fas fa-info-circle"></i> Como funciona:</strong>
            Informe o e-mail da sua conta e receberá um novo link de confirmação. Clique no link para ativar sua conta.
        </div>

        <form action="{{ route('client.email.resend') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">E-mail *</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="seu@email.com" 
                    value="{{ old('email') }}"
                    required
                >
                @error('email')
                    <div style="color: #dc3545; font-size: 12px; margin-top: 5px;">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-paper-plane"></i> Enviar Link de Confirmação
            </button>
        </form>

        <div class="form-footer">
            <p>Já tem uma conta? <a href="{{ route('login') }}">Fazer login</a></p>
        </div>
    </div>
</body>
</html>
