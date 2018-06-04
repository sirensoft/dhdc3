yii.confirm = function (message, okCallback, cancelCallback) {
    swal({
        title:message,
        //text: "Your will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "No",
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes",
        closeOnConfirm: true
    }, okCallback);
};


