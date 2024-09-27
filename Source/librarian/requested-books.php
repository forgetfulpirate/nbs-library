<?php 
     session_start();
    if (!isset($_SESSION["username"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page = 'rbook';
    include 'inc/header.php';
    include 'inc/connection.php';
    mysqli_query($link,"update request_books set read1='yes'");
 ?>

<main class="content px-3 py-2">
            <div class="gap-30"></div>
                <div class="container-fluid">
				<div class="mb-3">
          
                        <h4>Student Information  
                        <p id="time"></p>
                            <p id="date"></p>
                        </h4>
                 </div>
            </div>
            <br>
          
            <div class="card border-0">
                 
                        <div class="card-body">
                            <table class="table table-hover text-left table-striped" id="dtBasicExample">
							<thead>
										<tr>
											<th scope="col" >Name</th>
											<th scope="col">Username</th>
											<th scope="col">User Type</th>								
											<th scope="col">Email</th>
											<th scope="col">Book Name</th>
											<th scope="col">Book Url</th>	
                                            <th scope="col">Send Message</th>									
										</tr>
									</thead>
									<tbody>
                                    <?php
                                        $res= mysqli_query($link, "select * from request_books ORDER BY id DESC");
                                        while ($row=mysqli_fetch_array($res)) {
                                            $burl = $row['burl'];
                                            echo "<tr>";
                                            echo "<td>"; echo $row["name"]; echo "</td>";
                                            echo "<td>"; echo $row["username"]; echo "</td>";
                                            echo "<td>"; echo $row["utype"]; echo "</td>";
                                            echo "<td>"; echo $row["email"]; echo "</td>";
                                            echo "<td>"; echo $row["bname"]; echo "</td>";
                                            echo "<td>";
                                            ?><a href="<?php echo $burl; ?>" target="_blank">View</a><?php
                                            echo "</td>";
                              
echo "<td>";
?><button type="button" class="btn btn-danger sendMessageBtn" data-toggle="modal" data-target="#sendMessageModal" data-id="<?php echo $row["id"]; ?>" data-name="<?php echo $row["name"]; ?>">Send Message</button><?php
echo "</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                    </tbody>
                           
                                
                            </table>
                        </div>
                    </div>
             
            
            </main>

        


<!-- Modal -->
<div class="modal fade" id="sendMessageModal" tabindex="-1" aria-labelledby="sendMessageModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sendMessageModalLabel">Send Message to Selected User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="sendMessageForm">
        <div class="modal-body">
          <div class="form-group">
            <label for="recipientName">Recipient Name:</label>
            <input type="text" class="form-control" id="recipientName" readonly>
          </div>
          <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" placeholder="Enter title" name="title">
          </div>
          <div class="form-group">
            <label for="message">Message:</label>
            <textarea class="form-control" id="message" placeholder="Enter your message" name="msg"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Send Message</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('.sendMessageBtn').click(function() {
      var id = $(this).data('id');
      var name = $(this).data('name');
      $('#recipientID').val(id);
      $('#recipientName').val(name);
      
      // AJAX call to send message
      $.ajax({
        type: 'POST',
        url: 'send_message.php',
        data: $('#sendMessageForm').serialize(),
        success: function(response) {
          // Handle success response
          console.log(response);
          // Close the modal
          $('#sendMessageModal').modal('hide');
          // Optionally, display a success message or refresh the page
        },
        error: function(xhr, status, error) {
          // Handle error
          console.error(xhr.responseText);
          // Optionally, display an error message to the user
        }
      });
    });
  });
</script>


   <script>
        $(document).ready(function () {
            $('#dtBasicExample').DataTable({
				// dom: '<html5buttons"B>1Tfgitp',
                // buttons:['copy','csv','excel','pdf', 'print'],
                "lengthMenu": [[5,10, 25, 50, 100, 500], [5,10, 25, 50, 100, 500]]
			});
			
       
        });
    </script>

<?php 
		include 'inc/footer.php';
	 ?>