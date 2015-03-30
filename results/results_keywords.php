<?php
mysql_connect("impa.valdosta.edu", "archives_web", "uhCs4fQpr") or die("Error connecting to database: ".mysql_error());
mysql_select_db("extra_credit") or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Search results</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="../css/tables.css">
        <script src="../js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
        <?php
        $query = $_GET['query'];
        $min_length = 2;
        
        if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
        $query = htmlspecialchars($query);
        // changes characters used in html to their equivalents, for example: < to &gt;
        $query = mysql_real_escape_string($query);
        // makes sure nobody uses SQL injection
        
        $raw_results = mysql_query("SELECT * FROM gendex
        WHERE (`notes` LIKE '%".$query."%') OR (`first_name` LIKE '%".$query."%') OR ('notes' LIKE '%".$query."%') OR ('article_date' LIKE '%".$query."%') ORDER BY last_name, first_name ASC") or die(mysql_error());
        if(mysql_num_rows($raw_results) > 0){ // if one or more rows are returned do following ?>
        
        <div class="genhead">
            <a href="href="http://www.valdosta.edu/archives""><img src="../img/vsuasc-logo_f.png" alt="Archive Logo" class="logo"/></a>
            <h1>Gendex Keyword Search Results <small><?php echo "for <strong>$query</strong>"; ?> </small></h1>
            <p><a href="#">Back to Search Page</a></p>
        </div>
        <div>
            <table class="table table-striped table-hover table-bordered">
                <tr class="gentabhead">
                    <th>ID</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Date</th>
                    <th>Event</th>
                    <th>Notes</th>
                    <th>Publication</th>
                    <th>Page Number</th>
                </tr>
                
                <?php $i=1;//new line
                while($results = mysql_fetch_assoc($raw_results)){
                ?>
                
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $results['first_name']; ?></td>
                    <td><?php echo $results['last_name']; ?></td>
                    <td><?php echo $results['article_date']; ?></td>
                    <td><?php echo $results['event']; ?></td>
                    <td><?php echo $results['notes']; ?></td>
                    <td><?php echo $results['publication']; ?></td>
                    <td><?php echo $results['page']; ?></td>
                </tr>
                <?php
                $i++; //new line
                }
                ?>
            </table>
        </div>
        <?php
        }
        else{ // if there is no matching rows do following
        echo "No results";
        }
        }
        else{ // if query length is less than minimum
        echo "Minimum length is ".$min_length;
        }
        ?>
        <hr>
        <footer>
            <p>&copy; Valdosta State University Archives and Special Collections, 2014 Collections</p>
        </footer>
        </div> <!-- /container -->        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-46637854-12', 'auto');
        ga('send', 'pageview');
        </script>
    </body>
</html>