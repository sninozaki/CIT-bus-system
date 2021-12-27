<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="./tsudanumahatsu.css" />
  <title>新習志野バス時刻表検索システム</title>
</head>

<body>

  <form action="result_shinnarashino.php" method="post">

    <a href="tsudanumahatsu.php">
      <div class="notdeparture">津田沼発</div>
      <div class="departure"><a href="shinnarashinohatsu.php">新習志野発</div>
    </a>
    <br><br>


    <h2>
      <div class="syuppatu">出発時刻</div>
    </h2><br><br><br>

    <div class="date"><input type="date" name="selecteddate" 　style="width:40em;height:3em" required></div><br>


    <br>

    <div class="time"><input type="time" name="selectedtime" required></input></div></br>
    <br>
    <div class="submit"><input type="submit" value="検索" style="width:12%;padding:10px;font-size:25px;"></div><br><br>

</body>

</html>
