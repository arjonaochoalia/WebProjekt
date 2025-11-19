<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body style="background-color:#FFF2EF">
    <?php include 'nav.php' ?>


    <!--Beauty Lab-->
    <section>
        <div class="container text-center py-5">
            <h1 class="fw-bold mb-3">Beauty Lab</h1>
            <img src="Bilder/home_section_one.jpg"
                alt="Putting eyeshadow on"
                class="img-fluid mb-4 rounded shadow"
                width=70%>
            <p class="lead mx-auto" style="max-width: 700px;">
                The place where you become a beauty specialist <br>
                Join Beauty Lab to explore hands-on workshops in beauty and wellness, from hairstyling and massage to manicure and skincare.<br>
                Learn, practice and grow your expertise in a creative community designed to help you shine.<br>
            </p>
        </div>
    </section>
    <!--What We Offer-->
    <section class="container my-3">
        <div class="row align-items-center">
            <div class="col-md-6 d-none d-md-block">
                <img src="Bilder/home_section_two.jpg" class="img-fluid rounded shadow" alt="Beauty Workshop" width=93%>
            </div>
            <div class=" col-12 col-md-6">
                <h2 class="fw-bold mb-3">What We Offer</h2>
                <img src="Bilder/home_section_two.jpg" class="img-fluid rounded shadow d-block d-md-none mb-3" alt="Beauty Workshop">
                <p class="lead mx-auto" style="max-width: 700px;">
                    At Beauty Lab, we believe that learning should be practical, creative and fun. Our events and workshops are designed for anyone who wants to deepen their knowledge and skills in the world of beauty and wellness. Participants can explore a variety of topics such as hairstyling, skincare, massage, manicure and pedicure.
                    <br><br>
                    Each session is guided by experienced professionals who provide hands-on training and personal feedback, ensuring that every participant gains real experience and confidence. Whether you are just starting out or looking to improve your existing skills, our workshops offer the perfect opportunity to grow.
                    <br><br>
                    Meet like-minded people, share your passion and be part of a supportive community that celebrates creativity, self-care and professional development. Join Beauty Lab and take the next step toward becoming a true beauty expert.
                </p>
                <a href="events.php" class="btn btn-primary mt-3">Explore Events</a>
            </div>
        </div>
    </section>
    <!--Reviews-->
    <section class="container my-5">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 style=" margin-top: 5rem;">
                <h2 class="fw-bold mb-3">Your BeautyLab Story's</h2>
                <img src="Bilder/home_section_three.jpg" class="img-fluid rounded shadow d-block d-md-none mb-3" alt="Community Picture">
                <p class="lead mx-auto" style="max-width: 700px;">
                    At Beauty Lab, our feedback page is a space where our participants share their honest experiences, impressions and moments from the events they attended. It is a welcoming place for anyone who wants to discover how others have enjoyed our beauty and wellness workshops.
                    <br><br>
                    On this page, you can explore personal reviews, see what our users loved most and gain real insights into the atmosphere and quality of our events. Their stories and ratings help you get a clearer picture and may inspire you to try something new yourself.
                    <br><br>
                    Take a moment to read through the feedback and let our community’s experiences guide and motivate you. Join us, get inspired, and see for yourself why Beauty Lab is a place where people learn, grow and feel empowered.
                </p>
                <a href="community.php" class="btn btn-primary mt-3">View Feedback</a>
            </div>
            <div class="col-md-6 d-none d-md-block">
                <img src="Bilder/home_section_three.jpg" class="img-fluid rounded shadow" alt="Community Picture" width=93%>
            </div>
        </div>
    </section>

</body>

</html>