<!Doctype hmtl>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Comic+Neue&display=swap" rel="stylesheet">
  <title>Document</title>
  <?php include("connectDB.php"); ?>


  <style>

* {
    box-sizing: border-box;
    padding: 0;
    margin: 0;
}

    html{
      height:100vh;
      
    }

    body{
      height:100%;
      background:black;
      
    }

    main{
      height:500px;
      display:flex;
      justify-content:flex-end;
      align-items:center;
      flex-direction:column;
      background-image: url("https://thecountryclub.com.au/wp-content/uploads/2017/06/trivia-tuesdays-background-300x94.jpg");
      margin-top:10vh;
      font-family: 'Comic Neue', cursive;

      font-size: 20px;
      

    }


.formContainer{
  
  height:100%;
  display:flex;
  justify-content:center;
  align-items:center;
  flex-direction:column;
  position:relative;
  padding-left:10vw;
  
}

form{
  background-color:purple;
  color:#f0f0f0;
  padding:20px 60px 20px 20px;
 
  width:100%;
  height:90%;
  max-height:90%;
  overflow-y:scroll;
}
   


#nickname,#password{
  padding:5px;
  font-size:inherit;
  font-family:inherit;
  margin-bottom:10px;
}

#submit{
  padding:10px;
  font-size:inherit;
  font-family:inherit;
  background-color:#78b857;
  color:white;
}

.cats{
  margin:10px 0;
  display:flex;
  flex-wrap:wrap;
  justify-content:flex-start;
}

#idSpan,#passSpan{
 color:red;
}

.categoryBtn{
  width:40%;
  background-color:#cc1200;
  margin:5px;
  padding:10px 0px;
  text-align:center;
}

form::before{
  position:absolute;
  content:"";
  
  background:url("https://thecountryclub.com.au/wp-content/uploads/2017/06/trivia-tuesdays-background-300x94.jpg");
  width:50px;
  height:100%;
  top:0;
  right:0px;
}
  </style>

</head>
<body>
  
  <?php 
    connectToDB("localhost","root","","trivias");
    
  ?>

  <header></header>

  <main>


<div class="formContainer">
    <form action="save.php"  method="post">
    
    <label for="nickname">Enter your nickname:</label><br>
  <input type="text" id="nickname" name="nickname"><br>* <span id="idSpan"></span> <br>
  <br>
  <label for="password">Enter your password:</label><br>
  <input type="password" id="password" name="password"><br>* <span id="passSpan"></span><br>
  <br>


  <div id="radioCont">
  <input type="radio" id="history" name="categories" value="history">
  <label for="history"></label>  <br>
  <input type="radio" id="mathematics" name="categories" value="math">
  <label for="math">Mathematics</label><br>
  <input type="radio" id="music" name="categories" value="music">
  <label for="music">Music</label><br>
  <input type="radio" id="film" name="categories" value="film">
  <label for="film">Film</label><br>
  <input type="radio" id="books" name="categories" value="books">
  <label for="books">Books</label><br>
  <input type="radio" id="general" name="categories" value="general">
  <label for="general">General</label>

  </div>
<div>Select a category:</div>
<div class="cats">
  <div class="categoryBtn" onclick="test()">History</div>
  <div class="categoryBtn"  onclick="test()">Mathematics</div>
  <div  class="categoryBtn" onclick="test()">Music</div>
  <div class="categoryBtn"  onclick="test()">Film</div>
  <div  class="categoryBtn" onclick="test()">Books</div>
  <div class="categoryBtn" onclick="test()">General</div>
    
  </div>

  <input  class="z" tabindex="0" type="submit" name="submit" id="submit" value="Play!">





    </form>

    </div>
  </main>



  <script>

  function test(){
    document.querySelector(".z").focus();
    console.log("done")
  }

  let width=document.querySelector("main").getBoundingClientRect().width;
  console.log(width-20);
  let formC= document.querySelector(".formContainer");
  formC.style.maxWidth=width;


  let radiosDiv= document.querySelector("#radioCont");
  radiosDiv.style.display="none";
  let catBtns= document.querySelectorAll(".categoryBtn");
  let catWasSelected=false;
  
  function isCatSelected(nodes){
    for(let node of nodes){
      if(node.style.color=="white"){
        catWasSelected=true;
       
        return node;
      }
    }
    catWasSelected=false;
    return false;
  }
  console.log(isCatSelected(catBtns))


  function select(dom){
    dom.setAttribute("style","background-color:black;color:white");

  }

  function unselect(dom){
    dom.setAttribute("style","background-color:'';color:''");

  }

  

  for(let b of catBtns){
    b.addEventListener("click",(event)=>{  
      let btext=  event.target.textContent.toLowerCase(); 
      
      let radio= document.querySelector("#"+btext);    
      radio.checked=true;
     
      if(isCatSelected(catBtns)!=b){
        if(isCatSelected(catBtns)){          
          unselect(isCatSelected(catBtns));
          select(b);
          
        }else{
          
          select(b);
        }
      }
     
            
    });
    if(catWasSelected){
      document.querySelector("#submit").disabled=false;
    }
    else{
      document.querySelector("#submit").disabled=true;
    }
  }
  

  let user = document.querySelector("#nickname");
  let pass = document.querySelector("#password");
  let timeout;
  let changed=false;
  let isNewUser=false;
  let isPassOK= false;


  document.querySelector("#submit").disabled=true;

  user.addEventListener("input", () => {
  clearTimeout(timeout); 
  timeout = setTimeout(checkNewUsername, 500);
  changed=false;
  pass.value="";
  document.querySelector("#passSpan").textContent="";
  document.querySelector("#submit").disabled=true;
  });


  

  


  function checkNewUsername(){
      
    if(sintaxCheck(user.value)){ 
      changed=true; 
     
      return true;
      //existInDB();
    }else{
      return false;
    }
    
  }

  

  function sintaxCheck(text){
 
    result= /^\w+$/.test(text);    
    if(!result&& text.length==0){
      document.querySelector("#idSpan").textContent="";
    }
    else if(!result){
      
      document.querySelector("#idSpan").textContent="Only alphanumeric characters  are allowed";
      return false;
    }else{
      document.querySelector("#idSpan").textContent="";
      return true;
    }
}


function passSintaxCheck(text){
 
 result= /^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=\S{6,}$)/.test(text);    
 if(!result&& text.length==0){
   document.querySelector("#passSpan").textContent="";
 }
 else if(!result){
  document.querySelector("#submit").disabled=true;
   document.querySelector("#passSpan").textContent="Password must be al least 6 alphanumeric characters.";
   return false;
 }else{
   document.querySelector("#passSpan").textContent="";
   return true;
 }
}


function existInDB(){

let username= user.value;
let url="userValidator.php?username="+username;
let request= new XMLHttpRequest();
request.open("GET",url,true);
request.onreadystatechange =function(){
  if (this.readyState == 4 && this.status == 200) {
   
    if(request.responseText.length=="6"){
      document.querySelector("#idSpan").textContent="Username already exists.";
      

    }else{      
      document.querySelector("#idSpan").textContent="";
      isNewUser=true;
    }
  }
};
request.send();




}



  
let time;    
pass.addEventListener("input", () => {    
    clearTimeout(time);
    time = setTimeout(checkPassword, 500);
    
  });



function checkPassword(){
  if(passSintaxCheck(pass.value)){      
      
    passIsCorrect();
    }
}


function passIsCorrect(){
  let password= pass.value;
  let username=user.value;
let url="userValidator.php?password="+password+"&username="+username;

let request= new XMLHttpRequest();
request.open("GET",url,true);
request.onreadystatechange =function(){
  if (this.readyState == 4 && this.status == 200) {
    
    if(request.responseText.length=="18"){
      document.querySelector("#passSpan").textContent="Password is incorrect.";
      document.querySelector("#idSpan").textContent="Username already exists.";

    }else{   
       
      document.querySelector("#passSpan").textContent="";
      isPassOK=true;     
      document.querySelector("#submit").disabled=false;
    
    }
  }
};
request.send();

  }


  

  </script>

</body>
</html>