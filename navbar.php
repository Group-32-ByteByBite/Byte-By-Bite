<ul>
    <form class="formLink" name="homeForm" action="index.php" method="post" >
            <input type="submit" name="submit" value="Home">
        </form>
    <form class="formLink" name="aboutForm" action="index.php" method="post" >
            <input type="submit" name="submit" value="About">
        </form>
    <form class="formLink" name="colorForm" action="index.php" method="post" >
            <input type="submit" name="submit" value="Color Coordinates">
        </form>
</ul>
<?php
    if(isset($_POST['submit'])){
        $submit = $_POST['submit'];
        switch ($submit) {
            case 'Home':
                //we don't have anything to present here
                break;
            case 'About':
                include 'about.php';
                break;
            case 'Color Coordinates':
                include 'parameter_selection.php';
                break;
        }
    }
?>