<div class="page-content">
<div class="container-fluid">
    <header class="section-header">
    <div class="tbl">
        <div class="tbl-row">
            <div class="tbl-cell col-md-10">
                <h2>My Salary Slips</h2>
            </div>
        </div>
    </div>
    </header>
    <section class="card">
        <div class="card-block">
            <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th style="width:15%">Employee Name</th>
                    <th style="width:15%">Month</th>
                    <th style="width:15%">Year</th>
                    <th style="width:10%">Actions</th>
                </tr>
                </thead>
                
                <tbody>
                                      
                </tbody>
            </table>
        </div>
    </section>
    <div class="modal fade" id="preview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 <div class="modal-dialog" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times; <small>Close</small></span></button>
     </div>
     <div class="modal-body" id="modal-content">
       <img class="loader" src="<?php echo base_url('images/loaders/loader1.gif'); ?>" alt="" /> Loading Preview...
     </div>
   </div>
 </div>
</div>

<!--Employee Salary Slip***************-->

    
<script>
        $(function(){
            // $('#example').DataTable({
            //  responsive: true
            // });
        });
        function get_month(month)
        {
            var monthNames = ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"];
            var d = month-1;
            return monthNames[d];
        }

        function get_salary_slips()
        {
            var id = '<?php echo $this->uri->segment(3); ?>';
            oTable = $('#example').DataTable({
            
                'responsive': true,
                'bProcessing'    : true,
                'bServerSide'    : true,
                'language': {
                    processing: "<img src='<?php echo assets_url();?>img/loader.gif'>"
                },
                "order": [[ 0, "desc" ]],  //descending column for id , newly inserted record display on row one
                'sPaginationType': 'full_numbers',
                "aoColumns": [
                    // {"sName": "can_id", "mData": "can_id" ,"bSortable":true},
                    {"sName": "can_name", "mData": "can_name" ,"bSortable":true},
                    {"sName": "month", "mData": "month" ,"bSortable":true},
                    {"sName": "year", "mData": "year" ,"bSortable":false},
                    {"sName": "download", "mData": "download" ,"bSortable":false,"bSearchable":false}
                ],
                'sAjaxSource'    : '<?php echo site_url();?>'+'/compensation/get_user_salary_slips',
                'fnServerData': function(sSource, aoData, fnCallback)
                {
                    $.ajax
                    ({
                        'dataType': 'json',
                        'type'    : 'POST',
                        'url'     : sSource,
                        'data'    : aoData,
                        'success' : fnCallback
                    });
                },
            "createdRow": function ( row, data, index )
            {
                $('td', row).eq(1).text(get_month(data.month));
            }
 

            });
        }


    $(document).ready(function() {
       var oTable;
       day=get_month(1);
      //  alert(day);
        get_salary_slips();
    });
</script>

</div>
</div><!--.page-content-->