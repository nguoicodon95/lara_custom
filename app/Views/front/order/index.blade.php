@extends('front._master')

@section('css')
  <style>
      .main-wrapper {
          margin-bottom: 10px;
      }
  </style>
@endsection

@section('js')
  <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
@endsection

@section('js-init')
<script>
	$.validator.addMethod("regx", function(value, element, regexpr) {
	    return regexpr.test(value);
	}, "Số điện thoại không hợp lệ.");
	$(function() {
	    $("#_form_confirm").validate({
	        rules: {
	            address: "required",
	            name: {
	                required: true,
	            	minlength: 2,
	            },
	            phone: {
	            	required: true,
					number: true,
					regx: /^(0|\+[0-9]{1,5})([1-9][0-9]{8}?([0-9]{0,1}))$/,
	            },
	            email: {
	                required: true,
	                email: true
	            },
	        },
	        messages: {
	            phone: {
	            	required: "Vui lòng nhập số điện thoại",
	            	number: "Số điện thoại phải nhập bằng số",
	            },
	            address: "Vui lòng nhập địa chỉ",
	            name: {
	            	required: "Vui lòng nhập họ và tên",
	            	minlength: "Họ và tên ít nhất 2 kí tự",
	            },
	            email: {
	            	required: "Vui lòng nhập e-mail",
	            	email: "E-mail không đúng định dạng",
	            },
	        },
	        submitHandler: function(form) {
	            form.submit();
	        }
	    });
});
</script>
@endsection

@section('content')
  @if(isset($shoppingCart['cartItems']))
  	<section class="main-wrapper">
      <div class="order">
      		@if(Session::has('errors'))
				<div class="alert alert-danger">Đã có sự cố trong quá trình đặt hàng của bạn. Hãy thử lại!</div>
      		@endif
            <h4 class="group_title"><span>GIỎ HÀNG</span></h4>
            <div class="order">
                <style>
                    table.cart-item {
                        width: 100%;
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
                <form id="_form_confirm" method="post" autocomplete="off">
                    {{ csrf_field() }}
                    <table class="cart-item">
                        <tr>
                            <th colspan=2>Sản phẩm</th>
                            <th>Giá tiền</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th></th>
                        </tr>
                    @foreach($shoppingCart['cartItems'] as $item)
                        <tr>
                            <td class="text-center">
                                <img src="{{ asset($item->thumbnail) }}" alt="{{ $item->title }}" width="75">
                            </td>
                            <td>
                                <a href="{{ _getProductLink($item->slug) }}">{{ $item->title }}</a>
                            </td>
                            <td>
                                <strong>{{ _formatPrice($item->price) }}</strong>
                            </td>
                            <td>
                                <select class="quantity form-control" pid="{{ $item->id }}">
                                        @for($i=1; $i < 6; $i++)
                                        <option value="{{ $i }}" {{ $item->quantity == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                </select>
                            </td>
                            <td><strong>{{ _formatPrice($item->price * $item->quantity) }}</strong></td>
                            <td><a id="{{$item->id}}" class="deteteElem" title="Xóa sản phẩm khỏi giỏ hàng">x</a></td>
                        </tr>
                    @endforeach
                        <tr>
                            <td class="text-center"><strong>Tổng cộng: </strong></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <strong>{{ _formatPrice($shoppingCart['cartSubTotal']) }}</strong>
                                <input type="hidden" name="amount" value="{{ $shoppingCart['cartSubTotal'] }}">
                            </td>
                            <td></td>
                        </tr>
                    </table>
                    <a href="{{ asset(Request::path()) == URL::previous() ? asset('/') : URL::previous() }}" class="btn btn-default pull-right">Tiếp tục mua hàng</a>
                    <div class="loading" style="display:none">
                        <div class="ctnr animated">
                            <span class="throbber"></span>
                            <p>Đang xử lý... Vui lòng chờ trong giây lát.</p>
                        </div>
                        <div class="ovl"></div>
                    </div>
                    <div class="clearfix"></div>
                    <h4 class="group_title"><span>THÔNG TIN ĐẶT HÀNG</span></h4>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Họ và tên" required>
                            <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" required>
                            <input type="text" class="form-control" pattern="^(0|\+[0-9]{1,5})([1-9][0-9]{8}?([0-9]{0,1}))$" id="phone" name="phone" placeholder="Số điện thoại" required>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Địa chỉ liên hệ" required>
                        </div>
                        <div class="col-md-6">
                            <textarea name="note" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Gửi đơn hàng</button>
                        </div>
                    </div>
                </form>
            </div>
      </div>
  </section>
@endif
@endsection
