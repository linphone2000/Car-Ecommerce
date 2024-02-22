    <?php
    include '../admin/connection.php';
    session_start();
    if (isset($_POST['buy'])) {
        if (strpos($_SESSION['name'], "b2b") !== false) {
            $userqty = 5;
        } else {
            $userqty = 1;
        }
        if (isset($_SESSION['cart'])) {
            $sameitem = array_column($_SESSION['cart'], "name");
            if (in_array($_POST['name'], $sameitem)) {
                print_r($sameitem);
                echo "<br>" . "Index: ";
                $num = array_search($_POST['name'], $sameitem);
                echo $num;
                $_SESSION['cart'][$num]['quantity']++;
                header('Location: clientpage.php#scrollspy2');
                // echo "<script>alert('Item already added!');window.location.href = '../client/clientpage.php';</script>";
            } else {
                $count = count($_SESSION['cart']);
                $_SESSION['cart'][$count] = array(
                    "iid" => $_POST['iid'], "name" => $_POST['name'], "price" => $_POST['price'],
                    "quantity" => $userqty, "image" => $_POST['image']
                );
                header('Location: clientpage.php#scrollspy2');
                // echo"<script>alert('Item else added!');window.location.href = '../client/clientpage.php';</script>";
            }
        } else {
            $_SESSION['cart'][0] = array(
                "iid" => $_POST['iid'], "name" => $_POST['name'], "price" => $_POST['price'],
                "quantity" => $userqty, "image" => $_POST['image']
            );
            header('Location: clientpage.php#scrollspy2');
            // echo"<script>alert('Item added!');window.location.href = '../client/clientpage.php';</script>";
        }
    }
    if (isset($_POST['remove'])) {
        $itemtoadd = $_POST['fname'];
        echo "Item to add = " . $itemtoadd . "<br>";
        $same = array_column($_SESSION['cart'], "name");
        echo "To: ";
        print_r($same);
        echo "<br>";
        echo "Index is " . array_search($itemtoadd, $same);
        if (in_array($itemtoadd, $same)) {
            $index = array_search($itemtoadd, $same);
            $_SESSION['cart'][$index]['quantity']--;
        }
        if ($_SESSION['cart'][array_search($itemtoadd, $same)]['quantity'] == 0) {
            unset($_SESSION['cart'][array_search($itemtoadd, $same)]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
        header('Location: mycart.php');
    }
    if (isset($_POST['add'])) {
        $itemtoadd = $_POST['fname'];
        echo "Item to add = " . $itemtoadd . "<br>";
        $same = array_column($_SESSION['cart'], "name");
        echo "To: ";
        print_r($same);
        echo "<br>";
        echo "Index is " . array_search($itemtoadd, $same);
        if (in_array($itemtoadd, $same)) {
            $index = array_search($itemtoadd, $same);
            $_SESSION['cart'][$index]['quantity']++;
        }
        header('Location: mycart.php');
    }
    ?>

    <!-- foreach($_SESSION['cart'] as $key => $value){
            if($value['name'] == $_POST['name']){
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                echo"<script>alert('Item removed!');window.location.href = '../client/clientpage.php';</script>";
            }
        } -->