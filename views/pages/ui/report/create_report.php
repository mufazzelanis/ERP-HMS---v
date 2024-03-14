    <?php
    echo page_header(["title"=>"Daily Reports"]);
    ?>

<div style="padding-top: 0px !important;" class="p-4 no-print">
        <?php echo table_wrap_open();?>
        <form method="post" action='' >
            <div class="form-group row align-items-center m-0">
                <div class="col-sm-6">
                    <div class="wrapper d-flex align-items-center">
                        <label class="form-label m-0" for="date">Date:</label>
                        <input class="form-control mx-2" type="date" id="date" value="<?php echo date("Y-m-d") ?>" name="date">
                        <button id="btn" type="submit" class='btn btn-info my-primary-btn'><b>GO</b></button>
                    </div>
                </div>
                <div class="col-sm-6"></div>
            </div>
        </form>
        <?php echo table_wrap_close();?>
</div>

<div style="padding-top: 0px !important;" class="p-4">
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Check if the key "date" exists in the $_POST array
                if (isset($_POST["date"])) {
                    $date = $_POST["date"];
                    echo Invoice::label_test_report($date);
                } 
            }
        ?>
        
</div>