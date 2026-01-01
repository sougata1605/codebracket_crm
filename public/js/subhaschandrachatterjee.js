document.addEventListener('change', function(e) {
        if (!e.target.classList.contains('calling-type')) return;

        const modal = e.target.closest('.modal-body');

        modal.querySelector('.followup-date').classList.add('d-none');
        modal.querySelector('.followup-datetime').classList.add('d-none');

        const type = e.target.dataset.requireDate;

        if (type === 'date') {
            modal.querySelector('.followup-date').classList.remove('d-none');
        }

        if (type === 'datetime') {
            modal.querySelector('.followup-datetime').classList.remove('d-none');
        }
    });



    function getISTDate() {
  const now = new Date();
  const istOffset = 5.5 * 60; 
  const utc = now.getTime() + now.getTimezoneOffset() * 60000;
  return new Date(utc + istOffset * 60000);
}

async function fetchFestivalGreeting() {
  const istDate = getISTDate();
  
  const year = istDate.getFullYear();
  const month = istDate.getMonth() + 1;
  const day = istDate.getDate();

    const apiKey = "gvfkKwtUwDlGnQhu6ysNBqK0aLvKHl6V"; 
  const country = "IN";
  const url = `https://calendarific.com/api/v2/holidays?&api_key=${apiKey}&country=${country}&year=${year}&month=${month}&day=${day}`;

  try {
    const response = await fetch(url);
    const data = await response.json();
    const holidays = data.response.holidays;

    if (holidays && holidays.length > 0) {
      document.getElementById('festivalGreeting').innerText =
        `🎉 Happy ${holidays[0].name}! 🎉`;
      showBalloons();
    } else {
      document.getElementById('festivalGreeting').innerText = "";
    }
  } catch (error) {
    console.error("Error fetching festivals:", error);
    document.getElementById('festivalGreeting').innerText = "";
  }
}

function showBalloons() {
  const container = document.getElementById('balloons');
  for (let i = 0; i < 10; i++) {
    const balloon = document.createElement('div');
    balloon.className = 'balloon';
    balloon.style.left = Math.random() * window.innerWidth + 'px';
    balloon.style.backgroundColor = ['red', 'blue', 'green', 'yellow', 'pink'][Math.floor(Math.random()*5)];
    balloon.style.animationDuration = (3 + Math.random() * 3) + 's';
    container.appendChild(balloon);
  }
}

fetchFestivalGreeting();









document.addEventListener("DOMContentLoaded", function() {
    const element = document.getElementById('dynamicGreeting');
    const greetings = ["Hello  👋", "Clapping 👏", "Bye Bye 👋"];

    
    let index = 0;

    setInterval(function() {
        element.textContent = greetings[index];
        index = (index + 1) % greetings.length;
    }, 1000);
});


setTimeout(() => {
        const alert = document.getElementById('success-alert');
        if (alert) alert.style.display = 'none';
    }, 4000);