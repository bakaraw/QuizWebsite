<?php
session_start();

$servername = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$database_name = 'web';

$conn = new mysqli($servername, $dbUsername, $dbPassword, $database_name);

if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error);
    exit; 
}
?>
<style>
.tinO {
    background: #fff;
    margin-top: 20px;
    margin-bottom: 1.5rem;
    margin-right: .5rem!important;
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-clip: border-box;
    border: 0 solid transparent;
    border-radius: .25rem;
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
}
</style>


<div class="container">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="tinO">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <div class="mt-3">
                            <?php
                                $sql = "SELECT username FROM account";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // Output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        echo '<h4>' . htmlspecialchars($row["username"]) . '</h4><br>';
                                    }
                                } 
                                $conn->close();
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
