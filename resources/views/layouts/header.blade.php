<nav class="navbar navbar-dark bg-dark px-4">
    <span class="navbar-brand">Codebracket</span>

<div id="festivalGreeting" style="font-size: 0.9rem; color: #ff9800; font-weight: bold; margin-bottom:10px;"></div>
<div id="balloons"></div>


    <div class="dropdown">
        <a class="text-white dropdown-toggle" href="#" data-bs-toggle="dropdown">
            {{ auth()->user()->name }}
        </a>

        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="dropdown-item text-danger">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>

<script>
function getISTDate() {
  const now = new Date();
  const istOffset = 5.5 * 60; 
  const utc = now.getTime() + now.getTimezoneOffset() * 60000;
  return new Date(utc + istOffset * 60000);
}

async function fetchFestivalGreeting() {
  const istDate = getISTDate();
  // const istDate = new Date("2025-01-26T00:00:00+05:30"); 
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
</script>