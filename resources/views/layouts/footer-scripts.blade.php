<!-- jquery -->
<script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- plugins-jquery -->
<script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>
<!-- plugin_path -->
<script>
    var plugin_path = 
    '{{asset('assets/js')}}/';

</script>

<!-- chart -->
<script src="{{ URL::asset('assets/js/chart-init.js') }}"></script>
<!-- calendar -->
<script src="{{ URL::asset('assets/js/calendar.init.js') }}"></script>
<!-- charts sparkline -->
<script src="{{ URL::asset('assets/js/sparkline.init.js') }}"></script>
<!-- charts morris -->
<script src="{{ URL::asset('assets/js/morris.init.js') }}"></script>
<!-- datepicker -->
<script src="{{ URL::asset('assets/js/datepicker.js') }}"></script>
<!-- sweetalert2 -->
<script src="{{ URL::asset('assets/js/sweetalert2.js') }}"></script>
<!-- toastr -->
@yield('js')
<script src="{{ URL::asset('assets/js/toastr.js') }}"></script>
<!-- validation -->
<script src="{{ URL::asset('assets/js/validation.js') }}"></script>
<!-- lobilist -->
<script src="{{ URL::asset('assets/js/lobilist.js') }}"></script>
<!-- custom -->
<script src="{{ URL::asset('assets/js/custom.js') }}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" ></script>

  <script type="text/javascript">
    @if(Session::has('message'))
let type = "{{Session::get('alert-type','info')}}";

switch (type)
{
  case 'info' : toastr.info("{{Session::get('message')}}");
   break;
  case 'success' : toastr.success("{{Session::get('message')}}");
     break;


  case 'WARNING' : toastr.WARNING("{{Session::get('message')}}");
     break;


  case 'error' : toastr.error("{{Session::get('message')}}");
     break;

}
@endif
  </script>



<script>

$(document).ready(function(){

   $('select[name="to_grade"]').on('change',function(){

   let Grade_id = $(this).val();

   if(Grade_id){
     
     $.ajax({
      type : 'get',
      dataType : 'json',
      url : '/students/getclassbyajax/' + Grade_id,

      success:function(data){

        $('select[name="to_classroom"]').empty();
        $('select[name="to_classroom"]').append('<option selected disabled> choose  </option>');

        $.each(data,function(key,value){
       

      $('select[name="to_classroom"]').append('<option value= "'+key +'">' +value+ '</option>');


        });

      }
     

     });
    

   }


   }) 




});




</script>


<script>

$(document).ready(function(){

   $('select[name="to_classroom"]').on('change',function(){

   let Classroom_id = $(this).val();

   if(Classroom_id){
     
     $.ajax({
      type : 'get',
      dataType : 'json',
      url : '/students/getsectionbyajax/' + Classroom_id,

      success:function(data){

        $('select[name="to_section"]').empty();

        $.each(data,function(key,value){
       

      $('select[name="to_section"]').append('<option value= "'+key +'">' +value+ '</option>');


        });

      }
     

     });
    

   }


   }) 




});




</script>



  



