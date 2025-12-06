<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: DejaVu Sans, sans-serif;
            background: #f0f2f5;
        }

        .page {
            background: white;
            margin: 25px;
            padding: 40px;
            border-radius: 18px;
            box-shadow: 0 0 20px rgba(0,0,0,0.15);
        }

        /* CABEÇALHO */
        .header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #ffcc00;
            padding-bottom: 15px;
        }

        .header img.logo {
            width: 130px;
            margin-right: 20px;
        }

        .header-title {
            font-size: 30px;
            font-weight: bold;
            color: #69330B;
        }

        .header-sub {
            font-size: 14px;
            color: #BA6626;
        }

        .info-box {
            background: linear-gradient(135deg, #ffcc00, #ffb300);
            padding: 15px 20px;
            border-radius: 10px;
            color: #69330B;
            font-weight: bold;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-box img {
            width: 22px;
        }

        /* TABELA */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 13px;
            border-radius: 12px;
            overflow: hidden;
        }

        table thead {
            background: #69330B;
            color: white;
            font-weight: bold;
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #e0e0e0;
        }

        table tr:nth-child(even) {
            background: #FFF3C0;
        }

        /* RODAPÉ */
        footer {
            text-align: center;
            margin-top: 35px;
            font-size: 12px;
            color: #BA6626;
            padding-top: 15px;
            border-top: 2px solid #ddd;
        }

        .footer-brand {
            color: #FFC72C;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="page">

    <div class="header">
        <img class="logo" src="{{ public_path('img/mercado.png') }}" alt="Logo">

        <div>
            <div class="header-title">Sorriso Supermercados</div>
            <div class="header-sub">Relatório Oficial — Pedidos e Itens</div>
        </div>
    </div>

   
    <div class="info-box">
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAWCAYAAADafVyIAAAACXBIWXMAAAsTAAALEwEAmpwYAAAA">
        Data de Emissão: <span>{{ now()->format('d/m/Y H:i') }}</span>
    </div>

   

    <table>
        <thead>
        <tr>
           
            <th>Usuário</th>
            <th>Endereço</th>
         
            <th>Status</th>
            <th>Item</th>
            <th>Descrição</th>
            <th>Usuario id</th>
  
        </tr>
        </thead>

        <tbody>

        @foreach ($dados as $item)

            @php
                $endereco = "{$item->rua} / {$item->estado} / {$item->cep}";
            @endphp

            <tr>
             
                <td>{{ $item->username }}</td>
                <td>{{ $endereco }}</td>
            
                <td>{{ $item->status }}</td>
                <td>{{ $item->itensName }}</td>
                <td>{{ $item->descricao }}</td>
                <td>{{ $item->userid }}</td>
            </tr>

        @endforeach

        </tbody>
    </table>

    <footer>
        Documento gerado automaticamente pelo sistema • 
        <span class="footer-brand">Sorriso Supermercados</span> — {{ date('Y') }}
    </footer>

</div>

</body>
</html>
