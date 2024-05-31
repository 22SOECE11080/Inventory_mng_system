<?php
session_start();
if(!isset($_SESSION["email"])){
?>
 <script>
        window.location.href = "http://localhost/Inventory_mng_system/login.php";
</script>
<?php
}
?>