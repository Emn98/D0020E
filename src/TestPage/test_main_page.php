<!doctype html>

<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>d0020e-prodject</title>
    <link rel="stylesheet" href="Styles/style.css">

</head>

<body>    

    <div class="center_div">
        <h1>Frontend for access test of data and attributes</h1>

        <form action="access_request.php" method="GET">
            <label for="users">Choose a user:</label>
                <select id="user" name="user">
                    <option value="jesper">Jesper</option>
                    <option value="ilaman">Ilaman</option>
                    <option value="emil">Emil</option>
                    <option value="birger">Birger</option>
                </select>
            <label for="objects">Choose a object:</label>
                <select id="object" name="object">
                    <option value="hobbit">Hobbit</option>
                    <option value="bible">Bible</option>
                    <option value="book1">book1</option>
                    <option value="book2">book2</option>
                </select>
            <button id="submit" name="submit" type="submit">Submit</button>
        </form>

        <?php
            if(isset($_COOKIE["acccess"]))
            {
                echo $_COOKIE["acccess"];
            }
        ?>
    </div>

</body>

</html>