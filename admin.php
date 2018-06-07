


<html>
    <head>
        <!--Scripts-->
            <script src="https://code.jquery.com/jquery-3.1.1.min.js"
                    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
            <script src="semantic/dist/semantic.min.js"></script>
            <script src="js/owl.carousel.min.js"></script>
            
            <!--Scripts-->
            <script src="assets/library/jquery.min.js"></script>
            <script src="assets/semantic/semantic.min.js"></script>
            <script src="assets/js/script.js"></script>

            <!--Styles-->
            <link rel="stylesheet" href="semantic/dist/semantic.min.css">
            <link rel="stylesheet" href="css/index.css">
            <link rel="stylesheet" href="css/owl.carousel.min.css">
            <link rel="stylesheet" href="css/owl.theme.default.min.css">
    </head>

<body>
    
        <!-- Webpage Content -->
    
        <div class="ui borderless menu" id="header">
                <div class="ui container"><a href="admin.php">
                        <div class="header item">
                            <img class="logo" src="assets/images/logo.png">
                            &nbsp;Admin Page
                        </div>
                        </a>
          
                        <a class="ui right floated dropdown item" id="dropdown">
                            Menu <i class="dropdown icon"></i>
                        <div class="menu">
                            <div class=" right item" id="login">Update Announcements or Events</div>
                            <div class="right item" id="logout">Logout</div>
                        </div>
                    </a>
              
            </div>
                </div>
    
        <div class="ui container" style="background-color: #f9f9f9">
            <div class="ui center aligned baic">

                
                
                <div class="ui container" align="center">
                    <img class="disabled Small ui image" align="center" src="img/logo.png">
                    <div class="ui horizontal divider">Customer logs</div>
                </div>

                
                <!-- Three headers --> 
                <div class="ui grid">
                    <div class="three column row">
                        <!-- First cell -->
                        <div class="column">
                            <div class="ui segment">
                                Number of Current Logged-In Users
                                <h1>
                                0
                                </h1>
                            </div>
                        </div>
                        <!-- Second cell -->
                        <div class="column">
                            <div class="ui segment">
                                Number of Logins Today
                                <h1>
                                0
                                </h1>
                            </div>
                            
                        </div>
                        <!-- Third cell -->
                        <div class="column">
                            <div class="ui segment">
                                Total Accounts Registered
                                <h1>
                                0
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Include php database here 

                -->
                
                
                <table class="ui striped selectable celled definition table">
                  <thead>
                    <tr>
                      <th></th> <!-- 7 Columns -->
                      <th>Full Name</th> 
                      <th>E-mail Address</th>
                      <th>Mobile Number</th>
                      <th>Organization</th>
                      <th>Time in</th>
                      <th>Time out</th>
                      <th>Status</th> 
                    </tr>
                  </thead>

                <tbody>
                    <!-- First Row --> 
                    <tr>
                      <td class="collapsing">
                        <div class="ui checkbox">
                          <input type="checkbox"> <label></label>
                        </div>
                      </td>
                      <td>John Weak</td>
                      <td>johnwick@gmail.com</td>
                      <td>9776827540</td>
                      <td>Yu-Si</td>
                      <td class="top aligned">
                          12-Hour format<br>
                          DD/MM/YY<br>
                      </td>
                      <td class="top aligned">
                          12-Hour format<br>
                          DD/MM/YY<br>
                      </td>
                        <td>Meme-ber</td>
                    </tr>
                    <!-- Second Row --> 
                    <tr>
                      <td class="collapsing">
                        <div class="ui checkbox">
                          <input type="checkbox"> <label></label>
                        </div>
                      </td>
                      <td>John Strong</td>
                      <td>johnwick@gmail.com</td>
                      <td>9776827540</td>
                      <td>Es-low</td>
                      <td class="top aligned">
                          12-Hour format<br>
                          DD/MM/YY<br>
                      </td>
                      <td class="top aligned">
                          12-Hour format<br>
                          DD/MM/YY<br>
                      </td>
                        <td>Drop-out</td>
                    </tr>
                    <!-- Third Row --> 
                    <tr>
                      <td class="collapsing">
                        <div class="ui checkbox">
                          <input type="checkbox"> <label></label>
                        </div>
                      </td>
                      <td>John Ka Magaling</td>
                      <td>johnwick@gmail.com</td>
                      <td>9776827540</td>
                      <td>Yu-Bee</td>
                      <td class="top aligned">
                          12-Hour format<br>
                          DD/MM/YY<br>
                      </td>
                      <td class="top aligned">
                          12-Hour format<br>
                          DD/MM/YY<br>
                      </td>
                        <td>Event Space</td>
                    </tr>
                  </tbody>
                  <tfoot class="full-width">
                    <tr>
                      <th></th>
                      <th colspan="8">
                        <div class="ui input focus">
                          <input placeholder="Search User Account..." type="text" id="userSearch" onkeyup="myFunction()">
                        </div>

                          <div class="ui right floated pagination menu">
                                <a class="icon item">
                                  <i class="left chevron icon"></i>
                                </a>
                                <a class="icon item">
                                  <i class="right chevron icon"></i>
                                </a>
                          </div>

                      </th>
                    </tr>
                  </tfoot>
                </table>

            </div>
        </div>
        <!-- page-content" -->
    <!-- page-wrapper -->

        <script>
            $('#menu')
                  .dropdown({
                    maxSelections: 3
                  })
                ;
                
            $(".sidebar-dropdown > a").click(function() {
              $(".sidebar-submenu").slideUp(200);
              if (
                $(this)
                  .parent()
                  .hasClass("active")
              ) {
                $(".sidebar-dropdown").removeClass("active");
                $(this)
                  .parent()
                  .removeClass("active");
              } else {
                $(".sidebar-dropdown").removeClass("active");
                $(this)
                  .next(".sidebar-submenu")
                  .slideDown(200);
                $(this)
                  .parent()
                  .addClass("active");
              }
            });
            $("#close-sidebar").click(function() {
              $(".page-wrapper").removeClass("toggled");
            });
            $("#show-sidebar").click(function() {
              $(".page-wrapper").addClass("toggled");
            });
        </script>

</body>
    
    </html>