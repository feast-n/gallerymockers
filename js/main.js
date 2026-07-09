document.addEventListener('DOMContentLoaded', () => {
    const joinForm = document.getElementById('joinForm');
    if (joinForm) {
        joinForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value; 
            const msg = document.getElementById('joinMsg');
            msg.style.display = 'block';
            msg.textContent = `Thanks! ${email} joined the list.`;
            this.reset();
        });
    }

    const counters = document.querySelectorAll('.stats-section .fw-bold');

    counters.forEach(c => {
        c.dataset.target = c.innerText.replace(/[^0-9]/g, '');
        c.innerText = "0+";
    });

    const runCounter = (el) => {
        const target = +el.dataset.target;
        const speed = 100;
        const increment = target / speed;

        const update = () => {
            const current = +el.innerText.replace(/[^0-9]/g, '');
            if (current < target) {
                el.innerText = Math.ceil(current + increment) + "+";
                setTimeout(update, 20);
            } else {
                el.innerText = target + "+";
            }
        };
        update();
    };

    const counterObserver = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                if (!counter.dataset.counted) {
                    runCounter(counter);
                    counter.dataset.counted = "true";
                }
                obs.unobserve(counter);
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(el => {
        counterObserver.observe(el);
    });
});