<!DOCTYPE html>    
<html>    
<head>    
    <title>Login Form</title>    
    <style>
        body  
{  
    margin: 0;  
    padding: 0;  
    /*background-color:#6abadeba;  */
    font-family: 'Arial';  
}  
.login{  
        width: 382px;  
        overflow: hidden;  
        margin: auto;  
        margin: 20 0 0 450px;  
        padding: 80px;  
        background: #23463f;  
        border-radius: 15px ;  
          
}  
h2{  
    text-align: center;  
    color: #277582;  
    padding: 20px;  
}  
label{  
    color: #08ffd1;  
    font-size: 17px;  
}  
#Uname{  
    width: 300px;  
    height: 30px;  
    border: none;  
    border-radius: 3px;  
    padding-left: 8px;  
}  
#Pass{  
    width: 300px;  
    height: 30px;  
    border: none;  
    border-radius: 3px;  
    padding-left: 8px;  
      
}  
#log{  
    width: 300px;  
    height: 30px;  
    border: none;  
    border-radius: 17px;  
    padding-left: 7px;  
    color: blue;  
  
  
}  
span{  
    color: white;  
    font-size: 17px;  
}  
a{  
    float: right;  
    background-color: grey;  
}          
    </style>    
</head>    
<body>    
    <h2>Login</h2><br>    
    <div class="login">    
    <form id="login" method="get" action="{{ url('authenticate') }}">     
        <input style="width: 100%;padding: 10px;margin-bottom: 10px;" type="text" name="shop" id="shop" placeholder="Enter Your Shopify Domain..">    
        <input style="padding: 10px;background: white;color: green;border-redius:10%;" type="submit" value="Log In">       
    </form>     
</div>    
</body>    
</html>  