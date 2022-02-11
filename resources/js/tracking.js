$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('#update').click(function(e){
e.preventDefault();
$.ajaxSetup({
   headers: {
       'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
   }
});
$.ajax({
  url:'/operator/tracking/update',
  data:{
      'museum':1,
   },
  type:'POST',
  success:  function (response) {
     alert(response);
  },
  statusCode: {
     404: function() {
        alert('web not found');
     }
  },
  error:function(x,xs,xt){
     window.open(JSON.stringify(x));
     alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
  }
});
});