<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DB Select</title>
</head>
<body>
    <h1>Book 전체 조회</h1>
    <?php
        //print_r($books);
        foreach($books as $book){
            echo $book->num;
            echo "/";
            echo $book->title;
            echo "/";
            echo $book->body;
            echo "/";
            echo $book->totalpage;
            echo "/";
            echo $book->author;
            echo "<br>";
        }
    ?>

    <h1>Book 특정값 조회</h1>
    <?php
        foreach($where_books as $book){
            echo $book->num;
            echo "/";
            echo $book->title;
            echo "/";
            echo $book->body;
            echo "/";
            echo $book->totalpage;
            echo "/";
            echo $book->author;
            echo "<br>";
        }
    ?>
</body>
</html>