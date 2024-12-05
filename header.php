<!DOCTYPE html>
<html lang="en">
<head>
    <script src="/docs/5.3/assets/js/color-modes.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="pages/home/wave.css">
    <link rel="stylesheet" href="pages/home/classic.css">
    <link rel="stylesheet" href="pages/home/window.css">
    <link rel="stylesheet" href="pages/home/product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="home" viewBox="0 0 16 16">
          <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"></path>
        </symbol>
        <symbol id="speedometer2" viewBox="0 0 16 16">
          <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z"></path>
          <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z"></path>
        </symbol>
        <symbol id="table" viewBox="0 0 16 16">
          <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"></path>
        </symbol>
        <symbol id="people-circle" viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"></path>
          <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"></path>
        </symbol>
        <symbol id="grid" viewBox="0 0 16 16">
          <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z"></path>
        </symbol>
        <symbol id="hcmut" viewBox="0 0 892 904">
            <path transform="translate(0)" d="m0 0h892v904h-892z" fill="#FEFEFE"/>
            <path transform="translate(443)" d="m0 0h449v753l-1 16v4l-7-2-89-52-14-8-17-10-25-15-25-14-13-8-21-12-12-7-1-257-13-8-26-15-28-16-13-8-11-6-14-8-24-14-15-9-28-16-24-14-23-13-6 1-14 8-24 14-28 16-41 24-28 16-26 15-17 10-26 15-11 6h-3l-1-3v-254l8-5 30-18 21-12 26-15 20-11 15-9 22-13 21-12 52-30 4-2z" fill="#108CDE"/>
            <path transform="translate(0)" d="m0 0h443l-1 3-22 12-17 10-52 30-25 15-22 12-24 14-28 16-16 10-12 7v254l1 4v221l1 39 23 12 20 12 25 14 22 13 26 15 27 16 21 12 18 10 36 21-1 5-13 8-18 10-13 8-25 14-24 14-21 12-13 8-25 14-10 6-41 24-14 8-1 1h-225z" fill="#108CDE"/>
            <path transform="translate(448)" d="m0 0h444v518l-14-8-25-14-16-10-21-12-20-12-21-12-17-10-25-15-44-26-19-11-1-1v-258l-5-2-18-10-27-16-26-15-22-13-46-26-41-24-35-20z" fill="#FEFEFE"/>
            <path transform="translate(0)" d="m0 0h443l-1 3-22 12-17 10-52 30-25 15-22 12-24 14-28 16-16 10-12 7-1 258-10 7-28 16-26 15-24 14-42 24-45 26-46 27h-2z" fill="#FEFEFE"/>
            <path transform="translate(668,645)" d="m0 0 14 7 24 14 26 15 24 14 17 10 15 9 23 13 22 13 48 28 10 5-1-10 1-10h1v151h-667l4-4 22-12 18-11 21-12 24-14 14-8 13-8 25-14 24-14 21-12 17-10 14-8 2-4 7-3 25-14 10-6 26-15 18-10 15-9 28-16 22-13 26-15 23-13 13-8z" fill="#108CDE"/>
            <path transform="translate(221,648)" d="m0 0h7l26 14 15 9 25 14 22 13 26 15 27 16 21 12 18 10 36 21-1 5-13 8-18 10-13 8-25 14-24 14-21 12-13 8-25 14-10 6-41 24-14 8-5 1-3-3-10-5-20-12-29-17-32-19-15-9-20-11-18-11-19-11-15-9-26-15-11-8 1-3 22-12 17-10 14-8 17-10 27-15 21-12 15-9 25-14 23-13 24-14z" fill="#022996"/>
            <path transform="translate(442,2)" d="m0 0h3v257l-4 4-13 7-24 14-28 16-41 24-28 16-26 15-17 10-26 15-11 6h-3l-1-3v-254l8-5 30-18 21-12 26-15 20-11 15-9 22-13 21-12 52-30z" fill="#022996"/>
            <path transform="translate(669,389)" d="m0 0 6 1 23 13 20 12 32 19 15 9 24 14 21 12 20 12 22 13 24 14 15 9 1 1v235l-1 16v4l-7-2-89-52-14-8-17-10-25-15-25-14-13-8-21-12-11-6z" fill="#022996"/>
            <path transform="translate(445,775)" d="m0 0 5 1 13 8 23 13 17 10 11 6 17 10 11 6 26 15 10 6 27 15 24 14 20 12 11 6 8 4 5-1 23-13 43-25 77-44 18-10 14-8 24-14 18-11h2v129h-667l4-4 22-12 18-11 21-12 24-14 14-8 13-8 25-14 24-14 21-12 17-10 14-8z" fill="#FEFEFE"/>
            <path transform="translate(294,389)" d="m0 0h82l15 2 12 5 7 6 7 11 4 13-1 13-4 10-9 10-5 4-1 2 9 3 9 8 5 8 4 11v17l-5 14-7 9-8 8-9 4-14 2-43 1h-47l-1-1z" fill="#022D99"/>
            <path transform="translate(0,773)" d="m0 0 5 2 21 13 23 13 13 8 24 14 15 9 11 6 17 10 32 19 29 17 25 15 6 3v2h-221z" fill="#FEFEFE"/>
            <path transform="translate(491,388)" d="m0 0h6l1 1 1 66 19-19 9-11 8-8 7-8 16-17 3-3 42-1 2 2-9 10-24 24-7 8-12 13-6 6 2 5 10 16 7 11 14 21 16 25 12 18-1 2-17 1h-23l-4-4-15-27-16-27-9-15-3 1-7 8-14 14-1 49-1 1h-32l-1-1v-160z" fill="#022D99"/>
            <path transform="translate(589,578)" d="m0 0 17 1 1 1v61l-1 1h-8l-4-1-1-38-9 36-2 3h-11l-3-5-7-29-3-3 1 4v32l-1 1h-8l-4-1v-61l1-1h17l3 3 7 26 2 8 2-4 7-27 2-6z" fill="#108CDE"/>
            <path transform="translate(329,479)" d="m0 0h33l15 2 9 4 7 8 1 2v12l-5 9-5 3-10 2-46 1v-42z" fill="#FEFEFE"/>
            <path transform="translate(353,578)" d="m0 0h20l15 2 6 4 4 6 2 7v7l-4 7-7 6-9 2-14 1-1 21-1 1h-12l-1-1v-60z" fill="#108CDE"/>
            <path transform="translate(422,579)" d="m0 0h13l1 23h23v-22l1-1h12v63h-12l-1-1-1-25h-22l-1 26h-13l-1-1v-61z" fill="#108CDE"/>
            <path transform="translate(328,417)" d="m0 0h44l9 2 6 7v14l-5 8-9 3-15 1h-30z" fill="#FEFEFE"/>
            <path transform="translate(509,577)" d="m0 0 10 1 10 6 7 9-1 4-8 3-4-2-7-6-2-1h-9l-6 5-3 8v13l4 10 5 3h9l6-4 5-7 9 1 2 2-1 7-8 9-6 4-8 2-9-1-10-5-5-5-5-8-2-6v-17l3-9 6-8 7-5z" fill="#108CDE"/>
            <path transform="translate(304,578)" d="m0 0h38l2 1v11l-1 1h-17v50l-1 1h-11l-2-2v-49h-16l-2-2v-9l1-1z" fill="#108CDE"/>
            <path transform="translate(365,590)" d="m0 0h8l9 2 3 3 1 5-2 4-5 2-12 1-2-1z" fill="#FEFEFE"/>
            <path transform="translate(400,628)" d="m0 0h10l1 1v12l-1 1h-11l-2-2v-8l1-3z" fill="#108CDE"/>
        </symbol>
      </svg>
    
        <!-- header-->
    <header>
        <div class="px-3 py-2 bg-light bg-gradient text-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
                <svg class="bi me-2" width="80" height="60" role="img" aria-label="Hcmut"><use xlink:href="#hcmut"></use></svg>
            </a>
    
            <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                <li>
                <a href="index.php?page=home" class="nav-link text-secondary" >
                    <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#home"></use></svg>
                    Home
                </a>
                </li>
                <li>
                <a href="index.php?page=dashboard" class="nav-link text-dark">
                    <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#speedometer2"></use></svg>
                    Dashboard
                </a>
                </li>
                <li>
                <a href="index.php?page=buy_history" class="nav-link text-dark">
                    <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#table"></use></svg>
                    Buy History
                </a>
                </li>
                <!-- Update the product dropdown menu -->
                <li class="nav-item dropdown">
                    <a href="index.php?page=products" class="nav-link text-dark dropdown-toggle" data-bs-toggle="dropdown">
                        <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#grid"></use></svg>
                        Product
                    </a>
                    <div class="dropdown-menu">
                        <a href="index.php?page=products&category=Electronics" class="dropdown-item">Electronics</a>
                        <a href="index.php?page=products&category=Clothing" class="dropdown-item">Clothing</a>
                        <a href="index.php?page=products&category=Home" class="dropdown-item">Home & Garden</a>
                        <hr>
                        <a href="index.php?page=products" class="dropdown-item">All Products</a>
                    </div>
                </li>
                <li>
                <a href="index.php?page=student" class="nav-link text-dark">
                    <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#people-circle"></use></svg>
                    Account
                </a>
                </li>
            </ul>
            </div>
        </div>
        </div>
    </header>
      <!-- Sources-->
      <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      <script src="pages/home/moveeye.js"></script>
