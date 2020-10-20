<?php


session_start();
function infoArticles(){
    $servername = "localhost";
    $user = "test";
    $pass = "";
    try{ // articles
        $connection = new PDO ("mysql:host=$servername;dbname=mydb", $user,$pass);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql_cmd = "SELECT * FROM Articles";
        $articles = $connection->query($sql_cmd);
        $counter = 0;
        foreach ($articles as $article){
            $counter++;
            $id = "#id$counter";
            ?>
            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="portfolio-item">
                    <a class="portfolio-link" data-toggle="modal" href=<?php echo $id ?>>
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <img class="img-fluid" src=<?php echo $article['thumbnail_link'] ?> alt="" />
                    </a>
                    <div class="portfolio-caption">
                        <div class="portfolio-caption-heading"><?php echo $article['description'] ?></div>
                    </div>
                </div>
            </div>

        <?}
    }
    catch (PDOException $err){
        echo $err->getMessage();
    }
    $connection = null;
}

function full_ArticleDesc(){
    $servername = "localhost";
    $user = "test";
    $pass = "";
    try{ // articles
        $connection = new PDO ("mysql:host=$servername;dbname=mydb", $user,$pass);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql_cmd = "SELECT * FROM Articles";
        $articles = $connection->query($sql_cmd);
        $counter = 0;
        foreach ($articles as $article){
            $counter++;
            $id = "id$counter";
    ?>
    <div class="portfolio-modal modal fade" id=<?php echo $id ?> tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="modal-body">
                                <!-- Project Details Go Here-->
                                <h2 class="text-uppercase"><?php echo $article['description'] ?></h2>
                                <img class="img-fluid d-block mx-auto" src=<?php echo $article['full_pic_link'] ?> alt="" />
                                <p><?php echo $article['full_text'] ?></p>
                                <button class="btn btn-primary" data-dismiss="modal" type="button">
                                    <i class="fas fa-times mr-1"></i>
                                    Close This
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?}
    }
    catch (PDOException $err){
        echo $err->getMessage();
    }
    $connection = null;
}

function contactMe_db(){
    include "assets/mail/contact_me.php";
    $servername = "localhost";
    $user = "test";
    $pass = "";
    try { // articles
        $connection = new PDO ("mysql:host=$servername;dbname=mydb", $user, $pass);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $data = db_data();
        $sql_cmd = "INSERT INTO contactme (fname, email, phone, message) VALUES ($data);";
        $connection->exec($sql_cmd);
    }
    catch (PDOException $err){}
    $connection = null;
}

require "views/index.view.php";
