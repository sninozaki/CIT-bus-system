<!DOCTYPE html>
  <html lang="ja">

    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width,initial-scale=1">
<!--  <link rel="stylesheet" href="/result.css" />-->
      <link rel="stylesheet" href="result.css" />
      <title>検索結果_津田沼発</title>
    </head>

    <body>

      <?php

      $sd = $_POST['selecteddate'];  # 選択された日付け
      $st = $_POST['selectedtime'];  # 設定された時間

      require 'db.php';                                                # 接続
        $sql = 'SELECT * FROM calendar_table WHERE 日付 = :sd ';       # SQL文
        $prepare = $db->prepare($sql);                                 # 準備
        $prepare->bindValue(':sd', $sd, PDO::PARAM_STR);               # 埋め込み
        $prepare->execute();                                           # 実行
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);                # 結果の取得
       
      foreach ($result as $row) {
              $sw = h($row['運行ダイヤ']);

              if($sw == "平日" AND ($st < '08:49:00' OR $st > '20:10:00')){
                header("Location:error.html");
              }elseif($sw == "土曜日" AND ($st < '10:39:00' OR $st > '20:10:00')){
                header("Location:error.html");             
              }elseif($sw == "日曜・祝日・休日" AND ($st < '08:29:00' OR $st > '18:00:00')){
                header("Location:error.html");              
              }else{
                echo "<p>", $sd, '（', $sw, 'ダイヤ）', $st, '　津田沼発', "</p>";
              }              
      }

      ?>
   
      <table>

        <?php

        require 'db.php';                                # 接続
        $sql = 'SELECT * FROM 時刻表 
               WHERE 出発時間 >= :st AND 
                     運行ダイヤ = :sw AND 
                     出発場所 = "津田沼" LIMIT 4';       # SQL文
        $prepare = $db->prepare($sql);                   # 準備
        $prepare->bindValue(':st', $st, PDO::PARAM_STR); # 埋め込み
        $prepare->bindValue(':sw', $sw, PDO::PARAM_STR); # 埋め込み
        $prepare->execute();                             # 実行
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);  # 結果の取得
       
            foreach ($result as $row) {
              $timeA = h($row['出発時間']);
              $timeB = h($row['到着時間']);
              $intA  = h($row['混雑予測']);
              $image = '';
              if($intA != ''){
               $image = "<img src='kao{$intA}.png' alt='混雑度{$intA}'>";
              }

              if($intA != ''){
                echo 
               '<tr class="busy">' .
                "<td class='timeA'>{$timeA}</td>".
                "<td>→</td>".
                "<td>({$timeB} 到着予定)</td>".
                "<td>混雑予測</td>".
                "<td class='intA'>{$image}".
               '</tr>';
              }else{
                echo 
               '<tr>' .
                "<td class='timeA'>{$timeA}</td>".
                "<td>→</td>".
                "<td>({$timeB} 到着予定)</td>".
                "<td></td>".
                "<td class='intA'></td>".
               '</tr>';  
              }
            }
        

         ?>

      </table>
      <p class="A"><a href="tsudanumahatsu.php" >津田沼発　時刻入力へ</a></p>
      <p class="A"><a href="shinnarashinohatsu.php" >新習志野発　時刻入力へ</a></p>
<!--
      <p class="A"><a href="https://ogasawara-a.pm-chiba.tech/tsudanumahatsu.php" >津田沼発　時刻入力へ</a></p>
      <p class="A"><a href="https://ogasawara-a.pm-chiba.tech/shinnarashinohatsu.php" >新習志野発　時刻入力へ</a></p>
-->
    </body>
    
  </html>
