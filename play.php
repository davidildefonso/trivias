<?php

session_start();


include("connectDB.php");
$con=connectToDB("localhost","user","pass","trivias"); //change user and pass to your database user and password

$username=$_SESSION["name"];

/*echo $_SESSION["name"];
echo $_SESSION["uid"];
echo $_SESSION["cat"];


echo $_SESSION["gameID"];*/
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Comic+Neue&display=swap" rel="stylesheet">
  <title>Document</title>
  <style>


* {
    box-sizing: border-box;
    padding: 0;
    margin: 0;
}

.correctPopUp{
  position:absolute;
  font-size:5rem;
  color:green;
  font-weight: 800;
  text-shadow: 0 0 3px #aaff11, 0 0 5px #bcff11;
}

.incorrectPopUp{
  position:absolute;
  font-size:5rem;
  color:red;
  font-weight: 800;
  text-shadow: 0 0 3px #FF0000, 0 0 5px #0000FF;
}



  html{
    font-family: 'Comic Neue', cursive;
    height:100%;
  }

  body{
    height:100vh;
    background-color:#000000;
  }

    .div{
      height:500px;
      display:flex;
      flex-direction:column;
      justify-content:center;
      background-color:blue;
      align-items:center;
    }

    .anim{
      animation: intro 3s linear forwards;
    }
    


    @Keyframes intro {
      0%{
        background-color:#101dc0;
      }
    
      100%{
        background-color:#f5d12b;
        
      }
    }

    .gameContainer{
      background-color:pink;
      height:500px;
      overflow:hidden;
      margin-top:10vh;
    }

   .correctAns{
     display:none;
   }

    .hidden{
      display:none;
    }
    .show{
      display:block;
    }
    
    .questionCont{
      height:500px;
      background-color:pink;
      width:100%;
      text-align:center;

    }

    .question{
      font-size:2rem;
      font-weight:700;
      margin-bottom:20px;
      padding:0 10px;
      color:#006c59;
    }

    .answers{
      width:35%;
      display: inline-block;  
      background-color:rgb(141,27,84);
      color:rgb(255,255,255);
      font-size:1rem;
      font-weight:500;
      text-decoration: none;
      text-transform: uppercase; 
      border-radius: 5px; 
      text-shadow:0px 1px 0px rgba(0,0,0,0.5);
      box-shadow:0px 2px 2px rgba(0,0,0,0.2);
      padding:10px;
      margin:10px 10px 0 10px;
    }

    .answers:hover {
  background-color:#ffa14f;
  border-right: 1px solid  rgba(0,0,0,0.3);
  cursor:pointer;
}

.tableCont{
  display:flex;
  justify-content:center;
  align-items:center;
}
 

.table{
 
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



.questionsCont{
  display:flex;
  flex-wrap:wrap;
  flex-direction:row;
  align-items:center;
  justify-content:center;
}

#firstCont{
  display:flex;
  flex-direction:column;
  align-items:center;
  justify-content:center;
}

.introCont{
  width:70%;
  height:40%;
  background-color:purple;
  overflow:hidden;
  display:flex;
  flex-direction:column;
  font-size:11rem;
  align-items:center;
  line-height:100%;
  text-align:center;
  color:#f0f0f0;
  border-radius: 5px;
}

.introCont div{
  height:100%;
  width:100%;
}

.div h1{
color:#f0f0f0;
font-size: 50px;
padding-bottom:10px;
text-align:center;
}


.div p{
  color:#f0f0f0;
font-size: 30px;
margin:10px 20px;
padding-bottom:20px;
}


.finalMsg{
  font-size: 80px;
  font-weight:800;
  text-align:center;
  margin: 40px 20px 20px 20px;
  color: #0614f9
}

.score{
  font-size: 30px;
  font-weight:800;
  text-align:center;
  margin: 10px;
  color:#1f5020;
}

.time{
  font-size: 30px;
  font-weight:800;
  text-align:center;
  margin: 10px;
  color:#1f5020;
}

.showRankingBtn,.restartBtn{
  padding:10px;
  font-size:25px;
  background-color:#5500ff;
  margin-bottom:10px;
  color:#f0f0f0;
}

.restartBtn a{
  text-decoration:none;
  color:inherit;
}

  </style>

</head>
<body>

<div class="gameContainer">
  <div class="div">

  <h1>GOOD LUCK <?php echo $username?>! </h1>
  <p>Game starts in:  </p>
  <div class="introCont">
    <div class="first">3</div>
    <div class="second">2</div>
    <div class="third">1</div>
    <div class="fourth">GO!</div>
  </div>
  
  
  
  </div>
  
</div>

<script>
let timeStart,timeEnd;
let div=document.querySelector(".div");
let data;
let timeDiff;
let cat='<?php echo $_SESSION["cat"]?>';
console.log(cat)
let user= '<?php echo $username ?>';
console.log(user);

window.onload= function(){

  let introCont= document.querySelector(".introCont");
  
  changeSlide(introCont);
 
   
  function changeSlide(dom){
    
      setTimeout(() => {
        dom.children[0].remove();
        if(dom.children.length>1){
          changeSlide(dom)
        }
    }, 1000);
    

  }
  



  let gameCont=document.querySelector(".gameContainer");
    div.setAttribute("class","anim div");
    div.addEventListener("animationstart",()=>{
      
      timeStart=new Date();
      console.log(timeStart)
    })
    
  div.addEventListener("animationend",()=>{
 
    timeEnd=new Date();
    console.log(timeEnd)

    timeDiff=Math.round(timeEnd-timeStart);
    console.log(timeDiff);
    
    data=requestQuestionsAndAnswers(cat)
      .then(data=>{
        data=decodeURI(data);
        data= decodeURIComponent(data);
        let r=data.split(",");
        r.shift();
        r=r.join("").split("[");
        r.shift();
        r=r.join("").split("{");
        r=r.join("").split("}");
        r.pop();
        r.pop();
        generateSlides(r,gameCont);
        gameCont.children[0].remove();       
        startGame(); 
      });
        
  });
  
  
}


function startGame(){
  let score=0;
  let timeBegin=new Date();
  let cont= document.querySelector(".gameContainer");
 

  playQuestion(cont.children[0],score,timeBegin);
 
 

}

function random(min,max) {
  const num = Math.floor(Math.random()*(max-min)) + min;
  return num;
}

function randomColor() {
  return 'rgb(' + random(128,255) + ', ' + random(128,255) + ', ' + random(128,255) +  ')';
}




function playQuestion(dom,score,startTime){  
  let newScore=score;
  dom.setAttribute("id","firstCont");
  let correctAns= document.querySelector(".correctAns").textContent;
  let questionsContainer= document.querySelector("#firstCont div");
  
  const stylesheet = document.styleSheets[1];
  let boxParaRule;


  for(let i = 0; i < stylesheet.cssRules.length; i++) {
    if(stylesheet.cssRules[i].selectorText === '#firstCont') {
      boxParaRule = stylesheet.cssRules[i];
    }
  }

  function setRandomBgColor() {
    const newBgColor = randomColor();
     boxParaRule.style.setProperty('background-color', newBgColor);
  }



  questionsContainer.setAttribute("class","questionsCont");
  let ansAll=document.querySelector("#firstCont").querySelectorAll(".answers");
  
  ansAll.forEach(ans=>{
      ans.addEventListener("click",(e)=>{   
        setRandomBgColor(); 
        newScore=checkAns(e,correctAns,newScore);            
        
        setTimeout(() => {
          document.querySelector("#firstCont").remove();        
        let dom= document.querySelector(".gameContainer");
        if(dom.children.length>0){
          playQuestion(dom.children[0],newScore,startTime);
        }else{          
          let endTime=new Date();
          let timeTotal=  Math.round((endTime-startTime)/1000);
          let msg=(newScore==100)?"Absolutely perfect!":
            (newScore>80)?"Awesome!":
            (newScore>60)?"Well done!":
            (newScore>40)?"Not bad!":
            "Nice try!";
          console.log(msg)
          dom.appendChild(
              elt("div", {class:"questionCont"}, 
              elt("p",{class:"finalMsg"}, msg),
                elt("p",{class:"score"}, user+" your score is: "+newScore+"/100"),
                elt("p",{class:"time"}, "Your time: "+ timeTotal+" seg"),
                elt("button",{class:"showRankingBtn",onclick:"showRankTable()"} ,"Show ranking"),
                elt("button",{class:"restartBtn"},
                  elt("a",{href:"trivias.php"},"Home"))));


          
          saveTriviaGame();
          getRankings()
          
        }
        }, 2000);
        
        
      })
  });
  
}

function wait(ms){
   var start = new Date().getTime();
   var end = start;
   while(end < start + ms) {
     end = new Date().getTime();
  }
}

function showRankTable(){
  let table=document.querySelector(".table");
  table.classList.toggle("show");
  
}

function saveTriviaGame(){

let score= /\d+/.exec(document.querySelector(".score").textContent)[0];
let time= /\d+/.exec(document.querySelector(".time").textContent)[0]
let url="gameValidator.php?score="+score+"&time="+time;
let request= new XMLHttpRequest();
request.open("GET",url,true);
request.onreadystatechange =function(){
  if (this.readyState == 4 && this.status == 200) {
    console.log(url)
    console.log(request);
 
  }
};
request.send();

}


function getRankings(){

let url="gameValidator.php?";
let request= new XMLHttpRequest();
request.open("GET",url,true);
request.onreadystatechange =function(){
  if (this.readyState == 4 && this.status == 200) {
   
    let r= JSON.parse(request.responseText);
  
   console.log(Object.values({'N°': 1, ...r[0]}))
    
    let cont=document.querySelector(".questionCont");

    let tableCont=document.createElement("div");
    tableCont.className="tableCont";
    tableCont.appendChild(elt2("table",{class:"table hidden"},
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


function checkAns(e,ans,score){
  
  let answers= document.querySelectorAll("#firstCont .answers"); 


  if(event.target.textContent==ans){
    answers.forEach(x=>{
      if(x.textContent!=ans){
        x.style.opacity=0.2;
      }
    })
    let cont=document.querySelector("#firstCont");
    cont.prepend(elt("div",{class:"correctPopUp"},
      elt("span",{class:"correctMark"},"✓")))
   
   
   
    return score+=5;
  }else{
   
    answers.forEach(x=>{
      if(x.textContent!=ans){
        x.style.opacity=0.2;
      }else{
        x.style.backgroundColor="#ffa14f";
      }
    })
    let cont=document.querySelector("#firstCont");
    cont.prepend(elt("div",{class:"incorrectPopUp"},
      elt("span",{class:"incorrectMark"},"✗")
    ))    
  
    return score;
  }
  
}

function removeSlide(){
  let cont=document.querySelector("#firstCont");
  cont.remove();
}

function generateSlides(questionsInfo,dom){
  
  questionsInfo.forEach(q=>{
    
    
    let question=/(?<=question":).*(?="correct)/.exec(q);
   question=question[0];
   question=question.slice(1,-1);
    let correct=/(?<=correct_answer":).*(?="incorrect_answers)/.exec(q);
    correct=correct[0];
    correct=correct.slice(1,-1);
    let incorrect=/(?<=incorrect_answers":).*(?=])/.exec(q);
    
    incorrect=incorrect[0].split('"');
    incorrect=incorrect.filter(e=>e!=="");
   
    let answers= incorrect.concat(correct,"None");
    answers = answers.sort(() => Math.random() - 0.5)
   
    dom.appendChild(
      elt("div", {class:"questionCont"}, 
        elt("p",{class:"question"}, question),
        elt("p",{class:"correctAns"} ,correct),
        elt("div",{},answers )));

  })
}

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

function elt3(type, props, ...children) {
  let dom = document.createElement(type);
  if (props) Object.assign(dom, props);
  for (let child of children) {
    if (typeof child != "string") dom.appendChild(child);
    else dom.appendChild(document.createTextNode(child));
  }
  return dom;
}


 function  requestQuestionsAndAnswers(cat){
  let url="https://opentdb.com/api.php?amount=20&type=multiple&encode=url3986"
  //any
  if(cat=="general") url=url;
  else if(cat=="math") url+="&category=19";
  else if(cat=="history") url+="&category=23";
  else if(cat=="books") url+="&category=10";
  else if(cat=="music") url+="&category=12";
  else if(cat=="film") url+="&category=11";
  

  return fetch(url)
  .then(response => response.text())
  .then(data => data)
  .catch(err => { throw err });

 }


</script>

  
</body>
</html>

