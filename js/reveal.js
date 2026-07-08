document.addEventListener('DOMContentLoaded', function() {
  // Select all elements with the class 'reveal'
  const reveals = document.querySelectorAll('.reveal');

  // Configure the observer
  const revealOptions = {
    threshold: 0.15, // Triggers when 15% of the element is visible
    rootMargin: "0px 0px -50px 0px" // Slightly delays the trigger until it's further up the screen
  };

  // Create the Intersection Observer
  const revealOnScroll = new IntersectionObserver(function(entries, observer) {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        // Add the 'active' class when it enters the screen
        entry.target.classList.add('active');
        
        // Optional: Stop observing if you only want the animation to happen once per page load
        // observer.unobserve(entry.target); 
      } else {
        // Optional: Remove the class if you want the animation to repeat when scrolling back up
        entry.target.classList.remove('active');
      }
    });
  }, revealOptions);

  // Apply the observer to all '.reveal' elements
  reveals.forEach(reveal => {
    revealOnScroll.observe(reveal);
  });
});