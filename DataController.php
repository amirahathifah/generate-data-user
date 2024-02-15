<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function datapelajar()
    {
        $maleFirstNames = ['Ahmad', 'Mohd', 'Abdul', 'Muhammad', 'Aziz', 'Farid', 'Hakim', 'Rahman', 'Haris', 'Zaki'];
        $femaleFirstNames = ['Siti', 'Nor', 'Aisyah', 'Fatimah', 'Zainab', 'Aisha', 'Laila', 'Nurul', 'Sofia', 'Amira'];
        $lastNames = ['Mohd Ali', 'Ismail', 'Abdullah', 'Omar', 'Hassan', 'Rahman', 'Ahmad', 'Salleh', 'Yusof', 'Ibrahim'];
        
        // Generate and directly output 5,000 names
        for ($i = 1; $i <= 10; $i++) {
            $gender = rand(0, 1) ? 'male' : 'female';
            $lastName = $lastNames[array_rand($lastNames)];
            
            if ($gender === 'male') {
                $firstName = $maleFirstNames[array_rand($maleFirstNames)];
                $fullName = $firstName . ' bin ' . $lastName;
            } else {
                $firstName = $femaleFirstNames[array_rand($femaleFirstNames)];
                $fullName = $firstName . ' binti ' . $lastName;
            }

            $email = strtolower( $firstName . $lastName) . '@gmail.com';

            // Generate a random identification number for users aged 18 and above
            $age = rand(25, 60); //Range 1999 - 1964(25-60tahun)
            $ic = $this->generateIc($age);

            // Extract birthdate from identification number
            $birthdate = '19' . substr($ic, 0, 2) . '-' . substr($ic, 2, 2) . '-' . substr($ic, 4, 2);

            // $user = new User();
            // $user->nama_penuh = $fullName;
            // $user->email = $email;
            // $user->id_jenis_pengenalan_diri = 1;
            // $user->nombor_pengenalan_diri = $ic;
            // $user->tarikh_lahir = $birthdate;
            // $user->id_status_akaun = 2;
            // $user->password = bcrypt('12345678');
            // $user->save();
            // $user->roles()->attach($pengguna_smbp);
            // $user->permissions()->attach($pendaftaran_keahlian_pengakap);
            // $user->permissions()->attach($membuat_pembayaran_keahlian);
            // $user->permissions()->attach($melihat_profil);

            $data = json_encode([
                'nama_penuh' => $fullName,
                'email' => $email,
                'id_jenis_pengenalan_diri' => 1,
                'nombor_pengenalan_diri' => $ic,
                'tarikh_lahir' => $birthdate,
                'id_status_akaun' => 2,
                'password' => bcrypt('12345678')
            ], JSON_PRETTY_PRINT);
    
            dump("User $i:\n$data");
        }
        
    }

    function generateIc($age) 
    {
        // Logic to generate identification number based on age
        // Format: YYMMDD-SS-NNNN
        $year = date('Y') - $age;
        $year = substr($year, 2, 4);
        $month = rand(1, 12);
        $day = rand(1, 28); // Assuming all months have 28 days for simplicity
        $state = rand(1, 16); // Random state 
        $randomDigits = sprintf("%04d", rand(0, 9999));
    
        return sprintf("%02d%02d%02d-%02d-%s", $year, $month, $day, $state, $randomDigits);
    }

}
