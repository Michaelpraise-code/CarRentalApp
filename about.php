<?php include 'components/NavBar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>About Us | Car Rental</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      background: linear-gradient(135deg, #204b6e 0%, #2e7db1 100%);
      color: #fff;
      line-height: 1.6;
      padding-top: 70px;
      text-align: center;
    }
    .container {
      max-width: 900px;
      margin: 40px auto 80px;
      padding: 0 20px;
      text-align: left;
    }
    h1 {
      font-size: 3rem;
      font-weight: 700;
      margin-bottom: 30px;
      color: #aad4ff;
      border-bottom: 3px solid #3ecf8e;
      padding-bottom: 10px;
      letter-spacing: 1.2px;
      text-align: center;
    }
    h2 {
      font-size: 2.2rem;
      font-weight: 700;
      margin-bottom: 20px;
      color: #aad4ff;
      letter-spacing: 1.1px;
    }
    p {
      font-size: 1.1rem;
      margin-bottom: 25px;
      color: #e6ebf1cc;
      font-weight: 500;
    }
    ul {
      font-size: 1.1rem;
      margin-left: 30px;
      margin-bottom: 30px;
      list-style-type: disc;
      color: #e6ebf1cc;
    }
    ul li {
      margin-bottom: 10px;
    }
    .btn-primary {
      background-color: #3ecf8e;
      border: none;
      padding: 14px 40px;
      font-size: 1.1rem;
      font-weight: 700;
      border-radius: 30px;
      transition: background-color 0.3s ease;
      box-shadow: 0 0 14px #3ecf8e;
      color: #0b2f1a;
      display: inline-block;
      text-align: center;
      text-decoration: none;
    }
    .btn-primary:hover {
      background-color: #2ca86c;
      box-shadow: 0 0 20px #2ca86c;
      color: #fff;
      text-decoration: none;
    }
    @media (max-width: 768px) {
      h1 {
        font-size: 2.2rem;
      }
      h2 {
        font-size: 1.6rem;
      }
      p, ul {
        font-size: 1rem;
      }
      .btn-primary {
        padding: 12px 30px;
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>
    
  <div class="container">
    <h1>About Our Car Rental Service</h1>

    <h2>Our Mission</h2>
    <p>
      At [Your Company Name], our mission is to provide affordable, reliable, and convenient car rental services to help you move freely and safely wherever your journey takes you.
      We are dedicated to offering a seamless rental experience that combines top-notch customer service with a diverse fleet of vehicles to suit every need.
    </p>

    <h2>Who We Are</h2>
    <p>
      Founded in 2020, we are a passionate team committed to transforming the car rental experience.
      With years of industry experience and a customer-centric approach, we ensure that every client receives personalized service tailored to their unique travel plans.
    </p>
    <p>
      Our team works tirelessly behind the scenes to maintain the highest standards of vehicle safety and cleanliness, so you can drive with confidence.
      Whether you’re renting for business, leisure, or a special event, we’ve got you covered.
    </p>

    <h2>Our Values</h2>
    <ul>
      <li><strong>Customer Focus:</strong> We prioritize your satisfaction with friendly support and flexible services.</li>
      <li><strong>Integrity:</strong> Transparent pricing with no hidden fees or surprises.</li>
      <li><strong>Quality:</strong> Well-maintained vehicles and strict safety standards.</li>
      <li><strong>Innovation:</strong> Leveraging technology to streamline booking and customer communication.</li>
      <li><strong>Environmental Responsibility:</strong> Committed to sustainability by offering eco-friendly vehicle options and promoting green driving practices.</li>
    </ul>

    <h2>Our Fleet</h2>
    <p>
      Our extensive fleet includes economy cars perfect for city driving, spacious SUVs for family trips, luxury vehicles for special occasions, and electric cars for the environmentally conscious.
      Each vehicle is inspected regularly to ensure peak performance and comfort.
    </p>
    <p>
      Whether you need a fuel-efficient compact car or a spacious ride for your next adventure, you can count on us to deliver quality and value.
    </p>

    <h2>Why Choose Us?</h2>
    <p>
      We understand that renting a car can be stressful, which is why we focus on making the process smooth and hassle-free.
      Our competitive pricing, flexible rental periods, and 24/7 customer support set us apart in the industry.
    </p>
    <p>
      Plus, with easy online booking and multiple pickup locations, renting with us is more convenient than ever.
      Our dedicated team is always available to answer questions, provide recommendations, and assist with special requests.
    </p>

    <h2>Customer Testimonials</h2>
    <p>
      "I had a fantastic experience renting from [Your Company Name]. The staff was helpful, and the car was clean and reliable." — <em>Sarah J.</em>
    </p>
    <p>
      "Great prices and excellent service! The booking process was simple, and pickup was quick and easy." — <em>Mark T.</em>
    </p>
    <p>
      "Highly recommend for anyone needing a rental car. They made my business trip stress-free." — <em>Linda K.</em>
    </p>

    <h2>Our Commitment to Safety</h2>
    <p>
      Your safety is our priority. All our vehicles undergo rigorous maintenance and cleaning procedures.
      We follow all recommended health guidelines to provide a safe and comfortable environment for our customers.
    </p>
    <p>
      Our team continually monitors industry best practices to ensure we deliver a service that meets your expectations and peace of mind.
    </p>

    <h2>Contact Us</h2>
    <p>
      Have questions or need assistance? Our friendly customer support team is here to help.
      Reach out to us via phone, email, or visit our office during business hours.
    </p>
    <p>
      We look forward to helping you with your next rental experience!
    </p>

    <a href="cars.php" class="btn-primary">Explore Our Vehicles</a>
  </div>
 <?php include 'footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
