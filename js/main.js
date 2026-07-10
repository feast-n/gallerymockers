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

const myBtn = document.getElementById("myBtn");

window.addEventListener("scroll", () => {
    if (window.scrollY > 100) {
        myBtn.classList.add("show");
    } else {
        myBtn.classList.remove("show");
    }
});

myBtn.addEventListener("click", () => {
    window.scrollTo({ top: 0, behavior: "smooth" });
});
// --- History Year Filter Logic ---
document.addEventListener('DOMContentLoaded', () => {
    const filterButtons = document.querySelectorAll('#yearFilterGroup .btn');
    const historyCards = document.querySelectorAll('.card'); // Targets the history timeline cards

    if (filterButtons.length > 0 && historyCards.length > 0) {
        
        // 1. Auto-tag each card with a data-year based on its h4 title
        historyCards.forEach(card => {
            const titleElement = card.querySelector('h4');
            if (titleElement) {
                const titleText = titleElement.textContent;
                // Looks for any 4-digit year starting with 202
                const yearMatch = titleText.match(/\b(202\d)\b/); 
                
                if (yearMatch) {
                    card.setAttribute('data-year', yearMatch[0]);
                } else if (titleText.includes('Today')) {
                    // Maps the "Today: A Global Platform" card to 2026
                    card.setAttribute('data-year', '2026'); 
                }
            }
        });

        // 2. Handle button clicks for filtering
        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active styling from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));
                // Add active styling to the clicked button
                button.classList.add('active');

                const selectedYear = button.getAttribute('data-filter');

                // 3. Filter the cards with a smooth animation
                historyCards.forEach(card => {
                    const cardYear = card.getAttribute('data-year');
                    
                    if (selectedYear === 'all' || cardYear === selectedYear) {
                        card.style.display = 'block';
                        // Uses Web Animations API for a bug-free, immersive fade
                        card.animate([
                            { opacity: 0, transform: 'translateY(10px)' }, 
                            { opacity: 1, transform: 'translateY(0)' }
                        ], { 
                            duration: 400, 
                            easing: 'ease-out', 
                            fill: 'forwards' 
                        });
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    }
});