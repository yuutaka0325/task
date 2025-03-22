$(function(){
    $("#search-btn").on("click",function(e){
        e.preventDefault();
        console.log("click");
        let formdata=$("#search-form").serialize();
        console.log("ajax_start");

        $.ajax({
            type:"GET",
            url:'search',
            data:formdata,
            dataType: 'json',
            success: function(response) {

                console.log("Success:", response);
        
            },
        
            error: function(xhr, status, error) {
        
                console.error("Error:", xhr.responseText);
        
            }
        })   

        //成功した時
        .done(
            function(json,status, xhr){
                console.log(json);
                console.log(status);
                console.log(xhr);
                html='';
                //通信成功で実行される処理
                $.each(json, function (search, value) { //searchの中身からvalueを取り出す
                    let id = value.id;
                    let img_path = value.img_path;
                    let product_name = value.product_name;
                    let price = value.price;
                    let stock = value.stock;
                    let company_name = value.company_name;
                    // １ユーザー情報のビューテンプレートを作成
                    html +=`
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
                            @csrf
                                
                            <button type="submit" class="btn btn-danger delete" onclick='return confirm("本当に削除しますか？")'>削除</button>

                            </form>
                        </td>
                    </tr>
                        `;
                });
                $('tbody').html(html); //できあがったテンプレートをビューに追加   
                console.log(json);
            }
            
        )
        //失敗した時
        .fail(function(xhr, status, error) {
        console.log(xhr);
        console.log(status);
        console.log(error);

        })
        //終了した時
        .always(function(arg1, status, arg2) {
            console.log("完了");

            // 通信完了時の処理
        });

    });  
        
        
        


});
       