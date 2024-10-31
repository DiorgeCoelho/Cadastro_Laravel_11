<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Produtos</title>
</head>

<body style="font-size: 12px;">
    <h2 style="text-align: center">Produtos</h2>

    <table style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr style="background-color: #adb5bd;">
                <th style="border: 1px solid #ccc;">ID</th>
                <th style="border: 1px solid #ccc;">Descrição</th>
                <th style="border: 1px solid #ccc;">Valor</th>
                {{-- <th style="border: 1px solid #ccc;">Vencimento</th> --}}
            </tr>
        </thead>

        <tbody>
            @forelse ($produtos as $produto)
                <tr>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $produto->id }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ $produto->descricao }}</td>
                    <td style="border: 1px solid #ccc; border-top: none;">{{ 'R$ ' . number_format($produto->valor, 2, ',', '.') }}</td>
                    {{-- <td style="border: 1px solid #ccc; border-top: none;">{{ \Carbon\Carbon::parse($produto->vencimento)->tz('America/Sao_Paulo')->format('d/m/Y') }}</td> --}}
                </tr>
            @empty
                <tr>
                    <td colspan="4">Nenhuma conta encontrada!</td>
                </tr>
            @endforelse
        </tbody>

    </table>
</body>

</html>
