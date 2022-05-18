<?php

$title = "Clothes" ; 
require_once 'common/headerUser.php';

?>

<h1>Clothes</h1>
<script>
    function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
    }

    const Http = new XMLHttpRequest();
    const url = "/FinalProject-1/api/clothes/list.php"; 
    
    var panel = document.querySelector(".container");

    Http.open("GET", url);
    Http.send() ;
    Http.onreadystatechange= ()=>{
        if(Http.readyState===XMLHttpRequest.DONE){
            var grid = "";
            const row =`<div class="row" style="margin-top: 50px;">`;
            var j = 1; 
            var clothes = JSON.parse(Http.responseText);
            if(clothes.length==0){
                panel.innerHTML = panel.innerHTML + `<div class="alert alert-danger" role="alert">
                    There are no clothes yet!
                </div>`
            }
            else {
                var length = clothes.length-1;  
                for (var i in clothes){
                    
                    var cell = `
                                <div class="col">
                                    <h3 class="text-info">${capitalizeFirstLetter(clothes[i]['type'])}</h3>
                                    <a href="clothPanel.php?cloth_id=${clothes[i]["id"]}"><img src="${clothes[i]["image"]}"  width="200" height="350"></a>
                                    <h3 class="text-info">Price ${clothes[i]['price']}$</h3>
                                </div>
                                `;
                    if(j==1){
                        grid = grid + row ;
                    }
        
                    grid = grid + cell ;
                    
                    if(j==3 || i==length){
                        grid = grid + '</div>' ;
                        j=0 ;
                    }
                    j++ ;
                    
                }

            panel.innerHTML = panel.innerHTML + grid ;
            }
        
    } ;  
    }
</script>

</body>
</html>
