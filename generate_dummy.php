<?php
require 'vendor/autoload.php';
$faker = Faker\Factory::create('id_ID');

$passwordHash = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // 'password'

$sql = "INSERT INTO `users` (`name`, `nik`, `no_bpjs`, `email`, `no_hp`, `password`, `role`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `created_at`, `updated_at`) VALUES\n";

$values = [];
for ($i = 0; $i < 200; $i++) {
    $name = addslashes($faker->name);
    $nik = $faker->numerify('################');
    $no_bpjs = $faker->numerify('#############');
    $email = addslashes($faker->unique()->safeEmail);
    $no_hp = $faker->numerify('08##########');
    $role = 'pasien'; 
    $tanggal_lahir = $faker->dateTimeBetween('-50 years', '-10 years')->format('Y-m-d');
    $jenis_kelamin = $faker->randomElement(['L', 'P']); 
    $alamat = addslashes($faker->address);
    $now = date('Y-m-d H:i:s');
    
    $values[] = "('$name', '$nik', '$no_bpjs', '$email', '$no_hp', '$passwordHash', '$role', '$tanggal_lahir', '$jenis_kelamin', '$alamat', '$now', '$now')";
}

$sql .= implode(",\n", $values) . ";\n";

file_put_contents('dummy_users.sql', $sql);
echo "SQL File generated successfully.";
