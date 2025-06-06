<?php include 'components/NavBar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Contact Us - Michael's Car Store</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css" />

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/style.css">

  <style>
    body {
      margin: 0;
      padding: 40px 20px;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #204b6e 0%, #2e7db1 100%);
      color: #fff;
      min-height: 100vh;
      text-align: center;
    }

    .container {
      max-width: 700px;
      margin: 0 auto;
      background-color: rgba(255, 255, 255, 0.08);
      padding: 40px 30px;
      border-radius: 30px;
      box-shadow: 0 6px 25px rgba(0, 0, 0, 0.6);
    }

    h2 {
      font-weight: 700;
      font-size: 2.8rem;
      margin-bottom: 10px;
      color: #fff;
    }

    p.intro {
      font-weight: 400;
      font-size: 1.2rem;
      margin-bottom: 30px;
      color: #e0e7ffcc;
    }

    form label {
      font-weight: 600;
      display: block;
      margin-top: 15px;
      margin-bottom: 6px;
      text-align: left;
      color: #d0d9f9;
      font-size: 1rem;
    }

    form input,
    form textarea {
      width: 100%;
      padding: 12px 15px;
      border-radius: 12px;
      border: none;
      font-size: 1rem;
      outline: none;
      resize: vertical;
    }

    form input:focus,
    form textarea:focus {
      box-shadow: 0 0 8px #2e7db1;
    }

    form textarea {
      min-height: 120px;
    }

    button[type="submit"] {
      margin-top: 25px;
      background-color: #3ecf8e;
      border: none;
      color: #0b2f1a;
      font-weight: 700;
      font-size: 1.1rem;
      padding: 14px 0;
      width: 100%;
      border-radius: 25px;
      cursor: pointer;
      box-shadow: 0 0 18px #3ecf8e;
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    button[type="submit"]:hover {
      background-color: #35b977;
      box-shadow: 0 0 22px #2c9463;
    }

    @media (max-width: 720px) {
      body {
        padding: 30px 10px;
      }

      .container {
        padding: 30px 20px;
      }

      h2 {
        font-size: 2.2rem;
      }

      p.intro {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>

  <div class="container text-light mt-5">
    <h2>Contact Us</h2>
    <p class="intro">Have questions or want to book a car? Reach out to us and we'll get back to you promptly.</p>

    <form action="contact_process.php" method="post" novalidate>
      <label for="name">Full Name</label>
      <input type="text" id="name" name="name" required placeholder="Your full name" />

      <label for="email">Email Address</label>
      <input type="email" id="email" name="email" required placeholder="you@example.com" />

      <label for="phone">Phone Number</label>
      <input type="tel" id="phone" name="phone" placeholder="+123 456 7890" />

      <label for="message">Message</label>
      <textarea id="message" name="message" required placeholder="Write your message here..."></textarea>

      <button type="submit">Send Message</button>
    </form>
  </div>

  <?php include 'footer.php'; ?>
  <!-- Bootstrap JS -->
  <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
