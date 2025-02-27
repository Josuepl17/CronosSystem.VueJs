<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receituário Médico</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #fff;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #007BFF;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #007BFF;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .header .company-info {
            text-align: right;
        }

        .header .company-info h1 {
            margin: 0;
            font-size: 1.6em;
            color: #007BFF;
        }

        .header .company-info p {
            margin: 3px 0;
            font-size: 1em;
            color: #555;
        }

        .doctor-info {
            margin-bottom: 25px;
            padding-left: 15px;
            border-left: 2px solid #007BFF;
            border-radius: 8px;
        }

        .doctor-info h2 {
            margin: 0;
            font-size: 1.3em;
            color: #007BFF;
        }

        .doctor-info p {
            margin: 5px 0 0;
            font-size: 1em;
            color: #555;
        }

        .content {
            margin-bottom: 40px;
            padding: 15px;
            border-radius: 8px;
            height: auto;
            min-height: 150px;
            word-wrap: break-word;
            overflow-wrap: break-word;
            color: #333;
        }

        .content p {
            font-size: 1.1em;
            line-height: 1.6;
            color: #333;
            margin: 0;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
        }

        .footer .signature {
            margin-top: 50px;
            text-align: center;
        }

        .footer .signature hr {
            border: none;
            border-top: 2px solid #007BFF;
            margin: 5px auto;
            width: 250px;
        }

        .footer .signature p {
            margin: 0;
            font-size: 1em;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="company-info">
                <h1>{{ $empresa->razao_social }}</h1>
                <p>{{ $empresa->endereco }} - {{ $empresa->cidade }}</p>
                <p>Telefone: {{ $empresa->telefone }}</p>
                <p>Email: contato@clinicavida.com.br</p>
            </div>
        </div>

        <div class="doctor-info">
            <h2>Dr(a). {{ $medico->nome }}</h2>
            <p>CRM/CRP: {{ $medico->crp }}</p>
            <p>Especialidade: {{ $medico->especialidade }}</p>
        </div>

        <div class="content">
            <p><strong>{{ $tipoDocumento }}</strong></p>
            <p>{{ $prescricao }}</p>
        </div>

        <div class="footer">
            <div class="signature">
                <hr>
                <p>Assinatura do Médico(a)</p>
            </div>
        </div>
    </div>
</body>

</html>