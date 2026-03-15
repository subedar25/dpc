<div class="page-content">

    <div class="container-fluid">

        <div class="row">


            <div class="col-lg-12 ">
                <?php if (count($historyData)) { ?>
                    <div>

                        <div class=" box-rounded text-uppercase text-white" style="background-color: #003399;font-family:Times new roman; font-weight: bold; font-size:20px;" align="center">

                            <?php echo $historyData[0]->name; ?>
                        </div>


                        <div align="center" style="padding-top:5px; padding-bottom: 5px;" id="posts">

                         <?php //echo view('user/_viewallresult', array('historyData' => $historyData)); ?>
                            
                        </div>
                       
                        <div id="loading">Loading...</div>
                    </div>

                <?php } else { ?>
                    <div align="center"> <b> No Result Found</b></div>
                <?php } ?>


            </div>
            <div> <a href="javascript:javascript:history.go(-1)" class="btn btn-info"> <i class="fa fa-arrow-circle-left"></i> <b>Back</b></a> |
                <a href="<?php echo site_url('') ?>" class="btn btn-info"> <i class="fa fa-home"></i> <b>Home</b></a>
            </div>

        </div>

    </div> <!-- container-fluid -->
</div>


<script>
        let page = 1;
        let loading = false;

        function loadPosts() {
            if (loading) return;
            loading = true;
            $("#loading").show();
           // alert("ss");
            $.ajax({
                url: "<?php echo site_url('loadmoreresult?id='.$id); ?>&page=" + page,
                type: "GET",
              //  dataType: "json",
                success: function (data) {
                  //  console.log(data);
                    if (data.length === 0) {
                        $(window).off("scroll"); // Stop scrolling if no more data
                        $("#loading").text("No more result");
                        return;
                    } 
                    
                    $("#posts").append(data);
                
                    page++;
                    loading = false;
                    $("#loading").hide();
                }
            });
        }

        $(document).ready(function () {
            loadPosts(); // Load initial posts

            $(window).scroll(function () { 
                let scrollHeight = $(window).scrollTop();
                let winHeight = $(window).height();
                let docheight = $(document).height();
               // alert((scrollHeight + winHeight )+" --- "+(docheight-100));
                if ( scrollHeight + winHeight >=  docheight- 100) {
                   
                    loadPosts(); // Load more posts on scroll
                }
            });
        });
    </script>