@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1>Carrinho de Compras</h1>
    </div>
</div>

@if(count($cartItems) > 0)
<div class="row">
    <div class="col-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Total</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                <tr>
                    <td>
                        <img src="{{ $item['image'] ? '/images/' . $item['image'] : 'https://via.placeholder.com/50' }}" width="50" height="50" class="me-2 img-product-cart">
                        {{ $item['model'] }}
                    </td>
                    <td>${{ number_format($item['price'], 2) }}</td>
                    <td>
                        <form action="{{ route('cart.update', $item['product_id']) }}" method="POST" class="d-flex gap-2">
                            @csrf
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control" style="width: 70px;">
                            <button type="submit" class="btn btn-sm btn-primary">Atualizar</button>
                        </form>
                    </td>
                    <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $item['product_id']) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Remover</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                    <td colspan="2">${{ number_format($total, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-12 text-end">
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Continuar Comprando</a>
        <a href="{{ route('checkout.index') }}" class="btn btn-primary">Ir para o Checkout</a>
    </div>
</div>
@else
<div class="row">
    <div class="col-12">
        <div class="alert alert-info">
            Seu carrinho está vazio. <a href="{{ route('products.index') }}">Veja nossos produtos</a>.
        </div>
    </div>
</div>
@endif
@endsection