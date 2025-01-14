<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receituário Médico</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f4f4f9;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #007BFF;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header .logo {
            width: 100px;
        }

        .header .company-info {
            text-align: right;
        }

        .header .company-info h1 {
            margin: 0;
            font-size: 1.5em;
            color: #007BFF;
        }

        .header .company-info p {
            margin: 0;
            font-size: 0.9em;
            color: #555;
        }

        .doctor-info {
            margin-bottom: 20px;
        }

        .doctor-info h2 {
            margin: 0;
            font-size: 1.2em;
            color: #333;
        }

        .doctor-info p {
            margin: 5px 0 0;
            font-size: 0.9em;
            color: #555;
        }

        .content {
            margin-bottom: 40px;
           height: 585px;
        }

        .content p {
            font-size: 1em;
            line-height: 1.5;
            color: #333;
        }

        .footer {
            text-align: right;
        }

        .footer .signature {
            margin-top: 50px;
            text-align: center;
        }

        .footer .signature hr {
            border: none;
            border-top: 1px solid #555;
            margin: 5px auto;
            width: 200px;
        }

        .footer .signature p {
            margin: 0;
            font-size: 0.9em;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="logo.png" alt="Logo da Empresa" class="logo">
            <div class="company-info">
                <h1>Clínica Vida e Saúde</h1>
                <p>Rua Exemplo, 123 - Centro</p>
                <p>Telefone: (11) 98765-4321</p>
                <p>Email: contato@clinicavida.com.br</p>
            </div>
        </div>

        <div class="doctor-info">
            <h2>Dr(a). Maria Silva</h2>
            <p>CRM: 12345/SP</p>
            <p>Especialidade: Clínica Geral</p>
        </div>

        <div class="content">
            <p><strong>Receita:</strong></p>
            <p>{{ $prescricao }}<br></p>
        </div>

        <div class="footer">
            <div class="signature">
                <hr>
                <p>Assinatura do Médico</p>
            </div>
        </div>
    </div>
</body>
</html>
