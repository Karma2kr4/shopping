// Thêm sản phẩm vào giỏ hàng
function addTocart(event) {
    event.preventDefault();
    let urlCart = $(this).data('url');

    $.ajax({
        type: "GET",
        url: urlCart,
        dataType: 'json',
        success: function (data) {
            if (data.code === 200) {
                $('.badge').text(data.totalQuantity); // Cập nhật badge hiển thị số lượng sản phẩm
                alert('Sản phẩm đã được thêm vào giỏ hàng');
            }
        },
        error: function () {
            alert('Đã xảy ra lỗi khi thêm sản phẩm vào giỏ hàng!');
        }
    });
}

$(function () {
    $(document).on('click', '.add-to-cart', addTocart);
});


function actionDelete(event) {
    event.preventDefault(); // Ngừng hành động mặc định
    let urlRequest = $(this).data('url'); // URL xóa sản phẩm
    let that = $(this);

    Swal.fire({
        title: "Bạn có chắc chắn không?",
        text: "Bạn sẽ không thể khôi phục lại điều này!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Có, xóa nó!"
    }).then((result) => {
        if (result.value) {
            // AJAX để xóa sản phẩm
            $.ajax({
                type: 'GET',
                url: urlRequest,
                success: function(data) {
                    if (data.code == 200) {
                        // Cập nhật lại giỏ hàng
                        $('.cart-wrapper').html(data.cart_component); // Render lại component
                        $('.badge').text(data.totalQuantity); // Cập nhật badge

                        Swal.fire({
                            title: "Đã xóa!",
                            text: "Sản phẩm đã được xóa khỏi giỏ hàng.",
                            icon: "success"
                        });
                    } else {
                        Swal.fire({
                            title: "Lỗi!",
                            text: data.message,
                            icon: "error"
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        title: "Lỗi!",
                        text: "Có lỗi xảy ra. Vui lòng thử lại.",
                        icon: "error"
                    });
                }
            });
        }
    });
}


function updateCart(event) {
    event.preventDefault(); // Ngừng hành động mặc định

    let urlUpdateCart = $('.update_cart_url').data('url'); // Lấy URL cập nhật giỏ hàng
    let cartItems = []; // Mảng chứa thông tin các sản phẩm cần cập nhật

    // Duyệt qua các sản phẩm trong giỏ hàng và lấy thông tin
    $('.cart_info tbody tr').each(function() {
        let id = $(this).find('input.quantity').data('id'); // ID sản phẩm
        let quantity = $(this).find('input.quantity').val(); // Số lượng mới

        // Thêm sản phẩm vào mảng nếu có giá trị
        if (id && quantity) {
            cartItems.push({
                id: id,
                quantity: quantity
            });
        }
    });

    // Gửi yêu cầu AJAX
    $.ajax({
        type: "GET",
        url: urlUpdateCart,
        data: { cartItems: cartItems }, // Gửi danh sách sản phẩm cần cập nhật
        success: function (data) {
            console.log(data);
            if (data.code === 200) {
                $('.cart-wrapper').html(data.cart_component);
                $('.badge').text(data.totalQuantity);
                Swal.fire({
                    title: "Cập nhật thành công!",
                    text: "Giỏ hàng đã được cập nhật.",
                    icon: "success"
                });
            } else {
                Swal.fire({
                    title: "Lỗi!",
                    text: "Có lỗi xảy ra khi cập nhật giỏ hàng.",
                    icon: "error"
                });
            }
        },
        error: function () {
            Swal.fire({
                title: "Lỗi!",
                text: "Kết nối tới máy chủ thất bại. Vui lòng thử lại.",
                icon: "error"
            });
        }
    });
}



$(function () {
    $(document).on('click', '#updateCartBtn', updateCart); // Sự kiện cập nhật
    $(document).on('click', '.action_delete', actionDelete); // Sự kiện xóa
});
