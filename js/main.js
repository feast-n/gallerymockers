document.addEventListener('DOMContentLoaded', () => {
    const joinForm = document.getElementById('joinForm');
    if (joinForm) {
        joinForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const email = document.getElementById('joinEmail').value;
            const msg = document.getElementById('joinMsg');
            msg.style.display = 'block';
            msg.style.color = '#D4FF00';
            msg.textContent = `Thanks! ${email} joined the list.`;
            this.reset();
        });
    }
});