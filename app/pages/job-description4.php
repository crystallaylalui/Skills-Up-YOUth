<?php
    session_start();
    // No session variable "user" => no login
    if ( !isset($_SESSION["user_id"]) ) {
         // redirect to login page
         header("Location: ../index.php"); 
         exit;
    }
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Details</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://unpkg.com/vue@3"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link href="../css/jobdesc.css" rel="stylesheet">
    <script defer src="navbar.js"></script>
</head>

<body>
    <div>
        <?php include ('navbar.php'); ?>
    </div>
    <!-- <div class="top-section">
        <h2>Important Information Concisely</h2>
        <p>Additional details here...</p>
    </div> -->
    <div class="container-fluid" id="job">
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
                            <!-- <img src="../images/badges/js3.png"> -->
                            <!-- <button class="badge-button">Badge 1</button> -->
                            <!-- <button class="badge-button">Badge 2</button> -->
                            <!-- more badges if needed -->
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
                                <strong>Project Duration:</strong><br> Project Duration
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

    <script>
        // Function to fetch job details from the API
        function fetchJobDetails(jobId) {
            fetch('https://crystallaylalui.github.io/JSON-Data/db.json')
                .then(response => response.json())
                .then(data => {
                    const job = data.jobs.find(job => job.id === jobId);
                    if (job) {
                        console.log('Fetched job details:', job);
                        updateJobDetails(job);
                    } else {
                        console.error('Job not found');
                    }
                })
                .catch(error => console.error('Error fetching job details:', error));
        }

        // Usage example
        fetchJobDetails(4); // Fetch details for job with id 1


        // Function to update the job details on the page
        function updateJobDetails(job) {
            // Update job title
            document.querySelector('.large-text').innerText = job.title;

            // Update job description
            document.querySelector('.job-description p').innerText = job.description;

            // Update responsibilities
            const responsibilitiesList = document.querySelector('.responsibilities ul');
            responsibilitiesList.innerHTML = job.responsibilities.map(res => `<li>${res}</li>`).join('');

            // Update requirements
            const requirementsList = document.querySelector('.requirements ul');
            requirementsList.innerHTML = job.requirements.map(req => `<li>${req}</li>`).join('');

            // Update badges
            const badgeSection = document.querySelector('.badge-section');
            badgeSection.innerHTML = `
                <div class="section-heading">Badges</div>
                ${job.badges.map(badge => `<img src='../images/badges/${badge}.png' style='width: 120px;'>`).join('')}
            `;

            // Update other job details
            const detailsSection = document.querySelector('.details-section');
            detailsSection.innerHTML = `
                <div class="section-heading">Job Details</div>
                <hr>
                <div class="details-item">
                    <strong>Job Creation Date:</strong><br> ${job.details.creationDate}
                </div>
                <div class="details-item">
                    <strong>Recruitment Period:</strong><br> ${job.details.recruitmentPeriod}
                </div>
                <div class="details-item">
                    <strong>Hiring Manager:</strong><br> ${job.details.hiringManager}
                </div>
                <div class="details-item">
                    <strong>Project Duration:</strong><br> ${job.details.projectDuration}
                </div>
                <div class="details-item">
                    <strong>Recruitment Quota:</strong><br> ${job.details.recruitmentQuota}
                </div>
                <div class="details-item">
                    <strong>Job Type:</strong><br> ${job.details.jobType}
                </div>
                <div class="details-item">
                    <strong>Location:</strong><br> ${job.details.location}
                </div>
                <div class="details-item">
                    <strong>Salary:</strong><br> ${job.details.salary}
                </div>
                <div class="details-item">
                    <strong>Work Category:</strong><br> ${job.details.workCategory}
                </div>
            `;

            // Update other job details as needed
        }

        // Apply button click event
        document.addEventListener('DOMContentLoaded', function () {
            // Get the "Apply" button
            var applyButton = document.querySelector('.apply-button');

            // Add a click event listener to the "Apply" button

            document.querySelector('.apply-button').addEventListener('click', function () {
                // Display an alert when the button is clicked
                alert('Job applied!');
            });
        });


        // Fetch job details when the page loads
        window.onload = fetchJobDetails;

        const job = Vue.createApp({
            data() {
                return {

                }
            },
            created() {

            },
            methods: {
                getAllJobs() {
                    let url = "https://crystallaylalui.github.io/JSON-Data/db.json";

                    axios.get(url)
                    .then(r => {
                        this.jobs = r.data.jobs;

                        // for (i in r.data.jobs) {
                        //     if(r.data.jobs[i].job_badges.every(r => this.user_badges.includes(r)) == true){
                        //         this.unlocked.push(r.data.jobs[i]);
                        //     } else {
                        //         this.locked.push(r.data.jobs[i]);
                        //     }
                        // }
                    })
                },
                checkJob() {
                    this.jobs[3].job_badges.every(r => this.user_badges.includes(r))
                }
            }
        })

        const vm = job.mount("#job");

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
