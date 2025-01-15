<?php
include '../config/database.php';

if(isset($_POST['input'])){
     $input = $_POST['input'];
     $user_id = $_POST['user_id'];
     
     
     $per_page = 5;
     $total_records = 0;

     //GETTING ALL RECORDS
     $sql = "SELECT * from contacts where user_id=$user_id";
     $result = $conn->query($sql);
          $total_records = $result->num_rows;

     $total_pages = ceil($total_records/$per_page);
     
     
     
     $sql = "SELECT * from contacts where (name LIKE '{$input}%' OR company LIKE '{$input}%' OR email LIKE '{$input}%' or phone LIKE '{$input}%') AND user_id=$user_id";
     $result = $conn->query($sql);
                    if(!$result){
                         die('Invalid query:' . $conn->error);
                    }

                    $html = ' <table class="table w-100">
                              <thead>
                                   <tr>
                                        <td>Name</td>
                                        <td>Company</td>
                                        <td>Phone</td>
                                        <td>Email</td>
                                        <td>Action</td>
                                   </tr>
                              </thead>
                              <tbody>';

                    if($result->num_rows==0){
                         $html.='<tr><td colspan="5"><p class="text-center">No Data Found...</p></td></tr>';
                    }          

                    while($row = $result->fetch_assoc()){
                         $html.= " <tr>
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

                    $html.="  </tbody></table>
                    <br>
                    <div>
                         <p>Total Records: $total_records</p>
                    </div>
                    ";

                    echo $html;

}

?>