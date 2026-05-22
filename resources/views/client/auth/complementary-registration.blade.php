<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Complementar</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- jQuery and Mask -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
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
            padding: 40px 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
            color: white;
        }

        .header h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 16px;
            opacity: 0.9;
        }

        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }

        .progress-bar {
            width: 100%;
            height: 4px;
            background: #e8eef5;
            border-radius: 2px;
            margin-bottom: 30px;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            background: linear-gradient(90deg, #0a2b3e 0%, #1b4f6e 100%);
            width: 50%;
        }

        .form-section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #0a2b3e;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f4f8;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-title i {
            color: #ffd966;
            font-size: 18px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-row.full {
            grid-template-columns: 1fr;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 13px;
            font-weight: 600;
            color: #0a2b3e;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-group input,
        .form-group select {
            padding: 12px 14px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s ease;
            background: #fefefe;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #1b4f6e;
            box-shadow: 0 0 0 3px rgba(27, 79, 110, 0.1);
            outline: none;
        }

        .form-group input::placeholder {
            color: #8ba0ae;
        }

        .form-group.optional::after {
            content: " (opcional)";
            font-size: 11px;
            color: #8ba0ae;
            margin-left: 2px;
        }

        .error-text {
            color: #dc3545;
            font-size: 12px;
            margin-top: 4px;
        }

        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 30px;
            justify-content: flex-end;
        }

        .btn {
            padding: 12px 32px;
            border: none;
            border-radius: 40px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: #0a2b3e;
            color: white;
            flex: 1;
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

        .info-box {
            background: #f0f4f8;
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid #1b4f6e;
            margin-bottom: 30px;
            font-size: 14px;
            color: #333;
            line-height: 1.6;
        }

        .info-box strong {
            color: #0a2b3e;
        }

        .alert {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .card {
                padding: 30px 20px;
            }

            .header h1 {
                font-size: 24px;
            }

            .button-group {
                flex-direction: column-reverse;
            }

            .btn-primary {
                flex: unset;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-id-card"></i> Cadastro Complementar</h1>
            <p>Preencha seus dados para completar o cadastro</p>
        </div>

        <div class="card">
            <div class="progress-bar">
                <div class="progress"></div>
            </div>

            @if ($errors->any())
                <div class="alert alert-error">
                    <strong><i class="fas fa-exclamation-circle"></i> Erros ao preencher o formulário:</strong>
                    <ul style="margin: 10px 0 0 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="info-box">
                <strong><i class="fas fa-info-circle"></i> Sobre este formulário:</strong><br>
                Complete seus dados pessoais e endereço. Estes dados serão usados para validar seus serviços de cartório. Você pode pular esta etapa agora e completar depois.
            </div>

            <form action="{{ route('complementary-add-on.store') }}" method="POST">
                @csrf

                <!-- Seção Dados Pessoais -->
                <div class="form-section">
                    <div class="section-title">
                        <i class="fas fa-user"></i> Dados Pessoais
                    </div>

                    <div class="form-row full">
                        <div class="form-group optional">
                            <label for="cpf">CPF</label>
                            <input 
                                type="text" 
                                id="cpf" 
                                name="cpf" 
                                placeholder="000.000.000-00"
                                value="{{ old('cpf', $client->cpf) }}"
                            >
                            @error('cpf')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group optional">
                            <label for="birth_date">Data de Nascimento</label>
                            <input 
                                type="date" 
                                id="birth_date" 
                                name="birth_date"
                                value="{{ old('birth_date', $client->birth_date) }}"
                            >
                            @error('birth_date')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group optional">
                            <label for="gender">Gênero</label>
                            <select id="gender" name="gender">
                                <option value="">Selecione...</option>
                                <option value="male" {{ old('gender', $client->gender) == 'male' ? 'selected' : '' }}>Masculino</option>
                                <option value="female" {{ old('gender', $client->gender) == 'female' ? 'selected' : '' }}>Feminino</option>
                                <option value="other" {{ old('gender', $client->gender) == 'other' ? 'selected' : '' }}>Outro</option>
                            </select>
                            @error('gender')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Seção Endereço -->
                <div class="form-section">
                    <div class="section-title">
                        <i class="fas fa-map-marker-alt"></i> Endereço
                    </div>

                    <div class="form-row full">
                        <div class="form-group optional">
                            <label for="street">Rua/Avenida</label>
                            <input 
                                type="text" 
                                id="street" 
                                name="street" 
                                placeholder="Nome da rua"
                                value="{{ old('street', $client->street) }}"
                            >
                            @error('street')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group optional">
                            <label for="number">Número</label>
                            <input 
                                type="text" 
                                id="number" 
                                name="number" 
                                placeholder="000"
                                value="{{ old('number', $client->number) }}"
                            >
                            @error('number')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group optional">
                            <label for="complement">Complemento</label>
                            <input 
                                type="text" 
                                id="complement" 
                                name="complement" 
                                placeholder="Apt, sala, etc"
                                value="{{ old('complement', $client->complement) }}"
                            >
                            @error('complement')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group optional">
                            <label for="city">Cidade</label>
                            <input 
                                type="text" 
                                id="city" 
                                name="city" 
                                placeholder="Sua cidade"
                                value="{{ old('city', $client->city) }}"
                            >
                            @error('city')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group optional">
                            <label for="state">Estado</label>
                            <input 
                                type="text" 
                                id="state" 
                                name="state" 
                                placeholder="BA"
                                maxlength="2"
                                value="{{ old('state', $client->state) }}"
                            >
                            @error('state')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row full">
                        <div class="form-group optional">
                            <label for="zip_code">CEP</label>
                            <input 
                                type="text" 
                                id="zip_code" 
                                name="zip_code" 
                                placeholder="00000-000"
                                value="{{ old('zip_code', $client->zip_code) }}"
                            >
                            @error('zip_code')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="button-group">
                    <form action="{{ route('complementary-add-on.skip') }}" method="POST" style="flex: 1; margin-right: 12px;">
                        @csrf
                        <button type="submit" class="btn btn-secondary" style="width: 100%;">
                            <i class="fas fa-times"></i> Pular por enquanto
                        </button>
                    </form>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i> Completar Cadastro
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Máscara para CPF
            $('#cpf').mask('000.000.000-00');
            
            // Máscara para CEP
            $('#zip_code').mask('00000-000');
        });
    </script>
</body>
</html>
