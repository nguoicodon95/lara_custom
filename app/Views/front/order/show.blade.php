@extends('front._master')

@section('css')
@endsection

@section('js')
@endsection

@section('js-init')
@endsection

@section('content')
<style>
    table.cart-item {
        width: 100%;
        text-align: center;
    }
    .cart-item th {
        text-align: center;
        padding: 10px;
        border: 1px solid #CFCFCF;
        font-weight: bold;
        white-space: nowrap;
        color: #000;
        vertical-align: top;
    }
    .cart-item td {
        padding: 10px;
        border: 1px solid #CFCFCF;
    }
    .order .form-control, .order .btn {
        border-radius: 0;
    }
    .order .form-control {
        margin: 22px 0;
    }
</style>
  	<section class="main-wrapper">
      <div class="order">
        <h4 class="group_title">ĐẶT HÀNG THÀNH CÔNG</h4>
        <table class="cart-item">
            <tr>
                <th colspan=2>Sản phẩm</th>
                <th>Giá tiền</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
        @foreach($transaction->orders as $row)
            <?php $product = $row->products; ?>
            <?php $item = $product->productContent[0]; ?>
            <tr>
                <td>
                    <img src="{{ asset('uploads/small/'.$item->thumbnail) }}" alt="{{ $item->title }}" width="75">
                </td>
                <td>
                    <a href="{{ _getProductLink($item->slug) }}">{{ $item->title }}</a>
                </td>
                <td>
                    <strong>{{ _formatPrice($row->amount) }}</strong>
                </td>
                <td><strong>{{ $row->qty }}</strong></td>
                <td></td>
            </tr>
        @endforeach
            <tr>
                <td><strong>Tổng cộng: </strong></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <strong>{{ _formatPrice($transaction->amount) }}</strong>
                </td>
            </tr>
        </table>
        
        
        <h4 class="group_title"></h4>
        <div class="row">
            <div class="col-md-12">
                <p>Cảm ơn bạn {{ $transaction->name }} đã đặt hàng tại <a href="http://ngoctraiphuquocan.com">ngoctraiphuquocan.com</a>!</p>
                <p>Đơn hàng của bạn đã được gửi đến chúng tôi.</p>
                <p>Chúng tôi liên hệ lại với bạn để xác nhận thông tin đặt hàng.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <a href="{{ asset('/') }}" style="color: #4a90e2; font-weight: bold;">Quay về trang chủ</a>
            </div>
        </div>
      </div>
  </section>
@endsection
