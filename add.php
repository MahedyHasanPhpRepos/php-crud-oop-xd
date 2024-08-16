<?php

$page_title = "add buyer";

include('./common/header.php');


//must include parent class when we include child class 
include('./interfaces/CrudInterface.php');
include('./classes/DbConfig.php');
include('./classes/Crud.php');
include('./interfaces/ValidationInterface.php');
include('./classes/Validation.php');


$crud = new Crud();
$validation = new Validation();

$error = null;
$errName = null;
$errEmail = null;
$errReceiptId = null;
$errItems = null;
$errPhone = null;
$errAmount = null;
$errEntryBy = null;
$errNote = null;
$errCity = null;




if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create'])) {
    $error = $validation->checkEmptyField($_POST, ['buyer', 'buyer_email', 'phone', 'city', 'receipt_id', 'items', 'amount', 'note', 'entry_by']);
    if ($error == null) {

        $crud->buyer = $_POST['buyer'];
        $crud->buyer_email = $_POST['buyer_email'];
        $crud->phone = $_POST['phone'];
        $crud->city = $_POST['city'];
        $crud->receipt_id = $_POST['receipt_id'];
        $crud->items = $_POST['items'];
        $crud->amount = $_POST['amount'];
        $crud->note = $_POST['note'];
        $crud->entry_by = $_POST['entry_by'];

        $check_name = $validation->isValidName($crud->buyer);
        $check_email = $validation->isValidEmail($crud->buyer_email);

        //number validations only
        $check_phone = $validation->isValidNumberOnly($crud->phone);
        $check_amount = $validation->isValidNumberOnly($crud->amount);
        $check_entry_by = $validation->isValidNumberOnly($crud->entry_by);

        //text validations only
        $check_receipt_id = $validation->isValidTextOnly($crud->receipt_id);
        $check_items = $validation->isValidTextOnly($crud->items);

        $check_note = $validation->isValidNote($crud->note);
        $check_city = $validation->isValidCity($crud->city);


        if ($check_name == false) {
            $errName = "Please provide name only text, spaces and numbers , must start with a letter and not more than 20 characters";
        }

        if ($check_email == false) {
            $errEmail = "Please provide a valid email";
        }

        if ($check_receipt_id == false) {
            $errReceiptId = "Please provide receipt id text only";
        }

        if ($check_items == false) {
            $errItems = "Please provide items name text only";
        }


        if ($check_phone == false) {
            $errPhone = "Please provide phone numbers only";
        }
        if ($check_amount == false) {
            $errAmount = "Please provide amount numbers only";
        }
        if ($check_entry_by == false) {
            $errEntryBy = "Please provide entry by numbers only";
        }

        if ($check_note == false) {
            $errNote = "Please provide note less then 30 words";
        }

        if ($check_city == false) {
            $errCity = "Please provide city name text and space only no number and special charactures";
        }


        if ($check_name == true && $check_email == true && $check_receipt_id == true && $check_items == true && $check_phone == true && $check_amount == true && $check_entry_by == true && $check_note == true && $check_city == true) {
            // echo "done";
            $done = $crud->create() ; 
            // echo $done ; 
            if ($done) {
                header("location:index.php");
            } else {
                echo "something went wrong";
            }
        }
    }
}


?>


<div class="container">
    <div class="row">
        <div class="col-md-8 col-lg-6 mx-auto mt-3">
            <div class="text-center">
                <h2>Add Buyer</h2>
            </div>
            <div>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                    <div class="form-group my-2">
                        <label for="buyer" class="mb-1 text-muted required_label">Please enter buyer name </label>
                        <input type="text" name="buyer" id="buyer" class="form-control" placeholder="Please enter buyer name">
                    </div>
                    <div class="form-group my-2">
                        <label for="buyer_email" class="mb-1 text-muted required_label">Please enter buyer email </label>
                        <input type="text" name="buyer_email" id="buyer_email" class="form-control" placeholder="Please enter buyer email">
                    </div>
                    <div class="form-group my-2">
                        <label for="phone" class="mb-1 text-muted required_label">Please enter phone </label>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Please enter phone">
                    </div>
                    <div class="form-group my-2">
                        <label for="city" class="mb-1 text-muted required_label">Please enter city </label>
                        <input type="text" name="city" id="city" class="form-control" placeholder="Please enter city">
                    </div>
                    <div class="form-group my-2">
                        <label for="receipt_id" class="mb-1 text-muted required_label">Please enter receipt id </label>
                        <input type="text" name="receipt_id" id="receipt_id" class="form-control" placeholder="Please enter receipt id">
                    </div>
                    <div class="form-group my-2">
                        <label for="items" class="mb-1 text-muted required_label">Please enter items </label>
                        <input type="text" name="items" id="items" class="form-control" placeholder="Please enter items">
                    </div>
                    <div class="form-group my-2">
                        <label for="amount" class="mb-1 text-muted required_label">Please enter amount </label>
                        <input type="text" name="amount" id="amount" class="form-control" placeholder="Please enter amount">
                    </div>
                    <div class="form-group my-2">
                        <label for="note" class="mb-1 text-muted required_label">Please enter note </label>
                        <textarea type="textarea" name="note" id="note" class="form-control" placeholder="Please enter note"></textarea>
                    </div>
                    <div class="form-group my-2">
                        <label for="entry_by" class="mb-1 text-muted required_label">Please enter entry by </label>
                        <input type="text" name="entry_by" id="entry_by" class="form-control" placeholder="Please enter entry by">
                    </div>


                    <div class="form-group my-2">
                        <button type="submit" name="create" class="btn btn-success w-100">
                            Add Buyer
                        </button>
                    </div>
                </form>
            </div>
            <div>
                <?php
                if ($error != null):
                    echo $error;
                ?>
                <?php endif; ?>
            </div>
            <div>
                <?php
                if ($errName != null):
                    echo $errName;
                ?>
                <?php endif; ?>
            </div>
            <div>
                <?php
                if ($errEmail != null):
                    echo $errEmail;
                ?>
                <?php endif; ?>
            </div>
            <div>
                <?php
                if ($errReceiptId != null):
                    echo $errReceiptId;
                ?>
                <?php endif; ?>
            </div>
            <div>
                <?php
                if ($errItems != null):
                    echo $errItems;
                ?>
                <?php endif; ?>
            </div>
            <div>
                <?php
                if ($errPhone != null):
                    echo $errPhone;
                ?>
                <?php endif; ?>
            </div>
            <div>
                <?php
                if ($errNote != null):
                    echo $errNote;
                ?>
                <?php endif; ?>
            </div>
            <div>
                <?php
                if ($errAmount != null):
                    echo $errAmount;
                ?>
                <?php endif; ?>
            </div>
            <div>
                <?php
                if ($errEntryBy != null):
                    echo $errEntryBy;
                ?>
                <?php endif; ?>
            </div>
            <div>
                <?php
                if ($errCity != null):
                    echo $errCity;
                ?>
                <?php endif; ?>
            </div>
            <div class="mb-3"></div>
        </div>
    </div>
</div>


<?php

use Crud;

include('./common/footer.php');
?>