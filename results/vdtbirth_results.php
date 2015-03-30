<?php
mysql_connect("impa.valdosta.edu", "archives_web", "uhCs4fQpr") or die("Error connecting to database: ".mysql_error());
mysql_select_db("extra_credit") or die(mysql_error());
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <title>Valdosta Daily Times Engagement Announcements Search Results</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="../css/tables.css">
        <script src="../js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
        <?php
        $query = $_GET['searchterm'];
        // gets value sent over search form
        $min_length = 2;
        // you can set minimum length of the query if you want
        if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
        $query = htmlspecialchars($query);
        // changes characters used in html to their equivalents, for example: < to &gt;
        $query = mysql_real_escape_string($query);
        // makes sure nobody uses SQL injection
        $raw_results = mysql_query("SELECT * FROM vital_records WHERE (`newborns_name` LIKE '%".$query."%') OR (`fathers_name` LIKE '%".$query."%') OR (`mothers_name` LIKE '%".$query."%') ORDER BY year ASC") or die(mysql_error());
        
        if(mysql_num_rows($raw_results) > 0){ // if one or more rows are returned do following ?>
        <div class="vdthead">
            <a href="href="http://www.valdosta.edu/archives""><img src="../img/vsuasc-logo_f.png" alt="Archive Logo" class="logo"/></a>
            <h1>VDT Search Results <small><?php echo "for <strong>$query</strong>"; ?> </small></h1>
            <p><a href="http://archives.valdosta.edu/gendex/">Back to Search Page</a></p>
        </div>
        <div>
            <table class="table table-striped table-hover table-bordered">
                <tr class="vdttabhead">
                    <td><strong>ID</strong></td>
                    <td><strong>Newborn's Name</strong></td></td>
                    <td><strong>Father's Name</strong></td>
                    <td><strong>Mother's Name</strong></td>
                    <td><strong>Record Type</strong></td>
                    <td><strong>Month</strong></td>
                    <td><strong>Day</strong></td>
                    <td><strong>Year</strong></td>
                    <td><strong>Volume</strong></td>
                    <td><strong>Issue</strong></td>
                    <td><strong>Page/Section</strong></td>
                </tr>
                <?php $i=1;//new line
                while($results = mysql_fetch_assoc($raw_results)){
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $results['newborns_name']; ?></td>
                    <td><?php echo $results['fathers_name']; ?></td>
                    <td><?php echo $results['mothers_name']; ?></td>
                    <td><?php echo $results['record_type']; ?></td>
                    <td><?php echo $results['month']; ?></td>
                    <td><?php echo $results['day']; ?></td>
                    <td><?php echo $results['year']; ?></td>
                    <td><?php echo $results['vol']; ?></td>
                    <td><?php echo $results['issue']; ?></td>
                    <td><?php echo $results['page_section']; ?></td>
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
            <p>&copy; Valdosta State University Archives and Special Collections, 2014</p>
        </footer>
        </div> <!-- /container -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
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