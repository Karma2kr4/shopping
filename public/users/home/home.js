

// js số lượng sản phẩm
document.addEventListener("DOMContentLoaded", function () {
    const quantityInputs = document.querySelectorAll('.cart_quantity_input');
    
    quantityInputs.forEach(input => {
        const btnDecrease = input.previousElementSibling;  // Nút -
        const btnIncrease = input.nextElementSibling;     // Nút +

        // Xử lý nút tăng (+)
        btnIncrease.addEventListener('click', function (e) {
            e.preventDefault();
            let quantity = parseInt(input.value);
            if (quantity < 99) { // Giới hạn số lượng tối đa là 99
                input.value = quantity + 1;
            }
        });

        // Xử lý nút giảm (-)
        btnDecrease.addEventListener('click', function (e) {
            e.preventDefault();
            let quantity = parseInt(input.value);
            if (quantity > 1) { // Giới hạn số lượng tối thiểu là 1
                input.value = quantity - 1;
            }
        });
    });
});
