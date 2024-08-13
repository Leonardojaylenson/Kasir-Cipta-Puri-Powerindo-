<?php

namespace App\Controllers;
use CodeIgniter\Models\Controller;
use App\Models\M_pb;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
date_default_timezone_set('Asia/Jakarta');
use TCPDF;
class Home extends BaseController
{
	private function log_activity($activity)
    {
		$model = new M_pb();
        $data = [
            'id_user'    => session()->get('id'),
            'activity'   => $activity,
			'timestamp' => date('Y-m-d H:i:s'),
			'delete' => '0'
        ];

        $model->tambah('activity', $data);
    }

	private function log_activitys($activity, $id)
    {
		$model = new M_pb();
        $data = [
            'id_user'    => $id,
            'activity'   => $activity,
			'timestamp' => date('Y-m-d H:i:s'),
			'delete' => '0'
        ];

        $model->tambah('activity', $data);
    }

	private function updatelog($update)
    {
		$model = new M_pb();
        $data = [
            'id_user'    => session()->get('id'),
            'updated'   => $update,
			'timestamp' => date('Y-m-d H:i:s'),
			'delete' => '0'
        ];

        $model->tambah('updatelog', $data);
    }
	
	public function index(){
		if (session()->get('level') > 0) {
		$this->log_activity('User membuka Dashboard');
		$model = new M_pb();
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
		$data['menus'] = $model->getFilteredMenu();
		echo view('header',$data);
		echo view('menu',$data);
		echo view('dashboard');
		echo view('footer');
	} else {
		return redirect()->to('Home/login');
	}
	}

	public function login(){
		$model = new M_pb();
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
		echo view('header',$data);
		echo view('login');
	}

	public function generateCaptcha()
{
    // Create a string of possible characters
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $captcha_code = '';
    
    // Generate a random CAPTCHA code with letters and numbers
    for ($i = 0; $i < 6; $i++) {
        $captcha_code .= $characters[rand(0, strlen($characters) - 1)];
    }
    
    // Store CAPTCHA code in session
    session()->set('captcha_code', $captcha_code);
    
    // Create an image for CAPTCHA
    $image = imagecreate(120, 40); // Increased size for better readability
    $background = imagecolorallocate($image, 200, 200, 200);
    $text_color = imagecolorallocate($image, 0, 0, 0);
    $line_color = imagecolorallocate($image, 64, 64, 64);
    
    imagefilledrectangle($image, 0, 0, 120, 40, $background);
    
    // Add some random lines to the CAPTCHA image for added complexity
    for ($i = 0; $i < 5; $i++) {
        imageline($image, rand(0, 120), rand(0, 40), rand(0, 120), rand(0, 40), $line_color);
    }
    
    // Add the CAPTCHA code to the image
    imagestring($image, 5, 20, 10, $captcha_code, $text_color);
    
    // Output the CAPTCHA image
    header('Content-type: image/png');
    imagepng($image);
    imagedestroy($image);
}


public function aksi_login()
{
    // Periksa koneksi internet
    if (!$this->checkInternetConnection()) {
        // Jika tidak ada koneksi, cek CAPTCHA gambar
        $captcha_code = $this->request->getPost('captcha_code');
        if (session()->get('captcha_code') !== $captcha_code) {
            session()->setFlashdata('toast_message', 'Invalid CAPTCHA');
            session()->setFlashdata('toast_type', 'danger');
            return redirect()->to('home/login');
        }
    } else {
        // Jika ada koneksi, cek Google reCAPTCHA
        $recaptchaResponse = trim($this->request->getPost('g-recaptcha-response'));
        $secret = '6LeKfiAqAAAAAFkFzd_B9MmWjX76dhdJmJFb6_Vi'; // Ganti dengan Secret Key Anda
        $credential = array(
            'secret' => $secret,
            'response' => $recaptchaResponse
        );

        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
        curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($verify);
        curl_close($verify);

        $status = json_decode($response, true);

        if (!$status['success']) {
            session()->setFlashdata('toast_message', 'Captcha validation failed');
            session()->setFlashdata('toast_type', 'danger');
            return redirect()->to('home/login');
        }
    }

    // Proses login seperti biasa
    $u = $this->request->getPost('username');
    $p = $this->request->getPost('password');

    $where = array(
        'username' => $u,
        'password' => md5($p),
        'status' => 'verified'
    );
    $model = new M_pb;
    $cek = $model->getWhere('user', $where);

    if ($cek) {
        $this->log_activitys('User Melakukan Login', $cek->id_user);
        session()->set('nama', $cek->username);
        session()->set('id', $cek->id_user);
        session()->set('level', $cek->level);
        return redirect()->to('home/');
    } else {
        session()->setFlashdata('toast_message', 'Invalid login credentials');
        session()->setFlashdata('toast_type', 'danger');
        return redirect()->to('home/login');
    }
}

public function checkInternetConnection()
{
    $connected = @fsockopen("www.google.com", 80);
    if ($connected) {
        fclose($connected);
        return true;
    } else {
        return false;
    }
}




	public function logout()
	{
		$this->log_activity('User Logout');
		session()->destroy();
		return redirect()->to('home/login');
	}

	public function signup(){
		$model = new M_pb();
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
		echo view('header',$data);
		echo view('signup');
	}

	public function user(){
		if (session()->get('level') == 1) {
			$model = new M_pb();
			$where = array('id_user' => session()->get('id'));
			$data['dua'] = $model->getwhere('user', $where);
			$where1 = array('delete' => '0');
			$data['satu'] = $model->tampilwhere('user',$where1);
			$where = array('id_setting' => 1);
			$data['setting'] = $model->getwhere('setting', $where);
			$this->log_activity('User Membuka View user');
			$data['menus'] = $model->getFilteredMenu();
			echo view('header',$data);
			echo view('menu',$data);
			echo view('user',$data);
			echo view('footer');
		} elseif(session()->get('level') == 2||session()->get('level') == 3) {
			return redirect()->to('Home/notfound');
		}else{
			return redirect()->to('home/login');
		}
	}

	public function ruser(){
		if (session()->get('level') == 1) {
			$model = new M_pb();
			$where = array('id_user' => session()->get('id'));
			$data['dua'] = $model->getwhere('user', $where);
			$where1 = array('delete' => '1');
			$data['satu'] = $model->tampilwhere('user',$where1);
			$where = array('id_setting' => 1);
			$data['setting'] = $model->getwhere('setting', $where);
			$this->log_activity('User Membuka View ruser');
			$data['menus'] = $model->getFilteredMenu();
			echo view('header',$data);
			echo view('menu',$data);
			echo view('user',$data);
			echo view('footer');
		} elseif(session()->get('level') == 2||session()->get('level') == 3) {
			return redirect()->to('Home/notfound');
		}else{
			return redirect()->to('home/login');
		}
	}

	public function tuser(){
		if (session()->get('level') == 1) {
			$model = new M_pb();
			$where = array('id_user' => session()->get('id'));
			$data['dua'] = $model->getwhere('user', $where);
			$where = array('id_setting' => 1);
			$data['setting'] = $model->getwhere('setting', $where);
			$this->log_activity('User Membuka View tuser');
			$data['menus'] = $model->getFilteredMenu();
			echo view('header',$data);
			echo view('menu',$data);
			echo view('tuser',$data);
			echo view('footer');
		} elseif(session()->get('level') == 2||session()->get('level') == 3) {
			return redirect()->to('Home/notfound');
		}else{
			return redirect()->to('home/login');
		}
	}
	
	public function detailuser($id){
		if (session()->get('level') == 1 ) {
			$model = new M_pb();
			$where = array('id_user' => session()->get('id'));
			$data['dua'] = $model->getwhere('user', $where);
			$where = array('id_user' => $id);
			$data['satu'] = $model->getWhere('user',$where);
			$where = array('id_setting' => 1);
			$data['setting'] = $model->getwhere('setting', $where);
			$this->log_activity('User Membuka View detailuser');
			$data['menus'] = $model->getFilteredMenu();
			echo view('header',$data);
			echo view('menu',$data);
			echo view('euser',$data);
			echo view('footer');
		} elseif(session()->get('level') == 2||session()->get('level') == 3) {
			return redirect()->to('Home/notfound');
		}else{
			return redirect()->to('home/login');
		}
	}
// 	public function aksi_signup()
// {
//     $leo = $this->request->getPost('username');
//     $gtw = $this->request->getPost('password');
//     $gtww = $this->request->getPost('email');

//     $info = array(
//         'username' => $leo,
//         'password' => md5($gtw),
//         'email' => $gtww,
//         'level' => 3,
//         'status' => 'unverified',
// 		'delete' => '0',
// 		'foto' => 'admin.jpg'
//     );

//     $model = new M_pb;
//     $model->tambah('user', $info);

//     // Generate 6-character verification code
//     $token = $this->generateVerificationCode(6);

//     // Save token and email in the database along with the timestamp
//     $model->simpantoken($gtww, $token);

//     // Load Composer's autoloader
//     require ROOTPATH . 'vendor/autoload.php';

//     $mail = new PHPMailer(true);
//     try {
//         // Server settings
//         $mail->isSMTP();
//         $mail->Host = 'smtp.gmail.com';
//         $mail->SMTPAuth = true;
//         $mail->Username = 'btmcuyy@gmail.com';
//         $mail->Password = 'epce juqn nrfl npux';
//         $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//         $mail->Port = 587; // TLS port

//         // Recipients
//         $mail->setFrom('btmcuyy@gmail.com', 'Verifikasi Signup');
//         $mail->addAddress($gtww); // Add recipient

//         // Content
//         $mail->isHTML(true);
//         $mail->Subject = 'Verifikasi Cipta Puri Powerindo';
        
//         // Email body content
//         $mailContent = "<h1>Verifikasi Alamat Email Anda</h1>
//                         <p>Gunakan kode verifikasi di bawah ini untuk memverifikasi alamat email Anda:</p>
//                         <p><strong>{$token}</strong></p>";
//         $mail->Body = $mailContent;

//         $mail->send();
//         echo "
//         <script>
//         alert('Berhasil Terkirim');
//         window.location.href = '".base_url('home/belipoint')."';
//         </script>
//         ";
//     } catch (Exception $e) {
//         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//     }

//     return redirect()->to('home/verifikasi');
// }



private function generateVerificationCode($length = 6)
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

	public function verifikasi(){
		$model = new M_pb;
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
		echo view('header',$data);
		echo view('verifikasi');
	}

	public function verify()
{
    $token = $this->request->getPost('token');
    $model = new M_pb;

    // Get the email associated with the token
    $email = $model->getEmailByToken($token);

    if ($email) {
        // Update user status to "verified"
        $model->updateUserStatus($email, 'verified');
        
        // Delete the token after verification
        $model->deleteToken($token);

		session()->setFlashdata('toast_message', 'Verifikasi Berhasil');
        session()->setFlashdata('toast_type', 'success');
		return redirect()->to('home/login');
    } else {
		session()->setFlashdata('toast_message', 'Token Salah');
        session()->setFlashdata('toast_type', 'Danger');
		return redirect()->to('home/verifikasi');
    }
}

public function barang(){
	$model = new M_pb();
	$data['menus'] = $model->getFilteredMenu();
	if (session()->get('level') == 1 || $data('menus')->show_for_level_3 == 1) {
	
	$this->log_activity('User membuka view barang');
	$where = array('id_user' => session()->get('id'));
	$data['dua'] = $model->getwhere('user', $where);
	$where1 = array('barang.delete' => '0');
	$data['satu'] = $model->tampilWhere('barang',$where1);
	$where = array('id_setting' => 1);
	$data['setting'] = $model->getwhere('setting', $where);
	
	echo view('header',$data);
	echo view('menu',$data);
	echo view('barang',$data);
	echo view('footer');
} elseif(session()->get('level') == 2||session()->get('level') == 3) {
	return redirect()->to('Home/notfound');
}else{
	return redirect()->to('home/login');
}
}

public function tbarang(){
	if (session()->get('level') == 1) {
		$model = new M_pb();
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$data['satu'] = $model->tampil('barang');
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
		$this->log_activity('User Membuka View tbarang');
		$data['menus'] = $model->getFilteredMenu();
		echo view('header',$data);
		echo view('menu',$data);
		echo view('tbarang',$data);
		echo view('footer');
	} elseif(session()->get('level') == 2||session()->get('level') == 3) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('home/login');
	}
}

public function barangmasuk(){
	if (session()->get('level') == 1) {
	$model = new M_pb();
	$where = array('id_user' => session()->get('id'));
	$data['dua'] = $model->getwhere('user', $where);
	$where1 = array('barangmasuk.delete' => '0');
	$data['satu'] = $model->joinresult('barangmasuk','barang','barangmasuk.id_barang = barang.id_barang',$where1);
	$where = array('id_setting' => 1);
	$data['setting'] = $model->getwhere('setting', $where);
	$this->log_activity('User Membuka View barangmasuk');
	$data['menus'] = $model->getFilteredMenu();
	echo view('header',$data);
	echo view('menu',$data);
	echo view('barang',$data);
	echo view('footer');
} elseif(session()->get('level') == 2||session()->get('level') == 3) {
	return redirect()->to('Home/notfound');
}else{
	return redirect()->to('home/login');
}
}

public function tbarangm(){
	if (session()->get('level') == 1) {
		$model = new M_pb();
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$data['satu'] = $model->joinnowhere('barangmasuk','barang','barangmasuk.id_barang = barang.id_barang');
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
		$this->log_activity('User Membuka View tbarangm');
		$data['menus'] = $model->getFilteredMenu();
		echo view('header',$data);
		echo view('menu',$data);
		echo view('tbarangm',$data);
		echo view('footer');
	} elseif(session()->get('level') == 2||session()->get('level') == 3) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('home/login');
	}
}

public function aksi_tbarangm(){
	$model = new M_pb();
	
	$nbarang = $this->request->getPost('namabarang');
	$stok = $this->request->getPost('stok');
	$this->log_activity('User Menambah Data Barang Masuk');
	$data = array(
        'id_barang' => $nbarang,
        'quantity' => $stok,
		'delete' => '0',
		'tanggal' => date('Y-m-d'),
		'create_at' => date('Y-m-d H:i:s'),
		'create_by' => session()->get('id'),
    );

	$model->tambah('barangmasuk', $data);
	$model->tambah('barangmasuk_backup', $data);
    return redirect()->to('home/barangmasuk');
}

public function barangkeluar(){
	if (session()->get('level') == 1) {
	$model = new M_pb();
	$where = array('id_user' => session()->get('id'));
	$data['dua'] = $model->getwhere('user', $where);
	$where1 = array('barangkeluar.delete' => '0');
	$data['satu'] = $model->joinresult('barangkeluar','barang','barangkeluar.id_barang = barang.id_barang',$where1);
	$where = array('id_setting' => 1);
	$data['setting'] = $model->getwhere('setting', $where);
	$this->log_activity('User Membuka View barangkeluar');
	$data['menus'] = $model->getFilteredMenu();
	echo view('header',$data);
	echo view('menu',$data);
	echo view('barang',$data);
	echo view('footer');
} elseif(session()->get('level') == 2||session()->get('level') == 3) {
	return redirect()->to('Home/notfound');
}else{
	return redirect()->to('home/login');
}
}

public function tbarangk(){
	if (session()->get('level') == 1) {
		$model = new M_pb();
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$data['satu'] = $model->joinnowhere('barangkeluar','barang','barangkeluar.id_barang = barang.id_barang');
		$data['tiga'] = $model->tampil('barang');
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
		$this->log_activity('User Membuka View tbarangk');
		$data['menus'] = $model->getFilteredMenu();
		echo view('header',$data);
		echo view('menu',$data);
		echo view('tbarangk',$data);
		echo view('footer');
	} elseif(session()->get('level') == 2||session()->get('level') == 3) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('home/login');
	}
}

public function aksi_tbarangk(){
	$model = new M_pb();
	
	$nbarang = $this->request->getPost('namabarang');
	$stok = $this->request->getPost('stok');
	$this->log_activity('User Menambahkan Data Barang Keluar');
	$data = array(
        'id_barang' => $nbarang,
        'jumlah' => $stok,
		'delete' => '0',
		'tanggal' => date('Y-m-d'),
		'create_at' => date('Y-m-d H:i:s'),
		'create_by' => session()->get('id'),
    );

	$model->tambah('barangkeluar', $data);
	$model->tambah('barangkeluar_backup', $data);
    return redirect()->to('home/barangkeluar');
}

public function aksi_tuser(){
	$model = new M_pb();
	$uploadedFile = $this->request->getfile('foto');
	$username = $this->request->getPost('username');
	$password = $this->request->getPost('password');
	$email = $this->request->getPost('email');
	$level = $this->request->getPost('level');
	$this->log_activity('User Menambahkan User');
	if ($uploadedFile->getName()) {
		$foto = $uploadedFile->getName();
		$model->upload($uploadedFile);

	$data = array(
        'username' => $username,
        'password' => md5($password),
        'email' => $email,
		'foto' => $foto,
		'level' => $level,
		'status' => 'verified',
		'delete' => '0'
    );

	}else{
		$data = array(
			'username' => $username,
			'password' => md5($password),
			'email' => $email,
			'foto' => 'admin.jpg',
			'level' => $level,
			'status' => 'verified',
			'delete' => '0'
		);
	}
	

		

    $model->tambah('user', $data);
    return redirect()->to('home/user');
}

public function aksi_signup(){
	$model = new M_pb();
	$username = $this->request->getPost('username');
	$password = $this->request->getPost('password');
	$email = $this->request->getPost('email');


	$data = array(
        'username' => $username,
        'password' => md5($password),
        'email' => $email,
		'level' => '3',
		'status' => 'verified',
		'delete' => '0',
		'foto' => 'admin.jpg'
    );
	
	

		

    $model->tambah('user', $data);
    return redirect()->to('home/login');
}

public function aksi_euser(){
	$model = new M_pb();
	$uploadedFile = $this->request->getfile('foto');
	$username = $this->request->getPost('username');
	$email = $this->request->getPost('email');
	$level = $this->request->getPost('level');
	$id = $this->request->getPost('id');
	$where = array('id_user' => $id);
	$this->log_activity('User Mengupdate Data user');
	if ($uploadedFile->getName()) {
		$foto = $uploadedFile->getName();
		$model->upload1($uploadedFile);

		
	$data = array(
        'username' => $username,
        'email' => $email,
		'foto' => $foto,
		'level' => $level,
		'update_by' => session()->get('id'),
		'update_at' => date('Y-m-d H:i:s')
    );

	}else{
		$data = array(
			'username' => $username,
			'email' => $email,
			'level' => $level,
			'update_by' => session()->get('id'),
			'update_at' => date('Y-m-d H:i:s')
		);
	}
	

		

    $model->edit('user', $data, $where);
    return redirect()->to('home/user');
}

public function huser($id)
	{
		$model = new M_pb();
		$where = array('id_user' => $id);
		$model->hapus('user', $where);
		$this->log_activity('User Menghapus data user');

		return redirect()->to('Home/ruser');
	}
public function ebarang($id){
	if (session()->get('level') == 1) {
		$model = new M_pb();
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$where = array('id_barang' => $id);
		$data['satu'] = $model->getWhere('barang',$where);
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
		$this->log_activity('User Membuka View ebarang');
		$data['menus'] = $model->getFilteredMenu();
		echo view('header',$data);
		echo view('menu',$data);
		echo view('ebarang',$data);
		echo view('footer');
	} elseif(session()->get('level') == 2||session()->get('level') == 3) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('home/login');
	}
}

public function ebarangk($id){
	if (session()->get('level') == 1) {
		$model = new M_pb();
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$where5 = array('id_bkeluar' => $id);
		$data['satu'] = $model->getWhere('barangkeluar',$where5);
		$data['tiga'] = $model->joinnowhere('barang','barangkeluar','barang.id_barang = barangkeluar.id_barang');
		$data['empat'] = $model->tampil('barang');
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
		$this->log_activity('User Membuka View ebarangk');
		$data['menus'] = $model->getFilteredMenu();
		echo view('header',$data);
		echo view('menu',$data);
		echo view('ebarangk',$data);
		echo view('footer');
	
	} elseif(session()->get('level') == 2||session()->get('level') == 3) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('home/login');
	}
}

public function ebarangm($id){
	if (session()->get('level') == 1) {
		$model = new M_pb();
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$where5 = array('id_bmasuk' => $id);
		$data['satu'] = $model->getWhere('barangmasuk',$where5);
		$data['tiga'] = $model->joinnowhere('barang','barangmasuk','barang.id_barang = barangmasuk.id_barang');
		$data['empat'] = $model->tampil('barang');
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
		$this->log_activity('User Membuka View ebarangm');
		$data['menus'] = $model->getFilteredMenu();
		echo view('header',$data);
		echo view('menu',$data);
		echo view('ebarangm',$data);
		echo view('footer');
	
	} elseif(session()->get('level') == 2||session()->get('level') == 3) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('home/login');
	}
}

public function aksi_ebarangk(){
	$model = new M_pb();
	$nbarang = $this->request->getPost('namabarang');
	$stok = $this->request->getPost('stok');
	$tanggal = $this->request->getPost('tanggal');
	$create_at = $this->request->getPost('create_at');
	$id = $this->request->getPost('id');
	$this->log_activity('User Mengupdate Data Barang Keluar');
	$data = array(
        'id_barang' => $nbarang,
        'jumlah' => $stok,
		'update_by' => session()->get('id'),
		'update_at' => date('Y-m-d H:i:s'),
		'create_at' => $create_at,
		'tanggal' => $tanggal,
    );
	print_r($data);
	$this->updatelog('User Updated Data Barang Keluar');
	$where = array('id_bkeluar' => $id);
    $model->edit('barangkeluar', $data, $where);
    return redirect()->to('home/barangkeluar');
}

public function aksi_ebarangm(){
	$model = new M_pb();
	$nbarang = $this->request->getPost('namabarang');
	$stok = $this->request->getPost('stok');
	$tanggal = $this->request->getPost('tanggal');
	$create_at = $this->request->getPost('create_at');
	$id = $this->request->getPost('id');
	$this->log_activity('User Mengupdate Data Barang Masuk');
	$data = array(
        'id_barang' => $nbarang,
        'quantity' => $stok,
		'update_by' => session()->get('id'),
		'update_at' => date('Y-m-d H:i:s'),
		'create_at' => $create_at,
		'tanggal' => $tanggal,
    );
	print_r($data);
	
	$where = array('id_bmasuk' => $id);
    $model->edit('barangmasuk', $data, $where);
	$this->updatelog('User Updated Data Barang Masuk');
    return redirect()->to('home/barangmasuk');
}


public function aksi_ebarang(){
	$model = new M_pb();
	$nbarang = $this->request->getPost('nbarang');
	$kbarang = $this->request->getPost('kbarang');
	$hbeli = $this->request->getPost('hbeli');
	$hjual = $this->request->getPost('hjual');
	$stok = $this->request->getPost('stok');
	$status = $this->request->getPost('status');
	$id = $this->request->getPost('id');
	$this->log_activity('User Mengupdate Data Barang');
	$data = array(
        'nama_barang' => $nbarang,
        'kode_barang' => $kbarang,
        'harga_beli' => $hbeli,
        'harga_jual' => $hjual,
        'stok' => $stok,
        'status' => $status,
		'update_by' => session()->get('id'),
		'update_at' => date('Y-m-d H:i:s')
    );
	$where = array('id_barang' => $id);
    $model->edit('barang', $data, $where);
	$this->updatelog('User Updated Data Barang');
    return redirect()->to('home/barang');
}



public function aksi_tbarang(){
	$model = new M_pb();
	$uploadedFile = $this->request->getfile('foto');
	$nbarang = $this->request->getPost('nbarang');
	$kbarang = $this->request->getPost('kbarang');
	$hbeli = $this->request->getPost('hbeli');
	$hjual = $this->request->getPost('hjual');
	$stok = $this->request->getPost('stok');
	$status = $this->request->getPost('status');
	$this->log_activity('User Menambahkan Data Barang');

	if ($uploadedFile->getName()) {
			$foto = $uploadedFile->getName();
			$model->upload($uploadedFile);

	$data = array(
        'nama_barang' => $nbarang,
        'kode_barang' => $kbarang,
        'harga_beli' => $hbeli,
        'harga_jual' => $hjual,
        'stok' => $stok,
        'status' => $status,
		'delete' => '0',
		'foto' => $foto,
		'create_at' => date('Y-m-d H:i:s'),
		'create_by' => session()->get('id'),
    );
	}else{
		$data = array(
		'nama_barang' => $nbarang,
        'kode_barang' => $kbarang,
        'harga_beli' => $hbeli,
        'harga_jual' => $hjual,
        'stok' => $stok,
        'status' => $status,
		'delete' => '0',
		'create_at' => date('Y-m-d H:i:s'),
		'create_by' => session()->get('id'),
		);
	}
	$model->tambah('barang', $data);
	$model->tambah('barang_backup', $data);
    return redirect()->to('home/barang');
}

public function hkeranjang($id)
	{
		$model = new M_pb();
		$where = array('kode_keranjang' => $id);
		$model->hapus('keranjang', $where);
		$this->log_activity('User mendelete Data Keranjang');
		return redirect()->to('Home/keranjang/'.session()->get('id'));
	}

public function hdatakeranjang($id)
	{
		$model = new M_pb();
		$where = array('kode_keranjang' => $id);
		$model->hapus('keranjang', $where);
		$this->log_activity('User mendelete Data Keranjang');
		return redirect()->to('Home/datakeranjang/');
	}

	public function sddatakeranjang($id)
	{
			$model = new M_pb;
			$where = array('kode_keranjang' => $id);
			// Ubah status transaksi menjadi "habis" di kedua tabel
			$model->softdelete2('keranjang', 'deletek', '1', $where);
			$this->log_activity('User Soft Delete Data Keranjang');
			// Kirim respons (jika diperlukan)
			return redirect()->to('home/datakeranjang/');
	}

	public function rsdatakeranjang($id){
		$model = new M_pb;
		// Pass the where condition directly to the softdelete() function
		$where = array('kode_keranjang' => $id);
		$this->log_activity('User Restore Data Keranjang');
			// Ubah status transaksi menjadi "habis" di kedua tabel
		$model->softdelete2('keranjang', 'deletek', '0', $where);
		
		return redirect()->to('home/rkeranjang/');
	}

	public function sdkeranjang($id)
{
		$model = new M_pb;
		$where = array('kode_keranjang' => $id);
		$this->log_activity('User Soft Delete Data Keranjang');
		// Ubah status transaksi menjadi "habis" di kedua tabel
		$model->softdelete2('keranjang', 'deletek', '1', $where);

		// Kirim respons (jika diperlukan)
		return redirect()->to('home/keranjang/'.session()->get('id'));
}

public function rskeranjang($id){
	$model = new M_pb;
	// Pass the where condition directly to the softdelete() function
	$where = array('kode_keranjang' => $id);
	$this->log_activity('User Restore Data Keranjang');
		// Ubah status transaksi menjadi "habis" di kedua tabel
	$model->softdelete2('keranjang', 'deletek', '0', $where);
	
	return redirect()->to('home/keranjang/'.session()->get('id'));
}

public function hbarang($id)
	{
		$model = new M_pb();
		$where = array('id_barang' => $id);
		$model->hapus('barang', $where);
		$this->log_activity('User Hapus Data barang');
		return redirect()->to('Home/barang');
	}

public function sdbarang($id)
{
		$model = new M_pb;
		// Ubah status transaksi menjadi "habis" di kedua tabel
		$this->log_activity('User Soft Delete Keranjang');
		$model->softdelete1('barang','id_barang',$id);

		// Kirim respons (jika diperlukan)
		return redirect()->to('home/barang');
}

public function rsbarang($id){
		$model = new M_pb;
		// Pass the where condition directly to the softdelete() function
		$model->restore1('barang','id_barang',$id);
		$this->log_activity('User Restore Data Barang');
		// print_r($id);
		// Redirect to 'home/recyclebin'
		return redirect()->to('home/rbarang');
}

public function sdbarangm($id)
{
		$model = new M_pb;
		// Ubah status transaksi menjadi "habis" di kedua tabel
		$this->log_activity('User Soft Delete Data Barang Masuk');
		$model->softdelete1('barangmasuk','id_bmasuk',$id);

		// Kirim respons (jika diperlukan)
		return redirect()->to('home/barangmasuk');
}

public function rsbarangm($id){
		$model = new M_pb;
		// Pass the where condition directly to the softdelete() function
		$this->log_activity('User Restore Data Barang Masuk');
		$model->restore1('barangmasuk','id_bmasuk',$id);
		// print_r($id);
		// Redirect to 'home/recyclebin'
		return redirect()->to('home/rbarangmasuk');
}

public function sdbarangk($id)
{
		$model = new M_pb;
		// Ubah status transaksi menjadi "habis" di kedua tabel
		$this->log_activity('User Soft Delete Data Barang Keluar');
		$model->softdelete1('barangkeluar','id_bkeluar',$id);

		// Kirim respons (jika diperlukan)
		return redirect()->to('home/barangkeluar');
}

public function rsbarangk($id){
		$model = new M_pb;
		// Pass the where condition directly to the softdelete() function
		$this->log_activity('User Restore Data Barang Keluar');
		$model->restore1('barangkeluar','id_bkeluar',$id);
		// print_r($id);
		// Redirect to 'home/recyclebin'
		return redirect()->to('home/rbarangkeluar');
}

public function hbarangm($id)
	{
		$model = new M_pb();
		$where = array('id_barang' => $id);
		$this->log_activity('User Hapus Data Barang Masuk');
		$model->hapus('barangmasuk', $where);

		return redirect()->to('Home/rbarangmasuk');
	}

	public function hbarangk($id)
	{
		$model = new M_pb();
		$where = array('id_barang' => $id);
		$this->log_activity('User Hapus Data Barang Keluar');
		$model->hapus('barangkeluar', $where);

		return redirect()->to('Home/rbarangkeluar');
	}

	public function sduser($id)
	{
			$model = new M_pb;
			// Ubah status transaksi menjadi "habis" di kedua tabel
			$this->log_activity('User Soft Delete Data User');
			$model->softdelete1('user','id_user',$id);
	
			// Kirim respons (jika diperlukan)
			return redirect()->to('home/user');
	}
	
	public function rsuser($id){
			$model = new M_pb;
			// Pass the where condition directly to the softdelete() function
			$this->log_activity('User Restore Data User');
			$model->restore1('user','id_user',$id);
			// print_r($id);
			// Redirect to 'home/recyclebin'
			return redirect()->to('home/ruser');
	}

public function pemesanan(){
	if (session()->get('level') == 1 || session()->get('level') == 3) {
		$model = new M_pb();
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$where1 = array('barang.delete' => '0');
		$where2 = array('barang.status' => 'tersedia');
		$data['satu'] = $model->tampilWhere2('barang',$where1,$where2);
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
		$this->log_activity('User Membuka View Pemesanan');
		$data['menus'] = $model->getFilteredMenu();
		echo view('header',$data);
		echo view('menu',$data);
		echo view('pemesanan',$data);
		echo view('footer');
	} elseif(session()->get('level') == 2) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('Home/login');
	}
}

public function infopesanan(){
	if (session()->get('level') == 1 || session()->get('level') == 2) {
		$model = new M_pb();
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$where1 = array('transaksi.id_pengantar' => session()->get('id'));
		$where2 = array('status_transaksi' => 'On The Way');
		$data['satu'] = $model->groupbyjoinn2(
			'keranjang',
			'barang',
			'transaksi',
			'barang.id_barang = keranjang.id_barang',
			'transaksi.kode_keranjang = keranjang.kode_keranjang',
			$where1,
			$where2
		);
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
		$this->log_activity('User Membuka View infopemesanan');
		$data['menus'] = $model->getFilteredMenu();
		echo view('header',$data);
		echo view('menu',$data);
		echo view('infopesanan',$data);
		echo view('footer');
		
	} elseif(session()->get('level') == 3) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('home/login');
	}
}

public function save_cart() {
    $model = new M_pb(); 

    $cartData = $this->request->getBody();

    log_message('debug', 'Cart data received: ' . $cartData);

    $cartData = json_decode($cartData, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid JSON data']);
    }
	
    log_message('debug', 'Decoded cart data: ' . print_r($cartData, true));
    $cartCode = 'CPP-' . str_pad($model->getNextCartCode(), 4, '0', STR_PAD_LEFT);
    $userId = session()->get('id');
    if (!$userId) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'User not logged in']);
    }
    foreach ($cartData['items'] as $item) {
        $data = [
            'id_user' => $userId,
            'id_barang' => $item['id'],
            'quantity' => $item['quantity'],
            'kode_keranjang' => $cartCode,
			'create_at' => date('Y-m-d H:i:s'),
			'create_by' => session()->get('id'),
			'status' => 'pending',
			'deletek' => '0',
        ];

        if (!$model->add_to_cart($data)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to save item to cart']);
        }
    }
	$this->log_activity('User Menyimpan Data Keranjang');
	session()->set('kode_keranjang', $cartCode);
    return $this->response->setJSON(['status' => 'success', 'message' => 'Cart saved successfully']);
}




public function keranjang($id){
	$model = new M_pb();
	if (session()->get('level') == 3) {
		
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$where1 = array('keranjang.deletek' => '0');
		$where2 = array('keranjang.id_user' => session()->get('id'));
		$data['satu'] = $model->groupbyjoin3where1($where1,$where2);
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
		$this->log_activity('User Membuka View Keranjang');
		$data['menus'] = $model->getFilteredMenu();
		echo view('header',$data);
		echo view('menu',$data);
		echo view('keranjang',$data);
		echo view('footer');

	}elseif(session()->get('level') == 1){	

	$where = array('id_user' => session()->get('id'));
	$data['dua'] = $model->getwhere('user', $where);
	$where1 = array('keranjang.deletek' => '0');
	$data['satu'] = $model->groupbyjoin3where($where1);
	$where = array('id_setting' => 1);
	$data['setting'] = $model->getwhere('setting', $where);
	$this->log_activity('User Membuka View Keranjang');
	echo view('header',$data);
	echo view('menu',$data);
	echo view('keranjang',$data);
	echo view('footer');

	} elseif(session()->get('level') == 2) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('home/login');
	}
}

public function dkeranjang($id){
	if (session()->get('level') > 0) {
		$model = new M_pb();
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$where = array('kode_keranjang' => $id);
		$data['tiga'] = $model->joinresult('keranjang','barang','keranjang.id_barang=barang.id_barang', $where);
		$data['empat'] = $model->getWhere('keranjang',$where);
		$data['satu'] = $model->groupbyjoinn('keranjang', 'barang', 'barang.id_barang = keranjang.id_barang');
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
		$this->log_activity('User Membuka View dkeranjang');
		$data['menus'] = $model->getFilteredMenu();
		echo view('header',$data);
		echo view('menu',$data);
		echo view('dkeranjang',$data);
		echo view('footer');
		// print_r($data1);
	} else {
		return redirect()->to('Home/login');
	}
}

public function pembayaran($id){
	if (session()->get('level') > 0) {
		$model = new M_pb();
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$where = array('kode_keranjang' => $id);
		$data['tiga'] = $model->joinresult('keranjang','barang','keranjang.id_barang=barang.id_barang', $where);
		$data['satu'] = $model->groupbyjoinn('keranjang', 'barang', 'barang.id_barang = keranjang.id_barang');
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
		$this->log_activity('User Membuka View Pembayaran');
		$data['menus'] = $model->getFilteredMenu();
		echo view('header',$data);
		echo view('menu',$data);
		echo view('dkeranjang',$data);
		echo view('footer');
	} else {
		return redirect()->to('Home/login');
	}
}

public function setting(){
	if (session()->get('level') == 1) {
		$model = new M_pb();
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
		$this->log_activity('User Membuka View setting');
		$data['menus'] = $model->getFilteredMenu();
		echo view('header',$data);
		echo view('menu',$data);
		echo view('setting',$data);
		echo view('footer');
	} else {
		return redirect()->to('Home/notfound');
	}
}

public function aksi_esetting() {
    $model = new M_pb();
    $jwebsite = $this->request->getPost('judul_website');
    $t_icon = $this->request->getFile('t_icon');
    $m_icon = $this->request->getFile('m_icon');
    $l_icon = $this->request->getFile('l_icon');
    $id = $this->request->getPost('id');
	$this->log_activity('User Mengupdate setting');
    $data = array('judul_website' => $jwebsite);

    if ($t_icon->isValid() && !$t_icon->hasMoved()) {
        $foto_t_icon = $t_icon->getName();
        $t_icon->move(ROOTPATH . 'public/images', $foto_t_icon);
        $data['tab_icon'] = $foto_t_icon;
    }
    
    if ($m_icon->isValid() && !$m_icon->hasMoved()) {
        $foto_m_icon = $m_icon->getName();
        $m_icon->move(ROOTPATH . 'public/images', $foto_m_icon);
        $data['menu_icon'] = $foto_m_icon;
    }
    
    if ($l_icon->isValid() && !$l_icon->hasMoved()) {
        $foto_l_icon = $l_icon->getName();
        $l_icon->move(ROOTPATH . 'public/images', $foto_l_icon);
        $data['login_icon'] = $foto_l_icon;
    }
    
    $where = array('id_setting' => $id);
    $model->edit('setting', $data, $where);
    
    return redirect()->to('home/setting');
}

public function bayar() {
    try {
        if (session()->get('level') > 0) {
            $model = new M_pb();
            $this->log_activity('User Membuka View bayar');
            // Get user data
            $where = ['id_user' => session()->get('id')];
            $data['dua'] = $model->getWhere('user', $where);
            $kkeranjang = $this->request->getPost('kode_keranjang');
			if (!empty($kkeranjang)) {
			session()->set('kode_keranjang', $kkeranjang);
			}else{

			}
            $where = ['id_setting' => 1];
            $data['setting'] = $model->getWhere('setting', $where);
            $data['menus'] = $model->getFilteredMenu();
            
            $kodeKeranjang = session()->get('kode_keranjang');
            $where4 = ['keranjang.kode_keranjang' => $kodeKeranjang];
            $data['satu'] = $model->groupbyjoinnwhere('keranjang', 'barang', 'barang.id_barang = keranjang.id_barang', $where4);
            
            // Pass kode_keranjang and id_user to view
            $data['kode_keranjang'] = $kodeKeranjang; // Ensure this is set
            $data['id_user'] = session()->get('id');   // Ensure this is set
            
            echo view('header', $data);
            echo view('menu', $data);
            echo view('bayar', $data);
            echo view('footer', $data);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User not authorized']);
        }
    } catch (Exception $e) {
        log_message('error', 'An error occurred: ' . $e->getMessage());
        return $this->response->setJSON(['status' => 'error', 'message' => 'An error occurred while processing the payment.']);
    }
}

public function riwayat_p() {
    if (session()->get('level') > 0) {
        $model = new M_pb(); // Adjust namespace according to your app's structure
        $where = ['id_user' => session()->get('id')];
        $data['dua'] = $model->getWhere('user', $where); // Ensure method name matches your model's method
        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where); // Ensure method name matches your model's method
		$this->log_activity('User Membuka View riwayat_p');
		$data['menus'] = $model->getFilteredMenu();
        echo view('header', $data);
        echo view('menu', $data);
        echo view('riwayat_p', $data);
        echo view('footer');
    } else {
        return redirect()->to('Home/login');
    }
}

public function notfound(){
	if (session()->get('level') > 0) {
        $model = new M_pb(); 
        $where = ['id_user' => session()->get('id')];
        $data['dua'] = $model->getWhere('user', $where); // Ensure method name matches your model's method
        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where); // Ensure method name matches your model's method
		$this->log_activity('User Membuka View notfound');
		$data['menus'] = $model->getFilteredMenu();
        echo view('header', $data);
        echo view('menu', $data);
        echo view('notfound');
        echo view('footer');
    } else {
        return redirect()->to('Home/login');
    }
}

public function generateTransactionNumber()
{
    $model = new M_pb();
    $lastTransaction = $model->getLastTransaction();
    
    if ($lastTransaction) {
        $lastNumber = (int)substr($lastTransaction->no_transaksi, 4);
        $newNumber = $lastNumber + 1;
    } else {
        $newNumber = 1;
    }
    return 'CTP-' . $newNumber;
}
public function cash()
{
    $model = new M_pb();
    $notransaksi = $this->generateTransactionNumber();
    $kode_keranjang = $this->request->getPost('kode_keranjang');
    $iduser = $this->request->getPost('id_user');
    $id_barang = $this->request->getPost('id_barang');
    $quantity = $this->request->getPost('quantity');
	$alamat = $this->request->getPost('Alamat');
	$total = $this->request->getPost('total_price');

    // Debugging: Print received data
    echo "<pre>";
    print_r($id_barang);
    print_r($quantity);
    echo "</pre>";

    $data = array(
        'no_transaksi' => $notransaksi,
        'kode_keranjang' => $kode_keranjang,
        'tanggal' => date('Y-m-d H:i:s'),
        'create_at' => date('Y-m-d H:i:s'),
        'create_by' => session()->get('id'),
		'deletet' => '0',
    );

	$data1 = array(
        'nomor_transaksi' => $notransaksi,
        'tanggal_transaksi' => date('Y-m-d'),
		'jumlah_transaksi' => $total,
        'create_at' => date('Y-m-d H:i:s'),
        'create_by' => session()->get('id'),
		'delete' => '0',
    );

    foreach ($id_barang as $index => $barang) {
        $data2 = array(
            'id_barang' => $barang,
            'jumlah' => $quantity[$index],
			'delete' => '0',
			'tanggal' => date('Y-m-d'),
            'create_at' => date('Y-m-d H:i:s'),
            'create_by' => session()->get('id'),
			'kode_keranjang' => $kode_keranjang
        );
        
        $model->tambah('barangkeluar', $data2);
    }



    $where = array('kode_keranjang' => $kode_keranjang);
    $model->tambah('transaksi', $data);
	$model->tambah('nota', $data1);
    $model->statuskeranjang('keranjang', 'kode_keranjang', $where);
    // return redirect()->to('home/pemesanan');
}

public function pesanan(){
	$model = new M_pb();
    if(session()->get('level') == 3){

	$where = ['id_user' => session()->get('id')];
	$data['dua'] = $model->getWhere('user', $where);
	$data['menus'] = $model->getFilteredMenu();
	// Get settings data
	$where = ['id_setting' => 1];
	$data['setting'] = $model->getWhere('setting', $where);
	

	$where3 = ['transaksi.id_user' => session()->get('id')];
	$where2 = array('status_transaksi' => 'Pending');
	$where4 = array('status_transaksi' => 'On The Way');
	$data['satu'] = $model->groupbyjoinnwhere3($where3,$where2,$where4);
	$this->log_activity('User Membuka View Pesanan');
	echo view('header', $data);
    echo view('menu', $data);
    echo view('pesanan', $data);
    echo view('footer', $data);

	}elseif(session()->get('level')==1){

	$where = ['id_user' => session()->get('id')];
	$data['dua'] = $model->getWhere('user', $where);
	$data['menus'] = $model->getFilteredMenu();
	$where = ['id_setting' => 1];
	$data['setting'] = $model->getWhere('setting', $where);
	$where = ['level' => 2];
	$data['user'] = $model->tampilwhere('user',$where);

	$where2 = array('status_transaksi' => 'Pending');
	$where4 = array('status_transaksi' => 'On The Way');
	$data['satu'] = $model->groupbyjoinnwhere2($where2,$where4);
	
	echo view('header', $data);
    echo view('menu', $data);
    echo view('pesanan', $data);
    echo view('footer', $data);
	}elseif(session()->get('level')==2){

		return redirect()->to('Home/notfound');

	}else{

		return redirect()->to('home/login');

	}

}

public function hpesanan(){
	$model = new M_pb();
	if(session()->get('level') == 1 || session()->get('level') == 3){

		$where = ['id_user' => session()->get('id')];
		$data['dua'] = $model->getWhere('user', $where);
		
		// Get settings data
		$where = ['id_setting' => 1];
		$data['setting'] = $model->getWhere('setting', $where);
		$data['menus'] = $model->getFilteredMenu();
	
		$where3 = ['transaksi.id_user' => session()->get('id')];
		$where2 = array('status_transaksi' => 'Done');
		$data2['satu'] = $model->groupbyjoinnwhere22($where3,$where2);
		$this->log_activity('User Membuka View hpesanan');
		echo view('header', $data);
		echo view('menu', $data);
		echo view('hpesanan', $data2);
		echo view('footer', $data);

	}elseif(session()->get('level') == 2){

		return redirect()->to('home/notfound');
	
	} else {
		return redirect()->to('Home/login');
	}
}

public function statusto()
{
    $model = new M_pb;
    
    // Ubah status transaksi menjadi "habis" di tabel barang
	$id = $this->request->getPost('id');
	$pengantar = $this->request->getPost('pengantar');
    $where = ['id_transaksi' => $id];

	$model->softdelete2('transaksi', 'id_pengantar', $pengantar, $where);
    $model->softdelete2('transaksi', 'status_transaksi', 'On The Way', $where);

    return redirect()->to('home/pesanan');
}

public function statustd($id)
{
    $model = new M_pb;
    
    // Ubah status transaksi menjadi "habis" di tabel barang
    $where = ['id_transaksi' => $id];
    $model->softdelete2('transaksi', 'status_transaksi', 'Done', $where);

    // Kirim respons (jika diperlukan)
    return redirect()->to('home/pesanan');
}

public function resetpassword($id){
	$model = new M_pb;
	$where = array('id_user' =>$id );
	$table = 'user'; // Nama tabel
	$kolom = 'id_user';
	$data = array(
       
        'password' => md5('cpp123'),
    );
	$this->log_activity('User Reset Password user');
	$model->resetpassword($table, $kolom, $where, $data);
	return redirect()->to('Home/user');
}

public function profile(){
	if (session()->get('level') > 0) {
        $model = new M_pb(); // Adjust namespace according to your app's structure
        $where = ['id_user' => session()->get('id')];
        $data['dua'] = $model->getWhere('user', $where); // Ensure method name matches your model's method
        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where); // Ensure method name matches your model's method
		$this->log_activity('User Membuka profile');
		$data['menus'] = $model->getFilteredMenu();
        echo view('header', $data);
        echo view('menu', $data);
        echo view('profile', $data);
        echo view('footer');
    } else {
        return redirect()->to('Home/login');
    }
}

public function aksi_eprofile(){
	$model = new M_pb();
	$uploadedFile = $this->request->getfile('foto');
	$username = $this->request->getPost('username');
	$email = $this->request->getPost('email');
	$notelp = $this->request->getPost('no_telp');
	$level = $this->request->getPost('level');
	$id = $this->request->getPost('id');
	$where = array('id_user' => $id);
	$this->log_activity('User Mengupdate Profile');
	if ($uploadedFile->getName()) {
		$foto = $uploadedFile->getName();
		$model->upload1($uploadedFile);

		
	$data = array(
        'username' => $username,
        'email' => $email,
		'foto' => $foto,
		'no_telp' => $notelp,
		'level' => $level,
		'update_by' => session()->get('id'),
		'update_at' => date('Y-m-d H:i:s')
    );

	}else{
		$data = array(
			'username' => $username,
			'email' => $email,
			'level' => $level,
			'no_telp' => $notelp,
			'update_by' => session()->get('id'),
			'update_at' => date('Y-m-d H:i:s')
		);
	}
	

		

    $model->edit('user', $data, $where);
    return redirect()->to('home/profile');
}

public function changepassword(){
	if (session()->get('level') > 0) {
        $model = new M_pb(); // Adjust namespace according to your app's structure
        $where = ['id_user' => session()->get('id')];
        $data['dua'] = $model->getWhere('user', $where); // Ensure method name matches your model's method
        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where); // Ensure method name matches your model's method
		$this->log_activity('User Membuka View Change Password');
		$data['menus'] = $model->getFilteredMenu();
        echo view('header', $data);
        echo view('menu', $data);
        echo view('changepassword', $data);
        echo view('footer');
    } else {
        return redirect()->to('Home/login');
    }
}

public function aksi_changepass() {
    $model = new M_pb();
    $oldPassword = $this->request->getPost('old');
    $newPassword = $this->request->getPost('new');
    $userId = session()->get('id');

    // Dapatkan password lama dari database
    $currentPassword = $model->getPassword($userId);

    // Verifikasi apakah password lama cocok
    if (md5($oldPassword) !== $currentPassword) {
        // Set pesan error jika password lama salah
        session()->setFlashdata('error', 'Password lama tidak valid.');
        return redirect()->back()->withInput();
    }

    // Update password baru
    $data = [
        'password' => md5($newPassword),
        'update_by' => $userId,
        'update_at' => date('Y-m-d H:i:s')
    ];
    $where = ['id_user' => $userId];
    $this->log_activity('User Mengganti Password');
    $model->edit('user', $data, $where);
    
    // Set pesan sukses
    session()->setFlashdata('success', 'Password berhasil diperbarui.');
    return redirect()->to('home/changepassword');
}


public function printnota($id) {
    $model = new M_pb();
    if (session()->get('level') == 1 || session()->get('level') == 3) {
        $where = ['id_user' => session()->get('id')];
        $data['dua'] = $model->getWhere('user', $where);
        
        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where);
        
        $where2 = ['keranjang.kode_keranjang' => $id];
		$where3 = ['transaksi.kode_keranjang' => $id];
		$data['transaksi'] = $model->getWhere('transaksi', $where3);
        $data['satu'] = $model->joinresult3('keranjang','barang','keranjang.id_barang=barang.id_barang','transaksi','transaksi.kode_keranjang=keranjang.kode_keranjang','nota','transaksi.no_transaksi = nota.nomor_transaksi',$where2);
		$this->log_activity('User Print Nota');
        echo view('print_nota', $data);
		// print_r($data1);
	} elseif (session()->get('level') == 2) {
        return redirect()->to('home/notfound');
    } else {
        return redirect()->to('Home/login');
    }
}

public function rbarang(){
	if (session()->get('level') == 1) {
	$model = new M_pb();
	$where = array('id_user' => session()->get('id'));
	$data['dua'] = $model->getwhere('user', $where);
	$where1 = array('barang.delete' => '1');
	$data['satu'] = $model->tampilWhere('barang',$where1);
	$where = array('id_setting' => 1);
	$data['setting'] = $model->getwhere('setting', $where);
	$this->log_activity('User Membuka View rbarang');
	$data['menus'] = $model->getFilteredMenu();
	echo view('header',$data);
	echo view('menu',$data);
	echo view('barang',$data);
	echo view('footer');
} elseif(session()->get('level') == 2||session()->get('level') == 3) {
	return redirect()->to('Home/notfound');
}else{
	return redirect()->to('home/login');
}
}

public function rbarangmasuk(){
	if (session()->get('level') == 1) {
	$model = new M_pb();
	$where = array('id_user' => session()->get('id'));
	$data['dua'] = $model->getwhere('user', $where);
	$where1 = array('barangmasuk.delete' => '1');
	$data['satu'] = $model->joinresult('barangmasuk','barang','barangmasuk.id_barang = barang.id_barang',$where1);
	$where = array('id_setting' => 1);
	$data['setting'] = $model->getwhere('setting', $where);
	$this->log_activity('User Membuka View rbarangmasuk');
	$data['menus'] = $model->getFilteredMenu();
	echo view('header',$data);
	echo view('menu',$data);
	echo view('barang',$data);
	echo view('footer');
} elseif(session()->get('level') == 2||session()->get('level') == 3) {
	return redirect()->to('Home/notfound');
}else{
	return redirect()->to('home/login');
}
}

public function rbarangkeluar(){
	if (session()->get('level') == 1) {
	$model = new M_pb();
	$where = array('id_user' => session()->get('id'));
	$data['dua'] = $model->getwhere('user', $where);
	$where1 = array('barangkeluar.delete' => '1');
	$data['satu'] = $model->joinresult('barangkeluar','barang','barangkeluar.id_barang = barang.id_barang',$where1);
	$where = array('id_setting' => 1);
	$data['setting'] = $model->getwhere('setting', $where);
	$this->log_activity('User Membuka View rbarangkeluar');
	$data['menus'] = $model->getFilteredMenu();
	echo view('header',$data);
	echo view('menu',$data);
	echo view('barang',$data);
	echo view('footer');
} elseif(session()->get('level') == 2||session()->get('level') == 3) {
	return redirect()->to('Home/notfound');
}else{
	return redirect()->to('home/login');
}
}

public function laporantransaksi(){
	if (session()->get('level') == 1) {
		$model = new M_pb();
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$data['satu'] = $model->groupbyjoin4where0('keranjang',
			'barang',
			'transaksi',
			'user',
			'nota',
			'barang.id_barang = keranjang.id_barang',
			'transaksi.kode_keranjang = keranjang.kode_keranjang', 
			'keranjang.id_user = user.id_user',
			'transaksi.no_transaksi = nota.nomor_transaksi',
			);
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
		$this->log_activity('User Membuka View laporantransaksi');
		$data['menus'] = $model->getFilteredMenu();
		echo view('header',$data);
		echo view('menu',$data);
		echo view('laporantransaksi',$data);
		echo view('footer');
	} elseif(session()->get('level') == 2||session()->get('level') == 3) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('home/login');
	}
}

public function filterTanggal()
    {
		if (session()->get('level') == 1) {
        // Ambil parameter tanggal dari query string
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        // Set tanggal default jika tidak ada filter
        if (!$startDate) {
            $startDate = '0000-00-00'; // Atau tanggal default yang sesuai
        }
        if (!$endDate) {
            $endDate = '9999-12-31'; // Atau tanggal default yang sesuai
        }

        // Panggil model untuk mendapatkan data yang difilter
        $model = new M_pb(); // Ganti dengan nama model Anda
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
        $data['satu'] = $model->groupbyjoin4where1(
            'keranjang', 
            'barang', 
            'transaksi', 
            'user',
			'nota', 
            'keranjang.id_barang = barang.id_barang', 
            'transaksi.kode_keranjang = keranjang.kode_keranjang', 
            'user.id_user = transaksi.create_by',
			'transaksi.no_transaksi = nota.nomor_transaksi',
            [], // Tambahkan kondisi WHERE tambahan jika ada
            $startDate,
            $endDate
        );
		$data['menus'] = $model->getFilteredMenu();
        // Load view dengan data yang difilter
        echo view('header',$data);
		echo view('menu',$data);
		echo view('laporantransaksi',$data);
		echo view('footer');
	} elseif(session()->get('level') == 2||session()->get('level') == 3) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('home/login');
	}
    }

	public function transaksi_pdf()
	{
		if (session()->get('level') == 1) {
		$startDate = $this->request->getGet('start_date');
		$endDate = $this->request->getGet('end_date');
	
		if (!$startDate) {
			$startDate = '0000-00-00'; // Default start date
		}
		if (!$endDate) {
			$endDate = '9999-12-31'; // Default end date
		}
	
		// Load model and fetch data
		$model = new M_pb();
		$data['satu'] = $model->groupbyjoin5where1(
			'keranjang', 
            'barang', 
            'transaksi', 
            'user', 
			'nota',
            'keranjang.id_barang = barang.id_barang', 
            'transaksi.kode_keranjang = keranjang.kode_keranjang', 
            'user.id_user = transaksi.create_by', 
			'transaksi.no_transaksi = nota.nomor_transaksi',
			$startDate,
			$endDate
		);
		
		$data['setting'] = $model->getwhere('setting', ['id_setting' => 1]);
		$data['startDate'] = $startDate;
    $data['endDate'] = $endDate;
	$this->log_activity('User Membuka Laporan Transaksi Pdf');
		// Pass data to the view
		return view('transaksipdf', $data);
	} elseif(session()->get('level') == 2||session()->get('level') == 3) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('home/login');
	}
	}

	public function transaksi_excel()
	{
		if (session()->get('level') == 1) {
		$startDate = $this->request->getGet('start_date');
		$endDate = $this->request->getGet('end_date');
	
		if (!$startDate) {
			$startDate = '0000-00-00'; // Default start date
		}
		if (!$endDate) {
			$endDate = '9999-12-31'; // Default end date
		}
	
		// Load model and fetch data
		$model = new M_pb();
		$where1 = array('transaksi.status_transaksi' => 'Done');
		$data['satu'] = $model->groupbyjoin5where1(
			'keranjang', 
            'barang', 
            'transaksi', 
            'user', 
			'nota',
            'keranjang.id_barang = barang.id_barang', 
            'transaksi.kode_keranjang = keranjang.kode_keranjang', 
            'user.id_user = transaksi.create_by', 
			'transaksi.no_transaksi = nota.nomor_transaksi',
			$startDate,
			$endDate
		);
	
		$data['setting'] = $model->getwhere('setting', ['id_setting' => 1]);
		$data['startDate'] = $startDate;
    $data['endDate'] = $endDate;
		// Pass data to the view
		$this->log_activity('User Membuka Laporan Transaksi Excel');
		return view('transaksiexcel', $data);
	} elseif(session()->get('level') == 2||session()->get('level') == 3) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('home/login');
	}
	}

	public function transaksi_windows()
	{
		if (session()->get('level') == 1) {
		$startDate = $this->request->getGet('start_date');
		$endDate = $this->request->getGet('end_date');
	
		if (!$startDate) {
			$startDate = '0000-00-00'; // Default start date
		}
		if (!$endDate) {
			$endDate = '9999-12-31'; // Default end date
		}
	
		// Load model and fetch data
		$model = new M_pb();
		$where1 = array('transaksi.status_transaksi' => 'Done');
		$data['satu'] = $model->groupbyjoin5where1(
			'keranjang', 
            'barang', 
            'transaksi', 
            'user', 
			'nota',
            'keranjang.id_barang = barang.id_barang', 
            'transaksi.kode_keranjang = keranjang.kode_keranjang', 
            'user.id_user = transaksi.create_by', 
			'transaksi.no_transaksi = nota.nomor_transaksi',
			$startDate,
			$endDate
		);
	
		$data['setting'] = $model->getwhere('setting', ['id_setting' => 1]);
		$data['startDate'] = $startDate;
    $data['endDate'] = $endDate;
		// Pass data to the view
		$this->log_activity('User Membuka Laporan Transaksi Windows');
		return view('transaksiwindows', $data);
	} elseif(session()->get('level') == 2||session()->get('level') == 3) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('home/login');
	}
	}


	public function filterTanggalbm()
    {
		if (session()->get('level') == 1) {
        // Ambil parameter tanggal dari query string
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        // Set tanggal default jika tidak ada filter
        if (!$startDate) {
            $startDate = '0000-00-00'; // Atau tanggal default yang sesuai
        }
        if (!$endDate) {
            $endDate = '9999-12-31'; // Atau tanggal default yang sesuai
        }

        // Panggil model untuk mendapatkan data yang difilter
        $model = new M_pb(); // Ganti dengan nama model Anda
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$where1 = array('transaksi.status_transaksi' => 'Done');
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
        $data['satu'] = $model->filterbarang(
			'barang', 
            'barangmasuk', 
            'user', 
            'barang.id_barang = barangmasuk.id_barang', 
            'barang.create_by = user.id_user', 

			[],
			$startDate,
			$endDate
		);
		$this->log_activity('User Filter Barang Masuk');
		$data['menus'] = $model->getFilteredMenu();
        // Load view dengan data yang difilter
        echo view('header',$data);
		echo view('menu',$data);
		echo view('laporanbarangm',$data);
		echo view('footer');
	} elseif(session()->get('level') == 2||session()->get('level') == 3) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('home/login');
	}
    }

public function laporanbarangmasuk(){
	if (session()->get('level') == 1) {
		$model = new M_pb();
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$where1 = array('barangmasuk.delete' => '0');
		$data['satu'] = $model->joinresult('barangmasuk','barang','barangmasuk.id_barang = barang.id_barang',$where1);
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
		$this->log_activity('User Membuka Laporan Barang Masuk');
		$data['menus'] = $model->getFilteredMenu();
		echo view('header',$data);
		echo view('menu',$data);
		echo view('laporanbarangm',$data);
		echo view('footer');
	} elseif(session()->get('level') == 2||session()->get('level') == 3) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('home/login');
	}
}

public function barangm_pdf()
	{
		if (session()->get('level') == 1) {
		$startDate = $this->request->getGet('start_date');
		$endDate = $this->request->getGet('end_date');
	
		if (!$startDate) {
			$startDate = '0000-00-00'; // Default start date
		}
		if (!$endDate) {
			$endDate = '9999-12-31'; // Default end date
		}
	
		// Load model and fetch data
		$model = new M_pb();
		$data['satu'] = $model->filterbarang(
			'barang', 
            'barangmasuk', 
            'user', 
            'barang.id_barang = barangmasuk.id_barang', 
            'barang.create_by = user.id_user', 

			[],
			$startDate,
			$endDate
		);
	
		$data['setting'] = $model->getwhere('setting', ['id_setting' => 1]);
		$data['startDate'] = $startDate;
    $data['endDate'] = $endDate;
		// Pass data to the view
		$this->log_activity('User Membuka Laporan Barang Masuk Pdf');
		return view('barangmpdf', $data);
	} elseif(session()->get('level') == 2||session()->get('level') == 3) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('home/login');
	}
	}
public function barangm_excel()
	{
		if (session()->get('level') == 1) {
		$startDate = $this->request->getGet('start_date');
		$endDate = $this->request->getGet('end_date');
	
		if (!$startDate) {
			$startDate = '0000-00-00'; // Default start date
		}
		if (!$endDate) {
			$endDate = '9999-12-31'; // Default end date
		}
	
		// Load model and fetch data
		$model = new M_pb();
		$data['satu'] = $model->filterbarang(
			'barang', 
            'barangmasuk', 
            'user', 
            'barang.id_barang = barangmasuk.id_barang', 
            'barang.create_by = user.id_user', 

			[],
			$startDate,
			$endDate
		);
	
		$data['setting'] = $model->getwhere('setting', ['id_setting' => 1]);
		$data['startDate'] = $startDate;
    $data['endDate'] = $endDate;
	$this->log_activity('User Membuka Laporan Barang Masuk Excel');
		// Pass data to the view
		return view('barangmexcel', $data);
	} elseif(session()->get('level') == 2||session()->get('level') == 3) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('home/login');
	}
	}

	public function barangm_windows()
	{
		if (session()->get('level') == 1) {
		$startDate = $this->request->getGet('start_date');
		$endDate = $this->request->getGet('end_date');
	
		if (!$startDate) {
			$startDate = '0000-00-00'; // Default start date
		}
		if (!$endDate) {
			$endDate = '9999-12-31'; // Default end date
		}
	
		// Load model and fetch data
		$model = new M_pb();
		$data['satu'] = $model->filterbarang(
			'barang', 
            'barangmasuk', 
            'user', 
            'barang.id_barang = barangmasuk.id_barang', 
            'barang.create_by = user.id_user', 

			[],
			$startDate,
			$endDate
		);
	
		$data['setting'] = $model->getwhere('setting', ['id_setting' => 1]);
		$data['startDate'] = $startDate;
    $data['endDate'] = $endDate;
		// Pass data to the view
		$this->log_activity('User Membuka Laporan Barang Masuk Windows');
		return view('barangmwindows', $data);
	} elseif(session()->get('level') == 2||session()->get('level') == 3) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('home/login');
	}
	}





	public function filterTanggalbk()
    {
		if (session()->get('level') == 1) {
        // Ambil parameter tanggal dari query string
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        // Set tanggal default jika tidak ada filter
        if (!$startDate) {
            $startDate = '0000-00-00'; // Atau tanggal default yang sesuai
        }
        if (!$endDate) {
            $endDate = '9999-12-31'; // Atau tanggal default yang sesuai
        }

        // Panggil model untuk mendapatkan data yang difilter
        $model = new M_pb(); // Ganti dengan nama model Anda
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$where1 = array('transaksi.status_transaksi' => 'Done');
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
        $data['satu'] = $model->filterbarangk(
			'barang', 
            'barangkeluar', 
            'user', 
            'barang.id_barang = barangkeluar.id_barang', 
            'barang.create_by = user.id_user', 

			[],
			$startDate,
			$endDate
		);
		$this->log_activity('User Filter Barang Keluar');
		$data['menus'] = $model->getFilteredMenu();
        // Load view dengan data yang difilter
        echo view('header',$data);
		echo view('menu',$data);
		echo view('laporanbarangk',$data);
		echo view('footer');
	} elseif(session()->get('level') == 2||session()->get('level') == 3) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('home/login');
	}
    }

public function laporanbarangkeluar(){
	if (session()->get('level') == 1) {
		$model = new M_pb();
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$where1 = array('barangkeluar.delete' => '0');
		$data['satu'] = $model->joinresult('barangkeluar','barang','barangkeluar.id_barang = barang.id_barang',$where1);
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
		$this->log_activity('User Membuka Laporan Barang Keluar');
		$data['menus'] = $model->getFilteredMenu();
		echo view('header',$data);
		echo view('menu',$data);
		echo view('laporanbarangk',$data);
		echo view('footer');
	} elseif(session()->get('level') == 2||session()->get('level') == 3) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('home/login');
	}
}

public function barangk_pdf()
	{
		if (session()->get('level') == 1) {
		$startDate = $this->request->getGet('start_date');
		$endDate = $this->request->getGet('end_date');
	
		if (!$startDate) {
			$startDate = '0000-00-00'; // Default start date
		}
		if (!$endDate) {
			$endDate = '9999-12-31'; // Default end date
		}
	
		// Load model and fetch data
		$model = new M_pb();
		$data['satu'] = $model->filterbarangk(
			'barang', 
            'barangkeluar', 
            'user', 
            'barang.id_barang = barangkeluar.id_barang', 
            'barang.create_by = user.id_user', 

			[],
			$startDate,
			$endDate
		);
	
		$data['setting'] = $model->getwhere('setting', ['id_setting' => 1]);
		$data['startDate'] = $startDate;
    $data['endDate'] = $endDate;
		// Pass data to the view
		$this->log_activity('User Membuka Laporan Barang Keluar Pdf');
		return view('barangkpdf', $data);
	} elseif(session()->get('level') == 2||session()->get('level') == 3) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('home/login');
	}
	}
public function barangk_excel()
	{
		if (session()->get('level') == 1) {
		$startDate = $this->request->getGet('start_date');
		$endDate = $this->request->getGet('end_date');
	
		if (!$startDate) {
			$startDate = '0000-00-00'; // Default start date
		}
		if (!$endDate) {
			$endDate = '9999-12-31'; // Default end date
		}
	
		// Load model and fetch data
		$model = new M_pb();
		$data['satu'] = $model->filterbarangk(
			'barang', 
            'barangkeluar', 
            'user', 
            'barang.id_barang = barangkeluar.id_barang', 
            'barang.create_by = user.id_user', 

			[],
			$startDate,
			$endDate
		);
	
		$data['setting'] = $model->getwhere('setting', ['id_setting' => 1]);
		$data['startDate'] = $startDate;
    $data['endDate'] = $endDate;
		// Pass data to the view
		$this->log_activity('User Membuka Laporan Barang Keluar Excel');
		return view('barangkexcel', $data);
	} elseif(session()->get('level') == 2||session()->get('level') == 3) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('home/login');
	}
	}

	public function barangk_windows()
	{
		if (session()->get('level') == 1) {
		$startDate = $this->request->getGet('start_date');
		$endDate = $this->request->getGet('end_date');
	
		if (!$startDate) {
			$startDate = '0000-00-00'; // Default start date
		}
		if (!$endDate) {
			$endDate = '9999-12-31'; // Default end date
		}
	
		// Load model and fetch data
		$model = new M_pb();
		$data['satu'] = $model->filterbarangk(
			'barang', 
            'barangkeluar', 
            'user', 
            'barang.id_barang = barangkeluar.id_barang', 
            'barang.create_by = user.id_user', 

			[],
			$startDate,
			$endDate
		);
	
		$data['setting'] = $model->getwhere('setting', ['id_setting' => 1]);
		$data['startDate'] = $startDate;
    $data['endDate'] = $endDate;
		// Pass data to the view
		$this->log_activity('User Membuka Laporan Barang Keluar Windows');
		return view('barangkwindows', $data);
	} elseif(session()->get('level') == 2||session()->get('level') == 3) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('home/login');
	}
	}

	public function datakeranjang(){
		if (session()->get('level') == 1) {
		$model = new M_pb();
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$where1 = array('keranjang.deletek' => '0');
		$data['satu'] = $model->groupbyabc1($where1);
		$data['tiga'] = $model->tampilwhere('keranjang',$where1);
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
		$this->log_activity('User Membuka View datakeranjang');
		$data['menus'] = $model->getFilteredMenu();
		echo view('header',$data);
		echo view('menu',$data);
		echo view('datakeranjang',$data);
		echo view('footer');
		// print_r($data['satu']);
	} elseif(session()->get('level') == 2||session()->get('level') == 3) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('home/login');
	}
	}

	public function rkeranjang(){
		if (session()->get('level') == 1) {
		$model = new M_pb();
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$where1 = array('keranjang.deletek' => '1');
		$data['satu'] = $model->groupbyabc($where1);
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
		$this->log_activity('User Membuka View rkeranjang');
		$data['menus'] = $model->getFilteredMenu();
		echo view('header',$data);
		echo view('menu',$data);
		echo view('datakeranjang',$data);
		echo view('footer');
	} elseif(session()->get('level') == 2||session()->get('level') == 3) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('home/login');
	}
	}

	public function transaksi(){
		if (session()->get('level') == 1) {
		$model = new M_pb();
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$where1 = array('transaksi.deletet' => '0');
		$data['satu'] = $model->join('transaksi','nota','transaksi.no_transaksi = nota.nomor_transaksi',$where1);
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
		$this->log_activity('User Membuka View transaksi');
		$data['menus'] = $model->getFilteredMenu();
		echo view('header',$data);
		echo view('menu',$data);
		echo view('transaksi',$data);
		echo view('footer');
	} elseif(session()->get('level') == 2||session()->get('level') == 3) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('home/login');
	}
	}

	public function etransaksi($id){
		if (session()->get('level') == 1) {
		$model = new M_pb();
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$groupby = array('keranjang.kode_keranjang');
		$data['satu'] = $model->tampilgroupby('keranjang',$groupby);
		$where = array('id_transaksi' =>$id);
		$data['tiga'] = $model->joinrow('transaksi','nota','transaksi.no_transaksi = nota.nomor_transaksi',$where);
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
		$this->log_activity('User Membuka View etransaksi');
		$data['menus'] = $model->getFilteredMenu();
		echo view('header',$data);
		echo view('menu',$data);
		echo view('etransaksi',$data);
		echo view('footer');
	} elseif(session()->get('level') == 2||session()->get('level') == 3) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('home/login');
	}
	}

	public function aksi_etransaksi(){
		$model = new M_pb();
		
		$keranjang = $this->request->getPost('keranjang');
		$total = $this->request->getPost('total');
		$id = $this->request->getPost('id');
		$where = array('no_transaksi' =>$id);
		$where1 = array('nomor_transaksi' =>$id);
		$data = array(
			'kode_keranjang' => $keranjang,
			'deletet' => '0',
			'tanggal' => date('Y-m-d'),
			'update_at' => date('Y-m-d H:i:s'),
			'update_by' => session()->get('id'),
		);

		$data1 = array(
			'jumlah_transaksi' => $total,
			'delete' => '0',
			'tanggal_transaksi' => date('Y-m-d'),
			'update_at' => date('Y-m-d H:i:s'),
			'update_by' => session()->get('id'),
		);
		
		$model->edit('nota', $data1, $where1);
		$model->edit('transaksi', $data, $where);
		return redirect()->to('home/transaksi');
	}

	public function sdtransaksi($id)
	{
			$model = new M_pb;
			$where = array('id_transaksi' => $id);
			// Ubah status transaksi menjadi "habis" di kedua tabel
			$this->log_activity('User Soft Delete View Data Transaksi');
			$model->softdelete2('transaksi', 'deletet', '1', $where);
	
			// Kirim respons (jika diperlukan)
			return redirect()->to('home/transaksi/');
	}

	public function rstransaksi($id)
	{
			$model = new M_pb;
			$where = array('id_transaksi' => $id);
			// Ubah status transaksi menjadi "habis" di kedua tabel
			$this->log_activity('User Restore View Data Transaksi');
			$model->softdelete2('transaksi', 'deletet', '0', $where);
	
			// Kirim respons (jika diperlukan)
			return redirect()->to('home/rtransaksi/');
	}

	public function htransaksi($id)
	{
		$model = new M_pb();
		$where = array('id_keranjang' => $id);
		$this->log_activity('User Hapus Data Transaksi');
		$model->hapus('transaksi', $where);

		return redirect()->to('Home/rtransaksi');
	}

	public function rtransaksi(){
		if (session()->get('level') == 1) {
		$model = new M_pb();
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$where1 = array('transaksi.deletet' => '1');
		$data['satu'] = $model->join('transaksi','nota','transaksi.no_transaksi = nota.nomor_transaksi',$where1);
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
		$this->log_activity('User Membuka View rtransaksi');
		$data['menus'] = $model->getFilteredMenu();
		echo view('header',$data);
		echo view('menu',$data);
		echo view('transaksi',$data);
		echo view('footer');
	} elseif(session()->get('level') == 2||session()->get('level') == 3) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('home/login');
	}
	}

	public function edit_transaksi($id){
		if (session()->get('level') == 1 || session()->get('level') == 3) {
			$model = new M_pb();
			$where = array('id_user' => session()->get('id'));
			$data['dua'] = $model->getwhere('user', $where);
			$where1 = array('barang.delete' => '0');
			$where2 = array('barang.status' => 'tersedia');
			$data['satu'] = $model->tampilWhere2('barang',$where1,$where2);
			$where3 = array('keranjang.kode_keranjang' => $id);
			$data['tiga'] = $model->join('keranjang','barang','keranjang.id_barang = barang.id_barang', $where3);
			$where = array('id_setting' => 1);
			$data['setting'] = $model->getwhere('setting', $where);
			$this->log_activity('User Membuka View edit_transaksi');
			$data['menus'] = $model->getFilteredMenu();
			echo view('header',$data);
			echo view('menu',$data);
			echo view('epemesanan',$data);
			echo view('footer');
			// print_r($data3);
		} elseif(session()->get('level') == 2) {
			return redirect()->to('Home/notfound');
		}else{
			return redirect()->to('Home/login');
		}
	}

	public function delete_cart_item($id_keranjang)
{
    $model = new M_pb();
    $where = array('id_Keranjang' => $id_keranjang);
    $this->log_activity('User Mendelete Data Keranjang');
    if ($model->hapus('keranjang', $where)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error']);
    }
}

public function ekeranjang($id){
	if (session()->get('level') == 1 || session()->get('level') == 3) {
		$model = new M_pb();
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$where1 = array('barang.delete' => '0');
		$where2 = array('barang.status' => 'tersedia');
		$data['satu'] = $model->tampilWhere2('barang',$where1,$where2);
		$where3 = array('keranjang.kode_keranjang' => $id);
		$data['tiga'] = $model->join('keranjang','barang','keranjang.id_barang = barang.id_barang', $where3);
		$where4 = array('kode_keranjang' => $id);
		$data['empat'] = $model->getWhere('transaksi',$where4);
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
		$this->log_activity('User Membuka View ekeranjang');
		$data['menus'] = $model->getFilteredMenu();
		echo view('header',$data);
		echo view('menu',$data);
		echo view('ekeranjang',$data);
		echo view('footer');
		// print_r($data['tiga']);
	} elseif(session()->get('level') == 2) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('Home/login');
	}
}

public function ekeranjangp($id){
	if (session()->get('level') == 1 || session()->get('level') == 3) {
		$model = new M_pb();
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$where1 = array('barang.delete' => '0');
		$where2 = array('barang.status' => 'tersedia');
		$data['satu'] = $model->tampilWhere2('barang',$where1,$where2);
		$where3 = array('keranjang.kode_keranjang' => $id);
		$data['tiga'] = $model->join('keranjang','barang','keranjang.id_barang = barang.id_barang', $where3);
		$where4 = array('kode_keranjang' => $id);
		$data['empat'] = $model->getWhere('keranjang',$where4);
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
		$this->log_activity('User Membuka View ekeranjangp');
		$data['menus'] = $model->getFilteredMenu();
		echo view('header',$data);
		echo view('menu',$data);
		echo view('ekeranjangp',$data);
		echo view('footer');
		// print_r($data['tiga']);
	} elseif(session()->get('level') == 2) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('Home/login');
	}
}

public function updateCart($id) {
    $data = json_decode(file_get_contents('php://input'), true);
    $quantity = $data['quantity'];
    $kodeKeranjang = $data['kode_keranjang'];
    $itemId = $data['item_id'];
    $idBarang = $data['id_barang'];
	
    // Validate quantity
    if (!is_numeric($quantity) || $quantity < 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid quantity']);
        return;
    }

    $model = new M_pb();
    
    // Retrieve the current cart item to get kode_keranjang and id_barang
    $cartItem = $model->finds('keranjang', ['id_Keranjang' => $id]);
    if (!$cartItem) {
        echo json_encode(['success' => false, 'message' => 'Cart item not found']);
        return;
    }


    // Perform the update in keranjang table
	$this->log_activity('User Mengupdate Data Keranjang dan barangkeluar');
    $updateKeranjang = $model->edit('keranjang', ['quantity' => $quantity, 'update_at' => date('Y-m-d H:i:s')
		, 'update_by' => session()->get('id')], ['id_Keranjang' => $id]);

    // Perform the update in barang_keluar table
    $updateBarangKeluar = $model->edits('barangkeluar', ['jumlah' => $quantity, 'update_at' => date('Y-m-d H:i:s')
		, 'update_by' => session()->get('id')], ['kode_keranjang' => $kodeKeranjang, 'id_barang' => $idBarang]);

    if ($updateKeranjang && $updateBarangKeluar) {
        echo json_encode(['success' => true]);
    } else {
		
        echo json_encode(['success' => false, 'message' => 'Failed to update quantity']);
		
    }
}




public function removeCart($id) {
    // Decode JSON input
    $data = json_decode(file_get_contents('php://input'), true);
    $kodeKeranjang = $data['kode_keranjang'];
    $id_barang = $data['id_barang'];

    // Assuming M_pb model and connection are set up correctly
    $model = new M_pb();

    try {
        // Perform deletions
		$this->log_activity('User Mendelete Data keranjang dan barangkeluar');
        $deleteFromKeranjang = $model->hapus('keranjang', ['id_Keranjang' => $id]);
        $deleteFromBarangKeluar = $model->hapus('barangkeluar', ['kode_Keranjang' => $kodeKeranjang, 'id_barang' => $id_barang]);

        // Respond with success
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        // Respond with error
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}


public function addItem()
{
    try {
        // Get URL-encoded data from POST request
        $itemId = $this->request->getPost('item_id');
        $quantity = $this->request->getPost('quantity');
        $kodeKeranjang = $this->request->getPost('kode_keranjang'); // Retrieve kode_keranjang

        // Validate data
        if (!is_numeric($itemId) || !is_numeric($quantity) || $quantity < 1) {
            $errorMsg = 'Invalid data: itemId=' . $itemId . ', quantity=' . $quantity;
            error_log($errorMsg);
            return $this->response->setJSON(['success' => false, 'message' => $errorMsg]);
        }

        // Load model and perform database operations
        $model = new M_pb();
        $cartItem = $model->finds('keranjang', ['id_barang' => $itemId, 'kode_keranjang' => $kodeKeranjang]); // Adjust query
		
        if ($cartItem) {
			$this->log_activity('User Mengupdate quantity keranjang dan barangkeluar');

            $newQuantity = $cartItem->quantity + $quantity;
            $model->edits('keranjang', ['quantity' => $newQuantity, 'update_at' => date('Y-m-d H:i:s')
		, 'update_by' => session()->get('id')], ['id_Keranjang' => $cartItem->id_Keranjang]);
		
            // Update quantity in barang_keluar table
            $model->edits('barangkeluar', ['jumlah' => $newQuantity, 'update_at' => date('Y-m-d H:i:s')
		, 'update_by' => session()->get('id')], ['kode_keranjang' => $kodeKeranjang, 'id_barang' => $itemId]);
        } else {
			$this->log_activity('User Menambahkan Data keranjang dan barangkeluar');
            $model->inserts('keranjang', [
                'id_barang' => $itemId,
                'quantity' => $quantity,
                'id_user' => session()->get('id'),
                'kode_keranjang' => $kodeKeranjang, // Use kode_keranjang
                'create_at' => date('Y-m-d H:i:s'), // Correct date format
                'create_by' => session()->get('id'),
                'deletek' => '0',
				'status' => 'pending'
            ]);

            // Insert into barang_keluar table
            $model->inserts('barangkeluar', [
                'id_barang' => $itemId,
                'jumlah' => $quantity,
                'kode_keranjang' => $kodeKeranjang,
                'create_at' => date('Y-m-d H:i:s'),
                'create_by' => session()->get('id'),
				'delete' => '0',
				'tanggal' => date('Y-m-d'),
            ]);
        }

        // Respond with success
        return $this->response->setJSON(['success' => true]);

    } catch (\Exception $e) {
        $exceptionMsg = 'Exception: ' . $e->getMessage();
        error_log($exceptionMsg);
        return $this->response->setJSON(['success' => false, 'message' => $exceptionMsg]);
    }
}

public function addItem2()
{
    try {
        // Get URL-encoded data from POST request
        $itemId = $this->request->getPost('item_id');
        $quantity = $this->request->getPost('quantity');
        $kodeKeranjang = $this->request->getPost('kode_keranjang'); // Retrieve kode_keranjang

        // Validate data
        if (!is_numeric($itemId) || !is_numeric($quantity) || $quantity < 1) {
            $errorMsg = 'Invalid data: itemId=' . $itemId . ', quantity=' . $quantity;
            error_log($errorMsg);
            return $this->response->setJSON(['success' => false, 'message' => $errorMsg]);
        }

        // Load model and perform database operations
        $model = new M_pb();
        $cartItem = $model->finds('keranjang', ['id_barang' => $itemId, 'kode_keranjang' => $kodeKeranjang]); // Adjust query

        if ($cartItem) {
			$this->log_activity('User Mengupdate quantity keranjang dan barangkeluar');
            $newQuantity = $cartItem->quantity + $quantity;
            $model->edits('keranjang', ['quantity' => $newQuantity, 'update_at' => date('Y-m-d H:i:s')
		, 'update_by' => session()->get('id')], ['id_Keranjang' => $cartItem->id_Keranjang]);

            // Update quantity in barang_keluar table
            $model->edits('barangkeluar', ['jumlah' => $newQuantity, 'update_at' => date('Y-m-d H:i:s')
		, 'update_by' => session()->get('id')], ['kode_keranjang' => $kodeKeranjang, 'id_barang' => $itemId]);
        } else {
			$this->log_activity('User Menambahkan Data keranjang dan barangkeluar');

            $model->inserts('keranjang', [
                'id_barang' => $itemId,
                'quantity' => $quantity,
                'id_user' => session()->get('id'),
                'kode_keranjang' => $kodeKeranjang, // Use kode_keranjang
                'create_at' => date('Y-m-d H:i:s'), // Correct date format
                'create_by' => session()->get('id'),
                'deletek' => '0',
				'status' => 'pending'
            ]);

            // Insert into barang_keluar table
           
        }

        // Respond with success
        return $this->response->setJSON(['success' => true]);

    } catch (\Exception $e) {
        $exceptionMsg = 'Exception: ' . $e->getMessage();
        error_log($exceptionMsg);
        return $this->response->setJSON(['success' => false, 'message' => $exceptionMsg]);
    }
}

public function updateTotalPrice()
{
    try {
        $nomorTransaksi = $this->request->getPost('nomor_transaksi');
        $totalPrice = $this->request->getPost('total_price');

        // Debugging
        error_log('Received nomor_transaksi: ' . $nomorTransaksi);
        error_log('Received total_price: ' . $totalPrice);

        // Validate and sanitize data
        if (!is_numeric($totalPrice)) {
            $errorMsg = 'Invalid total price: ' . $totalPrice;
            error_log($errorMsg);
            return $this->response->setJSON(['success' => false, 'message' => $errorMsg]);
        }

        // Ensure totalPrice is a valid number
        $totalPrice = floatval($totalPrice);

        // Load model and perform database update
        $model = new M_pb(); // Ensure model is correctly named and loaded
        $updateData = [
            'jumlah_transaksi' => $totalPrice,
            'update_at' => date('Y-m-d H:i:s'),
            'update_by' => session()->get('id')
        ];

        // Perform the update operation
        $result = $model->edits('nota', $updateData, ['nomor_transaksi' => $nomorTransaksi]);

        // Check if the totalPrice is zero
        if ($totalPrice == 0) {
            // Delete rows from nota and transaksi tables if totalPrice is 0
            $model->hapus('nota', ['nomor_transaksi' => $nomorTransaksi]);
            $model->hapus('transaksi', ['no_transaksi' => $nomorTransaksi]);
			
            return $this->response->setJSON(['success' => true, 'message' => 'Rows deleted due to zero total price']);
        }

        // Check if the update was successful
        if ($result) {
            return $this->response->setJSON(['success' => true]);
        } else {
            $errorMsg = 'Update failed for nomor_transaksi: ' . $nomorTransaksi;
            error_log($errorMsg);
            return $this->response->setJSON(['success' => false, 'message' => $errorMsg]);
        }

    } catch (\Exception $e) {
        $exceptionMsg = 'Exception: ' . $e->getMessage();
        error_log($exceptionMsg);
        return $this->response->setJSON(['success' => false, 'message' => $exceptionMsg]);
    }
}

public function pay($id) {
    try {
        if (session()->get('level') > 0) {
            $model = new M_pb();
			$this->log_activity('User membuka view pay');
            // Get user data
            $where = ['id_user' => session()->get('id')];
            $data['dua'] = $model->getWhere('user', $where);
            $kkeranjang = $this->request->getPost('kode_keranjang');
			$where3 = array('keranjang.kode_keranjang' => $id);
			$this->log_activity('User Membuka View pay');


			}
            $where = ['id_setting' => 1];
            $data['setting'] = $model->getWhere('setting', $where);
            
            
            $kodeKeranjang = session()->get('kode_keranjang');
            $data['satu'] = $model->groupbyjoinnwhere('keranjang', 'barang', 'barang.id_barang = keranjang.id_barang', $where3);
            
            // Pass kode_keranjang and id_user to view
            $data['kode_keranjang'] = $kodeKeranjang; // Ensure this is set
            $data['id_user'] = session()->get('id');   // Ensure this is set
            $data['menus'] = $model->getFilteredMenu();
            echo view('header', $data);
            echo view('menu', $data);
            echo view('bayar', $data);
            echo view('footer', $data);
			
    } catch (Exception $e) {
        log_message('error', 'An error occurred: ' . $e->getMessage());
        return $this->response->setJSON(['status' => 'error', 'message' => 'An error occurred while processing the payment.']);
    }
}

public function tkeranjang(){
	if (session()->get('level') == 1 || session()->get('level') == 3) {
		$model = new M_pb();
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$where1 = array('barang.delete' => '0');
		$where2 = array('barang.status' => 'tersedia');
		$data['satu'] = $model->tampilWhere2('barang',$where1,$where2);
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
		$this->log_activity('User Membuka View tkeranjang');
		$data['menus'] = $model->getFilteredMenu();
		echo view('header',$data);
		echo view('menu',$data);
		echo view('tkeranjang',$data);
		echo view('footer');
	} elseif(session()->get('level') == 2) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('Home/login');
	}
}



	public function userlog(){
		if (session()->get('level') == 1) {
		$model = new M_pb();
		$this->log_activity('User membuka view userlog');
		$where = array('id_user' => session()->get('id'));
		$data['dua'] = $model->getwhere('user', $where);
		$where1 = array('activity.delete' => '0');
		$data['satu'] = $model->join('activity','user','activity.id_user = user.id_user',$where1);
		$where = array('id_setting' => 1);
		$data['setting'] = $model->getwhere('setting', $where);
		$data['menus'] = $model->getFilteredMenu();
		echo view('header',$data);
		echo view('menu',$data);
		echo view('userlog',$data);
		echo view('footer');
	} elseif(session()->get('level') == 2||session()->get('level') == 3) {
		return redirect()->to('Home/notfound');
	}else{
		return redirect()->to('home/login');
	}
	}

	public function huserlog($id)
	{
		$model = new M_pb();
		$where = array('id_activity' => $id);
		$model->hapus('activity', $where);
		$this->log_activity('User Menghapus data activity');

		return redirect()->to('Home/userlog');
	}

	public function restoreupbarang($id)
{
    $model = new M_pb();

    // Restore product data
    $model->restoreProduct('barang_backup','id_barang',$id);
	$this->updatelog('User Restore Updated Data Barang');
    return redirect()->to('home/barang');
}

public function restoreupbarangm($id)
{
    $model = new M_pb();

    // Restore product data
    $model->restoreProduct('barangmasuk_backup','id_bmasuk',$id);
	$this->updatelog('User Restore Updated Data Barang Masuk');
    return redirect()->to('home/barangmasuk');
}

public function restoreupbarangk($id)
{
    $model = new M_pb();

    // Restore product data
    $model->restoreProduct('barangkeluar_backup','id_bkeluar',$id);
	$this->updatelog('User Restore Updated Data Barang Keluar');
    return redirect()->to('home/barangkeluar');
}

public function updatelogs(){
	if (session()->get('level') == 1) {
	$model = new M_pb();
	$this->log_activity('User membuka view updatelogs');
	$where = array('id_user' => session()->get('id'));
	$data['dua'] = $model->getwhere('user', $where);
	$where1 = array('updatelog.delete' => '0');
	$data['satu'] = $model->join('updatelog','user','updatelog.id_user = user.id_user',$where1);
	$where = array('id_setting' => 1);
	$data['setting'] = $model->getwhere('setting', $where);
	$data['menus'] = $model->getFilteredMenu();
	echo view('header',$data);
	echo view('menu',$data);
	echo view('updatelog',$data);
	echo view('footer');
} elseif(session()->get('level') == 2||session()->get('level') == 3) {
	return redirect()->to('Home/notfound');
}else{
	return redirect()->to('home/login');
}
}

public function hupdatelog($id)
	{
		$model = new M_pb();
		$where = array('id_updatelog' => $id);
		$model->hapus('updatelog', $where);
		$this->log_activity('User Menghapus data UpdateLog');

		return redirect()->to('Home/updatelogs');
	}

	public function managemenu()
	{
		// if (session()->get('level') == 1) {
			$model = new M_pb();
			
			// Log user activity
			$this->log_activity('User membuka view updatelogs');
			$data['menus'] = $model->getFilteredMenu(); // Memanggil fungsi yang sudah diperbarui
			// Fetch user details
			$where = ['id_user' => session()->get('id')];
			$data['dua'] = $model->getwhere('user', $where);
	
			// Build the menu tree
			// $data['menus'] = $model->buildMenuTree();
			
			// Fetch all menu items
			$data['menuss'] = $model->tampil('menus');
	
			// Fetch settings
			$where = ['id_setting' => 1];
			$data['setting'] = $model->getwhere('setting', $where);
			
			// Load views
			echo view('header', $data);
			echo view('menu', $data);
			echo view('managemenu', $data);
			echo view('footer');
		// } elseif (session()->get('level') == 2 || session()->get('level') == 3) {
		// 	return redirect()->to('Home/notfound');
		// } else {
		// 	return redirect()->to('home/login');
		// }
	}

	public function updateMenuVisibility()
{
    // Get POST data
    $postData = $this->request->getPost();

    // Debug: Print the POST data to ensure it contains 'menus'
    log_message('debug', 'Post Data: ' . print_r($postData, true));

    // Check if 'menus' data exists
    if (!isset($postData['menus']) || empty($postData['menus'])) {
        return redirect()->back()->with('message', 'No data to update.');
    }

    // Load the model for managing menus
    $menuModel = new M_pb();

    // Fetch all menu items
    $menus = $menuModel->tampil('menus');

    // Check if menu items are fetched
    if (empty($menus)) {
        return redirect()->back()->with('message', 'No menus found to update.');
    }

    // Update visibility based on POST data
    foreach ($menus as $menu) {
        $id = $menu->id;

        // Determine if the menu should be shown for level 3
        $showForLevel3 = isset($postData['menus'][$id]) ? ($postData['menus'][$id] == '1') : false;

        // Log the data being updated
        log_message('debug', "Updating Menu ID: $id, Show for Level 3: $showForLevel3");

        // Update the menu in the database
        $menuModel->updates($id, ['show_for_level_3' => $showForLevel3]);
    }

    // Redirect back with a success message
    return redirect()->back()->with('message', 'Menu visibility updated successfully.');
}

// Controller atau fungsi di PHP untuk menghasilkan CAPTCHA



}


