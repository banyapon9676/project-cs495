@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-dark table-striped">
                <thead class="table-secondary">
                        <tr>
                            <th scope="col">ชื่อสินค้า</th>
                            <th scope="col">ราคา</th>
                            <th scope="col">จำนวน</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($order)
                            @foreach ($order->order_details as $item)
                                <tr>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->amount }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td>{{ $order->total }}</td>
                                <td class="text-center">
                                    <form action="{{ route('orders.update', $order->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="value" value="checkout">
                                <button class="btn btn-outline-primary" type="submit">ชำระเงิน</button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection