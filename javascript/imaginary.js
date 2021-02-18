/*Code pour la page "imaginary_store.php"*/ 

const image = document.querySelectorAll(".image_product");
const ids = document.querySelectorAll('.product-id');

image.forEach((element) => {
  element.addEventListener("mouseover", (evenement) => {
      let src = element.getAttribute("src");

         for(p = 0; p < ids.length; p++){
                let id = ids[p].textContent;
                

               if(src == "../image/"+id+".png"){      
                
                let product = document.querySelectorAll(".product");
                
                for(i = 0; i < product.length; i++) {
                  
               if(i == p){
                   product[i].style.backgroundImage = "url('../background/"+id+".png')";
                   product[i].style.backgroundRepeat = "no-repeat";
                   product[i].style.backgroundPosition = "center"; 
                   product[i].style.backgroundSize = "700px, 700px";

               }           

    
                            
                }
    
                           

               }
            
         }
      
  });
});
  


image.forEach((element) => {
  element.addEventListener("mouseout", (evenement) => {
      let src = element.getAttribute("src");

         for(p = 0; p < ids.length; p++){
                let id = ids[p].textContent;
                

               if(src == "../image/"+id+".png"){      
                
                let product = document.querySelectorAll(".product");
                
                for(i = 0; i < product.length; i++) {
                  
               if(i == p){
                   product[i].style.backgroundImage = "url('')";

               }           

    
                            
                }
    
                           

               }
            
         }
      
  });
});

/**/

