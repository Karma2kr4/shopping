function actionDelete(event){
    event.preventDefault();
    let urlRequest = $(this).data('url');
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
            $.ajax({
                type: 'GET',
                url: urlRequest,
                success: function(data){
                    if (data.code == 200){
                        that.parent().parent().remove();
                        Swal.fire({
                            title: "Đã xóa!",
                            text: "Đã xóa thành công.",
                            icon: "success"
                        });
                    }
                },
                error: function(){
                    // Xử lý lỗi nếu cần
                }
            });
        }
    });
}

$(function(){
    $(document).on('click', '.action_delete', actionDelete);
});
