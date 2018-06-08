


<html>
    <head>
        <title> Calle Uno: Admin Page (Announcement and Events)</title>
        <!-- Standard Meta -->
        <meta charset="utf-8">
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        
        <!--Scripts-->
            <script src="https://code.jquery.com/jquery-3.1.1.min.js"
                    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
            <script src="semantic/dist/semantic.min.js"></script>
            <script src="js/owl.carousel.min.js"></script>
            
            <!--Scripts-->
            <script src="assets/library/jquery.min.js"></script>
            <script src="assets/semantic/semantic.min.js"></script>
            <script src="assets/js/script.js"></script>
                <!-- calendar -->
                <script type="text/javascript" src="/bower_components/semantic-ui-calendar/dist/calendar.min.js"></script>
                <link rel="stylesheet" href="/bower_components/semantic-ui-calendar/dist/calendar.min.css" />

            <!--Styles-->
            <link rel="stylesheet" href="semantic/dist/semantic.min.css">
            <link rel="stylesheet" href="css/index.css">
            <link rel="stylesheet" href="css/owl.carousel.min.css">
            <link rel="stylesheet" href="css/owl.theme.default.min.css">
        
            <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
            <link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />

            
            <script>
                
                    $('#menu')
                          .dropdown({
                            maxSelections: 3
                          })
                        ;
                    $('.ui.dropdown')
                      .dropdown()
                    ;
                    $('#example1').calendar();
                    $('#example2').calendar({
                      type: 'date'
                    });
                    $('#example3').calendar({
                      type: 'time'
                    });
                    $('#rangestart').calendar({
                      type: 'date',
                      endCalendar: $('#rangeend')
                    });
                    $('#rangeend').calendar({
                      type: 'date',
                      startCalendar: $('#rangestart')
                    });
                    $('#example4').calendar({
                      startMode: 'year'
                    });
                    $('#example5').calendar();
                    $('#example6').calendar({
                      ampm: false,
                      type: 'time'
                    });
                    $('#example7').calendar({
                      type: 'month'
                    });
                    $('#example8').calendar({
                      type: 'year'
                    });
                    $('#example9').calendar();
                    $('#example10').calendar({
                      on: 'hover'
                    });
                    var today = new Date();
                    $('#example11').calendar({
                      minDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() - 5),
                      maxDate: new Date(today.getFullYear(), today.getMonth(), today.getDate() + 5)
                    });
                    $('#example12').calendar({
                      monthFirst: false
                    });
                    $('#example13').calendar({
                      monthFirst: false,
                      formatter: {
                        date: function (date, settings) {
                          if (!date) return '';
                          var day = date.getDate();
                          var month = date.getMonth() + 1;
                          var year = date.getFullYear();
                          return day + '/' + month + '/' + year;
                        }
                      }
                    });
                    $('#example14').calendar({
                      inline: true
                    });
                    $('#example15').calendar();
            
            </script>
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
                            <div class="right item" id="login">Home</div>
                            <div class="right item" id="login">Payments</div>
                            <div class="right item" id="logout">Logout</div>
                        </div>
                    </a>
              
            </div>
                </div>
    
        <div class="ui container" style="background-color: #f9f9f9">
            <div class="ui center aligned basic">

                <div class="ui container" align="center">
                    <img class="disabled Small ui image" align="center" src="img/logo.png">
                    <div class="ui horizontal divider">Announcement and Events</div>
                </div>
                
                <!-- Main content -->
                <div class="ui one column doubling stackable grid container">
                  <div class="column">
                    <form class="ui form">
                      <h3 class="ui dividing header">Create new announcement or event</h3>
                      <div class="field">

                        <div class="three fields">
                          
                              <!-- Title input (First field in the first row) -->
                              <div class="field">
                                <label>Title</label>
                                <input name="shipping[last-name]" placeholder="Enter Title" type="text">
                              </div>
                            

                            
                          <!-- Dropdown for Type of event -->
                              <div class=" field">
                              <label>Type</label>
                              <div class="ui selection dropdown left icon">
                                    <input type="hidden" name="purpose">
                                    <i class="id badge outline icon"></i>
                                    <div class="default text grey">Default</div>
                                    <i class="dropdown icon"></i>
                                    <div class="menu">
                                        <div class="item" data-value="Regular Member">Announcement</div>
                                        <div class="item" data-value="Drop-in Coworking">Event</div>
                                    </div>
                                </div>
                            </div>
                             
                                   
                          <!-- Month Field -->
                          <div class="nine wide field">
                              <label>Event description</label>
                              <div class="fields">
                              <textarea rows="3" placeholder="Enter event description" name="eventDesc" type="message" id="eventDesc"></textarea>
                          
                              </div>
                          </div>
                            <!-- Dropdown for Type of event -->
                            
                 
                        
                        
                       
                    </div>
                    <h3 class="ui dividing header">Duration</h3>
                    <div class="ui field">
                            <div class="field">
                                <div class="ui form">
                                <div class="three fields">
                                    <div class="three wide field">
                                    <label>Start date</label>
                                    <div class="ui calendar" id="rangestart">
                                        <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" placeholder="Start">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="three wide field">
                                    <label>End date</label>
                                    <div class="ui calendar" id="rangeend">
                                        <div class="ui input left icon">
                                        <i class="calendar icon"></i>
                                        <input type="text" placeholder="End">
                                        </div>
                                    </div>
                                    </div>
                                    
                                    <div class="field">
                                    <label> Upload File...</label>
                                    </div>
                                </div>
                                </div>
                                <br/>
                                

                            </div>
                            
                           
                            
                    </div>
                          
                </div>
              </form>
            </div>
        </div>
        <!-- page-content" -->
    <!-- page-wrapper -->

        
            </div>
    </div>
</body>
    
    </html>