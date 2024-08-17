<?php
session_start();

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'p') {
        header("location: ../login.php");
    } else {
        $useremail = $_SESSION["user"];
    }
} else {
    header("location: ../login.php");
}

include("../connection.php");

$sqlmain = "select * from patient where pemail=?";
$stmt = $database->prepare($sqlmain);
$stmt->bind_param("s", $useremail);
$stmt->execute();
$userrow = $stmt->get_result();
$userfetch = $userrow->fetch_assoc();

$userid = $userfetch["pid"];
$username = $userfetch["pname"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
    <title>Dashboard</title>
    <style>
        .dashbord-tables {
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container {
            animation: transitionIn-Y-bottom  0.5s;
        }
        .sub-table, .anime {
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
    <style>
        /* Styles for the floating chatbot icon */
        #chatbot-icon {
            position: fixed;
            bottom: 20px; /* Adjust as needed */
            right: 20px; /* Adjust as needed */
            width: 60px; /* Adjust as needed */
            height: 60px; /* Adjust as needed */
            background-color: #007bff; /* Adjust as needed */
            border-radius: 50%;
            cursor: pointer;
            z-index: 1000; /* Ensure it appears above other content */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Adjust as needed */
        }

        /* Styles for the chatbot icon image */
        #chatbot-icon img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
        }

        /* Styles for the teach-skin icon */
        #teach-skin-icon {
            position: fixed;
            bottom: 100px; /* Adjust as needed */
            right: 30px; /* Adjust as needed */
            width: 40px; /* Adjust as needed */
            height: 40px; /* Adjust as needed */
            cursor: pointer;
            z-index: 1000; /* Ensure it appears above other content */
        }

        #teach-skin-icon img {
            width: 100%;
            height: 100%;
        }

        /* Styles for the video-call icon */
        #video-call-icon {
            position: fixed;
            bottom: 180px; /* Adjust as needed */
            right: 30px; /* Adjust as needed */
            width: 40px; /* Adjust as needed */
            height: 40px; /* Adjust as needed */
            cursor: pointer;
            z-index: 1000; /* Ensure it appears above other content */
        }

        #video-call-icon img {
            width: 100%;
            height: 100%;
        }

        /* Styles for the detect-skin icon */
        #detect-skin-icon {
            position: fixed;
            bottom: 260px; /* Adjust as needed */
            right: 30px; /* Adjust as needed */
            width: 40px; /* Adjust as needed */
            height: 40px; /* Adjust as needed */
            cursor: pointer;
            z-index: 1000; /* Ensure it appears above other content */
        }

        #detect-skin-icon img {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <div id="chatbot-icon" onclick="openChatbot()">
        <img src="../img/icons/icon.png" alt="Chatbot Icon"> <!-- Replace icon.png with your icon image -->
    </div>
    <div id="teach-skin-icon" onclick="openTeachSkin()">
        <img src="../img/icons/chatbot-icon.png" alt="Teach Skin Icon"> <!-- Replace chatbot-icon.png with your teach-skin icon image -->
    </div>
    <div id="video-call-icon" onclick="openVideoCall()">
        <img src="../img/icons/videocall.png" alt="Video call Icon"> <!-- Replace icon.png with your icon image -->
    </div>
    <div id="detect-skin-icon" onclick="openDetectSkin()">
        <img src="../img/icons/chatbot-icon.png" alt="Detect Skin Icon"> <!-- Replace skin-detect.png with your detect skin icon image -->
    </div>
    <script>
        // Function to open the specified link in a new tab
        function openChatbot() {
            window.open('https://mediafiles.botpress.cloud/f0570150-d122-41d9-80f7-faf5342de604/webchat/bot.html', '_blank');
        }

        // Function to open teachSkin.html in a new tab
        function openTeachSkin() {
            window.open('teachSkin.html', '_blank');
        }

        // Function to open the video call in a new tab
        function openVideoCall() {
            window.open('https://meet.google.com/zoa-shqt-kmm', '_blank');
        }

        // Function to open the Flask app in a new tab
        function openDetectSkin() {
            window.open('http://localhost:3000', '_blank');
        }
    </script>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px">
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo substr($username, 0, 13) ?>..</p>
                                    <p class="profile-subtitle"><?php echo substr($useremail, 0, 22) ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php"><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-home menu-active menu-icon-home-active">
                        <a href="index.php" class="non-style-link-menu non-style-link-menu-active">
                            <div>
                                <p class="menu-text">Home</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor">
                        <a href="doctors.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">All Doctors</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-session">
                        <a href="schedule.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">Scheduled Sessions</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="appointment.php" class="non-style-link-menu">
                            <div>
                                <p class="menu-text">My Bookings</p>
                            </div>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style="border-spacing:0;margin:0;padding:0;">
                <tr>
                    <td width="13%">
                        <a href="index.php">
                            <button class="login-btn btn-primary-soft btn btn-icon-back" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">
                                <font class="tn-in-text">Back</font>
                            </button>
                        </a>
                    </td>
                    <td>
                        <p style="font-size:23px;padding-left:12px;font-weight:600;">Home</p>
                    </td>
                    <td width="15%">
                        <p class="heading-sub12" style="padding:0;margin:0;text-align:right;">
                            <?php echo date('d-m-Y'); ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button class="btn-label" style="display:flex;justify-content:center;align-items:center;">
                            <img src="../img/calendar.svg" width="100%">
                        </button>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <center>
                            <table class="filter-container" border="0">
                                <tr>
                                    <td colspan="4">
                                        <p style="font-size:20px;font-weight:600;padding-left:12px;">Welcome!</p>
                                        <p style="font-size:16px;font-weight:600;padding-left:12px;">Dashboard</p>
                                        <p class="heading-main12" style="margin-left:45px;font-size:18px;color:#737373;">Today's Appointments</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <center>
                                            <div class="abc scroll">
                                                <table width="93%" class="sub-table scrolldown" border="0">
                                                    <thead>
                                                        <tr>
                                                            <th class="table-headin">Appoint. Number</th>
                                                            <th class="table-headin">Session Title</th>
                                                            <th class="table-headin">Doctor</th>
                                                            <th class="table-headin">Scheduled Date & Time</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sqlmain = "select appointment.appoid,schedule.scheduleid,schedule.title,doctor.docname,schedule.scheduledate,schedule.scheduletime from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join patient on patient.pid=appointment.pid inner join doctor on schedule.docid=doctor.docid where patient.pid=$userid ";
                                                        $sqlmain .= "and schedule.scheduledate>='" . date('Y-m-d') . "' order by schedule.scheduledate asc";
                                                        $result = $database->query($sqlmain);

                                                        if ($result->num_rows == 0) {
                                                            echo '<tr>
                                                                    <td colspan="4">
                                                                        <br><br><br><br>
                                                                        <center>
                                                                            <p class="heading-main12" style="margin-left:45px;font-size:20px;color:#737373;">You have no appointments scheduled for today!</p>
                                                                            <a class="non-style-link" href="schedule.php">
                                                                                <button class="login-btn btn-primary-soft btn" style="display:flex;justify-content:center;align-items:center;margin-left:20px;">Show all Sessions</button>
                                                                            </a>
                                                                        </center>
                                                                        <br><br><br><br>
                                                                    </td>
                                                                </tr>';
                                                        } else {
                                                            for ($x = 0; $x < $result->num_rows; $x++) {
                                                                $row = $result->fetch_assoc();
                                                                $appoid = $row["appoid"];
                                                                $scheduleid = $row["scheduleid"];
                                                                $title = $row["title"];
                                                                $docname = $row["docname"];
                                                                $scheduledate = $row["scheduledate"];
                                                                $scheduletime = $row["scheduletime"];
                                                                echo '<tr>
                                                                        <td>' . substr($appoid, 0, 13) . '</td>
                                                                        <td>' . substr($title, 0, 30) . '</td>
                                                                        <td>' . substr($docname, 0, 20) . '</td>
                                                                        <td style="text-align:center;">' . substr($scheduledate, 0, 10) . ' @' . substr($scheduletime, 0, 5) . '</td>
                                                                    </tr>';
                                                            }
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </center>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <center>
                                            <a href="appointment.php" class="non-style-link">
                                                <button class="login-btn btn-primary-soft btn">Show all Appointments</button>
                                            </a>
                                        </center>
                                    </td>
                                </tr>
                            </table>
                        </center>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
