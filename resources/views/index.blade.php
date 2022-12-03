<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet"href="https://fonts.googleapis.com/css?family=Tangerine">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <style>
        /* div{
            border: 2px solid red;
        } */
        body{
            background-color:#BDE0FE;
        }
    .center {
                margin: auto;
                width: 60%;
                border: 3px solid #73AD21;
                padding: 10px;
            }
        h3 {
                font-family: 'Tangerine', serif;
                font-size: 58px;
            }
        p{
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body>
        <div class="container-fluid">
                <div class="row gx-3 gy-5">
                    <div class="col-5">
                    
                        @if ($errors->any())
                            @foreach ( $errors->all() as $error)
                                <li class="alert alert-danger my-3" style="list-style: none;width:70%">{{ $error }}</li>
                            @endforeach
                         @endif
                         @if (session()->has('message'))
                         <li class="alert alert-success my-3" style="list-style: none;width:90%">{{ session("message")}}</li>
                         @endif
                            <h3>Content</h3>
                            <form action="/submitcontent" method="POST" enctype="multipart/form-data">
                                @csrf
                            
                                    <div class="form-group">
                                            <label for="content">Word Content/Link</label>
                                            <textarea name="content" rows="5" cols="10" class="form-control"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="file">Any file attachment
                                            <input type="file" name="file" class="form-control">
                                        </label>
                                    
                                    </div>
                                    <p style="font-size:24px;">Paste your content above <i class="fa fa-exclamation" style="font-size:24px;color:blue"></i></p>
                                <button type="submit" class="btn btn-primary" >Submit</button>
                            </form>
                            
                    </div>

                    <div class="col-4 mx-3">
                           
                           <div class="row gx-5 gy-5">
                            <div class="col-12">
                                    <h3>Retrieve Content</h3> 
                                    @if (Session::has('result'))
                                       @if (session('result')['content'])
                                       <div class="form-group">
                                        <label for="content-ret">Word Content/Link</label>
                                        <textarea name="content-ret" rows="5" cols="10" class="form-control">{{ session('result')['content'] }}</textarea>
                                        </div>
                                       @endif

                                       @if (session('result')['file_url'] != "no image")
                                           <form action="{{ route('download') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                                <input type="text"  value="{{ session('result')['file_url'] }}" name="image_url" hidden>
                                                <button class="btn btn-info my-3">Download File Here</button>
                                           </form>
                                       @endif
                                    @endif

                                    <form action="{{ route('getcontent') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                            <div class="form-group">
                                                    <label for="code">Retrieval Code</label>
                                                    <input type="text" class="form-control" name="code">
                                            </div>
                                            <p class="words" style="font-size:24px;">Paste your retrieval code above <i class="fa fa-exclamation" style="font-size:24px;color:blue"></i></p>
                                            <button type="submit" class="btn btn-primary" >Retrieve</button>
                                    </form>
       
                            </div>
                    </div>
                </div>
        </div>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>

</body>
</html>