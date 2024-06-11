<?php
session_start();
include("../koneksi.php");

if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $query = "SELECT name FROM tbl_users WHERE email = '$email'";
    $result = mysqli_query($koneksi, $query);
    $user = mysqli_fetch_assoc($result);
    $namaPengguna = $user['name'];
}

if(isset($_GET['logout'])) {
    session_destroy(); 
    header("Location: ../index.html"); 
    exit();
}

if (isset($_SESSION['flash_message'])) {
    echo "<script>alert('" . $_SESSION['flash_message'] . "');</script>";
    unset($_SESSION['flash_message']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Techion</title>
    <link rel="stylesheet" href="student.css">
    <script src="script.js" defer></script>
</head>
<body>
    <nav>
        <div class="wrapper">
            <div class="logo"><a href=''>Techion</a></div>
            <div class="menu">
                <a href="#" class="tombol-menu">
                    <span class="garis"></span>
                    <span class="garis"></span>
                    <span class="garis"></span>
                </a>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#article">Article</a></li>
                    <li><a href="#videocontent">Video Content</a></li>
                    <li><a href="#course">Course</a></li>
                    <li><a href="#discforum">Discussion Forum</a></li>
                    <?php if(isset($namaPengguna)) { ?>
                        <li><a href="#" class="tbl-biru"><?php echo $namaPengguna; ?></a></li>
                        <li><a href="?logout=true" class="logout-ya">Logout</a></li> 
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper">
        <!-- untuk home -->
        <section id="home">
            <img src="https://img.freepik.com/free-vector/web-development-programmer-engineering-coding-website-augmented-reality-interface-screens-developer-project-engineer-programming-software-application-design-cartoon-illustration_107791-3863.jpg?size=626&ext=jpg&ga=GA1.2.1769275626.1605867161"/>
            <div class="kolom">
                <p class="deskripsi">Edukasi dan Pelatihan Teknologi</p>
                <h2>Kembangkan Skill dan Pengetahuan Anda</h2>
                <p>Techion adalah platform komprehensif yang menyediakan berbagai kursus online interaktif untuk meningkatkan keterampilan teknologi pengguna. Fitur-fiturnya meliputi artikel terkait, konten video, kursus online, dan forum komunitas.</p>
                <p><a href="" class="tbl-pink">Pelajari Lebih Lanjut</a></p>
            </div>
        </section>

        <!-- untuk article and video content -->
        <section id="articlevideo">
            <div class="kolom">
                <p class="deskripsi">You Will Need This</p>
                <h2>Articles and Video Content</h2>
                <p>Menyediakan fitur artikel yang mencakup beragam topik mulai dari tren industri terbaru hingga panduan mendalam tentang teknologi spesifik, ditulis oleh pakar untuk memperkaya pengetahuan pengguna.</p>
                <p>Video konten meliputi tutorial langkah-demi-langkah, webinar interaktif, studi kasus nyata, penjelasan konsep, wawancara dengan ahli, review produk teknologi, latihan coding, dan penugasan praktis, semuanya dirancang untuk memberikan pembelajaran yang komprehensif dan aplikatif.</p>
                <p><a href="" class="tbl-biru">Pelajari Lebih Lanjut</a></p>
            </div>
            <img src="https://img.freepik.com/free-vector/online-learning-isometric-concept_1284-17947.jpg?size=626&ext=jpg&ga=GA1.2.1769275626.1605867161"/>
        </section>

        <!-- untuk top course -->
        <section id="course">
            <div class="tengah">
                <div class="kolom">
                    <p class="deskripsi">Our Top Courses</p>
                    <h2>Courses</h2>
                    <p> Menawarkan konten multimedia interaktif oleh mentor berpengalaman dan sertifikasi digital yang dapat diunduh setelah menyelesaikan kursus, serta akses mobile dan offline untuk belajar kapan saja dan di mana saja.
                    </p>
                </div>

                <div class="courses-list">
                    <div class="kartu-course">
                        <img src="image\pemweb.jpg"/>
                        <p>Pemrograman Web</p>
                    </div>
                    <div class="kartu-course">
                        <img src="image\pemmob.png"/>
                        <p>Pemrograman Mobile</p>
                    </div>
                    <div class="kartu-course">
                        <img src="image\dataanalis.jpg"/>
                        <p>Data Analis</p>
                    </div>
                    <div class="kartu-course">
                        <img src="image\uiux.jpg"/>
                        <p>UI/UX</p>
                    </div>
                </div>
            </div>
        </section>

    <div id="copyright">
        <div class="wrapper">
            &copy; 2024. <b>Techion</b> All Rights Reserved.
        </div>
    </div>
    
</body>
</html>