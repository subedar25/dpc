<div class="modal fade bs-example-modal-center" id="editorder" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Edit Result</h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
            <div id="formupdatemsg" style="display:none" class="alert alert-success alert-dismissible fade show mb-0  mb-4 mt-2 col-lg-4"></div>
                    <div>
                            <div class="card-body">
                               
                                    <div id="orderlogdata" class=" col-lg-12">
                                    
                                    </div>
                               
                            </div>

                            
                        </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script>

    
 function updateresult()
          {
            
            var form = $('#editresultform')[0];
            var formdata = new FormData(form);

                var request = $.ajax( {
                            url : "<?php echo site_url('updatresult'); ?>",
                            cache: false,
                            contentType: false,
                            processData: false,
                            async: false,
                            data: formdata,
                            type: 'POST',
                            
                            success: function(res) {
                            //   console.log(res);
                                responsedata = JSON.parse(res);
                                
                                if (responsedata.status == 201) {

                                $("#formupdatemsg").html(responsedata.message);
                                $('#formupdatemsg').css('display','block');
                                
                                 $('#addorder').modal('toggle');
                                 window.location.reload();
                                }
                            },
                            fail: function(res) {
                                errorFlag = true;
                                console.log(res);
                                
                            },
                            error: function(xhr, status, error) {
                                errorFlag = true;
                                var errorMessage = xhr.status + ': ' + xhr.statusText;
                                console.log('Error - ' + errorMessage);
                                
                            }
                        })

                   
          }


     function getOrderEdit(oid)
        {

                     var request = $.ajax( {
                            url : "<?php echo site_url('editresultform?oid='); ?>"+oid,
                            cache: false,
                            contentType: false,
                            processData: false,
                            async: false,
                            data: "",
                            type: 'GET',
                            
                            success: function(res) {
                           
                                $('#orderlogdata').html(res); 
                              
                            },
                            fail: function(res) {
                                errorFlag = true;
                                console.log(res);
                                
                            },
                            error: function(xhr, status, error) {
                                errorFlag = true;
                                var errorMessage = xhr.status + ': ' + xhr.statusText;
                                console.log('Error - ' + errorMessage);
                                
                            }
                        })

        }
       
    </script>