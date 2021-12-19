function refreshData() {
    $.ajax({
        url: '/api/orders',
        methods: 'GET',
        type: 'json',
        headers: {'token': window.localStorage['token'] },
        success: (res) => {
            console.log(res)
            const data = res.data.data;
            const content = '';

            for (let i = 0; i < data.length; i++) {
                const item = data[i];
                const btnhapus = `<a  class='link-hapus' href='#' data-id='${item.id}' >Hapus</a>`;
                const btnedit = `<a  class='link-edit' href='#' data-id='${item.id}' >edit</a>`;

                content +=`
                    <tr>
                        <td>${i+1}</td>
                        <td>${item.order_date} <br /> ${btnhapus} | ${btnedit}</td>
                        <td>${item.product_title}</td>
                        <td>${item.price}</td>
                        <td>${item.qty}</td>
                        <td>${item.first_name} ${item.last_name}</td>
                    </tr>
                `

            }
        }
    })

}

function hapus(id) {

}

function edit(id) {

}


document.addEventListener('DOMContentLoaded',(c) => {
    refreshData();

    $('body').on('click','a.link-hapus',(e) =>{
        const c = confirm('Apakah Yakin Mau Hapus Data');

        if (c) {
            const id = $(e.currentTarget).data('id');
            hapus(id)
        }
    });

    $('body').on('click','a.link-edit',(e) =>{
        const c = confirm('Apakah Yakin Mau edit Data');

        if (c) {
            const id = $(e.currentTarget).data('id');
            edit(id)
        }
    });



});
