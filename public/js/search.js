$(function () {
    $("#search-btn").on("click", function (e) {
        console.log("テスト");
        e.preventDefault();

        doSearch();

    });

});

function doSearch() {
    console.log("click");
    let formdata = $("#search-form");
    formdata = formdata.serialize();//文字列化
    console.log("ajax_start");

    $.ajax({
        type: "GET",
        url: 'search',
        data: formdata,
        dataType: 'json',

    })

        //成功した時
        .done(
            function (json, status, xhr) {
                console.log(json);
                console.log(status);
                console.log(xhr);
                html = '';
                //通信成功で実行される処理
                $.each(json, function (search, value) { //searchの中身からvalueを取り出す
                    let id = value.id;
                    let img_path = value.img_path;
                    let product_name = value.product_name;
                    let price = value.price;
                    let stock = value.stock;
                    let company_name = value.company_name;
                    // １ユーザー情報のビューテンプレートを作成
                    html += `
                    <tr class="product-list">
                        <td class="list">${id}</td> 
                        <td class="list"><img src="${img_path}" width="30"></img></td>
                        <td class="list">${product_name}</td>
                        <td class="list">${price}</td>
                        <td class="list">${stock}</td>
                        <td class="list">${company_name}</td>
                        <td><button onclick="location.href='/detail/{id}'" class="move">詳細</button></td>
                        <td>
                            
                        <form method="POST" action="'/destroy/{id}'">
                              
                            <button type="submit" data-product_id="${id}}"  class="btn btn-danger delete" onclick='return confirm("本当に削除しますか？")'>削除</button>

                            </form>
                        </td>
                    </tr>
                        `;
                });
                $('tbody').html(html); //できあがったテンプレートをビューに追加  
                deleteEvent();
                console.log(json);

                $('#list-table').tablesorter({
                    headers: {
                        1: { sorter: false },
                        6: { sorter: false },

                    }
                });

                $("#list-table").trigger("update");
            })
        //失敗した時
        .fail(function (xhr, status, error) {
            console.log(xhr);
            console.log(status);
            console.log(error);

        })
        //終了した時
        .always(function (arg1, status, arg2) {
            console.log("完了");

            // 通信完了時の処理
        });

}






