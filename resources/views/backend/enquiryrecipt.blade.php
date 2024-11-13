@extends('backend.layouts.main')
@section('main-container')
<style>
 .form_section1_div{
    width: 70%;
    margin-left: auto;
    margin-right: auto;
        border: 1px solid #e4e0e0;
    padding: 20px;
}
@media print
{
  .invoice-summary {
    width: 220px;
    text-align: right;
    float: right;
    
}
.invoice-summary2 {
    width: 220px;
    text-align: left;
    float: left;
     position: relative;
    
}

.uperletter{
  text-transform: capitalize;
} 

.col-md-6 {
    flex: 0 0 auto;
    width: 40%;
}
}
@media print {
  .invoice-summary {
    margin-top: -100px;
    text-align: right;
    float: right;
  }}
</style>
<div class="main-content">
    <button class="btn btn-sm btn-danger" onclick="printDiv('printme')"> Print Report</button>
    <div class="form_section1_div" id="printme">
    <div class="row">
        @if(!empty($all_inquiry))
                                            
         @foreach($all_inquiry as $each_inq)
         <?php $notificationData1 = json_decode($each_inq->json_str, true);?>
            <div class="col-md-12 mb-4" style="display: grid; place-items: center;">
                <img src="{{url('assets/backend/')}}/images/school-logo.png"  style="width: 60%;" alt=""/>
                <br>
            </div>
            <!-- <div class="col-md-12">
            <h3 style="display: grid; place-items: center;">Fees Recipt</h3>
              
            </div> -->
            <div class="separator-breadcrumb border-top"></div>
            <div class="col-md-12 mb-4">
              <!-- recipt area -->
                <div id="print-area">
                                      
                                      <div class="row">
                                            
                                            <div class="col-md-12 ">
                                                <div class="table-responsive">
                                                    <table class="display table table-striped" id="zero_configuration_table" style="width: 100%">
                                                        <thead>
                                                            <tr>
                                                            <th>
                                                            <h5 class="font-weight-bold">Scholar No.: <span><?php if(!empty($each_inq->form_number)){ echo $each_inq->form_number; }?></span></span></h5>
                                                                <!-- <p>#106</p> -->
                                                                <h5 class="font-weight-bold uperletter">Student Name : <span><?php if(!empty($each_inq->student_name)){ echo $each_inq->student_name; }?></span></h5>
                                                                <h5 class="font-weight-bold uperletter">Father Name : <span><?php if(!empty($notificationData1['fathername_prefix'])){ echo $notificationData1['fathername_prefix']; }?>.  <?php if(!empty($notificationData1['fathername'])){ echo $notificationData1['fathername'];}?></span></h5>
                                                                <h5 class="font-weight-bold">Class : <span><?php if(!empty($each_inq->class_name)){ echo $each_inq->class_name; } ?></span></h5></th>
                                                            <th><div class="invoice-summary">
                                                                    <h5 class="font-weight-bold">Session: <span><?php if(!empty($each_inq->session_name)){ echo $each_inq->session_name; }?></span></h5>
                                                  
                                                                    <h5 class="font-weight-bold">Recipt No.: <span><?php if(!empty($each_inq->form_number)){ echo $each_inq->form_number; }?></span></h5>
                                                                    <h5 class="font-weight-bold">Date : <span><?php if(!empty($each_inq->created_at)){ echo date('d-m-Y', strtotime($each_inq->created_at)); }?></span></h5>

                                                            </div></th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                            </div>
                                        </div>
                                        
                                        <!-- <div class="separator-breadcrumb border-top"></div> -->

                                        <!-- <div class="separator-breadcrumb border-top"></div> -->

                                        <div class="col-md-12 ">
                                                <div class="table-responsive">
                                                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width: 100%">
                                                        <thead>
                                                            <tr>
                                                            <th>Enquiry Fees</th>
                                                            <th><div class="invoice-summary">Amount</div></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><h5><span>Enquiry</span></h5></td>
                                                            
                                                            <td>
                                                                <div class="invoice-summary"><h5><span>&#x20B9;500</span></h5></div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                                <td></td>
                                                            
                                                            <td>
                                                                <div class="invoice-summary"><h5>Grand Total: <span>&#x20B9;500</span></h5></div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <div class="col-md-12">
                                                                     <div class="separator-breadcrumb "></div>
                                                                   <div class="invoice-summary">
                                                                    <h5>.........................................</h5>
                                                                    <h5>Approved by: Name </h5>
                                                                   </div>
                                                                   @endforeach
                                                                   @endif
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                        
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!-- ==== / Print Area =====-->
            </div>
           
            <!-- signature area -->
            
            <!-- signature end -->
          
    <!-- end of main-content -->
</div>
<script type="text/javascript">
function printDiv(divName){
var printContents = document.getElementById(divName).innerHTML;
var originalContents = document.body.innerHTML;

document.body.innerHTML = printContents;

window.print();

document.body.innerHTML = originalContents;
}
</script>
@endsection