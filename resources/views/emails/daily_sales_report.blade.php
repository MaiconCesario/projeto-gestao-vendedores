<!DOCTYPE html>
<html>
<head>
    <title>Relatório Diário de Vendas</title>
</head>
<body>
    <h1>Relatório Diário de Vendas</h1>
    
    <p>Total de vendas do dia: R$ {{ number_format($totalVendas, 2, ',', '.') }}</p>
    
    <h2>Vendas do Dia:</h2>
    <ul>
        @foreach($vendas as $venda)
            <li>{{ $venda->id }} - {{ $venda->valor_total }}</li>
        @endforeach
    </ul>
</body>
</html>
