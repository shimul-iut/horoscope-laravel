@extends('layout')

<div class="container">
<a href="/"><img src="/logos/twitter_header_photo_2.png" width="90%" height="100"></a>

<br>
<button class="btn" style="background-color:black;margin-top: 21px; padding: 5px;" data-year = {{$year}} id = "bestScoreBtn">Click to View the Best Zodiac of {{$year}}</button>
<br>

<div class="row">
  <div class="col">
      @php
        $name = $zodiac->name;
        $icon_url = "/zodiac/".lcfirst($name).".png";
        $astro_no = $zodiac->magic_number;
        $celebrities = $zodiac->celebrities;

        $dateObj   = DateTime::createFromFormat('!m', $bestMonth->month);
        $monthName = $dateObj->format('F');
      @endphp
      <img class="zodiac_img" style = "width:12%;" src="{{$icon_url}}">
      <h4>{{$name}}</h4>
      <h4>Best Month of {{$year}}: {{$monthName}} <span style="color:red;">({{$bestMonth->average}}/10)</span></h4>
  </div>
  <div class="col">
      <p>Trivia<p>
      <h5>Lucky Number: <span style="color : green;">{{$astro_no}} </span></h5>
      <h5>Notable People: <span style="color : green;">{{$celebrities}}</span> </h5>
  </div>
</div>
<h4 style="text-align:center;">Zodiac Calender for {{$name}} of {{$year}}</h4>
<h6 style="text-align:center;">Click on dates for your Fortune Cookie</h6>
<div class="row">
@foreach($zodiacYear as $date)  
  <div class="col">   
  <table bgcolor="lightgrey" align="center" 
        cellspacing="50" cellpadding="40">
  
        <caption align="top" style="text-align:center !important;">
        @php       
            $dateObj   = DateTime::createFromFormat('!m', $date->month);
            $monthName = $dateObj->format('F');
            echo $monthName;
            
        @endphp
        </caption>
        <caption align="top" style="text-align:center !important;">
        @php       
           
            echo "Average: ". $date->average;
        @endphp
        </caption>
        <thead>
            <tr>
                <th>Sun</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
            </tr>
        </thead>
          
        <tbody>
        <tr>
        @foreach($date->CalenderScore as $score)

       
                @if($score->day == 1)
                    @if(date('D', strtotime($score->day.'-'.$date->month.'-'.$year)) == "Sun")
                    <td class="fortune-finder" data-id="{{$score->id}}" style="background-color:{{$score->mark}};">{{$score->day}}</td>    
                    @endif
                    @if(date('D', strtotime($score->day.'-'.$date->month.'-'.$year)) == "Mon")
                        <td></td>
                        <td class="fortune-finder" data-id="{{$score->id}}" style="background-color:{{$score->mark}};">{{$score->day}}</td>    
                    @endif
                    @if(date('D', strtotime($score->day.'-'.$date->month.'-'.$year)) == "Tue")
                        <td></td>
                        <td></td>
                        <td class="fortune-finder" data-id="{{$score->id}}" style="background-color:{{$score->mark}};">{{$score->day}}</td>       
                    @endif
                    @if(date('D', strtotime($score->day.'-'.$date->month.'-'.$year)) == "Wed")
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="fortune-finder" data-id="{{$score->id}}" style="background-color:{{$score->mark}};">{{$score->day}}</td>    
                    @endif
                    @if(date('D', strtotime($score->day.'-'.$date->month.'-'.$year)) == "Thu")
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="fortune-finder" data-id="{{$score->id}}" style="background-color:{{$score->mark}};">{{$score->day}}</td>       
                        @endif
                    @if(date('D', strtotime($score->day.'-'.$date->month.'-'.$year)) == "Fri")
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="fortune-finder" data-id="{{$score->id}}" style="background-color:{{$score->mark}};">{{$score->day}}</td>      
                        @endif
                    @if(date('D', strtotime($score->day.'-'.$date->month.'-'.$year)) == "Sat")
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="fortune-finder" data-id="{{$score->id}}" style="background-color:{{$score->mark}};">{{$score->day}}</td>    
                        </tr>
                        <tr>
                    @endif
                @else
                    <td class="fortune-finder" data-id="{{$score->id}}" style="background-color:{{$score->mark}};">{{$score->day}}</td>      
                    @if(date('D', strtotime($score->day.'-'.$date->month.'-'.$year)) == "Sat")
                     </tr>
                    <tr>
                    @endif
                @endif  
            @endforeach
        
        </tbody>
    </table>
  </div>
@endforeach
</div>
<script>
    document.querySelectorAll('.fortune-finder').forEach(function(e){
        e.addEventListener('click', function(){
            id = this.dataset.id;

            $.ajax({
                type: "GET",
                url: "/api/v1/day/"+id,
                success: function (data) {
                    console.log(data.data.prophecy)
                    Swal.fire({
                        titleText: 'Score : ' + data.data.score,
                        text: data.data.prophecy,
                        icon : 'success',
                        confirmButtonText: 'Cool'
                    })
                }
            });
        });
    });
   document.getElementById("bestScoreBtn").addEventListener("click", function() {
    $(".bestScoreBtn").html("Loading");
        year = this.dataset.year
        $.ajax({
        type: "POST",
        url: "/api/v1/populate-all-zodiacs",
        data: { 
            _token: "{{ csrf_token() }}",
            year: year
        },
        success: function (data){
            $(".bestScoreBtn").html("Check again");
            Swal.fire({
                title: 'The Best Zodiac Sign for the Year '+year+ ' is "' +data[0].parent_zodiac['name']+ '" with total score of '+ data[0].total_score,
                icon: 'success',
                html: '"'+ data[1].parent_zodiac['name'] +'" comes close with ' + data[1].total_score+' points',
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: true,
                reverseButtons: true,
                focusCancel: false,
                confirmButtonText:`Go Find a New Sign to play with`,
                cancelButtonText:`Continue Exploring `+year 
                }).then((result) => {
                if (result.value) {
                    window.location.href = '/';
                }
                }); 
        }
       });
   });
</script>