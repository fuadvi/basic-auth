function refreshData() {
    $.ajax({
        url: '/api/order',
        methods: 'GET',
        dataType: 'json',
        headers: {'token': window.localStorage['token'] },
        success: (res) => {
            console.log(res)
            var data = res.data.data;
            var content = '';

            for (let i = 0; i < data.length; i++) {
                var item = data[i];
                var btnhapus = `<a  class='link-hapus' href='#' data-id='${item.id}' >Hapus</a>`;
                var btnedit = `<a  class='link-edit' href='#' data-id='${item.id}' >edit</a>`;

                content +=`
                    <tr>
                        <td>${i+1}</td>
                        <td>${item.order_date} <br /> ${btnhapus} | ${btnedit}</td>
                        <td>${item.product_title}</td>
                        <td>${item.price}</td>
                        <td>${item.qty}</td>
                        <td>${item.first_name} ${item.last_name}</td>
                    </tr>
                `;
            }
            $('table.table tbody').html(content);
        },
        error:(res,status,err) =>{
            console.log(res);
            alert('Terjadi kesalahan');
        }
    });

}

function hapus(id) {

}

function edit(id) {

}


document.addEventListener('DOMContentLoaded',(c) => {
    refreshData();

    $('body').on('click','a.link-hapus',(e) =>{
        var c = confirm('Apakah Yakin Mau Hapus Data');

        if (c) {
            var id = $(e.currentTarget).data('id');
            hapus(id)
        }
    });

    $('body').on('click','a.link-edit',(e) =>{
        var c = confirm('Apakah Yakin Mau edit Data');

        if (c) {
            var id = $(e.currentTarget).data('id');
            edit(id)
        }
    });



});
