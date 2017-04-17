<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Blog</title>
</head>
<body>
<div class="container" id="app">

    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/">
                        The Blog
                    </a>
                </div>

            </div>
        </nav>
    </header>

    <div>
        <div class="page-header">
            <h1>Blog Posts <br /> <small>insert awesome subtitle here!</small></h1>
        </div>
        <blog-posts></blog-posts>
    </div>

</div>


<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css" async />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}" async/>
<script type="text/javascript" src="{{ URL::asset('js/app.js') }}" async></script>
<script src="https://cdn.jsdelivr.net/vue.resource/1.3.1/vue-resource.min.js"></script>
</body>
</html>