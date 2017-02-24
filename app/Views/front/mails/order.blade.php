<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Đơn đặt hàng mới</title>
  </head>
  <body>
    <p>Xin chào Admin <a href="http://dieuhoadaikin.com">dieuhoadaikin.com</a> !</p>
  	<p><strong>{{ $data['transaction']['object']->name or '' }}</strong> đã gửi 1 yêu cầu đặt hàng đến hệ thống {{ $data['transaction']['object']->created_at or '' }}</p>

  	<a href="{{ asset($adminCpAccess . '/orders/detail/' . $data['transaction']['object']->id) }}">Chi tiết đơn hàng #{{ $data['transaction']['object']->id }}</a>

  	<p>Thông tin liên hệ</p>
  	<table>
  		<tr>
  			<td>Họ tên:</td>
  			<td>{{ $data['transaction']['object']->name }}</td>
  		</tr>
  		<tr>
  			<td>Email:</td>
  			<td>{{ $data['transaction']['object']->email }}</td>
  		</tr>
  		<tr>
  			<td>Số ĐT:</td>
  			<td>{{ $data['transaction']['object']->phone }}</td>
  		</tr>
  		<tr>
  			<td>Địa chỉ:</td>
  			<td>{{ $data['transaction']['object']->address }}</td>
  		</tr>
  	</table>

  	<h5>Thông tin đơn hàng của {{ $data['transaction']['object']->name }}</h5>
  	<div class="row col-md-12 cart-item">
  	    <div class="table-responsive cart_info">
  	        <table style="boder: 1px solid #ccc; text-align: center;">
  	            <thead>
  	                <tr style="background: #1F79A7; color: #FFF;">
  	                    <th>Mã Sản phẩm</th>
  	                    <th class="image" width="80">Sản phẩm</th>
  	                    <th width="170"></th>
  	                    <th class="">Giá tiền</th>
  	                    <th class="">Số lượng</th>
  	                    <th class="price">Tổng tiền</th>
  	                </tr>
  	            </thead>
        				@foreach($data['orders'] as $item)
                  <?php
                    $product = \App\Models\Product::getById($item->product_id);
                  ?>
  	                <tbody>
  	                    <tr>
                            <td>
                              {{ $product->sku }}
                            </td>
  	                        <td>
  	                        	<img src="{{ asset($product->thumbnail) }}" alt="{{ $product->title }}" width="150"/>
  	                        </td>
  	                        <td>
  	                            <h4><a href="{{ _getProductLink($product->slug) }}"> {{ $product->title }} </a></h4>
  	                        </td>
  	                        <td>
  	                            <p>{{ _formatPrice($product->price) }}</p>
  	                        </td>
  	                        <td>
  	                            <div>
                                  {{ $item->qty }}
  	                            </div>
  	                        </td>
  	                        <td>
  	                            <p>{{ _formatPrice($product->price*$item->qty) }}</p>
  	                        </td>
  	                    </tr>
    					@endforeach
  						<tr style="background: #1F79A7; color: #FFF;">
  							<td colspan="6">Tổng cộng</td>
  							<td>{{ _formatPrice($data['transaction']['object']->amount) }}</td>
  						</tr>
  	                </tbody>
  	            </table>
  	        </div>
  	    </div>
  	</div>
  </body>
</html>
