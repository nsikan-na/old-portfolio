//dom selectors
const category=document.querySelector('.category');
const type=document.querySelector('.type');
const button = document.querySelector('.button');
const amount = document.querySelector('.amount');
const history = document.querySelector('.history');
const balance=document.querySelector('.runningBalance');
const error= document.querySelector('.error');
const form=document.querySelector('.form');
const expense_cat=document.querySelectorAll('.expense_category');
const income_cat=document.querySelectorAll('.income_category');
let li;
const runningIncome=document.querySelectorAll('.runningIncome')
const runningExpense=document.querySelectorAll('.runningExpense')
let total=0;
let incomeTotal=0;
let expenseTotal=0;
let expenseCat
let incomeCat



//changes the options in category based on which income is selected
var incomeArr = Array.prototype.slice.call(income_cat);
var expenseArr = Array.prototype.slice.call(expense_cat);
expenseArr.forEach((expense_cat)=>{
    if (type.value==='Income' || type.value===''){
        expense_cat.style.display="none";
    }else{
        expense_cat.style.display='block';
    }
});
type.addEventListener('change',function(){
    category.disabled=false
    amount.disabled=false
    category.value='';
    amount.value='';
incomeArr.forEach((income_cat)=>{
    if (type.value==='Income'){
        income_cat.style.display='block';
    }else{
income_cat.style.display="none";
        }
    });
expenseArr.forEach((expense_cat)=>{
    if (type.value==='Income'){
        expense_cat.style.display="none";
    }else{
        expense_cat.style.display='block';
    }
});
});




$(document).ready(function() { 
    $('form').submit(function(e) { //form does not refresh when submitted
        e.preventDefault();
        // or return false;
    });
});
let transArr=[]








   
button.addEventListener("click", function(){ //check if button is pressed
if((amount.value!=='')  && (category.value !=='')  && (type.value!=='')){ //check if all fields are completed



    let trans=[]
trans.push(type.value)
trans.push(category.value)
trans.push(amount.value)
transArr.push(trans)



    error.innerHTML=''; //reset error div

    li=document.createElement('li');//create li element for transaction history


//make a new li with a desc amount update symbol and delete symbol   
//color code the li based on if it is an income or expense
    let operation;     
    if (type.value==='Income'){  
        li.style.color='green';
        operation='+';
    }else{
    li.style.color='red';
    operation='-';
    }



//delete/update icons from bootstrap

for(let i=0; i< transArr.length; i++){
    li.innerHTML= transArr[i][1] + '<br> '+operation+'' +transArr[i][2]
    //+'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square update" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/></svg>'+
    //"<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash delete' viewBox='0 0 16 16'><path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/><path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/></svg>";
    history.insertBefore(li, history.childNodes[0]);

    /*
    const myUpdate = document.querySelector('.update')
    const myDelete = document.querySelector('.delete')
    
    myDelete.addEventListener("click", function(){
        transArr.splice(i,1)
        history.removeChild(history.childNodes[i])
        showCalc()
        });
        myUpdate.addEventListener("click", function(){
            console.log('update'+i)
            });   
*/

}

//get total for each type and balance 




function showCalc(){
    incomeTotal=0;
expenseTotal=0;
    for(let i=0; i< transArr.length; i++){
        if (transArr[i][0]==="Income"){
            incomeTotal+=parseInt(transArr[i][2]);
        }else{
             expenseTotal+=parseInt(transArr[i][2]);
        }
    }
let newBalance = incomeTotal-expenseTotal;
balance.innerHTML= newBalance;
runningIncome.innerHTML=incomeTotal;
runningExpense.innerHTML=expenseTotal;



if(newBalance>0){ //color code the running total based on if it is greater than 0 or not
    balance.style.color='green';
}else{
   balance.style.color='red';
}
}
showCalc();
//clear input fields and disable amount and category
type.value='';
amount.value='';
category.value='';
category.disabled=true;
amount.disabled=true;


//make array to hold cat per type
incomeCat = [];
expenseCat = [];
for (let i=0; i< transArr.length; i++){
    if (transArr[i][0]==="Income"){
        incomeCat.push(transArr[i][1]);
    }else{
         expenseCat.push(transArr[i][1]);
    }
}





}else{//if all fields are not completed
    error.innerHTML='Error! Please complete all fields!';
    error.style.color='red';
    }
});



/*

const QuickChart = require('quickchart-js');

const chart = new QuickChart();

chart.setWidth(500)
chart.setHeight(300);

chart.setConfig({
  type: 'pie',
  data: {
    datasets: [
      {
        data: [84, 28, 57, 19, 97],
        backgroundColor: [
          'rgb(255, 99, 132)',
          'rgb(255, 159, 64)',
          'rgb(255, 205, 86)',
          'rgb(75, 192, 192)',
          'rgb(54, 162, 235)',
        ],
        label: 'Income',
      },
    ],
    labels: ['Salary', 'Investments', 'Gifts', 'Lottery', 'Other'],
  },
});

// Print the chart URL
console.log(chart.getUrl());

// Get the image...
//const image = await chart.toBinary();

// Or write it to a file
chart.toFile('chart.png');

// Print the chart URL
console.log(myChart.getUrl());
*/