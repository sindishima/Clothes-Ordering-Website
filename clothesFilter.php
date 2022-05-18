<?php

$title = "Clothes Filter" ; 
require_once 'common/headerUser.php';

$cloth_type= $_GET['cloth_type']; 
?>

<h1 id="filtre"><?php echo ucfirst($cloth_type)?></h1>


<script>
    function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
    }
    var panel = document.querySelector(".container") ;
    
    var title = document.querySelector("#filtre") ;
    var cloth_type = title.innerHTML.trim().toLowerCase(); 
    var clothes ; 
    console.log(cloth_type) ;
    const url = "/FinalProject-1/api/clothes/filter.php" ;
    fetch(url , {
            method: "POST", 
            headers:{
                'Content-Type': 'application/json',
            },
                body : JSON.stringify({"type" : cloth_type}),
            }
            ).then(response => response.json())
            .then((date)=>{  
                clothes= date ;
                var grid = "";
                const row =`<div  class="row"  style="margin-top: 50px;">`;
                var j = 1 ; 
                if(clothes.length==0){
                    panel.innerHTML = panel.innerHTML + `<div class="alert alert-danger" role="alert">
                        There are no clothes yet!
                    </div>`
                }
                else {
                    var length = clothes.length-1 ;
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
                    
                    
            })
        .catch(console.error);

    
    
</script>


