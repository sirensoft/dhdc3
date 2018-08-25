#DHDC 3.0 Plugable  by DHDC Team
<hr>

<p><b>ขั้นตอนการเตรียมระบบ และการดาวน์โหลด</b>
<p>(1) #cd webroot
<p>(2) #wget  http://61.19.22.108/dhdc3.zip
<p>(3) #unzip dhdc3.zip
<p>(4) #chmod -R 0777 dhdc3
<p>(5) download   http://61.19.22.108/databases.zip
<p>(6) Linux OS แก้ไข httpd.conf เพิ่ม AllowOverRide  All ใน <Directory "/var/www/html">
<hr>
<p> <b>ขั้นตอนการติดตั้งระบบ</b>
<p>(1) สร้างฐานชื่อ dhdc3 กำหนด Collation เป็น utf8_general_ci (กรณี upgrade จาก dhdc2 ข้ามไปข้อ 2 )
<p>(2) ตั้งค่าการเชื่อมต่อฐานข้อมูลที่ไฟล์ dhdc3/common/config/<b>connect_database.php</b>
<p>(3) Restore ไฟล์ฐานข้อมูลใน databases.zip เรียงลำดับตามหมายเลข (กรณี upgrade โปรดระมัดระวังการเลือกไฟล์หมายเลข 1 ผิด)
<p>(4) Login = admin ,123456
<p>(5) จัดการระบบ - ตั้งค่าอำเภอ (ต้องทำก่อนการประมวลผลครั้งแรก!!!) 
<p>(6) จัดการระบบ - จัดการผู้ใช้ - create new user , สิทธิใช้งาน - มอบหมายสิทธิ
<p>(7) จัดการระบบ - ประมวลผล กดปุ่ม 1 และ 2  (สังเกต Transform Process และ System Process)
<p>(8) จัดการระบบ - Plugins

<hr>
<p><b>การติดตั้ง Plugins</b>
<p>โปรดอ่าน dhdc3/moules/การติดตั้ง.txt


<hr>
<p>Programmer Section
<p> (1) git -commit
<p> (2) git -remote -push หรือ git -remote -push to upstream ( ถ้า push ไม่ได้ให้ merge หรือ ทำข้อ (2.1) แล้วทำข้อ (3) )
<p> (2.1) git -remote -pull -merge
<p> (3) git -remote -push
<p>=============


