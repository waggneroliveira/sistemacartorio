<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reenvio - Confirme seu E-mail</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
    <table class="wrapper" width="600" border="0" cellspacing="0" cellpadding="0" align="center" style="background-color: #fff; margin: 20px auto; border-radius: 8px; overflow: hidden;">
        <tbody>
            <!-- Header -->
            <tr>
                <td colspan="2" style="background: linear-gradient(135deg, #0a2b3e 0%, #1b4f6e 100%); text-align: center; padding: 40px 0;">
                    <h1 style="color: #fff; margin: 0; font-size: 28px;">Cartório Central</h1>
                </td>
            </tr>

            <!-- Main Content -->
            <tr>
                <td colspan="2" style="padding: 40px 40px;">
                    <h2 style="color: #0a2b3e; font-size: 24px; margin: 0 0 20px; text-align: center;">Reenvio - Confirme seu E-mail</h2>
                    
                    <p style="color: #555; font-size: 16px; line-height: 1.6; margin-bottom: 25px;">
                        Olá {{ $client->name }},
                    </p>

                    <p style="color: #555; font-size: 16px; line-height: 1.6; margin-bottom: 25px;">
                        Você solicitou o reenvio do link de confirmação de e-mail. Clique no botão abaixo para confirmar seu endereço de e-mail e ativar sua conta:
                    </p>

                    <p style="text-align: center; margin-bottom: 30px;">
                        <a href="{{ $confirmUrl }}" style="background-color: #0a2b3e; color: #fff; padding: 14px 32px; text-decoration: none; border-radius: 40px; font-size: 16px; font-weight: bold; display: inline-block; transition: background-color 0.3s;">
                            Confirmar E-mail
                        </a>
                    </p>

                    <p style="color: #888; font-size: 14px; line-height: 1.6; text-align: center; margin-bottom: 25px;">
                        Ou copie e cole este link no seu navegador:<br>
                        <code style="color: #0a2b3e; background-color: #f0f0f0; padding: 8px 12px; border-radius: 4px; word-break: break-all; display: inline-block;">{{ $confirmUrl }}</code>
                    </p>

                    <hr style="border: none; border-top: 1px solid #e0e0e0; margin: 30px 0;">

                    <p style="color: #888; font-size: 14px; line-height: 1.6;">
                        Se você não solicitou este reenvio, por favor ignore este e-mail.
                    </p>

                    <p style="color: #888; font-size: 14px; line-height: 1.6; margin-bottom: 0;">
                        Atenciosamente,<br>
                        <strong>Equipe Cartório Central</strong>
                    </p>
                </td>
            </tr>

            <!-- Footer -->
            <tr>
                <td colspan="2" style="background: #0a2b3e; padding: 25px 40px; text-align: center;">
                    <p style="color: #fff; font-size: 12px; margin: 0; line-height: 1.6;">
                        © 2026 Cartório Central. Todos os direitos reservados.<br>
                        <a href="{{ route('lgpd-index') }}" style="color: #ffda7c; text-decoration: none;">Política de Privacidade</a> | 
                        <a href="{{ route('contact') }}" style="color: #ffda7c; text-decoration: none;">Contato</a>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>
