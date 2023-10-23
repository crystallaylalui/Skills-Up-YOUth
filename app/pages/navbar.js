document.addEventListener('DOMContentLoaded', function () {
    const navbar = document.getElementById('navbar');
    const indicator = document.getElementById('indicator');

    // Function to update the indicator position based on the active link
    function updateIndicator() {
        const activeLink = document.querySelector('.nav-link.active');
        if (activeLink) {
            const offsetLeft = activeLink.offsetLeft;
            const width = activeLink.offsetWidth;
            indicator.style.width = `${width}px`;
            indicator.style.transform = `translateX(${offsetLeft}px)`;
        }
    }

    // Add click event listeners to each link
    const links = document.querySelectorAll('.nav-link');
    links.forEach(link => {
        link.addEventListener('click', function () {
            // Remove 'active' class from all links
            links.forEach(link => link.classList.remove('active'));
            // Add 'active' class to the clicked link
            this.classList.add('active');
            // Update the indicator position
            updateIndicator();
        });
    });

    // Initial positioning of the indicator
    updateIndicator();
});
