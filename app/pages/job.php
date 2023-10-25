<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script defer src="navbar.js"></script>

    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-black">
            <div class="container-fluid">
                <!-- Left Logo -->
                <a class="navbar-brand" href="#" style="font-size: 30px; flex: 0;">
                    <img src="../images/logo.jpg" alt="Logo" style="width: 150px;">
                </a>
        
                <!-- Navbar Toggler Button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
        
                <!-- Navbar Links -->
                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#" style="font-size: 28px;">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" style="font-size: 28px;">Courses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" style="font-size: 28px;">Jobs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" style="font-size: 28px;">Leaderboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" style="font-size: 28px;">Profile</a>
                        </li>
                    </ul>
                </div>
        
                <!-- Right Logo (Duplicated) -->
                <a class="navbar-brand" href="#" style="font-size: 30px; flex: 0;">
                    <img src="../images/filler.jpg" alt="Logo" style="width: 150px;">
                </a>
            </div>
            <div id="indicator"></div>
        </nav>
    </div>

    <div id="job-search-container" style="background-color: black; color: white; padding: 50px;">
        <div class="row">
            <!-- Search Bar -->
            <div id="search-bar" class="col-md-6">
                <div class="search-container">
                    <input type="text" placeholder="Search jobs..." class="form-control">
                    <!-- Add other search-related elements here -->
                </div>
            </div>

            <!-- Employer Reviews -->
            <div id="employer-reviews" class="col-md-2">
                <h3>Employer Reviews</h3>
                <!-- Add content specific to employer reviews -->
            </div>

            <!-- Project Duration -->
            <div id="project-duration" class="col-md-2">
                <h3>Project Duration</h3>
                <!-- Add content specific to project duration -->
            </div>

            <!-- For Employers -->
            <div id="for-employers" class="col-md-2">
                <h3>For Employers</h3>
                <!-- Add content specific to employers -->
            </div>
        </div>
    </div>

    <div class="row">
        <div id="filter-container" class="col-md-3" style="border-right: 1px solid black; padding-right: 10px;">
            <h2>Filters</h2>
            
            <!-- Employment Type Filter -->
            <div class="filter-section">
                <h3>Employment Type</h3>
                <div class="filter-option">
                    <input type="checkbox" id="full-time" name="employment-type" value="full-time">
                    <label for="full-time">Full Time</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="part-time" name="employment-type" value="part-time">
                    <label for="part-time">Part Time</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="internship" name="employment-type" value="internship">
                    <label for="internship">Internship</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="volunteer" name="employment-type" value="volunteer">
                    <label for="volunteer">Volunteering</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="project" name="employment-type" value="project">
                    <label for="project">Project-Based</label>
                </div>
            </div>
        
            <!-- Eligibility Filter -->
            <div class="filter-section">
                <h3>Eligibility Based on</h3>
                <div class="filter-option">
                    <input type="checkbox" id="completed" name="eligibility" value="completed">
                    <label for="completed">Completed Courses</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="ongoing" name="eligibility" value="ongoing">
                    <label for="ongoing">Ongoing Courses</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="saved" name="eligibility" value="saved">
                    <label for="saved">Saved Courses</label>
                </div>
            </div>
        
            <!-- Work Location Filter -->
            <div class="filter-section">
                <h3>Work Location</h3>
                <div class="filter-option">
                    <input type="checkbox" id="in-office" name="work-location" value="in-office">
                    <label for="in-office">In Office</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="remote" name="work-location" value="remote">
                    <label for="remote">Remote</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="hybrid" name="work-location" value="hybrid">
                    <label for="hybrid">Hybrid</label>
                </div>
            </div>
        
            <!-- Add more filter sections as needed -->
        </div>

        <!-- jobs -->
        <div class="col-md-8" style="padding: 50px;">
            <h2>All courses</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-custom bg-white border-white border-0">
                        <div class="card-custom-img" style="background-image: url(../images/job.jpg)"></div>
                        <div class="card-custom-avatar">
                        <img class="img-fluid" src="../images/job1.jpeg" alt="Avatar" />
                        </div>
                        <div class="card-body" style="overflow-y: auto">
                        <h4 class="card-title">Software Engineer</h4>
                        <p class="card-text">Job Description</p>
                        </div>
                        <div class="card-footer" style="background: inherit; border-color: inherit;">
                        <a href="#" class="btn btn-dark">Apply</a>
                        <button id="saveButton" onclick="saveFilters()">Save</button>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom bg-white border-white border-0">
                        <div class="card-custom-img" style="background-image: url(../images/job.jpg)"></div>
                        <div class="card-custom-avatar">
                        <img class="img-fluid" src="../images/job2.png" alt="Avatar" />
                        </div>
                        <div class="card-body" style="overflow-y: auto">
                        <h4 class="card-title"> Cybersecurity Engineer</h4>
                        <p class="card-text"> Job description </p>
                        </div>
                        <div class="card-footer" style="background: inherit; border-color: inherit;">
                        <a href="#" class="btn btn-dark">Apply</a>
                        <button id="saveButton" onclick="saveFilters()">Save</button>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom bg-white border-white border-0">
                        <div class="card-custom-img" style="background-image: url(../images/job.jpg)"></div>
                        <div class="card-custom-avatar">
                        <img class="img-fluid" src="../images/job3.png" alt="Avatar" />
                        </div>
                        <div class="card-body" style="overflow-y: auto">
                        <h4 class="card-title"> Front-End Engineer</h4>
                        <p class="card-text"> Job description </p>
                        </div>
                        <div class="card-footer" style="background: inherit; border-color: inherit;">
                        <a href="#" class="btn btn-dark">Apply</a>
                        <button id="saveButton" onclick="saveFilters()">Save</button>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        // Function to save filters to local storage
        function saveFilters() {
            // Get selected filters (you need to adapt this part based on your actual filters)
            var selectedFilters = {
                employmentType: getSelectedFilters('employment-type'),
                eligibility: getSelectedFilters('eligibility'),
                workLocation: getSelectedFilters('work-location')
            };

        // Save to local storage
        localStorage.setItem('savedFilters', JSON.stringify(selectedFilters));

        alert('Job saved!');
        }

        // Function to get selected filters by name
        function getSelectedFilters(filterName) {
            var checkboxes = document.querySelectorAll('input[name="' + filterName + '"]:checked');
            return Array.from(checkboxes, checkbox => checkbox.value);
        }

        // Function to load saved filters from local storage
        function loadSavedFilters() {
            var savedFiltersJSON = localStorage.getItem('savedFilters');
            if (savedFiltersJSON) {
                var savedFilters = JSON.parse(savedFiltersJSON);

                // Apply saved filters to your UI (you need to implement this part)
                applyFilters(savedFilters);
            }
        }

        // Call this function when the page is loaded to load saved filters
        loadSavedFilters();

    </script>

</body>
</html>