<?php
    $authors = file_get_contents("https://inf653-rest-api.herokuapp.com/api/authors/");
    $authors_obj = json_decode($authors, true);

    $categories = file_get_contents("https://inf653-rest-api.herokuapp.com/api/categories/");
    $categories_obj = json_decode($categories, true);
?>

<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
        <link rel = "stylesheet" type = "text/css" href = "css/main.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <title>Quotes List</title>
    </head>
    <body>
        <div id = "content">
            <form action = "" method = "GET">&nbsp;&nbsp;
                <select name = "authorId" class = "sel">
                    <option value = "0">View All Authors</option>
                    <?php
                        for ($i = 0; $i < count($authors_obj); $i++)
                        {
                            echo "<option value = " . $authors_obj[$i]["id"] . ">" . $authors_obj[$i]["author"] . "</option>";
                        }
                    ?>
                </select>&nbsp;&nbsp;

                <select name = "categoryId" class = "sel">
                    <option value = "0">View All Categories</option>
                    <?php
                        for ($i = 0; $i < count($categories_obj); $i++)
                        {
                            echo "<option value = " . $categories_obj[$i]["id"] . ">" . $categories_obj[$i]["category"] . "</option>";
                        }
                    ?>
                </select>
                <input type = "submit" class="btn btn-primary" />
                <input type = "submit" id="resetQuotesListForm" type="reset" class="btn btn-ptimary">
            </form>
            <table class="table table-hover">
                <tr>
                    <th>Quote</th>
                    <th>Author</th>
                    <th>Category</th>
                </tr>
                <?php
                    $link = "https://inf653-rest-api.herokuapp.com/api/quotes/?";
                    if (isset($_GET["authorId"]))
                    {
                        $link .= "authorId=" . $_GET["authorId"] . "&";
                    }
                    if (isset($_GET["categoryId"]))
                    {
                        $link .= "categoryId=" . $_GET["categoryId"] . "&";
                    }

                    $quotes = file_get_contents($link);
                    $quotes_obj = json_decode($quotes, true);

                    if (!isset($quotes_obj["message"]))
                    {
                        for ($i = 0; $i < count($quotes_obj); $i++)
                        {
                            echo "<tr>";
                            echo "<td>" . $quotes_obj[$i]["quote"] . "</td>";
                            echo "<td>" . $quotes_obj[$i]["author"] . "</td>";
                            echo "<td>" . $quotes_obj[$i]["category"] . "</td>";
                            echo "</tr>";
                        }
                    }
                ?>
            </table>
        </div>
    </body>
</html>
