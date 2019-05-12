<?php
require_once('user_navbar.php');
    $category_id = $_GET['category_id'];
    $page_id = $_GET['page_id'];
    $start_from=($page_id-1)*$videos_per_page;
    $category_detail_query = "SELECT * FROM `categories` WHERE `id` = '$category_id'";
    $videos_of_category = "SELECT * FROM `zujji_master` WHERE `status` = '1' AND `zujji_category` = '$category_id' ORDER BY id DESC LIMIT $start_from,$videos_per_page";
    $category_details = mysqli_query($conn,$category_detail_query);
    $category = mysqli_fetch_assoc($category_details);
    $videos = mysqli_query($conn,$videos_of_category);
   
?>
    <div class="row">
        <div class="text-center"><h4><b><?php echo $category['category_name'];?></b></h4></div>        
    </div>
    <?php
        $iteration=0;
        $output = "";
        while($card_data=mysqli_fetch_array($videos)){

            if($iteration == 0){
                $output .='<div class="row">'; 
            }
            $output .='<div class="col-md-3 col-lg-3">
            <div class="card"><a href="video_page.php?video_id='.$card_data['id'].'"><img src="'.$card_data['banner_photo'].'" alt="Avatar" style="width:100%;height:130px"><div class="card_container"><h4 class="text-center"><b>'.$card_data['zujji_type'].'</b></h4> </a>
            </div></div></div>';
            if($iteration == 3){
                $output .='</div><br>';
                $iteration = 0;
            }
            else{
                $iteration++;
            }
        }

        $page_query='SELECT * FROM `zujji_master` WHERE status="1" ORDER BY id ASC';
        $page_result=mysqli_query($conn,$page_query);
        $total_records=mysqli_num_rows($page_result);
        $total_pages=ceil($total_records/$videos_per_page);
        if($iteration!=0){
            $output.="</div>
            <br><div class='text-center'>";
        }
        else{
            $output.="<div class='text-center'>";
        }
        for($i=1;$i<$total_pages;$i++)
        {
            
            $output.='<a href="category_select.php?category_id='.$category_id.'&&page_id='.$i.'" class="text-center videos_pagination_link" style="cursor:pointer;padding:6px 6px 6px 6px;border:1px solid #ccc;margin-right:5px;" id="'.$i.'">'.$i.'</a>';
        }
        $output.="</div>";
        echo $output;
    ?>
    
</div>
</body>
</html>