<!Doctype hmtl>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Comic+Neue&display=swap" rel="stylesheet">
  <?php include("connectDB.php") ;
  $con=connectToDB("localhost","root","","trivias");

  ?>
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
      justify-content:center;
      align-items:center;
      flex-direction:column;
      background-image: url("https://thecountryclub.com.au/wp-content/uploads/2017/06/trivia-tuesdays-background-300x94.jpg");
      margin-top:10vh;
      font-family: 'Comic Neue', cursive;
    }

    section{
      margin-top:10vh;
      display:flex;

    }


    h1{
      font-size:40px;
      background-color:purple;
     
      color:#f0f0f0;
      font-weight: 700;
      text-align:center;
     
      padding: 20px;
     
     
    }

    .startBtn{
      font-size:25px;
      background-color:#cc1100;
      padding:10px;
      margin:20px;
      color:#f0f0f0;
      font-weight: 500;
      text-align:center;
      border-radius:10px;
    }

    section a{
      text-decoration:none;
    }

    #top{
      font-size:25px;
      background-color:#cc1100;
      padding:10px;
      margin:20px;
      color:#f0f0f0;
      font-weight: 500;
      text-align:center;
      border-radius:10px;
    }

.title{
  position:relative;
  width:100%;
 display:flex;
 justify-content:center;
 align-items:center;
  
  height:30%;
}

.startBtn, #top{
  animation: appear 2s linear 2s forwards;
  opacity:0;

}

@keyframes appear{
  0% {
   
    opacity:0;
  }
  50%{
    opacity:0.5;
  }
  100%{
    opacity:1;
  }
}

.show{
  display:block;
}

.hidden{
  display:none;
}

.table{
  display:table;
  border: 1px solid #ff2233;
  background-color: #f0f0f0;
  font-size: 20px;
  font-weight:bold;
  
  border-collapse: collapse;
}


.td{
 
  border: 1px solid #dddddd;
  text-align: left;
  padding: 3px 6px;
  color: #250be4;

}

.tr:nth-child(even) {
  background-color: #dddddd;
}

.tr1 td{
  background-color: blue;
  color:#ff0
}



  </style>
</head>
<body>
  
  

  <header></header>
  <main>
  <div class="title"><h1>WELCOME TO TRIVIAS</h1></div>
  
    <section>
      <a href="game.php"><div class="startBtn">START</div></a> 
     <div id="top" onclick="toggleRanking()"> TOP 5</div>
    </section>
    
    <div id="ranking"></div>
  </main>

  <script>
  let c=document.querySelector(".title");
  let screenW=c.getBoundingClientRect().width;
  let title= document.querySelector("h1");
  let start;
  let initialScale=0.1;
  let angle = Math.PI / 2;

/*
function step(timestamp) {
  if (start === undefined)
    start = timestamp;
  const elapsed = timestamp - start;
  initialScale+=0.0075;

  angle +=2*Math.PI/120;
 
  title.style.transform = `translateX(${Math.min(-150+0.25 * elapsed, screenW/4.5)}px)
    scale(${initialScale}) 
    translateY(${Math.sin(2*angle)*155}px)
  `
  if (elapsed < 2000) { // Stop the animation after 2 seconds
    requestAnimationFrame(step);
  }
}

requestAnimationFrame(step);
   
*/

function step(timestamp) {
  if (start === undefined)
    start = timestamp;
  const elapsed = timestamp - start;
  initialScale+=0.0075;

  angle +=2*Math.PI/120;
 
  title.style.transform = `  scale(${initialScale}) 
    translateY(${Math.sin(2*angle)*155}px)
  `
  if (elapsed < 2000) { // Stop the animation after 2 seconds
    requestAnimationFrame(step);
  }
}

requestAnimationFrame(step);


function elt2(name, attrs, ...children) {
let dom = document.createElement(name);
for (let attr of Object.keys(attrs)) {
dom.setAttribute(attr, attrs[attr]);
}
for (let child of children) {
  if (typeof child != "string") {
 
  if(child.length>0){
    child.forEach(e=>{
      dom.appendChild(elt("td",{class:"td"},e));
     
   
     })
  }else{
    dom.appendChild(child);
  }

  }
  else {node.appendChild(document.createTextNode(child))};

}
return dom;
}


function elt(type, attrs,...children) {
let node = document.createElement(type);

for (let attr of Object.keys(attrs)) {
  node.setAttribute(attr, attrs[attr]);
}

for (let child of children) {
  if (typeof child != "string") {
    if(typeof child[0] == "string"){
      child.forEach(e=>{
        node.appendChild(elt("div",{class:"answers"},e));
        })
    }else{node.appendChild(child);}
  }
  else node.appendChild(document.createTextNode(child));
  }
  return node;
}

let rankingCont= document.querySelector("#ranking");
rankingCont.setAttribute("class","hidden");

function toggleRanking(){
     
      //let rankingCont= document.querySelector("#ranking");
   
      if(rankingCont.className=="hidden"){    
        console.log(rankingCont.className=="show")   
        getRankings() 
        rankingCont.setAttribute("class","show");
      }else{
        console.log(rankingCont.className)
        
        rankingCont.setAttribute("class","hidden");
        rankingCont.children[0].remove();

      }
      
        
 } 
    

function getRankings(){

let url="gameValidator.php?";
let request= new XMLHttpRequest();
request.open("GET",url,true);
request.onreadystatechange =function(){
  if (this.readyState == 4 && this.status == 200) {
   
    let r= JSON.parse(request.responseText);
  
   console.log(Object.values({'N°': 1, ...r[0]}))
    
    let cont=document.querySelector("#ranking");

    let tableCont=document.createElement("div");
    tableCont.className="tableCont";
    tableCont.appendChild(elt2("table",{class:"table"},
      elt2("tr",{class:"tr tr1"},Object.keys(Object.assign({"N°": "1"}, r[0]))),
      elt2("tr",{class:"tr"},Object.values({'N°': "1", ...r[0]})),
      elt2("tr",{class:"tr"},Object.values({'N°': "2", ...r[1]})),
      elt2("tr",{class:"tr"},Object.values({'N°': "3", ...r[2]})),
      elt2("tr",{class:"tr"},Object.values({'N°': "4", ...r[3]})),
      elt2("tr",{class:"tr"},Object.values({'N°': "5", ...r[4]})),
    
      ))

    cont.appendChild(tableCont);
 
  }
};
request.send();




}



  </script>
</body>
</html>