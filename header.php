<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <!-- loading icon  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- jquery /ajax -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" 
    crossorigin="anonymous"></script>
    <!-- date jquery -->
      <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">

      <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

      <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

      
    <!-- modal script -->
    <script>
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
     <script>                        
        $(function () {
            var dateToday = new Date();
            $("#schedule, #schedule_upd").datepicker({
                minDate: dateToday
            });
        });
    </script>
    <!-- <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script> -->
    <!-- filter script  -->
    <script>
        function myfilter(){
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr =table.getElementsByTagName("tr");
            for(i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if(td) {
                    txtValue = td.textContent || td.innerText;
                    if(txtValue.toUpperCase().indexOf(filter) > -1){
                        tr[i].style.display = "";
                    }else{
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
        <!-- sort table  -->
        <script>
            function sortTable() {
            var table, rows, switching, i, x, y, shouldSwitch;
            table = document.getElementById("myTable");
            switching = true;
            /*Make a loop that will continue until
            no switching has been done:*/
            while (switching) {
                //start by saying: no switching is done:
                switching = false;
                rows = table.rows;
                /*Loop through all table rows (except the
                first, which contains table headers):*/
                for (i = 1; i < (rows.length - 1); i++) {
                //start by saying there should be no switching:
                shouldSwitch = false;
                /*Get the two elements you want to compare,
                one from current row and one from the next:*/
                x = rows[i].getElementsByTagName("TD")[0];
                y = rows[i + 1].getElementsByTagName("TD")[0];
                //check if the two rows should switch place:
                if (Number(y.innerHTML) > Number(x.innerHTML)) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
                }
                if (shouldSwitch) {
                /*If a switch has been marked, make the switch
                and mark that a switch has been done:*/
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                }
            }
            }
        </script>
          <!-- pagination -->
          <script>
            $(document).ready(function() {
                $("#target-content").load("ajax.php?page=1");
                $(".page-link").click(function(){
                    var id = $(this).attr("data-id");
                    var select_id = $(this).parent().attr("id");
                    var ur = "index.php?page=ajax";
                    $.ajax({
                        url: "ajax.php",
                        type: "GET",
                        data: {
                            page : id
                        },
                        cache: false,
                        success: function(dataResult){
                            $("#target-content").html(dataResult);
                            $(".pagination").removeClass("active");
                            $("#"+select_id).addClass("active");
                            
                        }
                    });
                });
            });
        </script>

        <!-- staff script  -->
        <script>
            function GetDetail(id){

                if(! id){
                    return;
                }else{
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function () {

                        // Defines a function to be called when
                        // the readyState property changes
                        if (this.readyState == 4 && this.status == 200) {
                            var myObj = JSON.parse(this.responseText);

                            var select = document.getElementById("first_name");

                            var option = document.createElement("option");
                            option.text = 'Select Staff';
                            option.value = null;
                            option.disabled = true;
                            option.selected = true;

                            
                            document.getElementById("first_name").innerHTML = ""
                            select.append(option);
                            
                            myObj.forEach(function(item){
                                var el = document.createElement("option");
                                el.text = item['fname'];
                                el.value = item['id'];

                                select.append(el);
                                
                            })
                        }
                    };

                    xmlhttp.open("GET", "./includes/filter.php?id=" +id, true);
                    
                    xmlhttp.send();
                }
            }
        </script>  
    <!-- modal css -->
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}

        /* Full-width input fields */
        input[type=text], input[type=password], input[type=email], input[type=datetime-local], select{
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
        }

        /* Set a style for all buttons */
        button {
            background: var(--main-color);
            border-radius: 10px;
            color: #fff;
            font-size: .8rem;
            padding: .5rem 1rem;
            border: 1px solid var(--main-color);
        }

        button:hover {
        opacity: 0.8;
        }

        /* Extra styles for the cancel button */
        .cancelbtn {
        width: auto;
        padding: .5rem 1rem;
        background-color: #f44336;
        }

        /* Center the image and position the close button */
        .imgcontainer {
        text-align: center;
        margin: 24px 0 12px 0;
        position: relative;
        }

        img.avatar {
        width: 40%;
        border-radius: 50%;
        }

        .container {
        padding: 16px;
        }

        span.psw {
        float: right;
        padding-top: 16px;
        }

        /* The Modal (background) */
        .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        padding-top: 60px;
        }

        /* Modal Content/Box */
        .modal-content {
        background-color: #fefefe;
        margin: 5% 50px 15% auto; /* 5% from the top, 15% from the bottom and centered */
        border: 1px solid #888;
        transition: margin-left 300ms;
        /* margin-left:345px; */
        width: 80%; /* Could be more or less, depending on screen size */
        }

        /* The Close Button (x) */
        .close {
        position: absolute;
        right: 25px;
        top: 0;
        color: #000;
        font-size: 35px;
        font-weight: bold;
        }

        .close:hover,
        .close:focus {
        color: red;
        cursor: pointer;
        }

        /* Add Zoom Animation */
        .animate {
        -webkit-animation: animatezoom 0.6s;
        animation: animatezoom 0.6s
        }

        @-webkit-keyframes animatezoom {
        from {-webkit-transform: scale(0)} 
        to {-webkit-transform: scale(1)}
        }
        
        @keyframes animatezoom {
        from {transform: scale(0)} 
        to {transform: scale(1)}
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
        span.psw {
            display: block;
            float: none;
        }
        .cancelbtn {
            width: 100%;
        }
    }
        </style>
    <title>Ora Nail Spot</title>
</head>