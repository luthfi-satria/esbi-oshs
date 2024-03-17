$(document).ready(function(){
    $('#form-registrasi').on('submit', register);
});

function register(){
    const validation = validateRegister();
    if(validation){
        $.ajax({
            method: "post",
            url: "/",
            data: JSON.stringify(validation),
            dataType: "json",
        })
        .done(function(data, status, XHR){
            if(data.code == 406){
                setTimeout(() => {
                    $('#form-registrasi #alert-text').text(data?.message);
                    $('#form-registrasi .alert').toggleClass('hidden show');
                }, 400);
            }
            else{
                window.location.href="/signin";
            }
        })
        .fail(function(XHR){
            console.log("error", XHR);
        })
        ;
    }
    return false;
}

function validateRegister(){
    const data = $('#form-registrasi').serializeArray();
    $('#form-registrasi .error').html('');
    let validate = {};
    let i = 0;
    for(const items of data){
        if(!items.value){
            $('.error').eq(i).html(items.name+' harus terisi');
            return false;
        }
        else{
            validate = {...validate, [`${items.name}`]:items.value}
        }
        i++;
    }
    return validate;
}

function deleteUser(id){
    $.ajax({
        type: "DELETE",
        url: "/delete/"+id,
        dataType: "json",
    })
    .done(function(data, status, XHR){
        if(data.code == 406){
            alert(data?.message);
        }
        else{
            window.location.reload();
        }
    })
    .fail(function(XHR){
        console.log("error", XHR);
    })
    ;
}