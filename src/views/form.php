<html lang="en">
<head>
    <title>Puzzle</title>
</head>
<body>
<div>
    <form method="post">
        <div>
            <label for="input">Input</label>
            <textarea id="input" name="input" style="height: 300px"></textarea>
        </div>
        <div>
            <input type="submit" value="Submit">
        </div>
    </form>

    <div>
        <?php
        if (isset($output)) {
            echo "Output: </br> $output";
        }
        ?>
    </div>
</div>
</body>
</html>