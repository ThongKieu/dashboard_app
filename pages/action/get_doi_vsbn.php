<?php

try{
    $get_vsbn = 'SELECT * FROM vsbn where status_vsbn = 0';
    $show_vsbn = $conn -> query($get_vsbn);
    $show_vsbn ->setFetchMode(PDO::FETCH_ASSOC);
    $show_vsbn->execute();

    echo "
    <table class='table table-bordered table-hover '>
        <thead>
            <th>Tên Bể</th>
            <th> Địa chỉ</th>
            <th> Đội Thợ Làm </th>
            <th> Sửa </th>
        </thead>
        <tbody>
    ";
    while($r_vsbn = $show_vsbn->fetch())
    {
       echo" <tr>
            <td>".$r_vsbn['name_vsbn']."</td>
            <td>".$r_vsbn['add_vsbn']."</td>
            <td>".$r_vsbn['team_vsbn']."</td>
            <td>
                <form action='includes/logic/Xl_them_bn.php' method='GET'>
                        <input type='hidden' name='xl' value= '1'>
                        <input type='hidden' name='id_bn' value= '".$r_vsbn['id_vsbn']."'>
                    <button class='btn btn-sm btn-danger' type= 'submit'  value='benuoc'>Xong</button>
                </form>
            </td>
        </tr>  "; 

    }
    echo "</tbody>
        </table>";
}
catch(PDOException $e)
{
    echo $e->getMessage();
} 

?>