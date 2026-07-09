<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - KerjaHarian</title>
    <style>
        body {
            background-color: #f4f7f6;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }
        .register-card {
            background-color: #ffffff;
            padding: 45px 40px;
            border-radius: 32px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.04);
            width: 100%;
            max-width: 580px;
            text-align: center;
            transition: max-width 0.4s ease;
        }
        .register-card.expanded {
            max-width: 500px;
        }
        .logo-container {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 54px;
            height: 54px;
            background-color: #f1b513;
            border-radius: 14px;
            color: white;
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 24px;
        }
        .title {
            font-size: 26px;
            color: #09212c;
            font-weight: 700;
            margin: 0 0 8px 0;
        }
        .subtitle {
            font-size: 14px;
            color: #718096;
            margin: 0 0 35px 0;
            line-height: 1.5;
        }
        .role-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 35px;
        }
        .role-box {
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            padding: 25px 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            text-align: left;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .role-box:hover {
            border-color: #007b83;
            background-color: #f0f9fa;
        }
        .role-box.active {
            border-color: #007b83;
            background-color: #f0f9fa;
        }
        .role-icon {
            width: 40px;
            height: 40px;
            background-color: #e6f2f3;
            color: #007b83;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }
        .role-box.active .role-icon {
            background-color: #007b83;
            color: white;
        }
        .role-title {
            font-size: 16px;
            font-weight: 600;
            color: #1a202c;
            margin-bottom: 6px;
        }
        .role-desc {
            font-size: 12px;
            color: #718096;
            line-height: 1.4;
        }
        .radio-dot {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 18px;
            height: 18px;
            border: 2px solid #cbd5e0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .role-box.active .radio-dot {
            border-color: #007b83;
        }
        .role-box.active .radio-dot::after {
            content: '';
            width: 10px;
            height: 10px;
            background-color: #007b83;
            border-radius: 50%;
        }
        .form-section {
            display: none;
            text-align: left;
            animation: fadeIn 0.4s ease forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .input-group {
            margin-bottom: 20px;
        }
        .input-group label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: #a0aec0;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        .input-wrapper {
            position: relative;
        }
        .input-wrapper input, .input-wrapper select {
            width: 100%;
            padding: 14px 16px;
            background-color: #f3f4f6;
            border: 1px solid transparent;
            border-radius: 12px;
            font-size: 14px;
            color: #1a202c;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }
        .input-wrapper input:focus, .input-wrapper select:focus {
            outline: none;
            background-color: #ffffff;
            border-color: #007b83;
            box-shadow: 0 0 0 3px rgba(0, 123, 131, 0.1);
        }
        .btn-submit {
            background-color: #007b83;
            color: #ffffff;
            border: none;
            padding: 14px;
            border-radius: 12px;
            width: 100%;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }
        .btn-submit:hover {
            background-color: #005f66;
        }
        .footer-text {
            margin-top: 30px;
            font-size: 13px;
            color: #718096;
        }
        .footer-link {
            color: #007b83;
            text-decoration: none;
            font-weight: 600;
        }
        .footer-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="register-card" id="main-card">
        <div class="logo-container">K</div>
        <h2 class="title">Bergabung di KerjaHarian</h2>
        <p class="subtitle" id="dynamic-subtitle">Silakan pilih peran utama Anda untuk mulai mengelola proyek atau mencari pekerjaan harian.</p>

        <div class="role-container" id="role-selection-section">
            <div class="role-box" onclick="selectRole('pemberi_kerja')">
                <div class="radio-dot"></div>
                <div>
                    <div class="role-icon">💼</div>
                    <div class="role-title">Pemberi Kerja</div>
                    <div class="role-desc">Saya ingin merekrut pekerja dan memposting proyek harian.</div>
                </div>
            </div>

            <div class="role-box" onclick="selectRole('pelamar')">
                <div class="radio-dot"></div>
                <div>
                    <div class="role-icon">💻</div>
                    <div class="role-title">Pencari Kerja</div>
                    <div class="role-desc">Saya ingin mencari pekerjaan harian dan melamar proyek.</div>
                </div>
            </div>
        </div>

        <form action="{{ route('register.process') }}" method="POST" class="form-section" id="register-form">
        @csrf
            <input type="hidden" name="role" id="role-input">

            <div class="input-group">
                <label for="name">Nama Lengkap</label>
                <div class="input-wrapper">
                    <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap Anda" required>
                </div>
            </div>

            <div class="input-group">
                <label for="email">Alamat Email</label>
                <div class="input-wrapper">
                    <input type="email" id="email" name="email" placeholder="contoh@gmail.com" required>
                </div>
            </div>

            <div class="input-group">
                <label for="phone">No. Telepon / WhatsApp</label>
                <div class="input-wrapper">
                    <input type="text" id="phone" name="phone" placeholder="08xxxxxxxxxx" required>
                </div>
            </div>

            <div id="jobseeker-fields" style="display: none;">
                <div class="input-group">
                    <label for="category">Kategori Keahlian Utama</label>
                    <div class="input-wrapper">
                        <select id="category" name="category">
                            <option value="" disabled selected>Pilih keahlian Anda</option>
                            <option value="it_programming">Teknologi & Pemrograman</option>
                            <option value="design_creative">Desain & Kreatif</option>
                            <option value="writing_translation">Penulisan & Penerjemahan</option>
                            <option value="admin_sales">Administrasi & Penjualan</option>
                            <option value="jasa_harian">Jasa Umum & Harian</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="input-group">
                <label for="password">Kata Sandi</label>
                <div class="input-wrapper">
                    <input type="password" id="password" name="password" placeholder="Minimal 8 karakter" required>
                </div>
            </div>

            <div class="input-group">
                <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                <div class="input-wrapper">
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi" required>
                </div>
            </div>

            <button type="submit" class="btn-submit" id="submit-button">Daftar Sebagai Pencari Kerja</button>
        </form>

        <p class="footer-text">Belum punya akun KerjaHarian? <a href="/login" class="footer-link">Masuk Sekarang</a></p>
    </div>

    <script>
        function selectRole(role) {
            const boxes = document.querySelectorAll('.role-box');
            boxes.forEach(box => box.classList.remove('active'));

            const card = document.getElementById('main-card');
            const form = document.getElementById('register-form');
            const roleInput = document.getElementById('role-input');
            const jobseekerFields = document.getElementById('jobseeker-fields');
            const submitBtn = document.getElementById('submit-button');
            const subtitle = document.getElementById('dynamic-subtitle');

            if (role === 'pemberi_kerja') {
                boxes[0].classList.add('active');
                roleInput.value = 'pemberi_kerja';
                jobseekerFields.style.display = 'none';
                submitBtn.innerText = 'Daftar Sebagai Pemberi Kerja';
                subtitle.innerText = 'Isi data di bawah untuk mulai memposting lowongan pekerjaan harian Anda.';
            } else if (role === 'pelamar') {
                boxes[1].classList.add('active');
                roleInput.value = 'pelamar';
                jobseekerFields.style.display = 'block';
                submitBtn.innerText = 'Daftar Sebagai Pencari Kerja';
                subtitle.innerText = 'Lengkapi profil harian Anda untuk mulai menemukan proyek dan pekerjaan yang cocok.';
            }

            card.classList.add('expanded');
            form.style.display = 'block';
        }
    </script>
</body>
</html>