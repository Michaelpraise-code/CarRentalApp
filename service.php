<?php include 'components/NavBar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Our Services - Michael's Car Store</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css" />

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/style.css">

  <style>

    h2 {
      font-weight: 700;
      font-size: 3rem;
      margin-bottom: 15px;
      color: #8ab6d6;
      letter-spacing: 2px;
      text-align: center;
    }

    p.intro {
      font-weight: 400;
      font-size: 1.25rem;
      margin-bottom: 45px;
      color: #c9d6e3;
      line-height: 1.7;
      text-align: center;
      letter-spacing: 0.05em;
    }

    .service-item {
      margin-bottom: 40px;
      padding: 30px 25px;
      background-color:  linear-gradient(135deg, #204b6e 0%, #2e7db1 100%);
      border-radius: 20px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.5);
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .service-item:hover {
      background-color: rgba(72, 104, 142, 0.85);
      transform: translateY(-6px);
    }

    .service-title {
      font-weight: 700;
      font-size: 2rem;
      color: #a8d0e6;
      margin-bottom: 15px;
      letter-spacing: 1px;
    }

    .service-desc {
      font-weight: 400;
      font-size: 1.1rem;
      color: #dce6f1;
      line-height: 1.8;
    }

    @media (max-width: 720px) {
      body {
        padding: 40px 15px;
      }

      .container {
        padding: 30px 20px;
      }

      h2 {
        font-size: 2.4rem;
      }

      p.intro {
        font-size: 1.1rem;
        margin-bottom: 30px;
      }

      .service-title {
        font-size: 1.6rem;
      }

      .service-item {
        padding: 20px 15px;
        margin-bottom: 30px;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>Our Comprehensive Services</h2>
    <p class="intro">
      At Michael's Car Store, we pride ourselves on delivering unmatched automotive services tailored to your individual needs.  
      Our commitment to excellence ensures your satisfaction at every step of your journey with us.
    </p>

    <div class="service-item">
      <h3 class="service-title">Premium Car Rental</h3>
      <p class="service-desc">
        Explore our extensive fleet of well-maintained vehicles, ranging from economy models to luxury cars.  
        Enjoy a hassle-free rental experience with flexible terms and transparent pricing.  
        Whether it's for business, leisure, or special occasions, we provide tailored rental plans to suit your lifestyle.
      </p>
    </div>

    <div class="service-item">
      <h3 class="service-title">Expert Vehicle Maintenance & Repairs</h3>
      <p class="service-desc">
        Our certified technicians use state-of-the-art diagnostic tools to provide comprehensive maintenance services, including oil changes, brake inspections, engine tuning, and more.  
        We guarantee high-quality repairs using genuine parts to keep your vehicle running smoothly and safely.
      </p>
    </div>

    <div class="service-item">
      <h3 class="service-title">Personalized Test Drive Experiences</h3>
      <p class="service-desc">
        Thinking about buying? Schedule a personalized test drive to get firsthand experience of our latest car models.  
        Our knowledgeable staff will guide you through the features and answer all your questions to help you make an informed decision.
      </p>
    </div>

    <div class="service-item">
      <h3 class="service-title">Dedicated Customer Support</h3>
      <p class="service-desc">
        Our customer service team is available to assist you with inquiries, reservations, and after-sales support.  
        We believe in building lasting relationships with our clients by providing timely, courteous, and effective assistance whenever you need it.
      </p>
    </div>

    <div class="service-item">
      <h3 class="service-title">Customized Corporate Services</h3>
      <p class="service-desc">
        We offer tailored fleet rental and maintenance packages for businesses looking for reliable and cost-effective automotive solutions.  
        From short-term rentals to long-term contracts, our corporate services are designed to maximize your company’s mobility and efficiency.
      </p>
    </div>

    <div class="service-item">
      <h3 class="service-title">Roadside Assistance & Emergency Support</h3>
      <p class="service-desc">
        Safety is our priority. Our 24/7 roadside assistance team is always ready to help you with unexpected breakdowns, flat tires, or lockouts.  
        Rest easy knowing expert help is just a call away, no matter where your journey takes you.
      </p>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
