<?php
$page_title = 'index';
include('./common/header.php');
include('./interfaces/CrudInterface.php');
include('./classes/DbConfig.php');
include('./classes/Crud.php');

$crud = new Crud();



$searchId = isset($_GET['id']) ? trim($_GET['id']) : '';



if ($searchId == null) {
    $buyers = $crud->read();
} else {
    $buyers = $crud->search($searchId);
}






?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12 mx-auto mt-3">
            <div class="text-center">
                <h2> All Buyers</h2>
            </div>

        </div>
        <div class="col-md-2">
            <div class="text-start my-2">
                <?php if ($searchId == null): ?>
                    <a href='add.php' class="btn btn-success text-capitalize">
                        add Buyers
                    </a>
                <?php else: ?>
                    <a href='index.php' class="btn btn-primary text-capitalize">
                        back
                    </a>
                <?php endif ?>


            </div>
        </div>
        <div class="col-md-6 ms-auto align-items-center d-flex">
            <div class="w-100">
                <form method="get">
                    <div class="d-flex gap-2">
                        <div class="w-100">
                            <input type="text" name="id" class="form-control" placeholder="Please search with user id">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-info text-white">Search</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- <div>
                <form method="get">
                    <input type="text" name="search" placeholder="Search">
                    <button type="submit">Search</button>
                </form>
            </div> -->

        </div>
        <div class="col-12 mx-auto mt-3">

            <?php if (!empty($buyers)): ?>
                <div class="table-responsive">
                    <table class="table table-success table-striped">
                        <thead>
                            <tr>
                                <th>Id </th>
                                <th>Name </th>
                                <th>Email </th>
                                <th>Phone</th>
                                <th>City</th>
                                <th>Buyer_ip</th>
                                <th>Receipt_id</th>
                                <th>Items</th>
                                <th>Amount</th>
                                <th>Note</th>
                                <th>Entry_at</th>
                                <th>Entry_by</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($buyers as $buyer): ?>
                                <tr>
                                    <td><?php echo $buyer['id'] ?></td>
                                    <td><?php echo $buyer['buyer'] ?></td>
                                    <td><?php echo $buyer['buyer_email'] ?></td>
                                    <td><?php echo $buyer['phone'] ?></td>
                                    <td><?php echo $buyer['city'] ?></td>
                                    <td><?php echo $buyer['buyer_ip'] ?></td>
                                    <td><?php echo $buyer['receipt_id'] ?></td>
                                    <td><?php echo $buyer['items'] ?></td>
                                    <td><?php echo $buyer['amount'] ?></td>
                                    <td><?php echo $buyer['note'] ?></td>
                                    <td><?php echo $buyer['entry_at'] ?></td>
                                    <td><?php echo $buyer['entry_by'] ?></td>
                                    <td class="text-center">
                                        <a href="delete.php?id=<?php echo $buyer['id']; ?>" name="delete">delete</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <h3>No Buyer Record</h3>
            <?php endif ?>

        </div>
    </div>
</div>



<?php
include('./common/footer.php');
?>