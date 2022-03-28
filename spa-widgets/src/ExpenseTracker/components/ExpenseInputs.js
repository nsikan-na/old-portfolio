import React, { useRef, useState, useEffect } from "react";

export default function ExpenseInputs({ addTrans, event, updateTran }) {
  const incomeRef = useRef();
  const expenseRef = useRef();
  const descRef = useRef();
  const amountRef = useRef();

  function addTran(e) {
    e.preventDefault();
    const type = e.target.type.value;
    const desc = e.target.desc.value;
    const amount = e.target.amount.value;
    if (!type || !desc || !amount) return;
    addTrans(type, desc, amount);
    incomeRef.current.checked = false;
    expenseRef.current.checked = false;
    descRef.current.value = null;
    amountRef.current.value = null;
  }

  useEffect(() => {
    if (!event) return;
    const update = [...JSON.parse(localStorage.getItem("transactions"))][event];
    // console.log(update,Number(event));
    update.type === "Income"
      ? (incomeRef.current.checked = true)
      : (expenseRef.current.checked = true);
    amountRef.current.value = update.amount;
    descRef.current.value = update.desc;
  }, [updateTran]);

  return (
    <div>
      <br />
      <form onSubmit={addTran}>
        <label>Income</label>
        <input
          ref={incomeRef}
          type="radio"
          name="type"
          value="Income"
          className="mr-10 ml-1 active:bg-green-600 hover:bg-green-600 checked:bg-green-600 clicked:bg-green-600 focus:ring-transparent "
        />
        <label>Expense</label>
        <input
          ref={expenseRef}
          type="radio"
          name="type"
          value="Expense"
          className="ml-1 active:bg-red-600 hover:bg-red-600 checked:bg-red-600 clicked:bg-red-600 focus:ring-transparent"
        />

        <br />
        <br />
        <label>Description</label>
        <input ref={descRef} type="text" name="desc" className="ml-3 w-40" />
        <br />
        <br />
        <label>Amount</label>
        <input
          ref={amountRef}
          type="number"
          name="amount"
          className="ml-3 w-20"
        />
        <br />
        <br />
        <button>Add Transaction</button>
      </form>
    </div>
  );
}
