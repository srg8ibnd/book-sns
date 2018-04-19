<?php
session_start();
if (!isset($_SESSION['user'])){
    header('Location: http://localhost:8888/book-sns/login.php');
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $post_data = $_POST['book'];
    $data = "https://www.googleapis.com/books/v1/volumes?q=$post_data";
    $json = file_get_contents($data);
    $json_decode = json_decode($json, true);
}

 ?>
<?php require_once 'header.php'; ?>
<div class="contents container">
    <h2 class="search_book_title">読んだ本を投稿しよう!</h2>
    <form action="" method="post" class="search_form">
    <input type="text" class="form-control-lg" name="book" size="20" placeholder="本の名前"/>
    <input type="submit" class="btn bg-warning text-white" value="本を探す"/>
    </form>
   <form class="" action="search_book_done.php" method="post">
       <ul class="search_book_list">
           <?php $number = 1;?>
           <?php foreach ($json_decode['items'] as $item): ?>
               <li>
                   <img src="<?php echo $item['volumeInfo']['imageLinks']['thumbnail'] ?>" alt="">
                   <p><?php echo $item['volumeInfo']['title']; ?></p>
                   <div class="lcs_wrap"><input type="radio" name="isbn" value="<?php echo $number;?>" class="lcs_check lcs_tt2" autocomplete="off"><div class="lcs_switch  lcs_off lcs_radio_switch"><div class="lcs_cursor"></div><div class="lcs_label lcs_label_on"></div><div class="lcs_label lcs_label_off"></div></div>
                   <input type="hidden" name="image_<?php echo $number;?>" value="<?php echo $item['volumeInfo']['imageLinks']['thumbnail']; ?>">
                   <input type="hidden" name="title_<?php echo $number;?>" value="<?php echo $item['volumeInfo']['title']; ?>">
                   <input type="hidden" name="link_<?php echo $number;?>" value="<?php echo $item['volumeInfo']['previewLink']; ?>">
               </li>
               <?php $number++;?>
           <?php endforeach; ?>
       </ul>
       <?php if($_POST['book']){ ?>
       <button type="button" class="btn bg-warning text-white" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">この本で確定する</button>
       <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
         <div class="modal-dialog" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title" id="exampleModalLabel"></h4>
             </div>
             <div class="modal-body">
               <form>
                 <div class="form-group">
                   <label for="message-text" class="control-label">Message:</label>
                   <textarea class="form-control" id="message-text" name="text"></textarea>
                 </div>
               </form>
             </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <input type="submit" class="btn btn-primary">
             </div>
           </div>
         </div>
       </div>
   <?php } ?>
    </form>
</div>
