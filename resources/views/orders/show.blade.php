@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1>Pedido #{{ $order->id }}</h1>
        <p class="text-muted">Realizado em {{ $order->created_at->format('d \\de F \\de Y \\à\\s H:i') }}</p>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>Detalhes do Pedido</h4>
            </div>
            <div class="card-body">
                <p><strong>Status:</strong> 
                    <span class="badge bg-{{ $order->status == 'completed' ? 'success' : 'warning' }}">
                        {{ $order->status == 'completed' ? 'Concluído' : 'Pendente' }}
                    </span>
                </p>
                <p><strong>Total:</strong> R$ {{ number_format($order->total, 2, ',', '.') }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Itens do Pedido</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product->model }}</td>
                            <td>R$ {{ number_format($item->price, 2, ',', '.') }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>R$ {{ number_format($item->price * $item->quantity, 2, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                            <td>R$ {{ number_format($order->total, 2, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection