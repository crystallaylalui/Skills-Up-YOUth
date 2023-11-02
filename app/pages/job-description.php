<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            /* background: url('../images/job-desc.jpeg') center/cover fixed; */
            background-color: rgba(255, 255, 255, 0.8); /* Translucent white background */
            color: #333;
        }

        .navbar {
            background-color: #007bff;
            padding: 10px;
            color: #fff;
            text-align: center;
        }

        .section-container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            margin-top: 20px;
        }

        .left-section {
            padding: 20px;
            text-align: left;
        }

        .left-section h1 {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .large-text {
            font-size: 1.5em;
        }

        .section-heading {
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .job-description,
        .responsibilities,
        .requirements {
            margin-bottom: 20px;
        }

        .badge-section {
            margin-top: 20px;
        }

        .badge-button {
            background-color: #87CEEB;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            margin-right: 10px;
            cursor: pointer;
        }

        .apply-button {
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
            margin-right: 10px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
        }

        .right-section {
            padding: 20px;
            /* text-align: right; */
            background-color: #f8f9fa;
        }

        .details-section {
            margin-top: 20px;
            color: #555;
        }

        .details-section hr {
            border: 1px solid #ddd;
            margin: 10px 0;
        }

        .details-item {
            margin-bottom: 10px;
        }

        .top-section {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
        }

        .top-section h2 {
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div>
        <?php include ('navbar.php'); ?>
    </div>
    <!-- <div class="top-section">
        <h2>Important Information Concisely</h2>
        <p>Additional details here...</p>
    </div> -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="section-container">
                    <div class="left-section">
                        <p class="section-heading">Job Title</p>
                        <div class="large-text">Senior Product Design</div>
                        <hr>
                        <div class="job-description">
                            <div class="section-heading">Job Description</div>
                            <p>Concise description here...</p>
                        </div>
                        <div class="responsibilities">
                            <div class="section-heading">Responsibilities</div>
                            <ul>
                                <li>Responsibility 1</li>
                                <li>Responsibility 2</li>
                                <li>Responsibility 3</li>
                            </ul>
                        </div>
                        <div class="requirements">
                            <div class="section-heading">Requirements</div>
                            <ul>
                                <li>Requirement 1</li>
                                <li>Requirement 2</li>
                                <li>Requirement 3</li>
                            </ul>
                        </div>
                        <hr>
                        <div class="badge-section">
                            <div class="section-heading">Badges</div>
                            <button class="badge-button">Badge 1</button>
                            <button class="badge-button">Badge 2</button>
                            <!-- Add more badges as needed -->
                        </div>
                        <hr>
                        <button class="apply-button">Apply</button>
                        <!-- <button class="save-button">Save</button> -->
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="section-container">
                    <div class="right-section">
                        <div class="details-section">
                            <div class="section-heading">Job Details</div>
                            <hr>
                            <div class="details-item">
                                <strong>Job Creation Date:</strong><br> Date
                            </div>
                            <div class="details-item">
                                <strong>Recruitment Period:</strong><br> Period
                            </div>
                            <div class="details-item">
                                <strong>Hiring Manager:</strong><br> Manager
                            </div>
                            <div class="details-item">
                                <strong>Department:</strong><br> Department
                            </div>
                            <div class="details-item">
                                <strong>Recruitment Quota:</strong><br> Quota
                            </div>
                            <div class="details-item">
                                <strong>Job Type:</strong><br> Type
                            </div>
                            <div class="details-item">
                                <strong>Location:</strong><br> Location
                            </div>
                            <div class="details-item">
                                <strong>Salary:</strong><br> Salary
                            </div>
                            <div class="details-item">
                                <strong>Work Category:</strong><br> Work from Home/In Office/Hybrid
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>

