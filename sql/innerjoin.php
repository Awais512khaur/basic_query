<?php
$categoryQuery = "SELECT category.Category 
                  FROM news_category 
                  INNER JOIN category ON news_category.category_id = category.ID 
                  WHERE news_category.news_id = " . $row['ID'];
$categoryResult = mysqli_query($conn, $categoryQuery);
if ($categoryResult) 
{
    if (mysqli_num_rows($categoryResult) > 0) {
        $categoryRow = mysqli_fetch_assoc($categoryResult);
        $category_name = $categoryRow['Category'];
        echo "<td>$category_name</td>";
    } else 
    {
        echo "<td>No category found</td>";
    }
} else 
{
    echo "<td>Error: " . mysqli_error($conn) . "</td>";
}
                    //table name.column name
$categoryQuery = "SELECT category.Category 
                  --from which table
                  FROM news_category 
                  --join with category_table on news_category_table.table = category id from category table   
                  INNER JOIN category ON news_category.category_id = category.ID 
                  --condition where news_category.news_id table
                  WHERE news_category.news_id = " . $row['ID'];
