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
            color: #ffb300;
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
            font-size: 15px;
            border-radius: 12px;
            overflow: hidden;
        }

        table thead {
            background: #69330B;
            color: white;
            font-weight: bold;
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #e0e0e0;
        }

        table tr:nth-child(even) {
            background: #69330B;
        }

        table tr:hover td {
            background: #69330B;
        }

        /* TOTAL */
        .total-box {
            margin-top: 25px;
            font-size: 22px;
            font-weight: bold;
            text-align: right;
            color: #2d3436;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
        }

        .total-box img {
            width: 30px;
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

@php
    $total = 0;
@endphp

<div class="page">

    
    <div class="header">
        <img class="logo" src="{{ public_path('img/mercado.png') }}" alt="Logo">

        <div>
            <div class="header-title">Sorriso Supermercados</div>
            <div class="header-sub">Relatório Oficial — Itens Registrados</div>
        </div>
    </div>

    <!-- INFO BOX COM ÍCONE -->
    <div class="info-box">
        <img src="data:image/png;base64,
        iVBORw0KGgoAAAANSUhEUgAAABgAAAAWCAYAAADafVyIAAAACXBIWXMAAAsTAAALEwEAmpwYAAAA
        B3RJTUUH5QgIECYjZMhUlAAAAMJJREFUSMftlcENwjAMRV+QAWYAI2QAI2QAJmAAmYACdgAjZAAj
        ZACQ0nSWWEDuJeayQMZT6ZX0hgqP/d9vywgq6Z9erjRzCQXDpUe1koRaSPo6e7iT730GUNShUMpV
        PpO4m4rHuIAQ3Gscx3rgIxeqmoeZaZX6mE6oPD58x35H0TADaBrZEcD3gjKhsR4HIX66D+QP9enZ
        wcYAAAAASUVORK5CYII=">

        Data de Emissão: <span>{{ now()->format('d/m/Y H:i') }}</span>
    </div>

    <!-- TABELA DE ITENS -->
    <table>
        <thead>
            <tr>
                <th>Nome do Item</th>
                <th>Preço</th>
            </tr>
        </thead>

        <tbody>
        @foreach ($dados as $item)
            @php
                $partes = explode(' - ', $item->item_formatado);
                $nome = $partes[0] ?? '';
                $preco = $partes[1] ?? '0';

                // Remove "R$" e soma
                $valor = floatval(str_replace(['R$', ','], ['', '.'], $preco));
                $total += $valor;
            @endphp

            <tr>
                <td>{{ $nome }}</td>
                <td>{{ $preco }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    
    <div class="total-box">
        <img src="data:image/png;base64,
        iVBORw0KGgoAAAANSUhEUgAAABgAAAAWCAYAAADafVyIAAACQElEQVR4nI2UTW7TQBCGv1mGNAzb
        gE0wBvZkAA2YQAbYQAbIAVsALREDZkADZsAbGIAH2EAH2RAHyW1jRQp6qFNj65S6aN96ZM2efy93
        6/49AglAqakiyF+stixkmfsVNHYsYvwdivgLPgAvhT8Gf3eFQ8EuQigBlz5fRdEzysb8xOgwxDFUY
        JbHqr2raXIiQunlslqY5T2r8j04YfGLwRoTSesxNUFDXL9uBeb5GsyhQOdE31E4n4t4DccnE9vrF
        7rRk5v0zzakDx4zY/boYYGr2susx6bwyodH4qzM0gc3KJ2YMBX1AHzrc4vh3OJbGdv8ImZ/Sc7Vc
        bI0U1FVLtZL1NVr7DiIP9N6pN1Nsx3Rp3XIan+FJxuxMxDPZWS9Vyuk3F7S3w7Dnk3a1JpN96CBQ
        ZtPFl1FdYyqS/fWznuaCG2l9VmOAXoJ2i8LJIYur2jcWcA6iYG3PaY5E9O+V1YxAECEV4VpWw2gw
        XjeRGna43EIBgzHuLlHotEViT7V6czS4QhIwJIYBFvToNiMQzmiEJeZVrDCTnhgypKekJyAAoQ1r
        gIGeJ+Ww2gw2b9f0fX0HoPazTA/gkGEXUXMaLLq5yRvCNr4C0sgGAaHo9dZYkTfGZNVVRFlEopYy
        uWw2A1t/F7fs/3Gzdh0dX8GZFODdgNpTi27C/7hECabuX41sJLdnOjFkWDXLI4sdAlnOACIRbkI/
        mgAAAABJRU5ErkJggg==">

        Total Geral: R$ {{ number_format($total, 2, ',', '.') }}
    </div>

    <footer>
        Documento gerado automaticamente pelo sistema • 
        <span class="footer-brand">Sorriso Supermercados</span> — {{ date('Y') }}
    </footer>

</div>

</body>
</html>
