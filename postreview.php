<?php
    include 'connect.php';
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $username=$_POST['username'];
        $tieude=$_POST['tieude'];
        $noidung=$_POST['noidung'];
        $diachi=$_POST['diachi'];
        $ngaydang=date('Y-m-d H:i:s');
        $hinhanh=$_POST['hinhanh'];
        $conn->query("INSERT INTO review_table (username,ngaydang,tieude,noidung,diachi) 
        VALUES ('$username','$ngaydang','$tieude','$noidung','$diachi')");
        $sql="SELECT id FROM review_table order by id desc limit 1";
        $response=$conn->query($sql);
        $row=mysqli_fetch_assoc($response);
        $id=$row['id'];
        $name_hinhanh=$id.'.jpg';
        $link='hinhanh/'.$name_hinhanh;
        if(file_put_contents($link,base64_decode($hinhanh))&&
            $conn->query("UPDATE review_table set hinhanh='$name_hinhanh' where id='$id'"))
        $result['success']='1';
        else $result['success']='0';
        echo json_encode($result);
    }
?>