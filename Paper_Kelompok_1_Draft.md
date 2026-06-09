# Paper Kelompok 1 - Sentinel Public Safety

## 1. Pendahuluan (Introduction)

### 1.1 Latar Belakang
Bencana alam merupakan fenomena yang tidak dapat diprediksi secara pasti kapan dan di mana akan terjadi, meskipun potensi dan dampaknya seringkali sangat besar. Indonesia, yang terletak di kawasan Cincin Api Pasifik (Pacific Ring of Fire), memiliki kerentanan yang tinggi terhadap berbagai jenis bencana alam seperti gempa bumi, banjir, tanah longsor, hingga letusan gunung berapi. Dalam situasi krisis, kecepatan penyampaian informasi dan respons yang tepat menjadi faktor krusial dalam meminimalisir korban jiwa dan kerugian material. 

Saat ini, sistem penanganan bencana seringkali dihadapkan pada beberapa permasalahan utama. Pertama, kurangnya sistem pelaporan real-time yang terpusat menyebabkan informasi kejadian di lapangan lambat diterima oleh pihak berwenang, sehingga memperlambat waktu respons (response time). Kedua, dalam kondisi panik, masyarakat seringkali kesulitan mendapatkan informasi yang akurat mengenai rute evakuasi, lokasi shelter (posko pengungsian), dan fasilitas kesehatan terdekat. Ketiga, sistem peringatan dini yang ada belum sepenuhnya terintegrasi dengan panduan mitigasi yang adaptif dan spesifik terhadap konteks kejadian yang dialami oleh masyarakat.

Untuk mengatasi permasalahan tersebut, dibutuhkan sebuah platform terintegrasi yang mampu menjembatani kebutuhan informasi masyarakat dan efisiensi operasional petugas penanggulangan bencana (seperti BMKG dan BAZARNAS). Oleh karena itu, dalam penelitian ini diusulkan pengembangan aplikasi "Sentinel Public Safety", sebuah aplikasi web full-stack terintegrasi yang menyediakan fitur pelaporan real-time, pemetaan rute evakuasi interaktif berbasis geofencing, serta sistem rekomendasi tindakan preventif dan responsif yang didukung oleh kecerdasan buatan (AI) dan integrasi data langsung dari BMKG.

### 1.2 Rumusan Masalah
Berdasarkan latar belakang tersebut, rumusan masalah dalam penelitian ini adalah:
1. Bagaimana merancang dan membangun sistem pelaporan bencana yang real-time dan terpusat untuk mempercepat respons penanganan darurat?
2. Bagaimana menyediakan informasi rute evakuasi, shelter, dan fasilitas kesehatan yang mudah diakses dan akurat bagi masyarakat di lokasi bencana?
3. Bagaimana mengintegrasikan sistem peringatan dini BMKG dengan fitur rekomendasi kecerdasan buatan (AI) untuk memberikan panduan keselamatan yang adaptif bagi masyarakat?

### 1.3 Tujuan Penelitian
Tujuan dari penelitian ini adalah:
1. Membangun aplikasi "Sentinel Public Safety" yang mampu menerima dan mengelola laporan kejadian bencana secara real-time dari masyarakat.
2. Mengembangkan fitur pemetaan interaktif berbasis geofencing untuk menyajikan informasi rute evakuasi, posko, dan fasilitas kesehatan terdekat.
3. Mengintegrasikan layanan eksternal (API BMKG) dan model bahasa besar (LLM/GPT) untuk menghasilkan sistem peringatan dini dan rekomendasi mitigasi bencana yang cerdas.

---

## 2. Tinjauan Pustaka (Literature Review)

### 2.1 Sistem Informasi Penanggulangan Bencana
Sistem informasi manajemen bencana memainkan peran penting dalam seluruh fase penanggulangan bencana, mulai dari mitigasi, kesiapsiagaan, tanggap darurat, hingga pemulihan. Sistem yang efektif harus mampu memfasilitasi komunikasi dua arah antara masyarakat terdampak dan petugas penolong. Sentinel Public Safety mengadopsi konsep ini dengan memisahkan antarmuka untuk dua peran utama: masyarakat umum (`user`) dan petugas (`officer`), memastikan pengelolaan data yang efisien dan distribusi informasi yang tepat sasaran.

### 2.2 Integrasi Layanan (API BMKG dan AI)
Peringatan dini yang cepat sangat bergantung pada akurasi data. Integrasi dengan Application Programming Interface (API) dari lembaga resmi seperti Badan Meteorologi, Klimatologi, dan Geofisika (BMKG) memungkinkan aplikasi untuk menarik data cuaca dan gempa bumi secara real-time. Selain itu, pemanfaatan Artificial Intelligence (AI), khususnya Large Language Models (LLM), dalam memberikan rekomendasi tindakan merupakan pendekatan inovatif. AI dapat memproses konteks kejadian (jenis bencana dan lokasi) untuk menghasilkan panduan responsif (tindakan saat bencana) maupun preventif (langkah pencegahan) yang mudah dipahami oleh masyarakat.

### 2.3 Arsitektur Perangkat Lunak (MVC + Service + Repository)
Dalam pengembangan aplikasi skala menengah hingga besar, penggunaan arsitektur Model-View-Controller (MVC) standar seringkali tidak cukup untuk menjaga kode tetap bersih (clean code) dan mudah dipelihara (maintainable). Oleh karena itu, penerapan *Service Layer* dan *Repository Layer* di atas MVC menjadi best practice. 
*   **Repository Layer:** Mengisolasi logika akses data (query database), sehingga pengembang dapat mengubah sumber data tanpa mengganggu logika bisnis.
*   **Service Layer:** Menangani logika bisnis yang kompleks (seperti kalkulasi geofencing atau pemanggilan API eksternal), memisahkan tanggung jawab ini dari Controller.
*   **Controller:** Hanya bertugas menerima *request* HTTP dan mengembalikan *response*.
Arsitektur ini memastikan aplikasi memiliki kinerja yang terstruktur, aman, dan skalabel.

### 2.4 Pekerjaan Terkait (Related Work)
Penelitian mengenai sistem informasi dan mitigasi bencana telah banyak dilakukan, khususnya dengan memanfaatkan Sistem Informasi Geografis (SIG) dan integrasi data lembaga resmi. Beberapa penelitian yang menjadi rujukan dalam pengembangan Sentinel Public Safety antara lain:

1. **Penerapan Kecerdasan Buatan dalam Mitigasi Bencana:** Penelitian dalam *Jurnal Sistem Komputer dan Kecerdasan Buatan (2025)* menyoroti pentingnya pemanfaatan kecerdasan buatan (AI) untuk mengolah data secara cepat guna keperluan prediksi dan sistem peringatan dini. Penelitian tersebut mencatat bahwa integrasi AI dengan data historis dan real-time dapat meningkatkan kecepatan respons darurat secara signifikan. Sentinel Public Safety mengadopsi prinsip ini melalui `AiRecommendationService` yang memproses konteks kejadian untuk memberikan rekomendasi preventif dan responsif.
2. **Sistem Informasi Geografis (SIG) untuk Pemetaan Risiko:** Studi mengenai *Pemetaan Risiko Bencana Berbasis Web GIS (2023-2025)* menunjukkan efektivitas SIG dalam memvisualisasikan data kerawanan, seperti rute evakuasi dan lokasi shelter. Penggunaan lapisan data spasial (spatial data layers) terbukti mempermudah masyarakat dan pemerintah dalam mengambil keputusan tata ruang. Pada Sentinel Public Safety, konsep ini diimplementasikan melalui peta evakuasi interaktif berbasis geofencing.
3. **Integrasi Data BMKG:** Berbagai penelitian, seperti prediksi bahaya banjir menggunakan *Artificial Neural Network* (ANN) maupun metode clustering (*K-Means*), secara konsisten menggunakan data dari Badan Meteorologi, Klimatologi, dan Geofisika (BMKG) sebagai *ground truth*. Sentinel Public Safety melanjutkan praktik terbaik ini dengan membangun `BmkgService` yang secara otomatis menyinkronkan data gempa bumi dan peringatan cuaca, dilengkapi dengan mekanisme *graceful fallback* untuk memastikan ketersediaan layanan.

---

## 3. Metodologi Penelitian (Methodology)

### 3.1 Desain Sistem dan Arsitektur Perangkat Lunak
Pengembangan aplikasi Sentinel Public Safety menggunakan pendekatan rekayasa perangkat lunak yang terstruktur dengan mengadopsi arsitektur tiga lapis (three-tier architecture) berbasis *Model-View-Controller* (MVC) yang diperluas dengan *Service* dan *Repository Layer*. 
Kerangka kerja (framework) utama yang digunakan adalah Laravel (versi 12.0) dengan bahasa pemrograman PHP (versi 8.2). Untuk antarmuka pengguna (frontend), aplikasi ini menggunakan Blade template engine yang dikombinasikan dengan Vite dan Tailwind CSS untuk menghasilkan desain yang responsif. Database yang digunakan selama tahap pengembangan adalah SQLite, diakses melalui Eloquent ORM.

Alur pemrosesan data dirancang sebagai berikut:
`Controller → Service → Repository → Model → Database`
Pendekatan ini memastikan logika bisnis (berada di *Service*) terpisah dari logika akses database (berada di *Repository*), sehingga sistem lebih mudah untuk diuji dan dikembangkan lebih lanjut.

### 3.2 Kebutuhan Fungsional (Functional Requirements)
Aplikasi dibagi menjadi dua ruang lingkup pengguna berdasarkan *role-based access control*:
1.  **Masyarakat (`user`):** Memiliki fitur untuk melaporkan bencana, melihat riwayat kejadian dalam radius tertentu (geofencing), mengakses peta interaktif (rute evakuasi, shelter, fasilitas kesehatan), dan mendapatkan rekomendasi AI untuk tindakan preventif dan responsif.
2.  **Petugas (`officer`):** Memiliki akses ke dashboard analitik, peta sebaran bencana, manajemen laporan masyarakat, serta fungsi Create, Read, Update, Delete (CRUD) untuk data infrastruktur evakuasi dan catatan penanggulangan. Petugas juga menerima sinkronisasi data otomatis dari BMKG.

### 3.3 Integrasi Sistem Eksternal
Metodologi integrasi melibatkan dua layanan utama:
1.  **BmkgService:** Bertugas melakukan penarikan data (fetching) kejadian gempa atau peringatan cuaca langsung dari endpoint publik BMKG. Sistem dilengkapi dengan mekanisme *graceful fallback* untuk memastikan aplikasi tetap berjalan meskipun API BMKG mengalami gangguan jaringan.
2.  **AiRecommendationService:** Menggunakan API LLM (seperti OpenAI GPT-3.5) untuk memproses *prompt* yang berisi jenis bencana dan lokasi. Service ini membedakan output menjadi *preventive mode* dan *responsive mode*. Untuk mengoptimalkan kinerja dan biaya (API tokens), sistem menggunakan *Cache* untuk menyimpan rekomendasi serupa, dan menyediakan data rekomendasi statis (fallback) jika layanan AI tidak tersedia.

### 3.4 Skenario Pengujian (Testing Scenarios)
Pengujian sistem dilakukan untuk memastikan seluruh fitur berjalan sesuai dengan spesifikasi. Pengujian mencakup pengujian fungsional pada layer API maupun antarmuka pengguna. Berdasarkan dokumen kasus uji (test cases) yang telah disusun, pengujian difokuskan pada manajemen data krusial, seperti pengujian *Positive* dan *Negative* pada fitur "Kelola Jalur Evakuasi" untuk Petugas. Pengujian ini memverifikasi bahwa sistem mampu menangani input data yang valid, menolak input yang tidak lengkap atau melebihi batas karakter, serta memastikan keamanan akses (*Authorization*) sehingga pengguna yang tidak terautentikasi (masyarakat umum) tidak dapat memodifikasi data infrastruktur darurat.
