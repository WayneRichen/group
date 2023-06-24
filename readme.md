## 安裝說明
1. 首先將本專案下載到本機
![image](https://github.com/WayneRichen/group/assets/84951972/044078b6-60f1-4ea6-975b-af499a5405d8)
1. 打開 PHPMyAdmin 依照步驟把資料庫檔案（group.sql）匯入
![image](https://github.com/WayneRichen/group/assets/84951972/1e73a2ab-510d-4037-b631-829329a130f5)
1. 使用編輯器打開 `db.php` 將變數設為本機環境的設定
  ```php
  <?php
  $servername = "127.0.0.1"; // MySQL 伺服器位址
  $username = "root"; // MySQL 帳號，同 PHPMyAdmin 登入帳號
  $password = ""; // MySQL 密碼，同 PHPMyAdmin 登入密碼
  $dbname = "group"; // 資料庫名稱，這個不用改
  ```
## 使用說明
瀏覽器打開輸入 `http://127.0.0.1/login.html` 可以看到登入頁面
![image](https://github.com/WayneRichen/group/assets/84951972/7c5fb14c-2263-4ec2-99f7-582f481b8c8b)

`http://127.0.0.1/register.html` 為註冊頁面
![image](https://github.com/WayneRichen/group/assets/84951972/94e5b258-ca91-471d-bfbf-67508e20e315)

登入或註冊成功會跳轉到 `http://127.0.0.1/profile.php` 會員中心頁面
![image](https://github.com/WayneRichen/group/assets/84951972/ae45fae6-bd91-4990-b6f9-36ac4244b530)
