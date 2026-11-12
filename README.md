```html
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dokumentasi PKL2026 - Sistem Informasi Pengaduan berbasis web dengan workflow pengaduan, role management, dan administrasi sistem.">
    <meta name="author" content="PKL2026 Development Team">
    <title>PKL2026 | System Documentation</title>

    <style>
        :root {
            --background: #0d1117;
            --surface: #161b22;
            --surface-light: #21262d;
            --border: #30363d;
            --text: #e6edf3;
            --muted: #8b949e;
            --primary: #58a6ff;
            --primary-dark: #1f6feb;
            --success: #3fb950;
            --warning: #d29922;
            --radius: 12px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 85px;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI",
                Helvetica, Arial, sans-serif;
            background: var(--background);
            color: var(--text);
            line-height: 1.75;
            font-size: 15px;
        }

        a {
            color: var(--primary);
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        code {
            font-family: Consolas, "Courier New", monospace;
            background: rgba(110, 118, 129, 0.2);
            padding: 3px 6px;
            border-radius: 5px;
            font-size: 0.9em;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(13, 17, 23, 0.95);
            border-bottom: 1px solid var(--border);
            backdrop-filter: blur(12px);
        }

        .navbar-inner {
            max-width: 1150px;
            margin: auto;
            padding: 15px 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .brand {
            color: var(--text);
            font-size: 19px;
            font-weight: 750;
            letter-spacing: -0.5px;
        }

        .brand span {
            color: var(--primary);
        }

        .nav-links {
            display: flex;
            gap: 22px;
            flex-wrap: wrap;
            font-size: 13px;
        }

        .nav-links a {
            color: var(--muted);
        }

        .nav-links a:hover {
            color: var(--text);
            text-decoration: none;
        }

        .container {
            max-width: 1150px;
            margin: auto;
            padding: 0 25px;
        }

        .hero {
            padding: 85px 0 65px;
            border-bottom: 1px solid var(--border);
            background:
                radial-gradient(ellipse at 15% 0%, rgba(31, 111, 235, 0.16), transparent 55%);
        }

        .eyebrow {
            color: var(--primary);
            text-transform: uppercase;
            font-size: 12px;
            font-weight: 750;
            letter-spacing: 1.5px;
            margin-bottom: 15px;
        }

        .hero h1 {
            font-size: clamp(35px, 6vw, 57px);
            line-height: 1.15;
            letter-spacing: -2px;
            margin-bottom: 20px;
        }

        .hero h1 span {
            color: var(--primary);
        }

        .hero-description {
            max-width: 780px;
            color: var(--muted);
            font-size: 16px;
            margin-bottom: 28px;
        }

        .hero-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 18px;
            border-radius: 7px;
            font-size: 13px;
            font-weight: 650;
            border: 1px solid var(--border);
        }

        .button-primary {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            color: white;
        }

        .button-secondary {
            color: var(--text);
            background: var(--surface);
        }

        .button:hover {
            text-decoration: none;
            opacity: 0.85;
        }

        .metadata {
            display: flex;
            gap: 25px;
            flex-wrap: wrap;
            margin-top: 32px;
            color: var(--muted);
            font-size: 13px;
        }

        .metadata strong {
            color: var(--text);
        }

        .layout {
            display: grid;
            grid-template-columns: 230px minmax(0, 1fr);
            gap: 45px;
            padding-top: 45px;
            padding-bottom: 70px;
        }

        .sidebar {
            position: sticky;
            top: 90px;
            align-self: start;
            max-height: calc(100vh - 110px);
            overflow-y: auto;
            padding-right: 10px;
        }

        .sidebar h3 {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--muted);
            margin-bottom: 15px;
        }

        .sidebar a {
            display: block;
            color: var(--muted);
            padding: 7px 10px;
            font-size: 13px;
            border-left: 2px solid transparent;
        }

        .sidebar a:hover {
            color: var(--text);
            border-left-color: var(--primary);
            background: var(--surface);
            text-decoration: none;
        }

        main {
            min-width: 0;
        }

        section {
            margin-bottom: 60px;
        }

        .section-heading {
            font-size: 25px;
            letter-spacing: -0.7px;
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .section-description {
            color: var(--muted);
            margin-bottom: 25px;
        }

        .divider {
            border: none;
            border-top: 1px solid var(--border);
            margin: 30px 0;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 15px;
        }

        .info-card {
            background: var(--surface);
            border: 1px solid var(--border);
            padding: 20px;
            border-radius: var(--radius);
        }

        .info-card h3 {
            font-size: 15px;
            margin-bottom: 9px;
        }

        .info-card p {
            color: var(--muted);
            font-size: 13px;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .feature-card {
            padding: 22px;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            background: var(--surface);
        }

        .feature-icon {
            font-size: 25px;
            margin-bottom: 12px;
        }

        .feature-card h3 {
            font-size: 16px;
            margin-bottom: 8px;
        }

        .feature-card p {
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 12px;
        }

        .feature-card ul {
            padding-left: 18px;
            color: var(--muted);
            font-size: 13px;
        }

        .feature-card li {
            margin-bottom: 5px;
        }

        .table-wrapper {
            overflow-x: auto;
            border: 1px solid var(--border);
            border-radius: var(--radius);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 550px;
            font-size: 13px;
        }

        th, td {
            text-align: left;
            padding: 14px 16px;
            border-bottom: 1px solid var(--border);
        }

        th {
            background: var(--surface-light);
            color: var(--text);
            font-weight: 650;
        }

        td {
            color: var(--muted);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        td strong {
            color: var(--text);
        }

        .role-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 22px;
            margin-bottom: 16px;
        }

        .role-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .role-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            background: var(--surface-light);
            font-size: 21px;
        }

        .role-header h3 {
            font-size: 16px;
        }

        .role-header span {
            display: block;
            color: var(--muted);
            font-size: 12px;
        }

        .role-card p {
            color: var(--muted);
            font-size: 13px;
            margin-bottom: 10px;
        }

        .role-card ul {
            padding-left: 20px;
            color: var(--muted);
            font-size: 13px;
        }

        .workflow {
            position: relative;
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .workflow-step {
            position: relative;
            display: flex;
            gap: 17px;
            padding-bottom: 25px;
        }

        .workflow-number {
            flex-shrink: 0;
            width: 35px;
            height: 35px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid var(--primary);
            background: var(--surface);
            color: var(--primary);
            border-radius: 50%;
            font-weight: 700;
            font-size: 13px;
        }

        .workflow-content {
            padding-top: 3px;
        }

        .workflow-content h3 {
            font-size: 15px;
            margin-bottom: 4px;
        }

        .workflow-content p {
            color: var(--muted);
            font-size: 13px;
        }

        .code-block {
            background: #010409;
            border: 1px solid var(--border);
            border-radius: 9px;
            padding: 18px;
            overflow-x: auto;
            margin: 12px 0 18px;
        }

        .code-block pre {
            color: #c9d1d9;
            font-family: Consolas, "Courier New", monospace;
            font-size: 13px;
            line-height: 1.8;
            white-space: pre;
        }

        .notice {
            background: rgba(31, 111, 235, 0.08);
            border: 1px solid rgba(88, 166, 255, 0.3);
            border-radius: 9px;
            padding: 16px;
            color: var(--muted);
            font-size: 13px;
            margin-top: 20px;
        }

        .notice strong {
            color: var(--primary);
        }

        .status {
            display: inline-block;
            font-size: 11px;
            padding: 3px 8px;
            border-radius: 20px;
            font-weight: 650;
            background: rgba(210, 153, 34, 0.12);
            color: var(--warning);
        }

        .footer {
            border-top: 1px solid var(--border);
            padding: 30px 0;
            text-align: center;
            color: var(--muted);
            font-size: 12px;
        }

        .footer strong {
            color: var(--text);
        }

        @media (max-width: 850px) {
            .layout {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .sidebar {
                position: static;
                max-height: none;
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .sidebar h3 {
                grid-column: 1 / -1;
            }

            .nav-links {
                display: none;
            }
        }

        @media (max-width: 550px) {
            .container {
                padding: 0 17px;
            }

            .hero {
                padding: 55px 0 40px;
            }

            .info-grid,
            .feature-grid {
                grid-template-columns: 1fr;
            }

            .metadata {
                gap: 12px;
                flex-direction: column;
            }

            .sidebar {
                grid-template-columns: 1fr;
            }

            .section-heading {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>

    <header class="navbar">
        <div class="navbar-inner">
            <a href="#" class="brand">PKL<span>2026</span></a>

            <nav class="nav-links">
                <a href="#overview">Overview</a>
                <a href="#features">Features</a>
                <a href="#roles">User Roles</a>
                <a href="#workflow">Workflow</a>
                <a href="#installation">Installation</a>
            </nav>
        </div>
    </header>

    <div class="hero">
        <div class="container">
            <div class="eyebrow">Project Documentation</div>

            <h1>PKL2026<br><span>Complaint Management System</span></h1>

            <p class="hero-description">
                Sistem Informasi Pengaduan berbasis web yang dirancang
                untuk mengelola laporan masyarakat, mengatur hak akses
                pengguna, mengorganisasi workflow penanganan pengaduan,
                serta mendukung pengelolaan administrasi secara terstruktur
                dan terintegrasi.
            </p>

            <div class="hero-actions">
                <a class="button button-primary"
                   href="https://github.com/KeithMalvado/PKL2026">
                    ↗ View Repository
                </a>

                <a class="button button-secondary"
                   href="#features">
                    Explore Features
                </a>
            </div>

            <div class="metadata">
                <span>📁 <strong>Repository:</strong> PKL2026</span>
                <span>🌿 <strong>Branch:</strong> fitur-workflow-pengaduan</span>
                <span>⚙️ <strong>Status:</strong> Development</span>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="layout">

            <aside class="sidebar">
                <h3>Documentation</h3>
                <a href="#overview">01. Project Overview</a>
                <a href="#objectives">02. Objectives</a>
                <a href="#features">03. Key Features</a>
                <a href="#roles">04. User Roles</a>
                <a href="#permissions">05. Access Control</a>
                <a href="#workflow">06. Complaint Workflow</a>
                <a href="#modules">07. System Modules</a>
                <a href="#dashboard">08. Dashboard & CMS</a>
                <a href="#technology">09. Technology Stack</a>
                <a href="#structure">10. Project Structure</a>
                <a href="#installation">11. Installation</a>
                <a href="#security">12. Security</a>
                <a href="#development">13. Development</a>
            </aside>

            <main>

                <section id="overview">
                    <h2 class="section-heading">📌 Project Overview</h2>

                    <p class="section-description">
                        PKL2026 merupakan sistem informasi yang berfokus
                        pada pengelolaan pengaduan publik melalui platform
                        digital. Sistem ini menghubungkan proses pelaporan
                        dengan pengelolaan administratif dalam satu
                        lingkungan aplikasi.
                    </p>

                    <div class="info-grid">
                        <div class="info-card">
                            <h3>🏛️ Project Name</h3>
                            <p>PKL2026 - Sistem Informasi Pengaduan</p>
                        </div>

                        <div class="info-card">
                            <h3>🌐 Application Type</h3>
                            <p>Web-Based Information System</p>
                        </div>

                        <div class="info-card">
                            <h3>🎯 Project Category</h3>
                            <p>Complaint Management System</p>
                        </div>

                        <div class="info-card">
                            <h3>🔄 Development Status</h3>
                            <p>Ongoing Development</p>
                        </div>
                    </div>
                </section>

                <hr class="divider">

                <section id="objectives">
                    <h2 class="section-heading">🎯 Project Objectives</h2>

                    <p class="section-description">
                        Tujuan utama pengembangan sistem adalah membangun
                        mekanisme pengaduan yang terstruktur, terintegrasi,
                        dan dapat dikelola berdasarkan kewenangan pengguna.
                    </p>

                    <div class="info-card">
                        <ol style="padding-left: 20px; color: var(--muted);">
                            <li>Menyediakan layanan pengaduan publik berbasis web.</li>
                            <li>Memusatkan pencatatan dan pengelolaan data pengaduan.</li>
                            <li>Menerapkan autentikasi dan pembagian hak akses pengguna.</li>
                            <li>Mengorganisasi proses penanganan melalui workflow.</li>
                            <li>Mendukung monitoring pengaduan melalui dashboard.</li>
                            <li>Menyediakan pengelolaan informasi melalui CMS.</li>
                        </ol>
                    </div>
                </section>

                <hr class="divider">

                <section id="features">
                    <h2 class="section-heading">✨ Key Features</h2>

                    <p class="section-description">
                        Fitur utama yang menjadi ruang lingkup pengembangan
                        aplikasi PKL2026.
                    </p>

                    <div class="feature-grid">

                        <article class="feature-card">
                            <div class="feature-icon">📝</div>
                            <h3>Public Complaint Module</h3>
                            <p>
                                Modul layanan publik untuk mendukung proses
                                penyampaian laporan dan pengaduan masyarakat.
                            </p>
                            <ul>
                                <li>Halaman layanan pengaduan publik.</li>
                                <li>Pencatatan informasi laporan.</li>
                                <li>Pengelolaan data pengaduan.</li>
                                <li>Integrasi dengan administrasi pengaduan.</li>
                            </ul>
                        </article>

                        <article class="feature-card">
                            <div class="feature-icon">🔐</div>
                            <h3>Authentication & Role Management</h3>
                            <p>
                                Modul pengelolaan identitas pengguna dan
                                pembatasan akses berdasarkan role.
                            </p>
                            <ul>
                                <li>Autentikasi pengguna.</li>
                                <li>Manajemen akun.</li>
                                <li>Pembagian role pengguna.</li>
                                <li>Pengaturan hak akses.</li>
                            </ul>
                        </article>

                        <article class="feature-card">
                            <div class="feature-icon">🔄</div>
                            <h3>Complaint Workflow Management</h3>
                            <p>
                                Modul untuk mengorganisasi proses
                                administratif dan penanganan pengaduan.
                            </p>
                            <ul>
                                <li>Pengelolaan laporan masuk.</li>
                                <li>Pengorganisasian penanganan.</li>
                                <li>Penugasan tanggung jawab.</li>
                                <li>Pemantauan perkembangan laporan.</li>
                            </ul>
                        </article>

                        <article class="feature-card">
                            <div class="feature-icon">📊</div>
                            <h3>Admin Panel & CMS</h3>
                            <p>
                                Pusat pengelolaan administratif dan informasi
                                yang digunakan oleh administrator.
                            </p>
                            <ul>
                                <li>Pengelolaan data administratif.</li>
                                <li>Pengelolaan informasi sistem.</li>
                                <li>Manajemen konten CMS.</li>
                                <li>Pemantauan data pengaduan.</li>
                            </ul>
                        </article>

                    </div>
                </section>

                <hr class="divider">

                <section id="roles">
                    <h2 class="section-heading">👥 User Roles & Responsibilities</h2>

                    <p class="section-description">
                        Sistem menerapkan pembagian peran untuk memastikan
                        setiap pengguna memiliki tanggung jawab dan
                        kewenangan yang sesuai.
                    </p>

                    <article class="role-card">
                        <div class="role-header">
                            <div class="role-icon">👤</div>
                            <div>
                                <h3>Pelapor / Masyarakat</h3>
                                <span>Public User</span>
                            </div>
                        </div>

                        <p>
                            Pengguna yang memanfaatkan layanan publik
                            untuk menyampaikan pengaduan dan memperoleh
                            informasi terkait laporan.
                        </p>

                        <ul>
                            <li>Mengakses layanan pengaduan publik.</li>
                            <li>Menyampaikan informasi permasalahan.</li>
                            <li>Mengirimkan laporan melalui sistem.</li>
                            <li>Memperoleh informasi perkembangan laporan sesuai fasilitas yang tersedia.</li>
                        </ul>
                    </article>

                    <article class="role-card">
                        <div class="role-header">
                            <div class="role-icon">🛡️</div>
                            <div>
                                <h3>Administrator</h3>
                                <span>System Administrator</span>
                            </div>
                        </div>

                        <p>
                            Pengguna yang bertanggung jawab terhadap
                            pengelolaan sistem, administrasi, serta
                            pengawasan data pengaduan.
                        </p>

                        <ul>
                            <li>Mengelola data pengaduan.</li>
                            <li>Mengelola akun dan role pengguna.</li>
                            <li>Mengatur kebutuhan administrasi sistem.</li>
                            <li>Mengawasi proses penanganan pengaduan.</li>
                            <li>Mengelola informasi dan konten CMS.</li>
                        </ul>
                    </article>

                    <article class="role-card">
                        <div class="role-header">
                            <div class="role-icon">📋</div>
                            <div>
                                <h3>PIC / Petugas</h3>
                                <span>Person in Charge / Complaint Officer</span>
                            </div>
                        </div>

                        <p>
                            Pengguna yang bertanggung jawab terhadap
                            tindak lanjut laporan berdasarkan penugasan
                            dan kewenangan yang diberikan.
                        </p>

                        <ul>
                            <li>Menerima tanggung jawab pengaduan sesuai penugasan.</li>
                            <li>Menindaklanjuti laporan.</li>
                            <li>Memperbarui informasi penanganan sesuai kewenangan.</li>
                            <li>Mendukung proses penyelesaian pengaduan.</li>
                        </ul>
                    </article>
                </section>

                <hr class="divider">

                <section id="permissions">
                    <h2 class="section-heading">🔑 Role-Based Access Control</h2>

                    <p class="section-description">
                        Pembatasan akses dilakukan berdasarkan peran
                        pengguna. Matriks berikut merupakan gambaran
                        tanggung jawab yang direncanakan dan harus
                        disesuaikan dengan permission aktual aplikasi.
                    </p>

                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>Modul / Aktivitas</th>
                                    <th>Pelapor</th>
                                    <th>Admin</th>
                                    <th>PIC / Petugas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Pengajuan Pengaduan</td>
                                    <td>Pengguna</td>
                                    <td>Kelola</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Pengelolaan Data Pengaduan</td>
                                    <td>Akses sesuai fasilitas</td>
                                    <td>Kelola</td>
                                    <td>Sesuai penugasan</td>
                                </tr>
                                <tr>
                                    <td>Manajemen Pengguna</td>
                                    <td>-</td>
                                    <td>Kelola</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Workflow Pengaduan</td>
                                    <td>Pantau sesuai fasilitas</td>
                                    <td>Kelola</td>
                                    <td>Tindak lanjut</td>
                                </tr>
                                <tr>
                                    <td>Penugasan PIC</td>
                                    <td>-</td>
                                    <td>Kelola</td>
                                    <td>Menerima penugasan</td>
                                </tr>
                                <tr>
                                    <td>Administrasi CMS</td>
                                    <td>-</td>
                                    <td>Kelola</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Monitoring Administrasi</td>
                                    <td>-</td>
                                    <td>Kelola</td>
                                    <td>Sesuai kewenangan</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <hr class="divider">

                <section id="workflow">
                    <h2 class="section-heading">🔄 Complaint Workflow</h2>

                    <p class="section-description">
                        Workflow menggambarkan proses pengelolaan pengaduan
                        sejak laporan disampaikan hingga proses
                        penanganannya diselesaikan.
                    </p>

                    <div class="workflow">

                        <div class="workflow-step">
                            <div class="workflow-number">01</div>
                            <div class="workflow-content">
                                <h3>Pengajuan Pengaduan</h3>
                                <p>
                                    Masyarakat menyampaikan laporan melalui
                                    modul pengaduan publik dengan
                                    melengkapi informasi yang dibutuhkan.
                                </p>
                            </div>
                        </div>

                        <div class="workflow-step">
                            <div class="workflow-number">02</div>
                            <div class="workflow-content">
                                <h3>Penerimaan Laporan</h3>
                                <p>
                                    Data laporan masuk ke dalam sistem
                                    untuk dikelola melalui bagian
                                    administrasi pengaduan.
                                </p>
                            </div>
                        </div>

                        <div class="workflow-step">
                            <div class="workflow-number">03</div>
                            <div class="workflow-content">
                                <h3>Verifikasi dan Pengelolaan</h3>
                                <p>
                                    Administrator mengelola laporan
                                    berdasarkan informasi yang disampaikan
                                    dan kebutuhan proses penanganan.
                                </p>
                            </div>
                        </div>

                        <div class="workflow-step">
                            <div class="workflow-number">04</div>
                            <div class="workflow-content">
                                <h3>Penugasan Penanganan</h3>
                                <p>
                                    Pengaduan diarahkan kepada PIC atau
                                    petugas yang memiliki tanggung jawab
                                    terhadap tindak lanjut laporan.
                                </p>
                            </div>
                        </div>

                        <div class="workflow-step">
                            <div class="workflow-number">05</div>
                            <div class="workflow-content">
                                <h3>Proses Tindak Lanjut</h3>
                                <p>
                                    PIC atau petugas menjalankan proses
                                    penanganan dan memperbarui informasi
                                    perkembangan sesuai kewenangannya.
                                </p>
                            </div>
                        </div>

                        <div class="workflow-step">
                            <div class="workflow-number">06</div>
                            <div class="workflow-content">
                                <h3>Monitoring dan Penyelesaian</h3>
                                <p>
                                    Administrator memantau perkembangan
                                    laporan hingga proses penanganan
                                    mencapai penyelesaian sesuai prosedur.
                                </p>
                            </div>
                        </div>

                    </div>

                    <div class="notice">
                        <strong>Catatan Workflow:</strong>
                        Status pengaduan, mekanisme disposisi, aturan
                        perubahan status, dan otorisasi setiap tahapan
                        harus mengikuti implementasi aktual aplikasi.
                    </div>
                </section>

                <hr class="divider">

                <section id="modules">
                    <h2 class="section-heading">🧩 System Modules</h2>

                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>Module</th>
                                    <th>Primary Function</th>
                                    <th>Target User</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Public Complaint</strong></td>
                                    <td>Pengajuan laporan masyarakat</td>
                                    <td>Pelapor</td>
                                </tr>
                                <tr>
                                    <td><strong>Authentication</strong></td>
                                    <td>Autentikasi pengguna</td>
                                    <td>Seluruh pengguna</td>
                                </tr>
                                <tr>
                                    <td><strong>Role Management</strong></td>
                                    <td>Pengelolaan hak akses</td>
                                    <td>Admin</td>
                                </tr>
                                <tr>
                                    <td><strong>Complaint Administration</strong></td>
                                    <td>Pengelolaan data laporan</td>
                                    <td>Admin</td>
                                </tr>
                                <tr>
                                    <td><strong>Complaint Workflow</strong></td>
                                    <td>Pengelolaan proses penanganan</td>
                                    <td>Admin / PIC</td>
                                </tr>
                                <tr>
                                    <td><strong>Admin Panel</strong></td>
                                    <td>Administrasi sistem</td>
                                    <td>Admin</td>
                                </tr>
                                <tr>
                                    <td><strong>CMS</strong></td>
                                    <td>Pengelolaan konten dan informasi</td>
                                    <td>Admin</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <hr class="divider">

                <section id="dashboard">
                    <h2 class="section-heading">📊 Dashboard & CMS</h2>

                    <p class="section-description">
                        Dashboard administrasi menjadi pusat akses
                        informasi operasional dan pengelolaan modul
                        sistem.
                    </p>

                    <div class="info-grid">
                        <div class="info-card">
                            <h3>📈 Monitoring</h3>
                            <p>
                                Mendukung pemantauan data dan aktivitas
                                pengelolaan pengaduan.
                            </p>
                        </div>

                        <div class="info-card">
                            <h3>🗂️ Data Administration</h3>
                            <p>
                                Mendukung pengelolaan informasi dan data
                                administratif aplikasi.
                            </p>
                        </div>

                        <div class="info-card">
                            <h3>📝 Content Management</h3>
                            <p>
                                Mendukung pengelolaan konten dan informasi
                                melalui CMS.
                            </p>
                        </div>

                        <div class="info-card">
                            <h3>⚙️ System Management</h3>
                            <p>
                                Menjadi pusat pengelolaan kebutuhan
                                operasional sistem.
                            </p>
                        </div>
                    </div>
                </section>

                <hr class="divider">

                <section id="technology">
                    <h2 class="section-heading">🛠️ Technology Stack</h2>

                    <p class="section-description">
                        Teknologi berikut harus disesuaikan dengan
                        dependensi dan konfigurasi aktual repository.
                    </p>

                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>Component</th>
                                    <th>Technology</th>
                                    <th>Purpose</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Backend</td>
                                    <td>Laravel / PHP</td>
                                    <td>Server-side application</td>
                                </tr>
                                <tr>
                                    <td>Frontend</td>
                                    <td>Blade / HTML / CSS / JavaScript</td>
                                    <td>User interface</td>
                                </tr>
                                <tr>
                                    <td>Database</td>
                                    <td>Menyesuaikan konfigurasi</td>
                                    <td>Data storage</td>
                                </tr>
                                <tr>
                                    <td>Version Control</td>
                                    <td>Git & GitHub</td>
                                    <td>Source code management</td>
                                </tr>
                                <tr>
                                    <td>Development Environment</td>
                                    <td>Local Development Environment</td>
                                    <td>Application development</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <hr class="divider">

                <section id="structure">
                    <h2 class="section-heading">📁 Project Structure</h2>

                    <p class="section-description">
                        Gambaran struktur direktori proyek Laravel.
                        Struktur berikut merupakan template dan perlu
                        disesuaikan dengan direktori aktual.
                    </p>

                    <div class="code-block">
<pre>PKL2026/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   └── Models/
├── bootstrap/
├── config/
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
├── routes/
│   ├── web.php
│   └── api.php
├── storage/
├── tests/
├── .env.example
├── artisan
├── composer.json
└── README.md</pre>
                    </div>
                </section>

                <hr class="divider">

                <section id="installation">
                    <h2 class="section-heading">🚀 Installation & Setup</h2>

                    <p class="section-description">
                        Panduan persiapan lingkungan pengembangan
                        lokal untuk aplikasi berbasis Laravel.
                    </p>

                    <h3>1. Clone Repository</h3>
                    <div class="code-block">
<pre>git clone https://github.com/KeithMalvado/PKL2026.git</pre>
                    </div>

                    <h3>2. Masuk ke Direktori Project</h3>
                    <div class="code-block">
<pre>cd PKL2026</pre>
                    </div>

                    <h3>3. Install Dependencies</h3>
                    <div class="code-block">
<pre>composer install</pre>
                    </div>

                    <h3>4. Konfigurasi Environment</h3>
                    <div class="code-block">
<pre>cp .env.example .env</pre>
                    </div>

                    <h3>5. Generate Application Key</h3>
                    <div class="code-block">
<pre>php artisan key:generate</pre>
                    </div>

                    <h3>6. Jalankan Database Migration</h3>
                    <div class="code-block">
<pre>php artisan migrate</pre>
                    </div>

                    <h3>7. Jalankan Aplikasi</h3>
                    <div class="code-block">
<pre>php artisan serve</pre>
                    </div>

                    <div class="notice">
                        <strong>Important:</strong>
                        Sebelum menjalankan aplikasi, pastikan konfigurasi
                        database pada file .env sudah sesuai dan database
                        telah tersedia. Perintah di atas perlu disesuaikan
                        dengan dependensi serta konfigurasi aktual proyek.
                    </div>
                </section>

                <hr class="divider">

                <section id="security">
                    <h2 class="section-heading">🔐 Security & Access Control</h2>

                    <p class="section-description">
                        Keamanan aplikasi menjadi aspek penting untuk
                        melindungi data pengaduan dan memastikan
                        pengelolaan sistem berjalan sesuai kewenangan.
                    </p>

                    <div class="info-card">
                        <ul style="padding-left: 20px; color: var(--muted);">
                            <li>Autentikasi identitas pengguna.</li>
                            <li>Pengaturan akses berdasarkan role.</li>
                            <li>Pembatasan akses modul administratif.</li>
                            <li>Validasi data yang dikirimkan pengguna.</li>
                            <li>Perlindungan konfigurasi dan informasi sensitif.</li>
                            <li>Pengelolaan data berdasarkan tanggung jawab pengguna.</li>
                        </ul>
                    </div>
                </section>

                <hr class="divider">

                <section id="development">
                    <h2 class="section-heading">🌿 Development & Contribution</h2>

                    <p class="section-description">
                        Pengembangan aplikasi menggunakan Git sebagai
                        version control untuk menjaga perubahan source
                        code tetap terorganisasi.
                    </p>

                    <h3>Development Branches</h3>

                    <div class="table-wrapper" style="margin: 15px 0 25px;">
                        <table>
                            <thead>
                                <tr>
                                    <th>Branch</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><code>main</code></td>
                                    <td>Cabang utama repository.</td>
                                </tr>
                                <tr>
                                    <td><code>fitur-workflow-pengaduan</code></td>
                                    <td>Cabang pengembangan workflow pengaduan.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h3>Contribution Workflow</h3>

                    <div class="code-block">
<pre>git pull origin main

git checkout -b fitur-nama-fitur

git add .

git commit -m "feat: deskripsi perubahan"

git push origin fitur-nama-fitur</pre>
                    </div>

                    <p style="color: var(--muted); font-size: 13px;">
                        Setiap perubahan sebaiknya diuji sebelum dikirim
                        dan digabungkan ke branch utama melalui proses
                        review.
                    </p>
                </section>

                <hr class="divider">

                <section id="license">
                    <h2 class="section-heading">📄 License</h2>

                    <p class="section-description">
                        Informasi lisensi dan ketentuan distribusi
                        perangkat lunak mengikuti kebijakan yang
                        ditetapkan pada repository.
                    </p>
                </section>

            </main>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p><strong>PKL2026</strong> — Complaint Management System</p>
            <p>Structured Complaint Management · Administrative Workflow · Role-Based Access Control</p>
            <p style="margin-top: 10px;">
                <a href="https://github.com/KeithMalvado/PKL2026">
                    GitHub Repository
                </a>
            </p>
        </div>
    </footer>

</body>
</html>
```
