import React, { useState, useEffect, useRef } from "react";
import axios from "axios";

export default function WikiMain() {
  const [result, setResult] = useState("");
  const [term, setTerm] = useState("baby lion");
  const [imgUrl, setImgUrl] = useState(term);
  const myInput = useRef();

  useEffect(() => {
    if (!term) return;
    (async function () {
      await axios
        .get("https://api.unsplash.com/search/photos", {
          headers: {
            Authorization:
              "Client-ID qPSfInk8l6XGrlFg4jkjVs3KlkiDfrYA-JW9YQE8hkU",
          },
          params: {
            query: term,
          },
        })
        .then((res) => {
          setImgUrl(res.data.results[0].urls.regular);
        });
      await axios
        .get("https://en.wikipedia.org/w/api.php", {
          params: {
            action: "query",
            list: "search",
            origin: "*",
            format: "json",
            srsearch: term,
          },
        })
        .then((response) => {
          setResult(
            <>
              {response.data.query.search[0].snippet
                .replaceAll('<span class="searchmatch">', "")
                .replaceAll("</span>", "")
                .replaceAll("&quot;", ``)
                .concat("...")}
            </>
          );
        });
    })();
    myInput.current.value = "";
  }, [term, imgUrl]);

  return (
    <div className="text-center m-auto">
      <form
        onSubmit={(e) => {
          e.preventDefault();
          setTerm(myInput.current.value);
        }}
      >
        <h1 className="text-5xl my-3 font-bold">Quick Search</h1>
        <input
          style={{ width: "50%", fontSize: "2em" }}
          placeholder="Enter a term"
          ref={myInput}
          type="text"
        />
      </form>
      <h2 className=" text-3xl my-5">
        {term[0].toUpperCase() + term.slice(1)}
      </h2>
      <h3 className="m-auto text-2xl my-4">{result}</h3>
      <img className="m-auto max-w-3xl" src={imgUrl} />
    </div>
  );
}
