<div class="modal fade bs-example-modal-center" id="editorder" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-center" style="max-width:900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Edit Company</h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
            <div id="formupdatemsg" style="display:none" class="alert alert-success alert-dismissible fade show mb-0 mb-4 mt-2 w-100"></div>
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

function syncWorkingSelectAll($form) {
    var total = $form.find('.workingday').length;
    var checked = $form.find('.workingday:checked').length;
    $form.find('.workingday-select-all').prop('checked', total > 0 && total === checked);
}

$(document).on('change', '.workingday-select-all', function () {
    var $form = $(this).closest('form');
    $form.find('.workingday').prop('checked', this.checked);
    syncWorkingSelectAll($form);
});

$(document).on('change', '.workingday', function () {
    syncWorkingSelectAll($(this).closest('form'));
});

    
 function updateresult()
          {
            
            var form = $('#editcompanyform')[0];
            var formdata = new FormData(form);

                var request = $.ajax( {
                            url : "<?php echo site_url('updatcompany'); ?>",
                            cache: false,
                            contentType: false,
                            processData: false,
                            async: false,
                            data: formdata,
                            type: 'POST',
                            
                            success: function(res) {
                                responsedata = JSON.parse(res);

                                if (responsedata.status == 201) {
                                    $("#formupdatemsg").removeClass('alert-danger').addClass('alert-success');
                                    $("#formupdatemsg").html(responsedata.message);
                                    $('#formupdatemsg').css('display','block');
                                    $('#addorder').modal('toggle');
                                    window.location.reload();
                                } else {
                                    $("#formupdatemsg").removeClass('alert-success').addClass('alert-danger');
                                    $("#formupdatemsg").html(responsedata.message);
                                    $('#formupdatemsg').css('display','block');
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
                            url : "<?php echo site_url('editcategoryform?oid='); ?>"+oid,
                            cache: false,
                            contentType: false,
                            processData: false,
                            async: false,
                            data: "",
                            type: 'GET',
                            
                            success: function(res) {
                                $('#orderlogdata').html(res);
                                if (typeof syncWorkingSelectAll === 'function') {
                                    syncWorkingSelectAll($('#editcompanyform'));
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
       
    </script>
