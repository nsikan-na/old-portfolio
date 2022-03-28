import React, { useEffect, useState } from "react";
import ExpenseInputs from "./components/ExpenseInputs";
import QuickChart from "quickchart-js/build/quickchart.esm.js";

//test
// [{"type":"Income","desc":"love","amount":"400"},{"type":"Income","desc":"love","amount":"300"},{"type":"Income","desc":"love","amount":"200"},{"type":"Expense","desc":"hate","amount":"300"},{"type":"Expense","desc":"hate","amount":"200"},{"type":"Income","desc":"love","amount":"500"},{"type":"Expense","desc":"hate","amount":"100"},{"type":"Income","desc":"love","amount":"400"},{"type":"Expense","desc":"hate","amount":"100"},{"type":"Expense","desc":"hate","amount":"200"}]
const transArr = [...JSON.parse(localStorage.getItem("transactions"))];
function calcIncome() {
  const incomeArr = [];
  transArr
    .filter((tran) => {
      return tran.type === "Income";
    })
    .forEach((tran) => incomeArr.push(tran.amount));
  if (incomeArr.length === 0) return 0;
  return incomeArr.reduce((prev, cur) => Number(prev) + Number(cur));
}
function calcExpense() {
  const expenseArr = [];
  transArr
    .filter((tran) => {
      return tran.type === "Expense";
    })
    .forEach((tran) => expenseArr.push(tran.amount));
  if (expenseArr.length === 0) return 0;
  return expenseArr.reduce((prev, cur) => Number(prev) + Number(cur));
}

export default function ExpenseTracker() {
  const [incomeTotal, setIncomeTotal] = useState(calcIncome());
  const [expenseTotal, setExpenseTotal] = useState(calcExpense());
  const [balance, setBalance] = useState(incomeTotal - expenseTotal);
  const [update, setUpdate] = useState(false);
  const balColor = balance > 0 ? "green" : "red";
  const [event, setEvent] = useState(null);
  const [updateTran, setUpdateTran] = useState(true);
  const addTrans = (type, desc, amount) => {
    transArr.push({ type, desc, amount });
    setUpdate(!update);
  };
  const removeTrans = (e) => {
    transArr.splice(e.target.name, 1);
    setUpdate(!update);
  };
  const updateTrans = (e) => {
    setEvent(e.target.name);
    setUpdateTran(!updateTran);
    transArr.splice(e.target.name, 1);
    setUpdate(!update);
  };

  const filler = transArr.map(({ type, desc, amount }, i) => {
    const tranColor = type === "Income" ? "green-700" : "red-600";
    return (
      <div
        key={i}
        className={`my-5 bg-${tranColor} w-1/6 m-auto text-white rounded-3xl`}
      >
        <h3>{type}</h3>
        <h3>{desc}</h3>
        <h3>{amount}</h3>
        <button name={i} onClick={updateTrans}>
          Update
        </button>
        <br />
        <button name={i} onClick={removeTrans} className="hover:">
          Delete
        </button>
      </div>
    );
  });
  const [chart, setChart] = useState("");
  function printChart() {
    const myChart = new QuickChart();
    myChart
      .setConfig({
        type: "doughnut",
        data: {
          labels: ["Expense", "Income"],
          datasets: [
            {
              data: [calcExpense(), calcIncome()],
              backgroundColor: ["rgb(255, 0, 0)", "darkgreen"],
            },
          ],
        },
      })
      .setHeight("150%")
      .setBackgroundColor("transparent")
    setChart(<img className="transition mx-auto"  src={myChart.getUrl()} />);
  }
  const [result, setResult] = useState(filler);
  useEffect(() => {
    setResult(filler);
    setIncomeTotal(calcIncome());
    setExpenseTotal(calcExpense());
    setBalance(calcIncome() - calcExpense());
    localStorage.setItem("transactions", JSON.stringify(transArr));
    printChart();
  }, [update]);
  return (
    <div className="text-center ">
      <h1 className="text-5xl font-bold">Expense Tracker</h1>
      <ExpenseInputs
        addTrans={addTrans}
        event={event}
        updateTran={updateTran}
      />
      <br />
      <h2>Income: <span className='font-bold text-2xl text-green-700'>{incomeTotal}</span></h2>
      <h2>Expense: <span className='font-bold text-2xl text-red-600'>{expenseTotal}</span></h2>

      <h2>
        Balance:{" "}
        <span className={`text-${balColor}-700 font-bold text-4xl`}>
          {balance}
        </span>
      </h2>
      {chart}
      <br />
      {result}
    </div>
  );
}
