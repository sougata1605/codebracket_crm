
<footer class="bg-black text-center py-3 border-top text-warning" 
        style="position: fixed; bottom: 0; width: 100%; z-index: 1000;">
    <small class="fw-bold" id="istClock">
        © Codebrackets CRM. All rights reserved.
    </small>
</footer>


<script>
function updateISTClock() {
    const now = new Date();

    const options = {
        timeZone: 'Asia/Kolkata',
        weekday: 'long',
        year: 'numeric',
        month: 'short',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: true
    };

    document.getElementById('istClock').innerHTML =
        new Intl.DateTimeFormat('en-IN', options).format(now) +
        ' | Codebrackets CRM. All rights reserved.';
}

updateISTClock();
setInterval(updateISTClock, 1000);
</script>

