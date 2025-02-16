<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>Bạn muốn làm gì tiếp theo?</h3>
            <p>Kiểm tra lại thông tin</p>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="total_area">
                    <ul>
                        <li>Tổng số lượng sản phẩm <span>{{ $carts->sum('quantity') }}</span></li>
                        <li>Total <span>{{ number_format($total) }} VNĐ</span></li>
                    </ul>
                    @if($carts->isEmpty())
                        <div style="text-align: center;" class="alert alert-warning">
                            Giỏ hàng của bạn đang trống. Vui lòng thêm sản phẩm vào giỏ hàng trước khi đặt hàng.
                        </div>
                    @else
                        <a class="btn btn-default check_out" href="{{ route('checkOut') }}">Đặt hàng</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>