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

<style>
    img {
        width: 80px;
    }
</style>

<body>
    <div>
        <?php include ('navbar.php'); ?>
    </div>

    <div class="row">
        
        <!-- jobs -->
        <!-- <div class="col-md-8" style="padding: 50px;"> -->
        <div style="padding: 50px;">
            <h2>Jobs available</h2>
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-custom bg-light border-black border-2">
                        <div class="card-custom-img" style="background-image: url(../images/job.jpg)"></div>
                        <div class="card-custom-avatar">
                        <!-- <img class="img-fluid" src="../images/job1.jpeg" alt="Avatar" /> -->
                        </div>
                        <div class="card-body" style="overflow-y: auto">
                        <h4 class="card-title">JavaScript Developer</h4>
                        <p class="card-text">Building a mobile-app</p>
                        <img src="../images/badges/js3.png">
                        <img src="../images/badges/php2.png">
                        </div>
                        <div class="card-footer" style="background: inherit; border-color: inherit;">
                        <a href="job-description1.php" class="btn btn-dark">Learn More</a>
                        <button id="saveButton" onclick="saveFilters()">Save</button>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-custom bg-light border-black border-2">
                        <div class="card-custom-img" style="background-image: url(../images/job.jpg)"></div>
                        <div class="card-custom-avatar">
                        <!-- <img class="img-fluid" src="../images/job2.png" alt="Avatar" /> -->
                        </div>
                        <div class="card-body" style="overflow-y: auto">
                        <h4 class="card-title">Python Backend Developer</h4>
                        <p class="card-text"> Analytics project </p>
                        <img src="../images/badges/py3.png">
                        <img src="../images/badges/sql2.png">
                        </div>
                        <div class="card-footer" style="background: inherit; border-color: inherit;">
                        <a href="job-description2.php" class="btn btn-dark">Learn More</a>
                        <button id="saveButton" onclick="saveFilters()">Save</button>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-custom bg-light border-black border-2">
                        <div class="card-custom-img" style="background-image: url(../images/job.jpg)"></div>
                        <div class="card-custom-avatar">
                        <!-- <img class="img-fluid" src="../images/job3.png" alt="Avatar" /> -->
                        </div>
                        <div class="card-body" style="overflow-y: auto">
                        <h4 class="card-title">PHP Developer</h4>
                        <p class="card-text"> For e-commerce platform </p>
                        <img src="../images/badges/php3.png">
                        <img src="../images/badges/js1.png">
                        <img src="../images/badges/sql2.png">
                        </div>
                        <div class="card-footer" style="background: inherit; border-color: inherit;">
                        <a href="job-description3.php" class="btn btn-dark">Learn More</a>
                        <button id="saveButton" onclick="saveFilters()">Save</button>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-custom bg-light border-black border-2">
                        <div class="card-custom-img" style="background-image: url(../images/job.jpg)"></div>
                        <div class="card-custom-avatar">
                        <!-- <img class="img-fluid" src="../images/job3.png" alt="Avatar" /> -->
                        </div>
                        <div class="card-body" style="overflow-y: auto">
                        <h4 class="card-title"> MySQL Database Engineer</h4>
                        <p class="card-text"> For social platform </p>
                        <img src="../images/badges/sql3.png">
                        <img src="../images/badges/php2.png">
                        <img src="../images/badges/py2.png">
                        </div>
                        <div class="card-footer" style="background: inherit; border-color: inherit;">
                        <a href="job-description4.php" class="btn btn-dark">Learn More</a>
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