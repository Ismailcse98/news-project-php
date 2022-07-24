<?php 
include "config.php";
include "header.php";
if($_SESSION['user_role']==0){
  header("Location:post.php");
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
        <?php 
        $sql = "SELECT * FROM category ORDER BY category_id DESC";
        $res = mysqli_query($con,$sql);
        if(mysqli_num_rows($res)>0){
            $sl = 1;
            while ($row = mysqli_fetch_assoc($res)) {
                
        ?>
                        <tr>
                            <td class='id'><?php echo $sl++;?></td>
                            <td><?php echo $row['category_name'];?></td>
                            <td><?php echo $row['total_post'];?></td>
                            <td class='edit'><a href='update-category.php?id=<?php echo $row["category_id"]?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php?id=<?php echo $row["category_id"];?>' onclick="return confirm('Are you sure??')"><i class='fa fa-trash-o'></i></a></td>
                        </tr>
        <?php } } ?>
                    </tbody>
                </table>
                <ul class='pagination admin-pagination'>
                    <li class="active"><a>1</a></li>
                    <li><a>2</a></li>
                    <li><a>3</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>