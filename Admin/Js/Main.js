document.addEventListener("DOMContentLoaded", function () {
    // Initialize listeners for dropdowns and sidebar
    function initializeListeners() {
        // Initialize header listeners
        const akun = document.querySelector('.akun');
        const dropdown = document.querySelector('.akun .dropdown');

        if (akun) {
            akun.addEventListener('click', function (event) {
                event.stopPropagation();
                if (dropdown) {
                    dropdown.classList.toggle('active');
                }
            });
        }

        document.addEventListener('click', function (event) {
            if (dropdown && !akun.contains(event.target)) {
                dropdown.classList.remove('active');
            }
        });

        // Initialize aside listeners
        const surveyToggle = document.querySelector('#survey-menu');
        const dropdownSurvey = document.querySelector('.dropdown-survey');
        const arrow = document.querySelector('.arrow');

        if (surveyToggle && dropdownSurvey && arrow) {
            surveyToggle.addEventListener('click', function (event) {
                event.stopPropagation(); // Prevent click event from propagating
                dropdownSurvey.classList.toggle('show');
                arrow.classList.toggle('rotate');
            });

            // Add a click listener to document to close dropdown if clicked outside
            document.addEventListener('click', function (event) {
                if (!dropdownSurvey.contains(event.target) && !surveyToggle.contains(event.target)) {
                    dropdownSurvey.classList.remove('show');
                    arrow.classList.remove('rotate');
                }
            });
        }
    }

    // Function to set the active link in the sidebar
    function setActiveLink() {
        // Get the current page URL
        const currentPage = window.location.pathname.split('/').pop();

        // Get all sidebar links
        const links = document.querySelectorAll("nav ul li a");

        // Loop through links and add the 'active' class to the matching one
        links.forEach(link => {
            const href = link.getAttribute('href').split('/').pop(); // Get the file name from href
            if (currentPage === href) {
                link.parentElement.classList.add('active');
            } else {
                link.parentElement.classList.remove('active');
            }
        });
    }

    // Function to load HTML content
    function loadHTML(id, url) {
        fetch(url)
            .then(response => response.text())
            .then(data => {
                document.getElementById(id).innerHTML = data;
            })
            .then(() => {
                initializeListeners();
                setActiveLink(); // Set the active link after loading the HTML
            })
            .catch(error => console.error('Error loading HTML:', error)); // Added error handling
    }

    // Load header HTML and initialize listeners
    loadHTML('header', 'Main.php');
});
