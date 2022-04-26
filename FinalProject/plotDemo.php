<!DOCTYPE html>
<html>
    <?php 
        session_start();
        //echo "<script> const uid =" . $_SESSION['userid'] . "</script>";

    ?>
    <head>
        <title>
            Final Project Portal 
        </title>
        <meta name='viewport' content="width=device-width, initial-scale=1">
        
        <!-- Style taken from homepage -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="homepagestyle1.css">
        
        <!-- CDN for plotting -->
        <script src="https://cdn.plot.ly/plotly-2.11.1.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.js" 
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" 
        crossorigin="anonymous"></script>

        <!-- Functions -->
        <script>
            testUID = 1; 
            uid = testUID;
            ///////////////Database Querying Functions/////////////////////
            async function callAPI(queryString){
                return new Promise(function(resolve,reject){
                    request = new XMLHttpRequest();
                    url = "https://junxinggu.com/Final/queryDatabaseAPI.php?";
                    url += "time=" + Date.now();
                    url += queryString; 
                    request.open("GET", url, true);
                    request.send();
                    request.onreadystatechange = function(){
                        if (request.readyState == 4 && request.status == 200){
                          resolve(this.responseText);
                        }
                        else if (request.readyState == 4 && request.status != 200){
                            console.log("Failed to connect to API - try again later");
                        }
                    }});
                }           

                async function queryDatabase(metric, when, uid){
                    query = "&metric=" + metric + "&when=" + when + "&uid=" + 
                    uid;
                    value = await callAPI(query);
                    return value;
                }
                
                //Need to query database directly here TODO 
                function initializeTargets(uid){
                        // target = new Array();
                        <?php
                        $server = "localhost";
                        $userid = "uo8hchpccgagq";
                        $pw = "hhxxttxs";
                        $db= "db3guheulakj3q";

                        $conn = new mysqli($server, $userid, $pw);

                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                        }

                        $conn->select_db($db);

                        $SQLQuery = "SELECT target_cal, target_fat, target_carbs, target_protein FROM users WHERE userid=";
                        $SQLQuery .= $_SESSION['userid'];

                        //query database
                        $results = $conn->query($SQLQuery);
                        $target = [];

                        if ($results->num_rows > 0) {
                            $row = $results->fetch_assoc();
                            $target['calories'] = $row['target_cal'];
                            $target['fat'] = $row['target_fat'];
                            $target['carbs'] = $row['target_carbs'];
                            $target['protein'] = $row['target_protein']; 
                        }
                        $conn->close();
                        return $target; 
                        ?>
                }
                
                //Not Tested - need async? 
                async function totalMetric(metric, when){
                    return await queryDatabase(metric,when,testUID);
                }
        </script>

        <!-- Plotting Functions -->
        <script>
            //Config params for plotting
            var config = {responsive:true, showAxisDragHandles:false, displayModeBar:false};
           
            async function updateProgress(metric, when){
                // currTotal = await totalMetric(metric.toLowerCase(), when);
                // alert(currTotal);
                target = targets[metric.toLowerCase()];
                currTotal = await totalMetric(metric.toLowerCase(), when)*1;//converts null to int
                metricName = metric;
                
                var config = {responsive:true, showAxisDragHandles:false, 
                              displayModeBar:false};
                thePlot = document.getElementById("progressBar");
                remainingMetric = target-currTotal;
                metric = currTotal;
                //remainingMetric < 0 means exceeded
                if (remainingMetric < 0){
                    actualMetric = {
                        x: [metricName],
                        y: [target],
                        name: 'Target',
                        type: 'bar',
                        text: target,
                        textposition: 'auto',
                        marker: {
                            color:['rgba(0,255,0,1)']
                        }
                        
                    };
                    targetMetric = {
                        x: [metricName],
                        y: [Math.abs(remainingMetric)],
                        text: Math.abs(remainingMetric),
                        textposition: 'auto',
                        name: 'Over',
                        type: 'bar',
                        marker: {
                            color:['rgba(255,0,0,1)']
                        }
                    };
                }
                //Not yet met target 
                else{
                    actualMetric = {
                        x: [metricName],
                        y: [currTotal],
                        text: currTotal,
                        textposition: 'outside',
                        name: 'Actual',
                        type: 'bar'
                    };
                    targetMetric = {
                        x: [metricName],
                        y: [target-currTotal],
                        text: target-currTotal,
                        textposition: 'auto',
                        name: 'Remaining',
                        type: 'bar'
                    };
                    
                }
                yMax = currTotal > target ? 
                    (parseInt(currTotal)*1.1) : (parseInt(target)*1.1); 
                data = [actualMetric, targetMetric];
                layout = {barmode: 'relative', title: "Today's " + metricName +
                          ": " + currTotal, 
                          yaxis: {fixedrange:true, range:[0,yMax]}, 
                          xaxis: {fixedrange:true}};

                Plotly.newPlot(thePlot, data, layout, config);
            }
            //To remove
            // function plotProgress(currTotal, target, metricName){
            //     var config = {responsive:true, showAxisDragHandles:false, 
            //                   displayModeBar:false};
            //     thePlot = document.getElementById("progressBar");
            //     remainingMetric = target-currTotal;
            //     metric = currTotal;
            //     //remainingMetric < 0 means exceeded
            //     if (remainingMetric < 0){
            //         actualMetric = {
            //             x: [metricName],
            //             y: [target],
            //             name: 'Target',
            //             type: 'bar',
            //             text: target,
            //             textposition: 'auto',
            //             marker: {
            //                 color:['rgba(0,255,0,1)']
            //             }
                        
            //         };
            //         targetMetric = {
            //             x: [metricName],
            //             y: [Math.abs(remainingMetric)],
            //             text: Math.abs(remainingMetric),
            //             textposition: 'auto',
            //             name: 'Over',
            //             type: 'bar',
            //             marker: {
            //                 color:['rgba(255,0,0,1)']
            //             }
            //         };
            //     }
            //     //Not yet met target 
            //     else{
            //         actualMetric = {
            //             x: [metricName],
            //             y: [currTotal],
            //             text: currTotal,
            //             textposition: 'outside',
            //             name: 'Actual',
            //             type: 'bar'
            //         };
            //         targetMetric = {
            //             x: [metricName],
            //             y: [target-currTotal],
            //             text: target-currTotal,
            //             textposition: 'auto',
            //             name: 'Remaining',
            //             type: 'bar'
            //         };
                    
            //     }
            //     yMax = currTotal > target ? 
            //         (parseInt(currTotal) + 200) : (parseInt(target) + 200); 
            //     data = [actualMetric, targetMetric];
            //     layout = {barmode: 'relative', title: "Today's " + metricName +
            //               ": " + currTotal, 
            //               yaxis: {fixedrange:true, range:[0,yMax]}, 
            //               xaxis: {fixedrange:true}};

            //     Plotly.newPlot(thePlot, data, layout, config);
            // }

            //Generates pie chart of the calorie breakdown by metric
            async function plotBreakdown(when){
                fatCalories = await totalMetric("fat", when)*9; //Approx 9 cal per g fat
                carbCalories = await totalMetric("carbs", when)*4;
                proteinCalories = await totalMetric("protein", when)*4;
                //Add more variables if necessary

                totalCalories = fatCalories + carbCalories + proteinCalories; 

                if (totalCalories <= 0){
                    $("#noBreakdown").attr("style","display:block");
                    $("#dailyBreakdown").attr("style","display:none");
                    return;
                }
                fatPercentage = fatCalories/totalCalories;
                carbPercentage = carbCalories/totalCalories;
                proteinPercentage = proteinCalories/totalCalories;

                data = [{
                    values: [fatPercentage, carbPercentage, proteinPercentage],
                    labels: ["Fat", "Carbs", "Protein"],
                    type: "pie",
                    name:'Calorie Breakdown',
                    hole: 0.4,
                    automargin:true,
                    textposition: 'inside'
                }];
                layout = {
                    title:"Calorie Breakdown",
                    annotations: {
                        font:{size:20},
                        showarrow: false,
                        text: totalCalories,
                        x: 0.17,
                        y: 0.5
                    }
                };
                $("#noBreakdown").attr("style","display:none");
                $("#dailyBreakdown").attr("style","display:block");
                var config = {responsive:true, displayModeBar:false,
                              staticPlot:true};
                target = document.getElementById("dailyBreakdown");
                await Plotly.newPlot(target,data,layout, config);
            }

            //plots a bar chart of the week of the metric specified. 
            //plotOverTime('Calories', '04/11/2022') generates a plot of 
            //daily total calories for 8 days from 4/4 to 4/11

            //DEPRECIATED
            // function plotOverTime(metric, when){
            //     target = document.getElementById("overTime");
            //     metricTarget = [];
            //     totalMetricValue = [];
            //     remainingMetric = [];
            //     barColor = [];//
            //     for (i = 0; i<8; i++){
            //         metricTarget[i] = targets[metric];
            //         totalMetricValue[i] = totalMetric(metric, when);
            //         remainingMetric[i] = metricTarget[i]-totalMetricValue[i];
            //         barColor[i] = remainingMetric[i] < 0 ? 'rgba(255,0,0,1)' : 'rgba(0,0,255,1)';
            //         remainingMetric[i] = Math.abs(remainingMetric[i]);
            //     }
            //     //Exceeded target 
            //         actualMetric = {
            //             //X array updated when date parser built 
            //             x: ["Day 1", "Day 2" ,"Day 3", "Day 4", "Day 5", "Day 6" , "Day 7", "Today"],
            //             y: metricTarget,
            //             name: 'Target',
            //             type: 'bar',
            //             marker: {
            //                 color:['rgba(0,255,0,1)','rgba(0,255,0,1)','rgba(0,255,0,1)','rgba(0,255,0,1)',
            //                 'rgba(0,255,0,1)','rgba(0,255,0,1)','rgba(0,255,0,1)','rgba(0,255,0,1)']
            //             }
                        
            //         };
            //         targetMetric = {
            //             x: ["Day 1", "Day 2" ,"Day 3", "Day 4", "Day 5", "Day 6" , "Day 7", "Today"],
            //             y: remainingMetric,
            //             name: 'Actual',
            //             type: 'bar',
            //             marker: {
            //                 color:barColor
            //             }
            //         };
                
            //     data = [actualMetric, targetMetric];
            //     var config = {responsive:true}
            //     layout = {barmode: 'relative', title: metric + "Over Time"};
            //     Plotly.newPlot(target, data, layout,config);
            // }

        // <!-- https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input/date -->

        </script>


        <script>
            // <!-- Page initialization and Event Listeners -->

            targets = initializeTargets(testUID);
            //Event listener scripts: 
            $(document).ready(async function(){
                
                //Initialization of date
                todayDate = new Date();
                date = todayDate.getDate();
                if (date<10){
                    date = "0" + date;
                }
                month = todayDate.getMonth() + 1;
                if (month<10){
                    month = "0" + month;
                }
                year = todayDate.getFullYear();
                todayDate = year + "-" + month + "-" + date;
                
                //Attach default value to calendars
                $("#breakdownCalendar, #overTimeCalendar").attr("value", todayDate);

                //Plot initial 
                await plotBreakdown(todayDate);
                await updateProgress("Calories", todayDate);
                //plotOverTime("calories",todayDate);


                //Event Listeners
                $("#progressSelect").change(function(){
                    updateProgress($("#progressSelect").val(), todayDate);
                });

                $("#breakdownCalendar").change(function(){
                    plotBreakdown($("#breakdownCalendar").val());
                });

                // $("#overTimeCalendar, #overTimeSelectMetric").change(function(){
                //     plotOverTime($("#overTimeSelectMetric").val(), $("overTimeSelectTime").val());
                // });


                //Plotting Tester Inputs
                // $("#enterProgressTester").click(function(){
                //     testValue = $("#progressTester").val();
                //     testMetric = $("#progressSelect").val();
                //     plotProgress(testValue, targets[testMetric.toLowerCase()],testMetric);
                // })
            });
        </script>
        <style>
            .box{
                display:flex;
                flex-direction: row;
                justify-content: center;
                width:100%;
                box-sizing: content-box;
            }
            .plot{
                width:100%;
                box-sizing: content-box;
                max-width:600px;
                padding:5%;
            }
            @media (max-width:600px){
                .box{
                    flex-direction:column;
                }
            }
        </style>
        </head>

    <body>

        <!-- General Page Elements -->
        <div class="navbar">
            <a href="https://jluo01.github.io/CS20Projects/HomePage/homepage.html">
                <button class="logo"></button>
            </a>
            <!-- Navbar here needs to be redone for the post-login content -->
            <nav class="navbar-text">
                <ul>
                    <li><a href="#container">Home</a></li>
                    <li><a href="#profile">About&nbspUs</a></li>
                    <li><a href="#feature1">Service</a></li>
                    <li><a href="#contact">Contact&nbspUs</a></li>
                </ul>
            </nav>
    
            <div class="hamburger">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
            
        </div>


        <!-- Plot Elements -->
        <div class = "box">
            <div class="plot">
                <div id = "progressBar" ></div>
                <form>
                    <!-- <input type = "text" id = "progressTester" style = "border:solid black 1px">
                    <input type = "button" id = "enterProgressTester" style = "border:solid black 5px"> -->
                    <select id = "progressSelect">
                        <option>Calories</option>
                        <option>Fat</option>
                        <option>Protein</option>
                        <option>Carbs</option>
                    </select>
                </form>
            </div>
            <div class="plot"class="plot">
                <div id = "noBreakdown" style = "display:none">Nothing for today: please log</div>
                <div id = "dailyBreakdown"></div>
                <form>
                    <input type = "date" id = "breakdownCalendar" >
                </form>
            </div>
            <!-- <div class="plot">
                <div id = "overTime"></div>
                <form>
                    <input type = "date" id = "overTimeCalendar" >
                    <select id = "overTimeSelectMetric">
                        <option>Calories</option>
                        <option>Fat</option>
                        <option>Protein</option>
                        <option>Carbs</option>
                    </select>
                </form>
            </div> -->

            <script type="text/javascript">
                const hamburger = document.querySelector(".hamburger");
                const navMenu = document.querySelector(".navbar-text");
        
                hamburger.addEventListener("click", mobileMenu);
        
                function mobileMenu() {
                   hamburger.classList.toggle("active");
                navMenu.classList.toggle("active");
                }
        
            </script>
        </div>

        <div class="companyinfo">
            <div>Logo</div>
            <div>Our Number: +1 1234567</div>
            <div>Email: ciao@logo.com</div>
            <div>Address: 389 Boston Ave, Meford, MA</div>
        </div>

    </body>
</html>