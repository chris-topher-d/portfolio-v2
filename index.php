<?php

  $msg = '';

  if (filter_has_var(INPUT_POST, 'submit')) {

    $name = check_data($_POST['name']);
    $email = check_data($_POST['email']);
    $message = check_data($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($message)) {

      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        // PASSED - Valid email used - Recipient Email
        $toEmail = 'cdennis.aus@gmail.com';
        $subject = "Contact request from $name";
        $body = "<h2>Contact Request</h2>
                <h4>Name</h4><p>$name</p>
                <h4>Email</h4><p>$email</p>
                <h4>Message</h4><p>$message</p>";

        // Email Headers
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";

        // Additional Headers
        $headers .= "From: " .$name. "<".$email.">"."\r\n";

        if (mail($toEmail, $subject, $body, $headers)) {

          // PASSED - Email Sent
          $msg = 'Thank you. Your message has been sent';

        } else {

          // FAILED - Email was not sent
          $msg = 'Your message was not sent';

        }

      } else {

        $msg = 'Please use a valid email address';

      }

    } else {

      $msg = 'Please complete all fields';

    }
  }

  // Cleans data
  function check_data($data) {

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;

  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'>
    <title>Christopher Dennis</title>
    <link rel='shortcut icon' href='./favicon_c.png'>
    <link rel='stylesheet' href='assets/css/main.css'>
    <link rel="stylesheet" href="https://cdn.rawgit.com/konpa/devicon/df6431e323547add1b4cf45992913f15286456d3/devicon.min.css">
  </head>

  <body>
    <div id='home'>
      <header class='header'>
        <nav>
          <ul>
            <li><a href='#portfolio'>PORTFOLIO</a></li>
            <li><a href='#about'>ABOUT</a></li>
            <li><a href='#contact'>CONTACT</a></li>
          </ul>
        </nav>
      </header>
      <div class='name'>
        <h1>Christopher Dennis</h1>
        <h2>front-end developer</h2>
      </div>
    </div>

    <div id='portfolio'>
      <div class='tech'>
        <i class="devicon-html5-plain-wordmark"></i>
        <i class="devicon-css3-plain-wordmark"></i>
        <i class="devicon-javascript-plain"></i>
        <i class="devicon-sass-original"></i>
        <i class="devicon-jquery-plain-wordmark"></i>
        <i class="devicon-react-original-wordmark"></i>
      </div>

      <div class='projects'>
        <div class='project'>
          <a href='https://christopherdennis.me/twitch-app/' target='_blank'>
            <img src='assets/img/twitch-streamers.jpg' alt='twitch-app'>
          </a>
          <h2>Twitch Streamer Status</h2>
          <ul class='description'>
            <li>HTML | SASS | React | API</li>
          </ul>
        </div>

        <div class='project'>
          <a href='https://christopherdennis.me/weather-app/' target='_blank'>
            <img src='assets/img/weather-app.jpg' alt='weather-app'>
          </a>
          <h2>React Weather Station</h2>
          <ul class='description'>
            <li>HTML | SASS | React | API</li>
          </ul>
        </div>

        <div class='project'>
          <a href='https://christopherdennis.me/react-quote/' target='_blank'>
            <img src='assets/img/quote-app.jpg' alt='quote-app'>
          </a>
          <h2>Random Quote Generator</h2>
          <ul class='description'>
            <li>HTML | CSS | React | API</li>
          </ul>
        </div>

        <div class='project'>
          <a href='https://christopherdennis.me/tic-tac-toe/' target='_blank'>
            <img src='assets/img/tic-tac-toe.jpg' alt='tic-tac-toe'>
          </a>
          <h2>Tic-Tac-Toe</h2>
          <ul class='description'>
            <li>HTML | CSS | jQuery</li>
          </ul>
        </div>

        <div class='project'>
          <a href='https://christopherdennis.me/js-calc/' target='_blank'>
            <img src='assets/img/calc.jpg' alt='calculator'>
          </a>
          <h2>JavaScript Calculator</h2>
          <ul class='description'>
            <li>HTML | CSS | jQuery</li>
          </ul>
        </div>
      </div>
    </div>

    <div id='about'>
      <h2>About</h2>
      <div class='statement'>
        <p>I'm a front-end developer who enjoys building and solving problems with code. Whether creating
          a simple HTML document, or an interactive React application, my goal is to
          learn something new with every project. I code every day, but when I'm not in front of a monitor, I
          can be found hiking Austin area greenbelts, riding my motorcycle through the hill country, or digging
          into a book at my favorite coffee shop.</p>
      </div>
    </div>

    <div id='contact'>
      <h2>Contact</h2>
      <form class='form' action='#contact' method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label>Name:</label>
        <input type='text' name='name' id='name' value="<?php echo isset($_POST["name"]) ? $name : ''; ?>">
        <label>Email:</label>
        <input type='text' name='email' id='email' value="<?php echo isset($_POST["email"]) ? $email : ''; ?>">
        <label>Message:</label>
        <textarea name='message' id='message'><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
        <button type='submit' name='submit' id='send'>SEND</button>
      </form>
      <?php if ($msg !== ''): ?>
        <div class='alert'><?php echo $msg; ?></div>
      <?php endif; ?>
    </div>

    <div class='footer'>
      <p>&copy;<?php echo date('Y'); ?> <span style='color: #085e8c'>Christopher Dennis</p>
    </div>

  </body>
</html>
