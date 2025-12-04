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

Program ini merupakan contoh sederhana penerapan konsep OOP dalam PHP. Pada program ini dibuat ```class``` bernama "MOBIL" yang memiliki tiga properti utama yaitu ```warna```. ```merk```, dan ```harga```, yang semuanya bersifat private sehingga tidak dapat diakses secara langsung dari luar ```class```. 

```class``` ini juga menyediakan dua method, yaitu ```gantiWarna()``` untuk menggati warna mobil dan ```tampilWarna()``` untuk menampilkan warna mobil saat ini. setelah ```class``` didefinisikan, program mendefinisikan dua objek, yaitu ```$a``` sebagai mobil pertama dan ```$b``` sebagai mobil kedua.  

Berikut hasil pada Browser 

<img width="274" height="244" alt="Screenshot 2025-12-04 194348" src="https://github.com/user-attachments/assets/11fafa8e-2ca0-4a8b-9bdb-7286ac53219b" />


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

```class``` ini dibuat agar pembuatan form menjadi lebih mudah, terstruktur, dan tidak perlu ditulis secara manual setiap kali dibutuhkan. Di dalam ```class``` ini terdapat beberapa properti, yaitu ```$fields``` yang berfungsi untuk menyimpan daftar field yang akan ditampilkan, ```$action``` untuk menentukan tujuan ketika form dikirimkan, ```$submit``` sebagai label tombol submit, serta ```$jumlahField``` untuk menghitung jumlah field yang ditambahkan.

```class``` ini menyediakan tiga method utama. ```__construct()``` digunakan untuk mengatur nilai awal seperti action form dan teks pada tombol submit, ```addField``` berfungsi untuk menambahkan field baru ke dalam form lengkap dangan nama dan labelnya, sedangkan ```displayForm()``` digunakan untuk menampilkan form dalam bentuk tabel HTML beserta semua field dan tombol submit yang telah ditambahkan. 

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

Program ini merupakan implementasi dari ```class library form``` untuk membuat sebiuah form input sederhana. Pada program ini, file ```form.php``` di include terlebih dahulu karena berisi definisi ```class``` yang diperlukan untuk membangun form secara dinamis. Setelah itu program membentuk struktur dasar halaman HTML dan membuat sebuah objek dari class form, dengan parameter action kosong dan label tombol sebmit berupa "Input Form". 

Program ini menambahkan beberapa field input kedalam form, yaitu field untuk NIM, Nama, dan Alamat, masing-masing menggunakan method ```addfield()```. Setelah seluruh field ditambahkan, program menampilkan judul "Silahkan isi form berikut ini:", kemudia memanggil method ```displayForm()``` untuk menampilkan form secara lengkap di dalam halaman HTML. 

Berikut hasil pada Browser 

<img width="511" height="277" alt="Screenshot 2025-12-04 200300" src="https://github.com/user-attachments/assets/59daed8f-a050-47ce-8a97-88ed65a8b7ef" />

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

Program ini berisi sebuah ```class``` bernama database yang digunakan untuk mengelola proses koneksi dan interaksi dengan database menggunakan pendekatan OOP dalam PHP. ```class``` ini dirancang agar proses koneksi, pengambilan data, penambahan data, pembaruan data, dan penghapusan data dapat dilakukan secara lebih terstruktur dan mudah digunakan kembali. 

```class``` ini menyediakan beberapa method utama yaitu,  ```query()``` digunakan untuk menjalankan perintah SQL secara langsung, ```get()``` berfungsi untuk mengambil satu data dari sebuah tabel, dengan opsi menggunakan kondisi tertentu, ```insert()``` digunakan untuk nemambahkan data baru ke dalam tabel, dimana data dikirim dalam bentuk array dan otomatis diubah menjadi format SQL yang sesuai, ```update()``` digunakan untuk memperbarui data berdasarkan kondisi tertentu, dan ```delete()``` digunakan untuk menghapus data dari tabel sesuai filter yang diberikan. 

   
# PERTANYAAN DAN TUGAS 

<img width="597" height="85" alt="Screenshot 2025-12-04 204237" src="https://github.com/user-attachments/assets/aabbf998-e744-4e79-8bf9-fb68f5164c0f" />

Hasilnya: 

<img width="616" height="376" alt="Screenshot 2025-12-04 230505" src="https://github.com/user-attachments/assets/fb544738-b71a-404f-af1b-329ec9a10a70" />


   
