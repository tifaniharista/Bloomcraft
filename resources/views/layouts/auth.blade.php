<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>
@yield('title')
</title>



<style>


*{

margin:0;
padding:0;
box-sizing:border-box;

}



body{

font-family:Arial, Helvetica, sans-serif;

background:#fafafa;

color:#222;

}





.auth-page{


min-height:100vh;

display:flex;

justify-content:center;

align-items:center;

padding:40px;


}





.auth-box{


width:420px;

background:white;

padding:45px;

border-radius:20px;

box-shadow:
0 20px 50px rgba(0,0,0,.08);


}





.logo{


text-align:center;

font-family:Georgia,serif;

font-size:34px;

margin-bottom:35px;


}




.auth-header{


text-align:center;

margin-bottom:35px;


}




.auth-label{


font-size:12px;

letter-spacing:4px;

color:#999;

margin-bottom:20px;


}





.auth-header h1{


font-family:Georgia,serif;

font-size:42px;

font-weight:400;

margin-bottom:15px;


}




.auth-header p{


color:#777;

line-height:1.6;


}





.form-group{


margin-bottom:20px;


}





.form-group label{


display:block;

font-size:13px;

margin-bottom:8px;

letter-spacing:1px;


}





.form-group input{


width:100%;

padding:15px;

border:1px solid #ddd;

font-size:14px;


}





.auth-button{


width:100%;

padding:15px;

background:#222;

color:white;

border:none;

cursor:pointer;

letter-spacing:2px;

margin-top:10px;


}



.auth-button:hover{


background:#000;


}





.remember-row{


margin-bottom:20px;

font-size:13px;


}





.auth-footer{


text-align:center;

margin-top:25px;

font-size:14px;

color:#777;


}




.auth-footer a{


color:#222;

text-decoration:underline;


}


.back-dashboard{


display:block;

text-align:center;

margin-top:25px;

padding:12px;

border:1px solid #ddd;

border-radius:30px;

text-decoration:none;

color:#333;

font-size:14px;

transition:.3s;


}



.back-dashboard:hover{


background:#222;

color:white;


}


.alert{


padding:15px;

margin-bottom:20px;

border-radius:10px;

font-size:14px;


}




.error{


background:#fee2e2;

color:#991b1b;


}



.success{


background:#dcfce7;

color:#166534;


}




</style>
<link rel="stylesheet" href="{{ asset('assets/css/bloomcraft.css') }}">


</head>



<body>



<div class="auth-page">



<div class="auth-box">



<div class="logo">

Bloomcraft

</div>

@yield('content')



@if(Auth::check() && Auth::user()->role == 'admin')


<a
href="{{ route('admin.dashboard') }}"
class="back-dashboard">

← Kembali ke Dashboard Admin

</a>



@else


<a
href="{{ route('home') }}"
class="back-dashboard">

← Kembali ke Website

</a>



@endif

</div>



</div>




</body>


</html>
