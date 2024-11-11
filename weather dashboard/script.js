function getWeather() {
  const city = document.getElementById("cityInput").value;
  if (city === "") {
    alert("Please enter a city name.");
    return;
  }

  fetch(`weather.php?city=${city}`) // Use backticks for template literal
    .then(response => response.json())
    .then(data => {
      if (data.error) {
        document.getElementById("weatherResult").innerHTML = `<p>${data.error}</p>`;
      } else {
        document.getElementById("weatherResult").innerHTML = `
          <h2>${data.city}, ${data.country}</h2>
          <p>Temperature: ${data.temperature}°C</p>
          <p>Weather: ${data.description}</p>
          <p>Humidity: ${data.humidity}%</p>
          <p>Wind Speed: ${data.windSpeed} m/s</p>
        `;
      }
    })
    .catch(error => {
      console.error("Error:", error);
      document.getElementById("weatherResult").innerHTML = `<p>Failed to fetch weather data.</p>`;
    });
}
