<?php
session_start();
$isLoggedIn = isset($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/CSS/everest.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Include SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.14/dist/sweetalert2.min.css">

    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <!--**********  Navbar Section *********--->
    <header class="nav-section">
        <div class="nav ">
            <a href="../../index.html" class="logo">
                <img src="../Data/logod.png" alt="logo">
                NepTours</a>

            <ul class="navbar">
                <li><a href="../../user/index.php">home</a></li>
                <li><a href="#2">Packages</a></li>
                <li><a href="#3">Services</a></li>
                <li><a href="#">Review</a></li>
                <li><a href="../../routes/contact.html">contact</a></li>
            </ul>

            <ul class="inout">
                <?php if (isset($_SESSION['username'])) { ?>
                <li style="font-size: 1.6rem; font-weight: 600;color:#fc7c12;">
                    <?php echo $_SESSION['username']; ?>
                </li>
                <li><a href="../controller/logout.php">Logout</a></li>
                <?php } else { ?>
                <li><a href="../controller/login.php">Login</a></li>
                <li><a href="../controller/register1.php">Signup</a></li>
                <?php } ?>
            </ul>
        </div>
    </header>

    <!-- Random Text Section -->
    <section class="gallary container">
        <div class="image">
            <div class="slider-container">
                <div class="slides">
                    <img class="slide" src="../Data/ebc.jpg" alt="Image 1">
                    <img class="slide" src="../Data/ebc1.jpg" alt="Image 2">
                    <img class="slide" src="../Data/ebc2.jpg" alt="Image 3">
                    <img class="slide" src="../Data/ebc3.jpg" alt="Image 4">
                </div>
            </div>
            <div class="imgtwo">
                <img src="../../Data/ebc4.jpg" class="imagee" alt="">
            </div>
            <div class="imgthree">
                <img src="../../Data/ebc5.jpg" alt="">
                <img src="../../Data/ebc6.jpg" alt="">
            </div>
        </div>
    </section>


    <section class="topic container">

        <div class="sticky">
            <div class="two-topic--btn">
                <button class="topic-btn-overview">Overview</button>
                <button class="topic-btn-policies">Policies</button>
            </div>

            <div class="booking">

                <button class="btn" id="proceedToBookBtn" href="booking.php?package_id=1&package_name=Trekking%20Adventure">Proceed To Book</button>

            </div>
        </div>
        <hr class="longline">


        <div class="pagecont">



            <div class="overview">
                <div class="content">
                    <div class="details">
                        <h1 class="title">Everest Base Camp</h1>
                        <p class="paragraph">
                            Gosaikunda Trek is religiously vital and naturally richer activity in the northern part
                            of Nepal fallen under Langtang National Park. Situated at an altitude of 4,380 meters,
                            Gosaikunda is the name of a sacred Kunda (Lake) and the main source of the popular
                            Trishuli River. Usually from January to June for about half year the Gosaikunda Lake
                            changes into frozen form offering spectacular views to its visitors.
                        </p>

                        <div class="quickinfo">
                            <h1 class="qtitle">Quick Infos :</h1>
                            <ul class="infoList">
                                <li>
                                    <div class="info">
                                        <i class="fa-regular fa-clock"></i>
                                        <h1>Duration: 4 days</h1>
                                    </div>
                                </li>
                                <li>
                                    <div class="info">
                                        <i class="fa-solid fa-mountain"></i>
                                        <h1>Max Elevation: 4380 M</h1>
                                    </div>
                                </li>
                                <li>
                                    <div class="info">
                                        <i class="fa-solid fa-cloud-bolt"></i>
                                        <h1>Best Seasons: Spring and Autumn </h1>
                                    </div>
                                </li>

                                <li>
                                    <div class="info">
                                        <i class="fa-solid fa-signal"></i>
                                        <h1>Trip Grade: Moderate</h1>
                                    </div>
                                </li>
                                <li>
                                    <div class="info"></div>
                                </li>
                                <li>
                                    <div class="info"></div>
                                </li>

                            </ul>

                        </div>
                    </div>

                    <div class="map">
                        <img src="../../Data/goaikunda-trek-map2.png" alt="">
                        <h1>Route</h1>
                    </div>
                </div>
            </div>

            <div class="policies">
                <h1 class="policyTitle">Terms and Conditions</h1>

                <div class="allpolicies">

                    <h2>Important information</h2>
                    <ul class="contentList">
                        <li>
                            <p>Please Note: Jeep Safari / Elephant Safari, canoeing, nature walks, bird
                                watching and other adventure activities offered by the resort are not
                                included in the package. They can be booked on direct payment basis with the
                                hotel.</p>
                        </li>
                        <li>
                            <p>INR 1000 and INR 500 denomination Indian notes are banned in Nepal. Indian
                                Rupees of the denomination of Rs. 500 & Rs. 1000 are not a valid tender
                                currency in Nepal. They are strictly banned (punishable under Nepal law if
                                any one possessing this is found). Hence, it is not advised to carry them.
                                You may carry INR 100 notes and debit/credit card.</p>
                        </li>
                        <li>
                            <p>Sightseeing Hours: Half day sightseeing will be of around 03 hour and full
                                day sightseeing will be of around 06 hours</p>
                        </li>
                        <li>
                            <p>Documents Required for Adults ? A valid Indian passport or an election Id is
                                the only valid document for adults (18 yrs & above) for travel to Kathmandu.
                            </p>
                        </li>
                        <li>
                            <p>Documents Required for Children ? For children below the age of 18 years the
                                school or college id suffices. The id should clearly reflect the traveler's
                                picture, school or college name, date of birth as well as the class in which
                                the student is studying. For Children below below 12 years, please carry
                                birth certificate and School id.</p>
                        </li>
                        <li>
                            <p>Check-in: 13:00 hrs. / Check-out time is 11:00 hrs</p>
                        </li>
                    </ul>

                </div>

                <div class="allpolicies">
                    <h2>Exclusions</h2>
                    <ul class="contentList">
                        <li>
                            <p>Vehicle included is as per the Itinerary and not at disposal </p>
                        </li>
                        <li>
                            <p>Entrance fees to the monuments and guide charges are not included </p>
                        </li>
                        <li>
                            <p>Airline seats and hotel rooms are subject to availability at the time of booking.
                            </p>
                        </li>
                        <li>
                            <p>Please Note: Jeep Safari / Elephant Safari, canoeing, nature walks, bird watching
                                and other adventure activities offered by the resort are not included in the
                                package. They can be booked on direct payment basis with the hotel.</p>
                        </li>
                    </ul>
                </div>

                <div class="allpolicies">
                    <h2>Terms and Conditions</h2>

                    <ul class="contentList">
                        <li>Standard check-in time at the hotel is normally 1:00 pm and check-out is 11:00 am.
                            An early check-in, or a late check-out is solely based on the discretion of the
                            hotel.</li>
                        <li>A maximum of 3 adults are allowed in one room. The third occupant shall be provided
                            a mattress/rollaway bed</li>
                        <li>The itinerary is fixed and cannot be modified. Transportation shall be provided as
                            per the itinerary and will not be at disposal.</li>
                        <li>AC will not be functional anywhere in cool or hilly areas.</li>
                        <li>For children below the age of 18 years, the school or college id will be enough for
                            travel to Nepal. The id should reflect the travellers photograph, school or college
                            name, date of birth as well as the class in which the student is studying. </li>
                        <li>Booking rates are subject to change without prior notice.</li>
                        <li>In case of unavailability in the listed hotels, arrangement for an alternate
                            accommodation will be made in a hotel of similar standard.</li>
                        <li>In case your package needs to be cancelled due to any natural calamity, weather
                            conditions etc. NEPTOURS shall strive to give you the maximum possible refund
                            subject to the agreement made with our trade partners/vendors.</li>
                        <li>The booking price does not include: Expenses of personal nature, such as laundry,
                            telephone calls, room service, alcoholic beverages, mini bar charges, tips, portage,
                            camera fees etc.</li>
                        <li>The package price doesn't include special dinner or mandatory charges at time levied
                            by the hotels especially during New Year and Christmas or any special occasions.
                        </li>
                        <li>As per section 206CCA of Income Tax Act 1961, w.e.f. 01-Jul-21 onwards, TCS will be
                            charged @10% on overseas tour packages in case you.</li>
                    </ul>
                </div>

            </div>


        </div>
    </section>





    <script>

        // for gallary image slider

        let slideIndex = 0;
        showSlide();

        function showSlide() {
            const slides = document.getElementsByClassName("slide");
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1;
            }
            slides[slideIndex - 1].style.display = "block";
            setTimeout(showSlide, 3000); // Change slide every 5 seconds
        }


        // for toogle between itineary and policies
        var overview_btn = document.querySelector('.sticky .topic-btn-overview');
        var policy_btn = document.querySelector('.sticky .topic-btn-policies');
        var overview = document.querySelector('.overview');
        var policies = document.querySelector('.policies');

        overview_btn.style.color = '#fc7c12';

        overview_btn.onclick = () => {
            overview.style.display = 'inline-block';
            policies.style.display = 'none';
            // for button color change
            overview_btn.style.color = '#fc7c12';
            policy_btn.style.color = '';
        }

        policy_btn.onclick = () => {
            overview.style.display = 'none';
            policies.style.display = 'block';
            // for button color change
            overview_btn.style.color = '';
            policy_btn.style.color = '#fc7c12';
        }

        // for checking user id login or not
        // Handle "Proceed To Book" button click
        var isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;

        document.getElementById('proceedToBookBtn').onclick = function () {
            if (isLoggedIn) {
                window.location.href = "booking.php";
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Please login first',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "../controller/login.php";
                    }
                });
            }
        };
    </script>

</body>

</html>