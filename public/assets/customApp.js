document.addEventListener("DOMContentLoaded", function() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          let data = JSON.parse(xhttp.responseText);
          if(data.status){
            document.getElementById("addToCart").insertAdjacentHTML('beforebegin',data.html);
            for(let i=0;i<document.querySelectorAll('.circled-text').length;i++){
              document.querySelectorAll('.circled-text')[i].addEventListener('click',function(e){
                console.log(e.target.id)
                document.querySelector('#engravingText').style.fontFamily = e.target.id;
                for(let i=0;i<document.querySelectorAll('.circled-text').length;i++){
                  document.querySelectorAll('.circled-text')[i].classList.remove('active');
                }
  
                document.querySelectorAll('.circled-text')[i].classList.add('active');
              })
            }
            for(let i=0;i<document.querySelectorAll('.circled-color').length;i++){
              document.querySelectorAll('.circled-color')[i].addEventListener('click',function(e){
                console.log(e.target.id)
                for(let i=0;i<document.querySelectorAll('.circled-color').length;i++){
                  document.querySelectorAll('.circled-color')[i].classList.remove('active');
                }
                document.querySelectorAll('.circled-color')[i].classList.add('active');
                // document.querySelector('#engravingText').style.color = (e.target.id)
              })
            }
            let addTocart = document.getElementById('addToCart');
            var clone = addTocart.cloneNode(true);
            addTocart.remove();
            document.querySelector('.embeddedCode').insertAdjacentElement('afterend',clone)
            document.getElementById('addToCart').addEventListener('click',function(e){
              e.preventDefault();
              e.stopImmediatePropagation();
              e.stopPropagation();
              if(document.querySelector('#engravingText').value == ''){
                  document.querySelector('.errorAlert').innerHTML = "Engraving Text is Required."
              }else{
                  document.querySelector('.errorAlert').innerHTML = ""
                  let colorCheck = document.querySelector('.circled-color.active')
                  console.log(colorCheck)
                  let items = [{
                    id: parseInt(ShopifyAnalytics.meta.selectedVariantId),
                    quantity: parseInt(document.querySelector('input[name="quantity"]').value),
                    properties: {
                      text : document.querySelector('#engravingText').value,
                      color :  colorCheck ? getColorName(colorCheck.id) : 'silver',
                      font : document.querySelector('.circled-text.active').id
                    }
                  }];
                    document.getElementById('addToCart').value = "adding"
                  var xhttp2 = new XMLHttpRequest();
                  xhttp2.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                      let data = JSON.parse(xhttp2.responseText);
                      document.getElementById('addToCart').value = "Added"
                      setTimeout(function(){
                          document.getElementById('addToCart').value = "Add To Cart"
                      },2000)
                      
  //                     document.querySelector('#upper-content > ul.cart-links__wrapper.span-4.auto.sm-hide.v-center.a-right > li.cart-links__link-cart.my-cart-link-container > a > button > svg').dispatchEvent(new Event('click'))
                      location.href = '/cart'
                    }
                     }
                    xhttp2.open("POST", `/cart/add.js`, true);
                    xhttp2.setRequestHeader("Content-Type", "application/json");
                    xhttp2.send(JSON.stringify({items:items}));
              }
            })
            function getColorName(color){
              return color == '#C0C0C0' ? 'silver' : (color == '#FFD700' ? 'gold' : 'black')
            }
          }
          
        }
    };
    xhttp.open("GET", `https://thetokyoapp.com/product/check/${ShopifyAnalytics.meta.product.id}`, true);
    xhttp.send();
  });
  