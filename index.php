<?php

  $msg = '';

  if (filter_has_var(INPUT_POST, 'submit')) {

    $name = check_data($_POST['name'], 'Please include your name');
    $email = check_data($_POST['email'], 'Please use a valid email');
    $message = check_data($_POST['message'], 'Please include a message');

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

      // $msg = 'Please complete all fields';

    }
  }

  // Cleans data
  function check_data($data, $error) {

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    if (strlen($data) === 0 && $error) {
      $msg = $error;
    }

    return $data;

  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'>
    <title>Christopher Dennis</title>
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
        <i class="devicon-mysql-plain-wordmark"></i>
        <i class="devicon-php-plain"></i>
      </div>

      <div class='projects'>
        <div class='project'>
          <a href='#' target='_blank'>
            <img src='assets/img/songify.jpg' alt='music-service'>
          </a>
          <div class='project-name'>
            <h2>Music Streaming Service</h2>
          </div>
          <ul class='description'>
            <li>Built with PHP and jQuery</li>
            <li>Uses AJAX to query MySQL database</li>
            <li>Layout created with Flexbox and styled with SASS</li>
          </ul>
        </div>

        <div class='project'>
          <a href='#' target='_blank'>
            <img src='assets/img/twitch-streamers.jpg' alt='twitch-app'>
          </a>
          <h2>Twitch Streamer Status</h2>
          <ul class='description'>
            <li>React SPA styled with SASS</li>
            <li>Uses API call to fetch current streamer info</li>
            <li>Layout created with Flexbox</li>
          </ul>
        </div>

        <div class='project'>
          <a href='#' target='_blank'>
            <img src='assets/img/weather-app.jpg' alt='weather-app'>
          </a>
          <h2>React Weather Station</h2>
          <ul class='description'>
            <li>React weather service with 5 day forcast</li>
            <li>API call fetches current weather information</li>
            <li>Styled with SASS</li>
          </ul>
        </div>

        <div class='project'>
          <a href='#' target='_blank'>
            <img src='assets/img/quote-app.jpg' alt='quote-app'>
          </a>
          <h2>Random Quote Generator</h2>
          <ul class='description'>
            <li>React SPA styled with CSS</li>
            <li>API call used to fetch random quote</li>
            <li>Quote sent to Twitter with a click</li>
          </ul>
        </div>

        <div class='project'>
          <a href='#' target='_blank'>
            <img src='assets/img/tic-tac-toe.jpg' alt='tic-tac-toe'>
          </a>
          <h2>Tic-Tac-Toe</h2>
          <ul class='description'>
            <li>The classic game built with jQuery</li>
            <li>Layout created with Flexbox</li>
          </ul>
        </div>

        <div class='project'>
          <a href='#' target='_blank'>
            <img src='assets/img/calc.jpg' alt='calculator'>
          </a>
          <h2>JavaScript Calculator</h2>
          <ul class='description'>
            <li>Functional calculator built with jQuery</li>
            <li>Layout created with Flexbox</li>
          </ul>
        </div>
      </div>
    </div>

    <div id='about'>
      <div class='statement'>
        <p>I'm a native Austinite who enjoys learning new things and spending time outdoors. I first started learning C in 2013 as a hobby and eventually made my way to front end development with the goal of becoming a full stack developer.</p>
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
