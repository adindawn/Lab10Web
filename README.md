# PRAKTIKUM 10: PHP OOP 

Nama : ADINDA AULIA NABILA PUTRI

Nim : 312410309

Kelas : TI.24.A.4 


# DESKRIPSI PRAKTIKUM 

   Pada praktikum 10 membahas penerapan OOP pada PHP dengan membuat class dan object, serta menerapkan modularisasi melalui class library untuk form dan koneksi database. OOP digunakan untuk menyusun program agar lebih terstruktur, serta memisahkan fungsi-fungsi tertentu ke dalam class yang terorganisir. 

# MEMBUAT FILE DENGAN NAMA ```mobil.php```

```
<?php 
/**
 * Program sederhana pendefinisian class dan pemanggilan class.
 */

class Mobil 
{ 
    private $warna; 
    private $merk; 
    private $harga; 
  
    public function __construct() 
    { 
        $this->warna = "Biru"; 
        $this->merk  = "BMW"; 
        $this->harga = "10000000"; 
    } 
  
    public function gantiWarna($warnaBaru) 
    { 
        $this->warna = $warnaBaru; 
    } 
  
    public function tampilWarna() 
    { 
        echo "Warna mobilnya : " . $this->warna; 
    } 
} 
  
// membuat objek mobil 
$a = new Mobil(); 
$b = new Mobil(); 
  
// memanggil objek 
echo "<b>Mobil pertama</b><br>"; 
$a->tampilWarna(); 

echo "<br>Mobil pertama ganti warna<br>"; 
$a->gantiWarna("Merah"); 
$a->tampilWarna(); 
  
// memanggil objek kedua
echo "<br><b>Mobil kedua</b><br>"; 
$b->gantiWarna("Hijau"); 
$b->tampilWarna(); 
  
?>
```

# MEMBUAT FILE DENGAN NAMA ```form.php```

```
<?php 
/** 
* Nama Class: Form 
* Deskripsi: CLass untuk membuat form inputan text sederhan 
**/ 
  
class Form 
{ 
   private $fields = array(); 
   private $action; 
   private $submit = "Submit Form"; 
   private $jumField = 0; 
  
   public function __construct($action, $submit) 
   { 
       $this->action = $action; 
       $this->submit = $submit; 
   } 
  
   public function displayForm() 
   { 
       echo "<form action='".$this->action."' method='POST'>"; 
       echo '<table width="100%" border="0">'; 
       for ($j=0; $j<count($this->fields); $j++) { 
           echo "<tr><td 
align='right'>".$this->fields[$j]['label']."</td>"; 
           echo "<td><input type='text' 
name='".$this->fields[$j]['name']."'></td></tr>"; 
       } 
       echo "<tr><td colspan='2'>"; 
       echo "<input type='submit' value='".$this->submit."'></td></tr>"; 
       echo "</table>"; 
   } 
  
   public function addField($name, $label) 
   { 
       $this->fields [$this->jumField]['name'] = $name; 
       $this->fields [$this->jumField]['label'] = $label; 
       $this->jumField ++; 
   } 
} 
?>
```

# MEMBUAT FILE DENGAN NAMA ```form_input.php```

```
<?php
/**
* Program memanfaatkan Program 10.2 untuk membuat form inputan sederhana.
**/

include "form.php";

echo "<html><head><title>Mahasiswa</title></head><body>";
$form = new Form("","Input Form");
$form->addField("txtnim", "Nim");
$form->addField("txtnama", "Nama");
$form->addField("txtalamat", "Alamat");
echo "<h3>Silahkan isi form berikut ini :</h3>";
$form->displayForm();
echo "</body></html>";

?>
```

# MEMBUAT FILE DENGAN NAMA ```database.php```

```
<?php

class Database 
{
    protected $host;
    protected $user;
    protected $password;
    protected $db_name;
    protected $conn;

    public function __construct() 
    {
        $this->getConfig();

        $this->conn = new mysqli(
            $this->host,
            $this->user,
            $this->password,
            $this->db_name
        );

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    private function getConfig() 
    {
        include_once("config.php");
        $this->host     = $config['host'];
        $this->user     = $config['username'];
        $this->password = $config['password'];
        $this->db_name  = $config['db_name'];
    }

    public function query($sql) 
    {
        return $this->conn->query($sql);
    }

    public function get($table, $where = null) 
    {
        if ($where) {
            $where = " WHERE " . $where;
        }

        $sql = "SELECT * FROM " . $table . $where;
        $sql = $this->conn->query($sql);
        $sql = $sql->fetch_assoc();

        return $sql;
    }

    public function insert($table, $data) 
    {
        if (is_array($data)) {
            foreach ($data as $key => $val) {
                $column[] = $key;
                $value[]  = "'{$val}'";
            }

            $columns = implode(",", $column);
            $values  = implode(",", $value);
        }

        $sql = "INSERT INTO " . $table . " ($columns) VALUES ($values)";
        $sql = $this->conn->query($sql);

        if ($sql == true) {
            return $sql;
        } else {
            return false;
        }
    }

    public function update($table, $data, $where) 
    {
        $update_value = [];

        if (is_array($data)) {
            foreach ($data as $key => $val) {
                $update_value[] = "$key='{$val}'";
            }
            $update_value = implode(",", $update_value);
        }

        $sql = "UPDATE " . $table . " SET " . $update_value . " WHERE " . $where;
        $sql = $this->conn->query($sql);

        if ($sql == true) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($table, $filter) 
    {
        $sql = "DELETE FROM " . $table . " " . $filter;
        $sql = $this->conn->query($sql);

        if ($sql == true) {
            return true;
        } else {
            return false;
        }
    }
}

?>
```

# MEMBUAT FILE DENGAN NAMA ```config.php```

```
<?php
$config = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'db_name' => 'lab10_php_oop'
];
?>
```

# HASIL PADA BROWSER DARI FILE ```mobil.php```

<img width="274" height="244" alt="Screenshot 2025-12-04 194348" src="https://github.com/user-attachments/assets/ec9f1751-fbe5-4511-bb53-2721112917a5" />

   Gambar ini menampilkan hasil dari pemrograman PHP yang menggunakan konsep OBject Orientasi Pemrograman (OOP) dengan membuat ```class mobil```.
   
# PERTANYAAN DAN TUGAS 

<img width="597" height="85" alt="Screenshot 2025-12-04 204237" src="https://github.com/user-attachments/assets/aabbf998-e744-4e79-8bf9-fb68f5164c0f" />

   
