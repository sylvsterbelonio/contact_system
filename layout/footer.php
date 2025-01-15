</div>
</main>

<footer class="text-center mt-5">
  Technical Training &copy; 2025
</footer>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="js/simple-bootstrap-paginator.js"></script>
<script src="js/simple-bootstrap-paginator.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){


    var user_id = $("#ajax_user_id").val() ?? 0;

    $("#live_search").keyup(function(){
      var input = $(this).val() ?? '';
   
        $.ajax({
          url:'components/search_contact.php',
          method:'POST',
          data:{input:input,user_id:user_id},
          success:function(data){
            $("#search_result").html(data);
          }
        })
    });

    var totalPage = parseInt($("#ajax_total_records").val());


    //alert(totalPage);


    var pag = $("#pagination").simplePaginator({
      totalPages:totalPage,
      maxButtonVisible:5,
      currentPage:1,
      nextLabel:'Next',
      prevLabel:"Prev",
      firstLabel:'First',
      lastLabel:"Last",
      clickCurrentPage:true,
      pageChange:function(page){
        
        //$("#content").html("<tr><td colspan=6><strong>loading...</strong></td></tr>");
    
        $.ajax({
          url:'components/get_contact.php',
          method:'POST',
          dataType:"json",
          data:{page:page,user_id:user_id},
          success:function(data){


          //alert(data);


          }
        })
        
      }
    });


  });




</script>

</body>
</html>