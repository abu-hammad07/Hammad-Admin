<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>

    <?php
    require 'config.php';
    $sql = "SELECT * FROM `institute`";
    $res = mysqli_query($conn, $sql);
    $html = '<table class="table table-striped table-hover table-bordered border-dark text-center"> 
    <tr>
        <th style="width:200px">INSTITUTE ID</th>
        <th style="width:200px">INSTITUTE NAME</th>
        <th style="width:200px">LOCATION</th>
        <th style="width:200px">Create Date</th>
    </tr>';
    $no = 1;
    while ($data = mysqli_fetch_assoc($res)) {
        $html .= '<tr style="height:100px">
                    <td>' . $no . '</td>
                    <td>' . $data['institute_name'] . '</td>
                    <td>' . $data['institute_location'] . '</td>
                    <td>' . $data['create_date'] . '</td>
                </tr>';
        $no = $no + 1;
    }

    $html .= '</table>';
    header('Content-Type:application/xls');
    header('Content-Disposition:attatchment;filename=student.xls');
    echo $html;



    // echo $html;
    ?>

    </table>


</body>

</html>