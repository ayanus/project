<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Big Bee Farm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }
        .sidebar {
            width: 200px;
            background-color: #F8F8F8;
            border-right: 1px solid #E0E0E0;
            padding: 20px 0;
            /* top : 200px; */
        }
        .sidebar a {
            display: block;
            padding: 10px 20px;
            color: #000;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .content {
            flex-grow: 1;
            padding: 20px;

        }
        .topbar {
            width: 100%;
            background-color: #fff9c4;
            border-bottom: 1px solid #E0E0E0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            position: fixed;
            top: 0;
            left: 0;
            box-sizing: border-box;
        }
        .topbar input[type="text"] {
            width: 300px;
            padding: 5px;
            border: 1px solid #E0E0E0;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="#orders">ข้อมูลผึ้ง</a>
        <a href="#locations">การเลี้ยงผึ้ง</a>
        <a href="#inventory">วัตถุดิบ</a>
        <a href="#production">การผลิต</a>
        <a href="#sales">การขาย</a>
        <a href="#products">ผลิตภัณฑ์</a>
        <a href="#suppliers">Supplier</a>
    </div>
    <div class="content">
        <div class="topbar">
            <div class="logo">
                <h2 style="text-align:center;">Big Bee Farm</h2>
            </div>
        </div>
    </div>
</body>
</html>
