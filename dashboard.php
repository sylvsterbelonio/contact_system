<?php include 'layout/admin_header.php'; ?>
<?php include 'config/database.php'; ?>
<?php
$user_id = $_SESSION['id'];
?>

<script>
     var selected_id='';
     function delete_record(id) {
          selected_id = id;
     };
     function delete_now(){
          if(selected_id){
               document.location.href = 'delete_contact.php?id=' +selected_id;
          }
     }
</script>


<nav class="navbar navbar-expand-sm navbar-light bg-light mb-4">
    <div class="container">
      <a class="navbar-brand" href="#">Contact System</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="add_contact.php">Add Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contacts</a>
          </li>
          <li class="nav-item">
            <a id="link-address" class="nav-link" href="logout.php?id=<?=$_SESSION['id']?>">Log out</a>
          </li>
        </ul>
      </div>
  </div>
</nav>

<main>
  <div class="container d-flex flex-column align-items-center">

<p class="text-start">Welcome <?=$_SESSION['name']?>!</p>


<h2>List of Contacts</h2>
<div style="display:flex;justify-content:end;width:100%">
    <input class="form-control w-50" id="live_search" type="search" placeholder="Search" />
</div>




<input id="ajax_user_id" type="hidden" value="<?=$user_id?>" name="user_id"/>


<div id="search_result" class="container-fluid">
          <table class="table">
               <thead>
                    <tr>
                         <td>Name</td>
                         <td>Company</td>
                         <td>Phone</td>
                         <td>Email</td>
                         <td>Action</td>
                    </tr>
               </thead>
               <tbody id="content">
                    <?php 
                    $sql = "SELECT * from contacts where user_id=$user_id";
                    $result = $conn->query($sql);
                    if(!$result){
                         die('Invalid query:' . $conn->error);
                    }

                    while($row = $result->fetch_assoc()){
                         echo " <tr>
                         <td>$row[name]</td>
                         <td>$row[company]</td>
                         <td>$row[phone]</td>
                         <td>$row[email]</td>
                         <td>
                              <a href='edit_contact.php?id=$row[id]' class='btn btn-primary btn-sm'>Edit</a>

                              <button type='button' onclick='delete_record($row[id])'  class='btn btn-sm btn-danger' data-bs-toggle='modal' data-bs-target='#deleteRecord'>Delete</button>
                         </td>
                         </tr>";
                    }

                    ?>

                   
               </tbody>

          </table>

          <div id="pagination">
              <input id="ajax_total_records" type="hidden" value="<?=$result->num_rows?>" name="id"/>
          </div>
          
          




          
</div>

<!-- Button trigger modal -->
          <!-- Modal -->
          <div class="modal fade" id="deleteRecord" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Confirm</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    Are you sure you want to delete this record?
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" onclick="delete_now()" class="btn btn-danger" data-bs-dismiss="modal">Confirm</button>
                    </div>
               </div>
               </div>
          </div>



<?php include 'layout/footer.php'; ?>