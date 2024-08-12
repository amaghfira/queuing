<?php
require_once('./DBConnection.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `queue_list` where queue_id = '{$_GET['id']}'");
    @$res = $qry->fetch_assoc();
    if($res){
        foreach($res as $k => $v){
            if(!is_numeric($k)){
                $$k = $v;
            }
        }
    }
}
?>
<style>
    #uni_modal .modal-footer{
        display:none;
    }
</style>
<div class="container fluid">
    <?php if(isset($_GET['success']) && $_GET['success'] == true): ?>
        <div class="alert alert-success">Berhasil mendapatkan nomor antrean.</div>
    <?php endif; ?>
    <div id="outprint">
        <div class="row justify-content-end">
            <div class="col-12">
                <div class="card border-0 border-left border-start rounded-0 border-5 border-info">
                    <div class="fs-1 fw-bold text-center"><?php echo $queue ?></div>
                    <center><?php echo $customer_name ?></center>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-2 mx-0 justify-content-end align-items-center">
        <button class="btn btn-success rounded-0 me-2 col-sm-4" id="print" type="button"><i class="fa fa-print"></i> Save</button>
        <button class="btn btn-dark rounded-0 col-sm-4" data-bs-dismiss="modal" type="button"><i class="fa fa-times"></i> Close</button>
    </div>
</div>
<!-- save pdf -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script> -->

<!-- save pdf -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.9/pdfmake.min.js" integrity="sha512-5wC3oH3tojdOtHBV6B4TXjlGc0E2uk3YViSrWnv1VUmmVlQDAs1lcupsqqpwjh8jIuodzADYK5xCL5Dkg/ving==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.9/vfs_fonts.js" integrity="sha512-nNkHPz+lD0Wf0eFGO0ZDxr+lWiFalFutgVeGkPdVgrG4eXDYUnhfEj9Zmg1QkrJFLC0tGs8ZExyU/1mjs4j93w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- script print -->
<!-- <script>
    $(function(){
        $('#print').click(function(){
            var _el = $('<div>')
            var _h = $('head').clone()
            var _p = $('#outprint').clone()
            _h.find('title').text("Queue Number - Print")
            _el.append(_h)
            _el.append(_p)
            var nw = window.open('','_blank','width=700,height=500,top=75,left=200')
                nw.document.write(_el.html())
                nw.document.close()
                setTimeout(() => {
                    nw.print()
                    setTimeout(() => {
                        nw.close()
                        $('#uni_modal').modal('hide')
                    }, 200);
                }, 500);
        })
    })
</script> -->

<!-- <script>
    $(function(){
        $('#print').click(function(){
            // Capture the content of the element with the id "outprint" as an image
            html2canvas(document.getElementById('outprint'), {
                onrendered: function(canvas) {
                    var imgData = canvas.toDataURL('image/png');

                    // Create a PDF document
                    var docDefinition = {
                        content: [
                            { image: imgData, width: 500 }
                        ]
                    };

                    // Generate and save the PDF
                    pdfMake.createPdf(docDefinition).download('queue_number.pdf');
                }
            });
        });
    });
</script> -->

<script>
    $(function(){
        $('#print').click(function(){
            // Capture the content of the element with the id "outprint" as an image
            html2canvas(document.getElementById('outprint'), {
                onrendered: function(canvas) {
                    var imgData = canvas.toDataURL('image/png');

                    // Create a PDF document
                    var docDefinition = {
                        content: [
                            { image: imgData, width: 500 }
                        ]
                    };

                    // Generate and save the PDF
                    pdfMake.createPdf(docDefinition).download('queue_number.pdf');
                }
            });
        });
    });
</script>

