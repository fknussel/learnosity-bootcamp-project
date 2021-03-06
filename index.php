<?php
  require_once __DIR__ . '/vendor/learnosity/learnosity-sdk-php/src/LearnositySdk/autoload.php';

  use LearnositySdk\Request\Init;
  use LearnositySdk\Utils\Uuid;

  $consumer_secret = '74c5fd430cf1242a527f6223aebd42d30464be22';

  // Initialise Items API in inline mode.
  // Inline mode retrieves content from your Learnosity Item Bank and
  // instantiates Questions API for rendering, interaction and state management.
  $request = [
    'activity_id' => 'bootcamp-fknussel',
    'name' => 'Mario Bros Bootcamp Project',
    'rendering_type' => 'inline',
    'state' => 'initial',
    'type' => 'submit_practice',
    'session_id' => Uuid::generate(),
    'user_id' => 'demo_student',
    'assess_inline' => true,
    'items' => [
      'bootcamp-fknussel-item1',
      'bootcamp-fknussel-item2',
      'bootcamp-fknussel-item3',
      'bootcamp-fknussel-item4',
      'bootcamp-fknussel-item5',
      'bootcamp-fknussel-item6',
      'bootcamp-fknussel-item7',
      'bootcamp-fknussel-item8',
      'bootcamp-fknussel-item9',
    ]
  ];

  $security = [
    'consumer_key' => 'yis0TYCu7U9V4o7M',
    'domain' => $_SERVER['SERVER_NAME']
  ];

  // Instantiate the SDK Init class with your security and request data.
  $init = new Init('items', $security, $consumer_secret, $request);

  // Call the generate() method to retrieve a JavaScript object.
  $signedRequest = $init->generate();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Bootcamp Project</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <div class="world">
    <!-- Game score on the upper left corner -->
    <div class="score-panel">
      <div class="score-panel__coins">
        <img src="assets/coin.png" class="score-panel__coins-icon" alt="" />
        <span class="score-panel__coins-label" id="score">0000</span>
      </div>

      <ul class="score-panel__lives" id="lives">
        <li>
          <img src="assets/mushroom.png" alt="" />
        </li>
        <li>
          <img src="assets/mushroom.png" alt="" />
        </li>
        <li>
          <img src="assets/mushroom.png" alt="" />
        </li>
      </ul>
    </div>

    <!-- Princess Peach flying on the upper right corner -->
    <img src="assets/princess.png" class="princess" alt="" />

    <!-- Speech bubble shown on game over -->
    <img src="assets/speech-bubble.png" class="speech-bubble" alt="" />

    <!-- Warning box that displays when time's running out -->
    <img src="assets/exclamation.png" class="warning" alt="Hurry up!" />

    <!-- "You win!" message -->
    <div class="you-win">
      <div class="you-win__content">
        <img src="assets/dancing.gif" class="you-win__image" alt="" />
        <div class="you-win__text">Yay! Good job!</div>
        <ul class="you-win__report">
          <li class="you-win__report-item">
            <img src="assets/coin.png" class="you-win__coin" alt="" />
            <span id="report-points">0000</span>
          </li>
          <li class="you-win__report-item">
            Questions Attempted: <span id="report-questions-attempted"></span>
          </li>
          <li class="you-win__report-item">
            Wrong Answers: <span id="report-wrong-answers"></span>
          </li>
        </ul>
      </div>
    </div>

    <!-- Animated rising lava -->
    <div class="lava"></div>

    <!-- Tiles Mario steps on -->
    <ul class="platforms"></ul>

    <!-- Background audio player and control -->
    <audio src="assets/soundtrack.mp3" id="audio-player"></audio>
    <a href="#" class="audio-control">
      <img src="assets/audio-off.svg" class="audio-control__icon" />
    </a>

    <!-- Splash screen with start button -->
    <div class="splash visible">
      <img src="assets/logo.png" class="splash__image" alt="" />
      <div class="splash__copyright">©2018 Learnosity</div>
      <button class="splash__start-button" id="start-button">Start</button>
    </div>

    <!-- Modal on which we render the questions -->
    <div class="question">
      <div class="question__content">
        <img src="assets/question.png" class="question__icon" alt="" />
        <img src="assets/error.png" id="wrong-answer" class="question__wrong-answer" alt="" />
        <button class="question__next-button" id="check-answer">Check Answer</button>

        <!-- Learnosity questions hooks -->
        <span class="learnosity-item visible" data-reference="bootcamp-fknussel-item1"></span>
        <span class="learnosity-item" data-reference="bootcamp-fknussel-item2"></span>
        <span class="learnosity-item" data-reference="bootcamp-fknussel-item3"></span>
        <span class="learnosity-item" data-reference="bootcamp-fknussel-item4"></span>
        <span class="learnosity-item" data-reference="bootcamp-fknussel-item5"></span>
        <span class="learnosity-item" data-reference="bootcamp-fknussel-item6"></span>
        <span class="learnosity-item" data-reference="bootcamp-fknussel-item7"></span>
        <span class="learnosity-item" data-reference="bootcamp-fknussel-item8"></span>
        <span class="learnosity-item" data-reference="bootcamp-fknussel-item9"></span>
      </div>
    </div>

    <div class="game-over">
      Game over
    </div>
  </div>

  <script src="https://items.staging.learnosity.com/?v1"></script>
  <script src="bundle.js"></script>
  <script>
    const itemsApp = LearnosityItems.init(<?php echo $signedRequest; ?>, {
      readyListener() {
        console.log(`Game's ready`);
      },
      errorListener(err) {
        console.log('Something bad happened', err);
      }
    });
  </script>
</body>

</html>
