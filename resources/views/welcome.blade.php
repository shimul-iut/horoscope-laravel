@extends('layout')
@php
$year = date("Y");
@endphp
<div class="container">
<img src="/logos/linkedin_banner_image_1.png" width="100%" height="100">
</div>

<select required style="margin-left : 46%; margin-top:20px; width : 8%" id = "ddlViewBy"> 
    <!--
      This is how we can do "placeholder" options.
      note: "required" attribute is on the select
    -->
    <option value=""
            hidden
    >Select Year</option>

    <!-- normal options -->
    @for($i = $year; $i < $year + 10; $i++)
        <option value="{{$i}}">{{$i}}</option>
    @endfor
    </select>
    <br>
    <select required style="margin-left : 46%; margin-top:20px; width : 8%" id = "signView"> 
    <!--
      This is how we can do "placeholder" options.
      note: "required" attribute is on the select
    -->
    <option value=""
            hidden
    >Select Sign</option>

    <!-- normal options -->
    @foreach($signs as $sign)
        <option value="{{$sign->id}}">{{$sign->name}}</option>
    @endforeach
    </select>
  <br>
<button class="btn btn-success" id = "futureBtn">Find Your Future</button>

<script>

document.getElementById("futureBtn").addEventListener("click", function() {
   
    var year = document.getElementById("ddlViewBy").value;
    var sign = document.getElementById("signView").value;
    if(year === "" || sign === "") alert('Make your choices, Mate !')
    else{
        $.ajax({
        type: "POST",
        url: "api/v1/calender/create",
        data: { 
            _token: "{{ csrf_token() }}",
            zodiac_id: sign,
            year: year
        },
        success: function(data) {
            Swal.fire({
                title: '<strong>Your Future Lies Ahaed</strong>',
                icon: 'warning',
                html:`Are you ready to learn about it ?`,
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: true,
                reverseButtons: true,
                focusCancel: false,
                confirmButtonText:`Get Me In`,
                cancelButtonText:`May be Another Time`
                }).then((result) => {
                if (result.value) {
                    window.location.href = `/calender/`+year+'/'+sign
                }
                }); 
            console.log(data);
        
        },
        error: function(result) {
            alert(result);
        }
    });
}
});
</script>