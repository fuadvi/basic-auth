document.addEventListener('DOMContentLoaded',(c) => {

    $('button#btn-login').on('click',() => {
        var email = $('input[name=email]').val();
        var password = $('input[name=password]').val();

        $.ajax({
            url: '/api/auth',
            dataType: 'json',
            methods: 'GET',
            headers : {
                'Authorization': 'basic ' + window.btoa(email + ':' + password)
            },
            success: (msg)=>{
                alert('Selamat Datang '+ msg.data.first_name+' '+ msg.data.last_name);
                window.localStorage.setItem('token',msg.data.token);
                window.location = '/list-order';
            },
            error:(req,status,err) =>{
                console.log(req);
                alert(req.responseJSON.error[0]);
            }
        });
    });

});
