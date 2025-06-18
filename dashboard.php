<?php
session_start();
if (!isset($_SESSION['username'])) {
    // User is already logged in, redirect to welcome page  
    header("Location: login.php");

}

if(!isset($_SESSION["counter"])){
    $_SESSION["counter"] = 1;
} else {
    $_SESSION["counter"]++;
}

if(!isset($_SESSION["daftar"])){
    $_SESSION["daftar"] = [];
}

if(isset($_POST["namaku"]) && isset($_POST["umurku"])){
    $daftar = [
        'nama' => $_POST["namaku"],
        'umur' => $_POST["umurku"],
    ];
    $_SESSION["daftar"][] = $daftar;
}

?>
<html>
    <head>
        <title>::Login Page::</title>
        <style type="text/css">
            body{
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                height: 100vh;
                background-size: cover;
                background-image: url("https://cdn.arstechnica.net/wp-content/uploads/2023/06/bliss-update-1440x960.jpg");
            }
            table{
                background-color: white;
                border: 3px solid grey;
                padding: 20px;
                border-radius: 10px;
                font-family:Arial, Helvetica, sans-serif;
            }
            td{
                padding: 5px;
            }
            button{
                background-color: greenyellow;
                padding: 10px;
                border-radius: 5px;
            }
            #logout{
                background-color: red;
            }

        </style>
            <title>Dashboard</title>

    </head>
    <body>
        <h1><?php echo "Selamat datang " . $_SESSION['username'] . " ke-" . $_SESSION["counter"]  ?></h1>
        <br>
        <form action="dashboard.php" method="post">
         <table>
            <tr>
                <td colspan="2" style="text-align: center;" >DAFTAR</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="namaku" /></td>
            </tr>
            <tr>
                <td>Umur</td>
                <td><input type="text" name="umurku" /></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <button type="submit" >PROSES</button>
                    <a href="logout.php">
                        <button id="logout" type="button" >LOGOUT</button>
                    </a>
                </td>
            </tr>
        </table>
        <table border="1">
            <tr>
                <td>Nama</td>
                <td>Umur</td>
                <td>keterangan</td>
                <td>Aksi</td>
            </tr>
            <?php foreach($_SESSION["daftar"] as $i => $daftar_item): ?>
            <tr>
                <td><?php echo $daftar_item ["nama"]; ?></td>
                <td><?php echo $daftar_item ["umur"]; ?></td>
                <td><?php
                        if($daftar_item["umur"] < 10){
                            echo "Anak";
                        }elseif($daftar_item["umur"] >= 10 && $daftar_item["umur"] < 20){
                            echo "Remaja";
                        }elseif($daftar_item["umur"] >= 20 && $daftar_item["umur"] < 40){
                            echo "Dewasa";
                        }elseif($daftar_item["umur"] >= 40){
                            echo "Tua";
                        }else{
                            echo "tidak diketahui";
                        }
                ?></td>
                <td>
                    <a href="hapus.php?id=<?php echo $i; ?>">hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        </form>
    </body>
</html>