import React, { useState, useEffect } from 'react';
import _Header from './_Header';
import _Body from './_Body';
import _Footer from './_Footer';
import useCurrentDate from './_Time'; // import custom hook
import './App.css';

function App() {
  const { dayName, dateString } = useCurrentDate(); // use hook
  const [quantity, setQuantity] = useState('');

  useEffect(() => {
    fetch("http://172.30.17.120:8000/api.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ name: "Santhosh", order: "Milk 500ml" }),
    })
      .then((res) => res.json())
      .then((data) => console.log("Response from PHP:", data))
      .catch((err) => console.error("Fetch error:", err));
  }, []); // empty dependency array so it runs only once on mount

  return (
    <div className="App">
      <_Header />
      <_Body
        quantity={quantity}
        setQuantity={setQuantity}
        dateString={dateString}
        dayName={dayName}
      />
      <_Footer />
    </div>
  );
}

export default App;
