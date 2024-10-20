<?php
include 'C:\laragon\www\project\config\config.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // ดึงข้อมูลหลักจากตาราง disabled
    $sql = "SELECT * FROM beekeep_detail WHERE b_keep_dt_id = '$id'";
    $result_disabled = mysqli_query($conn, $sql_disabled);
    
    if ($result_disabled && $row_disabled = mysqli_fetch_assoc($result_disabled)) {
        echo "<h2>รายละเอียดผู้พิการ</h2>";
        echo "<p><strong>ชื่อ:</strong> " . htmlspecialchars($row_disabled['disabled_name']) . "</p>";
        echo "<p><strong>เลขบัตรประชาชน:</strong> " . htmlspecialchars($row_disabled['disabled_card']) . "</p>";
        echo "<p><strong>วัน/เดือน/ปีเกิด:</strong> " . htmlspecialchars($row_disabled['birthday']) . "</p>";
        echo "<p><strong>อายุ:</strong> " . htmlspecialchars($row_disabled['age']) . "</p>";
        echo "<p><strong>สถานะ:</strong> " . htmlspecialchars($row_disabled['status']) . "</p>";
        echo "<p><strong>ที่อยู่:</strong> " . htmlspecialchars($row_disabled['address']) . "</p>";
        echo "<p><strong>อาชีพ:</strong> " . htmlspecialchars($row_disabled['job']) . "</p>";
        echo "<p><strong>รายได้:</strong> " . htmlspecialchars($row_disabled['income']) . "</p>";
        echo "<p><strong>เบอร์โทร:</strong> " . htmlspecialchars($row_disabled['tel']) . "</p>";
        echo "<p><strong>อีเมล:</strong> " . htmlspecialchars($row_disabled['email']) . "</p>";
        
        // ดึงข้อมูลความสามารถ
        $sql_ability = "SELECT a.ability_name 
                        FROM abilitydetails ad
                        JOIN ability a ON ad.ability_id = a.ability_id
                        WHERE ad.disabled_id = '$id'";
        $result_ability = mysqli_query($conn, $sql_ability);
        if ($result_ability && mysqli_num_rows($result_ability) > 0) {
            echo "<p><strong>ความสามารถ:</strong> ";
            $abilities = array();
            while ($row_ability = mysqli_fetch_assoc($result_ability)) {
                $abilities[] = htmlspecialchars($row_ability['ability_name']);
            }
            echo implode(", ", $abilities);
            echo "</p>";
        } else {
            echo "<p><strong>ความสามารถ:</strong> ไม่ระบุ</p>";
        }
        
        // ดึงข้อมูลโรคประจำตัว
        $sql_disease = "SELECT d.disease_name 
                        FROM diseasedetails dd
                        JOIN disease d ON dd.disease_id = d.disease_id
                        WHERE dd.disabled_id = '$id'";
        $result_disease = mysqli_query($conn, $sql_disease);
        if ($result_disease && mysqli_num_rows($result_disease) > 0) {
            echo "<p><strong>โรคประจำตัว:</strong> ";
            $diseases = array();
            while ($row_disease = mysqli_fetch_assoc($result_disease)) {
                $diseases[] = htmlspecialchars($row_disease['disease_name']);
            }
            echo implode(", ", $diseases);
            echo "</p>";
        } else {
            echo "<p><strong>โรคประจำตัว:</strong> ไม่ระบุ</p>";
        }
        
        // ดึงข้อมูลประเภทความพิการ
        $sql_disabilitype = "SELECT dt.type_name, dt.type_money 
                             FROM disabilitypedetails dtd
                             JOIN disabilitype dt ON dtd.disabilitype_id = dt.disabilitype_id
                             WHERE dtd.disabled_id = '$id'";
        $result_disabilitype = mysqli_query($conn, $sql_disabilitype);
        if ($result_disabilitype && mysqli_num_rows($result_disabilitype) > 0) {
            echo "<p><strong>ประเภทความพิการและเงินช่วยเหลือ:</strong></p>";
            echo "<ul>";
            while ($row_disabilitype = mysqli_fetch_assoc($result_disabilitype)) {
                echo "<li>" . htmlspecialchars($row_disabilitype['type_name']) . 
                     ": " . htmlspecialchars($row_disabilitype['type_money']) . " บาท</li>";
            }
            echo "</ul>";
        } else {
            echo "<p><strong>ประเภทความพิการและเงินช่วยเหลือ:</strong> ไม่ระบุ</p>";
        }
    } else {
        echo "ไม่พบข้อมูล";
    }
} else {
    echo "ไม่พบ ID ที่ระบุ";
}

mysqli_close($conn);
?>