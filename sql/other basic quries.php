<!-- This is code to insert data in table and insert two different id from two different tables in an other table using their primary key as a foreign keys -->
<?php
include('../db/connection.php');
if(isset($_POST['submit'])) {
    $title = $_POST['title'];
    $image = $_FILES['image']['name'];
    $tmp_image = $_FILES['image']['tmp_name'];
    $subimage = $_FILES['subimage']['name'];
    $tmp_subimage = $_FILES['subimage']['tmp_name']; 
    $description = $_POST['description'];
    $date = $_POST['date'];
    $category_id = $_POST['category'];
    $thumbnail = $_POST['thumbnail'];
    $uploaded = $_POST['uploaded'];
    move_uploaded_file($tmp_image, "../images/$image");
    move_uploaded_file($tmp_subimage, "../sub_images/$subimage"); 
    $query = "INSERT INTO news (title, image, subimage, description, date, Address, Uploaded_by) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sssssss', $title, $image, $subimage, $description, $date, $thumbnail, $uploaded);
    $result = mysqli_stmt_execute($stmt);
    if($result) {
        $news_id = mysqli_insert_id($conn);
        $query_category = "INSERT INTO news_category (news_id, category_id) VALUES (?, ?)";
        $stmt_category = mysqli_prepare($conn, $query_category);
        mysqli_stmt_bind_param($stmt_category, 'ii', $news_id, $category_id);
        $result_category = mysqli_stmt_execute($stmt_category);
        
        if($result_category) {
            echo '<script>alert("News Added Successfully");</script>';
        } else {
            echo '<script>alert("Failed to add News to Category");</script>'; 
        }
        
        mysqli_stmt_close($stmt_category);
    } else {
        echo '<script>alert("Failed to add News");</script>'; 
    }
    
    mysqli_stmt_close($stmt);
}
?>

<!-- query to fetch data in descending order  -->
$query = mysqli_query($conn, "SELECT * FROM news ORDER BY date DESC");

<!-- this query is to fetch data where date is equal to today news -->
$query = mysqli_query($conn, "SELECT * FROM news WHERE DATE(date) = CURDATE();");

<!-- Inner join query -->

<!-- table name.column name -->
SELECT category.Category 
<!-- from which table -->
FROM news_category 
<!-- join with category_table on news_category_table.table = category id from category table    -->
INNER JOIN category ON news_category.category_id = category.ID 
<!-- condition where news_category.news_id table -->
WHERE news_category.news_id = " . $row['ID']

<!-- Create table as foreign key -->
CREATE TABLE new_category (
    news_id INT,
    category_id INT,
    FOREIGN KEY (news_id) REFERENCES news(ID),
    FOREIGN KEY (category_id) REFERENCES category(ID)
);

